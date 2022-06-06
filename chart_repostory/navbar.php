<div class="card" style="width: 98%;margin: 0px auto;">
    <div class="row">
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
            <div class="col-lg-4" style="float:left;margin-bottom: 5px;">
			<?php
				if($SESSION['dil']=="T"){ $lang = "tr";}
				if($SESSION['dil']=="E"){ $lang = "en";}
			?>
                    <?=dil_dashboard("Kayýt Tarih Aralýðý");?>
                    <input name="tarih1" id="tarih1" class="btn btn-success btn-xs" size="16" type="text" value="" readonly="">
                    <script>
                        $('input').datepicker({
                            format: 'yyyy-mm-dd',
                            language:"<?=$lang;?>"
                        });
                    </script>
                    <input name="tarih2" id="tarih2" class="btn btn-success btn-xs" size="16" type="text" value="" readonly="">
                    <script>
                        $('input').datepicker({
                            format: 'yyyy-mm-dd',
                            language:"<?=$lang;?>"
                        });
                    </script>
            </div>
            <div class="col-lg-2" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Marka");?>
                <select class="btn btn-success btn-xs" name="MARKA_ID" id="MARKA_ID" style="width: 150px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQLMarka = "SELECT ID, MARKA_ADI FROM MARKA ORDER BY MARKA_ADI";
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQLMarka, true,$MARKA_ID);
                ?>
                </select>
            </div>

            <div class="col-lg-2" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Kullaným");?>
                <select class="btn btn-success btn-xs" name="KULLANIM_SEKLI" id="KULLANIM_SEKLI" style="width: 150px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQL = dil_dashboard("SELECT ID,SEKIL FROM ARAC_KULLANIM_SEKLI", "SELECT ID,SEKIL_ENG FROM ARAC_KULLANIM_SEKLI");
                    echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,  $KULLANIM_SEKLI);
                ?>
                </select>
            </div>
       
	</div>
	<div class="row">			
		<div class="col-lg-2" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Tedarikci");?>
                <select class="btn btn-success btn-xs" name="TEDARIKCI" id="TEDARIKCI" style="width: 150px;margin-left: 2px;">
                    <?php
                        $conn = $cdb->getConnection();
                        $qry = "
                            SELECT
                                ID,
                                NAME
                            FROM SIPARIS_USERS
                                WHERE ACTIVE=1
                            ORDER BY NAME
                        " ;
                        echo $cUtility->FillComboValuesWSQL($conn, $qry, true,  $TEDARIKCI);
                      ?>
                </select>                
        </div>
		<?if ($SESSION['company_id'] == 64){?>
		<div class="col-lg-4" >						
				<?if ($FILO_ACENTELER == ""){ $FILO_ACENTELER = $FILO_ACENTELER_SABIT; }?>
				<input onclick="if (this.checked) { $('#FILO_ACENTELER').prop( 'disabled', false ); } else { $('#FILO_ACENTELER').prop( 'disabled', true ); }" type="checkbox" name="FILO_HARIC" id="FILO_HARIC" value="1" ><?=dil_dashboard("Filo Dosyalarý Hariç")?>
				<input <?if ($FILO_HARIC != 1 ){ echo " disabled"; }?> type="text" name="FILO_ACENTELER" id="FILO_ACENTELER" size="40" value="<?=$FILO_ACENTELER?>">						
		</div>		
		<div class="col-lg-1" >										
				<input type="checkbox" name="FATURALI_HARIC" id="FATURALI_HARIC" value="1" ><?=dil_dashboard("Faturalý Hariç")?>				
		</div>		
		<div class="col-lg-1" >										
				<input type="checkbox" name="MODUL_HARIC" id="MODUL_HARIC" value="1" ><?=dil_dashboard("Modül Hariç")?>				
		</div>		
		<?}?>									
		<div class="col-lg-3" style="float:left;margin-bottom: 5px;">
				<button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button"> <?=dil_dashboard("Ara");?> </button>
                <button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('box', 'tedarik')"><?=dil_dashboard("PDF");?></button>
		</div>
	</div>
</div>
 <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #ff0000; margin: 0px auto; background-color:#ffffff;text-align:center;font-weight: 600;">
	<?=dil_dashboard("Rapor Kriterleri: Kapalý dosyalar, Sipariþe uygun dosyalar, Ýhbar tarihine göre , Sadece var denilen parçalar, Talepsiz kapatýlan dosyalar hariç, Pert dosyalar hariç","Report Criteria: Closed files, Files appropriate for ordering, according to the date of notice, only parts in stock, except files that are closed without a request, except Total Loss files");?>
	<br>
	<?=dil_dashboard(" Tedarik Ýskontosu% fiziki yapýlan tedarike göre hesaplanmaktadýr "); ?>
</div>
