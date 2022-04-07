<!doctype html>
<html class="no-js" lang="zxx">

<?php 
    include "modules/Head.php";
    echo "<title>Loewen | Contacto</title>";
?>
<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <?php
            include "modules/Menu.php";
        ?>
        <!-- BREADCRUMBS AREA START -->
        <div class="breadcrumbs-area bread-bg-1 bg-opacity-black-70">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs">
                            <h2 class="breadcrumbs-title">Contacto</h2>
                            <ul class="breadcrumbs-list">
                                <li><a href="index.php">Home</a></li>
                                <li>Contacto</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS AREA END -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">

            <!-- CONTACT AREA START -->
            <div class="contact-area pt-115 pb-115">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <!-- get-in-toch -->
                            <div class="get-in-toch">
                                <div class="section-title mb-30">
                                    <h3>Bienes raices</h3>
                                    <h2>LOEWEN</h2>
                                </div>
                                <div class="contact-desc mb-50">
                                    <p> Quiere vender su casa o terreno? Venga con nosotros, lo ayudamos a conseguir el cliente y el precio ideal, si desea comprar pregunte por las casas de venta .</p>
                                </div>
                                <ul class="contact-address">
                                    <li>
                                        <div class="contact-address-icon">
                                            <img src="modules/images/icons/location-2.png" alt="">
                                        </div>
                                        <div class="contact-address-info">
                                            <span>km 15 Carretera Cuauhtémoc - A. Obregon #1525,</span>
                                            <span>Cuauhtémoc, Chihuahua</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-address-icon">
                                            <img src="modules/images/icons/phone-3.png" alt="">
                                        </div>
                                        <div class="contact-address-info">
                                            <span>Telefono:<a href="tel: +526251252928"> 625-125-2928</a></span>

                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-address-icon">
                                            <img src="modules/images/icons/world.png" alt="">
                                        </div>
                                        <div class="contact-address-info">
                                            <span>Email : <a href="mailto:ventas@bienesraicescc.com">ventas@bienesraicescc.com</a></span>
                                           <!-- <span>Web :<a href="#" target="_blank"> www.yoursite.com</a></span> -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="contact-messge contact-bg">
                                <!-- blog-details-reply -->
                                <div class="leave-review">
                                    <h5>Deja tu mensaje</h5>
                                    <form id="contact-form" action="mail.php" method="post">

                                        <input type="text" name="name" placeholder="Tu nombre" required>
                                        <input  type="text" name="tel" placeholder="Telefono" required>
                                        <input type="email" name="email" placeholder="Email" required>
                                        <textarea name="message" placeholder="Escribe aqui" required></textarea>
                                        <button type="submit" class="submit-btn-1">Enviar</button>
                                    </form>
                                    <p class="form-messege mb-0"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTACT AREA END -->

        </section>
        <!-- End page content -->

        <?php
            include "modules/footer.php";
        ?>
    </div>
    <!-- Body main wrapper end -->




    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Nivo slider js -->
    <script src="lib/js/jquery.nivo.slider.js"></script>
    <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeeHDCOXmUMja1CFg96RbtyKgx381yoBU"></script>
    <script src="js/google-map.js"></script>
    <!-- ajax-mail js -->
    <script src="js/ajax-mail.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="js/main.js"></script>

</body>

</html>