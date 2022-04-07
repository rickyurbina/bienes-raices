<?php
    if (!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Bienes Raices CC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <meta charset="utf-8">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="views/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="views/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="views/css/bootstrap-submenu.css">

    <link rel="stylesheet" type="text/css" href="views/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="views/css/magnific-popup.css">
    <link rel="stylesheet" href="views/css/leaflet.css" type="text/css">
    <link rel="stylesheet" href="views/css/map.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="views/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="views/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" type="text/css" href="views/fonts/linearicons/style.css">
    <link rel="stylesheet" type="text/css"  href="views/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css"  href="views/css/dropzone.css">
    <link rel="stylesheet" type="text/css"  href="views/css/slick.css">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="views/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="views/css/skins/green.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="views/img/favicon.ico" type="image/x-icon" >

     <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="views/css/ie10-viewport-bug-workaround.css">

     <script  src="views/js/ie-emulation-modes-warning.js"></script>

    <!-- SweetAlert 2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>


</head>
<body>
<!-- <div class="page_loader"></div> -->

    <?php
        $_SESSION["lostpass"] = true;
        if (isset($_SESSION["validar"]) && $_SESSION["validar"] == true){
            $modulos = new Enlaces();
            $modulos -> enlacesController();
        } else if (isset($_SESSION["lostpass"])){
            $modulos = new Enlaces();
            $modulos -> enlacesController();
        } else {
            include "modules/login.php";
        }
    ?>

  <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h4 class="modal-title" id="deleteModalLabel">Confirme</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

            <h5>Seguro que desea borrar este registro ?</h5>
            <p id="descDato"></p>
            <br><br>

            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger" onclick="borraOrden()"> Si, Borrar</button>

          </div>
        </div>
      </div>
    </div>


<!-- Datos de Venta Modal -->
<div class="modal fade" id="datosModal" tabindex="-1" role="dialog" aria-labelledby="datosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h4 class="modal-title" id="deleteModalLabel">Condiciones de Venta</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <span id="contnt" name="contnt"></span>
            <br><br>

            <button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>





<script src="views/js/jquery-2.2.0.min.js"></script>
<script src="views/js/popper.min.js"></script>
<script src="views/js/bootstrap.min.js"></script>
<script  src="views/js/bootstrap-submenu.js"></script>
<script  src="views/js/rangeslider.js"></script>
<script  src="views/js/jquery.mb.YTPlayer.js"></script>
<script  src="views/js/bootstrap-select.min.js"></script>
<script  src="views/js/jquery.easing.1.3.js"></script>
<script  src="views/js/jquery.scrollUp.js"></script>
<script  src="views/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script  src="views/js/leaflet.js"></script>
<script  src="views/js/leaflet-providers.js"></script>
<script  src="views/js/leaflet.markercluster.js"></script>
<script  src="views/js/dropzone.js"></script>
<script  src="views/js/slick.min.js"></script>
<script  src="views/js/jquery.filterizr.js"></script>
<script  src="views/js/jquery.magnific-popup.min.js"></script>
<script  src="views/js/jquery.countdown.js"></script>
<script  src="views/js/maps.js"></script>
<script  src="views/js/app.js"></script>

<!-- script para subir fotos -->
<script  src="views/js/fotos.js"></script>

<script  src="views/js/validarIngreso.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script  src="views/js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom javascript -->
<script  src="views/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>