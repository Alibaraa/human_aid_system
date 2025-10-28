<?php


namespace App\Controllers;

use App\Models\aidPersonModel;
use App\Models\PersonModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Auth\Models\UserModel;
use Auth\Models\userBlockModel;
use App\Models\BlockModel;
use App\Models\AidManageModel;

class ApiControler extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index()
    {
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();
        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }
        $person = new PersonModel();
        if($User['permissions'] == 3){
            $userBlockModel = new userBlockModel();
            $userBlocks = $userBlockModel->select('block_id ')->where('user_id', $User['id'])->findAll();
            $block_id = array();
            foreach ($userBlocks as $userBlock) {
                $block_id[] = $userBlock['block_id'];
            }
            $data['reportAll'] = array();
            $BlockModel = new BlockModel();
            $Block = $BlockModel->select('*,(select count(*) from person where person.block_id = block.id) as count')->whereIn('block.id',$block_id)->findAll();
            foreach ($Block as $item) {
                $data['reportAll'][] = array('count' => $item['count'], 'name' => $item['title']);
            }
            $personCountOne = $person->select('sum(num_mail) as count')->first();
            $data['reportAll'][] = array('count' => isset($personCountOne['count'])?$personCountOne['count']:0, 'name' => 'إجمالي عدد الذكور');

            $personCountOne = $person->select('sum(num_femail) as count')->first();
            $data['reportAll'][] = array('count' => isset($personCountOne['count'])?$personCountOne['count']:0, 'name' => 'إجمالي عدد الإناث');

            $personCountOne = $person->select('sum(f_num_liss_3) as count')->first();
            $data['reportAll'][] = array('count' => isset($personCountOne['count'])?$personCountOne['count']:0, 'name' => 'عدد الافراد اقل من 3 سنوات');

            $personCountOne = $person->select('sum(f_num_ill) as count')->first();
            $data['reportAll'][] = array('count' => isset($personCountOne['count'])?$personCountOne['count']:0, 'name' => 'عدد الافراد ذوي الامراض المزمنه');

            $personCountOne = $person->select('sum(f_num_sn) as count')->first();
            $data['reportAll'][] = array('count' => isset($personCountOne['count'])?$personCountOne['count']:0, 'name' => 'عدد الافراد ذوي الاحتياجات الخاصه');

        }else{
            $personCount = $person->countAll();
            $data['reportAll'][] = array('count' => $personCount, 'name' => 'عدد الاسر المسجلة');
            $BlockModel = new BlockModel();
            $BlockCount = $BlockModel->countAll();
            $data['reportAll'][] = array('count' => $BlockCount, 'name' => 'عدد المناديب');
            $aidPerson = new aidPersonModel();
            $aidPerson = $aidPerson->countAll();
            $data['reportAll'][] = array('count' => $aidPerson, 'name' => 'عدد المشاريع المنفذة');

            if ($aidPerson == 0 || $personCount == 0) {
                $data['reportAll'][] = array('count' => 0, 'name' => 'متوسط عدد الاستفادة للاسرة');
            } else {
                $data['reportAll'][] = array('count' => round($aidPerson / $personCount, 2), 'name' => 'متوسط عدد الاستفادة للاسرة');
            }
            $personCountOne = $person->select('sum(f_num) as count')->first();
            $data['reportAll'][] = array('count' => $personCountOne['count'], 'name' => 'إجمالي عدد الافراد');

            $personCountOne = $person->select('sum(num_mail) as count')->first();
            $data['reportAll'][] = array('count' => $personCountOne['count'], 'name' => 'إجمالي عدد الذكور');

            $personCountOne = $person->select('sum(num_femail) as count')->first();
            $data['reportAll'][] = array('count' => $personCountOne['count'], 'name' => 'إجمالي عدد الإناث');

            $personCountOne = $person->select('sum(f_num_liss_3) as count')->first();
            $data['reportAll'][] = array('count' => $personCountOne['count'], 'name' => 'عدد الافراد اقل من 3 سنوات');

            $personCountOne = $person->select('sum(f_num_ill) as count')->first();
            $data['reportAll'][] = array('count' => $personCountOne['count'], 'name' => 'عدد الافراد ذوي الامراض المزمنه');

            $personCountOne = $person->select('sum(f_num_sn) as count')->first();
            $data['reportAll'][] = array('count' => $personCountOne['count'], 'name' => 'عدد الافراد ذوي الاحتياجات الخاصه');

            if ($personCount == 0 || $BlockCount == 0) {
                $data['reportAll'][] = array('count' => 0, 'name' => 'متوسط عدد الاسر في التجمع');
            } else {
                $data['reportAll'][] = array('count' => round($personCount / $BlockCount, 2), 'name' => 'متوسط عدد الاسر في التجمع');
            }
        }

        $response = [
            'status' => true,
            'message' => 'تم جلب العناصرر بنجاح',
            'data' => (array)$data,
        ];
        return $this->respond($response, 200);
    }
    public function get_persone()
    {
        // validate request
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();
        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }

        $row = $this->request->getPost('start');
        $rowperpage = $this->request->getPost('length');
        $last_action = $this->request->getPost('last_action');
        $PersonModel = new PersonModel();
        $PersonModel->select(
            "person.id as p_id,person.pid as p_pid,person.fname as p_fname,person.sname as p_sname,person.tname as p_tname,person.lname as p_lname,person.mob_1 as p_mob_1,person.mob_2 as p_mob_2,person.f_num as p_f_num,person.block_id as p_block_id,person.wifi_id as p_wifi_id,person.wifi_name as p_wifi_name,person.num_mail as p_num_mail,person.num_femail as p_num_femail,person.f_num_liss_3 as p_f_num_liss_3,person.f_num_ill as p_f_num_ill,person.f_num_sn as p_f_num_sn,person.income as p_income,person.home_status as p_home_status, person.note as p_note,person.insert_date as p_insert_date,person.isdelet as p_isdelet,person.update_date as p_update_date
             ,block.id as b_id, block.title as b_title,block.p_name as b_p_name
             ")->join('block','block.id = person.block_id');
        if($User['permissions'] == 3){
            $userBlockModel = new userBlockModel();
            $userBlocks = $userBlockModel->select('block_id ')->where('user_id',$User['id'])->findAll();
            $block = array();
            foreach ($userBlocks as $userBlock) {
                $block[] = $userBlock['block_id'];
            }
            $PersonModel->whereIn('person.block_id',$block);
        }
        if(!empty($last_action)){
            $PersonModel->groupStart();
            $PersonModel->where('insert_date > ',$last_action);
            $PersonModel->orWhere('update_date > ',$last_action);
            $PersonModel->orWhere('isdelet_date > ',$last_action);
            $PersonModel->groupEnd();
        }
        $PersonModel->orderBy('person.id','desc');
        $res = $PersonModel->findAll($rowperpage,$row);


        $PersonModel->select(
            "person.id as p_id,person.pid as p_pid,person.fname as p_fname,person.sname as p_sname,person.tname as p_tname,person.lname as p_lname,person.mob_1 as p_mob_1,person.mob_2 as p_mob_2,person.f_num as p_f_num,person.block_id as p_block_id,person.wifi_id as p_wifi_id,person.wifi_name as p_wifi_name,person.num_mail as p_num_mail,person.num_femail as p_num_femail,person.f_num_liss_3 as p_f_num_liss_3,person.f_num_ill as p_f_num_ill,person.f_num_sn as p_f_num_sn,person.income as p_income,person.home_status as p_home_status, person.note as p_note,person.insert_date as p_insert_date,person.isdelet as p_isdelet,person.update_date as p_update_date
             ,block.id as b_id, block.title as b_title,block.p_name as b_p_name
             ")->join('block','block.id = person.block_id');
        if($User['permissions'] == 3){
            $userBlockModel = new userBlockModel();
            $userBlocks = $userBlockModel->select('block_id ')->where('user_id',$User['id'])->findAll();
            $block = array();
            foreach ($userBlocks as $userBlock) {
                $block[] = $userBlock['block_id'];
            }
            $PersonModel->whereIn('person.block_id',$block);
        }
        if(!empty($last_action)){
            $PersonModel->groupStart();
            $PersonModel->where('insert_date > '.$last_action);
            $PersonModel->orWhere('update_date > '.$last_action);
            $PersonModel->orWhere('isdelet_date > '.$last_action);
            $PersonModel->groupEnd();
        }
        $count = $PersonModel->countAllResults();

        $data_aid = array();
        if(!empty($res)){
            $p_id = array_column($res,'p_id');
            $aidPersonModel = new aidPersonModel();
            $data_aid = $aidPersonModel->join('aid_manage','aid_manage.id = aid_manage_id')
                ->join('aids','aids.id = aid_manage.aids_id')
                ->join('donation','donation.id = aid_manage.donation_id')
                ->whereIn('person_id',$p_id)->findAll();
        }
        $response = [
            'status' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'count' => $count,
            'data' => (array)$res,
            'aid' => (array)$data_aid
        ];
        return $this->respond($response, 200);
    }

    public function constant_var()
    {
        // validate request
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();

        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array()
            ];
            return $this->respond($response, 203);
        }

        $response = [
            'status' => true,
            'message' => 'ثوابت النظام',
            'data' => array(
                'income'=>array(
                    array('id'=>'1','title'=>'لا يعمل'),
                    array('id'=>'2','title'=>'عامل'),
                    array('id'=>'3','title'=>'موظف')
                ),
                'home_status'=>array(
                    array('id'=>'1','title'=>'سيئ'),
                    array('id'=>'2','title'=>'جيد'),
                    array('id'=>'3','title'=>'ممتاز')
                )
            )
        ];
        return $this->respond($response, 201);

    }

    // create
    public function get_blocks()
    {
        // validate request
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();
        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }
        if($User['permissions'] == 3) {
            $userBlockModel = new userBlockModel();
            $userBlocks = $userBlockModel->select('block_id ')->where('user_id', $User['id'])->findAll();
            $block = array();
            foreach ($userBlocks as $userBlock) {
                $block[] = $userBlock['block_id'];
            }
        }
        $BlockModel = new BlockModel();
        if($User['permissions'] == 3) {
            if(empty($block)){
                $block = [0];
            }
            $BlockModel->whereIn('id', $block);
        }
        $Blocks = $BlockModel->findAll();
        $response = [
            'status' => true,
            'message' => 'تم جلب المناديب',
            'data' => $Blocks,
        ];
        return $this->respond($response, 203);
    }
    // create
    public function create()
    {

        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();

        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
                'id'=>0
            ];
            return $this->respond($response, 203);
        }
        if($User['permissions'] == 3) {
            $userBlockModel = new userBlockModel();
            $userBlocks = $userBlockModel->select('block_id ')->where('user_id', $User['id'])->findAll();
            $block_user = array();
            foreach ($userBlocks as $userBlock) {
                $block_user[] = $userBlock['block_id'];
            }
        }
        $PersonModel = new PersonModel();
        $id = $this->request->getPost('id');
        $fname = $this->request->getPost('fname');
        $sname = $this->request->getPost('sname');
        $tname = $this->request->getPost('tname');
        $lname = $this->request->getPost('lname');
        $fcount = $this->request->getPost('fcount');
        $mob_1 = $this->request->getPost('mob_1');
        $mob_2 = $this->request->getPost('mob_2');
        $block = $this->request->getPost('block');
        $note = $this->request->getPost('note');
        $wifi_id = $this->request->getPost('wife_id');
        $wifi_name = $this->request->getPost('wife_name');
        $num_mail = $this->request->getPost('num_mail');
        $num_femail = $this->request->getPost('num_femail');
        $f_num_liss_3 = $this->request->getPost('f_num_liss_3');
        $f_num_ill = $this->request->getPost('f_num_ill');
        $f_num_sn = $this->request->getPost('f_num_sn');
        $income = $this->request->getPost('income');
        $home_status = $this->request->getPost('home_status');
        if(!$this->CheckId(trim($id))){
            $response = [
                'status' => 201,
                'messages' => 'رقم الهوية المدخل خطأ',
                'data'=>array(),
                'id'=>0
            ];
            return $this->respondCreated($response);
        }
        $count = $PersonModel->where('pid',$id)->withDeleted()->first();
        if($count){
            $response = [
                'status' => 201,
                'messages' => 'رقم الهوية موجود سابقا',
                'data'=>array(),
                'id'=>0
            ];
            return $this->respondCreated($response);
        }
        if(empty($fname) || empty($sname) || empty($tname) || empty($lname) || empty($block) ){
            $response = [
                'status' => 201,
                'messages' => 'أحد البيانات غير متوفرة يرجى التأكد من جميع الحقول المطلوبة',
                'data'=>array(),
                'id'=>0
            ];
            return $this->respondCreated($response);
        }
        if($User['permissions'] == 3 && !in_array($block,$block_user)){
            $response = [
                'status' => 203,
                'messages' => 'المندوب المضاف لا تبع للمستخدم',
                'data'=>array(),
                'id'=>0
            ];
            return $this->respondCreated($response);
        }
        $PersonModel->save(array(
            'pid'=>$id,
            'fname'=>$fname,
            'sname'=>$sname,
            'tname'=>$tname,
            'lname'=>$lname,
            'mob_1'=>$mob_1,
            'mob_2'=>$mob_2,
            'f_num'=>$fcount,
            'block_id'=>$block,
            'wifi_id'=>$wifi_id,
            'wifi_name'=>$wifi_name,
            'num_mail'=>$num_mail,
            'num_femail'=>$num_femail,
            'f_num_liss_3'=>$f_num_liss_3,
            'f_num_ill'=>$f_num_ill,
            'f_num_sn'=>$f_num_sn,
            'income'=>$income,
            'home_status'=>$home_status,
            'note'=>$note,
            'isdelet'=>0
        ));

        $response = [
            'status' => true,
            'messages' => 'تمت الاضافة بنجاح',
            'data'=>array(),
            'id'=>$PersonModel->getInsertID()
        ];
        return $this->respond($response,200);
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
    public function update($ids = null)
    {
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();

        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array()
            ];
            return $this->respond($response, 203);
        }
        if($User['permissions'] == 3) {
            $userBlockModel = new userBlockModel();
            $userBlocks = $userBlockModel->select('block_id ')->where('user_id', $User['id'])->findAll();
            $block_user = array();
            foreach ($userBlocks as $userBlock) {
                $block_user[] = $userBlock['block_id'];

            }
        }
        $PersonModel = new PersonModel();
        $pid = $this->request->getPost('pid');
        $fname = $this->request->getPost('fname');
        $sname = $this->request->getPost('sname');
        $tname = $this->request->getPost('tname');
        $lname = $this->request->getPost('lname');
        $f_num = $this->request->getPost('f_num');
        $mob_1 = $this->request->getPost('mob_1');
        $mob_2 = $this->request->getPost('mob_2');
        $block = $this->request->getPost('block');
        $note = $this->request->getPost('note');
        $status = $this->request->getPost('status');

        $wifi_id = $this->request->getPost('wife_id');
        $wifi_name = $this->request->getPost('wife_name');
        $num_mail = $this->request->getPost('num_mail');
        $num_femail = $this->request->getPost('num_femail');
        $f_num_liss_3 = $this->request->getPost('f_num_liss_3');
        $f_num_ill = $this->request->getPost('f_num_ill');
        $f_num_sn = $this->request->getPost('f_num_sn');
        $income = $this->request->getPost('income');
        $home_status = $this->request->getPost('home_status');
       
        if(!$this->CheckId(trim($pid))){
            $response = [
                'status' => 201,
                'messages' => 'رقم الهوية المدخل خطأ',
                'data'=>array()
            ];
            return $this->respond($response);
        }
        if(empty($ids) || empty($fname) || empty($sname) || empty($tname) || empty($lname) || empty($block) ){
            $response = [
                'status' => 201,
                'messages' => 'أحد البيانات غير متوفرة يرجى التأكد من جميع الحقول المطلوبة',
                'data'=>array()
            ];
            return $this->respond($response);
        }
        if($User['permissions'] == 3 && !in_array($block,$block_user)){
            $response = [
                'status' => 203,
                'messages' => 'المندوب المضاف لا يتبع للمستخدم',
                'data'=>array()
            ];
            return $this->respond($response);
        }
        $count = $PersonModel->where('pid',$pid)->where('id !=',$ids)->first();
        if($count){
            $response = [
                'status' => 201,
                'messages' => 'رقم الهوية مدخل لحساب شخص أخر',
                'data'=>array()
            ];
            return $this->respond($response);
        }
        $PersonModel->update($ids,array(
            'pid'=>$pid,
            'fname'=>$fname,
            'sname'=>$sname,
            'tname'=>$tname,
            'lname'=>$lname,
            'mob_1'=>$mob_1,
            'mob_2'=>$mob_2,
            'f_num'=>$f_num,
            'block_id'=>$block,
            'wifi_id'=>$wifi_id,
            'wifi_name'=>$wifi_name,
            'num_mail'=>$num_mail,
            'num_femail'=>$num_femail,
            'f_num_liss_3'=>$f_num_liss_3,
            'f_num_ill'=>$f_num_ill,
            'f_num_sn'=>$f_num_sn,
            'income'=>$income,
            'home_status'=>$home_status,
            'note'=>$note,
            'isdelet'=>$status
        ));
        $response = [
            'status' => true,
            'messages' => 'تم التعديل بنجاح',
            'data'=>array()
        ];
        return $this->respond($response,200);


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
        helper('text');
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
          //  $block_data[] = array('id'=>$item['block_id'],'title'=>$item['title']);
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


    public function get_aid_manage()
    {
        // validate request
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();
        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }
        if($User['permissions'] == 3){
            $response = [
                'status' => false,
                'message' => 'لا تملك الصلاحية للدخول لهذه الصفحة',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }

        $row = $this->request->getPost('start');
        $rowperpage = $this->request->getPost('length');
        $AidManageModel = new AidManageModel();
        $AidManageModel->select("aid_manage.id as aid_manage_id,aid_manage.title as aid_manage_title,aid_manage.date as aid_manage_date,aid_manage.note as aid_manage_note,aids.name as aids_name,donation.name as donation_name");
        $AidManageModel->join('aids','aids.id = aid_manage.aids_id');
        $AidManageModel->join('donation','donation.id = aid_manage.donation_id');
        $AidManageModel->where('status','1');
        $AidManageModel->orderBy('aid_manage_id','desc');
        $res = $AidManageModel->findAll($rowperpage,$row);


        $response = [
            'status' => true,
            'message' => 'تم تحمل البيانات بنجاح',
            'data' => (array)$res
        ];
        return $this->respond($response, 200);
    }

    public function get_aid_manage_by_id($id)
    {
        // validate request
        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();
        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }
        if($User['permissions'] == 3){
            $response = [
                'status' => false,
                'message' => 'لا تملك الصلاحية للدخول لهذه الصفحة',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }

 
        $AidManageModel = new AidManageModel();
        $AidManageModel->select("aid_manage.id as aid_manage_id,aid_manage.title as aid_manage_title,aid_manage.date as aid_manage_date,aid_manage.note as aid_manage_note,aids.name as aids_name,donation.name as donation_name");
        $AidManageModel->join('aids','aids.id = aid_manage.aids_id');
        $AidManageModel->join('donation','donation.id = aid_manage.donation_id');
        $AidManageModel->where('status','1');
        $AidManageModel->where('aid_manage.id',$id);
        $AidManageModel->orderBy('aid_manage_id','desc');
        $res = $AidManageModel->first();

        $aidPersonModel = new aidPersonModel();
        $aidPersonModel->select("aid_person.id as aid_person_id,aid_person.quantity as aid_person_quantity,aid_person.status_rec as aid_person_status_rec,aid_person.rec_name as aid_person_rec_name,person.fname as person_fname,person.sname as person_sname,person.tname as person_tname,person.lname as person_lname,person.mob_1 as person_mob_1,person.pid as person_pid");
        $aidPersonModel->join('person','person.id = aid_person.person_id');
        $aidPersonModel->where('aid_person.aid_manage_id ',$id);
        $aidPersonModel->orderBy('person.fname','ASC');
        $aidPersonModel->orderBy('person.sname','ASC');
        $aidPersonModel->orderBy('person.tname','ASC');
        $aidPersonModel->orderBy('person.lname','ASC');
        $aidPerson = $aidPersonModel->findAll();


        $response = [
            'status' => true,
            'message' => 'تم تحمل البيانات بنجاح',
            'data' => (array)$res,
            'person'=>(array)$aidPerson
        ];
        return $this->respond($response, 200);
    }

    public function set_aid_manage_receive()
    {

        $auth = $this->request->getHeaderLine('auth');
        $UserModel = new UserModel();
        $User = $UserModel->where('api_hash',$auth)->first();
        if (!$User) {
            $response = [
                'status' => false,
                'message' => 'يرجى تسجيل الدخول',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }
        if($User['permissions'] == 3){
            $response = [
                'status' => false,
                'message' => 'لا تملك الصلاحية للدخول لهذه الصفحة',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }

        $data = $this->request->getPost('data');
       

        if(empty($data)){
            $response = [
                'status' => false,
                'message' => 'البيانات المرسلة خطأ',
                'data' => array(),
            ];
            return $this->respond($response, 203);
        }
        $data_final = array();
        $data = json_decode($data);
       
        foreach ($data as $datum) {
            $data_final[] = array('id'=>$datum->id,'status_rec'=>1,'rec_name'=>$datum->title);
        }
       

        $aidPersonModel = new aidPersonModel();
        $set_data = $aidPersonModel->updateBatch($data_final,'id');
        $response = [
            'status' => true,
            'message' => 'تم معالجة البيانات',
            'data' => $set_data,
        ];
        return $this->respond($response, 200);
    }
    
    public function CheckId($idno) {
        $MultID = [1, 2, 1, 2, 1, 2, 1, 2];
        $SumID = 0;
        $i = 0;
        $x = 0;
        $r = (string)$idno;

        if (strlen($r) === 9 && is_numeric($r)) {
            while ($i < 8) {
                $x = $MultID[$i] * (int)$r[$i];
                if ($x > 9) {
                    $t = (string)$x;
                    $x = (int)$t[0] + (int)$t[1];
                }
                $SumID += $x;
                $i++;
            }

            if ($SumID % 10 !== 0) {
                $SumID = 10 * (int)($SumID / 10) + 10 - $SumID;
            } else {
                $SumID = 0;
            }

            if ($SumID === (int)$r[8]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}