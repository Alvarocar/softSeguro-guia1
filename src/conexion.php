<?php

$host="localhost";
$user_name="root";
$database="guia1";
$password="admin";
$port="3308";

$con = mysqli_connect($host, $user_name, $password, $database);

if ($con->connect_errno) {
    printf("Conexion fallida: %s\n", $con->connect_error);
}else{
    print("Conexion Exitosa");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

