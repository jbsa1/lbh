<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function add_post($data)
    {
        // Insert post
        $this->db->insert('post', $data);
        if ($this->db->affected_rows() > 0) {
            $post_id = $this->db->insert_id();
            // Insert category and id_post to have_category
            $status = 0;
            $category = $_POST['category'];
            foreach ($category as $cat) {
                $data = [
                    'id_post'       => $post_id,
                    'id_category'   => $cat
                ];
                $this->db->insert('have_category', $data);
                $status++;
            }
            // Cek insert category
            if ($status == count($category)) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> Postingan berhasil disimpan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            } else {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal menyimpan !</strong> gagal menyimpan kategori post
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            }
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal menyimpan !</strong> gagal menyimpan post
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function get_post($id_post = NULL)
    {
        if ($id_post == NULL) {
            // Get post
            $this->db->select('*, p.date_created as date_created, DATE_FORMAT(p.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author a', 'a.id_author=p.id_author');
            $this->db->order_by('p.date_created', 'desc');
            $this->db->order_by('p.id_post', 'desc');
            $post = $this->db->get('post p')->result_array();
            // Get category
            foreach ($post as $key => $p) {
                $this->db->join('category c', 'c.id_category=h.id_category');
                $categories = $this->db->get_where('have_category h', ['h.id_post' => $p['id_post']])->result_array();
                $p['categories'] = $categories;
                $posts[] = $p;
            }
            return $posts;
        } else {
            // Get post
            $this->db->select('*, DATE_FORMAT(p.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author a', 'a.id_author=p.id_author');
            $this->db->order_by('p.date_created', 'desc');
            $this->db->order_by('p.id_post', 'desc');
            $post = $this->db->get_where('post p', ['p.id_post' => $id_post])->row_array();
            // Get category
            $this->db->join('category c', 'c.id_category=h.id_category');
            $categories = $this->db->get_where('have_category h', ['h.id_post' => $post['id_post']])->result_array();
            $post['categories'] = $categories;
            return $post;
        }
    }

    public function edit_post($data)
    {
        // Edit post
        $this->db->where('id_post', $data['id_post']);
        $this->db->update('post', $data);
        // Cek edit post
        $status = 0;
        if ($this->db->affected_rows() > 0) {
            $status++;
        }

        // Delete category lama
        $this->db->where('id_post', $data['id_post']);
        $this->db->delete('have_category');
        // Insert category and id_post to have_category
        $category = $_POST['category'];
        $statusCategory = 0;
        foreach ($category as $cat) {
            $data = [
                'id_post'       => $data['id_post'],
                'id_category'   => $cat
            ];
            $this->db->insert('have_category', $data);
            $statusCategory++;
        }
        // Cek insert category
        if ($statusCategory == count($category)) {
            $status++;
        }

        // Cek status edit
        if ($status > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Postingan berhasil diedit
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong> tidak ada perubahan terdeteksi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function delete_post($id_post)
    {
        // Delete have category
        $this->db->where('id_post', $id_post);
        $this->db->delete('have_category');

        // Delete post
        $this->db->where('id_post', $id_post);
        $this->db->delete('post');

        // Cek delete post
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Postingan berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function get_category_value_set($id_post)
    {
        $categories = $this->db->get_where('have_category h', ['id_post' => $id_post])->result_array();
        $post_cat = '';
        foreach ($categories as $key => $cat) {
            $post_cat .= $cat['id_category'] . ',';
        }
        return substr($post_cat, 0, -1);
    }

    public function add_announcement($data)
    {
        // Insert post
        $this->db->insert('announcement', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Pengumuman telah dipubliskasikan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Pengumuman gagal dipubliskasikan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function edit_announcement($data, $id_announcement)
    {
        // Insert post
        $this->db->where('id_announcement', $id_announcement);
        $this->db->update('announcement', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Perubahan pengumuman telah disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function edit_running_text($data)
    {
        // Insert post
        $this->db->update('websetting', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Running text telah disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function delete_announcement($id_announcement)
    {
        $this->db->where('id_announcement', $id_announcement);
        $this->db->delete('announcement');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Success !</strong> Pengumuman telah dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'true';
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show mb-3" role="alert">
                    <strong>Failed !</strong> Pengumuman gagal dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'false';
        }
    }

    public function add_page($data)
    {
        // Insert post
        $this->db->insert('page', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Halaman telah ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal menyimpan !</strong> Halaman gagal ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function edit_page($data, $id_page)
    {
        // Insert post
        $this->db->where('id_page', $id_page);
        $this->db->update('page', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Halaman berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function add_menu($data)
    {
        $this->db->insert('menu', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Success !</strong> Menu berhasil ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'true';
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <strong>Failed !</strong> Menu gagal ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'false';
        }
    }

    public function edit_menu($data, $id_menu)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('menu', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Success !</strong> Menu berhasil diedit
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'true';
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show mb-3" role="alert">
                    <strong>Tidak ada perubahan !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'false';
        }
    }

    public function delete_page($id_page)
    {
        // Delete page
        $this->db->where('id_page', $id_page);
        $this->db->delete('page');

        // Cek delete page
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Halaman berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function get_menu($id_menu = NULL)
    {
        if ($id_menu == NULL) {
            $this->db->order_by('urutan', 'asc');
            $menus = $this->db->get('menu')->result_array();
            $data = [];
            foreach ($menus as $key => $menu) {
                $data[] = $menu;
                if ($menu['tipe'] == 'dropdown') {
                    $data[$key]['submenu'] = json_decode($data[$key]['submenu'], true);
                }
            }
            return $data;
        } else {
            $this->db->order_by('urutan', 'asc');
            $menu = $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array();
            if ($menu['tipe'] == 'dropdown') {
                $menu['submenu'] = json_decode($menu['submenu'], true);
            }
            return $menu;
        }
    }

    public function save_sort_menu($urutanMenu)
    {
        $count = 0;
        foreach ($urutanMenu as $key => $id) {
            $data = [
                'urutan'    => $key + 1
            ];
            $this->db->where('id_menu', $id);
            $this->db->update('menu', $data);
            if ($this->db->affected_rows() > 0) {
                $count++;
            }
        }
        if ($count > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Success !</strong> Menu telah berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'true';
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show mb-3" role="alert">
                    <strong>Failed !</strong> Tidak ada perubahan pada menu
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'false';
        }
    }

    public function delete_menu($id_menu)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->delete('menu');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                    <strong>Success !</strong> Menu telah dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'true';
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show mb-3" role="alert">
                    <strong>Failed !</strong> Menu gagal dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return 'false';
        }
    }

    public function add_category($data)
    {
        $this->db->insert('category', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Kategori berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Kategori gagal disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function edit_category($data, $id_category)
    {
        $this->db->where('id_category', $id_category);
        $this->db->update('category', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Perubahan telah disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function delete_category($id_category)
    {
        $this->db->where('id_category', $id_category);
        $this->db->delete('category');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Kategori berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Gagal menghapus kategori
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function get_user($id_author = NULL)
    {
        if ($id_author == NULL) {
            // Get post
            $author = $this->db->get('author')->result_array();
            return $author;
        } else {
            // Get post
            $author = $this->db->get_where('author', ['id_author' => $id_author])->row_array();
            return $author;
        }
    }

    public function add_user($data)
    {
        $this->db->insert('author', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Postingan berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Postingan gagal disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function edit_user($data, $id_author)
    {
        $this->db->where('id_author', $id_author);
        $this->db->update('author', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Postingan berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function reset_password_user($data, $id_author)
    {
        $this->db->where('id_author', $id_author);
        $this->db->update('author', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Password telah direset
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong> Gagal mereset password
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function edit_password($data, $id_author, $password_old)
    {
        // Get user
        $user = $this->db->get_where('author', ['id_author' => $id_author])->row_array();
        if (password_verify($password_old, $user['password'])) {
            $this->db->where('id_author', $id_author);
            $this->db->update('author', $data);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> Password telah direset
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            } else {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <strong>Tidak ada perubahan !</strong> Gagal mereset password
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            }
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Password yang anda masukkan salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function delete_user($id_author)
    {
        $this->db->where('id_author', $id_author);
        $this->db->delete('author');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Postingan berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Gagal menghapus postingan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function get_download($id_download = NULL)
    {
        if ($id_download == NULL) {
            // Get download file
            $this->db->join('category c', 'c.id_category=d.kategori_file', 'LEFT');
            $this->db->order_by('d.id_download', 'desc');
            $download = $this->db->get('download d')->result_array();
            return $download;
        } else {
            // Get download file
            $this->db->join('category c', 'c.id_category=d.kategori_file', 'LEFT');
            $this->db->order_by('d.id_download', 'desc');
            $download = $this->db->get_where('download d', ['d.id_download' => $id_download])->row_array();
            return $download;
        }
    }

    public function add_download($data)
    {
        $this->db->insert('download', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> File telah diupload
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> File gagal diupload
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    public function delete_download($id)
    {
        $this->db->where('id_download', $id);
        $this->db->delete('download');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> File telah dihapus dari server
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    <strong>Tidak ada perubahan !</strong> Gagal menghapus file dari server
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }

    private function _uploadImage($inputfile, $path, $prefix = 'IMG_', $alias = NULL)
    {
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

/* End of file Admin_model.php */
