<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Laporan';

        $this->load->model('model_bahan_baku');
        $this->load->model('model_produksi');
    }

    // Halaman utama (menu) untuk semua laporan
    public function index()
    {
        $this->render_template('reports/index', $this->data);
    }

    // Halaman Laporan Stok Bahan Baku (Sudah ada)
    public function stok_bahan_baku()
    {
        $this->data['stok_data'] = $this->model_bahan_baku->getBahanBakuData();
        $this->render_template('reports/stok_bahan_baku', $this->data);
    }

    // FUNGSI BARU: Halaman Laporan Produksi
public function produksi()
{
    $this->data['produksi_data'] = null; // Defaultnya data kosong
    $this->data['tanggal_mulai'] = null;
    $this->data['tanggal_selesai'] = null;

    // Cek apakah form filter telah disubmit (metode POST)
    if ($this->input->post()) {
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        // Panggil fungsi baru di model untuk mengambil data
        $data_laporan = $this->model_produksi->getProduksiByDateRange($tanggal_mulai, $tanggal_selesai);

        // Kirim data hasil filter ke view
        $this->data['produksi_data'] = $data_laporan;
        $this->data['tanggal_mulai'] = $tanggal_mulai;
        $this->data['tanggal_selesai'] = $tanggal_selesai;
    }

    // Tampilkan view laporan
    $this->render_template('reports/produksi', $this->data);
}
}