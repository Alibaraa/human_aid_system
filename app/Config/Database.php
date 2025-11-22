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

        // Configure SSL certificate for DigitalOcean MySQL connection
        // Priority: 1. /tmp/db-ca.crt or /tmp/ca-certificate.crt (DigitalOcean App Platform)
        //          2. app/Database/ca-certificate.crt (Local development)
        
        $caCertPath = null;
        
        // Check for certificate in /tmp (DigitalOcean App Platform) - try both possible filenames
        if (file_exists('/tmp/db-ca.crt') && is_readable('/tmp/db-ca.crt')) {
            $caCertPath = '/tmp/db-ca.crt';
        }
        elseif (file_exists('/tmp/ca-certificate.crt') && is_readable('/tmp/ca-certificate.crt')) {
            $caCertPath = '/tmp/ca-certificate.crt';
        }
        // Fallback: Check for certificate in app/Database (Local development)
        elseif (file_exists(APPPATH . 'Database' . DIRECTORY_SEPARATOR . 'ca-certificate.crt') 
                && is_readable(APPPATH . 'Database' . DIRECTORY_SEPARATOR . 'ca-certificate.crt')) {
            $caCertPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR . 'ca-certificate.crt';
        }
        
        // Enable SSL if certificate file exists
        // CodeIgniter 4 MySQLi expects SSL options in this format
        if ($caCertPath !== null) {
            $this->default['encrypt'] = [
                'ssl_ca' => $caCertPath,
                'ssl_verify' => false, // Set to false to skip certificate verification
            ];
            
            // Register custom MySQLi connection class for SSL support
            if ($this->default['DBDriver'] === 'MySQLi') {
                \CodeIgniter\Database\Database::registerDriver('MySQLi', \App\Database\MySQLi\Connection::class);
            }
        }

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
