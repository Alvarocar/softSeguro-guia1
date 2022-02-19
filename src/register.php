<?php  require_once("conexion.php");
  session_start();
  
  if (isset($_SESSION['session_username'])) {
    header('Location: index.php');
  }
?>

<?php 
  
  $message = '';

  function no_empty_fielts($data) {
    if (empty($data['fullname']) || empty($data['email']) 
    || empty($data['username']) || empty($data['password'])) {
      return false;
    }
    return true;
  }

  function search_by_email($con, $email) {
    return mysqli_query($con, "SELECT u.email FROM user as u WHERE u.email='" . $email . "'");
  }

  function insert_register($con, $fullname, $username, $email, $password) {
    $sql = "INSERT INTO user (fullname, username, email, password) VALUES ('". $fullname."','".$username."','".$email."','".$password."' )";
    return mysqli_query($con, $sql);
  }

  function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
  }

  function complete_register() {
    $_SESSION['account_created'] = 'created';
    redirect('login.php');
  }

  function register_user($con) {
    global $message;
    if (!no_empty_fielts($_POST)) {
      $message = "Todos los campos se deben diligenciar";
      return ;
    }
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $result = search_by_email($con, $email);
    $numrows = mysqli_num_rows($result);
    if ($numrows > 0) {
      $message = 'El correo seleccionado ya se encuentra registrado';
      return ;
    }
    if (!insert_register($con, $fullname, $username, $email, $password)) {
      $message = "No se pudo insertar los datos ingresados";
      return ;
    }
    $message = '';
    complete_register();
  }
?>

<?php
if (isset($_POST["register"])) {
  register_user($con);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Registro</title>
</head>
<body>
  <main class="row pt-5">
    <form class="col-4 offset-4 border p-3 pb-4 rounded d-grid gap-3" action="register.php" method="post">
      <fieldset class="d-grid gap-2">
        <legend>Registro</legend>
        <section class="d-grid gap-4">
          <input name="fullname" type="text" class="form-control" placeholder="Nombre Completo">
          <input name="username" type="text" class="form-control" placeholder="Nombre de usuario">
          <input name="email" type="email" class="form-control" placeholder="Correo">
          <input name="password" type="password" class="form-control" placeholder="Contraseña">
        </section>
      </fieldset>
      <input name="register" value="Registrarse" class="btn btn-info p-2" type="submit">
      <a href="login.php">¿Ya tienes una cuenta?, Ingresa aqui!</a>
      <?php if (!empty($message)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $message ?>
        </div>
      <?php
      } 
      ?>
    </form>
  </main>

  
</body>
</html>

