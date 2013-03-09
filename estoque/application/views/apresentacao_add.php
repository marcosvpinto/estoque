<?php 

	echo form_open('Apresentacao/create', 'class="form"');
	$field_array = array('Nome');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('nome_apresentacao', '', 'title="Nome da unidade do produto"');
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file apresentacao_add.php */
/* Location: ./system/application/views/apresentacao_add.php */