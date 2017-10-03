<?php
abstract class Model {

	private static $Connect = null;
	protected static $Table;
	private static $Result;

	private static function Conn(): PDO{
		global $config;

		try {
			if (self::$Connect == null):

				$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"];
				self::$Connect = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass'],$options);

				self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			endif;
		} catch (PDOException $e) {
			die($e->getMessage());
		}

		return self::$Connect;
	}

	public static function DB(){
		return self::Conn();
	}

	public static function getResult(){
		return self::$Result;
	}

	public static function Create(array $Fields){
		try {

			$tableName = static::$Table;
			$fields = implode(',',array_keys($Fields));
			$values = ':'.implode(',:',array_keys($Fields));

			$stmt = self::DB()->prepare("INSERT INTO {$tableName} ({$fields}) VALUES ({$values})");

			foreach ($Fields as $key => $value):
				$stmt->bindValue(":$key",$value);
			endforeach;

			$stmt->execute();

			if($stmt->rowCount() == 1):
				self::$Result = self::DB()->lastInsertId();
				return self::$Result;
			endif;


		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function ReadAll(){
		try {
			$tableName = static::$Table;
			$stmt = self::DB()->prepare("SELECT * FROM {$tableName}");
			$stmt->execute();

			if($stmt->rowCount() > 0):
				self::$Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return self::$Result;
			endif;

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function ReadByField(string $field,$value){
		try {
			$tableName = static::$Table;

			$stmt = self::DB()->prepare("SELECT * FROM {$tableName} WHERE {$field} = :value");
			$stmt->bindValue(":value",$value);
			$stmt->execute();

			if($stmt->rowCount() > 0):
				self::$Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return self::$Result;
			endif;

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function Update(array $Fields,string $cod_pk,int $id){
		try {

			$tableName = static::$Table;

			foreach ($Fields as $key => $val):
				$fields[] = "$key = :$key";
			endforeach;

			$fields = implode(',',$fields);
			$stmt = self::DB()->prepare("UPDATE {$tableName} SET {$fields} WHERE {$cod_pk} = :id");
			// print_r($stmt);die;

			foreach ($Fields as $key => $value):
				$stmt->bindValue(":$key",$value);
				$stmt->bindValue(":id",$id);
			endforeach;

			$stmt->execute();

			if($stmt->rowCount() == 1):
				self::$Result = true;
				return self::$Result;
			endif;


		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function Delete(string $cod_pk, int $id){
		try {

			$tableName = static::$Table;

			$stmt = self::DB()->prepare("DELETE FROM {$tableName} WHERE {$cod_pk} = :value");
			$stmt->bindValue(":value",$id);
			$stmt->execute();

			if($stmt->rowCount() == 1):
				self::$Result = true;
				return self::$Result;
			endif;


		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function FullRead(string $Query,array $Fields = null){
		try {

			$stmt = self::DB()->prepare($Query);

			if($Fields != null):
				foreach ($Fields as $key => $value):
					$stmt->bindValue(":$key",$value);
				endforeach;
			endif;

			$stmt->execute();

			if($stmt->rowCount() > 0):
				self::$Result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return self::$Result;
			endif;


		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}