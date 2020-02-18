<?php
/**
 * @author Dinum
 * Home Controller
 */
class Home extends CI_Controller {
    
    public $permissions;
    
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('user_logged')){
            $this->permissions = $this->session->userdata('permissions');
        }
    }

    public function index() {
        $this->loadHeader();
        $this->load->view('external/home');
        $this->loadFooter();
    }
    
    public function not_found() {
        $this->loadHeader();
        $this->load->view('external/not_found');
        $this->loadFooter();
    }
    
    public function permission_denied() {
        $this->loadHeader();
        $this->load->view('external/permission_denied');
        $this->loadFooter();
    }

    public function loadHeader(){
        $this->load->view('template/header');
        $this->load->view('template/leftmenu',array('permissions'=>$this->permissions));
    }
      
    public function loadFooter(){
        $this->load->view('template/footer');
    }
}
