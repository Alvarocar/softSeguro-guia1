<?php

$host="mysql";
$user_name="alvaro";
$database="gestion";
$password="alvaro";
$port="3306";

$con = new mysqli($host, $user_name, $password, $database);

if ($con->connect_errno) {
    die("Conexion fallida: ". $con->connect_error);
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

