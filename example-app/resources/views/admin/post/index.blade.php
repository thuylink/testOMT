@extends('admin.layout.layout_main')

@section('content')
    <div class="container mt-5">
        <h2>Danh sách bài viết</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Người đăng</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->content, 50) }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        @php
                            $images = json_decode($post->image, true); // Giải mã JSON thành mảng
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                            @foreach($images as $image)
                                <img src="{{ asset('uploads/post/' . $image) }}" alt="Image" style="max-width: 100px; margin: 5px;">
                            @endforeach
                        @else
                            <img src="{{ asset('uploads/post/' . $post->image) }}" alt="Image" style="max-width: 100px;">
                        @endif
                    </td>
                    <td>
                        @can('view', $post)
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">Xem chi tiết</a> <br>
                        @endcan
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
