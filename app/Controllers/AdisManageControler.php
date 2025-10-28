<?php
namespace App\Controllers;
include_once(APPPATH . "ThirdParty/xlsxwriter.class.php");

use Config\Services;
use XLSXWriter;
use App\Models\AidManageModel;
use App\Models\BlockModel;
use App\Models\PersonModel;
use App\Models\aidPersonModel;
use App\Models\aidsModel;
use App\Models\donationModel;

class AdisManageControler extends BaseController{
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
        $PersonModel = new AidManageModel();
        $data['AdisSow'] =
            $PersonModel->select('aid_manage.id as id,aid_manage.title title,aids.name as aids_name,donation.name as donation_name , date ,aid_manage.note as note,(select count(id) from aid_person where aid_person.aid_manage_id = aid_manage.id ) as count')
                ->join('aids','aids.id = aid_manage.aids_id')
                ->join('donation','donation.id = aid_manage.donation_id')
                ->orderBy('aid_manage.id','desc')
                ->findAll();

        $BlockModel = new BlockModel();
        $data['block'] = $BlockModel->select('*,(select count(*) from person  where person.block_id = block.id) as count')->findAll();
        $data['BlockList'] = $BlockModel->findAll();
        return view('Adis/show',$data);
    }

    public function viewAidsPerson($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidPersonModel = new aidPersonModel();
        $data['AdisSow'] =
            $aidPersonModel
                ->select("*,donation.name as dname")
                ->join('aid_manage','aid_manage.id = aid_person.aid_manage_id')
                ->join('donation','donation.id = aid_manage.donation_id')
                ->join('aids','aids.id = aid_manage.aids_id')
                ->orderBy('aid_manage.id','desc')
                ->where('aid_person.person_id',$id)
                ->findAll();
        $PersonModel = new PersonModel();

        $data['person'] = $PersonModel->where('id',$id)->first();


        return view('person/showAidsPerson',$data);
    }
    public function addAidsIdsPerson($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if(empty($id)){
            exit;
        }

        $data['id'] = $id;
        $AidManageModel = new AidManageModel();
        $data['cobone'] = $AidManageModel->where('id',$id)->first();

        return view('Adis/addAidsIdsPerson',$data);
    }
    public function addAidsIdsPersonAdd($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if(empty($id)){
            exit;
        }
        $aidPersonModel = new aidPersonModel();
        $person = new PersonModel();
        $quantity = $this->request->getPost('quantity');
        if(empty($quantity)){
            $quantity = 1;
        }
        if(isset($_POST['idsnumber']) && !empty($_POST['idsnumber'])){
            $error = array();
            $mod_keys = trim( $_POST['idsnumber'] );
            $pids = explode( "\n", $mod_keys );
            foreach ($pids as $pid) {

                $personData = $person->where('pid',$pid)->first();
                if(empty($personData)){
                    $error[] = array('id'=>$pid,'error'=>'المستفيد غير مسجل في قاعدة البيانات');
                }else if($personData['isdelet'] == 1){
                    $error[] = array('id'=>$pid,'error'=>'حالة الحساب غير فعال');
                }else{
                    $chick_if_user_exit = $aidPersonModel->where('person_id',$personData['id'])->where('aid_manage_id',$id)->first();
                    if(!empty($chick_if_user_exit)){
                        $error[] = array('id'=>$pid,'error'=>'رقم الهوية مسجل سابقا بنفس الكوبون');
                    }else{
                        $aidPersonModel->save(array(
                            'person_id'=>$personData['id'],
                            'quantity'=>$quantity,
                            'aid_manage_id'=>$id
                        ));
                    }
                }

            }
            $data['AdisSow'] = $error;
        }
        $data['id'] = $id;
        $AidManageModel = new AidManageModel();
        $data['cobone'] = $AidManageModel->where('id',$id)->first();
        return view('Adis/addAidsIdsPerson',$data);
    }
    public function addCobon()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();
        $data['Adis'] = $aidsModel->findAll();

        $donationModel = new donationModel();
        $data['donation'] = $donationModel->findAll();


        return view('Adis/add_cobon',$data);
    }
    public function insert()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $title = $this->request->getPost('title');
        $Adis = $this->request->getPost('Adis');
        $donation = $this->request->getPost('donation');
        $Date = $this->request->getPost('Date');
        $note = $this->request->getPost('note');

        $AidManageModel = new AidManageModel();
        $AidManageModel->save(array(
            'title'=>$title,
            'aids_id'=>$Adis,
            'donation_id'=>$donation,
            'date'=>$Date,
            'note'=>$note
        ));

        return redirect()->to('AdisManage/show');
    }
    public function updateCobon($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();
        $data['Adis'] = $aidsModel->findAll();

        $donationModel = new donationModel();
        $data['donation'] = $donationModel->findAll();

        $data['id'] = $id;

        $AidManageModel = new AidManageModel();
        $data['AidManage'] = $AidManageModel->where('id',$id)->first();

        return view('Adis/updateCobon',$data);
    }
    public function update()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $id = $this->request->getPost('id');
        $title = $this->request->getPost('title');
        $Adis = $this->request->getPost('Adis');
        $donation = $this->request->getPost('donation');
        $Date = $this->request->getPost('Date');
        $note = $this->request->getPost('note');

        $AidManageModel = new AidManageModel();
        $AidManageModel->update($id,array(
            'title'=>$title,
            'aids_id'=>$Adis,
            'donation_id'=>$donation,
            'date'=>$Date,
            'note'=>$note
        ));

        return redirect()->to('AdisManage/show');
    }

    public function addAidsFromGroup(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $group_data_id = $this->request->getPost('group_data_id');
        $group_person_id = $this->request->getPost('group_id');
        $PersonModel = new PersonModel();
        $aidPersonModel = new aidPersonModel();
        $person_info = $PersonModel->where('person.isdelet',0)->whereIn('block_id',$group_person_id)->findAll();
        $error=array();
        $count = 0;
        $error_html='';

        foreach ($person_info as $item) {
            $chick_if_user_exit = $aidPersonModel->where('person_id',$item['id'])->where('aid_manage_id',$group_data_id)->first();
            if(empty($chick_if_user_exit)){
                $aidPersonModel->save(array(
                    'person_id'=>$item['id'],
                    'aid_manage_id'=>$group_data_id
                ));
                $count++;
            }else{
                $error[] = array(
                    'ID'=>$item['pid'],
                    'NAME'=>'<li>'.$item['fname'].' '.$item['sname'].' '.$item['tname'].' '.$item['lname'].'</li>',
                    'INSER_DATE'=>$chick_if_user_exit['insert_date'],
                );
                $error_html = $error_html . '<li>'.$item['fname'].' '.$item['sname'].' '.$item['tname'].' '.$item['lname'].' : '.$chick_if_user_exit['insert_date'].'</li>';
            }
        }
        print_r(
            json_encode(
                array(
                    'add_count'=>$count,
                    'error_count'=>count($error),
                    'error'=>$error,
                    'error_html'=>$error_html,
                    'message'=>'تم إضافة '.$count
                )
            )
        );
    }

    public function addAidsFromPerson($id,$tag = 0){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new AidManageModel();
        $data['personAid'] = $PersonModel->where('id',$id)->first();
        if(empty($data['personAid'])){
            exit;
        }
        $data['cobon_id'] = $id;
        $data['tag'] = $tag;

        $aidPersonModel = new aidPersonModel();
        $person_info = $aidPersonModel->select('person_id')->where('aid_manage_id',$id)->findAll();
        $per_data = array();
        $per_data[] = 0;
        foreach ($person_info as $person_info_datum) {
            $per_data[] = $person_info_datum['person_id'];
        }

        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select('*,person.id as per_id')
            ->join('block','block.id = person.block_id')
            ->WhereNotIn('person.id',$per_data)
            ->where('person.isdelet',0)
            ->findAll();

        return view('Adis/add_person_to_cobon',$data);
    }
    public function addAidsFromPersonInsert(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $cobon_id = $this->request->getPost('cobon_id');
        $user_id = $this->request->getPost('user_id');
        if(empty($user_id)){
            exit;
        }
        if(empty($cobon_id)){
            exit;
        }
        $user = array();
        $aidPersonModel = new aidPersonModel();
        foreach ($user_id as $item) {
            $chick_if_user_exit = $aidPersonModel->where('person_id',$item)->where('aid_manage_id',$cobon_id)->first();
            if(empty($chick_if_user_exit)) {
                $user[] = array(
                    'person_id' => $item,
                    'aid_manage_id' => $cobon_id
                );
            }
        }
        $aidPersonModel = new aidPersonModel();
        if(!empty($user) && $aidPersonModel->insertBatch($user)){
            return redirect()->to('AdisManage/addAidsFromPerson/'.$cobon_id.'/1');
        }else{
            return redirect()->to('AdisManage/addAidsFromPerson/'.$cobon_id.'/2');
        }

    }


    public function showAidsFromPerson($id,$tag = 0){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new AidManageModel();
        $data['personAid'] = $PersonModel->where('id',$id)->first();
        if(empty($data['personAid'])){
            exit;
        }
        $data['cobon_id'] = $id;
        $data['tag'] = $tag;

        $blockModel = new BlockModel();
        $data['users'] = $blockModel->findAll();

        return view('Adis/show_person_to_cobon',$data);
    }

    public function get_person_table_data($id)
    {
        if (!isset($_SESSION['userData']['name'])) {
            return redirect()->to(base_url('login'));
        }
        if ($this->request->isAJAX()) {
            $params = $this->request->getPost('params');

            $draw = $this->request->getPost('draw');
            $row = $this->request->getPost('start');
            $rowperpage = $this->request->getPost('length'); // Rows display per page
            $columnIndex = $this->request->getPost('order')[0]['column']; // Column index
            $columnName = $this->request->getPost('columns')[$columnIndex]['data']; // Column name
            $columnSortOrder = $this->request->getPost('order')[0]['dir']; // asc or desc

            $pid = isset($params['pid'])?$params['pid']:''; // p name
            $fname = isset($params['fname'])?$params['fname']:''; // p name
            $sname = isset($params['sname'])?$params['sname']:''; // p name
            $tname = isset($params['tname'])?$params['tname']:''; // p name
            $lname = isset($params['lname'])?$params['lname']:''; // p name

            $mobile = isset($params['mobile'])?$params['mobile']:''; // p name
            $block = isset($params['block'])?$params['block']:''; // p name
            $status_rec = isset($params['status_rec'])?$params['status_rec']:''; // p name

            $PersonModel = new PersonModel();
            $PersonModel->select('*,block.p_mob as block_p_mob,block.title as block_title,person.id as per_id , aid_person.id as cobon_id')
                ->join('block','block.id = person.block_id')
                ->join('aid_person','aid_person.person_id = person.id')
                ->where('aid_person.aid_manage_id',$id)
                ->where('person.isdelet',0);



            if (!empty($pid)) {
                $PersonModel->where('person.pid', $pid);
            }
            if (!empty($fname)) {
                $PersonModel->like('person.fname', $fname);
            }
            if (!empty($sname)) {
                $PersonModel->like('person.sname', $sname);
            }
            if (!empty($tname)) {
                $PersonModel->like('person.tname', $tname);
            }
            if (!empty($lname)) {
                $PersonModel->like('person.lname', $lname);
            }
            if(!empty($mobile)){
                $PersonModel->where('person.mob_1', $mobile);
            }

            if(!empty($block)){
                $PersonModel->where('person.block_id', $block);
            }
            $res = $PersonModel->findAll($rowperpage,$row);

            $totalRecords = $PersonModel->select('*,person.id as per_id , aid_person.id as cobon_id')
                ->join('block','block.id = person.block_id')
                ->join('aid_person','aid_person.person_id = person.id')
                ->where('aid_person.aid_manage_id',$id)
                ->where('person.isdelet',0)->countAllResults();

            $PersonModel->select('block.id')
                ->join('block','block.id = person.block_id')
                ->join('aid_person','aid_person.person_id = person.id')
                ->where('aid_person.aid_manage_id',$id)
                ->where('person.isdelet',0);



            if (!empty($pid)) {
                $PersonModel->where('person.pid', $pid);
            }
            if (!empty($fname)) {
                $PersonModel->like('person.fname', $fname);
            }
            if (!empty($sname)) {
                $PersonModel->like('person.sname', $sname);
            }
            if (!empty($tname)) {
                $PersonModel->like('person.tname', $tname);
            }
            if (!empty($lname)) {
                $PersonModel->like('person.lname', $lname);
            }
            if(!empty($mobile)){
                $PersonModel->where('person.mob_1', $mobile);
            }

            if(!empty($block)){
                $PersonModel->where('person.block_id', $block);
            }
            $totalRecordwith = $PersonModel->findAll();
            $result = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => count($totalRecordwith),
                "aaData" => array_values($res)
            );
            return json_encode($result);

        }
    }


    public function deleteAidsFromPersonInsert()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $cobon_id = $this->request->getPost('cobon_id');
        $user_id = $this->request->getPost('user_id');
        if (empty($user_id)) {
            exit;
        }
        if (empty($cobon_id)) {
            exit;
        }
        $aidPersonModel = new aidPersonModel();
        foreach ($user_id as $item) {
            $aidPersonModel->delete($item);
        }
        return redirect()->to('AdisManage/viewAidsFromPerson/' . $cobon_id . '/1');

    }


}
