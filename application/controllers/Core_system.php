<?php

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
        $data['menu'] = $this->User_access_menu_model->get_all_user_access_menu($this->session->userdata('user_id'));
        $data['subMenu'] = $this->User_access_sub_menu_model->get_all_user_access_sub_menu($this->session->userdata('user_id'));
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar', $data);
        $cd = [
            //card properti 
            //format  'properti' => 'nilai'
            'title' => 'Ini Judul',
            'width' => '9', // lebar 1 - 12 default 12
            'nilai' => '100', // value 
            'detail' => 'Ini Detail', // detail *optional
            'icon' => 'fa-user', // icon fontawesomw fa fa-user
            'color' => 'primary', // primary,danger,success,warning,red,blue,green.yellow,purple,white
        ];
        $cd1 = [
            'title' => 'Ini Judul 2',
            'width' => '3',
            'nilai' => '50',
            'detail' => 'Ini Detail 2',
            'icon' => 'fa-user',
            'color' => 'danger',
        ];
        $card['card'] = [card($cd), card($cd1)];
        $this->load->view('sections/card', $card);
        $ct =  json_decode('[
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
        // $dt = [
        //     //fromat 'Judul' => [isi1,isi2,dst] isi fungsi helprt / tag html
        //     'Home' => [card($cd)], //panggil helper card array bentuknya
        //     'Dashboard' => [card($cd1), card($cd)], //array biar bisa beberapa konten di dalam 1 tab
        //     'Profil' => [table_view($ct)],
        // ];
        // $tab['tab'] = tab($dt);
        // $this->load->view('sections/tab', $tab);
        $getView = $this->Core_system_model->getView('core_system/index/' . $uid);
        $cfoo = array();
        $au = 0;
        foreach ($getView as $gV) {
            if ($gV['type'] == 'header') {
                $hd['size'] = $gV['sizeText'];
                $hd['title'] = $gV['headerTitle'];
                $this->load->view('sections/header', $hd);
            }
            if ($gV['type'] == 'accordion-table') {
                if ($gV['jsonFile'] == null) {
                    $dataValue = $this->_api($gV['select'], $gV['view_name'], $gV['where'], $gV['limit'], $gV['order_by']);
                } else {
                    $dataValue = $gV['jsonFile'];
                }
                $acc['accordion']  =  accordion_view($gV['accordionTableTitle'], $dataValue, $gV['accordionTablePer'], $au);
                $this->load->view('sections/accordion', $acc);
            }
            if ($gV['type'] == 'morris-line-chart') {
                $cl = ['0' => '#4d7cff', '1' => '#45fda5'];
                $label = ['0' => 'Jumlah', '1' => 'Bukan'];
                $key = [
                    'x' => 'bilangan',
                    'y' => $label,
                    'color' => $cl,
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

                ob_start();
                $cku = '$(function() {"use strict"; ';
                $cku .= morris_chart($key, $datacoba, 'morris-line-chart', $au);
                $cku .= '});';
                echo $cku;
                $contents = ob_get_contents();
                array_push($cfoo, $contents);
                ob_end_clean();
                $cbu['title'] = 'Grafik Jumlah Pendaftar Per Tahun Ajaran';
                $cbu['id'] = 'morris-line-chart' . $au;
                $cbu['color'] = $cl;
                $cbu['lable'] = $label;
                $this->load->view('sections/chart', $cbu);
            }
            $au++;
        }
        ob_start();
        $tes = '$(function() {"use strict"; ';
        $tes .= morris_chart($key, $datacoba, 'morris-line-chart', 100);
        $tes .= '});';
        echo $tes;
        $cont = ob_get_contents();
        array_push($cfoo, $cont);
        ob_end_clean();

        $tesc['title'] = 'Grafik Jumlah Pendaftar Per Tahun Ajaran';
        $tesc['id'] = 'morris-line-chart' . 100;
        $tesc['color'] = $cl;
        $tesc['lable'] = $label;
        $dt = [
            //fromat 'Judul' => [isi1,isi2,dst] isi fungsi helprt / tag html
            'Grafik' => [$tesc], //grafik
            'Home' => [card($cd)], //panggil helper card array bentuknya
            'Dashboard' => [card($cd1), table_view($ct)], //array biar bisa beberapa konten di dalam 1 tab
        ];
        $tab['tab'] = tab($dt);
        $this->load->view('sections/tab', $tab);

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
        return json_decode($getmhs, true)['data'];
    }
}
