<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Repositories\Admin\Eloquent\CategoryRepository;
use App\Repositories\Admin\Eloquent\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManagerProductControllerApi extends Controller
{
    //
    protected $productRepository, $categoryRepository;
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function listManagerProduct()
    {
        $listProduct = $this->productRepository->getAll();
        $listCategory = $this->categoryRepository->showAll();
        return response()->json([
            'listProduct' => $listProduct,
            'listCategory' => $listCategory,
        ]);
    }
    public function ManagerAddProduct(AddProductRequest $request)
    {
        $validated = $request->validated();
        $data = [
            'prod_name' => $validated['name'],
            'prod_slug' => Str::slug($validated['name']),
            'quantity' => $validated['quantity'],
            'prod_price' => $validated['price'],
            'prod_status' => $request->status,
            'prod_summary' => $request->summary,
            'prod_des' => $request->description,
            'prod_promotion' => $request->promotion,
            'prod_cate' => $request->category,
            'prod_brand' => $request->brand,
            'prod_featured' => $request->featured,
        ];
        if ($request->hasFile('imageAvatar')) {
            $image = $request->file('imageAvatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/avatar', $imageName);
            $data['prod_img'] = $imageName;
        }
        if ($request->hasFile('gallery')) {
            $galleryFile = $request->file('gallery');
            $galleryImagePath = [];
            foreach ($galleryFile as $index => $image) {
                if ($image->isValid()) {
                    $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/gallery', $imageName);
                    $galleryImagePath[] = $imageName;
                }
            }
            $data['prod_gallery'] = implode('|', $galleryImagePath);
        }
        $this->productRepository->create($data);
        return response()->json([
            'message' => 'Thêm sản phẩm thành công !',
            'data' => $data,
        ]);
    }

    public function actionSearchProduct(Request $request)
    {
        $inputQuery = $request->query('inputQuery');
        if (empty($inputQuery)) {
            $productWithSearch = $this->productRepository->getAll();
        } else {
            $productWithSearch = $this->productRepository->findByStr($inputQuery);
        }
        return response()->json([
            'productList' => $productWithSearch
        ]);
    }
    public function actionEditProduct(Request $request, $id)
    {
        $product = $this->productRepository->findById($id);
        $data = [
            'prod_name' => $request->prod_name,
            'prod_slug' => Str::slug($request->prod_name),
            'quantity' => $request->quantity,
            'prod_price' => $request->prod_price,
            'prod_status' => $request->prod_status,
            'prod_summary' => $request->prod_summary,
            'prod_des' => $request->prod_des,
            'prod_promotion' => $request->prod_promotion,
            'prod_cate' => $request->prod_cate,
            'prod_brand' => $request->prod_brand,
            'prod_featured' => $request->prod_featured,
        ];
        if ($request->hasFile('imageAvatar')) {
            if ($product->prod_img) {
                Storage::delete('public/avatar/' . $product->prod_img);
            }
            $image = $request->file('imageAvatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/avatar', $imageName);
            $data['prod_img'] = $imageName;
        }

        $galleryFromDB = explode("|", $product->prod_gallery);
        $currentGallery = $request->currentGallery ? explode("|",$product->prod_gallery) : [];
        $imageDelete = array_diff($galleryFromDB, $currentGallery);
        foreach($imageDelete as $img){
            Storage::delete('public/gallery/'. $img);
        }
        if ($request->hasFile('gallery')) {
            $galleryFile = $request->file('gallery');
            $newGallery = [];
            foreach ($galleryFile as $index => $image) {
                if ($image->isValid()) {
                    $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/gallery', $imageName);
                    $newGallery[] = $imageName;
                }
            }
            $finalGallery = array_merge($currentGallery, $newGallery);
        } else {
            $finalGallery = $currentGallery;
        }
        $data['prod_gallery'] = implode("|", $finalGallery);
        $this->productRepository->update($id, $data);
        return response()->json([
            'message' => 'Cập nhật thay đổi thành công !',
            'data' => $data
        ]);
    }
    public function actionDeleteProduct($id)
    {
        $this->productRepository->delete($id);
        return response()->json([
            'message' => 'Delete Product Success'
        ]);
    }
}
