<!DOCTYPE html>
<html>
<head>
	<title>Tambah Pegawai</title>
</head>
<body>
	<div class="container">
		<div class="row">			
			<h1>Tambah Pegawai</h1>
			<div class="col-md-8">
				<form method="post">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" reqiured>
					</div>

					<div class="form-group">
						<label>Alamat</label><br>
						<textarea name="alamat" class="form-control" placeholder="Alamat Pegawai (kasir)"></textarea>
					</div>

					<div class="form-group">
						<label>Telephone</label>
						<input type="number" name="telp" class="form-control" placeholder="Telephone" required>
					</div>					

					<div class="form-group">
						<label>Status User</label>
						<select name="status" class="form-control">
							<option class="form-control">Aktif</option>
							<option class="form-control">Tidak Aktif</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">User Pegawai</label>
						<input type="text" name="user" class="form-control" id="" placeholder="Username" required>
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="pass" class="form-control" id="" placeholder="Password" required>
					</div>
					<div class="form-group">
						<label>Akses User</label>
						<input type="text" class="form-control" readonly="readonly" value="Kasir">
					</div>		 
						<button type="submit" name="fsimpan" class="btn btn-primary btn-block">Tambahkan</button>
						<a class="btn btn-info btn-block" href="?menu=data_pegawai">Kembali</a>
				</form>
				<?php 
					if(isset($_POST['fsimpan'])) {
						$nama = $_POST['nama'];
						$alamat = $_POST['alamat'];
						$telp = $_POST['telp'];
						$status = $_POST['status'];
						$user = $_POST['user'];
						$pass = md5($_POST['pass']);
						$akses = "kasir";

						$q = "INSERT INTO tb_kasir 
							(nama, alamat, telepon, status, username, password, akses)
							VALUES('$nama', '$alamat', '$telp', '$status', '$user', '$pass', '$akses')
							";
						mysqli_query($conn, $q);
						?>
						<script type="text/javascript">
							alert('Data Berhasil Ditambahkan');
							document.location.href='?menu=data_pegawai';
						</script>
						<?php 
					}
				 ?>
			</div>
		</div>
	</div>
</body>
</html>