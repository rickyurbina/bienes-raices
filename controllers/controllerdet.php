<?php

require_once './models/Modeldet.php';

class Propiedad {
  public function ctlBuscaPropiedad ($idPropiedad) {
    $propiedad = detModel::mdlBuscaPropiedaddet($idPropiedad, "propiedades");
    $fotosPropiedad = array(explode('/', $propiedad['fotoPrincipal'])[3]);
    
    $fotos = json_decode($propiedad['fotos'], true);

    foreach ($fotos as $foto) {
      array_push($fotosPropiedad, $foto);
    }

    $caracteristicas = json_decode($propiedad['caracteristicas'], true);

    if ($propiedad["latitud"] || $propiedad["longitud"]){
      $ubicacion = '<a href="https://www.google.com.mx/maps/dir/'.$propiedad['latitud'].','.$propiedad['longitud'].'/"
                        target="_blank"> 
                        <button class="submit-btn-1">Ver Mapa</button>
                    </a>';
    }

    echo 
      '<div class="breadcrumbs-area bread-bg-1 bg-opacity-black-70">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="breadcrumbs">
                <h2 class="breadcrumbs-title"></h2>
                <ul class="breadcrumbs-list">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="properties.php?categoria=">Propiedades</a></li>
                  <li>Detalles de la propiedad</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>';

      echo 
        '<div style="display: flex; flex-direction: column; margin: 4rem 1rem 4rem 1rem;">
          <div class="row" style="justify-content: center">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-4">
              <h2>' . $propiedad['titulo'] . '</h2>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-7"></div>
          </div>
          <br />
          <div class="row" style="justify-content: center">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-4" style=" display: flex; flex-direction: column;">
              <img id="mainImage" src="controlPanel/' . $propiedad['fotoPrincipal'] . '" alt="Imagen" style=" aspect-ratio: 1 / 1">
              <div style="margin-top: 1rem;  height: 200px; overflow: auto; display: flex; gap: 1rem; padding-right: 1rem">
                ' . $this -> generateFotos($fotosPropiedad) . '
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-7" style="">
              <div class="row mt-5">
                <div class="col-12"><h3>' . $propiedad['direccion'] . ' ' . $propiedad['ciudad'] . ', ' . $propiedad['estado'] . '</h3></div>
                <div class="col-12">' . $this -> generatePrecio($propiedad) . '</div>
                <br><br>
                <div class="col-12">'.
                  $ubicacion
                .'</div>
  
              </div>
              <br />
              <div class="row"> 
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 mb-5" style=" display: flex; flex-direction: column;">
                  <h4>Distribución</h4>
                  <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.5rem;">
                    <span class="det"><img src="modules/images/icons/7.png" alt="" style="width: 20px;">&nbsp;&nbsp;Área del terreno: ' . $propiedad['areaTerreno'] . ' acres</span>
                    <span class="det"><img src="modules/images/icons/9.png" alt="" style="width: 20px;">&nbsp;&nbsp;Construcción: ' . $propiedad["areaConstruccion"] . ' ft<sup>2</sup></span>
                    <span class="det"><img src="modules/images/icons/5.png" alt="" style="width: 20px;">&nbsp;&nbsp;Habitaciones: ' . $propiedad['habitaciones'] . ' </span>
                    <span class="det"><img src="modules/images/icons/6.png" alt="" style="width: 20px;">&nbsp;&nbsp;Baños: ' . $propiedad['banos'] . '</span>
                  </div>
                  <br />
                  <h4>Adicionales</h4>
                  <div>
                    <ul class="lista">
                    ' . $this -> generateCaracteristicas($caracteristicas) . '
                    </ul>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7" style=" display: flex; flex-direction: column;">
                  <h4>Detalles</h4>
                  <div style="white-space: pre-line">' . $propiedad['detalles'] . '</div>
                </div>
              </div>
            </div>
          </div>
        </div>';


  }

  private function generateFotos($fotosPropiedad) {
    $resultado = '';
    foreach ($fotosPropiedad as $foto) {
      if ($foto){
      $resultado .= '<a href="controlPanel/views/img/propiedades/' . $foto . '" data-lightbox="roadtrip" class="col-sm-4">
                       <img src="controlPanel/views/img/propiedades/' . $foto . '" class="img-fluid">
                    </a> 
        ';
      }
    }
    return $resultado;
  }
  
  private function generateCaracteristicas($caracteristicas) {
    $resultado = '';

    foreach($caracteristicas as $caracteristica => $value) {
      if ($value != null) {
        $resultado .= '<li><i class="fa fa-check-square"></i>&nbsp;' . $caracteristica .  ' </li>';
      }
    }

    return $resultado; 
  }

  private function generatePrecio($propiedad) {

    if ($propiedad['oferta'] == 0) {
      return '<h3 style="color: #95C41F;">$' . number_format($propiedad['precio']) . ' ' . $propiedad['moneda'] . '</h3>';
    } else {
      return '<h3></h3>';
    }
  }
}

