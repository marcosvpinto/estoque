<?php 

	class MNotaFiscal extends CI_Model{

		function addNota($data)
		{
			$this->db->insert('nota', $data);
			return $this->db->insert_id();
		}

		function listNota()
		{
			$this->db->join('fornecedor', 'fornecedor.id_fornecedor = nota.id_fornecedor');
			$this->db->order_by('nota.data_nota', 'desc');
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
		
		function fecharNota($id)
		{
			$insert = array('fechado'=>'1');
			$this->db->where('cod_nota', $id);
			$this->db->update('nota', $insert);
		}
	}

/* End of file mnotafiscal.php */
/* Location: ./system/application/models/mnotafiscal.php */