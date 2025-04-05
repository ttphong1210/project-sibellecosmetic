<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Eloquent\FeeShipRepository;
use App\Services\EmailService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutRequest;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\CustomerRepository;
use App\Repositories\Eloquent\OrderDetailRepository;
use App\Repositories\Eloquent\OrderRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckOutControllerApi extends Controller
{
    //
    protected $cartRepository;
    protected $feeShipRepository;
    protected $orderDetailRepository;
    protected $customerRepository;
    protected $orderRepository;
    protected $emailService;
    public function __construct(CartRepository $cartRepository, FeeShipRepository $feeShipRepository, OrderDetailRepository $orderDetailRepository, CustomerRepository $customerRepository, OrderRepository $orderRepository, EmailService $emailService)
    {
        $this->cartRepository = $cartRepository;
        $this->feeShipRepository = $feeShipRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->emailService = $emailService;
    }
    public function handlePreflight(Request $request)
    {
        return response()->json('OK', 200);
    }

    public function getCityApi()
    {
        $city = City::orderBy('matp', 'ASC')->get();

        return response()->json([
            'city' => $city
        ]);
    }
    public function postSelectShippingInformationApi(Request $request)
    {
        $data = $request->all();
        if (!isset($data['action']) || !isset($data['ma_id'])) {
            return response()->json(["message" => "Invalid Request"], 400);
        }

        if ($data['action']) {
            if ($data['action'] == "city") {
                $select_district = District::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                return response()->json([
                    "districts" => $select_district
                ]);
            } elseif ($data['action'] == "district") {
                $select_ward = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
                return response()->json([
                    'wards' => $select_ward
                ]);
            }
        }
        return response()->json([
            "message" => 'Invalid Resquest'
        ], 400);
    }

    public function calculateShipping(Request $request)
    {
        $data = $request->all();
        if ($data['matp']) {
            $feeship = $this->feeShipRepository->findFeeShip($data['matp'], $data['maqh'], $data['xaid']);
            $feeAmount = $feeship ? $feeship->fee_feeship : 25000; // Giá mặc định nếu không tìm thấy
            Session::put('feeship', $feeAmount);
            Session::save();
        }

        $feeAmount = Session::get('feeship');
        $data['feeship'] = number_format($feeAmount, 0, ',', '.');
        return response()->json([
            'feeship' => $feeAmount, 
        ]);
    }

    public function actionPostCheckOut(CheckOutRequest $request)
    {
        try {
            $validated = $request->validated();
            $cartInfo = $request->input('cart', []);
            $data['total_after_feeship'] = $request->input('totalAfterFeeship', 0);
            $inputAddress = $request->only(['city', 'district', 'ward', 'address']);
            $location = [
                'city' => City::where('matp', $inputAddress['city'])->pluck('name_city')->first(),
                'district' => District::where('maqh', $inputAddress['district'])->pluck('name_district')->first(),
                'ward' => Wards::where('xaid', $inputAddress['ward'])->pluck('name_ward')->first()
            ];
            $fullAddress = implode(',', array_filter([
                $inputAddress['address'],
                $location['ward'],
                $location['district'],
                $location['city'],
            ]));

            $customerData = [
                'cust_name' => $validated['name'],
                'cust_phone' => $validated['number_phone'],
                'cust_email' => $validated['email'],
                'address' => $fullAddress,
                'notes' => $validated['notes'],
            ];

            $customer = $this->customerRepository->create($customerData);
            $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
            $orderData = [
                'customer_id' => $customer->cust_id,
                'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
                'total' => $data['total_after_feeship'],
                'notes' => $validated['notes'],
                'order_status' => 1,
                'order_code' => $checkout_code,
                'order_payment' => $validated['payments'],
            ];
            $order = $this->orderRepository->create($orderData);
            foreach ($cartInfo as $item) {
                $orderDetailData = [
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantily' => $item['quantity'],
                    'price' => $item['price'],
                    'order_code' => $checkout_code,
                    'order_payment' => $order->order_payment,
                ];
                $this->orderDetailRepository->create($orderDetailData);
            }
            $email = $validated['email'];
            $data['notes'] = $validated['notes'];
            $data['cartInfo'] = $cartInfo;
            $data['checkout_code'] = $checkout_code;
            $data['fullAddress'] = $fullAddress;
            $managerEmail = config('mail.manager_email', 'huuduongn91@gmail.com');
            $managerName = 'Manager Si.Belle Cosmetics';
            $this->emailService->sendEmail('frontend.email', $data, $email, $email, 'Cảm ơn bạn đã mua hàng Si.Belle Cosmetics');
            $this->emailService->sendEmail('frontend.email', $data, $managerEmail, $managerName, 'Bạn có một đơn hàng mới từ Si.Belle Cosmetics');
            return response()->json([
                'status' => 'success',
                'message' => 'Đơn hàng của bạn đã được tạo thành công!',
                'data' => $validated,
                'code' => $checkout_code,
                'order' => $order,
                'orderDetail' => $orderDetailData,
            ]);
        } catch (Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi xử lý đơn hàng.',
                'error' => $error
            ]);
        }
    }
}
