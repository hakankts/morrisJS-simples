<?php


            if($type=="3")
            {
                $ay_basi = date("Y-m-d", mktime(0, 0, 0, date("m")-3 , date("d"), date("Y")));
                $ay_sonu = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));
            }
            if(!$type || $type=="12")
            {
                $year = date('Y');
                $ay_basi = date("Y-m-d", mktime(0, 0, 0, date("m")-12 , date("d"), date("Y")));
                $ay_sonu = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));
            }

            require_once("dashboardClass.php");
            $dashboardClass     = new dashboardClass();
            $modul_kontrol      = $dashboardClass->modul_aktif_kontrol();
    ?>
    <?php require_once("load_modal.php");?>
    <?php if($modul_kontrol['modul_eksper']){ ?>
    <?php $eksper_data      = $dashboardClass->eksperBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu); ?>
    <div id="pc_content">
                <div class="pc_item">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">EKSPER</h3>
                        </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper1"> <?php echo $eksper_data->TOPLAM_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $eksper_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Parça Ýþçilik Hareketi Olmayan Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl"  class="eksper" id="eksper4"> <?php echo $eksper_data->PARCA_GIRILMEMIS_DOSYA_ADET;?></a></td>
                                <td><?php echo $eksper_data->PARCA_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->PARCA_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Servis Bilgisi Girilmemiþ Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper5"> <?php echo $eksper_data->SERVIS_GIRILMEMIS_DOSYA_ADET;?></a></td>
                                <td><?php echo $eksper_data->SERVIS_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->SERVIS_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Pert Ýþaretlenen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper8"> <?php echo $eksper_data->PERT_ADET;?></a></td>
                                <td><?php echo $eksper_data->PERT_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->PERT_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Tedarike Uygun Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper9"> <?php echo $eksper_data->SIPARIS_UYGUN_DOSYALAR;?></a></td>
                                <td><?php echo $eksper_data->SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->SIPARIS_UYGUN_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Neden Açýk Girilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper10"> <?php echo $eksper_data->NEDEN_ACIK_DOSYALAR;?></a></td>
                                <td><?php echo $eksper_data->NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->NEDEN_ACIK_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Kullanýcý Muallak Giriþi Yapýlmayan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper11"> <?php echo $eksper_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA;?></a></td>
                                <td><?php echo $eksper_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->MULLAK_GIRISI_YAPILMAYAN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Foto - Evrak Yüklenmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper12"> <?php echo $eksper_data->FOTO_EVRAK_YUKLENMEMIS_ADET;?></a></td>
                                <td><?php echo $eksper_data->FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->FOTO_EVRAK_YUKLENMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Maðdur Araç Bilgisi Girilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper13"> <?php echo $eksper_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS;?></a></td>
                                <td><?php echo $eksper_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Rücu Ýþaretli</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper14"> <?php echo $eksper_data->RUCU_ISARETLI;?></a></td>
                                <td><?php echo $eksper_data->RUCU_ISARETLI_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->RUCU_ISARETLI_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Ön Rapor Gönderilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper6"> <?php echo $eksper_data->ON_RAPO_ADET;?></a></td>
                                <td><?php echo $eksper_data->ON_RAPOR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->ON_RAPOR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Ön Rapor Gönderilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper7"> <?php echo $eksper_data->ON_RAPO_GONDERILMEYEN_ADET;?></a></td>
                                <td><?php echo $eksper_data->ON_RAPO_GONDERILMEYEN_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->ON_RAPO_GONDERILMEYEN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Yedek Parça (Deðiþim)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper2"> <?php echo $eksper_data->DEGISIM_ADET;?></a></td>
                                <td><?php echo $eksper_data->DEGISIM_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->DEGISIM_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Yedek Parça (Onarým)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper3"> <?php echo $eksper_data->ONARIM_ADET;?></a></td>
                                <td><?php echo $eksper_data->ONARIM_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->ONARIM_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Poliçe-Hasar Tarihi Fark <30</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="eksper" id="eksper15"> <?php echo $eksper_data->POLICE_FARK_DOSYA_SAY;?></a></td>
                                <td><?php echo $eksper_data->POLICE_FARK_ORT_GECEN_SURE;?></td>
                                <td><?php echo $eksper_data->POLICE_FARK_30_GECEN_SURE;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_servis']){ ?>
                <?php $servis_data = $dashboardClass->servisBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu);?>
                <div class="pc_item">
                        <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">SERVÝS - MODÜL</h3>
                        </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis1"> <?php echo $servis_data->TOPLAM_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $servis_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Ýlk Onaya Gönderilmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis18"> <?php echo $servis_data->ILK_ONAYA_GITMEYENLER;?></a></td>
                                <td><?php echo $servis_data->ILK_ONAYA_GITMEYENLER_ORT_SURE;?></td>
                                <td><?php echo $servis_data->ILK_ONAYA_GITMEYENLER_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Açýk Onaya Gönderilmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis2"> <?php echo $servis_data->SERVISTE_ACIK;?></a></td>
                                <td><?php echo $servis_data->SERVISTE_ACIK_ORT_SURE;?></td>
                                <td><?php echo $servis_data->SERVISTE_ACIK_ORT_SURE_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Açýk Sigorta Mesaj Gelen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis3"> <?php echo $servis_data->ACIK_DOSYA_SIGORTA_KUL_MESAJ;?></a></td>
                                <td><?php echo $servis_data->ACIK_DOSYA_SIGORTA_KUL_MESAJ_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->ACIK_DOSYA_SIGORTA_KUL_MESAJ_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Serviste Kapalý Sigorta Onayý Bekleyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis4"> <?php echo $servis_data->SERVISTE_KAPALI_SIGORTA_ONAY_BEKLIYOR;?></a></td>
                                <td><?php echo $servis_data->SERVISTE_KAPALI_SIGORTA_ONAY_BEKLIYOR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->SERVISTE_KAPALI_SIGORTA_ONAY_BEKLIYOR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Eksper Görevlendirilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis5"> <?php echo $servis_data->EKSPER_GOREVLENDIRILEN;?></a></td>
                                <td><?php echo $servis_data->EKSPER_GOREVLENDIRILEN_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->EKSPER_GOREVLENDIRILEN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Parça Ýþçilik Hareketi Olmayan Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis6"> <?php echo $servis_data->PARCA_GIRILMEMIS_DOSYA_ADET;?></a></td>
                                <td><?php echo $servis_data->PARCA_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->PARCA_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Tedarike Uygun Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis7"> <?php echo $servis_data->SIPARIS_UYGUN_DOSYALAR;?></a></td>
                                <td><?php echo $servis_data->SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->SIPARIS_UYGUN_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Neden Açýk Girilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis15"> <?php echo $servis_data->NEDEN_ACIK_DOSYALAR;?></a></td>
                                <td><?php echo $servis_data->NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->NEDEN_ACIK_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Foto - Evrak Yüklenmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis17"> <?php echo $servis_data->FOTO_EVRAK_YUKLENMEMIS_ADET;?></a></td>
                                <td><?php echo $servis_data->FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->FOTO_EVRAK_YUKLENMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarým Onayý Bekleyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis11"> <?php echo $servis_data->TOTAL_MBL_BEKLEYEN;?></a></td>
                                <td><?php echo $servis_data->TOTAL_MBL_BEKLEYEN_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->TOTAL_MBL_BEKLEYEN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Maðdur Araç Bilgisi Girilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis14"> <?php echo $servis_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS;?></a></td>
                                <td><?php echo $servis_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Yedek Parça (Deðiþim)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis12"> <?php echo $servis_data->DEGISIM_ADET;?></a></td>
                                <td><?php echo $servis_data->DEGISIM_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->DEGISIM_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Yedek Parça (Onarým)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis13"> <?php echo $servis_data->ONARIM_ADET;?></a></td>
                                <td><?php echo $servis_data->ONARIM_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->ONARIM_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Poliçe-Hasar Tarihi Fark <30</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="servis" id="servis16"> <?php echo $servis_data->POLICE_FARK_DOSYA_SAY;?></a></td>
                                <td><?php echo $servis_data->POLICE_FARK_ORT_GECEN_SURE;?></td>
                                <td><?php echo $servis_data->POLICE_FARK_30_GECEN_SURE;?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_faturali']){ ?>
                <?php $faturali_data = $dashboardClass->faturaliBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu);?>
                <div class="pc_item" id="faturali_kullanici" class="pdfNextPage">
                    <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">FATURALI KULLANICI</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali1"> <?php echo $faturali_data->TOPLAM_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $faturali_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Parça Ýþçilik Hareketi Olmayan Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali2"> <?php echo $faturali_data->PARCA_GIRILMEMIS_DOSYA_ADET;?></a></td>
                                <td><?php echo $faturali_data->PARCA_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->PARCA_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Servis Bilgisi Girilmemiþ Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali3"> <?php echo $faturali_data->SERVIS_GIRILMEMIS_DOSYA_ADET;?></a></td>
                                <td><?php echo $faturali_data->SERVIS_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->SERVIS_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Tedarike Uygun Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali4"> <?php echo $faturali_data->SIPARIS_UYGUN_DOSYALAR;?></a></td>
                                <td><?php echo $faturali_data->SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->SIPARIS_UYGUN_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Neden Açýk Girilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali9"> <?php echo $faturali_data->NEDEN_ACIK_DOSYALAR;?></a></td>
                                <td><?php echo $faturali_data->NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->NEDEN_ACIK_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Muallak Giriþi Yapýlmayan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali11"> <?php echo $faturali_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA;?></a></td>
                                <td><?php echo $faturali_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->MULLAK_GIRISI_YAPILMAYAN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Foto-Evrak Yüklenmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali5"> <?php echo $faturali_data->FOTO_EVRAK_YUKLENMEMIS_ADET;?></a></td>
                                <td><?php echo $faturali_data->FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->FOTO_EVRAK_YUKLENMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Maðdur Araç Bilgisi Girilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali8"> <?php echo $faturali_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS;?></a></td>
                                <td><?php echo $faturali_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Yedek Parça (Deðiþim)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali6"> <?php echo $faturali_data->DEGISIM_ADET;?></a></td>
                                <td><?php echo $faturali_data->DEGISIM_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->DEGISIM_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Yedek Parça (Onarým)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali7"> <?php echo $faturali_data->ONARIM_ADET;?></a></td>
                                <td><?php echo $faturali_data->ONARIM_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->ONARIM_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Poliçe-Hasar Tarihi Fark <30</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="faturali" id="faturali10"> <?php echo $faturali_data->POLICE_FARK_DOSYA_SAY;?></a></td>
                                <td><?php echo $faturali_data->POLICE_FARK_ORT_GECEN_SURE;?></td>
                                <td><?php echo $faturali_data->POLICE_FARK_30_GECEN_SURE;?></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>
				
				<?php if($modul_kontrol['modul_teknik_incelemeci']){ ?>
				<?php $teiknikincelemeci_data = $dashboardClass->teknikIncemeciBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu);?>				
				<div class="pc_item">                    						
					<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">TEKNÝK ÝNCELEMECÝ</h3>							
					</div>					
						<table class="table table-hover" id="dev-table">
							<thead>
								<tr>
									<th>Açýklama</th>
									<th>Adet</th>
									<th>Ort. Gün</th>								
									<th>30 Gün+</th>									
								</tr>
							</thead>
							<tbody>							
							<tr>
								<td>Dosya</td>	
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci1"> <?php echo $teiknikincelemeci_data->TOPLAM_DOSYA_SAYISI;?></a></td>																		
								<td><?php echo $teiknikincelemeci_data->DOSYA_ORT_GECEN_SURE;?></td>
								<td><?php echo $teiknikincelemeci_data->DOSYA_30_GECEN_SURE;?></td>
							</tr>																												
							<tr>
								<td>Parça Ýþçilik Hareketi Olmayan Dosyalar</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci2"> <?php echo $teiknikincelemeci_data->PARCA_GIRILMEMIS_DOSYA_ADET;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->PARCA_GIRILMEMIS_ORT_GECEN_SURE;?></td>	
								<td><?php echo $teiknikincelemeci_data->PARCA_GIRILMEMIS_30_ADET;?></td>
							</tr>
							<tr>
								<td>Servis Bilgisi Girilmemiþ Dosyalar</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci3"> <?php echo $teiknikincelemeci_data->SERVIS_GIRILMEMIS_DOSYA_ADET;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->SERVIS_GIRILMEMIS_ORT_GECEN_SURE;?></td>
								<td><?php echo $teiknikincelemeci_data->SERVIS_GIRILMEMIS_30_ADET;?></td>
							</tr>							
							<tr>
								<td>Tedarike Uygun Dosyalar</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci4"> <?php echo $teiknikincelemeci_data->SIPARIS_UYGUN_DOSYALAR;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE;?></td>	
								<td><?php echo $teiknikincelemeci_data->SIPARIS_UYGUN_DOSYALAR_30_ADET;?></td>	
							</tr>	
							<tr>
								<td>Neden Açýk Girilen</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci9"> <?php echo $teiknikincelemeci_data->NEDEN_ACIK_DOSYALAR;?></a></td>																
								<td><?php echo $teiknikincelemeci_data->NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE;?></td>
								<td><?php echo $teiknikincelemeci_data->NEDEN_ACIK_DOSYALAR_30_ADET;?></td>
							</tr>
							<tr>
								<td>Muallak Giriþi Yapýlmayan</td>								
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci11"> <?php echo $teiknikincelemeci_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA_ORT_GECEN_SURE;?></td>								
								<td><?php echo $teiknikincelemeci_data->MULLAK_GIRISI_YAPILMAYAN_30_ADET;?></td>								
							</tr>		
							<tr>
								<td>Foto-Evrak Yüklenmemiþ</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci5"> <?php echo $teiknikincelemeci_data->FOTO_EVRAK_YUKLENMEMIS_ADET;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE;?></td>	
								<td><?php echo $teiknikincelemeci_data->FOTO_EVRAK_YUKLENMEMIS_30_ADET;?></td>		
							</tr>
							<tr>
								<td>Maðdur Araç Bilgisi Girilmeyen</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci8"> <?php echo $teiknikincelemeci_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS;?></a></td>																
								<td><?php echo $teiknikincelemeci_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_ORT_GECEN_SURE;?></td>
								<td><?php echo $teiknikincelemeci_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_30_ADET;?></td>
							</tr>							
							<tr>
								<td>Yedek Parça (Deðiþim)</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci6"> <?php echo $teiknikincelemeci_data->DEGISIM_ADET;?></a></td>																
								<td><?php echo $teiknikincelemeci_data->DEGISIM_ORT_GECEN_SURE;?></td>	
								<td><?php echo $teiknikincelemeci_data->DEGISIM_30_ADET;?></td>										
							</tr>
							<tr>
								<td>Yedek Parça (Onarým)</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci7"> <?php echo $teiknikincelemeci_data->ONARIM_ADET;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->ONARIM_ORT_GECEN_SURE;?></td>	
								<td><?php echo $teiknikincelemeci_data->ONARIM_30_ADET;?></td>						
							</tr>
							<tr>
								<td>Poliçe-Hasar Tarihi Fark <30</td>
								<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="teiknikincelemeci" id="teiknikincelemeci10"> <?php echo $teiknikincelemeci_data->POLICE_FARK_DOSYA_SAY;?></a></td>								
								<td><?php echo $teiknikincelemeci_data->POLICE_FARK_ORT_GECEN_SURE;?></td>							
								<td><?php echo $teiknikincelemeci_data->POLICE_FARK_30_GECEN_SURE;?></td>
							</tr>	
							</tbody>
						</table>												                    
                </div>
				</div>	
				<?php } ?>	

                <?php if($modul_kontrol['modul_cam']){ ?>
                <?php $cam_data  = $dashboardClass->camBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu); ?>
                <div class="pc_item">
                    <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">CAM</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="cam" id="cam1"> <?php echo $cam_data->TOPLAM_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $cam_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $cam_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Parça Ýþçilik Hareketi Olmayan Dosyalar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="cam" id="cam2"> <?php echo $cam_data->PARCA_GIRILMEMIS_DOSYA_ADET;?></a></td>
                                <td><?php echo $cam_data->PARCA_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $cam_data->PARCA_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Neden Açýk Girilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="cam" id="cam9"> <?php echo $cam_data->NEDEN_ACIK_DOSYALAR;?></a></td>
                                <td><?php echo $cam_data->NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $cam_data->NEDEN_ACIK_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Foto-Evrak Yüklenmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="cam" id="cam5"> <?php echo $cam_data->FOTO_EVRAK_YUKLENMEMIS_ADET;?></a></td>
                                <td><?php echo $cam_data->FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $cam_data->FOTO_EVRAK_YUKLENMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Maðdur Araç Bilgisi Girilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="cam" id="cam8"> <?php echo $cam_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS;?></a></td>
                                <td><?php echo $cam_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $cam_data->MAGDUR_ARAC_BILGILERI_GIRILMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Poliçe-Hasar Tarihi Fark <30</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="cam" id="cam10"> <?php echo $cam_data->POLICE_FARK_DOSYA_SAY;?></a></td>
                                <td><?php echo $cam_data->POLICE_FARK_ORT_GECEN_SURE;?></td>
                                <td><?php echo $cam_data->POLICE_FARK_30_GECEN_SURE;?></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_tedarik']){ ?>
                <?php $tedarik_data         = $dashboardClass->tedarikBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu); ?>
                <div class="pc_item">
                    <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">TEDARIK</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Dosya</td>
                                <td>
                                    <div data-toggle="tooltip" data-placement="top" title="Sipariþ Sayýsý" style="float:left;">
                                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik12">
                                            <?php echo $tedarik_data->TOPLAM_DOSYA_SAYISI?>
                                        </a>
                                    </div>
                                </td>
                                <td><?php echo $tedarik_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Sipariþ</td>
                                <td>
                                    <div data-toggle="tooltip" data-placement="top" title="Sipariþ Sayýsý" style="float:left;">
                                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik1">
                                            <?php echo $tedarik_data->TOPLAM_SIPARIS_SAYISI;?>
                                        </a>
                                    </div>
                                </td>
                                <td><?php echo $tedarik_data->SIPARIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->SIPARIS_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Tedarikçiden Kod Beklenen Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik2"> <?php echo $tedarik_data->EKSPER_TALEP_SAY;?></a></td>
                                <td><?php echo $tedarik_data->EKSPER_TALEP_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->EKSPER_TALEP_30_ADET;?></td>
                            </tr>
                            <?php if($SESSION['company_id']==48 || $SESSION['company_id']==70 || $SESSION['company_id']==75 || $SESSION['company_id']==80){?>
                            <tr>
                                <td>Yeni Ýhale</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik3"> <?php echo $tedarik_data->SAY_YENI_IHALE;?></a></td>
                                <td><?php echo $tedarik_data->SAY_YENI_IHALE_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->SAY_YENI_IHALE_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Cevaplanan Ýhale</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik4"> <?php echo $tedarik_data->SAY_CEVAPLANAN_IHALE;?></a></td>
                                <td><?php echo $tedarik_data->SAY_CEVAPLANAN_IHALE_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->SAY_CEVAPLANAN_IHALE_IHALE_30_ADET;?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>Stok Kontrolünde (Cevaplanmamýþ)</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik5"> <?php echo $tedarik_data->STOK_KONTROL_SAY;?></a></td>
                                <td><?php echo $tedarik_data->STOK_KONTROL_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->STOK_KONTROL_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Sevk Tarihi Girilmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik6"> <?php echo $tedarik_data->SEVK_EDILECEK_SAY;?></a></td>
                                <td><?php echo $tedarik_data->SEVK_EDILECEK_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->SEVK_EDILECEK_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Teslim Tarihi Girilmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik7"> <?php echo $tedarik_data->TESLIM_EDILECEK_SAY;?></a></td>
                                <td><?php echo $tedarik_data->TESLIM_EDILECEK_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->TESLIM_EDILECEK_30_ADET;?></td>
                            </tr>
                            <?php if($SESSION['company_id']!=18){ ?>
                            <tr>
                                <td>Fatura Girilmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik8"> <?php echo $tedarik_data->FATURA_SAY;?></a></td>
                                <td><?php echo $tedarik_data->FATURA_GECEN_ORT_SURE;?></td>
                                <td><?php echo $tedarik_data->FATURA_30_ADET;?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>Ýade Onay Bekleyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik9"> <?php echo $tedarik_data->IADE_SAY;?></a></td>
                                <td><?php echo $tedarik_data->IADE_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->IADE_30_ADET;?></td>
                            </tr>
                            <?php if($SESSION['company_id']==75){?>
                            <tr>
                                <td>Yurt Dýþý Ýþaretlenen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="tedarik" id="tedarik10"> <?php echo $tedarik_data->YURT_DISI_SAY;?></a></td>
                                <td><?php echo $tedarik_data->YURT_DISI_ORT_GECEN_SURE;?></td>
                                <td><?php echo $tedarik_data->YURT_DISI_30_GECEN_SURE;?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_mobil']){ ?>
                <?php $mo_data  = $dashboardClass->mobilOnarimBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu); ?>
                <div class="pc_item">
                    <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">MOBÝL ONARIM</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Mobil Onarýma Konu Olan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim1"> <?php echo $mo_data->MO_KONU_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_KONU_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_KONU_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarýma Gönderilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim2"> <?php echo $mo_data->MO_GONDERILEN_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_GONDERILEN_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_GONDERILEN_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarým Cevap Bekleyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim3"> <?php echo $mo_data->MO_CEVAP_BEKLEYEN_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_CEVAP_BEKLEYEN_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_CEVAP_BEKLEYEN_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarýma Gönderilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim4"> <?php echo $mo_data->MO_GONDERILMEYEN_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_GONDERILMEYEN_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_GONDERILMEYEN_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarým Ýptal</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim5"> <?php echo $mo_data->MO_MODUL_IPTAL_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_MODUL_IPTAL_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_MODUL_IPTAL_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarým Onarýlan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim6"> <?php echo $mo_data->MO_ONARILAN_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_ONARILAN_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_ONARILAN_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarým Onarýlmayan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim7"> <?php echo $mo_data->MO_ONARILAMAYAN_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_ONARILAMAYAN_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_ONARILAMAYAN_30_DOSYA_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Mobil Onarým Deðerlendirilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim9"> <?php echo $mo_data->MO_DEGERLENDIRILMEYEN_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_DEGERLENDIRILMEYEN_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_DEGERLENDIRILMEYEN_30_DOSYA_ADET;?></td>
                            </tr>
                            <?php if($SESSION['company_id']==19){?>
                            <tr>
                                <td>Mobil Onarým Ýhale</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="mobilonarim" id="mobilonarim8"> <?php echo $mo_data->MO_IHALE_DOSYA_ADET;?></a></td>
                                <td><?php echo $mo_data->MO_IHALE_ORT_SURE;?></td>
                                <td><?php echo $mo_data->MO_IHALE_30_DOSYA_ADET;?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_arastirmaci']){ ?>
                <?php $arastirmaci_data     = $dashboardClass->arastirmaciBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu);  ?>
                <div class="pc_item">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">ARAÞTIRMACI</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Araþtýrmaya Konu Dosyalarý</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="arastirmaci" id="arastirmaci1"> <?php echo $arastirmaci_data->ARS_VERILMIS_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $arastirmaci_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $arastirmaci_data->ARS_VERILMIS_30_DOSYA_SAYISI;?></td>
                            </tr>
                            <tr>
                                <td>Araþtýrmacýda </td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="arastirmaci" id="arastirmaci2"> <?php echo $arastirmaci_data->ARASTIRMACIDA_OLAN_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $arastirmaci_data->ARS_GECEN_SURE_ORTALAMA;?></td>
                                <td><?php echo $arastirmaci_data->ARASTIRMACIDA_30_OLAN_DOSYA_SAYISI;?></td>
                            </tr>
                            <tr>
                                <td>Denetçide</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="arastirmaci" id="arastirmaci3"> <?php echo $arastirmaci_data->DENETCIDE_OLAN_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $arastirmaci_data->DEN_GECEN_SURE_ORTALAMA;?></td>
                                <td><?php echo $arastirmaci_data->DENETCIDE_30_OLAN_DOSYA_SAYISI;?></td>
                            </tr>
                            <?php /*
                            <tr>
                                <td>Ýptal</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="arastirmaci" id="arastirmaci5"> <?php echo $arastirmaci_data->IPTAL_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $arastirmaci_data->IPTAL_SURE_ORTALAMA;?></td>
                                <td><?php echo $arastirmaci_data->IPTAL_30_OLAN_DOSYA_SAYISI;?></td>
                            </tr>
                            <tr>
                                <td>Tamamlanmýþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="arastirmaci" id="arastirmaci4"> <?php echo $arastirmaci_data->TAMAMLANMIS_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $arastirmaci_data->TAMAMLANMIS_DOSYA_SAYISI_30ORTALAMA;?></td>
                                <td><?php echo $arastirmaci_data->TAMAMLANMIS_30_OLAN_DOSYA_SAYISI;?></td>
                            </tr>
                            */
                            ?>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_uzman']){ ?>
                <?php $uzman_data  = $dashboardClass->uzmanBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu); ?>
                <div class="pc_item">
                   <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">UZMAN</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Atanan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman1"> <?php echo $uzman_data->UZMAN_ATANAN_ADET;?></a></td>
                                <td><?php echo $uzman_data->UZMAN_ATANAN_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->UZMAN_ATANAN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Evrak Yüklenmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman2"> <?php echo $uzman_data->EVRAK_YUKLENMEYEN_ADET;?></a></td>
                                <td><?php echo $uzman_data->EVRAK_YUKLENMEYEN_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->EVRAK_YUKLENMEYEN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Evrak Yüklenen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman3"> <?php echo $uzman_data->EVRAK_YUKLENEN_ADET;?></a></td>
                                <td><?php echo $uzman_data->EVRAK_YUKLENEN_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->EVRAK_YUKLENEN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Araç Serviste Görülmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman7"> <?php echo $uzman_data->ARAC_SERVISTE_GORULMEYENLER;?></a></td>
                                <td><?php echo $uzman_data->ARAC_SERVISTE_GORULMEYENLER_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->ARAC_SERVISTE_GORULMEYENLER_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Birinci Kontrol</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman4"> <?php echo $uzman_data->BIRINCI_KONTROL_ADET;?></a></td>
                                <td><?php echo $uzman_data->BIRINCI_KONTROL_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->BIRINCI_KONTROL_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Ýkinci Kontrol</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman5"> <?php echo $uzman_data->IKINCI_KONTROL_ADET;?></a></td>
                                <td><?php echo $uzman_data->IKINCI_KONTROL_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->IKINCI_KONTROL_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Eksperde Kapalý Uzman onayý Bekleyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="uzman" id="uzman6"> <?php echo $uzman_data->EKSPER_KAPALI_UZMAN_ONAY_BEKLEYEN_ADET;?></a></td>
                                <td><?php echo $uzman_data->EKSPER_KAPALI_UZMAN_ONAY_BEKLEYEN_ORT_SURE;?></td>
                                <td><?php echo $uzman_data->EKSPER_KAPALI_UZMAN_ONAY_BEKLEYEN_30_ADET;?></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_otodisi']){ ?>
                <?php   $otodisi_data  = $dashboardClass->eksperBlokOtodisi($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu);?>
                <div class="pc_item">
                   <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">OTO DIÞI</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi1"> <?php echo $otodisi_data->TOPLAM_DOSYA_SAYISI;?></a></td>
                                <td><?php echo $otodisi_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Ön Rapor Gönderilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi2"> <?php echo $otodisi_data->ON_RAPOR_ADET;?></a></td>
                                <td><?php echo $otodisi_data->ON_RAPOR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->ON_RAPOR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Ön Rapor Gönderilmeyen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi3"> <?php echo $otodisi_data->ON_RAPOR_GONDERILMEYEN_ADET;?></a></td>
                                <td><?php echo $otodisi_data->ON_RAPOR_GONDERILMEYEN_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->ON_RAPOR_GONDERILMEYEN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Muallak Giriþi Yapýlmayan</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi4"> <?php echo $otodisi_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA;?></a></td>
                                <td><?php echo $otodisi_data->MULLAK_GIRISI_YAPILMAYAN_DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->MULLAK_GIRISI_YAPILMAYAN_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Neden Açýk Girilen</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi5"> <?php echo $otodisi_data->NEDEN_ACIK_DOSYALAR;?></a></td>
                                <td><?php echo $otodisi_data->NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->NEDEN_ACIK_DOSYALAR_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Foto - Evrak Yüklenmemiþ</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi6"> <?php echo $otodisi_data->FOTO_EVRAK_YUKLENMEMIS_ADET;?></a></td>
                                <td><?php echo $otodisi_data->FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->FOTO_EVRAK_YUKLENMEMIS_30_ADET;?></td>
                            </tr>
                            <tr>
                                <td>Rücu Ýþaretli</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="otodisi" id="otodisi7"> <?php echo $otodisi_data->RUCU_ISARETLI;?></a></td>
                                <td><?php echo $otodisi_data->RUCU_ISARETLI_ORT_GECEN_SURE;?></td>
                                <td><?php echo $otodisi_data->RUCU_ISARETLI_30_ADET;?></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <?php if($modul_kontrol['modul_alternatif_tamir']){ ?>
                <?php $altamir_data  = $dashboardClass->alternatifTamirBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu);    ?>
                <div class="pc_item">
                    <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">ALTERNATIF TAMÝR</h3>
                    </div>
                        <table class="table table-hover" id="dev-table">
                            <thead>
                                <tr>
                                    <th>Açýklama</th>
                                    <th>Adet</th>
                                    <th>Ort. Gün</th>
                                    <th>30 Gün+</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Dosya</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="alternatif" id="alternatif"> <?php echo $altamir_data->TOPLAM_DOSYA_ADET;?></a></td>
                                <td><?php echo $altamir_data->DOSYA_ORT_GECEN_SURE;?></td>
                                <td><?php echo $altamir_data->DOSYA_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Teklife Çýkacak</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="alternatif" id="alternatif1"> <?php echo $altamir_data->TEKLIFE_CIKACAKLAR;?></a></td>
                                <td><?php echo $altamir_data->TEKLIFE_CIKACAKLAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $altamir_data->TEKLIFE_CIKACAKLAR_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Teklif Toplamada Olanlar</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="alternatif" id="alternatif2"> <?php echo $altamir_data->TEKLIF_TOPLAMADA_OLANLAR;?></a></td>
                                <td><?php echo $altamir_data->TEKLIFE_CIKACAKLAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $altamir_data->TEKLIFE_CIKACAKLAR_30_GECEN_SURE;?></td>
                            </tr>
                            <tr>
                                <td>Teklif Veren Anlaþmalý Serviste Tamirde</td>
                                <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-xl" class="alternatif" id="alternatif6"> <?php echo $altamir_data->TEKLIF_VEREN_ANLASMALI_SERVISTE_TAMIR_OLANLAR;?></a></td>
                                <td><?php echo $altamir_data->TEKLIFE_CIKACAKLAR_ORT_GECEN_SURE;?></td>
                                <td><?php echo $altamir_data->TEKLIFE_CIKACAKLAR_30_GECEN_SURE;?></td>
                            </tr>
                            </tbody>
                        </table>
                </div>
                </div>
                <?php } ?>

                <div class="clear"></div>
    </div>