<?php

$server = 'localhost';
$user = 'root';
$password = '';
$databaseName = 'blog';
$port = 3307;
$conn = mysqli_connect($server, $user, $password, $databaseName, $port);
if (!$conn) {
    echo "Connection Failed";
}else{
    //echo "Connected Successfully";
}