<!DOCTYPE html>
<html>
<head>
    <title>Mật khẩu mới</title>
</head>
<body>
<h1>Xin chào, {{ $user->name }}</h1>
<p>Bạn đã yêu cầu đặt lại mật khẩu. Dưới đây là mật khẩu mới của bạn:</p>
<h2>{{ $newPassword }}</h2>
<p>Bạn có thể sử dụng mật khẩu này để đăng nhập vào hệ thống.</p>
<p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
</body>
</html>
