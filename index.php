<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php";
require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/classes/ModulAyarlari.php";

require "same_funcs.php";

// debugPrint($SESSION);

require_valid_login();
$cdb = new db_layer();

//header("Content-Type: text/html; charset=iso-8859-9");
//extract($_POST);
//error_reporting(E_ALL); ini_set('display_errors',1);

cc_page_meta_yeni();
$HASAR_TABLE = OAConf::HASAR_TABLE;

$select_Baslik = "SELECT ADI FROM USER_COMPANIES WHERE ID=".OAConf::COMPANY_ID;
$cdb->execute_sql($select_Baslik,$result_baslik,$error_msg);
$row_baslik= mysql_fetch_object($result_baslik);

if ($SESSION['hasar_user'] == "3") {
    uzman_header_yeni();
    uzman_link_yeni();
} else {
    cc_page_header_yeni(51, "", 511);
}
function cc_page_meta_yeni($value='')
{

}
function cc_page_header_yeni($value='')
{

}

$BUGUN_YIL = date('Y') ;
$BUGUN_AY  = date('m') ;
$BUGUN_GUN = date('d') ;

$YIL = $SESSION['yil'];

$select = "
    SELECT
        SUM(IF(SIGORTA_SEKLI=1,1,0)) AS TRAFIK_TOPLAM,
        SUM(IF(SIGORTA_SEKLI=2,1,0)) AS KASKO_TOPLAM
    FROM {$HASAR_TABLE}
    WHERE 1
        AND USER_EKSPER != 'EKSPER'
";
if ( $YIL!='' ) {
    $select .= " AND KAYIT_YIL = '{$YIL}' ";
}
$cdb->execute_sql($select,$result,$error_msg);
$row_t_k_toplam = mysql_fetch_object($result);

$select = "
    SELECT
        SUM(IF(SIGORTA_SEKLI=1,1,0)) AS TRAFIK_TOPLAM,
        SUM(IF(SIGORTA_SEKLI=2,1,0)) AS KASKO_TOPLAM
    FROM {$HASAR_TABLE}
    WHERE
        KAYIT_YIL = '{$BUGUN_YIL}'
        AND KAYIT_AY = '{$BUGUN_AY}'
        AND KAYIT_GUN = '{$BUGUN_GUN}'
        AND USER_EKSPER != 'EKSPER'
";

$cdb->execute_sql($select,$result,$error_msg);
$row_t_k_toplam_bugun = mysql_fetch_object($result);

$select = "
    SELECT
        COUNT(*) AS YANGIN_TOPLAM
    FROM YANGIN_HASAR
";
if ( $YIL!='' ) {
    $select .= "
        WHERE
            KAYIT_TARIH_SAAT > '{$YIL}-01-01 00:00:00'
            AND KAYIT_TARIH_SAAT < '{$YIL}-12-31 23:59:59'
    ";
}

$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_yangin = mysql_fetch_object($result);

$select = "
    SELECT
        COUNT(*) AS YANGIN_TOPLAM
    FROM YANGIN_HASAR
    WHERE
        KAYIT_TARIH_SAAT > '{$BUGUN_YIL}-{$BUGUN_AY}-{$BUGUN_GUN} 00:00:00'
";
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_yangin_bugun = mysql_fetch_object($result);

$toplam_acilan_dosya_bazli       = $row_toplam_yangin->YANGIN_TOPLAM + $row_t_k_toplam->TRAFIK_TOPLAM + $row_t_k_toplam->KASKO_TOPLAM;
$toplam_acilan_bugun_dosya_bazli = $row_toplam_yangin_bugun->YANGIN_TOPLAM + $row_t_k_toplam_bugun->TRAFIK_TOPLAM + $row_t_k_toplam_bugun->KASKO_TOPLAM;

$toplam_acilan_eksperli       = 0;
$toplam_acilan_eksperli_bugun = 0;

/*
$select = "
    SELECT COUNT(*) AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
          IFNULL(U.HKM_EKSPER,0) != '1'
      AND IFNULL(U.HKM,0) != '1'
      AND IFNULL(U.FATURALI_KULLANICI,0) != '1'
      AND IFNULL(U.OTOMOTIV,0) != '1'
      AND USER_EKSPER <> 'EKSPER'

";
if ( $YIL!='' ) {
    $select .= "  AND KAYIT_YIL='".$YIL."'";
}
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_eksperli_dosyalar = mysql_fetch_object($result);
$toplam_acilan_eksperli += $row_toplam_eksperli_dosyalar->TOPLAM;

$select = "
    SELECT COUNT(*) AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
          IFNULL(U.HKM_EKSPER,0) != '1'
      AND IFNULL(U.HKM,0) != '1'
      AND IFNULL(U.FATURALI_KULLANICI,0) != '1'
      AND IFNULL(U.OTOMOTIV,0) != '1'
      AND USER_EKSPER <> 'EKSPER'
      AND KAYIT_YIL='".$BUGUN_YIL."' AND KAYIT_AY='".$BUGUN_AY."' AND KAYIT_GUN='".$BUGUN_GUN."'"
;
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_eksperli_dosyalar_bugun = mysql_fetch_object($result);
$toplam_acilan_eksperli_bugun += $row_toplam_eksperli_dosyalar_bugun->TOPLAM;

$select = "
    SELECT COUNT(*)  AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
    1
    AND IFNULL(U.HKM_EKSPER,0) = '0'
    AND IFNULL(U.FATURALI_KULLANICI,0) = '1'
    AND IFNULL(U.OTOMOTIV,0) != '1'
    AND USER_EKSPER <> 'EKSPER'

";
if ( $YIL!='' ) {
    $select .= "  AND KAYIT_YIL='".$YIL."'";
}
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_faturali_dosyalar = mysql_fetch_object($result);
$toplam_acilan_eksperli += $row_toplam_faturali_dosyalar->TOPLAM;

$select = "
    SELECT COUNT(*)  AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
    1
    AND IFNULL(U.HKM_EKSPER,0) = '0'
    AND IFNULL(U.FATURALI_KULLANICI,0) = '1'
    AND IFNULL(U.OTOMOTIV,0) != '1'
    AND USER_EKSPER <> 'EKSPER'
    AND KAYIT_YIL='".$BUGUN_YIL."' AND KAYIT_AY='".$BUGUN_AY."' AND KAYIT_GUN='".$BUGUN_GUN."'"
;
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_faturali_dosyalar_bugun = mysql_fetch_object($result);
$toplam_acilan_eksperli_bugun += $row_toplam_faturali_dosyalar_bugun->TOPLAM;

$select = "
    SELECT COUNT(*)  AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
    1
    AND IFNULL(U.HKM_EKSPER,0) = '1'
    AND IFNULL(U.FATURALI_KULLANICI,0) = '1'
    AND IFNULL(U.OTOMOTIV,0) != '1'
    AND USER_EKSPER <> 'EKSPER'
";

if ( $YIL!='' ) {
    $select .= "  AND KAYIT_YIL='".$YIL."'";
}
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_anlasmali_dosyalar = mysql_fetch_object($result);
$toplam_acilan_eksperli += $row_toplam_anlasmali_dosyalar->TOPLAM;

$select = "
    SELECT COUNT(*)  AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
    1
    AND IFNULL(U.HKM_EKSPER,0) = '1'
    AND IFNULL(U.FATURALI_KULLANICI,0) = '1'
    AND IFNULL(U.OTOMOTIV,0) != '1'
    AND USER_EKSPER <> 'EKSPER'
    AND KAYIT_YIL='".$BUGUN_YIL."' AND KAYIT_AY='".$BUGUN_AY."' AND KAYIT_GUN='".$BUGUN_GUN."'"
;
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_anlasmali_dosyalar_bugun = mysql_fetch_object($result);
$toplam_acilan_eksperli_bugun += $row_toplam_anlasmali_dosyalar_bugun->TOPLAM;

$select = "
    SELECT COUNT(*)  AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
    1
    AND IFNULL(U.HKM_EKSPER,0) = '0'
    AND IFNULL(U.FATURALI_KULLANICI,0) = '1'
    AND IFNULL(U.OTOMOTIV,0) = '1'
    AND USER_EKSPER <> 'EKSPER'

";
if ( $YIL!='' ) {
    $select .= "  AND KAYIT_YIL='".$YIL."'";
}
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_cam_dosyalar = mysql_fetch_object($result);
$toplam_acilan_eksperli += $row_toplam_cam_dosyalar->TOPLAM;

$select = "
    SELECT COUNT(*)  AS TOPLAM FROM $HASAR_TABLE H
    INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
    1
    AND IFNULL(U.HKM_EKSPER,0) = '0'
    AND IFNULL(U.FATURALI_KULLANICI,0) = '1'
    AND IFNULL(U.OTOMOTIV,0) = '1'
    AND USER_EKSPER <> 'EKSPER'
    AND KAYIT_YIL='".$BUGUN_YIL."' AND KAYIT_AY='".$BUGUN_AY."' AND KAYIT_GUN='".$BUGUN_GUN."'"
;
$cdb->execute_sql($select,$result,$error_msg);
$row_toplam_cam_dosyalar_bugun = mysql_fetch_object($result);
$toplam_acilan_eksperli_bugun += $row_toplam_cam_dosyalar_bugun->TOPLAM;

*/

    $qry = "
    SELECT
        COUNT(*) AS TOPLAM_ADET,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=0 AND IFNULL(U.FATURALI_KULLANICI,0)=0 AND IFNULL(U.OTOMOTIV,0)=0,1,0)) AS EKSPERLI,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=0 AND IFNULL(U.FATURALI_KULLANICI,0)=1 AND IFNULL(U.OTOMOTIV,0)=0,1,0)) AS FATURALI,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=1 AND IFNULL(U.FATURALI_KULLANICI,0)=1 AND IFNULL(U.OTOMOTIV,0)=0,1,0)) AS MODUL,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=0 AND IFNULL(U.FATURALI_KULLANICI,0)=1 AND IFNULL(U.OTOMOTIV,0)=1,1,0)) AS CAMCI
    FROM $HASAR_TABLE H
        INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
        USER_EKSPER <> 'EKSPER'
    ";
    if ( $YIL!='' ) {
        $qry .= "  AND KAYIT_YIL='".$YIL."'";
    }
    $cdb->execute_sql($qry,$result_0,$error_msg);
    $row_0 = mysql_fetch_object($result_0);
    $toplam_acilan_eksperli += $row_0->TOPLAM_ADET;

    $qry = "
    SELECT
        COUNT(*) AS TOPLAM_ADET,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=0 AND IFNULL(U.FATURALI_KULLANICI,0)=0 AND IFNULL(U.OTOMOTIV,0)=0,1,0)) AS EKSPERLI,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=0 AND IFNULL(U.FATURALI_KULLANICI,0)=1 AND IFNULL(U.OTOMOTIV,0)=0,1,0)) AS FATURALI,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=1 AND IFNULL(U.FATURALI_KULLANICI,0)=1 AND IFNULL(U.OTOMOTIV,0)=0,1,0)) AS MODUL,
        SUM(IF(IFNULL(U.HKM,0)=0 AND IFNULL(U.HKM_EKSPER,0)=0 AND IFNULL(U.FATURALI_KULLANICI,0)=1 AND IFNULL(U.OTOMOTIV,0)=1,1,0)) AS CAMCI
    FROM $HASAR_TABLE H
        INNER JOIN USERS U ON U.U_NAME = H.USER_EKSPER
    WHERE
        USER_EKSPER <> 'EKSPER'
        AND KAYIT_YIL = '{$BUGUN_YIL}'
        AND KAYIT_AY = '{$BUGUN_AY}'
        AND KAYIT_GUN = '{$BUGUN_GUN}'
";

    $cdb->execute_sql($qry,$result_bugun,$error_msg);
    $row_bugun = mysql_fetch_object($result_bugun);
    $toplam_acilan_eksperli_bugun += $row_0->TOPLAM_ADET;

$select = "
    SELECT
        COUNT(*) AS TOPLAM,
        KAYIT_AY
    FROM {$HASAR_TABLE}
    WHERE 1
        AND USER_EKSPER != 'EKSPER'
        AND SIGORTA_SEKLI = 2
";
if ( $YIL!='' ) {
    $select .= " AND KAYIT_YIL = '{$YIL}' ";
}
$select.= '  GROUP BY KAYIT_AY ';
$cdb->execute_sql($select,$result_aylik_kasko,$error_msg);

$select = "
    SELECT
        COUNT(*) AS TOPLAM,
        KAYIT_AY
    FROM {$HASAR_TABLE}
    WHERE 1
        AND SIGORTA_SEKLI = 1
        AND USER_EKSPER != 'EKSPER'
";
if ( $YIL!='' ) {
    $select .= "  AND KAYIT_YIL = '{$YIL}' ";
}
$select.= '  GROUP BY KAYIT_AY ';

$cdb->execute_sql($select,$result_aylik_trafik,$error_msg);

$select = "
    SELECT
        COUNT(*) AS TOPLAM,
        MONTH(KAYIT_TARIH_SAAT) AS KAYIT_AY
    FROM YANGIN_HASAR
    WHERE 1
";
if ( $YIL!='' ) {
    $select .= "
        AND KAYIT_TARIH_SAAT > '{$YIL}-01-01 00:00:00'
        AND KAYIT_TARIH_SAAT < '{$YIL}-12-31 23:59:59'
    ";
}
$select.= ' GROUP BY MONTH(KAYIT_TARIH_SAAT) ';

$cdb->execute_sql($select,$result_aylik_yangin,$error_msg);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="ISO-8859-9">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$row_baslik->ADI?> - HYS</title>
        <link href="/yeni_ekran/css/bootstrap4.min.css" rel="stylesheet">
        <!-- <link href="/yeni_ekran/css/bootstrap4.min.css" rel="stylesheet"> -->
        <link href="/yeni_ekran/css/font-awesome.min.css" rel="stylesheet">
        <link href="/yeni_ekran/css/style.css?<?=rand();?>" rel="stylesheet">
        <!-- <link href="css/prettify.min.css" rel="stylesheet"> -->
        <link href="js/morris/morris.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="/yeni_ekran/js/jquery-2.2.5.min.js"></script>
        <script language="JavaScript" type="text/JavaScript" src="/scripts/common.js"></script>

        <script src="/yeni_ekran/js/bootstrap4.min.js"></script>

        <script type="text/javascript" src="/yeni_ekran/js/fusioncharts.js"></script>
        <script type="text/javascript" src="/yeni_ekran/js/themes/fusioncharts.theme.fint.js"></script>

        <script type="text/javascript" src="/yeni_ekran/js/raphael-min.js"></script>
        <script type="text/javascript" src="/yeni_ekran/js/morris/morris.min.js"></script>
        <script type="text/javascript" src="/yeni_ekran/js/jquery.devrama.slider.min-0.9.4.js"></script>
        <?
        $_GET['popup_goster'] = 1;
        cagir('popup_mesaj');
        popup_mesaj('SIGORTA_TARAFI');
        ?>
    </head>
    <body>
    <div id="content" style="min-width: 1348px;">
        <? require "menu.php"; ?>
        <div class="container" style="max-width: 1348px;">
            <div id="sayfa-ortasi">
                <table width="100%" height="100%">
                    <tr>
                        <td>
                            <div id="my-slide">
                                <div style="background-color: white;">
                                    <table width="100%">
                                        <td width="50%" align="right">
                                            <table width="80%">
                                                <tr>
                                                    <td align="center">
                                                        <div><strong><?=dil('Bugün Açýlan Dosyalar');?></strong></div>
                                                        <div id="chartContainer4"></div>
                                                        <div><strong><?=dil('Toplam');?> <?=$toplam_acilan_bugun_dosya_bazli?> <?=dil('Adet');?></strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="50%" align="left">
                                            <table width="80%">
                                                <tr>
                                                    <td align="center">
                                                        <div><strong><?=dil('Kümül Açýlan Dosyalar');?></strong></div>
                                                        <div id="chartContainer5"></div>
                                                        <div><strong><?=dil('Toplam');?> <?=$toplam_acilan_dosya_bazli?> <?=dil('Adet');?></strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </table>
                                </div>
                                <div style="background-color: white;">
                                    <table width="100%">
                                        <td width="50%" align="right">
                                            <table width="80%">
                                                <tr>
                                                    <td align="center">
                                                        <div><strong><?=dil('Bugün Açýlan Dosyalar');?></strong></div>
                                                        <div id="chartContainer6"></div>
                                                        <div><strong><?=dil('Toplam');?> <?=$toplam_acilan_eksperli_bugun?> <?=dil('Adet');?></strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="50%" align="left">
                                            <table width="80%">
                                                <tr>
                                                    <td align="center">
                                                        <div><strong><?=dil('Kümül Açýlan Dosyalar');?></strong></div>
                                                        <div id="chartContainer7"></div>
                                                        <div><strong><?=dil('Toplam');?> <?=$toplam_acilan_eksperli?> <?=dil('Adet');?></strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" style="margin-top: 10px; margin-bottom: 60px;">
                                <tr>
                                    <td colspan="2" width="100%">
                                        <table width="100%" border="0" cellpadding="2" cellspacing="2" style="margin-top: 10px;">
                                            <tr>
                                                <?php
                                                $width = 50;
                                                if ($row_toplam_yangin->YANGIN_TOPLAM > 0) {
                                                    $width = 33;
                                                }
                                                ?>
                                                <td width="<?=$width?>%" align="center">
                                                    <div id="chartContainer1"><?=dil('Lütfen Bekleyiniz');?>...</div>
                                                </td>
                                                <td width="<?=$width?>%" align="center">
                                                    <div id="chartContainer2"><?=dil('Lütfen Bekleyiniz');?>...</div>
                                                </td>
                                                <?php if ($row_toplam_yangin->YANGIN_TOPLAM > 0) { ?>
                                                    <td width="<?=$width?>%" align="center">
                                                        <div id="chartContainer3"><?=dil('Lütfen Bekleyiniz');?>...</div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- <footer>
                <div class="container">
                </div>
            </footer> -->
        </div>
        <script src="js/hys-menu.js"></script>
            <script>
            function yil_degistir(yil){
                $.ajax({
                    type: "POST",
                    url: "/yil.php",
                    cache: false,
                    data: {'YIL':yil},
                    success: function(j){

                        window.location.reload();
                    },
                    beforeSend: function(){

                    }
                });
              return false;
            }

            FusionCharts.ready(function() {
                var revenueChart = new FusionCharts({
                    "type": "column2d",
                    "renderAt": "chartContainer1",
                    "width": "400",
                    "height": "300",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                            "caption": "<?=dil('Aylýk Açýlan Kasko Dosyalarý');?>",
                            //"subCaption": "",
                            "xAxisName": "<?=dil('Aylar');?>",
                            "yAxisName": "<?=dil('Dosya Adetleri');?>",
                            "theme": "fint",
                            "showToolTip": "0",
                            "palettecolors": "#F6BD0F,#FF6600,#8BBA00,#F984A1,#A66EDD,#B2FF66,#AFD8F8",
                            "valueFontColor": "#000000"
                        },

                        "data": [
                         <?php aylikGrafikChart($result_aylik_kasko);?>
                        ]
                    }
                });

                revenueChart.render();
            });

            FusionCharts.ready(function() {
                var revenueChart = new FusionCharts({
                    "type": "column2d",
                    "renderAt": "chartContainer2",
                    "width": "400",
                    "height": "300",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                            "caption": "<?=dil('Aylýk Açýlan Trafik Dosyalarý');?>",
                            "subCaption": "",
                            "xAxisName": "<?=dil('Aylar');?>",
                            "yAxisName": "<?=dil('Dosya Adetleri');?>",
                            "theme": "fint",
                            "showToolTip": "0",
                            "palettecolors": "#F6BD0F,#FF6600,#8BBA00,#F984A1,#A66EDD,#B2FF66,#AFD8F8",
                            "valueFontColor": "#000000"
                        },
                        "data": [
                        <?php aylikGrafikChart($result_aylik_trafik);?>
                        ]
                    }
                });

                revenueChart.render();
            });
            <?php if ($row_toplam_yangin->YANGIN_TOPLAM > 0) { ?>

            FusionCharts.ready(function() {
                var revenueChart = new FusionCharts({
                    "type": "column2d",
                    "renderAt": "chartContainer3",
                    "width": "400",
                    "height": "300",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                            "caption": "<?=dil('Aylýk Açýlan Otodýþý Dosyalarý');?>",
                            "subCaption": "",
                            "xAxisName": "<?=dil('Aylar');?>",
                            "yAxisName": "<?=dil('Dosya Adetleri');?>",
                            "theme": "fint",
                            "showToolTip": "0",
                            "palettecolors": "#F6BD0F,#FF6600,#8BBA00,#F984A1,#A66EDD,#B2FF66,#AFD8F8",
                            "valueFontColor": "#000000"
                        },
                        "data": [

                        <?php aylikGrafikChart($result_aylik_yangin);?>

                      ]
                    }
                });

                revenueChart.render();
            });
<? } ?>

Morris.Donut({
    element: 'chartContainer4',
    data: [{
        value: <?=sifir_kontrol($row_t_k_toplam_bugun->KASKO_TOPLAM)?>,
        label: '<?=dil("Kasko");?>'
    }, {
        value: <?=sifir_kontrol($row_t_k_toplam_bugun->TRAFIK_TOPLAM)?>,
        label: '<?=dil("Trafik");?>'
    }, {
        value: <?=sifir_kontrol($row_toplam_yangin_bugun->YANGIN_TOPLAM)?>,
        label: '<?=dil("Otodýþý");?>'
    }],
    formatter: function(x) {
        return x + " <?=dil('adet');?>"
    },
    colors: [
        '#55AB47',
        '#007F46',
        '#00FF21'
    ],
}).on('click', function(i, row) {

});

Morris.Donut({
    element: 'chartContainer5',
    data: [{
        value: <?=sifir_kontrol($row_t_k_toplam->KASKO_TOPLAM)?>,
        label: '<?=dil("Kasko");?>'
    }, {
        value: <?=sifir_kontrol($row_t_k_toplam->TRAFIK_TOPLAM)?>,
        label: '<?=dil("Trafik");?>'
    }, {
        value: <?=sifir_kontrol($row_toplam_yangin->YANGIN_TOPLAM)?>,
        label: '<?=dil("Otodýþý");?>'
    }],
    formatter: function(x) {
        return x + " <?=dil('adet');?>"
    },
    colors: [
        '#55AB47',
        '#007F46',
        '#00FF21'
    ],
}).on('click', function(i, row) {
    //console.log(i, row);
});

Morris.Donut({
    element: 'chartContainer6',
    data: [{
        value: <?=sifir_kontrol($row_bugun->EKSPERLI)?>,
        label: '<?=dil("Eksper Atanmýþ");?>'
    }, {
        value: <?=sifir_kontrol($row_bugun->FATUALI)?>,
        label: '<?=dil("Faturalý");?>'
    }, {
        value: <?=sifir_kontrol($row_bugun->MODUL)?>,
        label: '<?=dil("Anlaþmalý Modül");?>'
    }
    , {
        value: <?=sifir_kontrol($row_bugun->CAMCI)?>,
        label: '<?=dil("Cam Modül");?>'
    }],
    formatter: function(x) {
        return x + " <?=dil('adet');?>"
    },
    colors: [
        '#55AB47',
        '#007F46',
        '#00FF21',
        '#0ed078'
    ],
}).on('click', function(i, row) {
    //console.log(i, row);
});

Morris.Donut({
    element: 'chartContainer7',
    data: [{
        value: <?=sifir_kontrol($row_0->EKSPERLI)?>,
        label: '<?=dil("Eksper Atanmýþ");?>'
    }, {
        value: <?=sifir_kontrol($row_0->MODUL)?>,
        label: '<?=dil("Anlaþmalý");?>'
    }, {
        value: <?=sifir_kontrol($row_0->FATURALI)?>,
        label: '<?=dil("Faturalý Modül");?>'
    }
    , {
        value: <?=sifir_kontrol($row_0->CAMCI)?>,
        label: '<?=dil("Cam Modül");?>'
    }],
    formatter: function(x) {
        return x + " <?=dil('adet');?>"
    },
    colors: [
        '#55AB47',
        '#007F46',
        '#00FF21',
        '#0ed078'
    ],
}).on('click', function(i, row) {
    //console.log(i, row);
});

$('#my-slide').DrSlider({
    width: '100%', //slide width
    height: 340, //slide height
    showProgress: true,
    progressColor: '#F0F0F0',
    showNavigation: false,
    showControl: true,
    duration: 4000,

    /*
    controlColor: '#000000',
    controlBackgroundColor: '#F0F0F0',
    */
});

jQuery(document).ready(function($) {
    $('#my-slide').show();
});

<?if($SESSION['company_id']==37){?>
        popup('/hasar/sorumlu_dosya_inceleme.php','sorumlu_dosyalari',995,640);
<?}?>
        </script>
    </div>

<?
require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php";
$kullaniciKontrol  = new kullaniciKontrolClass();
$kullanici_kontrol = $kullaniciKontrol->kullaniciKontrol();
if($kullanici_kontrol != "" ){?>
    <link rel="stylesheet" href="dashboard_repostory/css/style_dashboard.css?<?=rand()?>" type="text/css" media="screen" />
    <?
    // KULLANICI HAKLARI
    $qry = "SELECT * FROM USERS_YETKI WHERE SILINDI=0 AND USER_ID='".$SESSION['user_id']."'";
    if(!($cdb->execute_sql($qry,$result_ky,$error_msg))){ print_error($error_msg); exit; }
    while($row_ky = mysql_fetch_object($result_ky)){
        $KULLANICI_YETKILI[$row_ky->YETKI_ID]=$row_ky->YETKI_ID;
    }
    ?>
    <nav class="navbar fixed-bottom navbar-expand-sm navbar-light bg-light" style="z-index: 1000;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto" style="justify-content: center;">
                <li class="nav-item btn btn-danger btn-sm footerBtn">
                    <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard.php','_blank');"><i class="fa fa-line-chart"></i> <?=dil('Dosya Durumlarý');?></a>
                </li>
                <?if (in_array('29',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/summary_report.php','_blank');"><i class="fa fa-line-chart"></i> <?=dil('Özet', 'Summary');?></a>
                    </li>
                <?}?>
                <?if (in_array('26',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_tasarruf.php','_blank');"><i class="fa fa-pie-chart"></i> <?=dil('Tasarruflar');?></a>
                    </li>
                <?}?>
                <?if (in_array('36',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_portfoy.php','_blank');"><i class="fa fa-pie-chart"></i> <?=dil('Portföy Analizi', 'Portfolio Analysis');?></a>
                    </li>
                <?}?>
                <?if (in_array('27',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_degisimler.php','_blank');"><i class="fa fa-pie-chart"></i> <?=dil('Deðiþimler');?></a>
                    </li>
                <?}?>
                <?if (in_array('28',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_top10.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Top 10');?></a>
                    </li>
                <?}?>
                <?if (in_array('4',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_genel.php','_blank');"><i class="fa fa-pie-chart"></i> <?=dil('Genel Durum');?></a>
                    </li>
                <?}?>
                <?if (in_array('5',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_dosya.php','_blank');"><i class="fa fa-file-o"></i> <?=dil('Dosya');?></a>
                    </li>
                <?}?>
                <?if (in_array('39',$KULLANICI_YETKILI) && !in_array($SESSION['company_id'], array(18, 30, 75))){
                    // ANADOLU, ALLIANZ, HALK, SOMPO HARÝÇ
                    ?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_dosya_surec.php','_blank');"><i class="fa fa-file-o"></i> <?=dil('Dosya Süreçleri');?></a>
                    </li>
                <?}?>
                <?if (in_array('6',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_dagilim.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Genel Daðýlým');?></a>
                    </li>
                <?}?>
                <?if (in_array('41',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_garanti.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Garanti Ýçi');?></a>
                    </li>
                <?}?>
                <?if (in_array('42',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_garanti.php?gd=1','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Garanti Dýþý');?></a>
                    </li>
                <?}?>
                <?if (in_array('40',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_model_yili.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Model Yýllarý', 'Model Years');?></a>
                    </li>
                <?}?>
            </ul>
            <ul class="navbar-nav mr-auto"  style="margin-top: 3px; margin-bottom: 3px; justify-content: center;">
                <?if (in_array('31',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_tedarik_odeme.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Yedek Parça');?></a>
                    </li>
                <?}?>
                <?if (in_array('35',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_parca_maliyet.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Parça Bazýnda');?></a>
                    </li>
                <?}?>
                <?if (in_array('32',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_iscilik.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Ýþçilik');?></a>
                    </li>
                <?}?>
                <?if (in_array('43',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_tamir.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Onarým');?></a>
                    </li>
                <?}?>
                <?if (in_array('7',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_sektor.php','_blank');"><i class="fa fa-globe"></i> <?=dil('Sektör');?></a>
                    </li>
                <?}?>
                <?if (in_array('14',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_sektor_yil.php','_blank');"><i class="fa fa-globe"></i> <?=dil('Sektör Yýl');?></a>
                    </li>
                <?}?>
                <?if (in_array('38',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_sektor_aralik.php','_blank');"><i class="fa fa-globe"></i> <?=dil('Sektör YP&ÝÞÇ.', 'Sector SP&LBR');?></a>
                    </li>
                <?}?>
                <?if (in_array('37',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_sektor_degisim.php','_blank');"><i class="fa fa-globe"></i> <?=dil('Sektör Ay');?></a>
                    </li>
                <?}?>
                <?if (in_array('8',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_chart1.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Tedarik', 'Spare Part Delivery');?></a>
                    </li>
                <?}?>
                <?if (in_array('17',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_chart_sektor_tedarik.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Tedarik Sektör');?></a>
                    </li>
                <?}?>
                <?if (in_array('9',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/tedarikci_performans.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Tedarikçi Performans');?></a>
                    </li>
                <?}?>
				<?if (in_array('45',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_chart_sektor_yok_parcalar.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Sektör Tedarik Performans');?></a>
                    </li>
                <?}?>
                <?if (in_array('44',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_kacan_firsatlar.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Tedarik Kaçan Fýrsatlar');?></a>
                    </li>
                <?}?>
                <?if (in_array('30',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_chart2.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Eþdeðer/LO', 'Alternative Parts');?></a>
                    </li>
                <?}?>
            </ul>
            <ul class="navbar-nav mr-auto"  style="margin-top: 0px; margin-bottom: 0.3rem; justify-content: center;">
                <?if (in_array('15',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_servis.php','_blank');"><i class="fa fa-search"></i> <?=dil('Servis Performans');?></a>
                    </li>
                <?}?>
                <?if (in_array('18',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_eksper.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Eksper');?></a>
                    </li>
                <?}?>
                <?if (in_array('19',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_chart1.1.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Anlaþmalý Servis');?></a>
                    </li>
                <?}?>
                <?if (in_array('20',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_mobil_onarim.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Mobil');?></a>
                    </li>
                <?}?>
                <?if (in_array('21',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_alternatif_tamir.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Alternatif Tamir');?></a>
                    </li>
                <?}?>
                <?if (in_array('22',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_cam.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Cam');?></a>
                    </li>
                <?}?>
                <?if (in_array('23',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_otodisi.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Oto Dýþý');?></a>
                    </li>
                <?}?>
                <?if (in_array('24',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_denetci.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Denetçi');?></a>
                    </li>
                <?}?>
                <?if (in_array('25',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_uzman.php','_blank');"><i class="fa fa-area-chart"></i> <?=dil('Uzman');?></a>
                    </li>
                <?}?>
                <?if (in_array('16',$KULLANICI_YETKILI)){?>
                    <!-- <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/harita/harita.php','_blank');"><i class="fa fa-area-chart"></i> Eksper Performans</a>
                    </li> -->
                <?}?>
                <?if (in_array('10',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/ypZam.php','_blank');"><i class="fa fa-money"></i> <?=dil('Yedek Parça Zam');?></a>
                    </li>
                <?}?>
                <?if (in_array('11',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/harita/harita.php','_blank');"><i class="fa fa-map-o"></i> <?=dil('Harita');?></a>
                    </li>
                <?}?>
                <?if (in_array('12',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_loginLogs.php','_blank');"><i class="fa fa-sign-in"></i> <?=dil('Kullanýcý Giriþleri (Log)');?></a>
                    </li>
                <?}?>
                <?if (in_array('13',$KULLANICI_YETKILI)){?>
                    <li class="nav-item btn btn-danger btn-sm footerBtn">
                        <a class="nav-link" href="javascript:void(0);" onclick="window.open('/yeni_ekran/dashboard_userTrack.php','_blank');"><i class="fa fa-search"></i> <?=dil('Dosya Görüntüleme (Log)');?></a>
                    </li>
                <?}?>
            </ul>
        </div>
    </nav>

    <script type="text/javascript" src="dashboard_repostory/js/jquery.min_dashboard.js"></script>
    <script type="text/javascript" src="dashboard_repostory/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/jq/jquery.base64.js"></script>

    <script type="text/javascript">
        $("#expand").toggle(function() {
            var loader;
            console.log('toggle');
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
            $('#month3').removeClass("btn-success");
            $('#month3').addClass("btn-warning");
            $('#month12').removeClass("btn-warning");
            $('#month12').addClass("btn-success");
            $('#sorumlu').val("-1");
            $("#sigorta_sekli").val("-1");
            $('#S_TUR').val("0");
            $("#box").load("dashboard_repostory/load_data.php?type=3");
        }, function() {
            location.reload(true);
        });

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
            $("#box").load("dashboard_repostory/load_data.php?type="+type);
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
            $("#box").load("dashboard_repostory/load_data.php?type="+type);
        });

        $("#succes_button").click(function(){
            sorumlu = $("#sorumlu").val();
            brans   = $("#sigorta_sekli").val();
            servis_turu = $("#S_TUR").val();
            $("#box").load("dashboard_repostory/load_data.php?type=" +type+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu);
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

        var window_w = $(window).width();
        var window_h = $(window).height();
        var maxWidth, maxHeight, marginL;
    </script>
<?
}
?>
</body>
</html>
<?php

function sifir_kontrol($data){
    if ($data > 0 ) {
        return $data;
    }
    return 0;
}

function aylikGrafikChart($result_aylik_kasko='')
{
     while ( $row = mysql_fetch_object($result_aylik_kasko) ) {
                $virgül = ',';
                switch ($row->KAYIT_AY) {
                    case '1':
                        $ay = dil('Oca.');
                        break;
                    case '2':
                        $ay = dil('Þub.');
                        break;
                    case '3':
                        $ay = dil('Mar.');
                        break;
                    case '4':
                        $ay = dil('Nis.');
                        break;
                    case '5':
                        $ay = dil('May.');
                        break;
                    case '6':
                        $ay = dil('Haz.');
                        break;
                    case '7':
                        $ay = dil('Tem.');
                        break;
                    case '8':
                        $ay = dil('Agu.');
                        break;
                    case '9':
                        $ay = dil('Eyl.');
                        break;
                    case '10':
                        $ay = dil('Eki.');
                        break;
                    case '11':
                        $ay = dil('Kas.');
                        break;
                    case '12':
                        $ay = dil('Ara.');
                        $virgül = '';
                        break;
                }
                echo '
                     {
                        "label": "'.$ay.'",
                        "value": "'.$row->TOPLAM.'"
                    }'.$virgül
                ;
            }
}