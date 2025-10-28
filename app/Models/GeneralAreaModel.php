<?php
namespace App\Models;

class GeneralAreaModel extends BaseModel
{
    protected $table = 'general_area';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'note'];
}

