<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";


class notas extends conexion {

    private $table = "notas";
    private $titulo = "";
    private $nota = "";
    private $date = "0000-00-00";
    private $token = "";
    private $idNota = "";

public function listaNotas($pagina = 1){
        $inicio  = 0 ;
        $cantidad = 100;
        if($pagina > 1){
            $inicio = ($cantidad * ($pagina - 1)) +1 ;
            $cantidad = $cantidad * $pagina;
        }
        $query = "SELECT * FROM " . $this->table . " limit $inicio,$cantidad";
        $datos = parent::obtenerDatos($query);
        // foreach ($datos as &$key ){
        //     $key["caracteristicas"]= json_decode($key["caracteristicas"], true);
        //     $key["fotos"]= json_decode($key["fotos"], true);
        // }
        return $datos;
    }

public function todasNotas(){

    $query = "SELECT * FROM " . $this->table;
    $datos = parent::obtenerDatos($query);
    // foreach ($datos as &$key ){
    //     $key["caracteristicas"]= json_decode($key["caracteristicas"], true);
    // }
    return $datos;
}

public function obtenerNota($id){
    $query = "SELECT * FROM " . $this->table . " WHERE id = '$id'";
    $datos = parent::obtenerDatos($query);
    foreach ($datos as &$key ){
        $key["caracteristicas"]= json_decode($key["caracteristicas"], true);
        $key["fotos"]= json_decode($key["fotos"], true);
    }
    return $datos[0];

}

public function post($json){
    $_respuestas = new respuestas;
    $datos = json_decode($json,true);

    if(!isset($datos['token'])){
            return $_respuestas->error_401();
    }else{
        $this->token = $datos['token'];
        $arrayToken =   $this->buscarToken();
        if($arrayToken){

            if(!isset($datos['titulo'])){
                return $_respuestas->error_400();
            }else{
                $this->titulo = $datos['titulo'];

                if (isset($datos['titulo'])) {$this->titulo = $datos['titulo'];}
                if (isset($datos['nota'])) {$this->nota = $datos['nota'];}
                if (isset($datos['date'])) {$this->date = $datos['date'];}

                $resp = $this->insertarNota();

                if($resp){
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "idNota" => $resp
                    );
                    return $respuesta;
                }else{
                    return $_respuestas->error_500();
                }
            }

        }else{
            return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
        }
   }
}


private function insertarNota(){
    $query = "INSERT INTO " . $this->table . "(`id`, `titulo`, `nota`, `date`) 
    VALUES (NULL, '".$this->titulo."','".$this->nota."','".$this->date."')";
    $resp = parent::nonQueryId($query);
    if($resp){
         return $resp;
    }else{
        return 0;
    }
}
    
public function put($json){
    $_respuestas = new respuestas;
    $datos = json_decode($json,true);

    if(!isset($datos['token'])){
            return $_respuestas->error_401();
    }else{
        $this->token = $datos['token'];
        $arrayToken =   $this->buscarToken();
        if($arrayToken){

            if(!isset($datos['idNota'])){
                return $_respuestas->error_400();
            }else{
                $this->idNota = $datos['idNota'];

                if (isset($datos['titulo'])) {$this->titulo = $datos['titulo'];}
                if (isset($datos['nota'])) {$this->nota = $datos['nota'];}
                if (isset($datos['date'])) {$this->date = $datos['date'];}

                $resp = $this->modificarNota();

                if($resp){
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "idNota" => $this->idNota
                    );
                    return $respuesta;
                }else{
                    return $_respuestas->error_500();
                }
            }

        }else{
            return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
        }
   }
}


private function modificarNota(){
    $query = "UPDATE " . $this->table . " SET titulo = '".$this->titulo."', nota ='".$this->nota."', date = '".$this->date."' WHERE id = ".$this->idNota ;
    $resp = parent::nonQuery($query);

    if($resp >= 1){
         return $resp;
    }else{
        return 0;
    }
}



public function delete($json){
    $_respuestas = new respuestas;
    $datos = json_decode($json,true);

    if(!isset($datos['token'])){
        return $_respuestas->error_401();
    }else{
        $this->token = $datos['token'];
        $arrayToken =   $this->buscarToken();
        if($arrayToken){

            if(!isset($datos['idNota'])){
                return $_respuestas->error_400();
            }else{
                $this->idNota = $datos['idNota'];
                $resp = $this->eliminarNota();
                if($resp){
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "idNota" => $this->idNota
                    );
                    return $respuesta;
                }else{
                    return $_respuestas->error_500();
                }
            }

        }else{
            return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
        }
    }
}


private function eliminarNota(){
    $query = "DELETE FROM " . $this->table . " WHERE id = '" . $this->idNota . "'";
    $resp = parent::nonQuery($query);
    if($resp >= 1 ){
        return $resp;
    }else{
        return 0;
    }
}


private function buscarToken(){
    $query = "SELECT  TokenId,UsuarioId,Estado from usuarios_token WHERE Token = '" . $this->token . "' AND Estado = 'Activo'";
    $resp = parent::obtenerDatos($query);
    if($resp){
        return $resp;
    }else{
        return 0;
    }
}

    
private function actualizarToken($tokenid){
    $date = date("Y-m-d H:i");
    $query = "UPDATE usuarios_token SET Fecha = '$date' WHERE TokenId = '$tokenid' ";
    $resp = parent::nonQuery($query);
    if($resp >= 1){
        return $resp;
    }else{
        return 0;
    }
}

}
?>