<?php namespace Auth\Models;

use CodeIgniter\Model;

class userBlockModel extends Model
{
    protected $table = 'user_block';
    protected $primaryKey = 'user_block_id';
    protected $allowedFields = ['user_id', 'block_id'];
}