<?php
function field_as($field)
{
    switch ($field) {
        case "npm":
            $field = "NPM";
            break;
        case "tgldaftar":
            $field = "Tanggal Daftar";
            break;
        case "nama":
            $field = "Nama";
            break;
        case "jk":
            $field = "Jenis Kelamin";
            break;
        case "id_jurusan":
            $field = "ID Jurusan";
            break;
        case "kdta":
            $field = "KDTA";
            break;
        case "tempatlahir":
            $field = "Tempat Lahir";
            break;
        case "tgllahir":
            $field = "Tanggal Lahir";
            break;
        case "angkatan":
            $field = "Angkatan";
            break;
        case "ta":
            $field = "Tahun Ajaran";
            break;
        case "TA":
            $field = "Tahun Ajaran";
            break;
        case "nm_semester":
            $field = "Nama Semester";
            break;
        case "alamat":
            $field = "Alamat";
            break;
        case "kelurahan":
            $field = "Kelurahan";
            break;
        case "nm_kecamatan":
            $field = "Kecamatan";
            break;
        case "nm_kabupaten":
            $field = "Kabupaten";
            break;
        case "nm_propinsi":
            $field = "Provinsi";
            break;
        case "nm_jurusan":
            $field = "Jurusan";
            break;
        case "jenjang":
            $field = "Jenjang";
            break;
        case "no_pendaftar":
            $field = "No Pendaftar";
            break;
        case "no_test":
            $field = "No Tes";
            break;
        case "tgldaftar":
            $field = "Tanggal Daftar";
            break;
        case "nocuti":
            $field = "No Cuti";
            break;
        case "tglcuti":
            $field = "Tanggal Cuti";
            break;
        case "tglcuti":
            $field = "Tanggal Cuti";
            break;
        case "alasan":
            $field = "Alasan";
            break;
        case "kdta_lapor":
            $field = "KDTA Lapor";
            break;
        case "smtlapor":
            $field = "Semester Lapor";
            break;
        case "Prodi":
            $field = "Prodi";
            break;
        case "ta_lapor":
            $field = "TA Lapor";
            break;
        case "jumlah_sks":
            $field = "Jumlah SKS";
            break;
        case "ipk":
            $field = "IPK";
            break;
        case "predikat":
            $field = "Predikat";
            break;
        case "judul_indo":
            $field = "Judul";
            break;
        case "masa_studi":
            $field = "Masa Studi";
            break;
        case "tglmasuk":
            $field = "Tanggal Masuk";
            break;
        case "tglsk_yudisium":
            $field = "Tanggal SK Yudisium";
            break;
        case "keterangan":
            $field = "Keterangan";
            break;
        case "waktu_kuliah":
            $field = "Waktu Kuliah";
            break;
        case "tanggal":
            $field = "Tanggal";
            break;
        case "nik":
            $field = "NIK";
            break;
        case "kodemk":
            $field = "Kode MK";
            break;
        case "namamk":
            $field = "Nama MK";
            break;
        case "JamMasuk":
            $field = "Jam Masuk";
            break;
        case "JamKeluar":
            $field = "Jam Keluar";
            break;
        case "sks":
            $field = "SKS";
            break;
        case "kelas":
            $field = "Kelas";
            break;
        case "ruangan":
            $field = "Ruangan";
            break;
        case "pertemuan":
            $field = "Pertemuan";
            break;
        case "presensi":
            $field = "Presensi";
            break;
        case "NamaDosen":
            $field = "Nama Dosen";
            break;
        case "waktu_jawab":
            $field = "Waktu Jawab";
            break;
        case "pertanyaan":
            $field = "Pertanyaan";
            break;
        case "waktu_tanya":
            $field = "Waktu Tanya";
            break;
        case "jawaban":
            $field = "jawaban";
            break;
        default:
            $field;
            break;
    }
    return $field;
}
