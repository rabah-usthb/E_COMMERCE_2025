<?php

$userName = getenv("MySql_UserName");

$dbName = getenv("Mysql_DB");
$host = getenv("MySql_Host");
$password = getenv("Mysql_Password");
$dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";


try {
    $pdo;
    $pdo = new PDO($dsn, $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(503);
    include('dbError.php');
    exit;
}

?>