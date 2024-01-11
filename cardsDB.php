<?php

session_start();

function openDBCards()
{

    $servername = "localhost";
    $username = "root";
    $password = "mysql";

    // $servername = "localhost";
    // $username = "root";
    // $password = "root";

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

function selectAttributes()
{
    $conn = openDBCards();

    $select = "SELECT * FROM atributos";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectTypes()
{
    $conn = openDBCards();

    $select = "SELECT * FROM tipocarta";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectGroups()
{
    $conn = openDBCards();

    $select = "SELECT * FROM grupos";

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

function selectCardsGroups()
{
    $conn = openDBCards();

    $select = "SELECT * FROM cartas_has_grupos";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectCardGroup($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT grupos.grupo FROM grupos JOIN cartas_has_grupos ON  cartas_has_grupos.grupos_id_grupo = grupos.id_grupo JOIN cartas ON cartas.id_carta = cartas_has_grupos.cartas_id_carta WHERE cartas.id_carta = '$id_carta';";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function selectCardGroupID($id_carta)
{
    $conn = openDBCards();

    $select = "SELECT grupos.id_grupo FROM grupos JOIN cartas_has_grupos ON  cartas_has_grupos.grupos_id_grupo = grupos.id_grupo JOIN cartas ON cartas.id_carta = cartas_has_grupos.cartas_id_carta WHERE cartas.id_carta = $id_carta;";

    $sentencia = $conn->prepare($select);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conn = closeDB();

    return $resultado;
}

function insertCards($nombre, $poder, $atributo, $tipo_carta, $imagen)
{
    try {
        $conn = openDBCards();

        $insert = "INSERT INTO cartas (nombre, poder, atributo, tipo_carta, imagen) VALUES (:nombre, :poder, :atributo, :tipo_carta, :imagen)";
        $sentencia = $conn->prepare($insert);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':poder', $poder);
        $sentencia->bindParam(':atributo', $atributo);
        $sentencia->bindParam(':tipo_carta', $tipo_carta);
        $sentencia->bindParam(':imagen', $imagen);

        $sentencia->execute();

        $lastInsertId = $conn->lastInsertId();

        $_SESSION['addedCard'] = 'Card Added Successfully';

        return $lastInsertId;
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}

function updateCards($nombre, $poder, $atributo, $tipo_carta, $imagen, $id_carta)
{
    try {
        $conn = openDBCards();

        $update = "UPDATE cartas SET nombre = :nombre, poder = :poder, atributo = :atributo, tipo_carta = :tipo_carta,
        imagen = :imagen WHERE id_carta = :id_carta";
        $sentencia = $conn->prepare($update);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':poder', $poder);
        $sentencia->bindParam(':atributo', $atributo);
        $sentencia->bindParam(':tipo_carta', $tipo_carta);
        $sentencia->bindParam(':imagen', $imagen);
        $sentencia->bindParam(':id_carta', $id_carta);

        $sentencia->execute();

        $_SESSION['edited'] = 'Card Modified Succesfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}

function insertCardGroups($cartas_id_carta, $grupos_id_grupo)
{
    try {
        $conn = openDBCards();

        $insert = "INSERT INTO cartas_has_grupos (cartas_id_carta, grupos_id_grupo) VALUES (:cartas_id_carta, :grupos_id_grupo)";
        $sentencia = $conn->prepare($insert);
        $sentencia->bindParam(':cartas_id_carta', $cartas_id_carta);
        $sentencia->bindParam(':grupos_id_grupo', $grupos_id_grupo);

        $sentencia->execute();

        $_SESSION['addedCard'] = 'Card Added Successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}

function updateCardGroups($cartas_id_carta, $grupos_id_grupo)
{
    try {
        $conn = openDBCards();

        foreach ($_POST['group2'] as $group) {
            $update = "UPDATE cartas_has_grupos SET grupos_id_grupo = :grupos_id_grupo WHERE (cartas_id_carta = :cartas_id_carta) AND (grupos_id_grupo = $group)";
            $sentencia = $conn->prepare($update);

            $sentencia->bindParam(':cartas_id_carta', $cartas_id_carta);
            $sentencia->bindParam(':grupos_id_grupo', $grupos_id_grupo);

            $sentencia->execute();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}

function insertGroups($grupo)
{
    try {
        $conn = openDBCards();

        if (!groupExists($grupo)) {

            $insert = "INSERT INTO grupos (grupo) VALUES (:grupo);";
            $sentencia = $conn->prepare($insert);
            $sentencia->bindParam(':grupo', $grupo);
            $sentencia->execute();
            $_SESSION['addedGroup'] = 'Group Added Successfully';
        } else {
            $_SESSION['existingGroup'] = 'Group Already Exists';
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}

function groupExists($grupo)
{
    try {
        $conn = openDBCards();

        $select = "SELECT COUNT(*) FROM grupos WHERE grupo = :grupo";
        $sentencia = $conn->prepare($select);
        $sentencia->bindParam(':grupo', $grupo);
        $sentencia->execute();

        $count = $sentencia->fetchColumn();

        return $count > 0;
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
        return false;
    }
    $conn = closeDB();
}


function deleteCards($id_carta)
{
    try {
        $conn = openDBCards();

        $delete = "DELETE FROM cartas WHERE id_carta = :id_carta";
        $sentencia = $conn->prepare($delete);
        $sentencia->bindParam(':id_carta', $id_carta);
        $sentencia->execute();

        $_SESSION['deleted'] = 'Card Deleted Successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}

function deleteGroups($id_carta) {
    try {
        $conn = openDBCards();

        $delete = "DELETE FROM cartas_has_grupos WHERE cartas_id_carta = :id_carta";
        $sentencia = $conn->prepare($delete);
        $sentencia->bindParam(':id_carta', $id_carta);
        $sentencia->execute();

        $_SESSION['deleted'] = 'Card Deleted Successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getCode() . ' - ' . $e->getMessage();
    }

    $conn = closeDB();
}