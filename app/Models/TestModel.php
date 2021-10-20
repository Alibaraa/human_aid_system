<?php

namespace App\Models;



class TestModel extends BaseModel
{
    protected $table = 'test_table';
    protected $primaryKey = 'id';
    protected $allowedFields = ['test_col1','test_col2'];
}
