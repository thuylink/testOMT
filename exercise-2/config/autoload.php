<?php

//kiểm tra hằng số PATHDEFAULT được định nghĩa chưa
//chưa thi dừng thực thi và thông báo lỗi
defined('PATHDEFAULT') OR exit('Không có quyền truy cập');

global $autoload;

//định nghĩa các thư viện cần tự động tải
$autoload['libraries'] = [
    'route', //thư viện quản lý định tuyến
    'database', //thư viện quản lý cơ sở dữ liệu
    'mail', //thư viện xử lý gửi gmail
    'jwt' //thư viện xử lý json web token cho việc xác thực và bảo mật
];

//định nghĩa các helper cần tự động tải
$autoload['helper'] = [
    'data', //helper liên quan đến xử lý dữ liệu, nằm tai helper/data.php
    'format', //định dạng
    'prem' //helper khác
];