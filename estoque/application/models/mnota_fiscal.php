<?php 

	class MNotaFiscal extends CI_Model{

		function addNota($data)
		{
			$this->db->insert('nota', $data);
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

/* End of file mnota_fiscal.php */
/* Location: ./system/application/models/mnota_fiscal.php */