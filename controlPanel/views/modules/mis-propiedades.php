<?php
//session_start();
require('upload-images/upload-images.html');

if(!$_SESSION["validar"]){

    header("location:index.php");

    exit();


}
include "navAdmin.php";
$lista = new MvcController();
print_r(
    "<script>
          const propiedades = JSON.parse('" .  $lista -> ctrListaPropiedades() . "');
          const formatter = new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN'
          });
    </script>"
);
?>


<div class="dashboard-list">
    <h3>Lista de Propiedades</h3>
    <table class="manage-table">
        <tbody>
        <?php
          $lista -> ctrBorrarPropiedad();
        ?>
        </tbody>
    </table>
    <br>
    <div class="row" style="display: none;" id="paginador">
        <div class="col text-center">
            <button class="btn btn-paginador" id="btn-paginador-1" onclick="irAPaginaNo(1)" >
                &lt;&lt;
            </button>
            <button class="btn btn-paginador" id="btn-paginador-2" onclick="irAPaginaNo(paginaActual - 1)" >
                1
            </button>
            <button class="btn btn-paginador" id="btn-paginador-3">
                2
            </button>
            <button class="btn btn-paginador" id="btn-paginador-4" onclick="irAPaginaNo(paginaActual + 1)" >
                3
            </button>
            <button class="btn btn-paginador" id="btn-paginador-5" onclick="irAPaginaNo(noPaginas)" >
                &gt;&gt;
            </button>
        </div>
    </div>
    <br>
</div>
<script async="false">
    const pageSize = 12;
    let noPaginas = 0;

    let paginaActual = 1;
    const tabla = document.querySelector('tbody');
    // let html = '';

    const promise = new Promise((resolve, reject) => {
        const result = generarPropiedades();
        resolve(result);
    });

    promise.then((value) => {
        tabla.innerHTML = value;
        irAPaginaNo(1);

    }).catch((error) => {
        console.log(error);
    }); 
       
    function generarPropiedades() {
        let html = '';

        for (let i = 0; i < propiedades.length; i++) {
            if (i % pageSize === 0) {
                noPaginas++;
            }
            const propiedad = propiedades[i];
            html += 
            `
            <tr class="responsive-table" page="${ noPaginas }">
                <td class="listing-photoo">
                    <a href="#datosModal" data-toggle="modal" href="#datosModal" data-desc="${propiedad.condVenta}" class="datosVenta">
                    <img src="${propiedad.fotoPrincipal}" alt="listing-photo" class="img-fluid" width="120">
                </td>
                <td class="title-container">
                    ID: ${propiedad.id}<br>
                    <h2>${propiedad.titulo}</h2>
                    <h5 class="d-none d-xl-block d-lg-block d-md-block">${propiedad.direccion}</h5>
                    <h6 class="table-property-price">${formatter.format(propiedad.precio)} ${propiedad.moneda}</h6>
                </td>
                <td class="expire-date">${propiedad.status}</td>
                <td class="action">
                    <a onclick="getImages(${propiedad.id});"  propiedad="${propiedad.id}" ><i class="fa fa-picture-o"></i> Más Fotos</a>
                    <a href="index.php?action=edita-propiedad&idEditar=${propiedad.id}"><i class="fa fa-pencil"></i> Editar</a>
                    <a href="#deleteModal" data-toggle="modal" data-target="#deleteModal" data-borrar="${propiedad.id}" data-desc="Descripcion" class="delete"><i class="fa fa-remove"></i>Borrar</a>
                    <a href="index.php?action=mis-propiedades&idBorrar=${propiedad.id}"><button id="${propiedad.id}" name="${propiedad.id}" hidden>X</button></a>
                </td>
            </tr>
            `;
        }

        return html;
    }

    function generarPaginador() {
        document.getElementById('paginador').style.display = 'block';

        if (paginaActual > 1) {
            document.getElementById('btn-paginador-2').style.opacity = '1.0';
            document.getElementById('btn-paginador-2').innerHTML = paginaActual - 1;
        } else {
            document.getElementById('btn-paginador-2').style.opacity = '0.0';
        }

        document.getElementById('btn-paginador-3').innerHTML = paginaActual;

        if (paginaActual < noPaginas) {
            document.getElementById('btn-paginador-4').style.opacity = '1.0';
            document.getElementById('btn-paginador-4').innerHTML = paginaActual + 1;
        } else {
            document.getElementById('btn-paginador-4').style.opacity = '0.0';
        }

        const elementos = tabla.getElementsByClassName('responsive-table');
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
        paginaActual = noPagina;
        window.scrollTo({ top: 0, behavior: 'smooth' });
        generarPaginador();
    }

</script>
<?php
    include "footer.php";
?>
