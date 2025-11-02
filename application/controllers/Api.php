<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Kita muat model-model yang datanya ingin kita ambil
        $this->load->model('model_bahan_baku');
        $this->load->model('model_resep');
        $this->load->model('model_produksi');
        $this->load->model('model_products');
    }

    // Endpoint pertama kita: mengambil semua data bahan baku
    public function bahan_baku()
    {
        // Panggil data dari model yang sudah ada
        $data = $this->model_bahan_baku->getBahanBakuData();

        // Perintahkan CodeIgniter untuk mengeluarkan output sebagai JSON
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($data));
    }

    // Endpoint kedua: mengambil semua data produk kue
    public function produk_kue()
    {
        $data = $this->model_products->getProductData();
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($data));
    }

    public function tambah_produksi()
    {
        // 1. Ambil data JSON yang dikirim oleh aplikasi mobile
        $json_data = json_decode(file_get_contents('php://input'), true);

        // 2. Set data JSON itu ke dalam $_POST agar bisa dibaca oleh model kita
        // Ini adalah 'jembatan' agar kita tidak perlu mengubah model
        if ($json_data) {
            // Pastikan nama key-nya konsisten
            $_POST['resep'] = $json_data['id_resep']; 
            $_POST['jumlah'] = $json_data['jumlah_produksi'];
            $_POST['catatan'] = $json_data['catatan'] ?? null; // Opsional
        }

        // 3. Panggil fungsi model_produksi->create() yang SUDAH ADA
        // Model ini akan membaca data dari $_POST yang baru saja kita isi
        $create = $this->model_produksi->create();

        // 4. Kirim balasan (response) ke aplikasi mobile dalam format JSON
        if($create == true) {
            $response = array('status' => 'success', 'message' => 'Produksi berhasil ditambahkan');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal menambahkan produksi');
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }

    public function resep()
{
    // 1. Panggil data dari model yang sudah ada
    // (model_resep sudah kita muat di __construct)
    // Fungsi getResepData() ini sudah otomatis mengambil nama produknya
    $data = $this->model_resep->getResepData();

    // 2. Kirim balasan (response) ke aplikasi mobile dalam format JSON
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($data));
}
}