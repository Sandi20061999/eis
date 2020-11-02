<?php

use Jajo\JSONDB;

use function PHPSTORM_META\type;

class Core_system extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_access_menu_model');
        $this->load->model('User_access_sub_menu_model');
        $this->load->model('Core_system_model');
    }
    function index($uid)
    {
        $data['menu'] = $this->db->join('menu', 'menu.id=role_access_menu.menu_id')->get_where('role_access_menu', array('role_id' => $this->session->userdata('role_id')))->result_array();
        $data['subMenu'] = $this->db->join('sub_menu', 'sub_menu.id=role_access_sub_menu.sub_menu_id')->get_where('role_access_sub_menu', array('role_id' => $this->session->userdata('role_id')))->result_array();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $getView = $this->Core_system_model->getView('core_system/index/' . $uid);
        $cfoo = array();
        $au = 0;
        foreach ($getView as $gV) {
            if ($gV['type'] == 'card') {
                $fil = json_decode($gV['cardFilter'], TRUE);
                if ($gV['jsonFile'] == null) {
                    $dataValue = $this->_api($gV['select'], $gV['view_name'], $gV['where'], $gV['limit'], $gV['order_by']);
                    $json_db = new JSONDB($dataValue);
                    $users = $json_db->select($fil['filter'])
                        ->from()
                        ->where($fil['where'], 'AND')
                        ->get();
                } else {
                    $json_db = new JSONDB($gV['jsonFile']);
                    $users = $json_db->select($fil['filter'])
                        ->from()
                        ->where($fil['where'], 'AND')
                        ->get();
                }
                if ($fil['by'] == null) {
                    $count = count($users);
                } else {
                    $goblok = [];
                    foreach ($users as $us) {
                        $goblok[] = $us[$fil['by']];
                    }
                    $count = rupiah(array_sum($goblok));
                }
                $cd = [
                    'title' => $gV['cardTitle'],
                    'width' => $gV['cardWidth'], // lebar 1 - 12 default 12
                    'nilai' => $count, // value 
                    'detail' => $gV['cardDetail'], // detail *optional
                    'icon' => $gV['cardIcon'], // icon fontawesomw fa fa-user
                    'color' => $gV['cardColor'], // primary,danger,success,warning,red,blue,green.yellow,purple,white
                ];
                $card['card'] = card($cd);
                $this->load->view('sections/card', $card);
            }
            if ($gV['type'] == 'chart-parent') {
                $cuk = $gV['chartChildrenId'];
                $datasetf = [];
                $labels = [];
                foreach (json_decode($cuk, TRUE) as $c) {
                    $children = $this->db->get_where('api', array('id' => $c))->row_array();
                    if ($children['jsonFile'] == null) {
                        $dataValue = $this->_api($gV['select'], $gV['view_name'], $gV['where'], $gV['limit'], $gV['order_by']);
                    } else {
                        $dataValue = $children['jsonFile'];
                    }
                    $fil = json_decode($gV['chartFilter'], TRUE);
                    $json_db = new JSONDB($dataValue);
                    if ($labels == null) {
                        $array = $json_db->select($fil['filter'])
                            ->from()
                            ->where($fil['where'], 'AND')
                            ->get();
                        $tempArr = array_unique(array_column($array, $fil['filter']));
                        $l = array_intersect_key($array, $tempArr);
                        foreach ($l as $to) {
                            array_push($labels, $to[$fil['filter']]);
                        }
                    }
                    $dataset = [];
                    sort($labels);
                    foreach ($labels as $kuy) {
                        $dot = $json_db->select('*')
                            ->from()
                            ->where(array_merge($fil['where'], [$fil['filter'] => $kuy]), 'AND')
                            ->get();
                        if ($fil['by'] == null) {
                            $count = count($dot);
                        } else {
                            
                            $goblok = [];
                            foreach ($dot as $us) {
                                $goblok[] = $us[$fil['by']];
                            }
                            $count =array_sum($goblok);
                        }
                        $jum = $count;
                        array_push($dataset, $jum);
                    }
                    // var_dump($dataset);
                    // die;
                    $rand_color = '#' . substr(md5(mt_rand()), 0, 6);
                    $tete = [
                        'backgroundColor' => $rand_color,
                        'borderColor' => $rand_color,
                        'fill' => false,
                        'label' => $children['name'],
                        'data' => $dataset
                    ];
                    array_push($datasetf, $tete);
                }
                $data = [
                    'labels' => $labels,
                    'datasets' => $datasetf
                ];
                $options = [
                    'title' => [
                        'display' => true,
                        'text' => $gV['chartTitle']
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
                    ]
                ];
                $test['chart'] = chart('test' . $rand_color, $gV['chartType'], $data, $options, $gV['chartWidth']);
                $this->load->view('sections/chart', $test);
            }
            if ($gV['type'] == 'accordion-table') {
                $filter = json_decode($gV['accordionTablePer'], TRUE);
                if ($gV['jsonFile'] == null) {
                    $dataValue = $this->_api($gV['select'], $gV['view_name'], $gV['where'], $gV['limit'], $gV['order_by']);
                    $json_db = new JSONDB($dataValue);
                    $users = $json_db->select('*')
                        ->from()
                        ->where($filter['where'], 'AND')
                        ->get();
                } else {
                    $json_db = new JSONDB($gV['jsonFile']);
                    $users = $json_db->select('*')
                        ->from()
                        ->where($filter['where'], 'AND')
                        ->get();
                }
                $acc['accordion']  =  accordion_view($gV['accordionTableTitle'], $users, $filter['filter'], $gV['id']);
                $this->load->view('sections/accordion', $acc);
            }
            if ($gV['type'] == 'table') {
                $filter = json_decode($gV['tableFilter'], TRUE);
                if ($gV['jsonFile'] == null) {
                    $dataValue = $this->_api($gV['select'], $gV['view_name'], $gV['where'], $gV['limit'], $gV['order_by']);
                    $json_db = new JSONDB($dataValue);
                    $users = $json_db->select('*')
                        ->from()
                        ->where($filter, 'AND')
                        ->get();
                } else {
                    $json_db = new JSONDB($gV['jsonFile']);
                    $users = $json_db->select('*')
                        ->from()
                        ->where($filter, 'AND')
                        ->get();
                }
                $acc['title'] = $gV['tableTitle'];
                $acc['table']  =  table_view($users);
                $this->load->view('sections/table', $acc);
            }
            $au++;
        }
        $val['javascript'] = $cfoo;
        $this->load->view('layouts/footer', $val);
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
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        return json_decode($getmhs, true);
    }
}
