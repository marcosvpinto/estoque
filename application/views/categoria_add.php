<?php 

	echo form_open('Categoria/create', 'class="form-cadastro"');
	$field_array = array('Nome');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_input('nome_categoria', '', 'title="Nome da categoria do produto" class="input-block-level input-xlarge" placeholder="Nome"');
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	
/* End of file categoria_add.php */
/* Location: ./system/application/views/categoria_add.php */