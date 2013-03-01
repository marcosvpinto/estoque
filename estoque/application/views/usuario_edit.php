<?php 

	echo form_open('Usuario/update');
	$field_array = array('Login', 'Senha', 'Setor', 'Perfil');
	
	echo form_hidden('id_usuario', $usuario[0]->id_usuario);
	
	echo form_label($field_array[0], $field_array[0]);
	echo form_input('login', $usuario[0]->login);
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo form_password('senha', $usuario[0]->senha);
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo ('<select name="setor">');
	foreach($setores->result() as $setor):
		echo ('<option value="'.$setor->id_setor.'"'); 
			if($setor->id_setor == $usuario[0]->setor) 
				echo ('selected="selected"');
			echo('>'.$setor->nome_setor.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[3], $field_array[3]);
	echo ('<select name="perfil">');
	foreach($perfis->result() as $perfil):
		echo ('<option value="'.$perfil->id_perfil.'"');
			if($perfil->id_perfil == $usuario[0]->perfil)
				echo('selected="selected"');
			echo('>'.$perfil->nome_perfil.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_submit('', 'Atualizar'); 
	echo form_close();
	
/* End of file usuario_edit.php */
/* Location: ./system/application/views/usuario_edit.php */