<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        // Check login
        if (isset($_SESSION['login'])) {
            redirect('admin');
            die;
        }

        $data['title'] = 'LBH | Login';
        $this->load->view('auth/login', $data);
    }

    public function proses_login()
    {
        // Check login
        if (isset($_SESSION['login'])) {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Get user
            $user = $this->db->get_where('author', ['username' => $username]);

            // Check username
            if ($user->num_rows() > 0) {
                $userdata = $user->row_array();
                $password_hash = $userdata['password'];
                if (password_verify($password, $password_hash)) {
                    $_SESSION['login'] = true;
                    $_SESSION['id_user'] = $userdata['id_author'];
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('status', '
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <strong>Password salah !</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <strong>Username salah !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['id_user']);
        redirect('login');
    }
}

/* End of file Auth.php */
