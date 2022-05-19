<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";


class propiedades extends conexion {

    private $table = "propiedades";
    private $destacada = "";
    private $oferta = "";
    private $titulo = "";
    private $status = "";
    private $precio = "";
    private $precioOferta = "";
    private $condVenta = "";
    private $categoria = "";
    private $areaTerreno = "";
    private $areaConstruccion = "";
    private $habitaciones = "";
    private $banos = "";
    private $direccion = "";
    private $ciudad = "";
    private $estado = "";
    private $CP = "";
    private $latitud = "";
    private $longitud = "";
    private $fotoPrincipal = "";
    private $fotos = "";
    private $detalles = "";
    private $caracteristicas = "";
    private $vendedor = "";
    private $fechaRegistro = "0000-00-00";
    private $moneda = "";

    private $token = "";

    //-----------------------------------------------------------------------
    private $idPropiedad = "";

    
//bb5cf530f5a4ff32c522f56d5ca8cff6

public function listaPropiedades($pagina = 1){
        $inicio  = 0 ;
        $cantidad = 100;
        if($pagina > 1){
            $inicio = ($cantidad * ($pagina - 1)) +1 ;
            $cantidad = $cantidad * $pagina;
        }
        $query = "SELECT * FROM " . $this->table . " limit $inicio,$cantidad";
        $datos = parent::obtenerDatos($query);
        foreach ($datos as &$key ){
            $key["caracteristicas"]= json_decode($key["caracteristicas"], true);
            $key["fotos"]= json_decode($key["fotos"], true);
        }


        return $datos;
    }

public function todasPropiedades(){

    $query = "SELECT * FROM " . $this->table;
    $datos = parent::obtenerDatos($query);
    foreach ($datos as &$key ){
        $key["caracteristicas"]= json_decode($key["caracteristicas"], true);
    }

    return $datos;
}

public function obtenerPropiedad($id){
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

            if(!isset($datos['titulo']) || !isset($datos['status']) || !isset($datos['precio']) || !isset($datos['categoria'])){
                return $_respuestas->error_400();
            }else{
                $this->titulo = $datos['titulo'];
                $this->dni = $datos['status'];
                $this->correo = $datos['precio'];
                $this->correo = $datos['categoria'];

                if (isset($datos['destacada'])) {$this->destacada = $datos['destacada'];}
                if (isset($datos['oferta'])) {$this->oferta = $datos['oferta'];}
                if (isset($datos['titulo'])) {$this->titulo = $datos['titulo'];}
                if (isset($datos['status'])) {$this->status = $datos['status'];}
                if (isset($datos['precio'])) {$this->precio = $datos['precio'];}
                if (isset($datos['precioOferta'])) {$this->precioOferta = $datos['precioOferta'];}
                if (isset($datos['condVenta'])) {$this->condVenta = $datos['condVenta'];}
                if (isset($datos['categoria'])) {$this->categoria = $datos['categoria'];}
                if (isset($datos['areaTerreno'])) {$this->areaTerreno = $datos['areaTerreno'];}
                if (isset($datos['areaConstruccion'])) {$this->areaConstruccion = $datos['areaConstruccion'];}
                if (isset($datos['habitaciones'])) {$this->habitaciones = $datos['habitaciones'];}
                if (isset($datos['banos'])) {$this->banos = $datos['banos'];}
                if (isset($datos['direccion'])) {$this->direccion = $datos['direccion'];}
                if (isset($datos['ciudad'])) {$this->ciudad = $datos['ciudad'];}
                if (isset($datos['estado'])) {$this->estado = $datos['estado'];}
                if (isset($datos['CP'])) {$this->CP = $datos['CP'];}
                if (isset($datos['latitud'])) {$this->latitud = $datos['latitud'];}
                if (isset($datos['longitud'])) {$this->longitud = $datos['longitud'];}
                if (isset($datos['fotoPrincipal'])) {$this->fotoPrincipal = $datos['fotoPrincipal'];}
                if (isset($datos['fotos'])) {$this->fotos = $datos['fotos'];}
                if (isset($datos['detalles'])) {$this->detalles = $datos['detalles'];}
                if (isset($datos['caracteristicas'])) {$this->caracteristicas = $datos['caracteristicas'];}
                if (isset($datos['vendedor'])) {$this->vendedor = $datos['vendedor'];}
                if (isset($datos['fechaRegistro'])) {$this->fechaRegistro = $datos['fechaRegistro'];}
                if (isset($datos['moneda'])) {$this->moneda = $datos['moneda'];}

                if (isset($datos['imagen'])){
                    $resp = $this->procesarImagen($datos['imagen']);
                    $this->fotoPrincipal = $resp;
                }

                $resp = $this->insertarpropiedad();

                if($resp){
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "idPropiedad" => $resp
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


private function insertarpropiedad(){
    $query = "INSERT INTO " . $this->table . "(`destacada`, `oferta`, `titulo`, `status`, `precio`, `precioOferta`, `condVenta`, `categoria`, `areaTerreno`, `areaConstruccion`, `habitaciones`, `banos`, `direccion`, `ciudad`, `estado`, `CP`, `latitud`, `longitud`, `fotoPrincipal`, `fotos`, `detalles`, `caracteristicas`, `vendedor`, `fechaRegistro`, `moneda`) 
    VALUES (".$this->destacada.",".$this->oferta.",'".$this->titulo."','".$this->status."',".$this->precio.",".$this->precioOferta.",'".$this->condVenta."','".$this->categoria."','".$this->areaTerreno."','".$this->areaConstruccion."',".$this->habitaciones.",".$this->banos.",'".$this->direccion."','".$this->ciudad."','".$this->estado."',".$this->CP.",'".$this->latitud."','".$this->longitud."','".$this->fotoPrincipal."','".$this->fotos."','".$this->detalles."','".$this->caracteristicas."',".$this->vendedor.",'".$this->fechaRegistro."','".$this->moneda."')";
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

            if(!isset($datos['idPropiedad'])){
                return $_respuestas->error_400();
            }else{
                $this->idPropiedad = $datos['idPropiedad'];

                if (isset($datos['destacada'])) {$this->destacada = $datos['destacada'];}
                if (isset($datos['oferta'])) {$this->oferta = $datos['oferta'];}
                if (isset($datos['titulo'])) {$this->titulo = $datos['titulo'];}
                if (isset($datos['status'])) {$this->status = $datos['status'];}
                if (isset($datos['precio'])) {$this->precio = $datos['precio'];}
                if (isset($datos['precioOferta'])) {$this->precioOferta = $datos['precioOferta'];}
                if (isset($datos['condVenta'])) {$this->condVenta = $datos['condVenta'];}
                if (isset($datos['categoria'])) {$this->categoria = $datos['categoria'];}
                if (isset($datos['areaTerreno'])) {$this->areaTerreno = $datos['areaTerreno'];}
                if (isset($datos['areaConstruccion'])) {$this->areaConstruccion = $datos['areaConstruccion'];}
                if (isset($datos['habitaciones'])) {$this->habitaciones = $datos['habitaciones'];}
                if (isset($datos['banos'])) {$this->banos = $datos['banos'];}
                if (isset($datos['direccion'])) {$this->direccion = $datos['direccion'];}
                if (isset($datos['ciudad'])) {$this->ciudad = $datos['ciudad'];}
                if (isset($datos['estado'])) {$this->estado = $datos['estado'];}
                if (isset($datos['CP'])) {$this->CP = $datos['CP'];}
                if (isset($datos['latitud'])) {$this->latitud = $datos['latitud'];}
                if (isset($datos['longitud'])) {$this->longitud = $datos['longitud'];}
                if (isset($datos['fotoPrincipal'])) {$this->fotoPrincipal = $datos['fotoPrincipal'];}
                if (isset($datos['fotos'])) {$this->fotos = $datos['fotos'];}
                if (isset($datos['detalles'])) {$this->detalles = $datos['detalles'];}
                if (isset($datos['caracteristicas'])) {$this->caracteristicas = $datos['caracteristicas'];}
                if (isset($datos['vendedor'])) {$this->vendedor = $datos['vendedor'];}
                if (isset($datos['fechaRegistro'])) {$this->fechaRegistro = $datos['fechaRegistro'];}
                if (isset($datos['moneda'])) {$this->moneda = $datos['moneda'];}

                $resp = $this->modificarpropiedad();

                if($resp){
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "idPropiedad" => $this->idPropiedad
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

public function putFotos($json, $prop){
    $_respuestas = new respuestas;
    $datos = json_decode($json,true);

    if(!isset($datos['token'])){
            return $_respuestas->error_401();
    }else{
        $this->token = $datos['token'];
        $arrayToken =   $this->buscarToken();
        if($arrayToken){

            $this->idPropiedad = $prop;

            if (isset($datos['fotoPrincipal'])) {$this->fotoPrincipal = "views/img/propiedades/" .$this->procesarImagen($datos['fotoPrincipal']);}

            if (isset($datos['foto0'])) {$resp = $this->procesarImagen($datos['foto0']); $this->fotos .= '{"0":"'.$resp.'",'; }
                else{$this->fotos .= '{"0":"",';}
            if (isset($datos['foto1'])) { $resp = $this->procesarImagen($datos['foto1']); $this->fotos .= '"1":"'.$resp.'",'; }
                else{$this->fotos .= '"1":"",';}
            if (isset($datos['foto2'])) { $resp = $this->procesarImagen($datos['foto2']); $this->fotos .= '"2":"'.$resp.'",'; }
                else{$this->fotos .= '"2":"",';}
            if (isset($datos['foto3'])) { $resp = $this->procesarImagen($datos['foto3']); $this->fotos .= '"3":"'.$resp.'",'; }
                else{$this->fotos .= '"3":"",';}
            if (isset($datos['foto4'])) { $resp = $this->procesarImagen($datos['foto4']); $this->fotos .= '"4":"'.$resp.'",'; }
                else{$this->fotos .= '"4":"",';}
            if (isset($datos['foto5'])) { $resp = $this->procesarImagen($datos['foto5']); $this->fotos .= '"5":"'.$resp.'",'; }
                else{$this->fotos .= '"5":"",';}
            if (isset($datos['foto6'])) { $resp = $this->procesarImagen($datos['foto6']); $this->fotos .= '"6":"'.$resp.'",'; }
                else{$this->fotos .= '"6":"",';}
            if (isset($datos['foto7'])) { $resp = $this->procesarImagen($datos['foto7']); $this->fotos .= '"7":"'.$resp.'",'; }
                else{$this->fotos .= '"7":"",';}
            if (isset($datos['foto8'])) { $resp = $this->procesarImagen($datos['foto8']); $this->fotos .= '"8":"'.$resp.'",'; }
                else{$this->fotos .= '"8":"",';}
            if (isset($datos['foto9'])) { $resp = $this->procesarImagen($datos['foto9']); $this->fotos .= '"9":"'.$resp.'"}'; }
                else{$this->fotos .= '"9":""}';}

            $resp = $this->actualizaFotos();

            if($resp){
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "idPropiedad" => $this->idPropiedad
                );
                return $respuesta;
            }else{
                return $_respuestas->error_500();
            }


        }else{
            return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
        }
   }
}


private function modificarpropiedad(){
    $query = "UPDATE " . $this->table . " SET destacada = ".$this->destacada.", oferta =".$this->oferta.", titulo = '".$this->titulo."', status = '".$this->status."', precio = " .$this->precio.", precioOferta = ".$this->precioOferta."
    , condVenta = '".$this->condVenta."', categoria = '".$this->categoria."', areaTerreno = '".$this->areaTerreno."', areaConstruccion = '".$this->areaConstruccion."', habitaciones = ".$this->habitaciones.", banos = ".$this->banos."
    , direccion = '".$this->direccion."', ciudad = '".$this->ciudad."', estado = '".$this->estado."', CP = ".$this->CP.", latitud = '".$this->latitud."', longitud = '".$this->longitud."', fotoPrincipal = '".$this->fotoPrincipal."'
    , fotos = '".$this->fotos."', detalles = '".$this->detalles."', caracteristicas = '".$this->caracteristicas."', vendedor = ".$this->vendedor.", fechaRegistro = '".$this->fechaRegistro."', moneda = '".$this->moneda."' 
    WHERE id = ".$this->idPropiedad ;
    $resp = parent::nonQuery($query);

    if($resp >= 1){
         return $resp;
    }else{
        return 0;
    }
}

private function actualizaFotos(){
    $query = "UPDATE " . $this->table . " SET fotoPrincipal = '".$this->fotoPrincipal."', fotos = '".$this->fotos."' WHERE id = ".$this->idPropiedad ;
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

            if(!isset($datos['idPropiedad'])){
                return $_respuestas->error_400();
            }else{
                $this->idPropiedad = $datos['idPropiedad'];
                $resp = $this->eliminarPropiedad();
                if($resp){
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "idPropiedad" => $this->idPropiedad
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


private function eliminarPropiedad(){
    $query = "DELETE FROM " . $this->table . " WHERE id = '" . $this->idPropiedad . "'";
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

private function procesarImagen($img){
    $direccion = dirname(__DIR__) . "/public/images/";
    //$direccion = dirname(__DIR__) . "loewen.com.mx/controlPanel/views/img/propiedades/";
    $partes = explode(";base64,",$img);
    $extencion = explode('/', mime_content_type($img))[1];
    
    $imagen_base64 = base64_decode($partes[1]);
    $nombre = uniqid() . "." . $extencion;
    $file = $direccion . $nombre;



    //Si se pudo grabar la imagen en la carpeta returnamos el nombre de la imagen 
    // de lo contrario returnamos "Image upload error"
    if (file_put_contents($file,$imagen_base64) !== false) {
        $nuevaDireccion = str_replace('\\','/',$file);
        return $nombre;
    }
    else{
        return "Image upload error";
    }
    
}

}
?>