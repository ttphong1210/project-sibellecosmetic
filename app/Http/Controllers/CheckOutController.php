<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class CheckOutController extends Controller
{

    public function getCheckout()
    {
        $data['cart'] = Cart::content();
        $data['total'] = Cart::subtotal(0,',','.');
        // dd($data);
        return view('frontend.checkout', $data);
    }

    public function postCheckout(Request $request)
    {
        $cartInfo = Cart::content();
  
        //validate
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'number_phone' => 'required|numeric|min:10'
        ]);
      if($validator->fails()){
       // session()->flash('errors','Vui lòng nhập đầy đủ thông tin');
        // return back();
        return back()->with('alert','Vui lòng nhập đầy đủ thông tin');
      }

        try {

            $customer = new Customer;
            $customer->cust_name = $request->name;
            $customer->cust_phone = $request->number_phone;
            $customer->cust_email = $request->email;
            $customer->address = $request->address;
            $customer->notes = $request->notes;

            $customer->save();

            $checkout_code = substr(md5(microtime()),rand(0,26),5);

            $order = new Order;
            $order->customer_id = $customer->id;
            $order->date_order = Carbon::now('Asia/Ho_Chi_Minh');
            $order->total = str_replace(',','', Cart::subtotal());
            $order->notes = $request->notes;
            $order->order_status = 1;
            $order->order_code = $checkout_code;
            $order->order_payment = $request->payments;
            $order->save();

            if(count($cartInfo) > 0){
                foreach($cartInfo as $item){
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
            $data['total'] = Cart::subtotal(0,',','.');
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
}
