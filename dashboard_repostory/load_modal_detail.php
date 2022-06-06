<div id="load_modal_box2" style="margin-top: 10px;"></div>		

<script>
			
			/*neden açýk*/
			$(".nedenacik").click(function(){
				var id = $(this).attr('id');	
				$("#load_modal_box2").load("dashboard_repostory/modals.php?modal_id=50&param="+id);
				
			});
			
			/*neden açýk otodýþý*/
			$(".nedenacikOtodisi").click(function(){
				var id = $(this).attr('id');	
				$("#load_modal_box2").load("dashboard_repostory/modals.php?modal_id=51&param="+id);
				
			});
		
</script>