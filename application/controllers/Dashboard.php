<?php 

class Dashboard extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Dashboard';

        // Memuat model yang kita butuhkan
        $this->load->model('model_bahan_baku'); 
		$this->load->model('model_produksi');
    }

    public function index()
    {
        // Mengambil data bahan baku kritis dari model
        $this->data['stok_kritis'] = $this->model_bahan_baku->getStokKritis();
		$this->data['produk_populer'] = $this->model_produksi->getProdukPopuler();

        $this->render_template('dashboard', $this->data);
    }
}