<?php
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('View_model');
        $this->load->model('User_model');
        $this->load->model('Menu_model');
        $this->load->model('Role_model');
        $this->load->model('Sub_menu_model');
        $this->load->model('Role_access_menu_model');
        $this->load->model('Role_access_sub_menu_model');
        $this->load->model('Sub_menu_access_view_model');
    }

    function dashboard($p = 'index')
    {
        $data['_view'] = 'dashboard';
        $this->load->view('layouts_admin/main', $data);
    }
    function api($p = 'index')
    {
        switch ($p) {
            case 'add':
                $this->load->library('form_validation');

                $this->form_validation->set_rules('password', 'Password', 'required|max_length[256]');
                $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

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
                    redirect('admin/user/index');
                } else {
                    $this->load->model('Role_model');
                    $data['all_user_roles'] = $this->Role_model->get_all_roles();

                    $data['_view'] = 'user/add';
                    $this->load->view('layouts_admin/main', $data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->User_model->delete_user($id);
                        redirect('admin/user');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'user/index';
                $data['users'] = $this->User_model->get_all_user();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function menu($p = 'index')
    {
        switch ($p) {
            case 'add':
                $this->load->library('form_validation');

                $this->form_validation->set_rules('menu', 'Menu', 'required');

                if ($this->form_validation->run()) {
                    $params = array(
                        'menu' => $this->input->post('menu'),
                    );
                    $user_menu_id = $this->Menu_model->add_menu($params);
                    redirect('admin/menu/index');
                } else {
                    $this->load->model('Role_model');
                    $data['all_user_roles'] = $this->Role_model->get_all_roles();

                    $data['_view'] = 'menu/add';
                    $this->load->view('layouts_admin/main', $data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');


                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->User_model->delete_user($id);
                        redirect('admin/user');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'menu/index';
                $data['menu'] = $this->Menu_model->get_all_menu();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function role($p = 'index')
    {
        switch ($p) {
            case 'add':
                $this->load->library('form_validation');

                $this->form_validation->set_rules('role', 'Role', 'required');

                if ($this->form_validation->run()) {
                    $params = array(
                        'role' => $this->input->post('role'),
                    );

                    $user_role_id = $this->Role_model->add_role($params);
                    redirect('admin/role/index');
                } else {

                    $data['_view'] = 'role/add';
                    $this->load->view('layouts_admin/main', $data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user_role'] = $this->Role_model->get_role($id);
                if ($id) {
                    if (isset($data['user_role'])) {
                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('role', 'Role', 'required');
                        $this->load->library('form_validation');
                        if ($this->form_validation->run()) {
                            $params = array(
                                'role' => $this->input->post('role'),
                            );
                            $this->Role_model->update_role($id, $params);
                            redirect('admin/role/index');
                        } else {
                            $data['_view'] = 'role/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $role = $this->Role_model->get_role($id);
                if ($id) {
                    if (isset($role['id'])) {
                        $this->Role_model->delete_role($id);
                        redirect('admin/role/index');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/role');
                }
                break;
            default:
                $data['user_roles'] = $this->Role_model->get_all_roles();

                $data['_view'] = 'role/index';
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function role_access_menu($p = 'index')
    {
        switch ($p) {
            case 'add':
                $role_id = $this->uri->segment(4);
                if ($role_id) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
                    if ($this->form_validation->run()) {
                        $params = array(
                            'role_id' => $role_id,
                            'menu_id' => $this->input->post('menu_id'),
                        );
                        $role_access_menu_id = $this->Role_access_menu_model->add_role_access_menu($params);
                        redirect('admin/role_access_menu/index/' . $role_id);
                    } else {
                        $data['all_menu'] = $this->Menu_model->get_all_menu();
                        $data['_view'] = 'role_access_menu/add';
                        $this->load->view('layouts_admin/main', $data);
                    }
                } else {
                    redirect('admin/role_access_menu');
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');


                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['sm'] = $this->Role_access_menu_model->get_role_access_menu($id);
                ($id);
                if ($id) {
                    if (isset($data['sm'])) {
                        $this->Role_access_menu_model->delete_role_access_menu($id);
                        redirect('admin/role_access_menu');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'role_access_menu/index';
                $data['role'] = $this->Role_model->get_all_roles();
                $data['role_access_menu'] = $this->Role_access_menu_model->get_all_role_access_menu();
                $data['role_access_sub_menu'] = $this->Role_access_sub_menu_model->get_all_role_access_sub_menu();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function role_access_sub_menu($p = 'index')
    {
        switch ($p) {
            case 'add':
                $role_id = $this->uri->segment(4);
                if ($role_id) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('sub_menu_id', 'sub_Menu Id', 'required');
                    if ($this->form_validation->run()) {
                        $params = array(
                            'role_id' => $role_id,
                            'sub_menu_id' => $this->input->post('sub_menu_id'),
                        );
                        $role_access_sub_menu_id = $this->Role_access_sub_menu_model->add_role_access_sub_menu($params);
                        redirect('admin/role_access_menu/index/' . $role_id);
                    } else {
                        $data['all_sub_menu'] = $this->Sub_menu_model->get_all_sub_menu();
                        $data['_view'] = 'role_access_sub_menu/add';
                        $this->load->view('layouts_admin/main', $data);
                    }
                } else {
                    redirect('admin/role_access_menu');
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');


                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['sm'] = $this->Role_access_sub_menu_model->get_role_access_sub_menu($id);
                ($id);
                if ($id) {
                    if (isset($data['sm'])) {
                        $this->Role_access_sub_menu_model->delete_role_access_sub_menu($id);
                        redirect('admin/role_access_menu');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'role_access_sub_menu/index';
                $data['role_access_sub_menu'] = $this->Role_access_sub_menu_model->get_all_role_access_sub_menu();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function sub_menu($p = 'index')
    {
        switch ($p) {
            case 'add':
                $menu_id = $this->uri->segment(4);

                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('icon', 'Icon', 'required');
                $this->form_validation->set_rules('is_active', 'Is Active', 'required');

                if ($this->form_validation->run()) {
                    $str = $this->generateRandomString();
                    $result = hash("sha256", $str);
                    $params = array(
                        'menu_id' => $menu_id,
                        'is_active' => $this->input->post('is_active'),
                        'title' => $this->input->post('title'),
                        'url' => 'core_system/index/' . $result,
                        'icon' => $this->input->post('icon'),
                    );

                    $user_sub_menu_id = $this->Sub_menu_model->add_sub_menu($params);
                    redirect('admin/menu/index');
                } else {
                    $data['menu'] = $this->Menu_model->get_all_menu();
                    $data['_view'] = 'sub_menu/add';
                    $this->load->view('layouts_admin/main', $data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');


                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->User_model->delete_user($id);
                        redirect('admin/user');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'sub_menu/index';
                $data['sub_menu'] = $this->Sub_menu_model->get_all_sub_menu();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function sub_menu_access_view($p = 'index')
    {
        switch ($p) {
            case 'add':
                $sub_menu_id = $this->uri->segment(4);
                if ($sub_menu_id) {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('view_id', 'View Id', 'required');
                    $this->form_validation->set_rules('is_active', 'Is Active', 'required');
                    $by =  $this->db->query("SELECT * FROM `sub_menu_access_view` WHERE sub_menu_id = " . $sub_menu_id . " ORDER BY `sub_menu_access_view`.`by` DESC LIMIT 1")->row_array();
                    if ($this->form_validation->run()) {
                        $params = array(
                            'sub_menu_id' => $sub_menu_id,
                            'view_id' => $this->input->post('view_id'),
                            'is_active' => $this->input->post('is_active'),
                            'by' => $by['by']+1,
                        );

                        $user_sub_menu_access_view_id = $this->Sub_menu_access_view_model->add_sub_menu_access_view($params);
                        redirect('admin/sub_menu_access_view');
                    } else {
                        $data['all_view'] = $this->View_model->get_all_view();
                        $data['_view'] = 'sub_menu_access_view/add';
                        $this->load->view('layouts_admin/main', $data);
                    }
                } else {
                    redirect('admin/user');
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');


                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['sm'] = $this->Sub_menu_access_view_model->get_sub_menu_access_view($id);
                ($id);
                if ($id) {
                    if (isset($data['sm'])) {
                        $this->Sub_menu_access_view_model->delete_sub_menu_access_view($id);
                        redirect('admin/sub_menu_access_view');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'sub_menu_access_view/index';
                $data['sub_menu'] = $this->Sub_menu_model->get_all_sub_menu();
                $data['sub_menu_access_view'] = $this->Sub_menu_access_view_model->get_all_sub_menu_access_view();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function user($p = 'index')
    {
        switch ($p) {
            case 'add':
                $this->load->library('form_validation');

                $this->form_validation->set_rules('password', 'Password', 'required|max_length[256]');
                $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

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
                    redirect('admin/user/index');
                } else {
                    $this->load->model('Role_model');
                    $data['all_user_roles'] = $this->Role_model->get_all_roles();

                    $data['_view'] = 'user/add';
                    $this->load->view('layouts_admin/main', $data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->load->library('form_validation');


                        $this->form_validation->set_rules('name', 'Name', 'required|max_length[128]');
                        $this->form_validation->set_rules('email', 'Email', 'required|max_length[128]|valid_email');
                        $this->form_validation->set_rules('role_id', 'Role Id', 'required|integer');
                        $this->form_validation->set_rules('is_active', 'Is Active', 'required|integer');

                        if ($this->form_validation->run()) {
                            if ($this->input->post('password') == null) {
                                $pass = $data['user']['password'];
                            } else {
                                $pass =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            }

                            $params = array(
                                'role_id' => $this->input->post('role_id'),
                                'password' => $pass,
                                'name' => $this->input->post('name'),
                                'email' => $this->input->post('email'),
                                'is_active' => $this->input->post('is_active'),
                            );

                            $this->User_model->update_user($id, $params);
                            redirect('user/index');
                        } else {
                            $this->load->model('Role_model');
                            $data['all_user_roles'] = $this->Role_model->get_all_roles();

                            $data['_view'] = 'user/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['user'] = $this->User_model->get_user($id);
                if ($id) {
                    if (isset($data['user'])) {
                        $this->User_model->delete_user($id);
                        redirect('admin/user');
                    } else
                        show_error('The user you are trying to delete does not exist.');
                } else {
                    redirect('admin/user');
                }
                break;
            default:
                $data['_view'] = 'user/index';
                $data['users'] = $this->User_model->get_all_user();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function view($p = 'index')
    {
        switch ($p) {
            case 'add':
                $this->load->library('form_validation');

                $this->form_validation->set_rules('type', 'Type', 'required');

                if ($this->form_validation->run()) {
                    // var_dump($_POST);
                    // die;
                    if ($this->input->post('type') == 'card') {
                        // {"filter":"ta","where":{"ta":"2020\/2021","id_jurusan":"0105"},"by":""}
                        if ($this->input->post('level') == 'kaprodi') {
                            $ff = ["filter" => $this->input->post('filter'), "where" => [$this->input->post('filter') => $this->input->post('fvalue'), "id_jurusan" => $this->input->post('id_jurusan')], "by" => $this->input->post('by')];
                        } else {
                            $ff = ["filter" => $this->input->post('filter'), "where" => [$this->input->post('filter') => $this->input->post('fvalue')], "by" => $this->input->post('by')];
                        }
                        $filter = json_encode($ff, true);
                        $params = array(
                            'type' => $this->input->post('type'),
                            'api_id' => $this->input->post('api_id'),
                            'cardTitle' => $this->input->post('cardTitle'),
                            'cardWidth' => $this->input->post('cardWidth'),
                            'cardFilter' => $filter,
                            'cardDetail' => $this->input->post('cardDetail'),
                            'cardColor' => $this->input->post('cardColor'),
                            'cardIcon' => $this->input->post('cardIcon'),
                        );
                    } elseif ($this->input->post('type') == 'chart') {
                        // {"filter":"kdta","where":{"id_jurusan":"0105"},"by":""}
                        if ($this->input->post('level') == 'kaprodi') {
                            $ff = ["filter" => $this->input->post('filter'), "where" => ["id_jurusan" => $this->input->post('id_jurusan')], "by" => $this->input->post('by')];
                        } else {
                            $ff = ["filter" => $this->input->post('filter'), "where" => [], "by" => $this->input->post('by')];
                        }
                        $filter = json_encode($ff, true);
                        $chartchildern = json_encode(array_map('intval', $this->input->post('api_id')), true);
                        $params = array(
                            'type' => 'chart-parent',
                            'chartChildrenId' => $chartchildern,
                            'chartFilter' => $filter,
                            'chartTitle' => $this->input->post('chartTitle'),
                            'chartType' => $this->input->post('chartType'),
                            'chartWidth' => $this->input->post('chartWidth'),
                        );
                    } elseif ($this->input->post('type') == 'accordionTable') {
                        if ($this->input->post('level') == 'kaprodi') {
                            $ff = ["filter" => $this->input->post('filter'), "where" => ["id_jurusan" => $this->input->post('id_jurusan')]];
                        } else {
                            $ff = ["filter" => $this->input->post('filter'), "where" => ["id_jurusan" => $this->input->post('id_jurusan')]];
                        }
                        $filter = json_encode($ff, true);
                        $params = array(
                            'type' => 'accordion-table',
                            'api_id' => $this->input->post('api_id'),
                            'accordionTableTitle' => $this->input->post('accordionTitle'),
                            'accordionTablePer' => $filter,
                        );
                    } elseif ($this->input->post('type') == 'table') {
                        if ($this->input->post('level') == 'kaprodi') {
                            $ff = [$this->input->post('filter') => $this->input->post('fvalue'), 'id_jurusan' => $this->input->post('id_jurusan')];
                        } else {
                            $ff = [$this->input->post('filter') => $this->input->post('fvalue')];
                        }
                        $filter = json_encode($ff, true);
                        $params = array(
                            'type' => $this->input->post('type'),
                            'api_id' => $this->input->post('api_id'),
                            'tableTitle' => $this->input->post('tableTitle'),
                            'tableFilter' => $filter,
                        );
                    } else {
                        echo 'kkk';
                    }
                    // $params = array(
                    //     'type' => $this->input->post('type'),
                    //     'api_id' => $this->input->post('api_id'),

                    //     'tableHeader' => $this->input->post('tableHeader'),
                    //     'tableTitle' => $this->input->post('tableTitle'),



                    //     'headerTitle' => $this->input->post('headerTitle'),
                    //     'sizeText' => $this->input->post('sizeText'),
                    //     'tabData' => $this->input->post('tabData'),
                    // );
                    // var_dump($params);
                    // die;
                    $view_id = $this->View_model->add_view($params);
                    redirect('admin/view/index');
                } else {
                    $data['api'] = $data = $this->db->select('id,name')->get('api')->result_array();
                    $data['_view'] = 'view/add';
                    $this->load->view('layouts_admin/main', $data);
                }
                break;
            case 'edit':
                $id = $this->uri->segment(4);
                $data['view'] = $this->View_model->get_view($id);
                if ($id) {
                    if (isset($data['view'])) {
                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('type', 'Type', 'required');
                        $this->form_validation->set_rules('api_id', 'Api_id', 'required');

                        if ($this->form_validation->run()) {
                            $params = array(
                                'type' => $this->input->post('type'),
                                'api_id' => $this->input->post('api_id'),

                                'tableHeader' => $this->input->post('tableHeader'),
                                'tableTitle' => $this->input->post('tableTitle'),

                                'accordionTableTitle' => $this->input->post('accordionTableTitle'),
                                'accordionTableFilter' => $this->input->post('accordionTablePer'),

                                'headerTitle' => $this->input->post('headerTitle'),
                                'sizeText' => $this->input->post('sizeText'),

                                'chartXkey' => $this->input->post('chartXkey'),
                                'chartYkey' => $this->input->post('chartYkey'),
                                'chartColor' => $this->input->post('chartColor'),

                                'cardTitle' => $this->input->post('cardTitle'),
                                'cardWidth' => $this->input->post('cardWidth'),
                                'cardFilter' => $this->input->post('cardFilter'),
                                'cardDetail' => $this->input->post('cardDetail'),
                                'cardColor' => $this->input->post('cardColor'),
                                'cardIcon' => $this->input->post('cardIcon'),

                                'tabData' => $this->input->post('tabData'),
                            );
                            $view_id = $this->View_model->update_view($id, $params);
                            redirect('admin/view/index');
                        } else {
                            $data['api'] = $data = $this->db->select('id,name')->get('api')->result_array();

                            $data['_view'] = 'view/edit';
                            $this->load->view('layouts_admin/main', $data);
                        }
                    } else
                        show_error('The view you are trying to delete does not exist.');
                } else {
                    redirect('admin/view');
                }
                break;
            case 'delete':
                $id = $this->uri->segment(4);
                $data['view'] = $this->View_model->get_view($id);
                if ($id) {
                    if (isset($data['view'])) {
                        $this->View_model->delete_view($id);
                        redirect('admin/view');
                    } else
                        show_error('The view you are trying to delete does not exist.');
                } else {
                    redirect('admin/view');
                }
                break;
            default:
                $data['_view'] = 'view/index';
                $data['views'] = $this->View_model->get_all_view();
                $this->load->view('layouts_admin/main', $data);
                break;
        }
    }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
