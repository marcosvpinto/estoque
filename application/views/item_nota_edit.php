<?php 

	echo form_open('itemnota/updateItem', 'class="form-cadastro"');
	
	echo form_hidden('cod_nota', $nota_fiscal[0]->cod_nota);
	
	$field_array = array('Produto', 'Quantidade', 'Valor Unitário');
	
	echo heading($headline, 4, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('id_item', $item[0]->id_item);
	
	echo ('<select name="cod_produto" title="Produto" class="required input-block-level input-large">');
	echo ('<option value="">Produto</option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'"');
			if($produto->id_produto == $item[0]->cod_produto) 
					echo ('selected="selected"');
		echo ('>'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('quantidade', $item[0]->quantidade, 'title="Quantidade de Itens Comprados" class="required input-block-level input-large"');
	echo br();
	
	echo form_input('valor_item', str_replace('.', ',', $item[0]->valor_item), 'title="Valor Unitário do Item" id="valor_item" class="required input-block-level input-large"');
	
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"');
	echo form_close();

	
/* End of file item_nota_edit.php */
/* Location: ./system/application/views/item_nota_edit.php */