<?php
/**
 * @author Dinum
 * Home Controller
 */
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->loadHeader();
        $this->load->view('external/home');
        $this->loadFooter();
    }

    public function loadHeader(){
        $this->load->view('template/header');
        $this->load->view('template/leftmenu');
    }
      
    public function loadFooter(){
        $this->load->view('template/footer');
    }
}
