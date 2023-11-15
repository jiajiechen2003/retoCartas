<?php
require_once("cardsDB.php");


if (isset($_POST["modifyCard"])) {
    $targetDirectory = "img/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $rutaImagen = $targetFile;
    } else {
        echo "Hubo un error al subir la imagen.";
    }

    if (isset($_POST['group2'])) {
        updateCards(
            $_POST['name'],
            $_POST['power'],
            $_POST['attribute'],
            $_POST['type'],
            $_POST['group'],
            $_POST['group2'],
            $rutaImagen,
            
        );
    } else {
        updateCards(
            $_POST['name'],
            $_POST['power'],
            $_POST['attribute'],
            $_POST['type'],
            $_POST['group'],
            null,
            $rutaImagen
        );
    }

    echo "Card added successfully.";

    header("Location: index.php");
    exit();
}

?>