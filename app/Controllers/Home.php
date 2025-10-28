<?php

namespace App\Controllers;
use App\Models\AidManageModel;
use App\Models\BlockModel;
use App\Models\PersonModel;
use App\Models\aidPersonModel;
use App\Models\aidsModel;
use App\Models\donationModel;

use Config\Services;
class Home extends BaseController
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
        if (!isset($this->session->get('userData')['name'])) {
            return redirect()->to(base_url('login'));
        }
        $data = [];
        $person = new PersonModel();
        if($this->session->get('userData')['permissions']!= 3) {

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


            $db = db_connect();
            $persondate = $db->query("SELECT
    month_names.month, COALESCE(COUNT(person.insert_date), 0) AS total_data
FROM
    (SELECT
        DATE_FORMAT(DATE_SUB(NOW(), INTERVAL n MONTH), '%Y-%m') AS month
    FROM
        (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
        UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
        UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) AS months
    ) AS month_names
LEFT JOIN
    person ON DATE_FORMAT(person.insert_date, '%Y-%m') = month_names.month
GROUP BY
    month_names.month
ORDER BY
    month_names.month;")->getResult();

            $data['person_dates'] = $persondate;
            //print_r($persondate);exit();


            $aidPerson_date = $db->query("SELECT
    month_names.month, COALESCE(COUNT(aid_person.insert_date), 0) AS total_data
FROM
    (SELECT
        DATE_FORMAT(DATE_SUB(NOW(), INTERVAL n MONTH), '%Y-%m') AS month
    FROM
        (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
        UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
        UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) AS months
    ) AS month_names
LEFT JOIN aid_person ON DATE_FORMAT(aid_person.insert_date, '%Y-%m') = month_names.month
GROUP BY month_names.month
ORDER BY month_names.month;")->getResult();

            $data['aidPerson_dates'] = $aidPerson_date;

            $home_status = $person->select('
                                          sum(case when home_status = "1" then  1 else  0 end) سيئ,
                                          sum(case when home_status = "2" then  1 else  0 end) جيد,
                                          sum(case when home_status = "3" then  1 else  0 end) ممتاز')
                ->first();
            $data['home_status'] = $home_status;

            $income = $person->select('
                                          sum(case when income = "1" then  1 else  0 end) "لا يعمل",
                                          sum(case when income = "2" then  1 else  0 end) عامل,
                                          sum(case when income = "3" then  1 else  0 end) موظف')
                ->first();
            $data['income'] = $income;
            $data['admin_set'] = 1;
        }else{
            $data['reportAll'] = array();
            $block_id = $this->block_id;
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



            $home_status = $person->select('
                                          sum(case when home_status = "1" then  1 else  0 end) سيئ,
                                          sum(case when home_status = "2" then  1 else  0 end) جيد,
                                          sum(case when home_status = "3" then  1 else  0 end) ممتاز')
                ->whereIn('person.block_id',$block_id)
                ->first();
            $data['home_status'] = $home_status;

            $income = $person->select('
                                          sum(case when income = "1" then  1 else  0 end) "لا يعمل",
                                          sum(case when income = "2" then  1 else  0 end) عامل,
                                          sum(case when income = "3" then  1 else  0 end) موظف')
                ->whereIn('person.block_id',$block_id)
                ->first();
            $data['income'] = $income;

            $data['admin_set'] = 0;
        }
        return view('welcome_message',$data);
    }
}
