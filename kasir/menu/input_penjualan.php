<?php 
	$id_buku = $_GET['id_buku'];
	$qbuku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku='$id_buku'");
	$buku = mysqli_fetch_array($qbuku);
	$id_buku = $buku['id_buku'];

	// kode otomats
	$qkode = mysqli_query($conn, "SELECT max(id_jual) FROM tb_jual");
	$kode = mysqli_fetch_array($qkode);
	if($kode) {
		$nilai = $kode[0];
		$nilai = substr($nilai, 3);
		$nilai =(int)$nilai;
		$kodebaru = $nilai+1;
		$kode_otomatis = "PJN".str_pad($kodebaru,4,"0",STR_PAD_LEFT);
	} else {
		$kode_otomatis = "PJN0001";
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Input Penjualan</title>
</head>
<body>
	<h4>Input Penjualan</h4>
	<p>KODE : <?= $kode_otomatis; ?></p>
	<form class="form-inline" method="post">
		<a href="?menu=load_buku" class="btn btn-info">Load Buku</a>
		<input type="text" placeholder="Pilih Buku" readonly="readonly" require class="form-control" name="" value="<?= $buku['judul']; ?>">
		<input type="number" max="<?= $buku['stok']; ?>" name="jumlah" placeholder="Jumlah beli max <?= $buku['stok']; ?>" class="form-control">
		<input type="submit" name="tambah" value="tambah ke keranjang" class="btn btn-primary">
	</form>
	<?php 
		if(isset($_POST['tambah'])) {
			$jumlah = $_POST['jumlah'];
			$id_kasir = $profil['id_kasir'];
			$jumlah_harga = $buku['harga_pokok'] * $jumlah;

			$buku1 = mysqli_query($conn, "SELECT * FROM tb_keranjang WHERE id_buku='$id_buku'") ;
			$cek1 = mysqli_num_rows($buku1);
			$cek2 = mysqli_fetch_array($buku1);
			$subjumlah = $cek2['jumlah'];
			$t1 = $subjumlah + $jumlah;
			$subjumlah_harga = $t1 * $buku['harga_pokok'];
			if($cek1 > 0) {
				mysqli_query($conn, "UPDATE tb_keranjang SET jumlah='$t1',jumlah_harga='$subjumlah_harga' WHERE id_buku='$id_buku'");
				$updatestok1 = $buku['stok'] - $jumlah;
				mysqli_query($conn, "UPDATE tb_buku SET stok='$updatestok1' WHERE id_buku='$id_buku'");				
			} else {
				mysqli_query($conn, "INSERT INTO tb_keranjang(id_buku, id_kasir, jumlah, jumlah_harga)
								VALUES 
								('$id_buku', '$id_kasir', '$jumlah', '$jumlah_harga')
								");
			$updatestok = $buku['stok'] - $jumlah;
			mysqli_query($conn, "UPDATE tb_buku SET stok='$updatestok' WHERE id_buku='$id_buku'");
			}
			
			?>
			<div class="alert alert-success">
				Berhasil di tambah ke keranjang
			</div>
			
			<?php
		}
	 ?>
	<hr>
	<h3><span class="glyphicon glyphicon-shopping-cart"></span>	Keranjang</h3>
	<table class="table table-bordered">
		<tr>
			<th>No.</th>
			<th>Buku</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Jumlah harga</th>
			<th>Aksi</th>
		</tr>
		<?php 
		$no =1;
		$qker = mysqli_query($conn, "SELECT tb_buku.*,tb_kasir.*,tb_keranjang.* FROM tb_keranjang INNER JOIN tb_buku ON tb_buku.id_buku=tb_keranjang.id_buku INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_keranjang.id_kasir");
		while($data = mysqli_fetch_array($qker)) {
			$tot_jumlah = $data['harga_pokok'] * $data['jumlah'];
		 ?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $data['judul']; ?></td>			
			<td>Rp.<?= $data['harga_pokok']; ?></td>
			<td><?= $data['jumlah']; ?></td>
			<td>Rp.<?= $tot_jumlah; ?></td>
			<td>
				<a onclick="return confirm('Anda Yakin?')" href="?menu=hapus_ker&id_keranjang=<?= $data['id_keranjang']; ?>&id_buku=<?= $data['id_buku']; ?>&jumlah=<?= $data['jumlah']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th class="text-right" colspan="4">Total Harga</th>
			<td colspan="2">Rp.
				<?php 
				$qtotal = mysqli_query($conn, "SELECT sum(jumlah_harga) as total FROM tb_keranjang");
				$total = mysqli_fetch_array($qtotal);
				echo number_format($total['total'], 2);
				 ?>
			</td>
		</tr>
	</table>
	<hr>
	<?php
	$qk = mysqli_query($conn, "SELECT * FROM tb_keranjang");
	$cek = mysqli_num_rows($qk);
	if ($cek > 0) {
		
	  ?>
	<div class="col-md-4">
		<h1><small>Harga Total</small><br>
		Rp.<?= number_format($total['total'],2); ?>
		</h1>
		<form class="form-inline" method="post">
			<input type="number" name="uang" placeholder="Masukkan Uang Pembeli" class="form-control" required="required" min="<?= $total['total']; ?>">
			<button name="proses" class="btn btn-success">Proses</button>
		</form>
	</div>
	<div class="col-md-4">
		<?php
		if(isset($_POST['proses'])) {
		  $uang = $_POST['uang'];
		  $kembali = $uang - $total['total'];
		  $tanggal = date('Y-m-d');

		  mysqli_query($conn, "INSERT INTO tb_penjualan(id_buku,jumlah,jumlah_harga,id_jual) SELECT id_buku,jumlah,jumlah_harga,'$kode_otomatis' FROM tb_keranjang");
		  // masukkan data ke tb_jual
		  mysqli_query($conn, "INSERT INTO tb_jual(id_jual,total,uang,kembali,id_kasir,tanggal)
		  						VALUES
		  						('$kode_otomatis','$total[total]','$uang','$kembali','$profil[id_kasir]','$tanggal')
		  						");
		  ?>
		  	<blockquote>
		  		<h3>
		  			<small>Uang Pembeli</small>
		  			Rp. <?= number_format($uang,2); ?>
		  		</h3>
		  		<h2>
		  			<small>Uang Kembali</small>
		  			Rp. <?= number_format($kembali,2); ?>
		  		</h2>
		  	</blockquote>
		<?php
		}	
		?>
	</div>
	<div class="col-md-4">
		<br><br>
		<a href="?menu=selesai" class="btn btn-primary">Selesai dan Bersihkan</a>
		<a href="" class="btn btn-success"><span class="glyphicon glyphicon-print"></span></a>
	</div>
	<?php } ?>
</body>
</html>