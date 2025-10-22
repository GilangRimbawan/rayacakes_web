<?php 

class Model_bahan_baku extends CI_Model
{
    // Mengambil data bahan baku (semua atau berdasarkan ID)
	public function getBahanBakuData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM bahan_baku WHERE id_bahan = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM bahan_baku ORDER BY nama_bahan ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    // Menambah data bahan baku baru
	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('bahan_baku', $data);
			return ($insert == true) ? true : false;
		}
	}

    // Mengubah data bahan baku berdasarkan ID
	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id_bahan', $id);
			$update = $this->db->update('bahan_baku', $data);
			return ($update == true) ? true : false;
		}
	}

    // Menghapus data bahan baku berdasarkan ID
	public function remove($id)
	{
		if($id) {
			$this->db->where('id_bahan', $id);
			$delete = $this->db->delete('bahan_baku');
			return ($delete == true) ? true : false;
		}
	}
	public function getStokKritis($limit = 5)
	{
		// Stok dianggap kritis jika di bawah 100 (misalnya 100 gr)
		// Kamu bisa sesuaikan angka '100' ini sesuai kebutuhan
		$sql = "SELECT * FROM bahan_baku WHERE stok <= batas_kritis ORDER BY stok ASC LIMIT ?";
		$query = $this->db->query($sql, array($limit));
		return $query->result_array();
	}

}