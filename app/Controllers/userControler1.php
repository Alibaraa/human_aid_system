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
        $usersModel = new usersModel();
        $data['user'] = $usersModel->findAll();
        return view('user/show', $data);
    }

    public function Group($id)
    {
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
    }

    public function change_status($id,$status){
        $usersModel = new usersModel();
        $usersModel->update($id,array(
            'active' =>$status
        ));
        return redirect()->to('User/show');
    }



}
