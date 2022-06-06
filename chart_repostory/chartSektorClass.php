<?php
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php");
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");
	
	class chartSektorClass extends kullaniciKontrolClass{

		protected $cdb;
		protected $hasarTable;					
		protected $companyId;			
		protected $kullaniciKriter;	
		protected $otodisiKullaniciKriter;
		protected $OTODISI_DOSYA_SORUMLUSU;
		protected $DEF_DOSYA_SORUMLUSU;
		function __construct()
		{
			global $SESSION;
			require_valid_login();
			$this->cdb 				= new db_layer;			
			$this->hasarTable   	= get_hasar_table();									
			$this->companyId 		= OAConf::COMPANY_ID;						
			$this->USER_NAME		= $SESSION['username'];  			
			$this->USER_ID			= $SESSION['user_id'];  						
			$this->kullaniciKontrol();				
						
		}		

		function sektorTopBlok($donem, $brans){						
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
				
			if($donem!=NULL && $donem!=-1){ 
				$kriter .=  " AND DONEM='$donem'";
			}			
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND SIGORTA_SEKLI='$brans'";
			}
			else{
				$kriter .=  " AND SIGORTA_SEKLI='0'";
			}
			/*			
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
			
			if(($kullanim_sekli!=NULL && $kullanim_sekli!='-1')){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='$kullanim_sekli'";
			}
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
			if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
			if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
			if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
			if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
			if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
			if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
			if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}
			*/
			
			$sql = "
				SELECT					
					ID,
					FIRMA,
					DONEM,
					SUM(TOPLAM_DOSYA_ADET) AS TOPLAM_DOSYA_ADET,
					SUM(TOPLAM_PARCA_KALEM_ADET) AS TOPLAM_PARCA_KALEM_ADET,
					SUM(TOPLAM_TEDARIK_PARCA_ADET) AS TOPLAM_TEDARIK_PARCA_ADET,
					SUM(TOPLAM_SERVIS_PARCA_ADET) AS TOPLAM_SERVIS_PARCA_ADET,
					SUM(TOPLAM_TEDARIK_ORJ_PARCA_ADET) AS TOPLAM_TEDARIK_ORJ_PARCA_ADET,
					SUM(TOPLAM_TEDARIK_LO_PARCA_ADET) AS TOPLAM_TEDARIK_LO_PARCA_ADET,
					SUM(TOPLAM_TEDARIK_ESD_PARCA_ADET) AS TOPLAM_TEDARIK_ESD_PARCA_ADET,
					SUM(TOPLAM_SERVIS_ORJ_PARCA_ADET) AS TOPLAM_SERVIS_ORJ_PARCA_ADET,
					SUM(TOPLAM_SERVIS_ESD_PARCA_ADET) AS TOPLAM_SERVIS_ESD_PARCA_ADET,
					SUM(TOPLAM_TD_ORJ_PARCA_ADET) AS TOPLAM_TD_ORJ_PARCA_ADET,
					SUM(TOPLAM_TD_ESD_PARCA_ADET) AS TOPLAM_TD_ESD_PARCA_ADET,
					SUM(TED_SISTEM_TUTAR) AS TED_SISTEM_TUTAR,
					SUM(TED_ISK_TUTAR) AS TED_ISK_TUTAR,
					SUM(TED_KAZANDIRILAN) AS TED_KAZANDIRILAN,
					SUM(TED_ORJ_SISTEM_TUTAR) AS TED_ORJ_SISTEM_TUTAR,
					SUM(TED_ORJ_ISK_TUTAR) AS TED_ORJ_ISK_TUTAR,
					SUM(TED_ORJ_KAZANDIRILAN) AS TED_ORJ_KAZANDIRILAN,
					SUM(TED_LO_SISTEM_TUTAR) AS TED_LO_SISTEM_TUTAR,
					SUM(TED_LO_ISK_TUTAR) AS TED_LO_ISK_TUTAR,
					SUM(TED_LO_KAZANDIRILAN) AS TED_LO_KAZANDIRILAN,
					SUM(TED_ESD_SISTEM_TUTAR) AS TED_ESD_SISTEM_TUTAR,
					SUM(TED_ESD_ISK_TUTAR) AS TED_ESD_ISK_TUTAR,
					SUM(TED_ESD_KAZANDIRILAN) AS TED_ESD_KAZANDIRILAN,
					SUM(SERVIS_SISTEM_TUTAR) AS SERVIS_SISTEM_TUTAR,
					SUM(SERVIS_ISK_TUTAR) AS SERVIS_ISK_TUTAR,
					SUM(SERVIS_KAZANDIRILAN) AS SERVIS_KAZANDIRILAN,
					SUM(SERVIS_ORJ_SISTEM_TUTAR) AS SERVIS_ORJ_SISTEM_TUTAR,
					SUM(SERVIS_ORJ_ISK_TUTAR) AS SERVIS_ORJ_ISK_TUTAR,
					SUM(SERVIS_ORJ_KAZANDIRILAN) AS SERVIS_ORJ_KAZANDIRILAN,
					SUM(SERVIS_ESD_SISTEM_TUTAR) AS SERVIS_ESD_SISTEM_TUTAR,
					SUM(SERVIS_ESD_ISK_TUTAR) AS SERVIS_ESD_ISK_TUTAR,
					SUM(SERVIS_ESD_KAZANDIRILAN) AS SERVIS_ESD_KAZANDIRILAN,
					SUM(TD_ORJ_SISTEM_TUTAR) AS TD_ORJ_SISTEM_TUTAR,
					SUM(TD_ORJ_ISK_TUTAR) AS TD_ORJ_ISK_TUTAR,
					SUM(TD_ORJ_KAZANDIRILAN) AS TD_ORJ_KAZANDIRILAN,
					SUM(TD_ESD_SISTEM_TUTAR) AS TD_ESD_SISTEM_TUTAR,
					SUM(TD_ESD_ISK_TUTAR) AS TD_ESD_ISK_TUTAR,
					SUM(TD_ESD_KAZANDIRILAN) AS TD_ESD_KAZANDIRILAN,
					AVG(SEVK_ORT_GECEN_SURE) AS SEVK_ORT_GECEN_SURE
				FROM
					SEKTOR_TEDARIK_ANALIZ	
				WHERE
					1
					$kriter
			";
			//if(dbg()) { echo($sql); die; } 
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
			$row = mysql_fetch_object($result);
			return $row;	
		}
		
		
		function modul_aktif_kontrol(){
			
			$modul_eksper				= false;
			$modul_servis				= false;
			$modul_faturali 			= false; 
			$modul_cam 					= false; 
			$modul_tedarik				= false; 
			$modul_mobil				= false; 			
			$modul_otodisi 				= false;
			$modul_arastirmaci 			= false;
			$modul_uzman 				= false;
			$modul_alternatif_tamir 	= false;
			
			//firma id lere göre aktif mi kontrol ediliyor.
			$eksper_aktif_modul_kontrol				= array(18,19,20,23,24,27,28,30,32,37,42,44,47,48,49,50,51,55,56,58,60,64,70,75,80,143,144,145,156,157);
			$servis_aktif_modul_kontrol				= array(18,19,20,27,28,30,37,42,44,47,50,51,55,56,60,64,75,143,144,145,156,157);
			$faturali_aktif_modul_kontrol			= array(18,19,20,24,28,30,32,37,42,44,47,48,49,50,51,55,56,58,60,64,70,75,80,143,144,145,156,157);
			$cam_aktif_modul_kontrol				= array(19,20,24,27,28,30,32,37,42,44,47,48,50,55,56,58,64,75,80,143,144,145,156,157);
			$tedarik_aktif_modul_kontrol			= array(18,19,20,23,24,27,28,30,32,37,42,44,47,48,49,50,51,55,56,58,60,64,70,75,80,143,144,145,156,157);
			$mobil_aktif_modul_kontrol				= array(18,19,20,23,24,27,28,30,32,37,42,44,47,48,49,50,51,55,56,58,60,64,70,75,80,143,144,145,156,157);
			$otodisi_aktif_modul_kontrol 			= array(27,18,30,28,24,51,56,19,23,20,37,32,70,143,55,47,75,58,64);			
			$arastirmaci_aktif_modul_kontrol 		= array(19,20,23,24,28,32,42,44,47,48,51,55,56,58,60,64,80);
			$uzman_aktif_modul_kontrol 				= array(27,49,24,19,23,20,50,37,32,70,55,47,75);
			$alternatif_tamir_aktif_modul_kontrol	= array(20,30,44);
			
			
			if(in_array($this->companyId,$eksper_aktif_modul_kontrol)) 			{ $modul_eksper = true; }
			if(in_array($this->companyId,$servis_aktif_modul_kontrol)) 			{ $modul_servis = true; }
			if(in_array($this->companyId,$faturali_aktif_modul_kontrol)) 		{ $modul_faturali = true; }			
			if(in_array($this->companyId,$cam_aktif_modul_kontrol)) 			{ $modul_cam = true; }			
			if(in_array($this->companyId,$tedarik_aktif_modul_kontrol)) 		{ $modul_tedarik = true; }			
			if(in_array($this->companyId,$mobil_aktif_modul_kontrol)) 			{ $modul_mobil = true; }			
			if(in_array($this->companyId,$otodisi_aktif_modul_kontrol)) 		{ $modul_otodisi = true; }
			if(in_array($this->companyId,$arastirmaci_aktif_modul_kontrol)) 	{ $modul_arastirmaci = true; }
			if(in_array($this->companyId,$uzman_aktif_modul_kontrol))			{ $modul_uzman = true; }			
			if(in_array($this->companyId,$alternatif_tamir_aktif_modul_kontrol)){ $modul_alternatif_tamir = true; }			
			
			$return_modul = array(
			'modul_eksper'=>$modul_eksper,
			'modul_servis'=>$modul_servis,			
			'modul_faturali'=>$modul_faturali,
			'modul_cam'=>$modul_cam,
			'modul_tedarik'=>$modul_tedarik,
			'modul_mobil'=>$modul_mobil,
			'modul_otodisi'=>$modul_otodisi,
			'modul_arastirmaci'=>$modul_arastirmaci,
			'modul_uzman'=>$modul_uzman,
			'modul_alternatif_tamir'=>$modul_alternatif_tamir,			
			);
			return $return_modul;
			
		}

	}
	
?>