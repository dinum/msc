<?php
/**
 * @author Dinum
 * Login Controller
 */
class TblgetData extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    function getPermissionsByUser($id) {
        $this->db->select("tblpermission.permission,tblpermission.special_permission");
        $this->db->from("user_roles");
        $this->db->join("permission_roles", "user_roles.role_id = permission_roles.role_id");
        $this->db->join("tblpermission", "permission_roles.permission_id = tblpermission.id");
        $this->db->where("user_roles.user_id", $id);
        $query = $this->db->get();
        if (isset($query) && $query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }
}
