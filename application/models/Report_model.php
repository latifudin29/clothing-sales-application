<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends MY_Model
{
    public function get()
    {
        $this->db->select('*');
        $this->db->from('order_detail');
        $this->db->join('orders', 'order_detail.id_orders = orders.id');
        $this->db->join('product', 'order_detail.id_product = product.id');
        $query = $this->db->get();
        return $query;
    }
    function gettahun()
    {
        $query = $this->db->query("SELECT YEAR(created_at) AS tahun FROM 
        order_detail GROUP BY YEAR(created_at) ORDER BY YEAR(created_at) ASC");
        return $query->result();
    }

    function filterbybulan($tahun1, $bulan)
    {

        $this->db->select('*');
        $this->db->from('order_detail');
        $this->db->join('orders', 'order_detail.id_orders = orders.id');
        $this->db->where('YEAR(created_at)', $tahun1);
        $this->db->where('MONTH(created_at)', $bulan);
        $this->db->order_by('created_at', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function filterbytahun($tahun2)
    {

        $this->db->select('*');
        $this->db->from('order_detail');
        $this->db->join('orders', 'order_detail.id_orders = orders.id');
        $this->db->where('YEAR(created_at)', $tahun2);
        $this->db->order_by('created_at', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
