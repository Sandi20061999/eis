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

                ob_start();
                $cku = '$(function() {"use strict"; ';
                $cku .= morris_chart($key, $datacoba, 'morris-line-chart', $au);
                $cku .= '});';
                echo $cku;
                $contents = ob_get_contents();
                array_push($cfoo, $contents);
                ob_end_clean();
                $title = 'Grafik Jumlah Pendaftar Per Tahun Ajaran';
                $cbu['id'] = 'morris-line-chart' . $au;
                $this->load->view('sections/chart', $cbu);
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
        return json_decode($getmhs, true)['data'];
    }
}
