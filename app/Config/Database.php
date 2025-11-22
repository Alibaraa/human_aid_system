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
        'DBDriver' => 'MySQLi',
        'port'     => '',
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'encrypt'  => true,
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

        // إذا نشتغل على environment الاختبارية
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

        // إعداد SSL بطريقة آمنة بدون constants
        $this->default['options'] = [
            'ssl_key' => null,
            'ssl_cert' => null,
            'ssl_ca' => '/tmp/db-ca.crt',          // ← DigitalOcean App Platform يكتب هذا الملف تلقائيًا
            'ssl_capath' => null,
            'ssl_cipher' => null,
            'ssl_verify_server_cert' => true,
        ];
    }
}
