<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
require APPPATH . '/libraries/RESTController.php';
require APPPATH . '/libraries/Format.php';
class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        if ($_SERVER['PHP_AUTH_USER'] == "root" && $_SERVER['PHP_AUTH_PW'] == "12345") {
            return true;
        }

        $this->error();
        exit;
    }

    private function error() {
        echo json_encode(["status" => "Bad authentication"]);
    }
    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }


    
}