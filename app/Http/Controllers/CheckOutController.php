<?php

namespace App\Http\Controllers;

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
    // public function getCheckout()
    // {
    //     $data['cart'] = Cart::content();
    //     $data['city'] = City::orderBy('matp', 'ASC')->get();
    //     $data['totalProduct'] = Cart::total( 0, ',', '.');
    //     $feeAmount = Session::get('feeship');
    //     $data['feeship'] = number_format($feeAmount, 0, ',', '.');

    //     return view('frontend.checkout', $data);
    // }

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

    public function postCheckout(Request $request)
    {
        $cartInfo = $this->cartRepository->content();
        $totalProduct = intval(str_replace('.', '', $this->cartRepository->total()));
        $feeship = intval(str_replace('.', '', number_format(Session::get('feeship'), 0, ',', '.')));
        $data['total_after_feeship'] = number_format($totalProduct + $feeship, 0, ',', '.');
        $order_total = (int)str_replace('.', '',  $data['total_after_feeship']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'number_phone' => 'required|numeric|min:10',
            'payments' => 'required'

        ]);
        if ($validator->fails()) {
            return back()->with('status', 'Vui lòng kiểm tra nhập đầy đủ thông tin & phương thức thanh toán ');
        }
        try {
            $customerData = [
                'cust_name' => $request->name,
                'cust_phone' => $request->number_phone,
                'cust_email' => $request->email,
                'address' => $request->address,
                'notes' => $request->notes,
            ];
            $customer = $this->customerRepository->create($customerData);
            $checkout_code = substr(md5(microtime()), rand(0, 26), 5);

            $orderData = [
                'customer_id' => $customer->cust_id,
                'date_order' => Carbon::now('Asia/Ho_Chi_Minh'),
                'total' => $order_total,
                'notes' => $request->notes,
                'order_status' => 1,
                'order_code' => $checkout_code,
                'order_payment' => $request->payments,
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
            $data['info'] = $request->all();
            $email = $request->email;
            $data['cart'] = $this->cartRepository->content();
            Mail::send('frontend.email', $data, function ($message) use ($email) {
                $message->to($email, $email);
                $message->cc('hoaithukt999@gmail.com', 'Trần Thị Hoài Thu');
                $message->subject('Cảm ơn bạn đã mua hàng Si.Belle Cosmetic');
            });
            Cart::destroy();
            return redirect('complete');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getDeleteFeeship()
    {
        Session::forget('feeship');
        return back();
    }

    // public function postCheckout(Request $request)
    // {

    //     try {


    //         $data['info'] = $request->all();
    //         $email = $request->email;
    //         $data['cart'] = Cart::content();
    //         Mail::send('frontend.email', $data, function ($message) use ($email) {
    //             $message->to($email, $email);
    //             $message->cc('hoaithukt999@gmail.com', 'Trần Thị Hoài Thu');
    //             $message->subject('Cảm ơn bạn đã mua hàng Si.Belle Cosmetic');
    //         });

    //         Cart::destroy();
    //         return redirect('complete');
    //     } catch (Exception $e) {
    //         echo $e->getMessage();
    //     }
    // }
    // public function getDeleteFeeship(){
    //     Session::forget('feeship');
    //     return back();
    // }
}
