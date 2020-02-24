<!DOCTYPE html>
<html>
<head>
	<title>Edit Buku</title>
</head>
<body>
		<?php 
			$idbuku = $_GET['id_buku'];
			$qbuku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku='$idbuku'");
			$data = mysqli_fetch_array($qbuku);

		 ?>
			<h1>Tambah Buku</h1>
			<div class="row">
			<div class="col-md-6">
				<form method="post">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" reqiured>
					</div>

					<div class="form-group">
						<label>No.isbn</label>
						<input type="text" name="noisbn" class="form-control" value="<?= $data['noisbn'] ?>" reqiured>
					</div>

					<div class="form-group">
						<label>Penulis</label>
						<input type="text" name="penulis" class="form-control" value="<?= $data['penulis'] ?>" reqiured>
					</div>

					<div class="form-group">
						<label>Penerbit</label>
						<input type="text" name="penerbit" class="form-control" value="<?= $data['penerbit'] ?>" reqiured>
					</div>

					<div class="form-group">
						<label>Tahun</label>
						<input type="number" min="1200" max="2099" name="tahun" class="form-control" value="<?= $data['tahun'] ?>" reqiured>
					</div>
												
			</div>
			<div class="col-md-6">				
					<div class="form-group">
						<label>Stok</label>
						<input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" reqiured>
					</div>

					<div class="form-group">
						<label>Harga Pokok</label>
						<input type="number" name="harga_pokok" class="form-control" value="<?= $data['harga_pokok'] ?>" reqiured readonly>
					</div>

					<div class="form-group">
						<label>Harga jual</label>
						<input type="number" name="harga_jual" class="form-control" value="<?= $data['harga_jual'] ?>" reqiured>
					</div>

					<div class="form-group">
						<label>Ppn</label>
						<input type="number" name="ppn" class="form-control" value="<?= $data['ppn'] ?>" reqiured readonly>
					</div>

					<div class="form-group">
						<label>Diskon</label>
						<input type="number" name="diskon" class="form-control" value="<?= $data['diskon'] ?>" reqiured>
					</div>
			</div>							
					<button type="submit" name="fsimpan" class="btn btn-primary btn-block">Simpan</button>
					<a class="btn btn-info btn-block" href="?menu=data_buku">Kembali</a>
				</form>
			
			<?php 
					if(isset($_POST['fsimpan'])) {
						$judul = $_POST['judul'];
						$noisbn = $_POST['noisbn'];
						$penulis = $_POST['penulis'];
						$penerbit = $_POST['penerbit'];
						$tahun = $_POST['tahun'];
						$stok = $_POST['stok'];
						$harga_jual = $_POST['harga_jual'];
						$jml_ppn = 0.1;
						$ppn = $harga_jual * $jml_ppn;
						$diskon = $_POST['diskon'];
						$harga_pokok = $harga_jual + $ppn - $diskon;
						

						$q = "UPDATE tb_buku SET judul='$judul', noisbn='$noisbn', penulis='$penulis', penerbit='$penerbit', tahun='$tahun', stok='$stok', harga_pokok='$harga_pokok', harga_jual='$harga_jual', ppn='$ppn', diskon='$diskon' WHERE id_buku='$idbuku'						
							";
						mysqli_query($conn, $q);
						?>
						<script type="text/javascript">
							alert('Data Berhasil Diupdate');
							document.location.href='?menu=data_buku';
						</script>
						<?php 
					}
				 ?>
		</div>	
</body>
</html>