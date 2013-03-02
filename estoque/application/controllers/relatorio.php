<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function Relatorio() 
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
        $data['title'] = "Cadastro de Produto - Controle de Estoque";
        $data['headline'] = "Cadastro de Produtos";
        $data['include'] = "produto_add";
		$this->load->model('MApresentacao', '', TRUE);
		$data['unidades'] = $this->MApresentacao->listApresentacao();
		$this->load->model('MCategoria', '', TRUE);
		$data['categorias'] = $this->MCategoria->listCategoria();
        $this->load->view('template', $data);
    }
	
	function create()
    {
        $this->load->model('MProduto','',TRUE);
        $this->MProduto->addProduto($_POST);
        redirect('Produto/listing', 'refresh');
    }
	
	function edit()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MProduto', '', TRUE);
		$data['produto'] = $this->MProduto->getProduto($id)->result();
		$data['title'] = "Modificar Produto - Controle de Estoque";
		$data['headline'] = "Edição de Produtos";
		$data['include'] = "produto_edit";
		$this->load->model('MApresentacao', '', TRUE);
		$data['unidades'] = $this->MApresentacao->listApresentacao();
		$this->load->model('MCategoria', '', TRUE);
		$data['categorias'] = $this->MCategoria->listCategoria();
		$this->load->view('template', $data);
	}
	
	function update()
	{
		$this->load->model('MProduto','',TRUE);
		$this->MProduto->updateProduto($_POST['id_produto'], $_POST);
		redirect('Produto/listing', 'refresh');
	}
	
	function delete()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MProduto','',TRUE);
		$this->MProduto->deleteProduto($id);
		redirect('Produto/listing', 'refresh');
	}

	function listing()
	{
		$data['title'] = "Listagem de Relatórios - Controle de Estoque";
		$data['headline'] = "Listagem de Relatórios";
		$data['include'] = 'Relatorio_listing';
		$this->load->view('template', $data);
	}
}

/* End of file Relatorio.php */
/* Location: ./application/controllers/Relatorio.php */