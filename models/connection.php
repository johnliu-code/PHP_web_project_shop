<?php

class DBconnection{
	function connectDataBase(){
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=projet_final;charset=utf8', 'root', '');
			return $db;
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
	}

}
