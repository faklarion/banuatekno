<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_customer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_customer/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_customer/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_customer/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_customer_model->total_rows($q);
        $tbl_customer = $this->Tbl_customer_model->get_all();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_customer_data' => $tbl_customer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_customer/tbl_customer_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_customer_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_customer' => $row->id_customer,
		'nama_customer' => $row->nama_customer,
		'alamat_customer' => $row->alamat_customer,
		'nohp_customer' => $row->nohp_customer,
		'email_customer' => $row->email_customer,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','tbl_customer/tbl_customer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_customer'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_customer/create_action'),
	    'id_customer' => set_value('id_customer'),
	    'nama_customer' => set_value('nama_customer'),
	    'alamat_customer' => set_value('alamat_customer'),
	    'nohp_customer' => set_value('nohp_customer'),
	    'email_customer' => set_value('email_customer'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->template->load('template','tbl_customer/tbl_customer_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_customer' => $this->input->post('nama_customer',TRUE),
		'alamat_customer' => $this->input->post('alamat_customer',TRUE),
		'nohp_customer' => $this->input->post('nohp_customer',TRUE),
		'email_customer' => $this->input->post('email_customer',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Tbl_customer_model->insert($data);
            $this->session->set_flashdata('message', 'Berhasiil Menambahkan Data !');
            redirect(site_url('tbl_customer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_customer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_customer/update_action'),
		'id_customer' => set_value('id_customer', $row->id_customer),
		'nama_customer' => set_value('nama_customer', $row->nama_customer),
		'alamat_customer' => set_value('alamat_customer', $row->alamat_customer),
		'nohp_customer' => set_value('nohp_customer', $row->nohp_customer),
		'email_customer' => set_value('email_customer', $row->email_customer),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','tbl_customer/tbl_customer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_customer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_customer', TRUE));
        } else {
            $data = array(
		'nama_customer' => $this->input->post('nama_customer',TRUE),
		'alamat_customer' => $this->input->post('alamat_customer',TRUE),
		'nohp_customer' => $this->input->post('nohp_customer',TRUE),
		'email_customer' => $this->input->post('email_customer',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Tbl_customer_model->update($this->input->post('id_customer', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_customer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_customer_model->get_by_id($id);

        if ($row) {
            $this->Tbl_customer_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_customer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_customer', 'nama customer', 'trim|required');
	$this->form_validation->set_rules('alamat_customer', 'alamat customer', 'trim|required');
	$this->form_validation->set_rules('nohp_customer', 'nohp customer', 'trim|required');
	$this->form_validation->set_rules('email_customer', 'email customer', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_customer', 'id_customer', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_customer.doc");

        $data = array(
            'tbl_customer_data' => $this->Tbl_customer_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_customer/tbl_customer_doc',$data);
    }

}

/* End of file Tbl_customer.php */
/* Location: ./application/controllers/Tbl_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-11 12:18:57 */
/* http://harviacode.com */