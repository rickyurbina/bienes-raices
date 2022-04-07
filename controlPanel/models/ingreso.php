<?php

require_once "conexion.php";

class IngresoModels{

	public static function ingresoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email AND password = :password");
		//select * from usuarios where email='rickyurbina@gmail.com' and PASSWORD = '123'

		$stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);

		$stmt -> execute();
		return $stmt -> fetch();
		$stmt->close();

	}


	public static function intentosModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");

		$stmt -> bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
		$stmt -> bindParam(":usuario", $datosModel["usuarioActual"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}

		else{

			return "error";
		}

	}

}