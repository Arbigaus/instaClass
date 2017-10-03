<?php
class Clients extends Model {

	protected static $Table = "tab_clients";

	public static function CountClients(){
		$Query = "SELECT COUNT(id_client) AS Total FROM tab_clients";
		Clients::FullRead($Query);
		return Clients::getResult()[0]['Total'];

	}
}