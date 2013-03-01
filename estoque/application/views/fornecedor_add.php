<?php 

	echo form_open('Fornecedor/create');
	$field_array = array('CNPJ', 'Razão Social', 'Telefone');
	
	echo form_label($field_array[0], $field_array[0]);
	echo form_input('cnpj', '', 'title="CNPJ da empresa" class="cnpj"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo form_input('razao_social', '', 'title="Nome da empresa"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo form_input('telefone', '', 'title="Telefone de Contato" class="telefone"');
	echo br();
	
	echo form_submit('', 'Cadastrar'); 
	echo form_close();
	
/* End of file fornecedor_add.php */
/* Location: ./system/application/views/fornecedor_add.php */