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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\District;
use App\Models\FeeShip;
use App\Models\Wards;
use Illuminate\Support\Facades\Session;
// use Symfony\Component\HttpFoundation\Session\Session;

class CheckOutController extends Controller
{

    public function getCheckout()
    {
        $data['cart'] = Cart::content();
        $data['subtotal'] = (int)Cart::subtotal(0,',','.')*1000;
        $data['city'] = City::orderBy('matp', 'ASC')->get();

        return view('frontend.checkout', $data);
    }

    public function select_shipping_infomation(Request $request)
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
    public function charge_shipping(Request $request)
    {
        $data = $request->all();
        //  $output = '';
        if ($data['matp']) {
            $feeship = FeeShip::where('fee_matp', $data['matp'])
                ->where('fee_maqh', $data['maqh'])
                ->where('fee_xaid', $data['xaid'])
                ->get();
                foreach($feeship as $key => $fee){
                    Session::put('feeship', $fee->fee_feeship);
                    Session::save();
                }
            
        //    $output.=' <p class="col subtotal-title"> Phí ship:</p>';
        //   foreach($feeship as $key => $fee){
        //     $output.='<span>'.number_format($fee->fee_feeship,0,',','.').' đ</span>';
          }
          
        //}
        // echo $output;
    }
    public function postCheckout(Request $request)
    {
        $cartInfo = Cart::content();

        //validate
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'number_phone' => 'required|numeric|min:10'
        ]);
        if ($validator->fails()) {
            // session()->flash('errors','Vui lòng nhập đầy đủ thông tin');
            // return back();
            return back()->with('alert', 'Vui lòng nhập đầy đủ thông tin');
        }

        try {

            $customer = new Customer;
            $customer->cust_name = $request->name;
            $customer->cust_phone = $request->number_phone;
            $customer->cust_email = $request->email;
            $customer->address = $request->address;
            $customer->notes = $request->notes;

            $customer->save();

            $checkout_code = substr(md5(microtime()), rand(0, 26), 5);

            $order = new Order;
            $order->customer_id = $customer->id;
            $order->date_order = Carbon::now('Asia/Ho_Chi_Minh');
            $order->total = str_replace(',', '', Cart::subtotal());
            $order->notes = $request->notes;
            $order->order_status = 1;
            $order->order_code = $checkout_code;
            $order->order_payment = $request->payments;
            $order->save();

            if (count($cartInfo) > 0) {
                foreach ($cartInfo as $item) {
                    $orderDetail = new OrderDetail;
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $item->id;
                    $orderDetail->quantily = $item->qty;
                    $orderDetail->price = $item->price;
                    $orderDetail->order_code = $checkout_code;
                    $orderDetail->order_payment = $order->order_payment;
                    $orderDetail->save();
                }
            }

            $data['info'] = $request->all();
            $email = $request->email;
            $data['cart'] = Cart::content();
            $data['total'] = Cart::subtotal(0, ',', '.');
            Mail::send('frontend.email', $data, function ($message) use ($email) {
                $message->from('typhong1210@gmail.com', 'Si.Belle Cosmetic');
                $message->to($email, $email);
                $message->cc('hoaithukt999@gmail.com', 'Trần Thị Hoài Thu');
                $message->subject('Xác nhận mua hàng Si.Belle Cosmetic');
            });

            Cart::destroy();
            return redirect('complete');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function delete_feeship(){
        Session::forget('feeship');
    }
}
