<?php
class Users extends MY_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Users_model', 'u_model');
        // $this->load->helper('email'); 
        // $this->load->helper('url_helper');
        // $this->load->library('session');
    }

    function secure(){
    //verificação de segurança
        if (!$this->session->has_userdata('login')){
            $this->data['msg']   = '<br><br><br><p class="alert alert-danger" style="text-align:center"><b>ACESSO RESTRITO A COLABORADORES DO IMUNODB!</b>
            <br>Se você for um de nossos colaboradores, por favor, realize seu login.</p><br><br><br>';
            $this->data['title'] = 'Acesso negado';
            $this->middle        = 'submissions/acesso_negado';
            $this->layout();
            return false;
            exit;
        }
        else return true;
    }

    public function redirect() {
        if ($this->input->post('register') == TRUE)
            $this->register();
        if ($this->input->post('login') == TRUE){
            $login = array();
            $login['email'] = $this->input->post('email');
            $login['psw']   = $this->input->post('password');
            $this->login($login);
        }
    }

    public function login($login){
        if (!($this->u_model->valid_mail($login['email']))){
            //exibir mensagem de erro avisando que email não existe
            $href = base_url('index.php/users/register');
            $this->data['title'] = "Erro de login | Email não cadastrado";
            $this->data['error'] = '<p class="alert alert-danger" style="text-align:center">Email não encontrado</p>';
            $this->data['msg']   = '<p class="alert alert-warning">Verifique se o endereço foi digitado corretamente e tente outra vez.
            <br>Caso o problema persista, cadastre-se <a href="'.$href.'"> aqui</a>.</p>';
            $this->data['space'] = '<br><br><br><br>';
            $this->middle        = "login_error";
            $this->layout();
            
        }
        else if ($this->u_model->verify_level($login['email']) == 0){
            //exibir mensagem de email não confirmado e sugerir confirmação do email
            $this->data['title']  = 'Erro de login | Email não confirmado';
            $this->data['error']  = '<p class="alert alert-danger" style="text-align:center">Email não confirmado</p>';
            $this->data['msg']    = '<p class="alert alert-warning">Esse endereço de e-mail está cadastrado mas não foi confirmado.
            <br>Para confirmar, clique <a href="#">aqui</a>.</p>';
            $this->data['space']  = '<br><br><br><br>';
            $this->middle         = "login_error";
            $this->layout();
        }

        else if (!($this->u_model->login($login))){
            //exibir mensagem de mismatch de email e senha
            $this->data['title']  = 'Erro de login | Email e senha incompatíveis';
            $this->data['error']  = '<p class="alert alert-danger" style="text-align:center">Email e senha não correspondem</p>';
            $this->data['msg']    = '<p class="alert alert-warning">Verifique se a senha foi digitada corretamente e tente outra vez.
            <br>Caso o problema persista, clique <a href="#">aqui</a> para recuperar sua senha.';
            $this->data['space']  = '<br><br><br><br>';
            $this->middle         = "login_error";
            $this->layout();
        }

        else {
            //redireciona para página de colaborador ou admin (?)
            $name  = $this->u_model->get_name($login['email']);
            $id    = $this->u_model->get_id($login['email']);
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('first_name', $name['first_name']);
            $this->session->set_userdata('last_name', $name['last_name']);
            $this->session->set_userdata('id', $id);
            $this->data['msg']   = '';
            $this->data['title'] = 'ImunoDB | Submeter artigo';
            $this->middle        = "submissions/submission_form";
            $this->layout();
        }
    }

        function logoff() {
        //desconecta usuário contribuidor
        if ($this->secure()){
            $this->session->unset_userdata('login');
            // $this->session->sess_destroy();
            $this->data['title'] = 'ImunoDB | Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias';
            $this->middle        = 'home/home_view';
            $this->layout();
        }
    }

    public function register () {
        #exibir formulario de cadastro
        $this->data['title'] = "ImunoDB | Cadastre-se e seja um de nossos colaboradores!";
        $this->data['msg']   = '';
        $this->data['mail_error'] = '';
        $this->data['pswd_error'] = '';
        $this->middle = "register_form";
        $this->layout();
    }

    function save_register(){
        #salvar usuario no BD
        $get = array();
        $get = $this->input->post();
        if ($this->u_model->set($get))
            $this->data['msg'] = '<p class="alert alert-success">Cadastro efetuado com sucesso!</p>';
        else
            $this->data['msg'] = '<p class="alert alert-danger">Desculpe, por algum motivo que ainda desconhecemos o seu cadastro não pôde ser efetuado.</p>';

        $this->data['mail_error'] = '';
        $this->data['pswd_error'] = '';
        $this->data['title'] = "ImunoDB | Cadastre-se e seja um de nossos colaboradores!";
        $this->middle = "register_form";
        $this->layout();
    }

    function verify(){
        //valida email e senha
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $repassword = $this->input->post('repassword');

        if ($this->u_model->get_id($email)){
            $this->data['mail_error'] = "<p class='text-danger'>E-mail já cadastrado</p>";
            $this->data['pswd_error'] = '';
        }
        else if (!(valid_email($email))){
            $this->data['mail_error'] = "<p class='text-danger'>Por favor, insira um endereço de e-mail válido</p>";
            $this->data['pswd_error'] = '';
            if ($password != $repassword){
            $this->data['pswd_error'] = "<p class='text-danger'>As senhas não combinam</p>";
            }
        }

        else if ($password != $repassword){
            $this->data['mail_error'] = '';
            $this->data['pswd_error'] = "<p class='text-danger'>As senhas não combinam</p>";
        }

        else 
            $this->save_register();

        $this->data['msg'] = '';
        $this->data['title'] = "ImunoDB | Cadastre-se e seja um de nossos colaboradores!";
        $this->middle = "register_form";
        $this->layout();
    }

    function edit_data () {
        //altera dados do usuário contribuidor
        if ($this->secure()){
            $arr = $this->input->post();
            $this->data = $arr;

            $user = $this->u_model->get_user_data($this->session->id);

            $arr['email']        = $user->email;
            $this->data['email'] = $user->email;

            if ($this->u_model->update_data($arr))
                $this->data['msg'] = '<p class="alert alert-success" style="text-align:center">Seus dados foram atualizados com sucesso!</p>';
            else
                $this->data['msg'] = '<p class="alert alert-danger" style="text-align:center">Seus dados não puderam ser atualizados. Por favor, tente novamente mais tarde</p>';

            $this->data['title']   = 'ImunoDB | Meus dados';
            $this->middle          = 'submissions/view_data';
            $this->layout();
        }    
    }

    function change_password(){
        if ($this->secure()){
            $arr = $this->input->post();
            if ($arr['password'] == $this->u_model->get_password($this->session->id)){
                if ($arr['new_password'] == $arr['repeat_new_password']){
                    if($this->u_model->update_password($this->session->id, $arr['new_password'])){
                        $this->data['msg']              = '<p class="alert alert-success" style="text-align:center">Senha alterada com sucesso!</p>';
                        $this->data['new_password_msg'] = '';
                        $this->data['password_msg']     = '';
                        $this->data['title']            = 'ImunoDB | Alterar senha';
                        $this->middle                   = 'submissions/change_password';
                        $this->layout();
                    }
                    
                    else { 
                        $this->data['msg']              = '<p class="alert alert-danger" style="text-align:center"Sua senha não pôde ser alterada no momento. Por favor, tente novamente mais tarde.</p>';
                        $this->data['new_password_msg'] = '';
                        $this->data['password_msg']     = '';
                        $this->data['title']            = 'ImunoDB | Alterar senha';
                        $this->middle                   = 'submissions/change_password';
                        $this->layout();
                    }
                }

                else {
                    $this->data['msg']              = '';
                    $this->data['password_msg']     = '';
                    $this->data['new_password_msg'] = '<p class="text-danger">Senhas não correspondem</p>';
                    $this->data['title']            = 'ImunoDB | Alterar senha';
                    $this->middle                   = 'submissions/change_password';
                    $this->layout();
                }
            }

            else {
                $this->data['msg']              = ''; 
                $this->data['password_msg']     = '<p class="text-danger">Senha incorreta</p>';
                $this->data['new_password_msg'] = '';
                $this->data['title']            = 'ImunoDB | Alterar senha';
                $this->middle                   = 'submissions/change_password';
                $this->layout();
            }
        }
    }

    public function forget_password(){
        //recuperação de senha
        $this->data['title']    = 'ImunoDB | Recuperação de senha';
        $this->middle           = 'forget_password';
        $this->layout();
    }

    public function recovery_password(){
        /* faz:
        $id       = $this->u_model->get_id($this->input->post('email'));
        $password = $this->u_model->get_password($id);
        send_mail();
        se for enviar por email*/

        //ou

        /*
        redireciona para página de digitar nova senha
        recebe dados (aqui mesmo?)
        faz verificações necessárias e salva se estiver tudo ok
        */

    }
    // private function delete () {

    // }

    // private function view () {

    // }
}
