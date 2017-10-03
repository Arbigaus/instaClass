<?php
class clientsController extends Controller{

	public function index(){
		$data = [];

		Clients::ReadAll();
		$data['list_client'] = Clients::getResult();

		$this->loadTemplate("clients_list",$data);
	}

	public function add(){
		$data = array();

		$this->loadTemplate("clients_add",$data);

	}
// TODO: Adicionar via Ajax.
	public function add_ajax(){
		$data = array();

		$dados_form = filter_input_array(INPUT_POST,FILTER_SANITIZE_MAGIC_QUOTES);


		if(isset($dados_form['client_name']) && !empty($dados_form['client_name'])):
			$dados_form['client_genre'] = ucfirst($dados_form['client_genre']);

			Clients::Create($dados_form);
			if(Clients::getResult()):
				$data['return'] = ["alert-success","Cadastro de <b>{$dados_form['client_name']}</b> efetuado com sucesso!<p></p>"];
				$data['count_client'] = Clients::CountClients();
				// $data['redirect'] = ["clients", 3200];
			else:
				$data['return'] = ["alert-danger","Erro ao cadastrar!"];
			endif;
		else:
			$data['return'] = ["alert-warning","Preencha todos os campos!"];
		endif;

		echo json_encode($data);

	}

	public function edit($id){
		$data = array();

		Clients::ReadByField("id_client", $id);
		$data['list_client'] = Clients::getResult();


		$this->loadTemplate("clients_edit",$data);
	}

	public function edit_ajax(){
		$data = array();

		$dados_form = filter_input_array(INPUT_POST,FILTER_SANITIZE_MAGIC_QUOTES);
		if(isset($dados_form['client_name']) && !empty($dados_form['client_name'])):
			$dados_form['client_genre'] = ucfirst($dados_form['client_genre']);

			Clients::Update($dados_form,"id_client",$dados_form['id_client']);
			if(Clients::getResult()):
				$data['return'] = ["alert-success","Cadastro de <b>{$dados_form['client_name']}</b> atualizado com sucesso!<p></p>"];
				$data['redirect'] = ["clients", 2000];
			else:
				$data['return'] = ["alert-danger","Erro ao cadastrar!"];
			endif;
		else:
			$data['return'] = ["alert-warning","Preencha todos os campos!"];
		endif;

		echo json_encode($data);
	}

	public function del($id){
		$data = array();

		if(isset($_POST['id'])):
			$id = $_POST['id'];
			Clients::Delete("id_client",$id);
			if(Clients::getResult()):
				$data['return'] = ["alert-success","O Cliente foi removido com sucesso!"];
				$data['count_client'] = Clients::CountClients();
			endif;
		else:
			$data['return'] = ["alert-danger","ID de registro não encontrado para exclusão!="];

		endif;

		echo json_encode($data);

	}

	// public function del($id){
	// 	Clients::Delete("id_client",$id);

	// 	if(Clients::getResult()):
	// 		header("Location: ".BASE."/clients");
	// 	endif;
	// }


}
