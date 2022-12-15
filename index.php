<?php include $_SERVER['DOCUMENT_ROOT'].'/kasir/view/header.php';?>
<title>Kasir - Beranda</title>
<style type="text/css">
sm{
  margin-top: 10px;
  padding-top: 10px;
  font-size : 0.5em;
  
}
h2{
  font-size: 1.5em;
}
</style>
<?php
$jmlhtrsk = 0;
$trs = mysqli_query($koneksi, "call gettodaysale()");
while(mysqli_next_result($koneksi)){;}
$jmlhtrsk = mysqli_num_rows($trs);
$query = mysqli_query($koneksi, "call getlowprd()");
while(mysqli_next_result($koneksi)){;}
$jmllowprd = mysqli_num_rows($query);
$cnt = mysqli_query($koneksi, ("select count(id) as jumlah from tbl_produk"));
while(mysqli_next_result($koneksi)){;}
while ($a = mysqli_fetch_assoc($cnt)){
$jmlhprd = $a['jumlah'];



  }

  $no = 1;

?>
  <body class="nav-md  footer_fixed">
    <?php
if (isset($_GET['add'])){
  if ($_GET['add']=='berhasil'){
    echo '<div class="alert alert-success" role="alert">Tambah Stok Berhasil</div>';}
    elseif ($_GET['add']=='warn'){
    echo '<div class="alert alert-warning" role="alert">Harap Masukan Nilai Lebih Dari 0</div>';}
    elseif($_GET['add']=='gagal'){
    echo'<div class="alert alert-danger" role="alert">
    Tambah Stok Gagal </div>';
  }
}
    ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
          <?php include $include_path.'/view/navbar.php';?>

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row w-100" style="display: inline-block;" >
          <div class="tile_count">
            <div class="col-md-3 col-sm-4  tile_stats_count">
              <a href="<?=$base_url?>/view/produk">
              <span class="count_top"><i class="fa fa-archive"></i> Total Produk</span>
              <div class="count"><?= $jmlhprd ?></div>
              <span class="count_bottom">Jenis Produk</span>
            </a>
            </div>
            <div class="col-md-3 col-sm-4  tile_stats_count">
              <a href="<?=$base_url?>/view/riwayat_penjualan">
              <span class="count_top"><i class="fa fa-clock-o"></i> Transaksi Hari Ini</span>
              <div class="count">
              <?php if($jmlhtrsk==0){echo '<div class="count">'.$jmlhtrsk.'</div>';}else{echo '<div class="count green">'.$jmlhtrsk.'</div>';}?>
            </div>
              <span class="count_bottom">Transaksi</span>
            </a>
            </div>
            <div class="col-md-3 col-sm-4  tile_stats_count">
              <span class="count_top"><i class="fa fa-triangle-exclamation"></i> Peringatan</span>
              <?php if($jmllowprd==0){echo '<div class="count">'.$jmllowprd.'</div>';}else{echo '<div class="count red">'.$jmllowprd.'</div>';}?>
              <span class="count_bottom"> Produk Hampir Habis</span>
            </div>
           
          </div>
        </div>
          <!-- /top tiles -->
          <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pofil Toko</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="row">
                    <div class="col ml-1">
                      *Atur Profil Toko di Pengaturan
                    </div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                        <div class="col">
                          <h4>Nama Toko : <?= $config['nama_toko']?></h4>
                        </div>
                        <div class="col">
                          <h4>Alamat Toko : <?= $config['alamat_toko']?></h4>
                        </div>
                        <div class="col">
                          <h4>No Telepon : <?= $config['no_telp']?></h4>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
       
          

          <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                   <h2>Produk Dengan Stok Rendah</h2>
                    <ul class="nav navbar-right panel_toolbox">
                       <a class="btn btn-primary ml-3" href="<?=$base_url?>/view/tambah_produk">Tambah Produk</a>
                     <a class="btn btn-primary ml-3" href="<?=$base_url?>/view/produk">Daftar Produk</a>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%; font-size:<?=$font_size?> !important;">
                      <thead>
                        <tr>
													<th>No</th>
                          <!--<th>Kode Produk</th>-->
                          <th>Nama Produk</th>
                          <th>Harga satuan</th>
                          <th>Stok</th>
                          <th>Stok Minimal</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
											<tbody>
                        <div class="btn_container">
		<?php 
		//perintah perulangan untuk menampilkan data
		while ($data= mysqli_fetch_assoc($query)){
			//membuat variabel untuk menampung data 
      $id=$data["id"];
			//$kode_produk=$data['kode_produk'];
			$nama_produk=$data['nama_produk'];
      $stok_min = $data['stok_min'];
			$harga_satuan=$data['harga_satuan'];
			$stok=$data['stok'];
			$satuan=$data['satuan'];
		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $nama_produk?></td>
			<td>Rp.<?=number_format( $harga_satuan, 0, ',', '.'); ?>-</td>
			<td><?= $stok.' '.$satuan ?></td>
      <td><?= $stok_min.' '.$satuan?></td>
			<td class="text-center" >
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-stok-<?=$id?>"><i class="fa fa-pencil"></i><b>&ensp;Tambah Stok</b>
</button>

<!-- Modal -->
<div class="modal fade" id="add-stok-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Stok Produk <b>'<?=$nama_produk ?>'</b> : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <form method="post" id="ed-form" class="form-horizontal form-label-left">
              
              <input type="hidden" name="id" value="<?=$id?>" >
                      <div class="item form-group justify-content-center mb-0 mt-1">
												<label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Stok<span class="required">*</span></label>
												<div class="input-group col-md mt-2">
													<input id="stok" class="form-control " type="number" min="0" name="jumlah" required="required" value="0" placeholder="Masukkan Jumlah produk (e.g 10,50, etc)">
												  <div class="input-group-append">
                          <span class="input-group-text " id="basic-addon2"><?=$satuan?></span>
                        </div>
                        </div>
											</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info
                      " data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" id="btn" type="reset">Reset</button>
                      <button type="submit" name="add_stkprd" class="btn btn-success" >Submit</button>
                   
                  </form>
      </div>
    </div>
  </div>
</div>

					
			</td>
		</tr>
		<?php }?>
  </div>
		</tbody>
                    </table>
                  </div>  
                  </div>
              </div>

            </div

                  </div>
                </div>
              </div>
            </div>



          </div>
       </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          <a href="<?=$base_url?>/view/credit.php">Website Kasir - Siswa RPL</a><a href="https://web.smkn2kra.sch.id/"> SMK Negeri 2 Karanganyar</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=$base_url?>/assets/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=$base_url?>/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?=$base_url?>/assets/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=$base_url?>/assets/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?=$base_url?>/assets/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?=$base_url?>/assets/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=$base_url?>/assets/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?=$base_url?>/assets/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?=$base_url?>/assets/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?=$base_url?>/assets/Flot/jquery.flot.js"></script>
    <script src="<?=$base_url?>/assets/Flot/jquery.flot.pie.js"></script>
    <script src="<?=$base_url?>/assets/Flot/jquery.flot.time.js"></script>
    <script src="<?=$base_url?>/assets/Flot/jquery.flot.stack.js"></script>
    <script src="<?=$base_url?>/assets/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?=$base_url?>/assets/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?=$base_url?>/assets/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?=$base_url?>/assets/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?=$base_url?>/assets/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?=$base_url?>/assets/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?=$base_url?>/assets/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?=$base_url?>/assets/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=$base_url?>/assets/moment/min/moment.min.js"></script>
    <script src="<?=$base_url?>/assets/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=$base_url?>/build/js/custom.min.js"></script>
    <script src="<?=$base_url?>/build/js/cst.js"></script>

	
  </body>
</html>

