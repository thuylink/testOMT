<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $validatedData = $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'cmt' => 'required|string',
        ]);

        $existingComment = Comment::where('post_id', $postId)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existingComment) {
            return redirect()->route('posts.show', $postId)->with('error', 'Không thể bình luận nhiều lần');
        }

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = auth()->id();
        $comment->star = $validatedData['star'];
        $comment->cmt = $validatedData['cmt'];
        $comment->save();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment added successfully!');
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'cmt' => 'required|string',
        ]);
        $comment = Comment::findOrFail($id);
        
        //kiểm tra đây phải là cmt của người dùng
        if($comment->user_id !== Auth::id()) {
            return redirect()->route('', $comment->post_id)->with('error', 'Không có quyền chỉnh sửa bình luận này');
        }

        $comment->star = $validatedData['star'];
        $comment->cmt = $validatedData['cmt'];
        $comment->save();
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Bình luận đã được cập nhật thành công');
    }

    public function destroy($id) {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $comment->post_id)->with('error', 'Bạn không có quyền xóa bình luận này');
        }

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Bình luận đã được xóa thành công');
    }

}
