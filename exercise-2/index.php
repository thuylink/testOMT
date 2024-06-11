<?php

//start session
session_start();

/*
 * đường dẫn
 * hằng số PATHDEFAULT với giá trị là đường dẫn tới thư mục tệp hiện tại
 * dirname(__FILE__) trả về đường dẫn thư mục chứa tệp đang đuược thực thi
 */
define('PATHDEFAULT', dirname(__FILE__));
define('PATH', 'http://localhost/testOMT/exercise-2/');
/*
 * appload file
 * include tệp core/appload.php
 */
require PATHDEFAULT . DIRECTORY_SEPARATOR .'core' . DIRECTORY_SEPARATOR .'appload.php';




/*
 * session lưu thông tin để sd trong suốt tgian truy cập website
 *
 */