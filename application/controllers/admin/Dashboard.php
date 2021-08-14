<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        $data["order"] = $this->M_order->get_count_order();
        $data['template'] = "admin/dashboard";
		$this->load->view('admin/template',$data);
    }

}
