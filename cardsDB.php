<?php

session_start();

function openDBCards()
{

    $servername = "localhost";
    $username = "root";
    $password = "mysql";

    $conn = new PDO("mysql:host=$servername;dbname=onepiececartas", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

    return $conn;
}

function closeDB()
{
    return null;
}

function selectCards()
{
    $conn = openDBCards();

    $select = "SELECT * FROM cartas";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectAttribute($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT atributos.atributo FROM atributos JOIN cartas ON 
    atributos.id_atributo = cartas.atributo WHERE cartas.id_carta = '$id_carta'; ";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectAttributeImage($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT atributos.imagen FROM atributos JOIN cartas ON 
    atributos.id_atributo = cartas.atributo WHERE cartas.id_carta = '$id_carta';  ";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectType($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT tipocarta.tipo FROM tipocarta JOIN cartas on tipocarta.id_tipo = cartas.tipo_carta WHERE cartas.id_carta = '$id_carta';";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectGroup($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT grupos.grupo FROM grupos JOIN cartas on grupos.id_grupo = cartas.grupo WHERE cartas.id_carta = '$id_carta';";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectSecondaryGroup($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT grupos.grupo FROM grupos JOIN cartas on grupos.id_grupo = cartas.grupo_secundario WHERE cartas.id_carta = '$id_carta';";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}


function insertCards()
{

    try {
        $conn = openDBCards();

        $insert = "INSERT INTO cartas (nombre, poder, atributo, tipo_carta, grupo, grupo_secundario, imagen) VALUES (:nombre, :poder, :atributo, :tipo_carta, :grupo, :grupo_secundario, :imagen)";
        $sentencia = $conn->prepare($insert);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':poder', $poder);
        $sentencia->bindParam(':atributo', $atributo);
        $sentencia->bindParam(':tipo_carta', $tipo_carta);
        $sentencia->bindParam(':grupo', $grupo);
        $sentencia->bindParam(':grupo_secundario', $grupo_secundario);
        $sentencia->bindParam(':imagen', $imagen);

        $nombre = 'Usopp';
        $poder = '4000';
        $atributo = 1;
        $tipo_carta = 1;
        $grupo = 1;
        $grupo_secundario = null;
        $imagen = 'img/usopp.jpg';

        $sentencia->execute();

        $conn = closeDB();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

}

function deleteCards()
{
    try {
        $conn = openDBCards();

        $delete = "DELETE FROM cadenas WHERE cif = 'A65473825'";
        $sentencia = $conn->prepare($delete);
        $sentencia->execute();

        $conn = closeDB();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

}


?>