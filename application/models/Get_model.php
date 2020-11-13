<?php

class Get_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_sub_menu_by_role($role,$menu_id)
    {
        $this->db->join('sub_menu', 'sub_menu.id = role_access_sub_menu.sub_menu_id');
        $this->db->join('menu', 'menu.id = sub_menu.menu_id');
        $this->db->where('role_access_sub_menu.role_id', $role);
        $this->db->where('menu.id', $menu_id);
        return $this->db->get('role_access_sub_menu')->result_array();
    }
    function get_view($idsubmenu)
    {
        $this->db->join('view', 'view.id = sub_menu_access_view.view_id');
        $this->db->where('sub_menu_access_view.sub_menu_id', $idsubmenu);
        return $this->db->get('sub_menu_access_view')->result_array();
    }
}
