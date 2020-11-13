<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class Sub_menu_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get sub_menu by id
     */
    function get_sub_menu($id)
    {
        return $this->db->get_where('sub_menu', array('id' => $id))->row_array();
    }

    /*
     * Get all sub_menu
     */
    // function get_all_sub_menu($menu_id)
    // {
    //     return $this->db->get_where('sub_menu', array('menu_id' => $menu_id))->result_array();
    // }
    function get_all_sub_menu()
    {
        $this->db->select('*,sub_menu.id as id');
        $this->db->join('menu', 'menu.id = sub_menu.menu_id');
        return $this->db->get('sub_menu')->result_array();
    }
    function get_all_sub_menu_by_menu_id($id)
    {
        $this->db->select('*,sub_menu.id as id');
        $this->db->join('menu', 'menu.id = sub_menu.menu_id');
        $this->db->where('menu.id',$id );
        return $this->db->get('sub_menu')->result_array();
    }
    function get_all_sub_menu_role($id)
    {
        $this->db->select('*,sub_menu.id as id');
        $this->db->join('menu', 'menu.id = sub_menu.menu_id');
        return $this->db->get('sub_menu')->result_array();
    }

    function get_all_sub_menu_senior()
    {
        return $this->db->get('sub_menu')->result_array();
    }

    /*
     * function to add new sub_menu
     */
    function add_sub_menu($params)
    {
        $this->db->insert('sub_menu', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update sub_menu
     */
    function update_sub_menu($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('sub_menu', $params);
    }

    /*
     * function to delete sub_menu
     */
    function delete_sub_menu($id)
    {
        return $this->db->delete('sub_menu', array('id' => $id));
    }
}
