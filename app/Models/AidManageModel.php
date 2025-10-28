<?php


namespace App\Models;


class AidManageModel extends BaseModel
{
    protected $table = 'aid_manage';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','aids_id', 'donation_id', 'date', 'note'];
}
