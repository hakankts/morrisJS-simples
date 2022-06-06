    <div class="card" style="width: 98%;margin: 0px auto;">
        <div class="row">
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
                    <?=dil_dashboard("Bran�");?>
                    <select class="btn btn-success btn-xs" name="SIGORTA_SEKLI" id="SIGORTA_SEKLI" style="width: 150px;margin-left: 2px;">
                        <option value="-1">--<?=dil_dashboard('T�m�');?>--</option>
                    <?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT ID, ADI FROM SIGORTA_SEKLI WHERE ID IN (1, 2)", "SELECT ID, ADI_ENG FROM SIGORTA_SEKLI WHERE ID IN (1,2)");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, false, $SIGORTA_SEKLI);
                    ?>
                    </select>
            </div>
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
                <?php
                    if($SESSION['dil']=="T"){ $lang = "tr";}
                    if($SESSION['dil']=="E"){ $lang = "en";}
                ?>
                    <?=dil_dashboard("Kay�t Tarih Aral���");?>
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
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Marka");?>
                <select class="btn btn-success btn-xs" name="MARKA_ID" id="MARKA_ID" size="1" style="width: 100px;margin-left: 2px;">
                   <?
                   $conn = $cdb->getConnection();
                   $strSQL = "  SELECT
                                    M.ID,
                                    M.MARKA_ADI,
                                    M.IMAGE
                                FROM
                                    MARKA M
                                INNER JOIN YP_TRANSFER_TARIHLERI TT ON TT.MARKA_KODU = M.ID
                                WHERE
                                    M.ID NOT IN (109,152)
                                GROUP BY
                                    M.MARKA_KODU
                                ORDER BY
                                    M.MARKA_ADI,
                                    TT.ID";
                   echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$MARKA_ID);
                    ?>
               </select>
            </div>
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Dosya Stat�s�");?>
                <select class="btn btn-success btn-xs" name="DOSYA_STATU" id="DOSYA_STATU" style="width: 100px;margin-left: 2px;">
                   <option <?if ($DOSYA_STATU == "-1"){ echo " selected";}?> value="-1"><?=dil_dashboard("T�m�","All")?></option>
                   <option <?if ($DOSYA_STATU == "0"){ echo " selected";}?> value="0"><?=dil_dashboard("A��k","Open")?></option>
                   <option <?if ($DOSYA_STATU == "1"){ echo " selected";}?> value="1"><?=dil_dashboard("Kapal�","Close")?></option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("Ara� Ya��");?>
                <select class="btn btn-success btn-xs" name="ARAC_YAS" id="ARAC_YAS" style="width: 100px;margin-left: 2px;">
                <option value="">Se�iniz</option>
                    <?
                    for ($yy=1  ; $yy < 11 ; $yy++){
                        if($ARAC_YAS==$yy){ $selected="selected";}else{$selected="";}
                        echo '<option value="'.$yy.'" '.$selected.'>'.$yy.'</option>';
                    }
                    ?>
                </select>
                <input type="radio" id="ARAC_YAS_TIP_0" name="ARAC_YAS_TIP" value="0"<?=($ARAC_YAS_TIP=="0")?' checked="checked"':''?>/> <label for="ARAC_YAS_TIP_0"><?=dil_dashboard('ya� alt�');?></label>
                <input type="radio" id="ARAC_YAS_TIP_1" name="ARAC_YAS_TIP" value="1"<?=($ARAC_YAS_TIP=="1")?' checked="checked"':''?>/> <label for="ARAC_YAS_TIP_1"><?=dil_dashboard('ya� �st�');?></label>
            </div>
            <div class="col-lg-6" style="float:left;margin-bottom: 5px;">
                <?=dil_dashboard("�l");?>
                <select class="btn btn-success btn-xs" name="IL" id="IL" style="width: 100px;margin-left: 2px;">
                    <option value="-1">--<?=dil_dashboard('T�m�');?>--</option>
                    <?php
                       $conn = $cdb->getConnection();
                       $strSQL = "SELECT ILLER.ID, ILLER.ADI FROM ILLER GROUP BY ILLER.ID ORDER BY ILLER.ADI";
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, false, $IL);
                    ?>
                </select>
            </div>
            <div class="col-lg-3" style="float:left;margin-bottom: 5px;">
                <button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button"> <?=dil_dashboard("Ara");?> </button>
                <button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('box', 'dashboard_tedarik')"><?=dil_dashboard("PDF");?></button>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="padding: 1px;  text-align:center; font-weight: 600;">
        <span style="color: #ff0000;">
            <?=dil_dashboard("Rapor Kriterleri: Kapal� dosyalar, Sipari�e uygun dosyalar, �hbar tarihine g�re, Sadece var denilen par�alar, Talepsiz kapat�lan dosyalar hari�, Pert dosyalar hari�","Report Criteria: Closed files, Files appropriate for ordering, according to the date of notice, only parts in stock, except files that are closed without a request, except Total Loss files");?>
        </span>
        <br>
        <span style="color: black;">
            <?=dil_dashboard("Dosya bilgilerini 1875 nolu rapordan alabilirsiniz.");?>
        </span>
    </div>