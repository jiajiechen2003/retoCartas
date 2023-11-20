<?php if (isset($_SESSION['message'])) { ?>

    <div class="alert alert-danger" role="alert">

        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>