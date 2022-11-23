<?php
class liveedit_model extends CI_model{
    function load_post(){
        $query = $this->db->get('belanja');
        $this->db->order_by('id', 'desc');
        return $query->result_array();
    }
    function insert($data){
        $this->db->insert('belanja', $data);
    }
    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('belanja', $data);
    }
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('belanja');
    }
}
?>