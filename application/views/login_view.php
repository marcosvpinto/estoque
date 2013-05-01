<?php 

	echo '<div class="page-header">
			<h1>ESTOCA</h1>
			<h3>Sistema de Controle de Estoque</h3>
		</div>';

	echo form_open('login/process', 'class="form-signin"');
	$field_array = array('Login', 'Senha');
	
	echo heading('Login', 2, 'class="form-signin-heading"');
	
	if($msg == 1) 
		echo '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button> Usuário ou senha inválidos. </div>';

	echo form_input('username', '', 'title="Seu login no sistema" class="input-block-level" placeholder="Login"');

	echo form_password('password', '', 'title="Sua senha de acesso" class="input-block-level" placeholder="Senha"');

	echo form_submit('', 'Entrar', 'class="btn btn-large btn-primary"'); 
	echo br();
	
	echo form_close(); 
	
/* End of file login_view.php */
/* Location: ./system/application/views/login_view.php */
