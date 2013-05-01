<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio extends CI_Controller {

	public function Relatorio() 
	{
		parent::__construct();
		$this->check_isvalidated();
	}
	
	private function check_isvalidated()
	{
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }

	function listing()
	{
		$data['title'] = "Listagem de Relatórios - Controle de Estoque";
		$data['headline'] = "Listagem de Relatórios";
		$data['include'] = 'relatorio_listing';
		$this->load->model('MProduto', '', TRUE);
		$data['produtos'] = $this->MProduto->listProduto();
		$this->load->view('template', $data);
	}
	
	function retorno_consumo()
	{
		$data['title'] = "Relatórios - Controle de Estoque";
		$data['headline'] = "Relatório";
		$data['include'] = 'relatorio_retorno';
		$this->load->model('MRelatorio','',TRUE);
		$qry = $this->MRelatorio->getConsumoProduto($_POST);
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="relatorio">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Produto', 'Quantidade', 'Data');
		$table_row = array();
		$data['qry'] = array();
		foreach ($qry->result() as $produto)
		{
			$table_row = NULL;
			$table_row[] = $produto->nome_produto;
			$table_row[] = $produto->quantidade_pedida;
			$table_row[] = mysql_to_pt($produto->data_pedido);
			$this->table->add_row($table_row);
			$data['qry'][] = array((mysql_to_unix($produto->data_pedido)*1000), $produto->quantidade_pedida);
		}
		$table = $this->table->generate();
		$data['data_table'] = $table;
		$this->load->view('template3', $data);
	}
	
	function retorno_compra()
	{
		$data['title'] = "Relatórios - Controle de Estoque";
		$data['headline'] = "Relatório";
		$data['include'] = 'relatorio_retorno';
		$this->load->model('MRelatorio','',TRUE);
		$qry = $this->MRelatorio->getCompraProduto(/*$_POST*/);
		$table = $this->table->generate($qry);
		$tmpl = array ( 'table_open'  => '<table id="tabela" class="relatorio">' );
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('Número Nota', 'Fornecedor', 'Data da Nota', 'Valor Total');
		$table_row = array();
		$data['qry'] = array();
		foreach ($qry->result() as $nota)
		{
			$table_row = NULL;
			$table_row[] = $nota->numero_nota;
			$this->load->model('MFornecedor', '', TRUE);
			$fornecedor = $this->MFornecedor->getFornecedor($nota->id_fornecedor)->result();
			$table_row[] = $fornecedor[0]->razao_social;
			$table_row[] = mysql_to_pt($nota->data_nota);
			$table_row[] = ' ';
			$this->table->add_row($table_row);
			$data['qry'][] = array((mysql_to_unix($nota->data_nota)*1000), $fornecedor[0]->razao_social);
		}
		$table = $this->table->generate();
		$data['data_table'] = $table;
		$this->load->view('template3', $data);
	}
}

/* End of file Relatorio.php */
/* Location: ./application/controllers/Relatorio.php */