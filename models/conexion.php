<?php

class Conexion{

	public static function conectar(){
		// conexion local
		$bd = "loewen";
		$servername = "127.0.0.1";
		$username = "root";
		$password = "12345678";

		// // conexion Server ------------------------------
		//   $bd = "multie5_brcc";
		//   $servername = "localhost";
		//   $username = "multie5_brcc";
		//   $password = "}2Ut@1ouvQ}C";

		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$bd", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //echo '<script>alert("Connected successfully");</script>';
		    }
		catch(PDOException $e)
		    {
		    //echo '<script>alert("Connection failed: '.$e->getMessage().'");</script>';

		    }
		return $conn;

	}

}