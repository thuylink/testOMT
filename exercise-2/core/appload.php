<?php
//appload.php khởi tạo và cấu hình

/*
 * kiểm tra hằng số PATHDEFAULT được định nghĩa chưa;
 * nếu PATHDEFAULT chưa định nghĩa -> script dừng vào báo không có quyền truy cập
 * -> mục đích: bảo vệ tệp appload.php k bị truy cp trực tiếp mà không qua tệp chính
 */
defined('PATHDEFAULT') OR exit('Không có quyền truy cập');

/*
 * tải vào tệp core/base.php
 */
require PATHDEFAULT. DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'base.php';

// ====== load files =======


/*
 * gọi hàm load_folder() để tải tất cả các files trong folder config
 * hàm load_folder() viết trong core/base.php
 */
load_folder(PATHDEFAULT.DIRECTORY_SEPARATOR .'config');

/*
 * kiểm tra nếu biến $autoload là 1 mảng
 * -> duyệt từng phần tử của autoload, mỗi ptu chứa 1 danh sách các tệp cần tự động tải
 * sử dụng hàm load_storage() để nạp các tệp này
 */
if (is_array($autoload)) {
    foreach ($autoload as $type => $list_auto) {
        if (!empty($list_auto)) {
            foreach ($list_auto as $name) {
                load_storage($type, $name);
            }
        }
    }
}

//kết nối csdl
DB::connection(HOST, USER, PASSWORD, NAME);

//router -> xử lí các yêu cầu URL
require PATHDEFAULT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'router.php';