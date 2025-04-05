<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $order = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month');
        $months = $order->keys();
        $totals = $order->values();

        return view('admin.layout.home_admin',compact('months', 'totals'));
    }

    public function getProfileUser(){
        $data['userInfo'] = Auth::user();
        return view('admin.profile_user', $data);
    }
}
