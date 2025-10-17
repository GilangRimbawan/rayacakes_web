<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Produksi';
        $this->load->model('model_produksi');
        $this->load->model('model_resep'); 
    }

    public function index()
    {
        $this->render_template('produksi/index', $this->data);
    }

    public function fetchProduksiData()
    {
        $result = array('data' => array());
        $data = $this->model_produksi->getProduksiData();

        // INI BAGIAN YANG DIPERBAIKI (=> hanya satu kali)
        foreach ($data as $key => $value) {
            // Tombol aksi diperbarui
            $buttons = '';
            // Tombol Hapus memanggil fungsi removeFunc()
            $buttons .= '<a href="'.base_url('produksi/detail/'.$value['id_produksi']).'" class="btn btn-default"><i class="fa fa-eye"></i> Detail</a>';
            $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id_produksi'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

            $tanggal = date('d-m-Y H:i', strtotime($value['tanggal_produksi']));

            $result['data'][$key] = array(
                $tanggal,
                $value['nama_produk'],
                $value['jumlah_produksi'],
                $buttons
            );
        }
        echo json_encode($result);
    }
    
    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('resep', 'Resep', 'trim|required');
            $this->form_validation->set_rules('jumlah', 'Jumlah Produksi', 'trim|required|numeric|greater_than[0]');

            if ($this->form_validation->run() == TRUE) {
                $create = $this->model_produksi->create(); 
                if($create == true) {
                    $this->session->set_flashdata('success', 'Data produksi berhasil disimpan dan stok telah diperbarui');
                    redirect('produksi', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi error saat memproses data');
                    redirect('produksi/create', 'refresh');
                }
            }
        }
        
        $this->data['resep'] = $this->model_resep->getResepData();
        $this->render_template('produksi/create', $this->data);
    }

    public function remove()
    {
        $produksi_id = $this->input->post('produksi_id');

        $response = array();
        if($produksi_id) {
            $delete = $this->model_produksi->remove($produksi_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Data produksi berhasil dibatalkan dan stok telah dikembalikan"; 
            } else {
                $response['success'] = false;
                $response['messages'] = "Error saat membatalkan data";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Error, silakan segarkan halaman";
        }

        echo json_encode($response);
    }

    public function detail($id)
    {
        if(!$id) {
            redirect('dashboard', 'refresh');
        }

        // Ambil data utama produksi & detail bahan baku yang digunakan dari model
        $this->data['produksi_data'] = $this->model_produksi->getProduksiDataById($id);
        $this->data['bahan_terpakai'] = $this->model_produksi->getBahanBakuUsage($id);

        $this->render_template('produksi/detail', $this->data);
    }
}