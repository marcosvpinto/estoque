<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLogin extends CI_Model{
    
    function validate(){
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        $this->db->where('login', $username);
        $this->db->where('senha', $password);
		
		$this->db->join('perfil', 'perfil.nivel = usuario.perfil');
		$this->db->join('setor', 'setor.id_setor = usuario.setor');
        
		$query = $this->db->get('usuario');
        if($query->num_rows == 1)
        {
            $row = $query->row();
            $data = array(
                    'userid' => $row->id_usuario,
                    'login' => $row->login,
                    'perfil' => $row->nome_perfil,
                    'setor' => $row->nome_setor,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }
}

/* End of file mlogin.php */
/* Location: ./application/models/mlogin.php */
