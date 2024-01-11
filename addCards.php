<?php
session_start();
require_once("cardsDB.php");

if (isset($_POST["add"])) {
    $targetDirectory = "img/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $rutaImagen = $targetFile;
    } else {
        echo "Hubo un error al subir la imagen.";
    }
    $id_carta = insertCards(
        $_POST['name'],
        $_POST['power'],
        $_POST['attribute'],
        $_POST['type'],
        $rutaImagen
    );

    foreach ($_POST['group'] as $id_grupo) {
        insertCardGroups($id_carta, $id_grupo);
    }

    if (isset($_SESSION['addedCard'])) {

        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
