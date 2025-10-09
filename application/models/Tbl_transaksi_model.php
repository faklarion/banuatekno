<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_transaksi_model extends CI_Model
{

    public $table = 'tbl_transaksi';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('tbl_customer', 'tbl_transaksi.id_customer = tbl_customer.id_customer');
        $this->db->join('tbl_teknisi', 'tbl_transaksi.id_teknisi = tbl_teknisi.id_teknisi');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_booking()
    {
        $this->db->join('tbl_customer', 'tbl_transaksi.id_customer = tbl_customer.id_customer');
        $this->db->join('tbl_teknisi', 'tbl_transaksi.id_teknisi = tbl_teknisi.id_teknisi');
        $this->db->where('status', 1);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_transaksi()
    {
        $this->db->join('tbl_customer', 'tbl_transaksi.id_customer = tbl_customer.id_customer');
        $this->db->join('tbl_teknisi', 'tbl_transaksi.id_teknisi = tbl_teknisi.id_teknisi');
        $this->db->where('status != 1');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_performa_teknisi($id_teknisi, $awal, $akhir)
    {
            $this->db->select_sum('tbl_detail_transaksi.qty', 'total_qty');
            $this->db->join('tbl_detail_transaksi', 'tbl_detail_transaksi.id_transaksi = tbl_transaksi.id_transaksi');
            $this->db->where('tbl_transaksi.status', 2);
            $this->db->where('tbl_transaksi.id_teknisi', $id_teknisi);
            $this->db->where("tanggal_transaksi BETWEEN '$awal' AND '$akhir'");
            $query = $this->db->get('tbl_transaksi');
               // Cek dulu ada hasilnya atau tidak
    if ($query->num_rows() > 0) {
        return $query->row()->total_qty;
    } else {
        return 0; // atau NULL tergantung keperluan
    }
    }

    function get_by_tanggal($awal, $akhir)
    {
        $this->db->join('tbl_customer', 'tbl_transaksi.id_customer = tbl_customer.id_customer');
        $this->db->join('tbl_teknisi', 'tbl_transaksi.id_teknisi = tbl_teknisi.id_teknisi');
        $this->db->where('status', 1);
        $this->db->where("tanggal_transaksi BETWEEN '$awal' AND '$akhir'");
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_by_tanggal_transaksi($awal, $akhir)
    {
        $this->db->join('tbl_customer', 'tbl_transaksi.id_customer = tbl_customer.id_customer');
        $this->db->join('tbl_teknisi', 'tbl_transaksi.id_teknisi = tbl_teknisi.id_teknisi');
        $this->db->where('status != 1');
        $this->db->where("tanggal_transaksi BETWEEN '$awal' AND '$akhir'");
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('tbl_customer', 'tbl_transaksi.id_customer = tbl_customer.id_customer');
        $this->db->join('tbl_teknisi', 'tbl_transaksi.id_teknisi = tbl_teknisi.id_teknisi');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_detail_by_id($id)
    {
        $this->db->join('tbl_jasa', 'tbl_jasa.id_jasa = tbl_detail_transaksi.id_jasa');
        $this->db->where($this->id, $id);
        return $this->db->get('tbl_detail_transaksi')->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('id_customer', $q);
        $this->db->or_like('id_teknisi', $q);
        $this->db->or_like('jenis_pembayaran', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('tanggal_selesai', $q);
        $this->db->or_like('tanggal_transaksi', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('id_customer', $q);
        $this->db->or_like('id_teknisi', $q);
        $this->db->or_like('jenis_pembayaran', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('tanggal_selesai', $q);
        $this->db->or_like('tanggal_transaksi', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function delete_detail($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('tbl_detail_transaksi');
    }

}

/* End of file Tbl_transaksi_model.php */
/* Location: ./application/models/Tbl_transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2025-06-13 00:48:00 */
/* http://harviacode.com */