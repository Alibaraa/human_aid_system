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
use App\Models\AreaManagerModel;
use App\Models\GeneralAreaModel;

class AreaManagerControler extends BaseController
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

    public function show()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $AreaManagerModel = new AreaManagerModel();
        $data['Block'] = $AreaManagerModel
            ->select('*,area_manager.title as title,area_manager.id as id,general_area.title as general_area,(select count(*) from block where  block.area_manager_id = area_manager.id) as count')
            ->join('general_area','general_area.id = area_manager.general_area_id')
            ->orderBy('area_manager.id','desc')
            ->findAll();

        return view('AreaManager/index', $data);
    }

    public function add(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $AreaManagerModel = new GeneralAreaModel();
        $data['AreaManager'] = $AreaManagerModel->findAll();
        return view('AreaManager/add',$data);
    }
    public function insert(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $AreaManagerModel = new AreaManagerModel();

        $title = $this->request->getPost('title');
        $p_jawwal = $this->request->getPost('p_jawwal');
        $note = $this->request->getPost('note');
        $m_title = $this->request->getPost('m_title');
        $general_area = $this->request->getPost('general_area');

        $AreaManagerModel->save(array(
            'title'=>$title,
            'mobile'=>$p_jawwal,
            'm_title'=>$m_title,
            'general_area_id'=>$general_area,
            'note'=>$note
        ));
        return redirect()->to('AreaManager/show');
    }
    public function update($id){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $AreaManager = new AreaManagerModel();
        $title = $this->request->getPost('title');
        $p_jawwal = $this->request->getPost('p_jawwal');
        $note = $this->request->getPost('note');
        $m_title = $this->request->getPost('m_title');
        $general_area = $this->request->getPost('general_area');

        $AreaManager->update($id,array(
            'title'=>$title,
            'm_title'=>$m_title,
            'mobile'=>$p_jawwal,
            'general_area_id'=>$general_area,
            'note'=>$note
        ));
        return redirect()->to('AreaManager/show');
    }
    public function edit($id){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $GeneralAreaModel = new GeneralAreaModel();
        $data['AreaManager'] = $GeneralAreaModel->findAll();

        $AreaManagerModel = new AreaManagerModel();
        $data['data'] = $AreaManagerModel->where('id',$id)->first();
        return view('AreaManager/update',$data);
    }
    public function ExportData($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        if(empty($id)){
            exit();
        }
        $PersonModel = new PersonModel();
        $person = $PersonModel->select("*,person.id as p_id,block.title as block_title")
            ->join('block','block.id = person.block_id')
            ->join('area_manager','block.area_manager_id = area_manager.id')
            ->where('area_manager.id = '.$id)
            ->where('person.isdelet',0)
            ->orderBy('block.id','ASC')
            ->orderBy('person.fname','ASC')
            ->orderBy('person.sname','ASC')
            ->orderBy('person.tname','ASC')
            ->orderBy('person.lname','ASC')
            ->findAll();

        $AreaManagerModel = new AreaManagerModel();
        $AreaManagerModel= $AreaManagerModel->where('id ='.$id)->first();

        $filename = $AreaManagerModel['title'];


        $row_head[] = array('#','رقم الهوية','الاسم رباعي' ,'الاسم الاول', ' اسم الاب', 'اسم الجد', 'اسم العائلة', 'الجوال', 'الجوال البديل',  'عدد الافراد', 'اسم التجمع','ملاحظات');
        $i = 1;
        foreach ($person as $line) {
            $row_head[] = array($i,$line['pid'],$line['fname'].' '. $line['sname'].' '. $line['tname'].' '. $line['lname'], $line['fname'], $line['sname'], $line['tname'], $line['lname'], $line['mob_1'], $line['mob_2'], $line['f_num'],$line['block_title'], $line['note']);
            $i++;
        }
        $this->arr_xlsx($row_head, $filename);

        exit();

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


}
