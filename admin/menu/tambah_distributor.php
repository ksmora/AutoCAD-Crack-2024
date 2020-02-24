<!DOCTYPE html>
<html>
<head>
	<title>Tambah Distributor</title>
</head>
<body>
	<div class="container">
		<div class="row">			
			<h1>Tambah Distributor</h1>
			<div class="col-md-8">
				<form method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" reqiured>
					</div>

					<div class="form-group">
						<label>Alamat</label><br>
						<textarea name="alamat" class="form-control" placeholder="Alamat Distributor" required></textarea>
					</div>

					<div class="form-group">
						<label>Telephone</label>
						<input type="number" name="telp" class="form-control" placeholder="Telephone" required>
					</div>

						<button type="submit" name="fsimpan" class="btn btn-primary btn-block">Tambahkan</button>
						<a class="btn btn-info btn-block" href="?menu=data_distributor">Kembali</a>
				</form>
				<?php 
					if(isset($_POST['fsimpan'])) {
						$nama = $_POST['nama'];
						$alamat = $_POST['alamat'];
						$telp = $_POST['telp'];						

						$q = "INSERT INTO tb_distributor 
							(nama_distributor, alamat, telepon)
							VALUES('$nama', '$alamat', '$telp')
							";
						mysqli_query($conn, $q);
						?>
						<script type="text/javascript">
							alert('Data Berhasil Ditambahkan');
							document.location.href='?menu=data_distributor';
						</script>
						<?php 
					}
				 ?>
			</div>
		</div>
	</div>
</body>
</html>