<?php include 'header.php'?>	
<title>Kasir - Riwayat Penjualan</title>
  <body class="nav-md footer_fixed">

  <?php
		//mendapatkan nilai dari url
		if (isset($_GET['hapus'])){
			if ($_GET['hapus']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Hapus Riwayat Penjualan Berhasil</div>';
			}elseif($_GET['hapus']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Hapus Riwayat Penjualan Gagal </div>';
			}
		}
		//mendapatkan nilai dari url
		if (isset($_GET['update'])){
			if ($_GET['update']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Edit Riwayat Penjualan Berhasil</div>';
			}elseif($_GET['update']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Edit Riwayat Penjualan Gagal </div>';
					
			}}?>
 
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
          <?php include 'navbar.php'?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Riwayat Penjualan</h3>
              </div>
             
              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <!--<div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>-->
                </div>
              </div>
            </div>

            <div class="clearfix" ></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                     <a class="btn btn-primary ml-3" href="<?=$base_url?>/view/produk.php">Daftar Produk</a>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <font>
                    <div class="card-box table-responsive">
                    <table id="datatable" class="table text-center table-striped table-bordered" style="width:100%; font-size:<?=$font_size?>;">
                      <thead>
                        <tr>
													<th>No</th>
                          <th>Tanggal Penjualan</th>
                          <th>Kode Penjualan</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
											<tbody>
                     
		<?php 
		//menampilkan data dari tabel
		$query = mysqli_query($koneksi, "SELECT * FROM tbl_penjualan order by id desc ");
    while(mysqli_next_result($koneksi)){;}  
		//membuat variabel untuk penomoran
		$no = 1;
		$jumlah = mysqli_num_rows($query);
		//perintah perulangan untuk menampilkan data
		while ($data= mysqli_fetch_assoc($query)){
      

      //membuat variabel untuk menampung data 
      $id=$data["id"];
			$kode_penjualan=$data['kode_penjualan'];
			$tanggal_penjualan=$data['tanggal_penjualan'];
      
      $date=date_create($tanggal_penjualan);
		?>
		<tr>
			<td><?= $no++?></td>
      <td><?php echo date_format($date," d/m/Y H:i");if(date_format($date,"Ymd")== date('Ymd')){echo ('&ensp;<span class="badge badge-success">Hari Ini</span>');} ?></td>
			<td><?= $kode_penjualan?></td>
			<td class="text-center" >
<!-- Detail -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#detail-pjl-<?=$id?>"><i class="fa fa-circle-info"></i>&ensp;Detail
</button>
<!-- Modal -->
<div class="modal fade" id="detail-pjl-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detail Penjualan Dengan Kode Penjualan : <?=$kode_penjualan?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="card-box table-responsive">
                    <table id="datatable" class="table text-center table-striped table-bordered" style="width:100%; font-size:<?=$font_size?>;">
                      <thead>
                        <tr>
													<th>No</th>
                         
                          <th>Nama Produk</th>
                          <th>Harga Satuan</th>
                          <th>Jumlah</th>
                          <th>Harga Total</th>
                        </tr>
                      </thead>
											<tbody>
      <?php 
   //menampilkan data dari tabel

		$detail = mysqli_query($koneksi, "call getdetailpenjualan($kode_penjualan)");
    while(mysqli_next_result($koneksi)){;}
    $t = 0;
		//membuat variabel untuk penomoran
		$no = 1;
//		$jumlah = mysqli_num_rows($query);
//echo ($jumlah);
		//perintah perulangan untuk menampilkan data
		while ($data= mysqli_fetch_assoc($detail)){
			//membuat variabel untuk menampung data 
			$nama_produk = $data['nama_produk'];
			$harga_satuan = $data['harga_satuan'];
			$jumlah = $data['jumlah'];
			$satuan = $data['satuan'];
      $bayar = $data['bayar'];
    ?>
<tr>
			<td><?= $no++?></td>
      
			<td><?= $nama_produk?></td>
      <td>Rp.<?=number_format( $harga_satuan, 0, ',', '.'); ?>-</td>
      <td><?= $jumlah.' '.$satuan ?></td>
      <td>Rp.<?=number_format( $harga_satuan*$jumlah, 0, ',', '.'); ?>-</td>
		</tr>

    <?php $t += ($harga_satuan*$jumlah);} ?>
    </tbody>
</table>
      </div>
      <div align="right">
      <div class="w-25 font-weight-bold">

      <div class="row text-left">
		<div class="col-5"> Total </div>
		<div class="col p-0 ">=</div>
		<div class="col-6">
		<?=number_format($t,0,',','.')?>
		</div>		
	
		<div class="w-100"></div>

		<div class="col-5">	Tunai</div>
		<div class="col-1 p-0 ">=</div>
		<div class="col-6	">
		<?=number_format($bayar,0,',','.')?>
		</div>
		<div class="w-100"><hr class="hr"></div>

		<div class="col-5	"> Kembali </div>
		<div class="col-1 p-0 ">=</div>
		<div class="col-6">
		<?=number_format($bayar-$t,0,',','.')?>
		</div>
</div>

    </div>
      </div>
    </div>
    <div class="modal-footer">
    <div class="d-inline print">
  <a href="<?=$base_url.'/view/report?id='.$kode_penjualan.'&date='.date_format($date,'d-m-Y H:i')?>">
      <button type="button" class="btn btn-primary">
      <i class="fa fa-print"></i>&ensp;Cetak Nota
    </button>
  </a>
</div>
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

      	<!--printing-->
<div class="d-inline print">
  <a href="<?=$base_url.'/view/report?id='.$kode_penjualan.'&date='.date_format($date,'d-m-Y H:i')?>">
      <button type="button" class="btn btn-primary">
      <i class="fa fa-print"></i>&ensp;Cetak Nota
    </button>
  </a>
</div>

<!--delete-->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del-pjl-<?=$id?>"><i class="fa fa-trash"></i>&ensp;Hapus
</button>
<!-- Modal -->
<div class="modal fade" id="del-pjl-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">PERINGATAN !!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus penjualan pada <b><?=date_format($date,"d/m/Y")?></b> <br>dengan kode prnjualan <b><?=$kode_penjualan?></b> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?=$base_url.'/function/hapus?key=penjualan&id='.$kode_penjualan?>">Ya</a>
      </div>
    </div>
  </div>
</div>
			</td>
		</tr>
		<?php }?>
  </tbody>
</table>
</div>
        </font>
                  </div>  
                  </div>
              </div>
            </div
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->
<?php include 'footer.php' ?>