<?php
//session_start();

if(!$_SESSION["validar"]){

    header("location:index.php");

    exit();

}

$propiedad = $_REQUEST['idEditar'];
$busqueda = Datos::mdlBuscaPropiedad($propiedad, "propiedades");
$caract = json_decode($busqueda["caracteristicas"], true);

//var_dump($caract);


include "navAdmin.php";


 ?>

<div class="col-sm-12 col-md-6"><h4>Editar Datos de Propiedad</h4></div>

<div class="submit-address dashboard-list">
    <form action="" method="POST">
        <input type="text" class="input-text" value="<?php echo $propiedad; ?>" name="id" hidden>
        <h4 class="bg-grea-3">Informaci&oacute;n B&aacute;sica</h4>
        <div class="search-contents-sidebar">
            <div class="row pad-20">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="input-text" value="<?php echo $busqueda["titulo"]; ?>" name="nombre" placeholder="Titulo de la propiedad" required>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="selectpicker search-fields" name="status" required>
                            <option value="Venta">Venta</option>
                            <option value="Renta">Renta</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="text" class="input-text" value="<?php echo $busqueda["precio"]; ?>" name="precio" placeholder="sin signos, puntos y comas" required>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Habitaciones</label>
                        <select class="selectpicker search-fields" name="habitaciones" required>
                            <option value="1" <?php if ($busqueda['habitaciones']==1) echo 'selected'; ?> >1</option>
                            <option value="2" <?php if ($busqueda['habitaciones']==2) echo 'selected'; ?> >2</option>
                            <option value="3" <?php if ($busqueda['habitaciones']==3) echo 'selected'; ?> >3</option>
                            <option value="4" <?php if ($busqueda['habitaciones']==4) echo 'selected'; ?> >4</option>
                            <option value="5" <?php if ($busqueda['habitaciones']==5) echo 'selected'; ?> >5</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Ba&ntilde;os</label>
                        <select class="selectpicker search-fields" name="banos" required>
                            <option <?php if ($busqueda['banos']==1) echo 'selected'; ?> >1</option>
                            <option <?php if ($busqueda['banos']==2) echo 'selected'; ?> >2</option>
                            <option <?php if ($busqueda['banos']==3) echo 'selected'; ?> >3</option>
                            <option <?php if ($busqueda['banos']==4) echo 'selected'; ?> >4</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Categor&iacute;a</label>
                        <select class="selectpicker search-fields" name="categoria" required>
                            <option <?php if ($busqueda['categoria']=="Departamento") echo 'selected'; ?> >Departamento</option>
                            <option <?php if ($busqueda['categoria']=="Casa") echo 'selected'; ?> >Casa</option>
                            <option <?php if ($busqueda['categoria']=="Terreno") echo 'selected'; ?> >Terreno</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Area Terreno</label>
                        <input type="text" class="input-text" name="mtsTerreno" value="<?php echo $busqueda["areaTerreno"]; ?>" placeholder="Metros Cuadrados">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Area Construcci&oacute;n</label>
                        <input type="text" class="input-text" name="mtsConstruccion" value="<?php echo $busqueda["areaConstruccion"]; ?>" placeholder="Metros Cuadrados">
                    </div>
                </div>
            </div>
        </div>
        <h4 class="bg-grea-3">Ubicaci&oacute;n</h4>
        <div class="row pad-20">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Direcci&oacute;n</label>
                    <input type="text" class="input-text" name="direccion" value="<?php echo $busqueda["direccion"]; ?>" placeholder="Direcci&oacute;n" required>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Ciudad</label>
                    <input type="text" class="input-text" name="ciudad" value="<?php echo $busqueda["ciudad"]; ?>" placeholder="Ciudad" required>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Estado</label>
                    <select class="selectpicker search-fields" name="estado" required>
                        <option value="Aguascalientes" <?php if ($busqueda['estado']=="Aguascalientes") echo 'selected'; ?> >Aguascalientes</option>
                        <option value="Baja California" <?php if ($busqueda['estado']=="Baja California") echo 'selected'; ?> >Baja California</option>
                        <option value="Baja California Sur" <?php if ($busqueda['estado']=="Baja California Sur") echo 'selected'; ?> >Baja California Sur</option>
                        <option value="Campeche" <?php if ($busqueda['estado']=="Campeche") echo 'selected'; ?> >Campeche</option>
                        <option value="Coahuila de Zaragoza" <?php if ($busqueda['estado']=="Coahuila de Zaragoza") echo 'selected'; ?> >Coahuila de Zaragoza</option>
                        <option value="Colima" <?php if ($busqueda['estado']=="Colima") echo 'selected'; ?> >Colima</option>
                        <option value="Chiapas" <?php if ($busqueda['estado']=="Chiapas") echo 'selected'; ?> >Chiapas</option>
                        <option value="Chihuahua" <?php if ($busqueda['estado']=="Chihuahua") echo 'selected'; ?> >Chihuahua</option>
                        <!--<option value="9">Distrito Federal</option>
                        <option value="10">Durango</option>
                        <option value="11">Guanajuato</option>
                        <option value="12">Guerrero</option>
                        <option value="13">Hidalgo</option>
                        <option value="14">Jalisco</option>
                        <option value="15">México</option>
                        <option value="16">Michoacán de Ocampo</option>
                        <option value="17">Morelos</option>
                        <option value="18">Nayarit</option>
                        <option value="19">Nuevo León</option>
                        <option value="20">Oaxaca</option>
                        <option value="21">Puebla</option>
                        <option value="22">Querétaro</option>
                        <option value="23">Quintana Roo</option>
                        <option value="24">San Luis Potosí</option>
                        <option value="25">Sinaloa</option>
                        <option value="26">Sonora</option>
                        <option value="27">Tabasco</option>
                        <option value="28">Tamaulipas</option>
                        <option value="29">Tlaxcala</option>
                        <option value="30">Veracruz de Ignacio de la Llave</option>
                        <option value="31">Yucatán</option>
                        <option value="32">Zacatecas</option>-->
                    </select>
                   <!--  <select class="selectpicker search-fields" name="choose-state">
                        <option>Choose State</option>
                        <option>Alabama</option>
                        <option>California</option>
                        <option>Florida</option>
                    </select> -->
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12">
                <div class="form-group">
                    <label>C.P.</label>
                    <input type="text" class="input-text" name="CP" value="<?php echo $busqueda["CP"]; ?>" placeholder="CP">
                </div>
            </div>
        </div>
        <h4 class="bg-grea-3">Foto Principal</h4>
        <div class="col-lg-3 col-md-3">
                <div class="edit-profile-photo">
                    <img src="<?php echo $busqueda["fotos"]; ?>" alt="profile-photo" class="img-fluid previsualizar">
                    <div class="change-photo-btn">
                        <div class="photoUpload">
                            <span><i class="fa fa-upload"></i></span>
                            <input type="file" name="nuevaFoto" class="upload">
                        </div>
                    </div>
                </div>
            </div>

        <h4 class="bg-grea-3">Informaci&oacute;n Detallada</h4>
        <div class="row pad-20">
            <div class="col-lg-12">
                <textarea class="input-text" name="detalles" value="<?php echo $busqueda["detalles"]; ?>" placeholder="Mas detalles"></textarea>
            </div>
        </div>
        <h4 class="bg-grea-3">Caracter&iacute;sticas (opcional)</h4>
        <div class="row pad-20">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="estacionamiento" name="estacionamiento" type="checkbox" value="1" <?php if ($caract['estacionamiento']=="1") echo 'checked'; ?>>
                    <label for="estacionamiento">
                        Estacionamiento
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="AC" type="checkbox" name="AC" value="1" <?php if ($caract['AC']=="1") echo 'checked'; ?>>
                    <label for="AC">
                        Aire Acondicionado
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="piscina" type="checkbox" name="piscina" value="1" <?php if ($caract['piscina']=="1") echo 'checked'; ?>>
                    <label for="piscina">
                        Piscina
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="lavanderia" type="checkbox" name="lavanderia" value="1" <?php if ($caract['lavanderia']=="1") echo 'checked'; ?>>
                    <label for="lavanderia">
                        Lavander&iacute;a
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="calefaccion" type="checkbox" name="calefaccion" value="1" <?php if ($caract['calefaccion']=="1") echo 'checked'; ?>>
                    <label for="calefaccion">
                        Calefacci&oacute;n Central
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="alarma" type="checkbox" name="alarma" value="1" <?php if ($caract['alarma']=="1") echo 'checked'; ?>>
                    <label for="alarma">
                        Alarma
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="parque" type="checkbox" name="parque" value="1" <?php if ($caract['parque']=="1") echo 'checked'; ?>>
                    <label for="parque">
                        Parque / Areas Verdes
                    </label>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="checkbox checkbox-theme checkbox-circle">
                    <input id="ventanas" type="checkbox" name="ventanas" value="1" <?php if ($caract['ventanas']=="1") echo 'checked'; ?>>
                    <label for="ventanas">
                        Ventanas Doble Vidrio
                    </label>
                </div>
            </div>
        </div>
        <h4 class="bg-grea-3">Representante de Ventas</h4>
        <div class="row pad-20">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="input-text" name="agenteID" value="<?php echo $busqueda["vendedor"]; ?>" placeholder="Id del Agente" required>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="input-text" name="email" placeholder="Email">
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Phone (optional)</label>
                    <input type="text" class="input-text" name="phone"  placeholder="Phone">
                </div>
            </div>

        </div>

        <div style="text-align: center;" class="bg-grea-3 col-lg-12 col-md-12 col-sm-12">
            <button type="submit" class="btn btn-md button-theme" name="actualiza">Actualizar Datos</button>
        </div>
    </form>
</div>


<?php
$actualiza = new MvcController();
$actualiza -> ctrActualizaPropiedad();
include "footer.php";
 ?>