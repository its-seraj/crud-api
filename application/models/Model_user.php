<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model{
    public function login($data){
        $this->db->trans_start();
        $this->db->select('iUserId AS userid, vEmail AS email');
		$this->db->where($data);
		$this->db->from('user');
		$this->db->trans_complete();

        $data = $this->db->get()->row_array();
		if(($this->db->trans_status() === TRUE) && !empty($data)){
			return array(
                'status' => 'success',
                'message' => 'Login successful.',
				'data' => $data
            );
		}
		else{
			return array(
				'status' => 'failed',
				'message' => 'Login failed.'
			);
		}
    }
}