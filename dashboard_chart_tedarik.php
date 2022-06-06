<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT'])."/cgi-bin/functions.php");
$cUtility = new Utility();
$cdb = new db_layer();
$cDat =  new datetime_operations();
if($p=="" || $p < 1)
$p = 1;
$page_size = 200;
require_valid_login();
$HASAR_TABLE = $SESSION['hasar_table'];
$select_Baslik = "SELECT ADI FROM USER_COMPANIES WHERE ID=".OAConf::COMPANY_ID;
$cdb->execute_sql($select_Baslik,$result_baslik,$error_msg);
$row_baslik= mysql_fetch_object($result_baslik);
cagir('popup_mesaj');
popup_mesaj('SIGORTA_TARAFI');
?>
<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");
$kullaniciKontrol   = new kullaniciKontrolClass();
$kullanici_kontrol  = $kullaniciKontrol->kullaniciKontrol();
if(!$kullanici_kontrol){ header("Location:index.php");  }?>
<html>
<head>
    <title><?=$row_baslik->ADI;?> - HYS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chart_repostory/css/style_dashboard.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/yeni_ekran/css/lang.css?<?=rand();?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="chart_repostory/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="chart_repostory/css/morris.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="chart_repostory/css/datepicker.css" type="text/css" media="screen" />
    <script type="text/javascript" src="chart_repostory/js/jquery.mind.js"></script>
    <script type="text/javascript" src="chart_repostory/js/jquery-ui.mind.js"></script>
    <script type="text/javascript" src="chart_repostory/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="chart_repostory/js/bootstrap-datepicker.min.js"></script>
    <script src="chart_repostory/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="../scripts/common.js"></script>


    <script src='chart_repostory/lib/popper.min.js'></script>
    <script src='chart_repostory/lib/raphael.min.js' crossorigin='anonymous'></script>
    <script src='chart_repostory/lib/regression.js' crossorigin='anonymous'></script>
    <script src='chart_repostory/morris.js'></script>

    <script src='chart_repostory/js/html2canvas.min.js'></script>
    <script src='chart_repostory/js/jspdf.min.js'></script>
    <style type="text/css">
        .pc_title {
            background-color: darkred !important;
            color: white !important;
        }

        #pc_panel_fixed {
            background : none;
            background-color: white !important;
        }

        .form-group {
            color: black;
            font-weight: bold;
        }

        .row {
            color: black !important;
        }

        .card {
            font-size: 12px !important;
            font-weight: bold !important;
        }
    </style>
</head>
<body>
    <?php
    /*dashboard*/
    ?>
    <div class="pc_panel_fixed" id="pc_panel_fixed">
        <div id="expand" class="pc_label dexpand btn-jittery"></div>
        <?/*<div class="pc_label close"></div>*/ ?>

        <div class="pc_title">DASHBOARD TEDARİK</div>
        <div id="pc_wrapper" class="pc_wrapper">
            <?php require_once("chart_repostory/navbar.php");?>
           <div id="box"></div>
        </div>
    </div>

    <script>
       $(document).ready(function(){
                var loader;
                $(document).ajaxStart(function() {
                    loader = setTimeout(function(){
                        $('body').append('<div id="loading">\
                                            <div class="spinner">\
                                            <div class="rect1"></div>\
                                            <div class="rect2"></div>\
                                            <div class="rect3"></div>\
                                            <div class="rect4"></div>\
                                            <div class="rect5"></div>\
                                            </div>\
                                        </div>');
                        $("#loading").css("display", "block");
                    }, 500);
                }).ajaxStop(function() {
                    clearTimeout(loader);
                    $('#loading').remove();
                    $("#loading").css("display", "none");
                });
                $("#SIGORTA_SEKLI").val("-1");
                $('#tarih1').val();
                $('#tarih2').val();
                $('#MARKA_ID').val("-1");
                $('#KULLANIM_SEKLI').val("-1");
                $('#TEDARIKCI').val("-1");
                //$("#box").load("chart_repostory/load_data.php");
              }
            );

            $("#succes_button").click(function(){
                BRANS           = $("#SIGORTA_SEKLI").val();
                tarih1          = $('#tarih1').val();
                tarih2          = $('#tarih2').val();
                MARKA_ID        = $('#MARKA_ID').val();
                KULLANIM_SEKLI  = $('#KULLANIM_SEKLI').val();
                TEDARIKCI       = $('#TEDARIKCI').val();
                $("#box").load("chart_repostory/load_data.php?brans=" +BRANS+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +MARKA_ID+ "&kullanim_sekli=" +KULLANIM_SEKLI+ "&tedarikci=" +TEDARIKCI);
            });

            $("#save").click(function() {
                html2canvas(document.getElementById('pc_wrapper')).then(canvas => {
                    var w = document.getElementById("pc_wrapper").offsetWidth;
                    var h = document.getElementById("pc_wrapper").offsetHeight;

                    var img = canvas.toDataURL("image/jpeg", 1);

                    var doc = new jsPDF('L', 'pt', [w, h]);
                    doc.addImage(img, 'JPEG', 10, 10, w, h);
                    doc.save('sample-file.pdf');
                }).catch(function(e) {
                    console.log(e.message);
                });
            });
    </script>

    </body>
</html>