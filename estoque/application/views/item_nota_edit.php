<?php 

	echo form_open('ItemNota/updateItem', 'class="form"');
	
	echo form_hidden('cod_nota', $nota_fiscal[0]->cod_nota);
	
	$field_array = array('Produto', 'Quantidade', 'Valor Unitário');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_hidden('id_item', $item[0]->id_item);
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo ('<select name="cod_produto" title="Produto" class="required">');
	echo ('<option value=""></option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'"');
			if($produto->id_produto == $item[0]->cod_produto) 
					echo ('selected="selected"');
		echo ('>'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('quantidade', $item[0]->quantidade, 'title="Quantidade de Itens Comprados" size="10" class="required"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo form_input('valor_item', str_replace('.', ',', $item[0]->valor_item), 'title="Valor Unitário do Item" id="valor_item" size="15" class="required"');
	
	echo br();
	echo br();
	
	echo form_submit('', 'Atualizar');
	echo form_close();

	
/* End of file item_nota_add.php */
/* Location: ./system/application/views/item_nota_add.php */