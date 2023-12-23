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

    $cardGroup = selectCardGroupID($_POST['id_carta']);

    updateCards(
        $_POST['name'],
        $_POST['power'],
        $_POST['attribute'],
        $_POST['type'],
        $rutaImagen,
        $_POST['id_carta']
    );

    foreach ($_POST['group'] as $group) {
        updateCardGroups($_POST['id_carta'], $group, $cardGroup);
    }

    var_dump($_POST['group'], $_POST['name'],
        $_POST['power'],
        $_POST['attribute'],
        $_POST['type'],
        $rutaImagen,
        $_POST['id_carta'], $_POST['group2']);
    die();

    if (isset($_SESSION['edited'])) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
