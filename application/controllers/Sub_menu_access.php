<?php

class Sub_menu_access extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sub_menu_model');
        $this->load->model('Menu_model');
    }

    /*
     * Listing of sub_menu
     */
    function index()
    {
        $data['sub_menu'] = $this->Sub_menu_model->get_all_sub_menu();
        $data['_view'] = 'admin/sub_menu_access/index';
        $this->load->view('admin/layouts/main', $data);
    }


    function add($sub_menu_id)
    {
        $this->load->model('View_model');
        $subMenu = $this->View_model->get_all_view();

        $html = '
                                    <div class="modal fade" id="addNewModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="' . base_url("sub_menu_access/set/" . $sub_menu_id) . '" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Set Sub Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="subMenu">View</label>
                                                            <select class="bootstrap-select form-control" name="view[]" data-live-search="true" multiple required>';
        foreach ($subMenu as $p) {
            $json = json_decode($p['jsonFile'], TRUE);
            $html .= '<option value="' . $p['id'] . '">' . $json['name'] . '</option>';
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

    function set($sub_menu_id)
    {
        $sB = [];
        $row = $this->db->select("*")->limit(1)->order_by('id', "DESC")->get_where("sub_menu_access_view", array('sub_menu_id' => $sub_menu_id))->row_array();
        for ($i = 0; $i < count($this->input->post('view')); $i++) {
            $subMenu = [
                'sub_menu_id' => $sub_menu_id,
                'view_id' => $this->input->post('view')[$i],
                'is_active' => '1',
                'by' => $row['by'] + 1 + $i
            ];
            array_push($sB, $subMenu);
        }
        $this->db->insert_batch('sub_menu_access_view', $sB);
        redirect('sub_menu_access');
    }
    function subDelete($id)
    {
        $this->db->delete('sub_menu_access_view', array('id' => $id));
        redirect('sub_menu_access');
    }
}
