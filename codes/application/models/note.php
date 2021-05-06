<?php
class note extends CI_Model {


    function create($note){
        $query = "INSERT INTO posts (description, created_at, updated_at) VALUES (?,?,?)";
        $values = array($note['description'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }
    
    function all(){
        return $this->db->query("SELECT * FROM posts")->result_array();
    }

}
?>

