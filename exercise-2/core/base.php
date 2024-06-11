<?php
/*
 * tải tất cả các tệp trong 1 thư mục
 * tham số $path là đường dẫn đến thư mục cần tải
 * ktra xem đường dẫn có tồn tại không
 * dùng scandir() để lấy danh sách các tệp và thư mục trong đường dẫn
 * loại bỏ các mục . và .. ra khỏi danh sách
 * nếu còn tệp khác, duyệt qua từng tệp và dùng require để nạp tệp
 */
function load_folder($path)
{
    if(file_exists($path) && is_dir($path)) {
        $result = scandir($path);
        $files = array_diff($result, array('.', '..'));
        if(count($files) > 0) {
           foreach ($files as $file) {
               require $path .DIRECTORY_SEPARATOR .$file;
           }
        }
    }
}

/*
 * mục đích tải 1 tệp từ thư mục storage
 * tham số $type: loại thư mục con trong storage, $name:  tên tệp cần tải
 * hoạt động: xây dựng đường dẫn, nếu tồn tại -> dùng require để nạp tệp
 */
function load_storage($type, $name) {
    $path = PATHDEFAULT . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . "{$name}.php";
    if (file_exists($path))
        require "$path";
}

/*
 * mục đích: tải tệp model
 * tham số $name là tên model cần tải tên model phải có hậu tố Model
 * hoạt động: xây dựng đường dẫn đến tệp -> dùng require để nạp tệp nếu tồn tại
 */
function Model($name)
{
    $path = PATHDEFAULT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . "{$name}Model.php";
    if (file_exists($path))
        require "$path";
}

/*
 * giống model
 */
function Controller($name) {
    $path = PATHDEFAULT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . "{$name}Controller.php";
    if (file_exists($path))
        require "$path";
}

/*
 * mục đích: tải và hiển thị 1 tệp view
 * tham số: $name: tên view cần tải, tên này có thể dùng dấu . ể phân tách các phần của đường dẫn
 * tham số $data: mảng dữ liệu để truyền vào, mặc định là mảng rỗng
 * hoạt động: chia tên view thành các thành pần bằng cách dùng dấu .
 * nếu tên view chứa hơn 1 phần, ghép các phần lại với nhau bằng dấu / tạo thành đường dẫn
 * xây dựng đường dẫn đến tệp view -> require nếu tồn tại
 */
function __Include($name, $data = []) {
    $arr_name = explode('.', $name);
    $path_view = $name;
    if(count($arr_name) > 1) {
        $path_view = implode(DIRECTORY_SEPARATOR, $arr_name);
    }
    $path = PATHDEFAULT . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $path_view.'View.php';
    if (file_exists($path)) {
        require "$path";
    }
}

/*
 * mục đích: trả về đường dẫn 1 tài nguyên (asset) trong thư mục public/asset
 * tham số $name: tên tài nguyên
 * hoạt động: đặt source là được dẫn cơ sở public/asset/
 * kết hợp với tên tài nguyên để tạo đường dẫn đầy đủ -> trả về đường dẫn đầy đủ đến tài nguyên đó
 */
function asset($name) {
//    $source = '/public/asset/';
    $source = 'http://localhost/testOMT/exercise-2/public/asset/';
    $path = $source . $name;
    return "$path";
}

function assetHandle($name) {
//    $source = '/public/asset/';
    $source = 'http://localhost/testOMT/exercise-2/';
    $path = $source . $name;
    return "$path";
}

/*
 * mục đích: lấy giá trị từ biến session và xóa biến session đó
 * tham số $name: tên biến session
 * hoạt động: mặc định là false, kiểm tra xem biến session với tên $name có tồn tại không
 * nếu tồn tại -> gán biến của session vào $message và xóa biến session
 * trả về giá trị của $message
 */
function session($name) {
    $message = false;
    if(isset($_SESSION[$name])) {
        $message = $_SESSION[$name];
        unset($_SESSION[$name]);
    }
    return $message;
}

/*
 * mục đích: lấy gi trị cũ từ biến $_POST hoặc từ dữ liệu được cung cấp
 * tham số: $post: tên của biến POST, măặc định là null
 * $data: dữ liệu mặc định, mặc định là null
 * hoạt động: gán $data nào result,
 * nếu $data là null -> ktra xem biến $_POST vơới tên $post có tồn tại không
 * tồn tại và k rỗng -> gn gi trị biến $_POST vào result
 */
function old($post = null, $data = null) {
    $result = $data;
    if($data == null) {
        $result = !empty($_POST[$post]) ? $_POST[$post] : null;
    }
    return $result;
}


