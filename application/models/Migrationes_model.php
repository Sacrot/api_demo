<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migrationes_model extends CI_Model {



public function migra_usuarios()
{
    if($this->db->query("CREATE TABLE `us1` ( `id` INT NOT NULL AUTO_INCREMENT , 
                                                                `tipo_usuario` VARCHAR(100) NOT NULL ,
                                                                `status` INT NOT NULL , 
                                                                `fecha_registro` VARCHAR(100) NOT NULL ,
                                                                `nombre` VARCHAR(950) NOT NULL , 
                                                                `sexo` INT NOT NULL ,
                                                                `fecha_nacimiento` VARCHAR(100) NOT NULL ,
                                                                `codigo_pais` VARCHAR(100) NOT NULL ,
                                                                `pais` VARCHAR(100) NOT NULL ,
                                                                `telefono_wp` VARCHAR(100) NOT NULL ,
                                                                `correo` VARCHAR(100) NOT NULL ,
                                                                   PRIMARY KEY (`id`)) ENGINE = InnoDB;")){
       

        $this->db->query("CREATE TABLE `us2` ( `id` INT NOT NULL AUTO_INCREMENT , 
                                            `id_us1` INT NOT NULL ,
                                            `usuario` VARCHAR(250) NOT NULL , 
                                            `password` VARCHAR(250) NOT NULL ,
                                            `fecha_login` VARCHAR(100) NOT NULL ,
                                            PRIMARY KEY (`id`)) ENGINE = InnoDB;");


        $this->db->query("CREATE TABLE `us3` ( `id` INT NOT NULL AUTO_INCREMENT , 
                                            `id_us1` INT NOT NULL ,
                                            `tk_correo` VARCHAR(250) NOT NULL , 
                                            `hash` VARCHAR(250) NOT NULL ,
                                            PRIMARY KEY (`id`)) ENGINE = InnoDB;");


        $this->db->query("CREATE TABLE `us4` ( `id` INT NOT NULL AUTO_INCREMENT , 
                                                `id_us1` INT NOT NULL ,
                                                `estado` VARCHAR(500) NOT NULL , 
                                                `descripcion` VARCHAR(900) NOT NULL ,
                                                `foto_perfil` VARCHAR(400) NOT NULL ,
                                                PRIMARY KEY (`id`)) ENGINE = InnoDB;");


        $this->db->query("alter table us2 add foreign key(id_us1) references us1(id)");
        $this->db->query("alter table us3 add foreign key(id_us1) references us1(id)");
        $this->db->query("alter table us4 add foreign key(id_us1) references us1(id)");
    
     //   alter table admin_crmventas.usuarios_empresa add foreign key(id_empresa) references admin_crmventas.mi_empresa(id_mi_empresa);


                return true;


    }else{
        return false;
    }
}

public function drop_tables()
{
    $this->db->query("DROP TABLE ` usuarios_ap1");
}




}
