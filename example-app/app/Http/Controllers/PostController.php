<?php

namespace App\Http\Controllers;

use App\Models\Post;
use http\Exception\UnexpectedValueException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//
//        $this->authorizeResource(Post::class, 'post');
//    }

    public function index()
    {
        // Get the current authenticated admin's ID
        $adminId = auth()->user()->id; // Ensure you have the necessary authentication setup

        // Retrieve posts created by the current admin in descending order of creation date
        $posts = Post::where('user_id', $adminId)->orderBy('created_at', 'desc')->get();

        return view('admin.post.index', compact('posts'));
    }


    public function create()
    {
        return view('admin.post.create');
    }


    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Post::class);

        $validator = Validator::make($request->all(), [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image.*' => 'nullable|image|max:2048',
        ]);

        // Nếu validate không thành công
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lưu các hình ảnh vào thư mục và lấy tên của chúng
        $imageNames = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $image->move(public_path('uploads/post/'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Tạo bài viết mới và lưu vào cơ sở dữ liệu
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = auth()->id(); // Lấy id của user hiện tại
        $post->image = json_encode($imageNames); // Lưu tên của các hình ảnh dưới dạng JSON
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Tạo mới bài viết thành công');
    }

    public function edit($id) {
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post'));
    }



    public function update(Request $request, $id)
    {
        // Lấy bài viết từ database
        $post = Post::findOrFail($id);

        // Kiểm tra quyền sửa bài viết
        $this->authorize('update', $post);

        // Các xử lý cập nhật bài viết
        $currentUserId = auth()->id();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image.*' => 'nullable|image|max:2048', // Validate each image file
            'user_id' => 'required|integer',
        ]);

        $imageNames = json_decode($post->image, true) ?? [];

        // Xử lý hình ảnh để xóa
        if ($request->has('delete_images')) {
            $deleteImages = $request->input('delete_images');
            foreach ($deleteImages as $deleteImage) {
                if (($key = array_search($deleteImage, $imageNames)) !== false) {
                    unset($imageNames[$key]);
                    $imagePath = public_path('uploads/post/' . $deleteImage);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }

        // Xử lý hình ảnh mới
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $extension;
                $image->move(public_path('uploads/post/'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Lưu các thay đổi vào bài viết
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $currentUserId;
        $post->image = json_encode(array_values($imageNames)); // Save image names as JSON

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công');
    }

    public function show($id) {
        $post = Post::with('comments.user')->findOrFail($id);
//        dd($post->comments);
//        return view('admin.post.show', compact('post'));
        return view('user.detail', compact('post'));

    }



    public function destroy($id)
    {
        $post = Post::findOrFail($id);

//        dd('destroy controller đây');

        $this->authorize('delete', $post);

        $images = json_decode($post->image, true);
        if (is_array($images)) {
            foreach ($images as $image) {
                $imagePath = public_path('uploads/post/' . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Xóa bài viết thành công');
    }
}
