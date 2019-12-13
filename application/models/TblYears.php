<?php
/**
 * @author Dinum
 * Login Controller
 */
class TblYears extends CI_Model {
    
    //put your code here
    private $table;
    private $key_id;
    public function __construct() {
        parent::__construct();
        $this->table = "table_years";
        $this->key_id = "id";
    }
    public function get_all() {
        $query = $this->db->get($this->table);
        return $query->result();
    }
    function get_by_ID($id) {
        $this->db->where($this->key_id, $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    function get_by_filter($filterdata = array(),$orderby=array(),$groupby=array(),$limit="",$offset=0){
		if(isset($filterdata)&&is_array($filterdata)&&sizeof($filterdata)!=0){
            foreach ($filterdata as $search_index => $search_val) {
               //echo $search_index."->".$search_val."<br>";
               if (strstr($search_index, '?')) {
                    $where = str_replace('?',$search_val,$search_index);
                    $this->db->where($where);
               } else {
                    $this->db->where($search_index,$search_val);
               }
            }
        }
        if(isset($groupby)&&is_array($groupby)&&sizeof($groupby)!=0){
            $this->db->group_by($groupby);
        }
        if(isset($orderby)&&is_array($orderby)&&sizeof($orderby)!=0){
            foreach ($orderby as $orderkey => $ordervalue) {
                $this->db->order_by($orderkey.' '.$ordervalue);
            }
        }
        if(isset($limit)&&!empty($limit)&&is_int($limit)){
            $this->db->limit($limit,$offset);
        }
		$query = $this->db->get($this->table);
		if (isset($query)&&$query->num_rows()>0) {
                return $query->result();
        } else {
                return FALSE;
        }
	}
	function get_all_limit($limit){
		$query = $this->db->get($this->table,$limit);
		return $uery->result();
	}
	function insert_data($data){
		$inserid = $this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	function update_data($data,$where){
		return $this->db->update($this->table, $data, $where);
	}
	function delete_data($where){
		return $this->db->delete($this->table,$where); 
	} 
}
