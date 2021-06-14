<?php
class Profil extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
    $this->load('front/b_user_model',"bum");
  }
  public function index()

  {
    $data = array();
    $data = $this->__init();

    if(!$this->user_login){
      redir(base_url('login'));
      return false;
    }

    $this->setTitle('Profil - '.$this->config->semevar->site_name);
    $this->setDescription("Halaman Profil ".$this->config->semevar->site_name);
    $this->setKeyword('Profil');

    $this->putThemeContent("profil/home",$data); //pass data to view
    $this->putJsContent("profil/home_bottom",$data); //pass data to view
    $this->loadLayout("col-1",$data);
    $this->render();
  }
}
