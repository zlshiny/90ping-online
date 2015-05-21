<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Individual extends CI_Controller {

    public function index(){
        $this->load->view('individual.php');
    }
}