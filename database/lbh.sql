-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2021 pada 21.53
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lbh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `announcement`
--

CREATE TABLE `announcement` (
  `id_announcement` int(11) NOT NULL,
  `id_author` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `author`
--

CREATE TABLE `author` (
  `id_author` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `author`
--

INSERT INTO `author` (`id_author`, `name`, `username`, `password`, `role`, `status`, `date_created`) VALUES
(1, 'Administrator', 'admin', '$2y$10$6zsbO6lhz3jqMRRNkz3REuf83kH1WIZTaBAWFS70L.TCE9mJKxgSy', 'Admin', 'aktif', '2020-11-03'),
(4, 'LBH Surabaya', 'lbhsby', '$2y$10$aQPfuzy3ASKMwEH8fuGPXuLpN9yONLGpsTwr9Q7aRVtu7RPfCud5G', 'Author', 'aktif', '2021-07-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `category`) VALUES
(7, 'DONASI'),
(8, 'Pers'),
(9, 'Berita'),
(10, 'Kegiatan'),
(11, 'Opini'),
(12, 'Buku'),
(13, 'Modul'),
(14, 'Catahu'),
(15, 'Penelitian'),
(16, 'Kebijakan'),
(17, 'Jurnal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id_download` int(11) NOT NULL,
  `nama_file` varchar(200) NOT NULL,
  `deskripsi_file` text NOT NULL,
  `kategori_file` varchar(50) NOT NULL,
  `tipe_file` varchar(20) NOT NULL,
  `size_file` int(11) DEFAULT NULL,
  `path_file` varchar(100) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `download`
--

INSERT INTO `download` (`id_download`, `nama_file`, `deskripsi_file`, `kategori_file`, `tipe_file`, `size_file`, `path_file`, `date_created`) VALUES
(16, 'ini ngetes lagi', 'jadi kita mau ngetes file ini bisa apa ndak muncul read more nya', '8', 'png', 85347, 'FILES_60F1595FD0E12.png', '2021-07-16'),
(17, 'musik', 'musik', '8', 'mp3', 2945044, 'FILES_60F3F59BA3EBC.mp3', '2021-07-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `have_category`
--

CREATE TABLE `have_category` (
  `id_category` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `have_category`
--

INSERT INTO `have_category` (`id_category`, `id_post`) VALUES
(7, 6),
(8, 12),
(8, 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `submenu` text DEFAULT NULL,
  `tipe` varchar(15) DEFAULT NULL COMMENT 'single, dropdown'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `urutan`, `label`, `url`, `submenu`, `tipe`) VALUES
(4, 1, 'Beranda', 'http://localhost/lbh/', NULL, 'single'),
(17, 5, 'Donasi', 'http://localhost/lbh/page/donasi', NULL, 'single'),
(18, 6, 'Konsultasi', 'http://localhost/lbh/page/konsultasi', NULL, 'single'),
(19, 3, 'informasi', 'http://localhost/lbh/page/informasi', NULL, 'single'),
(20, 2, 'Publikasi', 'http://localhost/lbh/page/publikasi', NULL, 'single'),
(21, 4, 'Merch', 'https://www.instagram.com/lbhsurabaya.store/', NULL, 'single');

-- --------------------------------------------------------

--
-- Struktur dari tabel `page`
--

CREATE TABLE `page` (
  `id_page` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `page`
--

INSERT INTO `page` (`id_page`, `title`, `content`, `url`, `date_created`) VALUES
(11, 'Sejarah', '<p>Ini halaman sejarah</p>', 'Sejarah', '2021-07-15'),
(12, 'Visi &  Misi', '<p>Ini halaman Visi &amp; Misi</p>', 'visimisi', '2021-07-15'),
(13, 'Siaran Pers', 'Ini halaman siaran Pers', 'pers', '2021-07-15'),
(14, 'Berita', '<p>Ini halaman berita</p>', 'berita', '2021-07-15'),
(15, 'Pelatihan', '<p>Ini halaman pelatihan</p>', 'pelatihan', '2021-07-15'),
(16, 'YLBHI', '<p>ini halaman YLBHI</p>', 'ylbhi', '2021-07-15'),
(17, 'Syarat dan Ketentuan Umum', '<p>Ini halaman syarat dan ketentuan umum</p><p><br></p>', 'syarat', '2021-07-15'),
(18, 'NGO', '<p>Ini halaman NGO</p>', 'NGO', '2021-07-15'),
(19, 'Kampus', '<p>ini halaman kampus</p>', 'kampus', '2021-07-15'),
(20, 'Umum', '<p>Ini halaman umum</p>\r\n\r\n\r\n<div class=\"container pb-5\">\r\n        <h1 class=\"font-weight-bold\">Download Files</h1>\r\n        <hr>\r\n\r\n        <div class=\"row\">\r\n                            <div class=\"col-lg-3 mb-4\">\r\n                    <div class=\"list-group\" id=\"list-tab\" role=\"tablist\">\r\n                                                    <a class=\"list-group-item list-group-item-action active\" id=\"list-0-list\" data-toggle=\"list\" href=\"#list-0\" role=\"tab\" aria-controls=\"0\">\r\n                                Inkubator Bisnis                                <span class=\"badge badge-danger badge-pill float-right\">1</span>\r\n                            </a>\r\n                                                    <a class=\"list-group-item list-group-item-action \" id=\"list-1-list\" data-toggle=\"list\" href=\"#list-1\" role=\"tab\" aria-controls=\"1\">\r\n                                Penelitian                                <span class=\"badge badge-danger badge-pill float-right\">2</span>\r\n                            </a>\r\n                                                    <a class=\"list-group-item list-group-item-action \" id=\"list-2-list\" data-toggle=\"list\" href=\"#list-2\" role=\"tab\" aria-controls=\"2\">\r\n                                Pengabdian Masyarakat                                <span class=\"badge badge-danger badge-pill float-right\">1</span>\r\n                            </a>\r\n                                                    <a class=\"list-group-item list-group-item-action \" id=\"list-3-list\" data-toggle=\"list\" href=\"#list-3\" role=\"tab\" aria-controls=\"3\">\r\n                                UMUM                                <span class=\"badge badge-danger badge-pill float-right\">2</span>\r\n                            </a>\r\n                                                    <a class=\"list-group-item list-group-item-action \" id=\"list-4-list\" data-toggle=\"list\" href=\"#list-4\" role=\"tab\" aria-controls=\"4\">\r\n                                Program NonLitDimas                                <span class=\"badge badge-danger badge-pill float-right\">1</span>\r\n                            </a>\r\n                                            </div>\r\n                </div>\r\n                <div class=\"col-lg-9\">\r\n                    <div class=\"tab-content\" id=\"nav-tabContent\">\r\n                                                    <div class=\"tab-pane fade show active\" id=\"list-0\" role=\"tabpanel\" aria-labelledby=\"list-0-list\">\r\n                                <div class=\"card\">\r\n                                    <div class=\"card-body\">\r\n                                                                                <div class=\"table-responsive\">\r\n                                            <table class=\"table table-hover border dataTable\">\r\n                                                <thead>\r\n                                                    <tr>\r\n                                                        <th style=\"width: 30px; text-align: center;\">No</th>\r\n                                                        <th>Nama File</th>\r\n                                                        <th>Size</th>\r\n                                                        <th>Kategori</th>\r\n                                                        <th>Tanggal</th>\r\n                                                        <th class=\"text-center\" style=\"width: 130px;\">Opsi</th>\r\n                                                    </tr>\r\n                                                </thead>\r\n                                                <tbody>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">1</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>Panduan Pra Startup - Startup .</td>\r\n                                                            <td>0.94 MB</td>\r\n                                                            <td>Inkubator Bisnis</td>\r\n                                                            <td>2021-05-18</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/39\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                    </tbody>\r\n                                            </table>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                                                    <div class=\"tab-pane fade show \" id=\"list-1\" role=\"tabpanel\" aria-labelledby=\"list-1-list\">\r\n                                <div class=\"card\">\r\n                                    <div class=\"card-body\">\r\n                                                                                <div class=\"table-responsive\">\r\n                                            <table class=\"table table-hover border dataTable\">\r\n                                                <thead>\r\n                                                    <tr>\r\n                                                        <th style=\"width: 30px; text-align: center;\">No</th>\r\n                                                        <th>Nama File</th>\r\n                                                        <th>Size</th>\r\n                                                        <th>Kategori</th>\r\n                                                        <th>Tanggal</th>\r\n                                                        <th class=\"text-center\" style=\"width: 130px;\">Opsi</th>\r\n                                                    </tr>\r\n                                                </thead>\r\n                                                <tbody>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">1</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>RENSTRA PENELITIAN UPNV JATIM 2021-2026.</td>\r\n                                                            <td>1.52 MB</td>\r\n                                                            <td>Penelitian</td>\r\n                                                            <td>2021-03-16</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/34\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">2</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>Buku Panduan LITDIMAS Dana Internal 2021.</td>\r\n                                                            <td>1.77 MB</td>\r\n                                                            <td>Penelitian</td>\r\n                                                            <td>2021-02-25</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/31\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                    </tbody>\r\n                                            </table>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                                                    <div class=\"tab-pane fade show \" id=\"list-2\" role=\"tabpanel\" aria-labelledby=\"list-2-list\">\r\n                                <div class=\"card\">\r\n                                    <div class=\"card-body\">\r\n                                                                                <div class=\"table-responsive\">\r\n                                            <table class=\"table table-hover border dataTable\">\r\n                                                <thead>\r\n                                                    <tr>\r\n                                                        <th style=\"width: 30px; text-align: center;\">No</th>\r\n                                                        <th>Nama File</th>\r\n                                                        <th>Size</th>\r\n                                                        <th>Kategori</th>\r\n                                                        <th>Tanggal</th>\r\n                                                        <th class=\"text-center\" style=\"width: 130px;\">Opsi</th>\r\n                                                    </tr>\r\n                                                </thead>\r\n                                                <tbody>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">1</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>Buku Panduan LITDIMAS Dana Internal 2021.</td>\r\n                                                            <td>1.77 MB</td>\r\n                                                            <td>Pengabdian Masyarakat</td>\r\n                                                            <td>2021-02-25</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/32\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                    </tbody>\r\n                                            </table>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                                                    <div class=\"tab-pane fade show \" id=\"list-3\" role=\"tabpanel\" aria-labelledby=\"list-3-list\">\r\n                                <div class=\"card\">\r\n                                    <div class=\"card-body\">\r\n                                                                                <div class=\"table-responsive\">\r\n                                            <table class=\"table table-hover border dataTable\">\r\n                                                <thead>\r\n                                                    <tr>\r\n                                                        <th style=\"width: 30px; text-align: center;\">No</th>\r\n                                                        <th>Nama File</th>\r\n                                                        <th>Size</th>\r\n                                                        <th>Kategori</th>\r\n                                                        <th>Tanggal</th>\r\n                                                        <th class=\"text-center\" style=\"width: 130px;\">Opsi</th>\r\n                                                    </tr>\r\n                                                </thead>\r\n                                                <tbody>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">1</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>Katsinov dan Perhitungan TKT.</td>\r\n                                                            <td>0.18 MB</td>\r\n                                                            <td>UMUM</td>\r\n                                                            <td>2021-04-29</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/36\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">2</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>Pusat Studi.</td>\r\n                                                            <td>0.03 MB</td>\r\n                                                            <td>UMUM</td>\r\n                                                            <td>2021-03-16</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/35\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                    </tbody>\r\n                                            </table>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                                                    <div class=\"tab-pane fade show \" id=\"list-4\" role=\"tabpanel\" aria-labelledby=\"list-4-list\">\r\n                                <div class=\"card\">\r\n                                    <div class=\"card-body\">\r\n                                                                                <div class=\"table-responsive\">\r\n                                            <table class=\"table table-hover border dataTable\">\r\n                                                <thead>\r\n                                                    <tr>\r\n                                                        <th style=\"width: 30px; text-align: center;\">No</th>\r\n                                                        <th>Nama File</th>\r\n                                                        <th>Size</th>\r\n                                                        <th>Kategori</th>\r\n                                                        <th>Tanggal</th>\r\n                                                        <th class=\"text-center\" style=\"width: 130px;\">Opsi</th>\r\n                                                    </tr>\r\n                                                </thead>\r\n                                                <tbody>\r\n                                                                                                            <tr>\r\n                                                            <td style=\"width: 30px; text-align: center;\">1</td>\r\n                                                            <td><i class=\"fa fa-file mr-2 text-secondary\"></i>Panduan Matching Fund 2021.</td>\r\n                                                            <td>0.88 MB</td>\r\n                                                            <td>Program NonLitDimas</td>\r\n                                                            <td>2021-02-25</td>\r\n                                                            <td class=\"text-center\" style=\"width: 150px;\">\r\n                                                                <a href=\"http://lppm.upnjatim.ac.id/page/download_proses/33\" class=\"delete btn btn-sm btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download file\"><i class=\"fa fa-download\"></i></a>\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                                                                    </tbody>\r\n                                            </table>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                                            </div>\r\n                </div>\r\n                    </div>\r\n\r\n    </div>\r\n\r\n', 'umum', '2021-07-15'),
(21, 'Kontak', '<p>ini halaman kontak</p>', 'kontak', '2021-07-15'),
(23, 'Donasi', '<p>Ini halaman donasi</p><p><br></p>', 'donasi', '2021-07-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_author` int(11) DEFAULT NULL,
  `title` varchar(125) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `thumbnail` varchar(125) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id_post`, `id_author`, `title`, `description`, `content`, `thumbnail`, `date_created`) VALUES
(6, 1, 'Contoh Artikel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras hendrerit mi orci, eget consectetur felis aliquet nec. ', '<p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/4lGfNWKj9VQ\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras hendrerit mi orci, eget consectetur felis aliquet nec. Phasellus a dui neque. Suspendisse sagittis metus velit, ac luctus nisl fringilla sit amet. Aliquam eget commodo eros. Phasellus mi nibh, dignissim vitae volutpat et, maximus at magna. Suspendisse risus dui, tincidunt vel pellentesque ut, laoreet id lectus. Integer commodo nunc lectus, et pulvinar justo scelerisque id. Sed tempor risus ipsum, id ornare ipsum blandit nec. Fusce blandit mauris eget sollicitudin cursus. Vestibulum sit amet pulvinar augue, sed sollicitudin magna. Nam at urna eget nulla blandit faucibus. Maecenas volutpat eu ipsum id interdum. Quisque tempus a justo nec elementum. In eleifend magna sit amet condimentum pellentesque.</p><h2 style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"><b>Subjudul 1</b></h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">In eu egestas erat. Praesent tortor nisl, feugiat nec finibus nec, rutrum ut quam. Nam scelerisque aliquet nisi, et molestie neque semper quis. Aenean ullamcorper neque eu neque ullamcorper fringilla. Maecenas in metus sit amet ipsum hendrerit elementum. Fusce eu turpis fringilla velit commodo convallis. Sed leo libero, tincidunt a lobortis sed, condimentum ac ipsum. Aenean purus erat, sodales vel ligula vitae, egestas fringilla nibh.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Praesent hendrerit lacus sit amet tortor placerat, eget pulvinar eros vulputate. Vivamus eu enim semper, congue urna at, vehicula erat. Pellentesque euismod nibh id tellus lobortis eleifend. Morbi posuere interdum mauris, nec dapibus ex cursus eget. Aliquam ultrices neque augue, sit amet cursus nulla molestie in. Donec odio nunc, sollicitudin sed dolor quis, malesuada facilisis tellus. Pellentesque elementum mollis erat, eu tempus lectus congue nec. Phasellus aliquam erat quis mi ornare malesuada. Suspendisse quis nunc elementum, sagittis diam eget, fringilla mi. Aenean mattis mollis diam ut gravida. Sed eget dui semper, dictum ligula vitae, efficitur sapien. In vel neque sem. Nunc tellus erat, semper vel sem eget, tempus mollis leo. Quisque eget posuere diam, at facilisis eros. Etiam vel metus fringilla, dictum risus nec, finibus felis. Suspendisse bibendum aliquet vulputate.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">Vivamus turpis massa, pretium sed bibendum eu, cursus nec eros. Aliquam sit amet tortor sit amet nisi posuere feugiat. Integer laoreet est sit amet felis blandit ornare. Ut vel lorem eget neque vulputate molestie. Mauris gravida quis lectus ut congue. Morbi vestibulum eget dolor sed tincidunt. Vivamus tempus lectus eros, non auctor nulla consectetur nec. Donec augue sapien, hendrerit sit amet purus viverra, ultrices mattis risus. Phasellus gravida, nulla sed hendrerit elementum, nibh magna auctor sem, eu aliquet arcu nisi ac dui. Sed ac nulla a sem rhoncus lacinia. Sed congue condimentum leo, ac euismod felis. Praesent pulvinar sapien quis hendrerit sodales. Nunc pretium mi rutrum quam hendrerit vulputate. Sed cursus mauris nisl, id mattis metus molestie in. Ut eu dapibus turpis, ut blandit ex. Donec fermentum vitae nisi ultrices finibus.</p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px;\" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><img src=\"http://project.nc/lppm/assets/img/post-images/IMG-20200720-WA0017.jpg\" style=\"width: 50%;\"><br></p><h2 style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" -apple-system,=\"\" blinkmacsystemfont,=\"\" \"segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" ui=\"\" symbol\";=\"\" color:=\"\" rgb(0,=\"\" 0,=\"\" 0);\"=\"\"><span style=\"font-weight: bolder;\">Subjudul 2</span></h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">In sollicitudin ex ut pellentesque sagittis. Nam a tristique tellus. Proin sodales, enim maximus porttitor accumsan, augue nisl vehicula odio, id porta lectus tortor ut nisl. Pellentesque elit diam, sodales at auctor vitae, sodales vel nulla. Nunc ante sem, egestas in dictum ac, semper vel ante. Vivamus rhoncus eu ipsum at vestibulum. Nullam ut leo nisl. </p><p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">In eu egestas erat. Praesent tortor nisl, feugiat nec finibus nec, rutrum ut quam. Nam scelerisque aliquet nisi, et molestie neque semper quis. Aenean ullamcorper neque eu neque ullamcorper fringilla. Maecenas in metus sit amet ipsum hendrerit elementum. Fusce eu turpis fringilla velit commodo convallis. Sed leo libero, tincidunt a lobortis sed, condimentum ac ipsum. Aenean purus erat, sodales vel ligula vitae, egestas fringilla nibh.</p><p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">Praesent hendrerit lacus sit amet tortor placerat, eget pulvinar eros vulputate. Vivamus eu enim semper, congue urna at, vehicula erat. Pellentesque euismod nibh id tellus lobortis eleifend. Morbi posuere interdum mauris, nec dapibus ex cursus eget. Aliquam ultrices neque augue, sit amet cursus nulla molestie in. Donec odio nunc, sollicitudin sed dolor quis, malesuada facilisis tellus. Pellentesque elementum mollis erat, eu tempus lectus congue nec. Phasellus aliquam erat quis mi ornare malesuada. Suspendisse quis nunc elementum, sagittis diam eget, fringilla mi. Aenean mattis mollis diam ut gravida. Sed eget dui semper, dictum ligula vitae, efficitur sapien. In vel neque sem. Nunc tellus erat, semper vel sem eget, tempus mollis leo. Quisque eget posuere diam, at facilisis eros. Etiam vel metus fringilla, dictum risus nec, finibus felis. Suspendisse bibendum aliquet vulputate.</p><p open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\" style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify;\">Vivamus turpis massa, pretium sed bibendum eu, cursus nec eros. Aliquam sit amet tortor sit amet nisi posuere feugiat. Integer laoreet est sit amet felis blandit ornare. Ut vel lorem eget neque vulputate molestie. Mauris gravida quis lectus ut congue. Morbi vestibulum eget dolor sed tincidunt. Vivamus tempus lectus eros, non auctor nulla consectetur nec. Donec augue sapien, hendrerit sit amet purus viverra, ultrices mattis risus. Phasellus gravida, nulla sed hendrerit elementum, nibh magna auctor sem, eu aliquet arcu nisi ac dui. Sed ac nulla a sem rhoncus lacinia. Sed congue condimentum leo, ac euismod felis. Praesent pulvinar sapien quis hendrerit sodales. Nunc pretium mi rutrum quam hendrerit vulputate. Sed cursus mauris nisl, id mattis metus molestie in. Ut eu dapibus turpis, ut blandit ex. Donec fermentum vitae nisi ultrices finibus.</p>', 'THUMB_5FA17445F0EAE.png', '2021-07-16'),
(12, 1, 'ini nyoba', 'coba tok', '<p>ini kita cuma mau nyoba kak</p><p><br></p>', NULL, '2021-07-17'),
(13, 1, 'coba lagi ya', 'asdasd', '<p>lagi lagi</p>', NULL, '2021-07-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE `visitor` (
  `id_visitor` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` varchar(100) DEFAULT NULL,
  `date_visit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `websetting`
--

CREATE TABLE `websetting` (
  `website_name` varchar(100) DEFAULT NULL,
  `web_description` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `maps` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `running_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `websetting`
--

INSERT INTO `websetting` (`website_name`, `web_description`, `email`, `phone`, `maps`, `youtube`, `running_text`) VALUES
('LPPM', 'Lembaga Penelitian dan Pengabdian kepada Masyarakat - UPN Veteran Jatim', 'lppm@upnjatim.ac.id', '08576925422', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.168254102411!2d112.78568111437168!3d-7.334993174179948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fab81de81a3d%3A0x7d84cf500911950!2sTechno%20Park!5e0!3m2!1sid!2sid!4v1603265974052!5m2!1sid!2sid\" frameborder=\"0\" style=\"width: 100%; height: 500px; border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\" class=\"wow fadeInUp\" data-wow-delay=\"0.3s\" data-wow-duration=\"1s\"></iframe>', NULL, ' Selamat datang di website Lembaga Bantuan Hukum Surabaya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id_announcement`),
  ADD KEY `Announcement writer` (`id_author`),
  ADD KEY `Announcement category` (`id_category`);

--
-- Indeks untuk tabel `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id_author`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id_download`);

--
-- Indeks untuk tabel `have_category`
--
ALTER TABLE `have_category`
  ADD PRIMARY KEY (`id_category`,`id_post`),
  ADD KEY `fk_have_category2` (`id_post`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_have_post` (`id_author`);

--
-- Indeks untuk tabel `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id_visitor`),
  ADD KEY `fk_have_visitors` (`id_post`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id_announcement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `author`
--
ALTER TABLE `author`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id_download` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `have_category`
--
ALTER TABLE `have_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id_visitor` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `Announcement category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `Announcement writer` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`);

--
-- Ketidakleluasaan untuk tabel `have_category`
--
ALTER TABLE `have_category`
  ADD CONSTRAINT `fk_have_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `fk_have_category2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Ketidakleluasaan untuk tabel `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_have_post` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`);

--
-- Ketidakleluasaan untuk tabel `visitor`
--
ALTER TABLE `visitor`
  ADD CONSTRAINT `fk_have_visitors` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
