<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\District;
use App\Models\FeeShip;
use App\Models\Wards;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\FeeShipRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CheckOutController extends Controller
{
    protected $customerRepository;
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $feeShipRepository;
    protected $cartRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository, OrderRepositoryInterface $orderRepository, OrderDetailRepositoryInterface $orderDetailRepository, FeeShipRepositoryInterface $feeShipRepository, CartRepositoryInterface $cartRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->feeShipRepository = $feeShipRepository;
        $this->cartRepository = $cartRepository;
    }

    public function getCheckout()
    {
        $data['cart'] = Cart::content();
        $data['city'] = City::orderBy('matp', 'ASC')->get();
        $data['totalProduct'] = Cart::total(0, ',', '.');
        $feeAmount = Session::get('feeship');
        $data['feeship'] = number_format($feeAmount, 0, ',', '.');

        return view('frontend.checkout', $data);
    }

    public function postSelectShippingInfomation(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_district = District::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output = '<option value=> -- Chọn quận/huyện --</option>';
                foreach ($select_district as $key => $district) {
                    $output .= '<option value="' . $district->maqh . '">' . $district->name_district . '</option>';
                }
            } else {
                $select_ward = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
                $output = '<option value=>-- Chọn phường/xã --</option>';
                foreach ($select_ward as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_ward . '</option>';
                }
            }
        }
        echo $output;
    }
    public function postChargeShipping(Request $request)
    {
        $data = $request->all();
        $data['totalProduct'] = $this->cartRepository->total();
        if ($data['matp']) {
            $feeship = $this->feeShipRepository->findFeeShip($data['matp'], $data['maqh'], $data['xaid']);
            $feeAmount = $feeship ? $feeship->fee_feeship : 25000;
            Session::put('feeship', $feeAmount);
            Session::save();
        }
        $feeAmount = Session::get('feeship');
        $data['feeship'] = number_format($feeAmount, 0, ',', '.');
        $checkout_component = view('frontend.component.checkout_component', $data)->render();
        return response()->json([
            'feeship' => $feeAmount, // Trả về giá trị 0 hoặc gtri mặc định nếu không có đủ dữ liệu đầu vào
            'checkout_component' => $checkout_component
        ]);
    }

    public function postCheckout(CheckOutRequest $request)
    {    

        try {
            $validated = $request->validated();
            $cartInfo = $this->cartRepository->content();
            $totalProduct = intval(str_replace('.', '', $this->cartRepository->total()));
            $feeship = intval(str_replace('.', '', number_format(Session::get('feeship'), 0, ',', '.')));
            $data['total_after_feeship'] = number_format($totalProduct + $feeship, 0, ',', '.');
            $order_total = (int)str_replace('.', '',  $data['total_after_feeship']);
            
            $cityID = $request->input('city');
            $districtID = $request->input('district');
            $wardID = $request->input('ward');
            $address = $request->input('address');
            $cityName = City::where('matp', $cityID)->value('name_city');
            $districtName = District::where('maqh', $districtID)->value('name_district');
            $wardName = Wards::where('xaid', $wardID)->value('name_ward');
    
            $fullAddress = $address . ', ' . $wardName . ', ' . $districtName . ', ' . $cityName;
    
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
                'total' => $order_total,
                'notes' => $validated['notes'],
                'order_status' => 1,
                'order_code' => $checkout_code,
                'order_payment' => $validated['payments'],
            ];
            $order = $this->orderRepository->create($orderData);
            foreach ($cartInfo as $item) {
                $orderDetailData = [
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantily' => $item->qty,
                    'price' => $item->price,
                    'order_code' => $checkout_code,
                    'order_payment' => $order->order_payment,
                ];
                $this->orderDetailRepository->create($orderDetailData);
            }
            $data['info'] = $validated;
            $data['order_code'] = $checkout_code;
            $data['address'] = $fullAddress;
            $email = $validated['email'];
            $data['cart'] = $this->cartRepository->content();
            Mail::send('frontend.email', $data, function ($message) use ($email) {
                $message->to($email, $email);
                $message->subject('Cảm ơn bạn đã mua hàng Si.Belle Cosmetics');
            });
            Mail::send('frontend.email', $data, function ($message) {
                $message->to('huuduongn91@gmail.com', 'Manager Si.Belle Cosmetics');
                $message->subject('Bạn có một đơn hàng mới từ Si.Belle Cosmetics');
            });
            Cart::destroy();
            return response()->json([
                'status' => 'success',
                'message' => 'Đơn hàng của bạn đã được tạo thành công!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi xử lý đơn hàng.'
            ], 500);
        }
    }
    public function getDeleteFeeship()
    {
        Session::forget('feeship');
        return back();
    }
}
