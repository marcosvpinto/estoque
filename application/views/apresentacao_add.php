<?php 

	
	echo form_open('apresentacao/create', 'class="form-cadastro"');
	$field_array = array('Nome');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();

	echo form_input('nome_apresentacao', '', 'title="Nome da unidade do produto" class="input-block-level input-xlarge" placeholder="Nome" required');	
	echo br();

	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	
	
	
/* End of file apresentacao_add.php */
/* Location: ./system/application/views/apresentacao_add.php */