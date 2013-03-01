<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto extends CI_Controller {

	public function Produto() 
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
		$this->load->model('MProduto','',TRUE);
		$qry = $this->MProduto->listProduto();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="tablesorter">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('', 'Codigo', 'Nome', 'Categoria', 'Unidade', 'Minimo', '');
		$table_row = array();
		foreach ($qry->result() as $produto)
		{
			$table_row = NULL;
			$table_row[] = anchor('Produto/edit/' . $produto->id_produto, img(base_url().'assets/img/atualizar.jpg'));
			$table_row[] = $produto->codigo;
			$table_row[] = $produto->nome_produto;
			$table_row[] = $produto->nome_categoria;
			$table_row[] = $produto->nome_apresentacao;
			$table_row[] = $produto->qtd_minima;
			$table_row[] = anchor('Produto/delete/' . $produto->id_produto, img(base_url().'assets/img/delete.jpg'), 
							"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
			$this->table->add_row($table_row);
		}    
		$table = $this->table->generate();
		$data['title'] = "Listagem de Produtos - Controle de Estoque";
		$data['headline'] = "Listagem de Produtos";
		$data['include'] = 'Produto_listing';
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file Produto.php */
/* Location: ./application/controllers/Produto.php */