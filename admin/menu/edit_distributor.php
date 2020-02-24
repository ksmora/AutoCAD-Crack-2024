<!DOCTYPE html>
<html>
<head>
	<title>Tambah Pegawai</title>
</head>
<body>
	<?php 
		$id = $_GET['id_distributor'];
		$query = mysqli_query($conn, "SELECT * FROM tb_distributor WHERE id_distributor='$id'");
		$data = mysqli_fetch_array($query);
	 ?>
	 
	<div class="container">
		<h1>Edit Data Pegawai</h1>
		<div class="row">						
			<div class="col-md-8">
				<form method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" value=" <?= $data['nama_distributor']; ?>" reqiured>
					</div>

					<div class="form-group">
						<label>Alamat</label><br>
						<textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
					</div>

					<div class="form-group">
						<label>Telephone</label>
						<input type="text" name="telp" class="form-control" value=" <?= $data['telepon']; ?>" required>
					</div>					
											 
						<button type="submit" name="fsimpan" class="btn btn-primary btn-block">Simpan</button>
						<a class="btn btn-info btn-block" href="?menu=data_pegawai">Kembali</a>
				</form>
				<?php 
					if(isset($_POST['fsimpan'])) {
						$nama = $_POST['nama'];
						$alamat = $_POST['alamat'];
						$telp = $_POST['telp'];											

						$q = "UPDATE  tb_distributor SET nama_distributor='$nama', alamat='$alamat', telepon='$telp' WHERE id_distributor='$id'						
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