<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

use Nahid\JsonQ\Jsonq;

class Ambil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    function api()
    {
        $ambil = $this->db->get('user_api')->result_array();
        foreach ($ambil as $a) {
            $isi = $this->_api($a['select'], $a['view_name'], $a['where'], $a['limit'], $a['order_by']);
            if ($isi == null) {
            } else {
                $this->load->database();
                $up = $this->db->where('id', $a['id'])
                    ->update('user_api', array('jsonFile' => $isi));
                if ($up) {
                    echo "id " . $a['id'] . " berhasil isi";
                    echo "<br>";
                } else {
                    echo "id " . $a['id'] . " gagal isi";
                    echo "<br>";
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
        $getmhs = $this->curl->simple_post(API_URL(), $datapost);
        return $getmhs;
    }

    function ambil()
    {
        $dt = $this->db->get_where('user_api', array('id' => '23'))->row_array();
        $json = json_decode($dt['jsonFile'], true)['data'];
        $ar = [];
        foreach ($json as $jj) {
            array_push($ar, $jj['id_jurusan']);
        }
        $aa = array_unique($ar);
        var_dump($aa);
    }

    function tojson()
    {
        $arr = [
            'filter' => [
                'card' => [
                    'ta',
                    'id_jurusan',
                    'jenjang'
                ],
                'chart' => [],
            ]
        ];
        echo json_encode($arr);
    }

    function tojsonlevel()
    {
        $arr = [
            'level' => [
                'kaprodi',
                'keuangan'
            ]
        ];
        echo json_encode($arr);
    }

    function fil()
    {
        $pa = [
            'ta' => '2020/2021',
            'id_jurusan' => '0105',
        ];
        $h =  json_encode($pa);
        var_dump(json_decode($h, true));
    }
}
