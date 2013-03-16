<?php 

	echo form_open('Usuario/update', 'class="form-cadastro"');
	$field_array = array('Login', 'Senha', 'Setor', 'Perfil');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('id_usuario', $usuario[0]->id_usuario);
	
	echo form_input('login', $usuario[0]->login, 'title="Login do usuário no sistema" class="required input-block-level input-large" placeholder="Login"');
	echo br();
	
	echo form_password('senha', $usuario[0]->senha, 'title="Senha para o usuário" class="required input-block-level input-large" placeholder="Senha"');
	echo br();
	
	echo ('<select name="setor" title="Setor que o usuário está alocado" class="required input-block-level input-large">');
	foreach($setores->result() as $setor):
		echo ('<option value="'.$setor->id_setor.'"'); 
			if($setor->id_setor == $usuario[0]->setor) 
				echo ('selected="selected"');
			echo('>'.$setor->nome_setor.'</option>');
	endforeach;
	echo ('</select>');
	
	echo ('<select name="perfil" title="Perfil do usuário no sistema" class="required input-block-level input-large">');
	foreach($perfis->result() as $perfil):
		echo ('<option value="'.$perfil->nivel.'"');
			if($perfil->nivel == $usuario[0]->perfil)
				echo('selected="selected"');
			echo('>'.$perfil->nome_perfil.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"'); 
	echo form_close();
	
/* End of file usuario_edit.php */
/* Location: ./system/application/views/usuario_edit.php */