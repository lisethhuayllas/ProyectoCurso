<?php 
//Autentificaion por sesiones
    require_once 'conexion.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");

    $query = "CREATE TABLE usuarios (
        nombre VARCHAR(32) NOT NULL,
        apellido VARCHAR(32) NOT NULL,
        username VARCHAR(32) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";

    $result = $conexion->query($query);
    if (!$result) die("Error fatal");

    $nombre = "Denilson";
    $apellido = "Romero";
    $username = "denilson";
    $password = "denilson123";
    $hash = password_hash($password, PASSWORD_DEFAULT);

    add_user($conexion, $nombre, $apellido, $username, $hash);
    
    $nombre = "Yoselin";
    $apellido = "Huayllas";
    $username = "yoselin";
    $password = "yoselin123";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    add_user($conexion, $nombre, $apellido, $username, $hash);

    $nombre = "Liseth";
    $apellido = "Huayllas";
    $username = "liseth";
    $password = "liseth123";
    $hash = password_hash($password, PASSWORD_DEFAULT); //encriptación de contraseñas
    
    add_user($conexion, $nombre, $apellido, $username, $hash);

    function add_user($conexion, $nom, $ape, $usn, $pas)
    {
        $stmt = $conexion->prepare('INSERT INTO usuarios VALUES(?,?,?,?)');
        $stmt->bind_param('ssss', $nom, $ape, $usn, $pas);
        $stmt->execute();
        $stmt->close();
    }
?>