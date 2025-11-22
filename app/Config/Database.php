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
     *
     * @var string
     */
	 
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     *
     * @var string
     */
    public $defaultGroup = 'default';

    /**
     * The default database connection.
     *
    /**
     * @var array
     */
     
     //echo WRITEPATH;
     public $default = [
        'DSN'      => '',
        // It is better to use env() so you don't hardcode credentials
        'hostname' => 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com',
        'username' => 'doadmin',
        'password' => 'AVNS_grgEur-BkgLiRlRqB7O', // Update this after changing it in DO
        'database' => 'defaultdb',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false, // Default to false, enable below if cert exists
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 25060, // This is correct for DigitalOcean
    ];
    /**
     * This database connection is used when
     * running PHPUnit database tests.
     *
     * @var array
     */
    public $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
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

        if (file_exists('/tmp/db-ca.crt')) {
         echo 'file exist';
            $this->default['encrypt'] = [
                'ssl_ca'     => '/tmp/db-ca.crt',
                'ssl_verify' => true,
            ];
        } 
        // 2. Fallback: Check for a local file (Local Development)
        elseif (file_exists(WRITEPATH . 'Database/ca-certificate.crt')) {
            echo 'file not exist'; 
            $this->default['encrypt'] = [
                'ssl_ca'     => WRITEPATH . 'Database/ca-certificate.crt',
                'ssl_verify' => true,
            ];
        }
        else{
            echo "file not exist !!!";
        }

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
