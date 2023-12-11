<?php if (isset($_SESSION['addedCard'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['addedCard'];
        unset($_SESSION['addedCard']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['addedGroup'])) { ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        echo $_SESSION['addedGroup'];
        unset($_SESSION['addedGroup']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['existingGroup'])) { ?>

    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['existingGroup'];
        unset($_SESSION['existingGroup']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['deleted'])) { ?>

    <div class="alert alert-success" role="alert">
        <?php
        echo $_SESSION['deleted'];
        unset($_SESSION['deleted']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['edited'])) { ?>

    <div class="alert alert-success" role="alert">
        <?php
        echo $_SESSION['edited'];
        unset($_SESSION['edited']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>

    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>