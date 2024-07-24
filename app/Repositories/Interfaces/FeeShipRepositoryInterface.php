<?php
namespace App\Repositories\Interfaces;

interface FeeShipRepositoryInterface{
    public function findFeeShip($city_id, $district_id, $ward_id);
}