<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\EditCateRequest;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    public function getCate(){
        $data['catelist'] = $this->categoryRepository->showAll();
        return view('admin.layout.category.listcategory',$data);
    }

    public function getAddCate(){
        return view('admin.layout.category.addcategory');
    }

    public function postAddCate(AddCateRequest $request){
        $categoryData = [
            'cate_name' => $request->name,
            'cate_slug' => Str::slug($request->name),
        ];
       $category = $this->categoryRepository->create($categoryData);
        return redirect('admin/category');
    }

    public function getEditCate($id){
        $data['cate'] = $this->categoryRepository->findById($id);
        return view('admin.layout.category.editcategory', $data);
    }

    public function postEditCate(EditCateRequest $request,$id){
        $data = [
            'cate_name' => $request->name,
            'cate_slug' => Str::slug($request->name),
        ];
        $this->categoryRepository->update($id, $data);
        return redirect()->intended('admin/category');
    }
    public function getDeleteCate($id){
        $this->categoryRepository->delete($id);
        return back();
    }
}
