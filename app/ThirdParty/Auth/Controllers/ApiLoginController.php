<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Auth\Models\UserModel;
use Auth\Models\userBlockModel;

class ApiLoginController extends ResourceController
{
    use ResponseTrait;

    // all users
    public function Login()
    {

        // validate request
        $rules = [
            'email'		=> 'required|valid_email',
            'password' 	=> 'required|min_length[5]',
        ];

        if (! $this->validate($rules)) {
            $response = [
                'status' => false,
                'message' => $this->validator->getErrors(),
                'data' => array(),
            ];
            return $this->respond($response, 201);
        }

        // check credentials
        $users = new UserModel();
        $user = $users->where('email', $this->request->getPost('email'))->first();
        if (
            is_null($user) ||
            ! password_verify($this->request->getPost('password'), $user['password_hash'])
        ) {
            $response = [
                'status' => false,
                'message' => lang('Auth.wrongCredentials'),
                'data' => array(),
            ];
            return $this->respond($response, 201);
        }

        // check activation
        if (!$user['active']) {
            $response = [
                'status' => false,
                'message' => lang('Auth.notActivated'),
                'data' => array(),
            ];
            return $this->respond($response, 201);
        }

        $user_block = new userBlockModel();
        $block = $user_block->where('user_id',$user['id'])->findAll();
        $block_data = array();
        foreach ($block as $item) {
            $block_data[] = array('id'=>$item['block_id'],'title'=>$item['title']);
        }
        $hash_code = random_string('alnum', 32);
        $users->update($user['id'],array('api_hash'=>$hash_code));
        $response = [
            'status' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'data' => array(
                'id' 			=> $user['id'],
                'hash' 			=> $hash_code,
                'name' 			=> $user['name'],
                'email' 		=> $user['email'],
                'block' 	    => $block_data
            )
        ];
        return $this->respond($response, 200);

    }
    public function logout()
    {
        $users = new UserModel();
        $hash = $this->request->getHeader('hash');
        $user = $users->where('api_hash', $hash)->first();
        if($user){
            $users->update($user['id'],array('api_hash'=>null));
            $response = [
                'status' => true,
                'message' => 'تم تسجيل الخروج بنجاح',
                'data' => array()
            ];
            return $this->respond($response, 200);
        }
        $response = [
            'status' => false,
            'message' => 'هذا المستخدم غير مسجل بالنظام',
            'data' => array()
        ];
        return $this->respond($response, 201);

    }
    // create
    public function create()
    {

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Employee created successfully'
            ]
        ];
        return $this->respondCreated($response);
    }

    // single user
    public function show($id = null)
    {
//        $model = new EmployeeModel();
//        $data = $model->where('id', $id)->first();
//        if($data){
//            return $this->respond($data);
//        }else{
//            return $this->failNotFound('No employee found');
//        }
    }

    // update
    public function update($id = null)
    {
//        $model = new EmployeeModel();
//        $id = $this->request->getVar('id');
//        $data = [
//            'name' => $this->request->getVar('name'),
//            'email'  => $this->request->getVar('email'),
//        ];
//        $model->update($id, $data);
//        $response = [
//            'status'   => 200,
//            'error'    => null,
//            'messages' => [
//                'success' => 'Employee updated successfully'
//            ]
//        ];
//        return $this->respond($response);
    }

    // delete
    public function delete($id = null)
    {
//        $model = new EmployeeModel();
//        $data = $model->where('id', $id)->delete($id);
//        if($data){
//            $model->delete($id);
//            $response = [
//                'status'   => 200,
//                'error'    => null,
//                'messages' => [
//                    'success' => 'Employee successfully deleted'
//                ]
//            ];
//            return $this->respondDeleted($response);
//        }else{
//            return $this->failNotFound('No employee found');
//        }
    }
}