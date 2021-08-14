<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
            $keyword_product = array(
                                'keyword_sess' => $keyword
                            );
            $this->session->set_userdata($keyword_product);
        } else {
            $keyword = $this->session->userdata('keyword_sess');
        }
        $config['base_url'] = site_url('admin/product/index');
        if ($keyword == null) {
            $this->db->from('tbl_product');
        } else {
            $this->db->from('tbl_product');
            if ($keyword != '') {
                $this->db->like('nama_product' , $keyword);
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
        $data["data_product"] = $this->M_product->get_data_product($config["per_page"], $data['page'], $keyword);
        $data['pagination'] = $this->pagination->create_links();
        $data["order"] = $this->M_order->get_count_order();
        $data['template'] = "admin/product";
		$this->load->view('admin/template',$data);
    }

    public function upload(){
        if (isset($_FILES['gambar'])) {
            $file_name = $_FILES['gambar']['name'];
            $file_size = $_FILES['gambar']['size'];
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $file_type =$_FILES['gambar']['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $errors = array();
            $extensions = array("jpeg","jpg","png");
            if (in_array($file_ext,$extensions)===false) {
                $errors[]="file tidak didukung, gunakan ekstensi jpeg,jpg dan png";
            }
            if ($file_size > 2097152) {
                $errors[]="Ukuran file harus lebih kecil dari 2 MB";
            }
            if (empty($errors)===true) {
                move_uploaded_file($file_tmp, "assets/images/".$file_name);
                $response['error']=false;
                $response['message']="assets/images/".$file_name;
            }else{
                $response['error']=true;
                $response['message']=$errors;
            }
            echo json_encode($response);
        }
    }

    public function delete_image(){
        if (unlink($_POST['gambar'])) {
            $response['error']=false;
            $response['message']="Success";
        }else{
            $response['error']=true;
            $response['message']="Failed";
        }
        echo json_encode($response);
    }

    function save(){
        $username = $this->session->userdata('username');
        $user=$this->M_product->get_user_by_username($username);
        $cek_nama_product = $this->M_product->cek_duplicate_data($this->input->post('nama'));
        if ($cek_nama_product->total == '0') {
            $data = array(
                'nama_product' => $this->input->post('nama'), 
                'harga_product' => $this->input->post('harga'), 
                'deskripsi_product' => $this->input->post('deskripsi'),
                'image_product' => $this->input->post('gambar_value'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'id_user' => $user->id_user
            );
            $this->M_product->add_product($data,'tbl_product');
            $this->session->set_flashdata('message_success', 'Product berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('message_error', 'Nama product sudah ada.');
        }
        redirect('admin/product');
    }

    function delete(){
        $product_id = $this->input->post('id_product');
        $product_img = $this->input->post('img_product');
        unlink($product_img);
        $this->M_product->delete($product_id);
        $this->session->set_flashdata('message_success', 'Product berhasil dihapus.');
        redirect('admin/product');
    }

    public function get_product_by_id(){
        $product_id=$this->input->post('product_id');
        $data=$this->M_product->get_product_by_id($product_id);
        echo json_encode($data);
    }

    function update(){
        $username = $this->session->userdata('username');
        $user=$this->M_product->get_user_by_username($username);
        $data = array(
            'nama_product' => $this->input->post('nama_edit'), 
            'harga_product' => $this->input->post('harga_edit'), 
            'deskripsi_product' => $this->input->post('deskripsi_edit'),
            'image_product' => $this->input->post('gambar_value_edit'),
            'id_user' => $user->id_user,
            'updated_at' => date("Y-m-d H:i:s")
        );
        $where = array(
                        'id_product' => $this->input->post('id_product_edit')
                      );
        $this->M_product->update_product($where,$data,'tbl_product');
        $this->session->set_flashdata('message_success', 'Product berhasil diupdate.');
        redirect('admin/product');
    }

}
