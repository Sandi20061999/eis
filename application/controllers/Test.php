<?php

class Test extends CI_Controller
{
    public function helper_table()
    {
        $data['menu'] = $this->db->join('menu', 'menu.id=role_access_menu.menu_id')->order_by('role_access_menu.id', 'ASC')->get_where('role_access_menu', array('role_id' => $this->session->userdata('role_id')))->result_array();
        $data['subMenu'] = $this->db->join('menu_access_sub_menu', 'menu_access_sub_menu.sub_menu_id=role_access_sub_menu.sub_menu_id')->join('sub_menu', 'sub_menu.id=role_access_sub_menu.sub_menu_id')->order_by('sub_menu.by', 'ASC')->get_where('role_access_sub_menu', array('role_id' => 1))->result_array();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);

        $dataku['test'] = table('user', 'id', 'id|email|password', '', '3');
        $this->load->view('sections/test', $dataku);
        $this->load->view('layouts/footer');
    }
}
