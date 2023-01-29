<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    //
    public function getSlider(){

        return view('admin.layout.slider.slider_list');
    }
}
