<?php

	require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php";
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/classes/ModulAyarlari.php");

	require "../same_funcs.php";

	require_valid_login();
	$cdb = new db_layer();

	$modal_id = $_GET['modal_id'];
	if(!$modal_id) { die("Modal Yüklenemedi");}

	require_once("chartDetailClass.php");
	$chartDetailClass 		= new chartClass();

	?>
	<?php if($modal_id=='1'){
			$marka_data_arr 		= $chartDetailClass->markaBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$filo_haric,$filo_acenteler,$faturali_haric,$modul_haric);
						foreach($marka_data_arr as $marka_data){
							$MARKA_ADI						= $marka_data['MARKA_ADI'];
							$TEDARIK_SISTEM_TUTAR_MARKA		= $marka_data['TEDARIK_SISTEM_TUTAR'];
							$TEDARIK_ISK_TUTARI_MARKA		= $marka_data['TEDARIK_ISK_TUTARI'];
							$TEDARIK_KAZANDIRILAN_MARKA		= $marka_data['TEDARIK_SISTEM_TUTAR'] - $marka_data['TEDARIK_ISK_TUTARI'];

							$TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA			= $marka_data['ORJ_TEDARIK_SISTEM_TUTAR'];
							$TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA			= $marka_data['LO_SISTEM_TUTAR'];
							$TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA			= $marka_data['ESDEGER_SISTEM_TUTAR'];

							$TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA		= $marka_data['ORJ_TEDARIK_ISK_TUTAR'];
							$TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA		= $marka_data['LO_ISK_TUTAR'];
							$TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA		= $marka_data['ESDEGER_ISK_TUTAR'];

							$TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_MARKA	= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA;
							$TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_MARKA	= $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA;
							$TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_MARKA	= $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA;

							$TOPLAM_SISTEM_TUTARI_MARKA							= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR_MARKA;
							$TOPLAM_ISKONTOLU_TUTAR_MARKA						= $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR_MARKA;
							$TOPLAM_KAZANDIRILAN_TUTAR_MARKA					= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR_MARKA;

							$TOPLAM_TEDARIK_SISTEM_TUTARI_MARKA					= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA;
							$TOPLAM_TEDARIK_ISKONTOLU_TUTAR_MARKA				= $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA;
							$TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_MARKA			= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_MARKA;


							$TD_SISTEM_TUTAR_MARKA					= $marka_data['TD_SISTEM_TUTAR'];
							$TD_ISK_TUTARI_MARKA					= $marka_data['TD_ISK_TUTAR'];
							$TD_ISKONTOLU_TUTARI_MARKA				= $marka_data['TD_ISK_TUTARI'];
							$TD_KAZANDIRILAN_MARKA 					= $marka_data['TD_SISTEM_TUTAR'] - $marka_data['TD_ISK_TUTAR'];

							$TD_LOESD_SISTEM_TUTAR_MARKA			= $marka_data['TD_YC_SISTEM_TUTAR'];
							$TD_LOESD_ISKONTOLU_MARKA				= $marka_data['TD_YC_ISK_TUTAR'];
							$TD_LOESD_KAZANDIRILAN_MARKA			= $TD_LOESD_SISTEM_TUTAR_MARKA - $TD_LOESD_ISKONTOLU_MARKA;

							$TD_ORJ_SISTEM_TUTAR_MARKA				= $TD_SISTEM_TUTAR_MARKA - $TD_LOESD_SISTEM_TUTAR_MARKA;
							$TD_ORJ_ISKONTOLU_MARKA					= $TD_ISK_TUTARI_MARKA - $TD_LOESD_ISKONTOLU_MARKA;
							$TD_ORJ_KAZANDIRILAN_MARKA				= $TD_ORJ_SISTEM_TUTAR_MARKA - $TD_ORJ_ISKONTOLU_MARKA;

							$SERVIS_ISKONTO_SISTEM_MARKA			= $marka_data['SERVIS_ORG_SISTEM_TUTAR'] + $marka_data['SERVIS_LOESD_SISTEM_TUTAR'];
							$SERVIS_ISKONTO_SERVIS_MARKA			= $marka_data['SERVIS_ORG_ISK_TUTAR'] + $marka_data['SERVIS_LOESD_ISK_TUTAR'];
							$SERVIS_KAZANDIRILAN_MARKA				= $SERVIS_ISKONTO_SISTEM_MARKA - $SERVIS_ISKONTO_SERVIS_MARKA;

							$SERVIS_ISKONTO_ORJ_SISTEM_MARKA			= $marka_data['SERVIS_ORG_SISTEM_TUTAR'];
							$SERVIS_ISKONTO_ORJ_SERVIS_MARKA			= $marka_data['SERVIS_ORG_ISK_TUTAR'];
							$SERVIS_ISKONTO_ORJ_KAZANDIRILAN_MARKA		= $SERVIS_ISKONTO_ORJ_SISTEM_MARKA - $SERVIS_ISKONTO_ORJ_SERVIS_MARKA;

							$SERVIS_ISKONTO_LOESD_SISTEM_MARKA			= $marka_data['SERVIS_LOESD_SISTEM_TUTAR'];
							$SERVIS_ISKONTO_LOESD_SERVIS_MARKA			= $marka_data['SERVIS_LOESD_ISK_TUTAR'];
							$SERVIS_ISKONTO_LOESD_KAZANDIRILAN_MARKA	= $SERVIS_ISKONTO_LOESD_SISTEM_MARKA - $SERVIS_ISKONTO_LOESD_SERVIS_MARKA;

							$ORJ_TEDARIK_SISTEM_TUTAR_MARKA			= $marka_data['ORJ_TEDARIK_SISTEM_TUTAR'];
							$ORJ_TEDARIK_KAZANDIRILAN_MARKA			= $marka_data['ORJ_TEDARIK_ISK_TUTARI'];


							$LO_TEDARIK_SISTEM_TUTAR_MARKA			= $marka_data['LO_SISTEM_TUTAR'];
							$LO_TEDARIK_KAZANDIRILAN_MARKA			= $marka_data['LO_ISK_TUTARI'];

							$ESDEGER_TEDARIK_SISTEM_TUTAR_MARKA		= $marka_data['ESDEGER_SISTEM_TUTAR'];
							$ESDEGER_TEDARIK_KAZANDIRILAN_MARKA 		= $marka_data['ESDEGER_ISK_TUTARI'];

							$ORJ_TEDARIK_ISKONTOLU_TUTAR_MARKA						= $marka_data['ORJ_TEDARIK_ISK_TUTAR'];
							$TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_MARKA			= $marka_data['LO_ISK_TUTAR'];
							$TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_MARKA			= $marka_data['ESDEGER_ISK_TUTAR'];

							$TOPLAM_KAZANDIRILAN_MARKA			= $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_MARKA+ $SERVIS_KAZANDIRILAN_MARKA + $TD_KAZANDIRILAN_MARKA;
							$TOPLAM_SISTEM_TUTAR_MARKA			= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_MARKA + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_MARKA + $SERVIS_ISKONTO_SISTEM_MARKA + $TD_SISTEM_TUTAR_MARKA;
							$TOPLAM_ISKONTO_TUTARI_MARKA 		= $TOPLAM_SISTEM_TUTAR_MARKA - $TOPLAM_KAZANDIRILAN_MARKA;
							$TOPLAM_ISKONTO_ORANI_MARKA 		= $TOPLAM_KAZANDIRILAN_MARKA / $TOPLAM_SISTEM_TUTAR_MARKA*100;

							$chart_data_marka .= "{ marka:'".$MARKA_ADI."', kazandirilan:".($TOPLAM_KAZANDIRILAN_MARKA).", iskonto_oran:".formatla($TOPLAM_ISKONTO_ORANI_MARKA)."}, ";
					}
	?>
			<div class="panel panel-warning">
				<div class="tableFixHead">
					<div id='chart_hist_marka' class='chart_morris' style='min-height:1200px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_marka',
				  dataLabels: true,
				  data:[<?php echo $chart_data_marka; ?>],
				  xkey:'marka',
				  ykeys:['kazandirilan','iskonto_oran'],
				  labels:['<?=dil_dashboard("Kazandýrýlan Tutar")?>', '<?=dil_dashboard("Ýskonto Oran(%)")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal1 end ?>

	<?php if($modal_id=='2'){
			$tedarikci_data_arr 		= $chartDetailClass->tedarikciBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$filo_haric,$filo_acenteler,$faturali_haric,$modul_haric);
			foreach($tedarikci_data_arr as $tedarikci_data){
				$TEDARIKCI_ADI						= $tedarikci_data['TEDARIKCI'];
				$TEDARIK_SISTEM_TUTAR_TED		= $tedarikci_data['TEDARIK_SISTEM_TUTAR'];
				$TEDARIK_ISK_TUTARI_TED			= $tedarikci_data['TEDARIK_ISK_TUTARI'];
				$TEDARIK_KAZANDIRILAN_TED		= $tedarikci_data['TEDARIK_SISTEM_TUTAR'] - $tedarikci_data['TEDARIK_ISK_TUTARI'];

				$TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED			= $tedarikci_data['ORJ_TEDARIK_SISTEM_TUTAR'];
				$TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED			= $tedarikci_data['LO_SISTEM_TUTAR'];
				$TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED			= $tedarikci_data['ESDEGER_SISTEM_TUTAR'];

				$TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED		= $tedarikci_data['ORJ_TEDARIK_ISK_TUTAR'];
				$TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED			= $tedarikci_data['LO_ISK_TUTAR'];
				$TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED			= $tedarikci_data['ESDEGER_ISK_TUTAR'];

				$TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_TED		= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED;
				$TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_TED		= $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED;
				$TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_TED		= $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED;

				$TOPLAM_SISTEM_TUTARI_TED							= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR_TED;
				$TOPLAM_ISKONTOLU_TUTAR_TED							= $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR_TED;
				$TOPLAM_KAZANDIRILAN_TUTAR_TED						= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR_TED;

				$TOPLAM_TEDARIK_SISTEM_TUTARI_TED					= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED;
				$TOPLAM_TEDARIK_ISKONTOLU_TUTAR_TED					= $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED;
				$TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_TED				= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_TED;


				$TD_SISTEM_TUTAR_TED					= $tedarikci_data['TD_SISTEM_TUTAR'];
				$TD_ISK_TUTARI_TED						= $tedarikci_data['TD_ISK_TUTAR'];
				$TD_ISKONTOLU_TUTARI_TED				= $tedarikci_data['TD_ISK_TUTARI'];
				$TD_KAZANDIRILAN_TED 					= $tedarikci_data['TD_SISTEM_TUTAR'] - $tedarikci_data['TD_ISK_TUTAR'];

				$TD_LOESD_SISTEM_TUTAR_TED				= $tedarikci_data['TD_YC_SISTEM_TUTAR'];
				$TD_LOESD_ISKONTOLU_TED					= $tedarikci_data['TD_YC_ISK_TUTAR'];
				$TD_LOESD_KAZANDIRILAN_TED				= $TD_LOESD_SISTEM_TUTAR_TED - $TD_LOESD_ISKONTOLU_TED;

				$TD_ORJ_SISTEM_TUTAR_TED				= $TD_SISTEM_TUTAR_TED - $TD_LOESD_SISTEM_TUTAR_TED;
				$TD_ORJ_ISKONTOLU_TED					= $TD_ISK_TUTARI_TED - $TD_LOESD_ISKONTOLU_TED;
				$TD_ORJ_KAZANDIRILAN_TED				= $TD_ORJ_SISTEM_TUTAR_TED - $TD_ORJ_ISKONTOLU_TED;

				$SERVIS_ISKONTO_SISTEM_TED				= $tedarikci_data['SERVIS_ORG_SISTEM_TUTAR'] + $tedarikci_data['SERVIS_LOESD_SISTEM_TUTAR'];
				$SERVIS_ISKONTO_SERVIS_TED				= $tedarikci_data['SERVIS_ORG_ISK_TUTAR'] + $tedarikci_data['SERVIS_LOESD_ISK_TUTAR'];
				$SERVIS_KAZANDIRILAN_TED				= $SERVIS_ISKONTO_SISTEM_TED - $SERVIS_ISKONTO_SERVIS_TED;

				$SERVIS_ISKONTO_ORJ_SISTEM_TED			= $tedarikci_data['SERVIS_ORG_SISTEM_TUTAR'];
				$SERVIS_ISKONTO_ORJ_SERVIS_TED			= $tedarikci_data['SERVIS_ORG_ISK_TUTAR'];
				$SERVIS_ISKONTO_ORJ_KAZANDIRILAN_TED	= $SERVIS_ISKONTO_ORJ_SISTEM_TED - $SERVIS_ISKONTO_ORJ_SERVIS_TED;

				$SERVIS_ISKONTO_LOESD_SISTEM_TED		= $tedarikci_data['SERVIS_LOESD_SISTEM_TUTAR'];
				$SERVIS_ISKONTO_LOESD_SERVIS_TED		= $tedarikci_data['SERVIS_LOESD_ISK_TUTAR'];
				$SERVIS_ISKONTO_LOESD_KAZANDIRILAN_TED	= $SERVIS_ISKONTO_LOESD_SISTEM_TED - $SERVIS_ISKONTO_LOESD_SERVIS_TED;

				$ORJ_TEDARIK_SISTEM_TUTAR_TED			= $tedarikci_data['ORJ_TEDARIK_SISTEM_TUTAR'];
				$ORJ_TEDARIK_KAZANDIRILAN_TED			= $tedarikci_data['ORJ_TEDARIK_ISK_TUTARI'];


				$LO_TEDARIK_SISTEM_TUTAR_TED			= $tedarikci_data['LO_SISTEM_TUTAR'];
				$LO_TEDARIK_KAZANDIRILAN_TED			= $tedarikci_data['LO_ISK_TUTARI'];

				$ESDEGER_TEDARIK_SISTEM_TUTAR_TED		= $tedarikci_data['ESDEGER_SISTEM_TUTAR'];
				$ESDEGER_TEDARIK_KAZANDIRILAN_TED 		= $tedarikci_data['ESDEGER_ISK_TUTARI'];

				$ORJ_TEDARIK_ISKONTOLU_TUTAR_TED					= $tedarikci_data['ORJ_TEDARIK_ISK_TUTAR'];
				$TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_TED			= $tedarikci_data['LO_ISK_TUTAR'];
				$TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_TED			= $tedarikci_data['ESDEGER_ISK_TUTAR'];

				$TOPLAM_KAZANDIRILAN_TED		= $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_TED+ $SERVIS_KAZANDIRILAN_TED + $TD_KAZANDIRILAN_TED;
				$TOPLAM_SISTEM_TUTAR_TED		= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_TED + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_TED + $SERVIS_ISKONTO_SISTEM_TED + $TD_SISTEM_TUTAR_TED;
				$TOPLAM_ISKONTO_TUTARI_TED 		= $TOPLAM_SISTEM_TUTAR_TED - $TOPLAM_KAZANDIRILAN_TED;
				$TOPLAM_ISKONTO_ORANI_TED		= $TOPLAM_KAZANDIRILAN_TED / $TOPLAM_SISTEM_TUTAR_TED*100;

			$chart_data_tedarikci .= "{ tedarikci:'".$TEDARIKCI_ADI."', kazandirilan:".($TOPLAM_KAZANDIRILAN_TED).", iskonto_oran:".formatla($TOPLAM_ISKONTO_ORANI_TED)."}, ";
		}

	?>
			<div class="panel panel-warning">
				<div class="tableFixHead">
					<div id='chart_hist_tedarikci' class='chart_morris' style='min-height:1200px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_tedarikci',
				  dataLabels: true,
				  data:[<?php echo $chart_data_tedarikci; ?>],
				  xkey:'tedarikci',
				  ykeys:['kazandirilan','iskonto_oran'],
				  labels:['<?=dil_dashboard("Kazandýrýlan Tutar")?>', '<?=dil_dashboard("Ýskonto Oran(%)")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal2 end ?>


	<?php if($modal_id=='3'){
			$iller_data_arr 		= $chartDetailClass->illerBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$filo_haric,$filo_acenteler,$faturali_haric,$modul_haric);
			foreach($iller_data_arr as $il_data){
				$SERVIS_IL						= $il_data['SERVIS_IL'];
				$TEDARIK_SISTEM_TUTAR_IL		= $il_data['TEDARIK_SISTEM_TUTAR'];
				$TEDARIK_ISK_TUTARI_IL			= $il_data['TEDARIK_ISK_TUTARI'];
				$TEDARIK_KAZANDIRILAN_IL		= $il_data['TEDARIK_SISTEM_TUTAR'] - $il_data['TEDARIK_ISK_TUTARI'];

				$TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL			= $il_data['ORJ_TEDARIK_SISTEM_TUTAR'];
				$TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL			= $il_data['LO_SISTEM_TUTAR'];
				$TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL			= $il_data['ESDEGER_SISTEM_TUTAR'];

				$TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL		= $il_data['ORJ_TEDARIK_ISK_TUTAR'];
				$TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL			= $il_data['LO_ISK_TUTAR'];
				$TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL			= $il_data['ESDEGER_ISK_TUTAR'];

				$TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_IL		= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL - $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL;
				$TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_IL		= $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL - $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL;
				$TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_IL		= $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL - $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL;

				$TOPLAM_SISTEM_TUTARI_IL							= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_YAPILMAYAN_SISTEM_TUTAR_IL;
				$TOPLAM_ISKONTOLU_TUTAR_IL							= $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_YAPILMAYAN_ISKONTOLU_TUTAR_IL;
				$TOPLAM_KAZANDIRILAN_TUTAR_IL						= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_YAPILMAYAN_KAZANDIRILAN_TUTAR_IL;

				$TOPLAM_TEDARIK_SISTEM_TUTARI_IL					= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL;
				$TOPLAM_TEDARIK_ISKONTOLU_TUTAR_IL					= $TOPLAM_TEDARIK_ORIJINAL_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL;
				$TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_IL				= $TOPLAM_TEDARIK_ORIJINAL_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_KAZANDIRILAN_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_KAZANDIRILAN_TUTAR_IL;


				$TD_SISTEM_TUTAR_IL					= $il_data['TD_SISTEM_TUTAR'];
				$TD_ISK_TUTARI_IL					= $il_data['TD_ISK_TUTAR'];
				$TD_ISKONTOLU_TUTARI_IL				= $il_data['TD_ISK_TUTARI'];
				$TD_KAZANDIRILAN_IL 				= $il_data['TD_SISTEM_TUTAR'] - $il_data['TD_ISK_TUTAR'];

				$TD_LOESD_SISTEM_TUTAR_IL			= $il_data['TD_YC_SISTEM_TUTAR'];
				$TD_LOESD_ISKONTOLU_IL				= $il_data['TD_YC_ISK_TUTAR'];
				$TD_LOESD_KAZANDIRILAN_IL			= $TD_LOESD_SISTEM_TUTAR_IL - $TD_LOESD_ISKONTOLU_IL;

				$TD_ORJ_SISTEM_TUTAR_IL				= $TD_SISTEM_TUTAR_IL - $TD_LOESD_SISTEM_TUTAR_IL;
				$TD_ORJ_ISKONTOLU_IL				= $TD_ISK_TUTARI_IL - $TD_LOESD_ISKONTOLU_IL;
				$TD_ORJ_KAZANDIRILAN_IL				= $TD_ORJ_SISTEM_TUTAR_IL - $TD_ORJ_ISKONTOLU_IL;

				$SERVIS_ISKONTO_SISTEM_IL			= $il_data['SERVIS_ORG_SISTEM_TUTAR'] + $il_data['SERVIS_LOESD_SISTEM_TUTAR'];
				$SERVIS_ISKONTO_SERVIS_IL			= $il_data['SERVIS_ORG_ISK_TUTAR'] + $il_data['SERVIS_LOESD_ISK_TUTAR'];
				$SERVIS_KAZANDIRILAN_IL				= $SERVIS_ISKONTO_SISTEM_IL - $SERVIS_ISKONTO_SERVIS_IL;

				$SERVIS_ISKONTO_ORJ_SISTEM_IL			= $il_data['SERVIS_ORG_SISTEM_TUTAR'];
				$SERVIS_ISKONTO_ORJ_SERVIS_IL			= $il_data['SERVIS_ORG_ISK_TUTAR'];
				$SERVIS_ISKONTO_ORJ_KAZANDIRILAN_IL		= $SERVIS_ISKONTO_ORJ_SISTEM_IL - $SERVIS_ISKONTO_ORJ_SERVIS_IL;

				$SERVIS_ISKONTO_LOESD_SISTEM_IL			= $il_data['SERVIS_LOESD_SISTEM_TUTAR'];
				$SERVIS_ISKONTO_LOESD_SERVIS_IL			= $il_data['SERVIS_LOESD_ISK_TUTAR'];
				$SERVIS_ISKONTO_LOESD_KAZANDIRILAN_IL	= $SERVIS_ISKONTO_LOESD_SISTEM_IL - $SERVIS_ISKONTO_LOESD_SERVIS_IL;

				$ORJ_TEDARIK_SISTEM_TUTAR_IL			= $il_data['ORJ_TEDARIK_SISTEM_TUTAR'];
				$ORJ_TEDARIK_KAZANDIRILAN_IL			= $il_data['ORJ_TEDARIK_ISK_TUTARI'];


				$LO_TEDARIK_SISTEM_TUTAR_IL			= $il_data['LO_SISTEM_TUTAR'];
				$LO_TEDARIK_KAZANDIRILAN_IL			= $il_data['LO_ISK_TUTARI'];

				$ESDEGER_TEDARIK_SISTEM_TUTAR_IL	= $il_data['ESDEGER_SISTEM_TUTAR'];
				$ESDEGER_TEDARIK_KAZANDIRILAN_IL 	= $il_data['ESDEGER_ISK_TUTARI'];

				$ORJ_TEDARIK_ISKONTOLU_TUTAR_IL						= $il_data['ORJ_TEDARIK_ISK_TUTAR'];
				$TOPLAM_TEDARIK_LOGOSUZ_ISKONTOLU_TUTAR_IL			= $il_data['LO_ISK_TUTAR'];
				$TOPLAM_TEDARIK_ESDEGER_ISKONTOLU_TUTAR_IL			= $il_data['ESDEGER_ISK_TUTAR'];

				$TOPLAM_KAZANDIRILAN_IL				= $TOPLAM_TEDARIK_KAZANDIRILAN_TUTAR_IL+ $SERVIS_KAZANDIRILAN_IL + $TD_KAZANDIRILAN_IL;
				$TOPLAM_SISTEM_TUTAR_IL				= $TOPLAM_TEDARIK_ORIJINAL_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_LOGOSUZ_SISTEM_TUTAR_IL + $TOPLAM_TEDARIK_ESDEGER_SISTEM_TUTAR_IL + $SERVIS_ISKONTO_SISTEM_IL + $TD_SISTEM_TUTAR_IL;
				$TOPLAM_ISKONTO_TUTARI_IL 			= $TOPLAM_SISTEM_TUTAR_IL - $TOPLAM_KAZANDIRILAN_IL;
				$TOPLAM_ISKONTO_ORANI_IL			= $TOPLAM_KAZANDIRILAN_IL / $TOPLAM_SISTEM_TUTAR_IL*100;

				$chart_data_iller .= "{ iller:'".$SERVIS_IL."', kazandirilan:".($TOPLAM_KAZANDIRILAN_IL).", iskonto_oran:".formatla($TOPLAM_ISKONTO_ORANI_IL)."}, ";
		}
	?>
			<div class="panel panel-warning">
				<div class="tableFixHead">
					<div id='chart_hist_iller' class='chart_morris' style='min-height:1200px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_iller',
				  dataLabels: true,
				  data:[<?php echo $chart_data_iller; ?>],
				  xkey:'iller',
				  ykeys:['kazandirilan','iskonto_oran'],
				  labels:['<?=dil_dashboard("Kazandýrýlan Tutar")?>', '<?=dil_dashboard("Ýskonto Oran(%)")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal3 end ?>

	<?php
	if($modal_id=='4'){
			require_once("chartLoEsdegerClass.php");
			$chartClassLoEsdeger         = new chartClassLoEsdeger();
			$top20_tedarikci_detail_arr 	= $chartClassLoEsdeger->top20TedarikciDetailBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,$param);																	
			foreach($top20_tedarikci_detail_arr as $top20_tedarikci_detail){

				$chart_data_top20_detail .= "{ tedarikci:'".$top20_tedarikci_detail["TEDARIKCI"]."', tutar:".$top20_tedarikci_detail["TUTAR_ISKONTOLU"]."}, ";
			}
	?>
			<div class="panel panel-warning">
				<div class="tableFixHead">
					<div id='chart_hist_top20' class='chart_morris' style='min-height:1200px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_top20',
				  dataLabels: true,
				  data:[<?php echo $chart_data_top20_detail; ?>],
				  xkey:'tedarikci',
				  ykeys:['tutar'],
				  labels:['<?=dil_dashboard("Tutar")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal4 end ?>


	<?php
	if($modal_id=='5'){
			require_once("chartLoEsdegerClass.php");
			$chartClassLoEsdeger         = new chartClassLoEsdeger();
			$eksper_bazinda_lo_esd_arr 	= $chartClassLoEsdeger->eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,5);
			foreach($eksper_bazinda_lo_esd_arr as $eksper_bazinda_lo_esd){

				$eksper_bazinda_lo_esd_detail .= "{ eksper:'".$eksper_bazinda_lo_esd['EKSPER']."', tutar:".($eksper_bazinda_lo_esd['TEDARIK_TOPLAM_TUTARI']).", adet:".($eksper_bazinda_lo_esd['TEDARIK_TOPLAM_ADET'])."}, ";
			}
	?>
			<div class="panel panel-warning">
				<div class="tableFixHead" style='min-height:800px;'>
					<div id='chart_hist_eksper_bazinda_loesd' class='chart_morris' style='min-height:3000px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_eksper_bazinda_loesd',
				  dataLabels: true,
				  data:[<?php echo $eksper_bazinda_lo_esd_detail; ?>],
				  xkey:'eksper',
				  ykeys:['tutar','adet'],
				  labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal5 end ?>

	<?php
	if($modal_id=='6'){
			require_once("chartLoEsdegerClass.php");
			$chartClassLoEsdeger         = new chartClassLoEsdeger();
			$eksper_bazinda_lo_esd_arr 	= $chartClassLoEsdeger->eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,6);
			foreach($eksper_bazinda_lo_esd_arr as $eksper_bazinda_lo_esd){

				$eksper_bazinda_lo_detail .= "{ eksper:'".$eksper_bazinda_lo_esd['EKSPER']."', tutar:".($eksper_bazinda_lo_esd['TEDARIK_LO_TUTAR']).", adet:".($eksper_bazinda_lo_esd['TEDARIK_LO_ADET'])."}, ";
			}
	?>
			<div class="panel panel-warning">
				<div class="tableFixHead" style='min-height:800px;'>
					<div id='chart_hist_eksper_bazinda_lo' class='chart_morris' style='min-height:3000px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_eksper_bazinda_lo',
				  dataLabels: true,
				  data:[<?php echo $eksper_bazinda_lo_detail; ?>],
				  xkey:'eksper',
				  ykeys:['tutar','adet'],
				  labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal6 end ?>

	<?php
	if($modal_id=='7'){
			require_once("chartLoEsdegerClass.php");
			$chartClassLoEsdeger         = new chartClassLoEsdeger();
			$eksper_bazinda_lo_esd_arr 	= $chartClassLoEsdeger->eksperbazindaLoEsdBlok($brans,$tarih1,$tarih2,$marka_id,$kullanim_sekli,$tedarikci,$mensei,$sehir_id,$urun_id,7);
			foreach($eksper_bazinda_lo_esd_arr as $eksper_bazinda_lo_esd){

				$eksper_bazinda_esd_detail .= "{ eksper:'".$eksper_bazinda_lo_esd['EKSPER']."', tutar:".($eksper_bazinda_lo_esd['TEDARIK_ESD_TUTAR']).", adet:".($eksper_bazinda_lo_esd['TEDARIK_ESD_ADET'])."}, ";
			}
	?>
			<div class="panel panel-warning">
				<div class="tableFixHead" style='min-height:800px;'>
					<div id='chart_hist_eksper_bazinda_esd' class='chart_morris' style='min-height:3000px;'></div>
				</div>
			</div>
			<script>

				Morris.Bar({
				  element: 'chart_hist_eksper_bazinda_esd',
				  dataLabels: true,
				  data:[<?php echo $eksper_bazinda_esd_detail; ?>],
				  xkey:'eksper',
				  ykeys:['tutar','adet'],
				  labels:['<?=dil_dashboard("Tutar")?>', '<?=dil_dashboard("Adet")?>'],
				  horizontal: true,
				  stacked:true,
				});

			</script>
	<?php
	exit;
	} ?>
	<?php //modal6 end ?>