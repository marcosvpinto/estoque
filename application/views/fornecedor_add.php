<?php 

	echo form_open('fornecedor/create', 'class="form-cadastro"');
	$field_array = array('CNPJ', 'Razão Social', 'Telefone');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_input('cnpj', '', 'title="CNPJ da empresa" class="cnpj input-block-level input-xlarge" placeholder="CNPJ"');
	echo br();
	
	echo form_input('razao_social', '', 'title="Nome da empresa" class="input-block-level input-xlarge" placeholder="Razão Social" required');
	echo br();
	
	echo form_input('telefone', '', 'title="Telefone de Contato" class="telefone input-block-level input-xlarge" placeholder="Telefone"');
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"'); 
	echo form_close();
	
/* End of file fornecedor_add.php */
/* Location: ./system/application/views/fornecedor_add.php */