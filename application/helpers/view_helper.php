<?php

// format key ['x' => 'bilangan', 'y' => array('0'=>'',...),'color'=>array('0'=>'',..)]
// format data ['0'=>'','1'=>'',...]
// type = 'morris-bar-chart','extra-area-chart','morris-area-chart','morris-area-chart0','morris-donut-chart','morris-line-chart'
// type = morris-donut-chart maka format key ['x'=>label,'y'=>array('0'=>'value')]
function morris_chart($key, $data, $type, $n)
{
    // var_dump($data);
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
        return "Morris.Bar({element: 'morris-bar-chart" . $n . "',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",barColors: " . $color . ",hideHover: 'false',gridLineColor: 'transparent',resize: true});";
    }
    if ($type == 'extra-area-chart') {
        return "Morris.Area({element: 'extra-area-chart" . $n . "',data: " . $view . ",lineColors: " . $color . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 0,lineWidth: 0,resize: true,fillOpacity: 0.8,behaveLikeLine: true,gridLineColor: 'transparent',hideHover: 'auto'});";
    }
    if ($type == 'morris-area-chart') {
        return "Morris.Area({element: 'morris-area-chart" . $n . "',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 3,fillOpacity: 0,pointStrokeColors: " . $color . ",behaveLikeLine: true,gridLineColor: 'transparent',lineWidth: 3,hideHover: 'auto',lineColors: " . $color . ",resize: true});";
    }
    if ($type == 'morris-donut-chart') {
        return "Morris.Donut({element: 'morris-donut-chart" . $n . "',data: " . $view . ",resize: true,colors: " . $color . "});";
    }
    if ($type == 'morris-line-chart') {
        return "let line = new Morris.Line({element: 'morris-line-chart" . $n . "',resize: true, data: " . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",lineColors: " . $color . ",hideHover: false,});";
    }
}


function table_view($dat, $exc = [])
{
    $temp = '
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>';
    foreach ($dat[0] as $i => $v) {
        if ($i != 'ct') {
            if (!in_array($i, $exc)) {
                $temp .= '<th>' . field_as($i) . '</th>';
            }
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
                if (!in_array($i, $exc)) {
                    $temp .= '<td>' . $t[$i] . '</td>';
                }
            }
        }
        $temp .= '</tr>';
    }
    $temp .= '</tbody>
                        <tfoot>
                            <tr>';
    foreach ($dat[0] as $i => $v) {
        if ($i != 'ct') {
            if (!in_array($i, $exc)) {
                $temp .= '<th>' . field_as($i) . '</th>';
            }
        }
    }
    $temp .= '</tr>
                        </tfoot>
                    </table>
                </div>';
    return $temp;
}
function accordion_view($name, $dat, $by, $id)
{
    $temp = '<div class="row mb-4">
    <div class="col-lg-12">
            <div id="accordion-one' . $id . '" class="accordion">
            <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOneTop' . $id . '" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i>' . $name . '
                            </h5>
                        </div>
                        <div id="collapseOneTop' . $id . '" class="collapse" data-parent="#accordion-one' . $id . '">
                            <div class="card-body">';
    $dump = [];
    $i = 0;
    foreach ($dat as $index => $x) {
        $dump[$x[$by]][$index] = $x;
    }
    ksort($dump);
    foreach ($dump as $index => $x) {
        $temp .= ' <div id="accordion-one' . $id . $i . '" class="accordion">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne' . $id . $i . '" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i>' .
            $index . '</h5>
                        </div>
                        <div id="collapseOne' . $id . $i . '" class="collapse" data-parent="#accordion-one' . $id . $i . '">
                            <div class="card-body">' . table_view(array_values($x), ['id_jurusan', 'kelurahan', 'nm_kecamatan', 'nm_kabupaten', 'nm_propinsi', 'nm_semester']) . '</div>
                        </div>
                    </div>
                    </div>';

        $i++;
    }

    $temp .= '</div>
            </div>
            </div>
        </div>
    </div>
</div>';
    return $temp;
}
function card($data)
{
    //data = [
    //     'title' => 'Judul',
    //     'nilai' => '100',
    //     'detail' => 'anyyy',
    //
    //     'width' => '1-12',
    //     'icon' => 'fa-user',
    // ]
    $default = ['title' => 'Judul Tidak Di Set', 'color' => 'primary', 'width' => '12', 'nilai' => 'Tidak Ada Nilai', 'icon' => 'fa-window-close'];

    $temp = '<div class="col-md-' . (isset($data['width']) ? $data['width'] : $default['width']) . '">
    <div class="card bg-' . (isset($data['color']) ? $data['color'] : $default['color']) . '">
        <div class="card-body">
            <h3 class="card-title text-white">' . (isset($data['title']) ? $data['title'] : $default['title']) . '</h3>
            <div class="d-inline-block">
                <h2 class="text-white">' . (isset($data['nilai']) ? $data['nilai'] : $default['nilai']) . '</h2>';
    if (isset($data['detail'])) {
        $temp .= '<p class="text-white mb-0">' . $data['detail'] . '</p>';
    }
    $temp .= '</div>
            <span class="float-right display-5 opacity-5"><i class="fa text-white ' . (isset($data['icon']) ? $data['icon'] : $default['icon']) . '"></i></span>
        </div>
    </div>
</div>';
    return $temp;
}
function tab($data)
{
    //buatin tag untuk chart 

    //aku pindah di dungsi baru
    //
    $temp = '<div class="default-tab">
    <ul class="nav nav-tabs mb-3" role="tablist">';
    $i = 0;
    foreach ($data as $index => $val) {
        if ($i == 0) {
            $temp .= '<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#' . str_replace(' ', '_', $index) . '">' . $index . '</a>
        </li>';
        } else {
            $temp .= '<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#' . str_replace(' ', '_', $index) . '">' . $index . '</a>
        </li>';
        }
        $i++;
    }
    $i = 0;
    $temp .= '</ul>
    <div class="tab-content">';
    foreach ($data as $index => $val) {
        if ($i == 0) {
            $temp .= '<div class="tab-pane fade show active" id="' . str_replace(' ', '_', $index) . '" role="tabpanel">
            <div class="p-t-15">
                <h4>This is ' . $index . ' title</h4>';
            foreach ($val as $content) {
                if (isset($content['color'])) {
                    $temp .= tagchart($content['color'], $content['lable'], $content['id']);
                } else {
                    $temp .= $content;
                }
            }
            $temp .= '</div>
        </div>';
        } else {
            $temp .= ' <div class="tab-pane fade" id="' . str_replace(' ', '_', $index) . '">
        <div class="p-t-15">
          <h4>This is ' . $index . ' title</h4>';
            foreach ($val as $content) {
                if (isset($content['color'])) {
                    $temp .= tagchart($content['color'], $content['lable'], $content['id']);
                } else {
                    $temp .= $content;
                }
            }
            $temp .= '</div>
    </div>';
        }
        $i++;
    }
    $i = 0;
    $temp .= '  </div>
    </div>';
    return $temp;
}
function tagchart($color, $lable, $id)
{
    $tagchart = '<div class="flex-d flex-direction-row"></div>';
    for ($i = 0; count($color) > $i; $i++) {

        $tagchart .= '<span class="badge" style="width: 10;background-color: ' . $color[$i] . '">-</span> ' . $lable[$i];
    }
    $tagchart .= '<h4 class=" card-title"></h4>
    <div id="' . $id . '"></div>';
    return $tagchart;
}
