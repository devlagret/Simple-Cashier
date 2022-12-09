<?php include 'header.php' ?>
<title>Kasir - Daftar Produk</title>
  <body class="nav-md footer_fixed">
  <?php
		//mendapatkan nilai dari url
		if (isset($_GET['hapus'])){
			if ($_GET['hapus']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Hapus Produk Berhasil</div>';
			}elseif($_GET['hapus']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Hapus Produk Gagal </div>';
			}
		}
		//mendapatkan nilai dari url
		if (isset($_GET['update'])){
			if ($_GET['update']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Edit Produk Berhasil</div>';}
      
      elseif($_GET['update']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Edit Produk Gagal </div>';
			}}?>
 
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            
          <?php include 'navbar.php' ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Produk</h3>
              </div>
             
              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  
                </div>
              </div>
            </div>
            <div class="clearfix" ></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                     <a class="btn btn-primary ml-3" href="<?=$base_url?>/view/tambah_produk">Tambah Produk</a>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box mb-4 table-responsive">
                
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%; font-size:<?=$font_size?> !important;">
                      <thead>
                        <tr>
													<th>No</th>
                          <!--<th>Kode Produk</th>-->
                          <th>Nama Produk</th>
                          <th>Harga satuan</th>
                          <th>Stok</th>
                          <th>Stok Min</th>
                          <th>Satuan</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
											<tbody>
                        <div class="btn_container">
		<?php 
		//menampilkan data dari tabelzz0

		$query = mysqli_query($koneksi, "call getprd()");
		//membuat variabel untuk penomoran
		$no = 1;
		$jumlah = mysqli_num_rows($query);
		//perintah perulangan untuk menampilkan data
		while ($data= mysqli_fetch_assoc($query)){
			//membuat variabel untuk menampung data 
      $id=$data["id"];
			//$kode_produk=$data['kode_produk'];
			$nama_produk=$data['nama_produk'];
			$harga_satuan=$data['harga_satuan'];
			$stok=$data['stok'];
      $stok_min=$data['stok_min'];
			$satuan=$data['satuan'];
		?>
		<tr>
			<td><?= $no++ ?></td>
		
			<td><?= $nama_produk?></td>
			<td>Rp.<?=number_format( $harga_satuan, 0, ',', '.'); ?>-</td>
			<td><?= $stok?></td>
      <td><?= $stok_min?></td>
			<td><?= $satuan?></td>
			<td class="text-center" >
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-produk-<?=$id?>"><i class="fa fa-pencil"></i><b>&ensp;Edit Produk</b>
</button>

<!-- Modal -->
<div class="modal fade" id="edit-produk-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Produk <b>'<?=$nama_produk ?>'</b> : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form method="post" id="ed-form" class="form-horizontal form-label-left">
              <input type="hidden" name="id" value="<?=$id?>" >
											<div class="item form-group">
												<label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-produk">Nama Produk <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 ">
													<input type="text" id="text-caps" name="nama-produk" required="required" class="txt form-control" value="<?=$nama_produk?>" placeholder="Masukkan nama produk disini (e.g Masako, Mobil)">
												</div>
											</div>
											<div class="item form-group">
												<label for="harga-satuan" class="col-form-label col-md-3 col-sm-3 label-align">Harga Satuan<span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 ">
													<input id="harga-satuan" class="form-control" type="number" min='0' step='100' name="harga-satuan" required="required" value="<?=$harga_satuan?>" placeholder="Masukkan harga satuan produk per unit (e.g 1000, 50000, etc)">
												</div>
											</div>
											<div class="item form-group">
												<label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Stok<span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 ">
													<input id="stok" class="form-control" type="number" min='0' name="stok" required="required" value="<?=$stok?>" placeholder="Masukkan stok produk saat ini (e.g 10,50, etc)">
												</div>
											</div>
                      <div class="item form-group">
												<label for="stok-min" class="col-form-label col-md-3 col-sm-3 label-align">Stok Minimal<span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 ">
													<input id="stok-min" class="form-control" type="number" min='0' name="stok-min" required="required" value="<?=$stok_min?>" placeholder="Masukkan stok minimal produk (e.g 10,50, etc)">
												</div>
											</div>
                      <div class="item form-group">
												<label for="satuan" class="col-form-label col-md-3 col-sm-3 label-align">Satuan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 "> 
													<input type="text" id="text-caps2-<?=$id?>" name="satuan" required="required" class="txt form-control" value="<?=$satuan?>" placeholder="Masukkan satuan produk disini (e.g Kg, Pcs, etc)">
												</div>
											</div>            
      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info
                      " data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" id="btn" type="reset">Reset</button>
                      <button type="submit" name="edit_produk" class="btn btn-success" >Submit</button>
                   
                  </form>
      </div>
    </div>
  </div>
</div>
    
      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-data-<?=$id?>"><i class="fa fa-trash"></i><b>&ensp;Hapus Produk</b>
</button>

<!-- Modal -->
<div class="modal fade" id="hapus-data-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">PERINGATAN !!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus produk <b><?=$nama_produk ?></b> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?=$base_url.'/function/hapus?key=prd&id='.$id?>">Ya</a>
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
        <!-- /page content -->
<?php include 'footer.php' ?>