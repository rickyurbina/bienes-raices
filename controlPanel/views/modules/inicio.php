<?php
    if (!isset($_SESSION)){
        session_start();
    }

if(!$_SESSION["validar"]){

    header("location:index.php");

    exit();


}
include "navAdmin.php";
 ?>

    <div class="dashboard-header clearfix"> <!-- ENCABEZADO DEL CONTENIDO -->
        <div class="row">
            <div class="col-sm-12 col-md-6"><h4>Hola , <?php echo $_SESSION["nombre"];?></h4></div>
            <div class="col-sm-12 col-md-6">
                <div class="breadcrumb-nav">
                    <ul>
                        <li>
                            <a href="index.php?action=inicio">Index</a>
                        </li>
                        <li>
                            <a href="#" class="active">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>          <!-- END ENCABEZADO DEL CONTENIDO -->
<!--Tarjetas de Inicio -->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="ui-item bg-success">
                <div class="left">

                    <?php ob_start();
                      if (is_readable('views/contador.php')) include('views/contador.php');
                      ob_end_clean();
                      ob_flush();
                ?>
                 <h4><?php echo $num_visitas; ?></h4>

                    <p>Visitas</p>
                </div>
                <div class="right">
                    <i class="fa fa-map"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="ui-item bg-primary">
                <div class="left">
                    <h4><?php $datos = new MvcController(); $datos -> ctrNoProps(); ?></h4>
                    <p>Propiedades Registradas</p>
                </div>
                <div class="right">
                    <i class="fa fa-home"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="ui-item bg-info">
                <div class="left">
                    <h4><?php $datos -> ctrNoUsers(); ?></h4>
                    <p>Usuarios en el sistema</p>
                </div>
                <div class="right">
                    <i class="fa fa-user"></i>
                </div>
            </div>
        </div>

    </div> <!--Tarjetas de Inicio -->


    <div class="row">
        <!--Aqui va el contenido del Dashborad-->
    </div>


<?php
include "footer.php";
 ?>
