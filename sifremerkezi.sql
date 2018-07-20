-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Tem 2018, 10:37:17
-- Sunucu sürümü: 10.1.33-MariaDB
-- PHP Sürümü: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sifremerkezi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alt_uyeler`
--

CREATE TABLE `alt_uyeler` (
  `id` int(11) NOT NULL,
  `kategori_fk` int(11) NOT NULL,
  `kullanici_adi` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(254) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `e_mail` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `aktif_baslangic` datetime NOT NULL,
  `aktif_bitis` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `alt_uyeler`
--

INSERT INTO `alt_uyeler` (`id`, `kategori_fk`, `kullanici_adi`, `sifre`, `e_mail`, `aktif`, `aktif_baslangic`, `aktif_bitis`) VALUES
(47, 92, 'yunus', 'yunus', 'j.orenc@hotmail.com', 1, '2018-07-19 15:27:00', '2018-07-19 15:27:00'),
(48, 93, 'yunus', 'qwewqe', 'j.orenc@hotmail.com', 1, '2018-07-19 15:28:00', '2018-07-19 15:28:00'),
(49, 93, 'ahmet', 'asdsad', 'j.orenc@hotmail.com', 1, '2018-07-19 15:31:00', '2018-07-19 15:31:00'),
(50, 93, 'ahmet', 'asdasd', 'j.orenc@hotmail.com', 1, '2018-07-19 15:31:00', '2018-07-19 15:31:00'),
(51, 92, 'yunus', 'asdsad', 'j.orenc@hotmail.com', 1, '2018-07-19 13:45:00', '2018-07-19 13:45:00'),
(52, 92, 'ahmet', 'asdsad', 'j.orenc@hotmail.com', 1, '2018-07-19 13:45:00', '2018-07-19 13:45:00'),
(53, 92, 'kurumsa', 'asdsad', 'j.orenc@hotmail.com', 1, '2018-07-19 13:45:00', '2018-07-19 13:45:00'),
(54, 104, 'ahmet', 'asddddd', 'j.orenc@hotmail.com', 1, '2018-07-19 13:45:00', '2018-07-19 13:45:00'),
(55, 102, 'ahmet', 'asdsad', 'j.orenc@hotmail.com', 1, '2018-07-19 13:45:00', '2018-07-19 13:45:00'),
(56, 92, 'ahmet', 'orenc', 'j.orenc@hotmail.com', 1, '2018-07-19 15:37:00', '2018-07-19 15:37:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `entegrasyon`
--

CREATE TABLE `entegrasyon` (
  `id` int(11) NOT NULL,
  `entegrasyon_adi` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `entegrasyon`
--

INSERT INTO `entegrasyon` (`id`, `entegrasyon_adi`) VALUES
(1, 'soap'),
(2, 'restful'),
(3, 'XML-RPC '),
(4, 'JSON-RPC');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `izinli_ipler`
--

CREATE TABLE `izinli_ipler` (
  `id` int(11) NOT NULL,
  `kategori_fk` int(11) NOT NULL,
  `ip` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `uyeler_fk` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `kategori_adi` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adi` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(254) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`id`, `uyeler_fk`, `aktif`, `kategori_adi`, `kullanici_adi`, `sifre`) VALUES
(92, 249, 0, 'Ankara', 'Oteller', '7d8b28f8a11d5c4668964d43703fe524'),
(93, 249, 1, 'Siirt', 'Oteller', '7d8b28f8a11d5c4668964d43703fe524'),
(101, 250, 1, 'kocaeli', 'mabil', 'c28c4a6443f1a94c8131b44572ba8a14'),
(102, 249, 0, 'kocaeli', 'sirket', 'c28c4a6443f1a94c8131b44572ba8a14'),
(103, 249, 0, 'kocaeli otel', 'ankara', 'c28c4a6443f1a94c8131b44572ba8a14'),
(104, 249, 1, 'Ä°ncirlik', 'KÄ±z yurdu', '59c9c04e154bbae5018780c0d2542c87'),
(105, 249, 1, 'orenc', 'yunus', '7090655f7a3527dbe7fd6a43f86e8315');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori_entegrasyon`
--

CREATE TABLE `kategori_entegrasyon` (
  `id` int(11) NOT NULL,
  `kategori_fk` int(11) NOT NULL,
  `entg_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kategori_entegrasyon`
--

INSERT INTO `kategori_entegrasyon` (`id`, `kategori_fk`, `entg_fk`) VALUES
(24, 92, 1),
(25, 92, 3),
(26, 93, 1),
(27, 93, 3),
(28, 94, 1),
(29, 94, 3),
(30, 95, 1),
(31, 95, 3),
(38, 101, 1),
(39, 101, 3),
(40, 101, 4),
(41, 102, 1),
(42, 102, 2),
(43, 102, 3),
(44, 102, 4),
(45, 103, 1),
(46, 104, 1),
(47, 105, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `firma_adi` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adi` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `e_mail` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `firma_adi`, `kullanici_adi`, `sifre`, `e_mail`) VALUES
(249, 'portakal', 'deneme2', 'c28c4a6443f1a94c8131b44572ba8a14', 'j.orenc.b.m@gmail.com'),
(250, 'portakal', 'persinnow', 'c28c4a6443f1a94c8131b44572ba8a14', 'j.orenc.b.m@gmail.com');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `alt_uyeler`
--
ALTER TABLE `alt_uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `entegrasyon`
--
ALTER TABLE `entegrasyon`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `izinli_ipler`
--
ALTER TABLE `izinli_ipler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategori_entegrasyon`
--
ALTER TABLE `kategori_entegrasyon`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `alt_uyeler`
--
ALTER TABLE `alt_uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Tablo için AUTO_INCREMENT değeri `entegrasyon`
--
ALTER TABLE `entegrasyon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `izinli_ipler`
--
ALTER TABLE `izinli_ipler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Tablo için AUTO_INCREMENT değeri `kategori_entegrasyon`
--
ALTER TABLE `kategori_entegrasyon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
