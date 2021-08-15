<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Front_model extends CI_Model
{

    // public function sendmail()
    // {
    //     if(isset($_POST['submit_email']))
    // }

    public function get_post($id_post = NULL)
    {
        if ($id_post == NULL) {
            // Get post
            $this->db->select('*, DATE_FORMAT(p.date_created, "%d %M %Y") as date_created_formated');
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



    public function get_post_group()
    {
        // Get category
        $this->db->select('p.id_post, h.id_category, c.category, COUNT(p.id_post) as jumlah');
        $this->db->group_by('h.id_category');
        $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
        $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
        $categories = $this->db->get('have_category h')->result_array();

        // Get downloadable file
        $file = [];
        foreach ($categories as $key => $cat) {
            // Get file data
            $this->db->select('');
            $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
            $this->db->join('post p', 'p.id_post=h.id_post' ,'LEFT');
            $this->db->order_by('p.id_post', 'desc');
            $post = $this->db->get_where('have_category h', ['h.id_category' => $cat['id_category']])->result_array();
            
            // Create data
            $file[] = [
                'header'    => [
                    'category'  => $cat['category'],
                    'jumlah'    => $cat['jumlah']
                ],
                'body'      => $post
            ];
        }
        return $file;
    }

    public function pers()
    {
        // Get category
        $this->db->select('p.id_post, h.id_category, c.category, COUNT(p.id_post) as jumlah');
        $this->db->group_by('h.id_category');
        $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
        $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
        $categories = $this->db->get('have_category h')->result_array();

        // Get downloadable file
        $file = [];
        foreach ($categories as $key => $cat) {
            // Get file data
            $this->db->select('');
            $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
            $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
            $this->db->order_by('p.id_post', 'desc');
            $post = $this->db->get_where('have_category h', ['h.id_category' => '8'])->result_array();

            // Create data
            $file[] = [
                'header'    => [
                    'category'  => $cat['category'],
                    'jumlah'    => $cat['jumlah']
                ],
                'body'      => $post
            ];
        }
        return $file;
    }

    public function berita()
    {
        // Get category
        $this->db->select('p.id_post, h.id_category, c.category, COUNT(p.id_post) as jumlah');
        $this->db->group_by('h.id_category');
        $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
        $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
        $categories = $this->db->get('have_category h')->result_array();

        // Get downloadable file
        $file = [];
        foreach ($categories as $key => $cat) {
            // Get file data
            $this->db->select('');
            $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
            $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
            $this->db->order_by('p.id_post', 'desc');
            $post = $this->db->get_where('have_category h', ['h.id_category' => '9'])->result_array();

            // Create data
            $file[] = [
                'header'    => [
                    'category'  => $cat['category'],
                    'jumlah'    => $cat['jumlah']
                ],
                'body'      => $post
            ];
        }
        return $file;
    }

    public function kegiatan()
    {
        // Get category
        $this->db->select('p.id_post, h.id_category, c.category, COUNT(p.id_post) as jumlah');
        $this->db->group_by('h.id_category');
        $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
        $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
        $categories = $this->db->get('have_category h')->result_array();

        // Get downloadable file
        $file = [];
        foreach ($categories as $key => $cat) {
            // Get file data
            $this->db->select('');
            $this->db->join('category c', 'c.id_category=h.id_category', 'LEFT');
            $this->db->join('post p', 'p.id_post=h.id_post', 'LEFT');
            $this->db->order_by('p.id_post', 'desc');
            $post = $this->db->get_where('have_category h', ['h.id_category' => '10'])->result_array();

            // Create data
            $file[] = [
                'header'    => [
                    'category'  => $cat['category'],
                    'jumlah'    => $cat['jumlah']
                ],
                'body'      => $post
            ];
        }
        return $file;
    }


    public function cari_post($key)
    {
        // Get post
        $this->db->select('*, DATE_FORMAT(p.date_created, "%d %M %Y") as date_created_formated');
        $this->db->join('author a', 'a.id_author=p.id_author');
        $this->db->where("p.title LIKE '%$key%'");
        $this->db->order_by('p.date_created', 'desc');
        $this->db->order_by('p.id_post', 'desc');
        $this->db->limit(4);
        $post = $this->db->get('post p')->result_array();
        $posts = [];
        // Get category
        if (count($post) > 0) {
            foreach ($post as $key => $p) {
                $this->db->join('category c', 'c.id_category=h.id_category');
                $categories = $this->db->get_where('have_category h', ['h.id_post' => $p['id_post']])->result_array();
                $p['categories'] = $categories;
                $posts[] = $p;
            }
        }
        return $posts;
    }

    



    public function get_other_post($id_post = NULL)
    {
        if ($id_post == NULL) {
            // Get post
            $this->db->select('*, DATE_FORMAT(p.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author a', 'a.id_author=p.id_author');
            $this->db->order_by('p.date_created', 'desc');
            $this->db->order_by('p.id_post', 'desc');
            $this->db->limit(6);
            $post = $this->db->get('post p')->result_array();
            $posts = [];
            // Get category
            if (count($post) > 0) {
                foreach ($post as $key => $p) {
                    $this->db->join('category c', 'c.id_category=h.id_category');
                    $categories = $this->db->get_where('have_category h', ['h.id_post' => $p['id_post']])->result_array();
                    $p['categories'] = $categories;
                    $posts[] = $p;
                }
            }
            return $posts;
        } else {
            // Get post
            $this->db->select('*, DATE_FORMAT(p.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author a', 'a.id_author=p.id_author');
            $this->db->where('p.id_post !=', $id_post);
            $this->db->order_by('p.date_created', 'desc');
            $this->db->order_by('p.id_post', 'desc');
            $this->db->limit(6);
            $post = $this->db->get('post p')->result_array();
            $posts = [];
            // Get category
            if (count($post) > 0) {
                foreach ($post as $key => $p) {
                    $this->db->join('category c', 'c.id_category=h.id_category');
                    $categories = $this->db->get_where('have_category h', ['h.id_post' => $p['id_post']])->result_array();
                    $p['categories'] = $categories;
                    $posts[] = $p;
                }
            }
            return $posts;
        }
    }

    public function get_other_download($id_download = NULL)
    {
        if ($id_download == NULL) {
            // Get post
            $this->db->order_by('d.date_created', 'desc');
            $this->db->order_by('d.id_download', 'desc');
            $this->db->limit(4);
            $download = $this->db->get('download d')->result_array();
            $downloads = [];
            // Get category
            if (count($download) > 0) {
                foreach ($download as $key => $d) {
                    $this->db->join('category c', 'c.id_category=d.kategori_file');
                    $categories = $this->db->get('download d')->result_array();
                    $d['categories'] = $categories;
                    $downloads[] = $d;
                }
            }
            return $downloads;
        } else {
            // Get post
            $this->db->where('d.id_download !=', $id_download);
            $this->db->order_by('d.date_created', 'desc');
            $this->db->order_by('d.id_download', 'desc');
            $this->db->limit(4);
            $download = $this->db->get('download d')->result_array();
            $downloads = [];
            // Get category
            if (count($download) > 0) {
                foreach ($download as $key => $d) {
                    $this->db->join('category c', 'c.id_category=d.kategori_file');
                    $categories = $this->db->get('download d')->result_array();
                    $d['categories'] = $categories;
                    $downloads[] = $d;
                }
            }
            return $downloads;
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

    public function get_announcement($id_announcement = NULL)
    {
        if ($id_announcement == NULL) {
            $this->db->select('*, a.date_created as date_created, DATE_FORMAT(a.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
            $this->db->join('category c', 'c.id_category=a.id_category', 'LEFT');
            $this->db->order_by('a.date_created', 'desc');
            $this->db->order_by('a.id_announcement', 'desc');
            $data = $this->db->get('announcement a')->result_array();
            return $data;
        } else {
            $this->db->select('*, DATE_FORMAT(a.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
            $this->db->join('category c', 'c.id_category=a.id_category', 'LEFT');
            $data = $this->db->get_where('announcement a', ['a.id_announcement' => $id_announcement])->row_array();
            return $data;
        }
    }

    public function get_other_announcement($id_announcement = NULL)
    {
        if ($id_announcement == NULL) {
            $this->db->select('*, DATE_FORMAT(a.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
            $this->db->order_by('a.date_created', 'desc');
            $this->db->order_by('a.id_announcement', 'desc');
            $this->db->limit(10);
            $data = $this->db->get('announcement a')->result_array();
            return $data;
        } else {
            $this->db->select('*, DATE_FORMAT(a.date_created, "%d %M %Y") as date_created_formated');
            $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
            $this->db->where('a.id_announcement !=', $id_announcement);
            $this->db->order_by('a.date_created', 'desc');
            $this->db->order_by('a.id_announcement', 'desc');
            $this->db->limit(10);
            $data = $this->db->get('announcement a')->result_array();
            return $data;
        }
    }

    public function get_arsip_announcement($year = NULL)
    {
        if ($year == NULL) {
            $this->db->select('YEAR(a.date_created) as tahun, COUNT(a.id_announcement) as jumlah');
            $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
            $this->db->join('category c', 'c.id_category=a.id_category', 'LEFT');
            $this->db->order_by('a.date_created', 'desc');
            $this->db->order_by('a.id_announcement', 'desc');
            $this->db->group_by('a.date_created');
            $data = $this->db->get('announcement a')->result_array();
            return $data;
        } else {
            $this->db->select('*, DATE_FORMAT(a.date_created, "%d %M %Y") as date_created_formated, DATE_FORMAT(a.date_created, "%M") as bulan, YEAR(a.date_created) as tahun');
            $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
            $this->db->where('YEAR(a.date_created)', $year);
            $this->db->order_by('a.date_created', 'desc');
            $this->db->order_by('a.id_announcement', 'desc');
            $data = $this->db->get('announcement a')->result_array();
            return $data;
        }
    }

    public function get_pengumuman_terkini()
    {
        // Get max id
        $this->db->select('MAX(id_announcement) as maks');
        $maks = $this->db->get('announcement')->row_array()['maks'];
        // Get pengumuman
        $this->db->select('*, DATE_FORMAT(a.date_created, "%d %M %Y") as date_created_formated, DATE_FORMAT(a.date_created, "%M") as bulan, YEAR(a.date_created) as tahun');
        $this->db->join('author au', 'au.id_author=a.id_author', 'LEFT');
        $this->db->where('a.id_announcement', $maks);
        $this->db->order_by('a.date_created', 'desc');
        $this->db->order_by('a.id_announcement', 'desc');
        $data = $this->db->get('announcement a')->row_array();
        return $data;
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

    public function get_download_group()
    {
        // Get category
        $this->db->select('d.kategori_file, c.category, COUNT(d.id_download) as jumlah');
        $this->db->group_by('d.kategori_file');
        $this->db->join('category c', 'c.id_category=d.kategori_file', 'LEFT');
        $categories = $this->db->get('download d')->result_array();

        // Get downloadable file
        $file = [];
        foreach ($categories as $key => $cat) {
            // Get file data
            $this->db->join('category c', 'c.id_category=d.kategori_file', 'LEFT');
            $this->db->order_by('d.id_download', 'desc');
            $download = $this->db->get_where('download d', ['d.kategori_file' => $cat['kategori_file']])->result_array();
            // Create data
            $file[] = [
                'header'    => [
                    'category'  => $cat['category'],
                    'jumlah'    => $cat['jumlah']
                ],
                'body'      => $download
            ];
        }
        return $file;
    }
}

/* End of file Front_model.php */
