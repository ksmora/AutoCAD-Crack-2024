<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<div class="conatiner">
		<h1>Input Penjualan</h1>
		<h3>Pilih Buku</h3>
	</div>
	<div class="row">
		<div class="col-md-4 ">		 	 
		 	<form method="post">
		    <div class="input-group">	    		  
		      <input type="text" name="search" class="form-control" placeholder="Cari Buku">
		      <span class="input-group-btn">
		        <input name="cari" class="btn btn-default" value="Cari" type="submit">
		      </span>		      
		    </div><!-- /input-group -->
		    </form>		    
		</div>
		<div class="col-md-2"><a class="btn btn-sm btn-info" href="?menu=load_buku">Refresh</a></div>
	</div>
	<br>	  
	<div class="row">	  
		<div class="col-md-6">
			<table class="table table-bordered">
				<?php
					$search = $_POST['search'];
					if(isset($_POST['cari'])) {
						if($search=="") {
							$buku = mysqli_query($conn, "SELECT * FROM tb_buku");
						} 
						else if($search!="") {
							$buku = mysqli_query($conn, "SELECT * FROM tb_buku 
														WHERE 
														judul LIKE '%$search%' OR
														stok LIKE '%$search%' 
														");
						}
					} 
					else{
						$buku = mysqli_query($conn, "SELECT * FROM tb_buku");
					}
					$cek = mysqli_num_rows($buku);

					if($cek < 1) {
						?>
						<tr>
							<td>Tidak Ada Data <a class="btn btn-sm btn-success" href="?menu=load_buku">Refresh</a>
							</td>
							<td><a class="btn btn-warning" href="?menu=input_penjualan">Kembali</a></td>
						</tr>
						<?php
					}
					else{
					while($data = mysqli_fetch_array($buku)) {
						$idbuku = $data['id_buku'];
				 ?>
				 <tr>
				 	<td><?= $data['judul']; ?></td>
				 	<td><?= $data['stok']; ?></td>
				 	<td><a class="btn btn-sm btn-warning btn-block" href="?menu=input_penjualan&id_buku=<?php echo $idbuku; ?>">Pilih</a></td>
				 </tr>
				<?php } }?>
			</table>
		</div>
	</div>

</body>
</html>