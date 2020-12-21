<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends CI_Controller
{

    public function index()
    {
        $breadCrumbFormat = '{
            "type": "breadcrumb",
            "name": "Breadcrumb"
        }';
        $cardFormat = '{
        "type": "card",
        "name": "Card Pendaftar KaProdiSI",
        "title": "Jumlah Pendaftar",
        "width": 12,
        "icon": "fa fa-users",
        "color": "#3f48cc",
        "detail": "Tahun Ajaran 2019/2020",
        "api_id": 2,
        "data": {
            "table": "api_eis_prodi_pendaftar",
            "where": {
            "id_jurusan": "0105"
            },
            "default_where": {
            "ta": "2019/2020"
            },
            "default_value": "2019/2020",
            "groupby": "ta",
            "count": "row"
            }
        }';
        $chartFormat = '{
        "type": "chart",
        "name": "Chart Pendaftar KaProdiSI",
        "title": "Grafik Pendaftaran",
        "width": 9,
        "data": [
            {
            "name": "Pendaftar",
            "table": "api_eis_prodi_pendaftar",
            "where": {
                "id_jurusan": "0105"
                },
            "default_where": [
            
            ],
            "groupby": "ta",
            "count": "row"
            }
        ]
        }';
        $tableFormat = '{
        "type": "accordion",
        "name": "Accordion Pendaftar Tidak Daftar Ulang SI",
        "title": "Tabulasi Jumlah Pendaftar Tidak Daftar Ulang",
        "data": {
            "table": "api_eis_prodi_daftarulang_no",
            "where": {
            "id_jurusan": "0105"
            },
            "default_where": [
            
            ],
            "groupby": "ta",
            "count": "row"
        }
        }';
        $accordionFormat = '{
        "type": "accordion",
        "name": "Accordion Pendaftar Daftar Ulang SI",
        "title": "Tabulasi Jumlah Pendaftar Daftar Ulang",
        "data": {
            "table": "api_eis_prodi_daftarulang",
            "where": {
            "id_jurusan": "0105"
            },
            "default_where": [
            
            ],
            "groupby": "ta",
            "count": "row"
        }
        }';


        // 2-53
        $SMdari = 19;
        $SMsampai = 37;

        $vdari = 2;
        $vsampai = 54;

        for ($sm = 0; $sm < 11; $sm++) {
            for ($k = $SMdari; $k < $SMsampai; $k++) {
                if ($k !== ($SMdari + 6)) {
                    if ($k !== ($SMdari + 7)) {
                        if ($k !== ($SMdari + 12)) {
                            if ($k !== ($SMdari + 17)) {
                                if ($k == ($SMdari + 11)) {
                                    for ($v = 0; $v < 3; $v++) {
                                        // 51,52,53
                                        if ($v == 1) {
                                            $by = $v + 1;
                                        } else {
                                            $by = $v + 2;
                                        }
                                        $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => ($vsampai + 20 + $v - 4), 'is_active' => '1', 'by' => $by]);
                                        echo 'ini 3 kali 12 bawah id  = ' . $k . ' view_id = ' . ($vsampai + 20 + $v - 4);
                                        echo '<br>';
                                    }
                                } elseif ($k == ($SMdari + 10)) {
                                    for ($v = 0; $v < 2; $v++) {
                                        $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => $vsampai, 'is_active' => '1', 'by' => ($v + 2)]);
                                        echo 'ini 2 kali id = ' . $k . ' view_id = ' . $vsampai;
                                        echo '<br>';
                                        $vsampai++;
                                        $vsampai++;
                                    }
                                } elseif ($k == ($SMdari + 14)) {
                                    for ($v = 0; $v < 4; $v++) {
                                        if ($v == 1) {
                                            $by = $v + 6;
                                        } else {
                                            $by = $v + 2;
                                        }
                                        $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => $vsampai, 'is_active' => '1', 'by' => $by]);
                                        echo 'ini 4 kali id = ' . $k . ' view_id = ' . $vsampai;
                                        echo '<br>';
                                        $vsampai++;
                                    }
                                } elseif ($k == ($SMdari + 16)) {
                                    for ($v = 0; $v < 4; $v++) {
                                        if ($v == 1) {
                                            $by = $v + 6;
                                        } else {
                                            $by = $v + 2;
                                        }
                                        $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => $vsampai, 'is_active' => '1', 'by' => $by]);
                                        echo 'ini 4 kali id = ' . $k . ' view_id = ' . $vsampai;
                                        echo '<br>';
                                        $vsampai++;
                                    }
                                } elseif ($k == $SMdari) {
                                    for ($v = 0; $v < 1; $v++) {
                                        $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => $vsampai, 'is_active' => '1', 'by' => ($v + 1)]);
                                        echo '<br>';
                                        $vsampai++;
                                    }
                                } else {
                                    for ($v = 0; $v < 3; $v++) {
                                        if ($v == 1) {
                                            $vsampai++;
                                            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => $vsampai, 'is_active' => '1', 'by' => ($v + 2)]);
                                            echo '<br>';
                                        } else {
                                            $this->db->insert('sub_menu_access_view', ['sub_menu_id' => $k, 'view_id' => $vsampai, 'is_active' => '1', 'by' => ($v + 2)]);
                                            echo '<br>';
                                        }
                                        $vsampai++;
                                    }
                                }
                            }
                        }
                    }
                    echo '<br>';
                }
            }
            $vsampai++;
            $vsampai++;
            $vsampai++;
            $SMdari = $SMsampai;
            $SMsampai = $SMsampai + 18;
        }
    }
    function cuk()
    {
        $arr = [
            [
                'nama' => 'Biaya SP',
                'key' => 33
            ],
            [
                'nama' => 'Pelatihan Zahir',
                'key' => 34
            ],
            [
                'nama' =>     'Test TOEFL Alumni',
                'key' => 35
            ],
            [
                'nama' =>     'Kursus Bahasa Mandarin',
                'key' => 36
            ],
            [
                'nama' =>     'Biaya Buku',
                'key' => 37
            ],
            [
                'nama' =>     'Kuliah Terbimbing',
                'key' => 40
            ],
            [
                'nama' =>     'Wisuda',
                'key' => 41
            ],
            [
                'nama' =>     'BPP Tambahan',
                'key' => 42
            ],
            [
                'nama' =>     'SKS Tambahan',
                'key' => 43
            ],
            [
                'nama' =>     'Bahasa Inggris (Satu)',
                'key' => 44
            ],
            [
                'nama' =>     'Bahasa Inggris (Dua)',
                'key' => 45
            ],
            [
                'nama' =>     'Abstrak ( Satu Hari )',
                'key' => 46
            ],
            [
                'nama' =>     'Undangan Wisuda',
                'key' => 47
            ],
            [
                'nama' =>     'Denda GDK',
                'key' => 48
            ],
            [
                'nama' =>     'Uji Kompetensi',
                'key' => 49
            ],
            [
                'nama' =>     'Modul DLC',
                'key' => 50
            ],
            [
                'nama' =>     'Abstrak Lainnya',
                'key' => 51
            ],
            [
                'nama' =>     'Pelatihan Soft Skill',
                'key' => 52
            ],
            [
                'nama' =>     'TOEFL Intensive',
                'key' => 53
            ],
            [
                'nama' =>     'Visit Akademik',
                'key' => 54
            ],
            [
                'nama' =>     'Kursus Bahasa Inggris',
                'key' => 55
            ],
            [
                'nama' =>     'PMB Tambahan',
                'key' => 56
            ],
            [
                'nama' =>     'Tambahan PKPM',
                'key' => 57
            ],
            [
                'nama' =>     'Ganti KTM',
                'key' => 58
            ],
            [
                'nama' =>     'Tambahan Kunjungan Industri',
                'key' => 59
            ]
        ];

        foreach ($arr as $a) {
            $pas = [
                "name" => "Keuangan MHS (biaya " . $a['nama'] . ")",
                "jsonConfig" => '{"key":"id","keyForUpdate":"npm","index":[],"field":{"id":{"type":"INT","constraint":11,"unsigned":true,"auto_increment":true},"npm":{"type":"VARCHAR","null":true,"constraint":"15"},"nama":{"type":"VARCHAR","null":true,"constraint":"30"},"kdta":{"type":"VARCHAR","null":true,"constraint":"10"},"idrekening":{"type":"VARCHAR","null":true,"constraint":"10"},"id_jurusan":{"type":"VARCHAR","null":true,"constraint":"10"},"nm_jurusan":{"type":"VARCHAR","null":true,"constraint":"30"},"tgltransaksi":{"type":"VARCHAR","null":true,"constraint":"20"},"total":{"type":"VARCHAR","null":true,"constraint":"25"},"ct":{"type":"VARCHAR","null":true,"constraint":"10"}}}',
                "select" => "*",
                "view_name" => "EIS_keu_detail_mhs_all_prodi",
                "where" => "idrekening='" . $a['key'] . "'",
                "limit" => "-1",
                "order_by" => ""
            ];
            $this->db->insert('api', $pas);
        }
    }
}
