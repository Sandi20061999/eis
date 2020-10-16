<?php

// format key ['x' => 'bilangan', 'y' => array('0'=>'',...),'color'=>array('0'=>'',..)]
// format data ['0'=>'','1'=>'',...]
// type = 'morris-bar-chart','extra-area-chart','morris-area-chart','morris-area-chart0','morris-donut-chart','morris-line-chart'
// type = morris-donut-chart maka format key ['x'=>label,'y'=>array('0'=>'value')]
function morris_chart($key, $data, $type)
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
        }else{
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
        return "Morris.Bar({element: 'morris-bar-chart',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",barColors: " . $color . ",hideHover: 'auto',gridLineColor: 'transparent',resize: true});";
    }
    if ($type == 'extra-area-chart') {
        return "Morris.Area({element: 'extra-area-chart',data: " . $view . ",lineColors: " . $color . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 0,lineWidth: 0,resize: true,fillOpacity: 0.8,behaveLikeLine: true,gridLineColor: 'transparent',hideHover: 'auto'});";
    }
    if ($type == 'morris-area-chart') {
        return "Morris.Area({element: 'morris-area-chart',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 3,fillOpacity: 0,pointStrokeColors: " . $color . ",behaveLikeLine: true,gridLineColor: 'transparent',lineWidth: 3,hideHover: 'auto',lineColors: ['#7571F9', '#4d7cff', '#9097c4'],resize: true});";
    }
    if ($type == 'morris-area-chart0') {
        return "Morris.Area({element: 'morris-area-chart0',data:" . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",pointSize: 0,fillOpacity: 0.4,pointStrokeColors: " . $color . ",behaveLikeLine: true,gridLineColor: 'transparent',lineWidth: 0,smooth: false,hideHover: 'auto',lineColors: " . $color . ",resize: true});";
    }
    if ($type == 'morris-donut-chart') {
        return "Morris.Donut({element: 'morris-donut-chart',data: " . $view . ",resize: true,colors: " . $color . "});";
    }
    if ($type == 'morris-line-chart') {
        return "let line = new Morris.Line({element: 'morris-line-chart',resize: true,data: " . $view . ",xkey: '" . $x . "',ykeys: " . $y . ",labels: " . $y . ",gridLineColor: 'transparent',lineColors: " . $color . ",lineWidth: 1,hideHover: 'auto',});";
    }
}

// format thn ajaran ['TA'=>array('2017/2018','2018/2019','2019/2020')]
function accordion($Jurusan, $TA){

}