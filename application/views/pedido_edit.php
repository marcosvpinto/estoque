<?php 

	echo form_open('pedido/update', 'class="form-cadastro"');
	$field_array = array('Usuário', 'Data Pedido', 'Observação');
	
	echo heading($headline, 3, 'class="form-signin-heading"');
	
	echo form_hidden('cod_pedido', $pedido[0]->cod_pedido);
	
	echo ('<select name="id_usuario" title="Usuário que fez a requisição" class="required input-block-level input-xlarge">');
	echo ('<option value=""></option>');
	foreach($usuarios->result() as $usuario):
		echo ('<option value="'.$usuario->id_usuario.'"');
			if($usuario->id_usuario == $pedido[0]->id_usuario) 
				echo ('selected="selected"');
		echo ('>'.$usuario->login.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('data_pedido', mysql_to_pt($pedido[0]->data_pedido), 'id="data_nota" title="Data que o usuário fez a requisição" class="required input-block-level input-xlarge"');
	
	echo form_textarea('obs', $pedido[0]->obs, 'title="Informação adicional relevante" class="required input-block-level input-xlarge"');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"');
	echo form_close();
	
/* End of file pedido_edit.php */
/* Location: ./system/application/views/pedido_edit.php */