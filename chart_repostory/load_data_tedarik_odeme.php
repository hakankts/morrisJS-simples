<?php
require_once("chartTedarikOdemeClass.php");
$charttedarikOdemeClass         = new chartClassTedarikOdeme();
?>
<?php require_once("load_modal.php");?>
<?php $chart_data_arr         = $charttedarikOdemeClass->chartBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
    <?php
        foreach($chart_data_arr as $chart_data){
            
            $TOPLAM_SISTEM_TUTAR = ($chart_data["TOPLAM_SISTEM_TUTAR"]);
            $TOPLAM_GERCEKLESEN = ($chart_data["TOPLAM_GERCEKLESEN"]);
            $TOPLAM_ISKONTO_TUTAR = $TOPLAM_SISTEM_TUTAR -  $TOPLAM_GERCEKLESEN;

            $TOPLAM_ORJ_ADET = ($chart_data["TOPLAM_ORJ_ADET"]);
            $TOPLAM_LOESD_ADET = ($chart_data["TOPLAM_LOESD_ADET"]);

            $TOPLAM_ORJ_SISTEM_TUTAR    = ($chart_data["TOPLAM_ORJ_SISTEM_TUTAR"]);
            $TOPLAM_ORJ_GERCEKLESEN     = ($chart_data["TOPLAM_ORJ_GERCEKLESEN"]);
            $TOPLAM_ORJ_ISKONTO         = $TOPLAM_ORJ_SISTEM_TUTAR - $TOPLAM_ORJ_GERCEKLESEN;

            $TOPLAM_LOESD_SISTEM_TUTAR  = ($chart_data["TOPLAM_LOESD_SISTEM_TUTAR"]);
            $TOPLAM_LOESD_GERCEKLESEN   = ($chart_data["TOPLAM_LOESD_GERCEKLESEN"]);
            $TOPLAM_LOESD_ISKONTO       = $TOPLAM_LOESD_SISTEM_TUTAR - $TOPLAM_LOESD_GERCEKLESEN;

            $YET_TUMU_DEGISIM_ADET      = ($chart_data["YET_TUMU_DEGISIM_ADET"]);
            $YET_TUMU_SISTEM            = ($chart_data["YET_TUMU_SISTEM"]);
            $YET_TUMU_GERCEKLESEN       = ($chart_data["YET_TUMU_GERCEKLESEN"]);
            $YET_TUMU_ISKONTO           = $YET_TUMU_SISTEM - $YET_TUMU_GERCEKLESEN;

            $OZL_TUMU_DEGISIM_ADET      = ($chart_data["OZL_TUMU_DEGISIM_ADET"]);
            $OZL_TUMU_SISTEM            = ($chart_data["OZL_TUMU_SISTEM"]);
            $OZL_TUMU_GERCEKLESEN       = ($chart_data["OZL_TUMU_GERCEKLESEN"]);
            $OZL_TUMU_ISKONTO           = $OZL_TUMU_SISTEM - $OZL_TUMU_GERCEKLESEN;

            $ORJ_YET_DEGISIM_ADET       = ($chart_data["ORJ_YET_DEGISIM_ADET"]);
            $ORJ_YET_SISTEM             = ($chart_data["ORJ_YET_SISTEM"]);
            $ORJ_YET_GERCEKLESEN        = ($chart_data["ORJ_YET_GERCEKLESEN"]);
            $ORJ_YET_ISKONTO            = $ORJ_YET_SISTEM - $ORJ_YET_GERCEKLESEN;

            $LOESD_YET_DEGISIM_ADET     = ($chart_data["LOESD_YET_DEGISIM_ADET"]);
            $LOESD_YET_SISTEM           = ($chart_data["LOESD_YET_SISTEM"]);
            $LOESD_YET_GERCEKLESEN      = ($chart_data["LOESD_YET_GERCEKLESEN"]);
            $LOESD_YET_ISKONTO          = $LOESD_YET_SISTEM - $LOESD_YET_GERCEKLESEN;

            $ORJ_OZEL_DEGISIM_ADET      = ($chart_data["ORJ_OZEL_DEGISIM_ADET"]);
            $ORJ_OZEL_SISTEM            = ($chart_data["ORJ_OZEL_SISTEM"]);
            $ORJ_OZEL_GERCEKLESEN       = ($chart_data["ORJ_OZEL_GERCEKLESEN"]);
            $ORJ_OZEL_ISKONTO           = $ORJ_OZEL_SISTEM - $ORJ_OZEL_GERCEKLESEN;

            $LOESD_OZEL_DEGISIM_ADET    = ($chart_data["LOESD_OZEL_DEGISIM_ADET"]);
            $LOESD_OZEL_SISTEM          = ($chart_data["LOESD_OZEL_SISTEM"]);
            $LOESD_OZEL_GERCEKLESEN     = ($chart_data["LOESD_OZEL_GERCEKLESEN"]);
            $LOESD_OZEL_ISKONTO         = $LOESD_OZEL_SISTEM - $LOESD_OZEL_GERCEKLESEN;

            $TED_ORJ_DEGISIM_ADET       = ($chart_data["TED_ORJ_DEGISIM_ADET"]);
            $TED_ORJ_SISTEM             = ($chart_data["TED_ORJ_SISTEM"]);
            $TED_ORJ_GERCEKLESEN        = ($chart_data["TED_ORJ_GERCEKLESEN"]);
            $TED_ORJ_ISKONTO            = $TED_ORJ_SISTEM - $TED_ORJ_GERCEKLESEN;

            $TED_LO_DEGISIM_ADET        = ($chart_data["TED_LO_DEGISIM_ADET"]);
            $TED_LO_SISTEM              = ($chart_data["TED_LO_SISTEM"]);
            $TED_LO_GERCEKLESEN         = ($chart_data["TED_LO_GERCEKLESEN"]);
            $TED_LO_ISKONTO             = $TED_LO_SISTEM - $TED_LO_GERCEKLESEN;

            $TED_ESD_DEGISIM_ADET       = ($chart_data["TED_ESD_DEGISIM_ADET"]);
            $TED_ESD_SISTEM             = ($chart_data["TED_ESD_SISTEM"]);
            $TED_ESD_GERCEKLESEN        = ($chart_data["TED_ESD_GERCEKLESEN"]);
            $TED_ESD_ISKONTO            = $TED_ESD_SISTEM - $TED_ESD_GERCEKLESEN;

            $YET_ALI_DEGISIM_ADET       = ($chart_data["YET_ALI_DEGISIM_ADET"]);
            $YET_ALI_SISTEM             = ($chart_data["YET_ALI_SISTEM"]);
            $YET_ALI_GERCEKLESEN        = ($chart_data["YET_ALI_GERCEKLESEN"]);
            $YET_ALI_ISKONTO            = $YET_ALI_SISTEM - $YET_ALI_GERCEKLESEN;

            $YET_ASIZ_DEGISIM_ADET      = ($chart_data["YET_ASIZ_DEGISIM_ADET"]);
            $YET_ASIZ_SISTEM            = ($chart_data["YET_ASIZ_SISTEM"]);
            $YET_ASIZ_GERCEKLESEN       = ($chart_data["YET_ASIZ_GERCEKLESEN"]);
            $YET_ASIZ_ISKONTO           = $YET_ASIZ_SISTEM - $YET_ASIZ_GERCEKLESEN;

            $OZEL_ALI_DEGISIM_ADET      = ($chart_data["OZEL_ALI_DEGISIM_ADET"]);
            $OZEL_ALI_SISTEM            = ($chart_data["OZEL_ALI_SISTEM"]);
            $OZEL_ALI_GERCEKLESEN       = ($chart_data["OZEL_ALI_GERCEKLESEN"]);
            $OZEL_ALI_ISKONTO           = $OZEL_ALI_SISTEM - $OZEL_ALI_GERCEKLESEN;

            $OZEL_ASIZ_DEGISIM_ADET     = ($chart_data["OZEL_ASIZ_DEGISIM_ADET"]);
            $OZEL_ASIZ_SISTEM           = ($chart_data["OZEL_ASIZ_SISTEM"]);
            $OZEL_ASIZ_GERCEKLESEN      = ($chart_data["OZEL_ASIZ_GERCEKLESEN"]);
            $OZEL_ASIZ_ISKONTO          = $OZEL_ASIZ_SISTEM - $OZEL_ASIZ_GERCEKLESEN;
			
			$TOPLAM_ADET = $ORJ_YET_DEGISIM_ADET + $ORJ_OZEL_DEGISIM_ADET + $LOESD_YET_DEGISIM_ADET + $LOESD_OZEL_DEGISIM_ADET;

        }
		
		
        ?>
        <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #ff0000; margin: 0px auto; background-color:#ffffff;text-align:center;font-weight: 600;">
            <?=dil_dashboard("Hesaplamalarda kapalý dosyalar, deðiþen parçalar, pert olmayan, talepsiz kapatýlmayan dosyalar dikkate alýnmýþtýr")?>

        </div>
        <div class="card" style="width: 99.7%;margin: 0px auto;">
                <?php
                    //DONUT 1
                    $pie_data1  .= "{ label: '".dil_dashboard('Orijinal Adet %' .(formatla( (($ORJ_YET_DEGISIM_ADET+$ORJ_OZEL_DEGISIM_ADET)) / ($TOPLAM_ADET) *100)) )."', value: ". (formatla( (($ORJ_YET_DEGISIM_ADET+$ORJ_OZEL_DEGISIM_ADET)) / ($TOPLAM_ADET) *100)) ." }, ";
                    $pie_data1  .= "{ label: '".dil_dashboard('Lo-Eþdeðer Adet %' .(formatla(($LOESD_YET_DEGISIM_ADET + $LOESD_OZEL_DEGISIM_ADET) / ($TOPLAM_ADET) *100)))."', value: ". (formatla(($LOESD_YET_DEGISIM_ADET + $LOESD_OZEL_DEGISIM_ADET) / ($TOPLAM_ADET) *100)) ." }, ";
                ?>

                <?php
                    //DONUT 2
                    $pie_data2  .= "{ label: '".dil_dashboard('Orijinal%' .(formatla( ($ORJ_YET_GERCEKLESEN + $ORJ_OZEL_GERCEKLESEN) / (($ORJ_YET_GERCEKLESEN + $ORJ_OZEL_GERCEKLESEN) + ($LOESD_YET_GERCEKLESEN + $LOESD_OZEL_GERCEKLESEN)) *100)))."', value: ". (formatla( ($ORJ_YET_GERCEKLESEN + $ORJ_OZEL_GERCEKLESEN) / (($ORJ_YET_GERCEKLESEN + $ORJ_OZEL_GERCEKLESEN) + ($LOESD_YET_GERCEKLESEN + $LOESD_OZEL_GERCEKLESEN)) *100)) ." }, ";
                    $pie_data2  .= "{ label: '".dil_dashboard('Lo-Eþdeðer%' .(formatla(($LOESD_YET_GERCEKLESEN + $LOESD_OZEL_GERCEKLESEN)  / (($ORJ_YET_GERCEKLESEN + $ORJ_OZEL_GERCEKLESEN) + ($LOESD_YET_GERCEKLESEN + $LOESD_OZEL_GERCEKLESEN)) *100)))."', value: ". (formatla(($LOESD_YET_GERCEKLESEN + $LOESD_OZEL_GERCEKLESEN)  / (($ORJ_YET_GERCEKLESEN + $ORJ_OZEL_GERCEKLESEN) + ($LOESD_YET_GERCEKLESEN + $LOESD_OZEL_GERCEKLESEN)) *100)) ." }, ";
                ?>

                <?php
                    //DONUT 3
                    $pie_data3  .= "{ label: '".dil_dashboard('Orijinal%' .(formatla( (($ORJ_YET_ISKONTO + $ORJ_OZEL_ISKONTO) / ( ($ORJ_YET_SISTEM + $ORJ_OZEL_SISTEM))) *100)))."', value: ". (formatla( (($ORJ_YET_ISKONTO + $ORJ_OZEL_ISKONTO) / ( ($ORJ_YET_SISTEM + $ORJ_OZEL_SISTEM))) *100)) ." }, ";
                    $pie_data3  .= "{ label: '".dil_dashboard('Lo-Eþdeðer%' .(formatla( (($LOESD_YET_ISKONTO+$LOESD_OZEL_ISKONTO) / ( ($LOESD_YET_SISTEM + $LOESD_OZEL_SISTEM))) *100)))."', value: ". (formatla( (($LOESD_YET_ISKONTO+$LOESD_OZEL_ISKONTO) / ( ($LOESD_YET_SISTEM + $LOESD_OZEL_SISTEM))) *100)) ." }, ";
                ?>
                    <div style="width: 99.7%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 425px;">
                    <div class="row">
                        <div class="col-lg-4 col-lg-4-pdf height15">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Toplam Yedek Parça Adet Daðýlým%")?></center></b>
                                <div id='chart_pie_1' class='chart_morris'></div>
                                <div id='chart_pie_1_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-lg-4-pdf height15">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Toplam Yedek Parça Tutar Daðýlým%")?></center></b>
                                <div id='chart_pie_2' class='chart_morris'></div>
                                <div id='chart_pie_2_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-lg-4-pdf height15">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Ýskonto Oraný%")?></center></b>
                                <div id='chart_pie_3' class='chart_morris'></div>
                                <div id='chart_pie_3_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="row" style="width: 99.7%;margin: 0px auto;">
                        <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                            <div class="table-responsive">
                            <table class="table" id="dev-table" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="text-align: center;min-width: 200px;" ><?=dil_dashboard("PARÇA TÜRÜ BAZINDA")?></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="text-align: center;min-width: 200px;" ><?=dil_dashboard("Yedek Parça")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ortalama")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ýskonto")?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?/*<tr>
                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("TOPLAM")?></td>

                                    <td style="text-align: center; font-size: 13px;"><?php echo ($TOPLAM_ORJ_ADET + $TOPLAM_LOESD_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TOPLAM_ORJ_GERCEKLESEN + $TOPLAM_LOESD_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($TOPLAM_ORJ_GERCEKLESEN + $TOPLAM_LOESD_GERCEKLESEN) / ($TOPLAM_ORJ_ADET + $TOPLAM_LOESD_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((1-($TOPLAM_ORJ_GERCEKLESEN + $TOPLAM_LOESD_GERCEKLESEN) / ($TOPLAM_ORJ_SISTEM_TUTAR + $TOPLAM_LOESD_SISTEM_TUTAR)) *100);?></td>
                                </tr>*/?>
                                <tr>

                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?=dil_dashboard("TOPLAM")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo ($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET>0) { echo "100.00"; } else { echo "0";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM>0) { echo "100.00"; } else { echo "0.00";}?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN>0) { echo "100.00"; } else { echo "0.00";}?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla(($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN) / ($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla((($YET_TUMU_ISKONTO + $OZL_TUMU_ISKONTO) / ($YET_TUMU_SISTEM +$OZL_TUMU_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Yetkili Servisler")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($YET_TUMU_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_DEGISIM_ADET / ($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_SISTEM / ($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($YET_TUMU_GERCEKLESEN) / ($YET_TUMU_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla((($YET_TUMU_ISKONTO) / ($YET_TUMU_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Orijinal ")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ORJ_YET_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_YET_DEGISIM_ADET / $YET_TUMU_DEGISIM_ADET *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_YET_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_YET_SISTEM / ($YET_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_YET_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_YET_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($ORJ_YET_GERCEKLESEN) / ($ORJ_YET_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($ORJ_YET_ISKONTO) / ($ORJ_YET_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Logosuz-Eþdeðer ")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($LOESD_YET_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_YET_DEGISIM_ADET / $YET_TUMU_DEGISIM_ADET *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_YET_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_YET_SISTEM / ($YET_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_YET_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_YET_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($LOESD_YET_GERCEKLESEN) / ($LOESD_YET_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($LOESD_YET_ISKONTO) / ($LOESD_YET_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Özel Servisler")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($OZL_TUMU_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_DEGISIM_ADET / ($YET_TUMU_DEGISIM_ADET+$OZL_TUMU_DEGISIM_ADET) *100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_SISTEM / ($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($OZL_TUMU_GERCEKLESEN) / ($OZL_TUMU_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla((($OZL_TUMU_ISKONTO) / ($OZL_TUMU_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Orijinal ")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ORJ_OZEL_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_OZEL_DEGISIM_ADET / $OZL_TUMU_DEGISIM_ADET *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_OZEL_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_OZEL_SISTEM / ($OZL_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_OZEL_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ORJ_OZEL_GERCEKLESEN / ($OZL_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($ORJ_OZEL_GERCEKLESEN) / ($ORJ_OZEL_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($ORJ_OZEL_ISKONTO) / ($ORJ_OZEL_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Logosuz-Eþdeðer ")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($LOESD_OZEL_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_OZEL_DEGISIM_ADET / $OZL_TUMU_DEGISIM_ADET *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_OZEL_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_OZEL_SISTEM / ($OZL_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_OZEL_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($LOESD_OZEL_GERCEKLESEN / ($OZL_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($LOESD_OZEL_GERCEKLESEN) / ($LOESD_OZEL_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($LOESD_OZEL_ISKONTO) / ($LOESD_OZEL_SISTEM)) *100);?></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="width: 99.7%;margin: 0px auto;">
                        <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                            <div class="table-responsive">
                            <table class="table" id="dev-table">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="text-align: center;min-width: 200px;" ><?=dil_dashboard("SERVÝS TÜRÜ BAZINDA")?></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="text-align: center;min-width: 200px;" ><?=dil_dashboard("Yedek Parça")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ortalama")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ýskonto")?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?=dil_dashboard("TOPLAM")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo ($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET>0) { echo "100.00"; } else { echo "0";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM>0) { echo "100.00"; } else { echo "0.00";}?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN>0) { echo "100.00"; } else { echo "0.00";}?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla(($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN) / ($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla((($YET_TUMU_ISKONTO + $OZL_TUMU_ISKONTO) / ($YET_TUMU_SISTEM +$OZL_TUMU_SISTEM)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Yetkili Servisler")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($YET_TUMU_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_DEGISIM_ADET / ($YET_TUMU_DEGISIM_ADET +$OZL_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_SISTEM / ($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($YET_TUMU_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN) * 100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($YET_TUMU_GERCEKLESEN) / ($YET_TUMU_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla((($YET_TUMU_ISKONTO) / ($YET_TUMU_SISTEM)) *100);?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Anlaþmalý")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($YET_ALI_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ALI_DEGISIM_ADET /($YET_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ALI_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ALI_SISTEM / ($YET_TUMU_SISTEM)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ALI_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ALI_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($YET_ALI_GERCEKLESEN) / ($YET_ALI_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($YET_ALI_ISKONTO) / ($YET_ALI_SISTEM)) *100);?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Anlaþmasýz ")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($YET_ASIZ_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ASIZ_DEGISIM_ADET /($YET_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ASIZ_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ASIZ_SISTEM / ($YET_TUMU_SISTEM)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ASIZ_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($YET_ASIZ_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($YET_ASIZ_GERCEKLESEN) / ($YET_ASIZ_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($YET_ASIZ_ISKONTO) / ($YET_ASIZ_SISTEM)) *100);?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Özel Servis")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($OZL_TUMU_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_DEGISIM_ADET / ($YET_TUMU_DEGISIM_ADET+$OZL_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_SISTEM / ($YET_TUMU_SISTEM + $OZL_TUMU_SISTEM)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($OZL_TUMU_GERCEKLESEN / ($YET_TUMU_GERCEKLESEN + $OZL_TUMU_GERCEKLESEN)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($OZL_TUMU_GERCEKLESEN) / ($OZL_TUMU_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla((($OZL_TUMU_ISKONTO) / ($OZL_TUMU_SISTEM)) *100);?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Anlaþmalý")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($OZEL_ALI_DEGISIM_ADET);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ALI_DEGISIM_ADET / ($OZL_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ALI_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ALI_SISTEM / ($OZL_TUMU_SISTEM)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ALI_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ALI_GERCEKLESEN / ($OZL_TUMU_GERCEKLESEN)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($OZEL_ALI_GERCEKLESEN) / ($OZEL_ALI_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($OZEL_ALI_ISKONTO) / ($OZEL_ALI_SISTEM)) *100);?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Anlaþmasýz ")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($OZEL_ASIZ_DEGISIM_ADET); ?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ASIZ_DEGISIM_ADET /($OZL_TUMU_DEGISIM_ADET)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ASIZ_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ASIZ_SISTEM / ($OZL_TUMU_SISTEM)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ASIZ_GERCEKLESEN);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($OZEL_ASIZ_GERCEKLESEN / ($OZL_TUMU_GERCEKLESEN)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($OZEL_ASIZ_GERCEKLESEN) / ($OZEL_ASIZ_DEGISIM_ADET));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($OZEL_ASIZ_ISKONTO) / ($OZEL_ASIZ_SISTEM)) *100);?></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                    <?php if($rapor_secim!="2"){?>

                    <?php $ted_toplam_data  = $charttedarikOdemeClass->tedarikYedekParca($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                    <?php       $TED_ORJ_DEGISIM_ADET3      = ($ted_toplam_data["TED_ORJ_DEGISIM_ADET"]);
                                $TED_ORJ_SISTEM3            = ($ted_toplam_data["TED_ORJ_SISTEM"]);
                                $TED_ORJ_GERCEKLESEN3       = ($ted_toplam_data["TED_ORJ_GERCEKLESEN"]);

                                $TED_LO_DEGISIM_ADET3       = ($ted_toplam_data["TED_LO_DEGISIM_ADET"]);
                                $TED_LO_SISTEM3             = ($ted_toplam_data["TED_LO_SISTEM"]);
                                $TED_LO_GERCEKLESEN3        = ($ted_toplam_data["TED_LO_GERCEKLESEN"]);

                                $TED_ESD_DEGISIM_ADET3      = ($ted_toplam_data["TED_ESD_DEGISIM_ADET"]);
                                $TED_ESD_SISTEM3            = ($ted_toplam_data["TED_ESD_SISTEM"]);
                                $TED_ESD_GERCEKLESEN3       = ($ted_toplam_data["TED_ESD_GERCEKLESEN"]);

                                $TED_ORJ_KAZANDIRILAN3      = $TED_ORJ_SISTEM3 - $TED_ORJ_GERCEKLESEN3;
                                $TED_LO_KAZANDIRILAN3       = $TED_LO_SISTEM3 - $TED_LO_GERCEKLESEN3;
                                $TED_ESD_KAZANDIRILAN3      = $TED_ESD_SISTEM3 - $TED_ESD_GERCEKLESEN3;

                                $TOPLAM_TED_SISTEM          = $TED_ORJ_SISTEM3 + $TED_LO_SISTEM3 + $TED_ESD_SISTEM3;
                                $TOPLAM_TED_GERCEKLESEN     = $TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3;
                                $TOPLAM_TED_KAZANDIRILAN    = $TOPLAM_TED_SISTEM - $TOPLAM_TED_GERCEKLESEN;

                    ?>
                    <div class="row" style="width: 99.7%;margin: 0px auto;">
                        <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                            <div class="table-responsive">
                            <table class="table" id="dev-table">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="text-align: center;min-width: 200px;" ><?=dil_dashboard("TEDARÝK EDÝLEN PARÇA BAZINDA ")?></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="text-align: center;min-width: 200px;" ><?=dil_dashboard("Yedek Parça")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ortalama")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ýskonto")?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?=dil_dashboard("Yalnýz Tedarik Edilen Parçalar")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo ($TED_ORJ_DEGISIM_ADET3 + $TED_LO_DEGISIM_ADET3 + $TED_ESD_DEGISIM_ADET3);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_DEGISIM_ADET3 + $TED_LO_DEGISIM_ADET3 + $TED_ESD_DEGISIM_ADET3>0) { echo "100.00"; } else { echo "0";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($TOPLAM_TED_SISTEM);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TOPLAM_TED_SISTEM>0) { echo "100.00"; } else { echo "0.00";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3>0) { echo "100.00"; } else { echo "0.00";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla(($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3) / ($TED_ORJ_DEGISIM_ADET3 + $TED_LO_DEGISIM_ADET3 + $TED_ESD_DEGISIM_ADET3));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3>0) { echo formatla( (($TOPLAM_TED_KAZANDIRILAN) / ($TOPLAM_TED_SISTEM)) *100);; } else { echo "0.00";} ?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Orijinal")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($TED_ORJ_DEGISIM_ADET3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ORJ_DEGISIM_ADET3 / ($TED_ORJ_DEGISIM_ADET3 + $TED_LO_DEGISIM_ADET3 + $TED_ESD_DEGISIM_ADET3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ORJ_SISTEM3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ORJ_SISTEM3 / ($TED_ORJ_SISTEM3 + $TED_LO_SISTEM3 + $TED_ESD_SISTEM3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ORJ_GERCEKLESEN3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ORJ_GERCEKLESEN3 / ($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($TED_ORJ_GERCEKLESEN3) / ($TED_ORJ_DEGISIM_ADET3));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($TED_ORJ_KAZANDIRILAN3) / ($TED_ORJ_SISTEM3)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Logosuz Orijinal")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($TED_LO_DEGISIM_ADET3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_LO_DEGISIM_ADET3 / ($TED_ORJ_DEGISIM_ADET3 + $TED_LO_DEGISIM_ADET3 + $TED_ESD_DEGISIM_ADET3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_LO_SISTEM3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_LO_SISTEM3 / ($TED_ORJ_SISTEM3 + $TED_LO_SISTEM3 + $TED_ESD_SISTEM3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_LO_GERCEKLESEN3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_LO_GERCEKLESEN3 / ($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($TED_LO_GERCEKLESEN3) / ($TED_LO_DEGISIM_ADET3));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($TED_LO_KAZANDIRILAN3) / ($TED_LO_SISTEM3)) *100);?></td>
                                </tr>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?=dil_dashboard("Eþdeðer")?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($TED_ESD_DEGISIM_ADET3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ESD_DEGISIM_ADET3 / ($TED_ORJ_DEGISIM_ADET3 + $TED_LO_DEGISIM_ADET3 + $TED_ESD_DEGISIM_ADET3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ESD_SISTEM3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ESD_SISTEM3 / ($TED_ORJ_SISTEM3 + $TED_LO_SISTEM3 + $TED_ESD_SISTEM3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ESD_GERCEKLESEN3);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($TED_ESD_GERCEKLESEN3 / ($TED_ORJ_GERCEKLESEN3 + $TED_LO_GERCEKLESEN3 + $TED_ESD_GERCEKLESEN3) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($TED_ESD_GERCEKLESEN3) / ($TED_ESD_DEGISIM_ADET3));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla((($TED_ESD_KAZANDIRILAN3) / ($TED_ESD_SISTEM3)) *100);?></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($rapor_secim=="2"){ ?>

                    <?php $ted_orj_arr  = $charttedarikOdemeClass->tedarikOrijinalBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                    <?php foreach($ted_orj_arr as $ted_orj_toplam){ ?>
                    <?php       $TED_ORJ_DEGISIM_ADET2      += ($ted_orj_toplam["TED_ORJ_DEGISIM_ADET"]);
                                $TED_ORJ_SISTEM2            += ($ted_orj_toplam["TED_ORJ_SISTEM"]);
                                $TED_ORJ_GERCEKLESEN2       += ($ted_orj_toplam["TED_ORJ_GERCEKLESEN"]);
                        }
                                $TED_ORJ_ISKONTO2           = $TED_ORJ_SISTEM2 - $TED_ORJ_GERCEKLESEN2;
                    ?>
                    <?php $ted_lo_arr  = $charttedarikOdemeClass->tedarikLogosuzBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                    <?php foreach($ted_lo_arr as $ted_lo_toplam){ ?>
                    <?php       $TED_LO_DEGISIM_ADET2       += ($ted_lo_toplam["TED_LO_DEGISIM_ADET"]);
                                $TED_LO_SISTEM2             += ($ted_lo_toplam["TED_LO_SISTEM"]);
                                $TED_LO_GERCEKLESEN2        += ($ted_lo_toplam["TED_LO_GERCEKLESEN"]);
                        }
                                $TED_LO_ISKONTO2            = $TED_LO_SISTEM2 - $TED_LO_GERCEKLESEN2;
                    ?>
                    <?php $ted_esd_arr  = $charttedarikOdemeClass->tedarikEsdegerBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                    <?php foreach($ted_esd_arr as $ted_esd_toplam){ ?>
                    <?php       $TED_ESD_DEGISIM_ADET2      += ($ted_esd_toplam["TED_ESD_DEGISIM_ADET"]);
                                $TED_ESD_SISTEM2            += ($ted_esd_toplam["TED_ESD_SISTEM"]);
                                $TED_ESD_GERCEKLESEN2       += ($ted_esd_toplam["TED_ESD_GERCEKLESEN"]);
                        }
                                $TED_ESD_ISKONTO2           = $TED_ESD_SISTEM2 - $TED_ESD_GERCEKLESEN2;
                    ?>

                    <div class="row" style="width: 99.7%;margin: 0px auto;">
                        <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                            <div class="table-responsive">
                            <table class="table" id="dev-table">
                                <thead>
                                    <tr>
                                        <th colspan="9" style="text-align: center;min-width: 200px;" ><?=dil_dashboard("TEDARÝK EDÝLEN PARÇA BAZINDA ")?></th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th style="text-align: center;min-width: 200px;" ><?=dil_dashboard("Yedek Parça")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Adet%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Sistem Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Parça Tutarý%")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ortalama")?></th>
                                        <th style="text-align: center;"><?=dil_dashboard("Ýskonto")?> </th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?=dil_dashboard("Yalnýz Tedarik Edilen Parçalar")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo ($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2>0) { echo "100.00"; } else { echo "0";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($TED_ORJ_SISTEM2 + $TED_LO_SISTEM2 + $TED_ESD_SISTEM2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_SISTEM2 + $TED_LO_SISTEM2 + $TED_ESD_SISTEM2>0) { echo "100.00"; } else { echo "0.00";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2>0) { echo "100.00"; } else { echo "0.00";} ?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php echo formatla(($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2) / ($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #dfdfdf;"><?php if($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2>0) { echo formatla((1-($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2) / ($TED_ORJ_SISTEM2 + $TED_LO_SISTEM2 + $TED_ESD_SISTEM2)) *100); } else { echo "0.00";} ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Orijinal")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($TED_ORJ_DEGISIM_ADET2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ORJ_DEGISIM_ADET2 / ($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2) *100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ORJ_SISTEM2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ORJ_SISTEM2 / ($TED_ORJ_SISTEM2 + $TED_LO_SISTEM2 + $TED_ESD_SISTEM2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ORJ_GERCEKLESEN2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ORJ_GERCEKLESEN2 / ($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($TED_ORJ_GERCEKLESEN2) / ($TED_ORJ_DEGISIM_ADET2));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php if($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2>0) { echo formatla((1-($TED_ORJ_GERCEKLESEN2) / ($TED_ORJ_SISTEM2)) *100); } else { echo "0.00";}?></td>
                                </tr>
                                <tbody>
                                <?php $ted_orj_arr  = $charttedarikOdemeClass->tedarikOrijinalBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                                <?php  foreach($ted_orj_arr as $ted_orj){ ?>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ted_orj['TEDARIKCI']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ted_orj['TED_ORJ_DEGISIM_ADET']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_orj['TED_ORJ_DEGISIM_ADET'] / ($TED_ORJ_DEGISIM_ADET2) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_orj['TED_ORJ_SISTEM']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_orj['TED_ORJ_SISTEM'] / ($TED_ORJ_SISTEM2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_orj['TED_ORJ_GERCEKLESEN']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_orj['TED_ORJ_GERCEKLESEN'] / ($TED_ORJ_GERCEKLESEN2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($ted_orj['TED_ORJ_GERCEKLESEN']) / ($ted_orj['TED_ORJ_DEGISIM_ADET']));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php if(($ted_orj['TED_ORJ_DEGISIM_ADET'])>0) { echo formatla((1-($ted_orj['TED_ORJ_GERCEKLESEN']) / ($ted_orj['TED_ORJ_SISTEM'])) *100); } else { echo "0.00";}?></td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Logosuz Orijinal")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($TED_LO_DEGISIM_ADET2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_LO_DEGISIM_ADET2 / ($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2) *100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_LO_SISTEM2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_LO_SISTEM2 / ($TED_ORJ_SISTEM2 + $TED_LO_SISTEM2 + $TED_ESD_SISTEM2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_LO_GERCEKLESEN2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_LO_GERCEKLESEN2 / ($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($TED_LO_GERCEKLESEN2) / ($TED_LO_DEGISIM_ADET2));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php if($TED_LO_DEGISIM_ADET2>0) { echo formatla((1-($TED_LO_GERCEKLESEN2) / ($TED_LO_SISTEM2)) *100); } else { echo "0.00";}?></td>
                                </tr>
                                <tbody>
                                <?php $ted_lo_arr  = $charttedarikOdemeClass->tedarikLogosuzBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                                <?php foreach($ted_lo_arr as $ted_lo){ ?>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ted_lo['TEDARIKCI']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ted_lo['TED_LO_DEGISIM_ADET']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_lo['TED_LO_DEGISIM_ADET'] / ($TED_LO_DEGISIM_ADET2) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_lo['TED_LO_SISTEM']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_lo['TED_LO_SISTEM'] / ($TED_LO_SISTEM2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_lo['TED_LO_GERCEKLESEN']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_lo['TED_LO_GERCEKLESEN'] / ($TED_LO_GERCEKLESEN2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($ted_lo['TED_LO_GERCEKLESEN']) / ($ted_lo['TED_LO_DEGISIM_ADET']));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php if(($ted_lo['TED_LO_DEGISIM_ADET'])>0) { echo formatla((1-($ted_lo['TED_LO_GERCEKLESEN']) / ($ted_lo['TED_LO_SISTEM'])) *100); } else { echo "0.00";}?></td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?=dil_dashboard("Eþdeðer")?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo ($TED_ESD_DEGISIM_ADET2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ESD_DEGISIM_ADET2 / ($TED_ORJ_DEGISIM_ADET2 + $TED_LO_DEGISIM_ADET2 + $TED_ESD_DEGISIM_ADET2) *100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ESD_SISTEM2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ESD_SISTEM2 / ($TED_ORJ_SISTEM2 + $TED_LO_SISTEM2 + $TED_ESD_SISTEM2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ESD_GERCEKLESEN2);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla($TED_ESD_GERCEKLESEN2 / ($TED_ORJ_GERCEKLESEN2 + $TED_LO_GERCEKLESEN2 + $TED_ESD_GERCEKLESEN2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php echo formatla(($TED_ESD_GERCEKLESEN2) / ($TED_ESD_DEGISIM_ADET2));?></td>
                                    <td style="text-align: center; font-size: 13px; background-color: #DFE8D9;"><?php if($TED_ESD_DEGISIM_ADET2>0) { echo formatla((1-($TED_ESD_GERCEKLESEN2) / ($TED_ESD_SISTEM2)) *100); } else { echo "0.00";}?></td>
                                </tr>
                                <tbody>
                                <?php $ted_esd_arr  = $charttedarikOdemeClass->tedarikEsdegerBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$sehir_id,$eksper,$rapor_secim,$siparis_uygun,$eksperli,$filo_haric,$filo_acenteler,$arac_yasi,$police_kodu); ?>
                                <?php foreach($ted_esd_arr as $ted_esd){ ?>
                                <tr>

                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ted_esd['TEDARIKCI']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo ($ted_esd['TED_ESD_DEGISIM_ADET']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_esd['TED_ESD_DEGISIM_ADET'] / ($TED_ESD_DEGISIM_ADET2) *100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_esd['TED_ESD_SISTEM']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_esd['TED_ESD_SISTEM'] / ($TED_ESD_SISTEM2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_esd['TED_ESD_GERCEKLESEN']);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla($ted_esd['TED_ESD_GERCEKLESEN'] / ($TED_ESD_GERCEKLESEN2)*100);?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php echo formatla(($ted_esd['TED_ESD_GERCEKLESEN']) / ($ted_esd['TED_ESD_DEGISIM_ADET']));?></td>
                                    <td style="text-align: center; font-size: 13px;"><?php if($ted_esd['TED_ESD_DEGISIM_ADET']>0) { echo formatla((1-($ted_esd['TED_ESD_GERCEKLESEN']) / ($ted_esd['TED_ESD_SISTEM'])) *100); } else { echo "0.00";}?></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
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

        pie_data1 = [ <?=$pie_data1; ?> ];
        pie_data2 = [ <?=$pie_data2;?> ];
        pie_data3 = [ <?=$pie_data3;?> ];

        Morris.Donut({
          element: 'chart_pie_1',
          data: pie_data1
        }).options.colors.forEach(function(color, a){
        if (pie_data1[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data1[a].label+'</span>';
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
    </script>