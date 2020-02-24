<!DOCTYPE html>
<html>
<head>
	<title>Input Pemasukan Buku</title>
</head>
<body>
	<?php
	if($_GET['id_buku']=="") {
		header("location:?menu=data_buku");
	}
		$idbuku = $_GET['id_buku'];
		$qbuku =  mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku='$idbuku'");
		$dbuku = mysqli_fetch_array($qbuku);
	 ?>

	<div class="container">
		<div class="row">			
			<h1>Input Pemasukan Buku</h1>
			<div class="col-md-9">
				<form method="post">
					<div class="form-group">
						<label>Buku</label>
						<input type="text" name="buku" class="form-control" value="<?= $dbuku['judul'] ?>" reqiured readonly>
					</div>

					<div class="form-group">
						<label>Pilih Distributor</label><br>
						<select name="id_distributor" class="form-control">
							<?php 
								$qdis = mysqli_query($conn, "SELECT * FROM tb_distributor");
								while ($ddis = mysqli_fetch_array($qdis)) {
							 ?>
							<option value="<?= $ddis['id_distributor'] ?>">
								<?= $ddis ['nama_distributor'] ?>
							</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Stok Awal</label>
						<input type="number" name="stok" class="form-control" value="<?= $dbuku['stok']; ?>" required readonly>
					</div>					

					<div class="form-group">
						<label>Jumlah Pemasukan</label>
						<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Pemasukan" required >
					</div>

					<div class="form-group">
						<label>Tanggal</label>
						<input type="text" name="tanggal" class="form-control" value="<?= date('d-m-Y') ?>" required readonly>
					</div>

							 
						<button type="submit" name="fsimpan" class="btn btn-primary btn-block">Simpan</button>
						<a class="btn btn-info btn-block" href="?menu=data_buku">Kembali</a>
				</form>
				<?php 
					if(isset($_POST['fsimpan'])) {
						$id_distributor = $_POST['id_distributor'];
						$jumlah = $_POST['jumlah'];
						$tanggal = $_POST['tanggal'];
						$stokupdate = $jumlah + $dbuku['stok'];

						$q = "INSERT INTO tb_pasok 
							(id_distributor, id_buku, jumlah, tanggal)
							VALUES('$id_distributor', '$idbuku', '$jumlah', '$tanggal')
							";
						mysqli_query($conn, $q);
						mysqli_query($conn, "UPDATE tb_buku SET stok='$stokupdate' WHERE id_buku='$idbuku'");
						?>
						<script type="text/javascript">
							alert('Data Berhasil Ditambahkan');
							document.location.href='?menu=data_buku';
						</script>
						<?php 
					}
				 ?>
			</div>
		</div>
	</div>
</body>
</html>