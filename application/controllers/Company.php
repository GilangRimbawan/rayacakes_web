<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Info Toko'; // Diganti

		$this->load->model('model_company');
	}

    /* * Halaman ini menampilkan info toko
    * dan memproses update data
    */
	public function index()
	{  
        if(!in_array('updateCompany', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        // Validasi disederhanakan
		$this->form_validation->set_rules('company_name', 'Nama Toko', 'trim|required');
		$this->form_validation->set_rules('address', 'Alamat', 'trim');
		$this->form_validation->set_rules('phone', 'No. Telepon', 'trim');
	
        if ($this->form_validation->run() == TRUE) {
            // true case

            // Data yang disimpan disederhanakan
        	$data = array(
        		'company_name' => $this->input->post('company_name'),
        		'address' => $this->input->post('address'),
        		'phone' => $this->input->post('phone'),
        	);

        	$update = $this->model_company->update($data, 1);
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Info Toko berhasil diperbarui'); // Diganti
        		redirect('company/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Terjadi error!!'); // Diganti
        		redirect('company/index', 'refresh');
        	}
        }
        else {
            // false case
        	$this->data['company_data'] = $this->model_company->getCompanyData(1);
			$this->render_template('company/index', $this->data);			
        }	
	}
}