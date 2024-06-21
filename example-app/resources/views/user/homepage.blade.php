<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test OMT</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Import CSS file -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_homepage.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@interactjs/interactjs@1.10.11/dist/interact.min.js"></script>

</head>

<body>
<div class="wrapper">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <header class="custom-header fixed-top mt-4" style="z-index: 1;">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="row">
                        <div class="col-6">
                            <i class="fa fa-bars" id="openPopup" style="margin-left: -500px; margin-top: 3px;"></i>
                            <div id="myPopupMobile" class="popup">
                                <div class="popup-content">
                                    <span class="close" id="closePopupMobile">&times;</span>
                                    <input class="form-control mr-sm-2 mt-5" type="search" placeholder="Search"
                                           aria-label="Search">

                                    <div>
                                        <div class="icon-text mt-2">
                                            <i class="fa mt-3 " id="loginIcon" style="font-family: Arial, sans-serif; ">
                                                <h5>
                                                    Đăng nhập, Tạo tài khoản
                                                </h5>
                                            </i>
                                        </div>
                                    </div>
                                    <hr class="thick-hr">
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <img src="https://s1.vnecdn.net/vnexpress/restruct/i/v897/v2_2019/pc/graphics/logo.svg"
                                 alt="" class="img-fluid" style="
                                    max-width: 341%;
                                    height: auto;
                                    margin-left: -488px;
                                ">
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-3">
                            Mới nhất
                        </div>
                        <div class="col-3">
                            International
                        </div>

                        <div class="col-6">
                            <div class="row navItems">
                                <div class="col-3">
                                    <i class="fa fa-search"></i>
                                </div>

                                <div class="col-2" id="loginIconIphone">
                                    <i class="fa fa-user"></i>
                                </div>

                                <div class="col-4" id="loginText">
                                    @auth
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <span onclick="document.getElementById('logout-form').submit();">{{ auth()->user()->name }}</span>
                                    @else
                                        <span onclick="openLoginPopup()">Đăng nhập</span>
                                    @endauth
                                </div>

                                <div id="loginPopup" class="popup">
                                    <div class="popup-content-login">
                                        <span class="close" onclick="closeLoginPopup()">&times;</span>
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="login-toggle" data-form="loginForm" onclick="showForm('loginForm')">Đăng nhập</h5>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="login-toggle" data-form="registerForm" onclick="showForm('registerForm')">Tạo tài khoản</h5>
                                            </div>
                                        </div>
                                        <hr class="thick-hr">
                                        <div id="loginForm" class="login-form mt-3">
                                            <form action="{{ route('login') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>Đăng nhập với email</p>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                                        <button type="button" class="btn btn-block" onclick="openForgetPasswordPopup()">Lấy lại mật khẩu</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="registerForm" class="login-form mt-3" style="display: none;">
                                            <form action="{{ route('register') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>Tạo tài khoản VnExpress</p>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                                                        </div>
                                                        <div>
                                                            <label for="usertype">User Type</label>
                                                            <select id="usertype" name="usertype" required>
                                                                <option value="1">User</option>
                                                                <option value="2">Admin</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block">Tạo tài khoản</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="forgetPasswordPopup" class="popup" style="display: none;">
                                    <div class="popup-content-login">
                                        <span class="close" onclick="closeForgetPasswordPopup()">&times;</span>
                                        <form id="forgetPasswordForm" method="POST" action="{{ route('customer.postForgetPass') }}">
                                            @csrf
                                            <legend>Lấy lại mật khẩu</legend>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" placeholder="Email">
                                                @error('email') <small class="help-block">{{$message}}</small> @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Gửi mail</button>
                                        </form>
                                    </div>
                                </div>

                                <script>
                                    function openLoginPopup() {
                                        document.getElementById('loginPopup').style.display = 'block';
                                        document.getElementById('forgetPasswordPopup').style.display = 'none';
                                    }

                                    function closeLoginPopup() {
                                        document.getElementById('loginPopup').style.display = 'none';
                                    }

                                    function showForm(formId) {
                                        document.getElementById('loginForm').style.display = 'none';
                                        document.getElementById('registerForm').style.display = 'none';
                                        document.getElementById(formId).style.display = 'block';
                                    }

                                    function openForgetPasswordPopup() {
                                        document.getElementById('forgetPasswordPopup').style.display = 'block';
                                        document.getElementById('loginPopup').style.display = 'none';
                                    }

                                    function closeForgetPasswordPopup() {
                                        document.getElementById('forgetPasswordPopup').style.display = 'none';
                                    }

                                    document.addEventListener('DOMContentLoaded', function () {
                                        var status = "{{ session('status') }}";
                                        if (status === 'registration_success') {
                                            openLoginPopup();
                                        }
                                    });

                                    window.onclick = function(event) {
                                        var loginPopup = document.getElementById('loginPopup');
                                        var forgetPasswordPopup = document.getElementById('forgetPasswordPopup');
                                        if (event.target == loginPopup) {
                                            loginPopup.style.display = "none";
                                        }
                                        if (event.target == forgetPasswordPopup) {
                                            forgetPasswordPopup.style.display = "none";
                                        }
                                    }
                                </script>
                                <div class="col-3">
                                    <i class="fa fa-bell"></i>
                                </div>
                            </div>
                        </div>

                        <script>
                            function openLoginPopup() {
                                document.getElementById('loginPopup').style.display = 'block';
                            }

                            function closeLoginPopup() {
                                document.getElementById('loginPopup').style.display = 'none';
                            }

                            function showForm(formId) {
                                document.getElementById('loginForm').style.display = 'none';
                                document.getElementById('registerForm').style.display = 'none';
                                document.getElementById(formId).style.display = 'block';
                            }
                        </script>

                    </div>
                </div>

                <script>
                    function openLoginPopup() {
                        var loginPopup = document.getElementById('loginPopup');
                        loginPopup.style.display = 'block';
                    }

                    function closeLoginPopup() {
                        var loginPopup = document.getElementById('loginPopup');
                        loginPopup.style.display = 'none';
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        // Event listener for switching between login and register forms
                        document.querySelectorAll('.login-toggle').forEach(function(element) {
                            element.addEventListener('click', function() {
                                var formId = this.getAttribute('data-form');
                                document.querySelectorAll('.login-form').forEach(function(form) {
                                    form.style.display = 'none';
                                });
                                document.getElementById(formId).style.display = 'block';
                            });
                        });

                        var status = "{{ session('status') }}";
                        if (status === 'registration_success') {
                            openLoginPopup();
                        }

                        // Close popup when clicking outside of it
                        window.onclick = function(event) {
                            var loginPopup = document.getElementById('loginPopup');
                            if (event.target === loginPopup) {
                                closeLoginPopup();
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </header>


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif



    <nav class="menu">
        <ul id="menuList">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Sản phẩm</a></li>
            <li><a href="#">Dịch vụ</a></li>
            <li><a href="#">Liên hệ</a></li>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Sản phẩm</a></li>
            <li><a href="#">Dịch vụ</a></li>
            <li><a href="#">Liên hệ</a></li>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Sản phẩm</a></li>
            <li><a href="#">Dịch vụ</a></li>
            <li><a href="#">Liên hệ</a></li>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Sản phẩm</a></li>
            <li><a href="#">Dịch vụ</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menu = document.querySelector('.menu');
            const header = document.querySelector('.header');
            const headerHeight = header.offsetHeight;

            window.addEventListener('scroll', function () {
                if (window.scrollY >= headerHeight) {
                    menu.classList.add('fixed');
                } else {
                    menu.classList.remove('fixed');
                }
            });
        });

    </script>

    <script>
        const menuList = document.getElementById('menuList');
        const menuContainer = document.querySelector('.menu');

        let currentX = 0;
        let startX = 0;
        let isDragging = false;

        function onMove(event) {
            if (!isDragging) return;

            const dx = event.clientX - startX;
            currentX = Math.min(0, Math.max(menuContainer.clientWidth - menuList.scrollWidth, currentX + dx));
            menuList.style.transform = `translateX(${currentX}px)`;
            startX = event.clientX;
        }

        function onEnd() {
            isDragging = false;
            menuList.classList.remove('grabbing');
            window.removeEventListener('mousemove', onMove);
            window.removeEventListener('mouseup', onEnd);
        }

        menuList.addEventListener('mousedown', (event) => {
            isDragging = true;
            startX = event.clientX;
            menuList.classList.add('grabbing');
            window.addEventListener('mousemove', onMove);
            window.addEventListener('mouseup', onEnd);
        });

        menuList.addEventListener('touchstart', (event) => {
            isDragging = true;
            startX = event.touches[0].clientX;
            menuList.classList.add('grabbing');
            window.addEventListener('touchmove', onTouchMove);
            window.addEventListener('touchend', onTouchEnd);
        });

        function onTouchMove(event) {
            if (!isDragging) return;

            const dx = event.touches[0].clientX - startX;
            currentX = Math.min(0, Math.max(menuContainer.clientWidth - menuList.scrollWidth, currentX + dx));
            menuList.style.transform = `translateX(${currentX}px)`;
            startX = event.touches[0].clientX;
        }

        function onTouchEnd() {
            isDragging = false;
            menuList.classList.remove('grabbing');
            window.removeEventListener('touchmove', onTouchMove);
            window.removeEventListener('touchend', onTouchEnd);
        }


    </script>


    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="customNavbar ">
        <div class="container-fluid">

            <div class="collapse navbar-collapse navbar-nav-scroll" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" aria-expanded="false">
                            Thời sự
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Chính trị</a></li>
                            <li><a class="dropdown-item">Dân sinh</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="  nav-link " id="navbarDropdown" aria-expanded="false">
                            Góc nhìn
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Bình luận nhiều</a></li>
                            <li><a class="dropdown-item">Chính trị và chính sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Thế giới
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Tư liệu</a></li>
                            <li><a class="dropdown-item">Phân tích</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Video
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Thời sự</a></li>
                            <li><a class="dropdown-item">Nhịp sống </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" aria-expanded="false">
                            Podcasts
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">VnExpress hôm nay</a></li>
                            <li><a class="dropdown-item">Tâm điểm kinh tế </a></li>
                            <li><a class="dropdown-item">Tài chính cá nhân</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Kinh doanh
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Quốc tế</a></li>
                            <li><a class="dropdown-item">Doanh nghiệp </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Bất động sản
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Chính sách</a></li>
                            <li><a class="dropdown-item">Thị trường</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Khoa học
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Khoa học trong nước</a></li>
                            <li><a class="dropdown-item">Doanh nghiệp </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" aria-expanded="false">
                            Giải trí
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Giới sao</a></li>
                            <li><a class="dropdown-item">Sách</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Thể thao
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Euro2024</a></li>
                            <li><a class="dropdown-item">Bóng đá</a></li>
                            <li><a class="dropdown-item">Lịch thi đấu</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Pháp luật
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Hồ sơ phá án</a></li>
                            <li><a class="dropdown-item">Tư vấn</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Giáo dục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Tin tức</a></li>
                            <li><a class="dropdown-item">Tuyển sinh</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Sức khỏe
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Tin tức</a></li>
                            <li><a class="dropdown-item">Tư vấn</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Đời sống
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Nhịp sống</a></li>
                            <li><a class="dropdown-item">Tổ ấm</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Du lịch
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Điểm đến</a></li>
                            <li><a class="dropdown-item">Ẩm thực</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Số hóa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Công nghệ</a></li>
                            <li><a class="dropdown-item">Sản phẩm</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " id="navbarDropdown" aria-expanded="false">
                            Xe
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item">Thị trường</a></li>
                            <li><a class="dropdown-item">Car Awards 2023</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var header = document.querySelector(".custom-header");
            var navbar = document.querySelector(".navbar");

            window.addEventListener("scroll", function () {
                var currentScrollPos = window.pageYOffset;

                if (currentScrollPos > 0) {
                    // Cuộn xuống
                    header.classList.add("hide-header");
                    navbar.classList.add("fixed-top");
                } else {
                    // Trở lại đầu trang
                    header.classList.remove("hide-header");
                    navbar.classList.remove("fixed-top");
                }
            });
        });

    </script>

    <div class="container">
        <div class="row mt-4">
            <!-- Cột trái (5 cột) -->
            <div class="col-md-12 col-lg-5 vertical-separator">
                @for ($i = 0; $i < count($posts); $i += 2)
                    <div class="mt-4">
                        <h6 class="hover-title">
                            <a href="{{ route('posts.show', ['id' => $posts[$i]->id]) }}">
                                {{ $posts[$i]->title }}
                            </a>
                        </h6>
                        <div class="row">
                            <div class="col-5">
                                @php
                                    $images = json_decode($posts[$i]->image, true);
                                @endphp
                                <a href="{{ route('posts.show', ['id' => $posts[$i]->id]) }}">
                                    @if(is_array($images) && count($images) > 0)
                                        <img src="{{ asset('uploads/post/' . $images[0]) }}" alt="Image" class="img-fluid">
                                    @else
                                        <img src="https://i1-vnexpress.vnecdn.net/2024/06/06/2024-06-05t185304z-167292766-r-3452-4652-1717630442.jpg?w=300&h=180&q=100&dpr=1&fit=crop&s=GJzr_XUlqPHRgqep9QP-3w"
                                             alt="Default Image" class="img-fluid">
                                    @endif
                                </a>
                            </div>
                            <div class="col-7">
                                <p>
                                    {{ Str::limit($posts[$i]->content, 200) }}
                                    <i class="fas fa-comment" style="color: rgb(120, 120, 113);"></i>
                                    {{ $posts[$i]->comments()->count() }} comments
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="thick-hr mt-1">
                @endfor
            </div>

            <!-- Cột phải (7 cột) -->
            <div class="col-md-12 col-lg-7">
                <div class="row">
                    @for ($i = 1; $i < count($posts); $i += 2)
                        <div class="col-6 mt-4">
                            @php
                                $images = json_decode($posts[$i]->image, true);
                            @endphp
                            <a href="{{ route('posts.show', ['id' => $posts[$i]->id]) }}">
                                @if(is_array($images) && count($images) > 0)
                                    <img src="{{ asset('uploads/post/' . $images[0]) }}" alt="Image" class="img-fluid">
                                @else
                                    <img src="https://i1-kinhdoanh.vnecdn.net/2024/06/06/sr-jpeg-1318-1717634582-171764-4297-7693-1717643193.jpg?w=380&h=228&q=100&dpr=1&fit=crop&s=KlXg65oqQqxFpXPkEE6bDg"
                                         alt="Default Image" class="img-fluid">
                                @endif
                            </a>
                        </div>
                        <div class="col-6 mt-4 vertical-separator">
                            <h6 class="hover-title">
                                <a href="{{ route('posts.show', ['id' => $posts[$i]->id]) }}">
                                    {{ $posts[$i]->title }}
                                </a>
                            </h6>
                            <p>
                                {{ Str::limit($posts[$i]->content, 200) }}
                            </p>
                        </div>
                        @if($i + 1 < count($posts))
                            <hr class="thick-hr mt-3">
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>



{{--    <footer class="foot mt-5" style="position: fixed;--}}
{{--            bottom: 0;--}}
{{--            width: 100%;--}}
{{--            background-color: #858585;--}}
{{--;--}}
{{--            color: #fff;--}}
{{--            text-align: center;--}}
{{--            padding: 10px 0;">--}}
{{--        <div class="container">--}}
{{--            <hr class="thick-hr-footer ">--}}

{{--            <div class="row">--}}
{{--                <div class="col-7">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-3">--}}
{{--                            <div style="text-align: left;">--}}
{{--                                <h6 class="small-footer">Trang chủ</h6>--}}
{{--                                <h6 class="small-footer">Video</h6>--}}
{{--                                <h6 class="small-footer">Podcasts</h6>--}}
{{--                                <h6 class="small-footer">Ảnh</h6>--}}
{{--                                <h6 class="small-footer">Infographics</h6>--}}
{{--                            </div>--}}
{{--                            <hr class="thick-hr mt-1">--}}
{{--                            <div style="text-align: left;">--}}
{{--                                <h6 class="small-footer">Mới nhất</h6>--}}
{{--                                <h6 class="small-footer">Xem nhiều</h6>--}}
{{--                                <h6 class="small-footer">Tin nóng</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div style="text-align: left;">--}}
{{--                                <h6 class="head-popup">Góc nhìn</h6>--}}
{{--                                <p class="small">Bình luận nhiều</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div style="text-align: left;">--}}
{{--                                <h6 class="head-popup">Thể thao</h6>--}}
{{--                                <p class="small">Pháp luật</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3">--}}
{{--                            <div style="text-align: left;">--}}
{{--                                <h6 class="head-popup">Khoa học</h6>--}}
{{--                                <p class="small">Số hóa</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-2">--}}
{{--                    <div style="text-align: left;">--}}
{{--                        <h6 class="head-popup">Rao vặt</h6>--}}
{{--                        <p class="small">Startup</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-3">--}}
{{--                    <div>--}}
{{--                        Tải ứng dụng--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-6">--}}
{{--                                VnExpress--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                International--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        Liên hệ <br>--}}
{{--                        Đường dây nóng--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr class="thick-hr mt-1">--}}
{{--        </div>--}}
{{--    </footer>--}}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</div>

</body>
</html>