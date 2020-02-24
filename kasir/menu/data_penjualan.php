<!DOCTYPE html>
<html>
<head>
	<title>Data Penjualan</title>
</head>
<body>
		<h1>Data Penjualan</h1>
		<?php 
			$qjumlah = mysqli_query($conn, "SELECT * FROM tb_jual");
			$jumlah = mysqli_num_rows($qjumlah);
		 ?>
		<div class="row">
		<div class="col-md-4">
			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?= $jumlah ?></span></button>
			<a class="btn btn-sm btn-primary" href="?menu=data_penjualan">Refresh</a>
		</div>
		 <div class="col-md-4 col-md-offset-3">		 	 
		 	<form method="post">
		    <div class="input-group">		    		  
		      <input type="text" name="search" class="form-control" placeholder="Cari Penjualan">
		      <span class="input-group-btn">
		        <input name="cari" class="btn btn-default" value="Cari" type="submit">
		      </span>		      
		    </div><!-- /input-group -->
		    </form>
		  </div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
		<br>
		<table class="table table-striped">

			<thead>
				<th>No</th>
				<th>Kasir</th>
				<th>Total</th>
				<th>Uang Pembeli</th>
				<th>Uang Kembali</th>
				<th>Tanggal</th>
				<th>Opsi</th>
			</thead>
			<tbody>
			<?php 
				$no = 1;
				$search = $_POST['search'];
				if ($_POST['cari']) {
					if($search=="") {
						$q = mysqli_query($conn, "SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir");						
					} else if($search!="") {
						$q = mysqli_query($conn, "SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir 
												WHERE 
												judul LIKE '%$search%' OR
												jumlah LIKE '%$search%' OR
												total LIKE '%$search%' OR
												nama LIKE '%$search%' OR
												tanggal LIKE '%$search%' OR
												");
					}
				} 
				else {
					$q = mysqli_query($conn, "SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir");
				}
				$cek = mysqli_num_rows($q);
					if($cek < 1) {
					?>
					<tr>
						<th colspan="7">
							<center>
							Tidak ada pencarian dari "<?= $search ?>"		
							<a href="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-refresh"></span></a>
							</center>
						</th>
					</tr>
					<?php 
					}
				while($data = mysqli_fetch_array($q)) {					
			 ?>				
			<tr>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $data['nama'];?></td>
					<td>Rp.<?= $data['total'];?></td>
					<td>Rp.<?= $data['uang'];?></td>
					<td>Rp.<?= $data['kembali'];?></td>
					<td><?= $data['tanggal'];?></td>
					<td>
						<a class="btn btn-info" href="?menu=detail&id_jual=<?= $data['id_jual']; ?>">Detail</a>
					</td>
				</tr>
			</tr>
			</tbody>
		<?php } ?>
		</table>
</body>
</html>