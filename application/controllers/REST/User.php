<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Model_user');
    }

	public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function login(){
        $post_data = $this->input->post();
        // print_r($post_data);exit;

        $data = array(
            'vEmail' => $post_data['email'],
            'vPassword' => md5($post_data['password']),
            'eStatus' => 'Active'
        );

        $result = $this->Model_user->login($data);//print_r($result);exit;

        if($result['status'] == 'success'){
            $data = array(
                'userid' => $result['data']['userid'],
                'email' => $result['data']['email'],
                'login' => true
            );
            $this->session->set_userdata($data);
            echo true;
            return;
        }

        $result = json_encode($result);

        echo $result;
    }
}
