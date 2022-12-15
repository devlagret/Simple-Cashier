<?php
$conf =getconfig();

foreach ($conf as $dta ){
  $config[$dta['name']] = $dta['value'];
}
//user autentification
include $include_path.'function/auth.php';
?>
<div class="navbar nav_title" style="border: 0;">
              <a href="<?=$base_url?>/" class="site_title"><i class="fa-solid fa-cash-register"></i><span> KASIR</span></a>
            </div>

            <div class="clearfix"></div>
 
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=$img_profile_path?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $username ?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
             

                <h3>General</h3>
                <ul class="nav side-menu">
								<li><a  href="<?=$base_url?>/"><i class="fa-solid fa-desktop fa-lg"></i> &ensp;Beranda</span></a>	</li>
                  <li><a href="<?=$base_url?>/view/kasir"><i class="fa-sharp fa-solid fa-cash-register fa-xl"></i> &ensp;Kasir </span></a></li>
                  
                <li><a><i class="fa fa-archive"></i> Produk <span class="fa fa-chevron-down"></a>
                  <ul class="nav child_menu">
                    <li><a href="<?=$base_url?>/view/tambah_produk">Tambah Produk</a></li>
                    <li><a href="<?=$base_url?>/view/produk">Daftar Produk</a></li>
                  </ul>
                </li>
                <li><a href="<?=$base_url?>/view/riwayat_penjualan"><i class="fa fa-history"></i> Riwayat Penjualan </a>
            </li>
            <li><a href="<?=$base_url?>/view/laporan_penjualan"><i class="fa fa-calendar-days"></i> Laporan Penjualan </a>
            </li>

                 
             
                </ul>
              </div>
             

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="modal" data-placement="top" data-target="#setting" title="Pengaturan">
                <!--<button type="button" data-toggle="modal"  >-->
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              <!--</button>-->
              </a>
       
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=$base_url?>/function/logout ">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?=$img_profile_path?>" alt=""><?=$username?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    
                      <a class="dropdown-item"  href="<?=$base_url.'/function/logout'?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                </ul>
              </nav>
            </div>
          </div>
           <!-- Modal -->
  <div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLongTitle">Pengaturan :</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="form-setting" method="POST" data-parsley-validate class="form-horizontal form-label-left">

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-toko">Nama Toko <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 ">
    <input type="text" id="nama-toko" name="nama_toko" required="required" value="<?= $config['nama_toko']?>" class="txt form-control " placeholder="Masukan Nama Toko">
  </div>
</div>
<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama-toko">Alamat Toko <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 ">
    <input type="text" id="nama-toko" name="alamat_toko" required="required" value=" <?= $config['alamat_toko']?>" class="txt form-control" placeholder="Masukan Alamat Toko">
  </div>
</div>
<div class="item form-group">
  <label for="no-tlp" class="col-form-label col-md-3 col-sm-3 label-align">No Telepon</label>
  <div class="col-md-6 col-sm-6 ">
    <input id="no_tlp" class="form-control" type="number" min="0" name="no_tlp" value="<?= $config['no_telp']?>" placeholder="Masukan no tlp (0821212...)">
  </div>
</div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  <button type="submit" class="btn btn-info" name="update_config">Simpan</button>
</form>
            </div>
          </div>
        </div>
      </div>
        <!-- /top navigation -->