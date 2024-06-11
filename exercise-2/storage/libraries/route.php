<?php
class Route {

    /*
     * mục đích: đăng ký route cho các yêu cầu get
     * tham số: $url: URL của route, $func: 1 mảng gồm tên lớp và tên phương thức để cử lý yêu cầu
     * hoạt động: dùng reponParameter để trích xuất các tham số từ URL
     * Ktra xem phương thức HTTP c phải là get và url yêu cầu có khớp với url đã đki không
     * khớp -> khởi tạo đối tượng của lớp $func[0], gọi phương thức $func[1]
     * die() để dừng sau khi xử lí yêu cầu
     */
    public static function get($url, $func)
    {
        $data = self::reponParameter($url, $_SERVER['REQUEST_URI']);
        $SERVER_REQUEST_URI_CONFIG_ARR =  explode('/', $_SERVER['REQUEST_URI']);
        unset($SERVER_REQUEST_URI_CONFIG_ARR[0]);
        unset($SERVER_REQUEST_URI_CONFIG_ARR[1]);
        unset($SERVER_REQUEST_URI_CONFIG_ARR[2]);
        $SERVER_REQUEST_URI_CONFIG_STR = implode('/', $SERVER_REQUEST_URI_CONFIG_ARR);
        if(empty($SERVER_REQUEST_URI_CONFIG_STR)){
            $SERVER_REQUEST_URI_CONFIG_STR = '/';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $SERVER_REQUEST_URI_CONFIG_STR == $data['url_check']) {
            $class = new $func[0];
            $func = $func[1];
            $class->$func(...$data['params']);
            die();
        }
    }
//    public static function get($url, $func)
//    {
//        $routeInstance = new self();
//        $data = $routeInstance->reponParameter($url, $_SERVER['REQUEST_URI']);
//
////        if ($_SERVER['REQUEST_METHOD'] == 'GET' &&  $_SERVER['REQUEST_URI'] == $data['url_check']) {
//        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//            $class = new $func[0];
//            $func = $func[1];
//            $class->$func(...$data['params']);
//            echo 123;
//            die();
//        }
//    }

    /*
     * mục đích và tham số tương tự get
     * hoạt động: tương tự get nhưng thêm tham số
     * $request = $_POST để truyền dữ liệu POST tới phương thức xử lý
     */
    public static function post($url, $func)
    {
        $data = route::reponParameter($url, $_SERVER['REQUEST_URI']);
        $SERVER_REQUEST_URI_CONFIG_ARR =  explode('/', $_SERVER['REQUEST_URI']);
        unset($SERVER_REQUEST_URI_CONFIG_ARR[0]);
        unset($SERVER_REQUEST_URI_CONFIG_ARR[1]);
        unset($SERVER_REQUEST_URI_CONFIG_ARR[2]);
        $SERVER_REQUEST_URI_CONFIG_STR = implode('/', $SERVER_REQUEST_URI_CONFIG_ARR);
        if(empty($SERVER_REQUEST_URI_CONFIG_STR)){
            $SERVER_REQUEST_URI_CONFIG_STR = '/';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $SERVER_REQUEST_URI_CONFIG_STR == $data['url_check']) {
            $class = new $func[0];
            $func = $func[1];
            $class->$func($request = $_POST,...$data['params']);
            die();
        }
    }

    /*
     * mục đích: xử lý url và trích xuất các tham số từ url
     * tham số: $url: url mẫu đã đăng ký cho tuyến đường
     * $url_server: URL thực tế từ yêu cầu của người dùng
     */
    public static function reponParameter($url, $url_server) {
        $arr_url_params = explode('/{', $url);  //URL mẫu
        $arr_url_server = explode('/', $url_server); //URL thực tế
        $data = [
            'params' => [],
            'url_check' => ''
        ];
        if($url!='/'){
            $data['url_check'] = trim($url,'/');
        }else{
            $data['url_check'] = $url;
        }

        if (count($arr_url_params) > 1) {
            $data['url_check'] = $arr_url_params[0];
            unset($arr_url_params[0]);
            $arr_url_server = array_reverse($arr_url_server);
            if (count($arr_url_server) < count($arr_url_params)) {
                die('LỖI');
            }
            foreach ($arr_url_params as $key => $value) {
                $data['params'][] = $arr_url_server[$key - 1];
            }
            $data['params'] = array_reverse($data['params']);
            $data['url_check'] = $data['url_check'].'/'.implode('/', $data['params']);
        }
        return $data;
    }

    /*
     * tách URL mẫu thành các thành phần dựa trên /{
     * tách URL thực tế thành các thành phần dựa trên /
     * tạo mảng $data để lưu các tham số và URL đã kiểm tra
     * nếu URL mẫu có chứa tham số -> tách các tham số từ URL thực tế
     *      đảo ngược mảng các phần của URL thực tế để dễ trích xuất các tham số từ cuối URL
     * ktra xem số lượng phần của URL thực tế có ít hơn số lượng tham số không
     * nếu có -> kết thúc & báo lỗi
     * xây dựng lại URL đã kiểm tra (url_check) bằng cách ghép các phần không là tham số và các tham số đã trích xuất
     * trả về mảng $data chứa URL đã kiểm tra và các tham số
     */
    
}
