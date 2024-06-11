<?php

class BaseController
{
    /*
     * mục đích: tải và hiển thị 1 view dựa trên tên được cung cấp
     * tham số: tên cú view cần tải, $data: mảng dl (mặc định rỗng) có thể được sử dụng trong view
     * hoạt động: tách tên view dựa trên dấu .
     * xây dựng đường dẫn tới file view
     * ktra xem file view tồn tại không, nếu có -> require
     */
    public function load_view($name, $data = [])
    {
        $arr_name = explode('.', $name);
        $path_view = $name;
        if(count($arr_name) > 1) {
            $path_view = implode(DIRECTORY_SEPARATOR, $arr_name);
        }
        $path = PATHDEFAULT . DIRECTORY_SEPARATOR .'public' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $path_view.'View.php';
        if (file_exists($path)) {
            require "$path";
        }
        return $this;
    }

    /*
     * mục đích: lưu các gtri vào session để dùng ở các yêu cầu tiếp theo
     * tham số: $array là 1 mảng các cặp khóa-giá trị cần lưu vào session
     *
     */
    public function with($array)
    {
        foreach ($array as $key => $value) {
            $_SESSION[$key] = $value;
        }
        return $this;
    }

    /*
     * chuyển hướng người dùng đến 1 url mới với $name là url mà ng dùng sẽ chuyển hướng đến
     */
    public function redirect($name)
    {
        header('Location: ' . PATH.$name);
        return $this;
    }
}