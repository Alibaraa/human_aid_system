<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public $defaultGroup = 'default';

    /**
     * The default database connection.
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com',
        'username' => 'doadmin',
        'password' => 'PUT_NEW_PASSWORD_HERE', // <--- UPDATE THIS AFTER RESETTING ON DIGITALOCEAN
        'database' => 'defaultdb',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => false, // Overwritten in __construct
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 25060,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
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

        $caCertPath = '/tmp/db-ca.crt';

        if (file_exists($caCertPath)) {
            $this->default['encrypt'] = [
                'ssl_key'    => NULL,
                'ssl_cert'   => NULL,
                'ssl_ca'     => $caCertPath,
                'ssl_capath' => NULL,
                'ssl_cipher' => NULL,
                // This is the line that likely fixes the difference 
                // between your raw script and CodeIgniter:
                'ssl_verify' => false 
            ];
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}