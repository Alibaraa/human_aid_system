<?php

namespace App\Models;

class aidPersonModel extends BaseModel
{
    protected $table = 'aid_person';
    protected $primaryKey = 'id';
    protected $allowedFields = ['person_id','aid_manage_id','quantity','status_rec','rec_name','insert_date'];
}

