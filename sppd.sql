-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2024 pada 17.00
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kantor`
--

CREATE TABLE `kantor` (
  `id_kantor` int(255) NOT NULL,
  `nama_kantor` varchar(100) NOT NULL,
  `alamat_kantor` varchar(100) NOT NULL,
  `uang_harian` int(10) NOT NULL,
  `transport` int(10) NOT NULL,
  `akomodasi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kantor`
--

INSERT INTO `kantor` (`id_kantor`, `nama_kantor`, `alamat_kantor`, `uang_harian`, `transport`, `akomodasi`) VALUES
(1, 'BKN Jakarta', 'jl.kgisadiu', 540000, 500000, 0),
(2, 'BKN Bandung', 'bjbdwbodowdb', 370000, 476000, 400000),
(3, 'Polres Tangsel', 'jl.ijbqiwjdn', 100000, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_staff` int(200) NOT NULL,
  `nama_staff` varchar(100) NOT NULL,
  `nip` varchar(1000) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_staff`, `nama_staff`, `nip`, `golongan`, `jabatan`) VALUES
(1, 'Drs. FUAD,MPA', '196504041990011001', 'IV/C Pembina Utama Muda', 'Kepala BKPSDM'),
(4, 'ihjwefje', '1232', 'oqjefkj', 'kj kjfqwd'),
(5, 'anto', '12321323', 'gol 1', 'jab 1'),
(6, 'asep', '42342342', 'gol 2', 'jab 2'),
(7, 'Boy Muhammad Danial, S.SI., M.SI', '196504041990011001', 'Pejabat Pelaksana Teknis Kegiatan', 'Pejabat Pelaksana Teknis Kegiatan'),
(8, 'Yani Octarani, S,E', '196504041990011001', 'Bendahara Pengeluaran', 'Bendahara Pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_09_12_032218_create_role_table', 1),
(10, '2024_09_12_081618_add_status_to_tr_sppd_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(200) NOT NULL,
  `nama_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'User'),
(2, 'Super Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spj`
--

CREATE TABLE `spj` (
  `id_spj` int(250) NOT NULL,
  `no_kwitansi` varchar(200) NOT NULL,
  `id_sppd` int(200) NOT NULL,
  `file_spt` varchar(150) NOT NULL,
  `file_spd` varchar(150) NOT NULL,
  `file_visum` varchar(150) NOT NULL,
  `file_laporan` varchar(150) NOT NULL,
  `file_kwitansi` varchar(150) NOT NULL,
  `file_poto` varchar(150) NOT NULL,
  `file_notabensin` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spj`
--

INSERT INTO `spj` (`id_spj`, `no_kwitansi`, `id_sppd`, `file_spt`, `file_spd`, `file_visum`, `file_laporan`, `file_kwitansi`, `file_poto`, `file_notabensin`) VALUES
(8, '19823982', 39, 'spj/bUwr0k9YCKmRRxfZUIPc7ULWIqa9utw5AwDakEDg.pdf', 'spj/fDEm44QsewBbdrdp3tAMUGxrh2WqieCpEDwmrE7l.pdf', 'spj/sG871V7uN5rzAiEA9gRS3voWIhJeKYutUNO9k74S.pdf', 'spj/Vx5gz7ZqcvLOXxCLQALuzr6fJljtWQ8aRTiDP5Sw.pdf', 'spj/W5iMC5u2SICsiqcIoEGIpEI6vnIHdjMYeyjpXBc2.pdf', 'spj/w3YbCj3j2RitRMyoBHvAyzSghCM9oNt5j3yOUDYK.png', 'spj/0WVmo85e5KJ6ToKpB9HXCDrqkTjuV3qjWj1t1GPa.png'),
(9, '23423434', 40, 'spj/Mgmq4TPFL2ic3qMvffPWiGQq618IkRs2tVv9faXu.pdf', 'spj/QOw4VIPyoN8YUMeKYMDddLTadX53LEARHuwFbTue.pdf', 'spj/qR6lJgMMhkbnoNsMYjWceEnE21ALpgJzaWbEfqv6.pdf', 'spj/MqRJvFRJPTe45IQeulbmE4wijuZZ7yamg4FsR0xm.pdf', 'spj/wqM60SNkbmxRwq3986Od985fEm3lC5zvINEjuUhN.pdf', 'spj/lFXsjSA8CpVOuuPDb0rz3Oj1hUcsNBzgxvQEjYu2.png', 'spj/wcrkAARw6YXz7vK8boD9OsvJS0svYDp7GIeQyxXv.png'),
(10, '893798213', 46, 'spj/MhKWMYj0YH8w4dXN9b4KzOCL0nIJsTsh3YwQ08wS.pdf', 'spj/XS3R9slwxYDHdrb9Cg1cuFegPuow3QqX6yt0vSLV.pdf', 'spj/W4aqlWEt1uQAjOHyjPUBHRMt84yqbLjeyrp1E7o6.pdf', 'spj/Wsh5iPxzGF8VGwzh0treT5UZ5n2oteshI2Pfwz31.pdf', 'spj/R5IECUv3tnpak5CVR3Z9Xd2MEy8h6Kq0DjF727K6.pdf', 'spj/NYrXuo18VmQa7rhQL006f4EZ0lWVtoGg514gVeUt.png', 'spj/5S0VfdWE4EWxY4JODQmppahX1ruzmKslVfsXZ3Hx.png'),
(11, '29021213', 52, 'spj/2rgPX0f5T52KTFHkXlaiOtJcCwigf5RctHY8bOZs.pdf', 'spj/KEijJZz68kNcCN7OhuJTWHxzrMmiovmjByRrVu6j.pdf', 'spj/XudJWcVHlMSlm1vmkPwynhsQg4ERbPRqoyBv3ni1.pdf', 'spj/uHDdkQajuudkqZl80FvJVNeYwrK5Y8xlMGaAmVcy.pdf', 'spj/7pjCNnPQgcWDEP5AZjZlDZB88HMEMnqsHpEzLOqg.pdf', 'spj/47mP5lstXAcBNPqxhbDbgHcR3r4YGaWKMCnec2OM.png', 'spj/KeHw0V1J7Mmxkl5xIlx68bUeJig6SA6ls03500sK.png'),
(12, '874981432', 63, 'spj/INdfeC6ithdZPSaAiYaewdzj3tBE8pAu1JP8RnwP.pdf', 'spj/vgFThXkxDSHnYNbefk9lGYb0CzvgxuudiSZoWp87.pdf', 'spj/6t7hp2TVV9NInMKGYPkzn6cMloIgPGwAySHkBNaX.pdf', 'spj/kmy2wf4hJA8IqkZ2y8MGsA9X1ka1T1lZ2HhDGsTP.pdf', 'spj/K9utwnMDqBXohNbRQ8FSXiVlqcDtzb2qj2lHY4w0.pdf', 'spj/gzqjcCPXiILRakegVdZyJI1VTNk1wyw6bg8vzqyb.png', 'spj/CZnhRm1i8cPqRvz9zvpmAfrn5O67gO0kKcerEndn.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_kerja`
--

CREATE TABLE `tim_kerja` (
  `id_tim_kerja` int(200) NOT NULL,
  `anggaran_awal` int(10) NOT NULL,
  `sisa_anggaran` int(150) NOT NULL,
  `tahun_anggaran` int(4) NOT NULL,
  `nama_tim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tim_kerja`
--

INSERT INTO `tim_kerja` (`id_tim_kerja`, `anggaran_awal`, `sisa_anggaran`, `tahun_anggaran`, `nama_tim`) VALUES
(3, 1000000000, 1, 2024, 'jwnfekn'),
(4, 2000000000, -113964468, 2025, 'khjed'),
(5, 300000000, -6287, 2024, ';jekdj'),
(6, 10000000, -1560, 2024, 'P2INKA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_kwitansi`
--

CREATE TABLE `tr_kwitansi` (
  `id_kwitansi` int(200) NOT NULL,
  `no_kwitansi` varchar(100) NOT NULL,
  `id_sppd` int(100) NOT NULL,
  `id_tr_sppd_pegawai` int(100) NOT NULL,
  `laporan` varchar(500) NOT NULL,
  `total_harian` int(100) NOT NULL,
  `total_transport` int(100) NOT NULL,
  `total_akomodasi` int(100) NOT NULL,
  `total_kwitansi` int(100) NOT NULL,
  `lama_perjalanan` int(50) NOT NULL,
  `biaya_transport` int(50) NOT NULL,
  `lama_akomodasi` int(50) NOT NULL,
  `uang_hari` int(100) NOT NULL,
  `uang_transport` int(100) NOT NULL,
  `uang_akomodasi` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_kwitansi`
--

INSERT INTO `tr_kwitansi` (`id_kwitansi`, `no_kwitansi`, `id_sppd`, `id_tr_sppd_pegawai`, `laporan`, `total_harian`, `total_transport`, `total_akomodasi`, `total_kwitansi`, `lama_perjalanan`, `biaya_transport`, `lama_akomodasi`, `uang_hari`, `uang_transport`, `uang_akomodasi`) VALUES
(48, '19230921', 49, 74, 'qwubdeiqbwd qwdbqw', 80, 50, 0, 130, 2, 1, 0, 40, 50, 60),
(49, '19230921', 49, 75, 'qwubdeiqbwd qwdbqw', 80, 0, 180, 260, 2, 0, 3, 40, 50, 60),
(50, '12370923', 51, 78, 'qwjdjqwd qwjd', 3500, 20000, 2520, 26020, 50, 250, 28, 70, 80, 90),
(51, '29021213', 52, 79, 'k;qJW DKJ', 120, 100, 120, 340, 3, 2, 2, 40, 50, 60),
(52, '1230923', 48, 72, 'qwkjbdkjqwd', 40, 100, 120, 260, 1, 2, 2, 40, 50, 60),
(53, '1230923', 48, 73, 'qwkjbdkjqwd', 80, 100, 120, 300, 2, 2, 2, 40, 50, 60),
(54, '128398123', 50, 76, 'ljnfjnf qejfbjq', 140, 80, 0, 220, 2, 1, 0, 70, 80, 90),
(55, '128398123', 50, 77, 'ljnfjnf qejfbjq', 140, 80, 0, 220, 2, 1, 0, 70, 80, 90),
(56, '91879282', 55, 82, 'iwubediqwe wjebiwe', 10, 20, 30, 60, 1, 1, 1, 10, 20, 30),
(60, '19039123', 57, 86, 'jd;qwoidnqw d;qwjdowqd', 140, 240, 90, 470, 2, 3, 1, 70, 80, 90),
(61, '19039123', 57, 87, 'jd;qwoidnqw d;qwjdowqd', 140, 80, 450, 670, 2, 1, 5, 70, 80, 90),
(62, '2980912', 58, 88, 'noindoiqw', 70, 160, 180, 410, 1, 2, 2, 70, 80, 90),
(63, '2980912', 58, 89, 'noindoiqw', 140, 160, 180, 480, 2, 2, 2, 70, 80, 90),
(64, '2980912', 58, 90, 'noindoiqw', 140, 160, 180, 480, 2, 2, 2, 70, 80, 90),
(65, '2980912', 58, 91, 'noindoiqw', 140, 160, 180, 480, 2, 2, 2, 70, 80, 90),
(66, '874981432', 63, 98, 'kajskjbasd', 60000, 406000, 400000, 866000, 2, 1, 1, 30000, 406000, 400000),
(67, '874981432', 63, 99, 'kajskjbasd', 600000, 0, 400000, 1000000, 2, 0, 1, 300000, 406000, 400000),
(68, '874981432', 63, 100, 'kajskjbasd', 740000, 0, 1200000, 1940000, 2, 0, 3, 370000, 476000, 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_sppd`
--

CREATE TABLE `tr_sppd` (
  `id_sppd` int(255) NOT NULL,
  `no_spt` varchar(100) NOT NULL,
  `ppk` varchar(100) NOT NULL,
  `perihal_sppd` varchar(500) NOT NULL,
  `angkutan` varchar(20) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `lama_perjalanan` varchar(10) NOT NULL,
  `tgl_spt` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_sppd`
--

INSERT INTO `tr_sppd` (`id_sppd`, `no_spt`, `ppk`, `perihal_sppd`, `angkutan`, `tujuan`, `tgl_berangkat`, `tgl_kembali`, `lama_perjalanan`, `tgl_spt`, `status`) VALUES
(48, '129380923', 'Drs. FUAD,MPA', ';kiqebudiqwd iqwbdiwd', 'Udara', 'kbjbaskdjbaksjbd', '2024-10-11', '2024-10-14', '3 hari', '2024-10-11', 'Laporan Submitted'),
(49, '87398123', 'Drs. FUAD,MPA', 'eibdiuqd iqwubdiqwd', 'Udara', 'kbjbaskdjbaksjbd', '2024-10-12', '2024-10-17', '5 hari', '2024-10-12', 'Laporan Submitted'),
(50, '13709123', 'Drs. FUAD,MPA', 'jkbqwijdiqw wjbddqw', 'Darat', 'jhbjwdb', '2024-10-11', '2024-10-14', '3 hari', '2024-10-12', 'Laporan Submitted'),
(51, '0987654321', 'Drs. FUAD,MPA', 'iqubwdiuqw diqwdiqw', 'Darat', 'jhbjwdb', '2024-10-12', '2024-10-14', '2 hari', '2024-10-12', 'Laporan Submitted'),
(52, '182739832', 'Drs. FUAD,MPA', 'qkwjbdijwd', 'Darat', 'kbjbaskdjbaksjbd', '2024-10-12', '2024-10-15', '3 hari', '2024-10-11', 'Laporan Submitted'),
(54, '128792', 'Drs. FUAD,MPA', 'wwhwdvhqwd dw iuhewdasggbfibe fouqewfi eifoubweif weiufbipefb qwiep fpieqwufbipef piqewufvbpie fpiqejhfpq fopiuqehvfief', 'Udara', 'BKN Jakarta', '2024-10-11', '2024-10-11', '1 hari', '2024-10-12', 'Aktif'),
(55, '12909322', 'Drs. FUAD,MPA', 'qwjdbjqwd qiwjdbjqwd', 'Udara', 'hohsdhfoi', '2024-10-11', '2024-10-14', '3 hari', '2024-10-11', 'Laporan Submitted'),
(56, '21309232', 'Drs. FUAD,MPA', 'iqwubdiqw dij qwd', 'Udara', 'kbjbaskdjbaksjbd', '2024-10-12', '2024-10-14', '2 hari', '2024-10-11', 'Laporan Submitted'),
(57, '12037019', 'Drs. FUAD,MPA', 'ew dkijqw dijq wd', 'Udara', 'jhbjwdb', '2024-10-12', '2024-10-15', '3 hari', '2024-10-11', 'Laporan Submitted'),
(58, '18029380', 'Drs. FUAD,MPA', 'k;jsb dk;jq wkdj kqjd', 'Darat', 'jhbjwdb', '2024-10-12', '2024-10-12', '1 hari', '2024-10-11', 'Laporan Submitted'),
(59, '192873981', 'Drs. FUAD,MPA', 'k;qjbdkjqwd', 'Udara', 'kbjbaskdjbaksjbd', '2024-10-12', '2024-10-15', '3 hari', '2024-10-11', 'Aktif'),
(60, 'gg', 'Drs. FUAD,MPA', 'ggdd', 'Darat', 'Polres Tangsel', '2024-10-11', '2024-10-17', '6 hari', '2024-10-11', 'Aktif'),
(61, '7687687', 'Drs. FUAD,MPA', 'hpiwefi iepf iefub eijf ie', 'Udara', 'BKN Bandung', '2024-10-12', '2024-10-15', '3 hari', '2024-10-12', 'Aktif'),
(62, '10973032', 'Drs. FUAD,MPA', 'jhwvdfjhfvef ekfjbef', 'Udara', 'BKN Bandung', '2024-10-12', '2024-10-19', '7 hari', '2024-10-12', 'Aktif'),
(63, 'viu4982/.298,29', 'Drs. FUAD,MPA', 'uvuivui uvuyvu uvuvuyfterdhckjhfo noouoiugo iyfuyfuyf yguyuyguyg fcdtrdytfuyfuyfuyjv j uiuiuy', 'Darat', 'BKN Bandung', '2024-10-18', '2024-10-22', '4 hari', '2024-10-17', 'Laporan Submitted');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_sppd_pegawai`
--

CREATE TABLE `tr_sppd_pegawai` (
  `id_tr_sppd_pegawai` int(255) NOT NULL,
  `id_sppd` int(255) NOT NULL,
  `id_staff` int(255) NOT NULL,
  `nama_tim` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_sppd_pegawai`
--

INSERT INTO `tr_sppd_pegawai` (`id_tr_sppd_pegawai`, `id_sppd`, `id_staff`, `nama_tim`) VALUES
(72, 48, 1, '5'),
(73, 48, 5, '5'),
(74, 49, 4, '6'),
(75, 49, 6, '6'),
(76, 50, 1, '6'),
(77, 50, 6, '6'),
(78, 51, 6, '5'),
(79, 52, 4, '5'),
(80, 53, 5, '5'),
(81, 54, 5, '5'),
(82, 55, 6, '6'),
(83, 56, 4, '6'),
(84, 56, 6, '6'),
(85, 56, 5, '6'),
(86, 57, 4, '6'),
(87, 57, 5, '6'),
(88, 58, 1, '6'),
(89, 58, 4, '6'),
(90, 58, 5, '6'),
(91, 58, 6, '6'),
(92, 59, 4, '6'),
(93, 59, 6, '6'),
(94, 60, 1, '5'),
(95, 61, 4, '5'),
(96, 61, 5, '5'),
(97, 62, 4, '5'),
(98, 63, 7, '5'),
(99, 63, 1, '5'),
(100, 63, 8, '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(250) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tim` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_tim`, `nama_role`, `created_at`, `updated_at`) VALUES
(17, 'apapun', '$2y$10$geS6nri98thzieXjukRsE.j//opBQTrxWnHaHRbw84qOB1xP5F0tu', '4', '2', '2024-09-29 19:08:29', '2024-10-02 08:54:24'),
(20, 'iyaiyaiya', '$2y$10$n7oCUJx3M6HqJDoUw2u5hu9toPYcdHZeBbkstgQLp8rePSNaWYyAO', '4', '2', '2024-10-01 22:03:41', '2024-10-01 22:03:41'),
(21, 'user', '$2y$10$X6.u.mseOGuOBVTeLa86COqtZQ5bvharG93zY3lRhE5k7d5bQON42', '4', '1', '2024-10-06 19:49:26', '2024-10-06 19:49:36'),
(22, 'superadmin', '$2y$10$miIgFBkG..whLvyHSBDWJ.xuIskUyGaOdqvz9ju03vuTnhTMWcs9G', '5', '2', '2024-10-06 19:49:55', '2024-10-06 19:49:55'),
(23, 'tim1', '$2y$10$z4Apu4yijClZQk7HSc9aFuW7Ql6hzynZq5tnpSz8hrWYYiMS1FvM6', '6', '1', '2024-10-10 00:12:02', '2024-10-10 00:12:02'),
(24, 'tim2', '$2y$10$aAE7EryKbH9sg1//O51FI.0Ekmb6M63h5EUUw7N1F..N51/vtSbIC', '6', '1', '2024-10-10 00:28:46', '2024-10-10 00:28:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id_kantor`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `spj`
--
ALTER TABLE `spj`
  ADD PRIMARY KEY (`id_spj`);

--
-- Indeks untuk tabel `tim_kerja`
--
ALTER TABLE `tim_kerja`
  ADD PRIMARY KEY (`id_tim_kerja`);

--
-- Indeks untuk tabel `tr_kwitansi`
--
ALTER TABLE `tr_kwitansi`
  ADD PRIMARY KEY (`id_kwitansi`);

--
-- Indeks untuk tabel `tr_sppd`
--
ALTER TABLE `tr_sppd`
  ADD PRIMARY KEY (`id_sppd`);

--
-- Indeks untuk tabel `tr_sppd_pegawai`
--
ALTER TABLE `tr_sppd_pegawai`
  ADD PRIMARY KEY (`id_tr_sppd_pegawai`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id_kantor` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_staff` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `spj`
--
ALTER TABLE `spj`
  MODIFY `id_spj` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tim_kerja`
--
ALTER TABLE `tim_kerja`
  MODIFY `id_tim_kerja` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tr_kwitansi`
--
ALTER TABLE `tr_kwitansi`
  MODIFY `id_kwitansi` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tr_sppd`
--
ALTER TABLE `tr_sppd`
  MODIFY `id_sppd` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `tr_sppd_pegawai`
--
ALTER TABLE `tr_sppd_pegawai`
  MODIFY `id_tr_sppd_pegawai` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(250) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
