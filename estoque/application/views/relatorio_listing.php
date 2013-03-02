<?php 

	echo heading('Relatorios', 3);
	echo br();
	
	echo form_open('Relatorio\retorno', 'class="form"');
	echo form_label('Nome', 'Nome do Produto');
	echo br();
	echo form_input('nome', '', 'title="Nome do Produto"');
	echo br();
	echo form_submit('', 'Executar');
	echo form_close();

/* End of file relatorio_listing.php */
/* Location: ./application/controllers/relatorio_listing.php */