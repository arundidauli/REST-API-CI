# Simple-Rest-Api-in-CI-3

### REST API IN CI -3 With Header Validation

### Database Name

Database: `codeigniter-api-application`


### Table structure for table `users`

````
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

`````

###  Model   `UserModel.php`

```````
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

```````
}

?>


###  Conntroller  	`User_Api.php`

`````
<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Api extends API_Controller
{
   
    public function __construct() {
        
        parent::__construct();
        
        $this->load->model('UserModel');
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

}

?>

``````








