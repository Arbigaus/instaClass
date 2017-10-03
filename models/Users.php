<?php
class Users extends Model {

	protected static $Table = "tab_users";

	public static function logar($dados_form){
		$Query = "SELECT * FROM tab_users WHERE user_email = :user_email AND user_pass = :user_pass";

		Users::FullRead($Query, $dados_form);
		return Users::getResult();


	}
}