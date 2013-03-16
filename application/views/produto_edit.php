<?php 

	echo form_open('Produto/update', 'class="form-cadastro"');
	$field_array = array('Codigo', 'Nome', 'Categoria', 'Unidade', 'Minimo');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('id_produto', $produto[0]->id_produto);
	
	echo form_input('codigo', $produto[0]->codigo, 'title="Código do produto formado por 3 caracteres iniciais do tipo e 3 digitos sequenciais daquele tipo" class="required input-block-level input-xlarge" placeholder="Código"');
	echo br();
	
	echo form_input('nome_produto', $produto[0]->nome_produto, 'title="Nome do produto" class="required input-block-level input-xlarge" placeholder="Nome"');
	echo br();
	
	echo ('<select name="categoria" title="Categoria ou tipo de Produto" class="required input-block-level input-xlarge">');
	foreach($categorias->result() as $categoria):
		echo ('<option value="'.$categoria->id_categoria.'"'); 
			if($categoria->id_categoria == $produto[0]->categoria) 
				echo ('selected="selected"');
			echo('>'.$categoria->nome_categoria.'</option>');
	endforeach;
	echo ('</select>');
	
	echo ('<select name="unidade" title="Unidade de medida do produto" class="required input-block-level input-xlarge">');
	foreach($unidades->result() as $unidade):
		echo ('<option value="'.$unidade->id_apresentacao.'"');
			if($unidade->id_apresentacao == $produto[0]->unidade)
				echo('selected="selected"');
			echo('>'.$unidade->nome_apresentacao.'</option>');
	endforeach;
	echo ('</select>');
	
	echo form_input('qtd_minima', $produto[0]->qtd_minima, 'title="Quantidade mínima do produto em estoque" class="required number input-block-level  input-small" placeholder="Quantidade"');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"'); 
	echo form_close();
	
/* End of file produto_edit.php */
/* Location: ./system/application/views/produto_edit.php */