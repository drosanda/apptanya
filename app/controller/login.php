<?php
class Login extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
  }
  public function index()
  {
    $data = $this->__init();

    if($this->user_login){
      redir(base_url('profil'));
      return false;
    }

    $this->setTitle('Login '.$this->config->semevar->site_suffix);
    $this->setDescription("Silakan login untuk bisa bertanya atau menjawab di ".$this->config->semevar->site_name);
    $this->setKeyword('Login');

    $this->putThemeContent("login/home",$data); //pass data to view
    $this->putJsContent("login/home_bottom",$data); //pass data to view

    $this->loadLayout("col-1",$data);
    $this->render();
  }
}
