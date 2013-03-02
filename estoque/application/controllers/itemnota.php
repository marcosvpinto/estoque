<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemNota extends CI_Controller {

	public function ItemNota() 
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
		$this->load->model('MNotaFiscal', '', TRUE);
		$nota = $this->MNotaFiscal->getNota($id)->result();
		if($nota[0]->fechado == '1'){
			redirect('NotaFiscal/listing', 'refresh');
		}
		else {
			$data['include'] = "item_nota_add";
			$this->load->model('MNotaFiscal', '', TRUE);
			$data['nota_fiscal'] = $this->MNotaFiscal->getNota($id)->result();
			$this->load->model('MFornecedor', '', TRUE);
			$data['fornecedores'] = $this->MFornecedor->listFornecedor();
			$this->load->model('MProduto', '', TRUE);
			$data['produtos'] = $this->MProduto->listProduto();
			$data['data_table'] = $this->listing($id);
			$data['title'] = "Cadastro de Nota Fiscal - Controle de Estoque";
			$data['headline'] = "Adicionar Itens à Nota";
			$this->load->view('template', $data);
		}
		
	}
	
	function createItens()
	{
		$this->load->model('MItemNota', '', TRUE);
		$this->MItemNota->addItem($_POST);
		redirect('ItemNota/addItens/'.$_POST['cod_nota'], 'refresh');
	}
	
	function editItem()
	{
		$id = $this->uri->segment(3);
		$cod_nota = $this->uri->segment(4);
		$this->load->model('MNotaFiscal', '', TRUE);
		$data['nota_fiscal'] = $this->MNotaFiscal->getNota($cod_nota)->result();
		$this->load->model('MFornecedor', '', TRUE);
		$data['fornecedores'] = $this->MFornecedor->listFornecedor();
		$this->load->model('MProduto', '', TRUE);
		$data['produtos'] = $this->MProduto->listProduto();
		$this->load->model('MItemNota', '', TRUE);
		$data['item'] = $this->MItemNota->getItem($id)->result();
		$data['title'] = "Modificar Notas Fiscais - Controle de Estoque";
		$data['headline'] = "Edição de Item da Nota Fiscal";
		$data['include'] = "item_nota_edit";
		$this->load->view('template', $data);
	}
	
	function updateItem()
	{
		$this->load->model('MItemNota','',TRUE);
		$this->MItemNota->updateItem($_POST['id_item'], $_POST);
		redirect('ItemNota/addItens/' . $_POST['cod_nota'], 'refresh');
	}
	
	function deleteItem()
	{
		$id = $this->uri->segment(3);
		$cod_nota = $this->uri->segment(4);
		$this->load->model('MItemNota','',TRUE);
		$this->MItemNota->deleteItem($id);
		redirect('ItemNota/addItens/'.$cod_nota, 'refresh');
	}

	function listing($id)
	{
		$this->load->model('MItemNota','',TRUE);
		$qry = $this->MItemNota->getItens($id);
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Editar', 'Produto', 'Quantidade', 'Valor Item', 'Subtotal', 'Excluir');
		$table_row = array();
		foreach ($qry->result() as $item)
		{
			$table_row = NULL;
			$table_row[] = anchor('ItemNota/editItem/' . $item->id_item . '/' . $item->cod_nota, '<span class="ui-icon ui-icon-pencil"></span>');
			$this->load->model('MProduto', '', TRUE);
			$produto = $this->MProduto->getProduto($item->cod_produto)->result();
			//var_dump($produto);
			$table_row[] = $produto[0]->nome_produto;
			$table_row[] = $item->quantidade;
			$table_row[] = 'R$ ' . number_format($item->valor_item, 2, ',', '.');
			$table_row[] = 'R$ ' . number_format(($item->quantidade)*($item->valor_item), 2, ',', '.');
			$table_row[] = anchor('ItemNota/deleteItem/' . $item->id_item . '/'.$item->cod_nota, '<span class="ui-icon ui-icon-trash"></span>', 
							"onClick=\" return confirm('Tem certeza que deseja remover o registro?')\"");
			$this->table->add_row($table_row);
		}    
		return $table = $this->table->generate();
	}
}

/* End of file NotaFiscal.php */
/* Location: ./application/controllers/NotaFiscal.php */