<div id="load_modal_box2" style="margin-top: 10px;"></div>		

<script>
			
			/*neden a��k*/
			$(".nedenacik").click(function(){
				var id = $(this).attr('id');	
				$("#load_modal_box2").load("dashboard_repostory/modals.php?modal_id=50&param="+id);
				
			});
			
			/*neden a��k otod���*/
			$(".nedenacikOtodisi").click(function(){
				var id = $(this).attr('id');	
				$("#load_modal_box2").load("dashboard_repostory/modals.php?modal_id=51&param="+id);
				
			});
		
</script>