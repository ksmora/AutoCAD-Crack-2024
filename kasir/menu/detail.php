<?php 
$id_jual = $_GET['id_jual'];
$query = mysqli_query($conn, "SELECT tb_penjualan.*,tb_buku.*,tb_jual.* FROM tb_penjualan INNER JOIN tb_buku ON tb_buku.id_buku=tb_penjualan.id_buku INNER JOIN tb_jual ON tb_jual.id_jual=tb_penjualan.id_jual");
$data = mysqli_fetch_array($query);
$id_jual = $data['id_jual'];


$i=1;

 ?>

	<table class="table table-striped table-bordered">		
		<head>
			<th>No.</th>
			<th>Nama Buku</th>
			<th>Harga</th>
			<th>Qty</th>
			<th>Jumlah</th>
		</head>
		<?php while($data = mysqli_fetch_array($query)) { ?>
		<tbody>
			<tr>
				<td><?= $i++ ?>.</td>
				<td><?= $data['judul']; ?></td>
				<td>Rp.<?= $data['harga_pokok']; ?></td>
				<td><?= $data['jumlah']; ?></td>
				<td>Rp.<?= $data['jumlah_harga']; ?></td>
			</tr>
			<?php }; ?>
			<?php 
			$query = mysqli_query($conn, "SELECT tb_penjualan.*,tb_buku.*,tb_jual.* FROM tb_penjualan INNER JOIN tb_buku ON tb_buku.id_buku=tb_penjualan.id_buku INNER JOIN tb_jual ON tb_jual.id_jual=tb_penjualan.id_jual");
				$data = mysqli_fetch_array($query);
			 ?>
			<tr>
				<td colspan="3"></td>
				<td>Uang Pembeli</td>
				<td>Rp.<?= $data['uang']; ?></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td>Total</td>
				<td>Rp.<?= $data['total'] ?></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td>Kembali</td>
				<td>Rp.<?= $data['kembali'] ?></td>
			</tr>
		</tbody>
		
	</table>

