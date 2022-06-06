<div class="card" style="width: 98%;margin: 0px auto;">
    <div class="row" style="text-align: center;">

                    <?=dil_dashboard("Dönem Seçimi (Yýl)");?>
                    <select class="btn btn-success btn-xs" name="DONEM" id="DONEM" style="width: 150px;margin-left: 2px;">
                    <?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT DISTINCT DONEM, DONEM_TEXT FROM SEKTOR_TEDARIK_ANALIZ GROUP BY DONEM,DONEM_TEXT", "SELECT DISTINCT DONEM, DONEM_TEXT_ENG FROM SEKTOR_TEDARIK_ANALIZ GROUP BY DONEM,DONEM_TEXT");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$DONEM);
                    ?>
                    </select>

                     <?=dil_dashboard("Branþ");?>
                    <select class="btn btn-success btn-xs" name="SIGORTA_SEKLI" id="SIGORTA_SEKLI" style="width: 150px;margin-left: 2px;">
                    <?php
                       $cUtility = new Utility();
                       $conn = $cdb->getConnection();
                       $strSQL = dil_dashboard("SELECT ID, ADI FROM SIGORTA_SEKLI WHERE ID IN (1,2)", "SELECT ID, ADI_ENG FROM SIGORTA_SEKLI WHERE ID IN (1,2)");
                       echo $cUtility->FillComboValuesWSQL($conn, $strSQL, true,$SIGORTA_SEKLI);
                    ?>
                    </select>
          <?php if(dbg()){?>
          <input type="text" size="1" name="hides" id="hides" value="0">
          <?php } ?>
                <button type="button" class="btn btn-success btn-xs tamam-btn" name="succes_button" id="succes_button">  <?=dil_dashboard("Ara");?> </button>
                <button type="button" class="btn btn-danger btn-xs pdf-btn" onclick="pdfMake('box', 'tedarik')"> <?=dil_dashboard("PDF");?> </button>
    </div>
</div>

 <div class="col-lg-12"style="width: 100%;padding: 1px; cursor: pointer; overflow: hidden; color: #ff0000; margin: 0px auto; background-color:#ffffff;text-align:center;font-weight: 600;">
    <?=dil_dashboard("Rapor Kriterleri: Kapalý dosyalar, Sipariþe uygun dosyalar, Ýhbar tarihine göre , Sadece var denilen parçalar, Talepsiz kapatýlan dosyalar hariç, Pert dosyalar hariç","Report Criteria: Closed files, Files appropriate for ordering, according to the date of notice, only parts in stock, except files that are closed without a request, except Total Loss files");?>
  <br><?=dil_dashboard(" Güncel yýl periyodik olarak gösterilmektedir. Her yýllýk çeyrek dönemde güncellenmektedir.","The current year is shown periodically. It is updated every quarter.");?>
</div>
