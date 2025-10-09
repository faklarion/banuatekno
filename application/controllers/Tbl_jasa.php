<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_jasa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_jasa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_jasa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_jasa/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_jasa/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_jasa_model->total_rows($q);
        $tbl_jasa = $this->Tbl_jasa_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_jasa_data' => $tbl_jasa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_jasa/tbl_jasa_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_jasa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jasa' => $row->id_jasa,
		'nama_jasa' => $row->nama_jasa,
		'harga_jasa' => $row->harga_jasa,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','tbl_jasa/tbl_jasa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jasa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_jasa/create_action'),
	    'id_jasa' => set_value('id_jasa'),
	    'nama_jasa' => set_value('nama_jasa'),
	    'harga_jasa' => set_value('harga_jasa'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->template->load('template','tbl_jasa/tbl_jasa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jasa' => $this->input->post('nama_jasa',TRUE),
		'harga_jasa' => $this->input->post('harga_jasa',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Tbl_jasa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_jasa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jasa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_jasa/update_action'),
		'id_jasa' => set_value('id_jasa', $row->id_jasa),
		'nama_jasa' => set_value('nama_jasa', $row->nama_jasa),
		'harga_jasa' => set_value('harga_jasa', $row->harga_jasa),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','tbl_jasa/tbl_jasa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jasa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jasa', TRUE));
        } else {
            $data = array(
		'nama_jasa' => $this->input->post('nama_jasa',TRUE),
		'harga_jasa' => $this->input->post('harga_jasa',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Tbl_jasa_model->update($this->input->post('id_jasa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_jasa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_jasa_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jasa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_jasa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jasa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jasa', 'nama jasa', 'trim|required');
	$this->form_validation->set_rules('harga_jasa', 'harga jasa', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_jasa', 'id_jasa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_jasa.doc");

        $data = array(
            'tbl_jasa_data' => $this->Tbl_jasa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_jasa/tbl_jasa_doc',$data);
    }

}

/* End of file Tbl_jasa.php */
/* Location: ./application/controllers/Tbl_jasa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-11 13:58:57 */
/* http://harviacode.com */