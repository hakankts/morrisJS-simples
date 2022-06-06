<?php
		require_once(dirname($_SERVER['DOCUMENT_ROOT'])."/cgi-bin/functions.php");
		$cUtility = new Utility();
		$cdb = new db_layer();
		$cDat =  new datetime_operations();
		$crypt = new Crypto();
		require_valid_login();
		$HASAR_TABLE = get_hasar_table();
		$modal_id = $_POST['modal_id'];
		if(!$modal_id) { die("Modal Yüklenemedi");}
	?>

<div class="modal fade" id="modal-block" tabindex="-1" role="dialog" aria-labelledby="modal3Label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">

			</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"> <?=dil_dashboard("Kapat","Close");?> </button>
				</div>
		</div>
	</div>
</div>