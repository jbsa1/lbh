<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
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
        $page = $this->db->get_where('page', ['url' => $this->uri->segment(2)]);
        if ($page->num_rows() > 0) {
            $data['page'] = $page->row_array();
            $data['title'] = 'LBH | ' . $data['page']['title'];
            $this->load->view('front/header', $data);
            $this->load->view('page/page');
            $this->load->view('front/footer');
        } else {
            echo "Page Not Found";
        }
    }

    public function publikasi()
    {
        $data['download'] = $this->Front_model->get_download_group();
        $data['title'] = 'LBH Surabaya | Publikasi';
        $this->load->view('front/header', $data);
        $this->load->view('page/publikasi');
        $this->load->view('front/footer');
        
    }

    public function informasi()
    {
        $data['post'] = $this->Front_model->get_post_group();
        $data['title'] = 'LBH Surabaya | Informasi';
        $this->load->view('front/header', $data);
        $this->load->view('page/informasi');
        $this->load->view('front/footer');
    }

    public function pers()
    {
        $data['post'] = $this->Front_model->pers();
        
        $data['title'] = 'LBH Surabaya | Informasi';
        $this->load->view('front/header', $data);
        $this->load->view('page/pers');
        $this->load->view('front/footer');
    }

    public function berita()
    {
        $data['post'] = $this->Front_model->get_post_group();
        $data['title'] = 'LBH Surabaya | Informasi';
        $this->load->view('front/header', $data);
        $this->load->view('page/berita');
        $this->load->view('front/footer');
    }

    public function kegiatan()
    {
        $data['post'] = $this->Front_model->get_post_group();
        $data['title'] = 'LBH Surabaya | Informasi';
        $this->load->view('front/header', $data);
        $this->load->view('page/kegiatan');
        $this->load->view('front/footer');
    }

    public function konsultasi()
    {
        $data['post'] = $this->Front_model->get_post_group();
        $data['title'] = 'LBH Surabaya | Download Files';
        $this->load->view('front/header', $data);
        $this->load->view('page/konsultasi');
        $this->load->view('front/footer');
    }

    public function donasi()
    {
        $data['post'] = $this->Front_model->get_post_group();
        $data['title'] = 'LBH Surabaya | Donasi';
        $this->load->view('front/header', $data);
        $this->load->view('page/donate');
        $this->load->view('front/footer');
    }

    public function sendmail()
    {
        if(isset($_POST['submit'])){
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            if(!empty($email)){

                $config = [
                    'mailtype' => 'text',
                    'charset' => 'utf-8',
                    'porotocol' => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_user' => 'jafbsa29@gmail.com',
                    'smtp_pass' => '29september',
                    'smtp_port' => '465',
                    'crlf'    => "\r\n",
                    'newline' => "\r\n"
                ];
                $this->load->library('email', $config);
                $this->email->initialize($config);

                $this->email->from('jafbsa29@gmail.com');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($message);

                if($this->email->send()){
                    echo "Email Berhasil dikirim";
                } else {
                    show_error($this->email->print_debugger());
                }

            }
        }
    }
    

    public function download_proses($id)
    {
        $file = $this->db->get_where('download', ['id_download' => $id])->row_array();
        $file_url = base_url('assets/download_files/' . $file['path_file']);
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }
}

/* End of file Page.php */
