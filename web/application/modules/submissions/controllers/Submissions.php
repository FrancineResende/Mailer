<?php
class Submissions extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Submissions_model', 's_model');
        $this->load->model('Users/Users_model', 'u_model');
        $this->load->helper('date');

        /*
        utilizar helper de segurança
        - se tentar acessar url interna de colaboração, redirecionar para página de erro e pedir login
        */
    }
    // function index(){
        
    //     $this->data['title'] = 'ImunoDB | Área de contribuição';
    //     $this->middle        = "users/contributor_home";
    //     $this->layout();
    // }

    function secure(){
        //verificação de segurança
        if (!$this->session->has_userdata('login')){
            $this->data['msg']   = '<br><br><br><p class="alert alert-danger" style="text-align:center"><b>ACESSO RESTRITO A COLABORADORES DO IMUNODB!</b>
            <br>Se você for um de nossos colaboradores, por favor, realize seu login.</p><br><br><br>';
            $this->data['title'] = 'Acesso negado';
            $this->middle        = 'acesso_negado';
            $this->layout();
            return false;
        }
        return true;
    }   
 
    function view_submissions(){
        //listar todas as submissões já feitas pelo colaborador
        if ($this->secure()){

            $id                  = $this->session->id;  //pega id do usuario logado
            $this->data['list']  = $this->s_model->get_submissions($id);
            $this->data['title'] = "ImunoDB | Listagem de submissões";
            $this->middle        = 'list_contributions';
            $this->layout();
        }

    }

    function submit(){
        //exibe formulário de submissão de artigo
        if ($this->secure()){
            if (!($this->form_validation->run())){
                $this->data['title'] = 'ImunoDB | Submeter artigo';
                $this->data['msg']   = '';
                $this->data['reset'] =  false;
                $this->middle        = 'submission_form';
                $this->layout();
            }
        
            else {
                $sub = $this->input->post();
                unset($sub['submit']);
                $sub['contrib_id']  = $this->s_model->get_contrib_id($this->session->id);
                   
                if ($this->s_model->set($sub))
                    $this->data['msg'] = '<p class="alert alert-success">Obrigado! Sua colaboração foi recebida com sucesso. Ela será analisada por nossa equipe assim que possível.</p>';
                else
                    $this->data['msg'] = '<p class="alert alert-danger">Sua colaboração não pôde ser armazenada corretamente. Por favor, tente novamente mais tarde ou informe-nos sobre esse problema</p>';
                
                $this->data['title'] = 'ImunoDB | Submeter artigo';
                $this->data['reset'] = true;
                $this->middle        = 'submission_form';
                $this->layout();
            }
        }
    }


    function view_data ($reset = true, $msg = '') {
        if ($this->secure()){
            $user = array();
            $user = $this->u_model->get_user_data($this->session->id);

            $this->data['luser_id']      = $user->luser_id; 
            $this->data['first_name']    = $user->first_name;
            $this->data['last_name']     = $user->last_name;
            $this->data['email']         = $user->email;
            $this->data['city']          = $user->city; 
            $this->data['country']       = $user->country_name; //puxar o nome
            $this->data['contrib_id']    = $user->contrib_id;
            $this->data['institution']   = $user->institution;
            $this->data['field_study']   = $user->field_study;
            $this->data['phone']         = $user->phone;
            $this->data['profile']       = $user->profile; 

            $this->data['msg']           = $msg;
            $this->data['reset']         = $reset;
            $this->data['title']         = 'ImunoDB | Meus dados';
            $this->middle                = 'view_data';
            $this->layout();
        }
    }

    function edit_data () {
    // altera dados do usuário contribuidor
        if ($this->secure()){
            if(!($this->form_validation->run()))
                $this->view_data(false);

            else {

                $this->data          = $this->input->post();
                $user                = $this->u_model->get_user_data($this->session->id);
                $this->data['email'] = $user->email;

                if ($this->u_model->update_data($this->data))
                    $msg = '<p class="alert alert-success" style="text-align:center">Seus dados foram atualizados com sucesso!</p>';
                else
                    $msg = '<p class="alert alert-danger" style="text-align:center">Seus dados não puderam ser atualizados. Por favor, tente novamente mais tarde</p>';
                $this->view_data(true, $msg);
            }
        }    
    }

    function change_password(){
        if ($this->secure()){
            if(!$this->form_validation->run()){
                $this->data['msg']   = '';
                $this->data['reset'] = false;
            }
            else {
                $arr = $this->input->post();

                if($this->u_model->update_password($this->session->id, $arr['new_password'])){
                    $this->data['msg']   = '<p class="alert alert-success" style="text-align:center">Senha alterada com sucesso!</p>';
                    $this->data['reset'] = true;
                }
            }

            $this->data['title'] = 'ImunoDB | Alterar senha';
            $this->middle        = 'change_password';
            $this->layout(); 
        }     
    }

    function verify_password($password){
        // if ($password === $this->u_model->get_password($this->session->id))
        if (password_verify($password, $this->u_model->get_password($this->session->id)))
            return true;
        else
            $this->form_validation->set_message('verify_password', 'Incorrect password');
        return false;
    }

    function check_doi($doi){
        //validação de doi

        // $pattern = '\b(10[.][0-9]{4,}(?:[.][0-9]+)*/(?:(?!["&\'<>])\S)+)\b'; // -> outra opção, mas não sei se funciona
        $pattern = '(10.[0-9]{4,}+/([^(\s\>\"\<)])+)';
        if (!preg_match($pattern, $doi)){
            $this->form_validation->set_message('check_doi', 'The {field} field must contain a valid value');
            return false;
        }
        return true;
    }

    function alpha_accented($str){
        if (!preg_match('/^[A-Za-zÀ-ž ]+$/', $str)){
            $this->form_validation->set_message('alpha_accented', 'The {field} field may only contain alphabetical and accented characters');
            return false;
        }
        return true;
    }

    function alphanum_accented($str){
        if (!preg_match('/^[A-Za-zÀ-ž0-9 ]+$/', $str)){
            $this->form_validation->set_message('alphanum_accented', 'The {field} field may only contain alphanumeric and accented characters');
            return false;
        }
        return true;
    }




    function insert () {

    }

    function edit () {

    }

    function delete () {
    	
    }

}