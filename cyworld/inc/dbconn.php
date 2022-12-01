<?php

//0. 설정
$mysql_hostname = '127.0.0.1';
$mysql_username = 'root';
$mysql_password = '@spqjdpseld96@';
$mysql_database = 'class';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//1. DB 연결
$dsn = 'mysql:host='.$mysql_hostname.';dbname='.$mysql_database.';port='.$mysql_port.';charset='.$mysql_charset;
try
{
    $connect = new PDO( $dsn, $mysql_username, $mysql_password );
}
catch ( PDOException $e )
{
    echo 'Connect failed : ' . $e->getMessage() . '';
    return false;
}

