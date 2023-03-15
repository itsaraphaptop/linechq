<?php
$info = array(
    'host' => '134.209.98.84',
    'user' => 'root',
    'port' => '3306',
    'password' => 'Mc5s7140',
    'dbname' => 'private_job'
);
$conn = mysqli_connect($info['host'], $info['user'], $info['password'], $info['dbname']) or die('Error connection database!');
mysqli_set_charset($conn, 'utf8');
?>
