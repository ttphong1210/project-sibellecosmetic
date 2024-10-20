<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\EditBrandRequest;
use App\Repositories\Admin\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    //
    protected $brandRepository;
    public function __construct(BrandRepositoryInterface $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function getBrand(){
        $data['brandlist'] = $this->brandRepository->getAll();
        return view('admin.layout.brand.listbrand', $data);
    }

    public function getAddBrand(){
        return view('admin.layout.brand.addbrand');
    }

    public function postAddBrand(AddBrandRequest $request){
        $data = [
            'brand_name' => $request->name,
            'brand_slug' => Str::slug($request->name)
        ];
        $this->brandRepository->create($data);
        return redirect('admin/brand');
    }

    public function getEditBrand($id){
        $data['brand'] = $this->brandRepository->getById($id);
        return view('admin.layout.brand.editbrand', $data);
    }
    public function postEditBrand(EditBrandRequest $request,$id){
        $data = [
            'brand_name' => $request->name,
            'brand_slug' => Str::slug($request->name)
        ];
        $this->brandRepository->update($id, $data);
        return redirect()->intended('admin/brand');
    }
    public function getDeleteBrand($id){
        $this->brandRepository->delete($id);
        return back();
    }
}
