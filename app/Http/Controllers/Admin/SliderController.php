<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function getSlider(){
        $data['listSlider'] = Slider::orderBy('id', 'DESC')->get();
        return view('admin.layout.slider.list_slider', $data);
    }
    public function getAddSlider(){
        return view('admin.layout.slider.add_slider');
    }
    public function postAddSlider(Request $request){
        $filename = $request->file('img')->getClientOriginalName();
        $destination_path = 'public/slider';

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->status = $request->status;
        $slider->image = $filename;
        $slider->save();

        $path = $request->file('img')->storeAs($destination_path, $filename);
        return back()->with('status','Add Slider Successfull');
    }
    public function postUpdateStatusSlider(Request $request){   
        $slider = Slider::find($request->slider_id);
        if($slider){
            $slider->status = $request->status;
            $slider->save();
            return response()->json(['message' => 'Cập nhật trạng thái thành công!']);
        };
        return response()->json(['message' => 'Không tìm thấy mục.'], 404);

    }
}
