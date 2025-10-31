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
}