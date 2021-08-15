<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Front_model');
        define('MENU', $this->Front_model->get_menu());
    }


    public function index()
    {
        $data['announcement'] = $this->Front_model->get_other_announcement();
        $data['infoTerkini'] = $this->Front_model->get_pengumuman_terkini();
        $data['download'] = $this->Front_model->get_other_download();
        $data['post'] = $this->Front_model->get_other_post();
        $data['title'] = 'LBH Surabaya';
        $this->load->view('front/header', $data);
        $this->load->view('front/index');
        $this->load->view('front/footer');
    }

    
    
}

/* End of file Front.php */
