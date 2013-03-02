<?php 
	
	echo heading($headline, 2);
	echo br();
	echo $data_table; 
	echo br();
	echo anchor('Fornecedor/add', form_button('Inserir', 'Inserir Fornecedor'));
	
?>
