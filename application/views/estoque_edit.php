<?php 

	echo form_open('estoque/update', 'class="form-cadastro"');
	$field_array = array('Produto', 'Quantidade');
	
	echo heading($headline, 3, 'class="form-cadastro-heading"');
	echo br();
	
	echo form_hidden('id_estoque', $estoque[0]->id_estoque);
	
	echo ('<select name="produto" disabled="disabled" class="input-block-level input-xlarge" >');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'"'); 
			if($produto->id_produto == $estoque[0]->produto) 
				echo ('selected="selected"');
			echo('>'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');

	echo form_input('quantidade', $estoque[0]->quantidade, 'title="Apenas a quantidade do produto pode ser alterado" class="input-block-level input-xlarge"');
	echo br();
	
	echo form_submit('', 'Atualizar', 'class="btn btn-primary"'); 
	echo form_close();
	
/* End of file estoque_edit.php */
/* Location: ./system/application/views/estoque_edit.php */