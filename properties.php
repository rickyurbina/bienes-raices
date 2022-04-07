<?php
 require "controllers/controllerPropiedades.php";
$Categoria = $_REQUEST['categoria'];
?>

<!doctype html>
<html class="no-js" lang="zxx">
    <?php
        include "modules/Head.php";
        echo "<title>Loewen | Propiedades</title>";
    ?>
<body>

    <style>
        .mapview-container {
            height: 500px;
        }

        @media (max-width: 1220px) {
            .mapview-container {
                height: 350px;
                margin: 1em;
            }
        }
    </style>

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- HEADER AREA START -->
        <?php
            include "modules/Menu.php";
        ?>

        <!-- BREADCRUMBS AREA START -->
        <div class="breadcrumbs-area bread-bg-1 bg-opacity-black-70">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs">
                            <h2 class="breadcrumbs-title">Propiedades</h2>
                            <ul class="breadcrumbs-list">
                                <li><a href="index.php">Home</a></li>
                                <li>Propiedades</li>
                                <?php if ($Categoria != '' ) echo '<li>'.$Categoria.'S'.'</li>'; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS AREA END -->

        <!-- Start page content -->
        <section id="page-content" class="page-wrapper">

            <!-- FEATURED FLAT AREA START -->
            <div class="featured-flat-area pt-50 pb-60">
                <div class="container">
                    <div class="row">                        
                        <div class="col-md-12 col-lg-12 col-xl-12 m-xl-12 mapview-container" id="mapid"></div>
                        <div><p> </p></div>
                    </div>
                

                    <div class="row" id="tablaPropiedades">

                    </div>
                    <div class="row" style="display: none;" id="paginador">
                        <div class="col text-center">
                            <button class="btn btn-paginador" id="btn-paginador-1" onclick="irAPaginaNo(1)" >
                                <i class="fas fa-angle-double-left"></i> 
                            </button>
                            <button class="btn btn-paginador" id="btn-paginador-2" onclick="irAPaginaNo(paginaActual - 1)" >
                                1
                            </button>
                            <button class="btn btn-paginador" style="background-color: #95C41F" id="btn-paginador-3">
                                2
                            </button>
                            <button class="btn btn-paginador" id="btn-paginador-4" onclick="irAPaginaNo(paginaActual + 1)" >
                                3
                            </button>
                            <button class="btn btn-paginador" id="btn-paginador-5" onclick="irAPaginaNo(noPaginas)" >
                                <i class="fas fa-angle-double-right"></i> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FEATURED FLAT AREA END -->

        </section>
        <?php
            include "modules/footer.php";
        ?>

    </div>
    <!-- Body main wrapper end -->

    <!-- Modal Busquedas-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>




    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="modules/js/vendor/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="modules/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Nivo slider js -->
    <script src="modules/lib/js/jquery.nivo.slider.js"></script>
    <!-- ajax-mail js -->
    <script src="modules/js/ajax-mail.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="modules/js/plugins.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="modules/js/main.js"></script>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="modules/Leaflet/dist/leaflet.markercluster.js"></script>
</body>

</html>

<script>
    let myMap = L.map("mapid").setView([28.409274,-106.864454],13);
    var markers = L.markerClusterGroup();
    let tabla = document.getElementById("tablaPropiedades");
    var minVal = 10000;
    var maxVal = 3000000;
    let minArea = document.getElementById("minArea");
    let maxArea = document.getElementById("maxArea");
    let valHabitaciones = document.getElementById("noHabitaciones");
    let valBanos = document.getElementById("noBanos");
    const cajaBusqueda = document.getElementById('search');

    var pinIcon = L.icon({
        iconUrl: './modules/images/pin.png',

        iconSize:     [38, 38], // size of the icon
        iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    let propiedades = [];
    L.tileLayer('https://a.tile.openstreetmap.de/{z}/{x}/{y}.png', {
        attribution:
            '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors' +
            ', Tiles courtesy of <a href="https://geo6.be/">GEO-6</a>',
        maxZoom: 18
    }).addTo(myMap);

    /*markers.addLayer(L.marker([28.4119884,-106.8829357]));
    markers.addLayer(L.marker([28.4066447,-106.8773346]));
    markers.addLayer(L.marker([28.4029008,-106.88164]));
    markers.addLayer(L.marker([28.4137298,-106.8977656]));
    markers.addLayer(L.marker([28.5780055,-106.9182677]));*/
    
    function limpiarFiltro() {
        //window.location.reload();
        document.getElementById("myForm").reset();

    }

    let paginaActual = 1;
    let noPaginas = 0;


    function obtenerFiltro() {
        tabla.innerHTML = ``;
        myMap.removeLayer(markers);
        markers =  L.markerClusterGroup();
        let texto = ``; 
        noPaginas = 0;
        const tempPropiedades = [];
        
        const p0 = performance.now();

        for (let i = 0; i < propiedades.length; i++) {
            const propiedad = propiedades[i];

            if (propiedad.status === 'Vendida') {
                continue;
            }

            let totalStats = 0;
            let matchedStats = 0;
            
            // console.log(minArea.value, propiedad.areaTerreno, propiedad.areaTerreno >= minArea.value);

            if (minArea.value) {
                totalStats++;
                if (propiedad.areaTerreno >= minArea.value) {
                    matchedStats++;
                }
            }

            if (maxArea.value) {
                totalStats++;
                if (propiedad.areaTerreno <= maxArea.value) {
                    matchedStats++;
                }
            }

            if (valHabitaciones.value) {
                totalStats++;
                if (propiedad.habitaciones === valHabitaciones.value) {
                    matchedStats++;
                }
            }

            if (valBanos.value) {
                totalStats++;
                if (propiedad.banos === valBanos.value) {
                    matchedStats++;
                }
            }

            const precioPropiedad = Number.parseFloat(propiedad.precio);

            if (minVal && maxVal) {
                totalStats++;
                if (precioPropiedad >= minVal && precioPropiedad <= maxVal) {
                    matchedStats++;
                }
            }

            if (cajaBusqueda.value) {
                totalStats++;
                if (propiedad.titulo.toLowerCase().includes(cajaBusqueda.value.toLowerCase())) {
                    matchedStats++;
                }
            }


            if (matchedStats === totalStats) {
                tempPropiedades.push(propiedad);
            }
        }

        const p1 = performance.now() - p0;

        console.log(`search ${p1}ms`);

        let i = 0;

        for (let y = 0; y < tempPropiedades.length; y++) {
            const propiedad = tempPropiedades[y];
            
            if (propiedad.latitud && propiedad.longitud) {
                let popupContent = `<p><a href="properties-details.php?idPro=${propiedad.id}">${propiedad.titulo}</a><br /></p><img src="controlPanel/${propiedad.fotoPrincipal}">`;
                markers.addLayer(L.marker([parseFloat(propiedad.latitud),parseFloat(propiedad.longitud)],{icon: pinIcon}).bindPopup(popupContent).openPopup());
            }

            if (i % 12 === 0) {
                noPaginas++;
            }

            i++;
            texto += `
            <div class="col-lg-4 col-md-6 col-12 item" page="${noPaginas}">
                <div class="flat-item">
                    <div class="flat-item-image">
                        <span class="for-sale rent">${propiedad.status}</span>
                            ${propiedad.status === "Vendida" ? 
                                (`<a class= "marca-de-agua" href="properties-details.php?idPro=${propiedad.id}"><img style="width: 100%; height: 360px;" src="controlPanel/${propiedad.fotoPrincipal}" alt=""></a>`) 
                                :(`<a href="properties-details.php?idPro=${propiedad.id}"><img style="width: 100%; height: 360px;" src="controlPanel/${propiedad.fotoPrincipal}" alt=""></a>`)}
                            <div class="flat-link">
                                <a href="properties-details.php?idPro=${propiedad.id}">Mas detalles</a>
                            </div>
                            <ul class="flat-desc">
                                <li>
                                    <img src="modules/images/icons/4.png" alt="">
                                    <span>${propiedad.areaTerreno}</sup></span>
                                </li>
                                <li>
                                    <img src="modules/images/icons/5.png" alt="">
                                    <span>${propiedad.habitaciones}</span>
                                </li>
                                <li>
                                    <img src="modules/images/icons/6.png" alt="">
                                    <span>${propiedad.banos}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="flat-item-info">
                            <div class="flat-title-price">
                                <h5><a href="properties-details.php?idPro=${propiedad.id}">${propiedad.titulo}</a></h5>
                                <span class="price">$${new Intl.NumberFormat().format(propiedad.precio)} USD </span>
                            </div>
                            <p><img src="modules/images/icons/location.png" alt="">${propiedad.direccion}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        tabla.innerHTML = texto;
        irAPaginaNo(1);
        myMap.addLayer(markers);
    }

    const formData = new FormData();
    formData.set('categoria', <?php echo "'" . ucfirst($Categoria) . "'"; ?>);

    $.ajax({
        url: './controllers/obtenerPropiedades.php',
        type: "POST",
        data: formData,
        success: function(data) {
            const datos = JSON.parse(data);
            propiedades = datos;
            let texto = ``;
            let i = 0;
            datos.forEach((propiedad) => {
                if (i % 12 === 0) {
                    noPaginas++;
                }

                let popupContent = `<p><a href="properties-details.php?idPro=${propiedad.id}">${propiedad.titulo}</a><br /></p><img src="controlPanel/${propiedad.fotoPrincipal}">`;

                if(propiedad.latitud && propiedad.longitud && propiedad.latitud != "" && propiedad.longitud != ""){
                    markers.addLayer(L.marker([parseFloat(propiedad.latitud),parseFloat(propiedad.longitud)], { icon: pinIcon }).bindPopup(popupContent).openPopup());
                }
                texto += `
                    <div class="col-lg-4 col-md-6 col-12 item" page="${noPaginas}">
                        <div class="flat-item">
                            <div class="flat-item-image">
                                <span class="for-sale rent">${propiedad.status}</span>
                                    ${propiedad.status === "Vendida" ? (`<a class= "marca-de-agua" href="properties-details.php?idPro=${propiedad.id}"><img style="width: 100%; height: 360px;" src="controlPanel/${propiedad.fotoPrincipal}" alt=""></a>`) :(`<a href="properties-details.php?idPro=${propiedad.id}"><img style="width: 100%; height: 360px;" src="controlPanel/${propiedad.fotoPrincipal}" alt=""></a>`)}
                                    <div class="flat-link">
                                        <a href="properties-details.php?idPro=${propiedad.id}">Mas detalles</a>
                                    </div>
                                    <ul class="flat-desc">
                                        <li>
                                            <img src="modules/images/icons/4.png" alt="">
                                            <span>${propiedad.areaTerreno}</sup></span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/5.png" alt="">
                                            <span>${propiedad.habitaciones}</span>
                                        </li>
                                        <li>
                                            <img src="modules/images/icons/6.png" alt="">
                                            <span>${propiedad.banos}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="flat-item-info">
                                    <div class="flat-title-price">
                                        <h5><a href="properties-details.php?idPro=${propiedad.id}">${propiedad.titulo}</a></h5>
                                        <span class="price">$${new Intl.NumberFormat().format(propiedad.precio)} ${propiedad.moneda} </span>
                                    </div>
                                    <p><img src="modules/images/icons/location.png" alt="">${propiedad.direccion}</p>
                                </div>
                            </div>
                        </div>
                `;

                
                i++;

            });
            tabla.innerHTML = texto;
            irAPaginaNo(1);
        },
        error: function(data) {
            console.log(data);
        },
        complete: function() {
            myMap.addLayer(markers);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    function generarPaginador() {
        document.getElementById('paginador').style.display = 'block';

        if (paginaActual > 1) {
            document.getElementById('btn-paginador-2').style.opacity = '1.0';
            document.getElementById('btn-paginador-2').innerHTML = paginaActual - 1;
            document.getElementById('btn-paginador-2').disabled = false;
        } else {
            document.getElementById('btn-paginador-2').style.opacity = '0.0';
            document.getElementById('btn-paginador-2').disabled = true;
        }

        document.getElementById('btn-paginador-3').innerHTML = paginaActual;

        if (paginaActual < noPaginas) {
            document.getElementById('btn-paginador-4').style.opacity = '1.0';
            document.getElementById('btn-paginador-4').innerHTML = paginaActual + 1;
            document.getElementById('btn-paginador-4').disabled = false;
        } else {
            document.getElementById('btn-paginador-4').style.opacity = '0.0';
            document.getElementById('btn-paginador-4').disabled = true;

        }

        const elementos = tabla.getElementsByClassName('item');
        const capacidad = elementos.length;

        for (let i = 0; i < capacidad; i++) {
            const page = elementos[i].getAttribute('page');
            if (page == paginaActual) {
                elementos[i].style.display = 'block';
            } else {
                elementos[i].style.display = 'none';
            }
        }

    }

    function irAPaginaNo(noPagina) {
        // paginaActual = noPagina;
        // window.scrollTo({ top: 1200, behavior: 'smooth' });
        // generarPaginador();
    }

</script>