<?php
require('../../../controllers/controller.php');
require('../../../models/crud.php');


// print_r($_POST);
$idPropiedad = $_POST["idPropiedad"];
$index = $_POST["indice"];

$Controller = new MvcController();

$respuestas = $Controller -> ctrGetImagenes($idPropiedad);
$nuevo = new SplFixedArray(5);
$cosas = json_decode($respuestas[0]["fotos"], true);

    for ($i = 0; $i < count($nuevo); $i++) {
        $nuevo[$i] = $cosas[$i];
     }

$nuevo[$index] = "";

$Controller = new MvcController();

$respuesta = $Controller -> ctrSubirImagenes($idPropiedad, $nuevo);
