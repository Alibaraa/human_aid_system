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

class constantsControler extends BaseController
{
    protected $session;
    protected $config;

    public function __construct()
    {
        $this->session = Services::session();
        $this->config = config('Auth');
        if ($this->session->get('userData')['permissions'] != 1) {
            return redirect()->to(base_url('login'));
        }
    }

    public function index()
    {
        exit;
    }

    public function showAids()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $aidsModel = new aidsModel();
        $data['aids'] = $aidsModel->findAll();

        return view('constants/showAids', $data);
    }

    public function showDonation()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $donationModel = new donationModel();
        $data['Donation'] = $donationModel->findAll();

        return view('constants/showDonation', $data);
    }
    public function addAids($tag = 0)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $data = array();
        if($tag == 1){
            $data['success'] = 1;
        }
        return view('constants/addAids',$data);
    }
    public function insertAids()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();

        $name = $this->request->getPost('title');
        $note = $this->request->getPost('note');

        $aidsModel->save(array(
            'name'=>$name,
            'note'=>$note
        ));
        return redirect()->to('constants/add/Aids/1');
    }
    public function addDonation($tag = 0)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $data = array();
        if($tag == 1){
            $data['success'] = 1;
        }
        return view('constants/addDonation',$data);
    }
    public function insertDonation()
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $donationModel = new donationModel();

        $name = $this->request->getPost('title');
        $note = $this->request->getPost('note');

        $donationModel->save(array(
            'name'=>$name,
            'note'=>$note
        ));
        return redirect()->to('constants/add/Donation/1');
    }

    public function editAids($id,$tag = 0)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();
        $data['data'] = $aidsModel->where('id', $id)->first();
        $data['id'] = $id;
        if($tag == 1){
            $data['editsuccess'] = $id;
        }
        return view('constants/editAids', $data);
    }
    public function updateAids($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $aidsModel = new aidsModel();

        $name = $this->request->getPost('title');
        $note = $this->request->getPost('note');

        $aidsModel->update($id,array(
            'name'=>$name,
            'note'=>$note
        ));
        return redirect()->to('constants/edit/Aids/'.$id.'/1');
    }
    public function editDonation($id,$tag=0)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }

        $donationModel = new donationModel();
        $data['data'] = $donationModel->where('id', $id)->first();
        $data['id'] = $id;
        if($tag == 1){
            $data['editsuccess'] = $id;
        }
        return view('constants/editDonation', $data);
    }
    public function updateDonation($id)
    {
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $donationModel = new donationModel();

        $name = $this->request->getPost('title');
        $note = $this->request->getPost('note');

        $donationModel->update($id,array(
            'name'=>$name,
            'note'=>$note
        ));
        return redirect()->to('constants/edit/Donation/'.$id.'/1');
    }


}
