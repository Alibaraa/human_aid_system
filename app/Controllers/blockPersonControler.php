<?php

namespace App\Controllers;
include_once(APPPATH . "ThirdParty/SimpleXLSX.php");

use Config\Services;
use Shuchkin\SimpleXLSX;
use App\Models\PersonModel;
use App\Models\BlockModel;

class blockPersonControler extends BaseController
{
    protected $session;
    protected $config;
    protected $block;
    public function __construct()
    {
        $this->session = Services::session();
        $this->config = config('Auth');
        $this->block = $this->session->get('userData')['block_id'];
        if(empty($this->block)){
            exit();
        }
    }
    public function index()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select("*,person.id as p_id")->join('block','block.id = person.block_id')->whereIn('person.block_id',$this->block)->orderBy('person.id','desc')->findAll();

        return view('personBlock/show',$data);
    }
    public function uploadFile()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        return view('personBlock/csv');
    }
    public function xlsx_arr($file_name)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $arrResult = array();
        if ($xlsx = SimpleXLSX::parse($file_name)) {
            foreach ($xlsx->rows() as $val){
                $arrResult[] = $val;
            }
        }

        return $arrResult;
    }
    public function uploadCsv(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $block_id = $this->block;
        $block = array();

        $BlockModel = new BlockModel();
        $block['Block'] = $BlockModel->findAll();

        if(isset($_FILES)){

            $tmpName = $_FILES['file']['tmp_name'];
            $csv_data = $this->xlsx_arr($tmpName);

            $PersonModel = new PersonModel();
            $i = 0;

            foreach ($csv_data as $datum){
                $i++;
                if($i == 1){
                    continue;
                }

                $count = $PersonModel->where('pid',$datum['0'])->first();
                if($count){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'action'=>'<a target="_blank" href="'.base_url().'/personBlock/editPerson/'.$count['id'].'">تعديل</a>','massage'=>'المستفد مدخل مسبقا.');
                    continue;
                }
                if(empty($datum['0']) || empty($datum['1']) || empty($datum['2']) || empty($datum['3']) || empty($datum['4']) ){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'action'=>'','massage'=>'  احد البيانات غر متوفرة.');
                    continue;
                }

                $PersonModel->save(array(
                    'pid'=>$datum['0'],
                    'fname'=>$datum['1'],
                    'sname'=>$datum['2'],
                    'tname'=>$datum['3'],
                    'lname'=>$datum['4'],
                    'mob_1'=>isset($datum['5'])?$datum['5']:'',
                    'mob_2'=>isset($datum['6'])?$datum['6']:'',
                    'f_num'=>isset($datum['7'])?$datum['7']:'',
                    'block_id'=>$block_id,
                    'note'=>isset($datum['8'])?$datum['8']:'',
                    'isdelet'=>0
                ));
                $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'action'=>'','massage'=>'تمت الاضافة بنجاح');
            }
            return view('personBlock/csv',$block);
        }

    }
    public function add($chick = 0)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel->whereIn('id',$this->block)->findAll();
        $data['chick'] = $chick;
        return view('personBlock/add',$data);
    }
    public function editPerson($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $data['id'] = $id;
        $PersonModel = new PersonModel();
        $data['editData'] = $PersonModel->where('id',$id)->first();
        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel->whereIn('id',$this->block)->findAll();

        if(!in_array($data['editData']['block_id'],$this->block)){
            return redirect()->to('personBlock/show');
        }
        return view('personBlock/update',$data);
    }
    public function update($ids)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
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

        $wifi_id = $this->request->getPost('wifi_id');
        $wifi_name = $this->request->getPost('wifi_name');
        $num_mail = $this->request->getPost('num_mail');
        $num_femail = $this->request->getPost('num_femail');
        $f_num_liss_3 = $this->request->getPost('f_num_liss_3');
        $f_num_ill = $this->request->getPost('f_num_ill');
        $f_num_sn = $this->request->getPost('f_num_sn');
        $income = $this->request->getPost('income');
        $home_status = $this->request->getPost('home_status');

        if(!in_array($block,$this->block)){
            return redirect()->to('personBlock/add/1');
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
        return redirect()->to('personBlock/show');
    }
    public function insert()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
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


        $wifi_id = $this->request->getPost('wifi_id');
        $wifi_name = $this->request->getPost('wifi_name');
        $num_mail = $this->request->getPost('num_mail');
        $num_femail = $this->request->getPost('num_femail');
        $f_num_liss_3 = $this->request->getPost('f_num_liss_3');
        $f_num_ill = $this->request->getPost('f_num_ill');
        $f_num_sn = $this->request->getPost('f_num_sn');
        $income = $this->request->getPost('income');
        $home_status = $this->request->getPost('home_status');


        if(!in_array($block,$this->block)){
            return redirect()->to('personBlock/add/1');
        }
        $count = $PersonModel->where('pid',$id)->first();
        if($count){
            return redirect()->to('personBlock/add/1');
        }
        if(empty($fname) || empty($sname) || empty($tname) || empty($lname) || empty($block) ){
            return redirect()->to('personBlock/add/2');
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
        return redirect()->to('personBlock/add/3');
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
