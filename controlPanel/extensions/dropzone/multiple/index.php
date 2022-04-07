<?PHP
require_once "../../../models/crud.php";
require_once "../../../controllers/controller.php";
$propiedad = $_REQUEST['propiedad'];
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sabir Imagenes para propiedad ID:<?php echo $propiedad; ?> </title>
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/dropzone.js"></script>
<script src="js/jquery-ui.min.js"></script>
 <script src="../../../views/plugins/sweetalert2/sweetalert2.all.js"></script>

</head>
<body>

<div class="container">
    <div class="row">
    <div id="content" class="col-lg-12">
<form action="index.php" method="post" enctype="multipart/form-data">
    <div class="fallback">
        <input name="file" id="basicUploadFile" type="file" multiple />
    </div>
    <div id="actions" class="row">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-secondary fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Seleccione imágenes...</span>
            </span>
            <button type="submit" class="btn btn-primary start" style="display: none;">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning cancel" style="display: none;">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
            </button>
        </div>

        <div class="col-lg-5">
            <!-- The global file processing state -->
            <span class="fileupload-process">
                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </span>
        </div>
    </div>

    <div class="table table-striped files" id="previews">
        <div id="template" class="file-row row">
            <!-- This is used as the file preview template -->
            <div class="col-xs-12 col-lg-3">
                <span class="preview" style="width:160px;height:160px;">
                    <img data-dz-thumbnail />
                </span>
                <br/>
                <button class="btn btn-primary start" style="display:none;">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Empezar</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                    <i class="icon-ban-circle fa fa-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                    <i class="icon-trash fa fa-trash"></i>
                    <span>Eliminar</span>
                </button>
            </div>
            <div class="col-xs-12 col-lg-9">
                <p class="name" data-dz-name></p>
                <p class="size" data-dz-size></p>
                <div>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dropzone-here">Arrastre aqu&iacute; imagenes jpg &oacute; png</div>


</form>
        </div>
    </div>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="number" name="propiedad" value="<?php echo $propiedad; ?>" hidden="true">
    <input type="text" name="foto1" id="foto1" hidden="true">
    <input type="text" name="foto2" id="foto2" hidden="true">
    <input type="text" name="foto3" id="foto3" hidden="true">
    <input type="text" name="foto4" id="foto4" hidden="true">
    <input type="text" name="foto5" id="foto5" hidden="true">

    <div class="footer-content row">
        <div class="col-lg-12">
            <div class="card-body text-center mt-4 mb-4">
                <button type="submit" name="sube" class="btn btn-success">Asignar Imágenes</button>
                <!--<a href="images.php" class="btn btn-primary" style="text-align: center;"><i class="fa fa-eye"></i> Ver Imágenes</a>-->
            </div>
        </div>
    </div>

</form>

<?php
    $agregaImagenes = new MvcController();
    $agregaImagenes -> ctrSubeImagenes();
?>

</div>

<script>
// Get the template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(document.body, {
    // Mando el ID de la propiedad para usarlo en el nombre de la imagen y asi evitar que loes nombres de las imagenes se enpalmen
    url: "upload.php?propiedad=<?php echo $propiedad; ?>",
    paramName: "file",
    acceptedFiles: 'image/*',
    maxFilesize: 2,
    maxFiles: 5,
    thumbnailWidth: 160,
    thumbnailHeight: 160,
    thumbnailMethod: 'contain',
    previewTemplate: previewTemplate,
    autoQueue: true,
    previewsContainer: "#previews",
    clickable: ".fileinput-button"
});
var i=1;
var fotos='{';
myDropzone.on("addedfile", function(file) {

    $('.dropzone-here').hide();
    document.querySelector("#foto"+i).value = file.name;
    //fotos += '"'+ i + '":"'+ file.name +'",'
    //alert(fotos);
    i++;
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file);};
});



// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    //document.querySelector("#total-progress").style.opacity = "0";
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};


</script>
</body>
</html>
