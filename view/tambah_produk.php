<?php include 'header.php' ?>
  <body class="nav-md footer_fixed">
		<title>Kasir - Tambah Produk</title>

  <?php
		//mendapatkan nilai dari url
		if (isset($_GET['add'])){
			if ($_GET['add']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Tambah Data Berhasil</div>';
			}elseif($_GET['add']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">Tambah Data Gagal </div>';
			}
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
                <h3>Tambah Produk</h3>
              </div>
             
              <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix" ></div>

            <div class="row">
							<div class="col-md-12 col-sm-12 ">
								<div class="x_panel">
									<div class="x_title">
									<a class="btn btn-primary ml-3" href="<?=$base_url?>/view/produk">Daftar Produk</a>
									<!--<h2>Form Tambah Produk</h2>-->
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
											</li>
										
										</ul>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<br />
                    
										<form method="post" class="form-horizontal form-label-left">

											<div class="item form-group">
												<label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-produk">Nama Produk <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 ">
													<input type="text" id="text-caps" name="nama-produk" required="required" class="txt form-control" placeholder="Masukkan nama produk disini (e.g Masako, Mobil)">
												</div>
											</div>
											<div class="item form-group">
												<label for="harga-satuan" class="col-form-label col-md-3 col-sm-3 label-align">Harga Satuan<span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 ">
													<input id="harga-satuan" class="form-control" type="number" min='0' step='100' name="harga-satuan" required="required" placeholder="Masukkan harga satuan produk per unit (e.g 1000, 50000, etc)">
												</div>
											</div>
											
                      <div class="item form-group">
												<label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Stok<span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 ">
													<input id="stok" class="form-control" type="number" min='0' name="stok" required="required" placeholder="Masukkan stok produk saat ini (e.g 10,50, etc)">
												</div>
											</div>

											<div class="item form-group">
												<label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Stok Minimal<span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 ">
													<input id="stok" class="form-control" type="number" min='0' name="stok-min" required="required" placeholder="Masukkan stok minial produk (e.g 10,50, etc)">
												</div>
											</div>

                      <div class="item form-group">
												<label for="satuan" class="col-form-label col-md-3 col-sm-3 label-align">Satuan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 "> 
													<input type="text" id="text-caps2" name="satuan" required="required" class="txt form-control" placeholder="Masukkan satuan produk disini (e.g Kg, Pcs, etc)">
												</div>
											</div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
                        <a href="<?=$base_url?>/view/produk">
												<button class="btn btn-primary" type="button">Cancel</button></a>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" name="tambah_produk" class="btn btn-success" >Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
        <!-- /page content -->
<?php include 'footer.php'; ?>