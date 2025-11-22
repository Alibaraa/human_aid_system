<?php

namespace App\Database\MySQLi;

use CodeIgniter\Database\MySQLi\Connection as BaseConnection;

/**
 * Custom MySQLi Connection with SSL Support
 * 
 * This extends CodeIgniter's MySQLi connection to properly handle SSL certificates
 * for DigitalOcean and other SSL-required database connections.
 */
class Connection extends BaseConnection
{
    /**
     * Establish the connection
     *
     * @param bool $persistent
     *
     * @return mixed
     */
    public function connect(bool $persistent = false)
    {
        // Get SSL configuration if available
        $encrypt = $this->encrypt ?? false;
        
        if (is_array($encrypt) && !empty($encrypt['ssl_ca'])) {
            // Initialize mysqli with SSL support
            $this->mysqli = mysqli_init();
            
            if ($this->mysqli === false) {
                throw new \RuntimeException('mysqli_init failed');
            }
            
            // Configure SSL options
            $ssl_ca = $encrypt['ssl_ca'] ?? null;
            $ssl_cert = $encrypt['ssl_cert'] ?? null;
            $ssl_key = $encrypt['ssl_key'] ?? null;
            $ssl_capath = $encrypt['ssl_capath'] ?? null;
            $ssl_cipher = $encrypt['ssl_cipher'] ?? null;
            
            // Set SSL options
            // Note: mysqli_ssl_set returns false on error, but we continue anyway
            // as some SSL options (like just CA cert) may still work
            mysqli_ssl_set(
                $this->mysqli,
                $ssl_key,
                $ssl_cert,
                $ssl_ca,
                $ssl_capath,
                $ssl_cipher
            );
            
            // Set SSL verify server certificate option if specified
            if (isset($encrypt['ssl_verify_server_cert'])) {
                mysqli_options($this->mysqli, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, $encrypt['ssl_verify_server_cert']);
            } elseif (isset($encrypt['ssl_verify']) && !$encrypt['ssl_verify']) {
                // If ssl_verify is false, disable server certificate verification
                mysqli_options($this->mysqli, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
            }
            
            // Real connect with SSL
            $hostname = $this->hostname;
            if ($persistent) {
                $hostname = 'p:' . $hostname;
            }
            
            $connected = mysqli_real_connect(
                $this->mysqli,
                $hostname,
                $this->username,
                $this->password,
                $this->database,
                $this->port ?? 3306,
                $this->socket ?? null,
                MYSQLI_CLIENT_SSL
            );
            
            if (!$connected) {
                $error = mysqli_connect_error();
                $errno = mysqli_connect_errno();
                throw new \RuntimeException("Database connection failed: [{$errno}] {$error}");
            }
            
            // Set charset if specified
            if (!empty($this->charset)) {
                $this->mysqli->set_charset($this->charset);
            }
            
            $this->connID = $this->mysqli;
            
            return $this->connID;
        }
        
        // Fall back to parent connection method if no SSL config
        return parent::connect($persistent);
    }
}

