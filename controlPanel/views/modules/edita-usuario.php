<?php
//session_start();
if(!$_SESSION["validar"]){

    header("location:index.php");

    exit();
}

$usuario = $_REQUEST['idEditar'];
$busqueda = Datos::mdlBuscaEmpleado($usuario, "usuarios");

$sociales = json_decode($busqueda["sociales"], true);


include "navAdmin.php";
 ?>

 <script type="text/javascript">


    var check = function() {
      $('#new-password, #confirm-new-password').on('keyup', function () {
        if ($('#new-password').val() == $('#confirm-new-password').val()) {
            $('#message').html('Coinciden').css('color', 'green');
            //document.getElementById('actualiza').disabled = false;
        }
        else $('#message').html('No coinciden').css('color', 'red');
        //document.getElementById('actualiza').disabled = true;
    });
    }

 </script>
<form action="" method="POST" enctype="multipart/form-data">
<div class="col-sm-12 col-md-6"><h4>Editar datos de usuario</h4></div>
<div class="dashboard-list">
    <h3 class="heading">Datos Personales</h3>
    <div class="dashboard-message contact-2 bdr clearfix">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <!-- Edit profile photo -->
                <div class="edit-profile-photo">
                    <img src="<?php echo $busqueda['foto'];?>" alt="profile-photo" class="img-fluid previsualizar">
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span><i class="fa fa-upload"></i></span>
                            <input type="file" name="nuevaFoto" class="upload">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group name">
                                <input required type="text" name="id" value="<?php echo $usuario; ?>" hidden>
                                <input required type="text" name="foto" value="<?php echo $busqueda['foto']; ?>" hidden>
                                <label>Nombre</label>
                                <input required type="text" name="name" value="<?php echo $busqueda['nombre'];?>" class="form-control" placeholder="Nombre completo">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group email">
                                <label>Puesto</label>
                                <input type="text" name="title" value="<?php echo $busqueda['titulo'];?>" class="form-control" placeholder="Puesto en la empresa">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group subject">
                                <label>Telefono</label>
                                <input type="text" name="phone" value="<?php echo $busqueda['telefono'];?>" class="form-control" placeholder="Telefono de contacto">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group number">
                                <label>Email</label>
                                <input required type="email" name="email" value="<?php echo $busqueda['email'];?>" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group number">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="fechaNac" value="<?php echo $busqueda['fechaNac'];?>" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group number">
                                <label>Perfil de Usuario <?php echo $busqueda['perfil']; ?></label>
                                <select name="profile" class="form-control">
                              <?php
                                if ($busqueda['perfil']=="usuairo"){echo '<option value="usuario" selected>Usuario</option>';}
                                else {echo '<option value="usuario">Usuario</option>';}
                                if ($busqueda['perfil']=="administrador") {echo '<option value="administrador" selected>Administrador</option>';}
                                else {echo '<option value="Administrador">Administrador</option>';}
                              ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group message">
                                <label>Información Personal</label>
                                <textarea class="form-control" name="personal"placeholder="ej. Activo, gusta de la buena musica, etc"><?php echo $busqueda['personal'];?></textarea>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="dashboard-list">
            <h3 class="heading">Actualiza tu password</h3>
            <div class="dashboard-message contact-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group email">
                                <label>Password</label>
                                <input  type="password" id="new-password" name="new-password" value="<?php echo $busqueda['password'];?>" class="form-control" placeholder="Nuevo Password" onkeyup='check();'>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group subject">
                                <label>Confirma Password</label>
                                <input type="password" id="confirm-new-password" name="confirm-new-password" value="<?php echo $busqueda['password'];?>" class="form-control" placeholder="Confirme Password" onkeyup='check();'>
                                <span id='message'></span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="dashboard-list">
            <h3 class="heading">Redes Sociales</h3>
            <div class="dashboard-message contact-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group name">
                                <label>Facebook</label>
                                <input type="text" name="facebook" value="<?php echo $sociales['Facebook'];?>" class="form-control" placeholder="https://www.facebook.com">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group email">
                                <label>Twitter</label>
                                <input type="text" name="twitter" value="<?php echo $sociales['Twitter'];?>" class="form-control" placeholder="https://twitter.com">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group subject">
                                <label>LinkedIn</label>
                                <input type="text" name="linkedin" value="<?php echo $sociales['LinkedIn'];?>" class="form-control" placeholder="linkedin.com">
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div> <!-- row -->

<div class="row">
    <div class="col-lg-3">
    </div>
    <div class="col-lg-3">
        <div  class="send-btn">
            <button type="button" class="btn btn-md btn-secondary" onclick="window.location.href = 'index.php?action=mis-usuarios'">Cancelar</button>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="send-btn">
            <button type="submit" class="btn btn-md button-theme" name="actualiza" id="actualiza" >Actualizar Datos</button>
        </div>
    </div>

    <br><br><br><br><br><br><br><br>
</div>

</form>

<?php

$actualiza = new MvcController();
$actualiza -> ctlActualizaUsuario();


include "footer.php";
 ?>