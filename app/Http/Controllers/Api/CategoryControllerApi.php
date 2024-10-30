<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryControllerApi extends Controller{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->middleware('cors');
        $this->categoryRepository = $categoryRepository;
    }
    public function getCategory(){
        $categoryAll = $this->categoryRepository->showAll();
        return response($categoryAll);
    }
    public function postCategory(Request $request){
        $categoryData = [
            'cate_name' => $request->name,
            'cate_slug' => Str::slug($request->name),
        ];
        $this->categoryRepository()->create($categoryData);
        return response()->json([
            'status_code' => 200,
            'message' => ' Thêm danh mục thành công'
        ]);
    }   
    public function getEditCategory($id){
        $category = $this->categoryRepository->findById($id);
        if($category){
            return $category;
        }
        return response()->json([
            'status_code' => 404,
            'message' => 'Category Not Found'
        ]);
    }
}