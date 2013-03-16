<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends CI_Controller {

	public function Pedido() 
	{
		parent::__construct();
		$this->check_isvalidated();
	}
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
	
	function add()
    {
        $data['title'] = "Cadastro de Pedidos - Controle de Estoque";
        $data['headline'] = "Cadastro de Pedidos";
        $data['include'] = "pedido_add";
		$this->load->model('MUsuario', '', TRUE);
		$data['usuarios'] = $this->MUsuario->listUsuario();
		$this->load->model('MProduto', '', TRUE);
		$data['produtos'] = $this->MProduto->listProduto();
        $this->load->view('template', $data);
    }
	
	function create()
    {
        $this->load->model('MPedido', '', TRUE);
		$_POST['data_pedido'] = pt_to_mysql($this->input->post('data_pedido'));
        $id = $this->MPedido->addPedido($_POST);
        redirect('ItemPedido/addItens/'.$id, 'refresh');
    }
	
	function edit()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MPedido', '', TRUE);
		$data['pedido'] = $this->MPedido->getPedido($id)->result();
		$this->load->model('MUsuario', '', TRUE);
		$data['usuarios'] = $this->MUsuario->listUsuario();
		$this->load->model('MProduto', '', TRUE);
		$data['produtos'] = $this->MProduto->listProduto();
		$data['title'] = "Modificar Pedido - Controle de Estoque";
		$data['headline'] = "Edição de Pedidos"; 
		$data['include'] = "pedido_edit";
		$this->load->view('template', $data);
	}
	
	function update()
	{
		$this->load->model('MPedido','',TRUE);
		$_POST['data_pedido'] = pt_to_mysql($this->input->post('data_pedido'));
		$this->MPedido->updatePedido($_POST['cod_pedido'], $_POST);
		redirect('Pedido/listing', 'refresh');
	}
	
	function fechar()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MItemPedido', '', TRUE);
		$itens = $this->MItemPedido->getItens($id);
		$ok = false;
		foreach($itens->result() as $item){
			if($item->flag_baixa == 'S'){
				$ok = true;
			}
			else {
				$ok = false;
			}
		}
		if($ok == true){
			$this->load->model('MPedido','',TRUE);
			$this->MPedido->fecharPedido($id);
			redirect('Pedido/listing', 'refresh');
		}
		else {
			redirect('ItemPedido/addItens/'.$id.'/2', 'refresh');
		}
	}
		
	function delete()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MPedido','',TRUE);
		$this->MPedido->deletePedido($id);
		redirect('Pedido/listing', 'refresh');
	}

	function verPedido()
	{
		$id = $this->uri->segment(3);
		
		$this->load->model('MPedido','',TRUE);
		$pedidos = $this->MPedido->getPedido($id);
		
		$pedido = $pedidos->result();
		$cod_pedido = $pedido[0]->cod_pedido; 
		
		$this->load->model('MItemPedido', '', TRUE);
		$itens = $this->MItemPedido->getItens($cod_pedido);
		
		$table1 = $this->table->generate($pedidos);
		$tmpl = array ( 'table_open'  => '<table id="tabela1" class="table table-striped table-bordered table-hover">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Número', 'Usuario', 'Data do Pedido');
		$table_row = array();
		foreach ($pedidos->result() as $pedido)
		{
			$table_row = NULL;
			$table_row[] = $pedido->cod_pedido; 
			$this->load->model('MUsuario', '', TRUE);
			$usuario = $this->MUsuario->getUsuario($pedido->id_usuario)->result();
			$table_row[] = $usuario[0]->login;
			$table_row[] = mysql_to_pt($pedido->data_pedido);
			$this->table->add_row($table_row);
		}    
		$table1 = $this->table->generate();
		$data['data_table1'] = $table1;
		
		$table2 = $this->table->generate($itens);
		$tmpl = array ( 'table_open'  => '<table id="tabela2" class="table table-striped table-bordered table-hover">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Produto', 'Quantidade');
		$table_row = array();
		foreach ($itens->result() as $item)
		{
			$table_row = NULL;
			$this->load->model('MProduto', '', TRUE);
			$produto = $this->MProduto->getProduto($item->cod_produto)->result();
			$table_row[] = $produto[0]->nome_produto;
			$table_row[] = $item->quantidade;
			$this->table->add_row($table_row);
		}    
		$table2 = $this->table->generate();
		$data['data_table2'] = $table2;
		
		$data['title'] = "Listagem de Pedidos - Controle de Estoque";
		$data['headline'] = "Listagem de Pedidos";
		$data['include'] = 'pedido_view';
		$this->load->view('template', $data);
	}
	
	function listing()
	{
		$this->load->model('MPedido','',TRUE);
		$qry = $this->MPedido->listPedido();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="table table-striped table-bordered table-hover">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Editar', 'Itens', 'Usuário', 'Data Pedido', 'Visualizar', 'Excluir');
		$table_row = array();
		foreach ($qry->result() as $pedido)
		{
			$table_row = NULL;
			if($pedido->flag_baixa == 'A')
			{
				$table_row[] = anchor('Pedido/edit/' . $pedido->cod_pedido, '<span class="ui-icon ui-icon-pencil"></span>');
				$table_row[] = anchor('ItemPedido/addItens/' . $pedido->cod_pedido, '<span class="ui-icon ui-icon-plus"></span>');
			} else 
			{
				$table_row[] = NULL;
				$table_row[] = NULL;
			}
			$table_row[] = $pedido->login;
			$table_row[] = mysql_to_pt($pedido->data_pedido);
			$table_row[] = anchor('Pedido/verPedido/' . $pedido->cod_pedido, '<span class="ui-icon ui-icon-circle-zoomin"></span>');
			if($pedido->flag_baixa == 'A')
			{
				$table_row[] = anchor('Pedido/delete/' . $pedido->cod_pedido, '<span class="ui-icon ui-icon-trash"></span>');
			} else 
			{
				$table_row[] = NULL;
			}
			$this->table->add_row($table_row);
		}    
		$table = $this->table->generate();
		$data['title'] = "Listagem de Pedidos - Controle de Estoque";
		$data['headline'] = "Listagem de Pedidos";
		$data['include'] = 'pedido_listing';
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file Pedido.php */
/* Location: ./application/controllers/Pedido.php */