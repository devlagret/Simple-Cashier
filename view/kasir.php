<?php include 'header.php'?>	
<title>Kasir - Kasir</title>
<style type="text/css">
small {margin-right:5px;}
</style>
  <body class="nav-md">
  <?php
    //Mendapatkan Total Harga Barang Yang Dibeli//
   $t_query = mysqli_query($koneksi, "call getttlcart()");
   while(mysqli_next_result($koneksi)){;}
       $t_dat = mysqli_fetch_array($t_query);
       $tot_uf=$t_dat['jumlah'];
    ////////////////////////////////////////////////////////////////   
$tot = 0;
//mendapatkan uang yang dibayarkan sebelumnya dari link
$tot_byr ;
if(isset($_GET['uang'])){$tot_byr=$_GET['uang'];}
/////////////////////////////////////////////////////// 
		//mendapatkan nilai dari url
		if (isset($_GET['hapus'])){
			if ($_GET['hapus']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Hapus Item Berhasil</div>';
			}elseif($_GET['hapus']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Hapus Item Gagal </div>';
			}
		}
    //mendapatkan nilai dari url
		if (isset($_GET['edit'])){
			if ($_GET['edit']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Edit Item Berhasil</div>';
			}elseif($_GET['edit']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Edit Item Gagal </div>';
			}
		}
		//mendapatkan nilai dari url
		if (isset($_GET['add'])){
			if ($_GET['add']=='berhasil'){
				echo '<div class="alert alert-success" role="alert">Tambah Pesanan Berhasil</div>';}
      
      elseif($_GET['add']=='gagal'){
				echo'<div class="alert alert-danger" role="alert">
				Tambah Pesanan Gagal. Pastikan Nama Produk Ada di Daftar Produk </div>';
			}elseif($_GET['add']=='exist'){
      
				echo'<div class="alert alert-warning" role="alert">
				Produk <b>"'.$_GET['name'].'"</b> Sudah Ditambahkan</div>';
			}
    }
      if (isset($_GET['info'])&&isset($_GET['name'])){
        if($_GET['info']=='lowstok'){
          echo'<div class="alert alert-danger" role="alert">
          Stok Tidak Mencukupi, Harap Tambah Stok Produk <b>"'.$_GET['name'].'"</b></div>';
        }}
        if(isset($_GET['info'])&& !(isset($_GET['name']))){
        if($_GET['info']=='lowstok'){
          echo'<div class="alert alert-danger" role="alert">
          Stok Tidak Mencukupi, Harap Tambah Stok Produk </div>';}
        if($_GET['info'] =='empty'){
          echo '<div class="alert alert-success" role="alert">Item di Kasir Sudah Bersih</div>';
        }if($_GET['info'] =='canceled'){
          echo '<div class="alert alert-success" role="alert">Berhasil Memersihkan Pembelian</div>';
        }if($_GET['info'] =='notcanceled'){
          echo '<div class="alert alert-danger" role="alert">Gagal Memersihkan Pembelian</div>';
        }if($_GET['info'] =='kosong'){
          echo '<div class="alert alert-danger" role="alert">Harap Tambahkan Produk yang Akan Dibeli</div>';
        }if($_GET['info'] =='noinput'){
          echo '<div class="alert alert-danger" role="alert">Nama atau Jumlah Produk yang Dibeli Masih Kosong</div>';
        }if($_GET['info'] =='uangkurang'){
          echo '<div class="alert alert-danger" role="alert">Uang Yang Dibayarkan Tidak Cukup ( Uang Kurang Rp.'.number_format( $tot_uf-$tot_byr, 0, ',', '.').' - )</div>';
        }
        }

            //menampilkan data kasir dari tabel
    $query = mysqli_query($koneksi, "call getcart();");
	while(mysqli_next_result($koneksi)){;}

    //$jumorder = mysqli_fetch_row($query);
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
                <?php 
                $kode_penjualan = null;
                if(validatecart()){
                  $kode_penjualan = getcode();
       
                }
                ?>
                <h3>Kode penjualan : <b><?=$kode_penjualan?></b></h3>
         
              </div> 

              <div class="title_right">
                <div class="col-lg-auto col-md-5  form-group pull-right top_search">
  <h1>Total : Rp. <?= number_format($tot_uf, 0, ',', '.')?> -</h1>
              
           </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title"> 
                  <form autocomplete="off" action="<?=$base_url?>/function/crud.php" id="frm-ksr" name="addtocart" class="form-inline align-items-center">
  <div class="autocomplete">
    <labe>Nama produk : </label>
    <input type="hidden" name="metode" value="nama">
  
    <input type="text" id="kd-prd-txt" tabindex="1" name="id" placeholder="Masukan Nama/Kode Produk yang Akan Dibeli" class="txt form-control mx-sm-3" style="width:275px!important;" aria-describedby="nm-prd">
    <input type="submit" hidden /> 

  </div>
  <div class="form-group row ml-5">
    <label for="jumlah">  Jumlah : </label>
    <input type="number" id="jumlah" tabindex="3" name="jumlah" min="1" placeholder="Masukan Jumlah Produk yang Akan Dibeli" class="form-control mx-sm-4" style="width:260px!important;" >
  </div>
  <input type="submit" hidden />
<button id="tbl-tbh" type="button" tabindex="4" name="addtocart" class="btn btn-success mt-1 mx-3" onclick="tambah()">Tambah</button>
<button type="button" data-toggle="modal" tabindex="7" data-target="#bayar" class="btn btn-success mt-1 mx-3" <?php if(!validatecart()){echo 'disabled';} ?>>Bayar</button>   
<button type="button"  data-toggle="modal" tabindex="6" data-target="#hapus-cart" class="btn btn-danger mt-1 mx-3">Batal</button>
                  </form>
<div class="modal fade <?php if(isset($_GET['uang'])){echo 'show';} ?>" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Masukan uang yang dibayar : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <form autocomplete="off" action="<?=$base_url?>/function/crud.php" id="frm-ksr-byr"><input name="bayar" type="hidden" value="1"><input name="id" type="hidden" value="<?=$kode_penjualan?>">
      <div class="row">
      <div class="col-4"><h5>Total </h5></div>
      <div class="col p-0"><h5>:</h5></div>
      <div class="col-6"><h5>Rp. <?= number_format($tot_uf, 0, ',', '.')?> -  </h5></div>
      </div>
      <input type="hidden" id="total" value="<?=$t_dat['jumlah']?>" name="total">
<div class="form-group row ">
    <label for="jumlah-byr" class="col-sm-auto col-form-label">  Uang Dibayar: </label>
    <div class="col-sm-1">
      <input type="number" id="jumlah-byr" name="uangbyr" min="100" step="100" value="<?=$tot_byr?>" placeholder="Masukan Jumlah Uang yang Dibayarkan" class="num form-control " style="width:160px;" <?php if(!validatecart()){echo 'disabled';} ?>>
      <input type="submit" hidden /> 
    </div>
  </div>     


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info
                      " data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" id="btn" type="reset">Reset</button>
                      <button id="tbl-byr" type="button" name="bayar" class="btn btn-success" onclick="byrr()" <?php if(!validatecart()){echo 'disabled';} ?>>Bayar</button>   
                  </form>
      </div>
    </div>
  </div>
</div>

                  </form>


<!-- Modal -->
      <div class="modal fade" id="hapus-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">PERINGATAN !!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="d-flex justify-content-center">
             <b> Yakin ingin menghapus semua produk yang akan dibeli ?</b></div>  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
              <a class="btn btn-danger" href="<?=$base_url.'/function/hapus?key=cart&id='.$kode_penjualan?>">Ya</a>
            </div>
          </div>
        </div>
      </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                  <table id="datatable" class="table text-center table-striped table-bordered" style="width:100%; font-size:<?=$font_size?>;">
                      <thead>
                        <tr>
												<th>No</th>
                          <!--<th>Kode Produk</th>-->
                          <th>Nama Produk</th>
                          <th>Harga Satuan</th>
                          <th>Jumlah</th>
                          <th>Harga Total</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
											<tbody>
                        <div class="btn_container">
		<?php 


    while(mysqli_next_result($koneksi)){;}
    

      //membuat variabel untuk penomoran
      $no = 1;
//		$jumlah = mysqli_num_rows($query);
//echo ($jumlah);
		//perintah perulangan untuk menampilkan data
		while ($data= mysqli_fetch_assoc($query)){
			//membuat variabel untuk menampung data 
      $id = $data['id'];
			//$kode_produk = $data['kode_produk'];
			$nama_produk = $data['nama_produk'];
			$harga_satuan = $data['harga_satuan'];
			$jumlah = $data['jumlah'];
			$satuan = $data['satuan'];
      
		?>
		<tr>
			<td><?= $no++?></td>
  
			<td><?= $nama_produk?></td>
      <td>Rp.<?=number_format( $harga_satuan, 0, ',', '.'); ?>-</td>
      <td><?= $jumlah.' '.$satuan ?>&ensp; <button type="button" class="btn btn-sm btn-warning mb-0" data-toggle="modal" data-target="#edit-sk-<?=$id?>"><i class="fa fa-pencil"></i></button>
     <!-- Modal -->
<div class="modal fade" id="edit-sk-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Pembelian Produk <b>'<?=$nama_produk ?>'</b> : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <form method="post" id="ed-form" class="form-horizontal form-label-left">
        <input type="hidden" name="id" value="<?=$nama_produk?>">
                      <div class="item form-group justify-content-center mb-0 mt-1">
												<label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Jumlah<span class="required">*</span></label>
												<div class="input-group col-sm-6 mt-2">
													<input id="stok" class="form-control " type="number" min="1" name="jumlah" required="required" value="<?=$jumlah?>" placeholder="Masukkan Jumlah produk (e.g 10,50, etc)">
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
                      <button type="submit" name="edit_cart" class="btn btn-success" >Submit</button>
                   
                  </form>
      </div>
    </div>
  </div>
</div>
    </td>
      <td>Rp.<?php $tt = $harga_satuan*$jumlah; echo number_format( $tt, 0, ',', '.');?>-</td>
			<td class="text-center" >
      <button type="button"  data-toggle="modal" data-target="#hapus-item-<?=$id?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
      <!-- Modal -->
      <div class="modal fade" id="hapus-item-<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">PERINGATAN !!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Yakin ingin menghapus item <b><?=$nama_produk ?></b> ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
              <a class="btn btn-danger" href="<?=$base_url.'/function/hapus?key=cartitm&id='.$id?>">Ya</a>
            </div>
          </div>
        </div>
      </div>
			</td>
		</tr>
		<?php 

  } ?>
  </div>
		</tbody>
         </table>
                  </div>
                </div>
              </div>
            </div>
</div>
        </div>       
        <!-- /page content -->
      <?php include 'foterksr.php' ?>