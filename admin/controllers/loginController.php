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
				$dados_form['passwd'] = md5($dados_form['passwd']);
				// Fazer algo
				if(Helpers::isMail($dados_form['email'])):
					// TODO: Cadastro do usuario
					if(Users::Create($dados_form)):
						$dados['return'] = $this->ajaxSuccess("Cadastro efetuado.");
					else:
						$dados['return'] = $this->ajaxDanger("Ocorreu algum erro, favor entrar em contato.");
					endif;
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

// TODO: Função para login do sistema.
	public function login(){
	  $dados = [];

	  $dados_form = filter_input_array(INPUT_POST, FILTER_SANITIZE_MAGIC_QUOTES);
	  if(!in_array("",$dados_form)):
				if(Helpers::isMail($dados_form['email'])):
		    $return = Users::doLogin($dados_form['email'],$dados_form['passwd']);
		    if($return === 1):
		      $dados['return'] = $this->ajaxWarning('<a href="'.BASEADMIN.'/login/cadastro">clique aqui para cadastrar</a>.','E-mail não encontrado.');
		    elseif($return === 2):
		      $dados['return'] = $this->ajaxError("Favor conferir a senha.","Senha Incorreta");
		    elseif($return === 3):
		      $dados['redirect'] = ["", 0];
		    else:
		      $dados['return'] = $this->ajaxError("Erro");
		    endif;
		  else:
		    $dados['return'] = $this->ajaxWarning("Favor preencher todos os campos.");
			endif;
	  endif;

	  echo json_encode($dados);
	  exit();
	}

// TODO: Função para logout do sistema.
	public function logout(){
		// if(empty($_SESSION['id']) || !isset($_SESSION['id'])):
			session_destroy();
			header("Location: ".BASEADMIN."/login");
			exit();
		// endif;

	}

}
