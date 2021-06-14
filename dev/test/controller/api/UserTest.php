<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once $GLOBALS['SEMEDIR']->kero_sine.'SENE_MySQLi_Engine.php';
require_once $GLOBALS['SEMEDIR']->kero_sine.'SENE_Model.php';
require_once $GLOBALS['SEMEDIR']->kero_sine.'SENE_Controller.php';
require_once $GLOBALS['SEMEDIR']->app_core.'ji_controller.php';
require_once $GLOBALS['SEMEDIR']->app_controller.'api_web/user.php';
require_once $GLOBALS['SEMEDIR']->app_model.'api_web/b_user_model.php';

final class UserTest extends SeneTestCase
{
  public function __construct(){
    parent::__construct();
  }
  /**
  * @uses SENE_MySQLi_Engine
  * @uses SENE_Model
  * @uses SENE_Controller
  * @covers JI_Controller
  * @covers B_user_Model
  * @covers User
  */
  public function testIndex(): void
  {
    $exp = array('status'=>400,'message'=>'Harus Login','data'=>array());
    $jexp = json_encode($exp, JSON_PRETTY_PRINT);
    $this->expectOutputString($jexp);
    $calc = new User();
    $calc->index();
  }
  /**
  * @uses SENE_MySQLi_Engine
  * @uses SENE_Model
  * @uses SENE_Controller
  * @covers JI_Controller
  * @covers B_user_Model
  * @covers User
  */
  public function testIndexLoggedIn(): void
  {
    $exp = array('status'=>200,'message'=>'Berhasil','data'=>array());
    $jexp = json_encode($exp, JSON_PRETTY_PRINT);
    $this->expectOutputString($jexp);
    $calc = new User();
    $calc->user_login = 1;
    $calc->index();
  }
}
