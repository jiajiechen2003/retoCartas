<?php

require_once("cardsDB.php");

if (isset($_POST["addGroups"])) {

    insertGroups(
        $_POST['group']
    );

    header("Location: index.php");
    exit();
}
?>