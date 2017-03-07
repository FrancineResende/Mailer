<?php
 
class Mutations_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    function set($data) {
    /*inserir mutação no BD*/
    //retorna 0 se inseriu ok
    //retorna 1 se deu problema na inserção
    //retorna 2 se artigo não existe no BD

  /*-------------------------------Pegar IDs---------------------------------*/

        /*pega id do artigo relacionado - deve já existir na tabela, obrigatoriamente*/
        $query = $this->db->select('b.article_id')
                          ->from('Bibliography as b')
                          ->where('b.doi', $data['doi'])
                          ->get();
        if (!$query->num_rows())
            return 2;
        
        $result = $query->row();
        $article_id = $result->article_id; 


        /*pega id do gene*/
        $query = $this->db->select('g.gene_id')
                          ->from('Genes as g')
                          ->where('g.gene_name', $data['gene_name'])
                          ->get();                          
        /*insere o gene, caso ele ainda não exista no BD, e pega o id da inserção*/
        if (!$query->num_rows()){
            $gen = array('gene_name' => $data['gene_name']);
            if (!$this->db->insert('Genes', $gen))
                return 1;
            $gene_id = $this->db->insert_id();
        }
        else {
            $result  = $query->row();
            $gene_id = $result->gene_id;
        }
      

        /*pega id da doença - mesmo tratamento dos anteriores se não existir na tabela*/
        $query = $this->db->select('d.disease_id')
                         ->from('Diseases as d')
                         ->where('d.disease_name', $data['disease_name'])
                         ->get();
        if ($query->num_rows() == 0){
            $dis = array('disease_name' => $data['disease_name']);
            if (!$this->db->insert('Diseases', $dis))
                return 1;
            $disease_id = $this->db->insert_id();
        }
        else {
          $result     = $query->row();
          $disease_id = $result->disease_id;
        }       


        /*pega id do país - deve existir no BD para ser aceito*/
        $query = $this->db->select('c.country_id')
                          ->from('Countries as c')
                          ->where('c.country_name', $data['country_name'])
                          ->get();
        $result     = $query->row();
        $country_id = $result->country_id;

/*------------------Terminou de pegar IDs--------------------*/


        /*inserir informações na tabela Mutations e pegar ID gerado*/
        $mut = array('gene_id'      => $gene_id,
                     'type'         => $data['type'], 
                     'inheritance'  => $data['inheritance'], 
                     'site'         => $data['site'], 
                     'c_dna'        => $data['c_dna'], 
                     'protein'      => $data['protein'],
                     'disease_id'   => $disease_id,
                     'country_id'   => $country_id,
                     'omim_phenotype' => $data['omim_phenotype'],
                     'article_id'   => $article_id);
        if (!$this->db->insert('Mutations', $mut))
            return 1;
        return 0;
     }


  function insert_synon($data){
      return $this->db->insert('Synonyms', $data);
  }

  function get_synon($gene_id){
    $query = $this->db->select('synon_id, synonymous')
                      ->from('Synonyms')
                      ->where('gene_id', $gene_id)
                      ->get();
    return $query->result();
  }

  function verify_synon($synon){
  //verifica se o sinônimo já existe no BD
    $query = $this->db->select('synonymous')
                      ->from('Synonyms')
                      ->where('synonymous', $synon)
                      ->get();
    if (!$query->num_rows())
      return false;
    else
      return true;
  }

  function edit_synon($synon_id, $data){
    $this->db->where('synon_id', $synon_id);
    $this->db->set($data);
    return $this->db->update('Synonyms');
  }
 
	function get($get) {     
    $query = $this->db->select('g.gene_name, m.inheritance, m.type, m.site, m.c_dna, m.protein, m.article_id, d.disease_name, c.country_name, m.omim_phenotype, b.authors, b.publication_year')
    ->from('Mutations as m, Genes as g, Bibliography as b ,Countries as c, Diseases as d')
    // ->where('p.mutation_id = m.mutation_id')
    ->where('m.gene_id = g.gene_id')
    ->where('m.article_id = b.article_id')
    ->where('m.disease_id = d.disease_id')
    ->where('m.country_id = c.country_id')
    ->like('g.gene_name', $get['name']) 
    ->like('m.type', $get['type'])
    ->like('m.inheritance', $get['inheritance'])
    ->like('d.disease_name', $get['disease'])
    ->like('c.country_name', $get['origin'])
    ->get();

    return $query->result();

	}

  function get_all($data){
    $query = $this->db->select('m.mutation_id, m.disease_id, m.country_id, m.omim_phenotype, g.gene_id, g.gene_name, m.type, m.inheritance, m.site, m.c_dna, m.protein, m.article_id, b.authors, b.publication_year, b.doi, d.disease_name, c.country_name')
    ->from('Mutations as m, Genes as g, Bibliography as b ,Countries as c, Diseases as d')
    // ->where('p.mutation_id = m.mutation_id')
    ->where('m.gene_id = g.gene_id')
    ->where('m.article_id = b.article_id')
    ->where('m.disease_id = d.disease_id')
    ->where('m.country_id = c.country_id')
    ->like('g.gene_name', $data['gene_name'])
    ->like('m.type', $data['type'])
    ->like('m.inheritance', $data['inheritance'])
    ->like('m.site', $data['site'])
    ->like('m.c_dna', $data['c_dna'])
    ->like('m.protein', $data['protein'])
    ->like('d.disease_name', $data['disease_name'])
    ->like('c.country_name', $data['country_name'])
    ->like('m.omim_phenotype', $data['omim_phenotype'])
    ->like('b.doi', $data['reference'])
    ->get();

    return $query;
  }

  function get_by_id($id){
    $query = $this->db->select('p.mutation_id, m.disease_id, m.country_id, m.omim_phenotype, g.gene_id, g.gene_name, m.type, m.inheritance, m.site, m.c_dna, m.protein, m.article_id, b.doi,  d.disease_name, c.country_name')
    ->from('Mutations as m, Genes as g, Bibliography as b ,Countries as c, Diseases as d')
    // ->where('p.mutation_id = m.mutation_id')
    ->where('m.gene_id = g.gene_id')
    ->where('m.article_id = b.article_id')
    ->where('m.disease_id = d.disease_id')
    ->where('m.country_id = c.country_id')
    ->where('m.mutation_id', $id)
    ->get();

    return $query->row();
  }

  function get_genes(){
    $query = $this->db->select('gene_id, gene_name')
                      ->from('Genes')
                      ->get();
    return $query->result();
  }

  function get_genes_with_synon(){
    $query1 = $this->db->select('gene_id')
                      ->distinct()
                      ->from('Synonyms')
                      ->get();

    $result = $query1->result();
    foreach ($result as $row) {
      $query2 = $this->db->select('gene_name')
                        ->from('Genes')
                        ->where('gene_id', $row->gene_id)
                        ->get();
      $query2 = $query2->row();                  
      $gen[$row->gene_id] = $query2->gene_name;
    }
    return $gen;
  }
     
  
  function edit($data) {
  //pegar id do novo gene
    $query = $this->db->select('gene_id')
                      ->from('Genes')  
                      ->where('gene_name', $data['gene_name'])
                      ->get();
    $query = $query->row();
    $gene_id = $query->gene_id;

    //pegar id da nova referência
    $query = $this->db->select('article_id')
                      ->from('Bibliography')
                      ->where('doi', $data['reference'])
                      ->get();
    $query = $query->row();
    $article_id = $query->article_id;

    //pegar id da nova doença
    $query = $this->db->select('disease_id')
                      ->from('Diseases')  
                      ->where('disease_name', $data['disease_name'])
                      ->get();
    $query = $query->row();
    $disease_id = $query->disease_id;

    //pegar id do novo país
    $query = $this->db->select('country_id')
                      ->from('Countries')  
                      ->where('country_name', $data['country_name'])
                      ->get();
    $query = $query->row();
    $country_id = $query->country_id;


    $setMut = array('gene_id' => $gene_id, 'type' => $data['type'], 'inheritance' => $data['inheritance'], 'site' => $data['site'], 'c_dna' => $data['c_dna'], 'protein' => $data['protein'], 'disease_id' => $disease_id, 'country_id' => $country_id, 'omim_phenotype' => $data['omim_phenotype'], 'article_id' => $article_id );
    $this->db->where('mutation_id', $data['mutation_id']);
    $this->db->set($setMut);
    if ($this->db->update('Mutations')) 
      return true;
    return false; 
  }

  function delete($id) {
      $this->db->where('mutation_id', $id);
      return $this->db->delete('Mutations');
  }

  function delete_synon($id){
    $this->db->where('synon_id', $id);
    return $this->db->delete('Synonyms');
  }

}
?>