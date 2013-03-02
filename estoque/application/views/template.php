<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title><?php echo $title;?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilo.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables_themeroller.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smoothness/jquery-ui-1.8.10.custom.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tipTip.css" type="text/css" media="screen" charset="utf-8" />

		<!-- JavaScript -->
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.9.1.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-ui-1.10.1.custom.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.tipTip.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.maskedinput.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/scripts.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.validate.js' ?>"></script>

	</head>
	
	<body>

		<div id="header">
			<h1><?php echo $headline;?></h1>
		</div>
		
		<div id="content">
		
			<div id="menu">
				<?php 
					$opt = array(anchor('Estoque/index', 'INICIAL'), 
								 anchor('Usuario/listing', 'USUÁRIOS'), 
								 anchor('Produto/listing', 'PRODUTOS'), 
								 anchor('Fornecedor/listing', 'FORNECEDORES'), 
								 anchor('NotaFiscal/listing', 'NOTA FISCAL'), 
								 anchor('', 'PEDIDO'), 
								 anchor('Estoque/listing', 'ESTOQUE'), 
								 anchor('Relatorio/listing', 'RELATÓRIO'),
								 anchor('Estoque/sair', 'SAIR'));
					echo ul($opt, 'id="navigation"');
				?>
			</div>
			
			<br />
			<br />
		
			<?php $this->load->view($include);?>
		
		</div>
		
		<div id="footer">
		
			<h3>MVPDEV Sistemas Digitais</h3>
		
		</div>

	</body>
</html>