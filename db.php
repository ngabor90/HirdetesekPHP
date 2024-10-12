<?php

function dbInit(){
    $servername = "mysql.rackhost.hu";
    $username = "c53281phpaprohir";
    $password = "OzzyMotorhead666";
    $dbname = "c53281phpaprohirdetesek";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}