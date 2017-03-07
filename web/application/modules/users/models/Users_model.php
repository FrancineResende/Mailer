<?php
 
class Users_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('email');
        // $this->load->model('admin/Admin_model', 'a_model');
    }
 
    function set($data) {
        $user = array();
        $user['first_name'] = $data['first_name'];
        $user['last_name']  = $data['last_name'];
        $user['email']      = $data['email'];
        $user['password']   = $data['password'];

        $this->db->insert('Login_Users', $user);
        $last_id = $this->db->insert_id();
        echo ("last_id: " . $last_id);
        //get country_id to add in the LU table
        $country_id = $this->get_country_id($data['country']);
        
        $contrib = array();
        $contrib['luser_id']    = $last_id;
        $contrib['phone']       = $data['phone'];
        $contrib['city']        = $data['city'];
        $contrib['country_id']  = $country_id;
        $contrib['profile']     = $data['profile'];
        $contrib['field_study'] = $data['field_study'];
        $contrib['institution'] = $data['institution'];

        if (isset($data['newsletter'])){
            $mail = array('luser_id' => $last_id, 'contrib_mail' => 1, 'generic_mail' => 1);
            $this->db->insert('Send_Mail', $mail);
            //fazer alguma verificação se inseriu
        }

        return $this->db->insert('Contributors', $contrib);
    }
 
    function valid_mail($email){
        //verifica se email existe no BD
        $query = $this->db->select('*')
                          ->from('Login_Users')
                          ->where('email', $email)
                          ->get();
        if ($query->result())
            return true;
        else
            return false;
    }

    function verify_level($email){
    //verifica o nivel de usuário
    //0 - registro não confirmado
    //1 - colaborador
    //2 - admin
        $query = $this->db->select('level')
                          ->from('Login_Users')
                          ->where('email', $email)
                          ->get();

        $level = $query->row();
        return $level->level;
    }

    function login($login){
        $query = $this->db->select('password')
                          ->from('Login_Users')
                          ->where('email', $login['email'])
                          ->get();
        $res = $query->row();
        if (password_verify($login['psw'], $res->password))
            // $res->password == $login['psw'])
            return true;
        else
            return false;

        // boolean password_verify ( string $password , string $hash )
    }

    function get_name($email){
        //retorna nome do usuário através do seu email
        $query = $this->db->select('first_name, last_name')
                          ->from('Login_Users')
                          ->where('email', $email)
                          ->get();
        $query = $query->row();
        $name['first_name']  =  $query->first_name;
        $name['last_name']   =  $query->last_name;

        return  $name;
    }

    function get_country_id($country_name){
        //retorna o id do país para ser adicionado em outras tabelas
        //evita necessidade de repetição de armazenamento desnecessário 
        $query = $this->db->select('country_id')
                          ->from('Countries')
                          ->where('country_name', $country_name)
                          ->get();
        $result = $query->row_array();
        $id = $result['country_id'];
        return  $id;
    }

    function get_id($email){
        //retorna o id do usuário dono do email
        $query = $this->db->select('luser_id')
                          ->from('Login_Users')
                          ->where('email', $email)
                          ->get();
        $result = $query->row_array();
        $id = $result['luser_id'];
        return  $id;
    }

	function get_user_data($id) {
        //retorna dados do usuário contribuidor
	   $query = $this->db->select('lu.luser_id, lu.first_name, lu.last_name, lu.email, c.contrib_id, c.city, co.country_name, c.institution, c.profile, c.field_study, c.phone')
                         ->from('Login_Users as lu, Contributors as c, Countries as co')
                         ->where('c.luser_id = lu.luser_id')
                         ->where('c.country_id = co.country_id')
                         ->where('lu.luser_id', $id)
                         ->get();
        return $query->row();
	}

    function get_password($id){
        //retorna a senha atual do usuário logado
        $query = $this->db->select('password')
                          ->from('Login_Users')
                          ->where('luser_id', $id)
                          ->get();
        $query = $query->row_array();
        return $query['password'];
    }
     
    function update_data($data) {
        
        $user = array('first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email']);
        $this->db->set($user);
        $this->db->where('luser_id', $data['luser_id']);
        if (!$this->db->update('Login_Users'))
            return false;


        $country_id = $this->get_country_id($data['country']);
        $contrib = array('institution' => $data['institution'], 'field_study' => $data['field_study'], 'profile' => $data['profile'], 'phone' => $data['phone'], 'city' => $data['city'], 'country_id' => $country_id);
        $this->db->set($contrib);
        $this->db->where('contrib_id', $data['contrib_id']);
        // $this->db->where('luser_id', $data['luser_id']);
        if (!$this->db->update('Contributors'))
            return false;

        //guardar variáveis importantes na session
        $this->session->set_userdata('first_name', $user['first_name']);
        $this->session->set_userdata('last_name', $user['last_name']);
        
        return true;       
    }

    function update_password($id, $new_password){
        $this->db->set('password', password_hash($new_password, PASSWORD_DEFAULT));
        $this->db->where('luser_id', $id);
        if ($this->db->update('Login_Users'))
            return true;
        return false;
    }
     
    function delete($id) {
        // $this->db->where('id', $id);
        // return $this->db->delete('pessoas');
    }

}
?>