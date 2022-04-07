<?php

require_once 'conexion.php';

class detModel {
	public static function mdlBuscaPropiedaddet($idpropiedad,$tabla){
		$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $idpropiedad, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
	}

	public static function mdlbuscaAgente($tabla){
		$stmt = Conexion::conectar() -> prepare("SELECT * FROM $tabla ");
		$stmt ->execute();
		return $stmt ->fetch();
		$stmt ->close();
	}

}