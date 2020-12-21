<?php

class Core_system_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getView($uid)
    {
        return $this->db
            ->join('sub_menu', 'sub_menu.id=sub_menu_access_view.sub_menu_id')
            ->join('view', 'view.id=sub_menu_access_view.view_id')
            // ->join('api', 'api.id=view.api_id', 'left')
            ->order_by('sub_menu_access_view.by', 'ASC')
            ->get_where('sub_menu_access_view', array('sub_menu.url' => $uid, 'sub_menu_access_view.is_active' => 1))->result_array();
    }
}
