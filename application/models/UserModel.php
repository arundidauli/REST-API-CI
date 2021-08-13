<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {


var $key  = "12345"; 
  
 
public function check_auth_client(){
        header('Content-Type:application/json');
        $auth_key  = $this->input->get_request_header('Auth-Key');
        if($auth_key == $this->key){
            return true;
        } else {
            echo json_encode(array('status' => 401,'message' => 'Unauthorized.'));
        }
}



public function insert_user($data){

    	$this->db->where('email',$data['email']);
		$result = $this->db->get('users');
		if ($result->num_rows() > 0) {
			return array('status' => FALSE,'message' => 'User email already exist');
		}else{
		    
			$this->db->insert('users',$data);
			$this->db->where('email',$data['email']);
            $query = $this->db->get('users');
			
            return array('status' => TRUE,'message' => 'User register successfully.','data' => $query->result_array());
		}
}




public function login($data){
      $this->db->select('*');
      $this->db->from('staff');
      $this->db->where('employee_id',$data['employee_id']);
      $this->db->where('password',$data['password']);

      $query = $this->db->get();

      if ($query->num_rows() > 0) {

        return array('status' => TRUE,
        	'message' => 'User Login Successfully',
        	'data' => $query->result_array()
        );
      }else{
    	 return array('status' => FALSE,
        	'message' => 'User Email and Paaword not match!',
        	'data' => $query->result_array()
        );
      }
    }

    public function staff_login($data){
      $this->db->select('*');
      $this->db->from('staff');
      $this->db->where('employee_id',$data['employee_id']);
      $this->db->where('password',$data['password']);

      $query = $this->db->get();

      if ($query->num_rows() > 0) {

        return array('status' => TRUE,
            'message' => 'Login Successfully',
            'data' => $query->result_array()
        );
      }else{
         return array('status' => FALSE,
            'message' => 'Wrong Employee Id or Paaword!',
            'data' => $query->result_array()
        );
      }
    }



    public function user_update($data){
     
      $this->db->where('id',$data['id']);
      $this->db->update('users',$data);

      
   	  $this->db->where('id',$data['id']);
      $query = $this->db->get('users');

      if ($query->num_rows() > 0) {

        return array('status' => TRUE,
        	'message' => 'User Update Successfully',
        	'data' => $query->result_array()
        );
      }else{
    	 return array('status' => FALSE,
        	'message' => 'User Id Not Found!',
        	'data' => $query->result_array()
        );
      }


    }
    
    public function user_delete($data){
      $this->db->where('id',$data['id']);
     
      $query = $this->db->get('users');
    
      if ($query->num_rows() > 0) {
         $this->db->where('id',$data['id']);
         $this->db->delete('users');
      
      
        return array('status' => TRUE,
        	'message' => 'User Delete Successfully',
        	'data' => $query->result_array()
        );
      }
     
     else{
    	 return array('status' => FALSE,
        	'message' => 'User Id Not Found!',
        	'data' => $query->result_array()
        );
     }


    }





public function get_all_staff($params){
      $this->db->select('*');
      $this->db->from('staff');

    if ($params['employee_id']!='') {

          $this->db->where('employee_id',$params['employee_id']);
          
    }

      $query = $this->db->get();

     if ($query->num_rows() > 0) {

        return array('status' => TRUE,
        	'message' => 'Staff fetch Successfully',
        	'data' => $query->result_array()
        );
    }else{
    	 return array('status' => FALSE,
        	'message' => 'Staff Not Found!',
        	'data' => $query->result_array()
        );
    }


    }



    public function get_student($params){

      $this->db->select('*');
      $this->db->from('students');


      if ($params['roll_no']!='') {

          $this->db->where('roll_no',$params['roll_no']);
          
      }

     $query = $this->db->get();

     if ($query->num_rows() > 0) {

        return array('status' => TRUE,
            'message' => 'Students fetch Successfully',
            'data' => $query->result_array()
        );
    }else{
         return array('status' => FALSE,
            'message' => 'Students Not Found!',
            'data' => $query->result_array()
        );
    }

 }

}

?>