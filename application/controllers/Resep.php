<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->data['page_title'] = 'Resep';
        
        $this->load->model('model_resep');
        $this->load->model('model_products');
        $this->load->model('model_bahan_baku');
    }

    public function index()
    {
        $this->render_template('resep/index', $this->data);
    }

    public function fetchResepData()
    {
        $result = array('data' => array());
        $data = $this->model_resep->getResepData();
        foreach ($data as $key => $value) {
            $buttons = '';
            // Tombol Edit dan Hapus sekarang memanggil fungsi JavaScript
            $buttons .= '<a href="'.base_url('resep/update/'.$value['id_resep']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id_resep'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';

            $result['data'][$key] = array(
                $value['nama_resep'],
                $value['nama_produk'],
                $buttons
            );
        }
        echo json_encode($result);
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('nama_resep', 'Nama Resep', 'trim|required');
            $this->form_validation->set_rules('id_produk', 'Produk Kue', 'trim|required');
            $this->form_validation->set_rules('bahan_baku[]', 'Bahan Baku', 'trim|required');
            $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'trim|required|numeric');

            if ($this->form_validation->run() == TRUE) {
                $create = $this->model_resep->create(); 
                if($create == true) {
                    $this->session->set_flashdata('success', 'Resep berhasil ditambahkan');
                    redirect('resep', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi error saat menyimpan data');
                    redirect('resep/create', 'refresh');
                }
            }
        }

        $this->data['products'] = $this->model_products->getProductData();
        $this->data['bahan_baku'] = $this->model_bahan_baku->getBahanBakuData();
        $this->render_template('resep/create', $this->data);
    }

    public function update($id)
    {
        if(!$id) {
            redirect('dashboard', 'refresh');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('nama_resep', 'Nama Resep', 'trim|required');
            $this->form_validation->set_rules('id_produk', 'Produk Kue', 'trim|required');
            $this->form_validation->set_rules('bahan_baku[]', 'Bahan Baku', 'trim|required');
            $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'trim|required|numeric');

            if ($this->form_validation->run() == TRUE) {
                $update = $this->model_resep->update($id); 
                if($update == true) {
                    $this->session->set_flashdata('success', 'Resep berhasil diperbarui');
                    redirect('resep', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi error saat memperbarui data');
                    redirect('resep/update/'.$id, 'refresh');
                }
            }
        }

        $this->data['resep'] = $this->model_resep->getResepDataById($id);
        $this->data['resep_detail'] = $this->model_resep->getResepDetailData($id);
        $this->data['products'] = $this->model_products->getProductData();
        $this->data['bahan_baku'] = $this->model_bahan_baku->getBahanBakuData();
        $this->render_template('resep/edit', $this->data);
    }

    public function remove()
    {
        $resep_id = $this->input->post('resep_id');

        $response = array();
        if($resep_id) {
            $delete = $this->model_resep->remove($resep_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Resep berhasil dihapus"; 
            } else {
                $response['success'] = false;
                $response['messages'] = "Error saat menghapus data";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Error, segarkan halaman";
        }
        echo json_encode($response);
    }
}