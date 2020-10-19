<?php
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_access_menu_model');
        $this->load->model('User_access_sub_menu_model');
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

        //Format

        $key = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah', '1' => 'Bukan'),
            'color' => array('0' => '#4d7cff', '1' => '#45fda5'),
        ];

        $datacoba = [
            array('2010', '78', '56'),
            array('2011', '10', '6'),
            array('2012', '80', '56'),
            array('2013', '24', '70'),
            array('2014', '57', '56'),
            array('2015', '60', '67'),
            array('2016', '56', '89'),
            array('2017', '90', '90'),
            array('2018', '80', '34'),
            array('2019', '3', '56'),
            array('2020', '10', '90'),
        ];
        $chart['key'] = $key;
        $chart['data'] = $datacoba;
        $chart['type'][0] = 'morris-bar-chart';
        $chart['type'][1] = 'morris-bar-chart';

        $jsn = json_decode('[
            {
                "npm": "1211059022",
                "nama": "M. Ricko Novriant",
                "jk": "Lk",
                "tempatlahir": "",
                "tgllahir": "1900-01-01 00:00:00",
                "jenjang": "S1",
                "id_jurusan": "0105",
                "nm_jurusan": "Sistem Informasi",
                "angkatan": "2012",
                "tglmasuk": "2012-09-15 00:00:00",
                "ct": "1"
            },
            {
                "npm": "1211059019",
                "nama": "Hartoyo",
                "jk": "Lk",
                "tempatlahir": "Tanjung Bintang",
                "tgllahir": "1988-03-16 00:00:00",
                "jenjang": "S1",
                "id_jurusan": "0105",
                "nm_jurusan": "Sistem Informasi",
                "angkatan": "2012",
                "tglmasuk": "2012-09-15 00:00:00",
                "ct": "2"
            }]', true);
        $table['table'][0] = table_view($jsn);
        $table['table'][1] = table_view($jsn);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/table', $table);
        $this->load->view('layouts/footer', $chart);
    }

    function detail_pendaftar_tidak_daftar_ulang()
    {
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));

        //Format

        $key = [
            'x' => 'bilangan',
            'y' => array('0' => 'Jumlah'),
            'color' => array('0' => '#4d7cff'),
        ];

        $datacoba = [
            array('2010', '78'),
            array('2011', '10'),
            array('2012', '80'),
            array('2013', '24'),
            array('2014', '57'),
            array('2015', '60'),
            array('2016', '56'),
            array('2017', '90'),
            array('2018', '80'),
            array('2019', '3'),
            array('2020', '10'),
        ];
        $chart['key'] = $key;
        $chart['data'] = $datacoba;
        $chart['type'][0] = 'morris-line-chart';

        $jsn = json_decode('[
            {
                "no_test": "R1100048",
                "npm": "1112120170",
                "tgldaftar": "2010-04-01 00:00:00",
                "nama": "DESI HANDAYANI",
                "jk": "Pr",
                "id_jurusan": "0212",
                "kdta": "20112",
                "tempatlahir": "PURNAMA TUNGGAL",
                "tgllahir": "1993-12-20 00:00:00",
                "angkatan": "2011",
                "ta": "2011/2012",
                "nm_semester": "GENAP",
                "alamat": "PURNAMA TUNGGAL.KEC WAY PENGUBUAN\r\nKAB LAMTENG",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Padang Ratu",
                "nm_kabupaten": "Kab. Lampung Tengah",
                "nm_propinsi": "Prop. Lampung",
                "ct": "1"
            },
            {
                "no_test": "R1100048",
                "npm": "1112120170",
                "tgldaftar": "2010-04-01 00:00:00",
                "nama": "DESI HANDAYANI",
                "jk": "Pr",
                "id_jurusan": "0212",
                "kdta": "20111",
                "tempatlahir": "PURNAMA TUNGGAL",
                "tgllahir": "1993-12-20 00:00:00",
                "angkatan": "2011",
                "ta": "2012/2013",
                "nm_semester": "GANJIL",
                "alamat": "PURNAMA TUNGGAL.KEC WAY PENGUBUAN\r\nKAB LAMTENG",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Padang Ratu",
                "nm_kabupaten": "Kab. Lampung Tengah",
                "nm_propinsi": "Prop. Lampung",
                "ct": "2"
            },
            {
                "no_test": "c1101195",
                "npm": "1111018009",
                "tgldaftar": "2012-03-28 14:53:00",
                "nama": "Dian Kurniawan",
                "jk": "Lk",
                "id_jurusan": "0101",
                "kdta": "20112",
                "tempatlahir": "Tanjung Karang",
                "tgllahir": "1984-01-07 00:00:00",
                "angkatan": "2011",
                "ta": "2013/2014",
                "nm_semester": "GENAP",
                "alamat": "Jl. Danau Sentani No. 9B",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Kedaton",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "3"
            },
            {
                "no_test": "c1101193",
                "npm": "1111058034",
                "tgldaftar": "2012-03-27 09:49:00",
                "nama": "Moch. Arven Capriza",
                "jk": "Lk",
                "id_jurusan": "0105",
                "kdta": "20112",
                "tempatlahir": "Bandar Lampung",
                "tgllahir": "1992-12-06 00:00:00",
                "angkatan": "2011",
                "ta": "2013/2014",
                "nm_semester": "GENAP",
                "alamat": "Jl. P. Sinopati Gg. Tamin Jati Mulyo Lampung Selatan",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Rajabasa",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "4"
            },
            {
                "no_test": "c1101191",
                "npm": "1111018008",
                "tgldaftar": "2012-03-15 11:32:00",
                "nama": "Parta Singaribu",
                "jk": "Lk",
                "id_jurusan": "0101",
                "kdta": "20112",
                "tempatlahir": "Baturaja",
                "tgllahir": "1985-04-04 00:00:00",
                "angkatan": "2011",
                "ta": "2014/2015",
                "nm_semester": "GENAP",
                "alamat": "Jl.Kasuari No7 Kemiling",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Kemiling",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "5"
            },
            {
                "no_test": "c1101188",
                "npm": "1112129018",
                "tgldaftar": "2012-03-09 14:24:00",
                "nama": "Irwansyah Putra",
                "jk": "Lk",
                "id_jurusan": "0212",
                "kdta": "20112",
                "tempatlahir": "BANDAR LAMPUNG",
                "tgllahir": "1986-11-13 00:00:00",
                "angkatan": "2011",
                "ta": "2015/2016",
                "nm_semester": "GENAP",
                "alamat": "Jl. P. Damar No.14 Sukarame",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Rajabasa",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "6"
            },
            {
                "no_test": "c1101186",
                "npm": "1111068001",
                "tgldaftar": "2012-03-09 09:07:00",
                "nama": "Apri Anto",
                "jk": "Lk",
                "id_jurusan": "0106",
                "kdta": "20112",
                "tempatlahir": "",
                "tgllahir": "1900-01-01 00:00:00",
                "angkatan": "2011",
                "ta": "2016/2017",
                "nm_semester": "GENAP",
                "alamat": "Jl. Bumi Manti II No.19 Bandarlampung",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Rajabasa",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "7"
            },
            {
                "no_test": "c1101183",
                "npm": "1111059010",
                "tgldaftar": "2012-03-08 13:56:00",
                "nama": "Deddy Nopriadi",
                "jk": "Lk",
                "id_jurusan": "0105",
                "kdta": "20112",
                "tempatlahir": "KETAPANG",
                "tgllahir": "1985-11-24 00:00:00",
                "angkatan": "2011",
                "ta": "2017/2018",
                "nm_semester": "GENAP",
                "alamat": "Jl. Sersan Laba Gole",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Kotabumi Selatan",
                "nm_kabupaten": "Kab. Lampung Utara",
                "nm_propinsi": "Prop. Lampung",
                "ct": "8"
            },
            {
                "no_test": "c1101182",
                "npm": "1112128006",
                "tgldaftar": "2012-03-08 13:28:00",
                "nama": "Rivo Febrianto Arleand",
                "jk": "Lk",
                "id_jurusan": "0212",
                "kdta": "20112",
                "tempatlahir": "BANDAR LAMPUNG",
                "tgllahir": "1987-02-01 00:00:00",
                "angkatan": "2011",
                "ta": "2019/2010",
                "nm_semester": "GENAP",
                "alamat": "Jl. Way Kanan No. 63 Pahoman",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Teluk Betung Selatan",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "9"
            },
            {
                "no_test": "c1101178",
                "npm": "1111018005",
                "tgldaftar": "2012-03-07 14:01:00",
                "nama": "Ayenah Kornelis",
                "jk": "Pr",
                "id_jurusan": "0101",
                "kdta": "20112",
                "tempatlahir": "Lampung",
                "tgllahir": "1987-08-18 00:00:00",
                "angkatan": "2011",
                "ta": "2020/2021",
                "nm_semester": "GENAP",
                "alamat": "Perum Bukit Kencana Blok S No. 1",
                "kelurahan": null,
                "nm_kecamatan": "Kec. Kemiling",
                "nm_kabupaten": "Kota Bandar Lampung",
                "nm_propinsi": "Prop. Lampung",
                "ct": "10"
            }]', true);
        $acc['accordion'][0]  =  accordion_view('Mahasiswa Aktif', $jsn, 'ta');
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('sections/chart', $chart);
        $this->load->view('sections/accordion', $acc);
        $this->load->view('layouts/footer', $chart);
    }
}
