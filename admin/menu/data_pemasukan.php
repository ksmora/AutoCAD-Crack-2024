<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Pemasukan</title>
</head>
<body>
		<h1>Riwayat Pemsukan</h1>
		<?php 
			$qjumlah = mysqli_query($conn, "SELECT * FROM tb_pasok");
			$jumlah = mysqli_num_rows($qjumlah);
		 ?>
		<div class="row">
		<div class="col-md-4">
			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?= $jumlah ?></span></button>
			<a class="btn btn-sm btn-primary" href="?menu=data_pemasukan">Refresh</a>
		</div>
		 <div class="col-md-4 col-md-offset-3">		 	 
		 	<form method="post">
		    <div class="input-group">		    		  
		      <input type="text" name="search" class="form-control" placeholder="Cari Pegawai">
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
				<th>Nama Distributor</th>
				<th>Judul Buku</th>
				<th>Jumlah</th>
				<th>tanggal</th>
				<th>Opsi</th>
			</thead>
			<tbody>
			<?php 
				$no = 1;
				$search = $_POST['search'];
				if ($_POST['cari']) {
					if($search=="") {
						$q = mysqli_query($conn, "SELECT tb_buku.*,tb_distributor.*,tb_pasok.* FROM tb_pasok INNER JOIN tb_distributor ON tb_distributor.id_distributor=tb_pasok.id_distributor INNER JOIN tb_buku ON tb_buku.id_buku=tb_pasok.id_buku");						
					} else if($search!="") {
						$q = mysqli_query($conn, "SELECT tb_buku.*,tb_distributor.*,tb_pasok.* FROM tb_pasok INNER JOIN tb_distributor ON tb_distributor.id_distributor=tb_pasok.id_distributor INNER JOIN tb_buku ON tb_buku.id_buku=tb_pasok.id_buku 
												WHERE 
												nama_distributor LIKE '%$search%' OR
												judul LIKE '%$search%' OR
												jumlah LIKE '%$search%' OR
												tanggal LIKE '%$search%' 
												");
					}
				} 
				else {
					$q = mysqli_query($conn, "SELECT tb_buku.*,tb_distributor.*,tb_pasok.* FROM tb_pasok INNER JOIN tb_distributor ON tb_distributor.id_distributor=tb_pasok.id_distributor INNER JOIN tb_buku ON tb_buku.id_buku=tb_pasok.id_buku");
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
					<td><?= $data['nama_distributor'];?></td>
					<td><?= $data['judul'];?></td>
					<td><?= $data['jumlah'];?></td>
					<td><?= $data['tanggal'];?></td>
					<td>
						
						<a onclick="return confirm('Anda akan menghapusnya')" class="btn btn-danger" title="Hapus" href="?menu=hapus_pasok&id_pasok=<?= $data['id_pasok']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					</td>
				</tr>
			</tbody>
		<?php } ?>
		</table>
</body>
</html>