<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.index');
    }
    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        // Validate the request data
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $image->move(public_path('uploads/post/'), $imageName);
        }

        // Create a new post with user_id
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        dd(Auth::id());
        if ($imageName) {
            $post->image = $imageName; // Save image name to database
        }
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Tạo mới bài viết thành công');
    }
}
