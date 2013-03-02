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
		$data['include'] = 'Relatorio_listing';
		$this->load->view('template', $data);
	}
	
	function retorno()
	{
		$data['title'] = "Relatórios - Controle de Estoque";
		$data['headline'] = "Relatório";
		$data['include'] = 'Relatorio_retorno';
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
			$data_human = mysql_to_pt($produto->data_pedido);
			$table_row[] = $data_human;
			$this->table->add_row($table_row);
			$data['qry'][] = array((mysql_to_unix($produto->data_pedido))*1000, $produto->quantidade_pedida);
		}    
		$table = $this->table->generate();
		$data['data_table'] = $table;
		$this->load->view('template', $data);
	}
}

/* End of file Relatorio.php */
/* Location: ./application/controllers/Relatorio.php */