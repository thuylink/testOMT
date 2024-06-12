<?php 

//Model('User');
//Controller('Base');
//Model('Post');
//require_once "PA";

class PostController extends BaseController
{
    private $postModal;
    public function __construct(){
        $this->postModal = new PostModel();
    }
    public function index(){
//        echo 'get_user';
        $data = $this->postModal->get_list_posts();
//        echo 'chạy vào controller r';
        return $this->load_view('post.home', ['data' => $data]);
    }
    public function create()
    {

        $dataUser = UserModel::get_users();
        return $this->load_view('post.create', ['dataUser' => $dataUser]);
    }

    public function postCreate($request)
    {
        $errors = [];
        if($request['title'] == ''){
            $errors['title'] = "Nhập tiêu đề";
        }
        if($request['user_id'] == ''){
            $errors['user_id'] = "Chọn tác giả";
        }

        if (!empty($request['title']) && $request['user_id'] != 0) {
            $check_user_post = PostModel::check_user_post($request['title'], $request['user_id']);
            if($check_user_post > 0){
                $errors['title'] = "Tiêu đề này đã tồn tại";
            }
        }

        if (count($errors) > 0) {
            return $this->load_view('post.create', ['errors' => $errors]);
        }

        $id = PostModel::save_post($request);
        return $this->redirect('')->with(['success'=>'Tạo mới post thành công', 'id_new' => $id]);
    }

    public function edit($id)
    {
        $data = PostModel::find_post($id);
        $dataUser = UserModel::get_users();
        return $this->load_view("post.edit", ['data' => $data[0], 'dataUser' => $dataUser]);
    }

    public function postEdit($request, $id)
    {
//        echo $id;
        $errors = [];
        if($request['title'] == ''){
            $errors['title'] = 'Nhập tiêu đề';
        }
        if ($request['user_id'] == '') {
            $errors['user_id'] = 'Chọn tác giả';
        }

        if (empty($request['content'])) {
            $errors['content'] = 'Nhập nội dung';
        }
        if (!empty($request['title']) && $request['user_id'] != 0) {
            $check_user_post = PostModel::check_user_post2($request['title'], $request['user_id'], $id);
            if($check_user_post){
                $errors['title'] = 'Tiêu đề này đã tồn tại';
            }
        }

        if (count($errors) > 0) {
            $dataUser = UserModel::get_users();
            return $this->load_view("post.create", ['$errors' => $errors, 'dataUser' => $dataUser]);
        }

        PostModel::update_post($request, $id);
        return $this->redirect('')->with(['success' => 'Sửa post thành công', 'id_new' => $id]);
    }

    public function delete($id) {
        PostModel::delete_user($id);
        return $this->redirect('')->with(['success' => 'Xóa user thành công']);
    }
}