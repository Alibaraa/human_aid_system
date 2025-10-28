<?php
namespace App\Models;


class AreaManagerModel extends BaseModel
{
    protected $table = 'area_manager';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'mobile','m_title', 'note'];
}
