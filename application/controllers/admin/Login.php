<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
		$this->load->view('admin/login');
    }

    public function proses()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$hasil = $this->M_login->cek_user($username,$password);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) 
			{
				$sess_data['username'] = $sess->username;
				$this->session->set_userdata($sess_data);
			}
			redirect('admin/dashboard');
		}
		else {
			$this->session->set_flashdata('msg_error', 'Username dan password tidak ditemukan...');
			redirect('admin/login');
		}
	}

	public function logout() 
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('keyword_sess');
		$this->session->unset_userdata('keyword_order_sess');
		session_destroy();
		redirect('admin/login');
	}

}
