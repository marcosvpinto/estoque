<?php 

	echo form_open('Usuario/create', 'class="form"');
	$field_array = array('Login', 'Senha', 'Setor', 'Perfil');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('login', '', 'title="Login do usuário no sistema" size="10" class="required"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_password('senha', '', 'title="Senha para o usuário" size="10" class="required"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo ('<select name="setor" title="Setor que o usuário está alocado" class="required">');
	echo ('<option value=""></option>');
	foreach($setores->result() as $setor):
		echo ('<option value="'.$setor->id_setor.'">'.$setor->nome_setor.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[3], $field_array[3]);
	echo br();
	echo ('<select name="perfil" title="Perfil do usuário no sistema" class="required">');
	echo ('<option value=""></option>');
	foreach($perfis->result() as $perfil):
		echo ('<option value="'.$perfil->id_perfil.'">'.$perfil->nome_perfil.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="submit"'); 
	echo form_close();
	
/* End of file usuario_add.php */
/* Location: ./system/application/views/usuario_add.php */