<?php
class Cari extends SENE_Controller{

	public function __construct(){
    parent::__construct();
		$this->setTheme('front');
	}
	public function index(){
		$data = array();
		$this->setTitle('Cari pertanyaan atau jawaban '.$this->site_suffix);
		$this->setDescription('Cari pertanyaan atau jawaban di '.$this->config->semevar->site_name);
		$this->setKeyword($this->config->semevar->site_name);
		$this->putThemeContent("cari/home",$data);
		$this->putJsContent("cari/home_bottom",$data);
		$this->loadLayout("col-1",$data);
		$this->render();
	}
}
