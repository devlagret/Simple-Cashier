<?php
//cekcookie
if(isset($_COOKIE['id'])&&isset($_COOKIE['key'])){
$id=$_COOKIE['id'];
$key=$_COOKIE['key'];
//ambil usernae berdasar id
$rst = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE id_user = $id");
while(mysqli_next_result($koneksi)){;}
$row = mysqli_fetch_assoc($rst);
// cek cokkie dan username 
if ($key == hash('sha256',$row['username'])){
$_SESSION['status'] = "login";

}}	
if (isset($_SESSION['status'])!="login"){
header("Location: http://localhost/kasir/view/login") ;
} 
?>