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
        $id = $this->MNotaFiscal->addNota($_POST);
        redirect('ItemNota/addItens/'.$id, 'refresh');
    }
	
	function edit()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MNotaFiscal', '', TRUE);
		$data['nota_fiscal'] = $this->MNotaFiscal->getNota($id)->result();
		$this->load->model('MFornecedor', '', TRUE);
		$data['fornecedores'] = $this->MFornecedor->listFornecedor();
		$data['title'] = "Modificar Nota Fiscal - Controle de Estoque";
		$data['headline'] = "Edição de Notas Fiscais"; 
		$data['include'] = "nota_fiscal_edit";
		$this->load->view('template', $data);
	}
	
	function update()
	{
		$this->load->model('MNotaFiscal','',TRUE);
		$_POST['data_nota'] = pt_to_mysql($this->input->post('data_nota'));
		$this->MNotaFiscal->updateNota($_POST['cod_nota'], $_POST);
		redirect('NotaFiscal/listing', 'refresh');
	}
	
	function fechar()
	{
		$id = $this->uri->segment(3);
		$this->load->model('MNotaFiscal','',TRUE);
		$this->MNotaFiscal->fecharNota($id);
		redirect('NotaFiscal/listing', 'refresh');
	}
	
	function verNota()
	{
		$id = $this->uri->segment(3);
		
		$this->load->model('MNotaFiscal','',TRUE);
		$notas = $this->MNotaFiscal->getNota($id);
		
		$nt = $notas->result();
		$cod_nota = $nt[0]->cod_nota;
		
		$this->load->model('MItemNota', '', TRUE);
		$itens = $this->MItemNota->getItens($cod_nota);
		
		$table1 = $this->table->generate($notas);
		$tmpl = array ( 'table_open'  => '<table id="tabela1">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Número', 'Fornecedor', 'Data da Nota');
		$table_row = array();
		foreach ($notas->result() as $nota)
		{
			$table_row = NULL;
			$table_row[] = $nota->numero_nota;
			$this->load->model('MFornecedor', '', TRUE);
			$fornecedor = $this->MFornecedor->getFornecedor($nota->id_fornecedor)->result();
			$table_row[] = $fornecedor[0]->razao_social;
			$table_row[] = mysql_to_pt($nota->data_nota);
			$this->table->add_row($table_row);
		}    
		$table1 = $this->table->generate();
		$data['data_table1'] = $table1;
		
		$table2 = $this->table->generate($itens);
		$tmpl = array ( 'table_open'  => '<table id="tabela2">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Produto', 'Quantidade', 'Valor Item', 'Subtotal');
		$table_row = array();
		foreach ($itens->result() as $item)
		{
			$table_row = NULL;
			$this->load->model('MProduto', '', TRUE);
			$produto = $this->MProduto->getProduto($item->cod_produto)->result();
			$table_row[] = $produto[0]->nome_produto;
			$table_row[] = $item->quantidade;
			$table_row[] = 'R$ ' . number_format($item->valor_item, 2, ',', '.');
			$table_row[] = 'R$ ' . number_format(($item->quantidade)*($item->valor_item), 2, ',', '.');
			$this->table->add_row($table_row);
		}    
		$table2 = $this->table->generate();
		$data['data_table2'] = $table2;
		
		$data['title'] = "Listagem de Notas Fiscais - Controle de Estoque";
		$data['headline'] = "Listagem de Nota Fiscal";
		$data['include'] = 'notafiscal_view';
		$this->load->view('template', $data);
	}

	function listing()
	{
		$this->load->model('MNotaFiscal','',TRUE);
		$qry = $this->MNotaFiscal->listNota();
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Editar', 'Itens', 'Número', 'Fornecedor', 'Data da Nota', 'Visualizar');
		$table_row = array();
		foreach ($qry->result() as $nota)
		{
			$table_row = NULL;
			if($nota->fechado == '1'){
				$table_row[] = '';
				$table_row[] = '';
			}
			else {
				$table_row[] = anchor('NotaFiscal/edit/' . $nota->cod_nota, '<span class="ui-icon ui-icon-pencil"></span>');
				$table_row[] = anchor('ItemNota/addItens/' . $nota->cod_nota, '<span class="ui-icon ui-icon-plus"></span>');
			}
			$table_row[] = $nota->numero_nota;
			$table_row[] = $nota->razao_social;
			$table_row[] = mysql_to_pt($nota->data_nota);
			$table_row[] = anchor('NotaFiscal/verNota/' . $nota->cod_nota, '<span class="ui-icon ui-icon-circle-zoomin"></span>');
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