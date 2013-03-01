<?php 

class MApresentacao extends CI_Model{

	function addApresentacao($data)
	{
		$this->db->insert('apresentacao', $data);
	}

	function listApresentacao()
	{
		return $this->db->get('apresentacao');
	}

	function getApresentacao($id)
	{
		return $this->db->get_where('apresentacao', array('id'=> $id));
	}

	function updateApresentacao($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('apresentacao', $data); 
	}

	function deleteApresentacao($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('apresentacao'); 
	}

}

/* End of file mapresentacao.php */
/* Location: ./system/application/models/mapresentacao.php */