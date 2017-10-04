<?php
class cidadesController extends Controller {
  public function index(){
    $data = [];

    Estado::ReadAll();
    $data['lista_estados'] = Estado::getResult();

    $this->loadTemplate('view_cidades',$data);
  }

  public function buscaCidades(){
    $data = [];
    $estado = filter_input(INPUT_POST, 'estado');
    $Places = ["estado" => $estado];
    $data ['lista_cidades'] = Cidades::selecionarCidades($Places);

    echo json_encode($data);
  }

  public function addCidades(){
    $data = [];

    $form_dados = filter_input_array(INPUT_POST,FILTER_SANITIZE_MAGIC_QUOTES);

    echo json_encode($form_dados);
  }

}
