	<div class="modal fade" id="modal-block" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">

				</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?=dil_dashboard('Kapat');?></button>
					</div>
			</div>
		</div>
	</div>


<script type='text/javascript'>
	$(document).ready(function(){

		$('.modalclass').click(function(){
			var modal_id = this.id;
			$.ajax({
				url: 'dashboard_repostory/modals.php',
				type: 'post',
				data: {modal_id: modal_id},
				success: function(response){
					$('.modal-body').html(response);
					$('#modal-block').modal('show');
				},
				error: function(){
					alert('error!');
				}
			});
		});
	});
</script>