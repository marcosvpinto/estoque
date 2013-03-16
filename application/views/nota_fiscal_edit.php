<?php 

	echo form_open('NotaFiscal/update', 'class="form-cadastro"');
	$field_array = array('Número', 'Fornecedor', 'Data da Nota');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('cod_nota', $nota_fiscal[0]->cod_nota);
	
	echo form_input('numero_nota', $nota_fiscal[0]->numero_nota, 'title="Número da Nota Fiscal" size="15" class="required input-block-level input-xlarge" placeholder="Nota Fiscal"');
	echo br();
	
	echo ('<select name="id_fornecedor" title="Fornecedor" class="required input-block-level input-xlarge">');
	echo ('<option value="">Fornecedor</option>');
	foreach($fornecedores->result() as $fornecedor):
		echo ('<option value="'.$fornecedor->id_fornecedor.'"'); 
			if($fornecedor->id_fornecedor == $nota_fiscal[0]->id_fornecedor) 
				echo ('selected="selected"');
		echo ('>'.$fornecedor->razao_social.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('data_nota', mysql_to_pt($nota_fiscal[0]->data_nota), 'title="Data da Nota Fiscal" id="data_nota" size="15" class="required input-block-level input-xlarge" placeholder="Data da Nota"');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"');
	echo form_close();
	
/* End of file nota_fiscal_edit.php */
/* Location: ./system/application/views/nota_fiscal_edit.php */