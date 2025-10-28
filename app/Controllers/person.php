<?php

namespace App\Controllers;
include_once(APPPATH . "ThirdParty/SimpleXLSX.php");

use Config\Services;
use Shuchkin\SimpleXLSX;
use App\Models\PersonModel;
use App\Models\BlockModel;

class Person extends BaseController
{
    protected $session;
    protected $config;
    protected $permissions;
    public function __construct()
    {
        $this->session = Services::session();
        $this->config = config('Auth');
        $this->permissions = $this->session->get('userData')['permissions'];
        if(empty($this->permissions) || $this->permissions == 3){
            exit();
        }
    }
    public function index()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select("*,person.id as p_id,person.note as note")->join('block','block.id = person.block_id')->orderBy('person.id','desc')->findAll();

        return view('person/show',$data);
    }
    
    public function felter(){
      if (!isset($this->session->get('userData')['name'])) {
          return redirect()->to(base_url('login'));
      }
      $blockModel = new BlockModel();
      $data['users'] = $blockModel->findAll();
      return view('person/showFellter',$data);
    }

    public function get_table_data()
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
            $operator = isset($params['operator'])?$params['operator']:''; // p name
            $fcount = isset($params['fcount'])?$params['fcount']:'';
            $active = isset($params['active'])?$params['active']:'';

            $operatoraids = isset($params['operatoraids'])?$params['operatoraids']:''; // p name
            $countaids = isset($params['countaids'])?$params['countaids']:'';

  //
            $PersonModel = new PersonModel();
            $PersonModel->select("*,person.id as p_id,person.insert_date as person_insert_date,person.note as note,(select count(*) from aid_person where p_id = aid_person.person_id) as aids_count ")->join('block','block.id = person.block_id');

            if (!empty($pid)) {
                $PersonModel->where('pid', $pid);

            }

            if (!empty($fname)) {
                $PersonModel->like('fname', $fname);
            }
            if (!empty($sname)) {
                $PersonModel->like('sname', $sname);
            }
            if (!empty($tname)) {
                $PersonModel->like('tname', $tname);
            }
            if (!empty($lname)) {
                $PersonModel->like('lname', $lname);
            }
            if(!empty($mobile)){
                $PersonModel->where('mob_1', $mobile);
            }
            if(!empty($active)){
              $PersonModel->where('isdelet', $active);
            }

            if(!empty($block)){
                $PersonModel->where('block_id', $block);
            }
            if(!empty($operator)){
                $operator_icon = '';
                if($operator == 1){
                    $operator_icon = ">";
                }else if($operator == 2){
                    $operator_icon = "<";
                }else if($operator == 3){
                    $operator_icon = "=";
                }
            }
            if(isset($operator_icon) && !empty($operator_icon) && !empty($fcount)){
                $PersonModel->where('f_num '.$operator_icon, $fcount);
            }

            if(!empty($operatoraids)){
                $operatoraids_icon = '';
                if($operatoraids == 1){
                    $operatoraids_icon = ">";
                }else if($operatoraids == 2){
                    $operatoraids_icon = "<";
                }else if($operatoraids == 3){
                    $operatoraids_icon = "=";
                }
            }

            $PersonModel->orderBy('person.id','desc');

            if(isset($operatoraids_icon) && !empty($operatoraids_icon) && !empty($countaids)){
                $PersonModel->having('aids_count '.$operatoraids_icon, $countaids);
            }
            $res = $PersonModel->findAll($rowperpage,$row);



            //
            $totalRecords =  $PersonModel->select("*,person.id as p_id")->join('block','block.id = person.block_id')->orderBy('person.id','desc')->countAll();


            $totalRecordwithFilter = $PersonModel->countAll();


            $result = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => array_values($res)
            );
            return json_encode($result);

        }
    }

    public function get_table_data_export()
    {
        if (!isset($_SESSION['userData']['name'])) {
            return redirect()->to(base_url('login'));
        }

            $pid = $this->request->getPost('pid');
            $fname = $this->request->getPost('fname');
            $sname = $this->request->getPost('sname');
            $tname = $this->request->getPost('tname');
            $lname = $this->request->getPost('lname');

            $mobile = $this->request->getPost('mobile');
            $block = $this->request->getPost('block');
            $operator = $this->request->getPost('operator');
            $fcount = $this->request->getPost('fcount');

            $operatoraids = $this->request->getPost('operatoraids');
            $countaids = $this->request->getPost('countaids');
            $active = $this->request->getPost('active');

//
            $PersonModel = new PersonModel();
            $PersonModel->select("*,person.id as p_id,person.note as note,(select count(*) from aid_person where p_id = aid_person.person_id) as aids_count ")->join('block','block.id = person.block_id');

            if (!empty($pid)) {
                $PersonModel->where('pid', $pid);

            }

            if (!empty($fname)) {
                $PersonModel->like('fname', $fname);
            }
            if (!empty($sname)) {
                $PersonModel->like('sname', $sname);
            }
            if (!empty($tname)) {
                $PersonModel->like('tname', $tname);
            }
            if (!empty($lname)) {
                $PersonModel->like('lname', $lname);
            }
            if(!empty($mobile)){
                $PersonModel->where('mob_1', $mobile);
            }
            if(!empty($block)){
                $PersonModel->where('block_id', $block);
            }
            if(!empty($active)){
              $PersonModel->where('isdelet', $active);
            }
            if(!empty($operator)){
                $operator_icon = '';
                if($operator == 1){
                    $operator_icon = ">";
                }else if($operator == 2){
                    $operator_icon = "<";
                }else if($operator == 3){
                    $operator_icon = "=";
                }
            }
            if(isset($operator_icon) && !empty($operator_icon) && !empty($fcount)){
                $PersonModel->where('f_num '.$operator_icon, $fcount);
            }

            if(!empty($operatoraids)){
                $operatoraids_icon = '';
                if($operatoraids == 1){
                    $operatoraids_icon = ">";
                }else if($operatoraids == 2){
                    $operatoraids_icon = "<";
                }else if($operatoraids == 3){
                    $operatoraids_icon = "=";
                }
            }

            $PersonModel->orderBy('person.id','desc');

            if(isset($operatoraids_icon) && !empty($operatoraids_icon) && !empty($countaids)){
                $PersonModel->having('aids_count '.$operatoraids_icon, $countaids);
            }
            $res = $PersonModel->findAll();

        $row_head[] = array('رقم الهوية','الاسم الرباعي','رقم الجوال','عدد الافراد','عدد المساعدات' ,'المربع','حالة المستفيد','رقم هوية الزوجة','اسم الزوجة','عدد الذكور','عدد الاناث','عدد الافراد اقل من 3 سنوات','عدد الافراد ذوي الأمراض المزمنه','عدد الافراد ذوي الاعاقة','معيل الاسرة','حالة المسكن','الملاحظات');

        foreach ($res as $line) {
            $income = '';
            if($line['income']==1){
                $income = 'لا يعمل';
            }elseif($line['income']==2){
                $income = 'عامل';
            }elseif($line['income']==3){
                $income = 'موظف';
            }
            $home_status = '';
            if($line['home_status']==1){
                $home_status = 'سيئ';
            }elseif($line['home_status']==2){
                $home_status = 'جيد';
            }elseif($line['home_status']==3){
                $home_status = 'ممتاز';
            }
            $row_head[] = array($line['pid'],$line['fname']." ".$line['sname']." ".$line['tname']." ".$line['lname'],$line['mob_1'],$line['f_num'],$line['aids_count'],$line['title'],$line['isdelet']==0?'فعال':'غير فعال',$line['wifi_id'],$line['wifi_name'],$line['num_mail'],$line['num_femail'],$line['f_num_liss_3'],$line['f_num_ill'],$line['f_num_sn'],$income,$home_status,$line['note']);
        }
        $filename = 'المستفيدين';
        $export_controle = new exportControler();
        $export_controle->arr_xlsx($row_head, $filename);
        exit();


    }

    public function chieckIds()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        return view('person/chieckIds');
    }
    public function data_chieckIds()
    {
        $block['statusExport'][] = array('رقم الهوية','الرسالة');
        if(isset($_POST['idsnumber']) && !empty($_POST['idsnumber'])){
            $mod_keys = trim( $_POST['idsnumber'] );
            $pids = explode( "\n", $mod_keys );
            foreach ($pids as $pid) {

                if(!$this->CheckId(trim($pid))){
                    $block['statusExport'][]=array($pid,'رقم الهوية خطأ');
                }else{
                    $block['statusExport'][]=array($pid,'رقم الهوية صحيح');
                }

            }
            $exportControler = new exportControler();
            $exportControler->arr_xlsx($block['statusExport'], 'status');
        }
    }

    public function active_not_active($id,$status = 1)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new PersonModel();
        if($status == 1){
            $PersonModel->update($id,array('isdelet_date'=>null));
        }
        if($status == 2){
            $PersonModel->update($id,array('isdelet'=>1));
        }
        return redirect()->to(base_url('person/show/delete'));
    }
    public function show_delete()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select("*,person.id as p_id")->join('block','block.id = person.block_id')->orderBy('person.id','desc')->where('isdelet',0)->onlyDeleted()->findAll();

        return view('person/show_delete',$data);
    }
    public function chickPid()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $pid = $this->request->getPost('pid');
        $PersonModel = new PersonModel();
        $data = $PersonModel->select("*,person.id as p_id")->join('block','block.id = person.block_id')->where('person.pid',$pid)->first();
        print_r(json_encode($data));exit();
    }
    public function uploadFile_block()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        return view('person/csv_block');
    }
    public function uploadFile()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel->findAll();
        return view('person/csv',$data);
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
        $block_id = $this->request->getPost('block');
        $types = $this->request->getPost('type_add_or_convert');
        $exportType = $this->request->getPost('exportType');
        $block = array();

        $BlockModel = new BlockModel();
        $block['Block'] = $BlockModel->findAll();

        if(isset($_FILES)){

            $tmpName = $_FILES['file']['tmp_name'];
            $csv_data = $this->xlsx_arr($tmpName);

            $PersonModel = new PersonModel();
            $i = 0;
            $block['statusExport'][] = array('رقم الهوية','الاسم الاول','اسم الاب','اسم الجد','اسم العائلة','المربع السابق إن وجد','الرسالة');
            foreach ($csv_data as $datum){
                $i++;
                if($i == 1){
                    continue;
                }
                if(!$this->CheckId(trim($datum['0']))){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم الهوية خطأ');
                    $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم الهوية خطأ');
                    continue;
                }
                if(isset($datum['8']) && !empty($datum['8']) && !$this->CheckId(trim($datum['8']))){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة خطأ');
                    $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة خطأ');
                    continue;
                }
                if(!empty($datum['8']) && $datum['8'] != 0){
                  $wifi_data = $PersonModel->select("*,person.id as id")->where('pid !=',$datum['0'])->where('wifi_id',$datum['8'])->join('block','block.id = person.block_id')->withDeleted()->first();
                  if(!empty($wifi_data)){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة موجود سابقا لمستفيد اخر');
                    $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة موجود سابقا لمستفيد اخر');
                    continue;
                  }
                  $wifi_data_id = $PersonModel->select("*,person.id as id")->where('pid',$datum['8'])->join('block','block.id = person.block_id')->first();
                  if(!empty($wifi_data_id)){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة موجود سابقا كمستفيد');
                    $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة موجود سابقا كمستفيد');
                    continue;
                  }
                }
                

                
                if($datum['0'] == $datum['8']){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة نفس هوية المستفيد');
                    $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة نفس هوية المستفيد');
                    continue;
                }

                $count = $PersonModel->select("*,person.id as id")->where('pid',$datum['0'])->join('block','block.id = person.block_id')->withDeleted()->first();
                
                if($count){
                    if($types == 2) {
                        $PersonModel->update($count['id'], array(
                            'mob_1' => isset($datum['5']) ? $datum['5'] : '',
                            'mob_2' => isset($datum['6']) ? $datum['6'] : '',
                            'f_num' => isset($datum['7']) ? $datum['7'] : '',
                            'block_id' => $block_id,
                            'wifi_id' => isset($datum['8']) ? $datum['8'] : '',
                            'wifi_name' => isset($datum['9']) ? $datum['9'] : '',
                            'num_mail' => isset($datum['10']) ? $datum['10'] : '',
                            'num_femail' => isset($datum['11']) ? $datum['11'] : '',
                            'f_num_liss_3' => isset($datum['12']) ? $datum['12'] : '',
                            'f_num_ill' => isset($datum['13']) ? $datum['13'] : '',
                            'f_num_sn' => isset($datum['14']) ? $datum['14'] : '',
                            'income' => isset($datum['15']) ? $datum['15'] : '',
                            'home_status' => isset($datum['16']) ? $datum['16'] : '',
                            'note' => isset($datum['17']) ? $datum['17'] : '',
                            'isdelet' => isset($datum['18']) ? $datum['18'] : 0,
                            'isdelet_date' => null
                        ));
                        $block['status'][] = array('id' => $datum['0'], 'fname' => $datum['1'], 'sname' => $datum['2'], 'tname' => $datum['3'], 'lname' => $datum['4'],'old'=>$count['title'] ,'action' => '<a target="_blank" href="' . base_url() . '/person/editPerson/' . $count['id'] . '">تعديل</a>', 'massage' => 'المستفيد مدخل سابقا تم التعديل عليه.');
                        $block['statusExport'][] = array($datum['0'],$datum['1'],$datum['2'],$datum['3'], $datum['4'],$count['title'] , 'المستفيد مدخل سابقا تم التعديل عليه.');
                    }else{
                        $block['status'][] = array('id' => $datum['0'], 'fname' => $datum['1'], 'sname' => $datum['2'], 'tname' => $datum['3'], 'lname' => $datum['4'],'old'=>$count['title'], 'action' => '<a target="_blank" href="' . base_url() . '/person/editPerson/' . $count['id'] . '">تعديل</a>', 'massage' => 'المستفيد مدخل سابقا');
                        $block['statusExport'][] = array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],$count['title'],'المستفيد مدخل سابقا');
                    }
                    continue;
                }
                if(empty($datum['0']) || empty($datum['1']) || empty($datum['2']) || empty($datum['3']) || empty($datum['4']) ){
                    $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'  احد البيانات غر متوفرة.');
                    $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'  احد البيانات غر متوفرة.');
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
                    'wifi_id' => isset($datum['8']) ? $datum['8'] : '',
                    'wifi_name' => isset($datum['9']) ? $datum['9'] : '',
                    'num_mail' => isset($datum['10']) ? $datum['10'] : '',
                    'num_femail' => isset($datum['11']) ? $datum['11'] : '',
                    'f_num_liss_3' => isset($datum['12']) ? $datum['12'] : '',
                    'f_num_ill' => isset($datum['13']) ? $datum['13'] : '',
                    'f_num_sn' => isset($datum['14']) ? $datum['14'] : '',
                    'income' => isset($datum['15']) ? $datum['15'] : '',
                    'home_status' => isset($datum['16']) ? $datum['16'] : '',
                    'note' => isset($datum['17']) ? $datum['17'] : '',
                    'isdelet'=>0
                ));
                $last_insert_id = $PersonModel->getInsertID();
                $PersonModel->delete($last_insert_id);

                $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'تمت الاضافة بنجاح');
                $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','تمت الاضافة بنجاح');
            }
            if(isset($block['statusExport']) && $exportType == 2){
                $exportControler = new exportControler();
                $exportControler->arr_xlsx($block['statusExport'], 'status');
            }else{
                return view('person/csv',$block);
            }
        }

    }


    public function uploadCsv_block(){
      if (!isset($this->session->get('userData')['name'])) {
          return redirect()->to(base_url('login'));
      }
      $types = $this->request->getPost('type_add_or_convert');
      $exportType = $this->request->getPost('exportType');
      $block = array();

      $BlockModel = new BlockModel();
      $block['Block'] = $BlockModel->findAll();

      if(isset($_FILES)){

          $tmpName = $_FILES['file']['tmp_name'];
          $csv_data = $this->xlsx_arr($tmpName);

          $PersonModel = new PersonModel();
          $i = 0;
          $block['statusExport'][] = array('رقم الهوية','الاسم الاول','اسم الاب','اسم الجد','اسم العائلة','المربع السابق إن وجد','الرسالة');
          foreach ($csv_data as $datum){
              $i++;
              if($i == 1){
                  continue;
              }
              if(!$this->CheckId(trim($datum['0']))){
                  $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم الهوية خطأ');
                  $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم الهوية خطأ');
                  continue;
              }


              if(!$this->CheckId(trim($datum['9']))){
                  $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة خطأ');
                  $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة خطأ');
                  continue;
              }

              $wifi_data = $PersonModel->select("*,person.id as id")->where('pid !=',$datum['0'])->where('wifi_id',$datum['9'])->join('block','block.id = person.block_id')->first();
              if(!empty($wifi_data)){
                  $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة موجود سابقا لمستفيد اخر');
                  $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة موجود سابقا لمستفيد اخر');
                  continue;
              }

              $wifi_data_id = $PersonModel->select("*,person.id as id")->where('pid',$datum['9'])->join('block','block.id = person.block_id')->first();
              if(!empty($wifi_data_id)){
                  $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة موجود سابقا كمستفيد');
                  $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة موجود سابقا كمستفيد');
                  continue;
              }
              if($datum['0'] == $datum['9']){
                  $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'رقم هوية الزوجة نفس هوية المستفيد');
                  $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'رقم هوية الزوجة نفس هوية المستفيد');
                  continue;
              }


              $count = $PersonModel->select("*,person.id as id")->where('pid',trim($datum['0']))->join('block','block.id = person.block_id')->withDeleted()->first();
              if($count){
                  if($types == 2) {
                      $PersonModel->update($count['id'], array(
                          'mob_1' => isset($datum['5']) ? $datum['5'] : '',
                          'mob_2' => isset($datum['6']) ? $datum['6'] : '',
                          'f_num' => isset($datum['7']) ? $datum['7'] : '',
                          'block_id' => isset($datum['8']) ? $datum['8'] : 0,

                          'wifi_id' => isset($datum['9']) ? $datum['9'] : '',
                          'wifi_name' => isset($datum['10']) ? $datum['10'] : '',
                          'num_mail' => isset($datum['11']) ? $datum['11'] : '',
                          'num_femail' => isset($datum['12']) ? $datum['12'] : '',
                          'f_num_liss_3' => isset($datum['13']) ? $datum['13'] : '',
                          'f_num_ill' => isset($datum['14']) ? $datum['14'] : '',
                          'f_num_sn' => isset($datum['15']) ? $datum['15'] : '',
                          'income' => isset($datum['16']) ? $datum['16'] : '',
                          'home_status' => isset($datum['17']) ? $datum['17'] : '',
                          'note' => isset($datum['18']) ? $datum['18'] : '',

                          'isdelet'=>0,
                          'isdelet_date'=>''
                      ));
                      $block['status'][] = array('id' => $datum['0'], 'fname' => $datum['1'], 'sname' => $datum['2'], 'tname' => $datum['3'], 'lname' => $datum['4'],'old'=>$count['title'] ,'action' => '<a target="_blank" href="' . base_url() . '/person/editPerson/' . $count['id'] . '">تعديل</a>', 'massage' => 'المستفيد مدخل سابقا تم التعديل عليه.');
                      $block['statusExport'][] = array($datum['0'],$datum['1'],$datum['2'],$datum['3'], $datum['4'],$count['title'] , 'المستفيد مدخل سابقا تم التعديل عليه.');
                  }else{
                      $block['status'][] = array('id' => $datum['0'], 'fname' => $datum['1'], 'sname' => $datum['2'], 'tname' => $datum['3'], 'lname' => $datum['4'],'old'=>$count['title'], 'action' => '<a target="_blank" href="' . base_url() . '/person/editPerson/' . $count['id'] . '">تعديل</a>', 'massage' => 'المستفيد مدخل سابقا');
                      $block['statusExport'][] = array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],$count['title'],'المستفيد مدخل سابقا');
                  }
                  continue;
              }
              if(empty($datum['0']) || empty($datum['1']) || empty($datum['2']) || empty($datum['3']) || empty($datum['4']) ){
                  $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'  احد البيانات غر متوفرة.');
                  $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','massage'=>'  احد البيانات غر متوفرة.');
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
                  'block_id'=>isset($datum['8']) ? $datum['8'] : 0,

                  'wifi_id' => isset($datum['9']) ? $datum['9'] : '',
                  'wifi_name' => isset($datum['10']) ? $datum['10'] : '',
                  'num_mail' => isset($datum['11']) ? $datum['11'] : '',
                  'num_femail' => isset($datum['12']) ? $datum['12'] : '',
                  'f_num_liss_3' => isset($datum['13']) ? $datum['13'] : '',
                  'f_num_ill' => isset($datum['14']) ? $datum['14'] : '',
                  'f_num_sn' => isset($datum['15']) ? $datum['15'] : '',
                  'income' => isset($datum['16']) ? $datum['16'] : '',
                  'home_status' => isset($datum['17']) ? $datum['17'] : '',
                  'note' => isset($datum['18']) ? $datum['18'] : '',

                  'isdelet'=>0
              ));
              // $last_insert_id = $PersonModel->getInsertID();
              // $PersonModel->delete($last_insert_id);

              $block['status'][]=array('id'=>$datum['0'],'fname'=>$datum['1'],'sname'=>$datum['2'],'tname'=>$datum['3'],'lname'=>$datum['4'],'old'=>'','action'=>'','massage'=>'تمت الاضافة بنجاح');
              $block['statusExport'][]=array($datum['0'],$datum['1'],$datum['2'],$datum['3'],$datum['4'],'','تمت الاضافة بنجاح');
          }
          if(isset($block['statusExport']) && $exportType == 2){
              $exportControler = new exportControler();
              $exportControler->arr_xlsx($block['statusExport'], 'status');
          }else{
              return view('person/csv_block',$block);
          }
      }

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

    public function add($chick = 0)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel->findAll();
        $data['chick'] = $chick;
        return view('person/add',$data);
    }
    public function editPerson($id)
    {

        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel->findAll();
        $data['id'] = $id;
        $PersonModel = new PersonModel();
        $data['editData'] = $PersonModel->where('id',$id)->first();
        return view('person/update',$data);
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
            'isdelet'=>$status,
            'isdelet_date'=>null

        ));
        return redirect()->to('person/show');
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

        $count = $PersonModel->where('pid',$id)->withDeleted()->first();
        if($count){
            return redirect()->to('person/add/1');
        }
        if(empty($fname) || empty($sname) || empty($tname) || empty($lname) || empty($block) ){
            return redirect()->to('person/add/2');
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
        $last_insert_id = $PersonModel->getInsertID();
        $PersonModel->delete($last_insert_id);
        return redirect()->to('person/add/3');
    }

    public function uploadFileBlock()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $BlockModel = new BlockModel();
        return view('person/csvBlock');
    }
    public function uploadCsvBlock(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $exportType = $this->request->getPost('exportType');
        $block = array();


        if(isset($_FILES)){

            $tmpName = $_FILES['file']['tmp_name'];
            $csv_data = $this->xlsx_arr($tmpName);

            $PersonModel = new PersonModel();
            $i = 0;
            $block['statusExport'][] = array('رقم الهوية','الرسالة');
            foreach ($csv_data as $datum){
                $i++;
                if($i == 1){
                    continue;
                }

                $count = $PersonModel->where('pid',$datum['0'])->first();
                if($count){
                    $PersonModel->update($count['id'], array(
                        'note' => $count['note'].' '.isset($datum['1']) ? $datum['1'] : '',
                        'isdelet' => 1
                    ));
                    $block['status'][] = array('id' => $datum['0'], 'massage' => 'المستفيد مدخل سابقا تم التعديل عليه.');
                    $block['statusExport'][] = array($datum['0'],'المستفيد مدخل سابقا تم التعديل عليه.');
                    continue;
                }

                $block['status'][]=array('id'=>$datum['0'],'massage'=>'رقم الهوية غير متوفر على النظام.');
                $block['statusExport'][]=array($datum['0'],'رقم الهوية غير متوفر على النظام.');

            }
            if(isset($block['statusExport']) && $exportType == 2){
                $exportControler = new exportControler();
                $exportControler->arr_xlsx($block['statusExport'], 'status');
            }else{
                return view('person/csvBlock',$block);
            }
        }

    }
}
