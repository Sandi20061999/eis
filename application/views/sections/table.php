<?php for ($i = 0; $i < count($table); $i++) {
    echo '<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">' . $title[$i] . '</h4>';
    echo $table[$i];
    echo '</div></div></div></div>';
};
