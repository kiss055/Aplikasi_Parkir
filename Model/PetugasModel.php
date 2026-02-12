<?php
class PetugasModel {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    // Mengambil semua jenis tarif untuk dropdown
    public function getTarifList() {
        return mysqli_query($this->db, "SELECT * FROM tb_tarif");
    }

    // Mengambil area parkir yang masih tersedia
    public function getAvailableAreas() {
        return mysqli_query($this->db, "SELECT * FROM tb_area_parkir WHERE terisi < kapasitas");
    }

    // Mengambil daftar kendaraan yang statusnya masih 'masuk'
    public function getKendaraanDalam() {
        $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan, a.nama_area 
                FROM tb_transaksi t 
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
                JOIN tb_area_parkir a ON t.id_area = a.id_area 
                WHERE t.status = 'masuk' 
                ORDER BY t.waktu_masuk DESC";
        return mysqli_query($this->db, $sql);
    }

    // Mengambil detail transaksi tunggal untuk struk
    public function getTransaksiDetail($id, $is_keluar = false) {
        if (!$is_keluar) {
            $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan, a.nama_area 
                    FROM tb_transaksi t 
                    JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
                    JOIN tb_area_parkir a ON t.id_area = a.id_area 
                    WHERE t.id_parkir = '$id'";
        } else {
            $sql = "SELECT t.*, k.plat_nomor, tr.jenis_kendaraan 
                    FROM tb_transaksi t 
                    JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
                    JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif 
                    WHERE t.id_parkir = '$id'";
        }
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_assoc($result);
    }

    // Logika simpan kendaraan masuk
    public function simpanMasuk($plat, $id_tarif, $id_area, $id_user, $waktu_masuk) {
        // Ambil jenis kendaraan berdasarkan tarif
        $qTarif = mysqli_query($this->db, "SELECT jenis_kendaraan FROM tb_tarif WHERE id_tarif = '$id_tarif'");
        $rTarif = mysqli_fetch_assoc($qTarif);
        $jenis = $rTarif['jenis_kendaraan'];

        // Cek apakah kendaraan sudah ada di master
        $cek_k = mysqli_query($this->db, "SELECT id_kendaraan FROM tb_kendaraan WHERE plat_nomor = '$plat'");
        
        if (mysqli_num_rows($cek_k) > 0) {
            $rk = mysqli_fetch_assoc($cek_k);
            $id_kendaraan = $rk['id_kendaraan'];
        } else {
            mysqli_query($this->db, "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan, id_user) VALUES ('$plat', '$jenis', '$id_user')");
            $id_kendaraan = mysqli_insert_id($this->db);
        }

        // Insert ke tabel transaksi
        $sql = "INSERT INTO tb_transaksi (id_kendaraan, waktu_masuk, id_tarif, id_user, id_area, status)
                VALUES ('$id_kendaraan', '$waktu_masuk', '$id_tarif', '$id_user', '$id_area', 'masuk')";
        
        if (mysqli_query($this->db, $sql)) {
            $id_baru = mysqli_insert_id($this->db);
            // Update slot area
            mysqli_query($this->db, "UPDATE tb_area_parkir SET terisi = terisi + 1 WHERE id_area = '$id_area'");
            return $id_baru;
        }
        return false;
    }

    // Logika proses kendaraan keluar
    public function prosesKeluar($id_parkir, $waktu_keluar) {
        $q = mysqli_query($this->db, "SELECT t.*, tr.tarif_per_jam FROM tb_transaksi t 
                                      JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif 
                                      WHERE t.id_parkir = '$id_parkir'");
        $d = mysqli_fetch_assoc($q);
        if (!$d) return false;

        // Hitung durasi
        $awal  = new DateTime($d['waktu_masuk']);
        $akhir = new DateTime($waktu_keluar);
        $interval = $awal->diff($akhir);
        $hours = ($interval->days * 24) + $interval->h;
        $minutes = $interval->i;

        $durasi = $hours;
        if ($minutes > 0 || $durasi == 0) {
            $durasi++;
        }

        $total = $durasi * $d['tarif_per_jam'];

        // Update transaksi
        $sql = "UPDATE tb_transaksi SET 
                waktu_keluar = '$waktu_keluar', 
                durasi_jam = '$durasi', 
                biaya_total = '$total', 
                status = 'keluar' 
                WHERE id_parkir = '$id_parkir'";
        
        if (mysqli_query($this->db, $sql)) {
            // Update slot area (kurangi)
            mysqli_query($this->db, "UPDATE tb_area_parkir SET terisi = terisi - 1 WHERE id_area = '{$d['id_area']}'");
            return true;
        }
        return false;
    }
}
