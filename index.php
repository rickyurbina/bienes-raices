<?php
//header("Status: 301 Moved Permanently");
// header("Location: http://www.bienesraicescc.com/properties.php");
// exit;
?>
<!DOCTYPE html>
<html lang="es-MX">

    <?php
        require "controllers/controllerPropiedades.php";
        require "controllers/controllerdet.php";
        require_once ('./models/Modeldet.php');
        include "modules/Head.php";
    ?>
<title>Loewen Bienes Racices</title>
<body>

    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <?php
            include "modules/Menu.php";
        ?>

        <!-- SLIDER SECTION START -->
        <div class="slider-1 pos-relative slider-overlay">
            <div class="bend niceties preview-1">
                <div id="ensign-nivoslider-3" class="slides">
                    <img src="modules/images/slider/1.jpg" alt="" title="#slider-direction-1" />
                    <img src="modules/images/slider/2.jpg" alt="" title="#slider-direction-2" />
                    <img src="modules/images/slider/3.jpg" alt="" title="#slider-direction-3" />
                </div>
                <!-- direction 1 -->
                <div id="slider-direction-1" class="slider-direction">
                    <div class="slider-content text-center">
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                            <h4 class="slider-1-title-1">Bienvenido a <span>Loewen Bienes Raices</span></h4>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <h1 class="slider-1-title-2">ENCUENTRA TU CASA CON NOSOTROS</h1>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                            <p class="slider-1-desc"></p>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                            <a class="slider-button mt-40" href="properties.php">PROPIEDADES</a>
                        </div>
                    </div>
                </div>
                <!-- direction 2 -->
                <div id="slider-direction-2" class="slider-direction">
                    <div class="slider-content text-left">
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                            <h4 class="slider-1-title-1">En <span>Loewen Bienes Raices</span></h4>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <h1 class="slider-1-title-2">Te asesoramos en tu compra</h1>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                            <p class="slider-1-desc"></p>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                            <a class="slider-button mt-40" href="contact.php">Contactanos</a>
                        </div>
                    </div>
                </div>
                <!-- direction 2 -->
                <div id="slider-direction-3" class="slider-direction">
                    <div class="slider-content text-right">
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                            <h4 class="slider-1-title-1">Bienvenido a <span>Loewen Bienes Raices</span></h4>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                            <h1 class="slider-1-title-2">TE AYUDAMOS CON TUS TRAMITES</h1>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                            <p class="slider-1-desc">Todo tramite que requieras para comprar o vender tu casa <br> nosotros lo hacemos por ti </p>
                        </div>
                        <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">
                            <a class="slider-button mt-40" href="contact.php">Contactanos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SLIDER SECTION END -->


        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">
            
            <div class="elements-area ptb-115">

                <!-- FEATURES AREA START -->
                <div class="features-area fix">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-7 offset-lg-5">
                                <div class="features-info bg-gray">
                                    <div class="section-title mb-30">
                                        <h3>PUEDES BUSCAR</h3>
                                        <h2 class="h1">EN ESTAS CATEGORIAS</h2>
                                    </div>
                                    <div class="features-desc">
                                    </div>
                                    <div class="features-include">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><i class="fas fa-home"></i><a href="properties.php?categoria=casa"> &nbsp Casas</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><img src="images/icons/13.png" alt=""><a href="properties.php?categoria=casabodega">Casa Bodega</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><i class="fas fa-caravan"></i><a href="properties.php?categoria=casas moviles">&nbsp Casas Móviles</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><i class="fas fa-warehouse"></i><a href="properties.php?categoria=bodega"> &nbsp Bodegas</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><img src="images/icons/4.png" alt=""><a href="properties.php?categoria=lote">Lotes</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><img src="images/icons/11.png" alt=""><a href="properties.php?categoria=tierras">Tierras</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><i class="fas fa-hat-cowboy"></i><a href="properties.php?categoria=ranchos"> &nbsp Ranchos</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><img src="images/icons/world.png" alt=""><a href="properties.php?categoria=">Todas</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><img src="images/icons/7.png" alt=""><a href="properties.php?categoria=casa">En oferta</a></h4>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6 col-md-6">
                                                <div class="features-include-list">
                                                    <h4><i class="fas fa-building"></i><a href="properties.php?categoria=negocios">&nbsp Negocios</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FEATURES AREA END -->

            </div>


            <!-- Propiedades mas recientes -->
            <div class="featured-flat-area pt-115 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title-2 text-center">
                                <h2>Propiedades M&aacute;s Recientes</h2>
                                <p>Estas son las propiedades mas recientes en nuestro catalogo, aproveche y sea el primero en conocerlas. <br>Agende una cita con nosotros para una visita.</p>
                            </div>
                        </div>
                    </div>
                    <div class="featured-flat">
                        <div class="row">
                            <?php

                            $Lista = new Propiedades();
                            $Lista -> ctlBuscaPropiedadesrecientes();

                                ?>
                        </div>
                    </div>
                    <div class="col-3"></div>
                    <div class="card text-center col-6" ><h3><a href="properties.php?categoria="> Ver Todas</a></h3></div>
                    
                </div>
            </div>


            <!-- SERVICES AREA END -->
           <?php

           ?>
        </section>
        <!-- End page content -->
        <?php
            include "modules/footer.php"
        ?>

    </div>
    <!-- Body main wrapper end -->




    <!-- Placed js at the end of the document so the pages load faster -->

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
    <!--  Images LightBox effect -->
    <script src="modules/js/lightbox.js"></script>
    <script src="modules/js/lightbox-plus-jquery.js"></script>

</body>

</html>