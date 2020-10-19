<?php

// format key ['x' => 'bilangan', 'y' => array('0'=>'',...),'color'=>array('0'=>'',..)]
// format data ['0'=>'','1'=>'',...]
// type = 'morris-bar-chart','extra-area-chart','morris-area-chart','morris-area-chart0','morris-donut-chart','morris-line-chart'
// type = morris-donut-chart maka format key ['x'=>label,'y'=>array('0'=>'value')]
function morris_chart($key, $data, $type, $n)
{
    $x = $key['x'];
    $ar = array();
    foreach ($data as $t) {
        $string = "{" . $x . ":'" . $t[0] . "'";
        $isi = '';
        for ($co = 0; $co < count($key['y']); $co++) {
            $isi .= "," . $key['y'][$co] . ":" . $t[$co + 1];
        }
        $fix = $string . $isi . "}";
        array_push($ar, $fix);
    }
    // Y
    // $ce = 0;
    $cy = count($key['y']) - 1;
    $yku = '';
    // foreach ($key['y'] as $ky) {
    for ($ce = 0; $ce < count($key['y']); $ce++) {
        if ($cy == $ce) {
            $yku .= "'" . $key['y'][$ce] . "'";
        } else {
            $yku .= "'" . $key['y'][$ce] . "',";
        }
        // $ce++;
    }
    $y = "[" . $yku . "]";
    // Warna
    // $cc = 0;
    $cco = count($key['color']) - 1;
    $cku = '';
    for ($cc = 0; $cc < count($key['color']); $cc++) {
        // foreach ($key['color'] as $kyq) {
        if ($cco == $cc) {
            $cku .= "'" . $key['color'][$cc] . "'";
        } else {
            $cku .= "'" . $key['color'][$cc] . "',";
        }
        // $cc++;
    }
    $color = "[" . $cku . "]";

    $isi1 = implode(",", $ar);
    $view =  "[" . $isi1 . "]";
    // var_dump($y);
    // die;
    if ($type == 'morris-bar-chart') {
        return "Morris.Bar({element: 'morris-bar-chart" . $n . "',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",barColors: " . $color . ",hideHover: 'auto',gridLineColor: 'transparent',resize: true});";
    }
    if ($type == 'extra-area-chart') {
        return "Morris.Area({element: 'extra-area-chart" . $n . "',data: " . $view . ",lineColors: " . $color . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 0,lineWidth: 0,resize: true,fillOpacity: 0.8,behaveLikeLine: true,gridLineColor: 'transparent',hideHover: 'auto'});";
    }
    if ($type == 'morris-area-chart') {
        return "Morris.Area({element: 'morris-area-chart" . $n . "',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 3,fillOpacity: 0,pointStrokeColors: " . $color . ",behaveLikeLine: true,gridLineColor: 'transparent',lineWidth: 3,hideHover: 'auto',lineColors: ['#7571F9', '#4d7cff', '#9097c4'],resize: true});";
    }
    if ($type == 'morris-donut-chart') {
        return "Morris.Donut({element: 'morris-donut-chart" . $n . "',data: " . $view . ",resize: true,colors: " . $color . "});";
    }
    if ($type == 'morris-line-chart') {
        return "let line = new Morris.Line({element: 'morris-line-chart" . $n . "',resize: true,data: " . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",gridLineColor: 'transparent',lineColors: " . $color . ",lineWidth: 1,hideHover: 'auto',});";
    }
}

// format thn ajaran ['TA'=>array('2017/2018','2018/2019','2019/2020')]
function accordion($Jurusan, $TA)
{
}

function table_view($dat)
{
    $temp = '<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Table</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>';
    foreach ($dat[0] as $i => $v) {
        if ($i != 'ct') {
            $temp .= '<th>' . field_as($i) . '</th>';
        }
    }
    $temp .=
        '</tr>
        </thead>
        <tbody>';
    foreach ($dat as $t) {
        $temp .= '<tr>';
        foreach ($dat[0] as $i => $v) {
            if ($i != 'ct') {
                $temp .= '<td>' . $t[$i] . '</td>';
            }
        }
        $temp .= '</tr>';
    }
    $temp .= '</tbody>
                        <tfoot>
                            <tr>';
    foreach ($dat[0] as $i => $v) {
        if ($i != 'ct') {
            $temp .= '<th>' . field_as($i) . '</th>';
        }
    }
    $temp .= '</tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>';
    return $temp;
}
function accordion_view($name, $dat, $by)
{
    $temp = '<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">' . $name . '</h4>
                <p class="text-muted"><code></code>
                </p>
                <div id="accordion-one" class="accordion">';
    $dump = [];
    $i = 0;
    foreach ($dat as $index => $x) {
        $dump[$x[$by]][$index] = $x;
    }
    foreach ($dump as $index => $x) {
        $temp .= '<div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne' . $i . '" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i>' .
            $index . '</h5>
                        </div>
                        <div id="collapseOne' . $i . '" class="collapse" data-parent="#accordion-one">
                            <div class="card-body">' . table_view(array_values($x)) . '</div>
                        </div>
                    </div>';
        $i++;
    }
    // for ($i = 0; $i < count($dump); $i++) {
    //     $temp .= '<div class="card">
    //                     <div class="card-header">
    //                         <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne' . $i . '" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i>' .
    //         $dump['2012/2013'][1]['ta'] . '</h5>
    //                     </div>
    //                     <div id="collapseOne' . $i . '" class="collapse" data-parent="#accordion-one">
    //                         <div class="card-body"></div>
    //                     </div>
    //                 </div>';
    // }


    $temp .= '</div>
            </div>
        </div>
    </div>
</div>';
    return $temp;
}
