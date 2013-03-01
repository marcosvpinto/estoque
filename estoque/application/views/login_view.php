<div id='login_form'>
	<?php echo form_open('Login/process'); ?>
	<!-- <form action='login/process' method='post' name='process'> -->
		<h2>Login</h2>
		<br />
		<?php if(! is_null($msg)) echo $msg;?>		
		<label for='username'>Usuário</label>
		<input type='text' name='username' id='username' size='25' /><br />
	
		<label for='password'>Senha</label>
		<input type='password' name='password' id='password' size='25' /><br />                            
	
		<!-- <input type='Submit' value='Entrar' /> -->
		<?php echo form_submit('', 'Entrar'); 
		echo form_close(); ?>
	<!-- </form> -->
</div>