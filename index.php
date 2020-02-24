<?php 
include "inc/koneksi.php";
session_start();
  if(@$_SESSION['userweb']!="") {
    if($_SESSION['level']=="admin") {
        header("location: admin/index.php");
    } else if($_SESSION['level']=="kasir") {
        header("location: kasir/index.php");
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Log In Dulu</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <center>
      <div class="col-md-5 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2><span class="glyphicon glyphicon-book " aria-hidden="true"></span>  Toko Buku Kami</h2>
            <h3>Log In System</h3>
            <p><span class="glyphicon glyphicon-road" aria-hidden="true"></span> Jl. Jepara-Bangsri KM 12</p>
            <p><span class="glyphicon glyphicon-phone-alt" ></span>  0895359844118</p>
          </div>
          <div class="panel-body">
            <div class="alert alert-success">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              masukkan username dan password dengan benar !
            </div>
            <div class="col-md-11">
              <form method="post">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Username</span>
                  <input type="text" class="form-control" name="user" placeholder="Username" aria-describedby="basic-addon1" required>
                </div>
                <br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Password</span>
                  <input type="password" class="form-control" name="pass" placeholder="password" aria-describedby="basic-addon1" required>
                </div>
                <br>
                </div>
                <button class="btn btn-block btn-primary btn-lg" name="flogin">Login</button>
              </form>

              <?php 
                  if( isset($_POST['flogin']) ) {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];

                    $qlogin= mysqli_query($conn, "SELECT * FROM tb_kasir WHERE username='$user' AND password=md5('$pass')");
                    $cek = mysqli_num_rows($qlogin);
                    $data = mysqli_fetch_array($qlogin);
                    if($cek < 1) {
                      ?>
                      <br>
                      <div class="alert alert-danger">
                        Maaf Username atau Password salah
                      </div>
                      <?php 
                    } else {
                      if($data['status']=="nonaktif") {
                        ?>
                        <br>
                        <div class="alert alert-danger">
                          Maaf username Anda Nonaktif
                        </div>
                        <?php  
                      } else if($data['status']=="aktif") {
                        $_SESSION['userweb']=$data['id_kasir'];
                        $_SESSION['level']=$data['akses'];
                        if ($data['akses']=="admin") {
                          header("location: admin/index.php");
                        } else if($data['akses']=="kasir") {
                          header("location: kasir/index.php");
                        }
                      }                      
                    } 
                  }

               ?>

          </div>
        </div>
      </div>
    </center>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
