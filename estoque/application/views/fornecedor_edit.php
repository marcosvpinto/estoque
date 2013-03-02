<?php 

	echo form_open('Fornecedor/update', 'class="form"');
	$field_array = array('CNPJ', 'Razão Social', 'Telefone');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_hidden('id_fornecedor', $fornecedor[0]->id_fornecedor);
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('cnpj', $fornecedor[0]->cnpj, 'title="CNPJ da empresa" class="cnpj" size="15"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('razao_social', $fornecedor[0]->razao_social, 'title="Nome da empresa" size="60"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo form_input('telefone', $fornecedor[0]->telefone, 'title="Telefone de Contato" class="telefone" size="15"');
	echo br();
	echo br();
	
	echo form_submit('', 'Atualizar'); 
	echo form_close();
	
/* End of file fornecedor_edit.php */
/* Location: ./system/application/views/fornecedor_edit.php */