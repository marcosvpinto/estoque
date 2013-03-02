<?php 
	
	echo heading($headline, 2);
	echo br();
	
	echo '<script type="text/javascript">';
	echo '
		$(document).ready(function () {
			var dataset1 =" .json_encode($qry). ";
			var plot = $.plot($("#grafico"), [
			{
				data: dataset1, 
				lines: { show: true }, 		
				points: { show: true }		
			}], {
				xaxis: { mode: "time"}, 
				grid: {backgroundColor: { colors: ["#fff", "#eee"] }, hoverable: true, clickable: true}});
		
			function showTooltip(x, y, contents) {
				$("<div id="tooltip">" + contents + "</div>").css( {
					position: "absolute",
					display: "none",
					top: y + 5,
					left: x + 5,
					border: "1px solid #fdd",
					padding: "2px",
					"background-color": "#fee",
					opacity: 0.80
				}).appendTo("body").fadeIn(200);
			}

			var previousPoint = null;
			$("#placeholder").bind("plothover", function (event, pos, item) {
				$("#x").text(pos.x.toFixed(2));
				$("#y").text(pos.y.toFixed(2));
				
					if (item) {
						if (previousPoint != item.dataIndex) {
							previousPoint = item.dataIndex;
							
							$("#tooltip").remove();
							var x = item.datapoint[0].toFixed(2),
								y = item.datapoint[1].toFixed(2);
							
							showTooltip(item.pageX, item.pageY,
										item.series.label + " of " + x + " = " + y);
						}
					}
					else {
						$("#tooltip").remove();
						previousPoint = null;            
					}
			});
			
			$("#grafico").bind("plotclick", function (event, pos, item) {
				if (item) {
					$("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
					plot.highlight(item.series, item.datapoint);
				}
			});
		});';
	echo '</script>';
	echo '<div>';
	echo $data_table; 
	echo '</div>';
	echo br();
	echo '<div id="grafico" style="width:900px;height:300px;">';
	echo '</div>';
	echo '<span id="clickdata"></span>';
	echo br();

/* End of file relatorio_retorno.php */
/* Location: ./system/application/views/relatorio_retorno.php */