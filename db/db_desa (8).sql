-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2021 at 03:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dataSetting`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_warga`
--

CREATE TABLE `akun_warga` (
  `id_akun_warga` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `nik` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` text DEFAULT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun_warga`
--

INSERT INTO `akun_warga` (`id_akun_warga`, `id_setting`, `id_penduduk`, `nik`, `email`, `no_hp`, `password`, `status`, `created`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 1, '1207236701921002', 'firman20dot@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'aktif', '2021-10-27 12:34:56', '2021-10-27 12:34:56', 1, NULL),
(7, 1, 2, '1207236701920003', 'user@gmail.com', '082237962182', 'ee11cbb19052e40b07aac0ca060c23ee', 'aktif', '2021-11-07 02:50:51', '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `kategori` text NOT NULL,
  `sub_kategori` varchar(128) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `tahap` varchar(128) NOT NULL,
  `jumlah` varchar(128) NOT NULL,
  `pelaksana` varchar(500) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `kategori`, `sub_kategori`, `nama`, `periode`, `tahap`, `jumlah`, `pelaksana`, `id_setting`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, '1', '3', 'testing', '2021-10-13', 'Tahap 1', '500000000', '', 1, 'aktif', '2021-10-13 22:58:08', 1, '0000-00-00 00:00:00', 0, NULL),
(2, '1', '3', 'Membangun WC', '2021-10-14', 'Tahap 1', '100000', '', 1, 'aktif', '2021-10-14 09:33:57', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_tag` varchar(15) DEFAULT NULL,
  `judul` varchar(150) NOT NULL,
  `slug` text NOT NULL,
  `konten` longtext NOT NULL,
  `images` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `id_setting`, `id_kategori`, `id_tag`, `judul`, `slug`, `konten`, `images`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(15, 1, 7, '', 'Daftar Penerima Bantuan Pangan Non Tunai (Kemensos) Tahun 2020 dataSetting Jelok Kecamatan Kaligesing', 'daftar-penerima-bantuan-pangan-non-tunai-kemensos-tahun-2020-dataSetting-jelok-kecamatan-kaligesing', '<p>Bantuan Pangan Non Tunai (BPNT)&nbsp;adalah bantuan pangan dari pemerintah yang diberikan kepada KPM setiap bulannya melalui mekanisme akun elektronik yang digunakan hanya untuk membeli pangan di e-Warong KUBE PKH / pedagang bahan pangan yang bekerjasama dengan Bank HIMBARA. Bertujuan untuk mengurangi beban pengeluaran serta memberikan nutrisi yang lebih seimbang kepada KPM secara tepat sasaran dan tepat waktu. Berikut ini daftar penerima PKH dataSetting Jelok Kecamatan Kaligesing :</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td colspan=\"2\">NO</td>\r\n<td>Nama</td>\r\n<td>Alamat</td>\r\n<td>Nama Ibu Kandung</td>\r\n<td>dataSetting</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">1</td>\r\n<td>LASTARI</td>\r\n<td>DUSUN KALISENG RW 03 RT 01</td>\r\n<td>ITHENG</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">2</td>\r\n<td>EDHI ARIYANTO</td>\r\n<td>GAMBASAN RT 01RW 04</td>\r\n<td>JUMIYATI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">3</td>\r\n<td>SUKATI</td>\r\n<td>SUKUH RT 01RW 07</td>\r\n<td>MUSIRAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">4</td>\r\n<td>NUNUNG ROMA KARYANI</td>\r\n<td>GAMBASAN RT 01RW 04</td>\r\n<td>MUSTINAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">5</td>\r\n<td>MARTINI</td>\r\n<td>KALISENG</td>\r\n<td>NGADIKEM</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">6</td>\r\n<td>SUTININGSIH</td>\r\n<td>DUSUN KRAJAN 1 RW 01 RT 01</td>\r\n<td>NGASINEM</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>7</td>\r\n<td>&nbsp;</td>\r\n<td>AAM</td>\r\n<td>DUSUN KRAJAN 1 RW 01 RT 01</td>\r\n<td>OOM</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>8</td>\r\n<td>&nbsp;</td>\r\n<td>SITI KHOMSATUN</td>\r\n<td>SIBATUR RT 01RW 06</td>\r\n<td>PAINI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>9</td>\r\n<td>&nbsp;</td>\r\n<td>SUNARYO</td>\r\n<td>DUSUN KALISENG RW 03 RT 01</td>\r\n<td>PAINTEN</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>10</td>\r\n<td>&nbsp;</td>\r\n<td>TUMINAH</td>\r\n<td>DUSUN KRAJAN 1 RW 01 RT 01</td>\r\n<td>PARINAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>11</td>\r\n<td>&nbsp;</td>\r\n<td>KAMSUDI</td>\r\n<td>KRAJAN 1 RT 01RW 01</td>\r\n<td>RETI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>12</td>\r\n<td>&nbsp;</td>\r\n<td>REBUT SUSANTI</td>\r\n<td>DUSUN KRAJAN 1 RW 01 RT 01</td>\r\n<td>RUBINI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>13</td>\r\n<td>&nbsp;</td>\r\n<td>SATINEM</td>\r\n<td>DUSUN KRAJAN 1 RW 01 RT 01</td>\r\n<td>SAMINAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>14</td>\r\n<td>&nbsp;</td>\r\n<td>SARINAH</td>\r\n<td>DUSUN KALISENG RW 03 RT 01</td>\r\n<td>SARIYEM</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>15</td>\r\n<td>&nbsp;</td>\r\n<td>EKA PRASTIWI</td>\r\n<td>NGESONG</td>\r\n<td>SITI PATIMAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>16</td>\r\n<td>&nbsp;</td>\r\n<td>SUSANTI OKTAFIA</td>\r\n<td>SIBATUR RT 01RW 06</td>\r\n<td>SRI WAHAYU</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>17</td>\r\n<td>&nbsp;</td>\r\n<td>KASERAN</td>\r\n<td>DUSUN KALISENG RW 03 RT 01</td>\r\n<td>SURIP</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>18</td>\r\n<td>&nbsp;</td>\r\n<td>TUTUT WINDARI</td>\r\n<td>GAMBARAN</td>\r\n<td>TITI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>19</td>\r\n<td>&nbsp;</td>\r\n<td>WAGE</td>\r\n<td>DUSUN KRAJAN 2 RW 02 RT 01</td>\r\n<td>TUKIYEM</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>20</td>\r\n<td>&nbsp;</td>\r\n<td>TUKIYAH</td>\r\n<td>NGESONG</td>\r\n<td>TUKIYEM</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>21</td>\r\n<td>&nbsp;</td>\r\n<td>PARIASIH</td>\r\n<td>SIBATUR RT 01RW 06</td>\r\n<td>TUNI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>22</td>\r\n<td>&nbsp;</td>\r\n<td>JUWARIYAH</td>\r\n<td>DUSUN NGESONG RW 05 RT 01</td>\r\n<td>UWUH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>23</td>\r\n<td>&nbsp;</td>\r\n<td>PARJAN</td>\r\n<td>DUSUN NGESONG RW 05 RT 01</td>\r\n<td>WAGINAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>24</td>\r\n<td>&nbsp;</td>\r\n<td>SRI SUGIHARTI</td>\r\n<td>NGESONG</td>\r\n<td>WAKINAH</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>25</td>\r\n<td>&nbsp;</td>\r\n<td>NUR AENI</td>\r\n<td>KRAJAN 2</td>\r\n<td>WASNI</td>\r\n<td>JELOK</td>\r\n</tr>\r\n<tr>\r\n<td>26</td>\r\n<td>&nbsp;</td>\r\n<td>HARYANI</td>\r\n<td>DUSUN NGESONG RW 05 RT 01</td>\r\n<td>WELAS</td>\r\n<td>JELOK</td>\r\n</tr>\r\n</tbody>\r\n</table>', '81e00916533c795b2443ee16e55e70cb.jpg', 1, '2021-09-11 13:38:48', 1, '2021-09-22 11:21:53'),
(17, 1, 6, '', 'Brikoka Dalam Pipa, Solusi Pupuk Bagi Tanaman Vanili', 'brikoka-dalam-pipa-solusi-pupuk-bagi-tanaman-vanili', '<p>Budidaya tanaman vanili dalam planter bag menjadi terobosan baru untuk mempermudah petani di dataSetting Jelok, Kecamatan Kaligesing, Kabupaten Purworejo.&nbsp;Inovasi tersebut dikembangkan oleh Program Kemitraan Masyarakat (PKM) Kemenristekdikti dan Universitas Muhammadiyah Purworejo (UMP).<br /><br />\"Penanaman vanili dalam planter bag ini bisa menjadi solusi bagi permasalahan petani di dataSetting Jelok. Karena dengan menggunakan kantong plastik, vanili bisa ditanam di dekat rumah sehingga pemeliharaan dan pemanenan lebih mudah,\" jelas Ketua Tim PKM, Jeki MW Wibawanti, SPt, MEng, MSi di lokasi penanaman siang ini (23/8).<br /><br />Vanili yang dikenal dengan istilah emas hijau, menjadi komoditi yang berharga mahal. Harga vanili basah bisa mencapai Rp550 ribu/kg. Mahalnya harga vanili, membuat orang tak bertanggung jawab mencurinya, sehingga merugikan petani.<br /><br />Alhasil, banyak petani yang kemudian tidak mau lagi menanamnya. Belum lagi bencana longsor yang sering terjadi di dataSetting ini.</p>\r\n<p>Program kemitraan ini mengambil tema Brikoka (Briket Kotoran Kambing) Fermentasi Sebagai Isi Pipa Panjat Budidaya Vanili Dalam Planter Bag\'.<br /><br />\"Teknik penanamannya adalah dengan menggunaka pipa yang telah diisi oleh fermentasi kotoran kambing etawa, brikoka, sehingga pohon vanili yang merambat dapat sekaligus sebagai media rambat bagi akarnya,\" terang Jeki lagi.<br /><br />Pihaknya menggunakan kotoran kambing sebagai tema PKM ini karena melihat Kecamatan Kaligesing menjadi sentra kambing etawa.<br /><br />Limbah kotoran kambing tersebut bisa dimanfaatkan untuk pupuk tanaman vanili.<br /><br />Jeki berharap, adanya pipa panjat yang diisi brikoka mampu menjaga vanili tetap berbuah. Meskipun batang bawah terputus karena terserang penyakit busuk batang.<br /><br />Program ini juga menginisiasi Produk Unggulan Kawasan PedataSettingan (Prukades) berupa brikoka dalam kemasan yang akan bekerjasama dengan Badan Usaha Milik dataSetting (Bumdes) Jelok.<strong>&nbsp;</strong></p>', 'bef4a173d59eecd83b9625284436a207.jpg', 1, '2021-09-11 18:28:34', 1, '2021-09-22 11:21:55'),
(18, 1, 7, '', 'Pelantikan Perangkat dataSetting Jelok 2019', 'pelantikan-perangkat-dataSetting-jelok-2019', '<p>Kegiatan Pelantikan Perangkat dataSetting Jelok yang dilaksanakan di Balai dataSetting Jelok berlangsung tertib dan lancar. Hadir dalam kegiatan tersebut Camat Kaligesing beserta muspika, Lembaga Kemasyarakatan dataSetting, Anggota BPD dan warga masyarakat dataSetting Jelok.</p>\r\n<p>Pengambilan sumpah dan pelantikan oleh Kepala dataSetting Jelok yang diikuti oleh 3 Perangkat dataSetting baru berlangsung khidmad. Kepala dataSetting Jelok berharap dengan telah diambil sumpah serta dilantik menjadi perangkat dataSetting, perangkat dataSetting tersebut dapat segera beradaptasi dengan lingkungan di pemerintah dataSetting Jelok. Selain itu juga diharapkan agar dapat mengemban amanah dengan penuh tanggung jawab.</p>\r\n<p>Camat Kaligesing dalam sambutan dan arahannya juga menyampaikan bahwa dengan telah diambil sumpah serta dilantik oleh kepala dataSetting, berarti sudah resmi menjadi perangkat dataSetting dan harus segera bekerja sesuai dengan tugas pokok dan fungsi masing-masing. Apalagi menjelang awal tahun anggaran baru diharapkan dapat ikut mempercepat kegiatan penyusunan APBdataSetting Tahun 2020 dan selesai sesuai dengan tahapan waktu yang telah ditentukan. Terkait dengan situasi kondisi serta cuaca saat ini yang sudah memasuki musim penghujan, diharapkan aparat pemerintah dataSetting dan warga masyarakat dataSetting Jelok meningkatkan kewaspadaan dilingkungan masing-masing. Sehingga jika melihat akan terjadi suatu kejadian bencana, dapat segera mengambil langkah-langkah antisipasi untuk meminimalisir kerugian yang lebih besar lagi.</p>', '8df32e099c7d99da400804b4886754c6.jpg', 1, '2021-09-11 18:32:10', 1, '2021-09-22 11:21:57'),
(20, 1, 6, '', 'Rayakan Tahun Baru 2021 Di Rumah Saja', 'rayakan-tahun-baru-2021-di-rumah-saja', '<p>Perayaan Natal dan Tahun Baru 2021 yang berpotensi membuat kerumunan, diperlukan beberapa langkah antisipatif untuk pengendalian dan pencegahan kasus Covid-19. Terkait hal itu, Bupati Purworejo RH Agus Bastian SE MM mengeluarkan surat edaran yang berisi himbauan.</p>\r\n<p>Dalam surat itu Bupati menghimbau agar protokol kesehatan diberlakukan lebih ketat di seluruh destinasi wisata. Pemilik caf&eacute; agar menutup operasionalnya maksimal pukul 22.00 WIB.</p>\r\n<p>Penyelenggara event tidak diperbolehkan menyelenggarakan event pada pergantian tahun baru, sedangkan masyarakat agar berada di rumah saja.Tiak ada acara perayaan pergantian tahun baru di alun-alun Purworejo, Kutoarjo maupun di semua kecamatan.</p>\r\n<p>Kawasan alun-alun Purworejo dan Kutoarjo ditutup mulai pukul 18.00, serta dilarang melakukan konvoi kendaraan. Sedangkan seluruh obyek wisata di Purworejo ditutup mulai 24 Desember hingga 4 Januari, untuk mengurangi penyebaran Covid-19 dan kerumunan massa.</p>\r\n<p>Bupati juga memerintahkan agar Satgas Covid-19 Kabupaten Purworejo melakukan monitoring.</p>', '22acec0cd287beb94fe09afe0c4b4188.jpg', 1, '2021-09-19 15:49:05', 1, '2021-09-19 14:08:34'),
(21, 1, 7, '', 'DAFTAR PENERIMA JPS KABUPATEN PURWOREJO dataSetting JELOK KECAMATAN KALIGESING TAHUN 2020', 'daftar-penerima-jps-kabupaten-purworejo-dataSetting-jelok-kecamatan-kaligesing-tahun-2020', '<p>&nbsp; Kementerian Ketenagakerjaan bekerja sama dengan Kementerian dataSetting, Pembangunan Daerah Tertinggal, dan Transmigrasi menggelar program Jaring Pengaman Sosial (JPS) untuk membantu pekerja yang ter-PHK serta menciptakan lingkungan yang bersih dan sehat di dataSetting.<br /><br />&nbsp; &nbsp; Program JPS ini ditujukan untuk menciptakan lapangan kerja bagi pekerja terdampak pandemi Covid-19, baik yang ter-PHK maupun dirumahkan, melalui program padat karya di pedataSettingan serta mendukung Sustainable Development Goals (SDGs) di Indonesia. Berikut daftar penerima JPS dataSetting Jelok Tahun 2020:</p>\r\n<p>&nbsp;</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td><strong>NO</strong></td>\r\n<td colspan=\"2\"><strong>nmkab</strong></td>\r\n<td><strong>nmkec</strong></td>\r\n<td colspan=\"3\"><strong>dataSetting</strong></td>\r\n<td colspan=\"2\"><strong>nama</strong></td>\r\n<td colspan=\"2\"><strong>L/P</strong></td>\r\n<td colspan=\"5\"><strong>alamat</strong></td>\r\n</tr>\r\n<tr>\r\n<td>1</td>\r\n<td colspan=\"2\">PURWOREJO</td>\r\n<td>KALIGESING</td>\r\n<td colspan=\"3\">JELOK</td>\r\n<td colspan=\"2\">SUYATI</td>\r\n<td colspan=\"2\">P</td>\r\n<td colspan=\"5\">Kaliseng Rt 01 Rw 03</td>\r\n</tr>\r\n<tr>\r\n<td>2</td>\r\n<td colspan=\"2\">PURWOREJO</td>\r\n<td>KALIGESING</td>\r\n<td colspan=\"3\">JELOK</td>\r\n<td colspan=\"2\">ISNUR CHOTIMAH</td>\r\n<td colspan=\"2\">P</td>\r\n<td colspan=\"5\">Kaliseng Rt 01 Rw 03</td>\r\n</tr>\r\n<tr>\r\n<td>3</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>WITO</td>\r\n<td>&nbsp;</td>\r\n<td>P</td>\r\n<td>&nbsp;</td>\r\n<td>Gambasa RT 01 RW 04</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>4</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>SUPRIYANTINI</td>\r\n<td>&nbsp;</td>\r\n<td>P</td>\r\n<td>&nbsp;</td>\r\n<td>Krajan II RT 001 RW 002 dataSetting Jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>5</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>MARSINI</td>\r\n<td>&nbsp;</td>\r\n<td>P</td>\r\n<td>&nbsp;</td>\r\n<td>Kaliseng Rt 01 Rw 03 dataSetting Jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>6</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>ELISA</td>\r\n<td>&nbsp;</td>\r\n<td>P</td>\r\n<td>&nbsp;</td>\r\n<td>Krajan II RT 001 RW 002 dataSetting Jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>7</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>SUGIATMI</td>\r\n<td>&nbsp;</td>\r\n<td>P</td>\r\n<td>&nbsp;</td>\r\n<td>Krajan II RT 001 RW 002 dataSetting Jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>8</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>DARMINI</td>\r\n<td>&nbsp;</td>\r\n<td>P</td>\r\n<td>&nbsp;</td>\r\n<td>Gambasan RT 01 RW 04 dataSetting Jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>9</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>WARNO DIHARJO</td>\r\n<td>&nbsp;</td>\r\n<td>L</td>\r\n<td>&nbsp;</td>\r\n<td>Gambasa RT 01 RW 04 dataSetting Jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>10</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>WALUYO</td>\r\n<td>&nbsp;</td>\r\n<td>L</td>\r\n<td>&nbsp;</td>\r\n<td>sibatur rt 01 rw 06 dataSetting jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>11</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>SAMINGUN</td>\r\n<td>&nbsp;</td>\r\n<td>L</td>\r\n<td>&nbsp;</td>\r\n<td>ngesong rt 01 rw 05 dataSetting jelok</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>12</td>\r\n<td>PURWOREJO</td>\r\n<td>&nbsp;</td>\r\n<td>KALIGESING</td>\r\n<td>JELOK</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>SLAMET</td>\r\n<td>&nbsp;</td>\r\n<td>L</td>\r\n<td>&nbsp;</td>\r\n<td>sukuh rt 01 rw07 dataSetting jelok</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'c981eb2e63c8a9203a9524d75dac7c41.jpg', 1, '2021-09-19 15:49:46', 1, '2021-09-19 14:08:23'),
(22, 1, 7, '6,7,8', 'Mendes Terbitkan Peraturan soal Prioritas Penggunaan Dana dataSetting 2021', 'mendes-terbitkan-peraturan-soal-prioritas-penggunaan-dana-dataSetting-2021', '<p>Menteri dataSetting, Pembangunan Daerah Tertinggal dan Transmigrasi (Mendes PDTT) Abdul Halim Iskandar mengeluarkan peraturan mengenai&nbsp;prioritas penggunaan dana dataSetting 2021.</p>\r\n<p>Permendes Nomor 13 tahun 2020 itu menjadi dasar bagi 74.953 dataSetting dalam menyusun rencana kerja dan APBDes 2021. &ldquo;Saya ingin menginformasikan telah diundangkannya Peraturan Menteri dataSetting Pembangunan Daerah Tertinggal dan Transmigrasi tanggal 15 September 2020 dengan nomor keputusan atau PermendataSetting nomor 13 tahun 2020 tentang prioritas penggunaan dana dataSetting 2021,&rdquo; kata Abdul Halim dalam konferensi pers virtual, Senin (21/9/2020).<br /><br />Abdul Halim mengatakan, peraturan tersebut sesuai dengan model pembangunan nasional yang berdasarkan pada Peraturan Presiden nomor 59 tahun 2017 tentang Pelaksanaan Pencapaian Tujuan Pembangunan Nasional Berkelanjutan atau SDGs (Sustainable Development Goals).</p>\r\n<p>Permendes menegaskan bahwa dana dataSetting tahun anggaran 2021 diprioritaskan untuk pencapaian SDGs dataSetting yang mengukur seluruh aspek pembangunan, sehingga mampu mewujudkan perkembangan manusia seutuhnya.</p>\r\n<p>Tujuannya, meningkatkan kesejahteraan masyarakat.</p>\r\n<p><br />Adapun perwujudan program SDGs dataSetting berupa, dataSetting Tanpa Kemiskinan, dataSetting Tanpa Kelaparan, dataSetting Sehat dan Sejahtera, Pendidikan dataSetting Berkualitas, Keterlibatan Perempuan dataSetting, dataSetting Layak Air Bersih dan Sanitasi, dataSetting Berenergi Bersih dan Terbarukan, Pertumbuhan Ekonomi dataSetting Merata, Infrastruktur dan Inovasi dataSetting sesuai Kebutuhan, dan dataSetting tanpa Kesenjangan.</p>\r\n<p>Kemudian, Kawasan Permukiman dataSetting Aman dan Nyaman, Konsumsi dan Produksi dataSetting Sadar Lingkungan, dataSetting Tanggap Perubahan Iklim, dataSetting Peduli Lingkungan Laut, dataSetting Peduli Lingkungan Darat, dataSetting Damai Berkeadilan, dan Kemitraan untuk Pembangunan dataSetting.</p>\r\n<p>Abdul Halim menuturkan, pelaksanaan SDGs Global di Indonesia dipayungi Perpres Nomor 59 tahun 2017 tentang Pelaksanaan Pencapaian Tujuan Pembangunan Nasional Berkelanjutan di Indonesia.</p>\r\n<p>&ldquo;Karena Indonesia adalah anggota PBB kemudian Indonesia berperan aktif dalam penentuan sasaran SDGs,&rdquo; kata Mendes.<br /><br />Artikel ini telah tayang di&nbsp;<a href=\"https://www.kompas.com/\">Kompas.com</a>&nbsp;dengan judul \"Mendes Terbitkan Peraturan soal Prioritas Penggunaan Dana dataSetting 2021\"</p>\r\n<p>&nbsp;</p>', 'a2ed4ecd52b289b5f983b822d4f78e8d.jpg', 1, '2021-09-19 15:51:45', 1, '2021-10-10 07:33:25'),
(26, 1, 10, '7,8', 'Danau Toba', 'danau-toba', '<div id=\"paragrafParent\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>', 'a7f0bcaed1f6d6a995c21cf93af47ecf.jpg', 1, '2021-09-21 14:07:54', 1, '2021-09-21 12:08:22'),
(27, 1, 10, '6,7', 'Pemandian Air Hangat Sangubanyu', 'pemandian-air-hangat-sangubanyu', '<p>Pemandian air hangat Sangubanyu terletak di dataSetting Pesanggrahan Kecamatan Bawang, sekitar 50 km selatan ibukota Kabupaten Batang. Mata air hangat muncul dari sekitar bebatuan sebelah barat sungai yang merupakan perbatasan Kabupaten Batang dan Kabupaten Kendal. Objek wisata ini dilengkapi kebun binatang mini dan wahana permainan ATV. Pemandian Air Hangat Sangubanyu akan dikembangkan agar lebih baik lagi.</p>', '44f64f2e01e9e8e8ae932d11c1bd5715.jpg', 1, '2021-09-21 14:10:55', 1, '2021-09-21 12:10:55'),
(28, 1, 10, '6,7', 'Pantai Celong', 'pantai-celong', '<p>Terletak di kecamatan Bayuputih, 32 km timur ibukota Kabupaten Batang. Pantai dengan karakteristik bebatuan karang menghampar di sepanjang pantai, memecahkan gulungan ombak Laut Jawa yang saling beriringan.</p>\r\n<p>Pantai Celong diyakini sebagai tempat berlabuhnya Dapunta Syailendra (pendiri Wangsa Syailendra yang keturunannya menjadi Raja - Raja Mataram Kuno) di Tanah Jawa.</p>\r\n<p>Keindahan pantai ini dapat dilihat dari ketinggian yang memperlihatkan jalur kereta api yang menghubungkan Jakarta - Surabaya berdampingan dengan garis pantai, serta keindahan Laut Jawa bertemu dengan daratan Pulau Jawa.</p>', '9e4ac73a2b5ab19e8ffa2381065ca9a2.jpg', 1, '2021-09-21 14:12:13', 1, '2021-09-21 12:12:13'),
(29, 2, 7, '6,7', 'Transaksi Berlangsung Cepat', 'transaksi-berlangsung-cepat', '<p>asdasdasdas</p>', '74ec2d8a070a88d467de24ac754e6f50.jpg', 2, '2021-09-22 13:38:34', 2, '2021-09-22 11:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `id_bantuan` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `sasaran` varchar(128) NOT NULL,
  `nama_bantuan` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `tgl_mulai` varchar(128) NOT NULL,
  `tgl_akhir` varchar(128) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id_bantuan`, `id_setting`, `sasaran`, `nama_bantuan`, `deskripsi`, `tgl_mulai`, `tgl_akhir`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(7, 1, 'Keluarga - KK', 'aidhad', 'ajbasjd', '2021-09-18', '2021-09-18', 'aktif', '2021-09-18 04:33:21', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bantuan_detail`
--

CREATE TABLE `bantuan_detail` (
  `id_bantuan_dtl` int(11) NOT NULL,
  `id_bantuan` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `no_kartu` varchar(128) NOT NULL,
  `gambar_kartu` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bantuan_detail`
--

INSERT INTO `bantuan_detail` (`id_bantuan_dtl`, `id_bantuan`, `id_setting`, `no_kk`, `nik`, `no_kartu`, `gambar_kartu`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 7, 1, '1271034711930225', '1207236701921002', '119999999999', 'fbfbf4010d03976eb912c0b6f25f557f.jpg', 'aktif', '2021-09-17 19:51:49', 1, '2021-09-17 20:40:13', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `broadcast_sms`
--

CREATE TABLE `broadcast_sms` (
  `id_broadcast_sms` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_jenis_sms` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `pesan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('pending','proses','sukses') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `broadcast_sms`
--

INSERT INTO `broadcast_sms` (`id_broadcast_sms`, `id_setting`, `id_jenis_sms`, `tanggal`, `waktu`, `pesan`, `harga`, `total`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(5, 1, 2, '2021-11-07', '20:44:00', 'Test', 0, NULL, 'pending', '2021-11-07 20:44:17', 1, '2021-11-07 21:00:20', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_disposisi` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `id_setting`, `nama_disposisi`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 'KASI PEMERINTAH', '2021-10-16 20:12:26', 1, '2021-10-16 20:12:53', 1, NULL),
(2, 1, 'KASI KESEJAHTERAAN', '2021-10-16 20:12:26', 1, '2021-10-16 20:12:53', 1, NULL),
(3, 1, 'KASI KEUANGAN', '2021-10-16 20:12:26', 1, '2021-10-16 20:12:53', 1, NULL),
(4, 1, 'SEKRETARIS dataSetting', '2021-10-16 20:12:26', 1, '2021-10-16 20:12:53', 1, NULL),
(5, 1, 'KAUR KEUANGAN', '2021-10-16 20:12:26', 1, '2021-10-16 20:12:53', 1, NULL),
(6, 1, 'KASI PELAYANAN', '2021-10-16 20:12:26', 1, '2021-10-16 20:12:53', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dumy`
--

CREATE TABLE `dumy` (
  `id` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `galleri`
--

CREATE TABLE `galleri` (
  `id_galleri` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `caption` varchar(150) NOT NULL,
  `images` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galleri`
--

INSERT INTO `galleri` (`id_galleri`, `id_setting`, `caption`, `images`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(19, 1, 'Pemberian Penghargaan Lomba Linmas', 'd1ced7685ce3686353e9794b37211134.jpg', 1, '2021-09-19 14:45:26', 1, '2021-09-22 11:37:09'),
(20, 1, 'Ujian Seleksi Sekdes', '550d6fbaede11911724f403325c9f6a2.jpg', 1, '2021-09-19 15:11:17', 1, '2021-09-19 13:11:17'),
(21, 1, 'Pelantikan Sekretaris dataSetting', 'fe45141dda3b977438f69c6a344fd515.jpg', 1, '2021-09-19 15:12:21', 1, '2021-09-19 13:12:21'),
(22, 1, 'Ucapan Selamat Kepada Perangkat dataSetting', '7472d6dcda8eb9de601b9f31e6730427.jpg', 1, '2021-09-19 15:12:48', 1, '2021-09-19 13:12:48'),
(23, 1, 'Foto Bersama', '5584b7e6fed7b36d6b3c8392b2c8c59a.jpg', 1, '2021-09-19 15:13:14', 1, '2021-09-19 13:13:14'),
(24, 2, 'Pemberian Penghargaan Lomba Linmas', '964af97bb22105152951a338a16def1a.jpg', 2, '2021-09-22 14:17:50', 2, '2021-09-22 12:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `nama_website` varchar(128) NOT NULL,
  `kode_dataSetting` varchar(128) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `kepala_dataSetting` varchar(255) NOT NULL,
  `nip_kepala_dataSetting` varchar(128) NOT NULL,
  `alamat` longtext NOT NULL,
  `email` varchar(128) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `tentang` longtext NOT NULL,
  `kecamatan` varchar(128) NOT NULL,
  `kode_kecamatan` varchar(50) NOT NULL,
  `nama_camat` varchar(128) NOT NULL,
  `nip_camat` varchar(50) NOT NULL,
  `nama_kabupaten` varchar(128) NOT NULL,
  `kode_kabupaten` varchar(50) NOT NULL,
  `provinsi` varchar(128) NOT NULL,
  `kode_provinsi` varchar(50) NOT NULL,
  `maps` longtext NOT NULL,
  `logo` longtext DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `edited` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_website`, `kode_dataSetting`, `kode_pos`, `kepala_dataSetting`, `nip_kepala_dataSetting`, `alamat`, `email`, `telepon`, `website`, `tentang`, `kecamatan`, `kode_kecamatan`, `nama_camat`, `nip_camat`, `nama_kabupaten`, `kode_kabupaten`, `provinsi`, `kode_provinsi`, `maps`, `logo`, `status`, `edited`) VALUES
(1, 'Kutacane', '01', '20146', 'Al azmi', '1221929192', 'Jalan KH Samanhudi No 20 Medan', 'amialazmi@gmail.com', '081774124643', 'localhost/dataSetting/webprofile', 'Tentang dataSetting', 'Kuta', '041', 'Andre', '12929128181', 'Medan', 'Medan', 'Aceh', '021', 'https://goo.gl/maps/qrkT5SEQzBjTfXtq8', 'a0d9a758c4f6281549d3b1512ca257c8.png', 'Aktif', '2021-10-11 19:27:34'),
(2, 'dataSetting Contoh\r\n', '02', '20146', 'Al azmi', '1221929192', 'Jalan KH Samanhudi No 20 Medan', 'amialazmi@gmail.com', '081774124643', 'localhost/dataSetting/dataSettingcontoh', 'Tentang dataSetting', 'Kuta', '041', 'Andre', '12929128181', 'Medan', 'Medan', 'Aceh', '021', 'https://goo.gl/maps/qrkT5SEQzBjTfXtq8', 'a0d9a758c4f6281549d3b1512ca257c8.png', 'Aktif', '2021-09-16 16:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sms`
--

CREATE TABLE `jenis_sms` (
  `id_jenis_sms` int(11) NOT NULL,
  `nama_jenis_sms` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_sms`
--

INSERT INTO `jenis_sms` (`id_jenis_sms`, `nama_jenis_sms`, `harga`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(1, 'Seluruh Penduduk', 220, 1, '2021-11-07 11:42:07', 1, '2021-11-07 04:42:07'),
(2, 'Location Based Advertising', 330, 1, '2021-11-07 11:42:54', 1, '2021-11-07 04:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_kategori` varchar(150) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_setting`, `nama_kategori`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(6, 1, 'Kesehatan', 1, '2021-09-11 11:18:56', 1, '2021-09-11 09:18:56'),
(7, 1, 'Politik', 1, '2021-09-11 12:32:35', 1, '2021-09-11 10:32:35'),
(10, 1, 'Wisata dataSetting', 1, '2021-09-21 14:01:47', 1, '2021-09-21 12:01:47'),
(11, 1, 'rse', 1, '2021-10-16 19:36:54', 1, '2021-10-16 12:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_kelompok`
--

CREATE TABLE `kategori_kelompok` (
  `id_kategori_kel` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_kelompok`
--

INSERT INTO `kategori_kelompok` (`id_kategori_kel`, `id_setting`, `nama_kategori`, `deskripsi`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 'Pengajian', 'Pengajian Ibu Ibu dataSetting', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id_kelompok` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_kelompok` varchar(255) NOT NULL,
  `nik_ketua` varchar(16) NOT NULL,
  `id_kategori_kel` int(11) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id_kelompok`, `id_setting`, `nama_kelompok`, `nik_ketua`, `id_kategori_kel`, `deskripsi`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 'Kelompok Pengajian Masjid Nurul Huda', '1271034711970013', 1, '<p>Pengajian Ibu Ibu dataSetting</p>', 'aktif', '2021-09-12 16:37:14', 1, '2021-09-12 16:57:45', 1, NULL),
(4, 1, 'tes', '1207236701921001', 1, '<p>testin</p>', 'aktif', '2021-09-12 17:30:19', 1, '2021-09-12 17:35:12', 1, NULL),
(5, 1, 'Kelompok Basket', '1271034711970013', 1, '<p>Pengajian Ibu Ibu dataSetting</p>', 'aktif', '2021-09-12 17:45:42', 1, '2021-09-12 17:49:15', 1, NULL),
(6, 1, 'Pemuda Mesjid', '1271034711930225', 1, '<p>uyghoi</p>', 'aktif', '2021-09-18 05:27:41', 1, '0000-00-00 00:00:00', 0, '2021-09-18 05:27:47-admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_detail`
--

CREATE TABLE `kelompok_detail` (
  `id_dtl_kel` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `keterangan` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok_detail`
--

INSERT INTO `kelompok_detail` (`id_dtl_kel`, `id_kelompok`, `id_setting`, `nik`, `keterangan`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 5, 1, '', '', 'aktif', '2021-09-15 16:44:35', 1, '0000-00-00 00:00:00', 0, '2021-09-15 17:19:55-1'),
(2, 5, 1, '', '', 'aktif', '2021-09-15 16:45:28', 1, '0000-00-00 00:00:00', 0, '2021-09-15 17:19:48-1'),
(3, 5, 1, '1271034711970013', '2', 'aktif', '2021-09-15 16:46:32', 1, '0000-00-00 00:00:00', 0, '2021-09-15 17:19:58-1'),
(4, 5, 1, '', '', 'aktif', '2021-09-15 16:47:53', 1, '0000-00-00 00:00:00', 0, '2021-09-15 17:19:44-1'),
(5, 5, 1, '', '', 'aktif', '2021-09-15 16:48:23', 1, '0000-00-00 00:00:00', 0, '2021-09-15 17:19:33-1'),
(6, 5, 1, '1207236701920003', 'ttes', 'aktif', '2021-09-15 16:57:50', 1, '0000-00-00 00:00:00', 0, NULL),
(7, 5, 1, '1207236701920003', '2', 'aktif', '2021-09-15 17:06:24', 1, '0000-00-00 00:00:00', 0, NULL),
(8, 5, 1, '1207236701921001', 'ttes2', 'aktif', '2021-09-15 17:16:32', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `no_kk` varchar(100) NOT NULL,
  `id_kepala_keluarga` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_terdaftar` date NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id_keluarga`, `id_setting`, `no_kk`, `id_kepala_keluarga`, `alamat`, `tgl_terdaftar`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, '123456789', 4, 'Medan', '2021-10-07', 'aktif', '2021-10-07 17:38:32', 1, '2021-10-07 17:38:32', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keluarga_detail`
--

CREATE TABLE `keluarga_detail` (
  `id_keluarga` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `no_kk` varchar(100) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `kode_klasifikasi` varchar(50) NOT NULL,
  `nama_klasifikasi` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klasifikasi`
--

INSERT INTO `klasifikasi` (`id_klasifikasi`, `id_setting`, `kode_klasifikasi`, `nama_klasifikasi`, `deskripsi`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, '001', 'Pengajian', 'Pengajian Ibu Ibu dataSetting', 'aktif', '0000-00-00 00:00:00', 0, '2021-10-13 08:20:10', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_artikel` int(11) NOT NULL,
  `ip_address` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `komentar` longtext NOT NULL,
  `status` enum('publish','hide','pending') NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `edited` datetime DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_setting`, `id_artikel`, `ip_address`, `nama`, `email`, `komentar`, `status`, `created`, `edited`, `edited_by`) VALUES
(6, 1, 22, '::1', 'Firman', 'admin@gmail.com', ' There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour', 'hide', '2021-10-13 17:26:14', '2021-10-14 00:26:14', 1),
(7, 1, 21, '::1', 'Roland Pardosi', 'member@gmail.com', 'Testing', 'publish', '2021-10-13 17:02:13', '2021-10-14 00:02:13', 1),
(9, 1, 22, '::1', 'Firman', 'admin@gmail.com', 'asdasdasdas', 'publish', '2021-10-18 13:15:10', '2021-10-18 20:15:10', 1),
(10, 2, 22, '::1', 'Ary Fahreza', 'admin@gmail.com', 'Artikel ini telah tayang di Kompas.com dengan judul \"Mendes Terbitkan Peraturan soal Prioritas Penggunaan Dana dataSetting 2021\"', 'pending', '2021-10-13 13:56:30', '2021-10-13 20:30:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lapor`
--

CREATE TABLE `lapor` (
  `id_lapor` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `jenis_laporan` varchar(250) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `laporan` text NOT NULL,
  `lampiran` text DEFAULT NULL,
  `status` enum('kirim','proses','selesai') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapor`
--

INSERT INTO `lapor` (`id_lapor`, `id_setting`, `id_penduduk`, `jenis_laporan`, `judul`, `laporan`, `lampiran`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(3, 1, 1, 'Adminsistrasi', 'test', 'asdasda', '', 'proses', '2021-10-28 10:06:49', 1, '0000-00-00 00:00:00', 0, NULL),
(4, 1, 1, 'Adminsistrasi', 'Transaksi Berlangsung Cepat', 'sdasda', '3453ca8662e534cbfc8e27e6301b6aaf.pdf', 'kirim', '2021-10-28 10:07:23', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layanan_surat_detail`
--

CREATE TABLE `layanan_surat_detail` (
  `id_proses_surat` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_surat` varchar(16) NOT NULL,
  `isi_surat` longtext NOT NULL,
  `status` enum('dibuat','diproses','selesai','dibatalkan') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `proses_by` varchar(255) NOT NULL,
  `proses_date` date NOT NULL,
  `selesai_by` varchar(255) NOT NULL,
  `selesai_date` date NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan_surat_detail`
--

INSERT INTO `layanan_surat_detail` (`id_proses_surat`, `id_setting`, `nik`, `id_surat`, `isi_surat`, `status`, `created`, `created_by`, `edited`, `edited_by`, `proses_by`, `proses_date`, `selesai_by`, `selesai_date`, `deleted`) VALUES
(28, 1, '1207236701921002', '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dsadasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdasdas&tertanda_atas_nama=dasdasdas&nik_pejabat=1271034711970012&jabatan=3', 'dibuat', '2021-10-27 18:31:41', 1, '0000-00-00 00:00:00', 0, '', '0000-00-00', '', '0000-00-00', NULL),
(29, 1, '1207236701921002', '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdas&tertanda_atas_nama=dasdasdas&nik_pejabat=1271034711970012&jabatan=3', 'selesai', '2021-10-27 18:32:14', 1, '0000-00-00 00:00:00', 0, '1', '2021-10-27', '1', '2021-10-27', NULL),
(30, 1, '1207236701921002', '16', 'id_surat=WG1iVzluUitId3FFd0F4a0NTMzJ2dz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dsadasd&tertanda_atas_nama=asdsadas&nik_pejabat=1271034711970012&jabatan=3', 'dibuat', '2021-10-27 20:52:59', 1, '0000-00-00 00:00:00', 0, '', '0000-00-00', '', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `id_log_login` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `browser` varchar(150) NOT NULL,
  `ip_address` varchar(150) NOT NULL,
  `os` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`id_log_login`, `id_setting`, `id_user`, `nama`, `level`, `browser`, `ip_address`, `os`, `created`, `created_by`) VALUES
(6, 2, 2, 'Firman', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 14:13:19', 2),
(7, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 14:16:21', 1),
(8, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 14:34:10', 1),
(9, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 14:34:10', 1),
(10, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 14:34:10', 1),
(11, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 14:16:21', 1),
(12, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 21:51:43', 1),
(13, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 21:54:06', 1),
(14, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-07 22:24:05', 1),
(15, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-08 09:59:53', 1),
(16, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-08 14:27:49', 1),
(17, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-08 21:02:36', 1),
(18, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-08 22:00:45', 1),
(19, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-09 02:17:17', 1),
(20, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-09 02:18:40', 1),
(21, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-09 08:55:53', 1),
(22, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-09 10:27:38', 1),
(23, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-09 19:05:59', 1),
(24, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-10 03:22:40', 1),
(25, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-10 14:24:20', 1),
(26, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-10 19:07:51', 1),
(27, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-11 08:06:17', 1),
(28, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-11 13:10:05', 1),
(29, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-11 19:14:32', 1),
(30, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-12 20:11:29', 1),
(31, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-13 07:58:46', 1),
(32, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13 19:20:51', 1),
(33, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13 19:33:47', 1),
(34, 1, 2, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13 19:39:20', 2),
(35, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13 19:39:35', 1),
(36, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13 19:41:24', 1),
(37, 1, 1, 'Admin', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13 19:42:05', 1),
(38, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-14 09:28:41', 1),
(39, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 12:00:22', 1),
(40, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 19:34:14', 1),
(41, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 19:34:24', 1),
(42, 1, 2, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 19:34:37', 2),
(43, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 19:34:46', 1),
(44, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 19:38:05', 1),
(45, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16 19:38:48', 1),
(46, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-17 23:09:56', 1),
(47, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-18 20:12:49', 1),
(48, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-20 21:01:04', 1),
(49, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-20 21:08:16', 1),
(50, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-22 19:28:29', 1),
(51, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-22 21:59:37', 1),
(52, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-23 09:46:27', 1),
(53, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-23 14:28:40', 1),
(54, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-23 20:26:09', 1),
(55, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-24 00:15:43', 1),
(56, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-26 13:11:25', 1),
(57, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-26 17:47:32', 1),
(58, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-26 18:57:33', 1),
(59, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-27 10:31:25', 1),
(60, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-27 13:31:16', 1),
(61, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-27 13:33:06', 1),
(62, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-27 13:40:15', 1),
(63, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-27 14:47:10', 1),
(64, 1, 1, 'Firman', 'Administrator', 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-27 17:57:15', 1),
(65, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-27 18:13:01', 1),
(66, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-27 18:34:12', 1),
(67, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-27 18:39:08', 1),
(68, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 10:32:09', 1),
(69, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 11:11:25', 1),
(70, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 11:11:44', 1),
(71, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 16:21:37', 1),
(72, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 19:49:01', 1),
(73, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-31 20:58:25', 1),
(74, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 11:07:56', 1),
(75, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 13:38:11', 1),
(76, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 13:44:55', 1),
(77, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 17:27:45', 1),
(78, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 23:50:07', 1),
(79, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-02 13:42:12', 1),
(80, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-02 13:50:43', 1),
(81, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-03 10:12:07', 1),
(82, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-04 23:28:20', 1),
(83, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-05 21:47:34', 1),
(84, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-06 18:28:02', 1),
(85, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 01:54:47', 1),
(86, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 03:12:30', 1),
(87, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 11:32:55', 1),
(88, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 11:37:39', 1),
(89, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 14:11:52', 1),
(90, 1, 1, 'Firman', 'Administrator', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 20:42:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_login_warga`
--

CREATE TABLE `log_login_warga` (
  `id_log_login_warga` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_akun_warga` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `browser` varchar(150) NOT NULL,
  `ip_address` varchar(150) NOT NULL,
  `os` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_login_warga`
--

INSERT INTO `log_login_warga` (`id_log_login_warga`, `id_setting`, `id_akun_warga`, `nama`, `level`, `browser`, `ip_address`, `os`, `created`, `created_by`) VALUES
(68, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-27 23:58:19', 1),
(69, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 00:00:13', 1),
(70, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 09:27:10', 1),
(71, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 09:31:06', 1),
(72, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 09:32:22', 1),
(73, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 13:54:19', 1),
(74, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28 19:48:17', 1),
(75, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-31 21:27:14', 1),
(76, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 10:11:38', 1),
(77, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 13:40:00', 1),
(78, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 14:12:57', 1),
(79, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01 17:26:40', 1),
(80, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-04 23:43:53', 1),
(81, 1, 1, 'Al azmi', 'Warga', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 01:58:54', 1),
(82, 1, 1, '', 'Warga', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 02:22:59', 1),
(83, 1, 7, 'Mutia Aufa', 'Warga', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 11:30:22', 7),
(84, 1, 7, 'Mutia Aufa', 'Warga', 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07 21:09:41', 7);

-- --------------------------------------------------------

--
-- Table structure for table `master_agama`
--

CREATE TABLE `master_agama` (
  `id_agama` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_agama`
--

INSERT INTO `master_agama` (`id_agama`, `nama`) VALUES
(3, 'ISLAM'),
(4, 'KRISTEN'),
(5, 'KATHOLIK'),
(6, 'HINDU'),
(7, 'BUDHA'),
(8, 'KHONGHUCU'),
(9, 'KEPERCAYAAN TERHADAP TUHAN YME / LAINNYA');

-- --------------------------------------------------------

--
-- Table structure for table `master_akseptor_kb`
--

CREATE TABLE `master_akseptor_kb` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_akseptor_kb`
--

INSERT INTO `master_akseptor_kb` (`id`, `nama`) VALUES
(1, 'PIL'),
(2, 'IUD'),
(3, 'SUNTIK'),
(4, 'KONDOM'),
(5, 'SUSUK KB'),
(6, 'STERILISASI WANITA'),
(7, 'STERILISASI PRIA'),
(8, 'LAINNYA');

-- --------------------------------------------------------

--
-- Table structure for table `master_golongan_darah`
--

CREATE TABLE `master_golongan_darah` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_golongan_darah`
--

INSERT INTO `master_golongan_darah` (`id`, `nama`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'AB'),
(4, 'O'),
(5, 'A+'),
(6, 'A-'),
(7, 'B+'),
(8, 'B-'),
(9, 'AB+'),
(10, 'AB-'),
(11, 'O+'),
(12, 'O-'),
(13, 'TIDAK TAHU');

-- --------------------------------------------------------

--
-- Table structure for table `master_jekel`
--

CREATE TABLE `master_jekel` (
  `id_jekel` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_jekel`
--

INSERT INTO `master_jekel` (`id_jekel`, `nama`) VALUES
(1, 'LAKI-LAKI'),
(2, 'PEREMPUAN');

-- --------------------------------------------------------

--
-- Table structure for table `master_kawin`
--

CREATE TABLE `master_kawin` (
  `id_kawin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_kawin`
--

INSERT INTO `master_kawin` (`id_kawin`, `nama`) VALUES
(1, 'BELUM KAWIN'),
(2, 'KAWIN'),
(3, 'CERAI HIDUP'),
(4, 'CERAI MATI');

-- --------------------------------------------------------

--
-- Table structure for table `master_pekerjaan`
--

CREATE TABLE `master_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pekerjaan`
--

INSERT INTO `master_pekerjaan` (`id_pekerjaan`, `nama`) VALUES
(4, 'BELUM/TIDAK BEKERJA'),
(5, 'MENGURUS RUMAH TANGGA'),
(6, 'PELAJAR/MAHASISWA'),
(7, 'PENSIUNAN'),
(8, 'PEGAWAI NEGERI SIPIL (PNS)'),
(9, 'TENTARA NASIONAL INDONESIA (TNI)'),
(10, 'KEPOLISIAN RI (POLRI)'),
(11, 'PERDAGANGAN'),
(12, 'PETANI/PEKEBUN'),
(13, 'PETERNAK'),
(14, 'NELAYAN/PERIKANAN'),
(15, 'INDUSTRI'),
(16, 'KONSTRUKSI'),
(17, 'TRANSPORTASI'),
(18, 'KARYAWAN SWASTA'),
(19, 'KARYAWAN BUMN'),
(20, 'KARYAWAN BUMD'),
(21, 'KARYAWAN HONORER'),
(22, 'BURUH HARIAN LEPAS'),
(23, 'BURUH TANI/PERKEBUNAN'),
(24, 'BURUH NELAYAN/PERIKANAN'),
(25, 'BURUH PETERNAKAN'),
(26, 'PEMBANTU RUMAH TANGGA'),
(27, 'TUKANG CUKUR'),
(28, 'TUKANG LISTRIK'),
(29, 'TUKANG BATU'),
(30, 'TUKANG KAYU'),
(31, 'TUKANG SOL SEPATU'),
(32, 'TUKANG LAS/PANDAI BESI'),
(33, 'TUKANG JAHIT'),
(34, 'TUKANG GIGI'),
(35, 'PENATA RIAS'),
(36, 'PENATA BUSANA'),
(37, 'PENATA RAMBUT'),
(38, 'MEKANIK'),
(39, 'SENIMAN'),
(40, 'TABIB'),
(41, 'PARAJI'),
(42, 'PERANCANG BUSANA'),
(43, 'PENTERJEMAH'),
(44, 'IMAM MASJID'),
(45, 'PENDETA'),
(46, 'PASTOR'),
(47, 'WARTAWAN'),
(48, 'USTADZ/MUBALIGH'),
(49, 'JURU MASAK'),
(50, 'PROMOTOR ACARA'),
(51, 'ANGGOTA DPR-RI'),
(52, 'ANGGOTA DPD'),
(53, 'ANGGOTA BPK'),
(54, 'PRESIDEN'),
(55, 'WAKIL PRESIDEN'),
(56, 'ANGGOTA MAHKAMAH KONSTITUSI'),
(57, 'ANGGOTA KABINET KEMENTERIAN'),
(58, 'DUTA BESAR'),
(59, 'GUBERNUR'),
(60, 'WAKIL GUBERNUR'),
(61, 'BUPATI'),
(62, 'WAKIL BUPATI'),
(63, 'WALIKOTA'),
(64, 'WAKIL WALIKOTA'),
(65, 'ANGGOTA DPRD PROVINSI'),
(66, 'ANGGOTA DPRD KABUPATEN/KOTA'),
(67, 'DOSEN'),
(68, 'GURU'),
(69, 'PILOT'),
(70, 'PENGACARA'),
(71, 'NOTARIS'),
(72, 'ARSITEK'),
(73, 'AKUNTAN'),
(74, 'KONSULTAN'),
(75, 'DOKTER'),
(76, 'BIDAN'),
(77, 'PERAWAT'),
(78, 'APOTEKER'),
(79, 'PSIKIATER/PSIKOLOG'),
(80, 'PENYIAR TELEVISI'),
(81, 'PENYIAR RADIO'),
(82, 'PELAUT'),
(83, 'PENELITI'),
(84, 'SOPIR'),
(85, 'PIALANG'),
(86, 'PARANORMAL'),
(87, 'PEDAGANG'),
(88, 'PERANGKAT dataSetting'),
(89, 'KEPALA dataSetting'),
(90, 'BIARAWATI'),
(91, 'WIRASWASTA'),
(92, 'LAINNYA');

-- --------------------------------------------------------

--
-- Table structure for table `master_pendidikan`
--

CREATE TABLE `master_pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `pendidikan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pendidikan`
--

INSERT INTO `master_pendidikan` (`id_pendidikan`, `pendidikan`) VALUES
(1, 'TIDAK / BELUM SEKOLAH'),
(2, 'BELUM TAMAT SD/SEDERAJAT'),
(3, 'SLTP/SEDERAJAT'),
(4, 'SLTA / SEDERAJAT'),
(5, 'DIPLOMA I / II'),
(6, 'AKADEMI/ DIPLOMA III/S. MUDA'),
(7, 'DIPLOMA IV/ STRATA I'),
(8, 'STRATA II'),
(9, 'STRATA III');

-- --------------------------------------------------------

--
-- Table structure for table `master_pendidikan_ditempuh`
--

CREATE TABLE `master_pendidikan_ditempuh` (
  `id_psd` int(11) NOT NULL,
  `pendidikan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pendidikan_ditempuh`
--

INSERT INTO `master_pendidikan_ditempuh` (`id_psd`, `pendidikan`) VALUES
(1, 'BELUM MASUK TK/KELOMPOK BERMAIN'),
(2, 'SEDANG TK/KELOMPOK BERMAIN'),
(3, 'TIDAK PERNAH SEKOLAH'),
(4, 'SEDANG SD/SEDERAJAT'),
(5, 'TIDAK TAMAT SD/SEDERAJAT'),
(6, 'SEDANG SLTP/SEDERAJAT'),
(7, 'SEDANG SLTA/SEDERAJAT'),
(8, 'SEDANG D-1/SEDERAJAT'),
(9, 'SEDANG D-2/SEDERAJAT'),
(10, 'SEDANG D-3/SEDERAJAT'),
(11, 'SEDANG S-1/SEDERAJAT'),
(12, 'SEDANG S-2/SEDERAJAT'),
(13, 'SEDANG S-3/SEDERAJAT'),
(14, 'SEDANG SLB A/SEDERAJAT'),
(15, 'SEDANG SLB B/SEDERAJAT'),
(16, 'SEDANG SLB C/SEDERAJAT'),
(17, 'TIDAK DAPAT MEMBACA DAN MENULIS HURUF LATIN/ARAB'),
(18, 'TIDAK SEDANG SEKOLAH');

-- --------------------------------------------------------

--
-- Table structure for table `master_sakit`
--

CREATE TABLE `master_sakit` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_sakit`
--

INSERT INTO `master_sakit` (`id`, `nama`) VALUES
(1, 'CACAT FISIK'),
(2, 'CACAT NETRA/BUTA'),
(3, 'CACAT RUNGU/WICARA'),
(4, 'CACAT MENTAL/JIWA'),
(5, 'CACAT FISIK DAN MENTAL'),
(6, 'CACAT LAINNYA'),
(7, 'TIDAK CACAT');

-- --------------------------------------------------------

--
-- Table structure for table `master_status_penduduk`
--

CREATE TABLE `master_status_penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_status_penduduk`
--

INSERT INTO `master_status_penduduk` (`id`, `nama`) VALUES
(1, 'TETAP'),
(2, 'TIDAK TETAP'),
(3, 'PENDATANG');

-- --------------------------------------------------------

--
-- Table structure for table `master_warga_negara`
--

CREATE TABLE `master_warga_negara` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_warga_negara`
--

INSERT INTO `master_warga_negara` (`id`, `nama`) VALUES
(1, 'WNI'),
(2, 'WNA'),
(3, 'DUA KEWARGANEGARAAN');

-- --------------------------------------------------------

--
-- Table structure for table `pejabat`
--

CREATE TABLE `pejabat` (
  `id_pejabat` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `golongan` varchar(128) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_sk_pengangkatan` varchar(128) NOT NULL,
  `tgl_sk_pengangkatan` varchar(50) NOT NULL,
  `no_sk_berhenti` varchar(128) NOT NULL,
  `tgl_sk_berhenti` varchar(50) NOT NULL,
  `masa_jabatan` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `tupoksi` longtext NOT NULL,
  `foto` longtext DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pejabat`
--

INSERT INTO `pejabat` (`id_pejabat`, `id_setting`, `nik`, `nip`, `golongan`, `no_hp`, `no_sk_pengangkatan`, `tgl_sk_pengangkatan`, `no_sk_berhenti`, `tgl_sk_berhenti`, `masa_jabatan`, `jabatan`, `tupoksi`, `foto`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(4, 1, '1271034711970012', '123213213', 'Kepala dataSetting', '7869-7989-3433', '12321312312', '2021-09-19', '12321321321', '2021-09-19', '5', '3', 'dsadasdasdas', 'default.png', 'aktif', '2021-09-18 19:23:03', 1, '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `rw` varchar(10) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `no_kk` varchar(16) DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tempat_dilahirkan` varchar(128) NOT NULL,
  `tgl_lahir` varchar(128) NOT NULL,
  `agama` varchar(128) NOT NULL,
  `pendidikan` varchar(128) NOT NULL,
  `jekel` varchar(20) NOT NULL,
  `ktp_elektrtonik` varchar(25) DEFAULT NULL,
  `status_rekam` varchar(25) DEFAULT NULL,
  `hubungan_dalam_keluarga` varchar(128) DEFAULT NULL,
  `status_penduduk` varchar(128) DEFAULT NULL,
  `nomor_akta_kelahiran` varchar(128) DEFAULT NULL,
  `waktu_kelahiran` varchar(20) DEFAULT NULL,
  `jenis_kelahiran` varchar(128) DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `penolong_kelahiran` varchar(128) DEFAULT NULL,
  `berat_lahir` int(11) DEFAULT NULL,
  `panjang_lahir` int(11) DEFAULT NULL,
  `pendidikan_sedang_ditempuh` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(128) DEFAULT NULL,
  `status_warga_negara` varchar(50) DEFAULT NULL,
  `nomor_paspor` varchar(100) DEFAULT NULL,
  `tgl_berakhir_paspor` varchar(15) DEFAULT NULL,
  `nomor_kitas` varchar(100) DEFAULT NULL,
  `nik_ayah` varchar(16) DEFAULT NULL,
  `nama_ayah` varchar(128) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `nama_ibu` varchar(128) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `alamat_sebelumnya` longtext DEFAULT NULL,
  `status_perkawinan` varchar(100) DEFAULT NULL,
  `no_akta_nikah` varchar(100) DEFAULT NULL,
  `tanggal_perkawinan` varchar(15) DEFAULT NULL,
  `no_akta_perceraian` varchar(100) DEFAULT NULL,
  `tanggal_perceraian` varchar(15) DEFAULT NULL,
  `golongan_darah` varchar(25) DEFAULT NULL,
  `cacat` varchar(128) DEFAULT NULL,
  `sakit_menahun` varchar(128) DEFAULT NULL,
  `akseptor_kb` varchar(128) DEFAULT NULL,
  `vaksin_1` varchar(50) DEFAULT NULL,
  `tgl_vaksin_1` date DEFAULT NULL,
  `vaksin_2` varchar(50) DEFAULT NULL,
  `tgl_vaksin_2` date DEFAULT NULL,
  `foto` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime DEFAULT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `id_setting`, `id_wilayah`, `rw`, `rt`, `no_kk`, `nik`, `nama_lengkap`, `no_hp`, `tempat_lahir`, `tempat_dilahirkan`, `tgl_lahir`, `agama`, `pendidikan`, `jekel`, `ktp_elektrtonik`, `status_rekam`, `hubungan_dalam_keluarga`, `status_penduduk`, `nomor_akta_kelahiran`, `waktu_kelahiran`, `jenis_kelahiran`, `anak_ke`, `penolong_kelahiran`, `berat_lahir`, `panjang_lahir`, `pendidikan_sedang_ditempuh`, `pekerjaan`, `status_warga_negara`, `nomor_paspor`, `tgl_berakhir_paspor`, `nomor_kitas`, `nik_ayah`, `nama_ayah`, `nik_ibu`, `nama_ibu`, `alamat`, `alamat_sebelumnya`, `status_perkawinan`, `no_akta_nikah`, `tanggal_perkawinan`, `no_akta_perceraian`, `tanggal_perceraian`, `golongan_darah`, `cacat`, `sakit_menahun`, `akseptor_kb`, `vaksin_1`, `tgl_vaksin_1`, `vaksin_2`, `tgl_vaksin_2`, `foto`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(2, 1, 1, '1', '1', '1207236701921002', '1207236701920003', 'Mutia Aufa', '', 'Medan', '', '07-11-1996', '1', '8', 'PEREMPUAN', NULL, NULL, 'ISTRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aa9ccc6c1aba5ed74efcbb16066942a3.jpg', 'aktif', '0000-00-00 00:00:00', 0, '2021-11-07 21:10:35', 2147483647, NULL),
(3, 1, 1, '1', '1', '1207236701922002', '1207236701921001', 'Indra Gunawan', '', 'Medan', '', '07-11-1996', '1', '8', 'LAKI-LAKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'aktif', '0000-00-00 00:00:00', 0, NULL, 0, NULL),
(4, 1, 1, '1 ', '1 ', '222', '12', 'Samsul Arifin', '1', '1', 'RUMAH', '', 'ISLAM', 'BELUM TAMAT SD/SEDERAJAT', 'LAKI-LAKI', 'BELUM', '', 'KEPALA KELUARGA', 'TIDAK TETAP', '1', '01:01', 'KEMBAR 2', 1, 'DOKTER', 11, 11, 'SEDANG TK/KELOMPOK BERMAIN', 'PENSIUNAN', 'WNA', '1', '2021-09-29', '1', '1', '1', '1', '1', '1', '11', 'CERAI HIDUP', '1', '0001-01-01', '1', '0001-01-01', 'AB-', 'CACAT RUNGU/WICARA', 'TIDAK ADA/TIDAK SAKIT', '', NULL, NULL, NULL, NULL, 'default.png', 'aktif', '2021-09-11 12:27:01', 1, '2021-10-09 02:20:00', 1, NULL),
(5, 1, 1, '2 ', '1 ', '222', '1271034711970013', 'Al Azmi', '1', '1', 'RS/RB', '2021-09-11', 'ISLAM', 'TAMAT SD / SEDERAJAT', 'LAKI-LAKI', 'BELUM', '', 'ORANG TUA', 'TIDAK TETAP', '1', '18:48', 'TUNGGAL', 23, 'DOKTER', 22, 2, 'SEDANG TK/KELOMPOK BERMAIN', 'PELAJAR/MAHASISWA', 'WNI', '1', '0001-01-01', '1', '1', '1', '1', '1', 'Jalan KH Samanhudi No 20 Medan1', 'Jalan KH Samanhudi No 20 Medan1', 'BELUM KAWIN', '1', '0001-01-01', '1', '0001-01-01', 'B', 'CACAT FISIK', 'STROKE', 'SUNTIK', NULL, NULL, NULL, NULL, 'default.png', 'aktif', '2021-09-11 13:49:11', 1, '2021-10-09 19:37:06', 1, NULL),
(6, 1, 4, '1 ', '1 ', '222', '1271034711970012', 'Al Azmi', '081774124643', '1', 'RS/RB', '2021-09-12', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'LAKI-LAKI', 'BELUM', '', 'ANAK', 'TIDAK TETAP', '1', '22:49', 'TUNGGAL', 2, 'DOKTER', 2, 2, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'BELUM/TIDAK BEKERJA', 'WNI', '1', '2021-09-12', '2', '1', '2', '1', '2', 'Jalan KH Samanhudi No 20 Medan', 'Jalan KH Samanhudi No 20 Medan', 'BELUM KAWIN', '2', '2021-09-12', '1', '2021-09-12', 'O', 'CACAT FISIK', 'JANTUNG', 'PIL', 'sudah', '2021-11-06', 'sudah', '2021-11-05', 'default.png', 'aktif', '2021-09-12 17:44:23', 1, '2021-10-10 19:28:09', 1, NULL),
(8, 1, 1, '2 ', '1 ', '1', '1207236701920002', 'Al Azmi', '081774124643', '11', '', '2021-09-13', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'LAKI-LAKI', 'BELUM', '', '', 'TETAP', '', '', '', 0, '', 0, 0, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'BELUM/TIDAK BEKERJA', '', '', '', '', '', '', '', '', 'Jalan KH Samanhudi No 20 Medan', 'Jalan KH Samanhudi No 20 Medan', 'CERAI HIDUP', '', '', '', '', '', '', 'TIDAK ADA/TIDAK SAKIT', '', NULL, NULL, NULL, NULL, '', 'aktif', '2021-09-13 15:11:20', 1, NULL, 0, '2021-09-18 04:32:58-1'),
(9, 1, 1, '2 ', '1 ', '1', '1207236701920002', 'Al Azmi', '081774124643', '11', 'POLINDES', '2021-09-13', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'LAKI-LAKI', 'BELUM', '5', 'CUCU', 'TIDAK TETAP', '1', '22:22', 'TUNGGAL', 2, 'BIDAN PERAWAT', 22, 22, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'MENGURUS RUMAH TANGGA', 'WNI', '22', '2021-09-15', '2', '2', '2', '2', '2', 'Jalan KH Samanhudi No 20 Medan', 'Jalan KH Samanhudi No 20 Medan', 'BELUM KAWIN', '2', '2021-09-15', '2', '', 'A', 'CACAT NETRA/BUTA', 'TIDAK ADA/TIDAK SAKIT', 'SUNTIK', NULL, NULL, NULL, NULL, 'default.png', 'aktif', '2021-09-15 11:20:39', 1, NULL, 0, '2021-09-18 04:32:54-1'),
(10, 1, 1, '2 ', '1 ', '1', '1207236701920002', 'Al Azmi', '081774124643', '11', '', '2021-09-13', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'LAKI-LAKI', 'BELUM', '2', 'ORANG TUA', 'TETAP', '222', '', '', 3, 'BIDAN PERAWAT', 3, 3, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'BELUM/TIDAK BEKERJA', 'WNI', '2', '2021-09-15', '2', '2', '2', '2', '2', 'Jalan KH Samanhudi No 20 Medan', 'Jalan KH Samanhudi No 20 Medan', 'CERAI HIDUP', '2', '2021-08-30', '2', '2021-09-15', 'AB', 'CACAT NETRA/BUTA', 'TIDAK ADA/TIDAK SAKIT', '', NULL, NULL, NULL, NULL, 'default.png', 'aktif', '2021-09-15 11:31:07', 1, NULL, 0, '2021-09-18 04:32:50-1'),
(11, 1, 1, '2 ', '4 ', '222', '1271034711970111', 'test', '081774124643', '11', 'PUSKEMAS', '2021-09-15', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'LAKI-LAKI', 'BELUM', '2', 'ANAK', 'TETAP', '222', '16:59', 'KEMBAR 2', 31, 'BIDAN PERAWAT', 31, 31, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'BELUM/TIDAK BEKERJA', 'WNI', '2', '2021-09-15', '2', '2', '2', '2', '2', 'Jalan KH Samanhudi No 20 Medan', 'Jalan KH Samanhudi No 20 Medan', 'CERAI HIDUP', '2', '2021-08-30', '2', '2021-09-15', 'AB', 'CACAT NETRA/BUTA', 'TIDAK ADA/TIDAK SAKIT', 'SUNTIK', NULL, NULL, NULL, NULL, '370c28351cb928a716ea30bb13557092.png', 'aktif', '2021-09-15 11:31:17', 1, '2021-10-10 19:28:23', 1, '2021-09-18 04:32:48-1'),
(12, 1, 1, '2', '4', '222', '1271034711930225', 'asd', '081376667771', '1', 'POLINDES', '2021-09-15', 'KATHOLIK', 'BELUM TAMAT SD/SEDERAJAT', 'LAKI-LAKI', 'BELUM', '2', 'ANAK', 'PENDATANG', '11', '11:11', 'KEMBAR 2', 1, 'DOKTER', 1, 1, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'BELUM/TIDAK BEKERJA', 'WNA', '11', '0011-11-11', '11', '11', '1', '11', '11', 'Jalan KH Samanhudi No 20 Medan', '1', 'KAWIN', '111', '0011-11-11', '1', '0001-11-11', 'AB', 'CACAT NETRA/BUTA', 'TIDAK ADA/TIDAK SAKIT', 'SUNTIK', NULL, NULL, NULL, NULL, 'default.png', 'aktif', '2021-09-15 13:53:25', 1, '2021-10-10 19:28:32', 1, '2021-09-18 04:32:44-1'),
(13, 1, 1, '1', '1', '1207236701921002', '12312312321', 'Firman', '082237962182', 'Kuala Simpang', 'LAINNYA', '1997-05-20', 'ISLAM', 'DIPLOMA IV/ STRATA I', 'LAKI-LAKI', 'KTP-EL', '2', 'ANAK', 'TETAP', '123125123312312', '15:27', 'TUNGGAL', 3, 'BIDAN PERAWAT', 5, 80, 'TIDAK SEDANG SEKOLAH', 'PELAJAR/MAHASISWA', 'WNI', '', '2021-10-10', '', '', '', '', '', 'Dusun Rajawali dataSetting Landuh, Jalan Perumahan Griya Rizky Residence Blok B No.11, Rantau, KAB. ACEH TAMIANG, RANTAU, NANGGROE ACEH', '', 'BELUM KAWIN', '', '', '', '', 'O', 'TIDAK CACAT', 'TIDAK ADA/TIDAK SAKIT', '', NULL, NULL, NULL, NULL, 'default.png', 'aktif', '2021-10-10 15:29:43', 1, NULL, 0, NULL),
(14, 1, 1, '1', '1', '1207236701921002', '231232112', 'Firman', '082237962182', 'Kuala Simpang', '', '2021-10-10', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'LAKI-LAKI', 'KTP-EL', '3', 'CUCU', 'TETAP', '', '15:32', '', 4, 'BIDAN PERAWAT', 2, 40, 'BELUM MASUK TK/KELOMPOK BERMAIN', 'MENGURUS RUMAH TANGGA', 'WNI', '', '', '', '', '', '', '', 'Dusun Rajawali dataSetting Landuh, Jalan Perumahan Griya Rizky Residence Blok B No.11, Rantau, KAB. ACEH TAMIANG, RANTAU, NANGGROE ACEH', '', 'KAWIN', '', '', '', '', 'O', 'TIDAK CACAT', 'TIDAK ADA/TIDAK SAKIT', '', 'sudah', '2021-11-05', 'sudah', '2021-11-05', 'default.png', 'aktif', '2021-10-10 15:33:37', 1, '2021-10-11 19:25:06', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `slug` text NOT NULL,
  `konten` longtext NOT NULL,
  `lampiran` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `page_name` varchar(150) NOT NULL,
  `slug` text NOT NULL,
  `konten` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `id_setting`, `page_name`, `slug`, `konten`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(8, 1, 'Profil Wilayah dataSetting', 'profil-wilayah-dataSetting', '<div class=\"panel-title\">\r\n<div class=\"single-title\">PROFIL WILAYAH dataSetting</div>\r\n</div>\r\n<div class=\"panel-body\">\r\n<div class=\"artikel-single\">\r\n<p>&nbsp; &nbsp; &nbsp;Dalam hal pemerintahan umum, Pemerintah dataSetting Jelok, senantiasa memberi pelayanan kepada segenap mesyarakat &nbsp;dalam beberapa hal ,seperti KK ,KTP , Akte, Pemakaman dll, juga pelayanan dalam bidang keamanan dan ketertiban masyarakat.seperti dibawah ini.</p>\r\n<p>dataSetting Jelok merupakan dataSetting di Kecamatan Kaligesing Kabupaten Purworejo.</p>\r\n<p><strong>A. LUAS DAN BATAS-BATAS</strong>&nbsp;<strong>:</strong></p>\r\n<ol>\r\n<li>dataSetting Jelok mempunyai luas wilayah : 318 ha</li>\r\n</ol>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; a.&nbsp;Jumlah Penduduk&nbsp;: 1.113 jiwa</p>\r\n<ol start=\"2\">\r\n<li>Batas dataSetting :</li>\r\n</ol>\r\n<ol>\r\n<li>Batas Wilayah : Timur dengan dataSetting Kedunggubah</li>\r\n<li>Selatan dengan dataSetting Brenggong</li>\r\n<li>Barat dengan dataSetting Brenggong</li>\r\n<li>Utara dengan dataSetting Sudimoro</li>\r\n</ol>\r\n</div>\r\n</div>', 1, '2021-09-11 16:17:12', 1, '2021-09-12 03:17:51'),
(9, 1, 'Demografi', 'demografi', '<p>test</p>', 1, '2021-09-11 16:46:23', 1, '2021-09-11 14:46:23'),
(10, 1, 'Visi & Misi', 'visi-and-misi', '<p><strong>Visi :</strong></p>\r\n<p>&ldquo; Menyelenggarakan&nbsp; pemerintahan yang bersih, transparan dan bertanggungjawab untuk mewujudkan masyarakat dataSetting Jelok yang demokratis, mandiri dan sejahtera &rdquo;</p>\r\n<p><strong>MISI :</strong></p>\r\n<p>Misi dataSetting Jelok adalah sebagai berikut :</p>\r\n<ol>\r\n<li aria-level=\"1\">Meningkatkan dan memperluas jaringan kerjasama pemerintah dan Non Pemerintah.</li>\r\n<li aria-level=\"1\">Mewujudkan pelayanan yang profesional melalui peningkatan tata kelola pemerintahan dataSetting yang responsif dan transparan.</li>\r\n<li aria-level=\"1\">Mewujudkan kehidupan sosial budaya yang dinamis dan damai.</li>\r\n<li aria-level=\"1\">Meningkatkan potensi dan daya dukung lingkungan untuk menciptakan peluang usaha.</li>\r\n<li aria-level=\"1\">Meningkatkan kesejahteraan masyarakat melalui pembangunan yang partisipatif</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p>Visi tersebut mengandung pengertian bahwa pemerintah dataSetting Jelok berkeinginan mewujudkan kehidupan mandiri dan berkesejahteraan dalam kehidupan yang demokratis dengan menyelenggarakan pemerintahan yang bersih, transparan dan bertanggungjawab. Makna dari masing masing kata yang terdapat dalam visi tersebut adalah sebagai berikut :</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li aria-level=\"1\"><strong>Bersih&nbsp;</strong>dalam arti pemerintahan dijalankan dengan dilandasi dengan niat yang tulus ikhlas dan suci serta dilandasi dengan semangat pengabdian yang tinggi.</li>\r\n<li aria-level=\"1\"><strong>Transparan&nbsp;dalam arti setiap keputusan yang diambil dapat dipertanggungjawabkan secara terbuka.</strong></li>\r\n<li aria-level=\"1\"><strong>Bertanggung jawab</strong>&nbsp;dalam arti pemertintahan yang wajib menanggung segala sesuatunya dan menerima pembebanan sebagai akibat sikap tindakan sendiri atau pihak lain.</li>\r\n<li aria-level=\"1\"><strong>Demokratis</strong>&nbsp;dalam arti bahwa adanya kebebasan berpendapat, berbeda pendapat dan menerima pendapat orang lain. Akan tetapi apabila sudah menjadi keputusan harus dilaksanakan bersama &ndash; sama dengan penuh rasa tanggungjawab.</li>\r\n<li aria-level=\"1\"><strong>Mandiri</strong>&nbsp;dalam arti bahwa kondisi atau keadaan masyarakat dataSetting Jelok yang dengan prakarsa lokal dan potensi lokal mampu memenuhi kebutuhan hidupnya.</li>\r\n<li aria-level=\"1\"><strong>Sejahtera</strong>&nbsp;dalam arti bahwa kebutuhan dasar masyarakat dataSetting jelok telah terpenuhi secara lahir dan batin. Kebutuhan dasar tersebut berupa kecukupan dan mutu pangan, sandang, papan, kesehatan, pendidikan dan kebutuhan dasar lainnya seperti lingkungan yang bersih, aman dan nyaman, juga terpenuhinya hak asasi dan partisipasi serta terwujudnya masyarakat beriman dan bertaqwa kepada Tuhan Yang Maha Esa.</li>\r\n<li aria-level=\"1\"><strong>Berkesadaran Lingkungan</strong>&nbsp;dalam arti bahwa kelestarian lingkungan dijadikan sebagai ruh atas segala kegiatan pembangunan.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Untuk mencapai misi dataSetting Jelok, maka nilai-nilai yang harus dijunjung tinggi adalah :</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li aria-level=\"1\"><strong>Partisipatif ( Keterlibatan )</strong></li>\r\n</ul>\r\n<p>&nbsp; &nbsp; &nbsp;Setiap anggota masyarakat dataSetting Jelok mempunyai hak untuk berpartisipasi dalam konteks pembangunan dengan prinsip&nbsp;<strong>dari, oleh dan untuk</strong>&nbsp;<strong>masyarakat</strong>&nbsp;<strong>( DOUM )</strong>. Oleh karena itu setiap proses pembangunan masyarakat harus dilibatkan mulai dari perncanaan, pelaksanaan dan pengawasan sampai pada pemeliharaan.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li aria-level=\"1\"><strong>Transparan ( Keterbukaan )</strong></li>\r\n</ul>\r\n<p>&nbsp; &nbsp; &nbsp;Adanya sifat keterbukaan pemerintan dataSetting Jelok dengan batas &ndash; batas kewajaran dalam rangka meningkatkan kepercayaan masyarakat.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li aria-level=\"1\"><strong>Demokratis&nbsp;</strong></li>\r\n</ul>\r\n<p>&nbsp; &nbsp; &nbsp;Masyarakat diberi kebebasan dalam mengemukakan dan menerima pendapat orang lain.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li aria-level=\"1\"><strong>Efektif dan efisien</strong></li>\r\n</ul>\r\n<p>&nbsp; &nbsp; &nbsp;Mengedepankan hasil yang optimal dengan pengorbanaan yang relatif sedikit (biaya maupun waktu) sehingga berhasil guna dan berdaya guna.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li aria-level=\"1\"><strong>Berbudaya dan beragama</strong></li>\r\n</ul>\r\n<p>&nbsp; &nbsp; Setiap gerak langkah pembangunan selaras dengan agama dan budaya yang berkembang di masyarakat, dengan demikian pelaksanaan pemerintahan dataSetting senantiasa menjunjung tinggi agama, budaya dan budi pekerti yang luhur.</p>', 1, '2021-09-11 16:46:37', 1, '2021-09-12 03:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `realisasi`
--

CREATE TABLE `realisasi` (
  `id_realisasi` int(11) NOT NULL,
  `kategori` text NOT NULL,
  `sub_kategori` varchar(128) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `tahap` varchar(128) NOT NULL,
  `jumlah` varchar(128) NOT NULL,
  `pelaksana` varchar(500) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `realisasi`
--

INSERT INTO `realisasi` (`id_realisasi`, `kategori`, `sub_kategori`, `nama`, `periode`, `tahap`, `jumlah`, `pelaksana`, `id_setting`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, '1', '3', 'testing', '2021-10-13', 'Tahap 1', '200000000', '', 1, 'aktif', '2021-10-13 22:58:08', 1, '0000-00-00 00:00:00', 0, NULL),
(3, '1', '3', '1', '2021-10-14', 'Tahap 1', '10000000', '', 1, 'aktif', '2021-10-14 09:13:48', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE `rt` (
  `id_rt` int(11) NOT NULL,
  `id_rw` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `no_rt` varchar(128) NOT NULL,
  `nik_ketua_rt` varchar(16) NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rt`
--

INSERT INTO `rt` (`id_rt`, `id_rw`, `id_setting`, `id_wilayah`, `no_rt`, `nik_ketua_rt`, `created`, `edited`, `deleted`) VALUES
(1, 1, 1, 1, '01', '1207236701920003', '07-09-2021 16:19:18-admin@gmail.com', '09-09-2021 14:27:04-admin@gmail.com', NULL),
(2, 0, 1, 1, '02', '1207236701921001', '09-09-2021 14:29:12-admin@gmail.com', '', NULL),
(3, 1, 1, 1, '02', '1207236701921001', '09-09-2021 14:31:16-admin@gmail.com', '', NULL),
(4, 2, 1, 1, '01', '1207236701920003', '09-09-2021 14:31:39-admin@gmail.com', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rw`
--

CREATE TABLE `rw` (
  `id_rw` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `no_rw` varchar(128) NOT NULL,
  `nik_ketua_rw` varchar(16) NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rw`
--

INSERT INTO `rw` (`id_rw`, `id_setting`, `id_wilayah`, `no_rw`, `nik_ketua_rw`, `created`, `edited`, `created_by`, `edited_by`, `deleted`) VALUES
(1, 1, 1, '01', '1207236701920002', '07-09-2021 16:19:18-admin@gmail.com', '09-09-2021 13:17:15-', 0, 0, NULL),
(2, 1, 1, '02', '1207236701920003', '09-09-2021 13:14:00-', '', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sk_kades`
--

CREATE TABLE `sk_kades` (
  `id_sk_kades` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `uraian` varchar(250) NOT NULL,
  `no_keputusan` varchar(50) NOT NULL,
  `tgl_keputusan` date NOT NULL,
  `no_dilaporkan` varchar(50) NOT NULL,
  `tgl_dilaporkan` date NOT NULL,
  `nama_lampiran` varchar(250) DEFAULT NULL,
  `lampiran` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_kades`
--

INSERT INTO `sk_kades` (`id_sk_kades`, `id_setting`, `uraian`, `no_keputusan`, `tgl_keputusan`, `no_dilaporkan`, `tgl_dilaporkan`, `nama_lampiran`, `lampiran`, `keterangan`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 'dasdasdasdasdasdas', '123456', '2021-10-16', '', '0000-00-00', '', 'ec7232bbf973930ec2807d89ac727f74.pdf', '', '2021-10-16 13:32:28', 1, '2021-10-16 19:37:37', 1, NULL),
(2, 1, 'adsadasasdasdasdas', '121212112312321', '2021-10-26', '21312312', '2021-10-26', 'trestaaaa', '3d8e815fee5506d72d8b575e43c8bc94.pdf', 'Testdsaddasdasdasd', '2021-10-26 13:28:49', 1, '2021-10-26 13:35:44', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_dana`
--

CREATE TABLE `sumber_dana` (
  `id_sumber_dana` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_sumber_dana` varchar(255) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sumber_dana`
--

INSERT INTO `sumber_dana` (`id_sumber_dana`, `id_setting`, `nama_sumber_dana`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 'tes', 'aktif', '2021-10-12 12:04:30', 1, '0000-00-00 00:00:00', 0, NULL),
(2, 1, 'tess', 'aktif', '2021-10-12 17:12:00', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_dana_bidang`
--

CREATE TABLE `sumber_dana_bidang` (
  `id_sumber_dana_bidang` int(11) NOT NULL,
  `id_sumber_dana` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_sumber_dana_bidang` varchar(255) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sumber_dana_bidang`
--

INSERT INTO `sumber_dana_bidang` (`id_sumber_dana_bidang`, `id_sumber_dana`, `id_setting`, `nama_sumber_dana_bidang`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(3, 1, 1, 'tes11', 'aktif', '2021-10-12 17:11:45', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_detail`
--

CREATE TABLE `surat_detail` (
  `id_surat_dtl` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_surat` varchar(16) NOT NULL,
  `isi_surat` longtext NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_detail`
--

INSERT INTO `surat_detail` (`id_surat_dtl`, `id_setting`, `id_surat`, `isi_surat`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(12, 1, '25', 'id_surat=SkVBSmJjRS9QTUd5UlRnL01IV2ZIUT09&nik=1207236701920002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=1&alasan=Lainnya&alasan_lainnya=1&tertanda_atas_nama=1&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-12 11:22:43', 1, '0000-00-00 00:00:00', 0, NULL),
(13, 1, '12', 'id_surat=cmZFVWVNQkVNOFlWamJ3YlhKZ0NTZz09&nik=12&text_tempat_lahir=&umur=&tempat_lahir=&tgl_lahir=&status_warga_negara=&alamat=&pendidikan=&agama=&nomor_surat=2&mulai_berlaku=2021-10-27&berhenti_berlaku=2021-10-27&tertanda_atas_nama=2&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 13:20:13', 1, '0000-00-00 00:00:00', 0, NULL),
(14, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701920002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=2&alasan=Karena%20Pengurangan%20Anggota%20Keluarga%20(Kematian%2C%20Kepindahan)&alasan_lainnya=2&tertanda_atas_nama=2&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 14:07:53', 1, '0000-00-00 00:00:00', 0, NULL),
(15, 1, '23', 'id_surat=WmpNN1pqTkdka0ZjcVkwTllkeDdoQT09&nik=1207236701920002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=2222&no_kartu=2&keperluan=22&tertanda_atas_nama=2&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 14:08:33', 1, '0000-00-00 00:00:00', 0, NULL),
(16, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=1&alasan=Karena%20Pengurangan%20Anggota%20Keluarga%20(Kematian%2C%20Kepindahan)&alasan_lainnya=1&tertanda_atas_nama=1&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 17:44:42', 1, '0000-00-00 00:00:00', 0, NULL),
(17, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=2&alasan=Lainnya&alasan_lainnya=2&tertanda_atas_nama=2&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 17:46:03', 1, '0000-00-00 00:00:00', 0, NULL),
(18, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=2&alasan=Karena%20Pengurangan%20Anggota%20Keluarga%20(Kematian%2C%20Kepindahan)&alasan_lainnya=2&tertanda_atas_nama=2&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 17:47:37', 1, '0000-00-00 00:00:00', 0, NULL),
(19, 1, '24', 'id_surat=QlJRaE12U1NDTUtjRkNLb001OUxNZz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=2&tertanda_atas_nama=2&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 17:50:43', 1, '0000-00-00 00:00:00', 0, NULL),
(20, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dwasadsa&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdsa&tertanda_atas_nama=dasdas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:12:37', 1, '0000-00-00 00:00:00', 0, NULL),
(21, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=sadasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=asdasdas&tertanda_atas_nama=dasdadas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:15:54', 1, '0000-00-00 00:00:00', 0, NULL),
(22, 1, '24', 'id_surat=QlJRaE12U1NDTUtjRkNLb001OUxNZz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dasdad&tertanda_atas_nama=asdasdas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:16:08', 1, '0000-00-00 00:00:00', 0, NULL),
(23, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=asdas&tertanda_atas_nama=dasdasda&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:17:41', 1, '0000-00-00 00:00:00', 0, NULL),
(24, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdas&tertanda_atas_nama=adsdasdas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:19:24', 1, '0000-00-00 00:00:00', 0, NULL),
(25, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dsadas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdas&tertanda_atas_nama=dsadas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:20:14', 1, '0000-00-00 00:00:00', 0, NULL),
(26, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=asdasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdasdas&tertanda_atas_nama=dasdasdas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:20:32', 1, '0000-00-00 00:00:00', 0, NULL),
(27, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=&alasan=&alasan_lainnya=&tertanda_atas_nama=&nik_pejabat=&jabatan=', 'aktif', '2021-10-27 18:20:42', 1, '0000-00-00 00:00:00', 0, NULL),
(28, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dsadasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdasdas&tertanda_atas_nama=dasdasdas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:31:41', 1, '0000-00-00 00:00:00', 0, NULL),
(29, 1, '25', 'id_surat=MEFhV1ZlVTlTUThabEZCaUFDdTJGdz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dasdas&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=dasdas&tertanda_atas_nama=dasdasdas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 18:32:14', 1, '0000-00-00 00:00:00', 0, NULL),
(30, 1, '16', 'id_surat=WG1iVzluUitId3FFd0F4a0NTMzJ2dz09&nik=1207236701921002&text_tempat_lahir=Medan%2C%201996-11-07&umur=24%20%20Thn&tempat_lahir=Medan&tgl_lahir=1996-11-07&status_warga_negara=-&alamat=Dusun%20Rajawali%20dataSetting%20Landuh%2C%20Jalan%20Perumahan%20Griya%20Rizky%20Residence%20Blok%20B%20No.11%2C%20Rantau%2C%20KAB.%20ACEH%20TAMIANG%2C%20RANTAU%2C%20NANGGROE%20ACEH&pendidikan=TIDAK%20%2F%20BELUM%20SEKOLAH&agama=ISLAM&nomor_surat=dsadasd&tertanda_atas_nama=asdsadas&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-10-27 20:53:00', 1, '0000-00-00 00:00:00', 0, NULL),
(31, 1, '25', 'id_surat=SkVBSmJjRS9QTUd5UlRnL01IV2ZIUT09&nik=1207236701921001&text_tempat_lahir=Medan%2C%2007-11-1996&umur=Oops!%20Could%20not%20calculate%20age!&tempat_lahir=Medan&tgl_lahir=07-11-1996&status_warga_negara=-&alamat=-&pendidikan=8&agama=1&nomor_surat=231w2321&alasan=Karena%20Penambahan%20Anggota%20Keluarga%20(Kelahiran%2C%20Kedatangan)&alasan_lainnya=asdasas&tertanda_atas_nama=312321&nik_pejabat=1271034711970012&jabatan=3', 'aktif', '2021-11-05 21:48:28', 1, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tujuan` text NOT NULL,
  `perihal` text NOT NULL,
  `lampiran` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat_keluar`, `id_setting`, `id_klasifikasi`, `no_surat`, `tgl_surat`, `tujuan`, `perihal`, `lampiran`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 1, '123456', '2021-10-16', 'Testing', 'Testings', 'ec7232bbf973930ec2807d89ac727f74.pdf', '2021-10-16 13:32:28', 1, '2021-10-16 19:37:37', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `pengirim` varchar(150) NOT NULL,
  `perihal` text NOT NULL,
  `disposisi_kepada` text NOT NULL,
  `isi_disposisi` text NOT NULL,
  `lampiran` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `id_setting`, `id_klasifikasi`, `no_surat`, `tgl_penerimaan`, `tgl_surat`, `pengirim`, `perihal`, `disposisi_kepada`, `isi_disposisi`, `lampiran`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 1, '123456', '2021-10-16', '2021-10-16', 'Testing', 'Testings', '', 'asdasd', 'feafc51126600117996ec954da442460.pdf', '2021-10-16 13:32:28', 1, '2021-10-16 19:37:37', 1, NULL),
(5, 1, 1, '12321321321', '2021-10-26', '2021-10-26', 'asdasdasddasdasdasdasdasdasd', 'asdasdasdasdasdasdasdas', 'SEKRETARIS dataSetting,KAUR KEUANGAN,KASI PEMERINTAH,KASI PELAYANAN,KADUS KALISENG', 'asdasdasasdasdasdasdasdas', '66ad2192b990eb8787fe3c2e092589b6.pdf', '2021-10-26 14:03:31', 1, '2021-10-26 18:47:32', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_template`
--

CREATE TABLE `surat_template` (
  `id_surat` int(16) NOT NULL,
  `kode_surat` varchar(16) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_surat` varchar(500) NOT NULL,
  `slug` text NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_template`
--

INSERT INTO `surat_template` (`id_surat`, `kode_surat`, `id_setting`, `nama_surat`, `slug`, `status`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 'SRT-001', 1, 'Surat Keterangan Pengantar', 'keterangan-pengantar', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(5, 'SRT-002', 1, 'Surat Keterangan Penduduk', 'keterangan-penduduk', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(6, 'SRT-003', 1, 'Surat Pengantar SKCK', 'pengantar-skck', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(7, 'SRT-004', 1, 'Surat Keterangan KTP Dalam Proses', 'ktp-dalam-proses', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(8, 'SRT-005', 1, 'SURAT BEPERGIAN / JALAN', 'bepergian', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(9, 'SRT-006', 1, 'SURAT PENGANTAR LAPORAN KEHILANGAN', 'pengantar-kehilangan', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(10, 'SRT-007', 1, 'SURAT PENGANTAR IZIN KERAMAIAN', 'pengantar-keramaian', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(11, 'SRT-008', 1, 'SURAT KETERANGAN USAHA', 'keterangan-usaha', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(12, 'SRT-009', 1, 'SURAT PERNYATAAN BELUM PERNAH MENIKAH', 'belum-menikah', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(13, 'SRT-010', 1, 'SURAT KETERANGAN BEDA NAMA', 'keterangan-bedanama', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(14, 'SRT-011', 1, 'SURAT KETERANGAN DOMISILI', 'keterangan-domisili', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(16, 'SRT-012', 1, 'SURAT KETERANGAN TIDAK MAMPU', 'tidak-mampu', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(17, 'SRT-013', 1, 'SURAT PERMOHONAN KARTU KELUARGA BARU', 'pemohonan-kk-baru', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(18, 'SRT-014', 1, 'SURAT PERMOHONAN KTP', 'permohonan-ktp', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(19, 'SRT-015', 1, 'SURAT PERMOHONAN CERAI', 'permohonan-cerai', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(20, 'SRT-016', 1, 'SURAT PERNYATAAN BELUM MEMILIKI AKTE LAHIR', 'pernyataan-akte-lahir', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(21, 'SRT-017', 1, 'SURAT PERMOHONAN AKTA LAHIR', 'permohonan-akte-lahir', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(22, 'SRT-018', 1, 'SURAT KETERANGAN DOMISILI USAHA', 'keterangan-domisili-usaha', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(23, 'SRT-019', 1, 'SURAT KETERANGAN JAMKESOS', 'keterangan-jamkesos', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(24, 'SRT-020', 1, 'SURAT KETERANGAN WALI HAKIM', 'keterangan-wali-hakim', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL),
(25, 'SRT-021', 1, 'SURAT PERMOHONAN PERUBAHAN KK', 'permohonan-perubahan-kk', 'aktif', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_tag` varchar(150) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `id_setting`, `nama_tag`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(6, 1, 'Wisata', 1, '2021-09-11 11:18:56', 1, '2021-09-21 12:02:11'),
(7, 1, 'Pemandian', 1, '2021-09-11 12:32:35', 1, '2021-09-21 12:02:15'),
(8, 1, 'Explore', 1, '2021-09-11 12:32:35', 1, '2021-09-21 12:02:15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `nohp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('Administrator','Owner','Operator') NOT NULL,
  `image` text NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_setting`, `email`, `password`, `nama`, `jk`, `nohp`, `alamat`, `level`, `image`, `status`, `created_date`) VALUES
(1, 1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Firman', 'LAKI-LAKI', '082237962182', 'Jalan KH Samanhudi No 20 Medan', 'Administrator', 'default.jpg', 'Aktif', '2021-11-01 17:05:55'),
(2, 2, 'iman@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Firman', 'LAKI-LAKI', '0', 'aw', 'Administrator', 'default.jpg', 'Aktif', '2021-11-04 15:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id_visitor` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `visitor` int(50) NOT NULL,
  `browser` varchar(150) DEFAULT NULL,
  `ip_address` varchar(150) NOT NULL,
  `os` varchar(150) DEFAULT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id_visitor`, `id_setting`, `visitor`, `browser`, `ip_address`, `os`, `created`) VALUES
(62, 1, 1, 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-10'),
(63, 1, 5, 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-10'),
(64, 1, 1, 'Chrome 94.0.4606.71', '::1', 'Windows 10', '2021-10-11'),
(65, 1, 30, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-13'),
(66, 1, 20, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-16'),
(67, 1, 11, 'Chrome 94.0.4606.81', '212312312', 'Windows 10', '2021-10-16'),
(68, 1, 1, 'Chrome 94.0.4606.81', '212312312', 'Windows 10', '2021-10-16'),
(69, 0, 1, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-21'),
(70, 0, 1, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-21'),
(71, 0, 1, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-21'),
(72, 1, 1, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-22'),
(73, 1, 1, 'Chrome 94.0.4606.81', '::1', 'Windows 10', '2021-10-23'),
(74, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-26'),
(75, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-27'),
(76, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-28'),
(77, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-10-31'),
(78, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-01'),
(79, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-02'),
(80, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-04'),
(81, 1, 1, 'Chrome 95.0.4638.54', '::1', 'Windows 10', '2021-11-05'),
(82, 1, 1, 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-06'),
(83, 0, 1, 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07'),
(84, 1, 1, 'Chrome 95.0.4638.69', '::1', 'Windows 10', '2021-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_dusun` varchar(225) NOT NULL,
  `nik_kepala_dusun` varchar(16) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `edited` datetime DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `id_setting`, `nama_dusun`, `nik_kepala_dusun`, `created`, `created_by`, `edited`, `edited_by`, `deleted`) VALUES
(1, 1, 'KALISENG', '1207236701920003', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', NULL, NULL),
(4, 1, 'Deli', '1207236701920002', '0000-00-00 00:00:00', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_detail`
--

CREATE TABLE `wilayah_detail` (
  `id_wilayah_detail` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `jumlah_rt` int(11) NOT NULL,
  `jumlah_rw` int(11) NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wilayah_detail`
--

INSERT INTO `wilayah_detail` (`id_wilayah_detail`, `id_setting`, `id_wilayah`, `jumlah_rt`, `jumlah_rw`, `created`, `edited`, `deleted`) VALUES
(1, 1, 1, 1, 1, '07-09-2021 16:19:18-admin@gmail.com', '', NULL),
(3, 1, 4, 0, 0, '08-09-2021 14:12:39-admin', '', NULL),
(4, 1, 5, 0, 0, '09-09-2021 17:48:31-admin@gmail.com', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `id_wisata_tag` varchar(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `slug` text NOT NULL,
  `konten` longtext NOT NULL,
  `images` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `id_setting`, `id_wisata_tag`, `judul`, `slug`, `konten`, `images`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(34, 1, '6,7', 'Wisata Alam Air Terjun Bali', 'wisata-alam-air-terjun-bali', '<p>asdasdas</p>', '81e14fbeb769163110a3d962c6b4c32d.jpg', 1, '2021-09-21 13:17:27', 1, '2021-09-21 11:47:57'),
(35, 1, '6,7,8,9', 'dsadas', 'dsadas', '<p>dasasdasdas</p>', '6dac069cb79aedd84dec123af0532d9e.jpg', 1, '2021-09-21 13:33:57', 1, '2021-09-21 11:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `wisata_tag`
--

CREATE TABLE `wisata_tag` (
  `id_wisata_tag` int(11) NOT NULL,
  `id_setting` int(11) NOT NULL,
  `nama_tag` varchar(150) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wisata_tag`
--

INSERT INTO `wisata_tag` (`id_wisata_tag`, `id_setting`, `nama_tag`, `created_by`, `created_date`, `edited_by`, `edited_date`) VALUES
(6, 1, 'Kesehatan', 1, '2021-09-11 11:18:56', 1, '2021-09-11 09:18:56'),
(7, 1, 'Politik', 1, '2021-09-11 12:32:35', 1, '2021-09-11 10:32:35'),
(8, 1, 'Air\r\n', 1, '2021-09-11 12:32:35', 1, '2021-09-11 10:32:35'),
(9, 1, 'Angin\r\n', 1, '2021-09-11 12:32:35', 1, '2021-09-11 10:32:35'),
(10, 1, 'Udaraa', 1, '2021-10-22 22:13:25', 1, '2021-10-22 15:13:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_warga`
--
ALTER TABLE `akun_warga`
  ADD PRIMARY KEY (`id_akun_warga`);

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id_bantuan`);

--
-- Indexes for table `bantuan_detail`
--
ALTER TABLE `bantuan_detail`
  ADD PRIMARY KEY (`id_bantuan_dtl`);

--
-- Indexes for table `broadcast_sms`
--
ALTER TABLE `broadcast_sms`
  ADD PRIMARY KEY (`id_broadcast_sms`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indexes for table `galleri`
--
ALTER TABLE `galleri`
  ADD PRIMARY KEY (`id_galleri`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `jenis_sms`
--
ALTER TABLE `jenis_sms`
  ADD PRIMARY KEY (`id_jenis_sms`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_kelompok`
--
ALTER TABLE `kategori_kelompok`
  ADD PRIMARY KEY (`id_kategori_kel`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indexes for table `kelompok_detail`
--
ALTER TABLE `kelompok_detail`
  ADD PRIMARY KEY (`id_dtl_kel`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `keluarga_detail`
--
ALTER TABLE `keluarga_detail`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `lapor`
--
ALTER TABLE `lapor`
  ADD PRIMARY KEY (`id_lapor`);

--
-- Indexes for table `layanan_surat_detail`
--
ALTER TABLE `layanan_surat_detail`
  ADD PRIMARY KEY (`id_proses_surat`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id_log_login`);

--
-- Indexes for table `log_login_warga`
--
ALTER TABLE `log_login_warga`
  ADD PRIMARY KEY (`id_log_login_warga`);

--
-- Indexes for table `master_agama`
--
ALTER TABLE `master_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `master_akseptor_kb`
--
ALTER TABLE `master_akseptor_kb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_golongan_darah`
--
ALTER TABLE `master_golongan_darah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jekel`
--
ALTER TABLE `master_jekel`
  ADD PRIMARY KEY (`id_jekel`);

--
-- Indexes for table `master_kawin`
--
ALTER TABLE `master_kawin`
  ADD PRIMARY KEY (`id_kawin`);

--
-- Indexes for table `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `master_pendidikan_ditempuh`
--
ALTER TABLE `master_pendidikan_ditempuh`
  ADD PRIMARY KEY (`id_psd`);

--
-- Indexes for table `master_sakit`
--
ALTER TABLE `master_sakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_status_penduduk`
--
ALTER TABLE `master_status_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_warga_negara`
--
ALTER TABLE `master_warga_negara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pejabat`
--
ALTER TABLE `pejabat`
  ADD PRIMARY KEY (`id_pejabat`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`id_realisasi`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id_rt`);

--
-- Indexes for table `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id_rw`);

--
-- Indexes for table `sk_kades`
--
ALTER TABLE `sk_kades`
  ADD PRIMARY KEY (`id_sk_kades`);

--
-- Indexes for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  ADD PRIMARY KEY (`id_sumber_dana`);

--
-- Indexes for table `sumber_dana_bidang`
--
ALTER TABLE `sumber_dana_bidang`
  ADD PRIMARY KEY (`id_sumber_dana_bidang`);

--
-- Indexes for table `surat_detail`
--
ALTER TABLE `surat_detail`
  ADD PRIMARY KEY (`id_surat_dtl`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`);

--
-- Indexes for table `surat_template`
--
ALTER TABLE `surat_template`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id_visitor`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- Indexes for table `wilayah_detail`
--
ALTER TABLE `wilayah_detail`
  ADD PRIMARY KEY (`id_wilayah_detail`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- Indexes for table `wisata_tag`
--
ALTER TABLE `wisata_tag`
  ADD PRIMARY KEY (`id_wisata_tag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_warga`
--
ALTER TABLE `akun_warga`
  MODIFY `id_akun_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id_bantuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bantuan_detail`
--
ALTER TABLE `bantuan_detail`
  MODIFY `id_bantuan_dtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `broadcast_sms`
--
ALTER TABLE `broadcast_sms`
  MODIFY `id_broadcast_sms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `galleri`
--
ALTER TABLE `galleri`
  MODIFY `id_galleri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jenis_sms`
--
ALTER TABLE `jenis_sms`
  MODIFY `id_jenis_sms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori_kelompok`
--
ALTER TABLE `kategori_kelompok`
  MODIFY `id_kategori_kel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelompok_detail`
--
ALTER TABLE `kelompok_detail`
  MODIFY `id_dtl_kel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keluarga_detail`
--
ALTER TABLE `keluarga_detail`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lapor`
--
ALTER TABLE `lapor`
  MODIFY `id_lapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `layanan_surat_detail`
--
ALTER TABLE `layanan_surat_detail`
  MODIFY `id_proses_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id_log_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `log_login_warga`
--
ALTER TABLE `log_login_warga`
  MODIFY `id_log_login_warga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `master_agama`
--
ALTER TABLE `master_agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_akseptor_kb`
--
ALTER TABLE `master_akseptor_kb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_golongan_darah`
--
ALTER TABLE `master_golongan_darah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_jekel`
--
ALTER TABLE `master_jekel`
  MODIFY `id_jekel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_kawin`
--
ALTER TABLE `master_kawin`
  MODIFY `id_kawin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_pendidikan_ditempuh`
--
ALTER TABLE `master_pendidikan_ditempuh`
  MODIFY `id_psd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `master_sakit`
--
ALTER TABLE `master_sakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_status_penduduk`
--
ALTER TABLE `master_status_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_warga_negara`
--
ALTER TABLE `master_warga_negara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pejabat`
--
ALTER TABLE `pejabat`
  MODIFY `id_pejabat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `id_realisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rt`
--
ALTER TABLE `rt`
  MODIFY `id_rt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rw`
--
ALTER TABLE `rw`
  MODIFY `id_rw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_kades`
--
ALTER TABLE `sk_kades`
  MODIFY `id_sk_kades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sumber_dana`
--
ALTER TABLE `sumber_dana`
  MODIFY `id_sumber_dana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sumber_dana_bidang`
--
ALTER TABLE `sumber_dana_bidang`
  MODIFY `id_sumber_dana_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_detail`
--
ALTER TABLE `surat_detail`
  MODIFY `id_surat_dtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_template`
--
ALTER TABLE `surat_template`
  MODIFY `id_surat` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id_visitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wilayah_detail`
--
ALTER TABLE `wilayah_detail`
  MODIFY `id_wilayah_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `wisata_tag`
--
ALTER TABLE `wisata_tag`
  MODIFY `id_wisata_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
