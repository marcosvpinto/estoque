<?php 

	class MEstoque extends CI_Model{

		function addEstoque($data)
		{
			$this->db->insert('estoque', $data);
		}

		function listEstoque()
		{
			$this->db->join('produto', 'estoque.produto = produto.id_produto');
			return $this->db->get('estoque');
		}

		function getEstoque($id)
		{
			return $this->db->get_where('estoque', array('id_estoque'=> $id));
		}

		function getEstoqueByProduto($id) {
			return $this->db->get_where('estoque', array('produto'=> $id));
		}
		
		function updateEstoque($id, $data)
		{
			$this->db->where('id_estoque', $id);
			$this->db->update('estoque', $data); 
		}

		function deleteEstoque($id)
		{
			$this->db->where('id_estoque', $id);
			$this->db->delete('estoque'); 
		}

	}

/* End of file mestoque.php */
/* Location: ./system/application/models/mestoque.php */