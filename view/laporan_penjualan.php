<?php include 'header.php' ?>
<title>Kasir - Laporan Penjualan</title>
<body class="nav-md footer_fixed">
<?php
if (isset($_GET['hapus'])) {
if ($_GET['hapus'] == 'berhasil') {
echo '<div class="alert alert-success" role="alert">Hapus Riwayat Penjualan Berhasil</div>';
} elseif ($_GET['hapus'] == 'gagal') {
echo '<div class="alert alert-danger" role="alert">
Hapus Riwayat Penjualan Gagal </div>';
}
}
if (isset($_GET['update'])) {
if ($_GET['update'] == 'berhasil') {
echo '<div class="alert alert-success" role="alert">Edit Riwayat Penjualan Berhasil</div>';
} elseif ($_GET['update'] == 'gagal') {
echo '<div class="alert alert-danger" role="alert">
Edit Riwayat Penjualan Gagal </div>';
}
}
$qw = mysqli_query($koneksi, "select * from tbl_penjualan");
while (mysqli_next_result($koneksi)) {;
}
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$range = getdaterange($tahun);
if ($bulan > $range['bulan_max'] || $bulan < $range['bulan_min']) {
$bulan = $range['bulan_max'];
}
} else {
$bulan = date('n');
$tahun = date('Y');
$range = getdaterange($tahun);
}
?>
<div class="container body">
<div class="main_container">
<div class="col-md-3 left_col">
<div class="left_col scroll-view">
<?php include 'navbar.php' ?>
<!-- page content -->
<div class="right_col" role="main">
<div class="">
<div class="page-title">
<div class="title_left">
<h3>Laporan Penjualan Bulan <?= convmonth($bulan) ?> tahun <?=$tahun?></h3>
</div>
<div class="title_right">
<div class="col-md-5 col-sm-5   form-group pull-right top_search">
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-12 col-sm-12  ">
<div class="x_panel">
<div class="x_title">
<div class="row">
<div class="col-md-auto">
<div class="form-group row">
<h5 class="control-label col-sm-auto mt-2 p-0">Bulan :</h5>
<div class="col-sm ">
<select name="bulan" id="select_bulan" onChange="setTanggal('laporan_penjualan')" class="form-control">
<?php if($range['bulan_min']!=null && $range['bulan_max']!=null){
for ($x = $range['bulan_max']; $x >= $range['bulan_min']; $x--) { ?>
<option <?php echo 'value="' . $x . '"';
if ($x == $bulan) {
echo 'selected';
} ?>><?=
convmonth($x)
?></option>
<?php }
} else {
echo '<option>'.convmonth($bulan).'</option>';
}
?>
</select>
</div>
</div>
</div>
<div class="col-md-auto">
<div class="form-group row">
<h5 class="control-label col-sm-auto mt-2 p-0">Tahun :</h5>
<div class="col-sm ">
<select name="tahun" id="select_th" onChange="setTanggal('laporan_penjualan')" class="form-control">
<?php if($range['th_max']!=null && $range['th_min']!=null){
for ($x = $range['th_max']; $x >= $range['th_min']; $x--) { ?>
<option <?php echo 'value="' . $x . '"';
if ($x == $tahun) {
echo 'selected';
} ?>><?= $x ?>  
<?php }
} else {
echo '<option>'.$tahun.'</option>';
}?>
</select>
</div>
</div>
</div>
<div class="col " align="right">
<a class="btn btn-success" href="<?= $base_url . '/view/riwayat_penjualan?bulan=' . $bulan . '&tahun=' . $tahun ?>"><i class="fa fa-circle-info"></i>&ensp;Detail</a>
<a class="btn btn-primary" href="<?= $base_url . '/function/laporanpdf?bulan=' . $bulan . '&tahun=' . $tahun ?>"><i class="fa-regular fa-file-pdf fa-lg"></i>&ensp;Cetak PDF</a>
</div>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
<div class="x_content">
<div class="row pt-3">
<div class="col-sm-12">
<font>
<div class="card-box table-responsive">
<table id="datatable" class="table text-center table-striped table-bordered" style="width:100%; font-size:<?= $font_size ?>;">
<thead>
<tr>
<th>No</th>
<th>Nama Produk</th>
<th>Jumlah Terjual</th>
<th>Pendapatan</th>
</tr>
</thead>
<tbody>
<?php
//menampilkan data dari tabel
$query = mysqli_query($koneksi, "call getlappjl($bulan,$tahun)");
while (mysqli_next_result($koneksi)) {;
}
//membuat variabel untuk penomoran
$n = 1;
$jumlah = mysqli_num_rows($query);
//perintah perulangan untuk menampilkan data
while ($data = mysqli_fetch_assoc($query)) {
//membuat variabel untuk menampung data 
$kode_penjualan = $data['kode_penjualan'];
$id = $data["id"];
$nama_prd = $data['nama_produk'];
$j_penjualan = $data['jumlah'];
$pdpt = $data['pendapatan'];
$stan = $data['satuan'];
?>
<tr>
<td><?= $n++ ?></td>
<td><?= $nama_prd ?></td>
<td><?= $j_penjualan . ' ' . $stan ?></td>
<td>Rp. <?= number_format($pdpt, 0, ',', '.'); ?> -</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</font>
</div>
</div>
</div>
</div </div>
</div>
</div>
</div>
</div>
<!-- /page content -->
<?php include 'footer.php' ?>