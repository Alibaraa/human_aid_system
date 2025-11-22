<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /**
     * Database service override to use custom MySQLi connection with SSL support
     */
    public static function database($getShared = true, ?\CodeIgniter\Database\Config $config = null)
    {
        if ($getShared) {
            return static::getSharedInstance('database', $config);
        }

        $config = $config ?? config('Database');
        
        // Register custom MySQLi connection class if SSL is configured
        if (isset($config->default['DBDriver']) && $config->default['DBDriver'] === 'MySQLi') {
            $encrypt = $config->default['encrypt'] ?? false;
            if (is_array($encrypt) && !empty($encrypt['ssl_ca'])) {
                // Register our custom MySQLi connection class before creating connection
                \CodeIgniter\Database\Database::registerDriver('MySQLi', \App\Database\MySQLi\Connection::class);
            }
        }
        
        return parent::database(false, $config);
    }
}
