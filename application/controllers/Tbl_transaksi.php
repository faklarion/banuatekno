<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_transaksi_model');
        $this->load->model('Tbl_teknisi_model');
        $this->load->model('Tbl_jasa_model');
        $this->load->model('Tbl_customer_model');
        $this->load->library('form_validation');
        $this->load->library('cart');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_transaksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_transaksi/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_transaksi/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_transaksi_model->total_rows($q);
        $tbl_transaksi = $this->Tbl_transaksi_model->get_all_booking();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_transaksi_data' => $tbl_transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_transaksi/tbl_transaksi_list', $data);
    }

    public function transaksi()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_transaksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_transaksi/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_transaksi/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_transaksi_model->total_rows($q);
        $tbl_transaksi = $this->Tbl_transaksi_model->get_all_transaksi();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_transaksi_data' => $tbl_transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_transaksi/tbl_transaksi_selesai', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_transaksi_model->get_by_id($id);
        
        $data = array(
            'row' => $row,
            'status' => 'BOOKING',
	    );
        
        $this->load->view('tbl_transaksi/tbl_transaksi_read', $data);
    }

    public function read_transaksi($id) 
    {
        $row = $this->Tbl_transaksi_model->get_by_id($id);
        
        $data = array(
            'row' => $row,
            'status' => 'TRANSAKSI',
	    );
        
        $this->load->view('tbl_transaksi/tbl_transaksi_read_transaksi', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_transaksi/create_action'),
            'id_customer' => set_value('id_customer'),
            'id_teknisi' => set_value('id_teknisi'),
            'id_transaksi' => set_value('id_transaksi'),
            'jenis_pembayaran' => set_value('jenis_pembayaran'),
            'status' => set_value('status'),
            'tanggal_selesai' => set_value('tanggal_selesai'),
            'tanggal_transaksi' => set_value('tanggal_transaksi'),
	);
        $this->template->load('template','tbl_transaksi/tbl_transaksi_form', $data);
    }
    
    public function create_action() 
    {
            $data_order = array('tanggal_transaksi' => date('Y-m-d'),
                                'id_customer' => $this->input->post('id_customer'),
                                'id_teknisi' => $this->input->post('id_teknisi'),
                                'tanggal_selesai' => $this->input->post('tanggal_selesai'),
                                'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
                                'status' => 1,
                                'tipe_hp' => $this->input->post('tipe_hp'),
                                'jenis_pembayaran' => NULL);
            $this->Tbl_transaksi_model->insert($data_order);
            $id_transaksi = $this->db->insert_id();
        //-------------------------Input data detail order-----------------------
        if ($cart = $this->cart->contents())
            {
                foreach ($cart as $item)
                    {
                        $data_detail = array('id_transaksi' =>$id_transaksi,
                                        'id_jasa' => $item['id'],
                                        'qty' => $item['qty'],
                                        'tanggal' => date('Y-m-d'),
                                        'harga' => $item['price']);
                        $this->db->insert('tbl_detail_transaksi', $data_detail);
                    }
                    $this->session->set_flashdata('message', 'Transaksi Berhasil !!');
                    $this->cart->destroy();
                    redirect(site_url('tbl_transaksi'));
            } else {
                $this->session->set_flashdata('message', 'Pilih Item Terlebih Dahulu !!');
                $this->Tbl_transaksi_model->delete($id_transaksi);
                $this->cart->destroy();
                redirect(site_url('tbl_transaksi/create'));
			}    
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_transaksi/update_action'),
                'id_customer' => set_value('id_customer', $row->id_customer),
                'id_teknisi' => set_value('id_teknisi', $row->id_teknisi),
                'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
                'jenis_pembayaran' => set_value('jenis_pembayaran', $row->jenis_pembayaran),
                'status' => set_value('status', $row->status),
                'tanggal_selesai' => set_value('tanggal_selesai', $row->tanggal_selesai),
                'tanggal_transaksi' => set_value('tanggal_transaksi', $row->tanggal_transaksi),
	    );
            $this->template->load('template','tbl_transaksi/tbl_transaksi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_transaksi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
            $data = array(
                'id_customer' => $this->input->post('id_customer',TRUE),
                'id_teknisi' => $this->input->post('id_teknisi',TRUE),
                'jenis_pembayaran' => $this->input->post('jenis_pembayaran',TRUE),
                'status' => $this->input->post('status',TRUE),
                'tanggal_selesai' => $this->input->post('tanggal_selesai',TRUE),
                'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
	    );

            $this->Tbl_transaksi_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_transaksi'));
        }
    }

    
    public function selesai()
    {
        
        $data = array(
		'status' => 2,
        'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
	    );

        $id = $this->input->post('id_transaksi');

            $this->Tbl_transaksi_model->update($id, $data);
            $this->session->set_flashdata('message', 'Servis Diselesaikan');
            redirect(site_url('tbl_transaksi'));
    }

    public function batal($id) 
    {
        
        $data = array(
		'status' => 3,
        'jenis_pembayaran' => "Transaksi dibatalkan",
	    );

            $this->Tbl_transaksi_model->update($id, $data);
            $this->session->set_flashdata('message', 'Servis Dibatalkan !');
            redirect(site_url('tbl_transaksi'));
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_transaksi_model->get_by_id($id);

        if ($row) {
            $this->Tbl_transaksi_model->delete_detail($id);
            $this->Tbl_transaksi_model->delete($id);           
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_transaksi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	$this->form_validation->set_rules('id_teknisi', 'id teknisi', 'trim|required');
	$this->form_validation->set_rules('jenis_pembayaran', 'jenis pembayaran', 'trim|required');
	//$this->form_validation->set_rules('status', 'status', 'trim|required');
	//$this->form_validation->set_rules('tanggal_selesai', 'tanggal selesai', 'trim|required');
	//$this->form_validation->set_rules('tanggal_transaksi', 'tanggal transaksi', 'trim|required');

	$this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {

        $awal   = $this->input->get('tanggal_awal');
        $akhir  = $this->input->get('tanggal_akhir');

        $data = array(
            'tbl_transaksi_data' => $this->Tbl_transaksi_model->get_by_tanggal($awal, $akhir),
            'start' => 0,
            'periode' => 'Periode '.tgl_indo($awal).' - '.tgl_indo($akhir).'',
        );
        
        $this->load->view('tbl_transaksi/tbl_transaksi_doc',$data);
    }

    public function word_transaksi()
    {

        $awal   = $this->input->get('tanggal_awal');
        $akhir  = $this->input->get('tanggal_akhir');

        $data = array(
            'tbl_transaksi_data' => $this->Tbl_transaksi_model->get_by_tanggal_transaksi($awal, $akhir),
            'start' => 0,
            'periode' => 'Periode '.tgl_indo($awal).' - '.tgl_indo($akhir).'',
        );
        
        $this->load->view('tbl_transaksi/tbl_transaksi_doc_transaksi',$data);
    }

    public function word_teknisi()
    {

        $awal   = $this->input->get('tanggal_awal');
        $akhir  = $this->input->get('tanggal_akhir');

        $data = array(
            'tbl_teknisi_data' => $this->Tbl_teknisi_model->get_all(),
            'start' => 0,
            'periode' => 'Periode '.tgl_indo($awal).' - '.tgl_indo($akhir).'',
            'awal' => $awal,
            'akhir' => $akhir,
        );
        
        $this->load->view('tbl_transaksi/tbl_transaksi_doc_teknisi',$data);
    }

    public function tambah_cart()
	{
		$data_produk= array('id' => $this->input->post('id_jasa'),
							 'name' => $this->input->post('nama_jasa'),
							 'price' => $this->input->post('harga_jasa'),
							 'qty' =>$this->input->post('qty')
							);
		$this->cart->insert($data_produk);
        
		redirect('tbl_transaksi/create');
	}

    function hapus_cart($rowid)
	{
		if ($rowid == "all") {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			$this->cart->update($data);
		}
		redirect('tbl_transaksi/create');
	}
}

/* End of file Tbl_transaksi.php */
/* Location: ./application/controllers/Tbl_transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-13 00:48:00 */
/* http://harviacode.com */