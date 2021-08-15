<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Check login
        if (!isset($_SESSION['login'])) {
            redirect('login');
            die;
        }

        //Load model
        $this->load->model('Admin_model');
        $this->load->model('Front_model');

        // Post and page counter
        $post_count = $this->db->get('post')->num_rows();
        $page_count = $this->db->get('page')->num_rows();
        $ann_count = $this->db->get('announcement')->num_rows();
        define('POSTCOUNT', $post_count);
        define('PAGECOUNT', $page_count);
        define('ANNCOUNT', $ann_count);

        // Define curent user
        $user = $this->db->get_where('author', ['id_author' => $_SESSION['id_user']])->row_array();
        define('USER', $user);
    }

    public function index()
    {
        redirect('admin/manage_post');
    }

    public function add_post()
    {
        if (!empty($_POST)) {
            $data = [
                'id_author'     => $_POST['id_author'],
                'title'         => $_POST['title'],
                'content'       => $_POST['content'],
                'description'   => $_POST['description'],
                'date_created'  => date('Y-m-d')
            ];
            if ($_FILES['thumbnails']['size'] != 0) {
                $data['thumbnail'] = $this->_uploadImage('thumbnails', './assets/img/thumbnails/', 'THUMB_', 'thumbnails');
            }
            $this->Admin_model->add_post($data);
            redirect('admin/manage_post');
        } else {
            $data['kategori'] = $this->db->get_where('category')->result_array();
            $data['title'] = 'Admin | Create Post';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/create-post');
            $this->load->view('admin/footer');
        }
    }

    public function manage_post()
    {
        $data['post'] = $this->Admin_model->get_post();
        $data['title'] = 'Admin | Manage Post';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-post');
        $this->load->view('admin/footer');
    }

    public function edit_post($id_post = NULL)
    {
        if (!empty($_POST)) {
            $data = [
                'id_post'       => $_POST['id_post'],
                'id_author'     => $_POST['id_author'],
                'title'         => $_POST['title'],
                'content'       => $_POST['content'],
                'description'   => $_POST['description'],
                'date_created'  => date('Y-m-d')
            ];

            // Get post
            $post = $this->db->get_where('post', ['id_post' => $_POST['id_post']])->row_array();
            if ($_FILES['thumbnails']['size'] != 0) {
                if (file_exists('./assets/img/thumbnails/' . $post['thumbnail'])) {
                    unlink('./assets/img/thumbnails/' . $post['thumbnail']);
                }
                $data['thumbnail'] = $this->_uploadImage('thumbnails', './assets/img/thumbnails/', 'THUMB_', 'thumbnails');
            }

            // Update proses
            $this->Admin_model->edit_post($data);
            redirect('admin/manage_post');
        } else {
            $data['post_cat'] = $this->Admin_model->get_category_value_set($id_post);
            $data['post'] = $this->db->get_where('post', ['id_post' => $id_post])->row_array();
            $data['kategori'] = $this->db->get('category')->result_array();
            $data['title'] = 'Admin | Edit Post';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/edit-post');
            $this->load->view('admin/footer');
        }
    }

    public function delete_post($id_post)
    {
        $post = $this->db->get_where('post', ['id_post' => $id_post])->row_array();
        if (file_exists('./assets/img/thumbnails/' . $post['thumbnail'])) {
            unlink('./assets/img/thumbnails/' . $post['thumbnail']);
        }
        $this->Admin_model->delete_post($id_post);
        redirect('admin/manage_post');
    }

    public function manage_announcement()
    {
        $data['announcement'] = $this->Front_model->get_announcement();
        $data['title'] = 'Admin | Kelola Pengumuman';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-announcement');
        $this->load->view('admin/footer');
    }

    public function add_announcement()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'title'         => $_POST['title'],
                'content'       => $_POST['content'],
                'id_author'     => $_POST['id_author'],
                'id_category'   => $_POST['id_category'],
                'date_created'  => date('Y-m-d')
            ];
            $this->Admin_model->add_announcement($data);
            redirect('admin/manage_announcement');
        } else {
            $data['kategori'] = $this->db->get('category')->result_array();
            $data['title'] = 'Admin | Buat Halaman';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/create-announcement');
            $this->load->view('admin/footer');
        }
    }

    public function edit_announcement($id_announcement = NULL)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'title'         => $_POST['title'],
                'content'       => $_POST['content'],
                'id_author'     => $_POST['id_author'],
            ];
            $this->Admin_model->edit_announcement($data, $_POST['id_announcement']);
            redirect('admin/manage_announcement');
        } else {
            $data['kategori'] = $this->db->get('category')->result_array();
            $data['announcement'] = $this->db->get_where('announcement', ['id_announcement' => $id_announcement])->row_array();
            $data['title'] = 'Admin | Edit Pengumuman';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/edit-announcement');
            $this->load->view('admin/footer');
        }
    }

    public function delete_announcement($id_announcement)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $this->Admin_model->delete_announcement($id_announcement);
        redirect('admin/manage_announcement');
    }

    public function running_text()
    {
        $data['running_text'] = $this->db->get('websetting')->row_array();
        $data['title'] = 'Admin | Running Text';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/running-text');
        $this->load->view('admin/footer');
    }

    public function edit_running_text()
    {
        $data = [
            'running_text'  => $_POST['running_text']
        ];
        $this->Admin_model->edit_running_text($data);
        redirect('admin/running_text');
    }

    public function manage_page()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $data['page'] = $this->db->get('page')->result_array();
        $data['title'] = 'Admin | Manage Post';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-page');
        $this->load->view('admin/footer');
    }

    public function add_page()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'title'         => $_POST['title'],
                'content'       => $_POST['content'],
                'url'           => $_POST['url'],
                'date_created'  => date('Y-m-d')
            ];
            $this->Admin_model->add_page($data);
            redirect('admin/manage_page');
        } else {
            $data['title'] = 'Admin | Buat Halaman';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/create-page');
            $this->load->view('admin/footer');
        }
    }

    public function edit_page($id_page = NULL)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'title'         => $_POST['title'],
                'content'       => $_POST['content'],
                'url'           => $_POST['url']
            ];
            $this->Admin_model->edit_page($data, $_POST['id_page']);
            redirect('admin/manage_page');
        } else {
            $data['page'] = $this->db->get_where('page', ['id_page' => $id_page])->row_array();
            $data['title'] = 'Admin | Edit Halaman';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/edit-page');
            $this->load->view('admin/footer');
        }
    }

    public function delete_page($id_page)
    {
        $this->Admin_model->delete_page($id_page);
        redirect('admin/manage_page');
    }

    public function check_url($url)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $check = $this->db->get_where('page', ['url' => $url])->num_rows();
        if ($check == 0) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function manage_menu()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $data['menu'] = $this->Admin_model->get_menu();
        $data['title'] = 'Admin | Kelola menu';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-menu');
        $this->load->view('admin/footer');
    }

    public function save_sort_menu()
    {
        if (!empty($_POST)) {
            $urutanMenu = $_POST['urutanMenu'];
            $status = $this->Admin_model->save_sort_menu($urutanMenu);
            echo $status;
        }
    }

    public function add_drop_menu()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'label'     => $_POST['label'],
                'submenu'   => json_encode($_POST['submenu']),
                'tipe'      => 'dropdown'
            ];
            $status = $this->Admin_model->add_menu($data);
            echo $status;
        }
    }

    public function edit_drop_menu()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'label'     => $_POST['label'],
                'submenu'   => json_encode($_POST['submenu']),
                'tipe'      => 'dropdown'
            ];
            $status = $this->Admin_model->edit_menu($data, $_POST['id_menu']);
            echo $status;
        }
    }

    public function add_single_menu()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'label'     => $_POST['label_single'],
                'url'       => $_POST['link_single'],
                'tipe'      => 'single'
            ];
            $status = $this->Admin_model->add_menu($data);
            redirect('admin/manage_menu');
        }
    }

    public function edit_single_menu()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'label'     => $_POST['label_single'],
                'url'       => $_POST['link_single'],
                'tipe'      => 'single'
            ];
            $status = $this->Admin_model->edit_menu($data, $_POST['id_menu_single']);
            redirect('admin/manage_menu');
        }
    }

    public function delete_menu($id_menu)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $this->Admin_model->delete_menu($id_menu);
        redirect('admin/manage_menu');
    }

    public function get_menu($id_menu)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $menu = $this->Admin_model->get_menu($id_menu);
        header('Content-Type: application/json');
        echo json_encode($menu);
    }

    public function manage_category()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $data['category'] = $this->db->get('category')->result_array();
        $data['title'] = 'Admin | Kelola kategori';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-category');
        $this->load->view('admin/footer');
    }

    public function add_category()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'category'         => $_POST['category'],
            ];
            $this->Admin_model->add_category($data);
            redirect('admin/manage_category');
        } else {
            $data['action'] = base_url('admin/add_category');
            $data['title'] = 'Admin | Tambah Kategori';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/form-category');
            $this->load->view('admin/footer');
        }
    }

    public function edit_category($id_category = NULL)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'category' => $_POST['category'],
            ];
            $this->Admin_model->edit_category($data, $_POST['id_category']);
            redirect('admin/manage_category');
        } else {
            $data['action'] = base_url('admin/edit_category');
            $data['title'] = 'Admin | Edit Kategori';
            $data['category'] = $this->db->get_where('category', ['id_category' => $id_category])->row_array();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/form-category');
            $this->load->view('admin/footer');
        }
    }

    public function delete_category($id_category)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $this->Admin_model->delete_category($id_category);
        redirect('admin/manage_category');
    }

    public function manage_download()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $data['download'] = $this->Admin_model->get_download();
        $data['title'] = 'Admin | Kelola download file';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-download');
        $this->load->view('admin/footer');
    }

    public function add_download()
    { 
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            
            $data = [
                'nama_file'         => $_POST['nama_file'],
                'deskripsi_file'    => $_POST['deskripsi_file'],
                'tipe_file'         => $_POST['tipe_file'],
                'size_file'         => $_POST['size_file'],
                'path_file'         => $_POST['path_file'],
                'kategori_file'     => $_POST['kategori_file'],
                'date_created'      => date('Y-m-d')
            ];
            if ($_FILES['thumbnails']['size'] != 0) {
                $data['thumbnail'] = $this->_uploadImage('thumbnails', './assets/img/thumbnails2/', 'THUMB_', 'thumbnails');
            }
            $this->Admin_model->add_download($data);
            redirect('admin/manage_download');
        } else {
            $data['kategori'] = $this->db->get('category')->result_array();
            $data['action'] = base_url('admin/add_download');
            $data['title'] = 'Admin | Tambah Download';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/form-download');
            $this->load->view('admin/footer');
        }
    }

    public function upload_download_file()
    {
        
        $folder = './assets/download_files/';
        if (!empty($_FILES)) {
            $temp_file = $_FILES['file']['tmp_name'];
            $ekstensi = explode('.', $_FILES['file']['name']);
            $ekstensi = end($ekstensi);
            $file_name = strtoupper(uniqid('FILES_')) . '.' . $ekstensi;
            $location = $folder . $file_name;
            
            if (move_uploaded_file($temp_file, $location)) {
                header('Content-Type: application/json');
                $response = [
                    'file_name' => $file_name,
                    'tipe'      => $ekstensi
                ];
                echo json_encode($response);
            } else {
                echo "failed";
            }

        


        }

    }

    public function delete_download_file($id)
    {
        $file = $this->db->get_where('download', ['id_download' => $id])->row_array();
        if (file_exists('./assets/download_files/' . $file['path_file'])) {
            unlink('./assets/download_files/' . $file['path_file']);
        }
        $this->Admin_model->delete_download($id);
        redirect('admin/manage_download');
    }

    public function manage_user()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $data['author'] = $this->Admin_model->get_user();
        $data['title'] = 'Admin | Manage User';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/manage-user');
        $this->load->view('admin/footer');
    }

    public function add_user()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'name'          => $_POST['name'],
                'username'      => $_POST['username'],
                'password'      => password_hash('12345', PASSWORD_DEFAULT),
                'role'          => $_POST['role'],
                'status'        => 'aktif',
                'date_created'  => date('Y-m-d')
            ];
            $this->Admin_model->add_user($data);
            redirect('admin/manage_user');
        } else {
            $data['action'] = base_url('admin/add_user');
            $data['title'] = 'Admin | Add User';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/form-user');
            $this->load->view('admin/footer');
        }
    }

    public function reset_password_user($id_user)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $data = [
            'password' => password_hash('12345', PASSWORD_DEFAULT)
        ];
        $this->Admin_model->reset_password_user($data, $id_user);
        redirect('admin/manage_user');
    }

    public function edit_user($id_user = NULL)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (!empty($_POST)) {
            $data = [
                'name'          => $_POST['name'],
                'username'      => $_POST['username'],
                'role'          => $_POST['role']
            ];
            $this->Admin_model->edit_user($data, $_POST['id_author']);
            redirect('admin/manage_user');
        } else {
            $data['action'] = base_url('admin/edit_user');
            $data['title'] = 'Admin | Edit User';
            $data['user'] = $this->Admin_model->get_user($id_user);
            $this->load->view('admin/header', $data);
            $this->load->view('admin/form-user');
            $this->load->view('admin/footer');
        }
    }

    public function delete_user($id_user)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $this->Admin_model->delete_user($id_user);
        redirect('admin/manage_user');
    }

    public function check_username($username)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $check = $this->db->get_where('author', ['username' => $username])->num_rows();
        if ($check == 0) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function settings()
    {
        $data['user'] = $this->Admin_model->get_user($_SESSION['id_user']);
        $data['title'] = 'Admin | Settings';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/settings');
        $this->load->view('admin/footer');
    }

    public function settings_edit_user()
    {
        if (!empty($_POST)) {
            $data = [
                'name'          => $_POST['name'],
                'username'      => $_POST['username']
            ];
            $this->Admin_model->edit_user($data, $_POST['id_author']);
            redirect('admin/settings');
        }
    }

    public function settings_edit_password()
    {
        if (!empty($_POST)) {
            $data = [
                'password'          => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            $this->Admin_model->edit_password($data, $_POST['id_author'], $_POST['password_old']);
            redirect('admin/settings');
        }
    }

    public function upload_image_post()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = './assets/img/post-images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/post-images/' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = './assets/img/post-images/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'assets/img/post-images/' . $data['file_name'];
            }
        }
    }

    public function delete_image_post()
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'Image deleted succesfully !';
        }
    }

    private function _uploadImage($inputfile, $path, $prefix = 'IMG_', $alias = NULL)
    {
        // Check role
        if (USER['role'] != 'Admin') {
            redirect('admin');
            die;
        }

        $config['upload_path']          = $path;
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = strtoupper(uniqid($prefix));
        $config['overwrite']            = false;
        $config['max_size']             = 5120;

        $this->load->library('upload', $config, $alias);
        $this->$alias->initialize($config);

        if ($this->$alias->do_upload($inputfile)) {
            $uploaddata = $this->$alias->data();
            return $uploaddata['file_name'];
        }

        return null;
    }
}

/* End of file Admin.php */
