<?php
require_once __DIR__ . '/../Controller/config.php';

class OwnerModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getRekapTransaksi($tgl_mulai, $tgl_selesai) {
        $query = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan, 
                  u.nama_lengkap as petugas 
                  FROM tb_transaksi t 
                  JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
                  LEFT JOIN tb_user u ON t.id_user = u.id_user 
                  WHERE DATE(t.waktu_keluar) BETWEEN '$tgl_mulai' AND '$tgl_selesai' 
                  AND t.status = 'keluar'
                  ORDER BY t.waktu_keluar DESC";

        $result = mysqli_query($this->conn, $query);

        $data = [];
        $total_pendapatan = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $total_pendapatan += $row['biaya_total'];
            $data[] = $row;
        }

        return [
            'data' => $data,
            'total_pendapatan' => $total_pendapatan,
            'jumlah_transaksi' => count($data)
        ];
    }
}