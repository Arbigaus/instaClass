<?php
class loginController extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array();

		$this->loadView('login/login', $data);

	}

	public function cadastro(){
		$data = [];

		$this->loadview('login/cadastro', $data);
	}

	public function add(){
		$dados = [];

		$dados_form = filter_input_array(INPUT_POST, FILTER_SANITIZE_MAGIC_QUOTES);
		if(!in_array("",$dados_form)):
			if($dados_form['v_passwd'] != $dados_form['passwd']):
				$dados['return'] = $this->ajaxSuccess("Senhas não conferem, favor digitar novamente.");
			else:
				unset($dados_form['v_passwd']);
				// Fazer algo
				if(Helpers::isMail($dados_form['email'])):
					// TODO: Cadastro do usuario
					if(Users::Create($dados_form)):
						$dados['return'] = $this->ajaxSuccess("Cadastro efetuado.");
					endif;
						$dados['return'] = $this->ajaxDanger("Ocorreu algum erro, favor entrar em contato.");

				else:
					$dados['return'] = $this->ajaxWarning("E-mail inválido.");
				endif;
			endif;
		else:
			$dados['return'] = $this->ajaxWarning("Favor preencher todos os campos.");
		endif;

		echo json_encode($dados);
		exit();
	}

}
