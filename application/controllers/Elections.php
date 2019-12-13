<?php

/**
 * @author Dinum
 * Login Controller
 */
class Elections extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('TblElectionCatogories');
        $this->load->library('messages');
        $this->load->library('common');
    }
    
    public function index($msgid=""){
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        $elections = $this->TblElectionCatogories->get_all_active_records();
        $this->loadHeader();
        $this->load->view('internal/elections',array('elections'=>$elections));
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
