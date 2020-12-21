<?php
class Menu_access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Sub_menu_model');
    }

    /*
     * Listing of menu
     */
    function index()
    {
        $data['menu'] = $this->Menu_model->get_all_menu();

        $data['_view'] = 'admin/menu_access/index';
        $this->load->view('admin/layouts/main', $data);
    }

    function add($menu_id)
    {
        $this->load->model('Sub_menu_model');
        $subMenu = $this->Sub_menu_model->get_all_sub_menu();

        $html = '
                                    <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="' . base_url("menu_access/set/" . $menu_id) . '" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Set Sub Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="subMenu">Sub Menu</label>
                                                            <select class="bootstrap-select form-control" name="subMenu[]" data-live-search="true" multiple required>';
        foreach ($subMenu as $p) {
            $html .= '<option value="' . $p['id'] . '">' . $p['title'] . '</option>';
        }
        $html .= '</select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
        ';

        echo $html;
    }

    function set($menu_id)
    {
        $sB = [];
        for ($i = 0; $i < count($this->input->post('subMenu')); $i++) {
            $subMenu = [
                'menu_id' => $menu_id,
                'sub_menu_id' => $this->input->post('subMenu')[$i]
            ];
            array_push($sB, $subMenu);
        }
        $this->db->insert_batch('menu_access_sub_menu', $sB);
        redirect('menu_access');
    }

    function subDelete($id)
    {
        $this->db->delete('menu_access_sub_menu', array('id' => $id));
        redirect('menu_access');
    }
}
