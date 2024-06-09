<?php
require_once 'models/User.php';

class UserController {
    public function showCreateForm() {
        require_once 'views/user_create.php';
    }

    public function createUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $user = new User();
            $result = $user->createUser($name);
            if ($result) {
                header("Location: /success");
                exit();
            } else {
                echo "Có lỗi xảy ra khi tạo người dùng.";
            }
        }
    }

    public function showSuccessMessage() {
        require_once 'views/success.php';
    }
}
