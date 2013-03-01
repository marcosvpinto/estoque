<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title><?php echo $title;?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilo.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/uniform.default.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_tablesorter.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smoothness/jquery-ui-1.8.10.custom.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tipTip.css" type="text/css" media="screen" charset="utf-8" />
		

		<!-- JavaScript -->
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.4.4.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.uniform.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/tablesorter.pagination.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.tablesorter.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-ui-1.8.9.custom.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.tipTip.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.maskedinput.js' ?>"></script>

		
		<script type="text/javascript">
		
			$(function(){
				$("input, textarea, select, button").uniform();
			});
		
		</script>
		
		<script type="text/javascript">
		
			$(document).ready(function(){ 
					$("#tabela").tablesorter({ 	})
					.tablesorter({widthFixed: true, widgets: ['zebra']}) 
					.tablesorterPager({container: $("#pager")});
			}); 
		
		</script>
		
		<script type="text/javascript">
		
			$(function(){
				$("input, textarea, select, button").tipTip({defaultPosition: "right", activation: "focus"});
			});
		
		</script>
		
		<script type="text/javascript">
		
			jQuery(function($){
			   $(".cnpj").mask("99.999.999-9999/99");
			   $(".telefone").mask("(99) 9999-9999");
			});
		
		</script>
		
		<script>
			
			$(function() {
				$( "input[type=submit], button" ).button()
			});
		
		</script>
		
		<script>
			
			$(function() {
				
				$("#categoria a").click(function(){

					$("#comunicado_portal").dialog({ width: 420, modal: true, show: "clip"});

				});
				
				$("#unidade a").click(function(){

					$("#comunicado_portal").dialog({ width: 420, modal: true, show: "clip"});

				});
				
			});
		
		</script>

	</head>
	
	<body>

		<div id="header">
			<h1><?php echo $headline;?></h1>
		</div>

		<div id="content">
		
			<div id="navigation">
			<?php 
				$opt = array(anchor('Estoque/index', 'Inicial', ''), 
				             anchor('Usuario/listing', 'Usuários'), 
				             anchor('Produto/listing', 'Produtos'), 
							 anchor('Fornecedor/listing', 'Fornecedores'), 
							 anchor('NotaFiscal/listing', 'Nota Fiscal'), 
							 anchor('Estoque/listing', 'Estoque'), 
							 anchor('Estoque/sair', 'Sair', ''));
				echo ul($opt, '');
			?>
			</div>
		
			<?php $this->load->view($include);?>
		
		</div>
		
		<div id="footer">
		
			<h3>MVPDEV Sistemas Digitais</h3>
		
		</div>

	</body>
</html>