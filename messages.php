<?php if (isset($_SESSION['addedCard'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h2><?php
            echo $_SESSION['addedCard'];
            unset($_SESSION['addedCard']);
            ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['addedGroup'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h2>
            <?php
            echo $_SESSION['addedGroup'];
            unset($_SESSION['addedGroup']);
            ?>
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['existingGroup'])) { ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h2>
            <?php
            echo $_SESSION['existingGroup'];
            unset($_SESSION['existingGroup']);
            ?>
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['deleted'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h2>
            <?php
            echo $_SESSION['deleted'];
            unset($_SESSION['deleted']);
            ?>
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['edited'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h2>
            <?php
            echo $_SESSION['edited'];
            unset($_SESSION['edited']);
            ?>
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h2>
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>