<?php 

	echo form_open('ItemNota/createItens', 'class="form"');
	
	echo ('<div id="cabecalho_nota">');
	echo heading('Cabeçalho da Nota Fiscal', 2);
	
	$field_array1 = array('Número', 'Fornecedor', 'Data da Nota');
	echo br();
	echo form_hidden('cod_nota', $nota_fiscal[0]->cod_nota);
	
	echo form_label($field_array1[0], $field_array1[0]);
	echo br();
	echo form_input('numero_nota', $nota_fiscal[0]->numero_nota, 'size="15" disabled="disabled"');
	echo br();
	
	echo form_label($field_array1[1], $field_array1[1]);
	echo br();
	echo ('<select name="id_fornecedor" disabled="disabled">');
	echo ('<option value=""></option>');
	foreach($fornecedores->result() as $fornecedor):
		echo ('<option value="'.$fornecedor->id_fornecedor.'"'); 
			if($fornecedor->id_fornecedor == $nota_fiscal[0]->id_fornecedor) 
				echo ('selected="selected"');
		echo ('>'.$fornecedor->razao_social.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array1[2], $field_array1[2]);
	echo br();
	echo form_input('data_nota', mysql_to_pt($nota_fiscal[0]->data_nota), 'id="data_nota" size="15" disabled="disabled"');
	
	echo br();
	echo ('</div>');
	
	$field_array = array('Produto', 'Quantidade', 'Valor Unitário');

	echo ('<div id="item_nota">');	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo ('<select name="cod_produto" title="Produto" class="required">');
	echo ('<option value=""></option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	echo br();

	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('quantidade', '', 'title="Quantidade de Itens Comprados" size="10" class="required"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo form_input('valor_item', '', 'title="Valor Unitário do Item" id="valor_item" size="15" class="required"');
	
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	echo br();
	echo ('</div>');
	
	echo br();
	echo br();
	
	echo $data_table;
	echo br();
	
	echo anchor('NotaFiscal/fechar/'.$nota_fiscal[0]->cod_nota, form_button('Finalizar', 'Finalizar Cadastro'));	
	
/* End of file item_nota_add.php */
/* Location: ./system/application/views/item_nota_add.php */