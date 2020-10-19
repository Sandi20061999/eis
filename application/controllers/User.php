<?php

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('User_access_menu_model');
        $this->load->model('User_access_sub_menu_model');
    }

    /*
     * Listing of user
     */
    function index()
    {
        $user['users'] = $this->User_model->get_all_user();
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('user/index', $user);
        $this->load->view('layouts/footer');
    }

    /*
     * Adding a new user
     */
    function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        // $this->form_validation->set_rules('image', 'Image', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run()) {
            $params = array(
                'role_id' => $this->input->post('role_id'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => 'default.png',
                'is_active' => $this->input->post('is_active'),
            );

            $user_id = $this->User_model->add_user($params);
            redirect('user/index');
        } else {
            $this->load->model('User_role_model');
            $role['all_user_roles'] = $this->User_role_model->get_all_user_role();
            $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
            $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('user/add', $role);
            $this->load->view('layouts/footer');
        }
    }

    /*
     * Editing a user
     */
    function edit($id)
    {
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);

        if (isset($data['user']['id'])) {
            $this->load->library('form_validation');

            // $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            // $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
            // $this->form_validation->set_rules('image', 'Image', 'required');
            $this->form_validation->set_rules('is_active', 'Is Active', 'required');

            if ($this->form_validation->run()) {
                if ($this->input->post('password') == null) {
                    $pass = $data['user']['password'];
                } else {
                    $pass = $this->input->post('password');
                }

                if ($this->input->post('email') == $data['user']['email']) {
                    $email = $data['user']['email'];
                } else {
                    $cek = $this->db->select('email')
                        ->get_where('user', ['email' => $this->input->post('email')])->row_array();
                    if (isset($cek['email'])) {
                        show_error('Email must be unique.');
                    } else {
                        $email = $this->input->post('email');
                    }
                }
                $params = array(
                    'role_id' => $this->input->post('role_id'),
                    'password' => $pass,
                    'name' => $this->input->post('name'),
                    'email' => $email,
                    'image' => "default.png", //$this->input->post('image')
                    'is_active' => $this->input->post('is_active'),
                );

                $this->User_model->update_user($id, $params);
                redirect('user/index');
            } else {
                $this->load->model('User_role_model');
                $data['all_user_roles'] = $this->User_role_model->get_all_user_role();
                $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
                $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar', $data);
                $this->load->view('user/edit', $data);
                $this->load->view('layouts/footer');
            }
        } else
            show_error('The user you are trying to edit does not exist.');
    }

    /*
     * Deleting user
     */
    function remove($id)
    {
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if (isset($user['id'])) {
            $this->User_model->delete_user($id);
            redirect('user/index');
        } else
            show_error('The user you are trying to delete does not exist.');
    }
}
