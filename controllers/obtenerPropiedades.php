<?php
    require ("./controllerPropiedadesAjax.php");


    $controller = new PropiedadesAjax();

    $categoria = $_POST["categoria"];

    $respuesta = $controller ->ctlBuscaPropiedades($categoria);

    print_r(json_encode($respuesta));

?>