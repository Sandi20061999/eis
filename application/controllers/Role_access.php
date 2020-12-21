<?php

class Role_access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model');
    }

    /*
     * Listing of role
     */
    function index()
    {
        $data['role'] = $this->Role_model->get_all_role();

        $data['_view'] = 'admin/role_access/index';
        $this->load->view('admin/layouts/main', $data);
    }

    function add($role_id)
    {
        $this->load->model('Menu_model');
        $this->load->model('Sub_menu_model');
        $menu = $this->Menu_model->get_all_menu();
        $subMenu = $this->Sub_menu_model->get_all_sub_menu();

        $role = $this->Role_model->get_role($role_id);
        $html = '
                                    <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="' . base_url("role_access/set/" . $role_id) . '" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Set Penagih</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            
                                                            <label for="menu">Menu</label>
                                                            <select class="form-control" name="menu" id="menuKu" required>';
        foreach ($menu as $m) {
            $html .= '<option value="' . $m['id'] . '">' . $m['menu'] . '</option>';
        }
        $html .= '</select>
                                                        </div>
                                                        <div id="sub"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    $(document).ready(function(){
                                        $("#menuKu").change(function() {
                                            $.ajax({
                                                url: "' . base_url() . '" + "role_access/subMenu/" + $(this).val(),
                                                type: "POST",
                                                cache: false,
                                                success: function(data) {
                                                    $("#sub").html(data);
                                                    $(".bootstrap-select").selectpicker();
                                                }
                                            })
                                        })
                                    });
                                    </script>
                                    
        ';

        echo $html;
    }

    function subMenu($menu_id)
    {
        $subMenu = $this->db->select('menu_access_sub_menu.id AS id,title')->join('sub_menu', 'sub_menu.id=menu_access_sub_menu.sub_menu_id')->get_where('menu_access_sub_menu', array('menu_id' => $menu_id))->result_array();
        $html = '
        <div class="form-group">
            <label for="subMenu">Sub Menu</label>
            <select class="bootstrap-select form-control" name="subMenu[]" data-live-search="true" multiple>
           ';
        foreach ($subMenu as $p) {
            $html .= '<option value="' . $p['id'] . '">' . $p['title'] . '</option>';
        }
        $html .= ' </select>
        </div>';
        echo $html;
    }

    function set($role_id)
    {
        $sB = [];
        for ($i = 0; $i < count($this->input->post('subMenu')); $i++) {
            $cek = $this->db->get_where('role_access_menu_sub_menu', array('role_id' => $role_id, 'menu_access_sub_menu_id' => $this->input->post('subMenu')[$i]))->row_array();
            if ($cek == null) {
                $subMenu = [
                    'role_id' => $role_id,
                    'menu_access_sub_menu_id' => $this->input->post('subMenu')[$i]
                ];
                array_push($sB, $subMenu);
            }
        }
        if ($sB != null) {
            $this->db->insert_batch('role_access_menu_sub_menu', $sB);
        }
        redirect('role_access');
    }


    function subDelete($role_id, $menu_access_sub_menu_id)
    {
        $this->db->delete('role_access_menu_sub_menu', array('role_id' => $role_id, 'menu_access_sub_menu_id' => $menu_access_sub_menu_id));
        redirect('role_access');
    }
}
