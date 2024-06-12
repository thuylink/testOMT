<?php

//kế thừa từ lớp DB, sd được các phương thức trong DB
class UserModel extends DB {


    public static function get_users()
    {
        echo 'vào get_user';
        return DB::fetch_array("SELECT * FROM `users` ORDER BY id DESC");
    }

    public static function find_user($id)
    {
        return DB::fetch_array("SELECT * FROM users WHERE id = $id");
    }

    public static function detail_user($id)
    {
        return DB::fetch_array("SELECT * FROM users WHERE id = $id");
    }


public static function save_user($data)
    {
        return self::insert('users', $data);
    }


    public static function update_user($data, $id) {
        return self::update('users', $data, "id = $id");
    }


    public static function delete_user($id) {
        return self::delete('users', "id = $id");
    }


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