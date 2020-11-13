<?php
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
    $temp = '
                <div class="col-md-12 my-3">
                    <div class="card">
                        <div class="card-body">
                            <div id="accordion-one' . $id . '" class="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOneTop' . $id . '" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i>' . $name . ' </h5>
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
    </div>
    </div>';
    return $temp;
} 
function card($data,$u,$filter)
{
    
    //     'title' => 'Judul',
    //     'nilai' => '100',
    //     'detail' => 'anyyy',
    //
    //     'width' => '1-12',
    //     'icon' => 'fa-user',
    // ]
    asort($filter);
    if(substr($data['nilai'],0,2) == 'Rp'){
        $jenis = 'rp';
    }else {
        $jenis = 'nl';
    }
    $default = ['title' => 'Judul Tidak Di Set', 'color' => '#3f48cc', 'width' => '12', 'nilai' => 'Tidak Ada Nilai', 'icon' => 'fa-window-close'];
    $temp = ' <div class="card" style="background-color:'.(isset($data['color']) ? $data['color'] : $default['color']) . '" ;> <div class="col"> <div class="dropdown custom-dropdown float-right mr-2 mt-2"> <div data-toggle="dropdown"><i class="fa fa-ellipsis-v text-white"></i> </div> <div class="dropdown-menu dropdown-menu-right">';foreach($filter as $link) { $asu = explode('|',$link); $temp .= '<a onclick="dropdowncard'.$asu[0].$jenis.'()" class="dropdown-item changetype">'.$asu[0].'</a>';} $temp .='</div> </div> </div> <a type="button" data-toggle="modal" data-target="#inimodal'.$u.'"> <div class="card-body"> <h3 class="card-title text-white">' . (isset($data['title']) ? $data['title'] : $default['title']) . '</h3> <div class="d-inline-block"> <h2 class="text-white"><div id="nilai'.$u.'">' . (isset($data['nilai']) ? $data['nilai'] : $default['nilai']) . '</div></h2>'; if (isset($data['detail'])) { $temp .= '<div id="detail'.$u.'"><p class="text-white mb-0">' . $data['detail'] . '</p></div>'; } $temp .= '</div> <span class="float-right display-5 opacity-5"><i class="fa text-white ' . (isset($data['icon']) ? $data['icon'] : $default['icon']) . '"></i></span> </div> </a></div>';

    $cardtofoot = "
    <script>
    var uyyy".$u." = '".$temp."'
    $(document).ready(function() {
        $('#cardcukkks".$u."').html(uyyy".$u.");
    });";

    foreach($filter as $y){
    $asu = explode('|',$y);
    $cardtofoot .= "
    function dropdowncard".$asu[0].$jenis."(){
        $.ajax({
        type: 'POST',
        url: '".base_url()."Ambil/ambilcard/',
        data: { param: '".$y."' },
        cache: false,
        success: function(msg) {
            var ui = JSON.parse(msg)
            $('#nilai".$u."').html(ui.nilai);
            $('#detail".$u."').html(ui.detail);
            $('#isimodal".$u."').html(ui.modal);
        }
    });
}
    ";
    }
        $cardtofoot .= "</script>";
        return $cardtofoot;

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
                <h4>This is ' . $index . ' title</h4> <div class="row">';
            foreach ($val as $content) {
                if (isset($content['color'])) {
                    $temp .= tagchart($content['color'], $content['lable'], $content['id']);
                } else {
                    $temp .= $content;
                }
            }
            $temp .= '</div></div>
        </div>';
        } else {
            $temp .= ' <div class="tab-pane fade" id="' . str_replace(' ', '_', $index) . '">
        <div class="p-t-15">
          <h4>This is ' . $index . ' title</h4><div class="row">';
            foreach ($val as $content) {
                if (isset($content['color'])) {
                    $temp .= tagchart($content['color'], $content['lable'], $content['id']);
                } else {
                    $temp .= $content;
                }
            }
            $temp .= '</div></div>
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

        $tagchart .= '<span class="badge" style="width: 10;background-color: ' . $color[$i] . '">-</span> ' . $lable[$i] . '  ';
    }
    $tagchart .= '<h4 class=" card-title"></h4>
    <div id="' . $id . '"></div>';
    return $tagchart;
}

function headerAtas($title, $size)
{
    return '<div class="col-md-6">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            
                <' . $size . ' class="card-title my-auto">' . $title . '</' . $size . '>
            </div>
        </div>
    </div>
</div>';
}
function chart($element, $type, $data, $options = null, $width = 12)
{
    $u = rand(0,1000);
    $arr = [
        'options' => $options
    ];
    $toString = json_encode($arr, TRUE);
    return '<div class="col-md-' . $width . '">
    <div class="card">
    <div class="card-body">
    <div class="col">
                                        <div class="dropdown custom-dropdown float-right">
                                            <div data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item changetype" id="changeBar'.$u.'" >Bar Chart</a> <a class="dropdown-item changetype"  id="changeLine'.$u.'">Line Chart</a>
                                            </div>
                                        </div>
                                    </div>
    <canvas id="' . $u . '"></canvas>
    </div>
    </div>
    </div>
        <script>
        var asubanget'.$u.' = {"type":"'.$type.'","data":'.json_encode($data,true).',"options":' .json_encode($options,true).'}
        ctx'.$u.' = document.getElementById("' . $u . '").getContext("2d")
        var chartAsu'.$u.'
            chartAsu'.$u.' = new Chart(ctx'.$u.',asubanget'.$u.');  
        $("#changeBar'.$u.'").click(function() {
            chartAsu'.$u.'.destroy();
            asubanget'.$u.'.type = "bar"
            chartAsu'.$u.' = new Chart(ctx'.$u.',asubanget'.$u.');  
          });
        $("#changeLine'.$u.'").click(function() {
            chartAsu'.$u.'.destroy();
            asubanget'.$u.'.type = "line"
            chartAsu'.$u.' = new Chart(ctx'.$u.',asubanget'.$u.');  
          });
        </script>';
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}   
function modal($dat,$key,$name){
    $temp = '<div class="modal fade" id="inimodal'.$key.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail '.$name.'</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> <div id="isimodal'.$key.'">';
        
        $temp .= table_view($dat);
          
        $temp .='</div></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>';
  return $temp;
}