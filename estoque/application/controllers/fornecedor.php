<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

	public function Fornecedor() 
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
        $data['title'] = "Cadastro de Fornecedor - Controle de Estoque";
        $data['headline'] = "Cadastro de Fornecedores";
        $data['include'] = "fornecedor_add";
		$this->load->model('MFornecedor', '', TRUE);
		$data['fornecedores'] = $this->MFornecedor->listFornecedor();
        $this->load->view('template', $data);
    }
	
	function create()
    {
        $this->load->model('MFornecedor','',TRUE);
        $this->MFornecedor->addFornecedor($_POST);
        redirect('Fornecedor/listing', 'refresh');
    }
	
	function edit()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MFornecedor', '', TRUE);
		$data['fornecedor'] = $this->MFornecedor->getFornecedor($id)->result();
		$data['title'] = "Modificar Fornecedores - Controle de Estoque";
		$data['headline'] = "Edição de Fornecedores";
		$data['include'] = "fornecedor_edit";
		$this->load->view('template', $data);
	}
	
	function update()
	{
		$this->load->model('MFornecedor','',TRUE);
		$this->MFornecedor->updateFornecedor($_POST['id_fornecedor'], $_POST);
		redirect('Fornecedor/listing', 'refresh');
	}
	
	function delete()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MFornecedor','',TRUE);
		$this->MFornecedor->deleteFornecedor($id);
		redirect('Fornecedor/listing', 'refresh');
	}

	function listing()
	{
		$this->load->model('MFornecedor','',TRUE);
		$qry = $this->MFornecedor->listFornecedor();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Editar', 'CNPJ', 'Razão Social', 'Telefone', 'Excluir');
		$table_row = array();
		foreach ($qry->result() as $fornecedor)
		{
			$table_row = NULL;
			$table_row[] = anchor('Fornecedor/edit/' . $fornecedor->id_fornecedor, '<span class="ui-icon ui-icon-pencil"></span>');
			$table_row[] = $fornecedor->cnpj;
			$table_row[] = $fornecedor->razao_social;
			$table_row[] = $fornecedor->telefone;
			$table_row[] = anchor('Fornecedor/delete/' . $fornecedor->id_fornecedor, '<span class="ui-icon ui-icon-trash"></span>', 
							"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
			$this->table->add_row($table_row);
		}    
		$table = $this->table->generate();
		$data['title'] = "Listagem de Fornecedores - Controle de Estoque";
		$data['headline'] = "Listagem de Fornecedores";
		$data['include'] = 'fornecedor_listing';
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file fornecedor.php */
/* Location: ./application/controllers/fornecedor.php */