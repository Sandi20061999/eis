<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */

class User_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_menu_model');
        $this->load->model('User_access_menu_model');
        $this->load->model('User_sub_menu_model');
        $this->load->model('User_sub_menu_access_view_model');
        $this->load->model('User_access_sub_menu_model');
    }

    /*
     * Listing of user_menu
     */
    function index()
    {
        $data['user_menus'] = $this->User_menu_model->get_all_user_menu();

        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('user_menu/index', $data);
        $this->load->view('layouts/footer');
    }

    /*
     * Adding a new user_menu
     */
    function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run()) {
            $params = array(
                'menu' => $this->input->post('menu'),
            );

            $user_menu_id = $this->User_menu_model->add_user_menu($params);
            redirect('user_menu/index');
        } else {
            $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
            $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('user_menu/add', $data);
            $this->load->view('layouts/footer');
        }
    }

    /*
     * Editing a user_menu
     */
    function edit($id)
    {
        // check if the user_menu exists before trying to edit it
        $data['user_menu'] = $this->User_menu_model->get_user_menu($id);

        if (isset($data['user_menu']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('menu', 'Menu', 'required');

            if ($this->form_validation->run()) {
                $params = array(
                    'menu' => $this->input->post('menu'),
                );

                $this->User_menu_model->update_user_menu($id, $params);
                redirect('user_menu/index');
            } else {
                $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
                $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar', $data);
                $this->load->view('user_menu/edit', $data);
                $this->load->view('layouts/footer');
            }
        } else
            show_error('The user_menu you are trying to edit does not exist.');
    }

    /*
     * Deleting user_menu
     */
    function remove($id)
    {
        $user_menu = $this->User_menu_model->get_user_menu($id);

        // check if the user_menu exists before trying to delete it
        if (isset($user_menu['id'])) {
            $this->User_menu_model->delete_user_menu($id);
            redirect('user_menu/index');
        } else
            show_error('The user_menu you are trying to delete does not exist.');
    }

    function index_sub($menu_id)
    {
        $data['user_sub_menus'] = $this->User_sub_menu_model->get_all_user_sub_menu($menu_id);

        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('user_sub_menu/index', $data);
        $this->load->view('layouts/footer');
    }

    /*
     * Adding a new user_sub_menu
     */
    function add_sub($menu_id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run()) {
            $str = $this->input->post('url');
            $result = hash("sha256", $str);
            $params = array(
                'menu_id' => $menu_id,
                'is_active' => $this->input->post('is_active'),
                'title' => $this->input->post('title'),
                'url' => 'core_system/index/'.$result,
                'icon' => $this->input->post('icon'),
            );

            $user_sub_menu_id = $this->User_sub_menu_model->add_user_sub_menu($params);
            redirect('user_menu/index_sub/' . $menu_id);
        } else {
            $this->load->model('User_menu_model');
            $data['all_user_menu'] = $this->User_menu_model->get_all_user_menu();

            $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
            $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('user_sub_menu/add', $data);
            $this->load->view('layouts/footer');
        }
    }

    /*
     * Editing a user_sub_menu
     */
    function edit_sub($menu_id, $id)
    {
        // check if the user_sub_menu exists before trying to edit it
        $data['user_sub_menu'] = $this->User_sub_menu_model->get_user_sub_menu($id);

        if (isset($data['user_sub_menu']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('url', 'Url', 'required');
            $this->form_validation->set_rules('icon', 'Icon', 'required');
            $this->form_validation->set_rules('is_active', 'Is Active', 'required');

            if ($this->form_validation->run()) {
                $params = array(
                    'is_active' => $this->input->post('is_active'),
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'icon' => $this->input->post('icon'),
                );

                $this->User_sub_menu_model->update_user_sub_menu($id, $params);
                redirect('user_menu/index_sub/' . $menu_id);
            } else {
                $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
                $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar', $data);
                $this->load->view('user_sub_menu/edit', $data);
                $this->load->view('layouts/footer');
            }
        } else
            show_error('The user_sub_menu you are trying to edit does not exist.');
    }

    /*
     * Deleting user_sub_menu
     */
    function remove_sub($menu_id, $id)
    {
        $user_sub_menu = $this->User_sub_menu_model->get_user_sub_menu($id);

        // check if the user_sub_menu exists before trying to delete it
        if (isset($user_sub_menu['id'])) {
            $this->User_sub_menu_model->delete_user_sub_menu($id);
            redirect('user_menu/index_sub/' . $menu_id);
        } else
            show_error('The user_sub_menu you are trying to delete does not exist.');
    }

    function index_access($menu_id, $sub_menu_id)
    {
        $data['user_sub_menu_access_view'] = $this->User_sub_menu_access_view_model->get_all_user_sub_menu_access_view($sub_menu_id);

        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('user_sub_menu_access_view/index', $data);
        $this->load->view('layouts/footer');
    }

    function add_access($menu_id, $sub_menu_id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('view_id', 'View Id', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run()) {
            $params = array(
                'sub_menu_id' => $sub_menu_id,
                'view_id' => $this->input->post('view_id'),
                'is_active' => $this->input->post('is_active'),
            );

            $user_sub_menu_access_view_id = $this->User_sub_menu_access_view_model->add_user_sub_menu_access_view($params);
            redirect('user_menu/index_access/' . $menu_id . '/' . $sub_menu_id);
        } else {
            $this->load->model('User_view_model');
            $data['all_user_view'] = $this->User_view_model->get_all_user_view();

            $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
            $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('user_sub_menu_access_view/add', $data);
            $this->load->view('layouts/footer');
        }
    }

    function edit_access($menu_id, $sub_menu_id, $id)
    {
        // check if the user_sub_menu_access_view exists before trying to edit it
        $data['user_sub_menu_access_view'] = $this->User_sub_menu_access_view_model->get_user_sub_menu_access_view($id);

        if (isset($data['user_sub_menu_access_view']['id'])) {
            $this->load->library('form_validation');

            // $this->form_validation->set_rules('sub_menu_id', 'Sub Menu Id', 'required');
            $this->form_validation->set_rules('view_id', 'View Id', 'required');
            $this->form_validation->set_rules('is_active', 'Is Active', 'required');

            if ($this->form_validation->run()) {
                $params = array(
                    'sub_menu_id' => $this->input->post('sub_menu_id'),
                    'view_id' => $this->input->post('view_id'),
                    'is_active' => $this->input->post('is_active'),
                );

                $this->User_sub_menu_access_view_model->update_user_sub_menu_access_view($id, $params);
                redirect('user_menu/index_access/' . $menu_id . '/' . $sub_menu_id);
            } else {

                $this->load->model('User_view_model');
                $data['all_user_view'] = $this->User_view_model->get_all_user_view();
                $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
                $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar', $data);
                $this->load->view('user_sub_menu_access_view/edit', $data);
                $this->load->view('layouts/footer');
            }
        } else
            show_error('The user_sub_menu_access_view you are trying to edit does not exist.');
    }

    /*
     * Deleting user_sub_menu_access_view
     */
    function remove_access($menu_id, $sub_menu_id, $id)
    {
        $user_sub_menu_access_view = $this->User_sub_menu_access_view_model->get_user_sub_menu_access_view($id);

        // check if the user_sub_menu_access_view exists before trying to delete it
        if (isset($user_sub_menu_access_view['id'])) {
            $this->User_sub_menu_access_view_model->delete_user_sub_menu_access_view($id);
            redirect('user_menu/index_access/' . $menu_id . '/' . $sub_menu_id);
        } else
            show_error('The user_sub_menu_access_view you are trying to delete does not exist.');
    }
}
