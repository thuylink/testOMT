@extends('admin.layout.layout_main')

@section('content')
    <div class="container mt-5">
        <h2>Tạo tài khoản mới</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="usertype">Loại tài khoản:</label>
                <select name="usertype" id="usertype" class="form-control" required>
                    <option value="1">User</option>
                    <option value="2">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
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
