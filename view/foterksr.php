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
<!-- Datatables -->
<script src="<?=$base_url?>/assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?=$base_url?>/assets/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?=$base_url?>/assets/jszip/dist/jszip.min.js"></script>
<script src="<?=$base_url?>/assets/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=$base_url?>/assets/pdfmake/build/vfs_fonts.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?=$base_url?>/build/js/custom.min.js"></script>
<script src="<?=$base_url?>/build/js/cst.js"></script>
<script>
console.log("tets");let numb = document.getElementsByClassName("txt form-control")
<?php
$q = mysqli_query($koneksi, "call getnmprd();");
while(mysqli_next_result($koneksi)){;}
$a = array();
while ($data= mysqli_fetch_assoc($q)) {
$nama_produk = $data['nama_produk'];
array_push($a, $nama_produk);
}
echo ('var prd = [`'.implode('`,`',$a).'`];');
?>
autocomplete(document.getElementById("kd-prd-txt"), prd)
</script>
</body>
</html>