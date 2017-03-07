<?php
class Users extends MY_Controller {

	public function __construct(){
        parent::__construct();
//        $this->load->model('Users_model', 'u_model');
//        $this->load->helper('security');
//        $this->load->library('email');
//        $this->load->library('encryption');
        // $this->load->helper('url_helper');
        // $this->load->library('session');
    }

    function secure(){
    // verificação de segurança
        // if (!$this->session->has_userdata('login')){
        //     $this->data['msg']   = '<br><br><br><p class="alert alert-danger" style="text-align:center"><b>ACESSO RESTRITO A COLABORADORES DO IMUNODB!</b>
        //     <br>Se você for um de nossos colaboradores, por favor, realize seu login.</p><br><br><br>';
        //     $this->data['title'] = 'Acesso negado';
        //     $this->middle        = 'submissions/acesso_negado';
        //     $this->layout();
        //     return false;
        //     exit;
        // }
        return true;
    }


    // Vai ser nessa função que o CI envia as informações para o Heroku
    // public function register () {
    //     // exibir formulario de cadastro

    //     if (!$this->form_validation->run()){
    //         $this->data['msg']   = '';
    //         $this->data['reset'] = false;
    //     }

    //     else {
    //         $data = $this->input->post(NULL,true);
    //         // $data['ip_address'] = $this->input->ip_address();
    //         $data['password']   = password_hash($data['password'], PASSWORD_DEFAULT);
    //         // $data['uid']        = $this->encryption->create_key(8); 

    //         if ($this->u_model->set($data)){
    //             $id       = $this->encryption->encrypt($this->db->insert_id());
    //             // a última Query executada, na verdade, foi a inserção na tabela Contributor, então esse é o ID que está pegando
    //             $email    = $this->encryption->encrypt($data['email']);
    //             $password = $this->encryption->encrypt($data['password']);
    //             // $uid   = $this->encryption->encrypt($data['uid']);
    //             $url      = 'http://localhost/codeigniter/users/confirm?';
    //             // $url  .= sprintf('id=%s&email=%s&password=%s&uid=%s',$id, $email, $password, $uid);
    //             $url     .= sprintf('id=%s&email=%s&password=%s',$id, $email, $password);

    //             $this->confirmation_mail($data, $url);
    //             $this->data['msg'] = '<p class="alert alert-success">Dados enviados com sucesso! Por favor, verifique seu email para confirmação do cadastro.</p>';
    //             //inserir pedido de reenvio do email
    //             //inserir link para avisar que não está recebendo                
    //         }

    //         else
    //             $this->data['msg'] = '<p class="alert alert-danger">Desculpe, seu cadastro não pôde ser efetuado.Tente novamente mais tarde.</p>';

    //         $this->data['reset'] = true;     
    //     }

    //     $this->data['title'] = "ImunoDB | Cadastre-se e seja um de nossos colaboradores!";
    //     $this->middle        = "register_form";
    //     $this->layout();   
    // }

    function confirmation_mail($data, $url){
        // mandar email de confirmação do cadastro
        $this->email->from('imunodb@gmail.com', 'ImunoDB');
        $this->email->reply_to('imunodb@gmail.com', 'ImunoDB');
        $this->email->to($data['email']);
        $this->email->subject('Confirmação de cadastro - ImunoDB');
        $this->email->message('Olá, '.$data['first_name'].'!'.'<br><br>'.
                              'Desejamos boas vindas à Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias!'."<br><br>".
                              'Confirme seu cadastro clicando <a href="'.$url.'"">AQUI</a> ou acessando o link:'."<br><br>".
                              $url."<br><br>". //gerar link para confirmação do email
                              'bye bye'.'<br>'); // necessário arrumar texto da mensagem
                                               // provavelmente mudar para tipo html
        $this->email->send();
    }

    public function confirm(){
        $data = $this->input->get();
        
        $data['id'] = $this->encryption->decrypt($data['id']);
        $data['email'] = $this->encryption->decrypt($data['email']);
        echo 'Dentro do Controller:<br>';
        echo 'Password pela url = ' . $data['password'].'<br>';
        $data['password'] = $this->encryption->decrypt($data['password']);
        echo 'Password decriptado = ' . $data['password'].'<br>';
        echo 'Uid pela url = ' . $data['uid']. '<br>';
        $data['uid']   = $this->encryption->decrypt($data['uid']);
        echo 'Uid decriptado = ' . $data['uid']. '<br>';

        if ($this->u_model->confirm($data)){
            // $this->u_model->free_login(); -> função para liberar o usuário para se logar (preciso melhorar esse nome)
            echo "Cadastro confirmado<br>";
        }
        else
            echo "Cadastro não confirmado";
    


    }

    // function verify_email($email){
    //     // callback function for email verification in DB
    //     if ($this->u_model->get_id($email)){
    //         $this->form_validation->set_message('verify_email', 'This email address was already registered');
    //         return false;
    //     }
    //     return true;
    // }

    // function alpha_accented($str){
    //     if (!preg_match('/^[A-Za-zÀ-ž ]+$/', $str)){
    //         $this->form_validation->set_message('alpha_accented', 'The {field} field may only contain alphabetical and accented characters');
    //         return false;
    //     }
    //     return true;
    // }

    // Essa função envia requisição para o Heroku
    // public function forget_password(){ 
    //     // recuperação de senha
    //     $this->data['title']    = 'ImunoDB | Recuperação de senha';
    //     $this->middle           = 'forget_password';
    //     $this->layout();
    // }

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

        // Essa função também precisa de envio de email

    }
   
}
