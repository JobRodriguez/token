<?php
include("conexion.php");

function login($user, $pass)
{
    global $mysqli;
    $token = 'NULL';
    $pass = MD5($pass);
    $query = "SELECT * FROM usuarios WHERE Usuario ='$user' AND Contrasena = '$pass' ";
    $result = $mysqli->query($query);
    if ($result) {
        $fila = $result->fetch_assoc();
        $token = sha1($fila["Usuario"].$fila['Contrasena'].$fila['fecha_sesion']);
        $query2 = "UPDATE Usuarios SET token = '$token' WHERE Id = ".$fila['Id'];
        $result2 = $mysqli->query($query2);
    }
    return $token;

}

function consulta($token)
{
    global $mysqli;
    $query = "SELECT * FROM usuarios WHERE token ='$token' ";
    $result = $mysqli->query($query);
    if ($result && $result->num_rows > 0) {
        return $result;
    } else {
        return 'error';

    }
}

$token = login('admin', '123');
$consult = consulta($token);
if ($consult) {
    $fila = $consult->fetch_assoc();
    echo ($fila["Usuario"].$fila['Contrasena'].$fila['fecha_sesion']);
    echo "<a type='button' href='logout.php?token=" . $token . "'>Cerrar</a>";
}
