<?php 
	echo form_open('Login/process', 'class="form"');
	$field_array = array('Login', 'Senha');
	
	echo heading('Login', 2);
	echo br();
	if(! is_null($msg)) echo $msg;
	echo br();
	echo form_label($field_array[0], 'username');
	echo br();
	echo form_input('username', '', 'title="Seu login no sistema"');
	echo br();
	echo br();

	echo form_label($field_array[1], 'password');
	echo br();
	echo form_password('password', '', 'title="Sua senha de acesso"');
	echo br();
	echo br();

	echo form_submit('', 'Entrar'); 
	echo form_close(); 
	
/* End of file login_view.php */
/* Location: ./system/application/views/login_view.php */