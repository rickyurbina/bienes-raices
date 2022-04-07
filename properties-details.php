<?php
 require "controllers/controllerdet.php";
$idPro = $_REQUEST['idPro'];
?>


<!doctype html>
<html class="no-js" lang="zxx">
    <?php
        include "modules/Head.php";
    ?>
    <title>Detalles propiedad</title>
    <style>
        .det {
            font-size: 16px;
        }

        .lista {
            padding-left: 0.5rem;
        }

        .lista li {
            font-size: 16px;
        }

    </style>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div class="wrapper">

        <?php
            include "modules/Menu.php";
                    $resultado = new Propiedad();
                    $resultado -> ctlBuscaPropiedad($idPro);
        ?>


        <?php
            include "modules/footer.php";
        ?>

    </div>

    <script>
        function cambiarFoto(foto) {
            document.getElementById('mainImage').src = `controlPanel/views/img/propiedades/${foto}`;
        }
    </script>

    <!-- jquery latest version -->
    <script src="modules/js/vendor/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="modules/js/bootstrap.min.js"></script>
    <!-- Nivo slider js -->
    <script src="modules/lib/js/jquery.nivo.slider.js"></script>
    <!-- ajax-mail js -->
    <script src="modules/js/ajax-mail.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="modules/js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="modules/js/main.js"></script>

</body>

</html>