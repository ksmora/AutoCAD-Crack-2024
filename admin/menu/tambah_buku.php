<!DOCTYPE html>
<html>
<head>
	<title>Tambah Buku</title>
</head>
<body>				
			<h1>Tambah Buku</h1>
			<div class="row">
			<div class="col-md-6">
				<form method="post">
					<div class="form-group">
						<label>Judul</label>
						<input type="text" name="judul" class="form-control" placeholder="judul buku" required>
					</div>

					<div class="form-group">
						<label>No.isbn</label>
						<input type="text" name="noisbn" class="form-control" placeholder="no.isbn" required>
					</div>

					<div class="form-group">
						<label>Penulis</label>
						<input type="text" name="penulis" class="form-control" placeholder="Penulis" required>
					</div>

					<div class="form-group">
						<label>Penerbit</label>
						<input type="text" name="penerbit" class="form-control" placeholder="Penerbit" required>
					</div>

					<div class="form-group">
						<label>Tahun</label>
						<input type="number" min="1200" max="2099" name="tahun" class="form-control" placeholder="Tahun" required>
					</div>
												
			</div>
			<div class="col-md-6">				
					<div class="form-group">
						<label>Stok</label>
						<input type="number" name="stok" class="form-control" placeholder="Stok" required>
					</div>

					<div class="form-group">
						<label>Harga Pokok</label>
						<input type="number" name="harga_pokok" class="form-control" placeholder="Harga Pokok di hitung Otomatis" required readonly>
					</div>

					<div class="form-group">
						<label>Harga jual</label>
						<input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" required>
					</div>

					<div class="form-group">
						<label>Ppn</label>
						<input type="number" name="ppn" class="form-control" placeholder="Ppn dihitung otomatis 10% dari Harga Jual" required readonly>
					</div>

					<div class="form-group">
						<label>Diskon</label>
						<input type="number" name="diskon" class="form-control" placeholder="Diskon" required>
					</div>
			</div>							
					<button type="submit" name="fsimpan" class="btn btn-primary btn-block">Tambahkan</button>
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
						

						$q = "INSERT INTO tb_buku (judul, noisbn, penulis, penerbit, tahun, stok, harga_pokok, harga_jual, ppn, diskon)						
							VALUES('$judul', '$noisbn', '$penulis', '$penerbit', '$tahun', '$stok', '$harga_pokok','$harga_jual','$ppn','$diskon')
							";
						mysqli_query($conn, $q);
						?>
						<script type="text/javascript">
							alert('Data Berhasil Ditambahkan');
							document.location.href='?menu=data_buku';
						</script>
						<?php 
					}
				 ?>
		</div>	
</body>
</html>