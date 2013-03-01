<?php 

class MCategoria extends CI_Model{

	function addCategoria($data)
	{
		$this->db->insert('categoria', $data);
	}

	function listCategoria()
	{
		return $this->db->get('categoria');
	}

	function getCategoria($id)
	{
		return $this->db->get_where('categoria', array('id'=> $id));
	}

	function updateCategoria($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('categoria', $data); 
	}

	function deleteCategoria($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('categoria'); 
	}

}

/* End of file mcategoria.php */
/* Location: ./system/application/models/mcategoria.php */