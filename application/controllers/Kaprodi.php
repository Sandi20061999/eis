<?php
class Kaprodi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_access_menu_model');
        $this->load->model('User_access_sub_menu_model');
        $this->load->model('Api_model');
    }
    function index()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/dashboard');
        $this->load->view('layouts/footer');
    }
    function grafik_perbandingan()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        $keyperbandingan = [
            'x' => 'bilangan',
            'y' => array('0' => 'Pendaftar', '1' => 'Daftar_Ulang', '2' => 'Tidak_Daftar_Ulang'),
            'color' => array('0' => '#4d7cff', '1' => '#00ff0f', '2' => '#ff0004'),
        ];
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_GrafikPendaftaran",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "id_jurusan desc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $gpendaftar = json_decode($getmhs, true)['data'];
        // var_dump($gpendaftar);
        // die;
        $jmlpendaftar = [];
        foreach ($gpendaftar as  $value) {
            $jmlpendaftar[] = array($value['TA'], ($value['jmlDaftarulang'] + $value['jmlTidakDaftarulang']), $value['jmlDaftarulang'], $value['jmlTidakDaftarulang']);
        }

        $chart['key'][0] = $keyperbandingan;
        $chart['data'][0] = $jmlpendaftar;
        $chart['type'][0] = 'morris-bar-chart';
        $chart['title'][0] = 'Grafik Jumlah Pendaftar Per Tahun Ajaran';
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('layouts/footer', $chart);
    }
    function pendaftar()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        // $jum = $this->Api_model->getApi(($this->uri->segment(1) . '/' . $this->uri->segment(2)));
        // // var_dump($jum);
        // // die;
        // for ($i = 0; $i < count($jum); $i++) {
        //     if ($jum[$i]['type'] == "morris-line-chart") {
        //         $keypendaftar = [
        //             'x' => 'bilangan',
        //             'y' => array('0' => 'Jumlah'),
        //             'color' => array('0' => '#4d7cff'),
        //         ];
        //         $gpendaftar = $this->_api($jum[$i]['select'], $jum[$i]['view_name'], ("id_jurusan='" . $this->session->userdata('prodi_id') . "'"), $jum[$i]['limit'], $jum[$i]['order_by']);
        //         $jmlpendaftar = [];
        //         foreach ($gpendaftar as  $value) {
        //             $jmlpendaftar[] = array($value['TA'], ($value['jmlDaftarulang'] + $value['jmlTidakDaftarulang']));
        //         }

        //         $chart['key'][$i] = $keypendaftar;
        //         $chart['data'][$i] = $jmlpendaftar;
        //         $chart['type'][$i] = 'morris-line-chart';
        //         $chart['title'][$i] = 'Grafik Jumlah Pendaftar Per Tahun Ajaran';
        //         $this->load->view('sections/chart', $chart);
        //     }

        //     if($jum[$i]['type'] == "accordion-table"){
        //         $gpendaftar = $this->_api($jum[$i]['select'], $jum[$i]['view_name'], ("id_jurusan='" . $this->session->userdata('prodi_id') . "'"), $jum[$i]['limit'], $jum[$i]['order_by']);
        //         $acc['accordion'][$i]  =  accordion_view('Tabulasi Pendaftaran', $gpendaftar, 'ta', $i);
        //         $this->load->view('sections/accordion', $acc);

        //     }
        // }
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_GrafikPendaftaran",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "id_jurusan desc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $gpendaftar = json_decode($getmhs, true)['data'];
        $jmlpendaftar = [];
        foreach ($gpendaftar as  $value) {
            $jmlpendaftar[] = array($value['TA'], ($value['jmlDaftarulang'] + $value['jmlTidakDaftarulang']));
        }
        
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmlpendaftar;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Pendaftar Per Tahun Ajaran';
        
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_Pendaftar",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "id_jurusan desc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $pendaftar = json_decode($getmhs, true)['data'];
        $acc['accordion'][0]  =  accordion_view('Tabulasi Pendaftaran', $pendaftar, 'ta', 0);
        
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    function pendaftar_daftar_ulang()
    {
        
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        
        //Format
        
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];
        
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_GrafikPendaftaran",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "id_jurusan desc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $gpendaftar = json_decode($getmhs, true)['data'];
        
        
        $jmldu = [];
        foreach ($gpendaftar as  $value) {
            $jmldu[] = array($value['TA'], $value['jmlDaftarulang']);
        }
        
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Daftar Ulang Per Tahun Ajaran';
        $acc['accordion'][0]  =  accordion_view('Tabulasi Pendaftaran Daftar Ulang', $gpendaftar, 'TA', 0);
        
        
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    function pendaftar_tidak_daftar_ulang()
    {
        
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        
        //Format
        
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];
        
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_GrafikPendaftaran",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "id_jurusan desc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $gpendaftar = json_decode($getmhs, true)['data'];
        
        
        $jmldu = [];
        foreach ($gpendaftar as  $value) {
            $jmldu[] = array($value['TA'], $value['jmlTidakDaftarulang']);
        }
        
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Tidak Daftar Ulang Per Tahun Ajaran';
        
        $acc['accordion'][0]  =  accordion_view('Tabulasi Pendaftaran Tidak Daftar Ulang', $gpendaftar, 'TA', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function mahasiswa_aktif()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaAktif",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];
        
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['ta']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            $jmldu[] = array($key, count($value));
        }
        // var_dump($jmldu);
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Aktif';
        
        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Aktif Per TA', $cuti, 'ta', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function mahasiswa_cuti()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaCuti",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];
        
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['ta']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            $jmldu[] = array($key, count($value));
        }
        // var_dump($jmldu);
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Cuti';
        
        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Cuti Per TA', $cuti, 'ta', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function mahasiswa_lulus_per_ta()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaLulus_PerTA",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];
        
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[trim($x['Tahun Lulus'])][$index] = $x;
        }
        // var_dump($dump);
        // die;
        arsort($dump);
        foreach ($dump as $key =>  $value) {
            if ($key != '') {
                $jmldu[] =  array($key, count($value));
            }
        }
        
        // var_dump($jmldu);
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Lulus Per Tahun Lulus';
        
        $cuti = json_decode($getmhs, true)['data'];
        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Lulus per Tahun Lulus', $cuti, 'Tahun Lulus', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function mahasiswa_lulus_per_angkatan()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaLulus_PerAngkatan",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];
        
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        var_dump($cuti);
        die;
        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['angkatan']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            $jmldu[] = array($key, count($value));
        }

        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Lulu Per Angkatan';
        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Lulus per Angkatan', $cuti, 'angkatan', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer');
    }
    public function mahasiswa_lulus_tepat_waktu()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaLulus_TepatWaktu",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta desc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['TA']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            if ($key != '') {
                $jmldu[] =  array($key, count($value));
            }
            // var_dump($key);
        }
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Lulu Tepat Waktu';

        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Lulus Tepat Waktu', $cuti, 'TA', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function mahasiswa_lulus_ipk_tertentu()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaLulus_IPK",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['ipk']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            if ($key == '') {
                $key = "Kosong";
            }
            $jmldu[] = array($key, count($value));
            // var_dump($key);
        }
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-bar-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Lulus IPK Tertentu';
        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Lulus IPK Tertentu', $cuti, 'ipk', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function mahasiswa_habis_masa_studi()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MHSHabisMasaStudi",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['angkatan']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            if ($key == '') {
                $key = "Kosong";
            }
            $jmldu[] = array($key, count($value));
            // var_dump($key);
        }
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-bar-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa Lulus Per Angkatan';

        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa Habis Masa Studi', $cuti, 'angkatan', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }

    public function mahasiswa_re_npm()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_MahasiswaReNPM",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['ta']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            if ($key == '') {
                $key = "Kosong";
            }
            $jmldu[] = array($key, count($value));
            // var_dump($key);
        }
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-line-chart';
        $chart['title'][0] = 'Grafik Jumlah Mahasiswa RE-NPM';

        $acc['accordion'][0]  =  accordion_view('Tabulasi Mahasiswa RE NPM Per Tahun', $cuti, 'ta', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
    public function presensi_mahasiswa()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_AbsensiMahasiswa",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        var_dump($cuti);
        die;
        $acc['accordion'][0]  =  accordion_view('Tabulasi Presensi Mahasiswa ', $cuti, 'TA', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer');
    }
    public function presensi_dosen()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_DosenMengajar",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        var_dump($cuti);
        die;
        $acc['accordion'][0]  =  accordion_view('Tabulasi Presensi Mahasiswa ', $cuti, 'ta', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer');
    }
    public function bimbingan_pa()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $datapost = [
            "select" => "*",
            "view_name" => "EIS_Prodi_BimbinganPA",
            "where" => "id_jurusan='".$this->session->userdata('prodi_id')."'",
            "limit" => "-1",
            "order_by" => "ta asc"
        ];
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        $cuti = json_decode($getmhs, true)['data'];
        $keypendaftar = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $dump = [];
        $i = 0;
        $jmldu = [];
        foreach ($cuti as $index => $x) {
            $dump[$x['Tahun']][$index] = $x;
        }
        foreach ($dump as $key =>  $value) {
            if ($key == '') {
                $key = "Kosong";
            }
            $jmldu[] = array($key, count($value));
            // var_dump($key);
        }
        // die;
        $chart['key'][0] = $keypendaftar;
        $chart['data'][0] = $jmldu;
        $chart['type'][0] = 'morris-bar-chart';
        $chart['title'][0] = 'Grafik Bimbingan PA';
        $acc['accordion'][0]  =  accordion_view('Tabulasi Bimbingan PA ', $cuti, 'Tahun', 0);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
}
