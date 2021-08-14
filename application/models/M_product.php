<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    class M_product extends CI_Model{

        public function get_data_product($limit=null, $start=null, $keyword=null)
        {
            if ($limit == null && $start == null) {
                $this->db->select('*');
                $this->db->from('tbl_product');
                $this->db->order_by('id_product' , 'DESC');
                $query = $this->db->get();
                return $query->result();
            } else {
                if ($keyword == null) {
                    $this->db->select('*');
                    $this->db->from('tbl_product');
                    $this->db->order_by('id_product' , 'DESC');
                    $this->db->limit($limit, $start);
                    $query = $this->db->get();
                } else {
                    $this->db->select('*');
                    $this->db->from('tbl_product');
                    if ($keyword != '') {
                        $this->db->like('nama_product' , $keyword);
                    }
                    $this->db->order_by('id_product' , 'DESC');
                    $this->db->limit($limit, $start);
                    $query = $this->db->get();
                }
                return $query;
            }
        }

        public function add_order($data,$table)
        {
            $this->db->insert($table,$data);
        }

        public function add_product($data,$table)
        {
            $this->db->insert($table,$data);
        }

        public function delete($product_id)
        {
            $this->db->delete('tbl_product', array('id_product' => $product_id));
        }

        public function get_product_by_id($product_id){
            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('id_product' , $product_id);
            $query = $this->db->get();
            return $query->row();
        }

        public function get_user_by_username($username){
            $this->db->select('*');
            $this->db->from('tbl_user');
            $this->db->where('username' , $username);
            $query = $this->db->get();
            return $query->row();
        }

        public function update_product($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        public function cek_duplicate_data($nama){
            $this->db->select('COUNT(nama_product) as total');
            $this->db->from('tbl_product');
            $this->db->where('LOWER(nama_product)' , strtolower($nama));
            $query = $this->db->get();
            return $query->row();
        }        
	
    }

?>
