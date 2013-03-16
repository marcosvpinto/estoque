<?php 

	class MUsuario extends CI_Model{

		function addUsuario($data)
		{
			$this->db->insert('usuario', $data);
		}

		function listUsuario()
		{
			$this->db->join('setor', 'setor.id_setor = usuario.setor');
			$this->db->join('perfil', 'perfil.nivel = usuario.perfil');
			$this->db->where('ativo = "S"');
			$this->db->order_by('login', 'asc');
			return $this->db->get('usuario');
		}

		function getUsuario($id)
		{
			return $this->db->get_where('usuario', array('id_usuario'=> $id));
		}

		function updateUsuario($id, $data)
		{
			$this->db->where('id_usuario', $id);
			$this->db->update('usuario', $data); 
		}

		function deleteUsuario($id)
		{
			$this->db->where('id_usuario', $id);
			$this->db->delete('usuario'); 
		}
		
		function inativarUsuario($id)
		{
			$data = array('ativo'=>'N');
			$this->db->where('id_usuario', $id);
			$this->db->update('usuario', $data); 
		}

	}

/* End of file musuario.php */
/* Location: ./system/application/models/musuario.php */