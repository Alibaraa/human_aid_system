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
        'hostname' => 'localhost',
        'username' => '',
        'password' => '',
        'database' => '',
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
        'port'     => 3306,
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

        // ----------------------------------------------------------
        // 1. DETECT DIGITALOCEAN 'DATABASE_URL'
        // ----------------------------------------------------------
        // DigitalOcean App Platform provides a single long URL string:
        // mysql://user:password@host:port/database
        $dbUrl = getenv('DATABASE_URL');

        if (!empty($dbUrl)) {
            $parsed = parse_url($dbUrl);

            if ($parsed) {
                $this->default['hostname'] = $parsed['host'] ?? $this->default['hostname'];
                $this->default['username'] = $parsed['user'] ?? $this->default['username'];
                $this->default['password'] = $parsed['pass'] ?? $this->default['password'];
                $this->default['database'] = ltrim($parsed['path'] ?? 'defaultdb', '/');
                $this->default['port']     = $parsed['port'] ?? 25060;
            }
        } 
        // ----------------------------------------------------------
        // 2. FALLBACK: Check for Individual ENV Variables
        // ----------------------------------------------------------
        // If DATABASE_URL wasn't found, check if manually set vars exist
        else {
            $this->default['hostname'] = getenv('database_default_hostname') ?: $this->default['hostname'];
            $this->default['username'] = getenv('database_default_username') ?: $this->default['username'];
            $this->default['password'] = getenv('database_default_password') ?: $this->default['password'];
        }

        // ----------------------------------------------------------
        // 3. SSL CONFIGURATION (Crucial for Managed DBs)
        // ----------------------------------------------------------
        $caCertPath = '/tmp/db-ca.crt';

        // If we found the cert file, we enable SSL
        if (file_exists($caCertPath)) {
            $this->default['encrypt'] = [
                'ssl_key'    => NULL,
                'ssl_cert'   => NULL,
                'ssl_ca'     => $caCertPath,
                'ssl_capath' => NULL,
                'ssl_cipher' => NULL,
                'ssl_verify' => false // Keep this false to prevent hostname mismatch errors
            ];
        }

        // ----------------------------------------------------------
        // 4. TESTING ENVIRONMENT OVERRIDE
        // ----------------------------------------------------------
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}