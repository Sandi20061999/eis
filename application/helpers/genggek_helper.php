<?php

use Jajo\JSONDB;

function genggek($fil, $id)
{
    $ci = &get_instance();
    $isi = $ci->db->join('api', 'api.id=view.api_id')->get_where('view', array('view.id' => $id))->row_array();
    $key1 = json_decode($isi['cardFilter'], true);
    $key = $key1['filter'];
    $repl = $key1['where'][$key] = $fil;
    if ($isi['jsonFile'] == null) {
        $dataValue = _api($isi['select'], $isi['view_name'], $isi['where'], $isi['limit'], $isi['order_by']);
        $json_db = new JSONDB($dataValue);
        $users = $json_db->select('*')
            ->from()
            ->where($key1['where'], 'AND')
            ->get();
    } else {
        $json_db = new JSONDB($isi['jsonFile']);
        $users = $json_db->select('*')
            ->from()
            ->where($key1['where'], 'AND')
            ->get();
    }
    if ($key1['by'] == null) {
        $count = count($users);
    } else {
        $goblok = [];
        foreach ($users as $us) {
            $goblok[] = $us[$key1['by']];
        }
        $count = rupiah(array_sum($goblok));
    }
    return [
        'count' => $count,
        'data' => $users
    ];
}


function _api($select, $view_name, $where, $limit, $order_by)
{
    $ci = &get_instance();

    $datapost = [
        "select" => $select,
        "view_name" => $view_name,
        "where" => $where,
        "limit" => $limit,
        "order_by" => $order_by
    ];
    $getmhs = $ci->curl->simple_post(API_URL(), $datapost);
    return json_decode($getmhs, true);
}
