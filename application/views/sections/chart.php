    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php for ($i = 0; count($color) > $i; $i++) {
                    ?>
                        <span class="badge" style="width: 10;background-color: <?= $color[$i] ?>">-</span> <?= $lable[$i] ?>
                    <?php } ?>
                    <h4 class=" card-title"></h4>
                    <div id="<?php echo $id; ?>"></div>
                </div>
            </div>
        </div>
    </div>