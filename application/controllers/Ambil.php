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
    function ambilcard(){
        $kunnn = $_POST['param'];
        $okkk = explode('|',$kunnn);
        if(strlen($okkk[0]) == 5){
        $detail = '<p class="text-white mb-0"> Tahun '.substr($okkk[0],0,4).' Semester '.substr($okkk[0],4).' </p>';
        }elseif(strlen($okkk[0]) == 4){
            $detail = '<p class="text-white mb-0"> Tahun '.$okkk[0].'</p>';

        }elseif((strlen($okkk[0]) == 9)){
            $detail = '<p class="text-white mb-0"> Tahun Ajaran'.$okkk[0].'</p>';
        }else{
            $detail = '<p class="text-white mb-0"> Tahun '.$okkk[0].'</p>';
        }
        $dapat = genggek($okkk[0],$okkk[1]);
        $modal = table_view($dapat['data']);
        $result = ["nilai" => $dapat['count'] ,"detail" => $detail,"modal"=>$modal];
        echo json_encode($result,true);
        
    }
    function api()
    {
        $ambil = $this->db->get_where('api', array('id >=' => 142, 'id <=' => 204))->result_array();
        foreach ($ambil as $a) {
            $isi = $this->_api($a['select'], $a['view_name'], $a['where'], $a['limit'], $a['order_by']);
            if ($isi == null) {
            } else {
                $this->load->database();
                $up = $this->db->where('id', $a['id'])
                    ->update('api', array('jsonFile' => $isi));
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
