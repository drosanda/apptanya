<?php
class Daftar extends JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('front');
  }
  public function index()
  {
    $data = $this->__init();
    $this->setTitle('Daftar '.$this->config->semevar->site_suffix);
    $this->setDescription("Daftarkan diri anda sekarang juga untuk dapat menikmati fasilitas bimbingan online gratis di ".$this->config->semevar->site_name);
    $this->setKeyword('Daftar');

    $this->putThemeContent("daftar/home",$data); //pass data to view
    $this->putJsContent("daftar/home_bottom",$data); //pass data to view

    $this->loadLayout("col-1",$data);
    $this->render();
  }
}
