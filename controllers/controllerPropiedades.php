<?php

require_once ('./models/buscaModel.php');

class Propiedades {


    public static function ctrBusquedas($busca){
        $textoBuscar = $_POST['textoBuscar'];
        $minArea = $_POST['minArea'];
        $maxArea = $_POST['maxArea']; 
        $habitaciones = $_POST['habitaciones'];
        $banos = $_POST['banos'];
        $minPrecio = $_POST['minPrecio'];
        $maxPrecio = $_POST['maxPrecio']; 

        $opciones = array( "textoBuscar" => $textoBuscar,
                           "minArea" => $minArea,
                           "maxArea" => $maxArea,
                           "habitaciones" => $habitaciones,
                           "banos" => $banos,
                           "minPrecio" => $minPrecio,
                           "maxPrecio" => $maxPrecio);

        $Resultado = BuscaModel::mdlBusquedasPropiedades("propiedades", $opciones);

        if (is_null($Resultado) || empty($Resultado)){
            echo "<h1>No se encontraron Resultados</h1>";
        }else{
            foreach ($Resultado as $row => $item){

                echo '<div class="col-lg-4 col-md-6 col-12">
                        <div class="flat-item">
                            <div class="flat-item-image">
                                <span class="for-sale rent">'.$item["status"].'</span>';
                                if ($item["status"] === "Vendida") {
                                    echo '<a class= "marca-de-agua" href="properties-details.php?idPro='.$item["id"].'"><img style="width: 100%; height: 235px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>';
                                }else{
                                    echo '<a href="properties-details.php?idPro='.$item["id"].'"><img style="width: 100%; height: 235px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>';
                                }
                                echo '
                                
                                <div class="flat-link">
                                    <a href="properties-details.php?idPro='.$item["id"].'">Mas detalles</a>
                                </div>
                                <ul class="flat-desc">
                                    <li>
                                        <img src="modules/images/icons/4.png" alt="">
                                        <span>'.$item["areaTerreno"].'</sup></span>
                                    </li>
                                    <li>
                                        <img src="modules/images/icons/5.png" alt="">
                                        <span>'.$item["habitaciones"].'</span>
                                    </li>
                                    <li>
                                        <img src="modules/images/icons/6.png" alt="">
                                        <span>'.$item["banos"].'</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="flat-item-info">
                                <div class="flat-title-price">
                                    <h5><a href="properties-details.php?idPro='.$item["id"].'">'.$item["titulo"].'</a></h5>
                                    <span class="price">$'.number_format($item["precio"]).' USD </span>
                                </div>
                                <p><img src="modules/images/icons/location.png" alt="">'.$item["direccion"].'</p>
                            </div>
                        </div>
                    </div>';
            }
        }
    }









	public static function ctlBuscaPropiedades ($Tipo) {

		$Resultado = BuscaModel::mdlBuscaPropiedades("propiedades", $Tipo);

		foreach ($Resultado as $row => $item){

			echo '<div class="col-lg-4 col-md-6 col-12">
                            <div class="flat-item">
                                <div class="flat-item-image">
                                    <span class="for-sale rent">'.$item["status"].'</span>';
                                    if ($item["status"] === "Vendida") {
                                        echo '<a class= "marca-de-agua" href="properties-details.php?idPro='.$item["id"].'"><img style="width: 100%; height: 235px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>';
                                    }else{
                                        echo '<a href="properties-details.php?idPro='.$item["id"].'"><img style="width: 100%; height: 235px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>';
                                    }
                                    echo '
                                    
                                    <div class="flat-link">
                                        <a href="properties-details.php?idPro='.$item["id"].'">Mas detalles</a>
                                    </div>
                                    <ul class="flat-desc">
                                        <li>
                                            <img src="modules/images/icons/4.png" alt="">
                                            <span>'.$item["areaTerreno"].'</sup></span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/5.png" alt="">
                                            <span>'.$item["habitaciones"].'</span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/6.png" alt="">
                                            <span>'.$item["banos"].'</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flat-item-info">
                                    <div class="flat-title-price">
                                        <h5><a href="properties-details.php?idPro='.$item["id"].'">'.$item["titulo"].'</a></h5>
                                        <span class="price">$'.number_format($item["precio"]).' USD </span>
                                    </div>
                                    <p><img src="modules/images/icons/location.png" alt="">'.$item["direccion"].'</p>
                                </div>
                            </div>
                        </div>';

		}

	}

    public static function ctlBuscaPropiedadesrecientes(){

        $Resultado = BuscaModel::mdlBuscaPropiedadesrecientes("propiedades");

        foreach ($Resultado as $row => $item) {
           echo '<div class="col-lg-4 col-md-6 col-12">
                            <div class="flat-item">
                                <div class="flat-item-image">
                                    <span class="for-sale rent">'.$item["status"].'</span>
                                    <a href="properties-details.php?idPro='.$item["id"].'"><img style="width: 100%; height: 235px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>
                                    <div class="flat-link">
                                        <a href="properties-details.php?idPro='.$item["id"].'">Mas detalles</a>
                                    </div>
                                    <ul class="flat-desc">
                                        <li>
                                            <img src="modules/images/icons/4.png" alt="">
                                            <span>'.$item["areaTerreno"].'</span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/5.png" alt="">
                                            <span>'.$item["habitaciones"].'</span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/6.png" alt="">
                                            <span>'.$item["banos"].'</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flat-item-info">
                                    <div class="flat-title-price">
                                        <h5><a href="properties-details.php?idPro='.$item["id"].'">'.$item["titulo"].'</a></h5>
                                        <span class="price">$'.number_format($item["precio"]).' ' .$item["moneda"]. '</span>
                                    </div>
                                    <p><img src="modules/images/icons/location.png" alt="">'.$item["direccion"].'</p>
                                </div>
                            </div>
                        </div>';
        }


    }

    public static function ctlHayOfertas () {
        $Resultado = BuscaModel::mdlHayOfertas("propiedades");

        if ($Resultado) {
            echo '
            <div class="featured-flat-area pt-0 pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title-2 text-center">
                                <h2>Propiedades en Oferta</h2>
                            </div>
                        </div>
                    </div>
                    <div class="featured-flat">
                        <div class="row">

                            ';

                            self::ctlBuscaPropiedadesOferta();
                            echo '
                        </div>
                    </div>
                </div>
            </div>';
        }


    }

    public static function ctlBuscaPropiedadesOferta () {
        $Resultado = BuscaModel::mdlBuscaPropiedadesOferta("propiedades");

        foreach ($Resultado as $row => $item) {
           echo '<div class="col-lg-4 col-md-6 col-12">
                            <div class="flat-item">
                                <div class="flat-item-image">
                                    <span class="for-sale rent">'.$item["status"].'</span>
                                    <a href="properties-details.php?idPro='.$item["id"].'"><img style="width: 100%; height: 235px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>
                                    <div class="flat-link">
                                        <a href="properties-details.php?idPro='.$item["id"].'">Mas detalles</a>
                                    </div>
                                    <ul class="flat-desc">
                                        <li>
                                            <img src="modules/images/icons/4.png" alt="">
                                            <span>'.$item["areaTerreno"].'</span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/5.png" alt="">
                                            <span>'.$item["habitaciones"].'</span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/6.png" alt="">
                                            <span>'.$item["banos"].'</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flat-item-info">
                                    <div class="flat-title-price">
                                        <h5><a href="properties-details.php?idPro='.$item["id"].'">'.$item["titulo"].'</a></h5>
                                        <span class="alert" style="color: red"><s>$'.number_format($item["precio"]).'</s></span><span class="price">$'.number_format($item["precioOferta"]).' '.$item["moneda"].'</span>

                                    <p><img src="modules/images/icons/location.png" alt="">'.$item["direccion"].'</p>

                                </div>

                                </div>
                            </div>
                        </div>';
        }


        return 1;
    }

}

?>