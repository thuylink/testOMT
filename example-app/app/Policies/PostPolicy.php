<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;


class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->usertype, [2, 1]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return in_array($user->usertype, [1, 2]);
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(User $user): bool
    {
//        dd('account này có quyền thêm');
        foreach ($user->roles as $role) {
            // Duyệt qua các quyền (permissions) của từng vai trò
            foreach ($role->permissions as $permission) {
                Log::info('User permission information', ['permission' => $permission->name]);
                if ($permission->name == 'tạo bài viết') {
                    return true;
                }
            }
        }

        return false;
    }


    /**
     * Determine whether the user can update the model.
     */

    public function update(User $user, Post $post): bool
    {
        // Duyệt qua các vai trò (roles) của người dùng
        foreach ($user->roles as $role) {
            // Duyệt qua các quyền (permissions) của từng vai trò
            foreach ($role->permissions as $permission) {
                Log::info('User permission information', ['permission' => $permission->name]);
                if ($permission->name == 'sửa bài viết') {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
//        dd('destroy đây');
        Log::info('Checking delete authorization', [
            'user_id' => $user->id,
            'post_user_id' => $post->user_id
        ]);

        return $user->id === $post->user_id;
    }




    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
