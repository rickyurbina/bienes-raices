<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Prubebas</title>
    <link rel="stylesheet" href="assets/estilo.css" type="text/css">
</head>
<body>

<div  class="container">
    <h1>Api Loewen</h1>
    <div class="divbody">
        <h3>Auth - login</h3>
        <code>
           POST  /auth
           <br>
           {
               <br>
               "usuario" :"",  -> REQUERIDO
               <br>
               "password": "" -> REQUERIDO
               <br>
            }
        
        </code>
    </div>      
    <div class="divbody">   
        <h3>propiedades</h3>
        <code>
           GET  /propiedades?page=$numeroPagina
           <br>
           GET  /propiedades?id=$idPropiedad
        </code>

        <code>
           POST  /propiedades<br>         
            {<br>
                "token": -> REQUERIDO,
                <br>"destacada":"",
                <br>"oferta":"",
                <br>"titulo":"",
                <br>"status":"",
                <br>"precio":"",
                <br>"precioOferta":"",
                <br>"condVenta":"",
                <br>"categoria":"",
                <br>"areaTerreno":"",
                <br>"areaConstruccion":"",
                <br>"habitaciones":"",
                <br>"banos":"",
                <br>"direccion":"",
                <br>"ciudad":"",
                <br>"estado":"",
                <br>"CP":"",
                <br>"latitud":"",
                <br>"longitud":,
                <br>"fotoPrincipal":null,
                <br>"fotos":"",
                <br>"detalles":"",
                <br>"caracteristicas":"",
                <br>"vendedor":"",
                <br>"fechaRegistro":"",
                <br>"moneda":""
            <br>} 

        </code>
        <code>
           PUT  /propiedades
           <br> 
           {
            <br> 
                <br>"destacada":"",
                <br>"oferta":"",
                <br>"titulo":"",
                <br>"status":"",
                <br>"precio":"",
                <br>"precioOferta":"",
                <br>"condVenta":"",
                <br>"categoria":"",
                <br>"areaTerreno":"",
                <br>"areaConstruccion":"",
                <br>"habitaciones":"",
                <br>"banos":"",
                <br>"direccion":"",
                <br>"ciudad":"",
                <br>"estado":"",
                <br>"CP":"",
                <br>"latitud":"",
                <br>"longitud":,
                <br>"fotoPrincipal":null,
                <br>"fotos":"",
                <br>"detalles":"",
                <br>"caracteristicas":"",
                <br>"vendedor":"",
                <br>"fechaRegistro":"",
                <br>"moneda":"",       
               <br>"token" : "" ,                -> REQUERIDO        
               <br>       
               "idPropiedad" : ""   -> REQUERIDO
               <br>
           }

        </code>

        <code>
           PUT  /propiedades?fotos=$idPropiedad<br>         
            {<br>
                "token": -> REQUERIDO,
                <br>"fotoPrincipal":"",
                <br>"foto1":"",
                <br>"foto2":"",
                <br>"foto3":"",
                <br>"foto4":"",
                <br>"foto5":"",
                <br>"foto6":"",
                <br>"foto7":"",
                <br>"foto8":"",
                <br>"foto9":"",
                <br>"foto10":""
            <br>} 
        </code>


        <code>
           DELETE  /propiedades
           <br> 
           {   
               <br>    
               "token" : "",                -> REQUERIDO        
               <br>       
               "idPropiedad" : ""   -> REQUERIDO
               <br>
           }

        </code>
    </div>

    <div class="divbody">   
        <h3>Notas</h3>
        <code>
           GET  /notas?page=$numeroPagina
           <br>
           GET  /notas?id=$idNota
        </code>

        <code>
           POST  /notas<br>         
            {
                <br>"token": -> REQUERIDO,
                <br>"titulo":"Nota 4",
                <br>"nota":"Ejemplo de nota 4",
                <br>"date":"2021-12-16"
            <br>} 

        </code>
        <code>
           PUT  /notas
           <br> 
           {
            <br> 
            <br>"titulo":"Nota 4",
            <br>"nota":"Ejemplo de nota 4",
            <br>"date":"2021-12-16",      
            <br>"token" : "",    -> REQUERIDO        
            <br>"idNota" : ""   -> REQUERIDO
            <br>
           }

        </code>

        <code>
           DELETE  /notas
           <br> 
           {   
               <br>"token" : "",   -> REQUERIDO        
               <br>"idNota" : ""   -> REQUERIDO
               <br>
           }

        </code>
    </div>

</div>
    
</body>
</html>

