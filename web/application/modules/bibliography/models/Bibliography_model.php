<?php
 
class Bibliography_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function set($data) {
        //retorna 0 se inseriu
        //retorna 1 se deu problema na inserção
        //retorna 2 se não inseriu porque artigo já existe no BD

        $query = $this->db->select('doi')
                          ->from("Bibliography")
                          ->where('doi', $data['doi'])->get();
        if ($query->num_rows() != 0){
            // echo "Esse artigo já foi inserido no ImunoDB";
            return 2;
        }
        else {
            unset($data['submit']);
            if ($this->db->insert('Bibliography', $data))
                return 0;
            else
                return 1;
        }
    }
 
	function get() {
        $query = $this->db->select('title, authors, publication_year')
                          ->from('Bibliography')
                          ->where('title !=', NULL)->get();
        return $query->result();
	}


    function get_all($data){
        $query = $this->db->select('article_id, title, authors, publication_year, doi')
                              ->from('Bibliography')
                              ->like('title', $data['title'])
                              ->like('authors', $data['authors'])
                              ->like('doi', $data['doi'])
                              ->like('publication_year', $data['publication_year'])->get();
        return $query;
    }

    function get_by_id($id){
        $query = $this->db->select('article_id, title, authors, publication_year, doi')
                              ->from('Bibliography')
                              ->where('article_id', $id)->get();
        return $query->row();
    }



    // function edit($id) {
 //    $this->db->where('id', $id);
 //    $query = $this->db->get('bibliography');
 //    return $query->result();
    // }
     
    function edit($data) {
        $this->db->where('article_id', $data['article_id']);
        $this->db->set($data);
        return $this->db->update('Bibliography');
    }
     
    function delete($id) {
        $this->db->where('article_id', $id);
        return $this->db->delete('Bibliography');
    }
}

// $sql    = "SELECT * FROM users WHERE user_id = :user_id";
// $stmt   = $this->_db->prepare($sql);
// $result = $stmt->execute(array(":user_id" => $user_id));
// $user   = $stmt->fetch(PDO::FETCH_ASSOC);






