<?php
require_once("chartSektorClass.php");
$chartClass         = new chartSektorClass();
$modul_kontrol      = $chartClass->modul_aktif_kontrol();
?>
<?php require_once("load_modal.php");?>
<?php if($modul_kontrol['modul_eksper']){ ?>
<?php $tedarik_top_data         = $chartClass->sektorTopBlok($donem,$brans); ?>
<?php
    $TOPLAM_DOSYA_KALEM_ADET    					= $tedarik_top_data->TOPLAM_DOSYA_ADET;
	$TOPLAM_PARCA_ADET 								= $tedarik_top_data->TOPLAM_TEDARIK_PARCA_ADET + $tedarik_top_data->TOPLAM_SERVIS_PARCA_ADET;
    $SEVK_ORT_GECEN_SURE     						= $tedarik_top_data->SEVK_ORT_GECEN_SURE;
    $TEDARIK_SISTEM_TUTAR       					= $tedarik_top_data->TED_SISTEM_TUTAR;
    $TEDARIK_ISK_TUTARI         					= $tedarik_top_data->TED_ISK_TUTAR;
    $TEDARIK_KAZANDIRILAN       					= $tedarik_top_data->TED_KAZANDIRILAN;

    $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR           = $tedarik_top_data->TED_ORJ_SISTEM_TUTAR;
    $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR            = $tedarik_top_data->TED_LO_SISTEM_TUTAR;
    $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR            = $tedarik_top_data->TED_ESD_SISTEM_TUTAR;

    $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR        = $tedarik_top_data->TED_ORJ_ISK_TUTAR;
    $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR         = $tedarik_top_data->TED_LO_ISK_TUTAR;
    $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR         = $tedarik_top_data->TED_ESD_ISK_TUTAR;

    $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR     = $tedarik_top_data->TED_ORJ_KAZANDIRILAN;
    $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR      = $tedarik_top_data->TED_LO_KAZANDIRILAN;
    $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR      = $tedarik_top_data->TED_ESD_KAZANDIRILAN;

    /*
	$TOPLAM_SISTEM_TUTARI                           = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR;
    $TOPLAM_ISKONTOLU_TUTAR                         = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR;
    $TOPLAM_KAZANDIRILAN_TUTAR                      = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR;
	*/
    $TOPLAM_TEDARIK_SISTEM_TUTARI                   = $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR;
    $TOPLAM_TEDARIK_ISKONTOLU_TUTAR                 = $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR;
    $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR              = $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR;


    $TD_SISTEM_TUTAR                    			= $tedarik_top_data->TD_ORJ_SISTEM_TUTAR + $tedarik_top_data->TD_ESD_SISTEM_TUTAR;
    $TD_ISK_TUTARI                     			 	= $tedarik_top_data->TD_ORJ_ISK_TUTAR + $tedarik_top_data->TD_ESD_ISK_TUTAR;
    $TD_KAZANDIRILAN                   				= $tedarik_top_data->TD_ORJ_KAZANDIRILAN + $tedarik_top_data->TD_ESD_KAZANDIRILAN;

    $TD_LOESD_SISTEM_TUTAR             			 	= $tedarik_top_data->TD_ESD_SISTEM_TUTAR;
    $TD_LOESD_ISKONTOLU                			 	= $tedarik_top_data->TD_ESD_ISK_TUTAR;
    $TD_LOESD_KAZANDIRILAN             			 	= $tedarik_top_data->TD_ESD_KAZANDIRILAN;

    $TD_ORJ_SISTEM_TUTAR                		 	= $tedarik_top_data->TD_ORJ_SISTEM_TUTAR;
    $TD_ORJ_ISKONTOLU                  			 	= $tedarik_top_data->TD_ORJ_ISK_TUTAR;
    $TD_ORJ_KAZANDIRILAN               			 	= $tedarik_top_data->TD_ORJ_KAZANDIRILAN;


    $SERVIS_ISKONTO_SISTEM              = $tedarik_top_data->SERVIS_SISTEM_TUTAR;
    $SERVIS_ISKONTO_SERVIS              = $tedarik_top_data->SERVIS_ISK_TUTAR;
    $SERVIS_KAZANDIRILAN                = $tedarik_top_data->SERVIS_KAZANDIRILAN;

    $SERVIS_ISKONTO_ORJ_SISTEM          = $tedarik_top_data->SERVIS_ORJ_SISTEM_TUTAR;
    $SERVIS_ISKONTO_ORJ_SERVIS          = $tedarik_top_data->SERVIS_ORJ_ISK_TUTAR;
    $SERVIS_ISKONTO_ORJ_KAZANDIRILAN    = $tedarik_top_data->SERVIS_ORJ_KAZANDIRILAN;


    $SERVIS_ISKONTO_LOESD_SISTEM        = $tedarik_top_data->SERVIS_ESD_SISTEM_TUTAR;
    $SERVIS_ISKONTO_LOESD_SERVIS        = $tedarik_top_data->SERVIS_ESD_ISK_TUTAR;
    $SERVIS_ISKONTO_LOESD_KAZANDIRILAN  = $tedarik_top_data->SERVIS_ESD_KAZANDIRILAN;


    $ORJ_TEDARIK_SISTEM_TUTAR           = $tedarik_top_data->TED_ORJ_SISTEM_TUTAR;
    $ORJ_TEDARIK_KAZANDIRILAN           = $tedarik_top_data->TED_ORJ_KAZANDIRILAN;


    $LO_TEDARIK_SISTEM_TUTAR            = $tedarik_top_data->TED_LO_SISTEM_TUTAR;
    $LO_TEDARIK_KAZANDIRILAN            = $tedarik_top_data->TED_LO_KAZANDIRILAN;

    $ESDEGER_TEDARIK_SISTEM_TUTAR       = $tedarik_top_data->TED_ESD_SISTEM_TUTAR;
    $ESDEGER_TEDARIK_KAZANDIRILAN       = $tedarik_top_data->TED_ESD_KAZANDIRILAN;


	$TOPLAM_ORJ_SISTEM					= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR + $TD_ORJ_SISTEM_TUTAR + $SERVIS_ISKONTO_ORJ_SISTEM;
	$TOPLAM_LOESD_SISTEM				= $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR + $SERVIS_ISKONTO_LOESD_SISTEM + $TD_LOESD_SISTEM_TUTAR;
	$TOPLAM_ORJ_KAZANDIRILAN			= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR + $TD_ORJ_KAZANDIRILAN + $SERVIS_ISKONTO_ORJ_KAZANDIRILAN;
	$TOPLAM_LOESD_KAZANDIRILAN			= $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR + $TD_LOESD_KAZANDIRILAN + $SERVIS_ISKONTO_LOESD_KAZANDIRILAN;


    $TOPLAM_KAZANDIRILAN                = $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR+ $SERVIS_KAZANDIRILAN + $TD_KAZANDIRILAN;
    $TOPLAM_SISTEM_TUTAR                = $TOPLAM_TEDARIK_SISTEM_TUTARI + $SERVIS_ISKONTO_SISTEM + $TD_SISTEM_TUTAR;
    $TOPLAM_ISKONTOLU_TUTAR             = $TOPLAM_TEDARIK_ISKONTOLU_TUTAR + $SERVIS_ISKONTO_SERVIS + $TD_ISK_TUTARI;
	
	
	$TOPLAM_TEDARIK_SISTEM 	= $ORJ_TEDARIK_SISTEM_TUTAR+$LO_TEDARIK_SISTEM_TUTAR+$ESDEGER_TEDARIK_SISTEM_TUTAR;
	$TOPLAM_SERVIS_SISTEM  	= $SERVIS_ISKONTO_ORJ_SISTEM+$SERVIS_ISKONTO_LOESD_SISTEM;
	$TOPLAM_TD_SISTEM	   	= $TD_ORJ_SISTEM_TUTAR+$TD_LOESD_SISTEM_TUTAR;
	/*<td style="text-align: center; font-size: 20px;"><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="top" id="top1"> <?php echo $TOPLAM_DOSYA_KALEM_ADET;?></a></td> */
    ?>
    <div class="card" style="width: 98%;margin: 0px auto;">
                <div class="row" style="width: 99.7%;">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
                        <table class="table" id="dev-table">
                            <thead>
                                <tr>
									<?php if($hides==1){ ?>
									<th style="text-align: center;"><?=dil_dashboard("Toplam Dosya Adet")?></th>
									<th style="text-align: center;"><?=dil_dashboard("Toplam Sistem Tutarý")?></th>
									<th style="text-align: center;"><?=dil_dashboard("Toplam Ýskontolu Tutarý")?></th>
                                    <th style="text-align: center;"><?=dil_dashboard("Toplam Kazandýrýlan")?></th>
									<?php } ?>
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
								<?php if($hides==1){ ?>
                                <td style="text-align: center; font-size: 20px;"><?php echo $TOPLAM_DOSYA_KALEM_ADET;?></td>
								<td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_SISTEM_TUTAR);?></td>
								<td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_ISKONTOLU_TUTAR);?></td>
								<td style="text-align: center; font-size: 20px;"><?php echo formatla($TOPLAM_KAZANDIRILAN);?></td>
								<?php } ?>
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
                    //DONUT 1
                    $pie_data  .= "{ label: '".dil_dashboard('Tedarik Adet %')."', value: ". (formatla(($tedarik_top_data->TOPLAM_TEDARIK_PARCA_ADET / $TOPLAM_PARCA_ADET *100) )) ." }, ";
                    $pie_data  .= "{ label: '".dil_dashboard('Servis Ýskonto Adet %')."', value: ". (formatla(( ($tedarik_top_data->TOPLAM_SERVIS_ORJ_PARCA_ADET+ $tedarik_top_data->TOPLAM_SERVIS_ESD_PARCA_ADET) / $TOPLAM_PARCA_ADET *100) )) ." }, ";
                    $pie_data  .= "{ label: '".dil_dashboard('Tedarik Dýþý Adet %')."', value: ". (formatla(( ($tedarik_top_data->TOPLAM_TD_ORJ_PARCA_ADET + $tedarik_top_data->TOPLAM_TD_ESD_PARCA_ADET) / $TOPLAM_PARCA_ADET *100) )) ." }, ";
                ?>

                <?php
                    //DONUT 2
                    $pie_data2  .= "{ label: '".dil_dashboard('Orijinal Adet %')."', value: ". (formatla( ($tedarik_top_data->TOPLAM_TEDARIK_ORJ_PARCA_ADET) / $tedarik_top_data->TOPLAM_TEDARIK_PARCA_ADET *100)) ." }, ";
                    $pie_data2  .= "{ label: '".dil_dashboard('Logosuz Adet %')."', value: ". (formatla( ($tedarik_top_data->TOPLAM_TEDARIK_LO_PARCA_ADET) / $tedarik_top_data->TOPLAM_TEDARIK_PARCA_ADET *100)) ." }, ";
                    $pie_data2  .= "{ label: '".dil_dashboard('Eþdeðer Adet %')."', value: ". (formatla( ($tedarik_top_data->TOPLAM_TEDARIK_ESD_PARCA_ADET) / $tedarik_top_data->TOPLAM_TEDARIK_PARCA_ADET *100)) ." }, ";
                ?>

                <?php
                    //DONUT 3
                    $pie_data3  .= "{ label: '".dil_dashboard('Orijinal Adet %')."', value: ". (formatla($tedarik_top_data->TOPLAM_SERVIS_ORJ_PARCA_ADET / ($tedarik_top_data->TOPLAM_SERVIS_ORJ_PARCA_ADET + $tedarik_top_data->TOPLAM_SERVIS_ESD_PARCA_ADET) *100)) ." }, ";
                    $pie_data3  .= "{ label: '".dil_dashboard('Lo-Eþdeðer Adet %')."', value: ". (formatla($tedarik_top_data->TOPLAM_SERVIS_ESD_PARCA_ADET / ($tedarik_top_data->TOPLAM_SERVIS_ORJ_PARCA_ADET + $tedarik_top_data->TOPLAM_SERVIS_ESD_PARCA_ADET) *100)) ." }, ";
                ?>

                <?php
                    //DONUT 4
                    $pie_data4  .= "{ label: '".dil_dashboard('Tedarik Dýþý Orj. Adet %')."', value: ". (formatla( ($tedarik_top_data->TOPLAM_TD_ORJ_PARCA_ADET) / ($tedarik_top_data->TOPLAM_TD_ORJ_PARCA_ADET + $tedarik_top_data->TOPLAM_TD_ESD_PARCA_ADET) *100)) ." }, ";
                    $pie_data4  .= "{ label: '".dil_dashboard('Tedarik Dýþý Lo-Eþd. Adet %')."', value: ". (formatla($tedarik_top_data->TOPLAM_TD_ESD_PARCA_ADET / ($tedarik_top_data->TOPLAM_TD_ORJ_PARCA_ADET + $tedarik_top_data->TOPLAM_TD_ESD_PARCA_ADET) *100)) ." }, ";
                ?>
                    <div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 425px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Adet Bazýnda Daðýlým")?></p>
                        </div>
                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Temin Daðýlýmý")?></center></b>
                                <div id='chart_pie_1' class='chart_morris'></div>
                                <div id='chart_pie_1_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Parça Tipi Daðýlýmý")?></center></b>
                                <div id='chart_pie_2' class='chart_morris'></div>
                                <div id='chart_pie_2_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis Parça Tipi Daðýlýmý")?></center></b>
                                <div id='chart_pie_3' class='chart_morris'></div>
                                <div id='chart_pie_3_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
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
                    $pie_data6  .= "{ label: '".dil_dashboard('Orijinal Ýskonto %')."', value: ". (formatla( ($TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR) *100 )) ." }, ";
                    $pie_data6  .= "{ label: '".dil_dashboard('Lo  Ýskonto %')."', value: ". (formatla( ($TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR) * 100)) ." }, ";
                    $pie_data6  .= "{ label: '".dil_dashboard('Eþdeðer Ýskonto %')."', value: ". (formatla(($TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR / $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR) * 100)) ." }, ";
                    ?>
                <?php
                    //DONUT 7
                    $pie_data7  .= "{ label: '".dil_dashboard('Orijinal Ýskonto %')."', value: ". (formatla( ($SERVIS_ISKONTO_ORJ_KAZANDIRILAN / $SERVIS_KAZANDIRILAN) *100 )) ." }, ";
                    $pie_data7  .= "{ label: '".dil_dashboard('Lo-Eþdeðer  Ýskonto %')."', value: ". (formatla( ($SERVIS_ISKONTO_LOESD_KAZANDIRILAN / $SERVIS_KAZANDIRILAN) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 8
                    $pie_data8  .= "{ label: '".dil_dashboard('Orijinal Ýskonto %')."', value: ". (formatla( ($TD_ORJ_KAZANDIRILAN / $TD_KAZANDIRILAN) *100 )) ." }, ";
                    $pie_data8  .= "{ label: '".dil_dashboard('Lo-Eþdeðer  Ýskonto %')."', value: ". (formatla( ($TD_LOESD_KAZANDIRILAN / $TD_KAZANDIRILAN) * 100)) ." }, ";
                ?>
                    <div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 439px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Kazandýrýlan Ýskonto Tutar Daðýlýmý")?></p>
                        </div>
                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Genel Ýskonto Daðýlýmý")?></center></b>
                                <div id='chart_pie_5' class='chart_morris'></div>
                                <div id='chart_pie_5_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik")?></center></b>
                                <div id='chart_pie_6' class='chart_morris'></div>
                                <div id='chart_pie_6_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis Ýskonto")?></center></b>
                                <div id='chart_pie_7' class='chart_morris'></div>
                                <div id='chart_pie_7_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
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
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Kazandýrýlan Ýskonto Oraný (%)")?></p>
                        </div>
                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Genel")?></center></b>
                                <div id='chart_pie_9' class='chart_morris'></div>
                                <div id='chart_pie_9_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik")?></center></b>
                                <div id='chart_pie_10' class='chart_morris'></div>
                                <div id='chart_pie_10_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis")?></center></b>
                                <div id='chart_pie_11' class='chart_morris'></div>
                                <div id='chart_pie_11_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Dýþý")?></center></b>
                                <div id='chart_pie_12' class='chart_morris'></div>
                                <div id='chart_pie_12_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>


                    </div>
                    </div>
					
					
					<? // sistem oran ?>
					<?php
                    //DONUT 13
                    $pie_data13  .= "{ label: '".dil_dashboard('Tedarik Sistem %')."', value: ". (formatla( ($TOPLAM_TEDARIK_SISTEM_TUTARI / $TOPLAM_SISTEM_TUTAR) *100 )) ." }, ";
                    $pie_data13 .= "{ label: '".dil_dashboard('Servis  Sistem %')."', value: ". (formatla( ($SERVIS_ISKONTO_SISTEM / $TOPLAM_SISTEM_TUTAR) * 100)) ." }, ";
                    $pie_data13 .= "{ label: '".dil_dashboard('Tedarik Dýþý sistem %')."', value: ". (formatla(($TD_SISTEM_TUTAR / $TOPLAM_SISTEM_TUTAR) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 14
                    $pie_data14  .= "{ label: '".dil_dashboard('Orijinal Sistem%')."', value: ". (formatla( ($ORJ_TEDARIK_SISTEM_TUTAR / $TOPLAM_TEDARIK_SISTEM) *100 )) ." }, ";
                    $pie_data14  .= "{ label: '".dil_dashboard('Lo  Sistem %')."', value: ". (formatla( ($LO_TEDARIK_SISTEM_TUTAR / $TOPLAM_TEDARIK_SISTEM) * 100)) ." }, ";
                    $pie_data14  .= "{ label: '".dil_dashboard('Eþdeðer Sistem %')."', value: ". (formatla(($ESDEGER_TEDARIK_SISTEM_TUTAR / $TOPLAM_TEDARIK_SISTEM) * 100)) ." }, ";
                    ?>
                <?php
                    //DONUT 15
                    $pie_data15 .= "{ label: '".dil_dashboard('Orijinal Sistem%')."', value: ". (formatla( ($SERVIS_ISKONTO_ORJ_SISTEM / $TOPLAM_SERVIS_SISTEM) *100 )) ." }, ";
                    $pie_data15  .= "{ label: '".dil_dashboard('Lo-Eþdeðer Sistem %')."', value: ". (formatla( ($SERVIS_ISKONTO_LOESD_SISTEM / $TOPLAM_SERVIS_SISTEM) * 100)) ." }, ";
                ?>
                <?php
                    //DONUT 16
                    $pie_data16  .= "{ label: '".dil_dashboard('Orijinal sistem%')."', value: ". (formatla( ($TD_ORJ_SISTEM_TUTAR / $TOPLAM_TD_SISTEM) *100 )) ." }, ";
                    $pie_data16  .= "{ label: '".dil_dashboard('Lo-Eþdeðer Sistem %')."', value: ". (formatla( ($TD_LOESD_SISTEM_TUTAR / $TOPLAM_TD_SISTEM) * 100)) ." }, ";
                ?>
                    <div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 439px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Sistem Tutarý Daðýlýmý (%)")?></p>
                        </div>
                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Genel")?></center></b>
                                <div id='chart_pie_13' class='chart_morris'></div>
                                <div id='chart_pie_13_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik")?></center></b>
                                <div id='chart_pie_14' class='chart_morris'></div>
                                <div id='chart_pie_14_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Servis")?></center></b>
                                <div id='chart_pie_15' class='chart_morris'></div>
                                <div id='chart_pie_15_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-lg-3-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tedarik Dýþý")?></center></b>
                                <div id='chart_pie_16' class='chart_morris'></div>
                                <div id='chart_pie_16_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>


                    </div>
                    </div>
					<? //sistem end ?>
					
                </div>

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
		pie_data13 = [ <?=$pie_data13;?> ];
        pie_data14 = [ <?=$pie_data14;?> ];
        pie_data15 = [ <?=$pie_data15;?> ];
		pie_data16 = [ <?=$pie_data16;?> ];

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
		
		Morris.Donut({
          element: 'chart_pie_13',
          data: pie_data13
        }).options.colors.forEach(function(color, a){
        if (pie_data13[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data13[a].label+'</span>';
            document.getElementById("chart_pie_13_legend").appendChild(node);
          }
        });
		
		Morris.Donut({
          element: 'chart_pie_14',
          data: pie_data14
        }).options.colors.forEach(function(color, a){
        if (pie_data14[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data14[a].label+'</span>';
            document.getElementById("chart_pie_14_legend").appendChild(node);
          }
        });
		
		Morris.Donut({
          element: 'chart_pie_15',
          data: pie_data15
        }).options.colors.forEach(function(color, a){
        if (pie_data15[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data15[a].label+'</span>';
            document.getElementById("chart_pie_15_legend").appendChild(node);
          }
        });
		
		Morris.Donut({
          element: 'chart_pie_16',
          data: pie_data16
        }).options.colors.forEach(function(color, a){
        if (pie_data16[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data16[a].label+'</span>';
            document.getElementById("chart_pie_16_legend").appendChild(node);
          }
        });

    </script>