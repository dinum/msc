<?php
/**
 * @author Dinum
 * Login Controller
 */
class Roles extends CI_Controller {
    public $permissions;
    public $super_permissions;
    public function __construct() {
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
        $this->load->model('TblRoles');
        $this->load->model('TblPermission');
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
        $datas = $this->TblRoles->get_all();
        $this->loadHeader();
        $this->load->view('internal/roles',array('datas'=>$datas,'msg'=>$msg));
        $this->loadFooter();
    }
    
    public function permission_check($permission,$rul){
        if (array_search($permission, $this->permissions)) {
            if(array_search($permission, $this->super_permissions)&&!$this->session->userdata('special_per')&&!$this->session->userdata('verify_user')){
                redirect(base_url().'verify_user'."/". base64_encode($rul));
            } else if(array_search($permission, $this->super_permissions)&&$this->session->userdata('verify_user')) {
                $this->session->set_userdata('special_per', true);
                $this->TblRoles->change_DB();
                $this->TblPermissionRoles->change_DB();
            }
        } else {
            redirect(base_url().'permission_denied');
        }
    }

    public function close_permissions(){
        $this->session->set_userdata('special_per', false);
        $this->TblRoles->change_DB();
        $this->TblPermissionRoles->change_DB();
    }
    
    public function add($msgid=""){
        $errors = array();
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        
        $this->permission_check('add_roles',base_url()."roles/add");
        
        $permissions = $this->TblPermission->get_all();
        if(isset($_POST['submitform'])){
            $name = $this->common->clean_text($this->input->post('name'));
                        
            $has_error = false;
            if(!$this->validator->validate_alpha($name)){
                $has_error = true;
                $errors['name'] = $this->messages->returnMessage(12);
                $logString = "Add Role | name validation fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
            
            if(!isset($_POST['permissions'])){
                $has_error = true;
                $errors['permissions'] = $this->messages->returnMessage(13);
                $logString = "Add Role | validation select fail";
                $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
            }
            
            if(!$has_error){
                $insert = array(
                    'name' => $name,
                    'added_date' => date('Y-m-d H:i:s')
                );
                
                $id = $this->TblRoles->insert_data($insert);
                
                if($id){                    
                    $perm = $this->input->post('permissions');            
                    foreach ($perm as $value) {
                        $insert2 = array(
                            'role_id' => $id,
                            'permission_id' => intval($value)
                        );
                        $this->TblPermissionRoles->insert_data($insert2);
                    }
                    $logString = "Add Role | Success | ID=".$id;
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                    redirect(base_url().'roles/5');
                } else {
                    $logString = "Add Role | Database Error";
                    $this->common->enter_log_logedUser($this->session->userdata('user_name'),$logString,$_POST,$this->session->userdata('user_id'));
                    redirect(base_url().'roles/6');
                }
                
            } 
        }
        $this->close_permissions();
        $this->loadHeader();
        $this->load->view('internal/add_role',array('msg'=>$msg,'error'=>$errors,'permissions'=>$permissions));
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
