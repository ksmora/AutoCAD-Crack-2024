<!DOCTYPE html>
<html>
<head>
	<title>Data Buku</title>
</head>
<body>
		<h1>Data Buku</h1>
		<?php 
			$qjumlah = mysqli_query($conn, "SELECT * FROM tb_buku");
			$jumlah = mysqli_num_rows($qjumlah);
		 ?>
		<div class="row">
		<div class="col-md-4">
			<a href="?menu=tambah_buku"><button class="btn btn-sm btn-success">Tambah Buku</button></a>
			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?= $jumlah ?></span></button>
			<a class="btn btn-sm btn-primary" href="?menu=data_buku">Refresh</a>
		</div>
		 <div class="col-md-4 col-md-offset-3">		 	 
		 	<form method="post">
		    <div class="input-group">		    		  
		      <input type="text" name="search" class="form-control" placeholder="Cari Buku">
		      <span class="input-group-btn">
		        <input name="cari" class="btn btn-default" value="Cari" type="submit">
		      </span>		      
		    </div><!-- /input-group -->
		    </form>
		  </div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
		<table class="table table-striped">
			<thead>
				<th>No</th>
				<th>Judul</th>
				<th>No.isbn</th>
				<th>Penulis</th>
				<th>Penerbit</th>
				<th>Tahun</th>
				<th>Stok</th>
				<th>Harga Pokok</th>
				<th>Harga Jual</th>
				<th>Ppn</th>
				<th>Diskon</th>
				<th>Opsi</th>
			</thead>
			<tbody>
			<?php 
				// pagination
				$batas = 4;
				$hal = ceil($jumlah/$batas);
				$page = (isset($_GET['hal'])) ? $_GET['hal']:1;
				$posisi = ($page - 1) * $batas;
				// end
				$no = 1+$posisi;
				$search = $_POST['search'];
				if ($_POST['cari']) {
					if($search=="") {
						$q = mysqli_query($conn, "SELECT * FROM tb_buku limit $posisi,$batas");						
					} else if($search!="") {
						$q = mysqli_query($conn, "SELECT * FROM tb_buku 
												WHERE 
												judul LIKE '%$search%' OR
												noisbn LIKE '%$search%' OR
												penulis LIKE '%$search%' OR
												penerbit LIKE '%$search%' OR
												tahun LIKE '%$search%' OR
												stok LIKE '%$search%' OR
												harga_pokok LIKE '%$search%' OR
												harga_jual LIKE '%$search%' OR
												ppn LIKE '%$search%' OR
												diskon LIKE '%$search%' 
												");
					}
				} 
				else {
					$q = mysqli_query($conn, "SELECT * FROM tb_buku limit $posisi,$batas");
				}
				$cek = mysqli_num_rows($q);
					if($cek < 1) {
					?>
					<tr>
						<th colspan="12">
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
					<td><?= $data['judul'];?></td>
					<td><?= $data['noisbn'];?></td>
					<td><?= $data['penulis'];?></td>
					<td><?= $data['penerbit'];?></td>
					<td><?= $data['tahun'];?></td>
					<td><?= $data['stok'];?></td>
					<td>Rp.<?= $data['harga_pokok'];?></td>
					<td>Rp.<?= $data['harga_jual'];?></td>
					<td>Rp.<?= $data['ppn'];?></td>
					<td>Rp.<?= $data['diskon'];?></td>
					<td>
						<a class="btn btn-sm btn-primary" title="Edit" href="?menu=edit_buku&id_buku=<?= $data['id_buku']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						<a onclick="return confirm('Anda Yakin akan menghapusnya')" class="btn btn-sm btn-danger" title="Hapus" href="?menu=hapus_buku&id_buku=<?= $data['id_buku']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
						<a class="btn btn-sm btn-info" href="?menu=input_pemasukan&id_buku=<?= $data['id_buku']; ?>" title="Pasok Buku">Pasok</a>
					</td>
				</tr>
			</tbody>
		<?php } ?>
		</table>
		<nav>
  <ul class="pagination">
  	<?php 
  	for ($i=1; $i <= $hal ; $i++) { 
  		?> 
  		<li class="active"><a href="?menu=data_buku&hal=<?= $i; ?>"><?= $i; ?></a></li>
  		<?php
  	}
  	 ?>
  </ul>
</nav>
</body>
</html>

