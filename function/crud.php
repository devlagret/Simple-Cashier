<?php 
session_start();
include 'config.php';
if(isset($_POST['login'])){
	$username = mysqli_real_escape_string($koneksi,strtolower(stripslashes($_POST['username'])));
	$password = hash('sha256',$_POST['password']);

	$login = mysqli_query($koneksi,"Select * from tbl_user where username ='$username' and password = '$password'");
	
	$cek = mysqli_num_rows($login);

	if($cek == 1){
		$data = mysqli_fetch_assoc($login);

		if($data['role']=="admin"){
			// buat session login dan username
			$_SESSION['id'] = $data['id_user'];
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['status'] = "login";
			$_SESSION['username'] = $username;
			//cek remember me
			if(isset($_POST['rm'])){

				//buat cookie
				setcookie('id', $data['id_user'],time()+3600*24*2);
				//setcookie('nama', hash('sha256', $data['nama']),time()+3600);
				
				setcookie('key', hash('sha256', $username),time()+3600*24*2);
			header("location:".$base_url."/");
			} else {
				header("location:" . $base_url . "/");
			}
			// alihkan ke halaman  admin
		}	}else{
			header("Location: http://localhost/kasir/view/login?pesan=gagal") ;
		}

	
	//header('Location:'.$base_url.'/'	);
}
if(isset($_POST['tambah_produk'])){
	if (auth()) {
		$add_nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama-produk']);
		$add_harga_satuan = toInt($_POST['harga-satuan']);
		$add_stok = toInt($_POST['stok']);
		$add_satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
		$add_stok_min = toInt($_POST['stok-min']);
		try {
			$add = mysqli_query($koneksi, "INSERT INTO `tbl_produk` (`id`, `nama_produk`, `harga_satuan`, `stok`, `stok_min`, `satuan`) VALUES (NULL, '$add_nama_produk', '$add_harga_satuan', '$add_stok', '$add_stok_min','$add_satuan')");
			if ($add) {
				header("Location:" . $base_url . "/view/tambah_produk?add=berhasil");
			} else {
				header("Location:" . $base_url . "/view/tambah_produk?add=gagal");
			}
		}catch(mysqli_sql_exception $e){
			if(str_contains($e, 'Duplicate entry')) {
				header("Location:" . $base_url . "/view/tambah_produk?info=duplicate&name=".$add_nama_produk);
			}
					die("Error inserting user details into database: " .  $e->getMessage());
				}
	}else{header("Location:".$base_url."/forbiden");}
}
if(isset($_POST['add_stkprd'])){
$id = mysqli_real_escape_string($koneksi,$_POST['id']);
$jumlah = toInt($_POST['jumlah']);
	if (auth()) {
		if ($jumlah <= 0) {
			header("Location:" . $base_url . "/index?add=warn");
		} else {
			$getstok = mysqli_query($koneksi, "SELECT stok FROM tbl_produk WHERE id = $id");
			while ($row = mysqli_fetch_assoc($getstok)) {
				$finalstok = $row['stok'] + $jumlah;
				$addstkprd = mysqli_query($koneksi, "call addstock($jumlah,$id)");
			}
		}
		if ($addstkprd) {
			header("Location:" . $base_url . "/index?add=berhasil");
		} else {
			header("Location:" . $base_url . "/index?add=gagal");
		}
	}else{header("Location:".$base_url."/forbiden");}
}
if (isset($_POST['edit_produk'])) {
	$id = $_POST['id'];

	$ed_nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama-produk']);
	$ed_harga_satuan = toInt($_POST['harga-satuan']);
	$ed_stok = toInt($_POST['stok']);
	$ed_stok_min = toInt($_POST['stok-min']);
	$ed_satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
	if (auth()) {
		try {
			$edit = mysqli_query($koneksi, "UPDATE tbl_produk SET nama_produk = '$ed_nama_produk', harga_satuan = '$ed_harga_satuan', stok = '$ed_stok',stok_min = '$ed_stok_min' , satuan = '$ed_satuan' WHERE id='$id'");

			if ($edit) {
				header("Location:" . $base_url . "/view/produk?update=berhasil");
			} else {
				header("Location:" . $base_url . "/view/produk?update=gagal");
			}
		}catch(mysqli_sql_exception $e){
			if(str_contains($e, 'Duplicate entry')) {
				header("Location:" . $base_url . "/view/produk?info=duplicate&name=".$ed_nama_produk);
			}
					die("Error inserting user details into database: " .  $e->getMessage());
				}
	}else{header("Location:".$base_url."/forbiden");}
}
if(isset($_GET['metode'])){
	$metode = $_GET['metode'];
	$id =$_GET['id'];
	
	$jumlah = toInt($_GET['jumlah']);
	
if($metode=="nama"&&auth()){
	date_default_timezone_set("Asia/Jakarta");
	$date = date("ymdHis");
	$code = $date;
	echo ($code.'<br>');
		echo ("nama selected <br>");
		echo ($id);
		
if($id!=null||$jumlah!=null){
	if(!validatecart()){
   setcode($code);
	}
	if(validatestok($id,$jumlah)){
			$stsmn = $con->prepare("call addcart(?,?)");
			$stsmn -> bind_param('si',$id,$jumlah);
		
			try{
			$stsmn->execute();
		header("Location:".$base_url."/view/kasir?add=berhasil");
	}catch(mysqli_sql_exception $e){echo($e);
		/*
			if (str_contains($e,'Duplicate entry')) {
				// duplicate entry, do something else
			header("Location:".$base_url."/view/kasir?add=exist&name=".$id);
		 }else{
			header("Location:".$base_url."/view/kasir?add=gagal");
		}
		*/
    while(mysqli_next_result($con)){;}
		}
	}else{
		header("Location:".$base_url."/view/kasir?info=lowstok&name=".$id);
	}
}else{
	header("Location:".$base_url."/view/kasir?info=noinput".$id);
}
}else{
	header("Location:".$base_url."/forbiden");
}
}
if (isset($_POST['edit_cart'])) {
$id = mysqli_real_escape_string($koneksi,$_POST['id']);
$jumlah = toInt($_POST['jumlah']);
if(validatestok($id,$jumlah)&&auth()){
$query = mysqli_query($koneksi, "UPDATE tmp_penjualan SET jumlah='$jumlah' WHERE nama_produk='$id'");
if($query){
	header("Location:".$base_url."/view/kasir?edit=berhasil");
}else{
	header("Location:".$base_url."/view/kasir?edit=gagal");
}
}else{
	header("Location:".$base_url."/view/kasir?info=lowstok");
}
}
if (isset($_GET['bayar'])){
$total = $_GET['total'];
$uangbyr = $_GET['uangbyr'];
if($uangbyr==null){$uangbyr=0;}
if($total <= $uangbyr){
	if(validatecart()&&auth()){
		$kode = getcode();
		echo  $kode;
		$byr = setbayar($kode,$uangbyr);
		$result = setdtlpenjualan($kode);
		$clear = resetcart();
		if($result && $clear && $byr){
			header("Location:".$base_url."/view/report?id=".$kode);
		}else{
			header("Location:".$base_url."/view/kasir?bayar=gagal");
		}
			
	}else{header("Location:".$base_url."/view/kasir?info=kosong");}
	}else{header("Location:".$base_url."/view/kasir?info=uangkurang&uang=".$uangbyr);}
}
if(isset($_POST['update_config'])){
	$nama_toko = $_POST['nama_toko'];
	$alamat_toko = $_POST['alamat_toko'];
	$no_tlp = $_POST['no_tlp'];

		$updconf1 = mysqli_query($koneksi,"call setconfig('$nama_toko','nama_toko')");
		while(mysqli_next_result($koneksi)){;}
		$updconf2 = mysqli_query($koneksi,"call setconfig('$alamat_toko','alamat_toko')");
		while(mysqli_next_result($koneksi)){;}
		$updconf3 = mysqli_query($koneksi,"call setconfig('$no_tlp','no_telp')");
		while(mysqli_next_result($koneksi)){;}
		if($updconf1&&$updconf2&&$updconf3){
	header("Location:".$base_url."/home?edit=berhasil");

		}
}

//global function 
function toInt($in){
	$res = preg_replace("/[^0-9]/", "", $in);
	return $res;
}
function validatestok($nama_produk,$jumlah){
	include 'config.php';
	$x = mysqli_real_escape_string($koneksi, $nama_produk);
	$q = mysqli_query($koneksi, "select stok from tbl_produk where nama_produk = '$x'");
	while ( $r = mysqli_fetch_assoc($q)){
		$stok = $r['stok'];
	}
	if($jumlah>$stok){
		return false;
	}elseif($jumlah<$stok){
		return true;}
}
function setcode($code){
	include 'config.php';
	$setpenj = mysqli_query($koneksi,"call setpenjualan('$code')");
  while(mysqli_next_result($koneksi)){;}
	if(!$setpenj){
		echo ('<script>console.log('.mysqli_error($koneksi).')</script>');
	}
}
function setdtlpenjualan($kodes){
	include 'config.php';
	$getcart = mysqli_query($koneksi,"call getmincart()");
  while(mysqli_next_result($koneksi)){;}
	$kode=$kodes;
	while($data = mysqli_fetch_assoc($getcart)){
		$nama_prd = $data['nama_produk'];
		$jmlh = $data['jumlah'];
		$input = mysqli_query($koneksi,"call bayar('$kode','$nama_prd','$jmlh')");
		while(mysqli_next_result($koneksi)){;}
		
	}if($input){
	  return true;
	}else{
		return false;
}}
function setbayar($kdpenj, $byr){
	include 'config.php';
	$byrval = $byr; $kpenj = $kdpenj;
	$sbayar = mysqli_query($koneksi,"call setbayar($kpenj,$byrval)");
  while(mysqli_next_result($koneksi)){;}
if($sbayar){
return true;
}else{
	return false;
}
}
function getcode(){
	include 'config.php';
	$getkode = mysqli_query($koneksi,"call getkodepenj()");
  while(mysqli_next_result($koneksi)){;}
	while ($dta = mysqli_fetch_assoc($getkode)){$kode1 = $dta['kode_penjualan'];}
	return $kode1;
}
function validatecart(){
	include 'config.php';
	$q = mysqli_query($koneksi,"call getmincart()");
  while(mysqli_next_result($koneksi)){;}
	$row = mysqli_num_rows($q);
	if ($row <= 0){
		return false;
	}elseif($row >= 0){
		return true;
	}
}
function resetcart(){
	include 'config.php';

	$result = mysqli_query($koneksi,"call resetcart()");
	while(mysqli_next_result($koneksi)){;}
	if($result){
		return true;
	}else{
		return false;
	}
}
function deletepejualan(){
	include 'config.php';
	$cd = getcode();
	$reset = resetcart();
	$result = mysqli_query($koneksi,"call delpenjualan($cd)");
	while(mysqli_next_result($koneksi)){;}
	if($reset==true && $result==true){
return true;
	}else{
		return false;
	}
}

/**
  * Get Config
	* Get web configuration from database
  * @param null
	* @return bool|mysqli_result Returns `false` on failure. Returns configuration in form of result set { 'name' => 'value' }.
  */
function getconfig(){
	include 'config.php';
	$conf = array();
	$cnf = mysqli_query($koneksi, "call getconfig()");
  while(mysqli_next_result($koneksi)){;}
	while($d = mysqli_fetch_assoc($cnf)){
		$conf[] = $d;
	}
	return $conf;
}

/**
  * Authentication.
	* Check if the user is already logged in before or not
  * @param null
	* @return bool Redirect to forbiden page if not logged in. If already logged in will return 'true'.
  */
function auth(){
	include 'config.php';
	if(isset($_COOKIE['id'])&&isset($_COOKIE['key'])){
		$id=$_COOKIE['id'];
		$key=$_COOKIE['key'];
		//ambil usernae berdasar id
		$result = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE id_user = $id");
		while(mysqli_next_result($koneksi)){;}
		$row = mysqli_fetch_assoc($result);
		// cek cokkie dan username 
		if ($key == hash('sha256',$row['username'])){
			$_SESSION['status'] = "login";
	 }}
	 if (isset($_SESSION['status'])!="login"){
	header("Location: http://localhost/kasir/forbiden") ;
	} elseif (isset($_SESSION['status']) == "login") {
	return true ;
	}
}
/**
 * Converts month.
 * Converts number to month in indonesian language
 * @param int $mouth
 * @return String
 */
function convmonth(int $month){
	if(0< $month && $month <=12){
	$bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus', 'September', 'Oktober', 'November', 'Desember'];
	return $bln[$month-1];
}else{return 'error';}
}
/**
 * Used to get date range of sales. Returns max and min month in inputed year from database.
 * @param int $year
 * @return array|bool|null
 */
function getdaterange(int $year){
include 'config.php';
$y = mysqli_real_escape_string($koneksi,$year);
$daterange = array();
$rg = mysqli_query($koneksi,"call getsaledaterange($y)");
return $daterange = mysqli_fetch_array($rg);
}
/**
 * Get Sales Report 
 *   Get sales report from certain month in certain year 
 * @param int $month 
 * @param int $year
 * @return array
 */
function getsalesreport(int $month, int $year){
	include 'config.php';
	$m = mysqli_real_escape_string($koneksi, $month);
	$y = mysqli_real_escape_string($koneksi, $year);
$dat = array();
    $lp = mysqli_query($koneksi, "call getlappjl($m , $y)");
    while($r = mysqli_fetch_assoc($lp)){
			$dat[] = $r;
		}
		return $dat;
} 