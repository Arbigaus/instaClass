<?php
class Cidades extends Model{
  protected static $Table = 'cidades';

  public static function selecionarCidades(array $Places){
    $Query = "SELECT * FROM ".self::$Table." WHERE estados_cod_estados = :estado";
    Cidades::FullRead($Query, $Places);
    return Cidades::getResult();
  }
}

 ?>
