<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/notas.class.php';

$_respuestas = new respuestas;
$_notas = new notas;


if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $listaNotas = $_notas->listaNotas($pagina);
        header("Content-Type: application/json");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($listaNotas);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $notaId = $_GET['id'];
        $datosNotas = $_notas->obtenerNota($notaId);
        header("Content-Type: application/json");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($datosNotas);
        http_response_code(200);
    }
    else{
        $datosPorton = $_notas->todasNotas();
        header("Content-Type: application/json");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($datosPorton);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_notas->post($postBody);

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

    // if(isset($_GET["fotos"])){
    //     $id_Propiedad = $_GET["fotos"];
    //     //recibimos los datos enviados
    //     $postBody = file_get_contents("php://input");
    //     //enviamos datos al manejador
    //     $datosArray = $_propiedades->putFotos($postBody, $id_Propiedad);
    //         //delvovemos una respuesta 
    //     header('Content-Type: application/json');
    //     if(isset($datosArray["result"]["error_id"])){
    //         $responseCode = $datosArray["result"]["error_id"];
    //         http_response_code($responseCode);
    //     }else{
    //         http_response_code(200);
    //     }
    //     echo json_encode($datosArray);
    // }else{
        //recibimos los datos enviados
        $postBody = file_get_contents("php://input");
        //enviamos datos al manejador
        $datosArray = $_notas->put($postBody);
            //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
    //}

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
        $datosArray = $_notas->delete($postBody);
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