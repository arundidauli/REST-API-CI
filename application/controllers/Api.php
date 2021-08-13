<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Api extends API_Controller
{
   
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('UserModel');
    }
    
    
    
    
    public function get_staff(){
        header('Content-Type:application/json');
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ( $check_auth_client== true){
		         $params = json_decode(file_get_contents('php://input'), TRUE);
		         $data = $this->UserModel->get_all_staff($params);
		         
		         echo json_encode($data);
		    }
		}
        
    }

     

     public function get_student(){
        header('Content-Type:application/json');
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ( $check_auth_client== true){
		        
		        $params = json_decode(file_get_contents('php://input'), TRUE);
		        $data = $this->UserModel->get_student($params);
		        echo json_encode($data);
		    }
		}
        
    }


    public function create_user(){
       header('Content-Type:application/json');
        $method = $_SERVER['REQUEST_METHOD'];
       
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ( $check_auth_client== true){
		        
		          $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['email'] == "" || $params['password'] == "") {

                        $data = array(
                            'status' => FALSE,
                            'message' => 'Username, Email & Password can\'t empty',
                        );

                    }else if($params['username']==""){
                        $data = array(
                            'status' => FALSE,
                            'message' => 'Username can\'t empty',
                        );
                        
                    }else{
                       $data = $this->UserModel->insert_user($params);
                      
                    }
                echo json_encode($data); 
                    

		    }
		}
      
    }

    public function user_login(){
        
        header('Content-Type:application/json');
         $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ( $check_auth_client== true){
		        
		        $params = json_decode(file_get_contents('php://input'), TRUE);
                     if ($params['email'] == "" || $params['password'] == "") {

                        $data = array(
                            'status' => FALSE,
                            'message' => 'Email & Password can\'t empty',
                        );

                    } else {
                        $data = $this->UserModel->login($params);
                    }
                    echo json_encode($data);
		    }
		}
      

    }



public function employeelogin(){
        
        header('Content-Type:application/json');
         $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ( $check_auth_client== true){
		        
		        $params = json_decode(file_get_contents('php://input'), TRUE);
                     if ($params['employee_id'] == "" || $params['password'] == "") {

                        $data = array(
                            'status' => FALSE,
                            'message' => 'Employee Id & Password can\'t empty',
                        );

                    } else {
                        $data = $this->UserModel->staff_login($params);
                    }
                    echo json_encode($data);
		    }
		}
      

    }



    public function get_users(){
        header('Content-Type:application/json');
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ($check_auth_client== true){
		        
		       	$data = $this->UserModel->get_all_staff();
		         
		         echo json_encode($data);
		    }
		}

    }


    public function update_user(){
       header('Content-Type:application/json');
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ($check_auth_client== true){
		        
		        $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['id'] == "") {

                        $data = array(
                            'status' => FALSE,
                            'message' => 'Id can\'t empty',
                        );

                    } else {
                        $data = $this->UserModel->user_update($params);
                    }
		         
		         echo json_encode($data);
		    }
		}

    }
    
     public function delete_user(){
       header('Content-Type:application/json');
        $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			 echo json_encode(array('status' => 400,'message' => 'Unknown Method or Bad Request'));
		} else {
		    $check_auth_client = $this->UserModel->check_auth_client();
		  
		    if ($check_auth_client== true){
		        
		        $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['id'] == "") {

                        $data = array(
                            'status' => FALSE,
                            'message' => 'Id can\'t empty',
                        );

                    } else {
                        $data = $this->UserModel->user_delete($params);
                    }
		         
		         echo json_encode($data);
		    }
		}

    }


}