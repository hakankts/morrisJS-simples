<div class="card" style="width: 98%;margin: 0px auto;">
    <div class="row" style="text-align: center;">

				<?=dil_dashboard("Dönem Seçimi (Yýl)");?>
				<select id="D_YIL" name="D_YIL" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">										 
                    <?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT DISTINCT SIPARIS_YIL AS D_YIL,SIPARIS_YIL FROM SEKTOR_YOK_PARCALAR GROUP BY SIPARIS_YIL ORDER BY SIPARIS_YIL DESC", "SELECT DISTINCT SIPARIS_YIL AS D_YIL,SIPARIS_YIL FROM SEKTOR_YOK_PARCALAR GROUP BY SIPARIS_YIL ORDER BY SIPARIS_YIL DESC");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$D_YIL);  
                    ?>                   
				</select>

				<?=dil_dashboard("Dönem");?>
				<?php
				$arr_aylar = array(dil_dashboard("1. Çeyrek"), dil_dashboard("2. Çeyrek"), dil_dashboard("3. Çeyrek"), dil_dashboard("4. Çeyrek"));
				if(!$D_AY){
					$D_AY = array();
					$num_bulundugumuz_ay = date('n');
					for($x=1;$x<=$num_bulundugumuz_ay;$x++){
						$D_AY[] = $x;
					}
				}
				?>				
				<select id="D_AY" name="D_AY" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">
					<option value="-1"><?=dil_dashboard("Tümü");?></option>
					<?
					foreach($arr_aylar as $k=>$v){
						$num_ay = $k+1;
					?>
					<option value="<?=$num_ay?>" <?=(in_array($num_ay,$D_AY))?' selected="selected"':''?>><?=$arr_aylar[$k]?></option>
					<?
					}
					?>
				</select>
				
				<?=dil_dashboard("Sigorta Þekli");?>
				<select id="D_SS" name="D_SS" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">					
					<?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT ID, ADI FROM SIGORTA_SEKLI WHERE ID IN (1,2)", "SELECT ID, ADI_ENG FROM SIGORTA_SEKLI WHERE ID IN (1,2)");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$D_SS);
                    ?>
				</select>
				
				<?=dil_dashboard("Araç Yaþý");?>
				<?
				if(!$ARAC_YAS){
					$bln_selected_tumu = true;
				}
				?>				
				<select id="ARAC_YAS" name="ARAC_YAS" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">
					<option value="-1"><?=dil_dashboard("Tümü");?></option>
					<?
					for($x=0;$x<=10;$x++){
					?>
					<option value="<?=$x?>" <?=in_array($x,$ARAC_YAS) || $bln_selected_tumu ?' selected="selected"':''?>><?=$x?></option>
					<?
					}
					?>
					<option value="1000" <?=in_array(1000,$ARAC_YAS) || $bln_selected_tumu?' selected="selected"':''?>>10+</option>
				</select>                            
	 
				<?=dil_dashboard("Marka");?>
				<select id="D_MARKA" name="D_MARKA" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">
					<option value="-1" <?=('-1' == $D_AKS)?' selected="selected"':''?>><?=dil_dashboard('Tümünü Göster')?></option>
					<?
					$str_sql_marka = "
						SELECT
							MARKA.MARKA_KODU,
							MARKA.MARKA_ADI
						FROM
							YP_TRANSFER_TARIHLERI
						INNER JOIN MARKA ON MARKA.ID = YP_TRANSFER_TARIHLERI.MARKA_KODU
						WHERE
							MARKA.ID NOT IN (109,152)
						GROUP BY
							YP_TRANSFER_TARIHLERI.MARKA_KODU
						ORDER BY
							MARKA.MARKA_ADI
					";
					if (!($cdb->execute_sql($str_sql_marka,$result_marka,$error_msg))){ print_error($error_msg); exit;}
					if(mysql_num_rows($result_marka)>0){
						while($row_marka = mysql_fetch_object($result_marka)){
					?>
					<option value="<?=$row_marka->MARKA_KODU?>" <?=($row_marka->MARKA_KODU == $D_MARKA)?' selected="selected"':''?>><?=$row_marka->MARKA_ADI?></option>
					<?
						}
					}
					?>
				</select>
				
				<?=dil_dashboard("Parça Tipi");?>
				<select id="D_PT" name="D_PT" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">
					<option value="-1" <?=('-1' == $D_AY)?' selected="selected"':''?>><?=dil_dashboard('Tümünü Göster')?></option>
					<?
					$arr_pt = array(0=>dil_dashboard("Orijinal"), 1=>dil_dashboard("Logosuz Orijinal") , 2=>dil_dashboard("Eþdeðer"));
					foreach($arr_pt as $k=>$v){
					?>
					<option value="<?=$k?>" <?=($k == $D_PT)?' selected="selected"':''?>><?=$v?></option>
					<?
					}
					?>
				</select>
				
				<?=dil_dashboard("Kullaným Þekli");?>
				<select id="D_AKS" name="D_AKS" class="btn btn-success btn-xs" style="width: 150px;margin-left: 2px;">
				<option value="-1"><?=dil_dashboard("Tümü");?></option>
				<?php
				$str_sql_aks = "SELECT ID, SEKIL FROM ARAC_KULLANIM_SEKLI";
				if (!($cdb->execute_sql($str_sql_aks,$result_aks,$error_msg))){ print_error($error_msg); exit;}
				if(mysql_num_rows($result_aks)>0){
					if(!$D_AKS){
						$bln_selected_tumu = true;
					}
					while($row_aks = mysql_fetch_object($result_aks)){
				?>
				<option value="<?=$row_aks->ID?>" <?=in_array($row_aks->ID,$D_AKS) || $bln_selected_tumu?' selected="selected"':''?>><?=dil_dashboard($row_aks->SEKIL)?></option>
				<?
					}
				}
				?>
				</select>
											
				<button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button">  <?=dil_dashboard("Ara");?> </button>
                <button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('box', 'tedarik')"> <?=dil_dashboard("PDF");?> </button>
	 </div>
</div>