<?php
namespace App\Repositories\Eloquent;

use App\Models\FeeShip;
use App\Repositories\Interfaces\FeeShipRepositoryInterface;

class FeeShipRepository implements FeeShipRepositoryInterface{
    public function findFeeShip($city_id, $district_id, $ward_id){
        return FeeShip::where('fee_matp', $city_id)
        ->where('fee_maqh', $district_id)
        ->where('fee_xaid', $ward_id)
        ->first();
    }
}