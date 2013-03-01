<?php 

	echo form_open('Apresentacao/create');
	$field_array = array('Nome');
	
	echo form_label($field_array[0], $field_array[0]);
	echo form_input('nome_apresentacao', '', 'title="Nome da unidade do produto"');
	echo br();
	
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file apresentacao_add.php */
/* Location: ./system/application/views/apresentacao_add.php */