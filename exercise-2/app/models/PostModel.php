<?php

class PostModel extends DB
{
    /*
     * lấy danh sách các bài viết cùng thông tin người dùng
     * kết quả trả về mảng chứa các bản ghi từ kết quả truy vấn
     */
    public function get_list_posts()
    {
        $sql = "SELECT p.id, user_id, u.name, u.phone, title, content, p.created_at, p.updated_at
        FROM posts as p INNER JOIN users as u ON p.user_id = u.id ORDER BY p.id DESC";
        return self::fetch_array($sql);
    }

    public function save_post($data)
    {
        return self::insert('posts', $data);
    }

    /*
     * mục đích: kiểm tra xem người dùng đã tạo bài viết với tiêu đề cụ thể chưa
     * trả về số lượng bản ghi tìm thấy
     */
    public static function check_user_post($title, $user)
    {
        $sql = "SELECT id FROM posts WHERE title = '$title' AND user_id = '$user'";
        return self::db_num_rows($sql);
    }

    public function find_post($id) {
        return DB::fetch_array("SELECT * FROM `post` WHERE id = $id");
    }

    /*
     * mục đích: kiểm tra người dùng có sở hữu bài viết với tiêu đề cụ thể không, ngoại trừ bài viết hiện tại
     */
    public function check_user_post2($title, $user, $id)
    {
        $sql = "SELECT id FROM posts WHERE id = $id AND title = '$title' AND user_id = '$user'";
        $check = self::db_num_rows($sql);
        if ($check == 0) {
            $check2 = self::check_user_post($title, $user);
            if ($check2 > 0) {
                return true;
            }
        }
        return false;
    }

    public function update_post($data, $id) {
        return self::update('posts', $data, "id = $id");
    }

    public function delete_post($id) {
        return self::delete('posts', "id = $id");
    }
    /*
     * ktra xem người dùng có bài viết nào không, trả về số bài viết
     */

    public static function check_post($user_id) {
        $sql = "SELECT id FROM posts WHERE user_id = '$user_id'";
        return self::db_num_rows($sql);
    }

}