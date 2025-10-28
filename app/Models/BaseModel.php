<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    //protected $afterInsert = ['afterInsert'];
    //protected $afterUpdate = ['afterUpdate'];
    //protected $afterDelete = ['afterDelete'];
    //private $source = 'models';
    public $dbo;
    public function __construct(?ConnectionInterface &$db = null, ?ValidationInterface $validation = null)
    {
        
        parent::__construct($validation);
    }
    protected function afterInsert(array $data)
    {
        //$log_obj = service('Log');
        //$log_obj->active_logs($this->table, $data['id'], ConstantManager::getConstantIdByConstantKey('log_table_insert'),$this->source);
        //$this->active_logs($this->table, $data['id'], 9);
    }
    protected function afterUpdate(array $data)
    {
        //$log_obj = service('Log');
        //$log_obj->active_logs($this->table, $data['id'], ConstantManager::getConstantIdByConstantKey('log_table_update'),$this->source);
        //$this->active_logs($this->table, $data['id'], 11);
    }
    protected function afterDelete(array $data)
    {
        //$log_obj = service('Log');
        //$log_obj->active_logs($this->table, $data['id'], ConstantManager::getConstantIdByConstantKey('log_table_delete'),$this->source);
        //$this->active_logs($this->table, $data['id'], 10);
    }
}
