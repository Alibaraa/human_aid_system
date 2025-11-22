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
        // ------------------------------------------------------------------
        // هام جداً: نضع الرابط الطويل هنا بدلاً من localhost
        // لتجنب خطأ Error 2002 (Socket connection)
        // ------------------------------------------------------------------
        'hostname' => 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com',
        'username' => 'doadmin',
        'password' => 'AVNS_grgEur-BkgLiRlRqB7O', // سيتم تعبئتها تلقائياً من الكود بالأسفل أو ضع الباسوورد الجديد هنا
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
        'port'     => 25060, // البورت الخاص بـ DigitalOcean
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

        // 1. محاولة جلب البيانات من DATABASE_URL (من DigitalOcean)
        $dbUrl = getenv('DATABASE_URL');

        if (!empty($dbUrl)) {
            $parsed = parse_url($dbUrl);
            if ($parsed) {
                // إذا وجدنا بيانات في البيئة، نستخدمها لتحديث الإعدادات
                $this->default['hostname'] = $parsed['host'] ?? $this->default['hostname'];
                $this->default['username'] = $parsed['user'] ?? $this->default['username'];
                $this->default['password'] = $parsed['pass'] ?? $this->default['password'];
                $this->default['database'] = ltrim($parsed['path'] ?? 'defaultdb', '/');
                $this->default['port']     = $parsed['port'] ?? 25060;
            }
        }

        // 2. إعدادات SSL الضرورية (CA Certificate)
        $caCertPath = '/tmp/db-ca.crt';

        if (file_exists($caCertPath)) {
            $this->default['encrypt'] = [
                'ssl_key'    => NULL,
                'ssl_cert'   => NULL,
                'ssl_ca'     => $caCertPath,
                'ssl_capath' => NULL,
                'ssl_cipher' => NULL,
                'ssl_verify' => false // هام جداً لتجنب مشاكل تطابق الاسم
            ];
        }

        // 3. ضمان بيئة الاختبار
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}