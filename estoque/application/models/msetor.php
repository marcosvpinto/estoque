<?php 

	class MSetor extends CI_Model{

		function listSetor()
		{
			return $this->db->get('setor');
		}

		function getSetor($id)
		{
			return $this->db->get_where('setor', array('id_setor'=> $id));
		}

	}

/* End of file msetor.php */
/* Location: ./system/application/models/msetor.php */