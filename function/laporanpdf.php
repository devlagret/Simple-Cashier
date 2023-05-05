<?php
//============================================================+
// File name   : Laporan Penjualan Bulan {$bulan} Tahun {$tahun}.php
// Begin       : 14-12-2022
// Last Update : 14-12-2022
//
// Description : Laporan penjualan bulan tertentu dan tahun tertentu 
//               dalam format PDF
// Author: AdminKasir (Siswa RPL SMKN 2 Karanganyar)
//
// (c) Copyright:
//               Siswa RPL SMKN 2 Karanganyar
//============================================================+
/**
* Creates monthly sales report in pdf format
* @package kasir
* @abstract Monthly sales report in pdf format
* @author AdminKasir (Siswa RPL SMKN 2 Karanganyar)
* @since 14-12-2022
*/
// Include the main TCPDF library (search for installation path).
require('../lib/tcpdf/tcpdf.php');
include 'crud.php';
?>
<script>
document.onload = setInterval(function(event){ window.location.href = "http://localhost/kasir/view/laporan_penjualan";},1000); 
</script>;<?php
if (isset($_GET['bulan'])&&isset($_GET['tahun'])){
$bulan = $_GET['bulan']; $tahun = $_GET['tahun'];
$dat = getsalesreport($bulan, $tahun);
$tp = 0;
$noo = 1;
foreach ($dat as $d) {
$tp += $d['pendapatan'];
$r .= "<tr>
<td width='40' >".$noo++."</td>
<td>" . $d['nama_produk'] . "</td>
<td>" . $d['jumlah'] . " " . $d['satuan'] . "</td>
<td>Rp. " . number_format($d['harga_satuan'], 0, ',', '.') . "</td>
<td>Rp. " . number_format($d['harga_satuan'] * $d['jumlah'], 0, ',', '.') . "</td>
</tr>";
$conf =getconfig();
foreach ($conf as $dta ){
$config[$dta['name']] = $dta['value'];
}
}
} else {
header("Location:".$base_url."/view/laporan_penjualan?info=error");}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('AdminKasir (Siswa RPL SMKN 2 Karanganyar)');
$pdf->SetTitle('Laporan Penjualan Bulanan');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData('ico.png', 15, PDF_HEADER_TITLE, PDF_HEADER_STRING." ".$config['nama_toko']."\nAlamat : ".$config['alamat_toko']."\nTelepon : ".$config['no_telp'], array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set default font subsetting mode
$pdf->setFontSubsetting(true);
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 14, '', true);
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
// Set some content to print
$html = '<h1>Laporan penjualan bulan '.convmonth($bulan).' Tahun '.$tahun.'</h1><br>';
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '30', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
$html = '
<table border="1" cellspacing="0" cellpadding="5">
<tr>
<th width="40" >NO</th>
<th>Nama Produk</th>
<th>Jumlah Terjual</th>
<th>Harga Satuan</th>
<th>Pendapatan</th>
</tr>
'.$r.'
<tr>
<td align="center"  colspan="4"><span style="font-weight: bold;">Total</span></td>
<td>Rp. '.number_format($tp, 0, ',', '.').' -</td>
</tr>
</table>
';
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Close and output PDF document
ob_end_clean();
$pdf->Output('Laporan Penjualan Bulan '.convmonth($bulan).' Tahun '.$tahun.'.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>