<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddBrandRequest;
use App\Repositories\Admin\Eloquent\BrandRepository;
use Illuminate\Support\Str;

class ManagerBrandControllerApi extends Controller
{
    protected $brandRepository;
    public function __construct(BrandRepository $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function listManagerBrands(){
        $listBrands = $this->brandRepository->getAll();
        return response()->json([
            'listBrands' => $listBrands
            
        ]);
    }
    public function actionAddNewBrands(AddBrandRequest $request){
        $data = $request->validated();
        $brandData = [
            'brand_name' => $data['name'],
            'brand_slug' => Str::slug($data['name'])
        ];
        $this->brandRepository->create($brandData);
        return response()->json([
            'message' => 'Thêm thương hiệu thành công',
        ]);
    }
    public function actionDeleteBrands($id) {
        $this->brandRepository->delete($id);

        return response()->json([
            'message' => 'Bạn đã xoá một thương hiệu'
        ]);
    }
}
