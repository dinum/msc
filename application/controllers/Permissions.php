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
        if($this->session->userdata('special_per')){            
            $active_group = "";
            $this->db->reconnect();
        } else {
            $this->current_db  = $this->load->database('read_only');
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
        $datas = $this->TblPermission->get_all();
        $this->loadHeader();
        $this->load->view('internal/permissions',array('datas'=>$datas,'msg'=>$msg));
        $this->loadFooter();
    }
    
    public function add($msgid=""){
        $errors = array();
        if(isset($msgid)&&$msgid != ""){
    		$msg = $this->messages->returnMessage($msgid);
    	} else {
    		$msg = "";
    	}
        
        if (array_search('add_permissions', $this->permissions)) {
            
        } else {
            
        }
        
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
