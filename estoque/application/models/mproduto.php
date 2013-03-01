<?php 

	class MProduto extends CI_Model{

		function addProduto($data)
		{
			$this->db->insert('produto', $data);
		}

		function listProduto()
		{
			$this->db->join('apresentacao', 'apresentacao.id_apresentacao = produto.unidade');
			$this->db->join('categoria', 'categoria.id_categoria = produto.categoria');
			return $this->db->get('produto');
		}

		function getProduto($id)
		{
			return $this->db->get_where('produto', array('id_produto'=> $id));
		}

		function updateProduto($id, $data)
		{
			$this->db->where('id_produto', $id);
			$this->db->update('produto', $data); 
		}

		function deleteProduto($id)
		{
			$this->db->where('id_produto', $id);
			$this->db->delete('produto'); 
		}

	}

/* End of file mproduto.php */
/* Location: ./system/application/models/mproduto.php */