<?php

	require_once dirname($_SERVER['DOCUMENT_ROOT']) . "/cgi-bin/functions.php";
	require_once(dirname($_SERVER['DOCUMENT_ROOT']) . "/classes/ModulAyarlari.php");

	require "../same_funcs.php";

	require_valid_login();
	$cdb = new db_layer();

	$modal_id = $_GET['modal_id'];
	if(!$modal_id) { die("Modal Yüklenemedi");}

	require_once("dashboardDetailClass.php");
	$dashboardDetailClass 	= new dashboardDetailClass();

	?>
	<?php require_once("load_modal_detail.php");?>
	<?php if($modal_id=='1'){
		$eksper_data_arr = $dashboardDetailClass->eksperBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");

		?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Eksper","Expert");?></th>
							<th><?=dil_dashboard("Servis","Service");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<th><?=dil_dashboard("Dosya Sorumlusu","File Responsible");?></th>
							<?php if($param=="eksper9") {?>
							<th><?=dil_dashboard("(T)","(S)");?></th>
							<?php } ?>
							<?php if($param=="eksper10") {?>
							<th><?=dil_dashboard("Neden Açýk","Why Open");?></th>
							<?php } ?>
						</tr>
					</thead>
							<?php

									$str_excel.= dil_dashboard("Sýra","No").";";
									$str_excel.= dil_dashboard("Branþ","Branch").";";
									$str_excel.= dil_dashboard("Dosya No","File Number").";";
									$str_excel.= dil_dashboard("Marka","Make").";";
									$str_excel.= dil_dashboard("Eksper","Expert").";";
									$str_excel.= dil_dashboard("Servis","Service").";";
									$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
									$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
									$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
									$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
									$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
									$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
									$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
									$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open").";";
									$str_excel.= dil_dashboard("Dosya Sorumlusu","File Responsible")."\n";
							?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($eksper_data_arr as $eksper_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($eksper_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$eksper_data['H_ID']?>&dosyaHash=<?=$eksper_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $eksper_data['DOSYA_NO'];?></a></td>
							<td><?php echo ($eksper_data['MARKA_ADI']);?></td>
							<td><?php echo ($eksper_data['EKSPER']);?></td>
							<td><?php echo ($eksper_data['SERVIS']);?></td>
							<td><?php if($eksper_data['SERVIS']) { echo dil_dashboard($eksper_data['SERVIS_TURU']);  } ?></td>
							<td><?php if($eksper_data['SERVIS']) { echo dil_dashboard($eksper_data['ANLASMA']); } ?></td>
							<td><?php if($eksper_data['SERVIS']) { echo $eksper_data['SERVIS_ILI']; }?></td>
							<td><?php echo $eksper_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($eksper_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($eksper_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($eksper_data['KAYIT_TARIH_SAAT']);?></td>
							<td><?php echo $eksper_data['DOSYA_GECEN_SURE'];?></td>
							<td><?php echo ($eksper_data['DOSYA_SORUMLUSU']);?></td>
							<?php if($param=="eksper9") {?>
							<td><a href="javascript:popup('/hasar/siparis_list.php?id=<?php echo $eksper_data['H_ID'];?>','snapshot',790,600)"> (T) </a></td>
							<?php } ?>
							<?php if($param=="eksper10") {?>
							<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" class="nedenacik" id="<?=$eksper_data['H_ID'];?>"> Gözat</a></td>
							<?php } ?>
							<?php
									$str_excel.= $i.";";
									$str_excel.= dil_dashboard($eksper_data['BRANS']).";";
									$str_excel.= $eksper_data['DOSYA_NO'].";";
									$str_excel.= $eksper_data['MARKA_ADI'].";";
									$str_excel.= $eksper_data['EKSPER'].";";
									$str_excel.= $eksper_data['SERVIS'].";";
									$str_excel.= dil_dashboard($eksper_data['SERVIS_TURU']).";";
									$str_excel.= dil_dashboard($eksper_data['ANLASMA']).";";
									$str_excel.= $eksper_data['SERVIS_ILI'].";";
									$str_excel.= $eksper_data['IHBAR_MUALLAK_TUTAR'].";";
									$str_excel.= dil_dashboard($eksper_data['HASAR_SEKLI']).";";
									$str_excel.= $eksper_data['HASAR_TARIHI'].";";
									$str_excel.= $eksper_data['KAYIT_TARIH_SAAT'].";";
									$str_excel.= $eksper_data['DOSYA_GECEN_SURE'].";";
									$str_excel.= $eksper_data['DOSYA_SORUMLUSU']."\n";
							?>
						</tr>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal1 end ?>

	<?php if($modal_id=='2'){
		$servis_data_arr = $dashboardDetailClass->servisBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Servis","Service");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<th><?=dil_dashboard("Dosya Sorumlusu","File Responsible");?></th>
							<?php if($param=="servis7") {?>
							<th><?=dil_dashboard("(T)","(S)");?></th>
							<?php } ?>
							<?php if($param=="servis15") {?>
							<th><?=dil_dashboard("Neden Açýk","Why Open");?></th>
							<?php } ?>
						</tr>
					</thead>
					<?php
							$str_excel.= dil_dashboard("Sýra","No").";";
							$str_excel.= dil_dashboard("Branþ","Branch").";";
							$str_excel.= dil_dashboard("Dosya No","File Number").";";
							$str_excel.= dil_dashboard("Marka","Make").";";
							$str_excel.= dil_dashboard("Servis","Service").";";
							$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
							$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
							$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
							$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
							$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
							$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
							$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open").";";
							$str_excel.= dil_dashboard("Dosya Sorumlusu","File Responsible")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($servis_data_arr as $servis_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($servis_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$servis_data['H_ID']?>&dosyaHash=<?=$servis_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $servis_data['DOSYA_NO'];?></a></td>
							<td><?php echo ($servis_data['MARKA_ADI']);?></td>
							<td><?php echo ($servis_data['SERVIS']);?></td>
							<td><?php if($servis_data['SERVIS']) { echo dil_dashboard($servis_data['SERVIS_TURU']); } ?></td>
							<td><?php if($servis_data['SERVIS']) { echo ($servis_data['SERVIS_ILI']); }?></td>
							<td><?php echo $servis_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($servis_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($servis_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($servis_data['KAYIT_TARIH_SAAT']);?></td>
							<td align="center"><?php echo $servis_data['DOSYA_ORT_GECEN_SURE'];?></td>
							<td><?php echo ($servis_data['DOSYA_SORUMLUSU']);?></td>
							<?php if($param=="servis7") {?>
							<td><a href="javascript:popup('/hasar/siparis_list.php?id=<?php echo $servis_data['H_ID'];?>','snapshot',790,600)"> (T) </a></td>
							<?php } ?>
							<?php if($param=="servis15") {?>
							<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" class="nedenacik" id="<?=$servis_data['H_ID'];?>"> Gözat</a></td>
							<?php } ?>
						</tr>
							<?php
									$str_excel.= $i.";";
									$str_excel.= dil_dashboard($servis_data['BRANS']).";";
									$str_excel.= $servis_data['DOSYA_NO'].";";
									$str_excel.= $servis_data['MARKA_ADI'].";";
									$str_excel.= $servis_data['SERVIS'].";";
									$str_excel.= dil_dashboard($servis_data['SERVIS_TURU']).";";
									$str_excel.= $servis_data['SERVIS_ILI'].";";
									$str_excel.= $servis_data['IHBAR_MUALLAK_TUTAR'].";";
									$str_excel.= dil_dashboard($servis_data['HASAR_SEKLI']).";";
									$str_excel.= $servis_data['HASAR_TARIHI'].";";
									$str_excel.= $servis_data['KAYIT_TARIH_SAAT'].";";
									$str_excel.= $servis_data['DOSYA_ORT_GECEN_SURE'].";";
									$str_excel.= $servis_data['DOSYA_SORUMLUSU']."\n";
							?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal2 end ?>


	<?php if($modal_id=='3'){
		$faturali_data_arr = $dashboardDetailClass->faturaliBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Kullanýcý","User");?></th>
							<th><?=dil_dashboard("Servis","Service");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<?php if($param=="faturali4") {?>
							<th><?=dil_dashboard("(T)","(S)");?></th>
							<?php } ?>
							<?php if($param=="faturali9") {?>
							<th><?=dil_dashboard("Neden Açýk","Why Open");?></th>
							<?php } ?>
						</tr>
					</thead>
					<?php
							$str_excel.= dil_dashboard("Sýra","No").";";
							$str_excel.= dil_dashboard("Branþ","Branch").";";
							$str_excel.= dil_dashboard("Dosya No","File Number").";";
							$str_excel.= dil_dashboard("Marka","Make").";";
							$str_excel.= dil_dashboard("Kullanýcý","User").";";
							$str_excel.= dil_dashboard("Servis","Service").";";
							$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
							$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
							$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
							$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
							$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
							$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
							$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
							$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($faturali_data_arr as $faturali_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($faturali_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$faturali_data['H_ID']?>&dosyaHash=<?=$faturali_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $faturali_data['DOSYA_NO'];?></a></td>
							<td><?php echo $faturali_data['MARKA_ADI'];?></td>
							<td><?php echo $faturali_data['FATURA_KULLANICI_KODU'];?></td>
							<td><?php echo $faturali_data['SERVIS'];?></td>
							<td><?php if($faturali_data['SERVIS']) { echo dil_dashboard($faturali_data['SERVIS_TURU']); } ?></td>
							<td><?php if($faturali_data['SERVIS']) { echo dil_dashboard($faturali_data['ANLASMA']); } ?></td>
							<td><?php if($faturali_data['SERVIS']) { echo $faturali_data['SERVIS_ILI']; }?></td>
							<td><?php echo $faturali_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($faturali_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($faturali_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($faturali_data['KAYIT_TARIH_SAAT']);?></td>
							<td align="center"><?php echo $faturali_data['DOSYA_ORT_GECEN_SURE'];?></td>
							<?php if($param=="faturali4") {?>
							<td><a href="javascript:popup('/hasar/siparis_list.php?id=<?php echo $faturali_data['H_ID'];?>','snapshot',790,600)"> (T) </a></td>
							<?php } ?>
							<?php if($param=="faturali9") {?>
							<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" class="nedenacik" id="<?=$faturali_data['H_ID'];?>"> Gözat</a></td>
							<?php } ?>
						</tr>
							<?php
									$str_excel.= $i.";";
									$str_excel.= dil_dashboard($faturali_data['BRANS']).";";
									$str_excel.= $faturali_data['DOSYA_NO'].";";
									$str_excel.= $faturali_data['MARKA_ADI'].";";
									$str_excel.= $faturali_data['FATURA_KULLANICI_KODU'].";";
									$str_excel.= $faturali_data['SERVIS'].";";
									$str_excel.= dil_dashboard($faturali_data['SERVIS_TURU']).";";
									$str_excel.= dil_dashboard($faturali_data['ANLASMA']).";";
									$str_excel.= $faturali_data['SERVIS_ILI'].";";
									$str_excel.= $faturali_data['IHBAR_MUALLAK_TUTAR'].";";
									$str_excel.= dil_dashboard($faturali_data['HASAR_SEKLI']).";";
									$str_excel.= $faturali_data['HASAR_TARIHI'].";";
									$str_excel.= $faturali_data['KAYIT_TARIH_SAAT'].";";
									$str_excel.= $faturali_data['DOSYA_ORT_GECEN_SURE']."\n";
							?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal3 end ?>


	<?php if($modal_id=='4'){
		$tedarik_data_arr = $dashboardDetailClass->tedarikBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
	?>

			<?php
				if($param=='tedarik1'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý sipariþ tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr","The number of open days is taken into account the date of file registration and the current time interval. Difference days number supplier response date and current time interval are taken into consideration."); }
				if($param=='tedarik2'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý eksper talep tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is taken into account the date of file registration and the current time interval. The number of difference days is the expert request and the current time interval date.");}
				if($param=='tedarik5'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý sipariþ tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is taken into account the date of file registration and the current time interval. Difference days number order date and current time interval are taken into consideration"); }
				if($param=='tedarik6'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý tedarikçi cevap tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is taken into account the date of file registration and the current time interval. Difference days number supplier response date and current time interval are taken into consideration");}
				if($param=='tedarik7'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý tedarikçi cevap tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is taken into account the date of file registration and the current time interval. Difference days number supplier response date and current time interval are taken into consideration");}
				if($param=='tedarik8'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý tedarikçi cevap tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is taken into account the date of file registration and the current time interval. Difference days number supplier response date and current time interval are taken into consideration");}
				if($param=='tedarik9'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr. Fark gün sayýsý iade tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is taken into account the date of file registration and the current time interval. Difference days of return spare part date and current time interval are taken into consideration.");}
				if($param=='tedarik12'){ $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration."); }

			?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Tedarikçi","Supplier");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<?php if($param=="tedarik2") {?>
							<th><?=dil_dashboard("Talep Tarihi","Request Date");?></th>
							<?php } else { ?>
							<th><?=dil_dashboard("Sipariþ Tarihi","Order Date");?></th>
							<th><?=dil_dashboard("Cevaplama Tarihi","Response Date");?></th>
							<?php } ?>
							<th><?=dil_dashboard("Fark Gün","Difference Day");?></th>
							<th><?=dil_dashboard("(T)","(S)");?></th>
						</tr>
					</thead>
					<?php
							$str_excel.= dil_dashboard("Sýra","No").";";
							$str_excel.= dil_dashboard("Branþ","Branch").";";
							$str_excel.= dil_dashboard("Dosya No","File Number").";";
							$str_excel.= dil_dashboard("Marka","Make").";";
							$str_excel.= dil_dashboard("Tedarikçi","Supplier").";";
							$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
							$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
							$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
							$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
							$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
							$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open").";";
							if($param=="tedarik2") {
							$str_excel.= dil_dashboard("Talep Tarihi","Request Date").";";
							} else {
							$str_excel.= dil_dashboard("Sipariþ Tarihi","Order Date").";";
							$str_excel.= dil_dashboard("Cevaplama Tarihi","Response Date").";";
							}
							$str_excel.= dil_dashboard("Fark Gün","Difference Day")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($tedarik_data_arr as $tedarik_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($tedarik_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$tedarik_data['H_ID']?>&dosyaHash=<?=$tedarik_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $tedarik_data['DOSYA_NO'];?></a></td>
							<td><?php echo ($tedarik_data['MARKA_ADI']);?></td>
							<td><?php echo ($tedarik_data['TEDARIKCI']);?></td>
							<td><?php if($tedarik_data['SERVIS']) { echo dil_dashboard($tedarik_data['SERVIS_TURU']); } ?></td>
							<td><?php if($tedarik_data['SERVIS']) { echo dil_dashboard($tedarik_data['ANLASMA']); } ?></td>
							<td><?php if($tedarik_data['SERVIS']) { echo $tedarik_data['SERVIS_ILI']; }?></td>
							<td><?php echo db2normal($tedarik_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($tedarik_data['KAYIT_TARIH_SAAT']);?></td>
							<td align="center"><?php echo $tedarik_data['DOSYA_ORT_GECEN_SURE'];?></td>
							<?php if($param=="tedarik2") {?>
							<td><?php echo db2normal($tedarik_data['KT_TARIH_EKSPER']);?></td>
							<?php } else { ?>
							<td><?php echo db2normal($tedarik_data['TARIH_SIPARIS']);?></td>
							<td><?php echo db2normal($tedarik_data['TARIH_TEDARIKCI']);?></td>
							<?php } ?>
							<td><?php echo $tedarik_data['FARK_GUN'];?></td>
							<td><a href="javascript:popup('/hasar/siparis_list.php?id=<?php echo $tedarik_data['H_ID'];?>','snapshot',790,600)"> (T) </a></td>
						</tr>
						<?php
								$str_excel.= $i.";";
								$str_excel.= dil_dashboard($tedarik_data['BRANS']).";";
								$str_excel.= $tedarik_data['DOSYA_NO'].";";
								$str_excel.= $tedarik_data['MARKA_ADI'].";";
								$str_excel.= $tedarik_data['TEDARIKCI'].";";
								$str_excel.= dil_dashboard($tedarik_data['SERVIS_TURU']).";";
								$str_excel.= dil_dashboard($tedarik_data['ANLASMA']).";";
								$str_excel.= $tedarik_data['SERVIS_ILI'].";";
								$str_excel.= $tedarik_data['HASAR_TARIHI'].";";
								$str_excel.= $tedarik_data['KAYIT_TARIH_SAAT'].";";
								$str_excel.= $tedarik_data['DOSYA_ORT_GECEN_SURE'].";";
								if($param=="tedarik2") {
								$str_excel.= $tedarik_data['KT_TARIH_EKSPER'].";";
								} else {
								$str_excel.= $tedarik_data['TARIH_SIPARIS'].";";
								$str_excel.= $tedarik_data['TARIH_TEDARIKCI'].";";
								}
								$str_excel.= $tedarik_data['FARK_GUN']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal4 end ?>


	<?php if($modal_id=='5'){
		$mobilonarim_data_arr = $dashboardDetailClass->mobilOnarimBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Kullanýcý","User");?></th>
							<th><?=dil_dashboard("Mobil Onarým Servisi","Mobile Repair Service");?></th>
							<?php if($param!='mobilonarim1'){?>
							<th><?=dil_dashboard("Gönderilen","Sent");?> </th>
							<th><?=dil_dashboard("Tamir Edilen","Repaired");?></th>
							<th><?=dil_dashboard("Tamir Edilen Tutar","Repaired Amount");?></th>
							<th><?=dil_dashboard("Tamir Edilmeyen","Unrepaired");?></th>
							<?php } ?>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<?php if($param != "mobilonarim1" && $param != "mobilonarim4"){ ?>
							<th><?=dil_dashboard("(M)","(M)");?></th>
							<?php } ?>
						</tr>
					</thead>
					<?php
							$str_excel.= dil_dashboard("Sýra","No").";";
							$str_excel.= dil_dashboard("Branþ","Branch").";";
							$str_excel.= dil_dashboard("Dosya No","File Number").";";
							$str_excel.= dil_dashboard("Marka","Make").";";
							$str_excel.= dil_dashboard("Kullanýcý","User").";";
							$str_excel.= dil_dashboard("Mobil Onarým Servisi","Mobile Repair Service").";";
							if($param!='mobilonarim1'){
							$str_excel.= dil_dashboard("Gönderilen","Sent").";";
							$str_excel.= dil_dashboard("Tamir Edilen","Repaired").";";
							$str_excel.= dil_dashboard("Tamir Edilen Tutar","Repaired Amount").";";
							$str_excel.= dil_dashboard("Tamir Edilmeyen","Unrepaired").";";
							}
							$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
							$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
							$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
							$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($mobilonarim_data_arr as $mobilonarim_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($mobilonarim_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$mobilonarim_data['H_ID']?>&dosyaHash=<?=$mobilonarim_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $mobilonarim_data['DOSYA_NO'];?></a></td>
							<td><?php echo ($mobilonarim_data['MARKA_ADI']);?></td>
							<td><?php echo $mobilonarim_data['SERVIS_EKSPER'];?></td>
							<td><?php echo $mobilonarim_data['SERVIS'];?></td>
							<?php if($param!='mobilonarim1'){?>
							<td><?php echo $mobilonarim_data['MO_GONDERILEN_PARCA_ADET'];?></td>
							<td><?php echo $mobilonarim_data['MO_ONARILAN_PARCA_ADET'];?></td>
							<td><?php echo $mobilonarim_data['MO_ONARILAN_PARCA_TUTAR'];?></td>
							<td><?php echo $mobilonarim_data['MO_ONARILAMAYAN_PARCA_ADET'];?></td>
							<?php } ?>
							<td><?php echo $mobilonarim_data['SERVIS_ILI'];?></td>
							<td><?php echo db2normal($mobilonarim_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($mobilonarim_data['KAYIT_TARIH_SAAT']);?></td>
							<td><?php echo $mobilonarim_data['DOSYA_ORT_GECEN_SURE'];?></td>
							<?php if($param != "mobilonarim1" && $param != "mobilonarim4"){ ?>
							<td><a href="javascript:popup('/hasar/mini_list.php?id=<?php echo $mobilonarim_data['H_ID'];?>','snapshot',790,600)"> (M) </a></td>
							<?php } ?>
						</tr>
						<?php
								$str_excel.= $i.";";
								$str_excel.= dil_dashboard($mobilonarim_data['BRANS']).";";
								$str_excel.= $mobilonarim_data['DOSYA_NO'].";";
								$str_excel.= $mobilonarim_data['MARKA_ADI'].";";
								$str_excel.= $mobilonarim_data['SERVIS_EKSPER'].";";
								$str_excel.= $mobilonarim_data['SERVIS'].";";
								if($param!='mobilonarim1'){
								$str_excel.= $mobilonarim_data['MO_GONDERILEN_PARCA_ADET'].";";
								$str_excel.= $mobilonarim_data['MO_ONARILAN_PARCA_ADET'].";";
								$str_excel.= $mobilonarim_data['MO_ONARILAN_PARCA_TUTAR'].";";
								$str_excel.= $mobilonarim_data['MO_ONARILAMAYAN_PARCA_ADET'].";";
								}
								$str_excel.= $mobilonarim_data['SERVIS_ILI'].";";
								$str_excel.= $mobilonarim_data['HASAR_TARIHI'].";";
								$str_excel.= $mobilonarim_data['KAYIT_TARIH_SAAT'].";";
								$str_excel.= $mobilonarim_data['DOSYA_ORT_GECEN_SURE']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal5 end ?>


	<?php if($modal_id=='6'){
		$arastirmaci_data_arr = $dashboardDetailClass->arastirmaciBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		if($param=='arastirmaci1' || $param=='arastirmaci2'){ $msg = dil_dashboard("Açýk gün sayýsý araþtýrmacýya veriliþ tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","The number of open days is given to the researcher, and the current time interval is taken into account.");}
		if($param=='arastirmaci3'){  $msg = dil_dashboard("Açýk gün sayýsý araþtýrmacýya veriliþ tarihi ile denetçiye atandýðý zaman aralýðý dikkate alýnmýþtýr.","The number of open days is given to the date of the assignment to the researcher and the time interval to which the auditor is assigned.");}
		if($param=='arastirmaci4'){  $msg = dil_dashboard("Açýk gün sayýsý araþtýrmacýya veriliþ tarihi ile denetçiye atandýðý zaman aralýðý dikkate alýnmýþtýr.","The number of open days is given to the date of the assignment to the researcher and the time interval to which the auditor is assigned.");}
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Araþtýrmacý","Investigator");?></th>
							<th><?=dil_dashboard("Denetçi","Investigator");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Arþ. Veriliþ Tarihi","Investigator Date of issue");?></th>
							<th><?=dil_dashboard("Arþ. Kapatma Tarihi","Investigator Closing Date");?></th>
							<th><?=dil_dashboard("Denetçi Kapatma Tarihi","Investigator Closing Date");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
						</tr>
					</thead>
					<?php
							$str_excel.= dil_dashboard("Sýra","No").";";
							$str_excel.= dil_dashboard("Dosya No","File Number").";";
							$str_excel.= dil_dashboard("Marka","Make").";";
							$str_excel.= dil_dashboard("Araþtýrmacý","Investigator").";";
							$str_excel.= dil_dashboard("Denetçi","Investigator").";";
							$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
							$str_excel.= dil_dashboard("Hasar Tarihi","").";";
							$str_excel.= dil_dashboard("Arþ. Veriliþ Tarihi","Investigator Date of issue").";";
							$str_excel.= dil_dashboard("Arþ Kapatma Tarihi","Investigator Closing Date").";";
							$str_excel.= dil_dashboard("Denetçi Kapatma Tarihi","Investigator Closing Date").";";
							$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($arastirmaci_data_arr as $arastirmaci_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$arastirmaci_data['H_ID']?>&dosyaHash=<?=$arastirmaci_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $arastirmaci_data['DOSYA_NO'];?></a></td>
							<td><?php echo ($arastirmaci_data['MARKA_ADI']);?></td>
							<td><?php echo $arastirmaci_data['ARASTIRMACI'];?></td>
							<td><?php echo $arastirmaci_data['DENETCI'];?></td>
							<td><?php echo $arastirmaci_data['SERVIS_ILI'];?></td>
							<td><?php echo db2normal($arastirmaci_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($arastirmaci_data['VERILIS_TARIH']);?></td>
							<td><?php echo db2normal($arastirmaci_data['CLOSER_DATE']);?></td>
							<td><?php echo db2normal($arastirmaci_data['DENETCI_CLOSER_DATE']);?></td>
							<td><?php echo $arastirmaci_data['DOSYA_ORT_GECEN_SURE']; ?></td>
						</tr>
						<?php
							$str_excel.= $i.";";
							$str_excel.= $arastirmaci_data['DOSYA_NO'].";";
							$str_excel.= $arastirmaci_data['MARKA_ADI'].";";
							$str_excel.= $arastirmaci_data['ARASTIRMACI'].";";
							$str_excel.= $arastirmaci_data['DENETCI'].";";
							$str_excel.= $arastirmaci_data['SERVIS_ILI'].";";
							$str_excel.= $arastirmaci_data['HASAR_TARIHI'].";";
							$str_excel.= $arastirmaci_data['KAYIT_TARIH_SAAT'].";";
							$str_excel.= $arastirmaci_data['VERILIS_TARIH'].";";
							$str_excel.= $arastirmaci_data['CLOSER_DATE'].";";
							$str_excel.= $arastirmaci_data['VERILIS_TARIH'].";";
							$str_excel.= $arastirmaci_data['DOSYA_ORT_GECEN_SURE']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal6 end ?>


	<?php if($modal_id=='7'){
		if($param=='uzman1' || $param=='uzman4' || $param=='uzman5' || $param=='uzman6'){  $msg = dil_dashboard("Açýk gün sayýsý dosya uzman iþlem tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr","Number of open days, AGCS date and current time interval are taken into consideration."); }
		if($param=='uzman2' || $param=='uzman3' || $param=='uzman7'){  $msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration."); }
		$uzman_data_arr = $dashboardDetailClass->uzmanBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);

	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Eksper","Expert");?></th>
							<th><?=dil_dashboard("Uzman","AGCS");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Uzman Tarihi","Date Of AGCS");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
						</tr>
					</thead>
					<?php
						$str_excel.= dil_dashboard("Sýra","No").";";
						$str_excel.= dil_dashboard("Branþ","Branch").";";
						$str_excel.= dil_dashboard("Dosya No","File Number").";";
						$str_excel.= dil_dashboard("Marka","Make").";";
						$str_excel.= dil_dashboard("Eksper","Expert").";";
						$str_excel.= dil_dashboard("Uzman","AGCS").";";
						$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
						$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
						$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
						$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
						$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
						$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
						$str_excel.= dil_dashboard("Uzman Tarihi","Date Of AGCS").";";
						$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($uzman_data_arr as $uzman_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($uzman_data['BRANS']);?></td>
							<td><a href="javascript:popup('/hasar/uzman_snapshot_ozet.php?id=<?=$uzman_data['H_ID']?>&dosyaHash=<?=$uzman_data['DOSYA_HASH'];?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $uzman_data['DOSYA_NO'];?></a></td>
							<td><?php echo ($uzman_data['MARKA_ADI']);?></td>
							<td><?php echo ($uzman_data['EKSPER']);?></td>
							<td><?php echo ($uzman_data['UZMAN']);?></td>
							<td><?php if($uzman_data['SERVIS']) { echo dil_dashboard($uzman_data['SERVIS_TURU']); } ?></td>
							<td><?php if($uzman_data['SERVIS']) { echo dil_dashboard($uzman_data['ANLASMA']); } ?></td>
							<td><?php if($uzman_data['SERVIS']) { echo $uzman_data['SERVIS_ILI']; }?></td>
							<td><?php echo $uzman_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo db2normal($uzman_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($uzman_data['KAYIT_TARIH_SAAT']);?></td>
							<td><?php echo db2normal($uzman_data['EKSPER_UZMAN_TARIH']);?></td>
							<td><?php echo $uzman_data['DOSYA_GECEN_SURE'];?></td>
						</tr>
						<?php
							$str_excel.= $i.";";
							$str_excel.= dil_dashboard($uzman_data['BRANS']).";";
							$str_excel.= $uzman_data['DOSYA_NO'].";";
							$str_excel.= $uzman_data['MARKA_ADI'].";";
							$str_excel.= $uzman_data['EKSPER'].";";
							$str_excel.= $uzman_data['UZMAN'].";";
							$str_excel.= dil_dashboard($uzman_data['SERVIS_TURU']).";";
							$str_excel.= dil_dashboard($uzman_data['ANLASMA']).";";
							$str_excel.= $uzman_data['SERVIS_ILI'].";";
							$str_excel.= $uzman_data['IHBAR_MUALLAK_TUTAR'].";";
							$str_excel.= $uzman_data['HASAR_TARIHI'].";";
							$str_excel.= $uzman_data['EKSPER_UZMAN_TARIH'].";";
							$str_excel.= $uzman_data['DOSYA_GECEN_SURE']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal7 end ?>

	<?php if($modal_id=='8'){
		$otodisi_data_arr= $dashboardDetailClass->eksperBlokOtodisi($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Eksper","Expert");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<?php if($param=="otodisi5") {?>
							<th><?=dil_dashboard("Neden Açýk","Why Open");?></th>
							<?php } ?>
						</tr>
					</thead>
					<?php
						$str_excel.= dil_dashboard("Sýra","No").";";
						$str_excel.= dil_dashboard("Branþ","Branch").";";
						$str_excel.= dil_dashboard("Dosya No","File Number").";";
						$str_excel.= dil_dashboard("Eksper","Expert").";";
						$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
						$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
						$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
						$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
						$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($otodisi_data_arr as $otodisi_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($otodisi_data['BRANS']);?></td>
							<? if($otodisi_data['HIZLI_RAPOR']=='1'){?>
							<td><a href="javascript:popup('/print/yangin_ekspertiz_fy.php?ID=<?=$otodisi_data['H_ID']?>&ID=<?=$otodisi_data['H_ID']?>','snapshot',790,600)"><?php echo $otodisi_data['DOSYA_NO'];?></a></td>
							<?php } else { ?>
							<td><a href="javascript:popup('/print/frame_yangin.php?url=yangin_rapor.php?ID=<?=$otodisi_data['H_ID']?>&ID=<?=$otodisi_data['H_ID']?>&yeni_kod=1','snapshot',790,600)"><?php echo $otodisi_data['DOSYA_NO'];?></a></td>
							<?php } ?>
							<td><?php echo ($otodisi_data['EKSPER']);?></td>
							<td><?php echo $otodisi_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($otodisi_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($otodisi_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($otodisi_data['KAYIT_TARIH_SAAT']);?></td>
							<td><?php echo $otodisi_data['DOSYA_GECEN_SURE'];?></td>
							<?php if($param=="otodisi5") {?>
							<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" class="nedenacikOtodisi" id="<?=$otodisi_data['H_ID'];?>"> Gözat</a></td>
							<?php } ?>
						</tr>
						<?php
							$str_excel.= $i.";";
							$str_excel.= dil_dashboard($otodisi_data['BRANS']).";";
							$str_excel.= $otodisi_data['DOSYA_NO'].";";
							$str_excel.= $otodisi_data['EKSPER'].";";
							$str_excel.= $otodisi_data['IHBAR_MUALLAK_TUTAR'].";";
							$str_excel.= dil_dashboard($otodisi_data['HASAR_SEKLI']).";";
							$str_excel.= $otodisi_data['HASAR_TARIHI'].";";
							$str_excel.= $otodisi_data['KAYIT_TARIH_SAAT'].";";
							$str_excel.= $otodisi_data['DOSYA_GECEN_SURE']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal8 end ?>

	<?php if($modal_id=='9'){
		$cam_data_arr = $dashboardDetailClass->camBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Kullanýcý","User");?></th>
							<th><?=dil_dashboard("Servis","Service");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<?php if($param=="cam9") {?>
							<th><?=dil_dashboard("Neden Açýk","Why Open");?></th>
							<?php } ?>

						</tr>
					</thead>
					<?php
						$str_excel.= dil_dashboard("Sýra","No").";";
						$str_excel.= dil_dashboard("Branþ","Branch").";";
						$str_excel.= dil_dashboard("Dosya No","File Number").";";
						$str_excel.= dil_dashboard("Marka","Make").";";
						$str_excel.= dil_dashboard("Kullanýcý","User").";";
						$str_excel.= dil_dashboard("Servis","Service").";";
						$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
						$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
						$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
						$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
						$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
						$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
						$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
						$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($cam_data_arr as $cam_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($cam_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$cam_data['H_ID']?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $cam_data['DOSYA_NO'];?></a></td>
							<td><?php echo $cam_data['MARKA_ADI'];?></td>
							<td><?php echo $cam_data['FATURA_KULLANICI_KODU'];?></td>
							<td><?php echo $cam_data['SERVIS'];?></td>
							<td><?php if($cam_data['SERVIS']) { echo dil_dashboard($cam_data['SERVIS_TURU']); } ?></td>
							<td><?php if($cam_data['SERVIS']) { echo dil_dashboard($cam_data['ANLASMA']); } ?></td>
							<td><?php if($cam_data['SERVIS']) { echo $cam_data['SERVIS_ILI']; }?></td>
							<td><?php echo $cam_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($cam_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($cam_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($cam_data['KAYIT_TARIH_SAAT']);?></td>
							<td align="center"><?php echo $cam_data['DOSYA_ORT_GECEN_SURE'];?></td>
							<?php if($param=="cam9") {?>
							<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" class="nedenacik" id="<?=$cam_data['H_ID'];?>"> Gözat</a></td>
							<?php } ?>
						</tr>
						<?php
							$str_excel.= $i.";";
							$str_excel.= dil_dashboard($cam_data['BRANS']).";";
							$str_excel.= $cam_data['DOSYA_NO'].";";
							$str_excel.= $cam_data['MARKA_ADI'].";";
							$str_excel.= $cam_data['FATURA_KULLANICI_KODU'].";";
							$str_excel.= $cam_data['SERVIS'].";";
							$str_excel.= dil_dashboard($cam_data['SERVIS_TURU']).";";
							$str_excel.= dil_dashboard($cam_data['ANLASMA']).";";
							$str_excel.= $cam_data['SERVIS_ILI'].";";
							$str_excel.= $cam_data['IHBAR_MUALLAK_TUTAR'].";";
							$str_excel.= dil_dashboard($cam_data['HASAR_SEKLI']).";";
							$str_excel.= $cam_data['HASAR_TARIHI'].";";
							$str_excel.= $cam_data['KAYIT_TARIH_SAAT'].";";
							$str_excel.= $cam_data['DOSYA_ORT_GECEN_SURE']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal9 end ?>

	<?php if($modal_id=='10'){
		$alternatif_data_arr = $dashboardDetailClass->alternatifTamirBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>
							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Servis","Service");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
						</tr>
					</thead>
					<?php
						$str_excel.= dil_dashboard("Sýra","No").";";
						$str_excel.= dil_dashboard("Branþ","Branch").";";
						$str_excel.= dil_dashboard("Dosya No","File Number").";";
						$str_excel.= dil_dashboard("Marka","Make").";";
						$str_excel.= dil_dashboard("Servis","Service").";";
						$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
						$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
						$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
						$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
						$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
						$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
						$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
						$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";

						$str_excel.= dil_dashboard("Sýra","").";";
						$str_excel.= dil_dashboard("Branþ","").";";
						$str_excel.= dil_dashboard("Dosya No","").";";
						$str_excel.= dil_dashboard("Marka","").";";
						$str_excel.= dil_dashboard("Servis","").";";
						$str_excel.= dil_dashboard("servis Türü","").";";
						$str_excel.= dil_dashboard("Servis Anlaþma","").";";
						$str_excel.= dil_dashboard("Servis Ýli","").";";
						$str_excel.= dil_dashboard("Ýhbar Muallak","").";";
						$str_excel.= dil_dashboard("Hasar Þekli","").";";
						$str_excel.= dil_dashboard("Hasar Tarihi","").";";
						$str_excel.= dil_dashboard("Kayýt Tarihi","").";";
						$str_excel.= dil_dashboard("Açýk Gün Sayýsý","")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($alternatif_data_arr as $alternatif_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($alternatif_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$alternatif_data['H_ID']?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $alternatif_data['DOSYA_NO'];?></a></td>
							<td><?php echo $alternatif_data['MARKA_ADI'];?></td>
							<td><?php echo $alternatif_data['SERVIS'];?></td>
							<td><?php if($alternatif_data['SERVIS']) { echo dil_dashboard($alternatif_data['SERVIS_TURU']); } ?></td>
							<td><?php if($alternatif_data['SERVIS']) { echo dil_dashboard($alternatif_data['ANLASMA']); } ?></td>
							<td><?php if($alternatif_data['SERVIS']) { echo $alternatif_data['SERVIS_ILI']; }?></td>
							<td><?php echo $alternatif_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($alternatif_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($alternatif_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($alternatif_data['KAYIT_TARIH_SAAT']);?></td>
							<td><?php echo db2normal($alternatif_data['DOSYA_ORT_GECEN_SURE']);?></td>
						</tr>
						<?php
							$str_excel.= $i.";";
							$str_excel.= dil_dashboard($alternatif_data['BRANS']).";";
							$str_excel.= $alternatif_data['DOSYA_NO'].";";
							$str_excel.= $alternatif_data['MARKA_ADI'].";";
							$str_excel.= $alternatif_data['SERVIS'].";";
							$str_excel.= dil_dashboard($alternatif_data['SERVIS_TURU']).";";
							$str_excel.= dil_dashboard($alternatif_data['ANLASMA']).";";
							$str_excel.= $alternatif_data['SERVIS_ILI'].";";
							$str_excel.= $alternatif_data['IHBAR_MUALLAK_TUTAR'].";";
							$str_excel.= dil_dashboard($alternatif_data['HASAR_SEKLI']).";";
							$str_excel.= $alternatif_data['HASAR_TARIHI'].";";
							$str_excel.= $alternatif_data['KAYIT_TARIH_SAAT'].";";
							$str_excel.= $alternatif_data['DOSYA_ORT_GECEN_SURE']."\n";
						?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal10 end ?>



	<?php if($modal_id=='11'){
		$teknikincelemeci_data_arr = $dashboardDetailClass->teknikIncemeciBlok($ay_basi,$ay_sonu,$sorumlu,$brans,$servis_turu,$param,1);
		$msg = dil_dashboard("Açýk gün sayýsý dosya kayýt tarihi ile þimdiki zaman aralýðý dikkate alýnmýþtýr.","Number of open days, file registration date and current time interval are taken into consideration.");
	?>
			<div class="alert alert-danger" role="alert" style="padding:1px; margin-bottom:3px"> <?php echo $msg;?> </div>
			<div class="panel panel-warning">
				<div class="tableFixHead">
				<table class="table table-hover" id="dev-table" style="color:#000000;">
					<thead class="modal_drag">
						<tr>

							<th><?=dil_dashboard("Sýra","No");?></th>
							<th><?=dil_dashboard("Branþ","Branch");?></th>
							<th><?=dil_dashboard("Dosya No","File Number");?></th>
							<th><?=dil_dashboard("Marka","Make");?></th>
							<th><?=dil_dashboard("Kullanýcý","User");?></th>
							<th><?=dil_dashboard("Servis","Service");?></th>
							<th><?=dil_dashboard("Servis Türü","Service Type");?></th>
							<th><?=dil_dashboard("Servis Anlaþma","Service Argeement");?></th>
							<th><?=dil_dashboard("Servis Ýli","City of the Service");?></th>
							<th><?=dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding");?></th>
							<th><?=dil_dashboard("Hasar Þekli","Claim Type");?></th>
							<th><?=dil_dashboard("Hasar Tarihi","Claim Date");?></th>
							<th><?=dil_dashboard("Kayýt Tarihi","Date Of Registration");?></th>
							<th><?=dil_dashboard("Açýk Gün Sayýsý","Days Open");?></th>
							<?php if($param=="teiknikincelemeci4") {?>
							<th><?=dil_dashboard("(T)","(S)");?></th>
							<?php } ?>
							<?php if($param=="teiknikincelemeci9") {?>
							<th><?=dil_dashboard("Neden Açýk","Why Open");?></th>
							<?php } ?>
						</tr>
					</thead>
					<?php

							$str_excel.= dil_dashboard("Sýra","No").";";
							$str_excel.= dil_dashboard("Branþ","Branch").";";
							$str_excel.= dil_dashboard("Dosya No","File Number").";";
							$str_excel.= dil_dashboard("Marka","Make").";";
							$str_excel.= dil_dashboard("Kullanýcý","User").";";
							$str_excel.= dil_dashboard("Servis","Service").";";
							$str_excel.= dil_dashboard("Servis Türü","Service Type").";";
							$str_excel.= dil_dashboard("Servis Anlaþma","Service Argeement").";";
							$str_excel.= dil_dashboard("Servis Ýli","City of the Service").";";
							$str_excel.= dil_dashboard("Ýhbar Muallak","Claim Decleration Outstanding").";";
							$str_excel.= dil_dashboard("Hasar Þekli","Claim Type").";";
							$str_excel.= dil_dashboard("Hasar Tarihi","Claim Date").";";
							$str_excel.= dil_dashboard("Kayýt Tarihi","Date Of Registration").";";
							$str_excel.= dil_dashboard("Açýk Gün Sayýsý","Days Open")."\n";
					?>
					<tbody>
						<?php $i=1; ?>
						<?php foreach($teknikincelemeci_data_arr as $teknikincelemeci_data){ ?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo dil_dashboard($teknikincelemeci_data['BRANS']);?></td>
							<td><a href="javascript:popup('/eks/eks_hasar_snapshot.php?id=<?=$teknikincelemeci_data['H_ID']?>&amp;list=&amp;i=0&amp;dil=T','snapshot',790,600)"><?php echo $teknikincelemeci_data['DOSYA_NO'];?></a></td>
							<td><?php echo $teknikincelemeci_data['MARKA_ADI'];?></td>
							<td><?php echo $teknikincelemeci_data['FATURA_KULLANICI_KODU'];?></td>
							<td><?php echo $teknikincelemeci_data['SERVIS'];?></td>
							<td><?php if($teknikincelemeci_data['SERVIS']) { echo dil_dashboard($teknikincelemeci_data['SERVIS_TURU']); } ?></td>
							<td><?php if($teknikincelemeci_data['SERVIS']) { echo dil_dashboard($teknikincelemeci_data['ANLASMA']); } ?></td>
							<td><?php if($teknikincelemeci_data['SERVIS']) { echo $teknikincelemeci_data['SERVIS_ILI']; }?></td>
							<td><?php echo $teknikincelemeci_data['IHBAR_MUALLAK_TUTAR'];?></td>
							<td><?php echo dil_dashboard($teknikincelemeci_data['HASAR_SEKLI']);?></td>
							<td><?php echo db2normal($teknikincelemeci_data['HASAR_TARIHI']);?></td>
							<td><?php echo db2normal($teknikincelemeci_data['KAYIT_TARIH_SAAT']);?></td>
							<td align="center"><?php echo $teknikincelemeci_data['DOSYA_ORT_GECEN_SURE'];?></td>
							<?php if($param=="teiknikincelemeci4") {?>
							<td><a href="javascript:popup('/hasar/siparis_list.php?id=<?php echo $teknikincelemeci_data['H_ID'];?>','snapshot',790,600)"> (T) </a></td>
							<?php } ?>
							<?php if($param=="teiknikincelemeci9") {?>
							<td><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm" class="nedenacik" id="<?=$teknikincelemeci_data['H_ID'];?>"> Gözat</a></td>
							<?php } ?>
						</tr>
							<?php
									$str_excel.= $i.";";
									$str_excel.= dil_dashboard($teknikincelemeci_data['BRANS']).";";
									$str_excel.= $teknikincelemeci_data['DOSYA_NO'].";";
									$str_excel.= $teknikincelemeci_data['MARKA_ADI'].";";
									$str_excel.= $teknikincelemeci_data['FATURA_KULLANICI_KODU'].";";
									$str_excel.= $teknikincelemeci_data['SERVIS'].";";
									$str_excel.= dil_dashboard($teknikincelemeci_data['SERVIS_TURU']).";";
									$str_excel.= dil_dashboard($teknikincelemeci_data['ANLASMA']).";";
									$str_excel.= $teknikincelemeci_data['SERVIS_ILI'].";";
									$str_excel.= $teknikincelemeci_data['IHBAR_MUALLAK_TUTAR'].";";
									$str_excel.= dil_dashboard($teknikincelemeci_data['HASAR_SEKLI']).";";
									$str_excel.= $teknikincelemeci_data['HASAR_TARIHI'].";";
									$str_excel.= $teknikincelemeci_data['KAYIT_TARIH_SAAT'].";";
									$str_excel.= $teknikincelemeci_data['DOSYA_ORT_GECEN_SURE']."\n";
							?>
						<?php $i++; } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php
			$SESSION['EXC'] = $str_excel;
			?>
	<?php
	exit;
	} ?>
	<?php //modal11 end ?>



	<?/*detal modallar buradan sonra*/?>

	<?php if($modal_id=='50'){
		$na_data = $dashboardDetailClass->nedenAcikBlok($param,1);
	?>
		<div class="alert alert-warning" role="alert">
			<div style="font-size:16px;font-weight:600;">Dosya No: <?php echo $na_data->DOSYA_NO;?>	</div>
			<br>
			<b><?=dil_dashboard("Neden Açýk:","Why Open:");?> </b> <?php echo $na_data->ACIK_NOTU;?>
		</div>
	<?php
	exit;
	} ?>
	<?php //modal50 end ?>

	<?php if($modal_id=='51'){
		$na_data = $dashboardDetailClass->nedenAcikOtodisiBlok($param,1);
	?>
		<div class="alert alert-warning" role="alert">
			<div style="font-size:16px;font-weight:600;">Dosya No: <?php echo $na_data->DOSYA_NO;?>	</div>
			<br>
			<b><?=dil_dashboard("Neden Açýk:","Why Open:");?> </b> <?php echo $na_data->ACIK_NOTU;?>
		</div>
	<?php
	exit;
	} ?>
	<?php //modal50 end ?>
