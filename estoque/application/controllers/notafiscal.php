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
        $this->load->model('MNotaFiscal','',TRUE);
        $this->MNotaFiscal->addNota($_POST);
        redirect('NotaFiscal/listing', 'refresh');
    }
	
	function edit()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MProduto', '', TRUE);
		$data['nota_fiscal'] = $this->MNotaFiscal->getNota($id)->result();
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
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="tablesorter">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Número', 'Fornecedor', 'Data da Nota');
		$table_row = array();
		foreach ($qry->result() as $nota)
		{
			$table_row = NULL;
			//$table_row[] = anchor('NotaFiscal/edit/' . $nota->cod_nota, img(base_url().'assets/img/atualizar.jpg'));
			$table_row[] = $nota->numero_nota;
			$table_row[] = $nota->razao_social;
			$table_row[] = $nota->data_nota;
			//$table_row[] = anchor('NotaFiscal/delete/' . $nota->cod_nota, img(base_url().'assets/img/delete.jpg'), 
			//				"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
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