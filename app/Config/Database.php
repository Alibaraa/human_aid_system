<?php

namespace Config;

use CodeIgniter\Database\Config;
use PDO;

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
        'DBDriver' => 'PDO', // استخدم PDO بدل MySQLi
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => true,
        'failover' => [],
        'port'     => '',
        'options'  => [], // سيتم إعدادها في الـ constructor
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
        $hostname = getenv('database_default_hostname');
        $username = getenv('database_default_username');
        $password = getenv('database_default_password');
        $database = getenv('database_default_database');
        $port     = getenv('database_default_port');

        $this->default['hostname'] = $hostname;
        $this->default['username'] = $username;
        $this->default['password'] = $password;
        $this->default['database'] = $database;
        $this->default['port']     = $port;

        // إعداد DSN لـ PDO
        $this->default['DSN'] = "mysql:host={$hostname};port={$port};dbname={$database};charset=utf8mb4";

        // إعداد خيارات PDO SSL
        $this->default['options'] = [
            PDO::MYSQL_ATTR_SSL_CA => '/tmp/db-ca.crt',   // DigitalOcean يكتب الملف تلقائيًا
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
        ];
    }
}
