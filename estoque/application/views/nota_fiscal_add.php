<?php 

	echo form_open('NotaFiscal/create');
	$field_array = array('Número', 'Fornecedor', 'Data da Nota');
	
	echo form_label($field_array[0], $field_array[0]);
	echo form_input('numero_nota', '', 'title="Número da Nota Fiscal"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo ('<select name="id_fornecedor" title="Fornecedor">');
	echo ('<option value=""></option>');
	foreach($fornecedores->result() as $fornecedor):
		echo ('<option value="'.$fornecedor->id_fornecedor.'">'.$fornecedor->razao_social.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo form_input('data_nota', '', 'title="Data da Nota Fiscal"');
	
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file nota_fiscal_add.php */
/* Location: ./system/application/views/nota_fiscal_add.php */