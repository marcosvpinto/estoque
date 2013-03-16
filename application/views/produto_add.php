<?php 

	echo form_open('Produto/create', 'class="form-cadastro"');
	$field_array = array('Codigo', 'Nome', 'Categoria', 'Apresentacao', 'Minimo');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_input('codigo', '', 'title="Código do produto formado por 3 caracteres iniciais do tipo e 3 digitos sequenciais daquele tipo" class="input-block-level input-xlarge" placeholder="Código" required');
	echo br();
	
	echo form_input('nome_produto', '', 'title="Nome do produto" class="input-block-level input-xlarge" placeholder="Nome" required');
	
	echo ('<select name="categoria" title="Categoria ou tipo de Produto" class="input-block-level input-xlarge" required>');
	echo ('<option value="">Categoria</option>');
	foreach($categorias->result() as $categoria):
		echo ('<option value="'.$categoria->id_categoria.'">'.$categoria->nome_categoria.'</option>');
	endforeach;
	echo ('</select>');
		
	echo ('<select name="unidade" title="Unidade de medida do produto" class="input-block-level input-xlarge" required>');
	echo ('<option value="">Apresentacao</option>');
	foreach($unidades->result() as $unidade):
		echo ('<option value="'.$unidade->id_apresentacao.'">'.$unidade->nome_apresentacao.'</option>');
	endforeach;
	echo ('</select>');
		
	echo form_input('qtd_minima', '', 'title="Quantidade mínima do produto em estoque" class="number input-block-level input-small" placeholder="Minimo" required');
	echo br();
	echo br();
	echo form_submit('', 'Cadastrar', 'class="btn btn-primary"');
	echo form_close();
	
/* End of file produto_add.php */
/* Location: ./system/application/views/produto_add.php */