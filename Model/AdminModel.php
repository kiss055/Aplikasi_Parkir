<?php
class AdminModel {
    private $db;

    public function __construct($db_conn) {
        $this->db = $db_conn;
    }

    // === DASHBOARD METHODS ===
    public function getDashboardStats() {
        return [
            'totalUser' => mysqli_fetch_assoc(mysqli_query($this->db, "SELECT COUNT(*) AS total FROM tb_user"))['total'],
            'totalKendaraan' => mysqli_fetch_assoc(mysqli_query($this->db, "SELECT COUNT(*) AS total FROM tb_kendaraan"))['total'],
            'totalTransaksi' => mysqli_fetch_assoc(mysqli_query($this->db, "SELECT COUNT(*) AS total FROM tb_transaksi"))['total']
        ];
    }

    public function getTransactionChartData($days = 7) {
        $sql = "SELECT DATE(waktu_masuk) AS tanggal, COUNT(*) AS total
                FROM tb_transaksi
                WHERE waktu_masuk >= DATE_SUB(CURDATE(), INTERVAL $days DAY)
                GROUP BY DATE(waktu_masuk)
                ORDER BY tanggal ASC";
        return mysqli_query($this->db, $sql);
    }

    // === LOG AKTIVITAS METHODS ===
    public function getLogs($limit = null) {
        $limitQuery = $limit ? "LIMIT $limit" : "";
        $sql = "SELECT l.*, u.nama_lengkap, u.username, u.role
                FROM tb_log_aktivitas l
                JOIN tb_user u ON l.id_user = u.id_user
                ORDER BY l.waktu_aktivitas DESC $limitQuery";
        return mysqli_query($this->db, $sql);
    }

    // === USER METHODS ===
    public function getAllUsers() {
        return mysqli_query($this->db, "SELECT * FROM tb_user ORDER BY id_user DESC");
    }

    public function getUserById($id) {
        $id = mysqli_real_escape_string($this->db, $id);
        return mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM tb_user WHERE id_user='$id'"));
    }

    // === PARKIR & LAYANAN METHODS ===
    public function getAllTarif() {
        return mysqli_query($this->db, "SELECT * FROM tb_tarif");
    }

    public function getTarifById($id) {
        $id = mysqli_real_escape_string($this->db, $id);
        return mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM tb_tarif WHERE id_tarif='$id'"));
    }

    public function getAllAreas() {
        return mysqli_query($this->db, "SELECT * FROM tb_area_parkir");
    }

    public function getAreaById($id) {
        $id = mysqli_real_escape_string($this->db, $id);
        return mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM tb_area_parkir WHERE id_area='$id'"));
    }

    public function getAllKendaraan() {
        return mysqli_query($this->db, "SELECT * FROM tb_kendaraan ORDER BY id_kendaraan DESC");
    }

    public function getKendaraanById($id) {
        $id = mysqli_real_escape_string($this->db, $id);
        return mysqli_fetch_assoc(mysqli_query($this->db, "SELECT * FROM tb_kendaraan WHERE id_kendaraan='$id'"));
    }
}
