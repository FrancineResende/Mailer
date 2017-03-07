<?php
class Admin extends MY_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_model', 'a_model');
        $this->load->model('mutations/Mutations_model', 'm_model');
        $this->load->model('bibliography/Bibliography_model', 'b_model');
        $this->load->model('users/Users_model', 'u_model');
        $this->load->model('submissions/Submissions_model', 's_model');

        $this->load->helper('form', 'url', 'text');   
    }

    function index(){
        //carrega página de login administrativo
        if ($this->session->has_userdata('loginAdm'))
            $this->home();
        else {
            $this->data['title'] = "ImunoDB | Login administrativo";
            $this->middle        = "login";
            $this->layout();
        }
    }

    function secure(){
        //verificação de segurança

        if (!$this->session->has_userdata('loginAdm') ){
            $this->data['msg']   = '<br><br><br><p class="alert alert-danger" style="text-align:center"><b>ACESSO RESTRITO A ADMINISTRADORES DO IMUNODB!</b>
            <br>Se você for um de nossos administradores, por favor, realize seu login.</p><br><br><br>';
            $this->data['title'] = 'Acesso negado';
            $this->middle        = 'submissions/acesso_negado';
            $this->layout();
            return false;
        }
        return true;
    }   

    function login(){
        //redireciona de acordo com as credenciais de login

            if (!$this->form_validation->run())
                $this->index();
            else {
                $this->session->set_userdata('loginAdm', true);
                $this->session->unset_userdata('login');
                $this->get_admin_name();
                $this->home();
            }
    }

    function logout(){
        $this->session->unset_userdata('loginAdm');
        // $this->session->sess_destroy();
        $this->data['title'] = 'ImunoDB | Base de Dados Latino-Americana de Mutações Genéticas em Imunodeficiências Primárias';
        $this->middle        = 'home/home_view';
        $this->layout();
    }

    function get_admin_name(){
        //usa o email para obter o nome do user admin
        if ($this->secure()){
            $name = $this->a_model->get_name($this->session->emailAdm);
            $this->session->set_userdata('first_name', $name->first_name);
            $this->session->set_userdata('last_name', $name->last_name);
        }
        return;
    }

    function home(){
        //carrega página inicial quando admin loga (painel administrativo)

        if ($this->secure()){
            $this->data['title'] = 'Painel Administrativo ImunoDB';
            $this->middle        = 'admin_home';
            $this->layout();
        }
    }

    function new_admin(){
        //registo de adms

        //gerar url codificada para enviar no email dos admins e eles se cadastrarem
        // if ($this->secure()) { //-> essa função verifica o email de quem acessou o link?
            $this->data['title'] = 'ImunoDB | Registro de administrador';
            $this->middle        = 'admin_register';
            $this->layout();
            //verificar só o email primeiro, pra caso ele já exista no bd
            //se já existir, só seta ele na tabela de admin
            //senão, cria um novo usuário com aquelas informações e seta para admin
        // }
    }

    function save_admin(){
        //verificar se email já está em Users

        if ($this->a_model->save($this->input->post('email')))
            echo 'Salvou';
        else
            echo 'Nope';


    }

    function insert_article($msg = ''){
        //carrega formulário de inserção de artigo
        if ($this->secure()){    
            $this->data['msg']   = $msg;  
            $this->data['title'] = "Painel Administrativo ImunoDB | Inserção de Artigo";
            $this->middle        = 'insert_article';
            $this->layout();
        }
    }

    function set_article(){
        if ($this->secure()){                  
            if (!$this->form_validation->run())
                $this->insert_article();

            else {
                $data  = $this->input->post();
                $value = $this->b_model->set($data);

                if ($value == 0) // se inseriu
                    $this->insert_article('<p class="alert alert-success">Artigo inserido com sucesso</p>');
                
                else if ($value == 1) // se deu problema na inserção
                    $this->insert_article('<p class="alert alert-danger">Ocorreu um problema na inserção do artigo. Tente novamente mais tarde</p>');

                else if ($value == 2) // se artigo já existe no BD
                    $this->insert_article('<p class="alert alert-warning">Esse artigo já consta da base de dados do ImunoDB</p>');
            }
        }
    }
    
    function search_article($alert = '', $search = ''){
        //exibe busca de artigos para editar e resultados da busca com opção para editar/excluir
        if ($this->secure()){
            if ($this->input->get()) {
                $data = $this->input->get();    
                $this->session->set_userdata('search', $data);
                $articles = $this->b_model->get_all($data);
            }

            else if ($search != '')
                $articles = $this->b_model->get_all($search);      
            
            if (isset($articles))
                    $this->data['articles'] = $articles;

            $this->data['title'] = 'Painel Administrativo ImunoDB | Busca de artigo para edição';
            $this->data['alert'] = $alert;
            $this->middle        = 'search_article';
            $this->layout();
        }
        
    }

    function article_edit_page($id, $msg = ''){
        if ($this->secure()){
            $data                = $this->b_model->get_by_id($id);
            $this->data['data']  = $data;
            $this->data['msg']   = $msg;
            $this->data['title'] = 'Painel Administrativo ImunoDB | Página de edição de artigo';
            $this->middle        = 'article_edit_page';
            $this->layout();
        }
        
    }

    function article_set_edit(){
        if ($this->secure()){
            if (!$this->form_validation->run())
                $this->article_edit_page($this->input->post('article_id'));
            else {
                $data = $this->input->post(); 
                unset($data['Buscar']);
                if ($this->b_model->edit($data))
                    $this->article_edit_page($data['article_id'], '<p class="alert alert-success">Artigo atualizado com sucesso!</p>');
                else
                    $this->article_edit_page($data['article_id'], '<p class="alert alert-danger">Artigo não pôde ser atualizado. Tente novamente mais tarde.</p>');
            }
        }
    } 

    function article_delete($id){
        if ($this->secure()){
            if ($this->b_model->delete($id))
                $this->search_article('<script>alert("O artigo foi deletado");</script>', $this->session->search);
        
            else 
                $this->search_article('<script>alert("O artigo não pôde ser deletado. Tente novamente mais tarde");</script>', $this->session->search);
        }
        //opção de otimização: mostrar informações do artigo deletado
    }
    
    function insert_mutation($msg = ''){
        //exibe formulário para inserção de mutação

        if ($this->secure()){    
            $this->data['msg']   = $msg;
            $this->data['title'] = "Painel Administrativo ImunoDB | Inserção de Mutação";
            $this->middle        = 'insert_mutation';
            $this->layout();
        }
    }

    function set_mutation(){

        if ($this->secure()){
            if (!$this->form_validation->run()){
                $this->insert_mutation();
            }
            else {
                $data  = $this->input->post();
                $value = $this->m_model->set($data);
                
                if ($value == 0) // se inseriu
                    $this->insert_mutation('<p class="alert alert-success">Mutação inserida com sucesso!</p>');

                else if ($value == 1) // se deu problema na inserção
                    $this->insert_mutation('<p class="alert alert-danger">Ocorreu um problema na inserção da mutação. Tente novamente mais tarde</p>');
                
                else if ($value == 2) // se artigo não existe no BD
                    $this->insert_mutation('<p class="alert alert-danger">Referência não consta na base de dados do ImunoDB</p>');
            }
        }
    }

    function search_mutation($alert = '', $searchMut = ''){
        //exibe busca de mutações para editar e resultados da busca com opção para editar/excluir
        if ($this->secure()){
            if ($this->input->get()) {
                $data = $this->input->get();    
                $this->session->set_userdata('searchMut', $data);
                $mutations = $this->m_model->get_all($data);
            }

            else if ($searchMut != '')
                $mutations = $this->m_model->get_all($searchMut);      
            
            if (isset($mutations))
                    $this->data['mutations'] = $mutations;

            $this->data['title'] = 'Painel Administrativo ImunoDB | Busca de mutação para edição';
            $this->data['alert'] = $alert;
            $this->middle        = 'search_mutation';
            $this->layout();
        }
    }

    function mutation_edit_page($id, $msg = ''){
         if ($this->secure()){
            $data                   = $this->m_model->get_by_id($id);
            $this->data['data']     = $data;
            $this->data['msg']      = $msg;
            $this->data['title']    = 'Painel Administrativo ImunoDB | Página de edição de mutação ';
            $this->middle           = 'mutation_edit_page';
            $this->layout();
        }
        
    }

    function mutation_set_edit($id){
         if ($this->secure()){
            if (!$this->form_validation->run()){
                $this->mutation_edit_page($id);
            }
            else {
                $data  = $this->input->post();
                unset($data['Alterar']);
                if ($this->m_model->edit($data))
                    $this->mutation_edit_page($data['mutation_id'], '<p class="alert alert-success">Mutação atualizada com sucesso!</p>');
                else
                    $this->mutation_edit_page($data['mutation_id'], '<p class="alert alert-danger">Mutação não pôde ser atualizada. Tente novamente mais tarde.</p>');
            }
        }
    }

    function mutation_delete($id){
        if ($this->secure()){
            if ($this->m_model->delete($id))
                $this->search_mutation('<script>alert("A mutação foi deletada");</script>', $this->session->searchMut);
            else 
                $this->search_mutation('<script>alert("A mutação não pôde ser deletada. Tente novamente mais tarde");</script>', $this->session->searchMut);
        }
        //opção de otimização: mostrar informações da mutação deletada?
    }

    function list_submissions($msg = ''){
    //lista todas as submissões com status == 'Aguardando avaliação da equipe'.
        if ($this->secure()){
            $list = $this->s_model->get_to_evaluation();
            $contrib_name = array();

            foreach ($list->result() as $row)
                $contrib_name[$row->contrib_id] = $this->s_model->get_contributor_name($row->contrib_id);

            $this->data['contrib_name']  = $contrib_name;
            $this->data['list']          = $list;
            $this->data['msg']           = $msg;
            $this->data['title']         = 'Painel Administrativo ImunoDB | Avaliação de contribuições';
            $this->middle                = 'evaluate_submissions';
            $this->layout();
        }
    }

    function evaluate($id){

        if ($this->secure()){
            $status = $this->input->get('status');
            $evaluated_by = $this->session->first_name.' '.$this->session->last_name;

            switch ($status) {
                case 'already_on_bd':
                    $new_status = 'Artigo já consta no ImunoDB';
                    break;
                case 'accepted':
                    $new_status = 'Colaboração aceita';
                    break;
                case 'refused_x':
                    $new_status = 'Colaboração recusada por motivo X';
                    break;
                case 'refused_y':
                    $new_status = 'Colaboração recusada por motivo Y';
                    break;
                default:
                   $new_status = 'Aguardando avaliação da equipe';
                    break;
            }

            if ($this->s_model->edit_status($id, $new_status, $evaluated_by))
                $this->list_submissions();
            else
                $this->list_submissions('<p class="alert alert-danger">Não foi possível alterar o status da submissão no momento. Por favor, tente novamente mais tarde</p>');
        }
    }

    function email_check($email){
        //verifica se email pertence a um adm ou não

        if (!$this->a_model->is_admin($email)){
            $this->form_validation->set_message('email_check', 'This email address does not belong to any administrator');
            return false;
        }
        else {
            $this->session->set_userdata('emailAdm', $email);
            return true;
        }
    }

    function password_check($password, $email){
        //verifica se email e senha combinam ou não

        $user_id = $this->u_model->get_id($email);
        if (!(password_verify($password, $this->u_model->get_password($user_id)))){
            $this->form_validation->set_message('password_check', 'The email and password combination did not match');
            return false;
        }
        else 
            return true;
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

    function check_country($country){
        //checa se country é válido, de acordo com o BD
        if ($this->secure()){
            if (!$this->a_model->verify_country($country)){
                $this->form_validation->set_message('check_country', 'The {field} field must contain a name of a latin american country or the word "Uninformed"');
                return false;
            }
            return true;
        }
    }

    function check_gene($gene){
        //checa se gene é válido, de acordo com o BD
        if ($this->secure()){
            if (!$this->a_model->verify_gene($gene)){
                $this->form_validation->set_message('check_gene', 'The {field} field must contain a gene that already exists on database');
                return false;
            }
            return true;
        }
    }

    function check_disease($disease){
        //checa se o nome da doença é válido, de acordo com o BD
        if ($this->secure()){
            if (!$this->a_model->verify_disease($disease)){
                $this->form_validation->set_message('check_disease', 'The {field} field must contain a disease name that already exists on database');
                return false;
            }
            return true;
        }
    }

    function check_article($doi){
    //checa se o nome da doença é válido, de acordo com o BD
        if ($this->secure()){
            if (!$this->a_model->verify_article($doi)){
                $this->form_validation->set_message('check_article', 'The {field} field must contain a reference that already exists on database');
                return false;
            }
            return true;
        }
    }

    function check_synonymous($synon){
        if($this->secure()){
            if($this->m_model->verify_synon($synon)){
                $this->form_validation->set_message('check_synonymous', 'The {field} field contain an information that already exists on database');
                return false;
            }
            return true;
        }
    }


    function synon_registration($msg = ''){
    //insere novo sinônimo de gene
        if($this->secure()){
            $genes = $this->m_model->get_genes();
            foreach ($genes as $row) 
                $data[$row->gene_id] = $row->gene_name;
            $this->data['data']      = $data;
            $this->data['msg']       = $msg;
            $this->data['title']     = 'Painel Administrativo ImunoDB | Registro de sinônimos';
            $this->middle            = 'syn_registration';
            $this->layout();
        }
    }

    function save_synonymous(){
        if($this->secure()){
            if (!$this->form_validation->run()){
                $this->synon_registration();
            }
            else {
                if ($this->m_model->insert_synon($this->input->post()))
                    $this->synon_registration('<p class="alert alert-success">Sinônimo inserido com sucesso!</p>');
                else
                    $this->synon_registration('<p class="alert alert-danger">Não foi possível inserir o sinônimo. Por favor, tente novamente mais tarde.</p>');
            }
        }
    }

    function edit_synon($alert = '', $gene_id = ''){
        if($this->secure()){

            if ($gene_id != ''){
                $synon = $this->m_model->get_synon($gene_id);
                if ($synon)
                    $this->data['synon']    = $synon;
                $this->data['gene_id']      = $gene_id;
            }
            else if($this->input->post('gene_id')){
                $synon = $this->m_model->get_synon($this->input->post('gene_id'));
                if ($synon)
                    $this->data['synon']    = $synon;
            }

            $genes                = $this->m_model->get_genes_with_synon();
            $this->data['genes']  = $genes;
            $this->data['alert']  = $alert;               
            $this->data['title']  = 'Painel Administrativo ImunoDB | Edição de sinônimos';
            $this->middle         = 'edit_synon';
            $this->layout();
        }
    }

    function set_edit_synon($synon_id, $gene_id){
        if ($this->secure()){
            if(!$this->form_validation->run()){
                $msg = '<br><p class="alert alert-danger">O campo que está tentando editar está vazio ou contém um sinônimo que já existe no BD.</p>';
                $this->edit_synon($msg, $gene_id);
            }
            else{
                if ($this->m_model->edit_synon($synon_id, $this->input->post()))
                    $this->edit_synon('<script>alert("Sinônimo atualizado!");</script>', $gene_id);
                else 
                    $this->edit_synon('<script>alert("Sinônimo não pôde ser atualizado. Tente novamente mais tarde.");</script>', $gene_id); 
            }
        }
    }

    function delete_synon($synon_id, $gene_id){
        if ($this->secure()){
            if ($this->m_model->delete_synon($synon_id))
                $this->edit_synon('<script>alert("Sinônimo excluído.");</script>', $gene_id);
            else 
                $this->edit_synon('<script>alert("O sinônimo não pôde ser excluído. Tente novamente mais tarde.");</script>', $gene_id);
        }
    }


}