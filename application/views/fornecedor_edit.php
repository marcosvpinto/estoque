<?php 

	echo form_open('fornecedor/update', 'class="form-cadastro"');
	$field_array = array('CNPJ', 'Razão Social', 'Telefone');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('id_fornecedor', $fornecedor[0]->id_fornecedor);
	
	echo form_input('cnpj', $fornecedor[0]->cnpj, 'title="CNPJ da empresa" class="cnpj input-block-level input-xlarge" placeholder="CNPJ"');
	echo br();
	
	echo form_input('razao_social', $fornecedor[0]->razao_social, 'title="Nome da empresa" class="input-block-level input-xlarge" placeholder="Razão Social"');
	echo br();

	echo form_input('telefone', $fornecedor[0]->telefone, 'title="Telefone de Contato" class="telefone input-block-level input-xlarge" placeholder="Telefone"');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"'); 
	echo form_close();
	
/* End of file fornecedor_edit.php */
/* Location: ./system/application/views/fornecedor_edit.php */