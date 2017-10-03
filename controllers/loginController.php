<?php
class loginController extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array();

		$dados_form = filter_input_array(INPUT_POST, FILTER_SANITIZE_MAGIC_QUOTES);
		if (isset($dados_form['user_email']) && !empty($dados_form['user_email'])){

			if(Users::logar($dados_form)){
				header("Location: ".BASE);
				exit();
			}

		}

		$this->loadView('login', $data);

	}
}
