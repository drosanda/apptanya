<?php
class D_Notifikasi_Model extends SENE_Model{
	var $tbl = 'd_notifikasi';
	var $tbl_as = 'dn';
	
	public function __construct(){
		parent::__construct();
	}
	public function getAll(){
		$this->db->from($this->tbl,$this->tbl_as);
		return $this->db->get();
	}
	public function getById($id){
		$this->db->where('id',$id);
		$this->db->from($this->tbl,$this->tbl_as);
		return $this->db->get_first();
	}
	public function set($di=array()){
		$this->db->insert($this->tbl,$di);
		return $this->db->last_id;
	}
	public function update($id,$du=array()){
		$this->db->where('id',$id);
		return $this->db->update($this->tbl,$du);
	}
	public function del($id){
		$this->db->where("id",$id);
		return $this->db->delete($this->tbl);
	}
	public function getByUserId($b_user_id,$is_read=''){
		$this->db->where('b_user_id',$b_user_id);
		$this->db->from($this->tbl,$this->tbl_as);
		return $this->db->get();
	}
	public function countByUserId($b_user_id,$is_read=''){
    $this->db->select_as("COUNT(*)",'total',0);
    $this->db->from($this->tbl,$this->tbl_as);
    $this->db->where('b_user_id',$b_user_id);
		if(strlen($is_read) == 1) $this->db->where('is_read',$is_read);
		$d = $this->db->get_first();
    if(isset($d->total)) return $d->total;
    return 0;
	}
}
