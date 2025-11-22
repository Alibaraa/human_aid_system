<?php
$hostname = 'db-mysql-sfo3-22518-do-user-28239552-0.f.db.ondigitalocean.com';
$username = 'doadmin';
$password = 'AVNS_grgEur-BkgLiRlRqB7O'; // Warning: Rotate this password immediately after fixing!
$database = 'defaultdb';
$port     = 25060;
$ssl_ca   = '/tmp/db-ca.crt';

$mysqli = mysqli_init();

if (!$mysqli) {
    die("mysqli_init failed");
}

// Configure SSL
// Arguments: key, cert, ca, capath, cipher
$mysqli->ssl_set(NULL, NULL, $ssl_ca, NULL, NULL);

// Try to connect
// Note: The flag MYSQLI_CLIENT_SSL is important
if (!$mysqli->real_connect($hostname, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connect Error: " . mysqli_connect_error());
}

echo "Success! Connected to DigitalOcean via SSL.";
$mysqli->close();