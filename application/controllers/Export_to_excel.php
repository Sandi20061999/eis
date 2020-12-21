<?php
// defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export_to_excel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index($idku)
    {
        // $dat = "3|2019/2020";
        $dat = base64_decode($idku);
        $data = explode('|', $dat);
        $get = $this->db->get_where('view', ['id' => $data[0]])->row_array();
        $json = json_decode($get['jsonFile'], TRUE);
        if ($data[3] == 'kosong') {
            $dataku = $json['data'];
        } else {
            $ah = $json['data'][$data[3]];
            $dataku = $ah['data'];
        }
        $where = array_merge($dataku['where'], [$dataku['groupby'] => $data[1]]);
        $isi = $this->getData($dataku['table'], $where);
        $field = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('EIS')
            ->setLastModifiedBy('EIS')
            ->setTitle('EIS')
            ->setSubject('EIS')
            ->setDescription('Laporan EIS')
            ->setKeywords('EIS')
            ->setCategory('Laporan');
        $fontStyleKop = [
            'font' => [
                'size' => 16,
                'bold' => true,
                'name' => 'Times New Roman',
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ];
        for ($i = 0; $i < 1; $i++) {
            $pan = count($isi[$i]);
        }
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', "Laporan Data " . field_as($dataku['groupby']) . " {$data[1]}")
            ->mergeCells("A1:{$field[$pan - 1]}1")
            ->getStyle('A1')->applyFromArray($fontStyleKop);
        $mulai = 3;
        $fontStylenF = [
            'font' => [
                'size' => 12,
                'name' => 'Times New Roman',
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ];
        $ff = 0;
        foreach ($isi[0] as $nF => $val) {
            $spreadsheet->getActiveSheet()->getColumnDimension($field[$ff])
                ->setAutoSize(true);
            $ff++;
        }
        $ff = 0;
        $up = [];
        foreach ($isi[0] as $nF => $val) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue("{$field[$ff]}{$mulai}", field_as($nF))
                ->getStyle("{$field[$ff]}{$mulai}", field_as($nF))->applyFromArray($fontStylenF);
            $ff++;
            array_push($up, $nF);
        }
        $mulai1 = 4;
        foreach ($isi as $nF) {
            $ff = 0;
            foreach ($up as $u) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("{$field[$ff]}{$mulai1}", $nF[$u])
                    ->getStyle("{$field[$ff]}{$mulai1}", $nF[$u])->applyFromArray($fontStylenF);
                $ff++;
            }
            $mulai1++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    function detail($idku)
    {
        // $dat = "3|2019/2020";
        $dat = base64_decode($idku);
        // var_dump($dat);
        // die;
        $data = explode('|', $dat);
        $get = $this->db->get_where('view', ['id' => $data[0]])->row_array();
        $json = json_decode($get['jsonFile'], TRUE);
        if ($data[1] == 'kosong') {
            $dataku = $json['data'];
            $jsonKU = $json;
        } else {
            $jsonKU = $json['data'][$data[1]];
            $dataku = $jsonKU['data'];
        }
        $getData = $this->db->get_where('api', ['id' => $jsonKU['withDetail']['api_id']])->row_array();
        $isi = $this->getData("api_" . strtolower($getData['view_name']), [$jsonKU['withDetail']['selector'] => $data[2]]);
        $field = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('EIS')
            ->setLastModifiedBy('EIS')
            ->setTitle('EIS')
            ->setSubject('EIS')
            ->setDescription('Laporan EIS')
            ->setKeywords('EIS')
            ->setCategory('Laporan');
        $fontStyleKop = [
            'font' => [
                'size' => 16,
                'bold' => true,
                'name' => 'Times New Roman',
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ];
        for ($i = 0; $i < 1; $i++) {
            $pan = count($isi[$i]);
        }
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', "Laporan Data Detail " . field_as($jsonKU['withDetail']['selector']) . " {$data[2]}")
            ->mergeCells("A1:{$field[$pan - 1]}1")
            ->getStyle('A1')->applyFromArray($fontStyleKop);
        $mulai = 3;
        $fontStylenF = [
            'font' => [
                'size' => 12,
                'name' => 'Times New Roman',
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ];
        $ff = 0;
        foreach ($isi[0] as $nF => $val) {
            $spreadsheet->getActiveSheet()->getColumnDimension($field[$ff])
                ->setAutoSize(true);
            $ff++;
        }
        $ff = 0;
        $up = [];
        foreach ($isi[0] as $nF => $val) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue("{$field[$ff]}{$mulai}", field_as($nF))
                ->getStyle("{$field[$ff]}{$mulai}", field_as($nF))->applyFromArray($fontStylenF);
            $ff++;
            array_push($up, $nF);
        }
        $mulai1 = 4;
        foreach ($isi as $nF) {
            $ff = 0;
            foreach ($up as $u) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("{$field[$ff]}{$mulai1}", $nF[$u])
                    ->getStyle("{$field[$ff]}{$mulai1}", $nF[$u])->applyFromArray($fontStylenF);
                $ff++;
            }
            $mulai1++;
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    function getData($table = '', $where = [])
    {
        return $this->db->select()->where($where)->get($table)->result_array();
    }
}
