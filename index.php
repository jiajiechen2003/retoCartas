<?php
require_once("cardsDB.php");
$cards = selectCards();
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
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                                ADD NEW CARD
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modify">
                                MODIFY CARD
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#delete">
                                DELETE CARD
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add a new card</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Monkey D. Luffy"
                                required>
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="power" name="power" placeholder="5000"
                                min="1000" step="1000" required>
                            <label for="power">Power</label>
                        </div>

                        <select class="form-select form-select-lg mb-3" aria-label="Large select example" required>
                            <option selected>Choose an attribute</option>
                            <option value="1">Ranged</option>
                            <option value="2">Slash</option>
                            <option value="3">Special</option>
                            <option value="4">Strike</option>
                            <option value="5">Wisdom</option>
                        </select>

                        <select class="form-select form-select-lg mb-3" aria-label="Large select example" required>
                            <option selected>Choose card type</option>
                            <option value="1">Character</option>
                            <option value="2">Leader</option>
                        </select>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="group" name="group" placeholder="Straw Hat Crew"
                                required>
                            <label for="name">Crew/Navy/Group</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="group2" name="group2"
                                placeholder="Straw Hat Crew" required>
                            <label for="name">Secondary Crew/Navy/Group</label>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select an Image</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="cards">
        <?php foreach ($cards as $card) { ?>
            <?php $attribute = selectAttribute($card['id_carta']); 
                $attributeImage = selectAttributeImage($card['id_carta']); 
                $type = selectType($card['id_carta']);
                $group = selectGroup($card['id_carta']);
                $secondaryGroup = selectSecondaryGroup($card['id_carta']);
                ?>
            <div class="card">
                <div class="leader-card-stats">
                    <div class="leader-power">
                        <h2>
                            <?php echo $card['nombre'] ?>
                        </h2>
                        <h3>
                            <?php echo $card['poder'] ?>
                        </h3>
                        <img src="<?php foreach ($attributeImage as $image) {
                            echo $image['imagen'];
                        } ?>" 
                        
                        id="<?php foreach ($attribute as $value) {
                               echo $value['atributo'];
                           } ?>">
                    </div>
                </div>
                <div class="leader-img">
                    <img src="<?php echo $card['imagen'] ?>">
                </div>
                <div class="card-text">
                    <div class="card-type">
                        <h4>
                            <?php foreach ($type as $tipo){
                                echo $tipo['tipo'];   
                            }?>
                        </h4>
                    </div>
                    <div class="card-crew">
                        <h4>
                            <?php
                            if (isset($card['grupo_secundario'])) {
                                echo $card['grupo'] . "/" . $card['grupo_secundario'];
                            } else {
                                echo $card['grupo'];
                            }
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Monkey D. Luffy</h2>
                    <h3>9000</h3>
                    <img src="img/strikeLogo.PNG" id="strike">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/luffyLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Straw Hat Crew/Worst Generation</h4>
                </div>
            </div>
        </div>
            <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Roronoa Zoro</h2>
                    <h3>6000</h3>
                    <img src="img/slashLogo.PNG" id="slash">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/zoroLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Straw Hat Crew/Worst Generation</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Sanji</h2>
                    <h3>5000</h3>
                    <img src="img/strikeLogo.PNG" id="strike">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/sanjiLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Straw Hat Crew</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Trafalgar Law</h2>
                    <h3>7000</h3>
                    <img src="img/slashLogo.PNG" id="slash">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/lawLeader.png">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Heart Pirates/Worst Generation</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="character-card-stats">
                <div class="character-power">
                    <h2>Boa Hancock</h2>
                    <h3>5000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="character-img">
                <img src="img/hancock.webp">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Character</h4>
                </div>
                <div class="card-crew">
                    <h4>Shichibukai/Kuja Pirates</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="character-card-stats">
                <div class="character-power">
                    <h2>Robin-Chwan</h2>
                    <h3>4000</h3>
                    <img src="img/wisdomLogo.PNG" id="wisdom">
                </div>
            </div>
            <div class="character-img">
                <img src="img/robinChwan.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Character</h4>
                </div>
                <div class="card-crew">
                    <h4>Straw Hat Crew</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="character-card-stats">
                <div class="character-power">
                    <h2>Nami-Swan</h2>
                    <h3>3000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="character-img">
                <img src="img/namiSwan.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Character</h4>
                </div>
                <div class="card-crew">
                    <h4>Straw Hat Crew</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="character-card-stats">
                <div class="character-power">
                    <h2>Jewelry Bonney</h2>
                    <h3>1000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="character-img">
                <img src="img/bonney.jpeg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Character</h4>
                </div>
                <div class="card-crew">
                    <h4>Bonney Pirates/Worst Generation</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Shanks</h2>
                    <h3>10000</h3>
                    <img src="img/slashLogo.PNG" id="slash">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/shanksLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Four Emperors/Red-Haired Pirates</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Edward Newgate</h2>
                    <h3>10000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/barbablancaLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Four Emperors/Whitebeard Pirates</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Gol D. Roger</h2>
                    <h3>10000</h3>
                    <img src="img/slashLogo.PNG" id="slash">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/rogerLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Roger Pirates</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Monkey D. Garp</h2>
                    <h3>7000</h3>
                    <img src="img/strikeLogo.PNG" id="strike">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/garpLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Navy</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Marshal D. Teach</h2>
                    <h3>6000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/barbanegraLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Four Emperors/Blackbeard Pirates</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Kaido</h2>
                    <h3>12000</h3>
                    <img src="img/strikeLogo.PNG" id="strike">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/kaidoLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Four Emperors/Beast Pirates</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Akainu</h2>
                    <h3>7000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/akainuLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Navy</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="leader-card-stats">
                <div class="leader-power">
                    <h2>Big Mom</h2>
                    <h3>5000</h3>
                    <img src="img/specialLogo.PNG" id="special">
                </div>
            </div>
            <div class="leader-img">
                <img src="img/bigmomLeader.jpg">
            </div>
            <div class="card-text">
                <div class="card-type">
                    <h4>Leader</h4>
                </div>
                <div class="card-crew">
                    <h4>Four Emperors/Big Mom Pirates</h4>
                </div>
            </div>
        </div>
    </div> -->

        <div class="modal fade" id="modify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>