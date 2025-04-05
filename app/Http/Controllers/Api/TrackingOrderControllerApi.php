<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class TrackingOrderControllerApi extends Controller
{
    public function postTrackingOrder(Request $request){
        $order_code = $request->order_code;
        $order = Order::where('order_code', $order_code)->first();
        if (!$order) {
            return response()->json([
                'messageError' => 'Không tìm thấy đơn hàng!',
            ], 404);
        }
        return response()->json([
            'messageSuccess' =>  'Ok, chờ xíu nhé !',
        ]);
    }
    public function detailTrackingOrder(Request $request){
        $order_code = $request->query('order_code');
        $order = Order::where('order_code', $order_code)->with('orderDetails.product','customer')->first();
        return response()->json([
            'orderItem' => $order
        ]);
    }
}
