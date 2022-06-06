<?php
require_once("chartSektorYokParcalarClass.php");
$chartClass         = new chartSektorYokParcalarClass();
$modul_kontrol      = $chartClass->modul_aktif_kontrol();
?>

    <div class="card" style="width: 98%;margin: 0px auto;">                
				<?php
				$top_yok_arr         = $chartClass->sektorYokParcalarBlok($D_YIL, $D_AY, $D_SS, $ARAC_YAS, $D_MARKA, $D_PT, $D_AKS);	
				if(count($top_yok_arr)>750){ $style="style='min-height:20000;'"; }
				else if(count($top_yok_arr)<=25){ $style="style='min-height:700px;'"; }
				else if(count($top_yok_arr)<=50){ $style="style='min-height:800px;'"; }
				else if(count($top_yok_arr)<=100){ $style="style='min-height:1800px;'"; }
				else if(count($top_yok_arr)<=250){ $style="style='min-height:4800px;'"; }				
				else if(count($top_yok_arr)<=500){ $style="style='min-height:9800px;'"; }				
				else if(count($top_yok_arr)<=750){ $style="style='min-height:13000px;'"; }											
				
                foreach($top_yok_arr as $top_yok){
															
						$chart_data_top_yok .= "{ parca:'PARÇA:".$top_yok['PARCA_ADI']." - KOD:".$top_yok['ORJ_PARCA_KODU']." - MARKA:".$top_yok['MARKA_ADI']."', tutar: ".$top_yok['TOPLAM_YOK_SISTEM_TUTAR'].", oran:".formatla( $top_yok['TOPLAM_VAR_SISTEM_TUTAR'] / ($top_yok['TOPLAM_VAR_SISTEM_TUTAR']+$top_yok['TOPLAM_YOK_SISTEM_TUTAR'])*100 )."}, ";
						
						$var_toplam 	+= $top_yok['TOPLAM_VAR_SISTEM_TUTAR'];
						$yok_toplam 	+= $top_yok['TOPLAM_YOK_SISTEM_TUTAR'];						
				}							
						$varyok_toplam = $var_toplam + $yok_toplam;												
				?>
				
				<?php
					$karsilama_orani	= ($var_toplam/$varyok_toplam*100);
					if(95-$karsilama_orani>0) { $hedeften_sapma =  95-$karsilama_orani; } else { $hedeften_sapma =  0; } 
                    //DONUT 1
                    $pie_data   .= "{ label: '".dil_dashboard('Tutarsal Karþýlama Oraný%')."', value: ". (formatla($karsilama_orani)) ." }, ";
                    $pie_data2  .= "{ label: '".dil_dashboard('Hedeften Sapma%')."', value: ". (formatla($hedeften_sapma)) ." }, ";                    
                ?>
				<div style="width: 99%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px; min-height: 425px;">
                    <div class="row">
                        <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                            <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Stokta Yok Denilen 1000 Parça Ýçin Oran Daðýlýmý")?></p>
                        </div>
                        <div class="col-lg-6 col-lg-6-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Tutarsal Karþýlama Oraný")?></center></b>
                                <div id='chart_pie_1' class='chart_morris'></div>
                                <div id='chart_pie_1_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-lg-6-pdf">
                            <div style="margin: 6px;cursor: pointer;overflow: hidden;color: #000000;border: 1px solid #dfe8f1;">
                                <b><center><?=dil_dashboard("Hedeften Sapma Oraný")?></center></b>
                                <div id='chart_pie_2' class='chart_morris'></div>
                                <div id='chart_pie_2_legend' class='text-center' style='font-size: 11px;font-weight: 600;'></div>
                            </div>
                        </div>                      
                    </div>
                </div>
				
				
				<div class="row" style="width: 99.7%; margin-top:10px">
                    <div class="col-lg-12-pdf">
                    <div style="width: 100%; padding: 1px; cursor: pointer; overflow: hidden; color: #000000; margin: 0px auto;  margin-top: 5px;">
                        <div class="row" style="width: 99.7%;">
                            <div class="panel-heading" style="padding: 5px;color: #333;background-color: #c8dcbb;border-color: #DFE8D9;">
                                <p class="panel-title" style="text-align: center;font-size: 14px;"><?=dil_dashboard("Sektörde Yok Cevaplanan Top Parçalar (En fazla yok denilen parça tutarýna göre sýralanmýþtýr.)")?> </p>
                            </div>
                            <div id='chart_hist_yok' class='chart_morris' <?=$style;?>></div>
                        </div>
                    </div>
					</div>
				</div>								

	</div>
    <div class="clear"></div>

    <div style="margin-top : 10px;"></div>

    <script type="text/javascript" src="/jq/jquery.base64.js"></script>
    <script>
        function pdfMake(id, filename) {

            jQuery.loadScript = function (url, callback) {
                jQuery.ajax({
                    url: url,
                    dataType: 'script',
                    success: callback,
                    async: true
                });
            }

            function postPDF(){
                $.base64.utf8encode = true;
                var htmlIcerik = $.base64.btoa($('#' + id).html());

                $.post('/toPDF.php', {contentHTML: htmlIcerik, fileName: filename}, function(data, textStatus, xhr) {
                    if (data.file_name) {
                        popup('/toPDF.php?download=' + data.file_name, 'PDFDownload', 700, 100);
                    }
                }, "json");
            }

            if (typeof $.base64 == 'undefined') {
                $.loadScript('/jq/jquery.base64.js', function(){
                    postPDF();
                });
            } else {
                postPDF();
            }

        }			
		
		Morris.Bar({
			element: 'chart_hist_yok',
			dataLabels: true,		
			data:[<?php echo $chart_data_top_yok; ?>],			
			xkey:'parca',
			ykeys:['tutar','oran'],
			labels:['','<?=dil_dashboard("Performansý En Düþük Top 1000 Parça Kodu (Ortalama Tutarsal Karþýlama Oraný % )")?>'],		  
			horizontal: true,
			stacked:true,						
        });	
		
		pie_data  = [ <?=$pie_data; ?> ];
		pie_data2 = [ <?=$pie_data2; ?> ];
		var colors_array= ["#e21914", "#e21914", "#e21914"];
		Morris.Donut({
          element: 'chart_pie_1',		  
          data: pie_data
        }).options.colors.forEach(function(color, a){
        if (pie_data[a] != undefined) {			
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data[a].label+'</span>';
            document.getElementById("chart_pie_1_legend").appendChild(node);
          }
        });


        Morris.Donut({
          element: 'chart_pie_2',
		  colors: colors_array,
          data: pie_data2
        }).options.colors.forEach(function(color, a){
        if (pie_data2[a] != undefined) {
            var node = document.createElement('span');
            node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie_data2[a].label+'</span>';
            document.getElementById("chart_pie_2_legend").appendChild(node);
          }
        });
		

    </script>