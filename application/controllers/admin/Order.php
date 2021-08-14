<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username')=="") 
        {
            redirect('admin/login');
        }
    }

    public function index()
    {
        if ($this->input->post('btn-cari')) {
            $keyword = $this->input->post('search');
            $keyword_order = array(
                                'keyword_order_sess' => $keyword
                            );
            $this->session->set_userdata($keyword_order);
        } else {
            $keyword = $this->session->userdata('keyword_order_sess');
        }
        $config['base_url'] = site_url('admin/order/index');
        if ($keyword == null) {
            $this->db->from('tbl_order');
            $this->db->join('tbl_product', 'tbl_order.id_product = tbl_product.id_product');
        } else {
            $this->db->from('tbl_order');
            $this->db->join('tbl_product', 'tbl_order.id_product = tbl_product.id_product');
            if ($keyword != '') {
                $this->db->like('nama_product' , $keyword);
                $this->db->or_like('nama',$keyword); 
            }
        }
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["data_order"] = $this->M_order->get_data_order($config["per_page"], $data['page'], $keyword);
        $data['pagination'] = $this->pagination->create_links();
        $datastatus = array(
            'status' => '1',
            'updated_at' => date("Y-m-d H:i:s")
        );
        $where = array(
                        'status' => '0'
                      );
        $this->M_order->update_status($where,$datastatus,'tbl_order');
        $data["order"] = $this->M_order->get_count_order();
        $data['template'] = "admin/order";
		$this->load->view('admin/template',$data);
    }

    public function get_product_by_name(){
        $product_nama=$this->input->post('product_nama');
        $data=$this->M_order->get_product_by_name($product_nama);
        echo json_encode($data);
    }

    function delete(){
        $id_order = $this->input->post('id_order');
        $this->M_order->delete($id_order);
        $this->session->set_flashdata('message_success', 'Pesanan berhasil dihapus.');
        redirect('admin/order');
    }

}
