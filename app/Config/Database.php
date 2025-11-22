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
        'DBDriver' => 'MySQLi', // استخدم MySQLi الطبيعي
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => false, // نستخدم SSL عبر mysqli_ssl_set
        'failover' => [],
        'port'     => '',
        'options'  => [],
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

        // إعدادات SSL
        $sslCertFile = '/tmp/db-ca.crt';
        if (file_exists($sslCertFile)) {
            mysqli_ssl_set(
                null,    // key
                null,    // cert
                $sslCertFile,  // CA
                null,    // capath
                null     // cipher
            );
            echo 'file is exist';
        }
    }
}
//
