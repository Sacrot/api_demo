<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {


	function __construct()
	{
    parent::__construct();
    $this->load->database();
    $this->load->model('Validacion_model');
    $this->load->model('Usuarios_model');
  }

    public function index()
	{
            if($this->input->server('REQUEST_METHOD') === "POST"){

                // PROCESO DE LOGIN
                
                // PROCESO DE LOGIN





                $data = array("solicitud" => $this->input->server('REQUEST_METHOD'));
                $this->output->set_content_type('application/json')->set_output(json_encode($data));            
            }else{
                http_response_code(403);
            }

//        print_r(json_encode($data));

      //  http_response_code(403);
        //$this->load->view('welcome_message');
    }
    
public function registro_usuario(){
    if($this->input->server('REQUEST_METHOD') === "POST"){

        //Verificar correo
            $array_validacion = array('correo' => $_POST['correo']);
            $tabla = "us1";
            $v = $this->Validacion_model->Validacion_campo($array_validacion, $tabla);
            if($v){

               $v2 = $this->Validacion_model->Validacion_campo_2($array_validacion, $tabla);

                $response = array("mensaje" => "Este correo ya esta en uso, cambialo por otro y continua ". $v2, "tipo" => "alert", "titulo" => "Correo invalido");
                $this->output->set_content_type('application/json')->set_output(json_encode($response));                     
                return false;
            }else{
                $pass = $_POST['contra_1'];
                $datos_registro = array('nombre' => $_POST['nombre'],
                                        'sexo' => $_POST['genero'],
                                        'status' => 1,
                                        'tipo_usuario' => 1,
                                        'pais' => $_POST['pais'],
                                        'codigo_pais' => $_POST['codigo_pais'],
                                        'fecha_nacimiento' => $_POST['fecha_n'],
                                        'fecha_registro' => date("y-m-d"),
                                        "correo" => $_POST['correo']);
                $registro = $this->Usuarios_model->registro($datos_registro, $pass);
                if($registro){
                    $response = array("mensaje" => "Excelente! Hemos enviado un codigo a su correo", "tipo" => "success", "titulo" => "Verificación de correo");
                    $this->output->set_content_type('application/json')->set_output(json_encode($response));        
                    return true;
                }else{
                    $response = array("mensaje" => "Por favor intentalo de nuevo", "tipo" => "alert", "titulo" => "Oh! a ocurrido un error");
                    $this->output->set_content_type('application/json')->set_output(json_encode($response));        
                    return false;
                }
            }
    }else{
        http_response_code(403);
    }
}


public function sendemail(){
		

    $res = $this->MiCorreo_model->buscar_mi_correo();

    $host = "mail.urbanhub.mx";
     $puerto = "465";
     $usuario = "info@urbanhub.mx";
     $clave = "coworking2019";
     
     /*
     $host = $res[0]['servidor_smtp'];
     $puerto = $res[0]['puerto'];
     $usuario = $res[0]['usuario'];
     $clave = $res[0]['clave'];
     */

    /*
            print_r($res[0]['servidor_smtp']);
    print_r("<br>");
            print_r($res[0]['puerto']);
    print_r("<br>");
            print_r($res[0]['usuario']);
    print_r("<br>");
            print_r($res[0]['clave']);

            die();
    */
        $this->load->library('email');



        $config['protocol'] = 'smtp';

        $config['smtp_host'] = $host;

        $config['smtp_user'] = $usuario;

        $config['smtp_pass'] = $clave;

        $config['smtp_port'] = $puerto;

        $config['charset'] = 'utf-8';

        $config['mailtype'] = 'html';

        $config['wordwrap'] = TRUE;

        $config['newline']    = "\r\n";



        $this->email->initialize($config);

        
        $this->email->from($res[0]['usuario']);

        $this->email->to("sacrotzenil@gmail.com", "Frank");
        $this->email->subject("demo de email");

        $this->email->message("demo de email desde CI");
        /*return*/ $this->email->send();

        print_r("envio de correo");	
}

public function enviar(){
    $config = array(
       'protocol' => 'smtp',
       'smtp_host' => 'smtp.googlemail.com',
       'smtp_user' => 'skuldafn.solstheim@gmail.com', //Su Correo de Gmail Aqui
       'smtp_pass' => 'sacrot12', // Su Password de Gmail aqui
       'smtp_port' => '465',
       'smtp_crypto' => 'ssl',
       'mailtype' => 'html',
       'wordwrap' => TRUE,
       'charset' => 'utf-8'
       );
       $this->load->library('email', $config);
       $this->email->set_newline("\r\n");
       $this->email->from('skuldafn.solstheim@gmail.com');
       $this->email->subject('Asunto del correo');
       $this->email->message('Hola desde correo');
       $this->email->to('sacrotzenil@gmail.com');
       if($this->email->send(FALSE)){
           echo "enviado<br/>";
           echo $this->email->print_debugger(array('headers'));
       }else {
           echo "fallo <br/>";
           echo "error: ".$this->email->print_debugger(array('headers'));
       }
  }

}



