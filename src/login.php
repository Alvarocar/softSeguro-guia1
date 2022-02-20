<?php
  require_once('conexion.php');
  session_start();
  
  if (isset($_SESSION['session_username'])) {
    header('Location: index.php');
  }
  ?>

<?php 
  $message = '';

  function valid_fields($data) {
    if (empty($data['email']) && empty($data['pass'])) {
      return false;
    }
    return true;
  }

  function find_user($email, $pass) {
    global $con;
    $pass = md5($pass);
    return $con->query("SELECT u.username FROM user as u WHERE u.email='". $email."' AND u.password='". $pass."'");
  }

  function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
  }

  function login() {
    global $message;

    if(!valid_fields($_POST)) {
      $message = 'Debe diligenciar todos los campos';
      return ;
    }
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $result = find_user($email, $pass);
    $numrows = mysqli_num_rows($result);

    if ($numrows <= 0) {
      $message = 'El correo o la contraseña no coinciden';
      return ;
    }

    while($row = $result->fetch_assoc()) {
      $_SESSION['session_username'] = $row['username'];
    }
    $message = '';
    redirect('index.php');
  }
?>

<?php 
  if(isset($_POST['login'])) {
    login();
  }
?>

<html>

<head>
  <meta charset="UTF-8">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <main class="row pt-5">
    <form class="col-4 offset-4 border p-3 pb-4 rounded d-grid gap-3" action="login.php" method="post">
      <fieldset class="d-grid gap-2">
        <legend>Login</legend>
        <section class="d-grid gap-4">
          <input name="email" placeholder="Correo" type="email" class="form-control">
          <input name="pass" placeholder="Contraseña" type="password" class="form-control">
        </section>
      </fieldset>
      <button class="btn btn-info p-2" type="submit" name="login">Ingresar</button>
      <a href="register.php">¿No tienes una cuenta? Creala aqu&iacute;</a>
      <?php if (!empty($message)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $message ?>
        </div>
      <?php
      } 
      ?>
    </form>
  </main>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1">
    <div id="liveToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body">
        Cuenta Creada
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <?php
  if (isset($_SESSION['account_created'])) {
  
  ?>
    <script>
      const toast = new bootstrap.Toast(document.getElementById('liveToast'))
      toast.show()
    </script>
  <?php
    unset($_SESSION['account_created']);
  } ?>
</body>

</html>