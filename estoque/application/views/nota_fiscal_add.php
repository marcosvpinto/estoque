<?php 

	echo form_open('NotaFiscal/create', 'class="form"');
	$field_array = array('Número', 'Fornecedor', 'Data da Nota');
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('numero_nota', '', 'title="Número da Nota Fiscal" size="15" class="required"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo ('<select name="id_fornecedor" title="Fornecedor" class="required">');
	echo ('<option value=""></option>');
	foreach($fornecedores->result() as $fornecedor):
		echo ('<option value="'.$fornecedor->id_fornecedor.'">'.$fornecedor->razao_social.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo form_input('data_nota', '', 'title="Data da Nota Fiscal" id="data_nota" size="15" class="required"');
	
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file nota_fiscal_add.php */
/* Location: ./system/application/views/nota_fiscal_add.php */