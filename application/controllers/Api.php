<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // 1. TAMBAHAN: Header CORS (Cross-Origin Resource Sharing)
        // Ini sangat penting agar aplikasi Flutter diizinkan mengambil data dari CI
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");

        // Kita muat model-model yang datanya ingin kita ambil
        $this->load->model('model_bahan_baku');
        $this->load->model('model_resep');
        $this->load->model('model_produksi');
        $this->load->model('model_products');
        
        // Catatan: Jika kamu punya model khusus untuk user/admin (misal: model_users), 
        // pastikan di-load juga di sini untuk keperluan fungsi login di bawah.
        // $this->load->model('model_users'); 
    }

    // 2. TAMBAHAN: Endpoint Login
    public function login()
    {
        // Ambil data JSON (username & password) yang dikirim dari Flutter
        $json_data = json_decode(file_get_contents('php://input'), true);

        if ($json_data) {
            $username = $json_data['username'];
            $password = $json_data['password'];

            // --- PERHATIAN: BAGIAN INI HARUS DISESUAIKAN ---
            // Idealnya, kamu mengecek ke database melalui model. Contoh:
            // $user = $this->model_users->cek_login($username, $password);
            // if($user) { ... }
            
            // KARENA SAYA TIDAK TAHU STRUKTUR TABEL USER-MU, 
            // Ini adalah logika bypass sementara. Silakan ganti dengan logika aslimu.
            if ($username === 'admin' && $password === 'admin123') {
                $response = array(
                    'status' => 'success', 
                    'message' => 'Login berhasil',
                    'data' => array(
                        'username' => $username,
                        'role' => 'admin' // Bisa disesuaikan
                    )
                );
            } else {
                $response = array('status' => 'error', 'message' => 'Username atau password salah');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Data tidak lengkap atau format salah');
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }

    // Endpoint mengambil semua data bahan baku
    public function bahan_baku()
    {
        $data = $this->model_bahan_baku->getBahanBakuData();
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($data));
    }

    // Endpoint mengambil semua data produk kue
    public function produk_kue()
    {
        $data = $this->model_products->getProductData();
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($data));
    }

    // Endpoint menambah produksi
    public function tambah_produksi()
    {
        $json_data = json_decode(file_get_contents('php://input'), true);

        if ($json_data) {
            $_POST['resep'] = $json_data['id_resep']; 
            $_POST['jumlah'] = $json_data['jumlah_produksi'];
            $_POST['catatan'] = $json_data['catatan'] ?? null;
        }

        $create = $this->model_produksi->create();

        if($create == true) {
            $response = array('status' => 'success', 'message' => 'Produksi berhasil ditambahkan');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menambahkan produksi');
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }

    // Endpoint mengambil resep
    public function resep()
    {
        $data = $this->model_resep->getResepData();
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($data));
    }

    // Endpoint mengambil total produksi hari ini
public function total_hari_ini()
    {
        $hari_ini = date('Y-m-d');
        
        
        $this->db->select_sum('jumlah_produksi', 'total_angka'); 
        
        $this->db->where('DATE(tanggal_produksi)', $hari_ini); 
        $query = $this->db->get('produksi'); 
        
        $result = $query->row();
        
        // Karena kita pakai alias 'total_angka', bagian bawah ini tidak perlu diubah-ubah lagi
        $total = $result->total_angka ? (int)$result->total_angka : 0;

        $response = array('status' => 'success', 'total' => $total);

        $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
    }
} 