<?php 

	echo form_open('Pedido/create', 'class="form"');
	$field_array = array('Usuário', 'Produto', 'Quantidade', 'Data Pedido', 'Observação');
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo ('<select name="id_usuario" title="Usuário que fez a requisição" class="required">');
	echo ('<option value=""></option>');
	foreach($usuarios->result() as $usuario):
		echo ('<option value="'.$usuario->id_usuario.'">'.$usuario->login.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo ('<select name="cod_produto" title="Produto solicitado" class="required">');
	echo ('<option value=""></option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo form_input('quantidade_pedida', '', 'title="Quantidade do produto solicitada pelo usuário" size="10" class="required number"');
	echo br();
	
	echo form_label($field_array[3], $field_array[3]);
	echo br();
	echo form_input('data_pedido', '', 'id="data_nota" title="Data que o usuário fez a requisição" size="15" class="required"');
	echo br();
	
	echo form_label($field_array[4], $field_array[4]);
	echo br();
	echo form_textarea('obs', '', 'title="Informação adicional relevante"');
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file pedido_add.php */
/* Location: ./system/application/views/pedido_add.php */