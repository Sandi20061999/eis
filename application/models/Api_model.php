<?php

class Api_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getApi($url)
    {
        return $this->db->join('user_sub_menu', 'user_sub_menu.id=user_sub_menu_access_view.sub_menu_id')
            ->join('user_view', 'user_view.id=user_sub_menu_access_view.view_id')
            ->get_where('user_sub_menu_access_view', array('url' => $url))->result_array();
    }
}
