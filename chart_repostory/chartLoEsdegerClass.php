<?php
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php");
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");
	
	class chartClassLoEsdeger extends kullaniciKontrolClass{

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





        function toplamTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}						
				
			
			$sql = "
				SELECT
					IFNULL(SYU.AD, 'DÝÐER') AS MENSEI,
					ILLER.ID,
					ILLER.ADI,
					SUM(SD.FIYAT_TEDARIKCI*SD.ADET) AS TEDARIK_TOPLAM_TUTARI,
					SUM(IF( (IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_LO_TUTAR,
					SUM(IF( (IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0) OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_ESD_TUTAR,

					COUNT(SD.ADET) AS TEDARIK_TOPLAM_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.ADET,NULL)) AS TEDARIK_LO_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.ADET,NULL)) AS TEDARIK_ESD_ADET,

					TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET) / COUNT(SD.ADET),2) AS ORTALAMA_TOPLAM,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.ADET,NULL)),2) ORTALAMA_LO,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.ADET,NULL)),2) ORTALAMA_ESD
				FROM
					SIPARIS S				
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID	
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO				
				LEFT JOIN SIPARIS_YANSANAYI_ULKE SYU ON SYU.ID = SD.ESD_ULKE_ID
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					IFNULL(SYU.ID,0)
				ORDER BY
				SUM(SD.FIYAT_TEDARIKCI*SD.ADET) DESC				
			";	
			//echo $sql;		
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$topdata_arr[] = $row;
			}
			return $topdata_arr;	
		}
		
		
		function top20TedarikciBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$tedarikci_col = "SU.NAME AS TEDARIKCI,";
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			else
			{
				$tedarikci_col = "LEFT(SU.NAME, 15) AS TEDARIKCI,";						
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}	

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}			
				
			
			$sql = "
					SELECT						
						$tedarikci_col
						TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET),2) AS TUTAR_ISKONTOLU
					FROM
						SIPARIS S
					INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
					INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID
					INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
					LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO				
					LEFT JOIN SIPARIS_YANSANAYI_ULKE SYU ON SYU.ID = SD.ESD_ULKE_ID
					LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
					LEFT JOIN ILLER ON ILLER.ID = SR.IL
					WHERE
						1
						$kriter
						AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
						AND SD.`STATUS` = 1
						AND H.DOSYA_NO NOT LIKE '%TEST%'
					GROUP BY
						SU.ID
					ORDER BY
						SUM(SD.FIYAT_TEDARIKCI*SD.ADET) DESC
					LIMIT 10
			";	
			//echo $sql;		
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$topdata_arr[] = $row;
			}
			return $topdata_arr;	
		}
		
		function top20TedarikciDetailBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}			
				
			
			$sql = "
					SELECT
						SU.NAME  AS TEDARIKCI,						
						TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET),2) AS TUTAR_ISKONTOLU
					FROM
						SIPARIS S
					INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
					INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID
					INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
					LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
					LEFT JOIN SIPARIS_YANSANAYI_ULKE SYU ON SYU.ID = SD.ESD_ULKE_ID
					LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
					LEFT JOIN ILLER ON ILLER.ID = SR.IL					
					WHERE
						1
						$kriter
						AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
						AND SD.`STATUS` = 1
						AND H.DOSYA_NO NOT LIKE '%TEST%'
					GROUP BY
						SU.ID
					ORDER BY
						SUM(SD.FIYAT_TEDARIKCI*SD.ADET) DESC					
			";	
			//ECHO $sql;	
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$topdata_arr[] = $row;
			}
			return $topdata_arr;	
		}
		
		
		function toplamMarkaTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}			
				
			
			$sql = "
				SELECT
					M.MARKA_ADI,					
					SUM(SD.FIYAT_TEDARIKCI*SD.ADET) AS TEDARIK_TOPLAM_TUTARI,
					SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_LO_TUTAR,
					SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_ESD_TUTAR,

					COUNT(SD.ADET) AS TEDARIK_TOPLAM_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.ADET,NULL)) AS TEDARIK_LO_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.ADET,NULL)) AS TEDARIK_ESD_ADET,

					TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET) / COUNT(SD.ADET),2) AS ORTALAMA_TOPLAM,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.ADET,NULL)),2) ORTALAMA_LO,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.ADET,NULL)),2) ORTALAMA_ESD					
				FROM
					SIPARIS S
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID
				INNER JOIN MARKA M ON M.MARKA_KODU = S.MARKA_ID 
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO				
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					M.MARKA_KODU
				ORDER BY
				SUM(SD.FIYAT_TEDARIKCI*SD.ADET) DESC				
			";
			//echo $sql;
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$topdata_marka_arr[] = $row;
			}
			return $topdata_marka_arr;	
		}
		
		function toplamYsMarkaTopBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}	

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}			
				
			
			$sql = "
				SELECT
					SYM.AD AS YS_MARKA,					
					SUM(SD.FIYAT_TEDARIKCI*SD.ADET) AS TEDARIK_TOPLAM_TUTARI,
					SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_LO_TUTAR,
					SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_ESD_TUTAR,

					COUNT(SD.ADET) AS TEDARIK_TOPLAM_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.ADET,NULL)) AS TEDARIK_LO_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.ADET,NULL)) AS TEDARIK_ESD_ADET,

					TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET) / COUNT(SD.ADET),2) AS ORTALAMA_TOPLAM,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP=2), SD.ADET,NULL)),2) ORTALAMA_LO,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP=1), SD.ADET,NULL)),2) ORTALAMA_ESD
				FROM
					SIPARIS S
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID
				INNER JOIN SIPARIS_YANSANAYI_MARKA SYM ON SYM.ID= SD.YS_MARKA_ID
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO				
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					SYM.ID
				ORDER BY
				SUM(SD.FIYAT_TEDARIKCI*SD.ADET) DESC				
			";
			//echo $sql;
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$topdata_ysmarka_arr[] = $row;
			}
			return $topdata_ysmarka_arr;	
		}
		
		function toplamYsMarkaOranBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}			
				
			
			$sql = "
				SELECT
					SYM.AD AS YS_MARKA,	

					TRUNCATE(SUM(IF(IFNULL(SD.LO,0) IN (0,1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (1,2)), SD.FIYAT_TEDARIKCI * SD.ADET,0)),2) AS TOPLAM_GERCEK,
					TRUNCATE(SUM(IF(IFNULL(SD.LO,0) IN (0,1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (1,2)), SD.FIYAT_SISTEM * SD.ADET,0)),2) AS TOPLAM_SISTEM,
					
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI * SD.ADET,0)),2) AS TOPLAM_LO_GERCEK,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_SISTEM * SD.ADET,0)),2) AS TOPLAM_LO_SISTEM,
					
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_TEDARIKCI * SD.ADET,0)),2) AS TOPLAM_ESD_GERCEK,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_SISTEM * SD.ADET,0)),2) AS TOPLAM_ESD_SISTEM,
					
					TRUNCATE(SUM(IF(IFNULL(SD.LO,0) IN (0,1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (1,2)), SD.FIYAT_TEDARIKCI * SD.ADET,0)) / SUM(IF(IFNULL(SD.LO,0) IN (0,1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (1,2)), SD.FIYAT_SISTEM * SD.ADET,0)) *100 ,2) AS TOPLAM_ISKONTO,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI * SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_SISTEM * SD.ADET,0)) *100 ,2) AS TOPLAM_LO_ISKONTO,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_TEDARIKCI * SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_SISTEM * SD.ADET,0)) *100 ,2) AS TOPLAM_ESD_ISKONTO
				FROM
					SIPARIS S
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID
				INNER JOIN SIPARIS_YANSANAYI_MARKA SYM ON SYM.ID= SD.YS_MARKA_ID
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO				
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					SYM.ID
				ORDER BY
					SYM.AD
			";
			//echo $sql;
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$topdata_ysmarkaoran_arr[] = $row;
			}
			return $topdata_ysmarkaoran_arr;	
		}
		
		function parcaGruplariBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}			
				
			
			$sql = "
				SELECT
					IFNULL(YGY.AD, 'DÝÐER') AS PARCA_GRUBU,		
					SUM(SD.FIYAT_TEDARIKCI*SD.ADET) AS TEDARIK_TOPLAM_TUTARI,
					SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_LO_TUTAR,
					SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_TEDARIKCI*SD.ADET,0)) AS TEDARIK_ESD_TUTAR,

					COUNT(SD.ADET) AS TEDARIK_TOPLAM_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.ADET,NULL)) AS TEDARIK_LO_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.ADET,NULL)) AS TEDARIK_ESD_ADET,

					TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET) / COUNT(SD.ADET),2) AS ORTALAMA_TOPLAM,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.ADET,NULL)),2) ORTALAMA_LO,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_TEDARIKCI*SD.ADET,0)) / SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.ADET,NULL)),2) ORTALAMA_ESD
				FROM
					SIPARIS S				
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN HASAR_DETAIL HD ON HD.ID = SD.YEDPAR_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID	
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO								
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL
				LEFT JOIN YP_GRUP_YENI YGY ON YGY.ID = HD.GRUP_ID
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					IFNULL(YGY.ID, 0)
				ORDER BY
				SUM(SD.FIYAT_TEDARIKCI*SD.ADET) DESC				
			";			
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$parca_grubu_arr[] = $row;
			}
			return $parca_grubu_arr;	
		}
		
		function eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,$param){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}
			
			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}

			if($param==1){
				$limit = " LIMIT 10";
				$order = " TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET),2) DESC";
			}	
			
			if($param==2){		
				$limit = " LIMIT 10";			
				$order = " TRUNCATE(SUM(IF(IFNULL(SD.LO,0)=1, SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) DESC";
			}
			
			if($param==3){				
				$limit = " LIMIT 10";
				$order = " TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0) , SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) DESC";
			}

			if($param==5){
				$limit = " LIMIT 500";
				$order = " TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET),2) DESC";
			}	
			
			if($param==6){		
				$limit = " LIMIT 500";			
				$order = " TRUNCATE(SUM(IF(IFNULL(SD.LO,0)=1, SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) DESC";
			}
			
			if($param==7){				
				$limit = " LIMIT 500";
				$order = " TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0) , SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) DESC";
			} 			
			
				
			
			$sql = "
				SELECT
					LEFT(U.NAME,20) AS EKSPER,
					TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET),2) AS TEDARIK_TOPLAM_TUTARI,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) AS TEDARIK_LO_TUTAR,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) AS TEDARIK_ESD_TUTAR,
					COUNT(SD.ADET) AS TEDARIK_TOPLAM_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.ADET,NULL)) AS TEDARIK_LO_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.ADET,NULL)) AS TEDARIK_ESD_ADET
				FROM
					SIPARIS S				
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID	
				INNER JOIN HASAR_DETAIL HD ON HD.ID = SD.YEDPAR_ID				
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				INNER JOIN USERS U ON H.USER_EKSPER = U.U_NAME
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO								
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL				
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					IFNULL(U.ID, 0)
				ORDER BY
				$order
				$limit
			";		
	
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$eksper_blok_arr[] = $row;
			}
			return $eksper_blok_arr;	
		}
		
		
		function loEsdAyBazinda($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,$param){
			
			if( ($this->kullaniciKontrol() == '2' || $this->hdsKullaniciKriter) ) { return false;}
						
			if($brans!=NULL && $brans!=-1){ 
				$kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
			}
						
			if(($tarih1 && $tarih2)){				
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$kriter .=  " AND S.TARIH_SIPARIS BETWEEN '$tarih1 00:00:00' AND '$tarih2 23:59:59'";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.MARKA_ID , H.HAS_MARKA_ID)='$marka_id'";
			}
						
			if($kullanim_sekli=="1"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)='1'";
			}

			if($kullanim_sekli=="2"){
					$kriter .=  " AND IF(H.SIGORTA_SEKLI=1,  HMA.SB_ARAC_KULLANIM_TURU , H.SB_ARAC_KULLANIM_TURU)<>'1'";
			}			
			
			if(($tedarikci!=NULL &&  $tedarikci!='-1')){ 
				$kriter .=  " AND S.TEDARIKCI_ID='$tedarikci'";
			}
			
			if(($mensei!=NULL &&  $mensei!='-1')){ 
				$kriter .=  " AND SD.ESD_ULKE_ID='$mensei'";
			}
			
			if(($sehir_id!=NULL &&  $sehir_id!='-1')){ 
				$kriter .=  " AND ILLER.ID='$sehir_id'";
			}

			if(($urun_id!=NULL &&  $urun_id!='-1')){ 
				$kriter .=  " AND SD.YS_MARKA_ID='$urun_id'";
			}	
				
			
			$sql = "
				SELECT
					CONCAT(MONTH (S.TARIH_SIPARIS),'-', YEAR (S.TARIH_SIPARIS))  AS AY,
					TRUNCATE(SUM(SD.FIYAT_TEDARIKCI*SD.ADET),2) AS TEDARIK_TOPLAM_TUTARI,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) AS TEDARIK_LO_TUTAR,
					TRUNCATE(SUM(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.FIYAT_TEDARIKCI*SD.ADET,0)),2) AS TEDARIK_ESD_TUTAR,
					COUNT(SD.ADET) AS TEDARIK_TOPLAM_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=1) OR (SD.ESDEGER_OLABILIR_SEBEP IN (2)), SD.ADET,NULL)) AS TEDARIK_LO_ADET,
					COUNT(IF((IFNULL(SD.ESDEGER_OLABILIR_SEBEP,0)=0 AND IFNULL(SD.LO,0)=0)  OR (SD.ESDEGER_OLABILIR_SEBEP IN (1)), SD.ADET,NULL)) AS TEDARIK_ESD_ADET
				FROM
					SIPARIS S				
				INNER JOIN SIPARIS_DETAIL SD ON S.ID = SD.SIPARIS_ID
				INNER JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID	
				INNER JOIN HASAR_DETAIL HD ON HD.ID = SD.YEDPAR_ID				
				INNER JOIN ".$this->hasarTable." H ON H.ID = S.DOSYA_ID			
				INNER JOIN USERS U ON H.USER_EKSPER = U.U_NAME
				LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO								
				LEFT JOIN SERVIS SR ON SR.ID = S.SERVIS_ID
				LEFT JOIN ILLER ON ILLER.ID = SR.IL				
				WHERE
					1
					$kriter
					AND (IFNULL(SD.YAN_SANAYI,0) =1 OR SD.ESDEGER_OLABILIR_SEBEP>0)
					AND SD.`STATUS`=1
					AND H.DOSYA_NO NOT LIKE '%TEST%'
				GROUP BY
					YEAR (S.TARIH_SIPARIS),
					MONTH (S.TARIH_SIPARIS) 
				ORDER BY
					YEAR (S.TARIH_SIPARIS),
					MONTH (S.TARIH_SIPARIS) 
			";	
			//echo $sql;	
			if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}			
			while($row = mysql_fetch_array($result)){			
			$aylar_arr[] = $row;
			}
			return $aylar_arr;	
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