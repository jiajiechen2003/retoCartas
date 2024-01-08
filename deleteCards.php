<?php
session_start();
require_once("cardsDB.php");

if (isset($_POST["deleteCard"])) {
    $id_card = $_POST['id_carta'];

    deleteGroups($id_card);
    deleteCards($id_card);
    
    if (isset($_SESSION['deleted'])) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
