@extends('admin.layout.layout_main')

@section('content')
    <div class="container">
        <h2>Tạo tài khoản người dùng</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="usertype">Loại tài khoản</label>
                <select name="usertype" id="usertype" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div class="form-group">
                <label for="role_id">Vai trò</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="permissions">Quyền hạn</label>
                <select name="permissions[]" id="permissions" class="form-control" multiple required>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
        </form>
    </div>
@endsection
