<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_cart extends CI_Model{
    public function add($data){
        $this->db->trans_start();
        $this->db->select('iCartId AS id, iCount AS count');
        $this->db->where($data);
        $this->db->from('cart');
        $this->db->trans_complete();
        $count = $this->db->get()->row_array();

        if($count == null){
            $data['iCount'] = 1;

            $this->db->trans_start();
            $this->db->insert('cart', $data);
            $this->db->trans_complete();
            
            return array(
                'status' => 'success',
                'message' => 'Item has been added to cart successfully.'
            );
        }
        else{
            $this->db->trans_start();
            $this->db->where('iCartId', $count['id']);

            // update count after where
            $data['iCount'] = $count['count'] + 1;
            if($data['iCount'] <= 0){
                $this->db->where('iCartId', $count['id']);
                $this->db->delete('cart');
            }else{
                $this->db->update('cart', $data);
            }
            $this->db->trans_complete();
            
            return array(
                'status' => 'success',
                'message' => 'Item has been added to cart successfully.'
            );
        }

        return $count;
    }

    public function update($data){
        $this->db->trans_start();
        $this->db->select('iCount AS count');
        $this->db->where('iCartId', $data['iCartId']);
        $this->db->from('cart');
        $this->db->trans_complete();
        $count = $this->db->get()->row_array();

        $this->db->trans_start();
        $this->db->where('iCartId', $data['iCartId']);

        // update count after where
        $data['iCount'] += $count['count'];
        if($data['iCount'] <= 0){
            $this->db->where('iCartId', $data['iCartId']);
            $this->db->delete('cart');
        }else{
            $this->db->update('cart', $data);
        }
        $this->db->trans_complete();
        
        return array(
            'status' => 'success',
            'message' => 'Item has been added to cart successfully.'
        );

        return $count;
    }

    public function count($data){
        $this->db->trans_start();
		$this->db->where($data);
		$this->db->from('cart');
		$this->db->trans_complete();

		if($this->db->trans_status() === TRUE){
			return $this->db->get()->num_rows();
		}
		else{
			return array(
				'status' => 'failed',
				'message' => 'Query not executed'
			);
		}
    }

    public function list($data){
        $this->db->trans_start();
        $this->db->select('iCartId AS id, iProductId AS product_id, iCount AS count, tTime AS time');
        $this->db->where($data);
        $this->db->from('cart');
        $this->db->order_by('iCartId', 'desc');
        $this->db->trans_complete();

        if($this->db->trans_status() === TRUE){
			return $this->db->get()->result_array();
		}
		else{
			return array(
				'status' => 'failed',
				'message' => 'Query not executed'
			);
		}
    }
}