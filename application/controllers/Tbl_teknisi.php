<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_teknisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_teknisi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_teknisi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_teknisi/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_teknisi/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_teknisi_model->total_rows($q);
        $tbl_teknisi = $this->Tbl_teknisi_model->get_all();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_teknisi_data' => $tbl_teknisi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_teknisi/tbl_teknisi_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_teknisi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_teknisi' => $row->id_teknisi,
		'nama_teknisi' => $row->nama_teknisi,
		'alamat_teknisi' => $row->alamat_teknisi,
		'nohp_teknisi' => $row->nohp_teknisi,
		'email_teknisi' => $row->email_teknisi,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','tbl_teknisi/tbl_teknisi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_teknisi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_teknisi/create_action'),
	    'id_teknisi' => set_value('id_teknisi'),
	    'nama_teknisi' => set_value('nama_teknisi'),
	    'alamat_teknisi' => set_value('alamat_teknisi'),
	    'nohp_teknisi' => set_value('nohp_teknisi'),
	    'email_teknisi' => set_value('email_teknisi'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->template->load('template','tbl_teknisi/tbl_teknisi_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_teknisi' => $this->input->post('nama_teknisi',TRUE),
		'alamat_teknisi' => $this->input->post('alamat_teknisi',TRUE),
		'nohp_teknisi' => $this->input->post('nohp_teknisi',TRUE),
		'email_teknisi' => $this->input->post('email_teknisi',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Tbl_teknisi_model->insert($data);
            $this->session->set_flashdata('message', 'Tambah Data Berhasil !');
            redirect(site_url('tbl_teknisi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_teknisi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_teknisi/update_action'),
                'id_teknisi' => set_value('id_teknisi', $row->id_teknisi),
                'nama_teknisi' => set_value('nama_teknisi', $row->nama_teknisi),
                'alamat_teknisi' => set_value('alamat_teknisi', $row->alamat_teknisi),
                'nohp_teknisi' => set_value('nohp_teknisi', $row->nohp_teknisi),
                'email_teknisi' => set_value('email_teknisi', $row->email_teknisi),
                'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','tbl_teknisi/tbl_teknisi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_teknisi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_teknisi', TRUE));
        } else {
            $data = array(
                'nama_teknisi' => $this->input->post('nama_teknisi',TRUE),
                'alamat_teknisi' => $this->input->post('alamat_teknisi',TRUE),
                'nohp_teknisi' => $this->input->post('nohp_teknisi',TRUE),
                'email_teknisi' => $this->input->post('email_teknisi',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Tbl_teknisi_model->update($this->input->post('id_teknisi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_teknisi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_teknisi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_teknisi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_teknisi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_teknisi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_teknisi', 'nama teknisi', 'trim|required');
	$this->form_validation->set_rules('alamat_teknisi', 'alamat teknisi', 'trim|required');
	$this->form_validation->set_rules('nohp_teknisi', 'nohp teknisi', 'trim|required');
	$this->form_validation->set_rules('email_teknisi', 'email teknisi', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_teknisi', 'id_teknisi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_teknisi.doc");

        $data = array(
            'tbl_teknisi_data' => $this->Tbl_teknisi_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_teknisi/tbl_teknisi_doc',$data);
    }

}

/* End of file Tbl_teknisi.php */
/* Location: ./application/controllers/Tbl_teknisi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-11 12:37:22 */
/* http://harviacode.com */