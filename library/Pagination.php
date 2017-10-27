<?php
// TODO: Classe de Paginação geral.
class Pagination extends Model {
  private static $table;
  private static $maxPerPage = 2;
  private static $page = 'page';
  private static $startPage;
  private static $maxLinks = 2;
  private static $query = "SELECT * FROM ";
  private static $queryCount = null;
  private static $places = array();

// Seters e Geters da classe Pagination.
  public static function setTable(string $setTable){
    if(!is_string($setTable)){
      throw new Exception("<< O NOME DA TABELA DEVE SER DO TIPO STRING >>");
    }else{
      self::$table = $setTable;
    }
  }

  private static function getTable(){
    return self::$table;
  }

  public static function setMaxPerPage(int $max){
    if(!is_int($max)){
      throw new Exception("<< O VALOR PARA O MAXIMO POR PAGINA DEVE SER UM INTEIRO >>");
    }else{
      self::$maxPerPage = $max;
    }
  }

  private static function getMaxPerPage(){
    return self::$maxPerPage;
  }

  public static function setPage(string $namePage){
    if(!is_string($namePage)){
      throw new Exception("<< O NOME DO PAGINADOR DEVE SER DO TIPO STRING >>");
    }else{
      self::$page = $namePage;
    }
  }

  private static function getPage(){
    return self::$page;
  }

  public static function setMaxLinks(int $max){
    if(!is_int($max)){
      throw new Exception("<< O VALOR PARA O MÁXIMO DE LINKS DEVE SER UM INTEIRO >>");
    }else{
      self::$maxLinks = $max;
    }
  }

  private static function getMaxLinks(){
    return self::$maxLinks;
  }

  private static function getPager() {
    $pager = filter_input(INPUT_GET, self::getPage());
    return (isset($pager)?(int)$pager:1);
  }

  public static function setPlaces(array $placesValues){
    self::$places = $placesValues;
  }

  private static function getPlaces(){
    return self::$places;
  }

// Funções gerais da classe Pagination

  public static function createPagination($where = null, $orderBy = null){
    // $inicio = (($max_pag * $pagina) - $max_pag);
    self::$startPage = ((self::getMaxPerPage() * self::getPager()) - self::getMaxPerPage());
    self::$startPage = (self::$startPage >= 1 ? self::$startPage : 0);

    if($where == null && $orderBy == null){
      //  "SELECT * FROM tab_clients ORDER BY id_client ASC LIMIT $inicio,$max_pag";
      self::$query .= self::getTable()." LIMIT ".self::$startPage.",".self::getMaxPerPage();
      Pagination::FullRead(self::$query);
    }elseif($where == null && $orderBy != null){
      self::$query .= self::getTable()." {$orderBy} LIMIT ".self::$startPage.",".self::getMaxPerPage();
      Pagination::FullRead(self::$query);
    }elseif($where != null && $orderBy == null){
      self::$query .= self::getTable()." {$where} LIMIT ".self::$startPage.",".self::getMaxPerPage();
      Pagination::FullRead(self::$query,self::getPlaces());
    }elseif($where != null && $orderBy != null){
      self::$query .= self::getTable()." {$where} {$orderBy} LIMIT ".self::$startPage.",".self::getMaxPerPage();
      Pagination::FullRead(self::$query,self::getPlaces());
    }
    return Pagination::getResult();

  }  // Fim do método Create Pagination

  public static function createLinks(){
    $links = array();
    self::$queryCount = str_replace("*","COUNT(*) AS Total",self::$query);
    // if(strrpos(self::$queryCount,"ORDER")){
    //   self::$queryCount = substr(self::$queryCount, 0,strpos(self::$queryCount,"ORDER"));
    // }else{
      self::$queryCount = substr(self::$queryCount, 0,strpos(self::$queryCount,"LIMIT"));
    // }

    if(strrpos(self::$queryCount, "WHERE")){
      Pagination::FullRead(self::$queryCount, self::getPlaces());
    }else{
      Pagination::FullRead(self::$queryCount);
    }

  		$total_registro = Pagination::getResult()[0]['Total'];
  		$total_paginas = ceil($total_registro / self::getMaxPerPage());

      if(self::getPager() > $total_paginas || self::getPager() < 1){
        header("Location: ".self::returnPageValid(self::getPage())."?".self::getPage()."=".$total_paginas);
      }else{

      	if($total_registro > self::getMaxPerPage()){
  			if(self::getPager() > 1){
  				$links[] = '<ul class="pagination"><li><a href="?'.self::getPage().'=1">Primeira Página</a></li>';
        // $links[] = self::getPage()."=1";
  			}else{
          $links[] = '<ul class="pagination">';
        }
  			// TODO: Imprimindo paginação, duas antes da página atual.
  			for($i = self::getPager() - self::getMaxLinks(); $i <= self::getPager() - 1; $i++){
  				if($i >= 1){
  					$links[] = '<li><a href="?'.self::getPage().'='.$i.'">'.$i.'</a></li>';
            // $links[] = self::getPage()."=".$i;
  				}
  			}
  			// Imprimir página atual
  			$links[] = '<li class="active"><span>'.self::getPager().'</span>';
        // $links[] = self::getPager();

  			for ($i = self::getPager() + 1; $i <= self::getPager() + self::getMaxLinks() ; $i++) {
  				if($i <= $total_paginas){
  					$links[] = '<li><a href="?'.self::getPage().'='.$i.'">'.$i.'</a></li>';
            // $links[] = self::getPage().'='.$i;
  				}
  			}
  			// Imprimir última página
  			if(self::getPager() != $total_paginas){
  				$links[] = '<li><a href="?'.self::getPage().'='.$total_paginas.'">Última Página</a></li><ul>';
        }else{
          $links[] = '<ul>';
        }
      }

    }
    return $links;
  } // Fim do método createLinks

  private static function returnPageValid($name_pager){
    $URL = $_SERVER['HTTP_HOST'];
    $url = "http://".$URL.$_SERVER['REQUEST_URI'];

    $clearpage = $url;
    $clearpage = substr($clearpage, 0, strpos($clearpage,"?".$name_pager));
    return $clearpage;

  }// Fim do método Return Page Valid


} // Fim da Classe Pagination
