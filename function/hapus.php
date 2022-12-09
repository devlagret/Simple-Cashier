<?php
include 'crud.php';

if(isset($_GET['key'])&&isset($_GET['id'])){
	 switch($_GET['key']){
		case 'prd':
			$id = mysqli_real_escape_string($koneksi,$_GET['id']);
			$query = mysqli_query($koneksi, "DELETE FROM tbl_produk WHERE id=$id");
			if($query){
				header("Location:".$base_url."/view/produk.php?hapus=berhasil");
			}else{
				header("Location:".$base_url."/view/produk.php?hapus=gagal");
			}
			break;
		case 'penjualan':
			$id = mysqli_real_escape_string($koneksi,$_GET['id']);
			$query1 = mysqli_query($koneksi, "DELETE FROM tbl_penjualan WHERE kode_penjualan=$id");
			while(mysqli_next_result($koneksi)){;}
			$query2 = mysqli_query($koneksi, "DELETE FROM tbl_detail_penjualan WHERE kode_penjualan=$id");
			if($query1&&$query2){
				header("Location:".$base_url."/view/riwayat_penjualan?hapus=berhasil");
			}else{
				header("Location:".$base_url."/view/riwayat_penjualan?hapus=gagal");
			}
			break;
		case 'cartitm':
			$id = mysqli_real_escape_string($koneksi,$_GET['id']);
			$q = mysqli_query($koneksi,"call getmincart()");
			while(mysqli_next_result($koneksi)){;}
			$row = mysqli_num_rows($q);
			if($row == 1){
			$query = mysqli_query($koneksi, "DELETE FROM tmp_penjualan WHERE id=$id");
			while(mysqli_next_result($koneksi)){;}
			$cd = getcode();
			$dl = mysqli_query($koneksi,"call delpenjualan($cd)");
			while(mysqli_next_result($koneksi)){;}
			if($query==true && $dl==true){
				header("Location:".$base_url."/view/kasir.php?dl&hapus=berhasil");
			}else{
				header("Location:".$base_url."/view/kasir.php?hapus=gagal");
			}
			}else{
			$query = mysqli_query($koneksi, "DELETE FROM tmp_penjualan WHERE id=$id");
			if($query==true ){
				header("Location:".$base_url."/view/kasir.php?hapus=berhasil");
			}else{
				header("Location:".$base_url."/view/kasir.php?hapus=gagal");
			}
			}

			
			break;
		case 'cart':
			if(validatecart()){
			$del =  deletepejualan();
			if($del){
				header("Location:".$base_url."/view/kasir.php?info=canceled");
			}else{
				header("Location:".$base_url."/view/kasir.php?info=notcanceled");
			}}else{
				header("Location:".$base_url."/view/kasir.php?info=empty");
			}
		
			break;
		default:
		header("Location:".$base_url."/forbiden");
		break;
	 }
	}else{
	header("Location:".$base_url."/forbiden");
	 }

?>