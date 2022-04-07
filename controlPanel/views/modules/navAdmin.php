<!-- Main header start -->
<header class="main-header header-2 fixed-header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo pad-0" href="index.php?action=inicio">
                <img src="views/img/logos/black-logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!--Menu para moviles-->
                <ul class="navbar-nav ml-auto d-lg-none d-xl-none">

                    <li class="nav-item dropdown active">
                        <a href="index.php?action=inicio" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="index.php?action=mis-propiedades" class="nav-link">Propiedades</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="index.php?action=mis-usuarios" class="nav-link">Usuarios</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="index.php?action=agrega-propiedad" class="nav-link">Agregar Propiedad</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="index.php?action=edita-usuario&idEditar=<?php echo $_SESSION['id']; ?>" class="nav-link">Mi Perfil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="index.php?action=salir" class="nav-link">Salir</a>
                    </li>
                </ul>
                <!--End Menu para moviles-->

                <!--Dropdown Izquierda-->
                <div class="navbar-buttons ml-auto d-none d-xl-block d-lg-block">
                    <ul>
                        <li>
                            <div class="dropdown btns">
                                <a class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo $_SESSION['foto']; ?>" alt="avatar">
                                    Mi Cuenta
                                </a>
                                <div class="dropdown-menu">
                                    <!--<a class="dropdown-item" href="dashboard.html">Dashboard</a>
                                    <a class="dropdown-item" href="messages.html">Messages</a>
                                    <a class="dropdown-item" href="bookings.html">Bookings</a>-->
                                    <a class="dropdown-item" href="index.php?action=edita-usuario&idEditar=<?php echo $_SESSION['id']; ?>">Mi Perfil</a>
                                    <a class="dropdown-item" href="index.php?action=salir">Salir</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="btn btn-theme btn-md" href="index.php?action=agrega-propiedad">Agregar Propiedad</a>
                        </li>
                    </ul>
                </div>
                <!-- End Dropdown Izquierda-->

            </div>
        </nav>
    </div>
</header>
<!-- Main header end -->

<!-- Dashbord start -->
<div class="dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-pad">   <!-- MENU LATERAL -->
                <div class="dashboard-nav d-none d-xl-block d-lg-block">
                    <div class="dashboard-inner">
                        <h4>Principal</h4>
                        <ul>
                            <li class="active"><a href="index.php?action=inicio"><i class="flaticon-dashboard"></i> Dashboard</a></li>
                            <!--<li><a href="messages.html"><i class="flaticon-mail"></i> Messages <span class="nav-tag">6</span></a></li>
                            <li><a href="bookings.html"><i class="flaticon-calendar"></i> Bookings</a></li>-->
                        </ul>
                        <h4>Listados</h4>
                        <ul>
                            <li><a href="index.php?action=mis-propiedades"><i class="flaticon-apartment-1"></i>Propiedades</a></li>
                            <li><a href="index.php?action=mis-usuarios"><i class="flaticon-people"></i>Usuarios</a></li>
                            <!--<li><a href="my-invoices.html"><i class="flaticon-bill"></i>My Invoices</a></li>
                            <li><a href="favorited-properties.html"><i class="flaticon-heart"></i>Favorited Properties</a></li>-->

                        </ul>
                        <h4>Registrar</h4>
                        <ul>
                            <li><a href="index.php?action=agrega-propiedad"><i class="flaticon-plus"></i>Propiedad</a></li>
                            <li><a href="index.php?action=agrega-usuario"><i class="flaticon-plus"></i>Usuario</a></li>
                        </ul>
                        <h4>Cuenta</h4>
                        <ul>
                            <li><a href="index.php?action=edita-usuario&idEditar=<?php echo $_SESSION['id']; ?>" class="nav-link"><i class="flaticon-people"></i>Mi Perfil</a></li>
                            <li><a href="index.php?action=salir"><i class="flaticon-logout"></i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- END MENU LATERAL -->


            <div class="col-lg-9 col-md-12 col-sm-12 col-pad"> <!-- CONTENIDO CENTRAL -->
                <div class="content-area5">
                    <div class="dashboard-content">


