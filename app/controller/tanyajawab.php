<?php
class TanyaJawab extends SENE_Controller{

	public function __construct(){
    parent::__construct();
		$this->setTheme('front');
	}
	public function index(){
		$data = array();
		$this->setTitle('Buat pertanyaan baru atau jawab pertanyaan yang sudah ada '.$this->site_suffix);
		$this->setDescription('Buat pertanyaan baru atau jawab pertanyaan yang sudah ada di '.$this->config->semevar->site_name);
		$this->setKeyword($this->config->semevar->site_name);
		$this->putThemeContent("tanyajawab/home",$data);
		$this->putJsContent("tanyajawab/home_bottom",$data);
		$this->loadLayout("col-1",$data);
		$this->render();
	}
}
