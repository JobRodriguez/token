<?php
include("conexion.php");

$token = $_GET['token'];

function logout($token)
{
    global $mysqli;
    $query = "SELECT * FROM usuarios WHERE token ='$token' ";
    $result = $mysqli->query($query);
    if ($result) {
        $fila = $result->fetch_assoc();
        $token = 'NULL';
        $query2 = "UPDATE Usuarios SET token = '$token' WHERE Id = ".$fila['Id'];
        $result2 = $mysqli->query($query2);
    }
    return $token;
}

logout($token);
