<?php 

	class MItemNota extends CI_Model{

		function addItem($data)
		{
			$this->db->set('cod_nota', $data['cod_nota']);
			$this->db->set('cod_produto', $data['cod_produto']);
			$this->db->set('quantidade', $data['quantidade']);
			$this->db->set('valor_item', str_replace(',', '.', $data['valor_item']));
			$this->db->insert('item');
		}

		function getItens($id)
		{
			return $this->db->get_where('item', array('cod_nota'=>$id));
		}
		
		function getItem($id)
		{
			return $this->db->get_where('item', array('id_item'=>$id));
		}

		function updateItem($id, $data)
		{
			$insert = array('cod_nota'=>$data['cod_nota'], 'cod_produto'=>$data['cod_produto'], 'quantidade'=>$data['quantidade'], 'valor_item'=>str_replace(',', '.', $data['valor_item']));
			$this->db->where('id_item', $id);
			$this->db->update('item', $insert); 
		}

		function deleteItem($id)
		{
			$this->db->where('id_item', $id);
			$this->db->delete('item'); 
		}

	}

/* End of file mitemnota.php */
/* Location: ./system/application/models/mitemnota.php */