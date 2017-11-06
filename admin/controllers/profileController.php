<?php
class profileController extends Controller {

  public function construct(){
    parent::__construct();
  }

  public function index(){
    $data = array();
    $data['user'] = Users::getLoggedUser($_SESSION['id']);

    $this->loadTemplate('user/profile',$data);
  }

}
