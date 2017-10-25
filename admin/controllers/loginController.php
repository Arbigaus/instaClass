<?php
class loginController extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array();

		// $dados_form = filter_input_array(INPUT_POST, FILTER_SANITIZE_MAGIC_QUOTES);
		// if (isset($dados_form['user_email']) && !empty($dados_form['user_email'])){
		//
		// 	if(Users::logar($dados_form)){
		// 		header("Location: ".BASEADMIN);
		// 		exit();
		// 	}
		//
		// }

		$this->loadView('login/login', $data);

	}

	public function cadastro(){
		$data = [];

		$this->loadview('login/cadastro', $data);
	}
}
