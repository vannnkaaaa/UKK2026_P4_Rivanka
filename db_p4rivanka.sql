-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2026 at 04:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_p4rivanka`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kartu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `penerbit_id` bigint UNSIGNED NOT NULL,
  `pengarang_id` bigint UNSIGNED NOT NULL,
  `rak_id` bigint UNSIGNED DEFAULT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `isbn`, `stok`, `penerbit_id`, `pengarang_id`, `rak_id`, `kelas_id`, `kategori`, `foto`, `tahun_terbit`, `created_at`, `updated_at`) VALUES
(1, 'Spring To Summer', '978-234-546', 5, 1, 1, 1, NULL, 'Sains', 'buku/HR3065pMq00zYljMlrZJlfTMgVtg0yN363etazPC.jpg', '2026', '2026-04-13 20:36:53', '2026-04-14 01:22:42'),
(2, 'One Last Breath', '978-235-555', 4, 2, 2, 2, NULL, 'Sains', 'buku/e8iQWwPbebUrfMOkiwDDBdDCCE6AB8o6Xkg3tlC0.jpg', '2026', '2026-04-13 22:49:45', '2026-04-14 01:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id` bigint UNSIGNED NOT NULL,
  `pengembalian_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `hari_terlambat` int NOT NULL DEFAULT '0',
  `status_lunas` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id`, `pengembalian_id`, `jumlah`, `hari_terlambat`, `status_lunas`, `created_at`, `updated_at`) VALUES
(1, 1, 5000, 0, 1, '2026-04-15 00:49:03', '2026-04-16 00:28:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wali_kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_siswa` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `tingkat`, `jurusan`, `wali_kelas`, `jumlah_siswa`, `created_at`, `updated_at`) VALUES
(1, 'XII - RPL', 'XII', 'RPL', 'Cahyohartono', 22, '2026-04-13 20:05:37', '2026-04-13 20:05:37'),
(2, 'XI - RPL', 'XI', 'RPL', 'Cahyohartono', 12, '2026-04-14 19:51:56', '2026-04-14 19:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_04_08_114830_add_role_to_users', 1),
(6, '2026_04_10_075239_add_field_to_users', 1),
(7, '2026_04_10_105747_add_nim_to_users_table', 1),
(8, '2026_04_10_105954_create_anggota_table', 1),
(9, '2026_04_10_110149_fix_no_kartu_nullable_in_users', 1),
(10, '2026_04_12_152424_fix_role_enum_in_users', 1),
(19, '2026_04_13_155452_create_penerbit_table', 2),
(20, '2026_04_13_155522_create_pengarang_table', 2),
(21, '2026_04_13_155630_create_rak_table', 2),
(22, '2026_04_13_155653_create_kelas_table', 2),
(23, '2026_04_13_155710_create_buku_table', 2),
(24, '2026_04_13_155814_create_peminjaman_table', 2),
(25, '2026_04_13_155835_create_pengembalian_table', 2),
(26, '2026_04_13_155856_create_denda_table', 2),
(27, '2026_04_14_000002_add_kategori_foto_to_buku_table', 3),
(28, '2026_04_15_022703_add_kelas_id_to_users_table', 4),
(29, '2026_04_16_074417_add_hari_terlambat_to_denda_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `jumlah` int DEFAULT '1',
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali_rencana` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `buku_id`, `tanggal_kembali`, `created_at`, `updated_at`, `user_id`, `status`, `jumlah`, `tgl_pinjam`, `tgl_kembali_rencana`) VALUES
(1, 1, '2026-04-15', '2026-04-13 22:37:16', '2026-04-14 01:22:42', 2, 'selesai', 1, '2026-04-14', '2026-04-15'),
(2, 2, '2026-04-15', '2026-04-13 22:51:06', '2026-04-13 22:51:39', 2, 'ditolak', 1, '2026-04-14', '2026-04-15'),
(3, 2, '2026-04-15', '2026-04-14 01:42:10', '2026-04-14 01:44:01', 2, 'diterima', 1, '2026-04-14', '2026-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'La NewYork', 'Los Angeles', '2026-04-13 20:35:17', '2026-04-13 20:35:17'),
(2, 'Creed ET', 'Chicago', '2026-04-13 22:48:36', '2026-04-13 22:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id`, `nama`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'LANY', NULL, '2026-04-13 20:35:03', '2026-04-13 20:35:03'),
(2, 'CREED', NULL, '2026-04-13 22:48:11', '2026-04-13 22:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `peminjaman_id`, `tanggal_kembali`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '2026-04-14', '2026-04-14 01:14:03', '2026-04-14 01:22:42', 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_rak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `nama_rak`, `created_at`, `updated_at`, `keterangan`) VALUES
(1, 'Rak A1', '2026-04-13 20:07:21', '2026-04-13 20:27:21', 'ASDAWA'),
(2, 'Rak A2', '2026-04-13 22:49:02', '2026-04-13 22:49:02', 'WQEQ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kartu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','anggota','petugas') COLLATE utf8mb4_unicode_ci DEFAULT 'anggota',
  `kelas_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nis`, `email`, `no_kartu`, `alamat`, `status_aktif`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `kelas_id`) VALUES
(1, 'Admin', NULL, 'admin@ukk2026.com', NULL, NULL, 1, '2026-04-13 17:52:15', '$2y$10$qwwn/3.JtDQk/cJRDkIaIePIVW/yxvXTxP8guienR/uYRT9.zRbl2', NULL, '2026-04-13 17:52:15', '2026-04-13 17:52:15', 'admin', NULL),
(2, 'Rizqia Akbar', '202413', 'anggota@ukk2026.com', 'ANG-001', 'Hantap Raya', 1, NULL, '$2y$10$UDt2zRxplrVMsZGxxEJ45.SDl32WYHNkAXkxjbE.L7E46YHuDScc.', NULL, '2026-04-13 17:56:41', '2026-04-14 19:53:30', 'anggota', 2),
(3, 'GarNugraha', NULL, 'petugas@ukk2026.com', NULL, NULL, 1, NULL, '$2y$10$JnyA7Ira/oPw9NUsERUwR.SJHwy1IE3.grWhdzOFNlosepjJCh4ti', NULL, '2026-04-13 17:58:11', '2026-04-13 17:58:11', 'petugas', NULL),
(7, 'Gavin Mk', '311331', 'anggota2@ukk2026.com', 'ANG-002', 'Antapani', 1, NULL, '$2y$10$Nk4O19krI3RtbAF6KrOSbuh7UUPOj3ryHF2z5nuuxYXRlVvp.oAeS', NULL, '2026-04-14 19:31:58', '2026-04-14 19:31:58', 'anggota', 1),
(8, 'Nay Dzulqor', '202415', 'anggota3@ukk2026.com', 'ANG-003', 'PSM', 1, NULL, '$2y$10$fnc4ADMRhsUlK6lKUWrU2u5JculzNRxG/zdwnHkBPZXZYiqjTCd2y', NULL, '2026-04-14 19:43:05', '2026-04-14 19:43:05', 'anggota', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_user_id_foreign` (`user_id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_penerbit_id_foreign` (`penerbit_id`),
  ADD KEY `buku_pengarang_id_foreign` (`pengarang_id`),
  ADD KEY `buku_rak_id_foreign` (`rak_id`),
  ADD KEY `buku_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `denda_pengembalian_id_foreign` (`pengembalian_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_no_kartu_unique` (`no_kartu`),
  ADD UNIQUE KEY `users_nim_unique` (`nis`),
  ADD KEY `users_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `buku_penerbit_id_foreign` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `buku_pengarang_id_foreign` FOREIGN KEY (`pengarang_id`) REFERENCES `pengarang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `buku_rak_id_foreign` FOREIGN KEY (`rak_id`) REFERENCES `rak` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `denda`
--
ALTER TABLE `denda`
  ADD CONSTRAINT `denda_pengembalian_id_foreign` FOREIGN KEY (`pengembalian_id`) REFERENCES `pengembalian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
