<!DOCTYPE html>
<html>
<head>
	<title>Data Distributor</title>
</head>
<body>
		<h1>Data Distributor</h1>
		<?php 
			$qjumlah = mysqli_query($conn, "SELECT * FROM tb_distributor");
			$jumlah = mysqli_num_rows($qjumlah);
		 ?>
		<div class="row">
		<div class="col-md-4">
			<a href="?menu=tambah_distributor"><button class="btn btn-sm btn-success">Tambah Distributor</button></a>
			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?= $jumlah ?></span></button>
			<a class="btn btn-sm btn-primary" href="?menu=data_distributor">Refresh</a>
		</div>
		 <div class="col-md-4 col-md-offset-3">		 	 
		 	<form method="post">
		    <div class="input-group">		    		  
		      <input type="text" name="search" class="form-control" placeholder="Cari Distributor">
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
				<th>Nama</th>
				<th>Alamat</th>
				<th>Telephone</th>
				<th>Opsi</th>
			</thead>
			<tbody>
			<?php 
				$no = 1;
				$search = $_POST['search'];
				if ($_POST['cari']) {
					if($search=="") {
						$q = mysqli_query($conn, "SELECT * FROM tb_distributor");						
					} else if($search!="") {
						$q = mysqli_query($conn, "SELECT * FROM tb_distributor 
												WHERE 
												nama_distributor LIKE '%$search%' OR
												alamat LIKE '%$search%' OR
												telepon LIKE '%$search%' 
												");
					}
				} 
				else {
					$q = mysqli_query($conn, "SELECT * FROM tb_distributor");
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
					<td><?= $data['alamat'];?></td>
					<td><?= $data['telepon'];?></td>					
					<td>
						<a class="btn btn-primary" title="Edit" href="?menu=edit_distributor&id_distributor=<?= $data['id_distributor']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						
						<a onclick="return confirm('Anda Yakin akan menhapusnya')" class="btn btn-danger" title="Hapus" href="?menu=hapus_distributor&id_distributor=<?= $data['id_distributor']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					</td>
				</tr>
			</tbody>
		<?php } ?>
		</table>
</body>
</html>	