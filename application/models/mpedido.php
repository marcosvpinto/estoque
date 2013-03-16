<?php 

	class MPedido extends CI_Model{

		function addPedido($data)
		{
			$this->db->insert('pedido', $data);
			return $this->db->insert_id();
		}

		function listPedido()
		{
			$this->db->join('usuario', 'usuario.id_usuario = pedido.id_usuario');
			$this->db->limit(1000);
			$this->db->order_by('data_pedido', 'desc');
			return $this->db->get('pedido');
		}

		function getPedido($id)
		{
			return $this->db->get_where('pedido', array('cod_pedido'=> $id));
		}

		function updatePedido($id, $data)
		{
			$this->db->where('cod_pedido', $id);
			$this->db->update('pedido', $data); 
		}
		
		function deletePedido($id)
		{
			$this->db->where('cod_pedido', $id);
			$this->db->delete('pedido'); 
		}
		
		function fecharPedido($id)
		{
			$update = array('flag_baixa'=>'S');
			$this->db->where('cod_pedido', $id);
			$this->db->update('pedido', $update);
		}

	}

/* End of file mpedido.php */
/* Location: ./system/application/models/mpedido.php */