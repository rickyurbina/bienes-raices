<?php
	if (!isset($_SESSION)){
        session_start();
    }
?>


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
                        <h3>Recupere aquí su contraseña</h3>
                        <!-- Form start
                        <form action="index.html" method="GET">-->
                        	<br><br>
                          <form id="login-form" name="login-form" class="nobottommargin" method="post" onsubmit="return validarIngreso()">

							<div class="col_full">
								<label for="login-form-username">Email:</label>
								<input required="true" type="email" id="usuarioIngreso" name="mailLost" placeholder="Escriba aqui su correo electr&oacute;nico"  class="form-control not-dark" />
							</div>
							<br><br><br><br>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md button-theme btn-block" name="enviaMail">Enviar</button>
                            </div>
							<div class="checkbox">
							    <a href="index.php" class="link-not-important pull-right">volver al login</a>
							    <div class="clearfix"></div>
							</div>

						</form>
                        <?php
                        $envia = Mailer::envia();

                        if( $envia == "ok" ){
								echo '<script>

										swal({

											type: "success",
											title: "¡Se ha enviado un correo con tus datos de acceso!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){

											if(result.value){

												window.location = "index.php";

											}

										});


										</script>';
							}
							else if ($envia == "no existe"){
								echo '<script>

										swal({

											type: "error",
											title: "¡No existe un usuario con ese correo, por favor contacte al administrador del sistema!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){

											if(result.value){

												//window.location = "index.php";

											}

										});


										</script>';
							}
							else if ($envia == "error al enviar"){
								echo '<script>

										swal({

											type: "error",
											title: "¡El sistema no pudo enviar el correo, intente mas tarde!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"

										}).then(function(result){

											if(result.value){

												window.location = "index.php";

											}

										});


										</script>';
							}


                        ?>
                    </div>

                </div>
                <!-- Form content box end -->
            </div>
        </div>
    </div>
</div>
<!-- Contact section end -->
