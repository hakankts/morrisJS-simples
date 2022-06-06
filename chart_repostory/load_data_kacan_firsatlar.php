<?php
require_once("chartKacanFirsatlarClass.php");
$chartClass    = new chartKacanfirsatlarClass();
$modul_kontrol = $chartClass->modul_aktif_kontrol();

ini_set('memory_limit', '32768M');
ini_set('max_execution_time', 0);
set_time_limit(0);
?>
<?php require_once("load_modal.php");?>
                <?php
                    $LO_VAR_OEM_SECILEN_ADET1       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR1= 0;
                    $t_SISTEM_FIYATI1               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT1         = 0;
                    $t_LO_FIYAT1                    = 0;
                    $t_ESD_PARCA_FIYATI1            = 0;
                    $t_GERCEKLESEN_FIYAT1           = 0;
                    $t_ILK_SEC_TED_FIYAT1           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK1     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK1       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK1    = 0;
                    $t_ESD_GERCEKLESEN_FARK1        = 0;

                    $LO_VAR_OEM_SECILEN_ADET2       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR2= 0;
                    $t_SISTEM_FIYATI2               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT2         = 0;
                    $t_LO_FIYAT2                    = 0;
                    $t_ESD_PARCA_FIYATI2            = 0;
                    $t_GERCEKLESEN_FIYAT2           = 0;
                    $t_ILK_SEC_TED_FIYAT2           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK2     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK2       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK2    = 0;
                    $t_ESD_GERCEKLESEN_FARK2        = 0;

                    $LO_VAR_OEM_SECILEN_ADET3       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR3= 0;
                    $t_SISTEM_FIYATI3               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT3         = 0;
                    $t_LO_FIYAT3                    = 0;
                    $t_ESD_PARCA_FIYATI3            = 0;
                    $t_GERCEKLESEN_FIYAT3           = 0;
                    $t_ILK_SEC_TED_FIYAT3           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK3     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK3       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK3    = 0;
                    $t_ESD_GERCEKLESEN_FARK3        = 0;

                    $LO_VAR_OEM_SECILEN_ADET4       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR4= 0;
                    $t_SISTEM_FIYATI4               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT4         = 0;
                    $t_LO_FIYAT4                    = 0;
                    $t_ESD_PARCA_FIYATI4            = 0;
                    $t_GERCEKLESEN_FIYAT4           = 0;
                    $t_ILK_SEC_TED_FIYAT4           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK4     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK4       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK4    = 0;
                    $t_ESD_GERCEKLESEN_FARK4        = 0;

                    $LO_VAR_OEM_SECILEN_ADET5       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR5= 0;
                    $t_SISTEM_FIYATI5               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT5         = 0;
                    $t_LO_FIYAT5                    = 0;
                    $t_ESD_PARCA_FIYATI5            = 0;
                    $t_GERCEKLESEN_FIYAT5           = 0;
                    $t_ILK_SEC_TED_FIYAT5           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK5     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK5       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK5    = 0;
                    $t_ESD_GERCEKLESEN_FARK5        = 0;

                    $LO_VAR_OEM_SECILEN_ADET6       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR6= 0;
                    $t_SISTEM_FIYATI6               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT6         = 0;
                    $t_LO_FIYAT6                    = 0;
                    $t_ESD_PARCA_FIYATI6            = 0;
                    $t_GERCEKLESEN_FIYAT6           = 0;
                    $t_ILK_SEC_TED_FIYAT6           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK6     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK6       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK6    = 0;
                    $t_ESD_GERCEKLESEN_FARK6        = 0;

                    $LO_VAR_OEM_SECILEN_ADET7       = 0;
                    $LO_VAR_OEM_SECILEN_KAYIP_TUTAR7= 0;
                    $t_SISTEM_FIYATI7               = 0;
                    $t_ORJ_ISKONTOLU_FIYAT7         = 0;
                    $t_LO_FIYAT7                    = 0;
                    $t_ESD_PARCA_FIYATI7            = 0;
                    $t_GERCEKLESEN_FIYAT7           = 0;
                    $t_ILK_SEC_TED_FIYAT7           = 0;
                    $t_ILK_SECIM_EN_UYGUN_FARK7     = 0;
                    $t_LOGOSUZ_EN_UYGUN_FARK7       = 0;
                    $t_LOGOSUZ_GERCEKLESEN_FARK7    = 0;
                    $t_ESD_GERCEKLESEN_FARK7        = 0;
                ?>
                <?php
                    $kacan_firsatlar1_arr         = $chartClass->kacanFirsatlar1($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar1_arr as $row){
                            if(round($row['LO_FIYAT'],2)* $row['ADET'] == round($row['GERCEKLESEN_FIYAT'],2)){ continue; } else {$i++;}
                            if(formatla($row['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' || (formatla($row['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' && formatla($row['ESD_GERCEKLESEN_FARK']) >= '0.00')){ continue; }
                            if($SESSION['company_id'] == 23){
                                if((($YIL - $row['MODEL_YILI'] < 10) && $row['SIGORTA_SEKLI'] == 'TRAFÝK' && $row['BEYAN_TIP']=='')) { continue; } else {$i++;}
                            }
                            $LO_VAR_OEM_SECILEN_ADET1           += $row['ADET'];
                            $LO_VAR_OEM_SECILEN_KAYIP_TUTAR1    += $row['LOGOSUZ_GERCEKLESEN_FARK'];

                            $t_SISTEM_FIYATI1               += $row['SISTEM_FIYATI'] * $row['ADET'];
                            $t_ORJ_ISKONTOLU_FIYAT1         += $row['ORJ_ISKONTOLU_FIYAT'];
                            $t_LO_FIYAT1                    += $row['LO_FIYAT'];
                            $t_ADET1                        += $row['ADET'];
                            $t_ESD_PARCA_FIYATI1            += $row['ESD_PARCA_FIYATI'];
                            $t_GERCEKLESEN_FIYAT1           += $row['GERCEKLESEN_FIYAT'];
                            $t_ILK_SEC_TED_FIYAT1           += $row['ILK_SEC_TED_FIYAT'];
                            $t_ILK_SECIM_EN_UYGUN_FARK1     += $row['ILK_SECIM_EN_UYGUN_FARK'];
                            $t_ORJ_GERCEKLESEN_FARK1        += $row['ORJ_GERCEKLESEN_FARK'];
                            $t_LOGOSUZ_GERCEKLESEN_FARK1    += $row['LOGOSUZ_GERCEKLESEN_FARK'];
                            $t_ESD_GERCEKLESEN_FARK1        += $row['ESD_GERCEKLESEN_FARK'];
                    }

                    if($t_LO_FIYAT1 / $t_SISTEM_FIYATI1>0) { $A1_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT1 / $t_SISTEM_FIYATI1) * 100); } else { $A1_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT1 / $t_SISTEM_FIYATI1>0)   { $A1_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT1 / $t_SISTEM_FIYATI1) * 100); } else { $A1_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT1>0)   { $A1_KAYIP_KAZANC_ORAN = formatla($A1_IDEAL_ISKONTO - $A1_GERCEKLESEN_ISKONTO); } else { $A1_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar2_arr         = $chartClass->kacanFirsatlar2($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar2_arr as $row2){
                        if(round($row2['LO_FIYAT'],2) * $row2['ADET'] == round($row2['GERCEKLESEN_FIYAT'],2)) { continue; } else {$i++;}
                        if(formatla($row2['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' || (formatla($row2['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' && formatla($row2['ESD_GERCEKLESEN_FARK']) >= '0.00')){ continue; }
                        if($SESSION['company_id'] == 23){
                            if((($YIL - $row2['MODEL_YILI'] < 10) && $row2['SIGORTA_SEKLI'] == 'TRAFÝK' && $row2['BEYAN_TIP']=='')) { continue; } else {$i++;}
                        }

                        $LO_VAR_OEM_SECILEN_ADET2           += $row2['ADET'];
                        $LO_VAR_OEM_SECILEN_KAYIP_TUTAR2    += $row2['LOGOSUZ_GERCEKLESEN_FARK'];

                        $t_SISTEM_FIYATI2               += $row2['SISTEM_FIYATI'] * $row2['ADET'];
                        $t_ORJ_ISKONTOLU_FIYAT2         += $row2['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYAT2                    += $row2['LO_FIYAT'];
                        $t_ADET2                        += $row2['ADET'];
                        $t_ESD_PARCA_FIYATI2            += $row2['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYAT2           += $row2['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYAT2           += $row2['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARK2     += $row2['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARK2        += $row2['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARK2    += $row2['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARK2        += $row2['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYAT2 / $t_SISTEM_FIYATI2>0) { $A2_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT2 / $t_SISTEM_FIYATI2) * 100); } else { $A2_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT2 / $t_SISTEM_FIYATI2>0)   { $A2_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT2 / $t_SISTEM_FIYATI2) * 100); } else { $A2_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT2>0)   { $A2_KAYIP_KAZANC_ORAN = formatla($A2_IDEAL_ISKONTO - $A2_GERCEKLESEN_ISKONTO); } else { $A2_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar3_arr         = $chartClass->kacanFirsatlar3($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar3_arr as $row3){
                        if(round($row3['LO_FIYAT'],2) * $row3['ADET'] == round($row3['GERCEKLESEN_FIYAT'],2)){ continue; } else {$i++;}
                        if(formatla($row3['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' || (formatla($row3['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' && formatla($row3['ESD_GERCEKLESEN_FARK']) >= '0.00')){ continue; } else {$i++;}
                            if($SESSION['company_id'] == 23){
                                if((($YIL - $row3['MODEL_YILI'] < 10) && $row3['SIGORTA_SEKLI'] == 'TRAFÝK' && $row3['BEYAN_TIP']=='')) { continue; } else {$i++;}
                            }

                        $LO_VAR_OEM_SECILEN_ADET3           += $row3['ADET'];
                        $LO_VAR_OEM_SECILEN_KAYIP_TUTAR3    += $row3['LOGOSUZ_GERCEKLESEN_FARK'];

                        $t_SISTEM_FIYATI3               += $row3['SISTEM_FIYATI'] * $row3['ADET'];
                        $t_ORJ_ISKONTOLU_FIYAT3         += $row3['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYAT3                    += $row3['LO_FIYAT'];
                        $t_ADET3                        += $row3['ADET'];
                        $t_ESD_PARCA_FIYATI3            += $row3['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYAT3           += $row3['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYAT3           += $row3['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARK3     += $row3['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARK3        += $row3['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARK3    += $row3['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARK3        += $row3['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYAT3 / $t_SISTEM_FIYATI3>0) { $A3_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT3 / $t_SISTEM_FIYATI3) * 100); } else { $A3_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT3 / $t_SISTEM_FIYATI3>0)   { $A3_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT3 / $t_SISTEM_FIYATI3) * 100); } else { $A3_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT3>0)   { $A3_KAYIP_KAZANC_ORAN = formatla($A3_IDEAL_ISKONTO - $A3_GERCEKLESEN_ISKONTO); } else { $A3_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar4_arr         = $chartClass->kacanFirsatlar4($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar4_arr as $row4){
                        if(round($row4['LO_FIYAT'],2) * $row4['ADET'] == round($row4['GERCEKLESEN_FIYAT'],2)){ continue; } else {$i++;}
                        if(formatla($row4['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' || (formatla($row4['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' && formatla($row4['ESD_GERCEKLESEN_FARK']) >= '0.00')){ continue; }
                        if($SESSION['company_id'] == 23){
                            if((($YIL - $row4['MODEL_YILI'] < 10) && $row4['SIGORTA_SEKLI'] == 'TRAFÝK' && $row4['BEYAN_TIP']=='')) { continue; } else {$i++;}
                        }

                        $LO_VAR_OEM_SECILEN_ADET4           += $row4['ADET'];
                        $LO_VAR_OEM_SECILEN_KAYIP_TUTAR4    += $row4['LOGOSUZ_GERCEKLESEN_FARK'];

                        $t_SISTEM_FIYATI4               += $row4['SISTEM_FIYATI'] * $row4['ADET'];
                        $t_ORJ_ISKONTOLU_FIYAT4         += $row4['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYAT4                    += $row4['LO_FIYAT'];
                        $t_ADET4                        += $row4['ADET'];
                        $t_ESD_PARCA_FIYATI4            += $row4['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYAT4           += $row4['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYAT4           += $row4['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARK4     += $row4['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARK4        += $row4['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARK4    += $row4['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARK4        += $row4['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYAT4 / $t_SISTEM_FIYATI4>0) { $A4_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT4 / $t_SISTEM_FIYATI4) * 100); } else { $A4_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT4 / $t_SISTEM_FIYATI4>0)   { $A4_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT4 / $t_SISTEM_FIYATI4) * 100); } else { $A4_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT4>0)   { $A4_KAYIP_KAZANC_ORAN = formatla($A4_IDEAL_ISKONTO - $A4_GERCEKLESEN_ISKONTO); } else { $A4_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar5_arr         = $chartClass->kacanFirsatlar5($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar5_arr as $row5){
                        if(round($row5['LO_FIYAT'],2) * $row5['ADET'] == round($row5['GERCEKLESEN_FIYAT'],2)){ continue; }
                        if(round($row5['LOGOSUZ_GERCEKLESEN_FARK'],2) >= '0.00' || (round($row5['LOGOSUZ_GERCEKLESEN_FARK'],2) >= '0.00' && round($row5['ESD_GERCEKLESEN_FARK'],2) >= '0.00')){ continue; } else {$i++;}
                        if($row5['STOK_DURUMU'] != 'STOKTA VAR'){ continue; } else {$i++;}
                        if($SESSION['company_id'] == 23){
                            if((($YIL - $row5['MODEL_YILI'] < 10) && $row5['SIGORTA_SEKLI'] == 'TRAFÝK' && $row5['BEYAN_TIP']=='')) { continue; } else {$i++;}
                        }

                        $LO_VAR_OEM_SECILEN_ADET5           += $row5['ADET'];
                        $LO_VAR_OEM_SECILEN_KAYIP_TUTAR5    += $row5['LOGOSUZ_GERCEKLESEN_FARK'];

                        $t_SISTEM_FIYATI5               += $row5['SISTEM_FIYATI'] * $row5['ADET'];
                        $t_ORJ_ISKONTOLU_FIYAT5         += $row5['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYAT5                    += $row5['LO_FIYAT'];
                        $t_ADET5                        += $row5['ADET'];
                        $t_ESD_PARCA_FIYATI5            += $row5['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYAT5           += $row5['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYAT5           += $row5['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARK5     += $row5['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARK5        += $row5['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARK5    += $row5['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARK5        += $row5['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYAT5 / $t_SISTEM_FIYATI5>0) { $A5_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT5 / $t_SISTEM_FIYATI5) * 100); } else { $A5_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT5 / $t_SISTEM_FIYATI5>0)   { $A5_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT5 / $t_SISTEM_FIYATI5) * 100); } else { $A5_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT5>0)   { $A5_KAYIP_KAZANC_ORAN = formatla($A5_IDEAL_ISKONTO - $A5_GERCEKLESEN_ISKONTO); } else { $A5_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar6_arr         = $chartClass->kacanFirsatlar6($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar6_arr as $row6){
                        if(round($row6['LO_FIYAT'],2) * $row6['ADET'] == round($row6['GERCEKLESEN_FIYAT'],2)){ continue; } else {$i++;}
                        if($row6['LOGOSUZ_GERCEKLESEN_FARK'] >= '0.00' || ($row6['LOGOSUZ_GERCEKLESEN_FARK'] >= '0.00' && $row6['ESD_GERCEKLESEN_FARK'] >= '0.00')){ continue; } else {$i++;}
                        if($row6['STOK_DURUMU'] != 'STOKTA VAR'){ continue; } else {$i++;}
                        if($SESSION['company_id'] == 23){
                            if((($YIL - $row6['MODEL_YILI'] < 10) && $row6['SIGORTA_SEKLI'] == 'TRAFÝK' && $row6['BEYAN_TIP']=='')) { continue; } else {$i++;}
                        }

                        $LO_VAR_OEM_SECILEN_ADET6           += $row6['ADET'];
                        $LO_VAR_OEM_SECILEN_KAYIP_TUTAR6    += $row6['LOGOSUZ_GERCEKLESEN_FARK'];

                        $t_SISTEM_FIYATI6               += $row6['SISTEM_FIYATI'] * $row6['ADET'];
                        $t_ORJ_ISKONTOLU_FIYAT6         += $row6['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYAT6                    += $row6['LO_FIYAT'];
                        $t_ADET6                        += $row6['ADET'];
                        $t_ESD_PARCA_FIYATI6            += $row6['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYAT6           += $row6['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYAT6           += $row6['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARK6     += $row6['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARK6        += $row6['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARK6    += $row6['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARK6        += $row6['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYAT6 / $t_SISTEM_FIYATI6>0) { $A6_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT6 / $t_SISTEM_FIYATI6) * 100); } else { $A6_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT6 / $t_SISTEM_FIYATI6>0)   { $A6_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT6 / $t_SISTEM_FIYATI6) * 100); } else { $A6_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT6>0)   { $A6_KAYIP_KAZANC_ORAN = formatla($A6_IDEAL_ISKONTO - $A6_GERCEKLESEN_ISKONTO); } else { $A6_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar7_arr = $chartClass->kacanFirsatlar7($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar7_arr as $row7){
                        if(round($row7['LO_FIYAT'],2) * $row7['ADET'] == round($row7['GERCEKLESEN_FIYAT'],2)){ continue; } else {$i++;}
                        if(formatla($row7['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' || (formatla($row7['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' && formatla($row7['ESD_GERCEKLESEN_FARK']) >= '0.00')){ continue; }
                        if($row7['STOK_DURUMU'] == 'STOKTA VAR'){ continue; } else {$i++;}
                        if(trim($row7['SONUC']) == 'T.DISI' && trim($row7['GERCEKLESEN_PARCA_TIPI']) == ""){ continue; } else {$i++;}
                        if($SESSION['company_id'] == 23){
                            if((($YIL - $row7['MODEL_YILI'] < 10) && $row7['SIGORTA_SEKLI'] == 'TRAFÝK' && $row7['BEYAN_TIP']=='')) { continue; } else {$i++;}
                        }
                        $LO_VAR_OEM_SECILEN_ADET7           += $row7['ADET'];
                        $LO_VAR_OEM_SECILEN_KAYIP_TUTAR7    += $row7['LOGOSUZ_GERCEKLESEN_FARK'];

                        $t_SISTEM_FIYATI7               += $row7['SISTEM_FIYATI'] * $row7['ADET'];
                        $t_ORJ_ISKONTOLU_FIYAT7         += $row7['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYAT7                    += $row7['LO_FIYAT'];
                        $t_ADET7                        += $row7['ADET'];
                        $t_ESD_PARCA_FIYATI7            += $row7['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYAT7           += $row7['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYAT7           += $row7['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARK7     += $row7['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARK7        += $row7['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARK7    += $row7['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARK7        += $row7['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYAT7 / $t_SISTEM_FIYATI7>0) { $A7_IDEAL_ISKONTO = formatla((1-$t_LO_FIYAT7 / $t_SISTEM_FIYATI7) * 100); } else { $A7_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYAT7 / $t_SISTEM_FIYATI7>0)   { $A7_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYAT7 / $t_SISTEM_FIYATI7) * 100); } else { $A7_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYAT7>0)   { $A7_KAYIP_KAZANC_ORAN = formatla($A7_IDEAL_ISKONTO - $A7_GERCEKLESEN_ISKONTO); } else { $A7_KAYIP_KAZANC_ORAN = "0"; }

                    $kacan_firsatlar8_arr         = $chartClass->kacanFirsatlar8($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip);
                    foreach($kacan_firsatlar8_arr as $rowe){
                        if(round($rowe['LO_FIYAT'],2) * $rowe['ADET'] == round($rowe['GERCEKLESEN_FIYAT'],2)){ continue; }
                        if(formatla($rowe['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' || (formatla($rowe['LOGOSUZ_GERCEKLESEN_FARK']) >= '0.00' && formatla($rowe['ESD_GERCEKLESEN_FARK']) >= '0.00')){ continue; }
                        if(trim($rowe['SONUC']) == 'T.DISI' && trim($rowe['GERCEKLESEN_PARCA_TIPI']) == ""){ continue; } else {$i++;}
                        if($SESSION['company_id'] == 23){
                            if((($YIL - $rowe['MODEL_YILI'] < 10) && $rowe['SIGORTA_SEKLI'] == 'TRAFÝK' && $rowe['BEYAN_TIP']=='')) { continue; }
                        }

                        $EKSPER_FARK                    += $rowe['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_SISTEM_FIYATIE               += $rowe['SISTEM_FIYATI'] * $rowe['ADET'];
                        $t_ORJ_ISKONTOLU_FIYATE         += $rowe['ORJ_ISKONTOLU_FIYAT'];
                        $t_LO_FIYATE                    += $rowe['LO_FIYAT'];
                        $t_ADETE                        += $rowe['ADET'];
                        $t_ESD_PARCA_FIYATIE            += $rowe['ESD_PARCA_FIYATI'];
                        $t_GERCEKLESEN_FIYATE           += $rowe['GERCEKLESEN_FIYAT'];
                        $t_ILK_SEC_TED_FIYATE           += $rowe['ILK_SEC_TED_FIYAT'];
                        $t_ILK_SECIM_EN_UYGUN_FARKE     += $rowe['ILK_SECIM_EN_UYGUN_FARK'];
                        $t_ORJ_GERCEKLESEN_FARKE        += $rowe['ORJ_GERCEKLESEN_FARK'];
                        $t_LOGOSUZ_GERCEKLESEN_FARKE    += $rowe['LOGOSUZ_GERCEKLESEN_FARK'];
                        $t_ESD_GERCEKLESEN_FARKE        += $rowe['ESD_GERCEKLESEN_FARK'];
                    }
                    if($t_LO_FIYATE / $t_SISTEM_FIYATIE>0) { $AE_IDEAL_ISKONTO = ((1-$t_LO_FIYATE / $t_SISTEM_FIYATIE) * 100); } else { $AE_IDEAL_ISKONTO = "0";}
                    if($t_GERCEKLESEN_FIYATE / $t_SISTEM_FIYATIE>0)   { $AE_GERCEKLESEN_ISKONTO = formatla((1-$t_GERCEKLESEN_FIYATE / $t_SISTEM_FIYATIE) * 100); } else { $AE_GERCEKLESEN_ISKONTO = "0"; }
                    if($t_LO_FIYATE>0)   { $AE_KAYIP_KAZANC_ORAN = ($AE_IDEAL_ISKONTO - $AE_GERCEKLESEN_ISKONTO); } else { $AE_KAYIP_KAZANC_ORAN = "0"; }
                ?>

                <?php
                    $pie_data_toplam_kacan_yuzde  .= "{ label: '".dil_dashboard('Kaçan Tüm Fýrsatlar')."', value: ". (formatla(($AE_KAYIP_KAZANC_ORAN) )) ." }, ";
                    $pie_data_toplam_kacan_tutar  .= "{ label: '".dil_dashboard('Kayýp Kazanç Tutarý')."', value: ". ((round($EKSPER_FARK,2) )) ." }, ";

                    $aciklama1 = addslashes(dil_dashboard("Logosuz Orijinali Olan Ancak Orijinal Seçilen"));
                    $aciklama2 = addslashes(dil_dashboard("Eþdeðeri Olan Ancak Orijinal Seçilen"));
                    $aciklama3 = addslashes(dil_dashboard("Doðrudan Servise Býrakýlan"));
                    $aciklama4 = addslashes(dil_dashboard("Tedarik Dýþý"));
                    $aciklama5 = addslashes(dil_dashboard("Tedarikçiye En Ucuz Parça Sipariþi Gönderilmeyen Logosuz Gerçekleþen"));
                    $aciklama6 = addslashes(dil_dashboard("Tedarikçiye En Ucuz Parça Sipariþi Gönderilmeyen Eþdeðer Gerçekleþen"));
                    $aciklama7 = addslashes(dil_dashboard("Tedarikçinin Yok Cevaplamasý Sebebi ile Kaynaklanan Kayýplar"));

                    $bar_data_adet .= "{ aciklama:'".$aciklama1."', adet:'".$LO_VAR_OEM_SECILEN_ADET1."' }, ";
                    $bar_data_adet .= "{ aciklama:'".$aciklama2."', adet:'".$LO_VAR_OEM_SECILEN_ADET2."' }, ";
                    $bar_data_adet .= "{ aciklama:'".$aciklama3."', adet:'".$LO_VAR_OEM_SECILEN_ADET3."' }, ";
                    $bar_data_adet .= "{ aciklama:'".$aciklama4."', adet:'".$LO_VAR_OEM_SECILEN_ADET4."' }, ";
                    $bar_data_adet .= "{ aciklama:'".$aciklama5."', adet:'".$LO_VAR_OEM_SECILEN_ADET5."' }, ";
                    $bar_data_adet .= "{ aciklama:'".$aciklama6."', adet:'".$LO_VAR_OEM_SECILEN_ADET6."' }, ";
                    $bar_data_adet .= "{ aciklama:'".$aciklama7."', adet:'".$LO_VAR_OEM_SECILEN_ADET7."' }, ";

                    $bar_data_oran .= "{ label:'".$aciklama1."', value:'".$A1_KAYIP_KAZANC_ORAN."' }, ";
                    $bar_data_oran .= "{ label:'".$aciklama2."', value:'".$A2_KAYIP_KAZANC_ORAN."' }, ";
                    $bar_data_oran .= "{ label:'".$aciklama3."', value:'".$A3_KAYIP_KAZANC_ORAN."' }, ";
                    $bar_data_oran .= "{ label:'".$aciklama4."', value:'".$A4_KAYIP_KAZANC_ORAN."' }, ";
                    $bar_data_oran .= "{ label:'".$aciklama5."', value:'".$A5_KAYIP_KAZANC_ORAN."' }, ";
                    $bar_data_oran .= "{ label:'".$aciklama6."', value:'".$A6_KAYIP_KAZANC_ORAN."' }, ";
                    $bar_data_oran .= "{ label:'".$aciklama7."', value:'".$A7_KAYIP_KAZANC_ORAN."' }, ";

                    $bar_data_tutar .= "{ aciklama:'".$aciklama1."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR1,2)."' }, ";
                    $bar_data_tutar .= "{ aciklama:'".$aciklama2."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR2,2)."' }, ";
                    $bar_data_tutar .= "{ aciklama:'".$aciklama3."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR3,2)."' }, ";
                    $bar_data_tutar .= "{ aciklama:'".$aciklama4."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR4,2)."' }, ";
                    $bar_data_tutar .= "{ aciklama:'".$aciklama5."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR5,2)."' }, ";
                    $bar_data_tutar .= "{ aciklama:'".$aciklama6."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR6,2)."' }, ";
                    $bar_data_tutar .= "{ aciklama:'".$aciklama7."', tutar:'".round($LO_VAR_OEM_SECILEN_KAYIP_TUTAR7,2)."' }, ";
                ?>
        <div class="card">
            <div class="col-lg-6 col-lg-6-pdf">
                <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                    <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                        <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Toplam Kayýp Ýskonto (Ýdeal Ýskonto-Gerçekleþen Ýskonto) %")?></p>
                    </div>
                    <div id='chart_pie_1' class='chart_morris'></div>
                    <div id='chart_pie_1_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                </div>
            </div>

            <div class="col-lg-6 col-lg-6-pdf">
                <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                    <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                        <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Tutar Toplamý")?></p>
                    </div>
                    <div id='chart_pie_2' class='chart_morris'></div>
                    <div id='chart_pie_2_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                </div>
            </div>

            <div class="col-lg-6 col-lg-6-pdf">
                <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Yedek Parça Adet")?></p>
                        </div>
                        <div id='chart_hist_yp_adet' class='chart_morris'></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-lg-6-pdf">
                <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                    <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                        <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Kayýp Kazanç Oraný % (Ýdeal Ýskonto-Gerçekleþen Ýskonto)")?></p>
                    </div>
                    <div id='chart_pie_3' class='chart_morris'></div>
                    <div id='chart_pie_3_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                </div>
            </div>

            <div class="col-lg-12">
                <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                    <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                        <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Kayýp Kazanç Tutarý")?></p>
                    </div>
                    <div id='chart_hist_yp_tutar' class='chart_morris'></div>
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

        pie_data_toplam_kacan       = [ <?=$pie_data_toplam_kacan_yuzde; ?> ];
        pie_data_toplam_kacan_tutar = [ <?=$pie_data_toplam_kacan_tutar; ?> ];
        pie_data_oran               = [ <?=$bar_data_oran; ?> ];

        Morris.Donut({
            element   : 'chart_pie_1',
            data      : pie_data_toplam_kacan,
            formatter : function (x) { return x + "%"}
        }).options.colors.forEach(function(color, a) {
            if (pie_data_toplam_kacan[a] != undefined) {
                var node = document.createElement('span');
                node.innerHTML += '<span style="color:' + color + '"><i style="margin-left: 15px;" class="fas fa-square"></i> ' + pie_data_toplam_kacan[a].label + '</span>';
                document.getElementById("chart_pie_1_legend").appendChild(node);
            }
        });

        Morris.Donut({
            element    : 'chart_pie_2',
            data       : pie_data_toplam_kacan_tutar,
            labelColor : '#F00',
        }).options.colors.forEach(function(color, a) {
            if (pie_data_toplam_kacan_tutar[a] != undefined) {
                var node = document.createElement('span');
                node.innerHTML += '<span style="color:' + color + '"><i style="margin-left: 15px;" class="fas fa-square"></i> ' + pie_data_toplam_kacan_tutar[a].label + '</span>';
                document.getElementById("chart_pie_2_legend").appendChild(node);
            }
        });

        /*
        Morris.Donut({
            element   : 'chart_pie_3',
            data      : pie_data_oran,
            colors    : ['#F6C244', '#53A351', '#CB444A', '#222529', '#2F7DF6', '#00F3FF', '#D500FF']
        }).options.colors.forEach(function(color, a) {
            if (pie_data_oran[a] != undefined) {
                var node = document.createElement('span');
                node.innerHTML += '<span style="color:' + color + '"><i style="margin-left: 15px;" class="fas fa-square"></i> ' + pie_data_oran[a].label + '</span>';
                document.getElementById("chart_pie_3_legend").appendChild(node);
            }
        });
        */

        Morris.Bar({
            element   : 'chart_pie_3',
            dataLabels : true,
            data       : pie_data_oran,
            xkey       : 'label',
            ykeys      : ['value'],
            labels     : ['<?=dil_dashboard("Adet")?>'],
            barColors  : ['#d6af50', '#5e2590'],
            // barColors  : ['#F6C244', '#53A351', '#CB444A', '#222529', '#2F7DF6', '#00F3FF', '#D500FF'],
            horizontal : true,
            stacked    : true,
        });

        Morris.Bar({
            element    : 'chart_hist_yp_adet',
            dataLabels : true,
            data       : [<?php echo $bar_data_adet; ?>],
            xkey       : 'aciklama',
            ykeys      : ['adet'],
            labels     : ['<?=dil_dashboard("Adet")?>'],
            barColors  : ['#d6af50', '#5e2590'],
            horizontal : true,
            stacked    : true,
        });

        Morris.Bar({
            element     : 'chart_hist_yp_tutar',
            dataLabels  : true,
            data        : [<?php echo $bar_data_tutar; ?>],
            xkey        : 'aciklama',
            ykeys       : ['tutar'],
            labels      : ['<?=dil_dashboard("Tutar")?>'],
            barColors  : ['#d6af50', '#5e2590'],
            horizontal  : true,
            stacked     : true,
        });

        /*
        $("#chart_hist_yp_adet svg text[text-anchor=start] tspan, #chart_hist_yp_tutar svg text[text-anchor=start] tspan").css({
            "font-family" : "'Assistant' !important",
            "padding" : "3%",
            "color": "black",
            "font-size": "15px",
            "font-weight": "bold"
        });
        */
    </script>