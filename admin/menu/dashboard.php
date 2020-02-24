<!DOCTYPE html>
<html>
<head>
	<title>Halaman Dashboard</title>
</head>
<body>
		<h1>TOKO BUKU</h1>
		<H3>Selamat Datang Di Halaman Admin </H3>	
	<div class="conatiner">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Data Pegawai</h3>
					</div>
					<div class="panel-body">
						<center>
						<h2><span class="glyphicon glyphicon-user"></span>
						<?php 
							$qpeg = mysqli_query($conn, "SELECT * FROM tb_kasir WHERE akses='kasir'");
							$jmh = mysqli_num_rows($qpeg);
							echo $jmh;
						 ?>	
						</h2>	
						</center>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Data Penjualan</h3>
					</div>
					<div class="panel-body">
						<center>
						<h2><span class="glyphicon glyphicon-export"></span>
						<?php 
							$qpeg = mysqli_query($conn, "SELECT * FROM tb_penjualan");
							$jmh = mysqli_num_rows($qpeg);
							echo $jmh;
						 ?>	
						</h2>
						</center>	
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Data Distributor</h3>
					</div>
					<div class="panel-body">
						<center>
						<h2><span class="glyphicon glyphicon-user"></span>
						<?php 
							$qpeg = mysqli_query($conn, "SELECT * FROM tb_distributor");
							$jmh = mysqli_num_rows($qpeg);
							echo $jmh;
						 ?>
						</h2>	
						</center>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Data Buku</h3>
					</div>
					<div class="panel-body">
						<center>
						<h2><span class="glyphicon glyphicon-book"></span>
						<?php 
							$qpeg = mysqli_query($conn, "SELECT * FROM tb_buku");
							$jmh = mysqli_num_rows($qpeg);
							echo $jmh;
						 ?>
						</h2>	
						</center>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Riwayat Pemasukan</h3>
					</div>
					<div class="panel-body">
						<center>
						<h2><span class="glyphicon glyphicon-import"></span>
						<?php 
							$qpeg = mysqli_query($conn, "SELECT * FROM tb_pasok");
							$jmh = mysqli_num_rows($qpeg);
							echo $jmh;
						 ?>
						</h2>	
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>