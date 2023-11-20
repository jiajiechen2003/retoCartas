<?php

require_once("cardsDB.php");

if (isset($_POST["deleteCard"])) {
    $id_card = $_POST['id_carta'];

    deleteCards($id_card);

    echo "Card deleted successfully.";

    header("Location: index.php");
    exit();
}

?>