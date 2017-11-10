<?php
require_once 'config.php';
require_once 'function.php';

session_start();

$isConnected = false;
$isPremium = true;
$isAdmin = true;

$dsn = "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['name'] . ";charset=utf8";
$db = new PDO( $dsn, $dbConfig['user'], $dbConfig['pass'] );


if( $page['premium'] && !$isPremium ){
    header('Location: premium.php');
    exit();
}

if( $page['admin'] && !$isAdmin ){
    echo "Vous devez être admin pour accéder a cette section";
    exit();
}
