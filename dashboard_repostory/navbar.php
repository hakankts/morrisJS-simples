<div class="btn-group" style="width: 95.5%;left: 5px;padding: 5px;float:left;border: 1px solid #ccc;border-radius: 5px; color:black;">
        <input type="hidden" class="btn btn-success" name="ilk_tarih" id="ilk_tarih" value="111">
        <button type="button" class="btn btn-success btn-sm" name="month3" id="month3" value="3" ><?=dil_dashboard("Son 3 Ay Açýk Dosya Durumu");?></button>
        <button type="button" class="btn btn-success btn-sm" name="month12" id="month12" value="12" ><?=dil_dashboard("1 Yýllýk Açýk Dosya Durumu");?></button>
        <div style="float:left;margin-left: 15px;">
            <?=dil_dashboard("Dosya Sorumlusu");?>
            <select class="btn btn-success btn-sm" name="sorumlu" id="sorumlu" style="width: 150px;margin-left: 10px;">
            <?php
                $cUtility = new Utility();
                $conn = $cdb->getConnection();
                $sql_user = $kullaniciKontrol->dsKontrol($kullanici_kontrol);
                echo $cUtility->FillComboValuesWSQL($conn, $sql_user, true, $sorumlu);
            ?>
            </select>
        </div>
        <div style="float:left;margin-left: 10px;">
                <?=dil_dashboard("Branþ");?>
                <select class="btn btn-success btn-sm" name="sigorta_sekli" id="sigorta_sekli" style="width: 150px;margin-left: 2px;">
                <?php
                   $cUtility = new Utility();
                   $conn = $cdb->getConnection();
                    $strSQL = dil_dashboard("SELECT ID, ADI FROM SIGORTA_SEKLI WHERE ID IN (1,2)", "SELECT ID, ADI_ENG FROM SIGORTA_SEKLI WHERE ID IN (1,2)");
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$sigorta_sekli);
                ?>
                </select>
        </div>
        <div style="float:left;margin-left: 10px;">
                <?=dil_dashboard("Servis Tipi");?>
                <select name="S_TUR" class="btn btn-success btn-sm" name="S_TUR" id="S_TUR" style="width: 150px;margin-left: 2px;">
                    <option value="0"><?=dil_dashboard("- - Tümü - -","- - All - -")?></option>
                    <option <?if($S_TUR == "1"){ echo " selected";}?> value="1"><?=dil_dashboard("Yetkili","Authorized")?></option>
                    <option <?if($S_TUR == "2"){ echo " selected";}?> value="2"><?=dil_dashboard("Özel ","Private ")?></option>
                    <option <?if($S_TUR == "3"){ echo " selected";}?> value="3"><?=dil_dashboard("Anlaþmalý ","Agreed ")?></option>
                    <option <?if($S_TUR == "4"){ echo " selected";}?> value="4"><?=dil_dashboard("Anlaþmasýz ","Non Agreed ")?></option>
                    <option <?if($S_TUR == "5"){ echo " selected";}?> value="5"><?=dil_dashboard("Yetkili Anlaþmalý","")?></option>
                    <option <?if($S_TUR == "6"){ echo " selected";}?> value="6"><?=dil_dashboard("Özel Anlaþmalý"," ")?></option>
                    <option <?if($S_TUR == "7"){ echo " selected";}?> value="7"><?=dil_dashboard("Yetkili Anlaþmasýz ","")?></option>
                    <option <?if($S_TUR == "8"){ echo " selected";}?> value="8"><?=dil_dashboard("Özel Anlaþmasýz ","")?></option>
                </select>
        </div>
        <div style="float:left;margin-left: 10px;">
            <button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button"><?=dil_dashboard("Ara");?></button>
            <button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('pc_content', 'dashboard')"><?=dil_dashboard("PDF");?></button>
        </div>
</div>
