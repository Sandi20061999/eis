<?php
class Get extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    function getsubmenu()
    {
        $role = $_POST['b'];
        $menu_id = $_POST['a'];
        $this->load->model('Get_model');
        $submenu = $this->Get_model->get_sub_menu_by_role($role, $menu_id);
        $rst = '<div class="modal fade" id="submenuModal" tabindex="-1" role="dialog" aria-labelledby="submenuModalLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="submenuModalLabel">Daftar Sub Menu</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> </a><a onclick="addsubmenu('.$menu_id.','.$role.')" class="btn btn-success btn-xs mb-1 float-right text-white">Tambah Sub Menu</a> <div class="table-responsive"> <table class="table table-striped table-bordered zero-configuration"> <thead> <tr> <th>Sub Menu</th><th>Action</th> </tr> </thead> <tbody>';
        foreach ($submenu as $sm) {
            $rst .= '<tr>';
            $rst .= '<td> <a href="' . base_url('admin/role_access_sub_menu/delete/') . $sm['id'] . '" class="btn btn-danger btn-xs mb-1 mr-1"><span class="fa fa-trash" title="Hapus Sub Menu"></span></a></a><a onclick="getview('.$sm['sub_menu_id'].')" class="btn btn-primary btn-xs mb-1 mr-1 text-white">' . $sm['title'] . '</a><br></td>';
            $rst .= '<td> </a><a onclick="getview('.$sm['sub_menu_id'].')" class="btn btn-danger btn-xs mb-1 mr-1 text-white">Tambah View</a><br></td>';
            $rst .= '</tr>';
        }
        $rst .= '</tr></tbody></table></div></div></div></div></div>';
        echo $rst;
    }
    function addsubmenu()
    {
        $menu_id = $_POST['a'];
        $role = $_POST['b'];
        $this->load->model('Sub_menu_model');
        $all_sub_menu = $this->Sub_menu_model->get_all_sub_menu_by_menu_id($menu_id);
        $rst = '<div class="modal fade" id="addsubmenuModal" tabindex="-1" role="dialog" aria-labelledby="addsubmenuModalLabel" aria-hidden="true"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="addsubmenuModalLabel">Tambah Sub Menu</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"><div class="form-group"> <div class="col-md-12"> <label for="sub_menu_id" class="control-label">Sub Menu</label> <div class="form-group"> <select name="sub_menu_id" id="select_sub_menu_id" class="form-control">';
        
        foreach ($all_sub_menu as $sm) 
        { $selected = ($sm['id'] == $this->input->post('sub_menu_id')) ? ' selected="selected"' : "";
            $rst .= '<option value="' . $sm['id'] . '" ' . $selected . '>' . $sm['menu'] . ' | ' . $sm['title'] . '</option>'; }
        
        $rst .= '</select></div> </div> </div> <div class="form-group"> <div class="col-sm-offset-4 col-sm-8"> <button type="submit" onclick="btn_addsubmenu('.$role.','.$menu_id.')" id="btn_addsubmenu" class="btn btn-success btn">Save</button> </div> </div></div></div></div></div>';
        echo $rst;
    }
    function getview()
    {
        $idsubmenu = $_POST['a'];
        $this->load->model('Get_model');
        $view = $this->Get_model->get_view($idsubmenu);
        
        $rst = '<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> <div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="viewModalLabel">Daftar View</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> <div class="table-responsive"> <table class="table table-striped table-bordered zero-configuration"> <thead> <tr> <th>Nama View</th> </tr> </thead> <tbody>';
        foreach ($view as $v) {
            if ($v['type'] == 'card') {
                $title = $v['cardTitle'];
                $type = 'Card';
            } elseif ($v['type'] == 'table') {
                $title = $v['tableTitle'];
                $type = 'Tabel';
            } elseif ($v['type'] == 'chart-parent') {
                $title = $v['chartTitle'];
                $type = 'Grafik';
            } elseif ($v['type'] == 'header') {
                $title = $v['headerTitle'];
                $type = 'Header';
            } elseif ($v['type'] == 'accordion-table') {
                $title = $v['accordionTableTitle'];
                $type = 'Accordion Table';
            } else {
                $type = '';
                $title = $v['type'];
            }
            $rst .= '<tr>';
            $rst .= '<td><a href="' . base_url('admin/sub_menu_access_view/delete/') . $v['id'] . '" class="btn btn-danger btn-xs mb-1 mr-1"><span class="fa fa-trash" title="Hapus Sub Menu"></span></a>' .$type.' | '. $title . '<br></td>';
            $rst .= '</tr>';
        }
        $rst .= '</tr></tbody></table></div></div></div></div></div>';
        echo $rst;
    }
}
