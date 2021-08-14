<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    class M_login extends CI_Model{

        public function cek_user($username,$password) 
        {
            $sql = "SELECT username FROM tbl_user WHERE username='".$username."' AND password='".$password."'";
            $query = $this->db->query($sql);
            return $query;
        }
	
    }

?>
