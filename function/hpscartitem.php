<?php
 include 'config.php';

$id = $_GET['id'];
		$query = mysqli_query($koneksi, "DELETE FROM tmp_penjualan WHERE id=$id");

		if($query){
			header("Location:".$base_url."/view/kasir.php?hapus=berhasil");
		}else{
			header("Location:".$base_url."/view/kasir.php?hapus=gagal");
		}
			?>