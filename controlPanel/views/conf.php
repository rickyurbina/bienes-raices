<?php
// Conexion Local
$bd = "loewen";
$servername = "127.0.0.1";
$username = "root";
$password = "12345678";


//conexion Server
    //   $bd = "multie5_brcc";
    //   $servername = "localhost";
    //   $username = "multie5_brcc";
    //   $password = "}2Ut@1ouvQ}C";



try {
    $conn = new PDO("mysql:host=$servername;dbname=$bd", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("SET CHARACTER SET utf8");
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>