-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Mar 2024 pada 00.59
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_fajar_timur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(128) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `delete_sts`, `created_at`, `created_user`, `updated_at`, `updated_user`) VALUES
(1, 'Aksesoris Mobils', 0, '2024-03-11 12:40:34', NULL, '2024-03-11 12:43:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_level_1`
--

CREATE TABLE `menu_level_1` (
  `id` int(11) NOT NULL,
  `url` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `icon` varchar(256) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_level_2`
--

CREATE TABLE `menu_level_2` (
  `id` int(11) NOT NULL,
  `id_menu_level_1` int(11) DEFAULT NULL,
  `url` varchar(126) DEFAULT NULL,
  `title` varchar(126) DEFAULT NULL,
  `icon` varchar(126) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `status_sub` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_level_3`
--

CREATE TABLE `menu_level_3` (
  `id` int(11) NOT NULL,
  `id_menu_level_2` int(11) DEFAULT NULL,
  `url` varchar(126) DEFAULT NULL,
  `title` varchar(126) DEFAULT NULL,
  `icon` varchar(126) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_admin`
--

CREATE TABLE `notifikasi_admin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(126) DEFAULT NULL,
  `isi_notifikasi` longtext DEFAULT NULL,
  `status_notif` int(11) DEFAULT NULL,
  `id_status_pembayaran` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_user`
--

CREATE TABLE `notifikasi_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(126) DEFAULT NULL,
  `isi_notifikasi` longtext DEFAULT NULL,
  `status_notif` int(11) DEFAULT NULL,
  `id_status_pembayaran` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `kode_product` varchar(126) DEFAULT NULL,
  `nama_barang` varchar(256) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `id_kategori`, `kode_product`, `nama_barang`, `harga`, `berat`, `deskripsi`, `stok`, `image`, `delete_sts`, `created_at`, `created_user`, `updated_at`, `updated_user`) VALUES
(1, 1, '0nZ7YiIVb8', 'Holder HP', 30000, 10, 'holder hp untuk mobil garansi 1 tahun', 30, 'barang_20240317-105546.jpg', 0, '2024-03-17 10:12:43', NULL, '2024-03-17 10:55:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_pembayaran_pelanggan`
--

CREATE TABLE `rekap_pembayaran_pelanggan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_order` varchar(126) DEFAULT NULL,
  `tgl_order` datetime DEFAULT NULL,
  `nama_penerima` varchar(126) DEFAULT NULL,
  `provinsi` varchar(126) DEFAULT NULL,
  `kota` varchar(126) DEFAULT NULL,
  `alamat_penerima` longtext DEFAULT NULL,
  `kode_pos` varchar(126) DEFAULT NULL,
  `ekspedisi` varchar(126) DEFAULT NULL,
  `paket` varchar(126) DEFAULT NULL,
  `estimasi` varchar(126) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `status_pembayaran` int(11) DEFAULT NULL,
  `bukti_bayar` varchar(126) DEFAULT NULL,
  `atas_nama` varchar(126) DEFAULT NULL,
  `nama_bank` varchar(126) DEFAULT NULL,
  `no_rek` varchar(126) DEFAULT NULL,
  `status_order` int(11) DEFAULT NULL,
  `no_resi` varchar(126) DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL,
  `hp_penerima` varchar(120) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(126) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id` int(11) NOT NULL,
  `status_pembayaran` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rekening`
--

CREATE TABLE `tbl_rekening` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(126) DEFAULT NULL,
  `no_rek` varchar(126) DEFAULT NULL,
  `atas_nama` varchar(126) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rinci_transaksi`
--

CREATE TABLE `tbl_rinci_transaksi` (
  `id` int(11) NOT NULL,
  `no_order` varchar(126) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(126) DEFAULT NULL,
  `username` varchar(126) DEFAULT NULL,
  `alamat` longtext DEFAULT NULL,
  `email` varchar(126) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `image` varchar(126) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(126) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `alamat`, `email`, `password`, `no_hp`, `image`, `id_role`, `is_active`, `delete_sts`, `created_at`, `created_user`, `updated_at`, `updated_user`) VALUES
(1, 'Admin', 'admin', '', 'admin@gmail.com', '$2y$10$1Y5ALImDUmwS.kCBQGzUeeo//N2l/rECscqfPRxLuLHnkzbYXNlia', '0853256898974', NULL, 1, 1, 0, '2024-03-10 19:00:26', 'admin', NULL, NULL),
(2, 'Samsul12', 'samsul', 'Jl. Majapahit RT 05 RW 03', 'samsul@gmail.com', '$2y$10$BUBeSUKsSBFXGCe5fIuavOxFsa15w2NcB6rnYSKZpur8aY1zI7Tru', '0856895623', 'user_20240311-115844.png', 2, 1, 0, '2024-03-11 11:58:44', NULL, '2024-03-11 12:06:57', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `id_menu_level_1` int(11) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `token` varchar(256) DEFAULT NULL,
  `delete_sts` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_user` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user` varchar(126) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_level_1`
--
ALTER TABLE `menu_level_1`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_level_2`
--
ALTER TABLE `menu_level_2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_level_3`
--
ALTER TABLE `menu_level_3`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap_pembayaran_pelanggan`
--
ALTER TABLE `rekap_pembayaran_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_rinci_transaksi`
--
ALTER TABLE `tbl_rinci_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menu_level_1`
--
ALTER TABLE `menu_level_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu_level_2`
--
ALTER TABLE `menu_level_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu_level_3`
--
ALTER TABLE `menu_level_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekap_pembayaran_pelanggan`
--
ALTER TABLE `rekap_pembayaran_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_rinci_transaksi`
--
ALTER TABLE `tbl_rinci_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
