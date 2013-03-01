<?php 

	class MNotaFiscal extends CI_Model{

		function addNota($data)
		{
			$this->db->insert('nota', $data);
		}

		function listNota()
		{
			$this->db->join('fornecedor', 'fornecedor.id_fornecedor = nota.id_fornecedor');
			return $this->db->get('nota');
		}

		function getNota($id)
		{
			return $this->db->get_where('nota', array('cod_nota'=> $id));
		}

		function updateNota($id, $data)
		{
			$this->db->where('cod_nota', $id);
			$this->db->update('nota', $data); 
		}

		function deleteNota($id)
		{
			$this->db->where('cod_nota', $id);
			$this->db->delete('nota'); 
		}

	}

/* End of file mnotafiscal.php */
/* Location: ./system/application/models/mnotafiscal.php */