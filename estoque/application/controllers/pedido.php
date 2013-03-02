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
        $this->MPedido->addPedido($_POST);
        redirect('Pedido/listing', 'refresh');
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
		
	function delete()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MPedido','',TRUE);
		$this->MPedido->deletePedido($id);
		redirect('Pedido/listing', 'refresh');
	}
	
	function baixa()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MPedido','',TRUE);
		$this->MPedido->baixaPedido($id);
		redirect('Pedido/listing', 'refresh');
	}

	function listing()
	{
		$this->load->model('MPedido','',TRUE);
		$qry = $this->MPedido->listPedido();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Editar', 'Baixa', 'Usuário', 'Produto', 'Quantidade', 'Data Pedido', 'Status', 'Excluir');
		$table_row = array();
		foreach ($qry->result() as $pedido)
		{
			$table_row = NULL;
			if($pedido->flag_baixa == 'A')
			{
				$table_row[] = anchor('Pedido/edit/' . $pedido->cod_pedido, '<span class="ui-icon ui-icon-pencil"></span>');
				$table_row[] = anchor('Pedido/baixa/' . $pedido->cod_pedido, '<span class="ui-icon ui-icon-check"></span>');
			} else 
			{
				$table_row[] = NULL;
				$table_row[] = NULL;
			}
			$table_row[] = $pedido->login;
			$table_row[] = $pedido->nome_produto;
			$table_row[] = $pedido->quantidade_pedida;
			$table_row[] = mysql_to_pt($pedido->data_pedido);
			if($pedido->flag_baixa == 'A')
			{
				$table_row[] = ('<span id="pedido_aberto">Aberta</span>');
			} elseif($pedido->flag_baixa == 'S')
			{
				$table_row[] = ('<span id="pedido_atendido">Atendida</span>');
			}
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