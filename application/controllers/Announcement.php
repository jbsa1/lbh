<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Announcement extends CI_Controller
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
        $data['arsip'] = $this->Front_model->get_arsip_announcement();
        $data['announcement'] = $this->Front_model->get_announcement();
        $data['title'] = 'LBH| Pengumuman';
        $this->load->view('front/header', $data);
        $this->load->view('announcement/index');
        $this->load->view('front/footer');
    }

    public function view_announcement($id_announcement)
    {
        $data['others'] = $this->Front_model->get_other_announcement($id_announcement);
        $data['announcement'] = $this->Front_model->get_announcement($id_announcement);
        $data['title'] = 'LBH | ' . $data['announcement']['title'];
        $this->load->view('front/header', $data);
        $this->load->view('announcement/announcement');
        $this->load->view('front/footer');
    }

    public function year($year)
    {
        $data['arsip'] = $this->Front_model->get_arsip_announcement($year);
        $data['announcement'] = $this->Front_model->get_announcement();
        $data['title'] = 'LBH | Pengumuman';
        $this->load->view('front/header', $data);
        $this->load->view('announcement/arsip');
        $this->load->view('front/footer');
    }
}

/* End of file Announcement.php */
