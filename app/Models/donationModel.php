<?php
namespace App\Models;

class donationModel extends BaseModel
{
    protected $table = 'donation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'note'];
}

