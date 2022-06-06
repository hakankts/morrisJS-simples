<div id="modal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div style="width: 98%; margin: 0px auto; text-align: left;">
                <? //load modals ?>
                 <div id="load_modal_box" style="margin-top: 10px;min-height:800px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="pdfMake('load_modal_box', 'tumu')">PDF</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"> <?=dil_dashboard("Kapat");?> </button>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function(){

            $("#modal").draggable({
                handle: ".modal_drag"
            });
			if ($("#FILO_HARIC").is(':checked')){
				var FILO_HARIC = 1;
			}else{
				var FILO_HARIC = 0;
			}
			if ($("#FATURALI_HARIC").is(':checked')){
				var FATURALI_HARIC = 1;
			}else{
				var FATURALI_HARIC = 0;
			}
			
			if ($("#MODUL_HARIC").is(':checked')){
				var MODUL_HARIC = 1;
			}else{
				var MODUL_HARIC = 0;
			}
			
            var brans           = $("#SIGORTA_SEKLI").val();
            var tarih1          = $('#tarih1').val();
            var tarih2          = $('#tarih2').val();
            var marka_id        = $('#MARKA_ID').val();
            var kullanim        = $('#KULLANIM_SEKLI').val();
            var tedarikci       = $('#TEDARIKCI').val();
			var MENSEI       	= $('#MENSEI').val();
			var SEHIR_ID       	= $('#SEHIR_ID').val();
			var FILO_ACENTELER	= $('#FILO_ACENTELER').val();			
            $(".marka").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=1&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC+ "&param="+id);
            });

            $(".tedarikci").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=2&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC+ "&param="+id);
            });

            $(".iller").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=3&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC+"&param="+id);
            });

			$(".chart2_tedarikciler").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=4&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&mensei=" +MENSEI+ "&sehir_id=" +SEHIR_ID+ "&urun_id=" +URUN_ID+ "&param="+id+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC);
            });

			$(".chart2_eksperloesd").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=5&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&mensei=" +MENSEI+ "&sehir_id=" +SEHIR_ID+ "&urun_id=" +URUN_ID+ "&param="+id+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC);
            });

			$(".chart2_eksperlo").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=6&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&mensei=" +MENSEI+ "&sehir_id=" +SEHIR_ID+ "&urun_id=" +URUN_ID+ "&param="+id+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC);
            });

			$(".chart2_eksperesd").click(function(){
                var id = $(this).attr('id');
                $("#load_modal_box").load("chart_repostory/modals.php?modal_id=7&brans=" +brans+ "&tarih1=" +tarih1+ "&tarih2=" +tarih2+ "&marka_id=" +marka_id+ "&kullanim=" +kullanim+ "&tedarikci=" +tedarikci+ "&mensei=" +MENSEI+ "&sehir_id=" +SEHIR_ID+ "&urun_id=" +URUN_ID+ "&param="+id+ "&filo_haric=" +FILO_HARIC+ "&filo_acenteler=" +FILO_ACENTELER+ "&faturali_haric=" +FATURALI_HARIC+ "&modul_haric=" +MODUL_HARIC);
            });

        });

</script>