<?php

namespace App\Models;

class PersonModel extends BaseModel
{
    protected $table = 'person';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['pid','fname','sname','tname','lname','mob_1','mob_2','f_num','block_id','wifi_id','wifi_name','num_mail','num_femail','f_num_liss_3','f_num_ill','f_num_sn','income','home_status','note','insert_date','isdelet','isdelet_date'];

    protected $useTimestamps = true;
    protected $createdField = 'insert_date';
    protected $updatedField = 'update_date';
    protected $deletedField = 'isdelet_date';

}
