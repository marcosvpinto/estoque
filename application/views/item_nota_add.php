<?php 

	echo form_open('itemnota/createItens', 'class="form"');
	
	echo ('<div class="row-fluid">');
	echo ('<div class="span6">');
	echo heading('Cabeçalho da Nota Fiscal', 3, 'class="form-cadastro-heading"');
	
	$field_array1 = array('Número', 'Fornecedor', 'Data da Nota');
	
	echo form_hidden('cod_nota', $nota_fiscal[0]->cod_nota);
	
	echo form_input('numero_nota', $nota_fiscal[0]->numero_nota, 'disabled="disabled" class="input-block-level input-large"');
	echo br();
	
	echo ('<select name="id_fornecedor" disabled="disabled" class="input-block-level input-large">');
	echo ('<option value=""></option>');
	foreach($fornecedores->result() as $fornecedor):
		echo ('<option value="'.$fornecedor->id_fornecedor.'"'); 
			if($fornecedor->id_fornecedor == $nota_fiscal[0]->id_fornecedor) 
				echo ('selected="selected"');
		echo ('>'.$fornecedor->razao_social.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('data_nota', mysql_to_pt($nota_fiscal[0]->data_nota), 'id="data_nota" disabled="disabled" class="input-block-level input-large"');
	
	echo br();
	echo ('</div>');
	
	$field_array = array('Produto', 'Quantidade', 'Valor Unitário');

	echo ('<div class="span6">');
	echo heading('Item da Nota Fiscal', 3, 'class="form-cadastro-heading"');	

	echo ('<select name="cod_produto" title="Produto" class="input-block-level input-large" required>');
	echo ('<option value="">Produto</option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');

	echo form_input('quantidade', '', 'title="Quantidade de Itens Comprados" class="input-block-level input-large" placeholder="Quantidade" required');
	echo br();

	echo form_input('valor_item', '', 'title="Valor Unitário do Item" id="valor_item" class="input-block-level input-large" placeholder="Valor Unitário" required');
	echo br();
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	echo ('</div>');
	echo ('</div>');
	
	echo br();
	echo br();
	
	echo $data_table;
	echo br();
	echo br();
	
	echo anchor('notafiscal/fechar/'.$nota_fiscal[0]->cod_nota, form_button('Finalizar', 'Finalizar Cadastro', 'class="btn btn-primary"'));

	
/* End of file item_nota_add.php */
/* Location: ./system/application/views/item_nota_add.php */