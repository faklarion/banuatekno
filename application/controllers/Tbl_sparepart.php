<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_sparepart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_sparepart_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_sparepart/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_sparepart/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_sparepart/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_sparepart_model->total_rows($q);
        $tbl_sparepart = $this->Tbl_sparepart_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_sparepart_data' => $tbl_sparepart,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_sparepart/tbl_sparepart_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_sparepart_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_sparepart' => $row->id_sparepart,
		'nama_sparepart' => $row->nama_sparepart,
		'stok' => $row->stok,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','tbl_sparepart/tbl_sparepart_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_sparepart'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_sparepart/create_action'),
            'id_sparepart' => set_value('id_sparepart'),
            'nama_sparepart' => set_value('nama_sparepart'),
            'stok' => set_value('stok'),
            'keterangan' => set_value('keterangan'),
            'harga_jual' => set_value('harga_jual'),
	);
        $this->template->load('template','tbl_sparepart/tbl_sparepart_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_sparepart' => $this->input->post('nama_sparepart',TRUE),
		//'stok' => $this->input->post('stok',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
        'harga_jual' => $this->input->post('harga_jual',TRUE),
	    );

            $this->Tbl_sparepart_model->insert($data);
            $this->session->set_flashdata('message', 'Tambah Data Berhasil !');
            redirect(site_url('tbl_sparepart'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_sparepart_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_sparepart/update_action'),
                'id_sparepart' => set_value('id_sparepart', $row->id_sparepart),
                'nama_sparepart' => set_value('nama_sparepart', $row->nama_sparepart),
                'stok' => set_value('stok', $row->stok),
                'harga_jual' => set_value('harga_jual', $row->harga_jual),
                'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','tbl_sparepart/tbl_sparepart_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_sparepart'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_sparepart', TRUE));
        } else {
            $data = array(
		'nama_sparepart' => $this->input->post('nama_sparepart',TRUE),
		//'stok' => $this->input->post('stok',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
        'harga_jual' => $this->input->post('harga_jual',TRUE),
	    );

            $this->Tbl_sparepart_model->update($this->input->post('id_sparepart', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('tbl_sparepart'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_sparepart_model->get_by_id($id);

        if ($row) {
            $this->Tbl_sparepart_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Data Success');
            redirect(site_url('tbl_sparepart'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_sparepart'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_sparepart', 'nama sparepart', 'trim|required');
	//$this->form_validation->set_rules('stok', 'stok', 'trim|required');
	//$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'trim|required');

	$this->form_validation->set_rules('id_sparepart', 'id_sparepart', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {

        $data = array(
            'tbl_sparepart_data' => $this->Tbl_sparepart_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_sparepart/tbl_sparepart_doc',$data);
    }

}

/* End of file Tbl_sparepart.php */
/* Location: ./application/controllers/Tbl_sparepart.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-11 13:04:27 */
/* http://harviacode.com */