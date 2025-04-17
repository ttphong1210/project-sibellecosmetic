<?php

namespace App\Http\Controllers\Api\Admin;

use App\Repositories\Admin\Eloquent\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCateRequest;
use Illuminate\Support\Str;

class ManagerCategoryControllerApi extends Controller
{
    //
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    public function listManagerCategory()  {
        $listCategory = $this->categoryRepository->showAll();

        return response()->json([
            'listCategory' => $listCategory,
        ]);
    }

    public function actionAddNewCategory(AddCateRequest $request){
        $data = $request->validated();
        $categoryData = [
            'cate_name' => $data['name'],
            'cate_slug' => Str::slug($data['name']),
        ];
        $this->categoryRepository->create($categoryData);
        return response()->json([
            'message' => 'Thêm sản phẩm thành công !',
        ]);
    }
    public function actionDeleteCategory($id){
        $this->categoryRepository->delete($id);
        return response()->json([
            'message' => 'Đã xoá thành công !',
        ]);
    }
}
