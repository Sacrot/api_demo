<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coneccion extends CI_Controller {

function __construct(){
	    parent::__construct();
	    $this->load->database();
	 //	$this->load->model('Migrationes_model');
  	}
	public function index()
    {
        // controles para los COORS
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
            if($this->input->server('REQUEST_METHOD') === "GET"){
                $data = array("solicitud" => $this->input->server('REQUEST_METHOD'), "ip" => $this->input->ip_address());
                $this->output->set_content_type('application/json')->set_output(json_encode($data));            
            }else{
                http_response_code(403);
            }
        }
}
