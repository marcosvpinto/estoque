<?php 

	echo form_open('Categoria/create', 'class="form"');
	$field_array = array('Nome');
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('nome_categoria', '', 'title="Nome da categoria do produto"');
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file categoria_add.php */
/* Location: ./system/application/views/categoria_add.php */