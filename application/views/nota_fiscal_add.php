<?php 

	echo form_open('notafiscal/create', 'class="form-cadastro"');
	$field_array = array('Número', 'Fornecedor', 'Data da Nota');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();

	echo form_input('numero_nota', '', 'title="Número da Nota Fiscal" size="15" class="input-block-level input-xlarge" placeholder="Nota Fiscal" required');
	echo br();
	
	echo ('<select name="id_fornecedor" title="Fornecedor" class="input-block-level input-xlarge" required>');
	echo ('<option value="">Fornecedor</option>');
	foreach($fornecedores->result() as $fornecedor):
		echo ('<option value="'.$fornecedor->id_fornecedor.'">'.$fornecedor->razao_social.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('data_nota', '', 'title="Data da Nota Fiscal" id="data_nota" size="15" class="input-block-level input-xlarge" placeholder="Data da Nota" required');
	
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	
/* End of file nota_fiscal_add.php */
/* Location: ./system/application/views/nota_fiscal_add.php */