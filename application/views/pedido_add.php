<?php 

	echo form_open('Pedido/create', 'class="form-cadastro"');
	$field_array = array('Usuário', 'Data Pedido', 'Observação');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo ('<select name="id_usuario" title="Usuário que fez a requisição" class="required input-block-level input-xlarge">');
	echo ('<option value="">Usuário</option>');
	foreach($usuarios->result() as $usuario):
		echo ('<option value="'.$usuario->id_usuario.'">'.$usuario->login.'</option>');
	endforeach;
	echo ('</select>');

	echo form_input('data_pedido', '', 'id="data_nota" title="Data que o usuário fez o pedido" size="15" class="required  input-block-level input-xlarge" placeholder="Data do pedido"');
	echo br();
	
	echo form_textarea('obs', '', 'title="Informação adicional relevante" class="input-block-level input-xlarge" placeholder="Observações"');
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	
/* End of file pedido_add.php */
/* Location: ./system/application/views/pedido_add.php */