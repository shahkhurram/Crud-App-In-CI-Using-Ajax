<?php 

class Car_model extends CI_model{

    public function create($formArray){
        $this->db->insert('car_models',$formArray);
        $id=$this->db->insert_id();
        return $id;

    }
    public function all(){
       $result= $this->db->order_by('id','asc')->get('car_models')->result_array();
       return $result;
    }
    public function getRow($id){
        $this->db->where('id',$id);
        $res=$this->db->get('car_models');
        return $res->row();
        
    }
    public function update($id,$formArray){
        $this->db->where('id',$id);
        $this->db->update('car_models',$formArray);
        return $id;

    }
    public function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('car_models');

    }
}

?>