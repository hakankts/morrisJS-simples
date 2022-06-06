<?php
require_once("chartLoEsdegerClass.php");
$chartClass         = new chartClassLoEsdeger();
$modul_kontrol      = $chartClass->modul_aktif_kontrol();
?>
<?php require_once("load_modal.php");?>

<?php $tedarik_top_data_arr         = $chartClass->toplamTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id); ?>
<?php foreach($tedarik_top_data_arr as $tedarik_top_data){ ?>
<?php
	$TEDARIK_GENEL_TOPLAM_TUTAR1	+= $tedarik_top_data['TEDARIK_TOPLAM_TUTARI'];
	$TEDARIK_LO_TOPLAM_TUTAR1    	+= $tedarik_top_data['TEDARIK_LO_TUTAR'];
	$TEDARIK_ESD_TOPLAM_TUTAR1   	+= $tedarik_top_data['TEDARIK_ESD_TUTAR'];
	$TEDARIK_GENEL_TOPLAM_ADET1		+= $tedarik_top_data['TEDARIK_TOPLAM_ADET'];
	$TEDARIK_LO_TOPLAM_ADET1	   	+= $tedarik_top_data['TEDARIK_LO_ADET'];
	$TEDARIK_ESD_TOPLAM_ADET1		+= $tedarik_top_data['TEDARIK_ESD_ADET'];
?>
<?php } ?>
    <div class="card" style="width: 98%;margin: 0px auto;">
                <div class="row" style="width: 99.7%;">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
                        <table class="table" id="dev-table">
                            <thead>
								<tr style="border: 1px solid;">
									<th colspan="1" style="border: 1px solid;text-align: center;font-size: 10px;"></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("TOPLAM")?></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ADET")?></th>
									<th colspan="3" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ORTALAMA PARÇA")?></th>
								</tr>
                                <tr>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?=dil_dashboard("Menþei")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Oran%")?></th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oran")?> %</th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Tutar")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Oran")?> %</th>

                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Adet Oraný")?>%</th>

									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Toplam")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Logosuz Orijinal")?></th>
									<th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Ortalama Eþdeðer")?></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php foreach($tedarik_top_data_arr as $tedarik_top_data){ ?>
							<?php
									$MENSEI    					 = $tedarik_top_data['MENSEI'];

									$TEDARIK_TOPLAM_TUTARI1     = $tedarik_top_data['TEDARIK_TOPLAM_TUTARI'];
									$TEDARIK_LO_TUTAR1    	 	= $tedarik_top_data['TEDARIK_LO_TUTAR'];
									$TEDARIK_ESD_TUTAR1    	 	= $tedarik_top_data['TEDARIK_ESD_TUTAR'];

									$TEDARIK_TOPLAM_ORAN1	 	=	($TEDARIK_TOPLAM_TUTARI1 / $TEDARIK_GENEL_TOPLAM_TUTAR1)*100;
									$TEDARIK_LO_ORAN1	 	 	=	($TEDARIK_LO_TUTAR1 / $TEDARIK_TOPLAM_TUTARI1)*100;
									$TEDARIK_ESD_ORAN1	 	 	=	($TEDARIK_ESD_TUTAR1 / $TEDARIK_TOPLAM_TUTARI1)*100;

									$TEDARIK_TOPLAM_ADET1   	 = $tedarik_top_data['TEDARIK_TOPLAM_ADET'];
									$TEDARIK_LO_ADET1	   		 = $tedarik_top_data['TEDARIK_LO_ADET'];
									$TEDARIK_ESD_ADET1	  	 	 = $tedarik_top_data['TEDARIK_ESD_ADET'];

									$TEDARIK_TOPLAM_ADET_ORAN1	 = ($TEDARIK_TOPLAM_ADET1 / $TEDARIK_GENEL_TOPLAM_ADET1)*100;
									$TEDARIK_LO_ADET_ORAN1	 	 = ($TEDARIK_LO_ADET1 / $TEDARIK_TOPLAM_ADET1)*100;
									$TEDARIK_ESD_ADET_ORAN1	 	 = ($TEDARIK_ESD_ADET1 / $TEDARIK_TOPLAM_ADET1)*100;

									$ORTALAMA_TOPLAM1	    	 = $tedarik_top_data['ORTALAMA_TOPLAM'];
									$ORTALAMA_LO1		    	 = $tedarik_top_data['ORTALAMA_LO'];
									$ORTALAMA_ESD1		    	 = $tedarik_top_data['ORTALAMA_ESD'];
							?>
                            <tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?php echo $MENSEI;?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_TUTARI1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ORAN1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_TUTAR1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ORAN1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_ESD_TUTAR1);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ORAN1);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_TOPLAM_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ADET_ORAN1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_LO_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ADET_ORAN1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_ESD_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ADET_ORAN1);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_TOPLAM1);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_LO1);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($ORTALAMA_ESD1);?></td>
                            </tr>
							<?php } ?>
							<tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;border-bottom:1px solid;font-weight:600;"><?=dil_dashboard("Toplam")?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR1/$TEDARIK_GENEL_TOPLAM_TUTAR1*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR1/$TEDARIK_GENEL_TOPLAM_TUTAR1*100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_GENEL_TOPLAM_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_LO_TOPLAM_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_ADET1/$TEDARIK_GENEL_TOPLAM_ADET1*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_ESD_TOPLAM_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_ADET1/$TEDARIK_GENEL_TOPLAM_ADET1 *100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR1 / $TEDARIK_GENEL_TOPLAM_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR1 / $TEDARIK_LO_TOPLAM_ADET1);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR1 / $TEDARIK_ESD_TOPLAM_ADET1);?></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

				<?php
                        $top20_tedarikci_arr      = $chartClass->top20TedarikciBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id);
                        foreach($top20_tedarikci_arr as $top20_tedarikci){
                            $chart_data_top20tedarikci .= "{ tedarikci:'".$top20_tedarikci["TEDARIKCI"]."', tutar:'".($top20_tedarikci["TUTAR_ISKONTOLU"])."' }, ";
                        }
                ?>
                <div class="row" style="width: 99.7%;">
                <div class="col-lg-12">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                        <div class="row" style="width: 99.7%;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Top 10 Tedarikçi")?> (%) </p>
                            </div>
                            <div id='chart_hist_top20tedarikci_adet' class='chart_morris'></div>
                        </div>

                    </div>
                </div>
				<button type="button" class="chart2_tedarikciler" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="chart2_tedarikciler"> <?=dil_dashboard("Tümü")?> </button>
                </div>

				<?php $tedarik_top_marka_data_arr         = $chartClass->toplamMarkaTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id); ?>
				<?php foreach($tedarik_top_marka_data_arr as $tedarik_top_marka_data){ ?>
				<?php
					$TEDARIK_GENEL_TOPLAM_TUTAR2	+= $tedarik_top_marka_data['TEDARIK_TOPLAM_TUTARI'];
					$TEDARIK_LO_TOPLAM_TUTAR2    	+= $tedarik_top_marka_data['TEDARIK_LO_TUTAR'];
					$TEDARIK_ESD_TOPLAM_TUTAR2   	+= $tedarik_top_marka_data['TEDARIK_ESD_TUTAR'];
					$TEDARIK_GENEL_TOPLAM_ADET2		+= $tedarik_top_marka_data['TEDARIK_TOPLAM_ADET'];
					$TEDARIK_LO_TOPLAM_ADET2	   	+= $tedarik_top_marka_data['TEDARIK_LO_ADET'];
					$TEDARIK_ESD_TOPLAM_ADET2		+= $tedarik_top_marka_data['TEDARIK_ESD_ADET'];
				?>
				<?php } ?>
				<div class="row" style="width: 99.7%; margin-top:10px">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
                        <table class="table" id="dev-table">
                            <thead>
								<tr style="border: 1px solid;">
									<th colspan="1" style="border: 1px solid;text-align: center;font-size: 10px;"></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("TOPLAM")?></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ADET")?></th>
									<th colspan="3" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ORTALAMA PARÇA")?></th>
								</tr>
                                <tr>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?=dil_dashboard("Marka")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Oran%")?></th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oran")?> %</th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Tutar")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Oran")?> %</th>

                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Adet Oraný")?>%</th>

									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Toplam")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Logosuz Orijinal")?></th>
									<th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Ortalama Eþdeðer")?></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php foreach($tedarik_top_marka_data_arr as $tedarik_top_marka_data){ ?>
							<?php
									$MARKA    					 = $tedarik_top_marka_data['MARKA_ADI'];

									$TEDARIK_TOPLAM_TUTARI2     = $tedarik_top_marka_data['TEDARIK_TOPLAM_TUTARI'];
									$TEDARIK_LO_TUTAR2    	 	= $tedarik_top_marka_data['TEDARIK_LO_TUTAR'];
									$TEDARIK_ESD_TUTAR2    	 	= $tedarik_top_marka_data['TEDARIK_ESD_TUTAR'];

									$TEDARIK_TOPLAM_ORAN2	 	=	($TEDARIK_TOPLAM_TUTARI2 / $TEDARIK_GENEL_TOPLAM_TUTAR2)*100;
									$TEDARIK_LO_ORAN2	 	 	=	($TEDARIK_LO_TUTAR2 / $TEDARIK_TOPLAM_TUTARI2)*100;
									$TEDARIK_ESD_ORAN2	 	 	=	($TEDARIK_ESD_TUTAR2 / $TEDARIK_TOPLAM_TUTARI2)*100;

									$TEDARIK_TOPLAM_ADET2   	 = $tedarik_top_marka_data['TEDARIK_TOPLAM_ADET'];
									$TEDARIK_LO_ADET2	   		 = $tedarik_top_marka_data['TEDARIK_LO_ADET'];
									$TEDARIK_ESD_ADET2	  	 	 = $tedarik_top_marka_data['TEDARIK_ESD_ADET'];

									$TEDARIK_TOPLAM_ADET_ORAN2	 = ($TEDARIK_TOPLAM_ADET2 / $TEDARIK_GENEL_TOPLAM_ADET2)*100;
									$TEDARIK_LO_ADET_ORAN2	 	 = ($TEDARIK_LO_ADET2 / $TEDARIK_TOPLAM_ADET2)*100;
									$TEDARIK_ESD_ADET_ORAN2	 	 = ($TEDARIK_ESD_ADET2 / $TEDARIK_TOPLAM_ADET2)*100;

									$ORTALAMA_TOPLAM2	    	 = $tedarik_top_marka_data['ORTALAMA_TOPLAM'];
									$ORTALAMA_LO2		    	 = $tedarik_top_marka_data['ORTALAMA_LO'];
									$ORTALAMA_ESD2		    	 = $tedarik_top_marka_data['ORTALAMA_ESD'];
							?>
                            <tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?php echo $MARKA;?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_TUTARI2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ORAN2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_TUTAR2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ORAN2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_ESD_TUTAR2);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ORAN2);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_TOPLAM_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ADET_ORAN2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_LO_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ADET_ORAN2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_ESD_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ADET_ORAN2);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_TOPLAM2);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_LO2);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($ORTALAMA_ESD2);?></td>
                            </tr>
							<?php } ?>
							<tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;border-bottom:1px solid;font-weight:600;"><?=dil_dashboard("Toplam")?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR2/$TEDARIK_GENEL_TOPLAM_TUTAR2*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR2/$TEDARIK_GENEL_TOPLAM_TUTAR2*100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_GENEL_TOPLAM_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_LO_TOPLAM_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_ADET2/$TEDARIK_GENEL_TOPLAM_ADET2*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_ESD_TOPLAM_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_ADET2/$TEDARIK_GENEL_TOPLAM_ADET2 *100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR2 / $TEDARIK_GENEL_TOPLAM_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR2 / $TEDARIK_LO_TOPLAM_ADET2);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR2 / $TEDARIK_ESD_TOPLAM_ADET2);?></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>


				<?php $tedarik_top_ysmarka_data_arr         = $chartClass->toplamYsMarkaTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id); ?>
				<?php foreach($tedarik_top_ysmarka_data_arr as $tedarik_top_ysmarka_data){ ?>
				<?php
					$TEDARIK_GENEL_TOPLAM_TUTAR3	+= $tedarik_top_ysmarka_data['TEDARIK_TOPLAM_TUTARI'];
					$TEDARIK_LO_TOPLAM_TUTAR3   	+= $tedarik_top_ysmarka_data['TEDARIK_LO_TUTAR'];
					$TEDARIK_ESD_TOPLAM_TUTAR3   	+= $tedarik_top_ysmarka_data['TEDARIK_ESD_TUTAR'];
					$TEDARIK_GENEL_TOPLAM_ADET3		+= $tedarik_top_ysmarka_data['TEDARIK_TOPLAM_ADET'];
					$TEDARIK_LO_TOPLAM_ADET3	   	+= $tedarik_top_ysmarka_data['TEDARIK_LO_ADET'];
					$TEDARIK_ESD_TOPLAM_ADET3		+= $tedarik_top_ysmarka_data['TEDARIK_ESD_ADET'];
				?>
				<?php } ?>
				<div class="row" style="width: 99.7%; margin-top:10px">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
                        <table class="table" id="dev-table">
                            <thead>
								<tr style="border: 1px solid;">
									<th colspan="1" style="border: 1px solid;text-align: center;font-size: 10px;"></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("TOPLAM")?></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ADET")?></th>
									<th colspan="3" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ORTALAMA PARÇA")?></th>
								</tr>
                                <tr>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?=dil_dashboard("Eþdeðer Marka")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Oran%")?></th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oran")?> %</th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Tutar")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Oran")?> %</th>

                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Adet Oraný")?>%</th>

									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Toplam")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Logosuz Orijinal")?></th>
									<th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Ortalama Eþdeðer")?></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php foreach($tedarik_top_ysmarka_data_arr as $tedarik_top_ysmarka_data){ ?>
							<?php
									$YS_MARKA    				= $tedarik_top_ysmarka_data['YS_MARKA'];

									$TEDARIK_TOPLAM_TUTARI3     = $tedarik_top_ysmarka_data['TEDARIK_TOPLAM_TUTARI'];
									$TEDARIK_LO_TUTAR3    	 	= $tedarik_top_ysmarka_data['TEDARIK_LO_TUTAR'];
									$TEDARIK_ESD_TUTAR3    	 	= $tedarik_top_ysmarka_data['TEDARIK_ESD_TUTAR'];

									$TEDARIK_TOPLAM_ORAN3	 	=	($TEDARIK_TOPLAM_TUTARI3 / $TEDARIK_GENEL_TOPLAM_TUTAR3)*100;
									$TEDARIK_LO_ORAN3	 	 	=	($TEDARIK_LO_TUTAR3 / $TEDARIK_TOPLAM_TUTARI3)*100;
									$TEDARIK_ESD_ORAN3	 	 	=	($TEDARIK_ESD_TUTAR3 / $TEDARIK_TOPLAM_TUTARI3)*100;

									$TEDARIK_TOPLAM_ADET3   	 = $tedarik_top_ysmarka_data['TEDARIK_TOPLAM_ADET'];
									$TEDARIK_LO_ADET3	   		 = $tedarik_top_ysmarka_data['TEDARIK_LO_ADET'];
									$TEDARIK_ESD_ADET3	  	 	 = $tedarik_top_ysmarka_data['TEDARIK_ESD_ADET'];

									$TEDARIK_TOPLAM_ADET_ORAN3	 = ($TEDARIK_TOPLAM_ADET3 / $TEDARIK_GENEL_TOPLAM_ADET3)*100;
									$TEDARIK_LO_ADET_ORAN3	 	 = ($TEDARIK_LO_ADET3 / $TEDARIK_TOPLAM_ADET3)*100;
									$TEDARIK_ESD_ADET_ORAN3	 	 = ($TEDARIK_ESD_ADET3 / $TEDARIK_TOPLAM_ADET3)*100;

									$ORTALAMA_TOPLAM3	    	 = $tedarik_top_ysmarka_data['ORTALAMA_TOPLAM'];
									$ORTALAMA_LO3		    	 = $tedarik_top_ysmarka_data['ORTALAMA_LO'];
									$ORTALAMA_ESD3		    	 = $tedarik_top_ysmarka_data['ORTALAMA_ESD'];
							?>
                            <tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?php echo $YS_MARKA;?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_TUTARI3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ORAN3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_TUTAR3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ORAN3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_ESD_TUTAR3);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ORAN3);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_TOPLAM_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ADET_ORAN3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_LO_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ADET_ORAN3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_ESD_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ADET_ORAN3);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_TOPLAM3);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_LO3);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($ORTALAMA_ESD3);?></td>
                            </tr>
							<?php } ?>
							<tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;border-bottom:1px solid;font-weight:600;"><?=dil_dashboard("Toplam")?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR3/$TEDARIK_GENEL_TOPLAM_TUTAR3*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR3/$TEDARIK_GENEL_TOPLAM_TUTAR3*100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_GENEL_TOPLAM_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_LO_TOPLAM_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_ADET3/$TEDARIK_GENEL_TOPLAM_ADET3*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_ESD_TOPLAM_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_ADET3/$TEDARIK_GENEL_TOPLAM_ADET3 *100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR3 / $TEDARIK_GENEL_TOPLAM_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR3 / $TEDARIK_LO_TOPLAM_ADET3);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR3 / $TEDARIK_ESD_TOPLAM_ADET3);?></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>


				<?php $tedarik_top_ysmarka_oran_data_arr_get         = $chartClass->toplamYsMarkaOranBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id); ?>
				<?php $say = ceil(count($tedarik_top_ysmarka_oran_data_arr_get) /3); ?>
				<?php $tedarik_top_ysmarka_oran_data_arr = array_chunk($tedarik_top_ysmarka_oran_data_arr_get, $say); ?>
				<?php foreach($tedarik_top_ysmarka_oran_data_arr_get as $tedarik_top_ysmarka_oran_data){ ?>
				<?php
					$TOPLAM_GERCEK1					+= $tedarik_top_ysmarka_oran_data['TOPLAM_GERCEK'];
					$TOPLAM_SISTEM1					+= $tedarik_top_ysmarka_oran_data['TOPLAM_SISTEM'];

					$TOPLAM_LO_GERCEK1				+= $tedarik_top_ysmarka_oran_data['TOPLAM_LO_GERCEK'];
					$TOPLAM_LO_SISTEM1				+= $tedarik_top_ysmarka_oran_data['TOPLAM_LO_SISTEM'];

					$TOPLAM_ESD_GERCEK1				+= $tedarik_top_ysmarka_oran_data['TOPLAM_ESD_GERCEK'];
					$TOPLAM_ESD_SISTEM1				+= $tedarik_top_ysmarka_oran_data['TOPLAM_ESD_SISTEM'];
				?>
				<?php } ?>
				<div class="row" style="width: 99.7%; margin-top:10px">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
							<div class="col-lg-4">
							<table class="table" id="dev-table" style="margin:0px;">
								<thead>
									<tr>
										<th style="text-align: center;font-size: 10px;border-left: 1px solid;border-top: 1px solid;"><?=dil_dashboard("Eþdeðer Marka")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Toplam Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Logosuz Orijinal Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-right: 1px solid;border-top: 1px solid;"><?=dil_dashboard("Eþdeðer Ýskonto Oraný")?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($tedarik_top_ysmarka_oran_data_arr[0] as $key => $tedarik_top_ysmarka_oran_data){ ?>
								<?php

										$YS_MARKA1    					= $tedarik_top_ysmarka_oran_data['YS_MARKA'];
										$TOPLAM_ISKONTO1    			= $tedarik_top_ysmarka_oran_data['TOPLAM_ISKONTO'];
										$TOPLAM_LO_ISKONTO1    			= $tedarik_top_ysmarka_oran_data['TOPLAM_LO_ISKONTO'];
										$TOPLAM_ESD_ISKONTO1    	 	= $tedarik_top_ysmarka_oran_data['TOPLAM_ESD_ISKONTO'];

								?>
								<tr>
									<td style="text-align: center; font-size: 10px;border-left: 1px solid;"><?php echo $YS_MARKA1;?></td>
									<td style="text-align: center; font-size: 10px;"><?php echo formatla($TOPLAM_ISKONTO1);?></td>
									<td style="text-align: center; font-size: 10px;"><?php echo formatla($TOPLAM_LO_ISKONTO1);?></td>
									<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TOPLAM_ESD_ISKONTO1);?></td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
							</div>

							<div class="col-lg-4">
							<table class="table" id="dev-table" style="margin:0px;">
								<thead>
									<tr>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Eþdeðer Marka")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Toplam Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Logosuz Orijinal Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-right: 1px solid;border-top: 1px solid;"><?=dil_dashboard("Eþdeðer Ýskonto Oraný")?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($tedarik_top_ysmarka_oran_data_arr[1] as $key => $tedarik_top_ysmarka_oran_data){ ?>
								<?php

										$YS_MARKA2    					= $tedarik_top_ysmarka_oran_data['YS_MARKA'];
										$TOPLAM_ISKONTO2    			= $tedarik_top_ysmarka_oran_data['TOPLAM_ISKONTO'];
										$TOPLAM_LO_ISKONTO2    			= $tedarik_top_ysmarka_oran_data['TOPLAM_LO_ISKONTO'];
										$TOPLAM_ESD_ISKONTO2    	 	= $tedarik_top_ysmarka_oran_data['TOPLAM_ESD_ISKONTO'];

								?>
								<tr>
									<td style="text-align: center; font-size: 10px;"><?php echo $YS_MARKA2;?></td>
									<td style="text-align: center; font-size: 10px;"><?php echo formatla($TOPLAM_ISKONTO2);?></td>
									<td style="text-align: center; font-size: 10px;"><?php echo formatla($TOPLAM_LO_ISKONTO2);?></td>
									<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TOPLAM_ESD_ISKONTO2);?></td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
							</div>

							<div class="col-lg-4">
							<table class="table" id="dev-table" style="margin:0px;">
								<thead>
									<tr>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;border-top: 1px solid;"><?=dil_dashboard("Eþdeðer Marka")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Toplam Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Logosuz Orijinal Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-right: 1px solid;border-top: 1px solid;"><?=dil_dashboard("Eþdeðer Ýskonto Oraný")?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									foreach($tedarik_top_ysmarka_oran_data_arr[2] as $key => $tedarik_top_ysmarka_oran_data){ ?>
								<?php

										$YS_MARKA3    					= $tedarik_top_ysmarka_oran_data['YS_MARKA'];
										$TOPLAM_ISKONTO3    			= $tedarik_top_ysmarka_oran_data['TOPLAM_ISKONTO'];
										$TOPLAM_LO_ISKONTO3   			= $tedarik_top_ysmarka_oran_data['TOPLAM_LO_ISKONTO'];
										$TOPLAM_ESD_ISKONTO3   		 	= $tedarik_top_ysmarka_oran_data['TOPLAM_ESD_ISKONTO'];

								?>
								<tr>
									<td style="text-align: center; font-size: 10px;"><?php echo $YS_MARKA3;?></td>
									<td style="text-align: center; font-size: 10px;"><?php echo formatla($TOPLAM_ISKONTO3);?></td>
									<td style="text-align: center; font-size: 10px;"><?php echo formatla($TOPLAM_LO_ISKONTO3);?></td>
									<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TOPLAM_ESD_ISKONTO3);?></td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
							</div>

							<table class="table" id="dev-table">
								<thead>
									<tr>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;border-left: 1px solid;"><?=dil_dashboard("")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Toplam Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-top: 1px solid;"><?=dil_dashboard("Toplam Logosuz Orijinal Ýskonto Oraný")?></th>
										<th style="text-align: center;font-size: 10px;border-right: 1px solid;border-top: 1px solid;"><?=dil_dashboard("Toplam Eþdeðer Ýskonto Oraný")?></th>
									</tr>
								</thead>
								<tbody>
								<tr>
										<td style="text-align: center; font-size: 10px;border-left: 1px solid;border-bottom:1px solid;font-weight:600;"><?=dil_dashboard("Toplam")?></td>
										<td style="text-align: center; font-size: 10px;border-bottom:1px solid;font-weight:600;"><?php  echo formatla($TOPLAM_GERCEK1/$TOPLAM_SISTEM1*100); ?></td>
										<td style="text-align: center; font-size: 10px;border-bottom:1px solid;font-weight:600;"><?php  echo formatla($TOPLAM_LO_GERCEK1/$TOPLAM_LO_SISTEM1*100); ?></td>
										<td style="text-align: center; font-size: 10px;border-bottom:1px solid;font-weight:600;border-right: 1px solid;"><?php  echo formatla($TOPLAM_ESD_GERCEK1/$TOPLAM_ESD_SISTEM1*100); ?></td>
								</tr>
								</tbody>
							</table>

                        </div>
                    </div>
                </div>


				<?php $parca_gruplari_arr         = $chartClass->parcaGruplariBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id); ?>
				<?php foreach($parca_gruplari_arr as $parca_gruplari){ ?>
				<?php
					$TEDARIK_GENEL_TOPLAM_TUTAR		+= $parca_gruplari['TEDARIK_TOPLAM_TUTARI'];
					$TEDARIK_LO_TOPLAM_TUTAR   		+= $parca_gruplari['TEDARIK_LO_TUTAR'];
					$TEDARIK_ESD_TOPLAM_TUTAR   	+= $parca_gruplari['TEDARIK_ESD_TUTAR'];
					$TEDARIK_GENEL_TOPLAM_ADET		+= $parca_gruplari['TEDARIK_TOPLAM_ADET'];
					$TEDARIK_LO_TOPLAM_ADET	   		+= $parca_gruplari['TEDARIK_LO_ADET'];
					$TEDARIK_ESD_TOPLAM_ADET		+= $parca_gruplari['TEDARIK_ESD_ADET'];
				?>
				<?php } ?>
				<div class="row" style="width: 99.7%;">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
                        <div class="table-responsive">
                        <table class="table" id="dev-table">
                            <thead>
								<tr style="border: 1px solid;">
									<th colspan="1" style="border: 1px solid;text-align: center;font-size: 10px;"></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("TOPLAM")?></th>
									<th colspan="6" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ADET")?></th>
									<th colspan="3" style="border: 1px solid;text-align: center;font-size: 10px;"><?=dil_dashboard("ORTALAMA PARÇA")?></th>
								</tr>
                                <tr>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?=dil_dashboard("Parça Grubu")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Oran%")?></th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Tutar")?></th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oran")?> %</th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Tutar")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Oran")?> %</th>

                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Toplam Adet Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Logosuz Orijinal Oraný")?>%</th>
									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Eþdeðer Adet")?> </th>
                                    <th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Eþdeðer Adet Oraný")?>%</th>

									<th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Toplam")?> </th>
                                    <th style="text-align: center;font-size: 10px;"><?=dil_dashboard("Ortalama Logosuz Orijinal")?></th>
									<th style="text-align: center;font-size: 10px;border-right: 1px solid;"><?=dil_dashboard("Ortalama Eþdeðer")?></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php foreach($parca_gruplari_arr as $parca_gruplari){ ?>
							<?php
									$PARCA_GRUBU  				= $parca_gruplari['PARCA_GRUBU'];

									$TEDARIK_TOPLAM_TUTARI     	= $parca_gruplari['TEDARIK_TOPLAM_TUTARI'];
									$TEDARIK_LO_TUTAR    	 	= $parca_gruplari['TEDARIK_LO_TUTAR'];
									$TEDARIK_ESD_TUTAR    	 	= $parca_gruplari['TEDARIK_ESD_TUTAR'];

									$TEDARIK_TOPLAM_ORAN	 	=	($TEDARIK_TOPLAM_TUTARI / $TEDARIK_GENEL_TOPLAM_TUTAR)*100;
									$TEDARIK_LO_ORAN	 	 	=	($TEDARIK_LO_TUTAR / $TEDARIK_TOPLAM_TUTARI)*100;
									$TEDARIK_ESD_ORAN	 	 	=	($TEDARIK_ESD_TUTAR / $TEDARIK_TOPLAM_TUTARI)*100;

									$TEDARIK_TOPLAM_ADET   		 = $parca_gruplari['TEDARIK_TOPLAM_ADET'];
									$TEDARIK_LO_ADET	   		 = $parca_gruplari['TEDARIK_LO_ADET'];
									$TEDARIK_ESD_ADET	  	 	 = $parca_gruplari['TEDARIK_ESD_ADET'];

									$TEDARIK_TOPLAM_ADET_ORAN	 = ($TEDARIK_TOPLAM_ADET / $TEDARIK_GENEL_TOPLAM_ADET)*100;
									$TEDARIK_LO_ADET_ORAN	 	 = ($TEDARIK_LO_ADET / $TEDARIK_TOPLAM_ADET)*100;
									$TEDARIK_ESD_ADET_ORAN	 	 = ($TEDARIK_ESD_ADET / $TEDARIK_TOPLAM_ADET)*100;

									$ORTALAMA_TOPLAM	    	 = $parca_gruplari['ORTALAMA_TOPLAM'];
									$ORTALAMA_LO		    	 = $parca_gruplari['ORTALAMA_LO'];
									$ORTALAMA_ESD		    	 = $parca_gruplari['ORTALAMA_ESD'];
							?>
                            <tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;"><?php echo $PARCA_GRUBU;?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_TUTARI);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ORAN);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_TUTAR);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ORAN);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_ESD_TUTAR);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ORAN);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_TOPLAM_ADET);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_TOPLAM_ADET_ORAN);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_LO_ADET);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($TEDARIK_LO_ADET_ORAN);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo ($TEDARIK_ESD_ADET);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_ADET_ORAN);?></td>

								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_TOPLAM);?></td>
								<td style="text-align: center; font-size: 10px;"><?php echo formatla($ORTALAMA_LO);?></td>
								<td style="text-align: center; font-size: 10px;border-right: 1px solid;"><?php echo formatla($ORTALAMA_ESD);?></td>
                            </tr>
							<?php } ?>
							<tr>
                                <td style="text-align: center; font-size: 10px;border-right: 1px solid;border-left: 1px solid;border-bottom:1px solid;font-weight:600;"><?=dil_dashboard("Toplam")?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR/$TEDARIK_GENEL_TOPLAM_TUTAR*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR/$TEDARIK_GENEL_TOPLAM_TUTAR*100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_GENEL_TOPLAM_ADET);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla(100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_LO_TOPLAM_ADET);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_ADET/$TEDARIK_GENEL_TOPLAM_ADET*100);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo ($TEDARIK_ESD_TOPLAM_ADET);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid; font-weight:600;"><?php echo formatla($TEDARIK_ESD_TOPLAM_ADET/$TEDARIK_GENEL_TOPLAM_ADET *100);?></td>

								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_GENEL_TOPLAM_TUTAR / $TEDARIK_GENEL_TOPLAM_ADET);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;"><?php echo formatla($TEDARIK_LO_TOPLAM_TUTAR / $TEDARIK_LO_TOPLAM_ADET);?></td>
								<td style="text-align: center; font-size: 10px;border-bottom:1px solid; font-weight:600;border-right: 1px solid;"><?php echo formatla($TEDARIK_ESD_TOPLAM_TUTAR / $TEDARIK_ESD_TOPLAM_ADET);?></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
				<?php
				$eksper_bazinda_lo_esd_arr         = $chartClass->eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,1);
				$eksper_bazinda_lo_arr         = $chartClass->eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,2);
				$eksper_bazinda_esd_arr         = $chartClass->eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,3);
                foreach($eksper_bazinda_lo_esd_arr as $eksper_bazinda_lo_esd){
						$chart_data_eksper_lo_esd .= "{ eksper:'".$eksper_bazinda_lo_esd['EKSPER']."', tutar:".($eksper_bazinda_lo_esd['TEDARIK_TOPLAM_TUTARI']).", adet:".($eksper_bazinda_lo_esd['TEDARIK_TOPLAM_ADET'])."}, ";
				}
				foreach($eksper_bazinda_lo_arr as $eksper_bazinda_lo){
						$chart_data_eksper_lo	  .= "{ eksper:'".$eksper_bazinda_lo['EKSPER']."', tutar:".($eksper_bazinda_lo['TEDARIK_LO_TUTAR']).", adet:".($eksper_bazinda_lo['TEDARIK_LO_ADET'])."}, ";
				}
				foreach($eksper_bazinda_esd_arr as $eksper_bazinda_esd){
						$chart_data_eksper_esd 	  .= "{ eksper:'".$eksper_bazinda_esd['EKSPER']."', tutar:".($eksper_bazinda_esd['TEDARIK_ESD_TUTAR']).", adet:".($eksper_bazinda_esd['TEDARIK_ESD_ADET'])."}, ";
				}
				?>
				<div class="row" style="width: 99.7%; margin-top:10px">
                    <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; background-color:#ffffff;">
						<div class="col-lg-4" style="float:left;">
							<div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; margin-top: 5px; min-height: 425px;">
							<div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
								<p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Top10 Eksper Lo-Eþdeðer Daðýlýmý")?> </p>
							</div>
							<div id='chart_hist_eksper_loesd' class='chart_morris'></div>
							<button type="button" class="chart2_eksperloesd" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="chart2_eksperloesd"> <?=dil_dashboard("Tümü")?> </button>
							</div>
						</div>

						<div class="col-lg-4 pdfNextPage" style="float:left;">
							<div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; margin-top: 5px; min-height: 425px;">
							<div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
								<p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Top10 Eksper Logosuz Orijinal Daðýlýmý")?> </p>
							</div>
							<div id='chart_hist_eksper_lo' class='chart_morris'></div>
							<button type="button" class="chart2_eksperlo" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="chart2_eksperlo"> <?=dil_dashboard("Tümü")?> </button>
							</div>
						</div>

						<div class="col-lg-4" style="float:left;">
							<div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto; margin-top: 5px; min-height: 425px;">
							<div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
								<p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Top10 Eksper Eþdeðer Daðýlýmý")?> </p>
							</div>
							<div id='chart_hist_eksper_esd' class='chart_morris'></div>
							<button type="button" class="chart2_eksperesd" data-dismiss="modal" data-toggle="modal" data-target=".bd-example-modal-xl" id="chart2_eksperesd"> <?=dil_dashboard("Tümü")?> </button>
							</div>
						</div>
                    </div>
                </div>


				<?php
                        $loesd_ay_bazinda_arr      = $chartClass->loEsdAyBazinda($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id);
                        foreach($loesd_ay_bazinda_arr as $loesd_ay_bazinda){
                            $chart_data_ay_bazinda_tutar .= "{ ay:'".$loesd_ay_bazinda["AY"]."', tutar:'".($loesd_ay_bazinda["TEDARIK_TOPLAM_TUTARI"])."', adet:'".($loesd_ay_bazinda["TEDARIK_TOPLAM_ADET"])."' }, ";
                        }
                ?>
                <div class="row" style="width: 99.7%;">
                <div class="col-lg-12">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                        <div class="row" style="width: 99.7%;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Ay Bazýnda Logosuz Orijinal Eþdeðer Daðýlýmý")?> </p>
                            </div>
                            <div id='chart_hist_loesd_aybazinda_tutar' class='chart_morris'></div>
                        </div>

                    </div>
                </div>
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

		Morris.Bar({
          element: 'chart_hist_loesd_aybazinda_tutar',
          dataLabels: true,
          data:[<?php echo $chart_data_ay_bazinda_tutar; ?>],
          xkey:'ay',
          ykeys:['tutar','adet'],
          labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
          barColors:['#d6af50', '#5e2590'],
          stacked:true,
        });

		Morris.Bar({
          element: 'chart_hist_eksper_loesd',
          dataLabels: true,
          data:[<?php echo $chart_data_eksper_lo_esd; ?>],
          xkey:'eksper',
          ykeys:['tutar','adet'],
          labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
          horizontal: true,
          stacked:true,
        });

		Morris.Bar({
          element: 'chart_hist_eksper_lo',
          dataLabels: true,
          data:[<?php echo $chart_data_eksper_lo; ?>],
          xkey:'eksper',
          ykeys:['tutar','adet'],
          labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
          horizontal: true,
          stacked:true,
        });

		Morris.Bar({
          element: 'chart_hist_eksper_esd',
          dataLabels: true,
          data:[<?php echo $chart_data_eksper_esd; ?>],
          xkey:'eksper',
          ykeys:['tutar','adet'],
          labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
          horizontal: true,
          stacked:true,
        });

		Morris.Bar({
          element: 'chart_hist_top20tedarikci_adet',
          dataLabels: true,
          data:[<?php echo $chart_data_top20tedarikci; ?>],
          xkey:'tedarikci',
          ykeys:['tutar'],
          labels:['<?=dil_dashboard("Tedarikci")?>'],
          barColors:['#d6af50', '#5e2590'],
          stacked:true,
        });

    </script>