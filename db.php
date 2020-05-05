<?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=radiostation;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $con = new PDO($dsn, $user, $password);
    echo "";
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>