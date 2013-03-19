<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title><?php echo $title;?></title>
		
		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilo.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables_themeroller.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.8.10.custom.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tipTip.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" type="text/css" media="screen" charset="utf-8" />

		<!-- JavaScript -->
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.9.1.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-ui-1.10.1.custom.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.tipTip.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.maskedinput.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/scripts.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/scripts.flot.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.validate.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.flot.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>

	</head>
	
	<body>
		
		<div id="wrap"> 
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						  <span class="icon-bar"></span>
						</button>
						<a class="brand">ESTOCA</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li class="divider-vertical"></li>
								<li <?php if($this->uri->segment(1) == 'Estoque' && $this->uri->segment(2) == 'index'){ echo 'class="active"'; } else { echo ''; } ?> ><?php echo anchor('Estoque/index', 'Inicial'); ?></li>
								<li class="dropdown <?php if($this->uri->segment(1) == 'Usuario'){ echo 'active'; } else { echo ''; } ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuários <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo anchor('Usuario/listing', 'Listagem'); ?></li>
										<li><?php echo anchor('Usuario/add', 'Cadastrar Usuário'); ?></li>
									</ul>
								</li>
								<li class="dropdown <?php if($this->uri->segment(1) == 'Produto'){ echo 'active'; } else { echo ''; } ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Produtos <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo anchor('Produto/listing', 'Listagem'); ?></li>
										<li><?php echo anchor('Produto/add', 'Cadastrar Produto'); ?></li>
										<li class="divider"></li>
										<li><?php echo anchor('Apresentacao/add', 'Cadastrar Apresentação'); ?></li>
										<li><?php echo anchor('Categoria/add', 'Cadastrar Categoria'); ?></li>
									</ul>
								</li>
								<li class="dropdown <?php if($this->uri->segment(1) == 'Fornecedor'){ echo 'active'; } else { echo ''; } ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Fornecedores <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo anchor('Fornecedor/listing', 'Listagem'); ?></li>
										<li><?php echo anchor('Fornecedor/add', 'Cadastrar Fornecedor'); ?></li>
									</ul>
								</li>
								<li class="dropdown <?php if($this->uri->segment(1) == 'NotaFiscal'){ echo 'active'; } else { echo ''; } ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Nota Fiscal <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo anchor('NotaFiscal/listing', 'Listagem'); ?></li>
										<li><?php echo anchor('NotaFiscal/add', 'Cadastrar Nota Fiscal'); ?></li>
									</ul>
								</li>
								<li class="dropdown <?php if($this->uri->segment(1) == 'Pedido'){ echo 'active'; } else { echo ''; } ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pedido <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><?php echo anchor('Pedido/listing', 'Listagem de Pedidos'); ?></li>
										<li><?php echo anchor('Pedido/add', 'Cadastrar Pedido'); ?></li>
										<li class="divider"></li>
										<li><?php echo anchor('ItemPedido/listing_itens', 'Listagem de Itens'); ?></li>
									</ul>
								</li>
								<li <?php if($this->uri->segment(1) == 'Estoque' && $this->uri->segment(2) == 'listing'){ echo 'class="active"'; } else { echo ''; } ?> ><?php echo anchor('Estoque/listing', 'Estoque'); ?></li>
								<li><?php echo anchor('Estoque/sair', 'Sair'); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		
			<div class="container">
				<?php $this->load->view($include);?>
			</div>
			
			<div id="push"></div>	
		</div>
		
		<div id="footer">
			<div class="container">
				<p class="muted credit">MVPDEV Sistemas Digitais - mvpdev@gmail.com</p>
			</div>
		</div>
		
	</body>
</html>