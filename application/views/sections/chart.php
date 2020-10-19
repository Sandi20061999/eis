<?php for ($i = 0; $i < count($type); $i++) : ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pendaftar</h4>
                    <div id="<?php echo $type[$i] . $i; ?>"></div>
                </div>
            </div>
        </div>
    </div>
<?php endfor ?>