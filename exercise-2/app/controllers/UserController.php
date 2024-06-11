<?php 

Model('User');
Controller('Base');
Model('Post');

class UserController extends BaseController
{
    private $userModal;
    public function __construct(){
        $this->userModal = new UserModel();
    }
    public function index(){
        echo 'get_user';
        $data = $this->userModal->get_users();
        echo 'chạy vào controller r';
        return $this->load_view('users.home', ['data' => $data]);
    }
    public function create()
    {
        return $this->load_view('users.create');
    }

    public function postCreate($request)
    {
        $errors = [];
        if($request['name'] == ''){
            $errors['name'] = "Nhập tên";
        }
        if($request['phone'] == ''){
            $errors['phone'] = "Nhập SĐT";
        } else {
            $check_phone_user = UserModel::check_phone_user($request['phone']);
            if($check_phone_user > 0){
                $errors['phone'] = 'SĐT đã tồn tại';
            }
        }

        if ($request['birth'] == '') {
            $errors['birth'] = "Nhập ngày sinh";
        }

        if (count($errors) > 0) {
            return $this->load_view('users.create', ['errors' => $errors]);
        }

        $id = UserModel::save_user($request);
        return $this->redirect('/')->with(['success'=>'Tạo mới user thành công', 'id_new' => $id]);
    }

    public function edit($id)
    {
        $data = UserModel::find_user($id);
        if (count($data) == 0) {
            echo '404';
            return;
        }
        if(empty($id)){
            echo '404';
            return;
        }
        return $this->load_view("users.edit", ['data' => $data[0], 'id' => $id]);
    }

    public function postEdit($request, $id)
    {
        echo $id;
        $errors = [];
        if($request['name'] == ''){
            $errors['name'] = 'Nhập tên';
        }
        if ($request['phone'] == '') {
            $errors['phone'] = 'Nhập SĐT';
        } else {
            $check_phone_user = UserModel::check_phone_user2($request['phone'], $id);
            if($check_phone_user){
                $errors['phone'] = 'SĐT đã tồn tại';
            }
        }
        if ($request['birth'] == '') {
            $errors['birth'] = 'Nhập ngày sinh';
        }
        if (count($errors)>0) {
            $data = UserModel::find_user($id);
            return $this->load_view('users.edit', ['data' => $data[0], 'errors' => $errors]);
        }
        $request['updated_at'] = date('Y-m-d h:i:s');
        UserModel::update_user($request, $id);
        return $this->redirect('/')->with(['success' => 'Sửa user thành công', 'id_new' => $id]);
    }

    public function delete($id) {
        $row_check = PostModel::check_post($id);
        if ($row_check > 0) {
            return $this->redirect('')->with(['error' => 'Không thể xóa tác giả vì vẫn còn bài viết của tác giả']);
        }
        UserModel::delete_user($id);
        return $this->redirect('')->with(['success' => 'Xóa user thành công']);
    }


}