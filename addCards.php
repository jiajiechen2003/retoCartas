<?php
// session_start();
require_once("cardsDB.php");

if (isset($_POST["add"])) {
    try {
        $conn = openDBCards();
        $conn->beginTransaction();

        $targetDirectory = "img/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $rutaImagen = $targetFile;
        } else {
            throw new Exception("Hubo un error al subir la imagen.");
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

        $conn->commit();

        if (isset($_SESSION['addedCard'])) {
            header("Location: index.php");
            exit();
        }
        
    } catch (Exception $e) {
        $conn->rollBack();
        $_SESSION['error'] = $e->getMessage();
        header("Location: index.php");
        exit();
    } finally {
        $conn = closeDB();
    }
}
