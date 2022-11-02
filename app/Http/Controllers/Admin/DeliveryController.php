<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\FeeShip;
use App\Models\Wards;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class DeliveryController extends Controller
{
    //
    public function getDelivery()
    {
        $data['city'] = City::orderBy('matp', 'ASC')->get();
        $data['infoFeeship'] = DB::table('feeship')
            ->join('tinhthanhpho', 'feeship.fee_matp', '=', 'tinhthanhpho.matp')
            ->join('quanhuyen', 'feeship.fee_maqh', '=', 'quanhuyen.maqh')
            ->join('xaphuongthitran', 'feeship.fee_xaid', '=', 'xaphuongthitran.xaid')
            ->orderBy('fee_id', 'DESC')
            ->get();
        //dd($data);
        return view('admin.layout.delivery.delivery', $data);
    }

    public function postSelectDelivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_district = District::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output = '<option> -- Chọn quận/huyện --</option>';
                foreach ($select_district as $key => $district) {
                    $output .= '<option value="' . $district->maqh . '">' . $district->name_district . '</option>';
                }
            } else {
                $select_ward = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
                $output = '<option>-- Chọn phường/xã --</option>';
                foreach ($select_ward as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_ward . '</option>';
                }
            }
        }
        echo $output;
    }
    public function postAddDelivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new FeeShip();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['district'];
        $fee_ship->fee_xaid = $data['ward'];
        $fee_ship->fee_feeship = $data['feeship'];
        $fee_ship->save();
    }
    public function postEditDelivery(Request $request)
    {
        # code...
        $fee_ship = FeeShip::where('fee_id', '=', $request['feeship_id'])
        ->update([
            'fee_feeship' => $request['fee_value']
        ]);
    }
}
// rtrim($request['fee_value'],'.')