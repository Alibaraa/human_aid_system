<?php
namespace App\Models;

class usersModel extends BaseModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'new_email', 'password_hash', 'name', 'activate_hash', 'reset_hash', 'reset_expires', 'active', 'permissions', 'block_id', 'created_at', 'updated_at'];
}
