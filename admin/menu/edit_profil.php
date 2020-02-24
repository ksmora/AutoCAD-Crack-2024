<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Profil</title>
</head>
<body>
	<div class="container">
		<div class="row">			
			<h1>Edit Data Saya</h1>
			<div class="col-md-8">
				<form method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" value=" <?= $profil['nama'];?>" reqiured>
					</div>

					<div class="form-group">
						<label>Alamat</label><br>
						<textarea class="form-control" name="alamat" required><?= $profil['alamat'];?></textarea>
					</div>

					<div class="form-group">
						<label>Telephone</label>
						<input type="text" class="form-control" name="telepon" value="<?= $profil['telepon'];?>" required>
					</div>									
						<button type="submit" name="edit_profil" class="btn btn-primary btn-block">Submit</button>
						<a class="btn btn-danger btn-block" href="?menu=profil">Batal</a>
				</form>
				<?php
					if(isset($_POST[edit_profil])) {
					$nama = $_POST['nama'];
					$alamat = $_POST['alamat'];
					$telp = $_POST['telepon'];

					mysqli_query($conn, "UPDATE tb_kasir SET nama='$nama', alamat='$alamat', telepon='$telp' WHERE id_kasir='$profil[id_kasir]'");
					?>
					<script type="text/javascript">
						alert('Profil berhasil di update');
						document.location.href='?menu=profil';
					</script>
					<?php
				}
				?>			
			</div>
		</div>
	</div>
</body>
</html>