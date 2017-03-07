<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Setting rules
|--------------------------------------------------------------------------
|
| Definição das regras para cada Controller/method que utiliza validação
|
*/
//$year é a variável usada na regra 'less_than_equal_to' para os campos de anos de publicação 
$year = date('Y'); 

$config = array(
        'home/contato' => array(
                array(
                        'field' => 'name',
                        'label' => 'name',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'address',
                        'label' => 'email',
                        'rules' => 'required|valid_email'
                ),
                array(
                        'field' => 'subject',
                        'label' => 'subject',
                        'rules' => 'required|callback_alphanum_accented'
                ),
                array(
                        'field' => 'message',
                        'label' => 'message',
                        'rules' => 'required'
                )
        ),
        // 'users/login' => array(
        //         array(
        //                 'field' => 'email',
        //                 'label' => 'email',
        //                 'rules' => 'required|callback_'
        //        ),
        //         array(
        //                 'field' => 'password',
        //                 'label' => 'password',
        //                 'rules' => 'required'       
        //         )
        // ),
        'users/register' => array(
                array(
                        'field' => 'first_name',
                        'label' => 'first name',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'last_name',
                        'label' => 'last name',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required|valid_email|callback_verify_email' //callback verifica se email já foi cadastrado anteriormente
                ),
                array(
                        'field' => 'phone',
                        'label' => 'phone',
                        'rules' => '' // arrumar regex 
                ),
                array(
                        'field' => 'institution',
                        'label' => 'institution',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'city',
                        'label' => 'city',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'country',
                        'label' => 'country',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'field_study',
                        'label' => 'field of study',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'password',
                        'label' => 'password',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'repassword',
                        'label' => 'rewrite password',
                        'rules' => 'required|matches[password]' // |callback_verificaPassword
                )
        ),
        'admin/login' => array(
                array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'required|valid_email|callback_email_check'
                ),
                array(
                        'field' => 'password',
                        'label' => 'password',
                        'rules' => 'required|callback_password_check['.$this->input->post('email').']'
                )
        ),
        'admin/set_article' => array(
                array(
                        'field' => 'title',
                        'label' => 'title',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'authors',
                        'label' => 'authors',
                        'rules' => 'required' 
                ),
                array(
                        'field' => 'publication_year',
                        'label' => 'year',
                        'rules' => 'required|is_natural|exact_length[4]|greater_than[1900]|less_than_equal_to['.$year.']'
                ),
                array(
                        'field' => 'doi',
                        'label' => 'doi',
                        'rules' => 'required|callback_check_doi'
                        //There is no defined limit eighter on the length of the DOI name, DOI prefix or DOI suffix.
                )
        ),
        'admin/article_set_edit' => array(
                array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'authors',
                        'label' => 'Authors',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'publication_year',
                        'label' => 'Year',
                        'rules' => 'required|is_natural|exact_length[4]|greater_than[1900]|less_than_equal_to['.$year.']'
                ),
                array(
                        'field' => 'doi',
                        'label' => 'DOI',
                        'rules' => 'required|callback_check_article'  //checar se doi está na tabela de artigos
                )
        ),        
        'admin/set_mutation' => array(
                array(
                        'field' => 'gene_name',
                        'label' => 'gene',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'synonymous',
                        'label' => 'synonymous',
                        'rules' => ''
                ),
                array(
                        'field' => 'type',
                        'label' => 'type',
                        'rules' => 'required|in_list[Deletion,Insertion,Missense,Nonsense,Splicing]' // =>verificar FS ins, FS del, Splice site, deleção heterozigota, termination, aberrant splicing, exons x~y deleted
                ),
                array(
                        'field' => 'inheritance',
                        'label' => 'inheritance',
                        'rules' => 'required|in_list[AD,AR,XLD,XLR]'
                ),
                array(
                        'field' => 'site',
                        'label' => 'site',
                        'rules' => 'required|alpha_numeric_spaces'
                ),
                array(
                        'field' => 'c_dna',
                        'label' => 'c_dna',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'protein',
                        'label' => 'protein',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'disease_name',
                        'label' => 'disease',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'country_name',
                        'label' => 'country',
                        'rules' => 'required|callback_check_country'
                ),
                array(
                        'field' => 'omim_phenotype',
                        'label' => 'omim',
                        'rules' => 'is_natural|exact_length[6]'
                ),
                array(
                        'field' => 'doi',
                        'label' => 'doi',
                        'rules' => 'required|callback_check_doi'
                )
        ),
        'admin/mutation_set_edit' => array(
                array(
                        'field' => 'gene_name',
                        'label' => 'Gene Symbol',
                        'rules' => 'required|callback_check_gene'  //checa se está na tabela de genes
                ),
                array(
                        'field' => 'type',
                        'label' => 'Type of mutation',
                        'rules' => 'required|in_list[Deletion,Insertion,Missense,Nonsense,Splicing]'  
                ),
                array(
                        'field' => 'inheritance',
                        'label' => 'Inheritance',
                        'rules' => 'required|in_list[AD,AR,XLD,XLR]'  
                ),
                array(
                        'field' => 'site',
                        'label' => 'Site',
                        'rules' => 'required|alpha_numeric_spaces' 
                ),
                array(
                        'field' => 'c_dna',
                        'label' => 'c_DNA',
                        'rules' => 'required' 
                ),
                array(
                        'field' => 'protein',
                        'label' => 'Protein',
                        'rules' => 'required' 
                ),
                array(
                        'field' => 'disease_name',
                        'label' => 'Disease',
                        'rules' => 'required|callback_alphanum_accented|callback_check_disease' //checar se está na tabela de doenças
                ),
                array(
                        'field' => 'country_name',
                        'label' => 'Country',
                        'rules' => 'required|callback_check_country' 
                ),
                array(
                        'field' => 'omim_phenotype',
                        'label' => 'OMIM',
                        'rules' => 'is_natural|exact_length[6]' 
                ),
                array(
                        'field' => 'reference',
                        'label' => 'Reference',
                        'rules' => 'required|callback_check_article' //checar se doi está na tabela de artigos
                )
        ),
        'submissions/submit' => array(
                array(
                        'field' => 'title',
                        'label' => 'Title',
                        'rules' => 'required|callback_alphanum_accented'
                ),
                array(
                        'field' => 'publication_year',
                        'label' => 'Year',
                        'rules' => 'required|is_natural|exact_length[4]|greater_than[1900]|less_than_equal_to['.$year.']' 
                ),
                array( 
                        'field' => 'doi',
                        'label' => 'DOI',
                        'rules' => 'required|callback_check_doi' 
                ),
                array( 
                        'field' => 'comment',
                        'label' => 'Comment',
                        'rules' => 'required|max_length[600]' //comprimento max -> alterar no BD, senão vai perder info
                )
        ),
        'submissions/change_password' => array(
                array(
                        'field' => 'password',
                        'label' => 'password',
                        'rules' => 'required|callback_verify_password' // callback para verificar se senha está correta
                ),
                array(
                        'field' => 'new_password',
                        'label' => 'new password',
                        'rules' => 'required' 
                ),
                array(
                        'field' => 'repeat_new_password',
                        'label' => 'repeat new password',
                        'rules' => 'required|matches[new_password]' 
                )
        ),
        'submissions/edit_data' => array(
                array(
                        'field' => 'first_name',
                        'label' => 'first name',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'last_name',
                        'label' => 'last name',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'phone',
                        'label' => 'phone',
                        'rules' => '' // numeric_spaces + '(', ')' e '-' // como fazer ? 
                ),
                array(
                        'field' => 'field_study',
                        'label' => 'field of study',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'institution',
                        'label' => 'institution',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'city',
                        'label' => 'city',
                        'rules' => 'required|callback_alpha_accented'
                ),
                array(
                        'field' => 'country',
                        'label' => 'country',
                        'rules' => 'required|callback_alpha_accented'
                )
        ),
        'admin/save_synonymous' => array(
                array(
                        'field' => 'synonymous',
                        'label' => 'synonymous',
                        'rules' => 'required|callback_check_synonymous' //verifica se o sinonimo já existe na tabela; retorna false se já existe
                )
        ),
        'admin/set_edit_synon'  => array(
                array(
                        'field' => 'synonymous',
                        'label' => 'synonymous',
                        'rules' => 'required|callback_check_synonymous'
                )
        )
);


/*
|--------------------------------------------------------------------------
| Error Delimiters
|--------------------------------------------------------------------------
|
| Definição das tags que irão delimitar todas as mensagens geradas 
| por erros de validação de formulário
|
*/
$config['error_prefix'] = '<p class="text-danger">';
$config['error_suffix'] = '</p>';
