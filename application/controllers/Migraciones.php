<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migraciones extends CI_Controller {

function __construct(){
	    parent::__construct();
	    $this->load->database();
	 	$this->load->model('Migrationes_model');
  	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            if($this->input->server('REQUEST_METHOD') === "GET"){


                    if($this->Migrationes_model->migra_usuarios()){
                        $migracion_status = "EXITO";
                    }else{
                        $migracion_status = "FALLIDO";
                    }

                $data = array("solicitud" => $this->input->server('REQUEST_METHOD'), "migracion" => $migracion_status);
                $this->output->set_content_type('application/json')->set_output(json_encode($data));            
            }else{
                http_response_code(403);
            }

//        print_r(json_encode($data));

      //  http_response_code(403);
        //$this->load->view('welcome_message');
	}
}
