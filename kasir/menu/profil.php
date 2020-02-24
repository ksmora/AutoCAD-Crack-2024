<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
</head>
<body>
	<h3>INFO Tentang Anda</h3>
			
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3> Info Tentang Anda</h3>
					</div>
					<div class="panel-body">
						<table class="table" cellspacing="8" cellpadding="10">
							<tr>
								<th>Nama</th> <td>:</td> <td><?= $profil['nama']; ?></td>
							</tr>
							<tr>
								<th>Alamat</th> <td>:</td> <td><?= $profil['alamat']; ?></td>
							</tr>
							<tr>
								<th>Telephon</th> <td>:</td> <td><?= $profil['telepon']; ?></td>
							</tr>
						</table>
						<a class="btn btn-sm btn-success " href="?menu=edit_profil">Edit Data Saya</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Edit Username dan Password</h3>
					</div>
					<div class="panel-body">
						<fieldset>
							<legend>Edit Username</legend>
							<form class="form" method="post">
								<div class="form-group">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">User saat ini</span>
									  <input type="text" readonly class="form-control" value=" <?= $profil['username']; ?>" aria-describedby="basic-addon1">
									</div><br>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">User baru</span>
									  <input type="text" name="userbaru" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
									</div><br>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">password anda</span>
									  <input type="password" name="pass" class="form-control" placeholder="password" aria-describedby="basic-addon1">
									</div><br>
									<input type="submit" name="edit_user" value="Simpan" class="btn btn-success">
								</div>
							</form>

							<!-- Fungsi Edit USername -->
								<?php 
									if (isset($_POST['edit_user'])) {
										$userbaru = $_POST['userbaru'];
										$pass = $_POST['pass'];
										if (md5($pass)==$profil['password']) {
											mysqli_query($conn, "UPDATE tb_kasir SET username='$userbaru' WHERE id_kasir='$profil[id_kasir]'");
										?>
										<script type="text/javascript">
											alert('Username Anda berhasil dirubah!');
											document.location.href= '../inc/keluar.php';
										</script>
										<?php
										} else {
											echo "Password Anda salah!!";
										}
									}
								 ?>


						</fieldset>
						<hr>
						<fieldset>
							<legend>Edit Password</legend>
							<form class="form" method="post">
								<div class="form-group">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Password baru</span>
									  <input type="text" name="pass1" class="form-control" placeholder="password baru" aria-describedby="basic-addon1">
									</div><br>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">Ketik ulang password baru</span>
									  <input type="text" name="pass2" class="form-control" placeholder="ketik ulang" aria-describedby="basic-addon1">
									</div><br>
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">password anda saat ini</span>
									  <input type="password" name="pass_awal" class="form-control" placeholder="password saat ini" aria-describedby="basic-addon1">
									</div><br>
									<input type="submit" name="edit_password" value="Simpan" class="btn btn-success">
								</div>
							</form>
							<!-- Fungsi Edit Password -->
								<?php 
									if (isset($_POST['edit_password'])) {
										$pass1 = md5($_POST['pass1']);
										$pass2 = md5($_POST['pass2']);
										$pass = $_POST['pass_awal'];
										if ($pass1 != $pass2) {
												echo "Password konfirmasi tidak cocok";
											} else {
												if (md5($pass)==$profil['password']) {
											mysqli_query($conn, "UPDATE tb_kasir SET password='$pass1' WHERE id_kasir='$profil[id_kasir]'");
										?>
										<script type="text/javascript">
											alert('Password Anda berhasil dirubah!, Silahkan Login kembali!');
											document.location.href= '../inc/keluar.php';
										</script>
										<?php
										} else {
											echo "Password Anda salah!!";
										}
											}	
									}
								 ?>
						</fieldset>
					</div>
				</div>
			</div>
		</div>			
</body>
</html>