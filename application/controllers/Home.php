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
        $this->load->model('Tblusers');
        $this->load->model('TblgetData');
        $this->load->library('messages');
        $this->load->library('common');
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
    
    public function verify_user($url="",$msgid="") {
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        if (isset($_POST['verify'])) {
            $psword = $this->common->clean_text($this->input->post('psword'));
            $url = $this->common->clean_text($this->input->post('backurl'));
            if(!empty($psword)){
                               
                $userData = $this->Tblusers->get_by_ID($this->session->userdata('user_id'));
                
                if (isset($userData[0]) && $userData[0]->id != '' && $userData[0]->password == md5($psword)) {
                    $this->session->set_userdata('verify_user', true);
                    redirect($url);
                } else {
                    $msg = $this->messages->returnMessage(10);
                }
            } else {
                $msg = $this->messages->returnMessage(20);
            }
        }
        
        $this->loadHeader();
        $this->load->view('internal/verify_user',array('url'=> base64_decode($url),'msg'=>$msg));
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
