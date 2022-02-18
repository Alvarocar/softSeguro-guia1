<?php require_once("conexion.php"); ?>

<?php
if (isset($_POST["register"])) {
  if (!empty($_POST['fullname']) && !empty($_POST['email']) 
      && !empty($_POST['username']) && !empty($_POST['password'])) {
      $full_name = $_POST['fullname'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      $result = mysql_query("SELECT u.email FROM user as u WHERE u.username='" + $username + "'");
  }
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

