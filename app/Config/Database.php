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
     * @var array
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'fajer',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
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
        'DBDebug'  => true,
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

        // Read database configuration from environment variables
        $this->default = [
            'DSN'        => env('database.default.DSN', ''),
            'hostname'   => env('database_default_hostname', 'localhost'), // <-- UPDATE: e.g., source-do-user-12345-0.db.ondigitalocean.com
            'username'   => env('database_default_username', 'doadmin'),                  // <-- UPDATE: Your DigitalOcean DB username (usually 'doadmin')
            'password'   => env('database_default_password', ''),        // <-- UPDATE: Your DigitalOcean DB password
            'database'   => env('database_default_database', 'defaultdb'),            // <-- UPDATE: Your DigitalOcean DB name
            'DBDriver'   => env('database_default_DBDriver', 'MySQLi'),
            'strictOn' => false,

            // *** START SSL CONFIGURATION FOR DIGITALOCEAN ***
            'encrypt'  => [
                'ssl_key'    => null,
                'ssl_cert'   => null,
                // Use realpath() to ensure the correct absolute path to your CA file.
                // The path is relative to the CodeIgniter root (public/index.php).
                // If the cert is in 'app/Database/ca-certificate.crt', the path is correct.
                'ssl_ca'     => realpath(APPPATH . 'Database' . DIRECTORY_SEPARATOR . 'ca-certificate.crt'),
                'ssl_verify' => true // Set to TRUE to enforce server certificate verification
            ],
            // *** END SSL CONFIGURATION ***

            'DBPrefix'   => env('database.default.DBPrefix', ''),
            'pConnect'   => env('database.default.pConnect', false),
            'DBDebug'    => env('database.default.DBDebug', (ENVIRONMENT !== 'production')),
            'charset'    => env('database.default.charset', 'utf8'),
            'DBCollat'   => env('database.default.DBCollat', 'utf8_general_ci'),
            'swapPre'    => env('database.default.swapPre', ''),
            'compress'   => env('database.default.compress', false),
            'strictOn'   => env('database.default.strictOn', false),
            'failover'   => env('database.default.failover', []),
            'port'       => (int) env('database_default_port', 25060), // <-- UPDATE: Use your DO port (e.g., 25060)
        ];


        $this->tests = [
            'DSN'      => env('database.tests.DSN', ''),
            'hostname' => env('database.tests.hostname', '127.0.0.1'),
            'username' => env('database.tests.username', ''),
            'password' => env('database.tests.password', ''),
            'database' => env('database.tests.database', ':memory:'),
            'DBDriver' => env('database.tests.DBDriver', 'SQLite3'),
            'DBPrefix' => env('database.tests.DBPrefix', 'db_'),
            'pConnect' => env('database.tests.pConnect', false),
            'DBDebug'  => env('database.tests.DBDebug', (ENVIRONMENT !== 'production')),
            'charset'  => env('database.tests.charset', 'utf8'),
            'DBCollat' => env('database.tests.DBCollat', 'utf8_general_ci'),
            'swapPre'  => env('database.tests.swapPre', ''),
            'encrypt'  => env('database.tests.encrypt', false),
            'compress' => env('database.tests.compress', false),
            'strictOn' => env('database.tests.strictOn', false),
            'failover' => env('database.tests.failover', []),
            'port'     => (int) env('database.tests.port', 3306),
        ];

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}