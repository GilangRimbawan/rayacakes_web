<?php 

class Model_produksi extends CI_Model
{
    // Fungsi untuk mengambil semua data riwayat produksi
    public function getProduksiData()
    {
        // Query ini menggabungkan tabel produksi dengan tabel products
        // untuk mengambil nama produknya berdasarkan id_produk
        $sql = "SELECT produksi.*, products.name as nama_produk 
                FROM produksi
                JOIN products ON produksi.id_produk = products.id
                ORDER BY produksi.tanggal_produksi DESC"; // Diurutkan berdasarkan tanggal terbaru

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // FUNGSI BARU: Mengambil data produksi berdasarkan rentang tanggal
public function getProduksiByDateRange($tanggal_mulai, $tanggal_selesai)
{
    // Menambahkan '23:59:59' ke tanggal selesai agar mencakup seluruh hari itu
    $tanggal_selesai_full = $tanggal_selesai . ' 23:59:59';

    $sql = "SELECT produksi.*, products.name as nama_produk 
            FROM produksi
            JOIN products ON produksi.id_produk = products.id
            WHERE produksi.tanggal_produksi BETWEEN ? AND ?
            ORDER BY produksi.tanggal_produksi DESC";

    $query = $this->db->query($sql, array($tanggal_mulai, $tanggal_selesai_full));
    return $query->result_array();
}

    public function create()
    {
        // 1. Ambil data dari form
        $id_resep = $this->input->post('resep');
        $jumlah_produksi = $this->input->post('jumlah');

        // 2. Ambil detail resep dari database
        // Kita butuh tahu produk apa yg dibuat & bahan apa saja yg dibutuhkan
        $this->load->model('model_resep');
        $resep = $this->model_resep->getResepDataById($id_resep);
        $resep_detail = $this->model_resep->getResepDetailData($id_resep);
        $id_produk = $resep['id_produk'];

        // 3. Kurangi stok bahan baku (LOOPING)
        foreach ($resep_detail as $bahan) {
            $id_bahan = $bahan['id_bahan'];
            $jumlah_dibutuhkan = $bahan['jumlah'] * $jumlah_produksi; // total bahan yg dipakai

            // Query untuk mengurangi stok bahan baku
            $sql_bahan = "UPDATE bahan_baku SET stok = stok - ? WHERE id_bahan = ?";
            $this->db->query($sql_bahan, array($jumlah_dibutuhkan, $id_bahan));
        }

        // 4. Tambah stok produk jadi
        $sql_produk = "UPDATE products SET qty = qty + ? WHERE id = ?";
        $this->db->query($sql_produk, array($jumlah_produksi, $id_produk));

        // 5. Catat riwayat produksi ke tabel 'produksi'
        $data_produksi = array(
            'id_produk' => $id_produk,
            'jumlah_produksi' => $jumlah_produksi,
            'tanggal_produksi' => date('Y-m-d H:i:s'),
            'catatan' => $this->input->post('catatan')
        );
        $this->db->insert('produksi', $data_produksi);

        return true; // Anggap selalu berhasil
    }

    public function remove($id_produksi)
    {
        // 1. Ambil data produksi yang akan dihapus
        $this->db->where('id_produksi', $id_produksi);
        $produksi = $this->db->get('produksi')->row_array();

        if($produksi) {
            $id_produk = $produksi['id_produk'];
            $jumlah_produksi = $produksi['jumlah_produksi'];

            // 2. Cari resep yang digunakan untuk produksi ini
            $this->db->where('id_produk', $id_produk);
            $resep = $this->db->get('resep')->row_array();
            $id_resep = $resep['id_resep'];

            // 3. Ambil detail bahan baku dari resep tersebut
            $this->load->model('model_resep');
            $resep_detail = $this->model_resep->getResepDetailData($id_resep);

            // 4. KEMBALIKAN stok bahan baku (LOOPING)
            foreach ($resep_detail as $bahan) {
                $id_bahan = $bahan['id_bahan'];
                $jumlah_dikembalikan = $bahan['jumlah'] * $jumlah_produksi;

                // Query untuk MENAMBAH kembali stok bahan baku
                $sql_bahan = "UPDATE bahan_baku SET stok = stok + ? WHERE id_bahan = ?";
                $this->db->query($sql_bahan, array($jumlah_dikembalikan, $id_bahan));
            }

            // 5. KURANGI stok produk jadi yang sudah ditambahkan sebelumnya
            $sql_produk = "UPDATE products SET qty = qty - ? WHERE id = ?";
            $this->db->query($sql_produk, array($jumlah_produksi, $id_produk));

            // 6. Hapus catatan riwayat produksi
            $this->db->where('id_produksi', $id_produksi);
            $this->db->delete('produksi');

            return true;
        }

        return false; // Gagal jika data produksi tidak ditemukan
    }

    // FUNGSI BARU: Mengambil produk yang paling sering diproduksi
public function getProdukPopuler($limit = 5)
{
    $sql = "SELECT p.name as nama_produk, COUNT(pr.id_produksi) as jumlah_kali_produksi
            FROM produksi pr
            JOIN products p ON pr.id_produk = p.id
            GROUP BY pr.id_produk, p.name
            ORDER BY jumlah_kali_produksi DESC
            LIMIT ?";

    $query = $this->db->query($sql, array($limit));
    return $query->result_array();
}

    // FUNGSI BARU 1: Mengambil data satu riwayat produksi
public function getProduksiDataById($id)
{
    $sql = "SELECT produksi.*, products.name as nama_produk 
            FROM produksi
            JOIN products ON produksi.id_produk = products.id
            WHERE produksi.id_produksi = ?";
    $query = $this->db->query($sql, array($id));
    return $query->row_array();
}

// FUNGSI BARU 2: Menghitung bahan baku yang terpakai untuk sebuah produksi
public function getBahanBakuUsage($id_produksi)
{
    // 1. Ambil data produksi
    $produksi = $this->getProduksiDataById($id_produksi);
    if(!$produksi) return null;

    $id_produk = $produksi['id_produk'];
    $jumlah_produksi = $produksi['jumlah_produksi'];

    // 2. Cari resep yang digunakan
    $this->db->where('id_produk', $id_produk);
    $resep = $this->db->get('resep')->row_array();
    if(!$resep) return null;

    $id_resep = $resep['id_resep'];

    // 3. Ambil detail bahan dari resep & hitung total pemakaian
    $sql = "SELECT rd.jumlah * ? as total_terpakai, bb.nama_bahan, bb.satuan
            FROM resep_detail rd
            JOIN bahan_baku bb ON rd.id_bahan = bb.id_bahan
            WHERE rd.id_resep = ?";

    $query = $this->db->query($sql, array($jumlah_produksi, $id_resep));
    return $query->result_array();
}
}