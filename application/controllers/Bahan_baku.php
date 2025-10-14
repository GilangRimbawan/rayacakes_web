<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_baku extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Bahan Baku';

		$this->load->model('model_bahan_baku');
	}

	public function index()
	{
		$this->render_template('bahan_baku/index', $this->data);
	}

	public function fetchBahanBakuData()
	{
		$result = array('data' => array());

		$data = $this->model_bahan_baku->getBahanBakuData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			$buttons .= '<button type="button" class="btn btn-default" onclick="editBahanBaku('.$value['id_bahan'].')" data-toggle="modal" data-target="#editBahanBakuModal"><i class="fa fa-pencil"></i></button>';	
			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeBahanBaku('.$value['id_bahan'].')" data-toggle="modal" data-target="#removeBahanBakuModal"><i class="fa fa-trash"></i></button>';

			$result['data'][$key] = array(
				$value['nama_bahan'],
				$value['stok'],
                $value['satuan'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetchBahanBakuDataById($id)
	{
		if($id) {
			$data = $this->model_bahan_baku->getBahanBakuData($id);
			echo json_encode($data);
		}
		return false;
	}

	public function create()
	{
		$response = array();

		$this->form_validation->set_rules('nama_bahan', 'Nama Bahan', 'trim|required');
		$this->form_validation->set_rules('stok', 'Stok Awal', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'nama_bahan' => $this->input->post('nama_bahan'),
        		'stok' => $this->input->post('stok'),	
                'satuan' => $this->input->post('satuan'),	
        	);

        	$create = $this->model_bahan_baku->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Data Berhasil Disimpan';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error di database saat menyimpan data';
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function update($id)
	{
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_nama_bahan', 'Nama Bahan', 'trim|required');
			$this->form_validation->set_rules('edit_stok', 'Stok', 'trim|required|numeric');
			$this->form_validation->set_rules('edit_satuan', 'Satuan', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_bahan' => $this->input->post('edit_nama_bahan'),
	        		'stok' => $this->input->post('edit_stok'),
                    'satuan' => $this->input->post('edit_satuan'),
	        	);

	        	$update = $this->model_bahan_baku->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Data Berhasil Diperbarui';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error di database saat memperbarui data';
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error, silakan segarkan halaman';
		}

		echo json_encode($response);
	}

	public function remove()
	{
		$bahan_baku_id = $this->input->post('bahan_baku_id');

		$response = array();
		if($bahan_baku_id) {
			$delete = $this->model_bahan_baku->remove($bahan_baku_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data Berhasil Dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error di database saat menghapus data";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Error, silakan segarkan halaman";
		}

		echo json_encode($response);
	}

}