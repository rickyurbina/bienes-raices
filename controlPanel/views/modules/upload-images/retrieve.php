<?php
require('../../../controllers/controller.php');
require('../../../models/crud.php');

$idPropiedad = $_GET["idPropiedad"];

$Controller = new MvcController();

$cosa = $Controller -> ctrGetImagenes($idPropiedad);

print_r(json_encode($cosa));
