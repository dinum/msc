<?php
/**
 * @author Dinum
 * Login Controller
 */
class Permissions extends CI_Controller {
    public $permissions;
    private $super_permissions;
    
    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('user_logged')) {
            redirect(base_url().'login/11');
        }
        if($this->session->userdata('user_logged')){
            $this->permissions = $this->session->userdata('permissions');
            $this->super_permissions = $this->session->userdata('high_permissions');
        } else {
            $this->permissions = array('home');
        }
                
        $this->load->model('TblPermission');
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
            $this->TblPermission->change_DB();
        
        $datas = $this->TblPermission->get_all();
        $this->loadHeader();
        $this->load->view('internal/permissions',array('datas'=>$datas,'msg'=>$msg));
        $this->loadFooter();
    }
    
    public function permission_check($permission,$rul){
        if (array_search($permission, $this->permissions)) {
            if(array_search($permission, $this->super_permissions)&&!$this->session->userdata('special_per')&&!$this->session->userdata('verify_user')){
                redirect(base_url().'verify_user'."/". base64_encode($rul));
            } else if(array_search($permission, $this->super_permissions)&&$this->session->userdata('verify_user')) {
                $this->session->set_userdata('special_per', true);
                $this->TblPermission->change_DB();
            }
        } else {
            redirect(base_url().'permission_denied');
        }
    }

    public function close_permissions(){
        $this->session->set_userdata('special_per', false);
        $this->TblPermission->change_DB();
    }

    public function add($msgid=""){
        $errors = array();
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        
        $this->permission_check('add_permissions',base_url()."permissions/add");
        
        if(isset($_POST['submitform'])){
            $name = $this->common->clean_text($this->input->post('name'));
            if(isset($_POST['special'])&&$_POST['special']==1){
                $special = 1;
            } else {
                $special = 0;
            }
            if($this->validator->validate_alpha($name)){
                $insert = array(
                    'permission' => $name,
                    'special_permission' => $special,
                    'created_date' => date('Y-m-d H:i:s')
                );
                
                $id = $this->TblPermission->insert_data($insert);
                
                if($id){
                    $logString = "Add Permission | Success | ID=".$id;
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                    redirect(base_url().'permissions/5');
                } else {
                    $logString = "Add Permission | Database Error";
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                    redirect(base_url().'permissions/6');
                }
                
            } else {
                $errors['name'] = $this->messages->returnMessage(12);
                $logString = "Add Permission | name validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
        }
        $this->close_permissions();
        $this->loadHeader();
        $this->load->view('internal/add_permissions',array('msg'=>$msg,'error'=>$errors));
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
