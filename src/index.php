<?php
    session_start();
    if (!isset($_SESSION["session_username"])) {
        header("location:login.php");
    } else {
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>Software Seguro</title>
    </head>
    <body>
            <div id="welcome">
                <h2>Bienvenido, <span><?php echo $_SESSION['session_username'] ?>!</span></h2>
                <p><a>Finalice</a> sesión</p>
            </div>
    </body>
</html>

<?php
    }
 ?>
