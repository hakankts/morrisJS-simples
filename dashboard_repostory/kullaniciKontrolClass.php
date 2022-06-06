<?php
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php");

	class kullaniciKontrolClass{

		protected $cdb;
		protected $hasarTable;
		protected $companyId;
		protected $DASHBOARD;
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

		}

		function kullaniciKontrol(){


				$this->HASAR_USER	= $SESSION['hasar_user'];
				if($SESSION['faturali_kullanici'] == "1") { $this->FATURALI = "1";}
				if($SESSION['hkm'] == "1") { $this->HKM = "1";}
				if($SESSION['hkm_eksper'] == "1") { $this->HKM_EKSPER = "1";}
				if($SESSION['otomotiv'] == "1") { $this->OTOMOTIV = "1";}
				$sqlu = " 	SELECT DASHBOARD FROM USERS WHERE U_NAME = '".$this->USER_NAME."'";
				if (!($this->cdb->execute_sql($sqlu,$resultu,$error_msg))){return false;}
				$rowu = mysql_fetch_object($resultu);
				$this->DASHBOARD = $rowu->DASHBOARD;
				if($rowu->DASHBOARD=="2"){
					$sqlod = " 	SELECT ID,U_NAME FROM YANGIN_DOSYA_SORUMLULARI WHERE U_NAME = '".$this->USER_NAME."'";
					if (!($this->cdb->execute_sql($sqlod,$resultod,$error_msg))){return false;}
					if(mysql_num_rows($resultod)>0){
						$this->otodisiKullaniciKriter = "AND DS.U_NAME='".$this->USER_NAME."'";
					}

				}

				switch(OAConf::COMPANY_ID){
				case '20':
				case '44':
				case '55':
				case '143':
				case '32':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.U_NAME = U.U_NAME WHERE U.ENABLED = 1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '37':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.U_NAME = U.U_NAME WHERE U.ENABLED = 1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '24':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.UNAME = U.U_NAME WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '49':
				case '23':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.USER = U.U_NAME WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '51':
				$SELECT ="SELECT '' AS T1_ID, D.ID AS T2_ID FROM DOSYA_SORUMLULARI D WHERE D.U_NAME= '".$this->USER_NAME."'";
				break;

				case '56':
				case '47':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.KULLANICI_ADI = U.U_NAME WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '50':
				case '70':
				case '48':
				case '75':
				case '80':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.OA_USER = U.U_NAME WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '60':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.USER_ID = U.ID WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;

				case '64':
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.USERS_UNAME = U.ID WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				break;				
				/* 19,28,58 */
				default:
				$SELECT = "SELECT '' AS T1_ID, D.ID AS T2_ID  FROM DOSYA_SORUMLULARI D INNER JOIN USERS U ON D.USER_NAME = U.U_NAME WHERE U.ENABLED=1 AND U.U_NAME= '".$this->USER_NAME."'";
				}

				$sql_user = "
					(SELECT ID AS T1_ID, '' AS T2_ID  FROM HKMEKS_SORUMLULAR WHERE SORUMLU = '".$this->USER_NAME."' AND IHBAR_DOSYA_ATA=1)
					UNION
					(".$SELECT.")
				";
				if (!($this->cdb->execute_sql($sql_user,$result,$error_msg))){return false;}

				if(mysql_num_rows($result)>0){
					$row = mysql_fetch_object($result);
				}

				if($rowu->DASHBOARD=="0"){
					return false;
				}
				if($rowu->DASHBOARD=="4" && $row->T1_ID!=""){
					return $this->hdsKullaniciKriter =  " AND HDS.SORUMLU ='".$this->USER_NAME."'";
				}
				if($rowu->DASHBOARD=="4" && $row->T2_ID!=""){
					return $this->kullaniciKriter =  " AND DS.ID='".$row->T2_ID."'";
				}
				if($rowu->DASHBOARD=="1" || $rowu->DASHBOARD=="2" || $rowu->DASHBOARD=="3")
				{
					return $rowu->DASHBOARD;
				}

		}

		function dsKontrol($param){

			if($param == '1' || $param == '2' || $param == '3')	{ $param =""; }

			switch(OAConf::COMPANY_ID){
				case '20':
				case '44':
				case '55':
				case '143':
				case '32':
				$sql_user = "SELECT DS.ID, DS.AD, DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.U_NAME = U.U_NAME WHERE U.ENABLED = 1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '37':
				$sql_user = "SELECT DS.ID, U.NAME AS AD, U.E_MAIL AS EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.U_NAME = U.U_NAME WHERE U.ENABLED = 1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '24':
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.UNAME = U.U_NAME WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '49':
				case '23':
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.USER = U.U_NAME WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '51':
				$sql_user ="SELECT * FROM DOSYA_SORUMLULARI DS WHERE 1 AND U.DASHBOARD=4 ".$param."";
				break;

				case '56':
				case '47':
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.KULLANICI_ADI = U.U_NAME WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '50':
				case '70':
				case '48':
				case '75':
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.OA_USER = U.U_NAME WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '60':
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.USER_ID = U.ID WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				case '64':
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.USERS_UNAME = U.ID WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				break;

				default:
				/*
				19,28,58
				*/
				$sql_user = "SELECT DS.ID,DS.AD,DS.EMAIL FROM DOSYA_SORUMLULARI DS INNER JOIN USERS U ON DS.USER_NAME = U.U_NAME WHERE U.ENABLED=1 AND U.DASHBOARD=4 ".$param." ORDER BY DS.AD";
				}

				return $sql_user;
		}

	}

?>