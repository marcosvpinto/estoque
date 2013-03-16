<?php 

	echo form_open('ItemPedido/updateItem', 'class="form-cadastro"');
	
	echo form_hidden('cod_pedido', $pedido[0]->cod_pedido);
	
	$field_array = array('Produto', 'Quantidade');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('id_item_pedido', $item[0]->id_item_pedido);
	
	echo ('<select name="cod_produto" title="Produto" class="required input-block-level input-large">');
	echo ('<option value=""></option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'"');
			if($produto->id_produto == $item[0]->cod_produto) 
					echo ('selected="selected"');
		echo ('>'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('quantidade', $item[0]->quantidade, 'title="Quantidade de Itens Comprados" size="10" class="required input-block-level input-large"');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"');
	echo form_close();

	
/* End of file item_pedido_edit.php */
/* Location: ./system/application/views/item_pedido_edit.php */