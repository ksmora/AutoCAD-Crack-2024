<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		$id = $_GET['id_buku'];
		$qbuku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku='$id'");
		$data = mysqli_fetch_array($qbuku);
	 ?>
	<h1>Penjualan</h1>
	<div class="row">
		<div class="col-md-5">
			<form method="post" class="form-horizontal">
				<label>Buku</label>
				<input class="form-control" type="text" name="" value="<?= $data['judul']; ?>" readonly>
				<label>Stok</label>
				<input class="form-control" type="text" name="" value="<?= $data['stok']; ?>" readonly>
				<label>Harga</label>
				<input class="form-control" type="text" name="" value="<?= $data['harga_pokok']; ?>" readonly>
				<label>Jumlah</label>
				<input class="form-control" type="number" name="jumlah" placeholder="Jumlah Penjualan">
				<label>Uang Pelanggan</label>
				<input class="form-control" type="number" name="uang" placeholder="Uang Pelanggan">
				<br>
				<button class="btn btn-success btn-block" name="proses">Proses</button>
				<a class="btn btn-block btn-warning" href="?menu=input_penjualan">Batal</a>
			</form>
			<?php 
				if(isset($_POST['proses'])) {
					$id_kasir = $profil['id_kasir'];
					$jumlah = $_POST['jumlah'];
					$uang = $_POST['uang'];
					$tanggal = date('Y-m-d');
					$total = $jumlah * $data['harga_pokok'];
					$kembali  = $uang - $total;
					$stokupdate = $data['stok'] - $jumlah;

					mysqli_query($conn, "INSERT INTO tb_penjualan (id_buku, id_kasir, jumlah, total, tanggal)
											VALUES 
											('$id', '$id_kasir', '$jumlah', '$total', '$tanggal')
											");
					mysqli_query($conn, "UPDATE tb_buku SET stok='$stokupdate' WHERE id_buku='$id'");
					?>
				</div>
				<div class="col-md-5">
					<table class="table table-bordered">
					<tr>
						<th>Total Bayar :</th><td><h4>Rp.<?= $total; ?></h4></td>
					</tr>
					<tr>
						<th>Uang Bayar :</th><td><h4>Rp.<?= $uang; ?></h4></td>
					</tr>
					<tr>
						<th>Uang Kembali :</th><td><h4>Rp.<?= $kembali; ?></h4></td>
					</tr>
					</table>
					<a class="btn btn-sm btn-success" href="?menu=data_penjualan">SELESAI</a>
					<a class="btn btn-primary" href="">	<span class="glyphicon glyphicon-print"></span></a>
				</div>
					<?php 
				}
			 ?>
		</div>
	</div>

</body>
</html>