<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Validacion_model extends CI_Model {

    public function Validacion_campo($data, $tabla)
    {
       $this->db->where($data);
     $validacion = $this->db->get($tabla);
            if(count($validacion->result()) > 0){
                return true;
            }else{
                return false;
            }
    }
    public function Validacion_campo_2($data, $tabla)
    {
       $this->db->where($data);
     $validacion = $this->db->get($tabla);
            if(count($validacion->result()) > 0){
               
               return $validacion->row()->nombre;
               
                // return $validacion->row();
            }else{
                return false;
            }
    }
}
