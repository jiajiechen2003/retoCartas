<?php

require_once("cardsDB.php");

if (isset($_POST["addGroups"])) {

    insertGroups(
        $_POST['group']
    );

    header("Location: index.php");
    exit();
}

if (isset($_POST["addGroups2"])) {

    insertGroups(
        $_POST['group']
    );

    header("Location: modifyCards.php");
    exit();
}
?>