<?php
class Jawab extends JI_Controller
{
  public $email_send = 0;
  public $is_log = 0;
  public function __construct()
  {
    parent::__construct();
    $this->lib("seme_email");
    //$this->lib("seme_log");
    $this->load("api_web/b_user_model",'bum');
    $this->load("api_web/c_tanya_model",'ctm');
    $this->load("api_web/d_notifikasi_model",'dnm');
  }
  public function index(){
    $data = array();
    $this->status = 404;
    $this->message = "Not found";
    $this->__json_out($data);
  }
  public function pertanyaan($id){
    $s = $this->__init();
    $data = array();

    if(!$this->user_login){
      $this->status = 403;
      $this->message = "Harus login";
      $this->__json_out($data);
      return false;
    }

    $id = (int) $id;
    if($id<=0){
      $this->status = 550;
      $this->message = "ID tidak valid";
      $this->__json_out($data);
      return false;
    }
    $data['data'] = $this->ctm->getById($id);
    if(!isset($data['data']->id)){
      $this->status = 551;
      $this->message = "Data dengan ID '".$id."' tidak ditemukan";
      $this->__json_out($data);
      return false;
    }

    if(strlen($data['data']->jawab)>=3){
      $this->status = 552;
      $this->message = "Pertanyaan telah dijawab";
      $this->__json_out($data);
      return false;
    }

    $du = array();
    $du['b_user_id_jawab'] = $s['sess']->user->id;
    $du['tgl_jawab'] = 'NOW()';
    $du['jawab'] = strip_tags(trim($this->input->post('jawab')));
    if(strlen($du['jawab'])<=2){
      $this->status = 553;
      $this->message = "jawaban terlalu pendek";
      $this->__json_out($data);
      return false;
    }

    $res = $this->ctm->update($id,$du);
    if($res){
      $this->status = 200;
      $this->message = "Jawaban berhasil disimpan ke database";

      $di = array();
      $di['b_user_id'] = $s['sess']->user->id;
      $di['c_tanya_id'] = $id;
      $di['isi'] = 'Telah dijawab! "'.$data['data']->tanya.'"';
      $di['is_read'] = 0;
      $this->dnm->set($di);
    }else{
      $this->status = 554;
      $this->message = "Gagal menyimpan jawaban ke database";
    }

    $this->__json_out($data);
  }
}
