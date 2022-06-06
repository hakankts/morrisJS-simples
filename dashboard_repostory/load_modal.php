<div id="modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div style="width: 98%; margin: 0px auto; text-align: left;">
				<? //load modals ?>
				 <div id="load_modal_box" style="margin-top: 10px;max-height: 800px;"></div>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-warning" onClick="location.href='dashboard_repostory/excel_out.php'" class="btn" name="BtnOk2" value="Excel" >
				<button type="button" class="btn btn-warning" data-dismiss="modal">  <?=dil_dashboard("Kapat","Close");?> </button>
			</div>
		</div>
	</div>
</div>

<script>

		$(document).ready(function(){

			$("#modal").draggable({
				handle: ".modal_drag"
			});

			var ay_basi 	= '<?=$ay_basi?>';
			var ay_sonu 	= '<?=$ay_sonu?>';
			var year 		= '<?=$year?>';
			var sorumlu 	= '<?=$sorumlu?>';
			var brans 		= '<?=$brans?>';
			var servis_turu = '<?=$servis_turu?>';

			$(".eksper").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=1&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*servis*/
			$(".servis").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=2&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*faturalý*/
			$(".faturali").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=3&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*teknik incelemeci*/
			$(".teiknikincelemeci").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=11&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*tedarik*/
			$(".tedarik").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=4&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*mobil onarým*/
			$(".mobilonarim").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=5&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*Araþtýrmacý*/
			$(".arastirmaci").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=6&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*UZMAN*/
			$(".uzman").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=7&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*OTODIÞI*/
			$(".otodisi").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=8&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*ALTERNATÝF TAMÝR*/
			$(".alternatif").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=10&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});

			/*CAM*/
			$(".cam").click(function(){
				var id = $(this).attr('id');
				$("#load_modal_box").load("dashboard_repostory/modals.php?modal_id=9&ay_basi=" +ay_basi+ "&ay_sonu=" +ay_sonu+ "&year=" +year+ "&sorumlu=" +sorumlu+ "&brans=" +brans+ "&servis_turu=" +servis_turu+ "&param="+id);
			});


		});

</script>