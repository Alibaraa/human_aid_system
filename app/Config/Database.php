<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public $defaultGroup = 'default';

    /**
     * The default database connection.
     * ---------------------------------------------------------
     * هنا سنضع البيانات بشكل إجباري (Hardcoded)
     * ---------------------------------------------------------
     */
    public $default = [
        'DSN'      => '',
        
        // 1. رابط الهوست الطويل (انسخه كما هو من لوحة التحكم)
        'hostname' => 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com',
        
        // 2. اسم المستخدم
        'username' => 'doadmin',
        
        // 3. كلمة المرور (اكتبها هنا مباشرة)
        // تأكد أنك قمت بتغييرها في DigitalOcean وضع الجديدة هنا
        'password' => 'AVNS_grgEur-BkgLiRlRqB7O',
        
        // 4. اسم قاعدة البيانات (ثابت)
        'database' => 'defaultdb',
        
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre'  => '',
        'encrypt'  => false, // لا تغيرها هنا، سيتم تفعيلها في الأسفل
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        
        // 5. البورت (ثابت)
        'port'     => 25060,
    ];

    /**
     * This database connection is used when running PHPUnit database tests.
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

        // ---------------------------------------------------------------------
        // تم حذف كود استدعاء getenv('DATABASE_URL') بالكامل.
        // الآن الكود مجبر على استخدام البيانات المكتوبة بالأعلى.
        // ---------------------------------------------------------------------

        // الشيء الوحيد الذي نحتاجه ديناميكياً هو ملف الشهادة
        // لأن مكانه ثابت داخل سيرفر DigitalOcean
        $caCertPath = '/tmp/db-ca.crt';

        if (file_exists($caCertPath)) {
            $this->default['encrypt'] = [
                'ssl_key'    => NULL,
                'ssl_cert'   => NULL,
                'ssl_ca'     => $caCertPath,
                'ssl_capath' => NULL,
                'ssl_cipher' => NULL,
                'ssl_verify' => false // ضروري جداً لتجاهل خطأ اسم الهوست
            ];
        }

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}