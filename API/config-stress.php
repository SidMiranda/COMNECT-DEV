<?php

$db_host = 'localhost';
$db_name = 'stress';
$db_user = 'root';
$db_pass = 'Telecom02#';

$pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);

$array = [
    'error' => '',
    'result' => []
];