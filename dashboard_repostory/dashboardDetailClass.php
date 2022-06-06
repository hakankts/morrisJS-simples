<?php
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php");
require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/root/yeni_ekran/dashboard_repostory/kullaniciKontrolClass.php");

class dashboardDetailClass extends kullaniciKontrolClass{

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
        $this->cdb          = new db_layer;
        $this->hasarTable   = get_hasar_table();
        $this->companyId    = OAConf::COMPANY_ID;
        $this->USER_NAME    = $SESSION['username'];
        $this->kullaniciKontrol();

    }

    function eksperBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        if($param=="eksper2"){
            $kriter .=  " AND CASE WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID END ";
        }

        if($param=="eksper3"){
            $kriter .=  " AND CASE
                            WHEN HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN HD.ISLEM=3 THEN H.ID
                        END ";
        }

        if($param=="eksper4"){
            $kriter .=  " AND HD.ID IS NULL ";
        }

        if($param=="eksper5"){
            $kriter .=  " AND H.SERVIS_ID IS NULL ";
        }

        if($param=="eksper6"){
            $kriter .=  " AND H.ON_RAPOR=1 ";
        }

        if($param=="eksper7"){
            $kriter .=  " AND IFNULL(H.ON_RAPOR,0)=0 ";
        }

        if($param=="eksper8"){
            $kriter .=  " AND IFNULL(H.PERT,0)=1 ";
        }

        if($param=="eksper9"){
            $kriter .=  " AND H.SIPARIS_UYGUN='1' AND H.SIPARIS_VAR=1";
        }

        if($param=="eksper10"){
            $kriter .=  " AND NA.ACIK_NOTU IS NOT NULL ";
        }

        if($param=="eksper11"){
            $kriter .=  " AND IFNULL(H.TAHMINI_HASAR,0)=0 ";
        }

        if($param=="eksper12"){
            $kriter .=  " AND H.FOTOVAR=0 ";
        }

        if($param=="eksper13"){
            $kriter .=  " AND H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0) ";
        }

        if($param=="eksper14"){
            $kriter .=  " AND H.RUCU =1 ";
        }

        if($param=="eksper15"){
            $kriter .=  " AND DATEDIFF(H.HASAR_TARIHI,H.SB_POLICE_BAS)<30 ";
        }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
                SELECT
                    /*eksper blok*/
                    H.ID AS H_ID,
                    HH.HASH AS DOSYA_HASH,
                    IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                    H.DOSYA_NO,
                    M.MARKA_ADI,
                    LEFT(U.NAME,30) AS EKSPER,
                    LEFT(SR.ADI,30) AS SERVIS,
                    SERVIS_IL.ADI AS SERVIS_ILI,
                    IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                    IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                    HS.SEKIL AS HASAR_SEKLI,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    DS.AD AS DOSYA_SORUMLUSU,

                    COUNT(DISTINCT H.ID) AS TOPLAM_DOSYA_SAYISI,
                    FORMAT((DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)),0) AS DOSYA_GECEN_SURE,
                    COUNT(DISTINCT IF(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DOSYA_30_GECEN_SURE,

                    COUNT(DISTINCT H.ID) AS TOPLAM_ADET,
                    COUNT( DISTINCT
                            CASE
                            WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID
                            END
                    ) AS DEGISIM_ADET,
                    COUNT( DISTINCT
                        CASE
                        WHEN HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                        WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN HD.ISLEM=3 THEN H.ID
                        END
                    ) AS ONARIM_ADET,

                    FORMAT( AVG( DISTINCT IF ( HD.ISLEM = 1 , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DEGISIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ISLEM =1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DEGISIM_30_ADET,
                    FORMAT( AVG( DISTINCT IF ( HD.ISLEM NOT IN (1) ,  DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,0)),0) AS ONARIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ISLEM NOT IN (1) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ONARIM_30_ADET,

                    COUNT(DISTINCT IF(HD.ID IS NULL, H.ID,NULL)) AS PARCA_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( HD.ID IS NULL, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,0)),0) AS PARCA_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS PARCA_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL, H.ID, NULL)) AS SERVIS_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.SERVIS_ID IS NULL , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SERVIS_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SERVIS_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.ON_RAPOR=1,H.ID,NULL)) AS ON_RAPO_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.ON_RAPOR=1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS ON_RAPOR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.ON_RAPOR=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ON_RAPOR_30_ADET,

                    COUNT(DISTINCT IF(IFNULL(H.ON_RAPOR,0)=0,H.ID,NULL)) AS ON_RAPO_GONDERILMEYEN_ADET,
                    FORMAT( AVG( DISTINCT IF ( IFNULL(H.ON_RAPOR,0)=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS ON_RAPO_GONDERILMEYEN_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(IFNULL(H.ON_RAPOR,0)=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ON_RAPO_GONDERILMEYEN_30_ADET,

                    COUNT(DISTINCT IF(IFNULL(H.PERT,0)=1,H.ID,NULL)) AS PERT_ADET,
                    FORMAT( AVG( DISTINCT IF ( IFNULL(H.PERT,0)=1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS PERT_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(IFNULL(H.PERT,0)=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS PERT_30_ADET,

                    COUNT(DISTINCT IF(IFNULL(H.TAHMINI_HASAR,0)=0, H.ID,NULL)) AS MULLAK_GIRISI_YAPILMAYAN_DOSYA,
                    FORMAT( AVG( DISTINCT IF ( IFNULL(H.TAHMINI_HASAR,0)=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS MULLAK_GIRISI_YAPILMAYAN_DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(IFNULL(H.TAHMINI_HASAR,0)=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS MULLAK_GIRISI_YAPILMAYAN_30_ADET,

                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1, H.ID, NULL)) AS SIPARIS_UYGUN_DOSYALAR,
                    FORMAT( AVG( DISTINCT IF ( H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SIPARIS_UYGUN_DOSYALAR_30_ADET,

                    COUNT(DISTINCT IF(NA.ACIK_NOTU IS NOT NULL, H.ID, NULL)) AS NEDEN_ACIK_DOSYALAR,
                    FORMAT( AVG( DISTINCT IF ( NA.ACIK_NOTU IS NOT NULL, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(NA.ACIK_NOTU IS NOT NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS NEDEN_ACIK_DOSYALAR_30_ADET,

                    FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                    FORMAT((H.TAHMINI_HASAR),2) AS EKSPER_MUALLAK_TUTAR,

                    COUNT(DISTINCT IF(H.FOTOVAR=0, H.ID, NULL)) AS FOTO_EVRAK_YUKLENMEMIS_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.FOTOVAR=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.FOTOVAR=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS FOTO_EVRAK_YUKLENMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0), H.ID, NULL)) AS MAGDUR_ARAC_BILGILERI_GIRILMEMIS,
                    FORMAT( AVG( DISTINCT IF ( H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0), DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS MAGDUR_ARAC_BILGILERI_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS MAGDUR_ARAC_BILGILERI_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.RUCU =1, H.ID, NULL)) AS RUCU_ISARETLI,
                    FORMAT( AVG( DISTINCT IF ( H.RUCU =1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS RUCU_ISARETLI_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.RUCU =1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS RUCU_ISARETLI_30_ADET
                FROM
                    $this->hasarTable H
                LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO
                LEFT JOIN SIPARIS_DETAIL SD ON HD.ID = SD.YEDPAR_ID
                LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME
                LEFT JOIN NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID
                LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
                LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                LEFT JOIN AS_HASAR_SEKLI HS ON H.HASAR_SEKLI = HS.ID
                LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
                WHERE
                H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                AND IFNULL(H.DOSYA_STATU,0) = 0
                AND IFNULL(U.HKM_EKSPER,0) = 0
                AND IFNULL(U.FATURALI_KULLANICI,0)= 0
                AND IFNULL(U.OTOMOTIV,0) = 0
                AND H.DOSYA_NO NOT LIKE '%TEST%'
                $kriter
                $this->kullaniciKriter
                GROUP BY H.ID
            ";
        //if(dbg()){echo($sql);}
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $eksper_arr[] = $row;
        }
        return $eksper_arr;
    }

    function eksperBlokOtodisi($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if($this->kullaniciKontrol() == '1') { return false;}

        if($act!=1){ die;}

        if($param=="otodisi2"){
            $kriter2 .=  " AND H.ON_RAPOR=1 ";
        }

        if($param=="otodisi3"){
            $kriter2 .=  " AND IFNULL(H.ON_RAPOR,0)=0 ";
        }

        if($param=="otodisi4"){
            $kriter2 .=  " AND IFNULL(H.TAHMINI_HASAR,0)=0 ";
        }

        if($param=="otodisi5"){
            $kriter2 .=  " AND NA.ACIK_NOTU IS NOT NULL ";
        }

        if($param=="otodisi6"){
            $kriter2 .=  " AND E.ID IS NULL AND F.ID IS NULL";
        }

        if($param=="otodisi7"){
            $kriter2 .=  " AND H.RUCU =1 ";
        }

        //if($sorumlu!=NULL && $sorumlu!=-1){ $kriter .=  " AND DS.ID='$sorumlu'";}
        //if($brans!=NULL && $brans!=-1){$kriter .=  " AND H.POLICE_TURU_ID='$brans'";}

        $sql = "
                SELECT
                    /*eksper blok otodisi*/
                    H.ID AS H_ID,
                    S.AD AS BRANS,
                    H.DOSYA_NO,
                    LEFT(U.NAME,30) AS EKSPER,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    S.AD AS HASAR_SEKLI,
                    ".( (in_array($this->companyId,array(27,18,51,56,19,20,37,32,47,75,58,64,30))) ? "
                    IF(YHS.DOSYA_ID IS NOT NULL, 1,0) AS HIZLI_RAPOR,
                    " : "" )."
                    COUNT(DISTINCT H.ID) AS TOPLAM_DOSYA_SAYISI,
                    FORMAT(AVG(DISTINCT DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)),0) AS DOSYA_GECEN_SURE,
                    COUNT(DISTINCT IF(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DOSYA_30_GECEN_SURE,

                    COUNT(DISTINCT H.ID) AS TOPLAM_ADET,

                    COUNT(DISTINCT IF(H.ON_RAPOR=1,H.ID,NULL)) AS ON_RAPOR_ADET,
                    FORMAT( AVG(  IF ( H.ON_RAPOR=1, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,NULL)),0) AS ON_RAPOR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.ON_RAPOR=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ON_RAPOR_30_ADET,

                    COUNT(DISTINCT IF(IFNULL(H.ON_RAPOR,0)=0,H.ID,NULL)) AS ON_RAPOR_GONDERILMEYEN_ADET,
                    FORMAT( AVG(  IF ( IFNULL(H.ON_RAPOR,0)=0, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,NULL)),0) AS ON_RAPOR_GONDERILMEYEN_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(IFNULL(H.ON_RAPOR,0)=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ON_RAPOR_GONDERILMEYEN_30_ADET,

                    COUNT(DISTINCT IF(IFNULL(H.TAHMINI_HASAR,0)=0, H.ID,NULL)) AS MULLAK_GIRISI_YAPILMAYAN_DOSYA,
                    FORMAT( AVG(  IF ( IFNULL(H.TAHMINI_HASAR,0)=0, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,NULL)),0) AS MULLAK_GIRISI_YAPILMAYAN_DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(IFNULL(H.TAHMINI_HASAR,0)=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS MULLAK_GIRISI_YAPILMAYAN_30_ADET,

                    COUNT(DISTINCT IF(NA.ACIK_NOTU IS NOT NULL, H.ID, NULL)) AS NEDEN_ACIK_DOSYALAR,
                    FORMAT( AVG(  IF ( NA.ACIK_NOTU IS NOT NULL, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,NULL)),0) AS NEDEN_ACIK_DOSYALAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(NA.ACIK_NOTU IS NOT NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS NEDEN_ACIK_DOSYALAR_30_ADET,

                    FORMAT((H.IHBAR_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                    FORMAT((H.TAHMINI_HASAR),2) AS EKSPER_MUALLAK_TUTAR,

                    COUNT(DISTINCT IF(E.ID IS NULL AND F.ID IS NULL, H.ID, NULL)) AS FOTO_EVRAK_YUKLENMEMIS_ADET,
                    FORMAT( AVG( DISTINCT IF ( E.ID IS NULL AND F.ID IS NULL, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,NULL)),0) AS FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(E.ID IS NULL AND F.ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS FOTO_EVRAK_YUKLENMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.RUCU =1, H.ID, NULL)) AS RUCU_ISARETLI,
                    FORMAT( AVG(  IF ( H.RUCU =1, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT ) ,NULL)),0) AS RUCU_ISARETLI_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.RUCU =1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS RUCU_ISARETLI_30_ADET
                FROM
                    YANGIN_HASAR H
                LEFT JOIN USERS U ON H.USER_ID = U.ID
                LEFT JOIN YANGIN_NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID
                LEFT JOIN YANGIN_HASAR_EKLER E ON H.ID = E.HASAR_ID
                LEFT JOIN YANGIN_HASAR_FOTO F ON H.ID = F.HASAR_ID
                INNER JOIN YANGIN_HASAR_SEKLI S ON S.ID = H.POLICE_TURU_ID
                LEFT JOIN YANGIN_DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                LEFT JOIN YANGIN_HASAR_EASY YHS ON H.ID = YHS.DOSYA_ID
                WHERE
                    H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                    AND IFNULL(H.DOSYA_STATU,0) = 0
                    AND H.DOSYA_NO NOT LIKE '%TEST%'
                    $kriter2
                    $this->otodisiKullaniciKriter
                GROUP
                    BY H.ID
            ";
        //if(dbg()) {echo($sql); }
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $otodisi_arr[] = $row;
        }

        return $otodisi_arr;
    }

    function servisBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        if($param=="servis2"){
            $kriter .=  " AND H.DOSYA_STATU = 0 AND IFNULL(HDO.DOSYA_ID,0)=0";
        }

        if($param=="servis3"){
            $kriter .=  " AND HDS.MESAJ = 1 AND HDS.ONAY = 0 AND H.SERVIS_DOSYA =1 AND H.DOSYA_STATU = 0 AND IFNULL(HDS.DOSYA_ID,0)>0";
        }

        if($param=="servis4"){
            $kriter .=  " AND H.DOSYA_STATU = 1 AND HDO.DOSYA_ID IS NULL";
        }

        if($param=="servis5"){
            $kriter .=  " AND H.SERVIS_DOSYA =1 AND H.DOSYA_STATU = 1 AND HDO.DURUM_ID =2";
        }

        if($param=="servis6"){
            $kriter .=  " AND HD.ID IS NULL";
            $table .= " LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO";
        }

        if($param=="servis7"){
            $kriter .=  " AND H.SIPARIS_UYGUN='1' AND H.SIPARIS_VAR=1";
        }

        if($param=="servis8"){
            $kriter .=  " AND NA.ACIK_NOTU IS NOT NULL";
            $table.="LEFT JOIN NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID";
        }

        if($param=="servis9"){
            $kriter .=  " AND IFNULL(H.TAHMINI_HASAR,0)=0";
        }

        if($param=="servis11"){
            $kriter .=  " AND AD.SERVIS_ONAYSIZ =2";
            $col    .=  " FORMAT( AVG( DISTINCT IF ( AD.SERVIS_ONAYSIZ =2 , DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS TOTAL_MBL_BEKLEYEN_ORT_GECEN_SURE,";
            $table  .=  " LEFT JOIN ( SELECT H.KAYIT_TARIH_SAAT,AD.ID, AD.SERVIS_ONAYSIZ, A.DOSYA_ID FROM AUTOKING_DETAIL AD INNER JOIN AUTOKING A ON A.ID = AD.AUTOKING_ID LEFT JOIN $this->hasarTable H ON A.DOSYA_ID = H.ID WHERE AD.SERVIS_ONAYSIZ = 2 AND H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59' AND IFNULL(H.SERVIS_DOSYA,0) =1 ) AD ON AD.DOSYA_ID = H.ID";
        }

        if($param=="servis12"){
            $kriter .=  " AND CASE WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID END";
            $table .= " LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO";
        }

        if($param=="servis13"){
            $kriter .=  " AND CASE
                            WHEN H.SERVIS_DOSYA =1 AND HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                            WHEN H.SERVIS_DOSYA =1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN H.SERVIS_DOSYA =1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN H.SERVIS_DOSYA =1 AND HD.ISLEM=3 THEN H.ID
                            END ";
            $table .= " LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO";
        }

        if($param=="servis14"){
            $kriter .=  " AND H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0) ";
        }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($param=="servis15"){
            $kriter .=  " AND NA.ACIK_NOTU IS NOT NULL ";
        }

        if($param=="servis16"){
            $kriter .=  " AND DATEDIFF(H.HASAR_TARIHI,H.SB_POLICE_BAS)<30 ";
        }

        if($param=="servis17"){
            $kriter .=  " AND H.FOTOVAR=0";
        }

        if($param=="servis18"){
            $kriter .=  " AND IFNULL(HDO.DOSYA_ID,0) = 0 AND IFNULL(HDD.ID,0)=0 AND H.CLOSER_DATE IS NULL";
            $table .= "LEFT JOIN HKMEKS_DOSYA_DETAY HDD ON HDD.DOSYA_ID = H.ID";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
            SELECT
                H.ID AS H_ID,
                HH.HASH AS DOSYA_HASH,
                IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                H.DOSYA_NO,
                M.MARKA_ADI,
                LEFT(SR.ADI,30) AS SERVIS,
                IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                SERVIS_IL.ADI AS SERVIS_ILI,
                FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                HS.SEKIL AS HASAR_SEKLI,
                H.HASAR_TARIHI,
                H.KAYIT_TARIH_SAAT,
                FORMAT(AVG(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)),0) AS DOSYA_ORT_GECEN_SURE,
                DS.AD AS DOSYA_SORUMLUSU,
                $col
                H.SIGORTA_SEKLI
            FROM $this->hasarTable AS H
            LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
            LEFT JOIN USERS U ON U.U_NAME  = H.USER_EKSPER
            LEFT JOIN HKMEKS_DOSYA_SORUMLULARI HDS ON HDS.DOSYA_ID = H.ID
            LEFT JOIN HKMEKS_DOSYA_ONAY HDO ON HDO.DOSYA_ID = H.ID
            LEFT JOIN NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID
            LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
            LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
            LEFT JOIN AS_HASAR_SEKLI HS ON H.HASAR_SEKLI = HS.ID
            LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
            LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
            LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
            $table
            WHERE
                H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                AND IFNULL(H.SERVIS_DOSYA, 0) = 1
                AND IFNULL(U.OTOMOTIV, 0) != 1
                AND IFNULL(U.HKM_EKSPER, 0) = 1
                AND IFNULL(U.FATURALI_KULLANICI, 0) = 1
                AND H.DOSYA_NO NOT LIKE '%TEST%'
                AND IFNULL(HDO.DURUM_ID, 0) = 0
                $kriter
                $this->kullaniciKriter
            GROUP BY H.ID
        ";
        //if(dbg()) { echo $sql; die; }
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $servis_arr[] = $row;
        }
        return $servis_arr;
    }

    function faturaliBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        //parça hareketi yok
        if($param=="faturali2"){
            $kriter .=  " AND HD.ID IS NULL";
        }

        //servis yok
        if($param=="faturali3"){
            $kriter .=  " AND H.SERVIS_ID IS NULL ";
        }

        //ted uygun
        if($param=="faturali4"){
            $kriter .=  " AND H.SIPARIS_UYGUN='1' AND H.SIPARIS_VAR=1";
        }

        //evrak yüklenmemiþ
        if($param=="faturali5"){
            $kriter .=  " AND H.FOTOVAR=0";
        }

        //yp
        if($param=="faturali6"){
            $kriter .=  " AND CASE WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID END";
        }

        //isc
        if($param=="faturali7"){
            $kriter .=  " AND CASE
                            WHEN HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN HD.ISLEM=3 THEN H.ID
                          END";
        }

        if($param=="faturali8"){
            $kriter .=  " AND H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0) ";
        }

        if($param=="faturali9"){
            $kriter .=  " AND NA.ACIK_NOTU IS NOT NULL ";
        }

        if($param=="faturali10"){
            $kriter .=  " AND DATEDIFF(H.HASAR_TARIHI,H.SB_POLICE_BAS)<30 ";
        }

        if($param=="faturali11"){
            $kriter .=  " AND IFNULL(H.TAHMINI_HASAR,0)=0 ";
        }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
                SELECT
                    H.ID AS H_ID,
                    HH.HASH AS DOSYA_HASH,
                    IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                    H.DOSYA_NO,
                    M.MARKA_ADI,
                    U.U_NAME AS FATURA_KULLANICI_KODU,
                    LEFT(SR.ADI,30) AS SERVIS,
                    IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                    IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                    SERVIS_IL.ADI AS SERVIS_ILI,
                    FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                    HS.SEKIL AS HASAR_SEKLI,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    H.SIGORTA_SEKLI,
                    COUNT(DISTINCT IF(H.DOSYA_STATU=0, H.ID, NULL)) AS TOPLAM_DOSYA_SAYISI,
                    FORMAT(AVG(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)),0) AS DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DOSYA_30_GECEN_SURE,
                    COUNT( DISTINCT
                            CASE
                            WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN H.ESKI_GIRIS=1 AND IFNULL(HD2.VERITABANINDA,0) =  1  THEN  H.ID
                            WHEN H.ESKI_GIRIS=1 AND IFNULL(HD2.VERITABANINDA,0) <> 1  THEN  H.ID
                            END
                    ) AS DEGISIM_ADET,
                    COUNT( DISTINCT
                        CASE
                        WHEN H.ESKI_GIRIS!=1 AND HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                        WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN H.ESKI_GIRIS!=1 AND HD.ISLEM=3 THEN H.ID
                        WHEN H.ESKI_GIRIS=1 AND HD3.ADET>0 THEN H.ID
                        END
                    ) AS ONARIM_ADET,

                    FORMAT( AVG( DISTINCT IF ( ((H.ESKI_GIRIS!=1 AND HD.ISLEM = 1) OR (HD2.ID IS NOT NULL)) , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DEGISIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(((H.ESKI_GIRIS!=1 AND HD.ISLEM = 1) OR (HD2.ID IS NOT NULL)) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DEGISIM_30_ADET,

                    FORMAT( AVG( DISTINCT IF ( ((H.ESKI_GIRIS!=1 AND HD.ISLEM NOT IN (1)) OR (HD2.ID IS NOT NULL)) ,  DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,0)),0) AS ONARIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(((H.ESKI_GIRIS!=1 AND HD.ISLEM NOT IN (1)) OR (HD2.ID IS NOT NULL)) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ONARIM_30_ADET,

                    COUNT(DISTINCT IF(HD.ID IS NULL AND HD2.ID IS NULL , H.ID,NULL)) AS PARCA_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( HD.ID IS NULL AND HD2.ID IS NULL, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS PARCA_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ID IS NULL AND HD2.ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS PARCA_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL, H.ID, NULL)) AS SERVIS_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.SERVIS_ID IS NULL , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SERVIS_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SERVIS_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1, H.ID, NULL)) AS SIPARIS_UYGUN_DOSYALAR,
                    FORMAT( AVG( DISTINCT IF ( H.SIPARIS_UYGUN=1 AND H.SERVIS_TUR_ID!=1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SERVIS_TUR_ID!=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SIPARIS_UYGUN_DOSYALAR_30_ADET,

                    COUNT(DISTINCT IF(H.FOTOVAR=0, H.ID, NULL)) AS FOTO_EVRAK_YUKLENMEMIS_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.FOTOVAR=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.FOTOVAR=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS FOTO_EVRAK_YUKLENMEMIS_30_ADET

                FROM
                    $this->hasarTable H
                    LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                    LEFT JOIN HKMEKS_DOSYA_SORUMLULARI HDS ON HDS.DOSYA_ID = H.ID
                    LEFT JOIN USERS U ON U.U_NAME  = H.USER_EKSPER
                    LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO
                    LEFT JOIN HASAR_YEDEK_PARCA HD2 ON HD2.ONAY_NO = H.ONAY_NO
                    LEFT JOIN HASAR_ISCILIK HD3 ON H.ONAY_NO = HD3.ONAY_NO
                    LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
                    LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                    LEFT JOIN AS_HASAR_SEKLI HS ON H.HASAR_SEKLI = HS.ID
                    LEFT JOIN NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID
                    LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                    LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                    LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
                WHERE
                        H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                        AND (IFNULL(U.FATURALI_KULLANICI, 0) = '1'  AND IFNULL(U.HKM_EKSPER, 0) = 0 AND IFNULL(OTOMOTIV, 0) = '0')
                        AND IFNULL(H.DOSYA_STATU,0)=0
                        AND H.DOSYA_NO NOT LIKE '%TEST%'
                        $kriter
                        $this->kullaniciKriter
                GROUP BY H.ID
            ";
            //ECHO $sql;
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $faturali_arr[] = $row;
        }
        return $faturali_arr;
    }

    function teknikIncemeciBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        //parça hareketi yok
        if($param=="teiknikincelemeci2"){
            $kriter .=  " AND HD.ID IS NULL";
        }

        //servis yok
        if($param=="teiknikincelemeci3"){
            $kriter .=  " AND H.SERVIS_ID IS NULL ";
        }

        //ted uygun
        if($param=="teiknikincelemeci4"){
            $kriter .=  " AND H.SIPARIS_UYGUN='1' AND H.SIPARIS_VAR=1";
        }

        //evrak yüklenmemiþ
        if($param=="teiknikincelemeci5"){
            $kriter .=  " AND PA.ID IS NULL";
        }

        //yp
        if($param=="teiknikincelemeci6"){
            $kriter .=  " AND CASE WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID END";
        }

        //isc
        if($param=="teiknikincelemeci7"){
            $kriter .=  " AND CASE
                            WHEN HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN HD.ISLEM=3 THEN H.ID
                          END";
        }

        if($param=="teiknikincelemeci8"){
            $kriter .=  " AND H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0) ";
        }

        if($param=="teiknikincelemeci9"){
            $kriter .=  " AND NA.ACIK_NOTU IS NOT NULL ";
        }

        if($param=="teiknikincelemeci10"){
            $kriter .=  " AND DATEDIFF(H.HASAR_TARIHI,H.SB_POLICE_BAS)<30 ";
        }

        if($param=="teiknikincelemeci11"){
            $kriter .=  " AND IFNULL(H.TAHMINI_HASAR,0)=0 ";
        }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
                SELECT
                    H.ID AS H_ID,
                    HH.HASH AS DOSYA_HASH,
                    IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                    H.DOSYA_NO,
                    M.MARKA_ADI,
                    U.U_NAME AS FATURA_KULLANICI_KODU,
                    LEFT(SR.ADI,30) AS SERVIS,
                    IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                    IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                    SERVIS_IL.ADI AS SERVIS_ILI,
                    FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                    HS.SEKIL AS HASAR_SEKLI,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    H.SIGORTA_SEKLI,
                    COUNT(DISTINCT IF(H.DOSYA_STATU=0, H.ID, NULL)) AS TOPLAM_DOSYA_SAYISI,
                    FORMAT(AVG(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)),0) AS DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DOSYA_30_GECEN_SURE,
                    COUNT( DISTINCT
                            CASE
                            WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN H.ESKI_GIRIS=1 AND IFNULL(HD2.VERITABANINDA,0) =  1  THEN  H.ID
                            WHEN H.ESKI_GIRIS=1 AND IFNULL(HD2.VERITABANINDA,0) <> 1  THEN  H.ID
                            END
                    ) AS DEGISIM_ADET,
                    COUNT( DISTINCT
                        CASE
                        WHEN H.ESKI_GIRIS!=1 AND HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                        WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN H.ESKI_GIRIS!=1 AND HD.ISLEM=3 THEN H.ID
                        WHEN H.ESKI_GIRIS=1 AND HD3.ADET>0 THEN H.ID
                        END
                    ) AS ONARIM_ADET,

                    FORMAT( AVG( DISTINCT IF ( ((H.ESKI_GIRIS!=1 AND HD.ISLEM = 1) OR (HD2.ID IS NOT NULL)) , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DEGISIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(((H.ESKI_GIRIS!=1 AND HD.ISLEM = 1) OR (HD2.ID IS NOT NULL)) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DEGISIM_30_ADET,

                    FORMAT( AVG( DISTINCT IF ( ((H.ESKI_GIRIS!=1 AND HD.ISLEM NOT IN (1)) OR (HD2.ID IS NOT NULL)) ,  DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,0)),0) AS ONARIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(((H.ESKI_GIRIS!=1 AND HD.ISLEM NOT IN (1)) OR (HD2.ID IS NOT NULL)) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ONARIM_30_ADET,

                    COUNT(DISTINCT IF(HD.ID IS NULL AND HD2.ID IS NULL , H.ID,NULL)) AS PARCA_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( HD.ID IS NULL AND HD2.ID IS NULL, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS PARCA_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ID IS NULL AND HD2.ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS PARCA_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL, H.ID, NULL)) AS SERVIS_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.SERVIS_ID IS NULL , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SERVIS_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SERVIS_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1, H.ID, NULL)) AS SIPARIS_UYGUN_DOSYALAR,
                    FORMAT( AVG( DISTINCT IF ( H.SIPARIS_UYGUN=1 AND H.SERVIS_TUR_ID!=1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SERVIS_TUR_ID!=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SIPARIS_UYGUN_DOSYALAR_30_ADET,

                    COUNT(DISTINCT IF(H.FOTOVAR=0, H.ID, NULL)) AS FOTO_EVRAK_YUKLENMEMIS_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.FOTOVAR=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.FOTOVAR=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS FOTO_EVRAK_YUKLENMEMIS_30_ADET

                FROM $this->hasarTable AS H
                LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                LEFT JOIN HKMEKS_DOSYA_SORUMLULARI HDS ON HDS.DOSYA_ID = H.ID
                LEFT JOIN USERS U ON U.U_NAME  = H.USER_EKSPER
                LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO
                LEFT JOIN HASAR_YEDEK_PARCA HD2 ON HD2.ONAY_NO = H.ONAY_NO
                LEFT JOIN HASAR_ISCILIK HD3 ON H.ONAY_NO = HD3.ONAY_NO
                LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
                LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                LEFT JOIN AS_HASAR_SEKLI HS ON H.HASAR_SEKLI = HS.ID
                LEFT JOIN NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID
                LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
                WHERE
                        H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                        AND IFNULL(U.TEKNIK_INC,0) =1
                        AND IFNULL(H.DOSYA_STATU,0)=0
                        AND H.DOSYA_NO NOT LIKE '%TEST%'
                        $kriter
                        $this->kullaniciKriter
                GROUP BY H.ID
            ";
            //ECHO $sql;
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $teknikincelemeci_arr[] = $row;
        }
        return $teknikincelemeci_arr;
    }

    function camBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        //parça hareketi yok
        if($param=="cam2"){
            $kriter .=  " AND HD.ID IS NULL";
        }

        //servis yok
        if($param=="cam3"){
            $kriter .=  " AND H.SERVIS_ID IS NULL ";
        }

        //ted uygun
        if($param=="cam4"){
            $kriter .=  " AND H.SIPARIS_UYGUN='1' AND H.SIPARIS_VAR=1";
        }

        //evrak yüklenmemiþ
        if($param=="cam5"){
            $kriter .=  " AND H.FOTOVAR=0";
        }

        //yp
        if($param=="cam6"){
            $kriter .=  " AND CASE WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID END";
        }

        //isc
        if($param=="cam7"){
            $kriter .=  " AND CASE
                            WHEN HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                            WHEN HD.ISLEM=3 THEN H.ID
                          END";
        }

        if($param=="cam8"){
            $kriter .=  " AND H.SIGORTA_SEKLI=1 AND (IFNULL(HMA.MARKA_ID,0) =0 OR IFNULL(HMA.MODEL_KODU,0)=0) ";
        }

        if($param=="cam9"){
            $kriter .=  " AND NA.ACIK_NOTU IS NOT NULL ";
        }

        if($param=="cam10"){
            $kriter .=  " AND DATEDIFF(H.HASAR_TARIHI,H.SB_POLICE_BAS)<30 ";
        }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
                SELECT
                    H.ID AS H_ID,
                    HH.HASH AS DOSYA_HASH,
                    IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                    H.DOSYA_NO,
                    M.MARKA_ADI,
                    U.U_NAME AS FATURA_KULLANICI_KODU,
                    LEFT(SR.ADI,30) AS SERVIS,
                    IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                    IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                    SERVIS_IL.ADI AS SERVIS_ILI,
                    FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                    HS.SEKIL AS HASAR_SEKLI,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    H.SIGORTA_SEKLI,
                    COUNT(DISTINCT IF(H.DOSYA_STATU=0, H.ID, NULL)) AS TOPLAM_DOSYA_SAYISI,
                    FORMAT(AVG(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)),0) AS DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DOSYA_30_GECEN_SURE,
                    COUNT( DISTINCT
                            CASE
                            WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 THEN  H.ID
                            WHEN H.ESKI_GIRIS=1 AND IFNULL(HD2.VERITABANINDA,0) =  1  THEN  H.ID
                            WHEN H.ESKI_GIRIS=1 AND IFNULL(HD2.VERITABANINDA,0) <> 1  THEN  H.ID
                            END
                    ) AS DEGISIM_ADET,
                    COUNT( DISTINCT
                        CASE
                        WHEN H.ESKI_GIRIS!=1 AND HD.ISLEM=1 AND HD.MINI_ID=0 AND ((IFNULL(HD.SOKTAK,0) + IFNULL(HD.BOYA_TUTAR,0) + IFNULL(HD.TAMIR,0))>0) THEN H.ID
                        WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN H.ESKI_GIRIS!=1 AND IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=2 THEN  H.ID
                        WHEN H.ESKI_GIRIS!=1 AND HD.ISLEM=3 THEN H.ID
                        WHEN H.ESKI_GIRIS=1 AND HD3.ADET>0 THEN H.ID
                        END
                    ) AS ONARIM_ADET,

                    FORMAT( AVG( DISTINCT IF ( ((H.ESKI_GIRIS!=1 AND HD.ISLEM = 1) OR (HD2.ID IS NOT NULL)) , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DEGISIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(((H.ESKI_GIRIS!=1 AND HD.ISLEM = 1) OR (HD2.ID IS NOT NULL)) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DEGISIM_30_ADET,

                    FORMAT( AVG( DISTINCT IF ( ((H.ESKI_GIRIS!=1 AND HD.ISLEM NOT IN (1)) OR (HD2.ID IS NOT NULL)) ,  DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,0)),0) AS ONARIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(((H.ESKI_GIRIS!=1 AND HD.ISLEM NOT IN (1)) OR (HD2.ID IS NOT NULL)) AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS ONARIM_30_ADET,

                    COUNT(DISTINCT IF(HD.ID IS NULL AND HD2.ID IS NULL , H.ID,NULL)) AS PARCA_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( HD.ID IS NULL AND HD2.ID IS NULL, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS PARCA_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ID IS NULL AND HD2.ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS PARCA_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL, H.ID, NULL)) AS SERVIS_GIRILMEMIS_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.SERVIS_ID IS NULL , DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SERVIS_GIRILMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SERVIS_ID IS NULL AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SERVIS_GIRILMEMIS_30_ADET,

                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1, H.ID, NULL)) AS SIPARIS_UYGUN_DOSYALAR,
                    FORMAT( AVG( DISTINCT IF ( H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS SIPARIS_UYGUN_DOSYALAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.SIPARIS_UYGUN=1 AND H.SIPARIS_VAR=1 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS SIPARIS_UYGUN_DOSYALAR_30_ADET,

                    COUNT(DISTINCT IF(H.FOTOVAR=0, H.ID, NULL)) AS FOTO_EVRAK_YUKLENMEMIS_ADET,
                    FORMAT( AVG( DISTINCT IF ( H.FOTOVAR=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT ) ,NULL)),0) AS FOTO_EVRAK_YUKLENMEMIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(H.FOTOVAR=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS FOTO_EVRAK_YUKLENMEMIS_30_ADET
                FROM
                    $this->hasarTable H
                    LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                    LEFT JOIN HKMEKS_DOSYA_SORUMLULARI HDS ON HDS.DOSYA_ID = H.ID
                    LEFT JOIN USERS U ON U.U_NAME  = H.USER_EKSPER
                    LEFT JOIN HASAR_DETAIL HD ON H.ONAY_NO = HD.ONAY_NO
                    LEFT JOIN HASAR_YEDEK_PARCA HD2 ON HD2.ONAY_NO = H.ONAY_NO
                    LEFT JOIN HASAR_ISCILIK HD3 ON H.ONAY_NO = HD3.ONAY_NO
                    LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
                    LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                    LEFT JOIN AS_HASAR_SEKLI HS ON H.HASAR_SEKLI = HS.ID
                    LEFT JOIN NEDEN_ACIK NA ON H.ID = NA.DOSYA_ID
                    LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                    LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                    LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
                WHERE
                        H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                        AND U.FATURALI_KULLANICI=1
                        AND IFNULL(U.OTOMOTIV,0)=1
                        AND IFNULL(U.HKM_EKSPER,0) =0
                        AND IFNULL(H.DOSYA_STATU,0)=0
                        AND H.DOSYA_NO NOT LIKE '%TEST%'
                        $kriter
                        $this->kullaniciKriter
                GROUP BY H.ID
            ";
            //ECHO $sql;
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $cam_arr[] = $row;
        }
        return $cam_arr;
    }

    function tedarikBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        //if($param=="tedarik2"){ $kriter .=  " AND KT.ID"; }

        //ihale
        if($param=="tedarik1"){ $group_by .= " GROUP BY S.ID";}
        if($param=="tedarik2"){ $group_by .= " GROUP BY S.ID";}
        if($param=="tedarik3"){
            $kriter     .=  " AND S2.STATUS=1 AND S2.IHALE_BITTI <> 1";
            $group_by   .=  " GROUP BY S2.ID";
        }
        if($param=="tedarik4"){
            $kriter   .= " AND S2.STATUS = 2 AND S2.IHALE_BITTI <> 1";
            $group_by .= " GROUP BY S2.ID";
        }

        //stok kontrol
        if($param=="tedarik5"){ $kriter .=  " AND S.STATUS=1"; $group_by .= " GROUP BY S.ID"; }
        if($param=="tedarik6"){ $kriter .=  " AND SD.STATUS = 1 AND (S.SEVK_TARIHI IS NULL OR S.SEVK_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00'"; $group_by .= " GROUP BY S.ID"; }
        if($param=="tedarik7"){ $kriter .=  " AND SD.STATUS = 1 AND (S.TESLIM_TARIHI IS NULL OR S.TESLIM_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00'";  $group_by .= " GROUP BY S.ID";}
        if($param=="tedarik8"){ $kriter .=  " AND SD.STATUS = 1 AND SUP.ID IS NULL AND S.TARIH_TEDARIKCI>='2019-01-01 01:00:00' AND H.DOSYA_STATU = 0 AND CONCAT(H.ID,'-',S.SIPARIS_GRUP)"; $group_by .= " GROUP BY S.ID"; }
        if($param=="tedarik9"){ $kriter .=  " AND SD.STATUS = 4 AND (SD.IADE_ONAY = 0 OR SD.IADE_ONAY IS NULL)"; $group_by .= " GROUP BY SD.ID"; }
        if($param=="tedarik10"){ $kriter .= " AND SD.ERTELEME_SEBEP=1"; $group_by .= " GROUP BY SD.ID";}
        if($param=="tedarik11"){ $kriter .= " AND S.KARGO_TAKIP_KODU=''"; $group_by .= " GROUP BY S.ID"; }
        if($param=="tedarik12"){ $group_by .= " GROUP BY H.ID"; }
        if($sorumlu!=NULL && $sorumlu!=-1){  $kriter .=  " AND DS.ID='$sorumlu'"; }
        if($brans!=NULL && $brans!=-1){  $kriter .=  " AND H.SIGORTA_SEKLI='$brans'"; }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        if($param!="tedarik2"){
        $sql = "
                SELECT
                    H.ID AS H_ID,
                    HH.HASH AS DOSYA_HASH,
                    IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                    H.DOSYA_NO,
                    M.MARKA_ADI,
                    SU.NAME AS TEDARIKCI,
                    LEFT(SR.ADI,30) AS SERVIS,
                    IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                    IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                    SERVIS_IL.ADI AS SERVIS_ILI,
                    FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    S.TARIH_SIPARIS,
                    S.TARIH_TEDARIKCI,
                    ".( ($param=='tedarik6' || $param=='tedarik8') ? "
                    DATEDIFF( NOW(), S.TARIH_TEDARIKCI ) AS FARK_GUN,
                    " : "" )."
                    ".( ( $param=='tedarik7') ? "
                    IF(SD.STATUS = 1 AND (S.TESLIM_TARIHI IS NULL OR S.TESLIM_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00', DATEDIFF( NOW(), S.TARIH_TEDARIKCI ), NULL) AS FARK_GUN,
                    " : "" )."
                    ".( ( $param=='tedarik9') ? "
                    DATEDIFF( NOW(),SD.TARIH_IADE ) AS FARK_GUN,
                    " : "" )."
                    ".( ($param=='tedarik5') ? "
                    DATEDIFF( NOW(), S.TARIH_SIPARIS ) AS FARK_GUN,
                    " : "" )."
                    ".( ($param=='tedarik1') ? "
                    IF(H.DOSYA_STATU = 0 AND S.TARIH_TEDARIKCI IS NULL, DATEDIFF(NOW(), S.TARIH_SIPARIS), DATEDIFF(S.TARIH_TEDARIKCI, S.TARIH_SIPARIS)) AS FARK_GUN,
                    " : "" )."
                    ".( ($param=='tedarik3') ? "
                    IF ( S2.STATUS = 1 ,  DATEDIFF( NOW(), S2.TARIH_SIPARIS ) ,NULL) AS FARK_GUN,
                    " : "" )."
                    ".( ($param=='tedarik4') ? "
                    IF ( S2.STATUS = 2 ,  DATEDIFF( NOW(), S2.TARIH_TEDARIKCI ) ,NULL) AS FARK_GUN,
                    " : "" )."

                    COUNT(DISTINCT IF(H.DOSYA_STATU=0, H.ID, NULL)) AS TOPLAM_DOSYA_SAYISI,
                    FORMAT( AVG( DISTINCT IF ( H.DOSYA_STATU=0 , DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF ( H.DOSYA_STATU = 0 AND DATEDIFF(NOW(), H.KAYIT_TARIH_SAAT)> 30, H.ID,NULL)) DOSYA_30_GECEN_SURE,

                    COUNT(DISTINCT IF(H.DOSYA_STATU=0, S.ID, NULL)) AS TOPLAM_SIPARIS_SAYISI,
                    FORMAT( AVG( DISTINCT IF ( H.DOSYA_STATU=0 , DATEDIFF( NOW(), S.TARIH_SIPARIS )  ,NULL)),0) AS SIPARIS_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF ( H.DOSYA_STATU = 0 AND DATEDIFF(NOW(), S.TARIH_SIPARIS)> 30, S.ID,NULL)) SIPARIS_30_GECEN_SURE,

                    COUNT( DISTINCT
                            CASE
                            WHEN IFNULL(HD.VERITABANINDA,0) =  1 AND HD.ISLEM=1 AND SD.STATUS=0 THEN  H.ID
                            WHEN IFNULL(HD.VERITABANINDA,0) <> 1 AND HD.ISLEM=1 AND SD.STATUS=0 THEN  H.ID
                            END
                    ) AS DEGISIM_ADET,

                    FORMAT( AVG( DISTINCT IF ( HD.ISLEM =1 AND SD.STATUS=0, DATEDIFF( NOW(), HD.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DEGISIM_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF(HD.ISLEM =1 AND SD.STATUS=0 AND DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)>30,H.ID,NULL)) AS DEGISIM_30_ADET,

                    ".( ($this->companyId == 48 || $this->companyId == 70 || $this->companyId == 75 || $this->companyId == 80) ? "
                    COUNT(S2.ID) AS SAY_YENI_IHALE,
                    COUNT(DISTINCT SD2.SIPARIS_ID) AS SAY_CEVAPLANAN_IHALE,
                    " : "" )."

                    COUNT(DISTINCT IF( S.STATUS = 1,S.ID,NULL)) AS STOK_KONTROL_SAY,
                    COUNT(DISTINCT IF(SD.STATUS = 1 AND (S.SEVK_TARIHI IS NULL OR S.SEVK_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00', S.ID, NULL)) AS SEVK_EDILECEK_SAY,
                    COUNT(DISTINCT IF(SD.STATUS = 1 AND (S.TESLIM_TARIHI IS NULL OR S.TESLIM_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00', S.ID, NULL)) AS TESLIM_EDILECEK_SAY,
                    COUNT(DISTINCT IF(SD.STATUS = 1 AND SUP.ID IS NULL AND S.TARIH_TEDARIKCI>='2019-01-01 01:00:00', S.ID, NULL) ) AS FATURA_SAY,
                    COUNT(DISTINCT IF(SD.STATUS = 4 AND (SD.IADE_ONAY = 0 OR SD.IADE_ONAY IS NULL), S.ID, NULL)) AS IADE_SAY,
                    COUNT(DISTINCT IF(SD.STATUS = 4 AND SD.IADE_ONAY = 1 AND (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(SD.TARIH_IADE))<2592000, S.ID, NULL)) AS ONAYLANMIS_IADE_SAY,

                    FORMAT( AVG(  IF ( S.STATUS = 1 ,  DATEDIFF( NOW(), S.TARIH_SIPARIS ) ,NULL)),0) AS STOK_KONTROL_ORT_GECEN_SURE,
                    FORMAT( AVG(  IF ( SD.STATUS = 1 AND (S.SEVK_TARIHI IS NULL OR S.SEVK_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00' ,  DATEDIFF( NOW(), S.TARIH_TEDARIKCI ) ,NULL)),0) AS SEVK_EDILECEK_ORT_GECEN_SURE,
                    FORMAT( AVG(  IF ( SD.STATUS = 1 AND (S.TESLIM_TARIHI IS NULL OR S.TESLIM_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00' ,  DATEDIFF( NOW(), S.TARIH_TEDARIKCI ) ,NULL)),0) AS TESLIM_EDILECEK_ORT_GECEN_SURE,
                    FORMAT( AVG(  IF ( SD.STATUS = 1 AND SUP.ID IS NULL AND S.TARIH_TEDARIKCI>='2019-01-01 01:00:00' AND H.DOSYA_STATU = 0 ,  DATEDIFF( NOW(), S.TARIH_TEDARIKCI ) ,NULL)),0) AS FATURA_GECEN_ORT_SURE,
                    FORMAT( AVG(  IF ( SD.STATUS = 4 AND (SD.IADE_ONAY = 0 OR SD.IADE_ONAY IS NULL) ,  DATEDIFF( NOW(),SD.TARIH_IADE ) ,NULL)),0) AS IADE_ORT_GECEN_SURE,
                    FORMAT( AVG(  IF ( SD.STATUS = 4 AND SD.IADE_ONAY = 1 AND (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(SD.TARIH_IADE))<2592000,  DATEDIFF( NOW(), SD.TARIH_IADE ),NULL)),0) AS ONAYLANMAMIS_ORT_GECEN_SURE,

                    COUNT(DISTINCT IF(S.STATUS = 1 AND DATEDIFF(NOW(),S.TARIH_SIPARIS)>30,S.ID,NULL)) AS STOK_KONTROL_30_ADET,
                    COUNT(DISTINCT IF(SD.STATUS = 1 AND (S.SEVK_TARIHI IS NULL OR S.SEVK_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00' AND DATEDIFF(NOW(),S.TARIH_TEDARIKCI)>30,S.ID,NULL)) AS SEVK_EDILECEK_30_ADET,
                    COUNT(DISTINCT IF(SD.STATUS = 1 AND (S.TESLIM_TARIHI IS NULL OR S.TESLIM_TARIHI = '0000-00-00 00:00:00') AND S.TARIH_TEDARIKCI >= '2019-01-01 00:00:00' AND DATEDIFF(NOW(),S.TARIH_TEDARIKCI)>30,S.ID,NULL)) AS TESLIM_EDILECEK_30_ADET,
                    COUNT(DISTINCT IF(SD.STATUS = 1 AND SUP.ID IS NULL AND S.TARIH_TEDARIKCI>='2019-01-01 01:00:00' AND H.DOSYA_STATU = 0 AND DATEDIFF(NOW(),S.TARIH_TEDARIKCI)>30,S.ID,NULL)) AS FATURA_30_ADET,
                    COUNT(DISTINCT IF(SD.STATUS = 4 AND (SD.IADE_ONAY = 0 OR SD.IADE_ONAY IS NULL) AND DATEDIFF( NOW(),SD.TARIH_IADE )>30,S.ID,NULL)) AS IADE_30_ADET,
                    COUNT(DISTINCT IF(SD.STATUS = 4 AND SD.IADE_ONAY = 1 AND (UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(SD.TARIH_IADE))<2592000 AND DATEDIFF(NOW(),SD.TARIH_IADE)>30,S.ID,NULL)) AS ONAYLANMIS_IADE_30_ADET,

                    ".( ($this->companyId == 75) ? " COUNT(DISTINCT SD.ERTELEME_SEBEP=1,1,0) AS YURT_DISI_SAY,   " : "" )."
                    ".( ($this->companyId == 18) ? " COUNT(DISTINCT S.KARGO_TAKIP_KODU=1,1,0) AS KARGO_TAKIPNO_GIRILMEYENLER,    " : "" )."
                    1
                FROM $this->hasarTable H
                LEFT JOIN SIPARIS S ON H.ID = S.DOSYA_ID
                LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                LEFT JOIN SIPARIS_USERS SU ON SU.ID = S.TEDARIKCI_ID
                LEFT JOIN SERVIS SR ON S.SERVIS_ID = SR.ID
                LEFT JOIN SIPARIS_DETAIL SD ON SD.SIPARIS_ID = S.ID
                LEFT JOIN HASAR_DETAIL HD ON HD.ID = SD.YEDPAR_ID
                LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                LEFT JOIN USERS ON USERS.U_NAME = H.USER_EKSPER
                LEFT JOIN SIPARIS_UPLOAD SUP ON SUP.SIPARIS_ID = S.ID
                ".( ($this->companyId == 48 || $this->companyId == 70 || $this->companyId == 75 || $this->companyId == 80) ? "
                LEFT JOIN SIPARIS2 S2 ON S2.DOSYA_ID = H.ID
                LEFT JOIN SIPARIS_DETAIL2 SD2 ON SD2.SIPARIS_ID = S2.ID
                " : "" )."
                LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
                WHERE
                    H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                    AND H.DOSYA_STATU = 0
                    AND H.DOSYA_NO NOT LIKE '%TEST%'
                    AND H.SIPARIS_UYGUN=1
                    AND H.SIPARIS_VAR = 1
                    $kriter
                    $this->kullaniciKriter
                    $group_by
            ";
            }
            else
            {
                $sql = "
                    SELECT
                        FORMAT( AVG( IF ( H.DOSYA_STATU=0 , DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DOSYA_ORT_GECEN_SURE,
                        DATEDIFF( NOW(), KT.TARIH_EKSPER ) AS FARK_GUN,
                        H.ID AS H_ID,
                        HH.HASH AS DOSYA_HASH,
                        IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                        H.DOSYA_NO,
                        M.MARKA_ADI,
                        SU.NAME AS TEDARIKCI,
                        LEFT(SR.ADI,30) AS SERVIS,
                        IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                        IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                        SERVIS_IL.ADI AS SERVIS_ILI,
                        FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                        H.HASAR_TARIHI,
                        H.KAYIT_TARIH_SAAT,
                        KT.TARIH_EKSPER AS KT_TARIH_EKSPER,
                        COUNT(DISTINCT KT.DOSYA_ID) AS EKSPER_TALEP_SAY,
                        COUNT(DISTINCT KT.ID) AS EKSPER_TALEP_PARCA_SAY,
                        FORMAT( AVG( IF ( KT.YP_KOD IS NULL AND KT.TARIH_TEDARIKCI IS NULL, DATEDIFF(NOW(), KT.TARIH_EKSPER), NULL ) ), 0) AS EKSPER_TALEP_ORT_GECEN_SURE,
                        COUNT( DISTINCT IF (KT.YP_KOD IS NULL AND KT.TARIH_TEDARIKCI IS NULL AND DATEDIFF(NOW(), H.KAYIT_TARIH_SAAT) > 30, KT.ID, NULL )) AS EKSPER_TALEP_30_ADET
                    FROM
                        EKS_YPKOD_TALEP KT
                        INNER JOIN $this->hasarTable H ON H.ID= KT.DOSYA_ID
                        LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                        LEFT JOIN SIPARIS_USERS SU ON SU.ID = KT.TEDARIKCI_ID
                        LEFT JOIN SERVIS SR ON SR.ID = H.SERVIS_ID
                        LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                        LEFT JOIN USERS ON USERS.U_NAME = H.USER_EKSPER
                        LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                        LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                        LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
                    WHERE
                        H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                    AND H.DOSYA_STATU = 0
                    AND H.DOSYA_NO NOT LIKE '%TEST%'
                    AND H.SIPARIS_UYGUN=1
                    #AND H.SIPARIS_VAR = 1
                    AND KT.YP_KOD IS NULL
                    AND KT.TARIH_TEDARIKCI IS NULL
                    AND KT.DOSYA_ID IS NOT NULL
                    $kriter
                    $this->kullaniciKriter
                  GROUP BY
                        KT.DOSYA_ID

                ";
            }
            //ECHO $sql; Die;
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $tedarik_arr[] = $row;
        }
        return $tedarik_arr;
    }

    function mobilOnarimBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}
        if($param=="mobilonarim1"){ $having .=  " HAVING MO_KONU_DOSYA_ADET"; }
        if($param=="mobilonarim2"){ $kriter .=  " AND IFNULL(AD.ID,0)>0"; }
        if($param=="mobilonarim3"){ $kriter .=  " AND IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0) IN (0,5)"; }
        if($param=="mobilonarim4"){ $kriter .=  " AND HD.ISLEM=1 AND IFNULL(AD.ID,0)=0 "; }
        if($param=="mobilonarim5"){ $kriter .=  " AND IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=3"; }
        if($param=="mobilonarim6"){ $kriter .=  " AND IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=1"; }
        if($param=="mobilonarim7"){ $kriter .=  " AND IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=2"; }
        if($param=="mobilonarim9"){ $kriter .=  " AND IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=4"; }
        if($param=="mobilonarim8"){ $kriter .=  " AND IFNULL(MOP.ID,0)>0"; }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
        SELECT
            T.H_ID,
            T.DOSYA_HASH,
            T.BRANS,
            T.DOSYA_NO,
            T.MARKA_ADI,
            T.SERVIS_EKSPER,
            T.SERVIS,
            T.SERVIS_TURU,
            T.ANLASMA,
            T.SERVIS_ILI,
            T.IHBAR_MUALLAK_TUTAR,
            T.HASAR_TARIHI,
            T.KAYIT_TARIH_SAAT,
            ".( ($param=='mobilonarim1') ? "  FORMAT(AVG(T.MO_FARK_KONU_DOSYA),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim2') ? "  FORMAT(AVG(T.MO_FARK_GONDERILEN),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim3') ? "  FORMAT(AVG(T.MO_FARK_CEVAP_BEKLEYEN),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim4') ? "  FORMAT(AVG(T.MO_FARK_GONDERILMEYEN),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim5') ? "  FORMAT(AVG(T.MO_FARK_MODUL_IPTAL),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim6') ? "  FORMAT(AVG(T.MO_FARK_ONARILAN),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim7') ? "  FORMAT(AVG(T.MO_FARK_ONARILAMAYAN),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim8') ? "  FORMAT(( IF(IFNULL(MOP.ID,0)>0, (DATEDIFF(IFNULL(MOI.BITIS_TARIHI,(DATE_SUB(MOI.GONDERIM_TARIHI, INTERVAL -2 DAY))),MOI.GONDERIM_TARIHI)),NULL)),0) AS DOSYA_ORT_GECEN_SURE," : "" )."
            ".( ($param=='mobilonarim9') ? "  FORMAT(AVG(T.MO_FARK_DEGERLENDIRILMEYEN),0) AS DOSYA_ORT_GECEN_SURE," : "" )."

            SUM(T.MO_KONU_DOSYA_ADET) AS MO_KONU_DOSYA_ADET,
            SUM(T.MO_KONU_PARCA_ADET) AS MO_KONU_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_KONU_DOSYA),0) AS MO_KONU_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_KONU_DOSYA>30,T.H_ID,NULL)) AS MO_KONU_30_DOSYA_ADET,

            SUM(T.POLICE_FARK_DOSYA_SAY) AS POLICE_FARK_DOSYA_SAY,
            FORMAT(AVG(IF(DATEDIFF(T.HASAR_TARIHI,T.SB_POLICE_BAS)<30,DATEDIFF(NOW(),T.H_KAYIT_TARIH_SAAT),NULL)),0) AS POLICE_FARK_ORT_GECEN_SURE,
            COUNT(DISTINCT IF(DATEDIFF(T.HASAR_TARIHI,T.SB_POLICE_BAS)<30 AND DATEDIFF(NOW(),T.H_KAYIT_TARIH_SAAT)>30, T.H_ID,NULL)) AS POLICE_FARK_30_GECEN_SURE,

            SUM(T.MO_GONDERILEN_DOSYA_ADET) AS MO_GONDERILEN_DOSYA_ADET,
            SUM(T.MO_GONDERILEN_PARCA_ADET) AS MO_GONDERILEN_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_GONDERILEN),0) AS MO_GONDERILEN_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_GONDERILEN>30,T.H_ID,NULL)) AS MO_GONDERILEN_30_DOSYA_ADET,

            SUM(T.MO_CEVAP_BEKLEYEN_DOSYA_ADET) AS MO_CEVAP_BEKLEYEN_DOSYA_ADET,
            SUM(T.MO_CEVAP_BEKLEYEN_PARCA_ADET) AS MO_CEVAP_BEKLEYEN_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_CEVAP_BEKLEYEN),0) AS MO_CEVAP_BEKLEYEN_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_CEVAP_BEKLEYEN>30,T.H_ID,NULL)) AS MO_CEVAP_BEKLEYEN_30_DOSYA_ADET,

            SUM(T.MO_GONDERILMEYEN_DOSYA_ADET) AS MO_GONDERILMEYEN_DOSYA_ADET,
            SUM(T.MO_GONDERILMEYEN_PARCA_ADET) AS MO_GONDERILMEYEN_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_GONDERILMEYEN),0) AS MO_GONDERILMEYEN_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_GONDERILMEYEN>30,T.H_ID,NULL)) AS MO_GONDERILMEYEN_30_DOSYA_ADET,

            SUM(T.MO_MODUL_IPTAL_DOSYA_ADET) AS MO_MODUL_IPTAL_DOSYA_ADET,
            SUM(T.MO_MODUL_IPTAL_PARCA_ADET) AS MO_MODUL_IPTAL_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_MODUL_IPTAL),0) AS MO_MODUL_IPTAL_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_MODUL_IPTAL>30,T.H_ID,NULL)) AS MO_MODUL_IPTAL_30_DOSYA_ADET,

            SUM(T.MO_ONARILAN_DOSYA_ADET) AS MO_ONARILAN_DOSYA_ADET,
            SUM(T.MO_ONARILAN_PARCA_ADET) AS MO_ONARILAN_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_ONARILAN),0) AS MO_ONARILAN_ORT_SURE,
            FORMAT(SUM(T.MO_ONARILAN_PARCA_TUTAR),2) AS MO_ONARILAN_PARCA_TUTAR,
            COUNT(DISTINCT IF(T.MO_FARK_ONARILAN>30,T.H_ID,NULL)) AS MO_ONARILAN_30_DOSYA_ADET,

            SUM(T.MO_ONARILAMAYAN_DOSYA_ADET) AS MO_ONARILAMAYAN_DOSYA_ADET,
            SUM(T.MO_ONARILAMAYAN_PARCA_ADET) AS MO_ONARILAMAYAN_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_ONARILAMAYAN),0) AS MO_ONARILAMAYAN_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_ONARILAMAYAN>30,T.H_ID,NULL)) AS MO_ONARILAMAYAN_30_DOSYA_ADET,

            SUM(T.MO_DEGERLENDIRILMEYEN_DOSYA_ADET) AS MO_DEGERLENDIRILMEYEN_DOSYA_ADET,
            SUM(T.MO_DEGERLENDIRILMEYEN_PARCA_ADET) AS MO_DEGERLENDIRILMEYEN_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_DEGERLENDIRILMEYEN),0) AS MO_DEGERLENDIRILMEYEN_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_DEGERLENDIRILMEYEN>30,T.H_ID,NULL)) AS MO_DEGERLENDIRILMEYEN_30_DOSYA_ADET,

            ".( ($this->companyId == 19) ? "
            #ihale DOSYA
            SUM(T.MO_IHALE_DOSYA_ADET) AS MO_IHALE_DOSYA_ADET,
            SUM(T.MO_IHALE_PARCA_ADET) AS MO_IHALE_PARCA_ADET,
            FORMAT(AVG(T.MO_FARK_IHALE_PARCA),0) AS MO_DEGERLENDIRILMEYEN_ORT_SURE,
            COUNT(DISTINCT IF(T.MO_FARK_IHALE_PARCA>30,T.H_ID,NULL)) AS MO_DEGERLENDIRILMEYEN_30_DOSYA_ADET,
            " : "" )."
            1
    FROM (
        SELECT
                H.ID AS H_ID,
                HH.HASH AS DOSYA_HASH,
                AU.ID AS AU_ID,
                H.KAYIT_TARIH_SAAT AS H_KAYIT_TARIH_SAAT,
                IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                H.DOSYA_NO,
                M.MARKA_ADI,
                LEFT(U.NAME,30) AS SERVIS_EKSPER,
                LEFT(AU.NAME,30) AS SERVIS,
                IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                SERVIS_IL.ADI AS SERVIS_ILI,
                FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                H.HASAR_TARIHI,
                H.KAYIT_TARIH_SAAT,
                H.SB_POLICE_BAS,

                /*KONU DOSYA*/
                COUNT(DISTINCT IF(((HD.ISLEM=1 AND IFNULL(AD.ID,0)=0) OR (IFNULL(AD.ID,0)>0)),H.ID,NULL)) AS MO_KONU_DOSYA_ADET,
                COUNT(DISTINCT IF(((HD.ISLEM=1 AND IFNULL(AD.ID,0)=0) OR (IFNULL(AD.ID,0)>0)),HD.ID,NULL)) AS MO_KONU_PARCA_ADET,
                IF(((HD.ISLEM=1 AND IFNULL(AD.ID,0)=0) OR (IFNULL(AD.ID,0)>0)),DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT),DATEDIFF(NOW(),H.KAYIT_TARIH_SAAT)) AS MO_FARK_KONU_DOSYA,

                /*POLICE DOSYA*/
                COUNT(DISTINCT IF(DATEDIFF(H.HASAR_TARIHI,H.SB_POLICE_BAS)<30,H.ID,NULL )) AS POLICE_FARK_DOSYA_SAY,

                /*GONDERILEN DOSYA*/
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0,H.ID,NULL)) AS MO_GONDERILEN_DOSYA_ADET,
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0,AD.ID,NULL)) AS MO_GONDERILEN_PARCA_ADET,
                IF(IFNULL(AD.ID,0)>0, DATEDIFF(MAX(IFNULL(AD.MODIFIED_AT,NOW())),MIN(AD.CREATED_AT)), NULL) AS MO_FARK_GONDERILEN,

                /*CEVAP_BEKLEYEN DOSYA*/
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0) IN (0,5),H.ID,NULL)) AS MO_CEVAP_BEKLEYEN_DOSYA_ADET,
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0) IN (0,5),AD.ID,NULL)) AS MO_CEVAP_BEKLEYEN_PARCA_ADET,
                IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0) IN (0,5), DATEDIFF(MAX(IFNULL(IFNULL(AD.MODIFIED_AT,NOW()),NOW())),MIN(AD.CREATED_AT)),NULL ) AS MO_FARK_CEVAP_BEKLEYEN,

                /*GONDERILMEYEN DOSYA*/
                COUNT(DISTINCT IF(HD.ISLEM=1 AND IFNULL(AD.ID,0)=0,H.ID,NULL)) AS MO_GONDERILMEYEN_DOSYA_ADET,
                COUNT(DISTINCT IF(HD.ISLEM=1 AND IFNULL(AD.ID,0)=0,HD.ID,NULL)) AS MO_GONDERILMEYEN_PARCA_ADET,
                IF(HD.ISLEM=1 AND IFNULL(AD.ID,0)=0,(DATEDIFF(NOW(),MIN(HD.KAYIT_TARIH_SAAT))),NULL) AS MO_FARK_GONDERILMEYEN,

                /*MODUL_IPTAL DOSYA*/
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=3,H.ID,NULL)) AS MO_MODUL_IPTAL_DOSYA_ADET,
                COUNT(DISTINCT IF( IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=3,AD.ID,NULL)) AS MO_MODUL_IPTAL_PARCA_ADET,
                IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=3, DATEDIFF(MAX(IFNULL(AD.MODIFIED_AT,NOW())),MIN(AD.CREATED_AT)), NULL) AS MO_FARK_MODUL_IPTAL,

                /*ONARILAN DOSYA*/
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=1,H.ID,NULL)) AS MO_ONARILAN_DOSYA_ADET,
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=1,AD.ID,NULL)) AS MO_ONARILAN_PARCA_ADET,
                IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=1,AD.AUTOKING_FIYATI,0) AS MO_ONARILAN_PARCA_TUTAR,
                IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=1, DATEDIFF(MAX(IFNULL(AD.MODIFIED_AT,NOW())),MIN(AD.CREATED_AT)), NULL) AS MO_FARK_ONARILAN,

                /*ONARILAMAYAN DOSYA*/
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=2,H.ID,NULL)) AS MO_ONARILAMAYAN_DOSYA_ADET,
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=2,AD.ID,NULL)) AS MO_ONARILAMAYAN_PARCA_ADET,
                IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=2, DATEDIFF(MAX(IFNULL(AD.MODIFIED_AT,NOW())),MIN(AD.CREATED_AT)), NULL) AS MO_FARK_ONARILAMAYAN,

                /*DEGERLENDIRILMEYEN DOSYA*/
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=4,H.ID,NULL)) AS MO_DEGERLENDIRILMEYEN_DOSYA_ADET,
                COUNT(DISTINCT IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=4,AD.ID,NULL)) AS MO_DEGERLENDIRILMEYEN_PARCA_ADET,
                IF(IFNULL(AD.ID,0)>0 AND IFNULL(AD.STATUS,0)=4, (DATEDIFF(IFNULL(AD.MODIFIED_AT,NOW()),A.CREATED_AT)),NULL) AS MO_FARK_DEGERLENDIRILMEYEN,
                ".( ($this->companyId == 19) ? "
                        COUNT(DISTINCT IF(IFNULL(MOP.ID,0)>0,MOI.ID,NULL)) AS MO_IHALE_DOSYA_ADET,
                        COUNT(DISTINCT IF(IFNULL(MOP.ID,0)>0,MOP.ID,NULL)) AS MO_IHALE_PARCA_ADET,
                        IF(IFNULL(MOP.ID,0)>0, (DATEDIFF(IFNULL(MOI.BITIS_TARIHI,(DATE_SUB(MOI.GONDERIM_TARIHI, INTERVAL -2 DAY))),MOI.GONDERIM_TARIHI)),NULL) AS MO_FARK_IHALE_PARCA,
                " : "" )."
                1
        FROM $this->hasarTable H
        LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
        LEFT JOIN HASAR_DETAIL HD ON HD.ONAY_NO = H.ONAY_NO
        LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME
        LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
        LEFT JOIN AUTOKING A ON A.DOSYA_ID = H.ID
        LEFT JOIN AUTOKING_DETAIL AD ON AD.AUTOKING_ID = A.ID
        LEFT JOIN AUTOKING_USERS AU ON AU.ID = A.AUTOKING_USER_ID
        LEFT JOIN ILLER AS SERVIS_IL ON SERVIS_IL.ID = AU.IL_ID
        LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
        LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
        ".( ($this->companyId == 19) ? "
        LEFT JOIN MOBIL_ONARIM_IHALE MOI ON MOI.DOSYA_ID = H.ID
        LEFT JOIN MOBIL_ONARIM_IHALE_PARCALAR MOP ON MOP.IHALE_ID = MOI.ID
        " : "" )."
            WHERE
                H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                AND H.USER_EKSPER NOT IN ('EKSPER','ANS001')
                AND H.PERT != 1
                AND IFNULL(H.DOSYA_STATU,0) = 0
                AND H.DOSYA_NO NOT LIKE '%TEST%'
                AND (
                 HD.PARCA_ID IN (1,2,10,11,15,20,27,28,43,44,47,49,50,51,52,57,60,62,123,132,301,302,320,321,322,327,334,335,342,343,344,345,347,348,351,358,359,360,369,386,391,526,583,584,649,650,651)
                 OR(HD.GRUP_ID = 2 AND HD.ALT_GRUP IN (586,591,592,595,597,598,599,600,606,608,631,640,1112,1635,1778,1779,1800))
                 OR(HD.GRUP_ID = 4 AND HD.ALT_GRUP IN (646,650,652,653,654))
                 OR(HD.GRUP_ID = 10 AND HD.ALT_GRUP IN (687,690))
                 OR(HD.GRUP_ID = 12 AND HD.ALT_GRUP = 853)
                )
                $kriter
                $this->kullaniciKriter
        GROUP BY
            H.ID, AD.ID
) T
GROUP BY
    T.H_ID, T.AU_ID
$having
            ";
            //echo $sql;
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $mobilonarim_arr[] = $row;
        }
        return $mobilonarim_arr;
    }

    function arastirmaciBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        if($param=="arastirmaci1"){ $kriter .=  " AND R.ID"; }
        if($param=="arastirmaci2"){ $kriter .=  " AND R.DURUM = 2"; }
        if($param=="arastirmaci3"){ $kriter .=  " AND R.DURUM = 3"; }
        if($param=="arastirmaci4"){ $kriter .=  " AND R.DURUM = 4"; }
        if($param=="arastirmaci5"){ $kriter .=  " AND R.DURUM = 5"; }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
            SELECT
                H.ID AS H_ID,
                HH.HASH AS DOSYA_HASH,
                IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                H.DOSYA_NO,
                M.MARKA_ADI,
                IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                SERVIS_IL.ADI AS SERVIS_ILI,
                FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                H.HASAR_TARIHI,
                R.VERILIS_TARIH,
                R.CLOSER_DATE,
                R.DENETCI_CLOSER_DATE,
                U1.NAME AS ARASTIRMACI,
                U2.NAME AS DENETCI,
                ".( ($param=='arastirmaci1') ? "
                FORMAT( AVG( IF ( R.ID , DATEDIFF( NOW(), R.VERILIS_TARIH ) ,NULL)),0) AS DOSYA_ORT_GECEN_SURE,
                " : "" )."
                COUNT(R.ID) AS ARS_VERILMIS_DOSYA_SAYISI,
                SUM(IF(R.DURUM = 2, 1, 0)) AS ARASTIRMACIDA_OLAN_DOSYA_SAYISI,
                ".( ($param=='arastirmaci2') ? "
                FORMAT ( AVG( IF (R.DURUM = 2, DATEDIFF(NOW(), R.VERILIS_TARIH),NULL) ), 0) AS DOSYA_ORT_GECEN_SURE,
                " : "" )."
                SUM(IF(R.DURUM = 3, 1, 0)) AS DENETCIDE_OLAN_DOSYA_SAYISI,
                ".( ($param=='arastirmaci3') ? "
                FORMAT( AVG( IF(R.DURUM = 3, DATEDIFF(NOW(), R.CLOSER_DATE),NULL) ), 0) AS DOSYA_ORT_GECEN_SURE,
                " : "" )."
                SUM(IF(R.DURUM = 5, 1, 0)) AS IPTAL_DOSYA_SAYISI,
                SUM(IF(R.DURUM = 4, 1, 0)) AS TAMAMLANMIS_DOSYA_SAYISI,
                ".( ($param=='arastirmaci4') ? "
                FORMAT(AVG(IF(R.DURUM = 4, DATEDIFF(R.DENETCI_CLOSER_DATE, R.VERILIS_TARIH),NULL)),0) AS DOSYA_ORT_GECEN_SURE,
                " : "" )."
                1
            FROM HASAR_ARASTIRMA_RAPOR AS R
            INNER JOIN $this->hasarTable AS H ON H.ID = R.DOSYA_ID
            LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
            LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
            LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
            LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
            LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
            LEFT JOIN USERS U1 ON R.USER_ID = U1.ID /*ARASTIRMACÝ*/
            LEFT JOIN USERS U2 ON R.DOSYA_SORUMLUSU = U2.ID /*DENERÇÝ*/
            LEFT JOIN HASAR_HASH HH ON HH.HASAR_ID = H.ID
            WHERE
                    R.VERILIS_TARIH  BETWEEN '".$ay_basi."' AND '".$ay_sonu."'
                    AND H.DOSYA_NO NOT LIKE '%TEST%'
                    $kriter
                    $this->kullaniciKriter
            GROUP BY  R.ID
            ";
            //echo $sql;
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $arastirmaci_arr[] = $row;
        }
        return $arastirmaci_arr;
    }

    function uzmanBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}
        if($act!=1){ die;}

        if($param=="uzman1"){ $kriter .=  " AND IFNULL( H.USER_UZMAN, '' ) != ''"; }
        if($param=="uzman2"){ $kriter .=  " AND IFNULL(PH.ID,0)=0 AND IFNULL(H.UZMAN_ONAY,0) != 1 AND H.USER_UZMAN IS NOT NULL";
                              $TABLE  .= " LEFT JOIN PHOTO_ARCHIVE PH ON H.ONAY_NO = PH.ONAY_NO";
                            }
        if($param=="uzman3"){
                            $kriter .=  " AND IFNULL(PH.ID,0) > 0 AND H.USER_UZMAN IS NOT NULL AND PH.USERNAME = H.USER_UZMAN";
                            $TABLE  .= " LEFT JOIN PHOTO_ARCHIVE PH ON H.ONAY_NO = PH.ONAY_NO";
                            }
        if($param=="uzman4"){ $kriter .=  " AND IFNULL(K1.ID,0) > 0 AND K1.KONTROL=1"; }
        if($param=="uzman5"){ $kriter .=  " AND IFNULL(K1.ID,0) > 0  AND K1.KONTROL=2"; }
        if($param=="uzman6"){ $kriter .=  " AND H.DOSYA_STATU = 1  AND H.USER_UZMAN IS NOT NULL  AND IFNULL( H.UZMAN_ONAY, 0 ) <> 1"; }
        if($param=="uzman7"){
                                $kriter .=  " AND IFNULL(H.UZMAN_ONAY, 0) != 1 AND ACIK_NOTU='Araç Serviste Bulunamadý'";
                                $TABLE  .=  " LEFT JOIN HASAR_UZMAN_KONTROL HUK ON HUK.ONAY_NO=H.ONAY_NO";
                            }

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
            SELECT
                H.ID AS H_ID,
                IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                H.DOSYA_NO,
                M.MARKA_ADI,
                LEFT(U.NAME,30) AS EKSPER,
                ".( ($this->companyId == 27) ? "
                LEFT(U2.RAPOR_ADI,30) AS UZMAN,
                " : "" )."
                ".( ($this->companyId != 27) ? "
                LEFT(U2.NAME,30) AS UZMAN,
                " : "" )."
                LEFT(SR.ADI,30) AS SERVIS,
                SERVIS_IL.ADI AS SERVIS_ILI,
                IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                H.HASAR_TARIHI,
                LEFT(H.KAYIT_TARIH_SAAT,10) AS KAYIT_TARIH_SAAT,
                LEFT(H.EKSPER_UZMAN_TARIH,10) AS EKSPER_UZMAN_TARIH,
                COUNT( H.ID ) AS TOPLAM_DOSYA_ADET,
                FORMAT((H.SS_TAHMINI_HASAR),2) AS IHBAR_MUALLAK_TUTAR,
                COUNT( IF ( IFNULL( H.USER_UZMAN, '' ) != '', H.ID, NULL ) ) AS UZMAN_ATANAN_ADET,
                ".( ($param=='uzman1') ? "
                FORMAT( AVG( IF ( IFNULL( H.USER_UZMAN, '' ) != '', DATEDIFF( NOW(), H.EKSPER_UZMAN_TARIH )  ,NULL)), 0 ) AS DOSYA_GECEN_SURE,
                " : "" )."
                ".( ($param=='uzman2') ? "
                COUNT( DISTINCT IF (IFNULL(PH.ID,0)=0, H.ID, NULL ) ) AS EVRAK_YUKLENMEYEN_ADET,
                FORMAT( AVG( IF (  IFNULL(PH.ID,0) =0, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DOSYA_GECEN_SURE,
                " : "" )."
                ".( ($param=='uzman3') ? "
                SUM( IF ( IFNULL(PH.ID,0) > 0, 1, 0 ) ) AS EVRAK_YUKLENEN_ADET,
                FORMAT( AVG( IF (  IFNULL(PH.ID,0) > 0, DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DOSYA_GECEN_SURE,
                " : "" )."
                ".( ($param=='uzman4') ? "
                SUM( IF ( IFNULL(K1.ID,0) > 0 AND K1.KONTROL=1, 1, 0 ) ) AS BIRINCI_KONTROL_ADET,
                FORMAT( AVG( IF ( K1.KONTROL=1, DATEDIFF( NOW(), H.EKSPER_UZMAN_TARIH ) ,NULL)),0) AS DOSYA_GECEN_SURE,
                " : "" )."
                ".( ($param=='uzman5') ? "
                SUM( IF ( IFNULL(K1.ID,0) > 0  AND K1.KONTROL=2, 1, 0 ) ) AS IKINCI_KONTROL_ADET,
                FORMAT( AVG( IF ( IFNULL(K1.ID,0) > 0  AND K1.KONTROL=2, DATEDIFF( NOW(), H.EKSPER_UZMAN_TARIH ) ,NULL)),0) AS DOSYA_GECEN_SURE,
                " : "" )."
                ".( ($param=='uzman6') ? "
                SUM( IF( H.DOSYA_STATU = 1  AND H.USER_UZMAN IS NOT NULL  AND IFNULL( H.UZMAN_ONAY, 0 ) <> 1, 1,0 ) ) AS EKSPER_KAPALI_UZMAN_ONAY_BEKLEYEN_ADET,
                FORMAT( AVG( IF ( H.DOSYA_STATU = 1  AND H.USER_UZMAN IS NOT NULL  AND IFNULL( H.UZMAN_ONAY, 0 ) <> 1, DATEDIFF( NOW(), H.EKSPER_UZMAN_TARIH ) ,NULL)),0) AS DOSYA_GECEN_SURE,
                " : "" )."
                ".( ($param=='uzman7') ? "
                FORMAT( AVG( IF ( HUK.ID IS NOT NULL, DATEDIFF( NOW(), HUK.TARIH )  ,NULL)),0) AS DOSYA_GECEN_SURE,
                " : "" )."
                1
            FROM
                $this->hasarTable H
                LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                LEFT JOIN UZMAN_KONTROL AS K1 ON K1.ONAY_NO = H.ONAY_NO
                LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME
                LEFT JOIN USERS U2 ON H.USER_UZMAN = U2.U_NAME
                LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
                LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                $TABLE
            WHERE
                    H.KAYIT_TARIH_SAAT BETWEEN '".$ay_basi." 00:00:00' AND '".$ay_sonu." 23:59:59'
                    AND H.DOSYA_NO NOT LIKE '%TEST%'
                    AND IFNULL(H.UZMAN_ONAY,0) != 1
                    $kriter
                    $this->kullaniciKriter
            GROUP BY H.ID
            ";
            //if(dbg()) { echo $sql;    die;}
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $uzman_arr[] = $row;
        }
        return $uzman_arr;
    }

    function alternatifTamirBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,$act){

        if( ($this->kullaniciKontrol() == '2') ) { return false;}

        if($act!=1){ die;}

        if($sorumlu!=NULL && $sorumlu!=-1){
            $kriter .=  " AND DS.ID='$sorumlu'";
        }

        if($brans!=NULL && $brans!=-1){
            $kriter .=  " AND H.SIGORTA_SEKLI='$brans'";
        }

        if($param=="alternatif1"){ $kriter .=  " AND TA.DURUM_ID= '1'"; }
        if($param=="alternatif2"){ $kriter .=  " AND TA.DURUM_ID= '2'"; }
        if($param=="alternatif6"){ $kriter .=  " AND TA.DURUM_ID= '6'"; }

        if($servis_turu==1){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1'";}
        if($servis_turu==2){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0'";}
        if($servis_turu==3){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==4){ $kriter .=  " AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==5){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==6){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='1'";}
        if($servis_turu==7){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='1' AND IFNULL(H.ANLASMALI, 0)='0'";}
        if($servis_turu==8){ $kriter .=  " AND IFNULL(H.SERVIS_TUR_ID, 0)='0' AND IFNULL(H.ANLASMALI, 0)='0'";}

        if($this->DEF_DOSYA_SORUMLUSU){
            $kriter .=  " AND DS.ID='".$this->defUserID."'";
        }

        $sql = "
                SELECT
                    IF(H.SIGORTA_SEKLI=1,'Trafik','Kasko') AS BRANS,
                    H.DOSYA_NO,
                    M.MARKA_ADI,
                    LEFT(U.NAME,30) AS EKSPER,
                    LEFT(U2.NAME,30) AS UZMAN,
                    LEFT(SR.ADI,30) AS SERVIS,
                    SERVIS_IL.ADI AS SERVIS_ILI,
                    IF(IFNULL(H.SERVIS_TUR_ID, 0) = 1, 'Yetkili', 'Özel') SERVIS_TURU,
                    IF(IFNULL(H.ANLASMALI, 0)= 1, 'Anlaþmalý', 'Anlaþmasýz') ANLASMA,
                    H.HASAR_TARIHI,
                    H.KAYIT_TARIH_SAAT,
                    COUNT(TA.ID) AS TOPLAM_DOSYA_ADET,
                    FORMAT( AVG( DISTINCT IF ( TA.ID , DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS DOSYA_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF ( TA.ID AND DATEDIFF(NOW(), H.KAYIT_TARIH_SAAT)> 30, H.ID,NULL)) DOSYA_30_GECEN_SURE,

                    COUNT(CASE WHEN TA.DURUM_ID= '1' THEN 1 END) AS TEKLIFE_CIKACAKLAR,
                    FORMAT( AVG( DISTINCT IF ( TA.DURUM_ID= '1', DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS TEKLIFE_CIKACAKLAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF (TA.DURUM_ID= '1' AND DATEDIFF(NOW(), H.KAYIT_TARIH_SAAT)> 30, H.ID,NULL)) TEKLIFE_CIKACAKLAR_30_GECEN_SURE,

                    COUNT(CASE WHEN TA.DURUM_ID= '2' THEN 1 END) AS TEKLIF_TOPLAMADA_OLANLAR,
                    FORMAT( AVG( DISTINCT IF ( TA.DURUM_ID= '2', DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS TEKLIFE_CIKACAKLAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF (TA.DURUM_ID= '2' AND DATEDIFF(NOW(), H.KAYIT_TARIH_SAAT)> 30, H.ID,NULL)) TEKLIFE_CIKACAKLAR_30_GECEN_SURE,

                    COUNT(CASE WHEN TA.DURUM_ID= '6' THEN 1 END) AS TEKLIF_VEREN_ANLASMALI_SERVISTE_TAMIR_OLANLAR,
                    FORMAT( AVG( DISTINCT IF ( TA.DURUM_ID= '6', DATEDIFF( NOW(), H.KAYIT_TARIH_SAAT )  ,NULL)),0) AS TEKLIFE_CIKACAKLAR_ORT_GECEN_SURE,
                    COUNT(DISTINCT IF (TA.DURUM_ID= '6' AND DATEDIFF(NOW(), H.KAYIT_TARIH_SAAT)> 30, H.ID,NULL)) TEKLIFE_CIKACAKLAR_30_GECEN_SURE
                FROM
                    $this->hasarTable H
                    LEFT JOIN HASAR_MAGDUR_ARACLAR HMA ON H.ONAY_NO = HMA.ONAY_NO
                    INNER JOIN TAMIRHANE_ARACLAR TA ON H.ONAY_NO = TA.ONAY_NO
                    INNER JOIN TAMIRHANE_DOSYA_DURUM TDD ON TDD.ID = TA.DURUM_ID
                    LEFT JOIN USERS U ON H.USER_EKSPER = U.U_NAME
                    LEFT JOIN USERS U2 ON H.USER_UZMAN = U2.U_NAME
                    LEFT JOIN SERVIS SR ON H.SERVIS_ID = SR.ID
                    LEFT JOIN ILLER AS SERVIS_IL ON SR.IL = SERVIS_IL.ID
                    LEFT JOIN MARKA M ON M.MARKA_KODU = IF(H.SIGORTA_SEKLI=1, HMA.MARKA_ID, H.HAS_MARKA_ID)
                    LEFT JOIN DOSYA_SORUMLULARI DS ON DS.ID = H.DOSYA_SORUMLUSU
                WHERE
                    TA.TARIH BETWEEN '".$ay_basi."' AND '".$ay_sonu."'
                    AND IFNULL(H.DOSYA_STATU,0) = 0
                    AND H.DOSYA_NO NOT LIKE '%TEST%'
                    $kriter
                    $this->kullaniciKriter
                GROUP BY
                    H.ID
            ";
            //echo($sql);
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        while($row = mysql_fetch_array($result)){
        $altenatif_arr[] = $row;
        }
        return $altenatif_arr;
    }

    function nedenAcikBlok($param,$act){

        if($act!=1){ die("ACT");}

        $sql = "
                SELECT
                    H.DOSYA_NO,
                    NA.ACIK_NOTU
                    FROM
                $this->hasarTable H
                INNER JOIN NEDEN_ACIK NA ON NA.DOSYA_ID = H.ID
                WHERE
                    H.ID ='".$param."'
            ";
            //echo($sql);
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        $row = mysql_fetch_object($result);
        return $row;
    }

    function nedenAcikOtodisiBlok($param,$act){

        if($act!=1){ die("ACT");}

        $sql = "
                SELECT
                    H.DOSYA_NO,
                    NA.ACIK_NOTU
                    FROM
                YANGIN_HASAR H
                INNER JOIN YANGIN_NEDEN_ACIK NA ON NA.DOSYA_ID = H.ID
                WHERE
                    H.ID ='".$param."'
            ";
            //echo($sql);
        if (!($this->cdb->execute_sql($sql,$result,$error_msg))){return false;}
        $row = mysql_fetch_object($result);
        return $row;
    }

}