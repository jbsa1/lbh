<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Front_model');
        define('MENU', $this->Front_model->get_menu());
    }

    public function view_post($id_post)
    {
        $data['announcement'] = $this->Front_model->get_other_announcement();
        $data['others'] = $this->Front_model->get_other_post($id_post);
        $data['post'] = $this->Front_model->get_post($id_post);
        $data['title'] = 'LBH Surabaya ' . $data['post']['title'];
        $this->load->view('front/header', $data);
        $this->load->view('front/post');
        $this->load->view('front/footer');
    }

    public function cari_post($key)
    {
        $data = $this->Front_model->cari_post($key);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

/* End of file Post.php */
