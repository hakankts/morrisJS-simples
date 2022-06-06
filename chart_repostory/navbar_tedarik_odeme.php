<div class="card" style="width: 98%;margin: 0px auto;">
    <div class="row">
	<table style="font-size: 12px;font-weight: 600;">
		<tr>
		<td>
            <div class="col-lg-2" style="float:left;margin-left: 5px;margin-bottom: 5px;">
                    <?=dil_dashboard("Branþ");?>
                    <select class="btn btn-success btn-xs" name="SIGORTA_SEKLI" id="SIGORTA_SEKLI" style="width: 150px;margin-left: 2px;">
                    <?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT ID, ADI FROM SIGORTA_SEKLI WHERE ID IN (1,2)", "SELECT ID, ADI_ENG FROM SIGORTA_SEKLI WHERE ID IN (1,2)");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$SIGORTA_SEKLI);
                    ?>
                    </select>
            </div>
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
			<?php
				if($SESSION['dil']=="T"){ $lang = "tr";}
				if($SESSION['dil']=="E"){ $lang = "en";}
				$date1 = date("Y-01-01");
				$date2 = date("Y-m-d");
			?>
                    <?=dil_dashboard("Kayýt Tarih Aralýðý");?>
                    <input name="tarih1" id="tarih1" class="btn btn-success btn-xs" size="8" type="text" value="<?php echo $date1;?>" readonly="">
                    <script>
                        $('input').datepicker({
                            format: 'yyyy-mm-dd',
                            language:"<?=$lang;?>"
                        });
                    </script>
                    <input name="tarih2" id="tarih2" class="btn btn-success btn-xs" size="8" type="text" value="<?php echo $date2;?>" readonly="">
                    <script>
                        $('input').datepicker({
                            format: 'yyyy-mm-dd',
                            language:"<?=$lang;?>"
                        });
                    </script>
            </div>
            <div class="col-lg-2" style="float:left;margin-bottom: 5px;margin-left:5px;">
                 <?=dil_dashboard("Tedarikci");?>
                <select class="btn btn-success btn-xs" name="TEDARIKCI" id="TEDARIKCI" style="width: 100px;margin-left: 2px;">
                    <?php
                        $conn = $cdb->getConnection();
                        $qry = "
                           SELECT
								ID,
								NAME
							FROM
								SIPARIS_USERS
							WHERE
								ACTIVE = 1
								AND NAME NOT LIKE '%TEST%'
							ORDER BY
								NAME
                        " ;
                        echo $cUtility->FillComboValuesWSQL($conn, $qry, true,  $TEDARIKCI);
                      ?>
                </select>
            </div>

			<div class="col-lg-2" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Marka");?>
                <select class="btn btn-success btn-xs" name="MARKA_ID" id="MARKA_ID" style="width: 100px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQLMarka = "SELECT ID, MARKA_ADI FROM MARKA ORDER BY MARKA_ADI";
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQLMarka, true,$MARKA_ID);
                ?>
                </select>
            </div>

			<div class="col-lg-2" style="float:left;margin-bottom: 5px;padding-left: 5px;">
                <?=dil_dashboard("Ýl");?>
                <select class="btn btn-success btn-xs" name="SEHIR_ID" id="SEHIR_ID" style="width: 100px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQLSehir = "SELECT * FROM ILLER ORDER BY ADI";
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQLSehir, true,$SEHIR_ID);
                ?>
                </select>
			</div>
			    
			</td>
			</tr>
			<tr>
			<td>
           <div class="col-lg-3" >
					<?=dil_dashboard("Araç Kullaným Þekli")?>
					<select class="btn btn-success btn-xs" name="KULLANIM_SEKLI" id="KULLANIM_SEKLI" style="width: 150px;margin-left: 2px;">
					<?php
						$conn = $cdb->getConnection();
						$qry = dil_dashboard("SELECT ID,SEKIL FROM ARAC_KULLANIM_SEKLI") ;
						echo $cUtility->FillComboValuesWSQL($conn, $qry, true,  $KULLANIM_SEKLI);
					?>
					</select>
			</div>

			<div class="col-lg-2" >
					<?=dil_dashboard("Eksper")?>
					<select class="btn btn-success btn-xs" name="USER_EKSPER" id="USER_EKSPER" style="width: 150px;margin-left: 2px;">
						<?php
							$conn = $cdb->getConnection();
							$qry = "
								SELECT
									U_NAME,
									NAME
								FROM USERS
								WHERE HASAR_USER=4
								  AND  U_NAME NOT IN ('EKSPER','EKSPER2')
								  AND IFNULL(FATURALI_KULLANICI,0)=0
								  AND IFNULL(OTOMOTIV,0)=0
								  AND IFNULL(HKM_EKSPER,0)=0
								  AND ENABLED=1
								ORDER BY NAME
							" ;
							echo $cUtility->FillComboValuesWSQL($conn, $qry, true,  $USER_EKSPER);
						  ?>
					</select>
			</div>

			 <div class="col-lg-3" style="float:left;margin-bottom: 5px;margin-left:5px;">
                <?=dil_dashboard("Raporlama Seçenekleri");?>
                <select class="btn btn-success btn-xs" name="RAPOR_SECIM" id="RAPOR_SECIM" style="width: 170px;margin-left: 2px;">
					<option <?php if(!$RAPOR_SECIM || $RAPOR_SECIM=='-1'){ echo "selected";}?> value="-1"><?=dil_dashboard("Özet Göster");?></option>
					<option <?php if($RAPOR_SECIM=='2'){ echo "selected";}?> value="2"><?=dil_dashboard("Detay Göster");?></option>
                </select>
            </div>
			
			<div class="col-lg-2" style="float:left;margin-bottom: 5px;padding-left: 5px;">
                <?=dil_dashboard("Sipariþ Uygun");?>
                <input class="form-check-input" type="Checkbox" name="SIPARIS_UYGUN" id="SIPARIS_UYGUN" value="1" <?if($SIPARIS_UYGUN=="1"){ echo " checked";}?>>
				<?=dil_dashboard("Eksperli");?>
				<input class="form-check-input" type="Checkbox" name="EKSPERLI" id="EKSPERLI" value="1" <?if($EKSPERLI=="1"){ echo " checked";}?>>
            </div>
          
			</td>
			</tr>
			<tr>
				<td>					 
					 <?if ($SESSION['company_id'] == 64){?>
					<div class="col-lg-5" >						
							<?if ($FILO_ACENTELER == ""){ $FILO_ACENTELER = $FILO_ACENTELER_SABIT; }?>
							<input onclick="if (this.checked) { $('#FILO_ACENTELER').prop( 'disabled', false ); } else { $('#FILO_ACENTELER').prop( 'disabled', true ); }" type="checkbox" name="FILO_HARIC" id="FILO_HARIC" value="1" ><?=dil_dashboard("Filo Dosyalarý Hariç")?>
							<input <?if ($FILO_HARIC != 1 ){ echo " disabled"; }?> type="text" name="FILO_ACENTELER" id="FILO_ACENTELER" size="50" value="<?=$FILO_ACENTELER?>">						
					</div>
					<?}?>									
					 <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
						<button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button"> <?=dil_dashboard("Ara");?> </button>
						<button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('box', 'logosuz_orijinal_esdeger_parca_tedarigi')"><?=dil_dashboard("PDF");?></button>
					</div>
				</td>
			<td>
			</table>
		</div>
</div>