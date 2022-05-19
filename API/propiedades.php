<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/propiedades.class.php';

$_respuestas = new respuestas;
$_propiedades = new propiedades;


if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $listaPropiedades = $_propiedades->listaPropiedades($pagina);
        header("Content-Type: application/json");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($listaPropiedades);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $propiedadid = $_GET['id'];
        $datosPropiedad = $_propiedades->obtenerPropiedad($propiedadid);
        header("Content-Type: application/json");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($datosPropiedad);
        http_response_code(200);
    }else if(isset($_GET['foto'])){
        $name = '../loewen.com.mx/controlPanel/views/img/propiedades/'.$_GET['foto'];
        $fp = fopen($name, 'rb');

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));

        fpassthru($fp);


        // $propiedadid = $_GET['id'];
        // $datosPropiedad = $_propiedades->obtenerPropiedad($propiedadid);
        // header("Content-Type: application/json");
        // header('Access-Control-Allow-Origin: *');
        // echo json_encode($datosPropiedad);
        http_response_code(200);
    }
    else{
        $datosPorton = $_propiedades->todasPropiedades();
        header("Content-Type: application/json");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($datosPorton);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_propiedades->post($postBody);

    //delvovemos una respuesta 
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);
    
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){

    if(isset($_GET["fotos"])){
        $id_Propiedad = $_GET["fotos"];
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_propiedades->putFotos($postBody, $id_Propiedad);
            //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
    }else{
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_propiedades->put($postBody);
            //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
        }

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){

        $headers = getallheaders();
        if(isset($headers["token"]) && isset($headers["idPropiedad"])){
            //recibimos los datos enviados por el header
            $send = [
                "token" => $headers["token"],
                "idPropiedad" =>$headers["idPropiedad"]
            ];
            $postBody = json_encode($send);
        }else{
            //recibimos los datos enviados
            $postBody = file_get_contents("php://input");
        }
        
        //enviamos datos al manejador
        $datosArray = $_propiedades->delete($postBody);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
       

}else{
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}


?>