<?php

class User_access_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_access_menu_model');
        $this->load->model('User_access_sub_menu_model');
    }

    /*
     * Listing of user_access_sub_menu
     */
    function index($user_id)
    {
        $data['user_access_menu'] = $this->User_access_menu_model->get_all_user_access_menu($user_id);

        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('user_access_menu/index', $data);
        $this->load->view('layouts/footer');
    }

    /*
     * Adding a new user_access_sub_menu
     */
    function add($user_id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');

        if ($this->form_validation->run()) {
            $params = array(
                'user_id' => $user_id,
                'menu_id' => $this->input->post('menu_id'),
            );

            $user_access_menu_id = $this->User_access_menu_model->add_user_access_menu($params);
            redirect('user_access_menu/index/' . $user_id);
        } else {

            $this->load->model('User_menu_model');
            $data['all_user_menu'] = $this->User_menu_model->get_all_user_menu();

            $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
            $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('user_access_menu/add', $data);
            $this->load->view('layouts/footer');
        }
    }

    /*
     * Editing a user_access_menu
     */
    function edit($user_id, $id)
    {
        // check if the user_access_menu exists before trying to edit it
        $data['user_access_menu'] = $this->User_access_menu_model->get_user_access_menu($id);

        if (isset($data['user_access_menu']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');

            if ($this->form_validation->run()) {
                $params = array(
                    'user_id' => $user_id,
                    'menu_id' => $this->input->post('menu_id'),
                );

                $this->User_access_menu_model->update_user_access_menu($id, $params);
                redirect('user_access_menu/index/' . $user_id);
            } else {
                $this->load->model('User_menu_model');
                $data['all_user_menu'] = $this->User_menu_model->get_all_user_menu();

                $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
                $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar', $data);
                $this->load->view('user_access_menu/edit', $data);
                $this->load->view('layouts/footer');
            }
        } else
            show_error('The user_access_menu you are trying to edit does not exist.');
    }

    /*
     * Deleting user_access_menu
     */
    function remove($user_id, $id)
    {
        $user_access_menu = $this->User_access_menu_model->get_user_access_menu($id);

        // check if the user_access_menu exists before trying to delete it
        if (isset($user_access_menu['id'])) {
            $this->User_access_menu_model->delete_user_access_menu($id);
            redirect('user_access_menu/index/' . $user_id);
        } else
            show_error('The user_access_menu you are trying to delete does not exist.');
    }
}
