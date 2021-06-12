<?php
/**
 * Controller class for throw 404 response code
 *
 * @package SemeFramework
 * @since SemeFramework 1.0
 *
 * @codeCoverageIgnore
 */
class NotFound extends JI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        header("HTTP/1.0 404 Not Found");
        $data = $this->__init();
    		$this->loadLayout("notfound",$data);
    		$this->render();
    }
}
