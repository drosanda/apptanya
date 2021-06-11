<?php
class C_Notif_Model extends SENE_Model{
	var $tbl = 'c_notif';
	var $tbl_as = 'cn';
	public function __construct(){
		parent::__construct();
	}
	public function getAll($keyword='',$b_user_id=''){
		$this->db->from($this->tbl,$this->tbl_as);
		return $this->db->get();
	}
	public function countAll($keyword='',$b_user_id=''){
    $this->db->select_as('COUNT(*)','total',0);
		$this->db->from($this->tbl,$this->tbl_as);
		$d = $this->db->get_first();
    if(isset($d->total)) return $d->totall
    return 0;
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
}
