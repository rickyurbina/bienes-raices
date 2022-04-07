<?php

class Ingreso{

	public static function ingresoController(){

		if(isset($_POST["usuarioIngreso"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"]) &&
				preg_match('/^[A-Za-z0-9\\._-]+@[A-Za-z0-9][A-Za-z0-9-]*(\\.[A-Za-z0-9_-]+)*\\.([A-Za-z]{2,6})$/', $_POST["usuarioIngreso"])){

			   	#$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("email"=>$_POST["usuarioIngreso"],
					                     "password"=>$_POST["passwordIngreso"]);

				$respuesta = IngresoModels::ingresoModel($datosController, "usuarios");


				if($respuesta['email'] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){


						$_SESSION["validar"] = true;
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];


					echo '<script>window.location="index.php?action=inicio";</script>';
				}
				else{
					/*echo '<script>alert("'.$respuesta['id'].' Niguas");</script>';
					echo '<script>window.location="index.php";</script>';*/
					echo '<div class="alert alert-danger">Verifique Usuario/Password</div>';
				}


			}

		}// si se capturo usuarioIngreso

	} // function Ingreso

} //Class