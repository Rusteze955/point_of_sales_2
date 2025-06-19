<?php
ob_clean();
require_once '/vendor/autoload.php';
require_once "";
$mpdf = new \Mpdf\Mpdf();
$idPrint = $_GET['print'];
$qTransactions = mysqli_query($config, "SELECT * FROM transactions  WHERE id = $idPrint");
$rowTrans = mysqli_fetch_assoc($qTransactions);
$html = "<h1>{$rowTrans['no_transaction']}</h1>";
$mpdf->WriteHTML($html);
$mpdf->Output();
