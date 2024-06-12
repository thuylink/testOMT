<?php
class Route {


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


    
}
