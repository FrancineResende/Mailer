<?php
 
class Users_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
    }
 
    function set($data) {
        // return $this->db->insert('pessoas', $data);
    }
 
	function get() {
		$query = $this->db->get('mutations');
		if (empty($query))
			echo "nope";
		return $query->result();
	}
     
    function edit($data) {
        // $this->db->where('id', $data['id']);
        // $this->db->set($data);
        // return $this->db->update('pessoas');
    }
     
    function delete($id) {
        // $this->db->where('id', $id);
        // return $this->db->delete('pessoas');
    }

}
?>