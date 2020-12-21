<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('Core_system_model');
    // }
    function index()
    {
        $data['html'] = "
        <script type=\"text/javascript\">
        $('a.subMenu').on('click', function() {
            $('#preloader').fadeIn(300);
            var id = $(this).attr(\"id\");
            $.ajax({
                url: '" . base_url() . "admin/' + $(this).attr('id'),
                type: 'POST',
                cache: false,
                success: function(msg) {
                    $('#crud').html(msg);
                    $('#crud').ready(function(){
                        $('.subMenu').removeClass('active');
                        $('#' + id).addClass('active');
                        $('#preloader').fadeOut(300);
                    });
                }
            })
        })
        </script>
        ";
        $data['_view'] = 'admin/dashboard';
        $this->load->view('admin/layouts/main', $data);
    }

    function role_list($page = 'index')
    {
        $this->load->model('Role_model');
        switch ($page) {
            case 'add':
                $this->load->library('form_validation');

                $rules = [
                    [
                        'field' => 'role',
                        'label' =>  'Role',
                        'rules' => [
                            'required',
                            'is_unique[role.role]'
                        ]
                    ]
                ];
                $this->form_validation->set_rules($rules);
                $this->form_validation->set_message('required', '{field} tidak boleh kosong');
                $this->form_validation->set_message('is_unique', '{field} sudah ada');

                if ($this->form_validation->run()) {
                    $params = array(
                        'role' => $this->input->post('role')
                    );
        
                    $this->Role_model->add_role($params);
                    echo json_encode('sukses');
                } else {
                    $data = [
                        'role' => form_error('role')
                    ];
                    echo json_encode($data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user_role'] = $this->Role_model->get_role($id);
                if ($id) {
                    if (isset($data['user_role'])) {
                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('role', 'Role', 'required');
                        $this->load->library('form_validation');
                        if ($this->form_validation->run()) {
                            $params = array(
                                'role' => $this->input->post('role'),
                            );
                            $this->Role_model->update_role($id, $params);
                            redirect('admin/role/index');
                        } else {
                            $data['_view'] = 'role/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $role = $this->Role_model->get_role($id);
                if ($id) {
                    if (isset($role['id'])) {
                        $this->Role_model->delete_role($id);
                        echo json_encode('sukses');
                    }
                } else {
                    echo json_encode('gagal');
                }
                break;
            default:
                $user_roles = $this->Role_model->get_all_role();
                $html = '
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between px-4">
                                    <h4 class="card-title">Data Table</h4>
                                    <a style="color:white" class="btn btn-success" data-toggle="modal" data-backdrop="false" data-target="#modaladd"><i class="mdi mdi-library-plus"></i></a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tabel-data">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                $i = 1;
                foreach ($user_roles as $u) {
                    $html .= '<tr>
                                                    <td>' . $i++ . '</td>
                                                    <td>' . $u["role"] . '</td>
                                                    <td>
                                                        <a style="color:white" id="role_list/edit/' . $u["id"] . '" class="btn btn-info btn-xs btnEdit"><i class="mdi mdi-lead-pencil"></i></a>
                                                        <a style="color:white" id="role_list/delete/' . $u["id"] . '" class="btn btn-danger btn-xs btnDelete"><i class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>';
                }
                $html .= '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $("#tabel-data").DataTable();
                    });
                    $("#addRole").on("click", function() {
                        var data = $("#formAddRole").serialize();
                        $.ajax({
                            url: "'.base_url('admin/role_list/add').'",
                            type: "POST",
                            dataType: "json",
                            data: data,
                            cache: false,
                            success: function(data) {
                                $(data).ready(function(){
                                    if (data !== "sukses") {
                                        $(".role").html(data.role);
                                    } else {
                                        $("#role").val("");
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil...",
                                            text: "Berhasil tambah role..",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                roleList();
                                            }
                                        })
                                    }
                                })
                            }
                        })
                    });
                    $(".btnDelete").on("click", function() {
                        var trnya = $(this).parents("tr");
                        Swal.fire({
                            title: "Yakin ingin menghapus?",
                            showCancelButton: true,
                            confirmButtonText: "Delete",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log($(this).attr("id"));
                                $.ajax({
                                    url: "' . base_url('admin/') . '" + $(this).attr("id"),
                                    type: "POST",
                                    dataType: "json",
                                    cache: false,
                                    success: function(msg) {
                                        if (msg !== "sukses") {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Gagal...",
                                                text: "Gagal hapus role..",
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                }
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Berhasil...",
                                                text: "Berhasil hapus role..",
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    trnya.remove();
                                                }
                                            })
                                        }
                                    }
                                })
                            }
                        })
                    });
                    function roleList(){
                        $("#preloader").fadeIn(1);
                            $.ajax({
                                url: "' . base_url('admin/role_list') . '",
                                type: "POST",
                                cache: false,
                                success: function(msg) {
                                    $("#crud").html(msg);
                                    $("#crud").ready(function(){
                                        $("#preloader").fadeOut(1);
                                        $(".subMenu").removeClass("active");
                                        $("#role_list").addClass("active");
                                    });
                                }
                            })
                        }
                </script>
                                <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Perusahaan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                            <form method="POST" id="formAddRole">
                                                                <div class="form-group">
                                                                    <div class="col-md-12 row">
                                                                        <label for="role">Role</label>
                                                                            <input type="text" name="role" value="'.$this->input->post('role').'" class="form-control" id="role" />
                                                                            <span class="text-danger role">'.form_error("role").'</span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="button" style="color:white" class="btn btn-success pull-right" id="addRole">Save</button>
                                                                </div>
                                                            </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" style="color:white" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                ';
                echo $html;
                break;
        }
    }
}
