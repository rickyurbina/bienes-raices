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

        /* alt="">Area '.$item["areaTerreno"].' </li>
//                                                     <li><img src="modules/images/icons/9.png" alt="">Const. '.$item["areaConstruccion"].' ft<sup>2</sup></li>
//                                                     <li><img src="modules/images/icons/5.png" alt="">Recamaras: '.$item["habitaciones"].'</li>
//                                                     <li><img src="modules//images/icons/6.png" alt="">Baños: '.$item["banos"].'</li> */
  }

  private function generateFotos($fotosPropiedad) {
    $resultado = '';
    foreach ($fotosPropiedad as $foto) {
      $resultado .= '<img src="controlPanel/views/img/propiedades/' . $foto . '" style="height: 100%; cursor: pointer;" onclick="cambiarFoto(\'' . $foto . '\')">';
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

// require_once ('./models/Modeldet.php');

// class Propiedad {

// 	public static function ctlBuscaPropiedad ($id) {
// 		$cont =2;
// 		$item= detModel::mdlBuscaPropiedaddet($id,"propiedades");
// 		$resultado = detModel:: mdlbuscaAgente("usuarios");
// 		$caract = json_decode($item["caracteristicas"], true);
//         //`$social = json_decode($item["sociales"], true);
//         $fotos = json_decode($item["fotos"], true);
//         $redes = json_decode($resultado["sociales"],true);

//       	echo '<div class="breadcrumbs-area bread-bg-1 bg-opacity-black-70">
//             <div class="container">
//                 <div class="row">
//                     <div class="col-12">
//                         <div class="breadcrumbs">
//                             <h2 class="breadcrumbs-title"></h2>
//                             <ul class="breadcrumbs-list">
//                                 <li><a href="index.php">Home</a></li>
//                                 <li><a href="properties.php?categoria=">Propiedades</a></li>
//                                 <li>Detalles de la propiedad</li>
//                             </ul>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>


//         <!-- Start page content -->
//         <section id="page-content" class="page-wrapper">

//             <!-- PROPERTIES DETAILS AREA START -->
//             <div class="properties-details-area pt-115 pb-60">
//                 <div class="container">
//                     <div class="row">
//                         <div class="col-lg-8">
//                         <h2>'.$item["titulo"].'</h2>
//                             <!-- pro-details-image -->
//                             <div class="pro-details-image mb-60">
//                                 <div class="pro-details-big-image">
//                                     <div class="tab-content" id="pills-tabContent">
//                                         <div class="tab-pane fade show active" id="pro-1" role="tabpanel" aria-labelledby="pro-1-tab">
//                                             <a href="controlPanel/'.$item["fotoPrincipal"].'" data-lightbox="image-1" data-title="Bienes Raices Corredor Comercial - 1">
//                                                 <img src="controlPanel/'.$item["fotoPrincipal"].'" alt="">
//                                             </a>
//                                         </div>';

//                                         if($fotos != null ){
//                                         foreach ($fotos as $row => $item2) {
//                                             if ($item2 != "") {
//                                                 echo'<div class="tab-pane fade" id="pro-'.$cont.'" role="tabpanel" aria-labelledby="pro-'.$cont.'-tab">
//                                                     <a href="controlPanel/views/img/propiedades/'.$item2.'" data-lightbox="image-1" data-title="Bienes Raices Corredor Comercial - '.$cont.'">
//                                                         <img src="controlPanel/views/img/propiedades/'.$item2.'" alt="" ">
//                                                     </a>
//                                                 </div>';
//                                             }                                       	
//                                             $cont++;
//                                         }}echo'

//                                     </div>
//                                 </div>
//                                 <ul class="nav nav-pills pro-details-navs" id="pills-tab" role="tablist">
//                                     <li class="nav-item">
//                                         <a class="nav-link active" id="pro-1-tab" data-toggle="pill" href="#pro-1" role="tab" aria-controls="pro-1" aria-selected="true"><img style=" height: 180px;" src="controlPanel/'.$item["fotoPrincipal"].'" alt=""></a>
//                                     </li>';
//                                     $cont = 2;
                                   
//                                     if ($fotos != null ) {
//                                         foreach ($fotos as $row => $item2) {
                                            
//                                             if ($item2 != "") {
//                                                 echo '<li class="nav-item">
//                                                     <a class="nav-link" id="pro-'.$cont.'-tab" data-toggle="pill" href="#pro-'.$cont.'" role="tab" aria-controls="pro-'.$cont.'" aria-selected="false"><img style=" height: 180px; width: 180px" src="controlPanel/views/img/propiedades/'.$item2.'" alt=""></a>
//                                                 </li>';
//                                             }
//                                         $cont++;
//                                         }
//                                     }
//                                 echo'
//                                 </ul>
//                                 </br>

//                                 <h4>'.$item["direccion"].', '.$item["ciudad"].', '.$item["estado"].'</h4>';
//                                     if ($item["oferta"]==0) {
//                                         echo '<span class="price">$'.number_format($item["precio"]).' USD</span>';
//                                     }else{
//                                       echo '<h6><s>$'.number_format($item["precio"]).'</s></h6>
//                                             <span class="price">$'.number_format($item["precioOferta"]).' ' . $item['moneda'] .'</span>';
//                                     }
//                                     echo'

//                             </div>


//                             <div class="pro-details-short-info mb-60">
//                                 <div class="row">
//                                     <div class="col-sm-6 col-xs-12">

//                                     </div>
//                                     <div class="col-sm-6 col-xs-12">

//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="pro-details-description mb-50">
//                                  <h5>Detalles</h5>

//                                 <pre>'.$item["detalles"].'</pre>
//                             </div>

//                         </div>
//                         <div class="col-lg-4">
//                             <!-- widget-search-property -->
//                             <div class="pro-details-condition">
//                                     <h5>Distribucion</h5>
//                                         <div class="pro-details-condition-inner bg-gray">
//                                                 <ul class="condition-list">
//                                                     <li><img src="modules/images/icons/7.png" alt="">Area '.$item["areaTerreno"].' </li>
//                                                     <li><img src="modules/images/icons/9.png" alt="">Const. '.$item["areaConstruccion"].' ft<sup>2</sup></li>
//                                                     <li><img src="modules/images/icons/5.png" alt="">Recamaras: '.$item["habitaciones"].'</li>
//                                                     <li><img src="modules//images/icons/6.png" alt="">Baños: '.$item["banos"].'</li>

//                                                 </ul>

//                                             </div>
//                                         </div>
//                                         <div class="pro-details-amenities">
//                                         <h5><br>Adicionales</h5>
//                                             <div class="pro-details-amenities-inner bg-gray">
//                                                 <ul class="amenities-list">';
//                                                     foreach ($caract as $key => $value){
//                                                     if($value != null ){
//                                                     echo '<li>
//                                                             '.$key.'
//                                                         </li>';
//                                                         }
//                                                         };


//                                                 echo'

//                                                 </ul>
//                                             </div>
//                                         </div>
//                     </div>
//                 </div>
//             </div>



//         </section>';





// 	}
//     public static function ctlBuscaAgente(){
//       $resultado = detModel:: mdlbuscaAgente("usuarios");
//       $redes = json_decode($resultado["sociales"],true);

//        echo '
//                     <div class="single-agent">
//                                                 <div class="agent-image">
//                                                     <img style="width: 100%; height: 100%px; " src="controlPanel/'.$resultado["foto"].'" alt="">
//                                                 </div>
//                                                 <div class="agent-info">
//                                                     <div class="agent-name">
//                                                         <h5><a href="#">'.$resultado["nombre"].'</a></h5>
//                                                         <p>agente y Director</p>
//                                                     </div>
//                                                 </div>
//                                                 <div class="agent-info-hover">
//                                                     <div class="agent-name">
//                                                         <h5><a href="#">'.$resultado["nombre"].'</a></h5>
//                                                         <p>agenete y Director</p>
//                                                     </div>
//                                                     <ul class="agent-address">
//                                                         <li><img  src="modules/images/icons/phone-2.png" alt=""><a href="tel:+52'.$resultado["telefono"].'">+52'.$resultado["telefono"].'</a>
//                                                         </li>
//                                                         <li><img src="modules/images/icons/mail-close.png" alt="">'.$resultado["email"].'
//                                                         </li>
//                                                     </ul>
//                                                     <ul class="social-media">';
//                                                      if ($redes["Facebook"] != "") echo'<li><a href="'.$redes["Facebook"].'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
//                                                      if ($redes["Twitter"] != "") echo'<li><a href="'.$redes["Twitter"].'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
//                                                      if ($redes["LinkedIn"] != "") echo'<li><a href="'.$redes["LinkedIn"].'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
//                                                     echo'
//                                                     </ul>
//                                                 </div>
//                                             </div>';
//     }
// }
