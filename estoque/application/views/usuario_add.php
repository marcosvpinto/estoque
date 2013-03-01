<?php 

	echo form_open('Usuario/create');
	$field_array = array('Login', 'Senha', 'Setor', 'Perfil');
	
	echo form_label($field_array[0], $field_array[0]);
	echo form_input('login');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo form_password('senha');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo ('<select name="setor">');
	echo ('<option value=""></option>');
	foreach($setores->result() as $setor):
		echo ('<option value="'.$setor->id_setor.'">'.$setor->nome_setor.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[3], $field_array[3]);
	echo ('<select name="perfil">');
	echo ('<option value=""></option>');
	foreach($perfis->result() as $perfil):
		echo ('<option value="'.$perfil->id_perfil.'">'.$perfil->nome_perfil.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_submit('', 'Cadastrar'); 
	echo form_close();
	
/* End of file usuario_add.php */
/* Location: ./system/application/views/usuario_add.php */