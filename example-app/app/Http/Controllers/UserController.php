<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', // Validate each permission
            'usertype' => 'required|string|in:admin,user', // Validate the usertype
        ]);

        $usertype = $request->usertype === 'admin' ? 2 : 1;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $usertype,
        ]);

        $user->roles()->attach($request->role_id);

        // Attach multiple permissions
        $user->permissions()->attach($request->permissions);

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
