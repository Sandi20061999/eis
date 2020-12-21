<?php
// kolom = kolom1|kolom2|kolom3
// where = key=>where1|key=>where2|key=>where3
function table($head = [], $data, $width = 12, $class = 'zero-configuration')
{
  $html = '
  <div class="col-md-' . $width . '">
        <div class="card">
            <div class="card-body scrollku">
                <div class="table-responsive px-0">
                    <table class="table table-sm table-striped table-bordered ' . $class . '">
                        <thead>
                            <tr>';
  foreach ($head as $h) {
    if ($h != 'ct') {

      $html .= "<th>" . field_as($h) . "</th>";
    }
  }
  $html .= '</tr>
                        </thead>
                        <tbody>';
  foreach ($data as $d) {
    $html .= "<tr>";
    foreach ($head as $h) {
      if ($h != 'ct') {
        $html .= "<td>" . $d[$h] . "</td>";
      }
    }
    $html .= "</tr>";
  }
  $html .= '</tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>';
  return $html;
}

function card($data = [], $u, $select = [])
{

  $rand = rand(0, 1000000000);
  $default = ['title' => 'Judul Tidak Di Set', 'color' => '#3f48cc', 'width' => '12', 'nilai' => 'Tidak Ada Nilai', 'icon' => 'fa-window-close', 'arr' => 'kosong'];
  $temp = '
  <div class="col-md-' . (isset($data['width']) ? $data['width'] : $default['width']) . '">
  <div class="card shadow" style="background-color:' . (isset($data['color']) ? $data['color'] : $default['color']) . '"> 
    <div class="col"> 
      <div class="float-left ml-2 mt-2 mb-2">
        <a id="' . $u . '|' . $data['default'] . '|' . $rand . '|' . (isset($data['arr']) ? $data['arr'] : $default['arr']) . '" class="updateData"><i class="fa fa-refresh text-white"></i><span class="sr-only">Loading...</span></a> 
      </div>';
  if ($data['type'] == 'row') {
    $temp .= '<div class="float-left ml-2 mt-2 mb-2">
          <a id="' . $u . '|' . $data['default'] . '|' . $rand . '|' . (isset($data['arr']) ? $data['arr'] : $default['arr']) . '" href="' . base_url('export_to_excel/index/' . base64_encode($u . '|' . $data['default'] . '|' . $rand . '|' . (isset($data['arr']) ? $data['arr'] : $default['arr']))) . '" class="downloadData' . $rand . ' dD' . $u . $rand . '"><i class="fa fa-download text-white"></i></a> 
          </div>';
  }
  $temp .= '<div class="dropdown custom-dropdown float-right mr-2 mt-2 mb-2"> 
        <div data-toggle="dropdown">
          <i class="fa fa-ellipsis-v text-white"></i> 
        </div>
        <div class="dropdown-menu dropdown-menu-right" style="height:150px; overflow:auto">';
  foreach ($select as $link) {
    $temp .= '<a id="' . $u . '|' . $link . '|' . $rand . '|' . (isset($data['arr']) ? $data['arr'] : $default['arr']) . '" class="dropdown-item changetype' . $rand . '">' . $link . '</a>';
  }
  $temp .= '</div> 
      </div> 
    </div>
    <a type="button" class="modalTable' . $rand . ' tabku' . $u . $rand . '" id="' . $u . '|' . $data['default'] . '|' . $rand . '|' . (isset($data['arr']) ? $data['arr'] : $default['arr']) . '"> 
    <div class="card-body">
      <h3 class="card-title text-white">' . (isset($data['title']) ? $data['title'] : $default['title']) . '</h3> 
      <div class="d-inline-block"> 
        <h2 class="text-white"><div id="nilai' . $u . $rand . '">' . (isset($data['nilai']) ? $data['nilai'] : $default['nilai']) . '</h2>
      </div>
      <span class="float-right display-5 opacity-5">
        <i class="fa text-white ' . (isset($data['icon']) ? $data['icon'] : $default['icon']) . '"></i>
      </span> 
      <div id="detail' . $u . $rand . '">
        <p class="text-white mb-0">' . $data['detail'] . '</p>
      </div>
    </div>
    
    </a>
  </div>
  </div>
  <script type="text/javascript">
    var baseUrl = "' . base_url() . '";
    $("a.changetype' . $rand . '").on("click", function() {
        var data = $(this).attr("id");
        console.log(data);
        $.ajax({
            url: baseUrl + "core_system/updateCard/",
            type: "POST",
            dataType: "json",
            data : {dat : data },
            cache: false,
            success: function(msg) {
                console.log(msg);
                var datageh = JSON.parse(JSON.stringify(msg))
                $("#nilai' . $u . $rand . '").html(datageh.nilai);
                $("#detail' . $u . $rand . '").html(datageh.detail);
                $(".tabku' . $u . $rand . '").attr("id", datageh.forTable);
                $(".dD' . $u . $rand . '").attr("href", datageh.forTable2);
            }
        })
    });
    $("a.downloadData' . $rand . '").on("click", function() {
      var data = $(this).attr("id");
      console.log(data);
      $.ajax({
          url: baseUrl + "export_to_excel",
          type: "POST",
          data : {dat : data },
          cache: false,
          success: function(msg) {
              console.log("berhasil");
          }
      })
    });
    $("a.updateData").on("click", function() {
      var data = $(this).attr("id");
      $(".updateData>i").addClass("fa-spin");
      $.ajax({
          url: baseUrl + "core_system/updateCard/reload",
          type: "POST",
          dataType: "json",
          data : {dat : data },
          cache: false,
          success: function(msg) {
            console.log(msg);
            $(msg).ready(function() {
              $(".updateData>i").removeClass("fa-spin");
              var datageh = JSON.parse(JSON.stringify(msg))
              $("#nilai' . $u . $rand . '").html(datageh.nilai);
              $("#detail' . $u . $rand . '").html(datageh.detail);
              $(".modalTable").attr("id", datageh.forTable);
            });
          }
      })
    });
    $("a.modalTable' . $rand . '").on("click", function() {
      var datae = $(this).attr("id");
      console.log(datae);
      $.ajax({
          url: baseUrl + "core_system/modalCard/",
          type: "POST",
          data : {dat : datae },
          cache: false,
          success: function(msg) {
            $("#isi").html(msg);
            $("#modal" + md5(datae)).modal("show");
            $(document).ready(function() {
              $(".zero-configuration").DataTable();
            });
          }
      })
    });
</script>
  ';
  return $temp;
}

function modal($dat, $key, $name)
{
  $temp = '<div class="modal modalawal fade" id=\'modal' . md5($key) . '\' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail ' . $name . '</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> <div id="isimodal' . $key . '">';

  $temp .= $dat;

  $temp .= '</div></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>';
  return $temp;
}
// $u = id view
// $list = array where tambahan
// $per = default where yang bisa dirubah
function accordion($name, $u, $list = [], $per)
{
  $rand = rand(0, 100);
  $html = '
  <div class="">
    <div class="card col-12 shadow">
      <div class="card-body">
      <h4>' . $name . '</h4>
        <div id="accordion" class="scrollku">';
  foreach ($list as $l) {
    $html .= '
            <div class="" id="heading' . $u . $l . $rand . '">
              <h5 class="mb-0">
                <button class="btn btn-link accordionku" id="' . $u . '|' . $l . '|' . $rand . '" data-toggle="collapse" data-target="#collapse' . md5($u . $l . $rand) . '" aria-expanded="true" aria-controls="collapse' . md5($u . $l . $rand) . '">
                  ' . $per . ' ' . $l . '
                </button>
              </h5>
            </div>
            <div id="collapse' . md5($u . $l . $rand) . '" class="collapse" aria-labelledby="heading' . $u . $l . $rand . '" data-parent="#accordion">     
                <div id="dataAccordion' . md5($u . '|' . $l . '|' . $rand) . '"></div>
            </div>
         ';
  }
  $html .= '</div>
      </div>
    </div>
  </div>
  <script>
  $(".accordionku").on("click", function() {
    var datae = $(this).attr("id");
    // $(".collapse").removeClass("show");
    // $("#collapse"+ md5(datae)).addClass("active");
    $.ajax({
        url: baseUrl + "core_system/getDataAccordion/",
        type: "POST",
        data : {dat : datae },
        cache: false,
        success: function(msg) {
          // console.log(msg);
          $("msg").ready(function() {
            $("#dataAccordion"+ md5(datae)).html(msg);
            $(document).ready(function() {
              $(".zero-configuration").DataTable();
            });
          });
        }
    })
  })
</script>
  ';
  return $html;
}

function chart($u, $data, $options, $type, $width)
{
  $html = '<div class="col-md-' . $width . '">
            <div class="card shadow">
              <div class="card-body">
                <div class="col">
                  <div class="float-left ml-2 mt-2 mb-2">
                  <button data-toggle="tooltip" data-placement="top" title="Allow Zoom" class="btn btn-primary btn-sm" id="unlock' . $u . '"><i style="color:white" class="fa fa-unlock"></i></button>
                  <button data-toggle="tooltip" data-placement="top" title="Lock Zoom" class="btn btn-primary btn-sm" id="lock' . $u . '"><i style="color:white" class="fa fa-lock"></i></button>  
                  </div>
                  <div class="dropdown custom-dropdown float-right">
                    <div data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item changetype" id="changeBar' . $u . '" >Bar Chart</a>
                     <a class="dropdown-item changetype"  id="changeLine' . $u . '">Line Chart</a>
                     </div>
                  </div>
                </div>
                <canvas id="' . $u . '"></canvas>
              </div>
            </div>
          </div>
        <script>
        var asubanget' . $u . ' = {"type":"' . $type . '","data":' . json_encode($data, true) . ',"options":' . json_encode($options, true) . '}
        ctx' . $u . ' = document.getElementById("' . $u . '").getContext("2d")
        var chartAsu' . $u . ' = new Chart(ctx' . $u . ',asubanget' . $u . ');  
        $("#changeBar' . $u . '").click(function() {
            chartAsu' . $u . '.destroy();
            asubanget' . $u . '.type = "bar"
            chartAsu' . $u . ' = new Chart(ctx' . $u . ',asubanget' . $u . ');  
          });
        $("#changeLine' . $u . '").click(function() {
            chartAsu' . $u . '.destroy();
            asubanget' . $u . '.type = "line"
            chartAsu' . $u . ' = new Chart(ctx' . $u . ',asubanget' . $u . ');  
          });
          $("#unlock' . $u . '").click(function() {
            chartAsu' . $u . '.destroy();
            asubanget' . $u . '.options.zoom.enabled = true;
            chartAsu' . $u . ' = new Chart(ctx' . $u . ',asubanget' . $u . ');  
          });
          $("#lock' . $u . '").click(function() {
            chartAsu' . $u . '.destroy();
            asubanget' . $u . '.options.zoom.enabled = false;
            chartAsu' . $u . ' = new Chart(ctx' . $u . ',asubanget' . $u . ');  
          });
          $("#reset' . $u . '").click(function() {
            chartAsu' . $u . '.destroy();
            chartAsu' . $u . ' = new Chart(ctx' . $u . ',asubanget' . $u . ');  
          });
        </script>';
  return $html;
}

function tableWithDetail($head, $data, $id, $selector, $width = 12)
{
  $html = '
  <div class="col-md-' . $width . '">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive px-0">
                    <table class="table table-sm table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                            <th>Detail/Download</th>
                            ';
  foreach ($head as $h) {
    if ($h != 'ct') {

      $html .= "<th>" . field_as($h) . "</th>";
    }
  }
  $html .= '</tr>
                        </thead>
                        <tbody>';
  foreach ($data as $d) {
    $html .= "<tr>
                <td>
                  <a id=\"" . $id . '|' . $d[$selector] . "\" class=\"btn btn-info btn-sm mb-1 btnDetail\" style=\"color:white\">Detail</a>
                  <a href=\"" . base_url('export_to_excel/detail/' . base64_encode($id . '|' . $d[$selector])) . "\" class=\"btn btn-info btn-sm\" style=\"color:white\">Download</a>
                </td>";
    foreach ($head as $h) {
      if ($h != 'ct') {
        $html .= "<td>" . $d[$h] . "</td>";
      }
    }
    $html .= "</tr>";
  }
  $html .= '</tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      
      <script>
      var baseUrl = "' . base_url() . '";
      $("a.btnDetail").on("click", function() {
        var datae = $(this).attr("id");
        $.ajax({
          url: baseUrl + "core_system/modalCardDetail/",
          type: "POST",
          data : {dat : datae },
          cache: false,
          success: function(msg) {
            $("#isi2").html(msg);
            $("#modal" + md5(datae)).modal("show");
              $(document).ready(function() {
                $(".zero-configuration").DataTable();
              });
            }
        })
      });
  </script>';
  return $html;
}


function modalDetail($dat, $key, $name)
{
  $temp = '<div class="modal modaldua fade" id=\'modal' . md5($key) . '\' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail ' . $name . '</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> <div id="isimodal' . $key . '">';

  $temp .= $dat;

  $temp .= '</div></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>';
  return $temp;
}

function scrollCard($isi = [])
{
  $html = '
  <style>
    .flex {
      display: flex;
      flex-wrap: nowrap; 
      overflow: auto;
    }
  </style>
  <div class="col-12 mt-3 mb-3">
  <div class="flex">';
  foreach ($isi as $i) {
    $html .= $i;
  }
  $html .= '</div>
  </div>';
  return $html;
}

function profil($isi = [])
{
  $user = $isi;
  $CI = &get_instance();
  return '
  <div class="row page-titles">
                    <div class="col p-md-0">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="javascript:void(0)" style="color: #324cdd;">Profile</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Profile</a></li>
                        </ol>
                    </div>
                </div>
  <div class="col-xl-12 order-xl-6">
      <div class="card card-profile">
          <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2 mt-2">
                  <div class="card-profile-image text-center mt-2" style="">
                      <a href="#">
                          <img src="' . base_url("assets/img/profil/" . $CI->session->userdata('image')) . '" class="rounded-circle bg-white" width="150" height="150">
                      </a>
                  </div>
              </div>
          </div>
          <div class="card-body pt-3">
              <div class="text-center "> ' . $CI->session->flashdata("message") . '
              <h5 class="h3">
                      ' . $user["name"] . '
              </h5>
              <h6>' . $user["role"] . '</h6>
                  <div class="h5 font-weight-300">
                      <i class="ni ni-email-83 mr-2"></i>' . $user["email"] . '</div>
              </div>
              <hr>
              <div class="">
              <p class="ml-1 rounded ">Action Button</p>
              </div>
              <div class="d-flex mt-2">
                  <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#exampleModal1">
                      Edit Akun
                  </button>
                  <button type="button" class="btn btn-success m-1 text-white" data-toggle="modal" data-target="#exampleModal3">
                      Ganti foto
                  </button>
                  <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#exampleModal2">
                      Ubah Password
                  </button>
              </div>
          </div>
      </div>
  </div><!-- Modal1 -->
  <div class="modal fade" data-backdrop="false" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info ">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <form id="bprofil">
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user-o"></i></span>
                        </div>
                        <input class="form-control" placeholder="Name" type="text" name="name" value="' . ($CI->input->post("name") ? $CI->input->post("name") : $user["name"]) . '">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input class="form-control" placeholder="Email" type="email" name="email" value="' . ($CI->input->post("email") ? $CI->input->post("email") : $user["email"]) . '">
                        
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                
                <button type="button" onclick="updateProfil(1)" name="bprofil" class="btn btn-primary">Save changes</button>
                </form></div>
        </div>
    </div>
  </div>
  <!-- Modal2 -->
  <div class="modal fade" data-backdrop="false" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger ">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="bpassword">
            <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input class="form-control" placeholder="New Password" type="password" name="newpass" id="newpass" minlength="6">
                        <span class="text-danger">' . form_error("newpass") . '</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirmpass" id="confirmpass" minlength="6">
                        <span class="text-danger">' . form_error("confirmpass") . '</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" id="btncpass" onclick="updatePassword()" class="btn btn-primary">Save changes</button>
            </div>
           </form></div>
    </div>
  </div>
  <!-- Modal3 -->
  <div class="modal fade" data-backdrop="false" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success ">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ganti Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="bfoto">
            <div class="input-group">
                    <div class=" custom-file">
                        <input type="file" name="photo" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="image/*" required>
                        <label class="custom-file-label" for="inputGroupFile04">Ganti Foto</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" onclick="updateFoto()" class="btn btn-primary">Save changes</button>
            </div>
            </form></div>
    </div>
  </div>
  <script>

    function updateProfil() {
      $("#preloader").fadeIn(300);
        $.ajax({
            url: "' . base_url() . 'core_system/profil/1",
            type: "post",
            data: $("#bprofil").serialize(),
            success: function(msg) {
              $("#exampleModal1").modal("hide");
              profil()
              $("#preloader").fadeOut(100);
            },
        });
    }

    function updateFoto() {
        $("#preloader").fadeIn(300);
        var form = $("#bfoto")[0];
        var data = new FormData(form)
        $.ajax({
            url: "' . base_url() . 'core_system/profil/2",
            type: "post",
            enctype: "multipart/form-data",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(msg) {
              console.log(msg)
              profil()
              $("#exampleModal3").modal("hide");
              $("#preloader").fadeOut(100);
              $("#fotoProfil").attr("src","'.base_url().'assets/img/profil/"+msg);
            },
        });
    }

    function updatePassword() {
        $("#preloader").fadeIn(300);
        var password = $("#newpass").val();
        var confirmPassword = $("#confirmpass").val();
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        } else {
            $.ajax({
                url: "' . base_url() . 'core_system/profil/3",
                type: "post",
                data: $("#bpassword").serialize(),
                success: function(msg) {
                  console.log(msg)
                  profil()
                $("#exampleModal2").modal("hide");
                  $("#preloader").fadeOut(100);
                },
            });
        }
    }
</script>
  ';
}
