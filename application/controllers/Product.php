<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
        $data['template'] = "product";
		$data['data_product'] = $this->M_product->get_data_product();
		$this->load->view('template' , $data);
	}

	function order(){
        $last_id = $this->M_order->get_last_order();
        if (empty($last_id->id_order)) {
            $id = 1;
        } else {
            $id = $last_id->id_order + 1;
        }
        $data = array(
            'id_order' => $id,
            'nama' => $this->input->post('nama'), 
            'alamat' => $this->input->post('alamat'), 
            'email' => $this->input->post('email'),
            'no_wa' => $this->input->post('no_wa'),
            'id_product' => $this->input->post('id_product'),
            'status' => '0',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );
        $this->M_product->add_order($data,'tbl_order');
        redirect('product/orderdetil/'.base64_encode($id));
    }

    function orderdetil($id=null){
        $data['template'] = "order_detil";
        $data['data_order_detil'] = $this->M_order->get_data_order_detil(base64_decode($id));
        $this->load->view('template' , $data);
    }

}
