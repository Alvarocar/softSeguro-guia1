<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Software Seguro</title>
        <?php session_start();?>
    </head>
    <body>
        <?php
            if (!isset($_SESSION["session_username"])) {
                header("location:login.php");
            } else {
                ?>
            <div id="welcome">
                <h2>Bienvenido, <span><?php echo $_SESSION['session_username'] ?>!</span></h2>
                <p><a>Finalice</a> sesión</p>
            </div>
            <?php
           }
        ?>
    </body>
</html>
