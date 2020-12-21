<?php
ini_set('MAX_EXECUTION_TIME', '-1');
function updateData($id = null)
{
    $CIKU = &get_instance();
    $CIKU->load->dbforge();
    if ($id != null) {
        $gA = $CIKU->db->get_where('api', array('id' => $id))->row_array();
        $jD = json_decode($gA['jsonConfig'], TRUE);
        if ($CIKU->db->table_exists("api_" . strtolower($gA['view_name']))) {
            echo "Tabel " . "api_" . strtolower($gA['view_name']) . " sudah ada.<br>Sedang melakukan update data<br>";
            $isi = _api($gA['select'], $gA['view_name'], $gA['where'], $gA['limit'], $gA['order_by']);
            var_dump($isi);
            die;
            $jsonDecode = json_decode($isi, TRUE);
            if ($jsonDecode) {
                foreach ($jsonDecode['data'] as $is) {
                    $par = [];
                    foreach ($jD['field'] as $field => $value) {
                        if ($field != 'id') {
                            // array_push($par, [$field => $is[$field]]);
                            $par[$field] = $is[$field];
                        }
                    }
                    $cek = $CIKU->db->get_where("api_" . strtolower($gA['view_name']), $par)->row_array();
                    if ($cek == null) {
                        $CIKU->db->insert("api_" . strtolower($gA['view_name']), $is);
                        echo "Berhasil menambah data " . json_encode($is);
                    } else {
                        $CIKU->db->where($jD['keyForUpdate'], $is[$jD['keyForUpdate']]);
                        $CIKU->db->update("api_" . strtolower($gA['view_name']), $is);
                        echo "Berhasil mengubah data " . json_encode($is);
                    }
                }
            } else {
                echo "Data api kosong";
            }
        } else {
            $isi = _api($gA['select'], $gA['view_name'], $gA['where'], $gA['limit'], $gA['order_by']);
            $jsonDecode = json_decode($isi, TRUE);
            $isiku = $jsonDecode['data'];
            $CIKU->dbforge->add_key($jD['key'], TRUE);
            $CIKU->dbforge->add_field($jD['field']);
            $CIKU->dbforge->create_table("api_" . strtolower($gA['view_name']));
            $in = $CIKU->db->insert_batch("api_" . strtolower($gA['view_name']), $isiku);
            echo "Berhasil membuat tabel " . "api_" . strtolower($gA['view_name']) . "<br> Sedang melakukan insert data<br>";
            if ($in) {
                echo "Insert data berhasil ke tabel api_" . strtolower($gA['view_name']) . "<br>";
            } else {
                echo "Insert data gagal ke tabel api_" . strtolower($gA['view_name']) . "<br>";
            }
        }
    } else {
        $getApi = $CIKU->db->get('api')->result_array();
        foreach ($getApi as $gA) {
            $jD = json_decode($gA['jsonConfig'], TRUE);
            if ($CIKU->db->table_exists("api_" . strtolower($gA['view_name']))) {
                echo "Tabel " . "api_" . strtolower($gA['view_name']) . " sudah ada.<br>Sedang melakukan update data<br>";
                $isi = _api($gA['select'], $gA['view_name'], $gA['where'], $gA['limit'], $gA['order_by']);
                $jsonDecode = json_decode($isi, TRUE);
                if ($jsonDecode) {
                    foreach ($jsonDecode['data'] as $is) {
                        $par = [];
                        foreach ($jD['field'] as $field => $value) {
                            if ($field != 'id') {
                                // array_push($par, [$field => $is[$field]]);
                                $par[$field] = $is[$field];
                            }
                        }
                        $cek = $CIKU->db->get_where("api_" . strtolower($gA['view_name']), $par)->row_array();
                        if ($cek == null) {
                            $CIKU->db->insert("api_" . strtolower($gA['view_name']), $is);
                            echo "Berhasil menambah data " . json_encode($is);
                        } else {
                            $CIKU->db->where($jD['keyForUpdate'], $is[$jD['keyForUpdate']]);
                            $CIKU->db->update("api_" . strtolower($gA['view_name']), $is);
                            echo "Berhasil mengubah data " . json_encode($is);
                        }
                    }
                } else {
                    echo "Data api kosong";
                }
            } else {
                $isi = _api($gA['select'], $gA['view_name'], $gA['where'], $gA['limit'], $gA['order_by']);
                $jsonDecode = json_decode($isi, TRUE);
                $isiku = $jsonDecode['data'];
                $CIKU->dbforge->add_key($jD['key'], TRUE);
                $CIKU->dbforge->add_field($jD['field']);
                $CIKU->dbforge->create_table("api_" . strtolower($gA['view_name']));
                $in = $CIKU->db->insert_batch("api_" . strtolower($gA['view_name']), $isiku);
                echo "Berhasil membuat tabel " . "api_" . strtolower($gA['view_name']) . "<br> Sedang melakukan insert data<br>";
                if ($in) {
                    echo "Insert data berhasil ke tabel api_" . strtolower($gA['view_name']) . "<br>";
                } else {
                    echo "Insert data gagal ke tabel api_" . strtolower($gA['view_name']) . "<br>";
                }
            }
        }
    }
}

function _api($select, $view_name, $where, $limit, $order_by)
{
    $CIKU = &get_instance();
    $CIKU->load->library('curl');
    $datapost = [
        "select" => $select,
        "view_name" => $view_name,
        "where" => $where,
        "limit" => $limit,
        "order_by" => $order_by
    ];
    $getmhs = $CIKU->curl->simple_post(API_URL(), $datapost);
    return $getmhs;
}
