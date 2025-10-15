<?php 

class Model_resep extends CI_Model
{
    // Mengambil semua data resep (untuk tabel utama)
    public function getResepData()
    {
        $sql = "SELECT resep.id_resep, resep.nama_resep, products.name as nama_produk 
                FROM resep
                JOIN products ON resep.id_produk = products.id
                ORDER BY resep.nama_resep ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // Mengambil data satu resep berdasarkan ID
    public function getResepDataById($id)
    {
        $sql = "SELECT * FROM resep WHERE id_resep = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    // Mengambil detail bahan baku untuk satu resep
    public function getResepDetailData($resep_id)
    {
        $sql = "SELECT * FROM resep_detail WHERE id_resep = ?";
        $query = $this->db->query($sql, array($resep_id));
        return $query->result_array();
    }

    // Menyimpan resep baru
    public function create()
    {
        $data_resep = array(
            'id_produk' => $this->input->post('id_produk'),
            'nama_resep' => $this->input->post('nama_resep')
        );
        $this->db->insert('resep', $data_resep);
        $resep_id = $this->db->insert_id();

        $bahan_baku = $this->input->post('bahan_baku');
        $jumlah = $this->input->post('jumlah');
        for ($i = 0; $i < count($bahan_baku); $i++) {
            $detail = array(
                'id_resep' => $resep_id,
                'id_bahan' => $bahan_baku[$i],
                'jumlah' => $jumlah[$i]
            );
            $this->db->insert('resep_detail', $detail);
        }
        return true;
    }

    // Memperbarui resep
    public function update($id)
    {
        // 1. Update data utama di tabel 'resep'
        $data_resep = array(
            'id_produk' => $this->input->post('id_produk'),
            'nama_resep' => $this->input->post('nama_resep')
        );
        $this->db->where('id_resep', $id);
        $this->db->update('resep', $data_resep);

        // 2. Hapus semua detail bahan baku yang lama
        $this->db->where('id_resep', $id);
        $this->db->delete('resep_detail');

        // 3. Masukkan kembali detail bahan baku yang baru
        $bahan_baku = $this->input->post('bahan_baku');
        $jumlah = $this->input->post('jumlah');
        for ($i = 0; $i < count($bahan_baku); $i++) {
            $detail = array(
                'id_resep' => $id,
                'id_bahan' => $bahan_baku[$i],
                'jumlah' => $jumlah[$i]
            );
            $this->db->insert('resep_detail', $detail);
        }
        return true;
    }

    // Menghapus resep
    public function remove($id)
    {
        // Hapus dulu dari tabel detail, baru tabel utama
        $this->db->where('id_resep', $id);
        $this->db->delete('resep_detail');

        $this->db->where('id_resep', $id);
        $this->db->delete('resep');
        
        return true;
    }
}