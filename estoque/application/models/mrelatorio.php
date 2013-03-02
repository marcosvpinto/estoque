<?php 

	class MRelatorio extends CI_Model{

		function getConsumoProduto($nome)
		{
			$this->db->where('nome_produto', $nome['nome']);
			return $this->db->get('consumo_produto');
		}

	}

/* End of file mrelatorio.php */
/* Location: ./system/application/models/mrelatorio.php */