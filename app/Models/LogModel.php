<?php

namespace App\Models;


class LogModel extends BaseModel
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['controller', 'method', 'post', 'ip', 'user'];
}
