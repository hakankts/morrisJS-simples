<?php
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php");
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");
	
	class chartClassParcaMaliyet extends kullaniciKontrolClass{

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

        function parcaMaliyetOrjBlok($brans,$tarih1,$tarih2,$kullanim_sekli,$servis_tipi,$sehir_id,$eksper,$marka_id,$dosya_no){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1, HMA.SB_ARAC_KULLANIM_TURU, H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1, HMA.SB_ARAC_KULLANIM_TURU, H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}

			if($servis_tipi=="1"){
					$kriter .=  " AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="2"){
					$kriter .=  " AND IFNULL(H.ANLASMALI, 0)=0";
			}
			if($servis_tipi=="3"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1";
			}
			if($servis_tipi=="4"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0";
			}
			if($servis_tipi=="5"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1 AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="6"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0 AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="7"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1 AND IFNULL(H.ANLASMALI, 0)=0";
			}
			if($servis_tipi=="8"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0 AND IFNULL(H.ANLASMALI, 0)=0";
			}			

			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND H.HASAR_ILI='$sehir_id'";
			}

			if(($eksper!=NULL &&  $eksper!='-1')){ 
				$kriter .=  " AND H.USER_EKSPER='$eksper'";
			}

			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}			
			
			if(($dosya_no!=NULL &&  $dosya_no!='')){ 
				$kriter .=  " AND H.DOSYA_NO='$dosya_no'";
			}
				
			$sql = "
					SELECT
						M.MARKA_ADI,
						M.MARKA_KODU,
						COUNT(DISTINCT H.ID) AS DOSYA_ADET,
						COUNT(DISTINCT HD.ID) AS PARCA_ADET,
						COUNT(DISTINCT HD.ID) / COUNT(DISTINCT H.ID) AS ORT_PARCA_ADET,	
						COUNT(DISTINCT IF(IFNULL(HD.YS_ISKONTO,0)=0, H.ID, NULL)) AS ORJ_DOSYA_ADET,																			
						COUNT( DISTINCT 
							CASE		
								WHEN IFNULL(HD.YS_ISKONTO,0)=0 THEN  HD.ID
								ELSE NULL
							END 								  															
						) AS ORJ_DEGISIM_ADET,																							
						SUM( 
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)=0 THEN  HD.BIRIM_FIYAT_SISTEM * HD.ADET
								ELSE 0
							END 								  															
						) AS ORJ_SISTEM,								
						SUM( 
							CASE		
								WHEN IFNULL(HD.YS_ISKONTO,0)=0 THEN  ((HD.BIRIM_FIYAT_GERCEK - ((HD.BIRIM_FIYAT_GERCEK * IFNULL(HD.KHHH_ISKONTO, 0) / 100))) * HD.ADET)
								ELSE 0
							END 								  															
							)
						 AS ORJ_GERCEKLESEN
																
				FROM
					".$this->hasarTable."  H
				INNER JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO														
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
				LEFT JOIN SIPARIS_DETAIL SD ON HD.ID = SD.YEDPAR_ID AND SD.STATUS=1							
				LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME																					
				LEFT JOIN SIPARIS S ON S.DOSYA_ID = H.ID
				LEFT JOIN SIPARIS_USERS SU ON S.TEDARIKCI_ID = SU.ID
				LEFT JOIN HKMEKS_DOSYA_ONAY HDO ON HDO.DOSYA_ID = H.ID	
				LEFT JOIN MARKA M ON M.MARKA_KODU = IF ( H.SIGORTA_SEKLI = 1,HMA.MARKA_ID, H.HAS_MARKA_ID)
				WHERE
					1 = 1							
					AND H.DOSYA_STATU=1
					AND HD.ISLEM=1					
					AND IFNULL(H.PERT, 0) <> 1														
					AND IFNULL(H.TALEPSIZ, 0) <> 1	
					AND IFNULL(HDO.DURUM_ID,0) <> 2		
									
					$kriter
				GROUP BY
					M.MARKA_KODU	
				
				";	
				
				//echo $sql;
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$data_arr[] = $row;
			}
			return $data_arr;	
		}

		function parcaMaliyetLoEsdBlok($brans,$tarih1,$tarih2,$kullanim_sekli,$kullanim_sekli,$servis_tipi,$sehir_id,$eksper,$marka_id,$dosya_no){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}

			if($servis_tipi=="1"){
					$kriter .=  " AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="2"){
					$kriter .=  " AND IFNULL(H.ANLASMALI, 0)=0";
			}
			if($servis_tipi=="3"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1";
			}
			if($servis_tipi=="4"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0";
			}
			if($servis_tipi=="5"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1 AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="6"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0 AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="7"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1 AND IFNULL(H.ANLASMALI, 0)=0";
			}
			if($servis_tipi=="8"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0 AND IFNULL(H.ANLASMALI, 0)=0";
			}			

			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND H.HASAR_ILI='$sehir_id'";
			}

			if(($eksper!=NULL &&  $eksper!='-1')){ 
				$kriter .=  " AND H.USER_EKSPER='$eksper'";
			}

			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}		

			if(($dosya_no!=NULL &&  $dosya_no!='')){ 
				$kriter .=  " AND H.DOSYA_NO='$dosya_no'";
			}
				
			$sql = "
					SELECT
						M.MARKA_ADI,
						M.MARKA_KODU,
						COUNT(DISTINCT H.ID) AS DOSYA_ADET,
						COUNT(DISTINCT HD.ID) AS PARCA_ADET,
						COUNT(DISTINCT HD.ID) / COUNT(DISTINCT H.ID) AS ORT_PARCA_ADET,	
						COUNT(DISTINCT IF(IFNULL(HD.YS_ISKONTO,0)=0, H.ID, NULL)) AS LO_ESD_DOSYA_ADET,																			
						COUNT(DISTINCT 
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)>0 THEN  HD.ID
								
							ELSE NULL
							END 								  															
						) AS LO_ESD_DEGISIM_ADET,																							
						SUM( 
							CASE		
								WHEN IFNULL(HD.YS_ISKONTO,0)>0 THEN  HD.BIRIM_FIYAT_SISTEM * HD.ADET
								ELSE 0
							
							END 								  															
						) AS LO_ESD_SISTEM,								
						SUM( 
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)>0 THEN  ((HD.BIRIM_FIYAT_GERCEK - ((HD.BIRIM_FIYAT_GERCEK * IFNULL(HD.KHHH_ISKONTO, 0) / 100))) * HD.ADET)
								ELSE 0
							
							END 								  															
							)
						 AS LO_ESD_GERCEKLESEN					
				FROM
					".$this->hasarTable."  H
				INNER JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO														
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
				LEFT JOIN SIPARIS_DETAIL SD ON HD.ID = SD.YEDPAR_ID AND SD.STATUS=1							
				LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME																					
				LEFT JOIN SIPARIS S ON S.DOSYA_ID = H.ID
				LEFT JOIN SIPARIS_USERS SU ON S.TEDARIKCI_ID = SU.ID
				LEFT JOIN HKMEKS_DOSYA_ONAY HDO ON HDO.DOSYA_ID = H.ID	
				LEFT JOIN MARKA M ON M.MARKA_KODU = IF ( H.SIGORTA_SEKLI = 1,HMA.MARKA_ID, H.HAS_MARKA_ID)
				WHERE
					1 = 1							
					AND H.DOSYA_STATU=1
					AND HD.ISLEM=1					
					AND IFNULL(H.PERT, 0) <> 1														
					AND IFNULL(H.TALEPSIZ, 0) <> 1	
					AND IFNULL(HDO.DURUM_ID,0) <> 2						
					$kriter
					
				GROUP BY
					M.MARKA_KODU					
					
				
				";		
			//echo $sql;				
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$data_arr[] = $row;
			}
			return $data_arr;	
		}

		 function parcaMaliyetTumuBlok($brans,$tarih1,$tarih2,$kullanim_sekli,$kullanim_sekli,$servis_tipi,$sehir_id,$eksper,$marka_id,$dosya_no){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND H.KAYIT_TARIH_SAAT BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}

			if($servis_tipi=="1"){
					$kriter .=  " AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="2"){
					$kriter .=  " AND IFNULL(H.ANLASMALI, 0)=0";
			}
			if($servis_tipi=="3"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1";
			}
			if($servis_tipi=="4"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0";
			}
			if($servis_tipi=="5"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1 AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="6"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0 AND IFNULL(H.ANLASMALI, 0)=1";
			}
			if($servis_tipi=="7"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=1 AND IFNULL(H.ANLASMALI, 0)=0";
			}
			if($servis_tipi=="8"){
					$kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)=0 AND IFNULL(H.ANLASMALI, 0)=0";
			}			

			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND H.HASAR_ILI='$sehir_id'";
			}

			if(($eksper!=NULL &&  $eksper!='-1')){ 
				$kriter .=  " AND H.USER_EKSPER='$eksper'";
			}

			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}	

			if(($dosya_no!=NULL &&  $dosya_no!='')){ 
				$kriter .=  " AND H.DOSYA_NO='$dosya_no'";
			}
				
			$sql = "
					SELECT
						M.MARKA_ADI,
						M.MARKA_KODU,
						COUNT(DISTINCT H.ID) AS DOSYA_ADET,
						COUNT(DISTINCT HD.ID) AS PARCA_ADET,
						COUNT(DISTINCT HD.ID) / COUNT(DISTINCT H.ID) AS ORT_PARCA_ADET,	
						
						
						/*ORJ*/																
						COUNT(DISTINCT IF(IFNULL(SD.YAN_SANAYI,0)=0, H.ID, NULL)) AS ORJ_DOSYA_ADET,																			
						COUNT(DISTINCT 
							CASE		
								WHEN IFNULL(HD.YS_ISKONTO,0)=0 THEN  HD.ID
								ELSE NULL
							END 								  															
						) AS ORJ_DEGISIM_ADET,																							
						TRUNCATE(SUM( 
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)=0 THEN  HD.BIRIM_FIYAT_SISTEM * HD.ADET
								ELSE 0
							END 								  															
						),2) AS ORJ_SISTEM,								
						TRUNCATE(SUM( 
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)=0 THEN  ((HD.BIRIM_FIYAT_GERCEK - ((HD.BIRIM_FIYAT_GERCEK * IFNULL(HD.KHHH_ISKONTO, 0) / 100))) * HD.ADET)
								ELSE 0
							END 								  															
							),2)
						 AS ORJ_GERCEKLESEN,							
						
						COUNT(DISTINCT IF(IFNULL(SD.YAN_SANAYI,0)=1, H.ID, NULL)) AS LO_ESD_DOSYA_ADET,																			
						COUNT( DISTINCT
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)>0 THEN  HD.ID
								ELSE NULL
							END 								  															
						) AS LO_ESD_DEGISIM_ADET,																							
						TRUNCATE(SUM( 
							CASE	
								WHEN IFNULL(HD.YS_ISKONTO,0)>0 THEN  HD.BIRIM_FIYAT_SISTEM * HD.ADET
								ELSE 0
							END 								  															
						),2) AS LO_ESD_SISTEM,								
						TRUNCATE(SUM( 
							CASE		
								WHEN IFNULL(HD.YS_ISKONTO,0)>0 THEN  ((HD.BIRIM_FIYAT_GERCEK - ((HD.BIRIM_FIYAT_GERCEK * IFNULL(HD.KHHH_ISKONTO, 0) / 100))) * HD.ADET)
								ELSE 0
							END 								  															
							),2)
						 AS LO_ESD_GERCEKLESEN					
				FROM
					".$this->hasarTable."  H
				INNER JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO														
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
				LEFT JOIN SIPARIS_DETAIL SD ON HD.ID = SD.YEDPAR_ID AND SD.STATUS=1							
				LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME																					
				LEFT JOIN SIPARIS S ON S.DOSYA_ID = H.ID
				LEFT JOIN SIPARIS_USERS SU ON S.TEDARIKCI_ID = SU.ID
				LEFT JOIN HKMEKS_DOSYA_ONAY HDO ON HDO.DOSYA_ID = H.ID	
				LEFT JOIN MARKA M ON M.MARKA_KODU = IF ( H.SIGORTA_SEKLI = 1,HMA.MARKA_ID, H.HAS_MARKA_ID)
				WHERE
					1 = 1							
					AND H.DOSYA_STATU=1
					AND HD.ISLEM=1					
					AND IFNULL(H.PERT, 0) <> 1														
					AND IFNULL(H.TALEPSIZ, 0) <> 1	
					AND IFNULL(HDO.DURUM_ID,0) <> 2					
					$kriter
					
				GROUP BY
					M.MARKA_KODU	
				
				";								
				//echo $sql;							
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$data_arr[] = $row;
			}
			return $data_arr;	
		}	
		
				

	}
	
?>