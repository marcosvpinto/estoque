<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estoque extends CI_Controller {

	public function Estoque() 
	{
		parent::__construct();
		$this->check_isvalidated();
	}
	
	private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
	
	public function sair(){
        $this->session->sess_destroy();
        redirect('login');
    }

	public function index()
	{
        $data['title'] = "Página Inicial - Controle de Estoque";
        $data['headline'] = "Controle de Estoque";
        $data['include'] = "estoque_index";
	    $this->load->view('template', $data);
	}
	
	function listing()
	{
		$this->load->model('MEstoque','',TRUE);
		$qry = $this->MEstoque->listEstoque();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="tablesorter">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Produto', 'Quantidade');
		$table_row = array();
		foreach ($qry->result() as $estoque)
		{
			$table_row = NULL;
			//$table_row[] = anchor('Estoque/edit/' . $estoque->id_estoque, img(base_url().'imagens/atualizar.jpg'));
			$table_row[] = $estoque->nome_produto;
			$table_row[] = $estoque->quantidade;
			//$table_row[] = anchor('Estoque/delete/' . $estoque->id_estoque, img(base_url().'imagens/delete.jpg'), 
			//				"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
			$this->table->add_row($table_row);
		}    
		$table = $this->table->generate();
		$data['title'] = "Listagem do Estoque - Controle de Estoque";
		$data['headline'] = "Listagem do Estoque";
		$data['include'] = 'estoque_listing';
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file estoque.php */
/* Location: ./application/controllers/estoque.php */