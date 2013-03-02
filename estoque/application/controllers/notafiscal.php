<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NotaFiscal extends CI_Controller {

	public function NotaFiscal() 
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
        $data['title'] = "Cadastro de Nota Fiscal - Controle de Estoque";
        $data['headline'] = "Cadastro de Nota Fiscal";
        $data['include'] = "nota_fiscal_add";
		$this->load->model('MFornecedor', '', TRUE);
		$data['fornecedores'] = $this->MFornecedor->listFornecedor();
        $this->load->view('template', $data);
    }
	
	function create()
    {
        $this->load->model('MNotaFiscal', '', TRUE);
		$_POST['data_nota'] = pt_to_mysql($this->input->post('data_nota'));
        $this->MNotaFiscal->addNota($_POST);
        redirect('NotaFiscal/listing', 'refresh');
    }
	
	function edit()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MNotaFiscal', '', TRUE);
		$data['nota_fiscal'] = $this->MNotaFiscal->getNota($id)->result();
		$data['title'] = "Modificar Produto - Controle de Estoque";
		$data['headline'] = "Edição de Notas Fiscais";
		$data['include'] = "nota_fiscal_edit";
		$this->load->model('MFornecedor', '', TRUE);
		$data['fornecedores'] = $this->MFornecedor->listFornecedor();
		$this->load->view('template', $data);
	}
	
	function update()
	{
		$this->load->model('MNotaFiscal','',TRUE);
		$this->MNotaFiscal->updateNota($_POST['cod_nota'], $_POST);
		redirect('NotaFiscal/listing', 'refresh');
	}
	
	function delete()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MNotaFiscal','',TRUE);
		$this->MNotaFiscal->deleteNota($id);
		redirect('NotaFiscal/listing', 'refresh');
	}

	function listing()
	{
		$this->load->model('MNotaFiscal','',TRUE);
		$qry = $this->MNotaFiscal->listNota();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Editar', 'Número', 'Fornecedor', 'Data da Nota', 'Excluir');
		$table_row = array();
		foreach ($qry->result() as $nota)
		{
			$table_row = NULL;
			$table_row[] = anchor('NotaFiscal/edit/' . $nota->cod_nota, '<span class="ui-icon ui-icon-pencil"></span>');
			$table_row[] = $nota->numero_nota;
			$table_row[] = $nota->razao_social;
			$data_human = mysql_to_pt($nota->data_nota);
			$table_row[] = $data_human;
			$table_row[] = anchor('NotaFiscal/delete/' . $nota->cod_nota, '<span class="ui-icon ui-icon-trash"></span>', 
							"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
			$this->table->add_row($table_row);
		}    
		$table = $this->table->generate();
		$data['title'] = "Listagem de Notas Fiscais - Controle de Estoque";
		$data['headline'] = "Listagem de Notas Fiscais";
		$data['include'] = 'NotaFiscal_listing';
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file NotaFiscal.php */
/* Location: ./application/controllers/NotaFiscal.php */