<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|string|in:admin,user',
        ]);

        $usertype = $request->usertype === 'admin' ? 2 : 1;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $usertype,
        ]);

        // Gán quyền cho tài khoản mới
        if ($usertype == 2) {
            $role = Role::where('name', 'admin')->first();
        } else {
            $role = Role::where('name', 'user')->first();
        }

        if ($role) {
            $user->roles()->attach($role);
        }

        return redirect()->route('users.index')->with('success', 'Tạo tài khoản người dùng thành công');
    }

    public function show($id) {
        $post = Post::findOrFail($id);
        return view('user.detail', compact('post'));
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
}
