<?php
class db
{
	private $dbhost='localhost';
	private $dbuser='biryaqrs_bbazaar';
	private $dbpas='Bbazaar007@#';
	private $dbname='biryaqrs_bbazaardb';
	
	public function connect()
	{
		$mysql_connect_str="mysql:host=$this->dbhost;dbname=$this->dbname;";
		$dbConnection=new PDO($mysql_connect_str,$this->dbuser,$this->dbpas);
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $dbConnection;
	}
}