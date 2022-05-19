<?php

class MvcController{


	#-------------------------------------
	#Estadisticas para inicio de Dashboard
	#------------------------------------

	public static function ctrNoProps(){

		$respuesta = Datos::mdlNoProps("propiedades");

		echo $respuesta["No"];
	}

	public static function ctrNoUsers(){

		$respuesta = Datos::mdlNoUsers("usuarios");

		echo $respuesta["No"];
	}



	#-------------------------------------
	#Busca los vendedores existentes para captura de propiedades
	#------------------------------------
	public static function ctlBuscaVendedores(){

		$respuesta = Datos::mdlVendedores("usuarios");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["id"].'">'.$item["nombre"].'</option>';
		}
	}

	#-------------------------------------
	#Busca los vendedores existentes para captura de propiedades y selecciona al que recibe como parametro
	#------------------------------------
	public static function ctlBuscaVendedor($vendedor){

		$respuesta = Datos::mdlVendedores("usuarios");

		foreach ($respuesta as $row => $item){

			if ($item["id"] == $vendedor) echo  '<option value="'.$item["id"].'" selected>'.$item["nombre"].'</option>';

			else echo  '<option value="'.$item["id"].'">'.$item["nombre"].'</option>';
		}
	}




	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	public static function ctrCrearUsuario(){

		if(isset($_POST["email"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["name"]) &&
			   preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $_POST["email"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["new-password"])){

			   	/*=============================================
				  VALIDAR IMAGEN
				=============================================*/

				$ruta = "views/img/usuarios/usuario.png";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){


					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*================================================================
					  CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					==================================================================*/

					$directorio = "views/img/usuarios";

					if (!file_exists($directorio)) {     // si el directorio no existe lo creamos
						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/usuarios/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]); //toma la imagen original

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto); // crea un espacio para la imagen que vamos a subir

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);   //  Redimensiona la imagen original y agrega al destino

						imagejpeg($destino, $ruta);  // graba la imagen redimensionada en $ruta

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/usuarios/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";
				$socials = array('Facebook' => $_POST["facebook"], 'Twitter' => $_POST["twitter"], 'LinkedIn' => $_POST["linkedin"]);

				//$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $_POST["name"],
							   "telefono" => $_POST["phone"],
					           "email" => $_POST["email"],
					           "password" => $_POST["new-password"],
					           //"password" => $encriptar,
					           "personal" => $_POST["personal"],
					           "titulo" => $_POST["title"],
					           "perfil" => $_POST["profile"],
					           "foto"=>$ruta,
					           "estado" => "1",
					           "ultimo_login" => 'NULL',
					           "fechaNac" => $_POST["fechaNac"],
					           "sociales" => json_encode($socials));

				$respuesta = Datos::mdlIngresarUsuario($tabla, $datos);


				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=agrega-usuario";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=agrega-usuario";

						}

					});


				</script>';

			}


		}


	}


	/*=============================================
	REGISTRO DE PROPIEDAD
	=============================================*/

	public static function ctrCrearProperty(){

		if(isset($_POST["name"])){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "views/img/propiedades/house-icon.png";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){


					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 1500;
					$nuevoAlto = 1500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "views/img/propiedades";

					if (!file_exists($directorio)) {     // si el directorio no existe lo creamos
						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,99999);

						$ruta = "views/img/propiedades/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,99999);

						$ruta = "views/img/propiedades/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				} //si se eligio foto

				$tabla = "propiedades";

				$caract = array('Estacionamiento' => $_POST["estacionamiento"], 'Aire Acondicionado' => $_POST["AC"], 'C. Piso Radiante' => $_POST["piso"], 'Garage' => $_POST["garage"], 'Piscina' => $_POST["piscina"], 'Lavanderia' => $_POST["lavanderia"], 'Calefaccion' => $_POST["calefaccion"], 'Alarma' => $_POST["alarma"], 'Placas Solares' => $_POST["placasSolares"], 'Ventanas doble vidrio' => $_POST["ventanas"], 'Doble Piso' => $_POST["doblePiso"], 'Sotano' => $_POST["sotano"], 'Sala' => $_POST["sala"], 'Comedor' => $_POST["comedor"], 'Cocina' => $_POST["cocina"], 'Agua' => $_POST["agua"], 'Luz' => $_POST["luz"], 'Pivote' => $_POST["pivote"], 'Paso de Agua' => $_POST["pasoAgua"]);
				//echo '<script>alert("Foto :'.$ruta.'");</script>';

				$datos = array("id" => $_POST["id"],
							   "destacada" => $_POST["destacada"],
							   "nombre" => $_POST["name"],
							   "status" => $_POST["status"],
					           "precio" => $_POST["precio"],
							   "moneda" => $_POST["moneda"],
					           "precioOferta" => $_POST["precioOferta"],
					           "mtsTerreno" => $_POST["mtsTerreno"],
					           "mtsConstruccion" => $_POST["mtsConstruccion"],
					           "habitaciones" => $_POST["habitaciones"],
					           "banos" => $_POST["banos"],
					           "categoria" => $_POST["categoria"],
					           "direccion" => $_POST["direccion"],
					           "ciudad" => $_POST["ciudad"],
					           "estado" => $_POST["estado"],
					           "CP" => $_POST["CP"],
					           "latitud" => $_POST["Latitud"],
					           "longitud" => $_POST["Longitud"],
					           "condiciones" => $_POST["condVenta"],
					           "detalles" => $_POST["detalles"],
					           "caract" => json_encode($caract),
					           "agenteID" => $_POST["agenteID"],
					           "foto"=>$ruta,
					           "caract" => json_encode($caract));

				$respuesta = Datos::mdlIngresarPropiedad($tabla, $datos);


				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Datos guardados correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-propiedades";

						}

					});


					</script>';


				}


			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al registrar, Verifique los datos !",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=property";

						}

					});


				</script>';

			}


		}//isset


	} // funcion


	/*=============================================
	ACTUALIZA DATOS DE PROPIEDAD
	=============================================*/

	public static function ctrActProperty(){
		if(isset($_POST["actualiza"])){

			$ruta = $_POST["foto"];

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				//$ruta = $_POST["nuevaFoto"];

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){


				list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
				$nuevoAncho = 1500;
				$nuevoAlto = 1500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "views/img/propiedades";

				if (!file_exists($directorio)) {     // si el directorio no existe lo creamos
					mkdir($directorio, 0755);
				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$aleatorio = mt_rand(100,99999);

					$ruta = "views/img/propiedades/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);

				}

				if($_FILES["nuevaFoto"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$aleatorio = mt_rand(100,99999);

					$ruta = "views/img/propiedades/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}
				//echo '<script>alert("Dentro :'.$ruta.'");</script>';

			} //si se eligio foto

				$tabla = "propiedades";

				$caract = array('Estacionamiento' => $_POST["estacionamiento"], 'Aire Acondicionado' => $_POST["AC"], 'C. Piso Radiante' => $_POST["piso"], 'Garage' => $_POST["garage"], 'Piscina' => $_POST["piscina"], 'Lavanderia' => $_POST["lavanderia"], 'Calefaccion' => $_POST["calefaccion"], 'Alarma' => $_POST["alarma"], 'Placas Solares' => $_POST["placasSolares"], 'Ventanas doble vidrio' => $_POST["ventanas"], 'Doble Piso' => $_POST["doblePiso"], 'Sotano' => $_POST["sotano"], 'Sala' => $_POST["sala"], 'Comedor' => $_POST["comedor"], 'Cocina' => $_POST["cocina"], 'Agua' => $_POST["agua"], 'Luz' => $_POST["luz"], 'Pivote' => $_POST["pivote"], 'Paso de Agua' => $_POST["pasoAgua"]);

				if (is_null($_POST["destacada"]) || empty($_POST["destacada"])) $dest = 0;
				else $dest=1;

				if (is_null($_POST["oferta"]) || empty($_POST["oferta"])) $oferta = 0;
				else $oferta = 1;

				$datos = array("id" => $_POST["id"],
							   "destacada" => $dest,
							   "oferta" => $oferta,
							   "nombre" => $_POST["name"],
							   "status" => $_POST["status"],
					           "precio" => $_POST["precio"],
							   "moneda" => $_POST["moneda"],
					           "precioOferta" => $_POST["precioOferta"],
					           "mtsTerreno" => $_POST["mtsTerreno"],
					           "mtsConstruccion" => $_POST["mtsConstruccion"],
					           "habitaciones" => $_POST["habitaciones"],
					           "banos" => $_POST["banos"],
					           "categoria" => $_POST["categoria"],
					           "direccion" => $_POST["direccion"],
					           "ciudad" => $_POST["ciudad"],
					           "estado" => $_POST["estado"],
					           "CP" => $_POST["CP"],
					           "latitud" => $_POST["latitud"],
					           "longitud" => $_POST["longitud"],
					           "detalles" => $_POST["detalles"],
					           "condiciones" => $_POST["condiciones"],
					           "caract" => json_encode($caract),
					           "agenteID" => $_POST["agenteID"],
					           "fotoPrincipal"=>$ruta,
					           "caract" => json_encode($caract));

				//var_dump($datos);

				$respuesta = Datos::mdlActualizarPropiedad($tabla, $datos);


				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Datos guardados correctamente! ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-propiedades";

						}

					});


					</script>';


				}


			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Error al registrar, Verifique los datos !",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=property";

						}

					});


				</script>';

			}


		}//isset


	} // funcion





	#------------------------------------------------------------------------------------------------------------------------------------------
	#LISTADO DE USUARIOS
	#-------------------------------------------------------------------------------------------------------------------------------------------
	public static function ctrSubeImagenes(){
		if(isset($_POST["sube"])){
			if ($_POST["foto1"]!="") $foto1 = $_POST["propiedad"].'-'.$_POST["foto1"]; else $foto1="";
			if ($_POST["foto2"]!="") $foto2 = $_POST["propiedad"].'-'.$_POST["foto2"]; else $foto2="";
			if ($_POST["foto3"]!="") $foto3 = $_POST["propiedad"].'-'.$_POST["foto3"]; else $foto3="";
			if ($_POST["foto4"]!="") $foto4 = $_POST["propiedad"].'-'.$_POST["foto4"]; else $foto4="";
			if ($_POST["foto5"]!="") $foto5 = $_POST["propiedad"].'-'.$_POST["foto5"]; else $foto5="";

			$fotos = array('foto1' => $foto1, 'foto2' => $foto2, 'foto3' => $foto3, 'foto4' => $foto4, 'foto5' => $foto5);

			$datos = array( "propiedad" => $_POST["propiedad"],
							"fotos" => json_encode($fotos));

			$respuesta = Datos::mdlSubeImagenes("propiedades", $datos);

			if ($respuesta=="ok"){

				echo '<script>

					swal({

						type: "success",
						title: "¡Las Imagenes se asignaron correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.close();

						}

					});


					</script>';
			}
			else{
				echo '<script>

					swal({

						type: "error",
						title: "Error al asignar imagenes",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.close();

						}

					});


					</script>';
			}

		}//ISSET
    }

    public static function ctrSubirImagenes($idPropiedad, $imagenes) {


        $data = array("propiedad" => $idPropiedad, "fotos" => json_encode($imagenes));
        $respuesta = Datos::mdlSubeImagenes("propiedades", $data);


        if ($respuesta == "ok") {
            echo "success";
        } else {
            echo "error";
        }
    }

    public static function ctrGetImagenes($idPropiedad) {
        $respuesta = Datos::mdlGetImagenes("propiedades", $idPropiedad);
        // print_r($respuesta);
        return $respuesta;
    }

	#LISTADO DE USUARIOS
	#------------------------------------

	public static function ctrListaUsuarios(){

		$respuesta = Datos::mdlListaUsuarios("usuarios");

		foreach ($respuesta as $row => $item){

		echo '<tr class="responsive-table">
            <td class="listing-photoo">
                <img src="'.$item["foto"].'" alt="listing-photo" class="img-fluid" width="120">
            </td>
            <td class="title-container">
                <h2><a href="#">'.$item["nombre"].'</a></h2>
                <h5 class="d-none d-xl-block d-lg-block d-md-block">'.$item["email"].'</h5>
                <h6 class="table-property-price">'.$item["telefono"].'</h6>
            </td>
            <td class="expire-date">'.$item["titulo"].'</td>
            <td class="action">
                <a href="index.php?action=edita-usuario&idEditar='.$item["id"].'"><i class="fa fa-pencil"></i> Editar</a>';

                if ($item['id'] != $_SESSION['id']){
                echo '<a href="#deleteModal" data-toggle="modal" data-target="#deleteModal" data-borrar="'.$item["id"].'" class="delete"><i class="fa fa-remove"></i> Borrar</a>
                <a href="index.php?action=mis-usuarios&idBorrar='.$item["id"].'"><button id="'.$item["id"].'" name="'.$item["id"].'" hidden>X</button></a>';
				}
		echo '
            </td>
        </tr>';
		}

	}




	#LISTADO DE PROPIEDADES
	#------------------------------------

	public function ctrListaPropiedades() {

		$respuesta = Datos::mdlListaPropiedades("propiedades");
		
		foreach ($respuesta as &$item) {

			// $item["titulo"] = json_decode($item["titulo"], true);
			// $item["3"] = json_decode($item["3"]);

			$item["detalles"] = null;
			$item["21"] = null;
			
			$item["caracteristicas"] = json_decode($item["caracteristicas"], true);
			$item["22"] = json_decode($item["22"], true);

			$item["condVenta"] = null;
			$item["7"] = null;

			$item["fotos"] = json_decode($item["fotos"], true);
			$item["20"] = json_decode($item["20"], true);

			$item["latitud"] = null;
			$item["17"] = null;

			$item["longitud"] = null;
			$item["18"] = null;
		}

		return json_encode($respuesta);

		// foreach ($respuesta as $row => $item){

		// echo '<tr class="responsive-table">
    //         <td class="listing-photoo">
    //         	<a href="#datosModal" data-toggle="modal" href="#datosModal" data-desc="'.$item["condVenta"].'" class="datosVenta">
    //             <img src="'.$item["fotoPrincipal"].'" alt="listing-photo" class="img-fluid" width="120">
    //         </td>
    //         <td class="title-container">
		// 		ID: '.$item["id"].'<br>
    //             <h2>'.$item["titulo"].'</h2>
    //             <h5 class="d-none d-xl-block d-lg-block d-md-block">'.$item["direccion"].'</h5>
    //             <h6 class="table-property-price">'.number_format($item["precio"]).'</h6>
    //         </td>
    //         <td class="expire-date">'.$item["status"].'</td>
    //         <td class="action">

    //             <a onclick="getImages('.$item["id"].');"  propiedad='.$item["id"].' ><i class="fa fa-picture-o"></i> Más Fotos</a>
    //             <a href="index.php?action=edita-propiedad&idEditar='.$item["id"].'"><i class="fa fa-pencil"></i> Editar</a>


    //             <a href="#deleteModal" data-toggle="modal" data-target="#deleteModal" data-borrar="'.$item["id"].'" data-desc="Descripcion" class="delete"><i class="fa fa-remove"></i>Borrar</a>

    //             <a href="index.php?action=mis-propiedades&idBorrar='.$item["id"].'"><button id="'.$item["id"].'" name="'.$item["id"].'" hidden>X</button></a>

    //         </td>
    //     </tr>';
		// }

	}


	#BORRAR USUARIO
	#------------------------------------
	public static function ctrBorrarEmpleado(){
		if (isset($_GET['idBorrar'])){
			$datosController = $_GET['idBorrar'];

			$busca = Datos::mdlBuscaEmpleado($_GET['idBorrar'], "usuarios");

			if (!empty($busca['foto']) && file_exists($busca['foto'])) {
		        unlink($busca['foto']);
		    }

			$respuesta = Datos::mdlBorrarEmpleado($datosController,"usuarios");
			if ($respuesta == "success"){
				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-usuarios";

						}

					});


					</script>';
			}
		}
	}

	#BORRAR PROPIEDAD
	#------------------------------------
	public static function ctrBorrarPropiedad(){
		if (isset($_GET['idBorrar'])){
			$datosController = $_GET['idBorrar'];

			//*****************************************************************************************************
			// se consulta la propiedad para eliminar las fotos guardadas en el server antes de borrar el registro
			//*****************************************************************************************************
			$busca = Datos::mdlBuscaPropiedad($_GET['idBorrar'], "propiedades");

			$fotos = json_decode($busca["fotos"], true);

			if (!empty($busca['fotoPrincipal']) && file_exists($busca['fotoPrincipal'])) {
		        unlink($busca['fotoPrincipal']);
		    }
			if (!empty($fotos['foto1']) && file_exists('views/img/propiedades/'.$fotos['foto1'])) {
		        unlink('views/img/propiedades/'.$fotos['foto1']);
		    }
		    if (!empty($fotos['foto2']) && file_exists('views/img/propiedades/'.$fotos['foto2'])) {
		        unlink('views/img/propiedades/'.$fotos['foto2']);
		    }
		    if (!empty($fotos['foto3']) && file_exists('views/img/propiedades/'.$fotos['foto3'])) {
		        unlink('views/img/propiedades/'.$fotos['foto3']);
		    }
		    if (!empty($fotos['foto4']) && file_exists('views/img/propiedades/'.$fotos['foto4'])) {
		        unlink('views/img/propiedades/'.$fotos['foto4']);
		    }
		    if (!empty($fotos['foto5']) && file_exists('views/img/propiedades/'.$fotos['foto5'])) {
		        unlink('views/img/propiedades/'.$fotos['foto5']);
		    }


			//*****************************************************************************************************





			$respuesta = Datos::mdlBorrarPropiedad($datosController,"propiedades");
			if ($respuesta == "success"){
				echo '<script>

					swal({

						type: "error",
						title: "¡Se ha borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-propiedades";

						}

					});


					</script>';
			}
		}
	}

# ACTUALIZA USUARIO
	#------------------------------------

	public static function ctlActualizaUsuario(){
		if (isset($_REQUEST['actualiza'])){

			$ruta = $_POST["foto"];

			if(isset($_FILES["nuevaFoto"]["tmp_name"])){


				list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
				CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				=============================================*/

				$directorio = "views/img/usuarios";

				if (!file_exists($directorio)) {     // si el directorio no existe lo creamos
					mkdir($directorio, 0755);
				}

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/

				if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$aleatorio = mt_rand(100,999);

					$ruta = "views/img/usuarios/".$aleatorio.".jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);

				}

				if($_FILES["nuevaFoto"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$aleatorio = mt_rand(100,999);

					$ruta = "views/img/usuarios/".$aleatorio.".png";

					$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}
				//echo '<script>alert("Dentro :'.$ruta.'");</script>';

			}

			$tabla = "usuarios";
			$socials = array('Facebook' => $_POST["facebook"], 'Twitter' => $_POST["twitter"], 'LinkedIn' => $_POST["linkedin"]);

			//$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array("id" => $_POST["id"],
						   "nombre" => $_POST["name"],
						   "telefono" => $_POST["phone"],
				           "email" => $_POST["email"],
				           "password" => $_POST["new-password"],
				           //"password" => $encriptar,
				           "personal" => $_POST["personal"],
				           "titulo" => $_POST["title"],
				           "perfil" => $_POST["profile"],
				           "foto"=>$ruta,
				           "estado" => "1",
				           "ultimoLogin" => 'NULL',
				           "fechaNac" => $_POST["fechaNac"],
				           "sociales" => json_encode($socials));

			$respuesta = Datos::mdlActualizaUsuario($datos, $tabla);

			//echo "<script type='text/javascript'>alert('$respuesta'); window.location.href='index.php?action=mis-usuarios'</script>";

			if ($respuesta=="ok"){

				echo '<script>

					swal({

						type: "success",
						title: "¡El usuario se actualizó correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-usuarios";

						}

					});


					</script>';
			}
			else{
				echo '<script>

					swal({

						type: "error",
						title: "Error al actualizar",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-usuarios";

						}

					});


					</script>';
			}

		}

	}


	/*=============================================
	REGISTRO DE PROPIEDAD NUEVA
	=============================================*/

	public static function ctrCrearPropiedad(){
		$target_dir = "views/img/propiedades/";
		$uploadOk = 1;
		$exists="";

	if(isset($_POST["submit"])) {
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

		// Check if file already exists
		if (file_exists($target_file)) {
		    $exists = ", already exists.";
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded".$exists;
		// if everything is ok, try to upload file
		} else {
		     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		     } else {
		         echo "Sorry, there was an error uploading your file.";
		     }
		}

 	}
	} // funcion




	/*=============================================
	ACTUALIZA DATOS DE PROPIEDAD
	=============================================*/

	public static function ctrActualizaPropiedad(){

		if(isset($_POST["actualiza"])){


				/*=============================================
				VALIDAR IMAGEN DE LA PROPIEDAD
				=============================================*/

				//$ruta = "views/img/propiedades/house-icon.png";
				$ruta = $_POST["nuevaFoto"];

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){
					//echo '<script>console_log("Si se puso foto :'.$ruta.'");</script>';


					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "views/img/propiedades";

					if (!file_exists($directorio)) {     // si el directorio no existe lo creamos
						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					// console_log($_FILES["nuevaFoto"]["type"]);

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
						//echo '<script>console_log("es JPG :'.$ruta.'");</script>';

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/propiedades/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){
						//echo '<script>console_log("Es PNG :'.$ruta.'");</script>';

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "views/img/propiedades/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}


				}


			$tabla = "propiedades";

				$caract = array('estacionamiento' => $_POST["estacionamiento"], 'AC' => $_POST["AC"], 'piscina' => $_POST["piscina"], 'lavanderia' => $_POST["lavanderia"], 'calefaccion' => $_POST["calefaccion"], 'alarma' => $_POST["alarma"], 'parque' => $_POST["parque"], 'ventanas' => $_POST["ventanas"]);
				//echo '<script>alert("Foto :'.$ruta.'");</script>';

				$datos = array("id" => $_POST["id"],
							   "nombre" => $_POST["nombre"],
							   "status" => $_POST["status"],
					           "precio" => $_POST["precio"],
							   "moneda" => $_POST["moneda"],
					           "mtsTerreno" => $_POST["mtsTerreno"],
					           "mtsConstruccion" => $_POST["mtsConstruccion"],
					           //"password" => $encriptar,
					           "habitaciones" => $_POST["habitaciones"],
					           "banos" => $_POST["banos"],
					           "categoria" => $_POST["categoria"],
					           "direccion" => $_POST["direccion"],
					           "ciudad" => $_POST["ciudad"],
					           "estado" => $_POST["estado"],
					           "CP" => $_POST["CP"],
					           "detalles" => $_POST["detalles"],
					           "caract" => json_encode($caract),
					           "agenteID" => $_POST["agenteID"],

					           "foto"=>$ruta,
					           "estado" => $_POST["estado"],
					           //"fechaNac" => $_POST["fechaNac"],
					           "caract" => json_encode($caract));

				var_dump($datos);

				$respuesta = Datos::mdlActualizarPropiedad($tabla, $datos);


				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡Se ha guardado la informacion correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-propiedades";

						}

					});


					</script>';


				}


			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡No se pudo guardar la informacion!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "index.php?action=mis-propiedades";

						}

					});


				</script>';

			}


		} //isset actualiza
	} // funcion ctrActualizaPropiedad


}
