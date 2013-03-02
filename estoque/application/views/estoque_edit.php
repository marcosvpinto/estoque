<?php 

	echo form_open('Estoque/update', 'class="form"');
	$field_array = array('Produto', 'Quantidade');
	
	echo form_hidden('id_estoque', $estoque[0]->id_estoque);
	
	echo form_label($field_array[0], $field_array[0]);
	echo br();
	echo ('<select name="produto" disabled="disabled" >');
	foreach($produtos->result() as $produto):
		echo ('<option value="'.$produto->id_produto.'"'); 
			if($produto->id_produto == $estoque[0]->produto) 
				echo ('selected="selected"');
			echo('>'.$produto->nome_produto.'</option>');
	endforeach;
	echo ('</select>');
	echo br();
	
	echo form_label($field_array[1], $field_array[1]);
	echo br();
	echo form_input('quantidade', $estoque[0]->quantidade, 'size="5"');
	echo br();
	echo br();
	
	echo form_submit('', 'Atualizar'); 
	echo form_close();
	
/* End of file estoque_edit.php */
/* Location: ./system/application/views/estoque_edit.php */