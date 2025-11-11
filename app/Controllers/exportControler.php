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

class exportControler extends BaseController
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
        exit;
    }
    public function filter()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();
        $data['Adis'] = $aidsModel->findAll();

        $donationModel = new donationModel();
        $data['donation'] = $donationModel->findAll();

        $AidManage = new AidManageModel();
        $data['cobone'] = $AidManage->findAll();


        return view('export/filter',$data);
    }
    public function filterExportData()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $fromDate = $this->request->getPost('fromDate');
        $toDate = $this->request->getPost('toDate');
        $cobon_name = $this->request->getPost('cobon_name');
        $Adis = $this->request->getPost('Adis');
        $donation = $this->request->getPost('donation');
        $idsnumber = $this->request->getPost('idsnumber');
        $mod_keys = trim( $idsnumber );
        $pids = explode( "\n", $mod_keys );

        $aidPersonModel = new aidPersonModel();
        $person = new PersonModel();
        $ExitWithAid = array();
        $ExitWithOutAid = array();
        $notExit = array();
        foreach ($pids as $pid){

            $personData = $person->select("*,person.id as p_id")->join('block','block.id = person.block_id')->where('pid',$pid)->first();
            if(!empty($personData)){
                $aidPerson = $aidPersonModel
                    ->select('* , person.note as p_note, aid_manage.title as aid_title
                    , aid_manage.date as aid_date, aid_manage.note as aid_note
                    , aids.name as aids_name, donation.name as donation_name
                    , block.title as block_title, aid_person.insert_date as aid_person_insert_date')
                    ->join('person','person.id = aid_person.person_id')
                    ->join('aid_manage','aid_manage.id = aid_manage_id')
                    ->join('aids','aids.id = aid_manage.aids_id')
                    ->join('donation','donation.id = aid_manage.donation_id')
                    ->join('block','block.id = person.block_id')
                    ->where('aid_person.person_id',$personData['p_id']);
                if(!empty($cobon_name)){
                    $aidPerson->where('aid_manage.id',$cobon_name);
                }
                if(!empty($Adis)){
                    $aidPerson->where('aid_manage.aids_id',$Adis);
                }
                if(!empty($donation)){
                    $aidPerson->where('aid_manage.donation_id',$donation);
                }
                if(!empty($fromDate)){
                    $aidPerson->where('aid_person.insert_date >=', $fromDate.' 00:00:00');
                }
                if(!empty($toDate)){
                    $aidPerson->where('aid_person.insert_date <=', $toDate .' 23:59:59');
                }


                $exitData = $aidPerson->findAll();
                if(!empty($exitData)){
                    foreach ($exitData as $exitDatum) {
                        $ExitWithAid[] = $exitDatum;
                    }
                }else{
                    $ExitWithOutAid[] = $personData;
                }


            }else{
                $notExit[] = array('pid'=>$pid);
            }
        }





        $filename = "export";


        $row_head['أفراد حصلوا على مساعدات'][] = array('رقم الهوية','الاسم الاول',' اسم الاب','اسم الجد','اسم العائلة','الجوال','الجوال البديل','اسم التجمع','الممول' ,'اسم الكوبون','نوع المساعدة','تاريخ الاضافة','تاريخ انشاء الكوبون');
        foreach ($ExitWithAid as $line) {
            $row_head['أفراد حصلوا على مساعدات'][] = array($line['pid'],$line['fname'],$line['sname'],$line['tname'],$line['lname'],$line['mob_1'],$line['mob_2'],$line['p_name'],$line['donation_name'] ,$line['aid_title'],$line['aids_name'],$line['aid_person_insert_date'],$line['date']);
        }



        $row_head['أفراد لم يحصلوا على مساعدات'][] = array('رقم الهوية','الاسم الاول',' اسم الاب','اسم الجد','اسم العائلة','الجوال','الجوال البديل','اسم التجمع');

        foreach ($ExitWithOutAid as $line) {
            $row_head['أفراد لم يحصلوا على مساعدات'][] = array($line['pid'],$line['fname'],$line['sname'],$line['tname'],$line['lname'],$line['mob_1'],$line['mob_2'],$line['p_name']);
        }


        $row_head['غير مسجلين على النظام'][] = array('رقم الهوية');
        foreach ($notExit as $line) {
            $row_head['غير مسجلين على النظام'][] = array($line['pid'],);
        }
        //return redirect()->to('export/filter/pid/data');
        $this->arr_xlsxMultiSheet($row_head, $filename);
        exit();

    }


    public function exportAidsFromPerson($id){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        if(empty($id)){
            exit;
        }

        $PersonModel = new AidManageModel();
        $personAid = $PersonModel->where('id',$id)->first();

        $PersonModel = new PersonModel();
        $person = $PersonModel->select('*,person.id as per_id , aid_person.id as cobon_id')
            ->join('block','block.id = person.block_id')
            ->join('aid_person','aid_person.person_id = person.id')
            ->where('aid_person.aid_manage_id',$id)
            ->where('person.isdelet',0)
            ->findAll();


        $filename = $personAid['title'];

        $row_head[] = array('رقم الهوية','الاسم الاول',' اسم الاب','اسم الجد','اسم العائلة','الجوال','الجوال البديل','عدد الافراد','اسم المربع','مسؤل المربع' ,'جوال مسؤل المربع');
        foreach ($person as $line) {
            $row_head[] = array($line['pid'],$line['fname'],$line['sname'],$line['tname'],$line['lname'],$line['mob_1'],$line['mob_2'],$line['f_num'],$line['title'] ,$line['p_name'],$line['p_mob']);
        }
        $this->arr_xlsx($row_head, $filename);
        exit();
    }




    public function general_report()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();
        $data['Adis'] = $aidsModel->findAll();

        $donationModel = new donationModel();
        $data['donation'] = $donationModel->findAll();

        $AidManage = new AidManageModel();
        $data['cobone'] = $AidManage->findAll();


        return view('export/general_report',$data);
    }

    public function filterExportDataWithoutPid()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $fromDate = $this->request->getPost('fromDate');
        $toDate = $this->request->getPost('toDate');
        $cobon_name = $this->request->getPost('cobon_name');
        $Adis = $this->request->getPost('Adis');
        $donation = $this->request->getPost('donation');

            $aidPersonModel = new aidPersonModel();
            $aidPerson = $aidPersonModel
                ->select('* , person.note as p_note, aid_manage.title as aid_title
                    , aid_manage.date as aid_date, aid_manage.note as aid_note
                    , aids.name as aids_name, donation.name as donation_name
                    , block.title as block_title, aid_person.insert_date as aid_person_insert_date')
                ->join('person','person.id = aid_person.person_id')
                ->join('aid_manage','aid_manage.id = aid_manage_id')
                ->join('aids','aids.id = aid_manage.aids_id')
                ->join('donation','donation.id = aid_manage.donation_id')
                ->join('block','block.id = person.block_id');
            if(!empty($cobon_name)){
                $aidPerson->where('aid_manage.id',$cobon_name);
            }
            if(!empty($Adis)){
                $aidPerson->where('aid_manage.aids_id',$Adis);
            }
            if(!empty($donation)){
                $aidPerson->where('aid_manage.donation_id',$donation);
            }

            if(!empty($fromDate)){
                $aidPerson->where('aid_person.insert_date >=', $fromDate.' 00:00:00');
            }
            if(!empty($toDate)){
                $aidPerson->where('aid_person.insert_date <=', $toDate .' 23:59:59');
            }
            $exitData = $aidPerson->findAll();

            $filename = "export";

            $row_head[] = array('','','','','أفراد حصلوا على مساعدات','','','','' ,'','','','');
            $row_head[] = array('رقم الهوية','الاسم الاول',' اسم الاب','اسم الجد','اسم العائلة','الجوال','الجوال البديل','اسم التجمع','الممول' ,'اسم الكوبون','نوع المساعدة','تاريخ الاضافة','تاريخ انشاء الكوبون');

            foreach ($exitData as $line) {
                $row_head[] = array($line['pid'],$line['fname'],$line['sname'],$line['tname'],$line['lname'],$line['mob_1'],$line['mob_2'],$line['p_name'],$line['donation_name'] ,$line['aid_title'],$line['aids_name'],$line['aid_person_insert_date'],$line['date']);
            }
            $this->arr_xlsx($row_head, $filename);
            exit();

    }

    public function daly_report()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $fromDate = $this->request->getPost('fromDate');
        $toDate = $this->request->getPost('toDate');

        $data['fromDate']=$fromDate;
        $data['toDate']=$toDate;

        if(!empty($fromDate) && !empty($toDate)){
            $PersonModel = new PersonModel();
            $data['data'][]= array('title'=>'عدد المستفيدين المضافين','count'=>$PersonModel
                ->where('person.insert_date >=', $fromDate.' 00:00:00.000000')
                ->where('person.insert_date <=', $toDate .' 23:59:59.000000')
                ->countAllResults());
            $aidPersonModel = new aidPersonModel();
            $data['data'][]= array('title'=>'عدد الكابونات الموزعه','count'=>$aidPersonModel
                ->where('insert_date >=', $fromDate.' 00:00:00.000000')
                ->where('insert_date <=', $toDate .' 23:59:59.000000')
                ->countAllResults());
            //print_r($data);exit();
            $aids = new aidsModel();
            $constants = $aids->findAll();
            $chickes_moal = new AidManageModel();

            foreach ($constants as $cons){
                $chickes = $chickes_moal->select("id")->where('aids_id', $cons['id'])->findAll();
                $val = array();
                if(!empty($chickes)){
                    foreach ($chickes as $chicke) {
                        $val[] = $chicke['id'];
                    }
                    $val = $aidPersonModel
                        ->where('aid_person.insert_date >=', $fromDate.' 00:00:00.000000')
                        ->where('aid_person.insert_date <=', $toDate .' 23:59:59.000000')
                        ->whereIn('aid_person.aid_manage_id',$val)
                        ->countAllResults();
                }else{
                    $val = 0;
                }
                $data['data'][]= array('title'=>$cons['name'],
                    'count'=>$val);
            }
        }

        return view('export/daly_report',$data);
    }


    public function arr_xlsx($results, $name = 'export')
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $writer = new XLSXWriter();
        $writer->writeSheet($results);
        $writer->writeToFile($name.'.xlsx');
        $file = $name.".xlsx";
        ob_end_clean(); // this is solution
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        readfile($file);

    }
    public function arr_xlsxMultiSheet($results, $name = 'export')
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $writer = new XLSXWriter();
        foreach ($results as $key=>$result) {
            $writer->writeSheet($result,$key);
        }
        $writer->writeToFile($name.'.xlsx');
        $file = $name.".xlsx";
        ob_end_clean(); // this is solution
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        readfile($file);

    }
}
