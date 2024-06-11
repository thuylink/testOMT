<?php

//kế thừa từ lớp DB, sd được các phương thức trong DB
class UserModel extends DB {

    //lấy tất cả người dùng từ bảng users, xếp theo id giảm dần, trả về mảng chứa tất cả các bản ghi người dùng
    public static function get_users()
    {
        echo 'vào get_user';
        return DB::fetch_array("SELECT * FROM `users` ORDER BY id DESC");
    }

    //trả về mảng chứa thông tin người dùng hoặc mảng rỗng nếu không tìm thấy
    public static function find_user($id)
    {
        return DB::fetch_array("SELECT * FROM users WHERE id = $id");
    }

    //tham số $data là mảng chứa các cặp khóa, giá trị tương ứng với các cột trong bảng users
    //trả về id của bản ghi mới được chèn vào
    public static function save_user($data)
    {
        return self::insert('users', $data);
    }

    /*
     * tham số $data: mảng chứa các cặp khóa-gtri tương ứng với các cột cần cập nhật
     * trả về số dòng bị ảnh hưởng bởi truy vấn cập nhật
     */
    public static function update_user($data, $id) {
        return self::update('users', $data, "id = $id");
    }

    /*
     * trả về số dòng bị ảnh hưởng bởi truy vấn xóa
     */
    public static function delete_user($id) {
        return self::delete('users', "id = $id");
    }

    /*
     * mục đích: ktar xem sđt tồn tại trong bảng users chưa
     * trả về số lượng bản ghi có số đt đó
     */
    public static function check_phone_user ($phone) {
        $sql = "SELECT id FROM users WHERE phone = '$phone'";
        return self::db_num_rows($sql);
    }

    public static function check_phone_user2($phone, $id) {
        $sql = "SELECT id FROM users WHERE id = '$id' AND phone = '$phone'";
        $row = self::db_num_rows($sql);
        if($row == 0) {
            $row2 = self::check_phone_user($phone);
            if($row2 > 0) {
                return true;
            }
        }
        return false;
    }

}