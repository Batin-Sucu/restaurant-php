-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 09:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` text NOT NULL,
  `sifre` text NOT NULL,
  `tur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `isim` text NOT NULL,
  `iletisim` text NOT NULL,
  `puan` float(1,1) DEFAULT 0.0,
  `adres` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yorumlar`
--

CREATE TABLE `yorumlar` (
  `restaurant_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `yorum` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`) USING HASH;

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`restaurant_id`,`kullanici_id`),
  ADD UNIQUE KEY `unique_comment` (`restaurant_id`,`kullanici_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD CONSTRAINT `yorumlar_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `yorumlar_ibfk_2` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
