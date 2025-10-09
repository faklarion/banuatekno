<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pembelian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_pembelian_model');
        $this->load->model('Tbl_sparepart_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_pembelian/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_pembelian/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_pembelian/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_pembelian_model->total_rows($q);
        $tbl_pembelian = $this->Tbl_pembelian_model->get_all();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_pembelian_data' => $tbl_pembelian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_pembelian/tbl_pembelian_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_pembelian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pembelian' => $row->id_pembelian,
		'id_sparepart' => $row->id_sparepart,
		'harga' => $row->harga,
		'jumlah' => $row->jumlah,
		'supplier' => $row->supplier,
		'tanggal_pembelian' => $row->tanggal_pembelian,
	    );
            $this->template->load('template','tbl_pembelian/tbl_pembelian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pembelian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_pembelian/create_action'),
	    'id_pembelian' => set_value('id_pembelian'),
	    'id_sparepart' => set_value('id_sparepart'),
	    'harga' => set_value('harga'),
	    'jumlah' => set_value('jumlah'),
	    'supplier' => set_value('supplier'),
	    'tanggal_pembelian' => set_value('tanggal_pembelian'),
	);
        $this->template->load('template','tbl_pembelian/tbl_pembelian_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_sparepart' => $this->input->post('id_sparepart',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'supplier' => $this->input->post('supplier',TRUE),
		'tanggal_pembelian' => $this->input->post('tanggal_pembelian',TRUE),
	    );

            $this->Tbl_pembelian_model->insert($data);
            $this->session->set_flashdata('message', 'Tambah Data Berhasil !');
            redirect(site_url('tbl_pembelian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pembelian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_pembelian/update_action'),
		'id_pembelian' => set_value('id_pembelian', $row->id_pembelian),
		'id_sparepart' => set_value('id_sparepart', $row->id_sparepart),
		'harga' => set_value('harga', $row->harga),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'supplier' => set_value('supplier', $row->supplier),
		'tanggal_pembelian' => set_value('tanggal_pembelian', $row->tanggal_pembelian),
	    );
            $this->template->load('template','tbl_pembelian/tbl_pembelian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pembelian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pembelian', TRUE));
        } else {
            $data = array(
		'id_sparepart' => $this->input->post('id_sparepart',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'supplier' => $this->input->post('supplier',TRUE),
		'tanggal_pembelian' => $this->input->post('tanggal_pembelian',TRUE),
	    );

            $this->Tbl_pembelian_model->update($this->input->post('id_pembelian', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_pembelian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pembelian_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pembelian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_pembelian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pembelian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_sparepart', 'id sparepart', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
	$this->form_validation->set_rules('supplier', 'supplier', 'trim|required');
	$this->form_validation->set_rules('tanggal_pembelian', 'tanggal pembelian', 'trim|required');

	$this->form_validation->set_rules('id_pembelian', 'id_pembelian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        $awal   = $this->input->get('tanggal_awal');
        $akhir  = $this->input->get('tanggal_akhir');

        $data = array(
            'tbl_pembelian_data' => $this->Tbl_pembelian_model->get_by_tanggal($awal, $akhir),
            'start' => 0,
            'periode' => 'Periode '.tgl_indo($awal).' - '.tgl_indo($akhir).'',
        );
        
        $this->load->view('tbl_pembelian/tbl_pembelian_doc',$data);
    }

}

/* End of file Tbl_pembelian.php */
/* Location: ./application/controllers/Tbl_pembelian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-11 13:22:53 */
/* http://harviacode.com */