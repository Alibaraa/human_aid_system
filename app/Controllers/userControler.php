<?php

namespace App\Controllers;

use Config\Services;
use App\Models\BlockModel;
use App\Models\usersModel;
use App\Models\userBlockModel;

class userControler extends BaseController
{
    protected $session;
    protected $config;

    public function __construct()
    {
        $this->session = Services::session();
        $this->config = config('Auth');
    }

    public function index()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }
        $usersModel = new usersModel();
        $data['user'] = $usersModel->findAll();
        return view('user/show', $data);
    }

    public function Group($id)
    {
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel->select('*,(select count(*) from person where person.block_id = block.id) as count')->findAll();

        $usersModel = new usersModel();
        $data['user'] = $usersModel->where('id',$id)->first();
        $data['userBlock'] = array();
        $userBlockModel = new userBlockModel();
        $userBlock = $userBlockModel->where('user_id',$id)->findAll();
        foreach ($userBlock as $block){
            $data['userBlock'][] = $block['block_id'];
        }

        $data['user_data'] = $id;

        return view('user/group', $data);
    }


    public function insert_update_group_blocks()
    {
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }
        $user_data = $this->request->getPost('user_data');
        $group = $this->request->getPost('group');

        $userBlockModel = new userBlockModel();
        $userBlockModel->where('user_id',$user_data)->delete();
        if(!empty($group)) {
            foreach ($group as $item) {
                $user[] = array(
                    'user_id' => $user_data,
                    'block_id' => $item
                );
            }
            //print_r($user);exit();
            $userBlockModel->insertBatch($user);
        }
        return redirect()->to(base_url('User/Group/'.$user_data));
    }

    public function change_status($id,$status){
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }
        $usersModel = new usersModel();
        $usersModel->update($id,array(
            'active' =>$status
        ));
        return redirect()->to('User/show');
    }
    public function add()
    {
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }

        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        return view('user/add');
    }

    public function insert()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }

        $usersModel = new usersModel();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password_hash = $this->request->getPost('password_hash');
        $permissions = $this->request->getPost('permissions');
        $active = $this->request->getPost('active');

        if(empty($name) || empty($email) || empty($email) || empty($permissions) ){
            return redirect()->to('User/show');
        }
        $data = array(
            'name'=>$name,
            'email'=>$email,
            'password_hash'=>password_hash($password_hash, PASSWORD_DEFAULT),
            'permissions'=>$permissions,
            'active'=>$active
        );

        $usersModel->save($data);
        return redirect()->to('User/show');
    }

    public function editUser($id)
    {

        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }
        $usersModel = new usersModel();
        $data['id'] = $id;
        $data['editData'] = $usersModel->where('id',$id)->first();
        return view('user/update',$data);
    }

    public function update($ids)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if($_SESSION['userData']['permissions'] != 1){
            return redirect()->to(base_url('login'));
        }
        $usersModel = new usersModel();
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password_hash = $this->request->getPost('password_hash');
        $permissions = $this->request->getPost('permissions');
        $active = $this->request->getPost('active');
        $data = array(
            'name'=>$name,
            'email'=>$email,
            'permissions'=>$permissions,
            'active'=>$active
        );
        if(!empty($password_hash) && strlen($password_hash) > 6){
            $data['password_hash']=password_hash($password_hash, PASSWORD_DEFAULT);
        }


        $usersModel->update($ids,$data);
        return redirect()->to('User/show');
    }

}
