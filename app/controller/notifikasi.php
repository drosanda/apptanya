<?php
class Notifikasi extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
  }
  public function index()
  {
    $data = $this->__init();
    $this->setTitle('Notifikasi '.$this->config->semevar->site_suffix);
    $this->setDescription("Notifikasi");
    $this->setKeyword('Notifikasi');

    $this->putThemeContent("notifikasi/home",$data); //pass data to view
    $this->putJsContent("notifikasi/home_bottom",$data); //pass data to view
    $this->loadLayout("col-1",$data);
    $this->render();
  }
}
