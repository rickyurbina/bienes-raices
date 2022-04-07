<?php
/*session_start();

if(!$_SESSION["validar"]){

    header("location:index.php");

    exit();


}*/
include "navAdmin.php";
 ?>
<form action="" method="POST" enctype="multipart/form-data">
<div class="col-sm-12 col-md-6"><h4>Registrar Nuevo Usuario</h4></div>
<div class="dashboard-list">
    <h3 class="heading">Datos Personales</h3>
    <div class="dashboard-message contact-2 bdr clearfix">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <!-- Edit profile photo -->
                <div class="edit-profile-photo">
                    <img src="views/img/usuarios/usuario.png" alt="profile-photo" class="img-fluid previsualizar">
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
                                <label>Nombre</label>
                                <input required type="text" name="name" class="form-control" placeholder="Nombre completo">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group email">
                                <label>Puesto</label>
                                <input type="text" name="title" class="form-control" placeholder="Puesto en la empresa">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group subject">
                                <label>Telefono</label>
                                <input type="text" name="phone" class="form-control" placeholder="Telefono de contacto">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group number">
                                <label>Email</label>
                                <input required type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group number">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="fechaNac" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group number">
                                <label>Perfil de Usuario</label>
                                <select name="profile" class="form-control">
                                  <option value="usuario">Usuario</option>
                                  <option value="administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group message">
                                <label>Información Personal</label>
                                <textarea class="form-control" name="personal" placeholder="ej. Activo, gusta de la buena musica, etc"></textarea>
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
            <h3 class="heading">Password</h3>
            <div class="dashboard-message contact-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group email">
                                <label>Password</label>
                                <input required type="password" name="new-password" class="form-control" placeholder="Nuevo Password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group subject">
                                <label>Confirma Password</label>
                                <input type="password" name="confirm-new-password" class="form-control" placeholder="Confirme Password">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="send-btn">
                <button type="submit" class="btn btn-md button-theme">Registrar Usuario</button>
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
                                <input type="text" name="facebook" class="form-control" placeholder="https://www.facebook.com">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group email">
                                <label>Twitter</label>
                                <input type="text" name="twitter" class="form-control" placeholder="https://twitter.com">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group subject">
                                <label>LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control" placeholder="linkedin.com">
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div> <!-- row -->
</form>
<?php
    $crearUsuario = new MvcController();
    $crearUsuario -> ctrCrearUsuario();

    include "footer.php";
 ?>