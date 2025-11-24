<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public $defaultGroup = 'default';

    public $default = [
        'DSN'      => '',
        'hostname' => 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com',
        'username' => 'doadmin',
        
        // -------------------------------------------------------
        // ضع كلمة المرور الجديدة هنا
        // -------------------------------------------------------
        'password' => 'AVNS_grgEur-BkgLiRlRqB7O', 
        
        'database' => 'defaultdb',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => false, 
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 25060,
    ];

    public $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        parent::__construct();
        //
        $caCertPath = '/tmp/db-ca.crt';

        if (file_exists($caCertPath)) {
            // هنا التعديل ليتطابق مع السكربت الناجح تماماً
            $this->default['encrypt'] = [
                'ssl_key'    => NULL,
                'ssl_cert'   => NULL,
                'ssl_ca'     => $caCertPath,
                'ssl_capath' => NULL,
                'ssl_cipher' => NULL,
                'ssl_verify' => TRUE
                // قمنا بحذف ssl_verify لأن السكربت الناجح لم يستخدمها
            ];
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}