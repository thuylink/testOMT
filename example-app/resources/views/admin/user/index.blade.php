{{--@extends('layouts.app')--}}
@extends('admin.layout.layout_main')

@section('content')
    <div class="container mt-5">
        <h2>Danh sách tài khoản người dùng</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Loại tài khoản</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype == 2 ? 'Admin' : 'User' }}</td>
                    <td>
                        {{--                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Chỉnh sửa</a>--}}
                        {{--                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">--}}
                        {{--                            @csrf--}}
                        {{--                            @method('DELETE')--}}
                        {{--                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">Xóa</button>--}}
                        {{--                        </form>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
