<?php
include 'config.php';
session_start();
//perintah mengakhiri session:
$_SESSION=[];
session_unset();
session_destroy();
//menhapus cookie
setcookie('id','',time()-3600);
setcookie('key','',time()-3600);
//mengalihkan kembali ke halaman login
header("Location:".$base_url."/");
exit;
?>