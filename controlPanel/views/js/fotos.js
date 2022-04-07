

/********************************************************
 * Subir una foto de usuario
 *********************************************************/

$(".upload").change(function(){
	var imagen = this.files[0];

	console.log(imagen);


	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
		$(".upload").val("");
		swal({
			title: "Error de tipo de imagen",
			text: "El tipo de archivo que eligio no es aceptado",
			type:"error",
			confirmButtonText: "Cerrar"
		});
	}
	else if(imagen["size"] > 2000000){
		$(".upload").val("");
		swal({
			title: "Error de tamaño de imagen",
			text: "La imagen no debe ser mas de 2MB",
			type:"error",
			confirmButtonText: "Cerrar"
		});

	}
	else {
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen)
		});
	}
});


/* ==============================================
 FUNCION PARA ABRIR VENTANA NUEVA SIN MENUS
*================================================*/
  $(function(){
            $(document).on('click'," .masFotos",function(e){
                e.preventDefault();
                var id = $(this).attr('propiedad');
                //alert(id);
                window.open("extensions/dropzone/multiple/index.php?propiedad="+id,'Agregar Fotos','toolbar=no,location=0,directories=no, status=0,menubar=0,scrollbars=0,resizable=0,width=1024,height=800,top=0,left=0');
            });
        });
