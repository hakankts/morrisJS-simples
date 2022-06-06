<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT'])."/cgi-bin/functions.php");
$cUtility = new Utility();
$cdb      = new db_layer();
$cDat     = new datetime_operations();
if($p=="" || $p < 1)
    $p = 1;
$page_size = 200;
require_valid_login();
$HASAR_TABLE   = $SESSION['hasar_table'];
$select_Baslik = "SELECT ADI FROM USER_COMPANIES WHERE ID=".OAConf::COMPANY_ID;
$cdb->execute_sql($select_Baslik,$result_baslik,$error_msg);
$row_baslik = mysql_fetch_object($result_baslik);
cagir('popup_mesaj');
popup_mesaj('SIGORTA_TARAFI');

require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");
$kullaniciKontrol   = new kullaniciKontrolClass();
$kullanici_kontrol  = $kullaniciKontrol->kullaniciKontrol();
if(!$kullanici_kontrol){ header("Location:index.php");  }
?>
<html>
<head>
    <title><?=$row_baslik->ADI;?> - HYS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chart_repostory/css/style_dashboard.css?<?=rand();?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="/yeni_ekran/css/lang.css?<?=rand();?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="dashboard_repostory/css/bootstrap.css" type="text/css" media="screen" />
    <script type="text/javascript" src="dashboard_repostory/js/jquery.mind.js"></script>
    <script type="text/javascript" src="dashboard_repostory/js/jquery-ui.mind.js"></script>
    <script src="dashboard_repostory/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="../scripts/common.js"></script>

    <style type="text/css">
        .pc_title {
            background-color: darkred !important;
            color: white !important;
        }

        .pc_panel {
            background : none;
            background-color: white !important;
        }

        #pc_panel_fixed {
            background : none;
            background-color: white !important;
        }

        .form-group {
            color: black;
            font-weight: bold;
        }

        .card {
            font-size: 12px !important;
            font-weight: bold !important;
            color: black !important;
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

        <div class="col-lg-12" style="margin-bottom:10px;padding: 0px;">
        <div class="col-lg-10" style="padding: 0px;"><div class="pc_title"><?=dil_dashboard("DOSYA DURUMLARI")?></div></div>
            <? include_once "dil_sec.php";?>
		</div>

        <div id="pc_wrapper" class="pc_wrapper">
            <?php require_once("dashboard_repostory/navbar.php");?>
           <div id="box"></div>
        </div>
    </div>

    <script type="text/javascript" src="/jq/jquery.base64.js"></script>
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
                    $("#loading").css({"display":"block", "z-index" : 999999});
                }, 500);
            }).ajaxStop(function() {
                clearTimeout(loader);
                $('#loading').remove();
                $("#loading").css("display", "none");
            });

            var type = $('#month3').val();
            $('#month3').removeClass("btn-success");
            $('#month3').addClass("btn-warning");
            $('#month12').removeClass("btn-warning");
            $('#month12').addClass("btn-success");
            $('#sorumlu').val("-1");
            $("#sigorta_sekli").val("-1");
            $('#S_TUR').val("0");
            // $("#box").load("dashboard_repostory/load_data.php?type="+type);
            $('.panel.panel-warning').attr('style', 'height:' + $('.panel.panel-warning:first').height() + 'px !important');
        });

        function pdfMake(id, filename) {

            jQuery.loadScript = function (url, callback) {
                jQuery.ajax({
                    url: url,
                    dataType: 'script',
                    success: callback,
                    async: true
                });
            }

            function postPDF(){
                $.base64.utf8encode = true;
                var htmlIcerik = $.base64.btoa($('#' + id).html());

                $.post('/toPDF.php', {contentHTML: htmlIcerik, fileName: filename}, function(data, textStatus, xhr) {
                    if (data.file_name) {
                        popup('/toPDF.php?download=' + data.file_name, 'PDFDownload', 700, 100);
                    }
                }, "json");
            }

            if (typeof $.base64 == 'undefined') {
                $.loadScript('/jq/jquery.base64.js', function(){
                    postPDF();
                });
            } else {
                postPDF();
            }

        }

        var type = $('#month3').val();
        $("#month3").click(function(){
            $('#month3').removeClass("btn-success");
            $('#month3').addClass("btn-warning");
            $('#month12').removeClass("btn-warning");
            $('#month12').addClass("btn-success");
            $('#sorumlu').val("-1");
            $("#sigorta_sekli").val("-1");
            $('#S_TUR').val("0");
            type = $('#month3').val();
            $("#box").load("dashboard_repostory/load_data.php?type="+type, function(){
                $('.panel.panel-warning').attr('style', 'height:' + $('.panel.panel-warning:first').height() + 'px !important');
            });
        });

        $("#month12").click(function(){
            $('#month12').removeClass("btn-success");
            $('#month12').addClass("btn-warning");
            $('#month3').removeClass("btn-warning");
            $('#month3').addClass("btn-success");
            $('#sorumlu').val("-1");
            $("#sigorta_sekli").val("-1");
            $('#S_TUR').val("0");
            type = $('#month12').val();
            $("#box").load("dashboard_repostory/load_data.php?type="+type, function(){
                $('.panel.panel-warning').attr('style', 'height:' + $('.panel.panel-warning:first').height() + 'px !important');
            });
        });

        $("#succes_button").click(function(){
            sorumlu = $("#sorumlu").val();
            brans   = $("#sigorta_sekli").val();
            servis_turu = $("#S_TUR").val();
            $("#box").load("dashboard_repostory/load_data.php?type=" +type+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu, function(){
                $('.panel.panel-warning').attr('style', 'height:' + $('.panel.panel-warning:first').height() + 'px !important');
            });
        });
    </script>
    </body>
</html>