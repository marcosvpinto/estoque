<?php 
	
	echo '<script type="text/javascript">';
	echo '
		$(document).ready(function () {
			var dataset1 =' .json_encode($qry). ';
			$.plot($("#grafico"), [dataset1], { xaxis: { mode: "time" } });
		});';
	echo '</script>';
	echo '<div>';
	echo $data_table; 
	echo '</div>';
	echo br();
	echo '<div id="grafico" style="width:900px;height:300px;">';
	echo '</div>';

/* End of file relatorio_retorno.php */
/* Location: ./system/application/views/relatorio_retorno.php */