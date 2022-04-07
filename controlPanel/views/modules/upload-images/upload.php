<?php
$idPropiedad = $_POST["idPropiedad"];

$cambios = $_POST["cambios"];

$arrayCambios = explode(',', $cambios);
print_r($arrayCambios);

$nombres = $_POST["nombres"];

$arrayNombres = explode(',', $nombres);



require('../../../controllers/controller.php');
require('../../../models/crud.php');

$destination = "../../img/propiedades/";
$imagenes = new SplFixedArray(5);
$registrar = false;


print_r($arrayNombres);

for ($i=0; $i < 5; $i++) { 


    if ($arrayNombres[$i] == "") {
        $imagenes[$i] = "";
    } else if ($arrayCambios[$i] == "no") {

        $imagenes[$i] = $arrayNombres[$i];
        
    } else {
        $imagen = $_FILES['img-' . ($i + 1)];

        if ($imagen['size'] > 0) {
            $imagenName = $imagen['name'];
            $imagenTmpName = $imagen['tmp_name'];
            $imagenSize = $imagen['size'];
            $imagenError = $imagen['error'];

            $imagenFileExtension = explode('.', $imagenName);
            $imagenActualFileExtension = strtolower(end($imagenFileExtension));

            if ($imagenError === 0) {
                $imagenNuevoNombre = uniqid('', true) . "." . $imagenActualFileExtension;

                $imagenDestino = $destination . $imagenNuevoNombre;
                move_uploaded_file($imagenTmpName, $imagenDestino);

                $imagenes[$i] = $imagenNuevoNombre;
                $registrar = true;
            }
        }
    }
}

print_r($imagenes);

if ($registrar === true) {
    $Controller = new MvcController();

    $Controller -> ctrSubirImagenes($idPropiedad, $imagenes);
}