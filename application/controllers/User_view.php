<?php

class User_view extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_view_model');
        $this->load->model('User_access_menu_model');
        $this->load->model('User_access_sub_menu_model');
    }

    /*
     * Listing of user_view
     */
    function index()
    {
        $data['user_view'] = $this->User_view_model->get_all_user_view();

        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('user_view/index', $data);
        $this->load->view('layouts/footer');
    }

    function getApi()
    {
        $data = $this->db->select('id,name')->get('user_api')->result_array();
        foreach ($data as $d) {
            echo "<option value='" . $d['id'] . "'>" . $d['name'] . "</option>";
        }
    }
    function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('view', 'View', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');

        if ($this->form_validation->run()) {
            $params = array(
                'type' => $this->input->post('type'),
                'view' => $this->input->post('view'),
                'view_name' => $this->input->post('view_name'),
                'select' => $this->input->post('select'),
                'where' => $this->input->post('where'),
                'limit' => $this->input->post('limit'),
                'tableHeader' => $this->input->post('tableHeader'),
                'tableTitle' => $this->input->post('tableTitle'),
                'accordionTableTitle' => $this->input->post('accordionTableTitle'),
                'accordionTablePer' => $this->input->post('accordionTablePer'),
                'headerTitle' => $this->input->post('headerTitle'),
                'sizeText' => $this->input->post('sizeText'),
                'chartXkey' => $this->input->post('chartXkey'),
                'chartYkey' => $this->input->post('chartYkey'),
                'chartColor' => $this->input->post('chartColor'),
                'cardTitle' => $this->input->post('cardTitle'),
                'cardWidth' => $this->input->post('cardWidth'),
                'cardValue' => $this->input->post('cardValue'),
                'cardDetail' => $this->input->post('cardDetail'),
                'cardColor' => $this->input->post('cardColor'),
                'cardIcon' => $this->input->post('cardIcon'),
                'tabData' => $this->input->post('tabData'),
            );

            $user_view_id = $this->User_view_model->add_user_view($params);
            redirect('user_view/index');
        } else {
            $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
            $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('user_view/add', $data);
            $this->load->view('layouts/footer');
        }
    }

    /*
     * Editing a user_view
     */
    function edit($id)
    {
        // check if the user_view exists before trying to edit it
        $data['user_view'] = $this->User_view_model->get_user_view($id);

        if (isset($data['user_view']['id'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('view', 'View', 'required');
            $this->form_validation->set_rules('type', 'Type', 'required');

            if ($this->form_validation->run()) {
                $params = array(
                    'type' => $this->input->post('type'),
                    'view' => $this->input->post('view'),
                    'view_name' => $this->input->post('view_name'),
                    'select' => $this->input->post('select'),
                    'where' => $this->input->post('where'),
                    'limit' => $this->input->post('limit'),
                    'order_by' => $this->input->post('order_by'),
                );

                $this->User_view_model->update_user_view($id, $params);
                redirect('user_view/index');
            } else {
                $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
                $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar', $data);
                $this->load->view('user_view/edit', $data);
                $this->load->view('layouts/footer');
            }
        } else
            show_error('The user_view you are trying to edit does not exist.');
    }

    /*
     * Deleting user_view
     */
    function remove($id)
    {
        $user_view = $this->User_view_model->get_user_view($id);

        // check if the user_view exists before trying to delete it
        if (isset($user_view['id'])) {
            $this->User_view_model->delete_user_view($id);
            redirect('user_view/index');
        } else
            show_error('The user_view you are trying to delete does not exist.');
    }
}
