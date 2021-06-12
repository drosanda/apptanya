<?php
class TanyaJawab extends JI_Controller{

	public function __construct(){
    parent::__construct();
    $this->setTheme('front');
		$this->load('front/c_tanya_model','ctm');
	}
	public function index(){
    $data = $this->__init();

    if(!$this->user_login){
      redir(base_url('login'));
      die();
    }
		$this->setTitle('Buat pertanyaan baru atau jawab pertanyaan yang sudah ada '.$this->site_suffix);
		$this->setDescription('Buat pertanyaan baru atau jawab pertanyaan yang sudah ada di '.$this->config->semevar->site_name);
		$this->setKeyword($this->config->semevar->site_name);
		$this->putThemeContent("tanyajawab/home",$data);
		$this->putJsContent("tanyajawab/home_bottom",$data);
		$this->loadLayout("col-1",$data);
		$this->render();
	}
	public function detail($id){
    $data = $this->__init();

    if(!$this->user_login){
      redir(base_url('login'));
      die();
    }
    $id = (int) $id;
    if($id<=0){
      redir(base_url('notfound'));
      die();
    }
    $data['data'] = $this->ctm->getById($id);
    if(!isset($data['data']->id)){
      redir(base_url('notfound'));
      die();
    }

		$this->setTitle($data['data']->tanya.' '.$this->site_suffix);
		$this->setDescription($data['data']->tanya.' via '.$this->config->semevar->site_name);
		$this->setKeyword($this->config->semevar->site_name);
		$this->putThemeContent("tanyajawab/detail",$data);
		$this->putJsContent("tanyajawab/detail_bottom",$data);
		$this->loadLayout("col-1",$data);
		$this->render();
	}
}
