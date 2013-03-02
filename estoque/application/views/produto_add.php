<?php 

	echo form_open('Produto/create', 'class="form"');
	$field_array = array('Codigo', 'Nome', 'Categoria', 'Apresentacao', 'Minimo');
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo form_input('codigo', '', 'title="Código do produto formado por 3 caracteres iniciais do tipo e 3 digitos sequenciais daquele tipo" size="15" class="required"');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('nome_produto', '', 'title="Nome do produto" size="15" class="required"');
	echo br();
	
	echo form_label($field_array[2], $field_array[2]);
	echo br();
	echo ('<select name="categoria" title="Categoria ou tipo de Produto" class="required">');
	echo ('<option value=""></option>');
	foreach($categorias->result() as $categoria):
		echo ('<option value="'.$categoria->id_categoria.'">'.$categoria->nome_categoria.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	echo br();
	echo anchor('Categoria/add', form_button('Categoria', 'Cadastro de Categoria'), 'id="categoria"');
	echo br();
	echo br();
	
	echo form_label($field_array[3], $field_array[3]);
	echo br();
	echo ('<select name="unidade" title="Unidade de medida do produto" class="required">');
	echo ('<option value=""></option>');
	foreach($unidades->result() as $unidade):
		echo ('<option value="'.$unidade->id_apresentacao.'">'.$unidade->nome_apresentacao.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	echo br();
	echo anchor('Apresentacao/add', form_button('Apresentacao', 'Cadastro de Apresentacao'), 'id="unidade"');
	echo br();
	echo br();
	
	echo form_label($field_array[4], $field_array[4]);
	echo br();
	echo form_input('qtd_minima', '', 'title="Quantidade mínima do produto em estoque" size="5" class="required number"');
	echo br();
	echo br();
	
	echo form_submit('', 'Cadastrar');
	echo form_close();
	
/* End of file produto_add.php */
/* Location: ./system/application/views/produto_add.php */