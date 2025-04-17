<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Repositories\Admin\Interfaces\BrandRepositoryInterface;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $productRepository, $categoryRepository, $brandRepository;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, BrandRepositoryInterface $brandRepository){
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
    }
    public function getProduct(){
        $data['productlist'] = $this->productRepository->getAll();       
        return view('admin.layout.product.listproduct',$data);
    }

    public function getAddProduct(){
        $data['catelist'] = $this->categoryRepository->showAll();
        $data['brandlist'] = $this->brandRepository->getAll();
        return view('admin.layout.product.addproduct',$data);
    }

    public function postAddProduct(AddProductRequest $request){
        $filename = $request->file('img')->getClientOriginalName();
        $destination_path = 'public/avatar';
        $allImage = array();
       
        $data = [
            'prod_name' => $request->name,
            'prod_slug' => Str::slug($request->name),
            'prod_price' => $request->price,
            'prod_img' => $filename,
            'prod_status' => $request->status,
            'prod_summary' => $request->summary,
            'prod_des' => $request->description,
            'prod_promotion' => $request->promotion,
            'prod_cate' => $request->cate,
            'prod_brand' => $request->brand,
            'prod_featured' => $request->featured,
        ];
        
        if($request->hasFile('image-gallery')){
            foreach($request->file('image-gallery') as $file){
                $filename_gallery = md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $filename_gallery . '.' . $ext;
                $multiple_path = 'public/gallery/';
                $file->storeAs($multiple_path, $image_full_name);
                $allImage[]= $image_full_name;
            }
            $data['prod_gallery'] = implode('|', $allImage);
        }
       
        $this->productRepository->create($data);        
        $request->file('img')->storeAs($destination_path, $filename);
        return back()->with('status','Thêm sản phẩm thành công !');
    }

    public function getEditProduct($id){
        $data['product'] = $this->productRepository->findById($id);
        $data['listcate'] = $this->categoryRepository->showAll();
        $data['listbrand'] = $this->brandRepository->getAll();

        return view('admin.layout.product.editproduct',$data);
    }
    public function postEditProduct(Request $request,$id){

        $allImage = array();
        $data = [
            'prod_name' => $request->name,
            'prod_slug' => Str::slug($request->name),
            'prod_price' => $request->price,
            'prod_status' => $request->status,
            'prod_summary' => $request->edit_summary,
            'prod_des' => $request->edit_description,
            'prod_promotion' => $request->promotion,
            'prod_cate' => $request->cate,
            'prod_brand' => $request->brand,
            'prod_featured' => $request->featured,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->storeAs('public/avatar',$filename);
            $data['prod_img'] = $request->file('image')->getClientOriginalName();

        }  
        if($request->hasFile('image-gallery')){
            foreach($request->file('image-gallery') as $file){
                $filename_gallery = md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $filename_gallery . '.' . $ext;
                $multiple_path = 'public/gallery/';
                $file->storeAs($multiple_path, $image_full_name);
                $allImage[]= $image_full_name;
            }
            $data['prod_gallery'] =  implode('|', $allImage);
        }
        $this->productRepository->update($id, $data);
        return redirect('admin/product');
    }

    public function getDeleteProduct($id){
       $this->productRepository->delete($id);
       return back();
    }

    public function getSearch(Request $request){
        $inputQuerySearch = $request->query('inputQuery');
        $data['productlist'] = $this->productRepository->findByStr($inputQuerySearch);
        
        if(empty($inputQuerySearch)){
            $data['productlist'] = $this->productRepository->getAll();
            $htmlRender = view('admin.layout.product.listproductSearch',$data)->render();  
        } elseif($data['productlist']->isEmpty()){
            $htmlRender = '<p style="text-align:center; font-size: 1.15em">Không tìm thấy sản phẩm nào</p>';
        }else{
            $htmlRender = view('admin.layout.product.listproductSearch', $data)->render();
        }
        return response()->json($htmlRender);
    }
    
}
