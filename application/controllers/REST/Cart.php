<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') !== true) {
            $data = array(
                'status' => 'failed',
                'message' => 'Invalid user.'
            );
            echo json_encode($data);
            exit;
        }
        $this->load->model('Model_cart');
    }

    public function add()
    {
        $post_data = $this->input->post();
        // print_r($post_data);exit;

        $data = array(
            'iProductId' => $post_data['product_id'],
            'iUserId' => $this->session->userdata('userid'),
            'eStatus' => 'Active'
        );

        $result = $this->Model_cart->add($data); //print_r($result);exit;
        $result = json_encode($result);

        echo $result;
    }

    public function update()
    {
        $post_data = $this->input->post();
        // print_r($post_data);exit;


        $data = array(
            'iCartId' => $post_data['cart_id'],
            'iUserId' => $this->session->userdata('userid'),
            'iCount' => $post_data['count'],
            'eStatus' => 'Active'
        );

        $result = $this->Model_cart->update($data); //print_r($result);exit;
        $result = json_encode($result);

        echo $result;
    }

    public function count()
    {
        $get_data = $this->input->get();
        // print_r($get_data);exit;

        $data = array(
            'iUserId' => $this->session->userdata('userid')
        );

        $result = $this->Model_cart->count($data); //print_r($result);exit;

        // for($i = 0; $i < count($result); $i++){
        //     $result[$i]['path'] = RECORDING_PATH . '/' . $result[$i]['name'];
        // }

        $result = json_encode($result);

        echo $result;
    }

    public function list()
    {
        $get_data = $this->input->get();
        // print_r($get_data);exit;

        $data = array(
            'iUserId' => $this->session->userdata('userid'),
            'eStatus' => 'Active'
        );

        $result = $this->Model_cart->list($data); //print_r($result);exit;
        $result = json_encode($result);

        echo $result;
    }
}
