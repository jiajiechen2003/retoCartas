<?php
session_start();
require_once("cardsDB.php");

if (isset($_POST["addGroups"])) {

    insertGroups(
        $_POST['group']
    );
}

if (isset($_SESSION['addedGroup'])) {
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}

?>