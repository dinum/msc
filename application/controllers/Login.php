<?php
/**
 * @author Dinum
 * Login Controller
 */
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Tblusers');
        $this->load->library('messages');
        $this->load->library('common');
    }
    
    public function index($msgid=""){
        if ($this->session->userdata('user_logged')) {
            redirect(base_url());
        } 
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        $this->loadHeader();
        $this->load->view('internal/login',array('msg'=>$msg));
        $this->loadFooter();
    }
    
    public function submit(){
        $errors = false;
        if ($this->session->userdata('user_logged')) {
            redirect(base_url());
        } 
        if (isset($_POST['submitButton'])) {
            $uname = $this->common->clean_text($this->input->post('uname'));
            $psword = $this->common->clean_text($this->input->post('psword'));
            if(!empty($uname)&&!empty($psword)){
                $this->session->unset_userdata('user_logged');
                $this->session->unset_userdata('user_name');
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('user_email');
                
                $userFilters = array(
                    'username' => $uname,
                    'status' => 1
                );
                
                $userData = $this->Tblusers->get_by_filter($userFilters);
                if (isset($userData[0]) && $userData[0]->id != '') {
                    if($userData[0]->password == md5($psword)){
                         $sessionArray = array(
                            'user_logged' => true,
                            'user_name' => $userData[0]->name,
                            'user_id' => $userData[0]->id,
                            'user_email' => $userData[0]->email
                        );
                        $this->session->set_userdata($sessionArray);
                        $logString = "User Login -  / USER - " . $userData[0]->username . " ID - " . $userData[0]->id . " / Date " . date("Y-m-d H:i:s");
                        $this->common->enter_log($userData[0]->username,$logString,array());
                        redirect(base_url());
                    } else {                        
                        $logString = "Login Failed | Incorrect Password | User Name=".$uname;
                        $this->common->enter_log($userData[0]->username,$logString,array());
                        redirect(base_url().'login/10');
                    }                       
                } else {
                    $logString = "Login Failed | No Record In Database | User Name=".$uname;
                    $this->common->enter_log('',$logString,array());
                    redirect(base_url().'login/10');
                }        
                
            } else {
                $logString = "Login Failed | Empty Username OR Password | User Name=".$uname;
                $this->common->enter_log('',$logString,array());
                redirect(base_url().'login/10');
            }
        }
    }
    
    public function logout() {
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url());
        }
        $logString = "User LogOut -  / USER - " . $this->session->userdata('user_name') . " ID - " . $this->session->userdata('user_id') . " / Date " . date("Y-m-d H:i:s");
        $this->common->enter_log($this->session->userdata('user_name'),$logString,array());
        $this->session->unset_userdata('user_logged');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        redirect(base_url());
    }
    
    public function loadHeader(){
        $this->load->view('template/header_full');
    }
      
    public function loadFooter(){
        $this->load->view('template/footer_full');
    }
}
