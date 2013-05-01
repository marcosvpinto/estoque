<?php 

	echo heading($headline, 2);
	echo br();
	
	echo form_open('relatorio/retorno_consumo', 'class="form-cadastro"');
	echo heading('Consumo de Produtos', 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo ('<select name="nome" title="Produto" class="required input-block-level input-xlarge">');
	echo ('<option value="">Produto</option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->nome_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_submit('', 'Executar', 'class="btn"');
	echo form_close();
	
	
	echo form_open('relatorio/retorno_compra', 'class="form-cadastro"');
	echo heading('Compra de Produtos', 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo ('<select name="nome" title="Produto" class="required input-block-level input-xlarge">');
	echo ('<option value="">Produto</option>');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->nome_produto.'">'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_submit('', 'Executar', 'class="btn"');
	echo form_close();

/* End of file relatorio_listing.php */
/* Location: ./application/controllers/relatorio_listing.php */