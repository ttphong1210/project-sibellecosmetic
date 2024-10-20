<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function getCustomer()
    {
        $data['customer'] = DB::table('customers')->orderBy('cust_id', 'desc')->get();

        return view('admin.layout.order.listcustomer', $data);
    }
    public function getDeleteCustomer($cust_id)
    {
        $customer = Customer::find($cust_id);
        Customer::destroy($cust_id);
        return back();
    }
    public function getOrder()
    {
        $data['order'] = DB::table('orders')
            ->join('customers', 'customers.cust_id', '=', 'orders.customer_id')
            ->get();
        return view('admin.layout.order.listorder', $data);
    }
    public function getEditOrder($id)
    {
        $data['customerInfo'] = DB::table('customers')
            ->join('orders', 'customers.cust_id', '=', 'orders.customer_id')
            ->where('customer_id', '=', $id)
            ->first();
        $data['orderInfo'] = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftJoin('products', 'order_details.product_id', '=', 'products.prod_id')
            ->where('orders.customer_id', '=', $id)
            ->get();
        return view('admin.layout.order.editorder', $data);
    }
    public function postEditOrder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->order_status = $request->input('status');
        $order->save();
        return redirect('admin/order');
    }
    public function getDeleteOrder($id)
    {
        Order::destroy($id);
        return back();
    }
    public function getTrackingOrder(){
        
    }
}
