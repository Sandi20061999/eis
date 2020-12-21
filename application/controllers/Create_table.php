<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('MAX_EXECUTION_TIME', '-1');
class Create_table extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('curl');
    }

    public function index($id = null)
    {
        // if ($id != null) {
        $getApi = $this->db->get_where('api', array('id >=' => '81', 'id <=' => '87'))->result_array();
        // } else {
        // $getApi = $this->db->get('api')->result_array();
        // }
        // var_dump($getApi);
        // die;
        foreach ($getApi as $gA) {
            $jD = json_decode($gA['jsonConfig'], TRUE);
            if ($this->db->table_exists("api_" . strtolower($gA['view_name']) . "_" . $gA['id'])) {
                echo "Tabel " . "api_" . strtolower($gA['view_name']) . "_" . $gA['id'] . " sudah ada.<br>Sedang melakukan update data<br>";
                $isi = $this->_api($gA['select'], $gA['view_name'], $gA['where'], $gA['limit'], $gA['order_by']);
                $jsonDecode = json_decode($isi, TRUE);
                if ($jsonDecode) {
                    foreach ($jsonDecode['data'] as $is) {
                        $par = [];
                        foreach ($jD['field'] as $field => $value) {
                            if (str_replace(' ', '_', $field) != 'id') {
                                // array_push($par, $field = $is[$field]);
                                $par[str_replace(' ', '_', $field)] = $is[$field];
                            }
                        }
                        // var_dump($par);
                        // die;
                        $cek = $this->db->get_where("api_" . strtolower($gA['view_name']) . "_" . $gA['id'], $par)->row_array();
                        if ($cek == null) {
                            $this->db->insert("api_" . strtolower($gA['view_name']) . "_" . $gA['id'], $par);
                            // echo "Berhasil menambah data " . json_encode($is) . "<br>";
                        } else {
                            $this->db->where($jD['keyForUpdate'], $par[$jD['keyForUpdate']]);
                            $this->db->update("api_" . strtolower($gA['view_name']) . "_" . $gA['id'], $par);
                            // echo "Berhasil merubah data " . json_encode($is) . "<br>";
                        }
                    }
                } else {
                    echo "Data api kosong";
                }
            } else {
                $isi = $this->_api($gA['select'], $gA['view_name'], $gA['where'], $gA['limit'], $gA['order_by']);
                $jsonDecode = json_decode($isi, TRUE);
                $isiku = $jsonDecode['data'];
                $this->dbforge->add_key($jD['key'], TRUE);
                $cuks = [];
                foreach ($jD['field'] as $field => $val) {
                    $cuks[str_replace(' ', '_', $field)] = $val;
                }
                $this->dbforge->add_field($cuks);
                $dan = [];
                foreach ($jsonDecode['data'] as $is) {
                    $par = [];
                    foreach ($jD['field'] as $field => $value) {
                        if (str_replace(' ', '_', $field) != 'idku') {
                            // array_push($par, $field = $is[$field]);
                            $par[str_replace(' ', '_', $field)] = $is[$field];
                        }
                    }
                    array_push($dan, $par);
                }
                $this->dbforge->create_table("api_" . strtolower($gA['view_name']) . "_" . $gA['id']);
                $in = $this->db->insert_batch("api_" . strtolower($gA['view_name']) . "_" . $gA['id'], $dan);
                echo "Berhasil membuat tabel " . "api_" . strtolower($gA['view_name']) . "_" . $gA['id'] . "<br> Sedang melakukan insert data<br>";
                if ($in) {
                    echo "Insert data berhasil ke tabel api_" . strtolower($gA['view_name'])  . "_" . $gA['id'] . "<br>";
                } else {
                    echo "Insert data gagal ke tabel api_" . strtolower($gA['view_name']) . "_" . $gA['id'] . "<br>";
                }
            }
        }
    }

    function _api($select, $view_name, $where, $limit, $order_by)
    {

        $datapost = [
            "select" => $select,
            "view_name" => $view_name,
            "where" => $where,
            "limit" => $limit,
            "order_by" => $order_by
        ];
        $getmhs = getAPIKU($datapost);
        return $getmhs;
    }

    function formatscroll()
    {
        $by = 1;
        $api = $this->db->get_where('api', ['id' => '24'])->result_array();
        foreach ($api as $a) {
            $per = [
                'title' => $a['name'],
                'url' => md5($a['name']),
                'is_active' => 1,
                'by' => $by,
                'pict' => 'def'
            ];
            $this->db->insert('sub_menu', $per);
            echo "Berhasil membuat sub menu<br>";
            $cek = $this->db->order_by('id', 'DESC')->get('sub_menu')->row_array();
            // $sub_id = $this->db->insert_id();
            //braedcrumb
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => '1', 'is_active' => '1', 'by' => '1']);
            $by++;
            $jur = [
                array(
                    "id_jurusan" => "0101",
                    "nm_jurusan" => "TI"
                ),
                array(
                    "id_jurusan" => "0102",
                    "nm_jurusan" => "TK"
                ),
                array(
                    "id_jurusan" => "0103",
                    "nm_jurusan" => "MI"
                ),
                array(
                    "id_jurusan" => "0105",
                    "nm_jurusan" => "SI"
                ),
                array(
                    "id_jurusan" => "0106",
                    "nm_jurusan" => "SK"
                ),
                array(
                    "id_jurusan" => "0107",
                    "nm_jurusan" => "DKV"
                ),
                array(
                    "id_jurusan" => "0121",
                    "nm_jurusan" => "MTI"
                ),
                array(
                    "id_jurusan" => "0211",
                    "nm_jurusan" => "MA"
                ),
                array(
                    "id_jurusan" => "0214",
                    "nm_jurusan" => "BD"
                ),
                array(
                    "id_jurusan" => "0231",
                    "nm_jurusan" => "MM"
                ),
                array(
                    "id_jurusan" => "0212",
                    "nm_jurusan" => "AKT S1"
                ),
                array(
                    "id_jurusan" => "0213",
                    "nm_jurusan" => "AKT D3"
                )
            ];
            $for = [
                'type' => 'scroll',
                'name' => 'Jumlah MHS ' . $a['name'],
                'data' => []
            ];
            $is = [];
            foreach ($jur as $j) {
                $arr = [
                    'type' => 'card',
                    'name' => 'Card ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'title' => 'Jumlah ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'width' => 4,
                    'icon' => 'fa fa-users',
                    'color' => '#3f48cc',
                    'detail' => 'KDTA 20201',
                    'api_id' => $a['id'],
                    'data' => [
                        'table' => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                        'where' => [
                            'id_jurusan' => $j['id_jurusan']
                        ],
                        'default_where' => [
                            'kdta' => '20201'
                        ],
                        'default_value' => '20201',
                        'groupby' => 'kdta',
                        'count' => 'row', // value untuk keuangan
                        // 'field' => 'value' // untuk count isi fieldnya    
                    ]
                ];
                array_push($is, $arr);
            }
            $for['data'] = $is;
            $satu = json_encode($for);
            //view
            $this->db->insert('view', ['jsonFile' => $satu]);
            $view1 = $this->db->order_by('id', 'DESC')->get('view')->row_array();

            // $view1 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view1['id'], 'is_active' => '1', 'by' => '2']);

            $for1 = [
                'type' => 'scroll',
                'name' => 'Total biaya ' . $a['name'],
                'data' => []
            ];
            $is1 = [];
            foreach ($jur as $j) {
                $arr1 = [
                    'type' => 'card',
                    'name' => 'Card ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'title' => 'Total ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'width' => 4,
                    'icon' => 'fa fa-money',
                    'color' => '#3f48cc',
                    'detail' => 'KDTA 20201',
                    'api_id' => $a['id'],
                    'data' => [
                        'table' => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                        'where' => [
                            'id_jurusan' => $j['id_jurusan']
                        ],
                        'default_where' => [
                            'kdta' => '20201'
                        ],
                        'default_value' => '20201',
                        'groupby' => 'kdta',
                        'count' => 'value', // value untuk keuangan
                        'selector' => ['total'] // untuk count isi fieldnya    
                    ]
                ];
                array_push($is1, $arr1);
            }
            $for1['data'] = $is1;
            // var_dump($for);
            $dua = json_encode($for1);
            $this->db->insert('view', ['jsonFile' => $dua]);
            $view2 = $this->db->order_by('id', 'DESC')->get('view')->row_array();
            // $view2 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view2['id'], 'is_active' => '1', 'by' => '3']);


            //chart
            $cha = [
                "type" => "chart",
                "name" => "Chart " . $a['name'],
                "title" => "Grafik Total " . $a['name'],
                "width" => 12,
                "data" => []
            ];
            $cas = [];
            foreach ($jur as $j) {
                $ca = [
                    "name" => "Total " . $a['name'] . ' ' . $j['nm_jurusan'],
                    "table" => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                    "where" => [
                        "id_jurusan" => $j['id_jurusan']
                    ],
                    "default_where" => [],
                    "groupby" => "kdta",
                    "count" => "value",
                    "selector" => "total"
                ];
                array_push($cas, $ca);
            }
            $cha['data'] = $cas;
            $tiga = json_encode($cha);
            $this->db->insert('view', ['jsonFile' => $tiga]);
            $view3 = $this->db->order_by('id', 'DESC')->get('view')->row_array();
            // $view3 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view3['id'], 'is_active' => '1', 'by' => '4']);
            $this->db->insert('menu_access_sub_menu', ['menu_id' => '16', 'sub_menu_id' => $cek['id']]);

            $cuks = $this->db->order_by('id', 'DESC')->get('menu_access_sub_menu')->row_array();

            $this->db->insert('role_access_menu_sub_menu', ['role_id' => '12', 'menu_access_sub_menu_id' => $cuks['id']]);
            // echo json_encode($cha);
            // die;
        }
    }

    function formattot()
    {
        $by = 1;
        $api = $this->db->get_where('api', ['id' => '22'])->result_array();
        foreach ($api as $a) {
            $per = [
                'title' => $a['name'],
                'url' => md5($a['name'] . '_all'),
                'is_active' => 1,
                'by' => $by,
                'pict' => 'def'
            ];
            $this->db->insert('sub_menu', $per);
            echo "Berhasil membuat sub menu<br>";
            $cek = $this->db->order_by('id', 'DESC')->get('sub_menu')->row_array();
            // $sub_id = $this->db->insert_id();
            //braedcrumb
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => '1', 'is_active' => '1', 'by' => '1']);
            $by++;

            $arr = [
                'type' => 'card',
                'name' => 'Card ' . $a['name'] . " all",
                'title' => 'Jumlah ' . $a['name'],
                'width' => 6,
                'icon' => 'fa fa-users',
                'color' => '#3f48cc',
                'detail' => 'KDTA 20201',
                'api_id' => $a['id'],
                'data' => [
                    'table' => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                    'where' => [],
                    'default_where' => [
                        'kdta' => '20201'
                    ],
                    'default_value' => '20201',
                    'groupby' => 'kdta',
                    'count' => 'row', // value untuk keuangan
                    // 'field' => 'value' // untuk count isi fieldnya    
                ]
            ];
            $satu = json_encode($arr);
            //view
            $this->db->insert('view', ['jsonFile' => $satu]);
            $view1 = $this->db->order_by('id', 'DESC')->get('view')->row_array();

            // $view1 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view1['id'], 'is_active' => '1', 'by' => '2']);

            $arr1 = [
                'type' => 'card',
                'name' => 'Card ' . $a['name'] . " all",
                'title' => 'Total ' . $a['name'],
                'width' => 6,
                'icon' => 'fa fa-money',
                'color' => '#3f48cc',
                'detail' => 'KDTA 20201',
                'api_id' => $a['id'],
                'data' => [
                    'table' => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                    'where' => [],
                    'default_where' => [
                        'kdta' => '20201'
                    ],
                    'default_value' => '20201',
                    'groupby' => 'kdta',
                    'count' => 'value', // value untuk keuangan
                    'selector' => ['total'] // untuk count isi fieldnya    
                ]
            ];

            $dua = json_encode($arr1);
            $this->db->insert('view', ['jsonFile' => $dua]);
            $view2 = $this->db->order_by('id', 'DESC')->get('view')->row_array();
            // $view2 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view2['id'], 'is_active' => '1', 'by' => '3']);


            //chart
            $cha = [
                "type" => "chart",
                "name" => "Chart " . $a['name'] . " all",
                "title" => "Grafik Total " . $a['name'],
                "width" => 12,
                "data" => []
            ];
            $rr = [
                "name" => "Total " . $a['name'],
                "table" => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                "where" => [],
                "default_where" => [],
                "groupby" => "kdta",
                "count" => "value",
                "selector" => "total"
            ];
            array_push($cha['data'], $rr);
            $tiga = json_encode($cha);
            $this->db->insert('view', ['jsonFile' => $tiga]);
            $view3 = $this->db->order_by('id', 'DESC')->get('view')->row_array();
            // $view3 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view3['id'], 'is_active' => '1', 'by' => '4']);

            $this->db->insert('menu_access_sub_menu', ['menu_id' => '8', 'sub_menu_id' => $cek['id']]);

            $cuks = $this->db->order_by('id', 'DESC')->get('menu_access_sub_menu')->row_array();

            $this->db->insert('role_access_menu_sub_menu', ['role_id' => '12', 'menu_access_sub_menu_id' => $cuks['id']]);
            // echo json_encode($cha);
            // die;
        }
    }

    function formatlulus()
    {
        $jur = [
            array(
                "id_jurusan" => "0101",
                "nm_jurusan" => "TI"
            ),
            array(
                "id_jurusan" => "0102",
                "nm_jurusan" => "TK"
            ),
            array(
                "id_jurusan" => "0103",
                "nm_jurusan" => "MI"
            ),
            array(
                "id_jurusan" => "0105",
                "nm_jurusan" => "SI"
            ),
            array(
                "id_jurusan" => "0106",
                "nm_jurusan" => "SK"
            ),
            array(
                "id_jurusan" => "0107",
                "nm_jurusan" => "DKV"
            ),
            array(
                "id_jurusan" => "0121",
                "nm_jurusan" => "MTI"
            ),
            array(
                "id_jurusan" => "0211",
                "nm_jurusan" => "MA"
            ),
            array(
                "id_jurusan" => "0214",
                "nm_jurusan" => "BD"
            ),
            array(
                "id_jurusan" => "0231",
                "nm_jurusan" => "MM"
            ),
            array(
                "id_jurusan" => "0212",
                "nm_jurusan" => "AKT S1"
            ),
            array(
                "id_jurusan" => "0213",
                "nm_jurusan" => "AKT D3"
            )
        ];
        $cha = [
            "type" => "chart",
            "name" => "Chart MHS lulus per angkatan",
            "title" => "Grafik Perbandingan Mahasiswa Lulus Per Angkatan ",
            "width" => 12,
            "data" => []
        ];
        $cas = [];
        foreach ($jur as $j) {
            $ca = [
                "name" => "Jumlah Mahasiswa Lulus " . $j['nm_jurusan'],
                "table" => 'api_eis_prodi_mahasiswalulus_perangkatan',
                "where" => [
                    "id_jurusan" => $j['id_jurusan']
                ],
                "default_where" => [],
                "groupby" => "angkatan",
                "count" => "row"
            ];
            array_push($cas, $ca);
        }
        $cha['data'] = $cas;
        $tiga = json_encode($cha);
        $this->db->insert('view', ['jsonFile' => $tiga]);
    }

    function formatpendaftar()
    {
        $jur = [
            array(
                "id_jurusan" => "0101",
                "nm_jurusan" => "TI"
            ),
            array(
                "id_jurusan" => "0102",
                "nm_jurusan" => "TK"
            ),
            array(
                "id_jurusan" => "0103",
                "nm_jurusan" => "MI"
            ),
            array(
                "id_jurusan" => "0105",
                "nm_jurusan" => "SI"
            ),
            array(
                "id_jurusan" => "0106",
                "nm_jurusan" => "SK"
            ),
            array(
                "id_jurusan" => "0107",
                "nm_jurusan" => "DKV"
            ),
            array(
                "id_jurusan" => "0121",
                "nm_jurusan" => "MTI"
            ),
            array(
                "id_jurusan" => "0211",
                "nm_jurusan" => "MA"
            ),
            array(
                "id_jurusan" => "0214",
                "nm_jurusan" => "BD"
            ),
            array(
                "id_jurusan" => "0231",
                "nm_jurusan" => "MM"
            ),
            array(
                "id_jurusan" => "0212",
                "nm_jurusan" => "AKT S1"
            ),
            array(
                "id_jurusan" => "0213",
                "nm_jurusan" => "AKT D3"
            )
        ];
        $cha = [
            "type" => "chart",
            "name" => "Chart MHS Pendaftar",
            "title" => "Grafik Perbandingan Pendaftar",
            "width" => 12,
            "data" => []
        ];
        $cas = [];
        foreach ($jur as $j) {
            $ca = [
                "name" => "Jumlah Pendaftar " . $j['nm_jurusan'],
                "table" => 'api_eis_prodi_pendaftar',
                "where" => [
                    "id_jurusan" => $j['id_jurusan']
                ],
                "default_where" => [],
                "groupby" => "ta",
                "count" => "row"
            ];
            array_push($cas, $ca);
        }
        $cha['data'] = $cas;
        $tiga = json_encode($cha);
        $this->db->insert('view', ['jsonFile' => $tiga]);
    }

    function formatdaftarulang()
    {
        $jur = [
            array(
                "id_jurusan" => "0101",
                "nm_jurusan" => "TI"
            ),
            array(
                "id_jurusan" => "0102",
                "nm_jurusan" => "TK"
            ),
            array(
                "id_jurusan" => "0103",
                "nm_jurusan" => "MI"
            ),
            array(
                "id_jurusan" => "0105",
                "nm_jurusan" => "SI"
            ),
            array(
                "id_jurusan" => "0106",
                "nm_jurusan" => "SK"
            ),
            array(
                "id_jurusan" => "0107",
                "nm_jurusan" => "DKV"
            ),
            array(
                "id_jurusan" => "0121",
                "nm_jurusan" => "MTI"
            ),
            array(
                "id_jurusan" => "0211",
                "nm_jurusan" => "MA"
            ),
            array(
                "id_jurusan" => "0214",
                "nm_jurusan" => "BD"
            ),
            array(
                "id_jurusan" => "0231",
                "nm_jurusan" => "MM"
            ),
            array(
                "id_jurusan" => "0212",
                "nm_jurusan" => "AKT S1"
            ),
            array(
                "id_jurusan" => "0213",
                "nm_jurusan" => "AKT D3"
            )
        ];
        $cha = [
            "type" => "chart",
            "name" => "Chart MHS Pendaftar Daftar Ulang Berdasarkan Wilayah",
            "title" => "Grafik Perbandingan Pendaftar Daftar Ulang Berdasarkan Wilayah",
            "width" => 12,
            "data" => []
        ];
        $cas = [];
        foreach ($jur as $j) {
            $ca = [
                "name" => "Jumlah Pendaftar Daftar Ulang " . $j['nm_jurusan'] . " Berdasarkan Wilayah",
                "table" => 'api_eis_prodi_daftarulang',
                "where" => [
                    "id_jurusan" => $j['id_jurusan']
                ],
                "default_where" => [],
                "groupby" => "nm_kabupaten",
                "count" => "row"
            ];
            array_push($cas, $ca);
        }
        $cha['data'] = $cas;
        $tiga = json_encode($cha);
        $this->db->insert('view', ['jsonFile' => $tiga]);
    }


    function sub_menu()
    {
        $jur = [
            array(
                "id_jurusan" => "0101",
                "nm_jurusan" => "TI"
            ),
            array(
                "id_jurusan" => "0102",
                "nm_jurusan" => "TK"
            ),
            array(
                "id_jurusan" => "0103",
                "nm_jurusan" => "MI"
            ),
            array(
                "id_jurusan" => "0105",
                "nm_jurusan" => "SI"
            ),
            array(
                "id_jurusan" => "0106",
                "nm_jurusan" => "SK"
            ),
            array(
                "id_jurusan" => "0107",
                "nm_jurusan" => "DKV"
            ),
            array(
                "id_jurusan" => "0121",
                "nm_jurusan" => "MTI"
            ),
            array(
                "id_jurusan" => "0211",
                "nm_jurusan" => "MA"
            ),
            array(
                "id_jurusan" => "0214",
                "nm_jurusan" => "BD"
            ),
            array(
                "id_jurusan" => "0231",
                "nm_jurusan" => "MM"
            ),
            array(
                "id_jurusan" => "0212",
                "nm_jurusan" => "AKT S1"
            ),
            array(
                "id_jurusan" => "0213",
                "nm_jurusan" => "AKT D3"
            )
        ];
        $by = 3;
        foreach ($jur as $j) {
            $par = [
                'title' => 'Pendaftar ' . $j['nm_jurusan'],
                'url' => md5($j['nm_jurusan'] . 'hahlembur'),
                'icon' => 'kosong',
                'is_active' => '1',
                'by' => $by,
                'pict' => 'kosong'
            ];
            $this->db->insert('sub_menu', $par);
            $cek = $this->db->order_by('id', 'DESC')->get('sub_menu')->row_array();
            // $sub_id = $this->db->insert_id();
            //braedcrumb
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => '1', 'is_active' => '1', 'by' => '1']);
            $by++;
        }
    }


    function formatsdm()
    {
        $by = 1;
        $api = $this->db->get_where('api', ['id >=' => '81', 'id <=' => '87'])->result_array();
        foreach ($api as $a) {
            $per = [
                'title' => $a['name'],
                'url' => md5($a['name'] . '_all'),
                'is_active' => 1,
                'by' => $by,
                'pict' => 'def'
            ];
            $this->db->insert('sub_menu', $per);
            echo "Berhasil membuat sub menu<br>";
            $cek = $this->db->order_by('id', 'DESC')->get('sub_menu')->row_array();
            // $sub_id = $this->db->insert_id();
            //braedcrumb
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => '1', 'is_active' => '1', 'by' => '1']);
            $by++;

            $arr = [
                'type' => 'card',
                'name' => 'Card ' . $a['name'] . " all",
                'title' => 'Jumlah ' . $a['name'],
                'width' => 12,
                'icon' => 'fa fa-users',
                'color' => '#3f48cc',
                'detail' => 'KDTA 20201',
                'api_id' => $a['id'],
                'data' => [
                    'table' => 'api_' . strtolower($a['view_name']) . '_' . $a['id'],
                    'where' => [],
                    'default_where' => [
                        'kdta' => '20201'
                    ],
                    'default_value' => '20201',
                    'groupby' => 'kdta',
                    'count' => 'row', // value untuk keuangan
                    // 'field' => 'value' // untuk count isi fieldnya    
                ]
            ];
            $satu = json_encode($arr);
            //view
            $this->db->insert('view', ['jsonFile' => $satu]);
            $view1 = $this->db->order_by('id', 'DESC')->get('view')->row_array();

            // $view1 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view1['id'], 'is_active' => '1', 'by' => '2']);

            // echo json_encode($cha);
            // die;
        }
    }

    function formatscrollfilkom()
    {
        $by = 1;
        $api = $this->db->get_where('api', ['id >=' => '6', 'id <=' => '6'])->result_array();
        foreach ($api as $a) {
            $per = [
                'title' => $a['name'] . ' FILKOM',
                'url' => md5($a['name']),
                'is_active' => 1,
                'by' => $by,
                'pict' => 'def'
            ];
            $this->db->insert('sub_menu', $per);
            echo "Berhasil membuat sub menu<br>";
            $cek = $this->db->order_by('id', 'DESC')->get('sub_menu')->row_array();
            // $sub_id = $this->db->insert_id();
            //braedcrumb
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => '1', 'is_active' => '1', 'by' => '1']);
            $by++;
            $jur = [
                array(
                    "id_jurusan" => "0101",
                    "nm_jurusan" => "TI"
                ),
                array(
                    "id_jurusan" => "0102",
                    "nm_jurusan" => "TK"
                ),
                array(
                    "id_jurusan" => "0103",
                    "nm_jurusan" => "MI"
                ),
                array(
                    "id_jurusan" => "0105",
                    "nm_jurusan" => "SI"
                ),
                array(
                    "id_jurusan" => "0106",
                    "nm_jurusan" => "SK"
                ),
                array(
                    "id_jurusan" => "0107",
                    "nm_jurusan" => "DKV"
                ),
                array(
                    "id_jurusan" => "0121",
                    "nm_jurusan" => "MTI"
                )
            ];
            $for = [
                'type' => 'scroll',
                'name' => 'Jumlah MHS ' . $a['name'] . ' FILKOM',
                'data' => []
            ];
            $is = [];
            foreach ($jur as $j) {
                $arr = [
                    'type' => 'card',
                    'name' => 'Card ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'title' => 'Jumlah ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'width' => 4,
                    'icon' => 'fa fa-users',
                    'color' => '#3f48cc',
                    'detail' => 'Tahun Lulus 2019/2020',
                    'api_id' => $a['id'],
                    // 'withDetail' => [
                    //     'api_id' => 20,
                    //     'selector' => 'npm'
                    // ],
                    'data' => [
                        'table' => 'api_' . strtolower($a['view_name']),
                        'where' => [
                            'id_jurusan' => $j['id_jurusan']
                        ],
                        'default_where' => [
                            'Tahun_Lulus' => '2019/2020'
                        ],
                        'default_value' => '2019/2020',
                        'groupby' => 'Tahun_Lulus',
                        'count' => 'row', // value untuk keuangan
                        // 'field' => 'value' // untuk count isi fieldnya    
                    ]
                ];
                array_push($is, $arr);
            }
            $for['data'] = $is;
            $satu = json_encode($for);
            //view
            $this->db->insert('view', ['jsonFile' => $satu]);
            $view1 = $this->db->order_by('id', 'DESC')->get('view')->row_array();

            // $view1 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view1['id'], 'is_active' => '1', 'by' => '2']);

            //chart
            $cha = [
                "type" => "chart",
                "name" => "Chart " . $a['name'] . ' FILKOM',
                "title" => "Grafik Jumlah " . $a['name'] . " FILKOM",
                "width" => 12,
                "data" => []
            ];
            $cas = [];
            foreach ($jur as $j) {
                $ca = [
                    "name" => "Total " . $a['name'] . ' ' . $j['nm_jurusan'],
                    "table" => 'api_' . strtolower($a['view_name']),
                    "where" => [
                        "id_jurusan" => $j['id_jurusan']
                    ],
                    "default_where" => [],
                    "groupby" => "Tahun_Lulus",
                    "count" => "row"
                ];
                array_push($cas, $ca);
            }
            $cha['data'] = $cas;
            $tiga = json_encode($cha);
            $this->db->insert('view', ['jsonFile' => $tiga]);
            $view3 = $this->db->order_by('id', 'DESC')->get('view')->row_array();
            // $view3 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view3['id'], 'is_active' => '1', 'by' => '3']);
            $this->db->insert('menu_access_sub_menu', ['menu_id' => '5', 'sub_menu_id' => $cek['id']]);

            $cuks = $this->db->order_by('id', 'DESC')->get('menu_access_sub_menu')->row_array();

            $this->db->insert('role_access_menu_sub_menu', ['role_id' => '13', 'menu_access_sub_menu_id' => $cuks['id']]);
            // echo json_encode($cha);
            // die;
        }
    }

    function formatscrollfeb()
    {
        $by = 1;
        $api = $this->db->get_where('api', ['id >=' => '14', 'id <=' => '14'])->result_array();
        foreach ($api as $a) {
            $per = [
                'title' => $a['name'] . ' FEB',
                'url' => md5($a['name']) . 'FEB',
                'is_active' => 1,
                'by' => $by,
                'pict' => 'def'
            ];
            $this->db->insert('sub_menu', $per);
            echo "Berhasil membuat sub menu<br>";
            $cek = $this->db->order_by('id', 'DESC')->get('sub_menu')->row_array();
            // $sub_id = $this->db->insert_id();
            //braedcrumb
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => '1', 'is_active' => '1', 'by' => '1']);
            $by++;
            $jur = [
                array(
                    "id_jurusan" => "0211",
                    "nm_jurusan" => "MA"
                ),
                array(
                    "id_jurusan" => "0214",
                    "nm_jurusan" => "BD"
                ),
                array(
                    "id_jurusan" => "0231",
                    "nm_jurusan" => "MM"
                ),
                array(
                    "id_jurusan" => "0212",
                    "nm_jurusan" => "AKT S1"
                ),
                array(
                    "id_jurusan" => "0213",
                    "nm_jurusan" => "AKT D3"
                )
            ];
            $for = [
                'type' => 'scroll',
                'name' => 'Jumlah MHS ' . $a['name'] . ' FEB',
                'data' => []
            ];
            $is = [];
            foreach ($jur as $j) {
                $arr = [
                    'type' => 'card',
                    'name' => 'Card ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'title' => 'Jumlah ' . $a['name'] . ' ' . $j['nm_jurusan'],
                    'width' => 4,
                    'icon' => 'fa fa-users',
                    'color' => '#3f48cc',
                    'detail' => 'Angkatan 2020',
                    'api_id' => $a['id'],
                    'withDetail' => [
                        'api_id' => 20,
                        'selector' => 'npm'
                    ],
                    'data' => [
                        'table' => 'api_' . strtolower($a['view_name']),
                        'where' => [
                            'id_jurusan' => $j['id_jurusan']
                        ],
                        'default_where' => [
                            'angkatan' => '2020'
                        ],
                        'default_value' => '2020',
                        'groupby' => 'angkatan',
                        'count' => 'row', // value untuk keuangan
                        // 'field' => 'value' // untuk count isi fieldnya    
                    ]
                ];
                array_push($is, $arr);
            }
            $for['data'] = $is;
            $satu = json_encode($for);
            //view
            $this->db->insert('view', ['jsonFile' => $satu]);
            $view1 = $this->db->order_by('id', 'DESC')->get('view')->row_array();

            // $view1 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view1['id'], 'is_active' => '1', 'by' => '2']);

            //chart
            $cha = [
                "type" => "chart",
                "name" => "Chart " . $a['name'] . ' FEB',
                "title" => "Grafik Jumlah " . $a['name'] . " FEB",
                "width" => 12,
                "data" => []
            ];
            $cas = [];
            foreach ($jur as $j) {
                $ca = [
                    "name" => "Total " . $a['name'] . ' ' . $j['nm_jurusan'],
                    "table" => 'api_' . strtolower($a['view_name']),
                    "where" => [
                        "id_jurusan" => $j['id_jurusan']
                    ],
                    "default_where" => [],
                    "groupby" => "angkatan",
                    "count" => "row"
                ];
                array_push($cas, $ca);
            }
            $cha['data'] = $cas;
            $tiga = json_encode($cha);
            $this->db->insert('view', ['jsonFile' => $tiga]);
            $view3 = $this->db->order_by('id', 'DESC')->get('view')->row_array();
            // $view3 = $this->db->insert_id();
            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $cek['id'], 'view_id' => $view3['id'], 'is_active' => '1', 'by' => '3']);
            $this->db->insert('menu_access_sub_menu', ['menu_id' => '2', 'sub_menu_id' => $cek['id']]);

            $cuks = $this->db->order_by('id', 'DESC')->get('menu_access_sub_menu')->row_array();

            $this->db->insert('role_access_menu_sub_menu', ['role_id' => '14', 'menu_access_sub_menu_id' => $cuks['id']]);
            // echo json_encode($cha);
            // die;
        }
    }
}
