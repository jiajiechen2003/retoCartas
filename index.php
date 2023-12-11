<?php
require_once("cardsDB.php");
$cards = selectCards();
$attributes = selectAttributes();
$types = selectTypes();
$groups = selectGroups();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/700997539d.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- HEADER WITH MODALS -->
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light ps-2 pt-4 pb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="img/logo.png" id="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add" id="addCardButton">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="modifyCards.php" class="btn btn-primary" role="button">MODIFY CARD</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php require_once("messages.php"); ?>

    <!-- CARDS DISPLAY -->
    <div class="cards">
        <?php foreach ($cards as $card) { ?>
            <?php $attribute = selectAttribute($card['id_carta']);
            $attributeImage = selectAttributeImage($card['id_carta']);
            $type = selectType($card['id_carta']);
            $group = selectGroup($card['id_carta']);
            $secondaryGroup = selectSecondaryGroup($card['id_carta']);
            ?>
            <a href="#" data-bs-toggle="modal" data-bs-target="#card<?php echo $card['id_carta']; ?>" class="card" id="<?php echo $card['id_carta']; ?>">
                <div class="card-stats">
                    <div class="card-power">
                        <h2>
                            <?php echo $card['nombre'] ?>
                        </h2>
                        <h3>
                            <?php echo $card['poder'] ?>
                        </h3>
                        <img src="<?php foreach ($attributeImage as $image) {
                                        echo $image['imagen'];
                                    } ?>" id="<?php foreach ($attribute as $value) {
                                                    echo $value['atributo'];
                                                } ?>">
                    </div>
                </div>
                <div class="card-img">
                    <img src="<?php echo $card['imagen'] ?>">
                </div>
                <div class="card-text">
                    <div class="card-type">
                        <h4>
                            <?php foreach ($type as $tipo) {
                                echo $tipo['tipo'];
                            } ?>
                        </h4>
                    </div>
                    <div class="card-crew">
                        <h4>
                            <?php
                            foreach ($group as $crew1) {
                                echo $crew1['grupo'];
                            }

                            foreach ($secondaryGroup as $crew2) {
                                echo "/" . $crew2['grupo'];
                            }
                            ?>
                        </h4>
                    </div>
                </div>
            </a>
        <?php } ?>

        <!-- MODAL FOR SINGLE CARD -->
        <?php foreach ($cards as $card) { ?>
            <div class="modal fade" id="card<?php echo $card['id_carta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" id="modalCard">
                        <?php $attribute = selectAttribute($card['id_carta']);
                        $attributeImage = selectAttributeImage($card['id_carta']);
                        $type = selectType($card['id_carta']);
                        $group = selectGroup($card['id_carta']);
                        $secondaryGroup = selectSecondaryGroup($card['id_carta']);
                        ?>
                        <div class="card">
                            <div class="card-stats">
                                <div class="card-power">
                                    <h2>
                                        <?php echo $card['nombre'] ?>
                                    </h2>
                                    <h3>
                                        <?php echo $card['poder'] ?>
                                    </h3>
                                    <img src="<?php foreach ($attributeImage as $image) {
                                                    echo $image['imagen'];
                                                } ?>" id="<?php foreach ($attribute as $value) {
                                                                echo $value['atributo'];
                                                            } ?>">
                                </div>
                            </div>
                            <div class="card-img">
                                <img src="<?php echo $card['imagen'] ?>">
                            </div>
                            <div class="card-text">
                                <div class="card-type">
                                    <h4>
                                        <?php foreach ($type as $tipo) {
                                            echo $tipo['tipo'];
                                        } ?>
                                    </h4>
                                </div>
                                <div class="card-crew">
                                    <h4>
                                        <?php
                                        foreach ($group as $crew1) {
                                            echo $crew1['grupo'];
                                        }

                                        foreach ($secondaryGroup as $crew2) {
                                            echo "/" . $crew2['grupo'];
                                        }
                                        ?>
                                    </h4>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary modify-button" data-bs-toggle="modal" data-bs-target="#modify<?php echo $card['id_carta']; ?>" id="editButton"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete" id="deleteButton"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- ADD CARDS MODAL -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a new card</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="addCards.php" method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Monkey D. Luffy" required>
                                <label for="name">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="power" name="power" placeholder="5000" min="1000" max="20000" step="1000" required>
                                <label for="power">Power</label>
                            </div>

                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="attribute" required>
                                <option disabled selected>Choose An attribute</option>
                                <?php foreach ($attributes as $attribute) { ?>
                                    <option value="<?php echo $attribute['id_atributo'] ?>">
                                        <?php echo $attribute['atributo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="type" required>
                                <option disabled selected>Choose Card type</option>
                                <?php foreach ($types as $type) { ?>
                                    <option value="<?php echo $type['id_tipo'] ?>">
                                        <?php echo $type['tipo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="group" required>
                                <option disabled selected>Group</option>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group['id_grupo'] ?>">
                                        <?php echo $group['grupo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="group2">
                                <option disabled selected>Secondary Group</option>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group['id_grupo'] ?>">
                                        <?php echo $group['grupo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <div class="form-floating mb-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroup">
                                    Add group
                                </button>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select an Image</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADD GROUPS MODAL -->
        <div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add a new group</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="addGroups.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="group" name="group" placeholder="Straw Hat Crew" required>
                                <label for="name">Group's Name (Ex. Straw Hat Crew)</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="addGroups">Save
                                    changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->

        <?php foreach ($cards as $card) { ?>
            <?php $attribute = selectAttribute($card['id_carta']);
            $type = selectType($card['id_carta']);
            $group = selectGroup($card['id_carta']);
            $secondaryGroup = selectSecondaryGroup($card['id_carta']);
            ?>
            <div class="modal fade" id="modify<?php echo $card['id_carta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modify
                                <?php echo $card['nombre']; ?> Card
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- FORM TO MODIFY CARDS -->
                            <form action="modify.php" method="POST" enctype="multipart/form-data" id="modifyForm">
                                <div class="form-floating mb-3">
                                    <input type="text" id="id_carta" name="id_carta" value="<?php echo $card['id_carta']; ?>" hidden>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $card['nombre']; ?>">
                                    <label for="name">Name
                                        <?php // echo "(" . $card['nombre'] . ")"; 
                                        ?>
                                    </label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="power" name="power" placeholder="5000" min="1000" max="20000" step="1000" value="<?php echo $card['poder']; ?>">
                                    <label for="power">Power
                                        <?php // echo " (" . $card['poder'] . ")"; 
                                        ?>
                                    </label>
                                </div>

                                <label for="attribute">Attribute</label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="attribute" required>
                                    <option disabled>Choose An Attribute</option>
                                    <?php foreach ($attributes as $attribute) { ?>
                                        <option value="<?php echo $attribute['id_atributo']; ?>" <?php if ($attribute['id_atributo'] == $card['atributo']) echo 'selected'; ?>>
                                            <?php echo $attribute['atributo']; ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <label for="type">Type</label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="type" required>
                                    <option disabled>Choose Card type</option>
                                    <?php foreach ($types as $type) { ?>
                                        <option value="<?php echo $type['id_tipo']; ?>" <?php if ($type['id_tipo'] == $card['tipo_carta']) echo 'selected'; ?>>
                                            <?php echo $type['tipo']; ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <label for="group">Group</label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="group" required>
                                    <option disabled>Select Group</option>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group['id_grupo'] ?>" <?php if ($group['id_grupo'] == $card['grupo']) echo 'selected' ?>>
                                            <?php echo $group['grupo'] ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <label for="group2">Secondary Group</label>
                                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="group2">
                                    <option disabled selected>Select Secondary Group</option>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group['id_grupo'] ?>" <?php if ($group['id_grupo'] == $card['grupo_secundario']) echo 'selected' ?>>
                                            <?php echo $group['grupo'] ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <div class="form-floating mb-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroup">
                                        Add group
                                    </button>
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Select an Image</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="modifyCard">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- DELETE MODAL -->

        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this card?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="deleteCards.php" method="POST">
                            <input type="hidden" name="id_carta" value="<?php echo $card['id_carta']; ?>">
                            <button type="submit" class="btn btn-danger" name="deleteCard">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>