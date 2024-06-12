<?php

defined('PATHDEFAULT') OR exit('Không có quyền truy cập');


require PATHDEFAULT. DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'base.php';

// ====== load files =======



load_folder(PATHDEFAULT.DIRECTORY_SEPARATOR .'config');


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