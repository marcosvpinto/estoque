<?php 

	class MItemPedido extends CI_Model{

		function addItem($data)
		{
			$this->db->set('cod_pedido', $data['cod_pedido']);
			$this->db->set('cod_produto', $data['cod_produto']);
			$this->db->set('quantidade', $data['quantidade']);
			$this->db->insert('item_pedido');
		}

		function getItens($id)
		{
			return $this->db->get_where('item_pedido', array('cod_pedido'=>$id));
		}
		
		function getItem($id)
		{
			return $this->db->get_where('item_pedido', array('id_item_pedido'=>$id));
		}
		
		function listItens()
		{
			$this->db->join('produto', 'produto.id_produto = item_pedido.cod_produto');
			$this->db->join('pedido', 'pedido.cod_pedido = item_pedido.cod_pedido');
			$this->db->join('usuario', 'usuario.id_usuario = pedido.id_usuario');
			$this->db->order_by('pedido.data_pedido', 'desc');
			return $this->db->get('item_pedido');
		}

		function updateItem($id, $data)
		{
			$insert = array('cod_pedido'=>$data['cod_pedido'], 'cod_produto'=>$data['cod_produto'], 'quantidade'=>$data['quantidade']);
			$this->db->where('id_item_pedido', $id);
			$this->db->update('item_pedido', $insert); 
		}
		
		function baixaItem($id)
		{
			$update = array('flag_baixa'=>'S');
			$this->db->where('id_item_pedido', $id);
			$this->db->update('item_pedido', $update);
		}

		function deleteItem($id)
		{
			$this->db->where('id_item_pedido', $id);
			$this->db->delete('item_pedido'); 
		}

	}

/* End of file mitempedido.php */
/* Location: ./system/application/models/mitempedido.php */