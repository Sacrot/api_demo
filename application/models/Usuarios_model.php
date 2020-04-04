<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_model extends CI_Model {

    public function registro($datos_registro, $pass)
    {

        if($this->db->insert("us1", $datos_registro)){
           $id_usuario = $this->db->insert_id();
            $data_u2 = array('id_us1' => $id_usuario,
                             'usuario' => "usuario-".$this->generarCodigo(3).$id_usuario,
                             'password' => sha1($pass),
                             'fecha_login' => date("Y-m-d"));
            $this->db->insert("us2", $data_u2);
            $data_u3 = array('id_us1' => $id_usuario,
                            'tk_correo' => $this->generarCodigo(6),
                            'hash' => $this->generarCodigo(15));                            
            $this->db->insert("us3", $data_u3);

            $data_u4 = array('id_us1' => $id_usuario,
                            'estado' => '',
                            'descripcion' => '',
                            'foto_perfil' => 'foto_inicial.jpg');                            
            $this->db->insert("us4", $data_u4);
            
            
            
            // ENVIO DE EMAIL CON TOKEN
            if($this->enviar_tk($datos_registro['correo'], $data_u3['tk_correo'])){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function generarCodigo($longitud) {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;

    }
       public function enviar_tk($correo, $tk){
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
           $this->email->subject('PHOTODONE verificación');
           $this->email->message('Este es tu codigo para continuar en PHOTODONE -> '.$tk);
           $this->email->to($correo);
           if($this->email->send(FALSE)){
            return true;
        }else {
            return false;  
        }
      }
    
}

