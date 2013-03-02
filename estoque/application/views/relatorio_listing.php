<?php 

	echo heading($headline, 2);
	echo br();
	
	echo form_open('Relatorio\retorno', 'class="form"');
	echo br();
	echo form_label('Nome', "Nome do Produto");
	echo br();
	echo ('<select name="nome" title="Produto" class="required">');
	echo ('<option value=""></option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->nome_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	echo form_submit('', 'Executar');
	echo form_close();

/* End of file relatorio_listing.php */
/* Location: ./application/controllers/relatorio_listing.php */