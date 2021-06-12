<?php
class Notifikasi extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
    $this->load('front/d_notifikasi_model',"dnm");
  }
  public function index()
  {
    $data = array();
    $data = $this->__init();

    if(!$this->user_login){
      redir(base_url('login'));
      die();
    }

    $data['notifs'] = $this->dnm->getByUserId($data['sess']->user->id);
    $this->setTitle('Notifikasi - '.$this->config->semevar->site_name);
    $this->setDescription("Halaman Notifikasi ".$this->config->semevar->site_name);
    $this->setKeyword('Notifikasi');

    $this->putThemeContent("notifikas/home",$data); //pass data to view
    $this->putJsContent("notifikas/home_bottom",$data); //pass data to view
    $this->loadLayout("col-1",$data);
    $this->render();
  }
}
