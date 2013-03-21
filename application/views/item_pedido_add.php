<?php 

	echo form_open('ItemPedido/createItens', 'class="form"');
	
	echo ('<div class="row-fluid">');
	echo ('<div class="span6">');
	echo heading('Cabeçalho do Pedido', 3, 'class="form-cadastro-heading"');
	
	$field_array1 = array('Número', 'Usuario', 'Data do Pedido');
	
	echo form_hidden('cod_pedido', $pedido[0]->cod_pedido);
	
	echo form_input('cod_pedido', $pedido[0]->cod_pedido, 'disabled="disabled" class="input-block-level input-large"');
	echo br();
	
	echo ('<select name="id_usuario" disabled="disabled" class="input-block-level input-large">');
	echo ('<option value=""></option>');
	foreach($usuarios->result() as $usuario):
		echo ('<option value="'.$usuario->id_usuario.'"'); 
			if($usuario->id_usuario == $pedido[0]->id_usuario) 
				echo ('selected="selected"');
		echo ('>'.$usuario->login.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('data_pedido', mysql_to_pt($pedido[0]->data_pedido), 'id="data_pedido" disabled="disabled" class="input-block-level input-large"');
	
	echo br();
	echo ('</div>');
	
	$field_array = array('Produto', 'Quantidade');

	echo ('<div class="span6">');
	echo heading('Item do Pedido', 3, 'class="form-cadastro-heading"');	
	
	echo ('<select name="cod_produto" title="Produto" class="input-block-level input-large" required>');
	echo ('<option value="">Produto</option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');

	echo form_input('quantidade', '', 'title="Quantidade de Itens Solicitados" size="10" class="input-block-level input-large" placeholder="Quantidade" required');
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	echo br();
	echo ('</div>');
	echo ('</div>');
	
	echo br();
	echo br();
	
	if($msg == 1) {
		echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button> A quantidade do produto em estoque não é suficiente para realizar o pedido. </div>';
	}
	elseif($msg == 2) {
		echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button> Não é possível fechar um pedido com itens em aberto. </div>';
	}
	
	echo $data_table;
	echo br();
	echo br();
	
	echo anchor('Pedido/fechar/'.$pedido[0]->cod_pedido, form_button('Finalizar', 'Finalizar Cadastro', 'class="btn btn-primary"'));

/* End of file item_pedido_add.php */
/* Location: ./system/application/views/item_pedido_add.php */