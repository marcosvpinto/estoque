<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function Categoria() 
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
        $data['title'] = "Cadastro de Categoria - Controle de Estoque";
        $data['headline'] = "Cadastro de Categoria";
        $data['include'] = "categoria_add";
        $this->load->view('template', $data);
    }
	
	function create()
    {
        $this->load->model('MCategoria','',TRUE);
        $this->MCategoria->addCategoria($_POST);
        redirect('produto/add', 'refresh');
    }
	
}

/* End of file Categoria.php */
/* Location: ./application/controllers/Categoria.php */