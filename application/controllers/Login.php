<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
            if($this->input->server('REQUEST_METHOD') === "POST"){

                // PROCESO DE LOGIN
                
                // PROCESO DE LOGIN

				



                $data = array("solicitud" => $this->input->server('REQUEST_METHOD'), "i" => $this->input->server(););
                $this->output->set_content_type('application/json')->set_output(json_encode($data));            
            }else{
                http_response_code(403);
            }

//        print_r(json_encode($data));

      //  http_response_code(403);
        //$this->load->view('welcome_message');
	}
}
