<!-- Contact section start -->
<div class="contact-section overview-bgi">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form content box start -->
                <div class="form-content-box">
                    <!-- details -->
                    <div class="details">
                        <!-- Logo -->
                        <a href="index.html">
                            <img src="views/img/logos/black-logo.png" class="cm-logo" alt="black-logo">
                        </a>
                        <!-- Name -->
                        <h3>Sign into your account</h3>
                        <!-- Form start
                        <form action="index.html" method="GET">-->
                          <form id="login-form" name="login-form" class="nobottommargin" method="post" onsubmit="return validarIngreso()">
                            <div class="form-group">
                                <input type="text" name="usuarioIngreso" id="usuarioIngreso" class="input-text" placeholder="Email">

                            </div>
                            <div class="form-group">
                                <input type="password" id="passwordIngreso" name="passwordIngreso" class="input-text" placeholder="Password">

                            </div>
                            <div class="checkbox">
                                <a href="index.php?action=lostPassword" class="link-not-important pull-right">Olvido su Password</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md button-theme btn-block">login</button>
                            </div>


                        </form>
                        <?php

                        $ingreso = new Ingreso();
                        $ingreso -> ingresoController();

                        ?>
                    </div>

                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- Contact section end -->