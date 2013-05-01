<?php 

	echo form_open('usuario/create', 'class="form-cadastro"');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_input('login', '', 'title="Login do usuário no sistema" class="input-block-level input-large" placeholder="Login" required');
	echo br();
	
	echo form_password('senha', '', 'title="Senha para o usuário" class="input-block-level input-large" placeholder="Senha" required');
	echo br();
	
	echo ('<select name="setor" title="Setor que o usuário está alocado" class="input-block-level input-large" required>');
	echo ('<option value="">Setor</option>');
	foreach($setores->result() as $setor):
		echo ('<option value="'.$setor->id_setor.'">'.$setor->nome_setor.'</option>');
	endforeach;
	echo ('</select>');
	
	echo ('<select name="perfil" title="Perfil do usuário no sistema" class="input-block-level input-large" required>');
	echo ('<option value="">Perfil</option>');
	foreach($perfis->result() as $perfil):
		echo ('<option value="'.$perfil->nivel.'">'.$perfil->nome_perfil.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"'); 
	echo form_close();
	
/* End of file usuario_add.php */
/* Location: ./system/application/views/usuario_add.php */