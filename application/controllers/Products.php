<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Produk Kue'; // Judul halaman diubah

        // Hanya load model yang kita perlukan
        $this->load->model('model_products');
        $this->load->model('model_category');
    }

    public function index()
    {
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('products/index', $this->data);  
    }

    public function fetchProductData()
    {
        $result = array('data' => array());
        $data = $this->model_products->getProductData();

        foreach ($data as $key => $value) {
            // Tombol aksi
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
                $buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }
            if(in_array('deleteProduct', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            
            $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            // Menyiapkan label stok rendah
            $qty_status = '';
            if($value['qty'] <= 10 && $value['qty'] > 0) { // Stok dianggap rendah jika 10 atau kurang
                $qty_status = ' <span class="label label-warning">Stok Rendah!</span>';
            } else if($value['qty'] <= 0) { // Stok habis
                $qty_status = ' <span class="label label-danger">Habis!</span>';
            }

            // Data yang dikirim ke tabel (sudah disederhanakan)
            $result['data'][$key] = array(
                $img,
                $value['name'],
                $value['price'],
                $value['qty'] . $qty_status,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }   

    public function create()
    {
        if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        // Validasi form yang disederhanakan
        $this->form_validation->set_rules('product_name', 'Nama Kue', 'trim|required');
        $this->form_validation->set_rules('price', 'Harga', 'trim|required|numeric');
        $this->form_validation->set_rules('qty', 'Stok', 'trim|required|numeric');
        
        if ($this->form_validation->run() == TRUE) {
            // true case
            $upload_image = $this->upload_image();

            // Data yang disimpan (sudah disederhanakan)
            $data = array(
                'name' => $this->input->post('product_name'),
                'price' => $this->input->post('price'),
                'qty' => $this->input->post('qty'),
                'image' => $upload_image,
                'description' => $this->input->post('description'),
                'category_id' => json_encode($this->input->post('category')),
            );

            $create = $this->model_products->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Produk Kue berhasil ditambahkan');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Terjadi error!!');
                redirect('products/create', 'refresh');
            }
        }
        else {
            // false case
            // Hanya mengambil data kategori yang diperlukan
            $this->data['category'] = $this->model_category->getActiveCategroy();          
            $this->render_template('products/create', $this->data);
        }   
    }

    public function upload_image()
    {
        // Fungsi upload gambar tidak perlu diubah
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048'; // Ukuran maks 2MB

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;          
        }
    }

    public function update($product_id)
    {       
        if(!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

        // Validasi form yang disederhanakan
        $this->form_validation->set_rules('product_name', 'Nama Kue', 'trim|required');
        $this->form_validation->set_rules('price', 'Harga', 'trim|required|numeric');
        $this->form_validation->set_rules('qty', 'Stok', 'trim|required|numeric');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            // Data yang diupdate (sudah disederhanakan)
            $data = array(
                'name' => $this->input->post('product_name'),
                'price' => $this->input->post('price'),
                'qty' => $this->input->post('qty'),
                'description' => $this->input->post('description'),
                'category_id' => json_encode($this->input->post('category')),
            );

            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $data['image'] = $upload_image;
            }

            $update = $this->model_products->update($data, $product_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Produk Kue berhasil diperbarui');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Terjadi error!!');
                redirect('products/update/'.$product_id, 'refresh');
            }
        }
        else {
            // false case
            $this->data['category'] = $this->model_category->getActiveCategroy();           

            $product_data = $this->model_products->getProductData($product_id);
            $this->data['product_data'] = $product_data;
            $this->render_template('products/edit', $this->data); 
        }   
    }

    public function remove()
    {
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Berhasil dihapus"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error di database saat menghapus data";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Silakan segarkan halaman kembali!!";
        }

        echo json_encode($response);
    }
}