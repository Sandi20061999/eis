<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $data['_view'] = 'auth/login';
            $this->load->view('layouts/main_auth', $data);
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->select('user.id AS `user_id`,email,role,role_id,password,is_active,image')
            ->join('role', 'role.id=user.role_id')
            ->get_where('user', ['email' => $email])->row_array();
        // var_dump($user);
        // die;
        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $awal = $this->db
                        ->join('role', 'role.id=user.role_id')
                        ->join('role_access_menu_sub_menu', 'role_access_menu_sub_menu.role_id=role.id')
                        ->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')
                        ->join('sub_menu', 'sub_menu.id=menu_access_sub_menu.sub_menu_id')
                        ->get_where('user', array('user.role_id' => $user['role_id'], 'user.is_active' => 1, 'sub_menu.by' => '-1'))->row_array();
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'user_id' => $user['user_id'],
                        'role' => $user['role'],
                        'image' => $user['image'],
                        'url' => $awal['url']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role'] == 'Administrator') {
                        redirect('dashboard');
                    } else {
                        redirect('core_system/index');
                    }
                } else {
                    $this->session->set_flashdata('message', "<script>
                        Swal.fire({
                                icon: 'error',
                                title: 'Gagal...',
                                text: 'Gagal masuk, password salah!!',
                            })
                        </script>");
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', "<script>
                Swal.fire({
                        icon: 'error',
                        title: 'Gagal...',
                        text: 'Gagal masuk, akun belum aktif!!',
                    })
                </script>");
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', "<script>
            Swal.fire({
                    icon: 'error',
                    title: 'Gagal...',
                    text: 'Gagal masuk, email tidak terdaftar!!',
                })
            </script>");
            redirect('auth');
        }
    }


    // public function resetPassword()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

    //         if ($user_token) {
    //             $this->session->set_userdata('reset_email', $email);
    //             $this->changePassword();
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
    //             redirect('auth');
    //         }
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
    //         redirect('auth');
    //     }
    // }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }
}
