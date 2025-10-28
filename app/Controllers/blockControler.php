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

class blockControler extends BaseController
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

        $BlockModel = new BlockModel();
        $data['Block'] = $BlockModel
            ->select('*,general_area.title as area_title,block.id as id,block.title as title,area_manager.title as area_manager_title,(select count(*) from person where isdelet = 0 and person.block_id = block.id) as count,(select count(*) from person where isdelet = 1 and person.block_id = block.id) as removecount')
            ->join('area_manager','block.area_manager_id = area_manager.id')
            ->join('general_area','general_area.id = area_manager.general_area_id')
            ->orderBy('area_manager_title','ASC')
            ->orderBy('block.title','ASC')

            ->findAll();

        return view('block/index', $data);
    }
    public function showPerson($id = 0)
    {
        if($id == 0){
            return redirect()->to(base_url(''));
        }
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $blockModel =  new BlockModel();
        $data['block'] = $blockModel->where('id',$id)->first();
        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select("*,person.id as p_id")->join('block','block.id = person.block_id')->where('person.block_id',$id)->orderBy('person.id','desc')->findAll();

        return view('personBlock/showPeson',$data);
    }
    public function add(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $AreaManagerModel =  new AreaManagerModel();
        $data['Block'] = $AreaManagerModel->findAll();
        $GeneralAreaModel =  new GeneralAreaModel();
        $data['GeneralArea'] = $GeneralAreaModel->findAll();
        //print_r($data);exit();
        return view('block/add',$data);
    }
    public function insert(){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $BlockModel = new BlockModel();

        $title = $this->request->getPost('title');
        $p_name = $this->request->getPost('p_name');
        $p_jawwal = $this->request->getPost('p_jawwal');
        $note = $this->request->getPost('note');
        $area_manager = $this->request->getPost('area_manager');

        $limit_num = $this->request->getPost('limit_num');
        $lan = $this->request->getPost('lan');
        $lat = $this->request->getPost('lat');
        $BlockModel->save(array(
            'title'=>$title,
            'p_name'=>$p_name,
            'p_mob'=>$p_jawwal,
            'area_manager_id'=>$area_manager,
            'limit_num'=>$limit_num,
            'lan'=>$lan,
            'lat'=>$lat,
            'note'=>$note
        ));
        return redirect()->to('block/show');
    }
    public function update($id){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $BlockModel = new BlockModel();
        $title = $this->request->getPost('title');
        $p_name = $this->request->getPost('p_name');
        $p_jawwal = $this->request->getPost('p_jawwal');
        $note = $this->request->getPost('note');
        $area_manager = $this->request->getPost('area_manager');

        $limit_num = $this->request->getPost('limit_num');
        $lan = $this->request->getPost('lan');
        $lat = $this->request->getPost('lat');

        $BlockModel->update($id,array(
            'title'=>$title,
            'p_name'=>$p_name,
            'p_mob'=>$p_jawwal,
            'area_manager_id'=>$area_manager,
            'limit_num'=>$limit_num,
            'lan'=>$lan,
            'lat'=>$lat,
            'note'=>$note
        ));
        return redirect()->to('block/show');
    }
    public function edit($id){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $BlockModel = new BlockModel();
        $data['data'] = $BlockModel->where('id',$id)->first();

        $AreaManagerModel =  new AreaManagerModel();
        $data['Block'] = $AreaManagerModel->findAll();
        return view('block/update',$data);
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
        $person = $PersonModel->select("*,person.id as p_id")
            ->join('block','block.id = person.block_id')
            ->where('person.block_id = '.$id)
            ->where('person.isdelet',0)
            ->orderBy('person.fname','ASC')
            ->orderBy('person.sname','ASC')
            ->orderBy('person.tname','ASC')
            ->orderBy('person.lname','ASC')
            ->findAll();

        $BlockModel = new BlockModel();
        $Block= $BlockModel->where('id ='.$id)->first();

        $filename = $Block['title'];


        $row_head[] = array('#','رقم الهوية','الاسم رباعي' ,'الاسم الاول', ' اسم الاب', 'اسم الجد', 'اسم العائلة', 'الجوال', 'الجوال البديل',  'عدد الافراد','تاريخ الاضافة', 'ملاحظات');
        $i = 1;
        foreach ($person as $line) {
            $row_head[] = array($i,$line['pid'],$line['fname'].' '. $line['sname'].' '. $line['tname'].' '. $line['lname'], $line['fname'], $line['sname'], $line['tname'], $line['lname'], $line['mob_1'], $line['mob_2'], $line['f_num'], $line['insert_date'], $line['note']);
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
