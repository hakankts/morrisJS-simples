<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT'])."/cgi-bin/rc4/class.rc4crypt.php");
$rc4   = new rc4crypt();
$crypt = new Crypto();
// ini_set("display_errors", 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL ^ E_NOTICE);
?>
<nav class="navbar">
    <div class="container-fluid" style="width: 100%; padding: 0;">
        <div class="navbar-header" style="margin:0 auto;">
            <div id="logo">
                <img src="images/<?=$SESSION['company_id']?>_logo.png" border="0" style="margin-top: 5px; margin-right:20px; max-width: 190px;" />
            </div>
            <div id="hys-logo" title="OtoAnaliz - Hasar Yönetim Sistemi">
            </div>
            <div id="logo-yan-menu">
                <div id="dilSecAlani">
                    <div class="dilBox dilTR <?=$SESSION['dil'] == 'T' ? 'dilActive' : '';?>" title="<?=dil('Türkçe')?>"><a href="/dil.php?l=T&PAGE=<?=$_SERVER['PHP_SELF']?>"></a></div>
                    <div class="dilBox dilEN <?=$SESSION['dil'] == 'E' ? 'dilActive' : '';?>" title="<?=dil('Ýngilizce')?>"><a href="/dil.php?l=E&PAGE=<?=$_SERVER['PHP_SELF']?>"></a></div>
                </div>
                <span id="kullanici-adi"><?=$SESSION['adi']?></span>
                <div style="clear: both"></div>
                        <script>
                            function runScript(e) {
                                if (e.keyCode == 13) {
                                    parent.location.href='/hasar/hasar_src.php?act=src&DOSYA_NO='+document.all('dosyaAraInput').value;
                                    return false;
                                }
                            }
                        </script>
                            <input class="dosyaAraInput" type="text" name="dosyaAraInput" id="dosyaAraInput" placeholder="<?=dil('Dosya Ara');?>..." maxlength="15" onkeypress="return runScript(event)"  >

                            <?if($Degerler['YENI_MENU_ILK_TARIH'] <= date("Y-m-d")){?>
                                <button type="button" class="btn btn-default btn-sm" title="<?=dil("Tüm Menüler")?>" onclick="$('#tumMenuler').show(function(){$('#tumMenuler').css('width', '100%');}); $('body').css('overflow', 'hidden');"><i class="fa fa-bars fa-lg" aria-hidden="true"></i> <?=dil('Raporlar & Admin');?></button>
                                <button type="button" class="btn btn-default btn-sm" title="<?=dil("Multicat Online")?>" onclick="popup('/mc.php', 'MC', 780, 600);"><?=dil('M.O.');?></button>
                                <button type="button" class="btn btn-default btn-sm" title="<?=dil("Sigorta Katalog")?>" onclick="popup('/KATALOG/redirect.php');"><?=dil('S.K.');?></button>
                            <?}?>

                            <!-- <button type="button" class="btn btn-default btn-sm" onclick="location.href='/login_image.php'"><i class="fa fa-home fa-lg" aria-hidden="true"></i> Ana Sayfa</button> -->
                            <button type="button" class="btn btn-default btn-sm" onclick="location.href='/hasar/hasar_src.php'"><i class="fa fa-search fa-lg" aria-hidden="true"></i> <?=dil('Hasar Arama');?></button>
                            <button type="button" class="btn btn-default btn-sm" onclick="javascript:popup('/hkmeks/onay.php','HKM',800,600);"><i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i> <?=dil('Dosya Ýnceleme');?></button>
                            <button type="button" class="btn btn-default btn-sm" onclick="popup('/hasar/chgpass.php','PASS',400,220);"><i class="fa fa-key fa-lg" aria-hidden="true"></i> <?=dil('Þifre Deðiþtir');?></button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?=dil('Kýsayollar');?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button" onclick="javascript:popup('/mesaj/liste.php','MESAJ',0,0);"><?=dil('Mesaj Gönder');?></button>
                                    <button class="dropdown-item" type="button" onclick="javascript:popup('http://havuz.hasaryonetimi.com/zam/zam.php?lang=<?=$SESSION['dil']?>','ZAM',0,0);"><?=dil('Yedek Parça Zam');?></button>
                                    <button class="dropdown-item" type="button"><?=dil('Önerilerim');?></button>
                                    <?php
                                    $taleplerim_kontrol = taleplerim_kontrol();
                                    if ($taleplerim_kontrol != false){ ?>
                                        <button class="dropdown-item" type="button" onclick="javascript:popup('<?=$taleplerim_kontrol?>','TALEPLER',800,600);" target="blank"><?=dil('Taleplerim');?></button>
                                    <?php } // taleplerim_kontrol
                                    if(  $SESSION['username'] == 'OTOIT2' || menu_gizle_goster(1) != true){?>
                                        <button class="dropdown-item" type="button" onclick="javascript:popup('/servisler/harita.php','SERVISLER',800,600);"><?=dil('Network Haritasý');?></button>
                                    <?}?>

                                </div>
                            </div>

                            <!--div class="btn-group" role="group">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-link fa-lg" aria-hidden="true"></i>
                                        Kýsayollar <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="dropdown-menu pull-right" role="menu">

                                        <li><a href="#" onclick="javascript:popup('/mesaj/liste.php','MESAJ',0,0);">Mesaj Gönder</a></li>
                                        <li><a href="#" onclick="javascript:popup('http://havuz.hasaryonetimi.com/zam/zam.php?lang=<?=$SESSION['dil']?>','ZAM',0,0);">Yedek Parça Zam</a></li>
                                        <li><a href="#">Önerilerim</a></li>
                                        <?php
                                        $taleplerim_kontrol = taleplerim_kontrol();
                                        if ($taleplerim_kontrol != false){ ?>
                                            <li><a href="#" onclick="javascript:popup('<?=$taleplerim_kontrol?>','TALEPLER',800,600);" target="blank" >Taleplerim</a></li>
                                        <?php } // taleplerim_kontrol
                                        if(  $SESSION['username'] == 'OTOIT2' || menu_gizle_goster(1) != true){?>
                                            <li><a href="#" onclick="javascript:popup('/servisler/harita.php','SERVISLER',800,600);">Network Haritasý</a></li>
                                        <?}?>

                                    </ul>
                                </div>
                            </div-->

                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                    <a tabindex="-1" href="javascript:void(0);"><?=dil('Yýl');?> (<?
                                        if(empty($SESSION['yil'])){
                                            echo dil('TÜMÜ');
                                        } else {
                                            echo $SESSION['yil'];
                                        }
                                    ?>) </a><span class="caret"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php
                                    YilSecimi();
                                    ?>
                                </div>
                            </div>
                            <!--div class="btn-group" role="group">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                                        <a tabindex="-1" href="#">Yýl (<?
                                            if(empty($SESSION['yil'])){
                                                echo dil('TÜMÜ');
                                            } else {
                                                echo $SESSION['yil'];
                                            }
                                        ?>) </a><span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <?php
                                            YilSecimi();
                                        ?>

                                    </ul>
                                </div>
                            </div-->
                </div>
            </div>

            <?if($Degerler['YENI_MENU_ILK_TARIH'] <= date("Y-m-d")){?>
                <div id="tumMenuler" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="document.getElementById('tumMenuler').style.width='0%'; $('body').css('overflow', 'auto');">&times;</a>
                    <iframe src="/tummenu/index.php" border="0" width="100%" height="100%" name="tummenu"></iframe>
                </div>
            <?}?>

            <?php

    $SQL = " SELECT * FROM ADMIN_CONFIG";
    $cdb->execute_sql($SQL,$result111,$error_msg);
    $rw                   = mysql_fetch_object($result111);
    $RC4_PASSWORD         = $rw->RC4_PASSWORD;
    $code                 = urlencode(base64_encode($rc4->encrypt($RC4_PASSWORD, $SESSION['username']."|".time())));
    $SESSION['$CODE']     = $code;
    $OTOANALIZ_ADMIN_MENU = array("212","215","246","317","330","331","332","333","339","344");

    $sql_menu = " SELECT * FROM USER_MENU WHERE USER_ID = '".$SESSION['user_id']."' ";
    if(!($cdb->execute_sql($sql_menu,$result_menu, $error_msg))){print_error($error_msg); exit;}
    while($row_menu_gorunmeyen = mysql_fetch_object($result_menu)){
        $menu_gorunmeyen[]=$row_menu_gorunmeyen->MENU_ID;
    }

    if (count($menu_gorunmeyen) >= 0 || (count($menu_gorunmeyen) == 0 && $SESSION['oa'] == 1) ){ // menu_gorunmeyen

            ?>
            <div style="clear: both;"></div>
            <?if($Degerler['ESKI_MENU_SON_TARIH'] >= date("Y-m-d")){?>
                <div id="dropdown-menu-alani">
                    <?php
                        $crypt = new Crypto();

                        $sql = " SELECT * FROM MENU WHERE BOUND_TO = 0 AND ID NOT IN (166, 167, 168, 2021) ORDER BY ORDER_NO ";

                        $cdb->execute_sql($sql,$result, $error_msg);
                        while($row = mysql_fetch_object($result)){
                            if((in_array($row->ID,$menu_gorunmeyen))){
                                $menu_html =  '<div class="dropdown" >';
                                if($row->TIP==1){

                                    $menu_html .='
                                        <a role="button" data-toggle="dropdown" class="btn btn-default btn-sm bigMenu" data-target="#" href="#" onclick="'.$row->RAPORLINK.'">
                                            '.dil($row->BASLIK,$row->BASLIK_ENG).' <span class="caret newline"></span>
                                        </a>
                                    ';
                                    dropdownmenu($row);
                                } else {
                                    if($row->ID !='166'){
                                       $menu_html .= '
                                            <a role="button" data-toggle="dropdown" class="btn btn-default btn-sm bigMenu" data-target="#" onclick="'.$row->RAPORLINK.'">
                                                '.dil($row->BASLIK,$row->BASLIK_ENG).'
                                            </a>
                                        ';
                                    } else {

                                             $menu_html .= '
                                            <a role="button" data-toggle="dropdown" class="btn btn-default btn-sm bigMenu" data-target="#" onclick="javascript:popup(\'http://multicat2.hasaryonetimi.com/index.php?dil='.$SESSION['dil'].'&CODE='.$crypt->encrypt($SESSION['password']).'&NAME='.$crypt->encrypt($SESSION['username']).'&url='.$SESSION['domain'].'&FIRMA_ID='.$SESSION['company_id'].'&domain='.$SESSION['domain_1'].'\',\'MC\',780,600);">
                                                '.dil($row->BASLIK,$row->BASLIK_ENG).'
                                            </a>
                                        ';

                                    }

                                }

                                $menu_html .=  '</div>';
                                echo $menu_html;
                            }
                        }
                    ?>
                    <?php } //menu_gorunmeyen ?>
                </div>
            <?}?>
    </div>
</nav>
<?php

function dropdownmenu($row='')
{
    global $menu_html,$menu_gorunmeyen,$cdb,$SESSION;
    $menu_html .= '<ul class="dropdown-menu" >';

    $sql1 = " SELECT * FROM MENU WHERE BOUND_TO=$row->ID ";
    $sql1.="  ORDER BY ORDER_NO ";
    $cdb->execute_sql($sql1,$result1, $error_msg);
    while($row1 = mysql_fetch_object($result1)){
         $row1->RAPORLINK = trim( $row1->RAPORLINK );
        if((in_array($row1->ID,$menu_gorunmeyen))){

            if($row1->TIP==1){
                $menu_html .='<li class="dropdown-submenu">
                            <a tabindex="-1" href="#">'.dil($row1->BASLIK,$row1->BASLIK_ENG).'</a>';
                dropdownmenu($row1);
                $menu_html .='</li>';
            } else {

                // if ( substr($row1->RAPORLINK,0,5)=="popup" OR substr($row1->RAPORLINK,0,10)=="javascript" OR substr($row1->RAPORLINK,0,24)!='javascript:location.href'){
                //     // javascript:popup(\'/menu/index1.php?id=60\',\'raporlar\',680,608);
                //     if (substr($row1->RAPORLINK,0,16)!="javascript:popup") {

                //         $RAPORLINK = explode("'", $row1->RAPORLINK);
                //         $RAPORLINK = str_replace('\\','',$RAPORLINK);
                //         $row1->RAPORLINK = $RAPORLINK[1];
                //         $row1->RAPORLINK = get_server_https().'://'.$_SERVER['SERVER_NAME']. $row1->RAPORLINK ;
                //         $menu_html .= '<li>
                //                             <a href="#" onclick="raporMenuAc(\''.$row1->ID.'\')">
                //                                 '.dil($row1->BASLIK,$row->BASLIK_ENG).'
                //                             </a>
                //                         </li>
                //                     ';
                //     } else {
                //          $menu_html .= '<li>
                //                         <a href="#" onclick="'.$row1->RAPORLINK.'">
                //                             '.dil($row1->BASLIK,$row->BASLIK_ENG).'
                //                         </a>
                //                     </li>
                //                 ';
                //     }
                // } else {
                //     if (substr($row1->RAPORLINK,0,24)!='javascript:location.href') {

                //         $row1->RAPORLINK = get_server_https().'://'.$_SERVER['SERVER_NAME']. $row1->RAPORLINK ;
                //     } else {
                //         $RAPORLINK = explode("'", $row1->RAPORLINK);
                //         $RAPORLINK = str_replace('\\','',$RAPORLINK);
                //         $row1->RAPORLINK = $RAPORLINK[1];
                //         $row1->RAPORLINK = get_server_https().'://'.$_SERVER['SERVER_NAME']. $row1->RAPORLINK ;

                //     }
                //     $menu_html .= '<li>
                //                         <a target="blank" href="'.$row1->RAPORLINK.'">
                //                             '.dil($row1->BASLIK,$row->BASLIK_ENG).'
                //                         </a>
                //                     </li>
                //                 ';
                // }
                if ( substr($row1->RAPORLINK,0,5)=="popup" OR substr($row1->RAPORLINK,0,10)=="javascript"  OR substr($row1->RAPORLINK,0,9)=="popup_son"  ){

                    $row1->RAPORLINK = str_replace('\\','',$row1->RAPORLINK);
                    $row1->RAPORLINK = str_replace('popup_son','raporMenuAc_eski',$row1->RAPORLINK);

                    $pos = strpos($row1->RAPORLINK, "popup_mesaj");
                    if (!is_integer($pos)) {
                        $row1->RAPORLINK = str_replace('popup','raporMenuAc_eski',$row1->RAPORLINK);
                    }

                    $menu_html .= '<li>
                                            <a href="#" onclick="'.$row1->RAPORLINK.'">
                                                '.dil($row1->BASLIK,$row->BASLIK_ENG).'
                                            </a>
                                        </li>
                                    ';
                }  else {
                     $menu_html .= '<li>
                                            <a target="blank" href="'.$row1->RAPORLINK.'">
                                                '.dil($row1->BASLIK,$row->BASLIK_ENG).'
                                            </a>
                                        </li>
                                    ';
                }
            }

        }
    }

    $menu_html .= '</ul>';
    return;
}