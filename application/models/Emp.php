<?php 

class Emp extends CI_Model {
    public function __construct (){
        parent::__construct ();
  
     }

    function getAll(){

        $q  = $this->db->query("SELECT * from ci4table");

        if($q->num_rows() > 0) {

            foreach ($q->result() as $row) {
                $data [] = $row;
            }
            return $data;
        }

    }

    public function addrecord($data){
        $this->db->insert('ci4table',$data);
       }   
    public function deleteRecord($id){

         $this->db->query("DELETE FROM ci4table WHERE id= $id");
        
    }

    public function updateRecord($username,$password,$id){
    
         $this->db->query("UPDATE  ci4table SET name='$username' , password =$password WHERE id= $id ");    
       
    }

    // public function uploadImage($imageFile){
    //     $this -> db ->query("INSERT INTO 'imagetable' ('imageFile') VALUES ('imageFile')");
    // }

    public function uploadImage($data){
        // $this->db->insert('imagetable',$data);
        $this ->db ->query("INSERT INTO `imagetable` ( `imageFile`) VALUES ( '$data')");
       }  
}