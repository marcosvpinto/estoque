<?php 

	class MFornecedor extends CI_Model{

		function addFornecedor($data)
		{
			$this->db->insert('fornecedor', $data);
		}

		function listFornecedor()
		{
			return $this->db->get('fornecedor');
		}

		function getFornecedor($id)
		{
			return $this->db->get_where('fornecedor', array('id_fornecedor'=> $id));
		}

		function updateFornecedor($id, $data)
		{
			$this->db->where('id_fornecedor', $id);
			$this->db->update('fornecedor', $data); 
		}

		function deleteFornecedor($id)
		{
			$this->db->where('id_fornecedor', $id);
			$this->db->delete('fornecedor'); 
		}

	}

/* End of file mfornecedor.php */
/* Location: ./system/application/models/mfornecedor.php */