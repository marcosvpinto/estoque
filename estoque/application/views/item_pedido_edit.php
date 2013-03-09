<?php 

	echo form_open('ItemPedido/updateItem', 'class="form"');
	
	echo form_hidden('cod_pedido', $pedido[0]->cod_pedido);
	
	$field_array = array('Produto', 'Quantidade');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_hidden('id_item_pedido', $item[0]->id_item_pedido);
	
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
	echo br();
	
	echo form_submit('', 'Atualizar');
	echo form_close();

	
/* End of file item_pedido_edit.php */
/* Location: ./system/application/views/item_pedido_edit.php */