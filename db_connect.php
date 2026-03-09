<?php

require_once "env_loader.php";

$host = $_ENV['DB_HOST'];
$db   = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'] ;
$pass = $_ENV['DB_PASS'];

try{

$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

die("Connection failed: " . $e->getMessage());

}

?>