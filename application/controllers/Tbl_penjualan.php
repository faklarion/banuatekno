<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_penjualan_model');
        $this->load->model('Tbl_customer_model');
        $this->load->model('Tbl_sparepart_model');
        $this->load->library('form_validation');
        $this->load->library('cart');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_penjualan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_penjualan/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_penjualan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_penjualan_model->total_rows($q);
        $tbl_penjualan = $this->Tbl_penjualan_model->get_all();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_penjualan_data' => $tbl_penjualan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_penjualan/tbl_penjualan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_penjualan_model->get_by_id($id);
        
        $data = array(
		    'row' => $row,
	    );
        
        $this->load->view('tbl_penjualan/tbl_penjualan_read', $data);
       
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_penjualan/create_action'),
            'id_customer' => set_value('id_customer'),
            'id_penjualan' => set_value('id_penjualan'),
            'jenis_pembayaran' => set_value('jenis_pembayaran'),
            'tanggal_penjualan' => set_value('tanggal_penjualan'),
	);
        $this->template->load('template','tbl_penjualan/tbl_penjualan_form', $data);
    }
    
    public function create_action() 
    {
            $data_order = array('tanggal_penjualan' => date('Y-m-d'),
                                'id_customer' => $this->input->post('id_customer'),
                                'jenis_pembayaran' => $this->input->post('jenis_pembayaran'));
            $this->Tbl_penjualan_model->insert($data_order);
            $id_penjualan = $this->db->insert_id();
        //-------------------------Input data detail order-----------------------
        if ($cart = $this->cart->contents())
            {
                foreach ($cart as $item)
                    {
                        $data_detail = array('id_penjualan' =>$id_penjualan,
                                        'id_sparepart' => $item['id'],
                                        'qty' => $item['qty'],
                                        'tanggal' => date('Y-m-d'),
                                        'harga' => $item['price']);
                        $this->db->insert('tbl_detail_penjualan', $data_detail);
                    }
                    $this->session->set_flashdata('message', 'Penjualan Berhasil !!');
                    $this->cart->destroy();
                    redirect(site_url('tbl_penjualan'));
            } else {
                $this->session->set_flashdata('message', 'Pilih Item Terlebih Dahulu !!');
                $this->Tbl_penjualan_model->delete($id_penjualan);
                $this->cart->destroy();
                redirect(site_url('tbl_penjualan/create'));
			}    
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_penjualan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_penjualan/update_action'),
		'id_customer' => set_value('id_customer', $row->id_customer),
		'id_penjualan' => set_value('id_penjualan', $row->id_penjualan),
		'jenis_pembayaran' => set_value('jenis_pembayaran', $row->jenis_pembayaran),
		'tanggal_penjualan' => set_value('tanggal_penjualan', $row->tanggal_penjualan),
	    );
            $this->template->load('template','tbl_penjualan/tbl_penjualan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_penjualan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penjualan', TRUE));
        } else {
            $data = array(
		'id_customer' => $this->input->post('id_customer',TRUE),
		'jenis_pembayaran' => $this->input->post('jenis_pembayaran',TRUE),
		'tanggal_penjualan' => $this->input->post('tanggal_penjualan',TRUE),
	    );

            $this->Tbl_penjualan_model->update($this->input->post('id_penjualan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_penjualan'));
        }
    }
    
        public function delete($id) 
    {
        $row = $this->Tbl_penjualan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_penjualan_model->delete_detail($id);
            $this->Tbl_penjualan_model->delete($id);           
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_penjualan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_penjualan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	$this->form_validation->set_rules('jenis_pembayaran', 'jenis pembayaran', 'trim|required');
	$this->form_validation->set_rules('tanggal_penjualan', 'tanggal penjualan', 'trim|required');

	$this->form_validation->set_rules('id_penjualan', 'id_penjualan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        $awal   = $this->input->get('tanggal_awal');
        $akhir  = $this->input->get('tanggal_akhir');

        $data = array(
            'tbl_penjualan_data' => $this->Tbl_penjualan_model->get_by_tanggal($awal,$akhir),
            'start' => 0,
            'periode' => 'Periode '.tgl_indo($awal).' - '.tgl_indo($akhir).'',
        );
        
        $this->load->view('tbl_penjualan/tbl_penjualan_doc',$data);
    }

    public function tambah_cart()
	{

        $sparepart = $this->Tbl_sparepart_model->get_by_id($this->input->post('id_sparepart'));

        $stok = $sparepart->stok;

        if($this->input->post('qty') > $stok) {
            $this->session->set_flashdata('message', 'Maaf, stok produk tidak mencukupi. Sisa stok: ' . $stok);
            redirect('tbl_penjualan/create'); 
        } else {
        $data_produk= array('id' => $this->input->post('id_sparepart'),
							 'name' => $this->input->post('nama_sparepart'),
							 'price' => $this->input->post('harga_jual'),
							 'qty' =>$this->input->post('qty')
							);
            $this->cart->insert($data_produk);
            redirect('tbl_penjualan/create');
        }
	}

    public function hapus_cart($rowid)
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
		redirect('tbl_penjualan/create');
	}

}

/* End of file Tbl_penjualan.php */
/* Location: ./application/controllers/Tbl_penjualan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-13 08:16:33 */
/* http://harviacode.com */