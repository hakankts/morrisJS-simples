<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT'])."/root/yeni_ekran/chart_repostory/chartClass.php");
$chartClass         = new chartClass();
$modul_kontrol      = $chartClass->modul_aktif_kontrol();
require_once(dirname($_SERVER['DOCUMENT_ROOT'])."/root/yeni_ekran/chart_repostory/load_modal.php");
?>
<?php if($modul_kontrol['modul_eksper']){ ?>
<?php $tedarik_top_data         = $chartClass->tedarikTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci); ?>
<?php
    $TOPLAM_DOSYA_KALEM_ADET    = $tedarik_top_data->TOPLAM_DOSYA_KALEM_ADET;

    if($tedarik_top_data->SEVK_ORT_GECEN_SURE_GUN>0){
        $SEVK_ORT_GECEN_SURE      = $tedarik_top_data->SEVK_ORT_GECEN_SURE_GUN." Gün";
    } else {
        $SEVK_ORT_GECEN_SURE     = $tedarik_top_data->SEVK_ORT_GECEN_SURE_SAAT." Saat";
    }

    $TEDARIK_SISTEM_TUTAR                       = $tedarik_top_data->TEDARIK_SISTEM_TUTAR;
    $TEDARIK_ISK_TUTARI                         = $tedarik_top_data->TEDARIK_ISK_TUTAR;
    $TEDARIK_KAZANDIRILAN                       = $tedarik_top_data->TEDARIK_SISTEM_TUTAR - $tedarik_top_data->TEDARIK_ISK_TUTAR;

    $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR       = $tedarik_top_data->ORJ_TEDARIK_SISTEM_TUTAR;
    $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR        = $tedarik_top_data->LO_SISTEM_TUTAR;
    $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR        = $tedarik_top_data->ESDEGER_SISTEM_TUTAR;

    $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR    = $tedarik_top_data->ORJ_TEDARIK_ISK_TUTAR;
    $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR     = $tedarik_top_data->LO_ISK_TUTAR;
    $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR     = $tedarik_top_data->ESDEGER_ISK_TUTAR;

    $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR;
    $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR  = $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR;
    $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR  = $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR;

    $TOPLAM_SISTEM_TUTARI                       = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR;
    $TOPLAM_ISKONTOLU_TUTAR                     = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR;
    $TOPLAM_KAZANDIRILAN_TUTAR                  = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR;

    $TOPLAM_TEDARIK_SISTEM_TUTARI               = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR;
    $TOPLAM_TEDARIK_ISKONTOLU_TUTAR             = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR;
    $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR          = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR;

    $TD_SISTEM_TUTAR                            = $tedarik_top_data->TD_SISTEM_TUTAR;
    $TD_ISK_TUTARI                              = $tedarik_top_data->TD_ISK_TUTAR;
    $TD_ISKONTOLU_TUTARI                        = $tedarik_top_data->TD_ISK_TUTARI;
    $TD_KAZANDIRILAN                            = $tedarik_top_data->TD_SISTEM_TUTAR - $tedarik_top_data->TD_ISK_TUTAR;

    $TD_LOESD_SISTEM_TUTAR                      = $tedarik_top_data->TD_YC_SISTEM_TUTAR;
    $TD_LOESD_ISKONTOLU                         = $tedarik_top_data->TD_YC_ISK_TUTAR;
    $TD_LOESD_KAZANDIRILAN                      = $TD_LOESD_SISTEM_TUTAR - $TD_LOESD_ISKONTOLU;

    $TD_ORJ_SISTEM_TUTAR                        = $TD_SISTEM_TUTAR - $TD_LOESD_SISTEM_TUTAR;
    $TD_ORJ_ISKONTOLU                           = $TD_ISK_TUTARI - $TD_LOESD_ISKONTOLU;
    $TD_ORJ_KAZANDIRILAN                        = $TD_ORJ_SISTEM_TUTAR - $TD_ORJ_ISKONTOLU;
    /*
    echo $tedarik_top_data->SERVIS_ORG_SISTEM_TUTAR;
    echo "<br>";
    echo $tedarik_top_data->SERVIS_LOESD_SISTEM_TUTAR;
    echo "<br>";
    echo $tedarik_top_data->SERVIS_ORG_ISK_TUTAR;
    echo "<br>";
    echo $tedarik_top_data->SERVIS_LOESD_ISK_TUTAR;
    */

    $SERVIS_ISKONTO_SISTEM                  = $tedarik_top_data->SERVIS_ORG_SISTEM_TUTAR + $tedarik_top_data->SERVIS_LOESD_SISTEM_TUTAR;
    $SERVIS_ISKONTO_SERVIS                  = $tedarik_top_data->SERVIS_ORG_ISK_TUTAR + $tedarik_top_data->SERVIS_LOESD_ISK_TUTAR;
    $SERVIS_KAZANDIRILAN                    = $SERVIS_ISKONTO_SISTEM - $SERVIS_ISKONTO_SERVIS;

    $SERVIS_ISKONTO_ORJ_SISTEM              = $tedarik_top_data->SERVIS_ORG_SISTEM_TUTAR;
    $SERVIS_ISKONTO_ORJ_SERVIS              = $tedarik_top_data->SERVIS_ORG_ISK_TUTAR;
    $SERVIS_ISKONTO_ORJ_KAZANDIRILAN        = $SERVIS_ISKONTO_ORJ_SISTEM - $SERVIS_ISKONTO_ORJ_SERVIS;

    $SERVIS_ISKONTO_LOESD_SISTEM            = $tedarik_top_data->SERVIS_LOESD_SISTEM_TUTAR;
    $SERVIS_ISKONTO_LOESD_SERVIS            = $tedarik_top_data->SERVIS_LOESD_ISK_TUTAR;
    $SERVIS_ISKONTO_LOESD_KAZANDIRILAN      = $SERVIS_ISKONTO_LOESD_SISTEM - $SERVIS_ISKONTO_LOESD_SERVIS;

    $ORJ_TEDARIK_SISTEM_TUTAR               = $tedarik_top_data->ORJ_TEDARIK_SISTEM_TUTAR;
    $ORJ_TEDARIK_KAZANDIRILAN               = $tedarik_top_data->ORJ_TEDARIK_ISK_TUTARI;

    $LO_TEDARIK_SISTEM_TUTAR                = $tedarik_top_data->LO_SISTEM_TUTAR;
    $LO_TEDARIK_KAZANDIRILAN                = $tedarik_top_data->LO_ISK_TUTARI;

    $ESDEGER_TEDARIK_SISTEM_TUTAR           = $tedarik_top_data->ESDEGER_SISTEM_TUTAR;
    $ESDEGER_TEDARIK_KAZANDIRILAN           = $tedarik_top_data->ESDEGER_ISK_TUTARI;

    $ORJ_TEDARIK_ISKONTOLU_TUTAR            = $tedarik_top_data->ORJ_TEDARIK_ISK_TUTAR;
    $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR = $tedarik_top_data->LO_ISK_TUTAR;
    $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR = $tedarik_top_data->ESDEGER_ISK_TUTAR;

    $TOPLAM_KAZANDIRILAN                    = $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR+ $SERVIS_KAZANDIRILAN + $TD_KAZANDIRILAN;
    $TOPLAM_SISTEM_TUTAR                    = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR + $SERVIS_ISKONTO_SISTEM + $TD_SISTEM_TUTAR;
    $TOPLAM_ISKONTOLU_TUTAR                 = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR + $SERVIS_ISKONTO_ORJ_SERVIS + $SERVIS_ISKONTO_LOESD_SERVIS + $TD_ISK_TUTARI;

    $TOPLAM_ORJ_SISTEM                      = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TD_ORJ_SISTEM_TUTAR + $SERVIS_ISKONTO_ORJ_SISTEM;
    $TOPLAM_LOESD_SISTEM                    = $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR + $SERVIS_ISKONTO_LOESD_SISTEM + $TD_LOESD_SISTEM_TUTAR;
    $TOPLAM_ORJ_KAZANDIRILAN                = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TD_ORJ_KAZANDIRILAN + $SERVIS_ISKONTO_ORJ_KAZANDIRILAN;
    $TOPLAM_LOESD_KAZANDIRILAN              = $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR + $TD_LOESD_KAZANDIRILAN + $SERVIS_ISKONTO_LOESD_KAZANDIRILAN;

    /*<td style="text-align: center; font-size: 20px;"><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="top" id="top1"> <?php echo $TOPLAM_DOSYA_KALEM_ADET;?></a></td> */
    ?>
    <?php
        $karsilama_adet_arr         = $chartClass->KarsilamaAdetKumulBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
        foreach($karsilama_adet_arr as $karsilama_kumul_data){
            $KARSILAMA_KUMUL_ADET = formatla($karsilama_kumul_data["KARSILAMA_ADET"]);
        }
    ?>
    <div class="card" style="width: 98%;margin: 0px auto;">
                <div class="row" style="width: 99.7%;">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
                        <table class="table" id="dev-table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"><?=dil_dashboard("Toplam Dosya Adet")?></th>
                                    <th style="text-align: center;"><?=dil_dashboard("Toplam Sistem Tutarý")?></th>
                                    <th style="text-align: center;"><?=dil_dashboard("Toplam Ýskontolu Tutarý")?></th>
                                    <th style="text-align: center;"><?=dil_dashboard("Toplam Kazandýrýlan")?></th>
                                    <?php /* <th style="text-align: center;">Toplam Sipariþ Tutarý</th>
                                    <th style="text-align: center;">Karþýlama Adet %</th> */ ?>
                                    <th style="text-align: center;"><?=dil_dashboard("Genel Ýskonto")?> %</th>
                                    <th style="text-align: center;"><?=dil_dashboard("Orijinal Ýskonto")?> %</th>
                                    <th style="text-align: center;"><?=dil_dashboard("Lo-Eþdeðer Ýskonto")?> %</th>
                                    <th style="text-align: center;"><?=dil_dashboard("Tedarik Ýskontosu")?> %</th>
                                    <th style="text-align: center;"><?=dil_dashboard("Servis Ýskontosu")?> %</th>
                                    <th style="text-align: center;"><?=dil_dashboard("Tedarik Dýþý")?> %</th>
                                    <th style="text-align: center;"><?=dil_dashboard("Ort. Sevk Süre")?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="text-align: center; font-size: 20px;"><?php echo $TOPLAM_DOSYA_KALEM_ADET;?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_SISTEM_TUTAR);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_ISKONTOLU_TUTAR);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_KAZANDIRILAN);?></td>
                                <?php /*
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_TEDARIK_SISTEM_TUTARI);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla($KARSILAMA_KUMUL_ADET);?></td>
                                */ ?>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla(($TOPLAM_KAZANDIRILAN / $TOPLAM_SISTEM_TUTAR) * 100);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla(($TOPLAM_ORJ_KAZANDIRILAN / $TOPLAM_ORJ_SISTEM) * 100);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla(($TOPLAM_LOESD_KAZANDIRILAN / $TOPLAM_LOESD_SISTEM) * 100);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla(($TEDARIK_KAZANDIRILAN / $TEDARIK_SISTEM_TUTAR) *100);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla(($SERVIS_KAZANDIRILAN / $SERVIS_ISKONTO_SISTEM) * 100);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo formatla(($TD_KAZANDIRILAN / $TD_SISTEM_TUTAR) * 100);?></td>
                                <td style="text-align: center; font-size: 20px;"><?php echo ($SEVK_ORT_GECEN_SURE);?></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php
                        $marka_data_arr         = $chartClass->markaBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                        foreach($marka_data_arr as $marka_data){
                            $MARKA_ADI                      = $marka_data['MARKA_ADI'];
                            $TEDARIK_SISTEM_TUTAR_MARKA     = $marka_data['TEDARIK_SISTEM_TUTAR'];
                            $TEDARIK_ISK_TUTARI_MARKA       = $marka_data['TEDARIK_ISK_TUTARI'];
                            $TEDARIK_KAZANDIRILAN_MARKA     = $marka_data['TEDARIK_SISTEM_TUTAR'] - $marka_data['TEDARIK_ISK_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA         = $marka_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA          = $marka_data['LO_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA          = $marka_data['ESDEGER_SISTEM_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA      = $marka_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA       = $marka_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA       = $marka_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_MARKA   = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA;
                            $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_MARKA    = $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA;
                            $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_MARKA    = $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA;

                            $TOPLAM_SISTEM_TUTARI_MARKA                         = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR_MARKA;
                            $TOPLAM_ISKONTOLU_TUTAR_MARKA                       = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR_MARKA;
                            $TOPLAM_KAZANDIRILAN_TUTAR_MARKA                    = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR_MARKA;

                            $TOPLAM_TEDARIK_SISTEM_TUTARI_MARKA                 = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA;
                            $TOPLAM_TEDARIK_ISKONTOLU_TUTAR_MARKA               = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA;
                            $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_MARKA            = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_MARKA;

                            $TD_SISTEM_TUTAR_MARKA                  = $marka_data['TD_SISTEM_TUTAR'];
                            $TD_ISK_TUTARI_MARKA                    = $marka_data['TD_ISK_TUTAR'];
                            $TD_ISKONTOLU_TUTARI_MARKA              = $marka_data['TD_ISK_TUTARI'];
                            $TD_KAZANDIRILAN_MARKA                  = $marka_data['TD_SISTEM_TUTAR'] - $marka_data['TD_ISK_TUTAR'];

                            $TD_LOESD_SISTEM_TUTAR_MARKA            = $marka_data['TD_YC_SISTEM_TUTAR'];
                            $TD_LOESD_ISKONTOLU_MARKA               = $marka_data['TD_YC_ISK_TUTAR'];
                            $TD_LOESD_KAZANDIRILAN_MARKA            = $TD_LOESD_SISTEM_TUTAR_MARKA - $TD_LOESD_ISKONTOLU_MARKA;

                            $TD_ORJ_SISTEM_TUTAR_MARKA              = $TD_SISTEM_TUTAR_MARKA - $TD_LOESD_SISTEM_TUTAR_MARKA;
                            $TD_ORJ_ISKONTOLU_MARKA                 = $TD_ISK_TUTARI_MARKA - $TD_LOESD_ISKONTOLU_MARKA;
                            $TD_ORJ_KAZANDIRILAN_MARKA              = $TD_ORJ_SISTEM_TUTAR_MARKA - $TD_ORJ_ISKONTOLU_MARKA;

                            $SERVIS_ISKONTO_SISTEM_MARKA            = $marka_data['SERVIS_ORG_SISTEM_TUTAR'] + $marka_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_SERVIS_MARKA            = $marka_data['SERVIS_ORG_ISK_TUTAR'] + $marka_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_KAZANDIRILAN_MARKA              = $SERVIS_ISKONTO_SISTEM_MARKA - $SERVIS_ISKONTO_SERVIS_MARKA;

                            $SERVIS_ISKONTO_ORJ_SISTEM_MARKA            = $marka_data['SERVIS_ORG_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_SERVIS_MARKA            = $marka_data['SERVIS_ORG_ISK_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_KAZANDIRILAN_MARKA      = $SERVIS_ISKONTO_ORJ_SISTEM_MARKA - $SERVIS_ISKONTO_ORJ_SERVIS_MARKA;

                            $SERVIS_ISKONTO_LOESD_SISTEM_MARKA          = $marka_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_SERVIS_MARKA          = $marka_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_KAZANDIRILAN_MARKA    = $SERVIS_ISKONTO_LOESD_SISTEM_MARKA - $SERVIS_ISKONTO_LOESD_SERVIS_MARKA;

                            $ORJ_TEDARIK_SISTEM_TUTAR_MARKA         = $marka_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $ORJ_TEDARIK_KAZANDIRILAN_MARKA         = $marka_data['ORJ_TEDARIK_ISK_TUTARI'];

                            $LO_TEDARIK_SISTEM_TUTAR_MARKA          = $marka_data['LO_SISTEM_TUTAR'];
                            $LO_TEDARIK_KAZANDIRILAN_MARKA          = $marka_data['LO_ISK_TUTARI'];

                            $ESDEGER_TEDARIK_SISTEM_TUTAR_MARKA     = $marka_data['ESDEGER_SISTEM_TUTAR'];
                            $ESDEGER_TEDARIK_KAZANDIRILAN_MARKA         = $marka_data['ESDEGER_ISK_TUTARI'];

                            $ORJ_TEDARIK_ISKONTOLU_TUTAR_MARKA                      = $marka_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA           = $marka_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA           = $marka_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_KAZANDIRILAN_MARKA          = $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_MARKA+ $SERVIS_KAZANDIRILAN_MARKA + $TD_KAZANDIRILAN_MARKA;
                            $TOPLAM_SISTEM_TUTAR_MARKA          = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA + $SERVIS_ISKONTO_SISTEM_MARKA + $TD_SISTEM_TUTAR_MARKA;
                            $TOPLAM_ISKONTO_TUTARI_MARKA        = $TOPLAM_SISTEM_TUTAR_MARKA - $TOPLAM_KAZANDIRILAN_MARKA;
                            $TOPLAM_ISKONTO_ORANI_MARKA         = $TOPLAM_KAZANDIRILAN_MARKA / $TOPLAM_SISTEM_TUTAR_MARKA*100;
                        $chart_data_marka .= "{ marka:'".$MARKA_ADI."', kazandirilan:".($TOPLAM_KAZANDIRILAN_MARKA).", iskonto_oran:".formatla($TOPLAM_KAZANDIRILAN_MARKA/$TOPLAM_SISTEM_TUTAR_MARKA*100)."}, ";
                    }
                ?>
                <?php
                        $tedarikci_data_arr         = $chartClass->tedarikciBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                        foreach($tedarikci_data_arr as $tedarikci_data){
                            $TEDARIKCI                                      = $tedarikci_data['TEDARIKCI'];
                            $TEDARIK_SISTEM_TUTAR_TED                       = $tedarikci_data['TEDARIK_SISTEM_TUTAR'];
                            $TEDARIK_ISK_TUTARI_TED                         = $tedarikci_data['TEDARIK_ISK_TUTARI'];
                            $TEDARIK_KAZANDIRILAN_TED                       = $tedarikci_data['TEDARIK_SISTEM_TUTAR'] - $tedarikci_data['TEDARIK_ISK_TUTARI'];

                            $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED       = $tedarikci_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED        = $tedarikci_data['LO_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED        = $tedarikci_data['ESDEGER_SISTEM_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED    = $tedarikci_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED     = $tedarikci_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED     = $tedarikci_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_TED = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED;
                            $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_TED  = $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED;
                            $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_TED  = $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED;

                            $TOPLAM_SISTEM_TUTARI_TED                       = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR_TED;
                            $TOPLAM_ISKONTOLU_TUTAR_TED                     = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR_TED;
                            $TOPLAM_KAZANDIRILAN_TUTAR_TED                  = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR_TED;

                            $TOPLAM_TEDARIK_SISTEM_TUTARI_TED               = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED;
                            $TOPLAM_TEDARIK_ISKONTOLU_TUTAR_TED             = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED;
                            $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_TED          = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_TED;

                            $TD_SISTEM_TUTAR_TED                            = $tedarikci_data['TD_SISTEM_TUTAR'];
                            $TD_ISK_TUTARI_TED                              = $tedarikci_data['TD_ISK_TUTAR'];
                            $TD_ISKONTOLU_TUTARI_TED                        = $tedarikci_data['TD_ISK_TUTARI'];
                            $TD_KAZANDIRILAN_TED                            = $tedarikci_data['TD_SISTEM_TUTAR'] - $tedarikci_data['TD_ISK_TUTAR'];

                            $TD_LOESD_SISTEM_TUTAR_TED                      = $tedarikci_data['TD_YC_SISTEM_TUTAR'];
                            $TD_LOESD_ISKONTOLU_TED                         = $tedarikci_data['TD_YC_ISK_TUTAR'];
                            $TD_LOESD_KAZANDIRILAN_TED                      = $TD_LOESD_SISTEM_TUTAR_TED - $TD_LOESD_ISKONTOLU_TED;

                            $TD_ORJ_SISTEM_TUTAR_TED                        = $TD_SISTEM_TUTAR_TED - $TD_LOESD_SISTEM_TUTAR_TED;
                            $TD_ORJ_ISKONTOLU_TED                           = $TD_ISK_TUTARI_TED - $TD_LOESD_ISKONTOLU_TED;
                            $TD_ORJ_KAZANDIRILAN_TED                        = $TD_ORJ_SISTEM_TUTAR_TED - $TD_ORJ_ISKONTOLU_TED;

                            $SERVIS_ISKONTO_SISTEM_TED                      = $tedarikci_data['SERVIS_ORG_SISTEM_TUTAR'] + $tedarikci_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_SERVIS_TED                      = $tedarikci_data['SERVIS_ORG_ISK_TUTAR'] + $tedarikci_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_KAZANDIRILAN_TED                        = $SERVIS_ISKONTO_SISTEM_TED - $SERVIS_ISKONTO_SERVIS_TED;

                            $SERVIS_ISKONTO_ORJ_SISTEM_TED                  = $tedarikci_data['SERVIS_ORG_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_SERVIS_TED                  = $tedarikci_data['SERVIS_ORG_ISK_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_KAZANDIRILAN_TED            = $SERVIS_ISKONTO_ORJ_SISTEM_TED - $SERVIS_ISKONTO_ORJ_SERVIS_TED;

                            $SERVIS_ISKONTO_LOESD_SISTEM_TED                = $tedarikci_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_SERVIS_TED                = $tedarikci_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_KAZANDIRILAN_TED          = $SERVIS_ISKONTO_LOESD_SISTEM_TED - $SERVIS_ISKONTO_LOESD_SERVIS_TED;

                            $ORJ_TEDARIK_SISTEM_TUTAR_TED                   = $tedarikci_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $ORJ_TEDARIK_KAZANDIRILAN_TED                   = $tedarikci_data['ORJ_TEDARIK_ISK_TUTARI'];

                            $LO_TEDARIK_SISTEM_TUTAR_TED                    = $tedarikci_data['LO_SISTEM_TUTAR'];
                            $LO_TEDARIK_KAZANDIRILAN_TED                    = $tedarikci_data['LO_ISK_TUTARI'];

                            $ESDEGER_TEDARIK_SISTEM_TUTAR_TED               = $tedarikci_data['ESDEGER_SISTEM_TUTAR'];
                            $ESDEGER_TEDARIK_KAZANDIRILAN_TED               = $tedarikci_data['ESDEGER_ISK_TUTARI'];

                            $ORJ_TEDARIK_ISKONTOLU_TUTAR_TED                = $tedarikci_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED     = $tedarikci_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED     = $tedarikci_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_KAZANDIRILAN_TED                        = $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_TED+ $SERVIS_KAZANDIRILAN_TED + $TD_KAZANDIRILAN_TED;
                            $TOPLAM_SISTEM_TUTAR_TED                        = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED + $SERVIS_ISKONTO_SISTEM_TED + $TD_SISTEM_TUTAR_TED;
                            $TOPLAM_ISKONTO_TUTARI_TED                      = $TOPLAM_SISTEM_TUTAR_TED - $TOPLAM_KAZANDIRILAN_TED;
                            $TOPLAM_ISKONTO_ORANI_TED                       = $TOPLAM_KAZANDIRILAN_TED / $TOPLAM_SISTEM_TUTAR_TED * 100;

                        $chart_data_tedarikci .= "{ tedarikci:'".$TEDARIKCI."', kazandirilan:".($TOPLAM_KAZANDIRILAN_TED).", iskonto_oran:".formatla($TOPLAM_ISKONTO_ORANI_TED)."}, ";
                    }

                ?>
                <?php
                    $iller_data_arr = $chartClass->illerBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                    foreach($iller_data_arr as $il_data){
                            $SERVIS_IL                                     = $il_data['SERVIS_IL'];
                            $TEDARIK_SISTEM_TUTAR_IL                       = $il_data['TEDARIK_SISTEM_TUTAR'];
                            $TEDARIK_ISK_TUTARI_IL                         = $il_data['TEDARIK_ISK_TUTARI'];
                            $TEDARIK_KAZANDIRILAN_IL                       = $il_data['TEDARIK_SISTEM_TUTAR'] - $il_data['TEDARIK_ISK_TUTARI'];

                            $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL       = $il_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL        = $il_data['LO_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL        = $il_data['ESDEGER_SISTEM_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL    = $il_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL     = $il_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL     = $il_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_IL = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL;
                            $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_IL  = $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL;
                            $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_IL  = $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL;

                            $TOPLAM_SISTEM_TUTARI_IL                       = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR_IL;
                            $TOPLAM_ISKONTOLU_TUTAR_IL                     = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR_IL;
                            $TOPLAM_KAZANDIRILAN_TUTAR_IL                  = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR_IL;

                            $TOPLAM_TEDARIK_SISTEM_TUTARI_IL               = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL;
                            $TOPLAM_TEDARIK_ISKONTOLU_TUTAR_IL             = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL;
                            $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_IL          = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_IL;

                            $TD_SISTEM_TUTAR_IL                            = $il_data['TD_SISTEM_TUTAR'];
                            $TD_ISK_TUTARI_IL                              = $il_data['TD_ISK_TUTAR'];
                            $TD_ISKONTOLU_TUTARI_IL                        = $il_data['TD_ISK_TUTARI'];
                            $TD_KAZANDIRILAN_IL                            = $il_data['TD_SISTEM_TUTAR'] - $il_data['TD_ISK_TUTAR'];

                            $TD_LOESD_SISTEM_TUTAR_IL                      = $il_data['TD_YC_SISTEM_TUTAR'];
                            $TD_LOESD_ISKONTOLU_IL                         = $il_data['TD_YC_ISK_TUTAR'];
                            $TD_LOESD_KAZANDIRILAN_IL                      = $TD_LOESD_SISTEM_TUTAR_IL - $TD_LOESD_ISKONTOLU_IL;

                            $TD_ORJ_SISTEM_TUTAR_IL                        = $TD_SISTEM_TUTAR_IL - $TD_LOESD_SISTEM_TUTAR_IL;
                            $TD_ORJ_ISKONTOLU_IL                           = $TD_ISK_TUTARI_IL - $TD_LOESD_ISKONTOLU_IL;
                            $TD_ORJ_KAZANDIRILAN_IL                        = $TD_ORJ_SISTEM_TUTAR_IL - $TD_ORJ_ISKONTOLU_IL;

                            $SERVIS_ISKONTO_SISTEM_IL                      = $il_data['SERVIS_ORG_SISTEM_TUTAR'] + $il_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_SERVIS_IL                      = $il_data['SERVIS_ORG_ISK_TUTAR'] + $il_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_KAZANDIRILAN_IL                        = $SERVIS_ISKONTO_SISTEM_IL - $SERVIS_ISKONTO_SERVIS_IL;

                            $SERVIS_ISKONTO_ORJ_SISTEM_IL                  = $il_data['SERVIS_ORG_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_SERVIS_IL                  = $il_data['SERVIS_ORG_ISK_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_KAZANDIRILAN_IL            = $SERVIS_ISKONTO_ORJ_SISTEM_IL - $SERVIS_ISKONTO_ORJ_SERVIS_IL;

                            $SERVIS_ISKONTO_LOESD_SISTEM_IL                = $il_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_SERVIS_IL                = $il_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_KAZANDIRILAN_IL          = $SERVIS_ISKONTO_LOESD_SISTEM_IL - $SERVIS_ISKONTO_LOESD_SERVIS_IL;

                            $ORJ_TEDARIK_SISTEM_TUTAR_IL                   = $il_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $ORJ_TEDARIK_KAZANDIRILAN_IL                   = $il_data['ORJ_TEDARIK_ISK_TUTARI'];

                            $LO_TEDARIK_SISTEM_TUTAR_IL                    = $il_data['LO_SISTEM_TUTAR'];
                            $LO_TEDARIK_KAZANDIRILAN_IL                    = $il_data['LO_ISK_TUTARI'];

                            $ESDEGER_TEDARIK_SISTEM_TUTAR_IL               = $il_data['ESDEGER_SISTEM_TUTAR'];
                            $ESDEGER_TEDARIK_KAZANDIRILAN_IL               = $il_data['ESDEGER_ISK_TUTARI'];

                            $ORJ_TEDARIK_ISKONTOLU_TUTAR_IL                = $il_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL     = $il_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL     = $il_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_KAZANDIRILAN_IL                        = $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_IL+ $SERVIS_KAZANDIRILAN_IL + $TD_KAZANDIRILAN_IL;
                            $TOPLAM_SISTEM_TUTAR_IL                        = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL + $SERVIS_ISKONTO_SISTEM_IL + $TD_SISTEM_TUTAR_IL;
                            $TOPLAM_ISKONTO_TUTARI_IL                      = $TOPLAM_SISTEM_TUTAR_IL - $TOPLAM_KAZANDIRILAN_IL;
                            $TOPLAM_ISKONTO_ORANI_IL                       = $TOPLAM_KAZANDIRILAN_IL / $TOPLAM_SISTEM_TUTAR_IL * 100;

                            $chart_data_iller .= "{ Þehir:'".$SERVIS_IL."', kazandirilan:".($TOPLAM_KAZANDIRILAN_IL).", iskonto_oran:".formatla($TOPLAM_ISKONTO_ORANI_IL)."}, ";
                    }
                ?>
                <div class="col-lg-4">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; margin-top: 5px; min-height: 425px;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Marka Oran Daðýlýmý")?> </p>
                            </div>
                        <div id='chart_hist_marka' class='chart_morris'></div>
                        <button type="button" class="marka" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="markalar"> <?=dil_dashboard("Tümü")?> </button>
                    </div>

                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 439;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Tedarikçi Oran Daðýlýmý")?></p>
                            </div>
                        <div id='chart_hist_tedarikci' class='chart_morris'></div>
                        <button type="button" class="tedarikci" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="tedarikciler"> <?=dil_dashboard("Tümü")?> </button>
                    </div>

                    <div class="pdfNextPage" style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 439;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Servis Ýli Oran Daðýlýmý")?></p>
                            </div>
                        <div id='chart_hist_iller' class='chart_morris'></div>
                        <button type="button" class="iller" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="iller"> <?=dil_dashboard("Tümü")?> </button>
                    </div>

                </div>
                <div class="col-lg-8">

                <?php
                    //DONUT 1
                    $pie_data  .= "{ label: '".dil_dashboard('Tedarik Adet %')."', value: ". (formatla(($tedarik_top_data->TEDARIK_DEGISIM_ADET / $tedarik_top_data->TOPLAM_PARCA_ADET *100) )) ." }, ";
                    $pie_data  .= "{ label: '".dil_dashboard('Servis Ýskonto Adet %')."', value: ". (formatla(( ($tedarik_top_data->SERVIS_ORG_ADET+ $tedarik_top_data->SERVIS_LOESD_ADET) / $tedarik_top_data->TOPLAM_PARCA_ADET *100) )) ." }, ";
                    $pie_data  .= "{ label: '".dil_dashboard('Tedarik Dýþý Adet %')."', value: ". (formatla(( $tedarik_top_data->TD_ADET / $tedarik_top_data->TOPLAM_PARCA_ADET *100) )) ." }, ";
                ?>

                <?php
                    //DONUT 2
                    $pie_data2  .= "{ label: '".dil_dashboard('Orijinal Adet %')."', value: ". (formatla( ($tedarik_top_data->ORJ_TEDARIK_ADET) / $tedarik_top_data->TEDARIK_DEGISIM_ADET *100)) ." }, ";
                    $pie_data2  .= "{ label: '".dil_dashboard('Logosuz Adet %')."', value: ". (formatla( ($tedarik_top_data->LO_ADET) / $tedarik_top_data->TEDARIK_DEGISIM_ADET *100)) ." }, ";
                    $pie_data2  .= "{ label: '".dil_dashboard('Eþdeðer Adet %')."', value: ". (formatla( ($tedarik_top_data->ESDEGER_ADET) / $tedarik_top_data->TEDARIK_DEGISIM_ADET *100)) ." }, ";
                ?>

                <?php
                    //DONUT 3
                    $pie_data3  .= "{ label: '".dil_dashboard('Orijinal Adet%')."', value: ". (formatla($tedarik_top_data->SERVIS_ORG_ADET / ($tedarik_top_data->SERVIS_ORG_ADET + $tedarik_top_data->SERVIS_LOESD_ADET) *100)) ." }, ";
                    $pie_data3  .= "{ label: '".dil_dashboard('Lo-Eþdeðer Adet%')."', value: ". (formatla($tedarik_top_data->SERVIS_LOESD_ADET / ($tedarik_top_data->SERVIS_ORG_ADET + $tedarik_top_data->SERVIS_LOESD_ADET) *100)) ." }, ";
                ?>

                <?php
                    //DONUT 4
                    $pie_data4  .= "{ label: '".dil_dashboard('Tedarik Dýþý Orj. Adet%')."', value: ". (formatla( ($tedarik_top_data->TD_ADET - $tedarik_top_data->TD_YC_ADET) / ($tedarik_top_data->TD_ADET) *100)) ." }, ";
                    $pie_data4  .= "{ label: '".dil_dashboard('Tedarik Dýþý Lo-Eþd. Adet%')."', value: ". (formatla($tedarik_top_data->TD_YC_ADET / ($tedarik_top_data->TD_ADET) *100)) ." }, ";
                ?>
                    <div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 425px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?php echo dil_dashboard("Adet Bazýnda Daðýlým");?></p>
                        </div>
                        <div class="col-lg-3">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Temin Daðýlýmý")?></center></b>
                                <div id='chart_pie_1' class='chart_morris'></div>
                                <div id='chart_pie_1_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 pdfNextPage">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Parça Tipi Daðýlýmý")?></center></b>
                                <div id='chart_pie_2' class='chart_morris'></div>
                                <div id='chart_pie_2_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis Parça Tipi Daðýlýmý")?></center></b>
                                <div id='chart_pie_3' class='chart_morris'></div>
                                <div id='chart_pie_3_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 pdfNextPage">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Dýþý Parça Tipi Daðýlýmý")?></center></b>
                                <div id='chart_pie_4' class='chart_morris'></div>
                                <div id='chart_pie_4_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>
                    </div>
                    </div>

                <?php
                    //DONUT 5
                    $pie_data5  .= "{ label: '".dil_dashboard('Tedarik Ýskonto %')."', value: ". (formatla( ($TEDARIK_KAZANDIRILAN / $TOPLAM_KAZANDIRILAN) *100 )) ." }, ";
                    $pie_data5  .= "{ label: '".dil_dashboard('Servis  Ýskonto %')."', value: ". (formatla( ($SERVIS_KAZANDIRILAN / $TOPLAM_KAZANDIRILAN) * 100)) ." }, ";
                    $pie_data5  .= "{ label: '".dil_dashboard('Tedarik Dýþý Ýskonto %')."', value: ". (formatla(($TD_KAZANDIRILAN / $TOPLAM_KAZANDIRILAN) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 6
                    $pie_data6  .= "{ label: '".dil_dashboard('Orijinal Ýskonto%')."', value: ". (formatla( ($TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR) *100 )) ." }, ";
                    $pie_data6  .= "{ label: '".dil_dashboard('Lo  Ýskonto %')."', value: ". (formatla( ($TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR) * 100)) ." }, ";
                    $pie_data6  .= "{ label: '".dil_dashboard('Eþdeðer Ýskonto %')."', value: ". (formatla(($TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR) * 100)) ." }, ";
                    ?>
                <?php
                    //DONUT 7
                    $pie_data7  .= "{ label: '".dil_dashboard('Orijinal Ýskonto%')."', value: ". (formatla( ($SERVIS_ISKONTO_ORJ_KAZANDIRILAN / $SERVIS_KAZANDIRILAN) *100 )) ." }, ";
                    $pie_data7  .= "{ label: '".dil_dashboard('Lo-Eþdeðer  Ýskonto %')."', value: ". (formatla( ($SERVIS_ISKONTO_LOESD_KAZANDIRILAN / $SERVIS_KAZANDIRILAN) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 8
                    $pie_data8  .= "{ label: '".dil_dashboard('Orijinal Ýskonto%')."', value: ". (formatla( ($TD_ORJ_KAZANDIRILAN / $TD_KAZANDIRILAN) *100 )) ." }, ";
                    $pie_data8  .= "{ label: '".dil_dashboard('Lo-Eþdeðer  Ýskonto %')."', value: ". (formatla( ($TD_LOESD_KAZANDIRILAN / $TD_KAZANDIRILAN) * 100)) ." }, ";
                ?>
                    <div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 439px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?php echo dil_dashboard("Kazandýrýlan Ýskonto Tutar Daðýlýmý");?></p>
                        </div>
                        <div class="col-lg-3">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Genel Ýskonto Daðýlýmý")?></center></b>
                                <div id='chart_pie_5' class='chart_morris'></div>
                                <div id='chart_pie_5_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 pdfNextPage">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik")?></center></b>
                                <div id='chart_pie_6' class='chart_morris'></div>
                                <div id='chart_pie_6_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis Ýskonto")?></center></b>
                                <div id='chart_pie_7' class='chart_morris'></div>
                                <div id='chart_pie_7_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 pdfNextPage">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Dýþý")?></center></b>
                                <div id='chart_pie_8' class='chart_morris'></div>
                                <div id='chart_pie_8_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                    </div>
                    </div>

                <?php
                    //DONUT 9
                    $pie_data9  .= "{ label: '".dil_dashboard('Tedarik Ýskonto %')."', value: ". (formatla( ($TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_SISTEM_TUTARI) *100 )) ." }, ";
                    $pie_data9  .= "{ label: '".dil_dashboard('Servis  Ýskonto %')."', value: ". (formatla( ($SERVIS_KAZANDIRILAN / $SERVIS_ISKONTO_SISTEM) * 100)) ." }, ";
                    $pie_data9  .= "{ label: '".dil_dashboard('Tedarik Dýþý Ýskonto %')."', value: ". (formatla(($TD_KAZANDIRILAN / $TD_SISTEM_TUTAR) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 10
                    $pie_data10  .= "{ label: '".dil_dashboard('Orijinal Kazandýrýlan%')."', value: ". (formatla( ($ORJ_TEDARIK_KAZANDIRILAN / $ORJ_TEDARIK_SISTEM_TUTAR) *100 )) ." }, ";
                    $pie_data10  .= "{ label: '".dil_dashboard('Lo  Kazandýrýlan %')."', value: ". (formatla( ($LO_TEDARIK_KAZANDIRILAN / $LO_TEDARIK_SISTEM_TUTAR) * 100)) ." }, ";
                    $pie_data10  .= "{ label: '".dil_dashboard('Eþdeðer Kazandýrýlan %')."', value: ". (formatla(($ESDEGER_TEDARIK_KAZANDIRILAN / $ESDEGER_TEDARIK_SISTEM_TUTAR) * 100)) ." }, ";
                    ?>
                <?php
                    //DONUT 11
                    $pie_data11 .= "{ label: '".dil_dashboard('Orijinal Kazandýrýlan%')."', value: ". (formatla( ($SERVIS_ISKONTO_ORJ_KAZANDIRILAN / $SERVIS_ISKONTO_ORJ_SISTEM) *100 )) ." }, ";
                    $pie_data11  .= "{ label: '".dil_dashboard('Lo-Eþdeðer  Kazandýrýlan %')."', value: ". (formatla( ($SERVIS_ISKONTO_LOESD_KAZANDIRILAN / $SERVIS_ISKONTO_LOESD_SISTEM) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 12
                    $pie_data12  .= "{ label: '".dil_dashboard('Orijinal Kazandýrýlan%')."', value: ". (formatla( ($TD_ORJ_KAZANDIRILAN / $TD_ORJ_SISTEM_TUTAR) *100 )) ." }, ";
                    $pie_data12  .= "{ label: '".dil_dashboard('Lo-Eþdeðer  Kazandýrýlan %')."', value: ". (formatla( ($TD_LOESD_KAZANDIRILAN / $TD_LOESD_SISTEM_TUTAR) * 100)) ." }, ";
                ?>
                    <div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 439px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?php echo dil_dashboard("Kazandýrýlan Ýskonto Oraný (%)");?></p>
                        </div>
                        <div class="col-lg-3">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Genel")?></center></b>
                                <div id='chart_pie_9' class='chart_morris'></div>
                                <div id='chart_pie_9_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 pdfNextPage">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik")?></center></b>
                                <div id='chart_pie_10' class='chart_morris'></div>
                                <div id='chart_pie_10_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis")?> </center></b>
                                <div id='chart_pie_11' class='chart_morris'></div>
                                <div id='chart_pie_11_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 pdfNextPage">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Dýþý")?> </center></b>
                                <div id='chart_pie_12' class='chart_morris'></div>
                                <div id='chart_pie_12_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>

                <?php
                        $aybazinda_data_karsilama_adet_arr      = $chartClass->aybazliKarsilamaAdetBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                        foreach($aybazinda_data_karsilama_adet_arr as $aybazinda_data){
                            $chart_data_adet .= "{ kayit_ay:'".$aybazinda_data["YIL_AY"]."', karsilama:".formatla($aybazinda_data["KARSILAMA_ADET"])." }, ";
                        }
                ?>
                <div class="row" style="width: 99.7%;">
                <div class="col-lg-12">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                        <div class="row" style="width: 99.7%;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Ay Bazýnda Adet Karþýlama")?> (%) </p>
                            </div>
                            <div id='chart_hist_karsilama_adet' class='chart_morris'></div>
                        </div>

                    </div>
                </div>
                </div>

                <?php
                        $aybazinda_data_karsilama_tutar_arr         = $chartClass->aybazliKarsilamaTutarBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                        foreach($aybazinda_data_karsilama_tutar_arr as $aybazinda_tk_data){
                            $chart_data_karsilama_tutar .= "{ kayit_ay:'".$aybazinda_tk_data["YIL_AY"]."', karsilama:".formatla($aybazinda_tk_data["KARSILAMA_TUTAR"])." }, ";
                        }
                ?>
                <div class="row" style="width: 99.7%;">
                <div class="col-lg-12">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                        <div class="row" style="width: 99.7%;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Ay Bazýnda Karþýlama Tutar");?>(%) </p>
                            </div>
                            <div id='chart_hist_karsilama_tutar' class='chart_morris'></div>
                        </div>

                    </div>
                </div>
                </div>

                <?php
                        $aybazinda_data_karsilama_tutar_arr         = $chartClass->aybazliKazandirilanTutarBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                        foreach($aybazinda_data_karsilama_tutar_arr as $aybazinda_tutar_data){

                            $YIL_AY                     = $aybazinda_tutar_data['YIL_AY'];
                            $TEDARIK_SISTEM_TUTAR       = $aybazinda_tutar_data['TEDARIK_SISTEM_TUTAR'];
                            $TEDARIK_ISK_TUTARI         = $aybazinda_tutar_data['TEDARIK_ISK_TUTARI'];
                            $TEDARIK_KAZANDIRILAN       = $aybazinda_tutar_data['TEDARIK_SISTEM_TUTAR'] - $aybazinda_tutar_data['TEDARIK_ISK_TUTARI'];

                            $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR           = $aybazinda_tutar_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR            = $aybazinda_tutar_data['LO_SISTEM_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR            = $aybazinda_tutar_data['ESDEGER_SISTEM_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR        = $aybazinda_tutar_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR         = $aybazinda_tutar_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR         = $aybazinda_tutar_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR     = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR;
                            $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR      = $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR;
                            $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR      = $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR;

                            $TOPLAM_SISTEM_TUTARI                           = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR;
                            $TOPLAM_ISKONTOLU_TUTAR                         = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR;
                            $TOPLAM_KAZANDIRILAN_TUTAR                      = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR;

                            $TOPLAM_TEDARIK_SISTEM_TUTARI                   = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR;
                            $TOPLAM_TEDARIK_ISKONTOLU_TUTAR                 = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR;
                            $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR              = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR;

                            $TD_SISTEM_TUTAR                    = $aybazinda_tutar_data['TD_SISTEM_TUTAR'];
                            $TD_ISK_TUTARI                      = $aybazinda_tutar_data['TD_ISK_TUTAR'];
                            $TD_ISKONTOLU_TUTARI                = $aybazinda_tutar_data['TD_ISK_TUTARI'];
                            $TD_KAZANDIRILAN                    = $aybazinda_tutar_data['TD_SISTEM_TUTAR'] - $aybazinda_tutar_data['TD_ISK_TUTAR'];

                            $TD_LOESD_SISTEM_TUTAR              = $aybazinda_tutar_data['TD_YC_SISTEM_TUTAR'];
                            $TD_LOESD_ISKONTOLU                 = $aybazinda_tutar_data['TD_YC_ISK_TUTAR'];
                            $TD_LOESD_KAZANDIRILAN              = $TD_LOESD_SISTEM_TUTAR - $TD_LOESD_ISKONTOLU;

                            $TD_ORJ_SISTEM_TUTAR                = $TD_SISTEM_TUTAR - $TD_LOESD_SISTEM_TUTAR;
                            $TD_ORJ_ISKONTOLU                   = $TD_ISK_TUTARI - $TD_LOESD_ISKONTOLU;
                            $TD_ORJ_KAZANDIRILAN                = $TD_ORJ_SISTEM_TUTAR - $TD_ORJ_ISKONTOLU;

                            $SERVIS_ISKONTO_SISTEM              = $aybazinda_tutar_data['SERVIS_ORG_SISTEM_TUTAR'] + $aybazinda_tutar_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_SERVIS              = $aybazinda_tutar_data['SERVIS_ORG_ISK_TUTAR'] + $aybazinda_tutar_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_KAZANDIRILAN                = $SERVIS_ISKONTO_SISTEM - $SERVIS_ISKONTO_SERVIS;

                            $SERVIS_ISKONTO_ORJ_SISTEM          = $aybazinda_tutar_data['SERVIS_ORG_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_SERVIS          = $aybazinda_tutar_data['SERVIS_ORG_ISK_TUTAR'];
                            $SERVIS_ISKONTO_ORJ_KAZANDIRILAN    = $SERVIS_ISKONTO_ORJ_SISTEM - $SERVIS_ISKONTO_ORJ_SERVIS;

                            $SERVIS_ISKONTO_LOESD_SISTEM        = $aybazinda_tutar_data['SERVIS_LOESD_SISTEM_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_SERVIS        = $aybazinda_tutar_data['SERVIS_LOESD_ISK_TUTAR'];
                            $SERVIS_ISKONTO_LOESD_KAZANDIRILAN  = $SERVIS_ISKONTO_LOESD_SISTEM - $SERVIS_ISKONTO_LOESD_SERVIS;

                            $ORJ_TEDARIK_SISTEM_TUTAR           = $aybazinda_tutar_data['ORJ_TEDARIK_SISTEM_TUTAR'];
                            $ORJ_TEDARIK_KAZANDIRILAN           = $aybazinda_tutar_data['ORJ_TEDARIK_ISK_TUTARI'];

                            $LO_TEDARIK_SISTEM_TUTAR            = $aybazinda_tutar_data['LO_SISTEM_TUTAR'];
                            $LO_TEDARIK_KAZANDIRILAN            = $aybazinda_tutar_data['LO_ISK_TUTARI'];

                            $ESDEGER_TEDARIK_SISTEM_TUTAR       = $aybazinda_tutar_data['ESDEGER_SISTEM_TUTAR'];
                            $ESDEGER_TEDARIK_KAZANDIRILAN       = $aybazinda_tutar_data['ESDEGER_ISK_TUTARI'];

                            $ORJ_TEDARIK_ISKONTOLU_TUTAR        = $aybazinda_tutar_data['ORJ_TEDARIK_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR         = $aybazinda_tutar_data['LO_ISK_TUTAR'];
                            $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR         = $aybazinda_tutar_data['ESDEGER_ISK_TUTAR'];

                            $TOPLAM_KAZANDIRILAN                = $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR+ $SERVIS_KAZANDIRILAN + $TD_KAZANDIRILAN;
                            $TOPLAM_SISTEM_TUTAR                = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR + $SERVIS_ISKONTO_SISTEM + $TD_SISTEM_TUTAR;
                            $chart_data_tutar .= "{ kayit_ay:'".$YIL_AY."', kazandirilan:".($TOPLAM_KAZANDIRILAN)." }, ";
                        }
                ?>
                <div class="row" style="width: 99.7%;">
                <div class="col-lg-12">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                        <div class="row" style="width: 99.7%;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Ay Bazýnda Kazandýrýlan Tutar")?> </p>
                            </div>
                            <div id='chart_hist_kazandirilan_tutar' class='chart_morris'></div>
                        </div>

                    </div>
                </div>
                </div>
                <?php
                if( OAConf::COMPANY_ID !=20 && OAConf::COMPANY_ID !=27){
                ?>
                <?php
                        $aybazinda_iade_arr         = $chartClass->aybazliIadeBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci);
                        foreach($aybazinda_iade_arr as $iade_data){
                            $chart_data_iade .= "{ kayit_ay:'".$iade_data["YIL_AY"]."', iade_adet:".($iade_data["IADE_ADET"])." , iade_tutar:".($iade_data["IADE_TUTAR"]).", iade_siparis_oran:".formatla($iade_data["TOPLAM_VAR_IADE_ORANI"])." }, ";
                        }
                ?>
                <div class="row pdfNextPage" style="width: 99.7%;">
                    <div class="col-lg-12">
                        <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                            <div class="row" style="width: 99.7%;">
                                <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                    <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Ay Bazýnda Ýade")?> </p>
                                </div>
                                <div id='chart_hist_iade' class='chart_morris'></div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php } ?>
    </div>

    <div class="clear"></div>

    <div style="margin-top : 10px;"></div>

    <script type="text/javascript" src="/jq/jquery.base64.js"></script>
    <script>
        function pdfMake(id, filename) {
            $.base64.utf8encode = true;
            var htmlIcerik = $.base64.btoa($('#' + id).html());

            $.post('/toPDF.php', {contentHTML: htmlIcerik, fileName: filename}, function(data, textStatus, xhr) {
                if (data.file_name) {
                    popup('/toPDF.php?download=' + data.file_name, 'PDFDownload_' + Math.floor(Math.random() * 100000000), 700, 100);
                }
            }, "json");
        }

        <?php if( OAConf::COMPANY_ID !=20 && OAConf::COMPANY_ID !=27){ ?>
        Morris.Bar({
          element: 'chart_hist_iade',
          dataLabels: true,
          data:[<?php echo $chart_data_iade; ?>],
          xkey:'kayit_ay',
          ykeys:['iade_adet','iade_tutar','iade_siparis_oran' ],
          labels:['<?=dil_dashboard("Adet")?>','<?=dil_dashboard("Tutar")?>','<?=dil_dashboard("Ýade Oran Toplam Sipariþ Oraný(%)")?>'],
          barColors:['#ce6969', '#862f2d','#ff0000'],
          stacked:true,
        });
        <?php } ?>

        Morris.Bar({
          element: 'chart_hist_karsilama_adet',
          dataLabels: true,
          data:[<?php echo $chart_data_adet; ?>],
          xkey:'kayit_ay',
          ykeys:['karsilama'],
          labels:['<?=dil_dashboard("Karþýlama Oraný Adet(%)")?>'],
          barColors:['#d6af50', '#5e2590'],
          stacked:true,
        });

        Morris.Bar({
          element: 'chart_hist_karsilama_tutar',
          dataLabels: true,
          data:[<?php echo $chart_data_karsilama_tutar; ?>],
          xkey:'kayit_ay',
          ykeys:['karsilama'],
          labels:['<?=dil_dashboard("Karþýlama Oraný Tutar(%)")?>'],
          barColors:['#5e7ead', '#5e2590'],
          stacked:true,
        });

        Morris.Bar({
          element: 'chart_hist_kazandirilan_tutar',
          dataLabels: true,
          data:[<?php echo $chart_data_tutar; ?>],
          xkey:'kayit_ay',
          ykeys:['kazandirilan'],
          labels:['<?=dil_dashboard("Kazandýrýlan")?>'],
          barColors:['#5cb15a', '#5e2590'],
          stacked:true,
        });

        Morris.Bar({
          element: 'chart_hist_marka',
          dataLabels: true,
          data:[<?php echo $chart_data_marka; ?>],
          xkey:'marka',
          ykeys:['kazandirilan','iskonto_oran'],
          labels:['<?=dil_dashboard("Kazandýrýlan Tutar")?>', '<?=dil_dashboard("Ýskonto Oran(%)")?>'],
          horizontal: true,
          stacked:true,
        });

        Morris.Bar({
          element: 'chart_hist_tedarikci',
          dataLabels: true,
          data:[<?php echo $chart_data_tedarikci; ?>],
          xkey:'tedarikci',
          ykeys:['kazandirilan','iskonto_oran'],
          labels:['<?=dil_dashboard("Kazandýrýlan Tutar")?>', '<?=dil_dashboard("Ýskonto Oran(%)")?>'],
          horizontal: true,
          stacked:true,
        });

        Morris.Bar({
          element: 'chart_hist_iller',
          dataLabels: true,
          data:[<?php echo $chart_data_iller; ?>],
          xkey:'Þehir',
          ykeys:['kazandirilan','iskonto_oran'],
          labels:['<?=dil_dashboard("Kazandýrýlan Tutar")?>', '<?=dil_dashboard("Ýskonto Oran(%)")?>'],
          horizontal: true,
          stacked:true,
        });

        pie_data  = [ <?=$pie_data; ?> ];
        pie_data2 = [ <?=$pie_data2;?> ];
        pie_data3 = [ <?=$pie_data3;?> ];
        pie_data4 = [ <?=$pie_data4;?> ];
        pie_data5 = [ <?=$pie_data5;?> ];
        pie_data6 = [ <?=$pie_data6;?> ];
        pie_data7 = [ <?=$pie_data7;?> ];
        pie_data8 = [ <?=$pie_data8;?> ];
        pie_data9 = [ <?=$pie_data9;?> ];
        pie_data10 = [ <?=$pie_data10;?> ];
        pie_data11 = [ <?=$pie_data11;?> ];
        pie_data12 = [ <?=$pie_data12;?> ];

        Morris.Donut({
          element: 'chart_pie_1',
          data: pie_data
        }).options.colors.forEach(function(color, a){
        if (pie_data[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data[a].label+'</span>';
            document.getElementById("chart_pie_1_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_2',
          data: pie_data2
        }).options.colors.forEach(function(color, a){
        if (pie_data2[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data2[a].label+'</span>';
            document.getElementById("chart_pie_2_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_3',
          data: pie_data3
        }).options.colors.forEach(function(color, a){
        if (pie_data3[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data3[a].label+'</span>';
            document.getElementById("chart_pie_3_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_4',
          data: pie_data4
        }).options.colors.forEach(function(color, a){
        if (pie_data4[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data4[a].label+'</span>';
            document.getElementById("chart_pie_4_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_5',
          data: pie_data5
        }).options.colors.forEach(function(color, a){
        if (pie_data5[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data5[a].label+'</span>';
            document.getElementById("chart_pie_5_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_6',
          data: pie_data6
        }).options.colors.forEach(function(color, a){
        if (pie_data6[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data6[a].label+'</span>';
            document.getElementById("chart_pie_6_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_7',
          data: pie_data7
        }).options.colors.forEach(function(color, a){
        if (pie_data7[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data7[a].label+'</span>';
            document.getElementById("chart_pie_7_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_8',
          data: pie_data8
        }).options.colors.forEach(function(color, a){
        if (pie_data8[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data8[a].label+'</span>';
            document.getElementById("chart_pie_8_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_9',
          data: pie_data9
        }).options.colors.forEach(function(color, a){
        if (pie_data9[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data9[a].label+'</span>';
            document.getElementById("chart_pie_9_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_10',
          data: pie_data10
        }).options.colors.forEach(function(color, a){
        if (pie_data10[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data10[a].label+'</span>';
            document.getElementById("chart_pie_10_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_11',
          data: pie_data11
        }).options.colors.forEach(function(color, a){
        if (pie_data11[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data11[a].label+'</span>';
            document.getElementById("chart_pie_11_legend").appendChild(node);
          }
        });

        Morris.Donut({
          element: 'chart_pie_12',
          data: pie_data12
        }).options.colors.forEach(function(color, a){
        if (pie_data12[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data12[a].label+'</span>';
            document.getElementById("chart_pie_12_legend").appendChild(node);
          }
        });

    </script>