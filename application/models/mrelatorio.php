<?php 

	class MRelatorio extends CI_Model{

		function getConsumoProduto($nome)
		{
			$where = "nome_produto = '".$nome['nome']."'";
			$this->db->where($where);
			return $this->db->get('consumo_produto');
		}
		
		function getCompraProduto()
		{
			//$where = "nome_produto = '".$nome['nome']."'";
			//$this->db->where($where);
			return $this->db->get('nota');
		}

	}

/* End of file mrelatorio.php */
/* Location: ./system/application/models/mrelatorio.php */