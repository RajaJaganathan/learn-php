<?php

class DBCxn {
	public static $dsn="mysql:dbname=lotterydb;host=127.0.0.1";
	public static $usr='root';
	public static $pwd='';
	
	private static $db;
	
	final private function __construct(){
	}
	final private function __clone(){
	}
	
	public static function get(){
		if(!self::$db){
			try{
				$db = new PDO(self::$dsn,self::$usr,self::$pwd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
		}
		return $db;
	}
}
