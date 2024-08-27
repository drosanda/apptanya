<?php

class Jawab extends \JI_Controller
{
	public $email_send = 0;
	public $is_log = 0;

	public function __construct()
	{
		parent::__construct();
		$this->lib("seme_email");
		//$this->lib("seme_log");
		$this->load("api_web/b_user_model", 'bum');
		$this->load("api_web/c_tanya_model", 'ctm');
		$this->load("api_web/d_jawab_model", 'djm');
		$this->load("api_web/d_notifikasi_model", 'dnm');
    $this->load('front/e_voting_model', 'evm');
	}

	public function index()
	{
		$data = array();
		$this->status = 404;
		$this->message = "Not found";
		$this->__json_out($data);
	}

	public function pertanyaan($c_tanya_id)
	{
		$session = $this->initialize_data();
		$data = array();

		if(!$this->user_login) {
			$this->status = 403;
			$this->message = "Harus login";
			$this->__json_out($data);
			return false;
		}

		$c_tanya_id = (int) $c_tanya_id;
		if($c_tanya_id <= 0) {
			$this->status = 550;
			$this->message = "ID tidak valid";
			$this->__json_out($data);
			return false;
		}
		$data['data'] = $this->ctm->getById($c_tanya_id);
		if(!isset($data['data']->id)) {
			$this->status = 551;
			$this->message = "Data dengan ID tersebut tidak ditemukan";
			$this->__json_out($data);
			return false;
		}
		
		$already_answered = $this->djm->already_answered($c_tanya_id, $session['sess']->user->id);
		if (isset($already_answered->id)) {
			$this->status = 552;
			$this->message = "Pertanyaan ini telah anda dijawab";
			$this->__json_out($data);
			return false;
		}

		$di = array();
		$di['c_tanya_id'] = $c_tanya_id;
		$di['b_user_id_jawab'] = $session['sess']->user->id;
		$di['created_at'] = 'NOW()';
		$di['jawaban'] = htmlspecialchars(trim($this->input->post('jawab')));
		if(strlen($di['jawaban']) <= 2) {
			$this->status = 553;
			$this->message = "jawaban terlalu pendek";
			$this->__json_out($data);
			return false;
		}

		$d_jawaban_id = $this->djm->set($di);
		if($d_jawaban_id) {
			$this->status = 200;
			$this->message = "Terimakasih sudah ikut menjawab";
			$this->update_jawaban_count($c_tanya_id);
			$this->create_notification($c_tanya_id, $data['data']->b_user_id_tanya);
			$this->set_best_answer($c_tanya_id);
		} else {
			$this->status = 554;
			$this->message = "Gagal menyimpan jawaban ke database";
		}

		$this->__json_out($data);
	}

	private function set_best_answer($c_tanya_id)
	{
    $djm = new \stdClass();
    $best_answer = $this->evm->best($c_tanya_id);
    if (isset($best_answer->d_jawab_id)) {
      $djm = $this->djm->id($best_answer->d_jawab_id);
    }
    if (isset($djm->jawaban)) {
      $this->ctm->set_best_answer($c_tanya_id, $djm->b_user_id_jawab, $djm->jawaban);
    }

	  return true;
	}

	private function create_notification($c_tanya_id, $b_user_id_tanya)
	{
	  $di = array();
	  $di['b_user_id'] = $b_user_id_tanya;
	  $di['c_tanya_id'] = $c_tanya_id;
	  $di['isi'] = 'Pertanyaan kamu udah ada yang jawab!';
	  $di['is_read'] = 0;

	  return $this->dnm->set($di);
	}

	private function update_jawaban_count($id)
	{
	  $du = array();
	  $du['jawaban_count'] = $this->djm->count_jumlah_jawaban($id);
	  return $this->ctm->update($id, $du);
	}
}
