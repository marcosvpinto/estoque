<?php 

	echo form_open('ItemPedido/createItens', 'class="form"');
	
	echo ('<div id="cabecalho_nota">');
	echo heading('Cabeçalho do Pedido', 2);
	
	$field_array1 = array('Número', 'Usuario', 'Data do Pedido');
	echo br();
	echo form_hidden('cod_pedido', $pedido[0]->cod_pedido);
	
	echo form_label($field_array1[0], $field_array1[0]);
	echo br();
	echo form_input('cod_pedido', $pedido[0]->cod_pedido, 'size="10" disabled="disabled"');
	echo br();
	
	echo form_label($field_array1[1], $field_array1[1]);
	echo br();
	echo ('<select name="id_usuario" disabled="disabled">');
	echo ('<option value=""></option>');
	foreach($usuarios->result() as $usuario):
		echo ('<option value="'.$usuario->id_usuario.'"'); 
			if($usuario->id_usuario == $pedido[0]->id_usuario) 
				echo ('selected="selected"');
		echo ('>'.$usuario->login.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array1[2], $field_array1[2]);
	echo br();
	echo form_input('data_pedido', mysql_to_pt($pedido[0]->data_pedido), 'id="data_pedido" size="15" disabled="disabled"');
	
	echo br();
	echo ('</div>');
	
	$field_array = array('Produto', 'Quantidade');

	echo ('<div id="item_nota">');
	echo heading('Item do Pedido', 2);	
	echo br();
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
	echo form_input('quantidade', '', 'title="Quantidade de Itens Solicitados" size="10" class="required"');
	echo br();
	
	echo nbs(25);
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	echo br();
	echo ('</div>');
	
	echo br();
	echo br();
	
	echo $data_table;
	echo br();
		
/* End of file item_pedido_add.php */
/* Location: ./system/application/views/item_pedido_add.php */