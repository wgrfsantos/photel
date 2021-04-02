<?php

require 'environment.php';

$config = array();
if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://localhost/photel/");
    define("BASE_URL_SITE", "http://localhost/photel/");
    define("PATH_SITE", "../photel/");
    $config['dbname'] = 'hpj';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE_URL", "");
    define("BASE_URL_SITE", "");
    define("PATH_SITE", "../");
    $config['dbname'] = '';
    $config['host'] = '';
    $config['dbuser'] = '';
    $config['dbpass'] = '';
}

global $db;
try {
    $db = new PDO(
        "mysql:dbname=" . $config['dbname'] .
        ";host=" . $config['host'],
        $config['dbuser'],
        $config['dbpass'],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
} catch (PDOException $e) {
    echo "ERRO: " . $e->getMessage();
    exit;
}
