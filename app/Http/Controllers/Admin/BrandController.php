<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\EditBrandRequest;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    //
    public function getBrand(){
        $data['brandlist'] = Brand::all();
        return view('admin.layout.brand.listbrand', $data);
    }

    public function getAddBrand(){
        return view('admin.layout.brand.addbrand');
    }

    public function postAddBrand(AddBrandRequest $request){
        $brand = new Brand;
        $brand->brand_name = $request->name;
        $brand->brand_slug = Str::slug($request->name);
        $brand->save();
        return redirect('admin/brand');
    }

    public function getEditBrand($id){
        $data['brand'] = Brand::find($id);
        return view('admin.layout.brand.editbrand', $data);
    }
    public function postEditBrand(EditBrandRequest $request,$id){
        $brand = Brand::find($id);
        $brand->brand_name = $request->name;
        $brand->brand_slug = Str::slug($request->name);
        $brand->save();
        return redirect()->intended('admin/brand');
    }
    public function getDeleteBrand($id){
        Brand::destroy($id);
        return back();
    }
}
