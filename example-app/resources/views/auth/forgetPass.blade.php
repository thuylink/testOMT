<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-4">
            <form action="" method="POST" role="form">
                @csrf
                <legend>Lấy lại mật khẩu</legend>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email">
                    @error('email') <small class="help-block">{{$message}}</small> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Gửi mail</button>

            </form>
        </div>
    </div>
</div>

