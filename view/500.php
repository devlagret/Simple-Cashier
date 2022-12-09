<?php include $_SERVER['DOCUMENT_ROOT'].'/kasir/function/config.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kasir - Internal Server Error </title>
    <link rel="icon" href="<?= $tab_icon_path ?>" type="image/<?= $tab_icon_file_type ?>">

    <!-- Bootstrap -->
    <link href="<?=$base_url?>/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$base_url?>/node/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link href="<?=$base_url?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=$base_url?>/assets/node/node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
    <!-- NProgress -->
    <link href="<?=$base_url?>/assets/nprogress/nprogress.css" rel="stylesheet">
  <!-- Custom Theme Style -->
	<link href="<?=$base_url?>/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">500</h1>
              <h2>Internal Server Error</h2>
              <p class="mb-5">Jika ini terjadi, Harap hubungi pengembang
              </p>
              <h5 class="mt-5"><a href="<?=$base_url?>/"><i class="fa-solid fa-desktop fa-lg"></i>&ensp;Beranda</a></h5>
            </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
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

       <!-- Custom Theme Scripts -->
			 <script src="<?=$base_url?>/build/js/custom.min.js"></script>
  </body>
</html>