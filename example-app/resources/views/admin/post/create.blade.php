@extends('admin.layout.layout_main')

@section('content')
    <div class="container mt-5">
        <h2>Tạo bài viết mới</h2>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea name="content" class="form-control" id="content" rows="5">{{ old('content') }}</textarea>
                @error('content')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh đính kèm</label>
                <input type="file" name="image[]" class="form-control-file" id="image" multiple onchange="previewImages(event)">
                <div id="image-previews" style="margin-top: 10px;"></div>
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Tạo bài viết</button>
        </form>
    </div>

    <script>
        function previewImages(event) {
            var input = event.target;
            var previews = document.getElementById('image-previews');
            previews.innerHTML = ''; // Clear any previous previews

            for (var i = 0; i < input.files.length; i++) {
                var file = input.files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.margin = '5px';
                    previews.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
