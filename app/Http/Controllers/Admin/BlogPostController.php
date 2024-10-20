<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddBlogPostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditBlogRequest;
use App\Models\BlogPost;
use App\Repositories\Admin\Interfaces\AccountAdminRepositoryInterface;
use App\Repositories\Admin\Interfaces\BlogPostRepositoryInterface;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    //
    protected $blogPostRepository, $accountAdminRepository;
    public function __construct(BlogPostRepositoryInterface $blogPostRepository, AccountAdminRepositoryInterface $accountAdminRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
        $this->accountAdminRepository = $accountAdminRepository;
    }
    public function getAllBlog()
    {
        $data['bloglist'] = $this->blogPostRepository->getAll();
        return view('admin.layout.blogpost.listblog', $data);
    }
    public function getAddBlog()
    {
        $data['list_user'] = $this->accountAdminRepository->show();
        return view('admin.layout.blogpost.addblog', $data);
    }
    public function postAddBlog(AddBlogPostRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('featured_image')) {
            $filename = $request->file('featured_image')->getClientOriginalName();
            $destination_path = 'public/featured-img-blog';
            $path = $request->file('featured_image')->storeAs($destination_path, $filename);
        }
        $data = [
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'summary' => $validatedData['summary'] ?? NULL,
            'content' => $validatedData['description'],
            'featured_image' => $filename,
            'author_id' => $validatedData['author_id'],
            'published_at' => $validatedData['published_at'] ?? NULL,
            'status' => $validatedData['status'],
            'meta_title' => $validatedData['meta_title'] ?? NULL,
            'meta_description' => $validatedData['meta_description'] ?? NULL,
            'meta_keywords' => $validatedData['meta_keywords'] ?? NULL,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $this->blogPostRepository->create($data);
        return redirect()->back()->with('message', 'Blog đã được thêm mới!');
    }
    public function getEditBlog($id){
        $data['blogpost'] = $this->blogPostRepository->findById($id);
        $data['list_user'] = $this->accountAdminRepository->show();
        return view('admin.layout.blogpost.editblog', $data);
    }
    public function postEditBlog(EditBlogRequest $request, $id){
        $validatedData = $request->validated();
        $blogPost = $this->blogPostRepository->findById($id);
        if($request->hasFile('featured_image')){
            $filename = $request->file('featured_image')->getClientOriginalName();
            $destination_path = 'public/featured-img-blog';
            $path = $request->file('featured_image')->storeAs($destination_path, $filename);
        }else{
            $filename = $blogPost->featured_image;
        }

        $data = [
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'summary' => $validatedData['summary'],
            'content' => $validatedData['description'],
            'featured_image' => $filename,
            'author_id' => $validatedData['author_id'],
            'published_at' => $validatedData['published_at'],
            'status' => $validatedData['status'],
            'meta_title' => $validatedData['meta_title'],
            'meta_description' => $validatedData['meta_description'],
            'meta_keywords' => $validatedData['meta_keywords'],
            'updated_at' => now()
        ];
        $this->blogPostRepository->update($id,$data);

        return redirect()->back()->with('message', 'Sửa blog thành công');
    }
    public function getDeleteBlog($id){
        $this->blogPostRepository->delete($id);
        return back();
    }
}
