<?php 

	echo form_open('Produto/update', 'class="form"');
	$field_array = array('Codigo', 'Nome', 'Categoria', 'Unidade', 'Minimo');
	
	echo heading($headline, 2);
	echo br();
	
	echo form_hidden('id_produto', $produto[0]->id_produto);
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('codigo', $produto[0]->codigo, 'title="Código do produto formado por 3 caracteres iniciais do tipo e 3 digitos sequenciais daquele tipo" size="15"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('nome_produto', $produto[0]->nome_produto, 'title="Nome do produto" size="15"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo ('<select name="categoria" title="Categoria ou tipo de Produto">');
	foreach($categorias->result() as $categoria):
		echo ('<option value="'.$categoria->id_categoria.'"'); 
			if($categoria->id_categoria == $produto[0]->categoria) 
				echo ('selected="selected"');
			echo('>'.$categoria->nome_categoria.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[3], $field_array[3]);
	echo br();
	echo ('<select name="unidade">');
	foreach($unidades->result() as $unidade):
		echo ('<option value="'.$unidade->id_apresentacao.'"');
			if($unidade->id_apresentacao == $produto[0]->unidade)
				echo('selected="selected"');
			echo('>'.$unidade->nome_apresentacao.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[4], $field_array[4]);
	echo br();
	echo form_input('qtd_minima', $produto[0]->qtd_minima, 'title="Quantidade mínima do produto em estoque" size="5"');
	echo br();
	echo br();
	
	echo form_submit('', 'Atualizar'); 
	echo form_close();
	
/* End of file produto_edit.php */
/* Location: ./system/application/views/produto_edit.php */