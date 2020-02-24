<?php 
include "../inc/koneksi.php";
session_start();
if($_SESSION['userweb']=="") {
  header("location: ../index.php");
}
if($_SESSION['level']=="admin") {
  header("location: ../admin/index.php");
}
$qprofil = mysqli_query($conn, "SELECT * FROM tb_kasir WHERE id_kasir='$_SESSION[userweb]'");
$profil = mysqli_fetch_array($qprofil);
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

    <title>Halaman Kasir</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/admin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">TOKO BUKU -- KASIR (<?= $profil['nama']; ?>)</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Dashboard</a></li>            
            <li><a href="?menu=profil">Profile</a></li>            
          </ul>         
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">          
          <ul class="nav nav-sidebar">
            <?php 
              @$menu = $_GET['menu'];
             ?>
            <li <?php if($menu=="") {echo "class='active'";} ?>><a href="index.php">Home</a></li>
            <li <?php if($menu=="data_penjualan") {echo "class='active'";} ?>><a href="?menu=data_penjualan">Data / Laporan Penjualan</a></li>            
            <li <?php if($menu=="input_penjualan") {echo "class='active'";} ?>><a href="?menu=input_penjualan">Input Penjualan</a></li>            
          </ul>          
          <ul class="nav nav-sidebar">
            <li class="active"><a onclick="return confirm('Anda akan keluar!')" href="../inc/keluar.php"><span class="glyphicon glyphicon-log-out"></span>  KELUAR <span class="sr-only">(current)</span></a></li>

          </ul>  
        </div>
        <!-- bagian konten -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php 
            error_reporting(0);
            switch($_GET['menu']){              

              case 'data_penjualan':
              include "menu/data_penjualan.php";
              break;

              case 'input_penjualan':
              include "menu/input_penjualan.php";
              break;                                          

              case 'jual':
              include "menu/jual.php";
              break;

              case 'hapus_penjualan': $id = $_GET['id_penjualan'];
              mysqli_query($conn, "DELETE FROM tb_penjualan WHERE id_penjualan='$id'");
              include "menu/data_penjualan.php";
              break;

              case 'profil':
              include "menu/profil.php";
              break;

              case 'hapus_ker':
              $id_buku = $_GET['id_buku'];
              $id_keranjang = $_GET['id_keranjang'];
              $jumlah = $_GET['jumlah'];
              $qbuku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku='$id_buku'");
              $buku = mysqli_fetch_array($qbuku);
              $updatestok = $buku['stok'] + $jumlah;
              mysqli_query($conn, "UPDATE   tb_buku SET stok='$updatestok' WHERE id_buku='$id_buku'");
              mysqli_query($conn, "DELETE FROM tb_keranjang WHERE id_keranjang='$id_keranjang'");
              include "menu/input_penjualan.php";
              break;

              case 'selesai':
              mysqli_query($conn, "truncate table tb_keranjang");
              include "menu/input_penjualan.php";
              break;

              case 'load_buku':
              include "menu/load_buku.php";
              break;

              case 'detail':
              include "menu/detail.php";
              break;

              default:
              include "menu/dashboard.php";
              break;
          }
          ?>        
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
