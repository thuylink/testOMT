@extends('admin.layout.layout_main')

@section('content')
    <div class="container mt-5">
        <h2>Chỉnh sửa bài viết</h2>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}">
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea name="content" class="form-control" id="content" rows="5">{{ $post->content }}</textarea>
                @error('content')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh đính kèm</label>
                <input type="file" name="image[]" class="form-control-file" id="image" multiple onchange="previewImages(event)">
                <div id="image-previews" style="margin-top: 10px;">
                    @php
                        $images = json_decode($post->image, true);
                    @endphp
                    @if(is_array($images) && count($images) > 0)
                        @foreach($images as $image)
                            <div style="display: inline-block; position: relative; margin: 5px;">
                                <img src="{{ asset('uploads/post/' . $image) }}" alt="Image" style="max-width: 100px;">
                                <div>
                                    <label>
                                        <input type="checkbox" name="delete_images[]" value="{{ $image }}"> Xóa
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
        </form>

        <script>
            function previewImages(event) {
                var input = event.target;
                var previews = document.getElementById('image-previews');

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
    </div>
@endsection
