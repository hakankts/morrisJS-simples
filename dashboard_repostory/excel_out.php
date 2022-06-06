<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php";
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/root/Spreadsheet/Excel/Writer.php';
require_valid_login();
$cUtility       = new Utility();
$cdb            = new db_layer();
$SESSION['EXC'] = str_replace(",", "", $SESSION['EXC']);
$str            = $SESSION['EXC'];
$workbook       = new Spreadsheet_Excel_Writer();

$workbook->send('excel_out.xls');
$worksheet1 = &$workbook->addWorksheet(dil_dashboard("sheet1", "sheet1"));

$satir = explode("\n", $str);
//$sutun = explode(";",$satir);
$i = 0;
foreach ($satir as $v) {
    $sutun = explode(";", $v);
    $j     = 0;
    foreach ($sutun as $vv) {
        $worksheet1->write($i, $j, $vv);
        $j++;
    }
    $i++;
}
$workbook->close();
echo $str;
