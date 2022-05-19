<?php

require_once 'conexion.php';

class BuscaModel {



	public static function mdlBusquedasPropiedades($Tabla, $opciones) {
		//Busca las propiedades con un minimo y un maximo de Area de terreno
		if (isset($opciones["minArea"]) && $opciones["minArea"] != "" && isset($opciones["maxArea"]) && $opciones["maxArea"] != "" ) { 
			$stmt = Conexion::conectar()->prepare("SELECT * FROM `propiedades` WHERE titulo LIKE :texto AND (areaTerreno BETWEEN :minArea AND :maxArea) AND status <> 'Vendida' ORDER BY areaTerreno");
			$stmt->bindValue(':texto', '%'.$opciones["textoBuscar"].'%' , PDO::PARAM_STR);
			$stmt -> bindParam(":minArea", $opciones["minArea"], PDO::PARAM_INT);
			$stmt -> bindParam(":maxArea", $opciones["maxArea"], PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		//Busca las propiedades con un minimo y un maximo de Precio
		elseif (isset($opciones["minPrecio"]) && $opciones["minPrecio"] != "" && isset($opciones["maxPrecio"]) && $opciones["maxPrecio"] != "" ){ 
			$stmt = Conexion::conectar()->prepare("SELECT * FROM `propiedades` WHERE titulo LIKE :texto AND (precio BETWEEN :minPrecio AND :maxPrecio ) AND status <> 'Vendida' ORDER BY precio");
			$stmt->bindValue(':texto', '%'.$opciones["textoBuscar"].'%' , PDO::PARAM_STR);
			$stmt -> bindParam(":minPrecio", $opciones["minPrecio"], PDO::PARAM_INT);
			$stmt -> bindParam(":maxPrecio", $opciones["maxPrecio"], PDO::PARAM_INT);
			$stmt->execute();
			
			return $stmt->fetchAll();
		}
		//Busca las propiedades con nombre en especifico
		elseif ($opciones["textoBuscar"] != ""){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM `propiedades` WHERE titulo LIKE :texto AND status <> 'Vendida' ORDER BY titulo");
				$stmt->bindValue(':texto', '%'.$opciones["textoBuscar"].'%' , PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetchAll();
		}else{
			return 0;
		}

	}




	public static function mdlBuscaPropiedadesAjax($Tabla, $Tipo) {

		if ($Tipo == "") {
			$Statement = Conexion::conectar()->prepare("SELECT * FROM $Tabla WHERE status <> 'Vendida' ORDER BY fechaRegistro DESC");
			$Statement->execute();
			return $Statement->fetchAll();
		} else {
			$Statement = Conexion::conectar()->prepare("SELECT * FROM $Tabla WHERE status <> 'Vendida' AND categoria = :categoria ORDER BY fechaRegistro DESC");
			$Statement->bindParam(":categoria", $Tipo, PDO::PARAM_STR);
			$Statement->execute();
			return $Statement->fetchAll();
		}
	}

	public static function mdlBuscaPropiedades($Tabla, $Tipo) {

		if ($Tipo == "") {
			$Statement = Conexion::conectar()->prepare("SELECT id, status, categoria, fotoPrincipal, areaTerreno, habitaciones, banos, titulo, precio, direccion FROM $Tabla WHERE status <> 'Vendida' ORDER BY fechaRegistro DESC");
			$Statement->execute();
			return $Statement->fetchAll();
		} else {
			$Statement = Conexion::conectar()->prepare("SELECT id, status, categoria, fotoPrincipal, areaTerreno, habitaciones, banos, titulo, precio, direccion FROM $Tabla WHERE status <> 'Vendida' AND categoria = :categoria ORDER BY fechaRegistro DESC");
			$Statement->bindParam(":categoria", $Tipo, PDO::PARAM_STR);
			$Statement->execute();
			return $Statement->fetchAll();
		}
	}

	public static function mdlBuscaPropiedadesrecientes($tabla) {
		$Statement = Conexion::conectar()->prepare("SELECT  id,status,moneda,categoria, fotoPrincipal, areaTerreno, habitaciones, banos, titulo, precio, direccion FROM $tabla WHERE status <> 'Vendida' AND oferta=0 ORDER BY fechaRegistro DESC , destacada DESC LIMIT 9");
		$Statement->execute();
		return $Statement->fetchAll();
	}

	public static function mdlHayOfertas($tabla) {
		$Statement = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE status <> 'Vendida' AND oferta = 1 ORDER BY fechaRegistro DESC");
		$Statement->execute();

		return $Statement->fetchAll();
	}

	public static function mdlBuscaPropiedadesOferta($tabla) {
		$Statement = Conexion::conectar()->prepare("SELECT  id,status,categoria, fotoPrincipal,moneda, areaTerreno, habitaciones, banos, titulo, precio, direccion, precioOferta FROM $tabla WHERE status <> 'Vendida' AND oferta = 1 ORDER BY fechaRegistro DESC LIMIT 9");
		$Statement->execute();
		return $Statement->fetchAll();
	}
}
