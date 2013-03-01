<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    
    public function Login()
	{
        parent::__construct();
    }

    public function index($msg = NULL)
	{
		$data['title'] = "Login - Controle de Estoque";
        $data['headline'] = "Controle de Estoque";
		$data['msg'] = $msg;
        $data['include'] = "login_view";
	    $this->load->view('template', $data);
    }
	
	public function process(){
        $this->load->model('MLogin');
        $result = $this->MLogin->validate();
        if(! $result){
			$msg = '<div id="erro">Usuário ou senha inválidos.</div><br />';
            $this->index($msg);
        }else{
			redirect('estoque/index');
        }        
    }
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */