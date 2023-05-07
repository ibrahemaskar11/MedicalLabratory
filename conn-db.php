<?php
$dbHost="localhost";
$dbUser="root";
$dbPass="";
$dbName="medicallaboratory";

try{
    $conn= new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPass);
}catch(Exception $e){
    echo $e->getMessage();
    exit();
}