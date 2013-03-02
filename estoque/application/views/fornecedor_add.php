<?php 

	echo form_open('Fornecedor/create', 'class="form"');
	$field_array = array('CNPJ', 'Razão Social', 'Telefone');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('cnpj', '', 'title="CNPJ da empresa" class="cnpj" size="15"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('razao_social', '', 'title="Nome da empresa" size="60"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo form_input('telefone', '', 'title="Telefone de Contato" class="telefone" size="15"');
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar'); 
	echo form_close();
	
/* End of file fornecedor_add.php */
/* Location: ./system/application/views/fornecedor_add.php */