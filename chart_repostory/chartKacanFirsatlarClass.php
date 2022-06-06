<?php
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php");
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");
	
	class chartKacanfirsatlarClass extends kullaniciKontrolClass{

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
		
		function kacanFirsatlar1($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(
					'1', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI',
					'$TEDARIK_TERCIH',
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'1', /*fark sebebi 1 direk orijinal seçilenler*/
					'$ZARAR',
					'$ESD_SECILEN_HARIC',
					'$UCUZ_SECILEN_HARIC',
					'1', /*GERCEKLESEN_PARCA_TIPI*/
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);
			";	
			//die($sql);
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}			
			return $row_arr;										
			}
		}

		function kacanFirsatlar2($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(
					'0', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI',
					'$TEDARIK_TERCIH',
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'1', /*fark sebebi 1 direk orijinal seçilenler*/
					'$ZARAR',
					'$ESD_SECILEN_HARIC',
					'$UCUZ_SECILEN_HARIC',
					'1', /*GERCEKLESEN_PARCA_TIPI*/
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);	
			";	
			//echo $sql;die;
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}
			
			return $row_arr;										
			}
		}

		function kacanFirsatlar3($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(
					'0,1', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI',
					'$TEDARIK_TERCIH',
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'', /*fark sebebi 2 servise býrakýlan*/
					'$ZARAR',
					'$ESD_SECILEN_HARIC',
					'$UCUZ_SECILEN_HARIC',
					'4', /*GERCEKLESEN_PARCA_TIPI*/
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);		
			";			
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}
			
			return $row_arr;										
			}
		}

		function kacanFirsatlar4($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(
					'0,1', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',/*araç marka*/
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI',
					'$TEDARIK_TERCIH',
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'', 
					'$ZARAR',
					'$ESD_SECILEN_HARIC',
					'$UCUZ_SECILEN_HARIC',
					'5', /*GERCEKLESEN_PARCA_TIPI t.dýþý*/
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);		
			";			
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}
			
			return $row_arr;										
			}
		}

		function kacanFirsatlar5($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(	
					'1', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',/*araç marka*/
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI', /*'$ASGARI_SISTEM_FIYATI',*/
					'$TEDARIK_TERCIH', /*'$TEDARIK_TERCIH',*/
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'$FARK_SEBEBI', /*FARK SEBEBÝ*/ 
					'1',/*'$ZARAR',*/
					'1', /*$ESD_SECILEN_HARIC*/
					'1',
					'2',
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);			
			";			
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}
			
			return $row_arr;										
			}
		}

		function kacanFirsatlar6($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(	
					'0', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',/*araç marka*/
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI', /*'$ASGARI_SISTEM_FIYATI',*/
					'$TEDARIK_TERCIH', /*'$TEDARIK_TERCIH',*/
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'$FARK_SEBEBI', /*FARK SEBEBÝ*/ 
					'1',/*'$ZARAR',*/
					'$ESD_SECILEN_HARIC',
					'1',
					'3',
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);	
			";			
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}
			
			return $row_arr;										
			}
		}	
		
		function kacanFirsatlar7($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(	
					'0,1', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',/*araç marka*/
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI', /*'$ASGARI_SISTEM_FIYATI',*/
					'1', /*'$TEDARIK_TERCIH',*/
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'$FARK_SEBEBI', /*fark sebebi*/
					'$ZARAR',
					'$ESD_SECILEN_HARIC',
					'$UCUZ_SECILEN_HARIC',
					'$GERCEKLESEN_PARCA_TIPI',
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);
			";			
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}			
			return $row_arr;										
			}
		}	
		
		function kacanFirsatlar8($dosya_statu, $brans,$tarih1,$tarih2,$marka_id,$arac_yas,$arac_yas_tip){									
									
			if($brans!=NULL && $brans!=-1){
				$SIGORTA_SEKLI 					= ($brans == '-1')?'':$brans;			
			}						
			
			if(($tarih1 && $tarih2)){				
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			} else {					
				$tarih1 = date("Y-m-d", mktime(0, 0, 0, date("01") , date("01"), date("Y")));
				$tarih2 = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")));	
				$TARIH_BASLANGIC 	=  "$tarih1";
				$TARIH_BITIS		=  "$tarih2";
			}										
			
			if($marka_id!=NULL && $marka_id!='-1'){ 
				$MARKA_ARAC	= ($marka_id == '-1')?'':implode(",",$marka_id);	 
			}
			
			if(($arac_yas!=NULL && $arac_yas!='-1')){ 
				$ARAC_YAS		= $arac_yas;
			}
			
			if(($arac_yas_tip!=NULL && $arac_yas_tip!='-1')){ 
				$ARAC_YAS_TIP		= $arac_yas_tip;
			}
			
			if(($il!=NULL &&  $il!='-1')){ 
				$SERVIS_IL			= ($il);	
			}
			
			if($dosya_statu!=NULL && $dosya_statu!='-1'){ 
				$DOSYA_STATU = ($dosya_statu == '-1')?'':$dosya_statu;							
			}
			
			
			$sql = "
				CALL CZ_LOGOSUZ_SECIM_RAPORU(
					'0,1', /*log parça tip 1 lo 0 Eþd*/
					'$DOSYA_NO',
					'$SIGORTA_SEKLI',
					'$SERVIS_TIPI',
					'$SERVIS_IL',
					'$DOSYA_STATU',
					'$MARKA_ARAC',
					'$ARAC_YAS',
					'$ARAC_YAS_TIP',
					'$USER_EKSPER',
					'$TEDARIKCI',
					'$ASGARI_SISTEM_FIYATI',
					'$TEDARIK_TERCIH',
					'$CZ',
					'$MARKA_PARCA',
					'$MARKA_PARCA_HARIC',
					'$ORIJINAL_PARCA_NO',
					'$LOGOSUZ_PARCA_NO',
					'$FARK_SEBEBI', /*fark sebebi 2 servise býrakýlan*/
					'$ZARAR',
					'$ESD_SECILEN_HARIC',
					'$UCUZ_SECILEN_HARIC',
					'$GERCEKLESEN_PARCA_TIPI', /*GERCEKLESEN_PARCA_TIPI*/
					'$GERCEKLESEN_PARCA_MARKA',
					'$BEYAN_TIP',
					'$TARIH_TUR',
					'$TARIH_BASLANGIC',
					'$TARIH_BITIS'
				);
			";			
			$mysqli = mysqli_connect(HOST,USR,PSW,DB);
			if ($mysqli -> connect_errno) {
				  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
				  exit();
			}
			if ($result = $mysqli -> query($sql)) {			  			
			while($row = $result -> fetch_array()){			
			$row_arr[] = $row;			
			}			
			return $row_arr;										
			}
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