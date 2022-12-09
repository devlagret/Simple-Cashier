<?php include $_SERVER['DOCUMENT_ROOT'].'/kasir/function/crud.php';?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Report</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<!-- Bootstrap -->
	<link href="<?=$base_url?>/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$base_url?>/node/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link href="<?=$base_url?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=$base_url?>/assets/node/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	 <style type="text/css">
h1{
	
}
.w-60{
	width : 60% !important;
}
@media print { 
	body {
		background-color: #ff0000 !important; 
	}
 }
 body{
	margin-left: 3%;
 }
 .content{
	font-size :1.5rem;
	max-width: 70mm;
	color: #000000 !important;
	font-family: 'Droid Sans','Calibri', 'Gill Sans', 'Gill Sans MT',  'Trebuchet MS', sans-serif !important;
}
h1{
	font-size: 4rem;
}
 td{
	font-weight: 500;
}
.table{
	color: #000000 !important;
	font-size: 1.3rem;
	margin-left: 17px;
	width : 65mm !important;


}
.table td, .table th {
    padding: 0.5rem;
		padding-left: 0.3rem;
}
#tl{
	padding-left: 0.7rem;
}
hr{
	border-top: 3px dashed #000000  !important;
  clear:both;
  display:block;
  width: 99%;               
  
  height: 1px;
}
		</style>
	<script src="<?=$base_url?>/build/js/custom.js"></script>
	<script>
	// document.onload = window.print();
	// window.onafterprint = function(event){ window.location.href = "http://localhost/kasir/view/kasir";}; 
	 </script>
</head>
<body >	<?php
$conf =getconfig();

foreach ($conf as $dta ){
  $config[$dta['name']] = $dta['value'];
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$date = mysqli_query($koneksi, "call gettglpjl($id)");
  while(mysqli_next_result($koneksi)){;}

	$t = mysqli_fetch_assoc($date);
	$tgl = date_create($t['tanggal_penjualan']);
}$total = 0;
?><body >
	<div align="left " class="">
	<div class="content" align="center">
		<div class="header">
	<h1 class="mb-0 font-weight-bold"><?= $config['nama_toko']?></h1>
<small>Alamat : <?= $config['alamat_toko']?></small></br>
<small>Telp : <?= $config['no_telp']?></small>
		</div>
<hr>
<div align="left" class="ml-4">
<div class="info">
	<table >
		<tr>
<small><td>No Struk</td><td> :</td><td> <?php if(isset($_GET['id'])){echo($_GET['id']);}?></td></small></tr><try>
<small><td>Tanggal </td><td>: </td><td><?php if(isset($_GET['date'])){echo($_GET['date']);}else{echo date_format($tgl,'d-m-Y H:i');}?></td></small>
		</tr>
	</table>
</div>
</div>
<hr>
<div>
	<div>
		<table class="table mb-2">
			<thead>
				<th>Nama</th>
				<th>Qty</th>
				<th>Harga</th>
				<th id="tl">Total</th>
			</thead>
			<tbody>
				<?php 
  $dtl = mysqli_query($koneksi, "call getdetailpenjualan($id)");
	while ($data = mysqli_fetch_assoc($dtl)){
					?>
<tr>
	<td><?= $data['nama_produk'] ?></td>
	<td><?= $data['jumlah'].' 	'.$data['satuan']?></td>
	<td><?= number_format($data['harga_satuan'], 0, ',', '.');?></td>
	<td id="tl"><?php $j=$data['jumlah']*$data['harga_satuan']; echo number_format($j, 0,',','.'); ?></td>
</tr>
					<?php $total = $total + $j;$bayar = $data['bayar'];}   ?>
			</tbody>
		</table>
	</div>
</div>
<hr class="mt-0"><div align="right"	>
<div class="w-60 mr-2 text-right font-weight-bold">

	<div class="row text-left">
		<div class="col-5"> Total </div>
		<div class="col p-0 ">=</div>
		<div class="col-6">
		<?=number_format($total,0,',','.')?>
		</div>		
	
		<div class="w-100"></div>

		<div class="col-5">	Tunai</div>
		<div class="col-1 p-0 ">=</div>
		<div class="col-6	">
		<?=number_format($bayar,0,',','.')?>
		</div>
		<div class="w-100"><hr></div>

		<div class="col-5	"> Kembali </div>
		<div class="col-1 p-0 ">=</div>
		<div class="col-6">
		<?=number_format($bayar-$total,0,',','.')?>
		</div>
</div>
		

</div>
</div>
<hr>
</br>
<p class="font-weight-bold ">Terimakasih <br> Atas Kunjungan Anda </p><br>
	<hr>
	</div>
	</div>
</html>