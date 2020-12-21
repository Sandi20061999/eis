<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Core_system extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Core_system_model');
    }
    function index()
    {
        // $menu = $this->db->select()->join('menu_access_sub_menu','menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id');
        $data['menu'] = $this->db->select('DISTINCT(menu),menu_id AS id,icon')->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')->join('menu', 'menu.id=menu_access_sub_menu.menu_id')->order_by('menu.by', 'ASC')->get_where('role_access_menu_sub_menu', array('role_id' => $this->session->userdata('role_id')))->result_array();
        // $data['sub'] = $this->db->select('menu_id,url,title')->join('menu_access_sub_menu', 'menu_access_sub_menu.id=role_access_menu_sub_menu.menu_access_sub_menu_id')->join('sub_menu', 'sub_menu.id=menu_access_sub_menu.sub_menu_id')->order_by('sub_menu.by', 'ASC')->get_where('role_access_menu_sub_menu', array('role_id' => $this->session->userdata('role_id')))->result_array();
        $req = "<script type=\"text/javascript\">
            $('a.getView').on('click', function() {
                $('#preloader').fadeIn(300);
                var id = $(this).attr('id');
                $.ajax({
                    url: '" . base_url() . "core_system/getView/' + id,
                    type: 'POST',
                    cache: false,
                    success: function(msg) {
                        $('msg').ready(function() {
                            $('#app').html(msg);
                            $('.getView').removeClass('active');
                            $('#' + id).addClass('active');
                            $('#preloader').fadeOut(100);
                        });
                    }
                })
            })
            $(document).ready(function() {
                $('#preloader').fadeOut(300);
                $.ajax({
                    type: 'POST',
                    url: '" . base_url() . "core_system/getView/" . $this->session->userdata('url') . "',
                    cache: false,
                    success: function(msg) {
                        $('msg').ready(function() {
                            $('#app').html(msg);
                        });
                    }
                });
                $('.menuAktif').click(); 
                $('#" . $this->session->userdata('url') . "').addClass('active');
            })
            function profil() {
            $.ajax({
                url: '" . base_url() . "core_system/getView/profil',
                type: 'POST',
                cache: false,
                success: function(msg) {
                    $('msg').ready(function() {
                        $('#app').html(msg);
                        $('#preloader').fadeOut(100);
                    });
                }
            })
        }
            </script>";
        $foot['req'] = $req;
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);

        // $foot['view'] = $this->getView($this->session->userdata('url'));
        $this->load->view('sections/main');
        $this->load->view('layouts/footer', $foot);
    }

    function getView($url = null)
    {
        if ($url == 'profil') {
            $user = $this->db->join('role', 'role.id = user.role_id')->get_where('user', ['user.id' => $this->session->userdata('user_id')])->row_array();
            $html = profil($user);
            echo $html;
        }
        if ($url != null) {
            $getView = $this->Core_system_model->getView($url);
            // var_dump($getView);
            // die;
            $html = '';
            foreach ($getView as $gV) {
                $json = json_decode($gV['jsonFile'], TRUE);
                if ($json['type'] == 'breadcrumb') {
                    $html .= $this->breadcrumb($url);
                }
                if ($json['type'] == 'sayhello') {
                    $html .= $this->sayhello($url);
                }
                if ($json['type'] == 'table') {
                    $u = $gV['id'];
                    $data = $json['data'];
                    $where = array_merge($data['where'], $data['default_where']);
                    if ($data['count'] == 'row') {
                        $select = $this->tableData($data['table'], $where, $data['groupby'], $data['count']);
                    } else {
                        $select = $this->tableData($data['table'], $where, $data['groupby'], $data['count'], $data['selector']);
                    }
                    if ($select == null) {
                        $html .= '<p>Data Kosong</p>';
                        continue;
                    } else {
                        $list = array_keys($select[0]);
                    }
                    if ($json['dataTable'] == true) {
                        $html .= table($list, $select, $json['width']);
                    } else {
                        $html .= table($list, $select, $json['width'], 'tidak');
                    }
                }
                if ($json['type'] == 'card') {
                    $u = $gV['id'];
                    $data = $json['data'];
                    $where = array_merge($data['where'], $data['default_where']);
                    if ($data['count'] == 'row') {
                        $jml = $this->getDataCard($data['table'], $where, $data['groupby'], $data['count']);
                    } else {
                        $jml = $this->getDataCard($data['table'], $where, $data['groupby'], $data['count'], $data['selector']);
                    }
                    $dataCard = [
                        'title' =>  $json['title'],
                        'color' => $json['color'],
                        'width' => $json['width'],
                        'nilai' => $jml['jumlah'],
                        'icon' => $json['icon'],
                        'detail' => $json['detail'],
                        'default' => $data['default_value'],
                        'type' => $data['count']
                    ];
                    $select = $this->getList($data['table'], $data['where'], $data['groupby']);
                    $tes = [];
                    foreach ($select as $s => $val) {
                        array_push($tes, $val[$data['groupby']]);
                    }
                    $card = card($dataCard, $u, $tes);
                    $html .= $card;
                }
                if ($json['type'] == 'scroll') {
                    $idk = $gV['id'];
                    $ulang = $json['data'];
                    $is = [];
                    $iku = 0;
                    foreach ($ulang as $u) {
                        $data1 = $u['data'];
                        $where = array_merge($data1['where'], $data1['default_where']);
                        if ($data1['count'] == 'row') {
                            $jml = $this->getDataCard($data1['table'], $where, $data1['groupby'], $data1['count']);
                        } else {
                            $jml = $this->getDataCard($data1['table'], $where, $data1['groupby'], $data1['count'], $data1['selector']);
                        }
                        $data1Card = [
                            'title' =>  $u['title'],
                            'color' => $u['color'],
                            'width' => $u['width'],
                            'nilai' => $jml['jumlah'],
                            'icon' => $u['icon'],
                            'detail' => $u['detail'],
                            'default' => $data1['default_value'],
                            'type' => $data1['count'],
                            'arr' => $iku
                        ];
                        $select = $this->getList($data1['table'], $data1['where'], $data1['groupby']);
                        $tes = [];
                        foreach ($select as $s => $val) {
                            array_push($tes, $val[$data1['groupby']]);
                        }
                        // $cek = '<script>
                        //     $(document).ready(function() {
                        //         console.log("' . $u . '")
                        //     });
                        // </script>';
                        // echo $cek;
                        // die;
                        $card = card($data1Card, $idk, $tes);
                        array_push($is, $card);
                        $iku++;
                    }
                    $html .= scrollCard($is);
                }
                if ($json['type'] == 'chart') {
                    $rand_color = ['#3f48cc', '#009688', '#ff6d00', '#ffd600', '#ec0c20', '#263238', '#0091ea', '#673ab7', '#00c853', '#004d40', '#9097c4', '#00A9A2', '#e83e8c'];
                    $colorrr = 0;
                    $u = $gV['id'];
                    $data = $json['data'];
                    $list = [];
                    $test = [];
                    foreach ($data as $a) {
                        $where = array_merge($a['where'], $a['default_where']);
                        $select = $this->getList($a['table'], $where, $a['groupby']);
                        foreach ($select as $s => $val) {
                            array_push($list, $val[$a['groupby']]);
                        }
                    }
                    $newList = array_unique($list);
                    $newList = array_values($newList);
                    // var_dump($newList);
                    // die;
                    foreach ($data as $a) {
                        $datalist = [];
                        foreach ($newList as $nL) {
                            $whereList = array_merge($a['where'], $a['default_where'], [$a['groupby'] => $nL]);
                            if ($a['count'] == 'row') {
                                $datanya = $this->getDataChart($a['table'], $whereList, $a['groupby'], $a['count']);
                                if ($datanya == null) {
                                    array_push($datalist, 0);
                                } else {
                                    array_push($datalist, intval($datanya['jumlah']));
                                }
                            } else {
                                $datanya = $this->getDataChart($a['table'], $whereList, $a['groupby'], $a['count'], $a['selector']);
                                if ($datanya == null) {
                                    array_push($datalist, 0);
                                } else {
                                    array_push($datalist, intval($datanya['jumlah']));
                                }
                            }
                        }
                        $tete = [
                            'backgroundColor' => $rand_color[$colorrr],
                            'borderColor' => $rand_color[$colorrr],
                            'fill' => false,
                            'label' => $a['name'],
                            'data' => $datalist
                        ];
                        $colorrr++;
                        array_push($test, $tete);
                    }
                    $datakuy = [
                        'labels' => $newList,
                        'datasets' => $test
                    ];
                    // var_dump(json_encode($datakuy, TRUE));
                    // die;
                    $chart = chart($u, $datakuy, $this->optionChart($json['title']), 'line', $json['width']);
                    $html .= $chart;
                }
                if ($json['type'] == 'accordion') {
                    $u = $gV['id'];
                    $data = $json['data'];
                    $where = array_merge($data['where'], $data['default_where']);
                    $select = $this->getList($data['table'], $data['where'], $data['groupby']);
                    $list = [];
                    foreach ($select as $s => $val) {
                        array_push($list, $val[$data['groupby']]);
                    }
                    $accordion = accordion($json['title'], $u, $list, field_as($data['groupby']));
                    $html .= $accordion;
                }
            }
            echo '<div class="row">' . $html . '</div>';
        } else {
            echo "<h1>Halaman tidak ditemukan.</h1>";
        }
    }

    function getDataAccordion()
    {
        $dat = $_POST['dat'];
        $data = explode('|', $dat);
        $get = $this->db->get_where('view', ['id' => $data[0]])->row_array();
        $json = json_decode($get['jsonFile'], TRUE);
        $dataku = $json['data'];
        $where = array_merge($dataku['where'], [$dataku['groupby'] => $data[1]]);
        $isi = $this->getTable($dataku['table'], $where, $dataku['groupby']);
        $head = array_keys($isi[0]);
        $table = table($head, $isi);
        echo $table;
    }

    function updateCard($reload = null)
    {
        $dat = $_POST['dat'];
        // $dat = '627|2019/2020|61|0';
        $data = explode('|', $dat);
        $get = $this->db->get_where('view', ['id' => $data[0]])->row_array();
        $json = json_decode($get['jsonFile'], TRUE);
        if ($data[3] == 'kosong') {
            $dataku = $json['data'];
            $reload = $json['api_id'];
        } else {
            $ah = $json['data'][$data[3]];
            $reload = $ah['api_id'];
            $dataku = $ah['data'];
        }
        // var_dump($dataku);
        // die;
        // if ($reload != null) {
        //     updateData($json['api_id']);
        // }
        $where = array_merge($dataku['where'], [$dataku['groupby'] => $data[1]]);
        if ($dataku['count'] == 'row') {
            $jml = $this->getDataCard($dataku['table'], $where, $dataku['groupby'], $dataku['count']);
        } else {
            $jml = $this->getDataCard($dataku['table'], $where, $dataku['groupby'], $dataku['count'], $dataku['selector']);
        }
        $return = [
            'detail' => '<p class="text-white mb-0">' . field_as($dataku['groupby']) . ' ' . $data[1] . '</p>',
            'nilai' => $jml['jumlah'],
            'forTable' => $dat,
            'forTable2' => base_url('export_to_excel/index/') . base64_encode($dat),
            'reload' => $reload
        ];
        echo json_encode($return, TRUE);
    }

    function modalCard()
    {
        $dat = $_POST['dat'];
        // $dat = '627|2019/2020|61|0';
        $data = explode('|', $dat);
        $get = $this->db->get_where('view', ['id' => $data[0]])->row_array();
        $json = json_decode($get['jsonFile'], TRUE);
        if ($data[3] == 'kosong') {
            $dataku = $json['data'];
            $jsonKU = $json;
        } else {
            $jsonKU = $json['data'][$data[3]];
            $dataku = $jsonKU['data'];
        }
        $where = array_merge($dataku['where'], [$dataku['groupby'] => $data[1]]);
        $isi = $this->getTable($dataku['table'], $where, $dataku['groupby']);
        if ($isi == null || empty($isi)) {
            $table = '<center><h3>Data tidak ada</h3></center>';
        } else {
            $head = array_keys($isi[0]);
            if (empty($jsonKU['withDetail'])) {
                $table = table($head, $isi);
            } else {
                $table = tableWithDetail($head, $isi, $data[0] . '|' . $data[3], $jsonKU['withDetail']['selector']);
            }
        }
        $modal = modal($table, $dat, field_as($dataku['groupby']) . ' ' . $data[1]);
        echo $modal;
    }
    function getTable($table = '', $where = [], $groupby = '')
    {
        return $this->db->select()->where($where)->order_by($groupby, 'ASC')->get($table)->result_array();
    }

    function getDataCard($table = '', $where = [], $groupby = '', $count = 'row', $selector = [])
    {
        if ($count == 'row') {
            return $this->db->select("COUNT({$groupby}) AS jumlah")->where($where)->group_by($groupby)->get($table)->row_array();
        } else {
            $jj = [];
            foreach ($selector as $s) {
                $hah = $this->db->select("SUM({$s}) AS jumlah")->where($where)->group_by($groupby)->get($table)->row_array();
                array_push($jj, $hah['jumlah']);
            }
            return [
                'jumlah' => array_sum($jj)
            ];
        }
    }

    function getList($table = '', $where = [], $groupby = '')
    {
        return $this->db->select("DISTINCT({$groupby})")->where($where)->order_by($groupby, 'ASC')->get($table)->result_array();
    }

    function breadcrumb($uid)
    {
        $breadcrumb = $this->db
            ->join('menu_access_sub_menu', 'menu_access_sub_menu.sub_menu_id=sub_menu.id')
            ->join('menu', 'menu.id=menu_access_sub_menu.menu_id')
            ->get_where('sub_menu', array('url' => ($uid), 'is_active' => 1))->row_array();
        $menu = $breadcrumb['menu'];
        $submenu = $breadcrumb['title'];
        $return = breadcrumb($menu, $submenu);
        return $return;
    }
    function sayhello($uid)
    {
        $breadcrumb = $this->db
            ->get_where('sub_menu', array('url' => $uid, 'is_active' => 1))->row_array();
        if ($breadcrumb['pict'] == null) {
            $filesvg = [
                'drawkit-grape-pack-illustration-2.svg',
                'drawkit-grape-pack-illustration-3.svg',
                'drawkit-grape-pack-illustration-4.svg',
                'drawkit-grape-pack-illustration-5.svg',
            ];
            $random_keys = array_rand($filesvg, 3);
            $datasay['pict'] = $filesvg[$random_keys[0]];
        } else {
            $datasay['pict'] = $breadcrumb['pict'];
        }
        return sayhello($datasay['pict'], $this->session->userdata('role'));
    }

    function optionChart($title = "Judul tidak di set")
    {
        return [
            'title' => [
                'display' => true,
                'text' => $title,
                'fontSize' => 18
            ],
            'plugins' => [
                'datalabels' => [
                    'backgroundColor' => 'white',
                    'borderRadius' => 4,
                    'color' => '#324cdd',
                    'font' => [
                        'weight' => 'bold'
                    ],
                    'formatter' => 'Math.round'
                ]
            ],
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true
                        ]
                    ]
                ]
            ],
            'zoom' => [
                // 'pan' => [
                //     'enabled' => false,
                //     'mode' => 'x'
                // ],
                // 'zoom' => [
                'enabled' => false,
                'mode' => "x"
                // ]

            ]

        ];
    }

    function getDataChart($table = '', $where = [], $groupby = '', $count = 'row', $selector = '')
    {
        if ($count == 'row') {
            return $this->db->select("{$groupby},COUNT(*) AS jumlah")->where($where)->group_by($groupby)->order_by($groupby, 'ASC')->get($table)->row_array();
        } else {
            return $this->db->select("SUM({$selector}) AS jumlah")->where($where)->group_by($groupby)->order_by($groupby, 'ASC')->get($table)->row_array();
        }
    }

    function saran()
    {
        $par = [
            'user_id' => $this->input->post('user_id'),
            'judul' => $this->input->post('judul'),
            'ket' => $this->input->post('ket'),
        ];
        $in = $this->db->insert('saran', $par);
        if ($in) {
            echo json_encode('sukses');
        } else {
            echo json_encode('gagal');
        }
    }

    function getTableView($list, $data, $title, $width)
    {
        return '
        <div class="col-' . $width . '">
            ' . table($list, $data) . '
        </div>
        ';
    }

    function tableData($table = '', $where = [], $groupby = '', $count = 'row', $selector = [])
    {
        if ($count == 'row') {
            return $this->db->select("{$groupby} , COUNT({$groupby}) AS jumlah")->where($where)->group_by($groupby)->order_by($groupby, 'ASC')->get($table)->result_array();
        } else {
            $hh = [];
            foreach ($selector as $s) {
                array_push($hh, "SUM({$s}) AS {$s}");
            }
            $im = implode(',', $hh);
            $dd = $groupby . ',';
            return $this->db->select($dd . $im)->where($where)->group_by($groupby)->order_by($groupby, 'ASC')->get($table)->result_array();
        }
    }

    function modalCardDetail()
    {
        $dat = $_POST['dat'];
        // $dat = '1032|0|2011019001P';
        $data = explode('|', $dat);
        $get = $this->db->get_where('view', ['id' => $data[0]])->row_array();   
        $json = json_decode($get['jsonFile'], TRUE);
        // var_dump($json);
        // die;
        if ($data[1] == 'kosong') {
            $dataku = $json['data'];
            $jsonKU = $json;
        } else {
            $jsonKU = $json['data'][$data[1]];
            $dataku = $jsonKU['data'];
        }
        $getData = $this->db->get_where('api', ['id' => $jsonKU['withDetail']['api_id']])->row_array();
        $isi = $this->getTable("api_" . strtolower($getData['view_name']), [$jsonKU['withDetail']['selector'] => $data[2]], $jsonKU['withDetail']['selector']);
        if ($isi == null || empty($isi)) {
            $table = '<center><h3>Data tidak ada</h3></center>';
        } else {
            $head = array_keys($isi[0]);
            $table = table($head, $isi);
        }
        // $head = array_keys($isi[0]);
        $modal = modalDetail($table, $dat, $data[1]);
        echo $modal;
    }
    function profil($apani = 100)
    {
        $uid = $this->session->userdata('user_id');
        $this->db->where('id', $uid);
        if ($apani == 3) {
            if ($this->db->update('user', ['password' => password_hash($_POST['newpass'], PASSWORD_DEFAULT)])) {
                echo 'berhasil';
            } else {
                echo 'gagal';
            }
        } else if ($apani == 1) {
            $data = $_POST;
            $this->db->where('id', $uid);
            if ($this->db->update('user', $data)) {
                echo 'berhasil';
            } else {
                echo 'gagal';
            }
        } else if ($apani == 2) {
            $this->db->where('id', $uid);
            if (isset($_FILES["photo"])) {
                $config['upload_path'] = './assets/img/profil/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2000';
                $this->load->library('upload', $config);
                $data = $this->db->get_where('user', ['id' => $uid])->row_array();
                if ($this->upload->do_upload('photo')) {
                    $new = $this->upload->data('file_name');
                    $foto_lama = $data['image'];
                    if ($foto_lama != 'default.png') {
                        unlink(FCPATH . 'assets/img/profil/' . $foto_lama);
                    }
                    $this->db->where('id', $uid);
                    $this->db->update('user', ['image' => $new]);
                    $this->session->set_userdata('image', $new);
                    echo $this->session->userdata('image');
                } else {
                    echo $this->upload->display_errors();
                }
            }
        } else {
            echo 'ooo';
        }
        // }if (isset($_POST['bprofil'])) {
        //     $this->form_validation->set_rules('email', 'Email', 'required|max_length[100]');
        //     $this->form_validation->set_rules('phone', 'Phone', 'max_length[13]|numeric');
        //     $this->form_validation->set_rules('name', 'Name', 'required');
        //     if ($this->form_validation->run()) {
        //         $userProperties = [
        //             'email' => $this->input->post('email'),
        //             'phoneNumber' => '+62' . $this->input->post('phone'),
        //             'name' => $this->input->post('name'),
        //         ];
        //        
        // } else if (isset($_POST['bfoto'])) {
        //     if (isset($_FILES["photo"])) {
        //         $config['upload_path'] = './assets/img/profil/';
        //         $config['allowed_types'] = 'gif|jpg|png';
        //         $config['max_size']     = '2000';
        //         $this->load->library('upload', $config);
        //         $data = $this->db->get_where('users', ['id' => $uid])->row_array();
        //         if ($this->upload->do_upload('photo')) {
        //             $new = $this->upload->data('file_name');
        //             $foto_lama = $data['image'];
        //             if ($foto_lama != 'default.png') {
        //                 unlink(FCPATH . 'assets/img/profil/' . $foto_lama);
        //             }
        //             $this->db->where('id', $uid);
        //             $this->db->update('users', ['image' => $new]);
        //         } else {
        //             echo $this->upload->display_errors();
        //         }
        //     }
        // }
    }
    // function profil()
    // {
    //     $uid = $this->session->userdata('user_id');
    //     $this->load->library('form_validation');
    //     if (isset($_POST['bpassword'])) {
    //         $this->form_validation->set_rules('newpass', 'Newpass', 'required|min_length[6]|trim');
    //         $this->db->where('id', $uid);
    //         if ($this->form_validation->run()) {
    //             $this->db->update('user', ['password' => $this->input->post('newpass')]);
    //             echo 'berhasil';
    //         } else {
    //             echo 'gagal';
    //         }
    //     } else if (isset($_POST['bprofil'])) {
    //         $this->form_validation->set_rules('email', 'Email', 'required|max_length[100]');
    //         $this->form_validation->set_rules('phone', 'Phone', 'max_length[13]|numeric');
    //         $this->form_validation->set_rules('name', 'Name', 'required');
    //         if ($this->form_validation->run()) {
    //             $userProperties = [
    //                 'email' => $this->input->post('email'),
    //                 'phoneNumber' => '+62' . $this->input->post('phone'),
    //                 'name' => $this->input->post('name'),
    //             ];
    //             $this->db->where('id', $uid);
    //             $this->db->update('user', $userProperties);
    //             echo 'berhasil';
    //         } else {
    //             echo 'gagal';
    //         }
    //     } else if (isset($_POST['bfoto'])) {
    //         if (isset($_FILES["photo"])) {
    //             $config['upload_path'] = './assets/img/profil/';
    //             $config['allowed_types'] = 'gif|jpg|png';
    //             $config['max_size']     = '2000';
    //             $this->load->library('upload', $config);
    //             $data = $this->db->get_where('users', ['id' => $uid])->row_array();
    //             if ($this->upload->do_upload('photo')) {
    //                 $new = $this->upload->data('file_name');
    //                 $foto_lama = $data['image'];
    //                 if ($foto_lama != 'default.png') {
    //                     unlink(FCPATH . 'assets/img/profil/' . $foto_lama);
    //                 }
    //                 $this->db->where('id', $uid);
    //                 $this->db->update('users', ['image' => $new]);
    //             } else {
    //                 echo $this->upload->display_errors();
    //             }
    //         }
    //     }
    // }
}
