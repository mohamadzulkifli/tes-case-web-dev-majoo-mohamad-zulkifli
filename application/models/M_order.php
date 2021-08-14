<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    class M_order extends CI_Model{

        public function get_data_order($limit=null, $start=null, $keyword=null)
        {
            if ($limit == null && $start == null) {
                $this->db->select('tbl_order.id_order , tbl_order.created_at , tbl_order.nama , tbl_order.email , tbl_order.no_wa , tbl_order.alamat , tbl_product.nama_product');
                $this->db->from('tbl_order');
                $this->db->join('tbl_product', 'tbl_order.id_product = tbl_product.id_product');
                $query = $this->db->get();
                return $query->result();
            } else {
                if ($keyword == null) {
                    $this->db->select('tbl_order.id_order , tbl_order.created_at , tbl_order.nama , tbl_order.email , tbl_order.no_wa , tbl_order.alamat , tbl_product.nama_product');
                    $this->db->from('tbl_order');
                    $this->db->join('tbl_product', 'tbl_order.id_product = tbl_product.id_product');
                    $this->db->limit($limit, $start);
                    $query = $this->db->get();
                } else {
                    $this->db->select('tbl_order.id_order , tbl_order.created_at , tbl_order.nama , tbl_order.email , tbl_order.no_wa , tbl_order.alamat , tbl_product.nama_product');
                    $this->db->from('tbl_order');
                    $this->db->join('tbl_product', 'tbl_order.id_product = tbl_product.id_product');
                    if ($keyword != '') {
                        $this->db->like('nama_product' , $keyword);
                        $this->db->or_like('nama',$keyword); 
                    }
                    $this->db->limit($limit, $start);
                    $query = $this->db->get();
                }
                return $query;
            }
        }

        public function get_product_by_name($product_nama){
            $this->db->select('*');
            $this->db->from('tbl_product');
            $this->db->where('nama_product' , $product_nama);
            $query = $this->db->get();
            return $query->row();
        }
        
        public function delete($id_order)
        {
            $this->db->delete('tbl_order', array('id_order' => $id_order));
        }

        public function update_status($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        public function get_count_order(){
            $this->db->select('COUNT(id_order) as total');
            $this->db->from('tbl_order');
            $this->db->where('status' , '0');
            $query = $this->db->get();
            return $query->row();
        }

        public function get_last_order()
        {
            $this->db->select('id_order');
            $this->db->from('tbl_order');
            $this->db->order_by('id_order', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row();
        }

        public function get_data_order_detil($id)
        {
            $this->db->select('tbl_order.created_at , tbl_order.nama , tbl_order.email , tbl_order.no_wa , tbl_order.alamat , tbl_product.nama_product , tbl_product.harga_product , tbl_product.deskripsi_product , tbl_product.image_product');
            $this->db->from('tbl_order');
            $this->db->join('tbl_product', 'tbl_order.id_product = tbl_product.id_product');
            $this->db->where('tbl_order.id_order' , $id);
            $query = $this->db->get();
            return $query->row();
        }
	
    }

?>
