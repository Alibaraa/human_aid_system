<?php
namespace App\Models;


class BlockModel extends BaseModel
{
    protected $table = 'block';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'p_name', 'p_mob','area_manager_id','limit_num','lan','lat', 'note'];
}
