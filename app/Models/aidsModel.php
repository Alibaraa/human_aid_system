<?php

namespace App\Models;

class aidsModel extends BaseModel
{
    protected $table = 'aids';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','note'];
}

