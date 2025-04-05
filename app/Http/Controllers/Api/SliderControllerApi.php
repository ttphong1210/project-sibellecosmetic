<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderControllerApi extends Controller
{
    public function getSlider(){
        $sliders = Slider::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        return response()->json([
            'sliders' => $sliders
        ]);
    }
}
