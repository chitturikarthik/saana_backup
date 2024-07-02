<?php
$host = "localhost";
$db = "saana_test";
$user = "root";
$pass = "";

try { //mysql
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed:" . $e->getMessage();
}
