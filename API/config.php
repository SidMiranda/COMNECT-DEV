<?php

$db_host = 'localhost';
$db_name = 'ws_scope_pay';
$db_user = 'root';
$db_pass = 'Telecom02#';

$pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);

$array = [
    'error' => '',
    'result' => []
];