<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public $defaultGroup = 'default';

    public $default = [
        'DSN'      => '',
        'hostname' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'DBDriver' => 'MySQLi', // استخدم MySQLi
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => true, // مهم لتفعيل SSL
        'failover' => [],
        'port'     => '',
        'options'  => [
            MYSQLI_CLIENT_SSL => true,
            MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT => false,
        ],
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

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
            return;
        }

        // جلب بيانات الاتصال من Environment
        $this->default['hostname'] = getenv('database_default_hostname');
        $this->default['username'] = getenv('database_default_username');
        $this->default['password'] = getenv('database_default_password');
        $this->default['database'] = getenv('database_default_database');
        $this->default['port']     = getenv('database_default_port');
    }
}
