<div class="card" style="width: 98%;margin: 0px auto;">
    <div class="row">
            <div class="col-lg-1.1" style="float:left;margin-left: 5px;margin-bottom: 5px;">
                    <?=dil_dashboard("Branş");?>
                    <select class="btn btn-success btn-xs" name="SIGORTA_SEKLI" id="SIGORTA_SEKLI" style="width: 90px;margin-left: 2px;">
                    <?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT ID, ADI FROM SIGORTA_SEKLI WHERE ID IN (1,2)", "SELECT ID, ADI_ENG FROM SIGORTA_SEKLI WHERE ID IN (1,2)");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$SIGORTA_SEKLI);
                    ?>
                    </select>
            </div>
            <div class="col-lg-2.3" style="float:left;margin-bottom: 5px;">
			<?php
				if($SESSION['dil']=="T"){ $lang = "tr";}
				if($SESSION['dil']=="E"){ $lang = "en";}
				$date1 = date("Y-01-01");
				$date2 = date("Y-m-d");
			?>
                    <?=dil_dashboard("Sipariş Tarih Aralığı");?>
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
            <div class="col-lg-1.2" style="float:left;margin-bottom: 5px;">
                 <?=dil_dashboard("Tedarikci");?>
                <select class="btn btn-success btn-xs" name="TEDARIKCI" id="TEDARIKCI" style="width: 100px;margin-left: 2px;">
                    <?php
						$companyId 	= OAConf::COMPANY_ID;
						if(!($companyId == 20 || $companyId == 27 || $companyId == 37 || $companyId == 30 || $companyId == 64 || $companyId == 143 )){
							$kriter = " AND YANSANAYI = 1 ";
						}
						else
						{
							$kriter = " AND YANSANAYI = 1 OR ((NAME LIKE ('%MARS%')  OR NAME LIKE ('%EVREN%') OR NAME LIKE ('%BİRLİKLER%') OR NAME LIKE ('%OPTİMUM%') ))";
						}
                        $conn = $cdb->getConnection();
                        $qry = "
                           SELECT
								ID,
								NAME
							FROM
								SIPARIS_USERS
							WHERE
								ACTIVE = 1
								$kriter
								AND NAME NOT LIKE '%TEST%'
							ORDER BY
								NAME
                        " ;
                        echo $cUtility->FillComboValuesWSQL($conn, $qry, true,  $TEDARIKCI);
                      ?>
                </select>
            </div>

			 <div class="col-lg-1.5" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Menşei");?>
                <select class="btn btn-success btn-xs" name="MENSEI" id="MENSEI" style="width: 100px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQL = dil_dashboard("SELECT ID,AD FROM SIPARIS_YANSANAYI_ULKE ORDER BY AD", "SELECT ID,AD_ENG FROM SIPARIS_YANSANAYI_ULKE ORDER BY AD_ENG");
                    echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,  $MENSEI);
                ?>
                </select>
            </div>

			<div class="col-lg-1.5" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Ürün");?>
                <select class="btn btn-success btn-xs" name="URUN_ID" id="URUN_ID" style="width: 100px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQL_YS = dil_dashboard("SELECT ID,AD FROM SIPARIS_YANSANAYI_MARKA ORDER BY AD","SELECT ID,AD FROM SIPARIS_YANSANAYI_MARKA ORDER BY AD");
                    echo $cUtility->FillComboValuesWSQL($conn, $strSQL_YS, true,  $URUN_ID);
                ?>
                </select>
            </div>

            <div class="col-lg-1.5" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Kullanım");?>
                <select class="btn btn-success btn-xs" name="KULLANIM_SEKLI" id="KULLANIM_SEKLI" style="width: 100px;margin-left: 2px;">
					<option value="-1"><?=dil_dashboard("--Tümü--","--All--");?></option>
					<option value="1"><?=dil_dashboard("Binek");?></option>
					<option value="2"><?=dil_dashboard("Binek Dışı");?></option>
                </select>
            </div>

			 <div class="col-lg-1.5" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Marka");?>
                <select class="btn btn-success btn-xs" name="MARKA_ID" id="MARKA_ID" style="width: 100px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQLMarka = "SELECT ID, MARKA_ADI FROM MARKA ORDER BY MARKA_ADI";
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQLMarka, true,$MARKA_ID);
                ?>
                </select>
            </div>

			<div class="col-lg-1.4" style="float:left;margin-bottom: 5px;padding-left: 5px;">
                <?=dil_dashboard("İl");?>
                <select class="btn btn-success btn-xs" name="SEHIR_ID" id="SEHIR_ID" style="width: 100px;margin-left: 2px;">
                <?php
                    $conn = $cdb->getConnection();
                    $strSQLSehir = "SELECT * FROM ILLER ORDER BY ADI";
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQLSehir, true,$SEHIR_ID);
                ?>
                </select>
            </div>

            <div class="col-lg-2.5" style="float:left;margin-bottom: 5px;">
                <button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button"> <?=dil_dashboard("Ara");?> </button>
                <button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('box', 'logosuz_orijinal_esdeger_parca_tedarigi')"><?=dil_dashboard("PDF");?></button>
            </div>
        </div>
</div>
<div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #ff0000; margin: 0px auto; background-color:#ffffff;text-align:center;font-weight: 600;">
	 <?=dil_dashboard("Tedarik yapılan ve stokta var denilen siparişler dikkate alınmıştır. Rapor sipariş tarihine göre çalışmaktadır.");?>
</div>
