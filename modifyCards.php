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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light ps-2 pt-4 pb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="img/logo.png" id="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- <div class="collapse navbar-collapse" id="modifyNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modify">
                                MODIFY CARD
                            </button>
                        </li>
                    </ul>
                </div> -->
            </div>
        </nav>
    </header>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <!-- TABLE TITLES -->
                <tr>
                    <th scope="col">Card ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Power</th>
                    <th scope="col">Attribute</th>
                    <th scope="col">Card Type</th>
                    <th scope="col">Group</th>
                    <th scope="col">Secondary Group</th>
                    <th scope="col">Update Card</th>
                </tr>
            </thead>
            <tbody>
                <!-- TABLE CONTENT WITH CARDS INFO -->
                <?php foreach ($cards as $card) {
                    $attribute = selectAttribute($card['id_carta']);
                    $type = selectType($card['id_carta']);
                    $group = selectGroup($card['id_carta']);
                    $secondaryGroup = selectSecondaryGroup($card['id_carta']);
                    echo "<tr>";
                    echo "<td>" . $card['id_carta'] . "</td>";
                    echo "<td>" . $card['nombre'] . "</td>";
                    echo "<td>" . $card['poder'] . "</td>";
                    foreach ($attribute as $value) {
                        echo "<td>" . $value['atributo'] . "</td>";
                    }
                    foreach ($type as $value) {
                        echo "<td>" . $value['tipo'] . "</td>";
                    }
                    foreach ($group as $value) {
                        echo "<td>" . $value['grupo'] . "</td>";
                    }
                    if ($secondaryGroup == null) {
                        echo "<td></td>";
                    } else {
                        foreach ($secondaryGroup as $value) {
                            echo "<td>" . $value['grupo'] . "</td>";
                        }
                    } ?>
                    <td><button type="button" class="btn btn-primary modify-button" data-bs-toggle="modal"
                            data-bs-target="#modify<?php echo $card['id_carta']; ?>">
                            Modify
                        </button></td>
                    <?php echo "</tr>"; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- MODIFY CARDS MODAL -->
    <?php foreach ($cards as $card) { ?>
        <?php $attribute = selectAttribute($card['id_carta']);
        $type = selectType($card['id_carta']);
        $group = selectGroup($card['id_carta']);
        $secondaryGroup = selectSecondaryGroup($card['id_carta']);
        ?>
        <div class="modal fade" id="modify<?php echo $card['id_carta']; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                <label for="name">Name <?php echo "(" . $card['nombre'] . ")"; ?></label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="power" name="power" placeholder="5000"
                                    min="1000" max="20000" step="1000" required>
                                <label for="power">Power <?php echo " (" . $card['poder'] . ")"; ?>
                                </label>
                            </div>

                            <label for="attribute">Attribute 
                                <?php foreach ($attribute as $value) {
                                    echo " (" . $value['atributo'] . ")";
                                } ?>
                            </label>
                            <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                name="attribute" required>
                                <option disabled selected>Choose An Attribute</option>
                                <?php foreach ($attributes as $attribute) { ?>
                                    <option value="<?php echo $attribute['id_atributo'] ?>">
                                        <?php echo $attribute['atributo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="type">Type 
                                <?php foreach ($type as $value) {
                                    echo " (" . $value['tipo'] . ")";
                                } ?>
                            </label>
                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="type"
                                required>
                                <option disabled selected>Choose Card type</option>
                                <?php foreach ($types as $type) { ?>
                                    <option value="<?php echo $type['id_tipo'] ?>">
                                        <?php echo $type['tipo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="group">Group 
                                <?php foreach ($group as $value) {
                                    echo " (" . $value['grupo'] . ")";
                                } ?>
                            </label>
                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="group"
                                required>
                                <option disabled selected>Select Group</option>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group['id_grupo'] ?>">
                                        <?php echo $group['grupo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <label for="group2">Secondary Group 
                                <?php
                                    if ($secondaryGroup != null) {
                                        foreach ($secondaryGroup as $value) {
                                            echo "(" . $value['grupo'] . ")";
                                        }
                                    }
                                ?>
                            
                            </label>
                            <select class="form-select form-select-lg mb-3" aria-label="Large select example"
                                name="group2">
                                <option disabled selected>Select Secondary Group</option>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group['id_grupo'] ?>">
                                        <?php echo $group['grupo'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <div class="form-floating mb-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addGroup">
                                    Add group
                                </button>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select an Image <?php echo " (" . $card['imagen'] . ")"; ?></label>
                                <input class="form-control" type="file" id="formFile" name="image" required>
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

    <!-- ADD GROUP MODAL -->
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
                            <input type="text" class="form-control" id="group" name="group" placeholder="Straw Hat Crew"
                                required>
                            <label for="name">Group's Name</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addGroups2">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
</body>

</html>