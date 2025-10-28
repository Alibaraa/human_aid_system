<?php

namespace App\Models;

class userBlockModel extends BaseModel
{
    protected $table = 'user_block';
    protected $primaryKey = 'user_block_id';
    protected $allowedFields = ['user_id', 'block_id'];
}

