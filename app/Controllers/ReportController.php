<?php
namespace App\Controllers;
require_once(APPPATH . "ThirdParty/Mpdf/vendorMpdf/autoload.php");


use App\Models\AidManageModel;
use App\Models\PersonModel;
use App\Models\BlockModel;
use Config\Services;
use Mpdf;
use Mpdf\HTMLParserMode;
use DateTime;

class ReportController extends BaseController
{
    protected $session;
    protected $config;
    public function __construct()
    {
        $this->session = Services::session();
        $this->config = config('Auth');
    }
    public function aid_p($id=''){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new AidManageModel();
        $data['personAid'] = $PersonModel->select("aids.name as aids_name,donation.name as donation_name")
            ->join('aids','aids.id = aid_manage.aids_id')
            ->join('donation','donation.id = aid_manage.donation_id')
            ->where('aid_manage.id',$id)->first();
        if(empty($data['personAid'])){
            exit;
        }

        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select('*,person.id as per_id , aid_person.id as cobon_id')
            ->join('block','block.id = person.block_id')
            ->join('aid_person','aid_person.person_id = person.id')
            ->where('aid_person.aid_manage_id',$id)
            ->where('person.isdelet',0)
            ->orderBy('fname','asc')
            ->orderBy('sname','asc')
            ->orderBy('tname','asc')
            ->orderBy('lname','asc')
            ->findAll();

        ini_set("memory_limit", "512M");
        ini_set("max_execution_time", "20000");

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf(['A4']);

        $mpdf->SetDirectionality('rtl');

        $mpdf->SetTopMargin(40);
        $mpdf->useAdobeCJK = true;

        $imageHeaderPath = base_url('assets/logo.jpg');
        $mpdf->showImageErrors = true;

        if($id == ''){
            $mpdf->WriteHTML("<h1 style='font-family: xbriyaz;'>لا توجد بيانات</h1>");
            $mpdf->Output("aid_P.pdf", 'I');
            exit;
        }

        $header = view('Report/aid_p/header', ['imageHeaderPath' => $imageHeaderPath]);
        $footer = view('Report/aid_p/footer');

        $page = '<html>
            <head>';
        $style = view('Report/style.php');
        $page .= '</head>
        <body>';
        $page .= $header;
        $page .= $footer;

        $page .= view('Report/aid_p/ItemsList.php', $data);
        $page .= '</body>
        </html>';


        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($page);

        // Output a PDF file directly to the browser
        $mpdf->Output("aid_P.pdf", 'I');

        exit;
    }
    public function aid_person($block='',$id=''){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new AidManageModel();
        $data['personAid'] = $PersonModel->select("aid_manage.date as date,aids.name as aids_name,donation.name as donation_name")
            ->join('aids','aids.id = aid_manage.aids_id')
            ->join('donation','donation.id = aid_manage.donation_id')
            ->where('aid_manage.id',$id)->first();
        if(empty($data['personAid'])){
            exit;
        }

        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select('*,person.id as per_id , aid_person.id as cobon_id')
            ->join('block','block.id = person.block_id')
            ->join('aid_person','aid_person.person_id = person.id')
            ->where('aid_person.aid_manage_id',$id)
            ->where('person.isdelet',0)
            ->where('person.block_id',$block)
            ->orderBy('fname','asc')
            ->orderBy('sname','asc')
            ->orderBy('tname','asc')
            ->orderBy('lname','asc')
            ->findAll();

        $BlockModel = new BlockModel();
        $data['block'] = $BlockModel->where('id',$block)->first();

            ini_set("memory_limit", "512M");
        ini_set("max_execution_time", "20000");

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf(['A4']);

        $mpdf->SetDirectionality('rtl');

        $mpdf->SetTopMargin(40);
        $mpdf->useAdobeCJK = true;

        $imageHeaderPath = base_url('assets/logo.jpg');
        $mpdf->showImageErrors = true;

        if($id == '' || $block = ''){
            $mpdf->WriteHTML("<h1 style='font-family: xbriyaz;'>لا توجد بيانات</h1>");
            $mpdf->Output("aid_P.pdf", 'I');
            exit;
        }

        $header = view('Report/aid_person/header', ['imageHeaderPath' => $imageHeaderPath]);
        $footer = view('Report/aid_person/footer');

        $page = '<html>
            <head>';
        $style = view('Report/style.php');
        $page .= '</head>
        <body>';
        $page .= $header;
        $page .= $footer;

        $page .= view('Report/aid_person/ItemsList.php', $data);
        $page .= '</body>
        </html>';


        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($page);

        // Output a PDF file directly to the browser
        $mpdf->Output("aid_person.pdf", 'I');

        exit;
    }

    public function aid_p_person($id=''){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new AidManageModel();
        $data['personAid'] = $PersonModel->select("aid_manage.note as aids_note,aids.name as aids_name,donation.name as donation_name")
            ->join('aids','aids.id = aid_manage.aids_id')
            ->join('donation','donation.id = aid_manage.donation_id')
            ->where('aid_manage.id',$id)->first();
        if(empty($data['personAid'])){
            exit;
        }

        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select('*,person.id as per_id , aid_person.id as cobon_id')
            ->join('block','block.id = person.block_id')
            ->join('aid_person','aid_person.person_id = person.id')
            ->where('aid_person.aid_manage_id',$id)
            ->where('person.isdelet',0)
            ->orderBy('fname','asc')
            ->orderBy('sname','asc')
            ->orderBy('tname','asc')
            ->orderBy('lname','asc')
            ->findAll();

        ini_set("memory_limit", "512M");
        ini_set("max_execution_time", "20000");

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf(['A4']);

        $mpdf->SetDirectionality('rtl');

        $mpdf->SetTopMargin(40);
        $mpdf->useAdobeCJK = true;

        $data['imageHeaderPath'] = base_url('assets/media/logos/sidebarlogo.jpg');
        $mpdf->showImageErrors = true;

        if($id == ''){
            $mpdf->WriteHTML("<h1 style='font-family: xbriyaz;'>لا توجد بيانات</h1>");
            $mpdf->Output("aid_P.pdf", 'I');
            exit;
        }

        //$header = view('Report/aid_p/header', ['imageHeaderPath' => $imageHeaderPath]);
        //$footer = view('Report/aid_p/footer');

        $page = '<html>
            <head>';
        $style = view('Report/style.php');
        $page .= '</head>
        <body>';
        //$page .= $header;
        //$page .= $footer;

        $page .= view('Report/aid_p_person/ItemsList.php', $data);
        $page .= '</body>
        </html>';


        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($page);

        // Output a PDF file directly to the browser
        $mpdf->Output("aid_P.pdf", 'I');

        exit;
    }




    public function block_person($block='',$start=0,$num=0){
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $PersonModel = new PersonModel();
        $data['person'] = $PersonModel->select("*,person.id as p_id")->join('block','block.id = person.block_id')->where('person.block_id',$block)->findAll($num,$start);
        if(empty($data['person'])){
            exit;
        }


        $BlockModel = new BlockModel();
        $data['block'] = $BlockModel->where('id',$block)->first();

        ini_set("memory_limit", "512M");
        ini_set("max_execution_time", "20000");

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf(['A4']);

        $mpdf->SetDirectionality('rtl');

        $mpdf->SetTopMargin(40);
        $mpdf->useAdobeCJK = true;

        $imageHeaderPath = base_url('assets/logo.jpg');
        $mpdf->showImageErrors = true;

        if($block = ''){
            $mpdf->WriteHTML("<h1 style='font-family: xbriyaz;'>لا توجد بيانات</h1>");
            $mpdf->Output("block_person.pdf", 'I');
            exit;
        }

        $header = view('Report/block_person/header', ['imageHeaderPath' => $imageHeaderPath]);
        $footer = view('Report/block_person/footer');

        $page = '<html>
            <head>';
        $style = view('Report/style.php');
        $page .= '</head>
        <body>';
        $page .= $header;
        $page .= $footer;

        $page .= view('Report/block_person/ItemsList.php', $data);
        $page .= '</body>
        </html>';


        $mpdf->WriteHTML($style, 1);
        $mpdf->WriteHTML($page);

        // Output a PDF file directly to the browser
        $mpdf->Output("block_person.pdf", 'I');

        exit;
    }


}