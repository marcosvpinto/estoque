<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemPedido extends CI_Controller {

	public function ItemPedido()
	{
		parent::__construct();
		$this->check_isvalidated();
	}

	private function check_isvalidated(){
		if(! $this->session->userdata('validated')){
			redirect('login');
		}
	}

	function addItens()
	{
		$id = $this->uri->segment(3);
		$msg = $this->uri->segment(4);
		$this->load->model('MPedido', '', TRUE);
		$pedido = $this->MPedido->getPedido($id)->result();
		if($pedido[0]->flag_baixa == 'S'){
			redirect('Pedido/listing', 'refresh');
		}
		else {
			$data['include'] = "item_pedido_add";
			$this->load->model('MPedido', '', TRUE);
			$data['pedido'] = $this->MPedido->getPedido($id)->result();
			$this->load->model('MUsuario', '', TRUE);
			$data['usuarios'] = $this->MUsuario->listUsuario();
			$this->load->model('MProduto', '', TRUE);
			$data['produtos'] = $this->MProduto->listProduto();
			$data['data_table'] = $this->listing($id);
			$data['title'] = "Cadastro de Pedidos - Controle de Estoque";
			$data['headline'] = "Adicionar Itens ao Pedido";
			$data['msg'] = $msg;
			$this->load->view('template', $data);
		}

	}

	function createItens()
	{
		$this->load->model('MItemPedido', '', TRUE);
		$this->MItemPedido->addItem($_POST);
		redirect('ItemPedido/addItens/'.$_POST['cod_pedido'], 'refresh');
	}

	function editItem()
	{
		$id = $this->uri->segment(3);
		$cod_pedido = $this->uri->segment(4);
		$this->load->model('MPedido', '', TRUE);
		$data['pedido'] = $this->MPedido->getPedido($cod_pedido)->result();
		$this->load->model('MUsuario', '', TRUE);
		$data['usuarios'] = $this->MUsuario->listUsuario();
		$this->load->model('MProduto', '', TRUE);
		$data['produtos'] = $this->MProduto->listProduto();
		$this->load->model('MItemPedido', '', TRUE);
		$data['item'] = $this->MItemPedido->getItem($id)->result();
		$data['title'] = "Modificar Pedidos - Controle de Estoque";
		$data['headline'] = "Edição de Item do Pedido";
		$data['include'] = "item_pedido_edit";
		$this->load->view('template', $data);
	}

	function updateItem()
	{
		$this->load->model('MItemPedido','',TRUE);
		$this->MItemPedido->updateItem($_POST['id_item_pedido'], $_POST);
		redirect('ItemPedido/addItens/' . $_POST['cod_pedido'], 'refresh');
	}

	function deleteItem()
	{
		$id = $this->uri->segment(3);
		$cod_pedido = $this->uri->segment(4);
		$this->load->model('MItemPedido','',TRUE);
		$this->MItemPedido->deleteItem($id);
		redirect('ItemPedido/addItens/'.$cod_pedido, 'refresh');
	}

	function baixaItem()
	{
		$id_item = $this->uri->segment(3);
		$cod_pedido = $this->uri->segment(4);

		$this->load->model('MItemPedido','',TRUE);
		$pedido = $this->MItemPedido->getItem($id_item)->result();
		$cod_produto = $pedido[0]->cod_produto;

		$this->load->model('MEstoque', '', TRUE);
		$estoque = $this->MEstoque->getEstoqueByProduto($cod_produto)->result();
		
		if($estoque[0]->quantidade >= $pedido[0]->quantidade){
			$this->MItemPedido->baixaItem($id_item);
			redirect('ItemPedido/addItens/'.$cod_pedido.'/0', 'refresh');
		} else {
			redirect('ItemPedido/addItens/'.$cod_pedido.'/1', 'refresh');
		}
	}

	function listing($id)
	{
		$this->load->model('MItemPedido','',TRUE);
		$qry = $this->MItemPedido->getItens($id);
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="table table-striped table-bordered table-hover">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Editar', 'Baixa', 'Produto', 'Quantidade', 'Excluir');
		$table_row = array();
		foreach ($qry->result() as $item)
		{
			$table_row = NULL;
			if ($item->flag_baixa == 'S') {
				$table_row[] = NULL;
				$table_row[] = NULL;
			} else {
				$table_row[] = anchor('ItemPedido/editItem/' . $item->id_item_pedido . '/' . $item->cod_pedido, '<span class="ui-icon ui-icon-pencil"></span>');
				$table_row[] = anchor('ItemPedido/baixaItem/' . $item->id_item_pedido . '/' . $item->cod_pedido, '<span class="ui-icon ui-icon-check"></span>');
			}
			$this->load->model('MProduto', '', TRUE);
			$produto = $this->MProduto->getProduto($item->cod_produto)->result();
			$table_row[] = $produto[0]->nome_produto;
			$table_row[] = $item->quantidade;
			if ($item->flag_baixa == 'S') {
				$table_row[] = NULL;
			} else {
				$table_row[] = anchor('ItemPedido/deleteItem/' . $item->id_item_pedido . '/'.$item->cod_pedido, '<span class="ui-icon ui-icon-trash"></span>',
						"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
			}
			$this->table->add_row($table_row);
		}
		return $table = $this->table->generate();
	}
	
	function listing_itens()
	{
		$this->load->model('MPedido','',TRUE);
		$qry = $this->MPedido->listPedido();
		$this->load->model('MItemPedido','',TRUE);
		$qry2 = $this->MItemPedido->listItens();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="table table-striped table-bordered table-hover">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Solicitante', 'Produto', 'Quantidade', 'Data do Pedido');
		$table_row = array();
		foreach ($qry2->result() as $item)
		{
			$table_row = NULL;
			$table_row[] = $item->login;
			$table_row[] = $item->nome_produto;
			$table_row[] = $item->quantidade;
			$table_row[] =  mysql_to_pt($item->data_pedido);
			$this->table->add_row($table_row);
		}
		foreach ($qry->result() as $pedido)
		{
			$table_row = NULL;
			$table_row[] = $pedido->login;
			$table_row[] = $pedido->nome_produto;
			$table_row[] = $pedido->quantidade_pedida;
			$table_row[] = mysql_to_pt($pedido->data_pedido);
			$this->table->add_row($table_row);
		} 
		$table = $this->table->generate();
		$data['title'] = "Listagem de Itens de Pedidos - Controle de Estoque";
		$data['headline'] = "Listagem de Itens de Pedidos";
		$data['include'] = 'item_pedido_listing';
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file ItemPedido.php */
/* Location: ./application/controllers/ItemPedido.php */