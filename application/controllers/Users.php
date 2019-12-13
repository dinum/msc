<?php
/**
 * @author Dinum
 * Login Controller
 */
class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url().'login/11');
        }
        $this->load->model('TblRoles');
        $this->load->model('TblPermission');
        $this->load->model('Tblusers');
        $this->load->model('TblUserRoles');
        $this->load->model('TblPermissionRoles');
        $this->load->library('messages');
        $this->load->library('common');        
        $this->load->library('validator');
    }
    
    public function index($msgid=""){
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        $datas = $this->Tblusers->get_all();
        $this->loadHeader();
        $this->load->view('internal/users',array('datas'=>$datas,'msg'=>$msg));
        $this->loadFooter();
    }
    
    public function add($msgid=""){
        $errors = array();
        $fData = array();
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        $roles = $this->TblRoles->get_all();
        if(isset($_POST['submitform'])){            
            $fData['name'] = $this->common->clean_text($this->input->post('name'));
            $fData['email'] = $this->common->clean_text($this->input->post('email'));
            $fData['status'] = $this->common->clean_text($this->input->post('status'));
            $fData['uname'] = $this->common->clean_text($this->input->post('uname'));
            $pw = $this->common->clean_text($this->input->post('pw'));
            $rpw = $this->common->clean_text($this->input->post('rpw'));
                        
            $has_error = false;
            if(!$this->validator->validate_alpha($fData['name'])){
                $has_error = true;
                $errors['name'] = $this->messages->returnMessage(12);
                $logString = "Add User | name validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
                        
            if(!$this->validator->validate_alpha($fData['uname'])){
                $has_error = true;
                $errors['uname'] = $this->messages->returnMessage(15);
                $logString = "Add User | user name validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            } else {
                $unameCount = $this->Tblusers->get_by_filter(array('username'=>$fData['uname']));
                if(isset($unameCount)&& $unameCount && sizeof($unameCount)>0){
                    $has_error = true;
                    $errors['uname'] = $this->messages->returnMessage(16);
                    $logString = "Add User | user name Already available";
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                }
            }
                        
            if(!$this->validator->validate_pw($pw)){
                $has_error = true;
                $errors['pw'] = $this->messages->returnMessage(17);
                $logString = "Add User | password validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
            
            if(!$this->validator->validate_pw($rpw)|| $pw!=$rpw){
                $has_error = true;
                $errors['rpw'] = $this->messages->returnMessage(18);
                $logString = "Add User | Confirm password validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
            
            if(!$this->validator->validate_email($fData['email'])){
                $has_error = true;
                $errors['email'] = $this->messages->returnMessage(14);
                $logString = "Add User | email name validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
            
            if(!isset($_POST['roles'])){
                $has_error = true;
                $errors['roles'] = $this->messages->returnMessage(13);
                $logString = "Add User | Role select fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
            
            if(!$has_error){
                $insert = array(
                    'name' => $fData['name'],
                    'email' => $fData['email'],
                    'username' => $fData['uname'],
                    'password' => md5($pw),
                    'status' => $fData['status'],
                    'added_date' => date('Y-m-d H:i:s')
                );
                
                $id = $this->Tblusers->insert_data($insert);
                
                if($id){                    
                    $rls = $this->input->post('roles');            
                    foreach ($rls as $value) {
                        $insert2 = array(
                            'user_id' => $id,
                            'role_id' => intval($value)
                        );
                        $this->TblUserRoles->insert_data($insert2);
                    }
                    $logString = "Add User | Success | ID=".$id;
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                    redirect(base_url().'users/5');
                } else {
                    $logString = "Add User | Database Error";
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                    redirect(base_url().'users/6');
                }
                
            } 
        }
        
        $this->loadHeader();
        $this->load->view('internal/add_user',array('msg'=>$msg,'error'=>$errors,'roles'=>$roles,'fData'=>$fData));
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
