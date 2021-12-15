-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Ara 2021, 14:42:11
-- Sunucu sürümü: 10.4.20-MariaDB
-- PHP Sürümü: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `spechy`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `company_id` int(55) NOT NULL,
  `customer_id` int(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(55) NOT NULL,
  `tax_no` varchar(55) NOT NULL,
  `tax_circle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`company_id`, `customer_id`, `name`, `email`, `phone`, `tax_no`, `tax_circle`) VALUES
(2, 15, 'testfirma', 'blafirma@gmail.com', '0212222222', 'dc57dd06bcfb8ed4379e516f297bea55', 'blabla vergi dairesi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `lastname`, `email`, `password`, `phone`) VALUES
(15, 'Barış', 'Yılmaz', 'brylhhmaz52@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '5412915677');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer_package`
--

CREATE TABLE `customer_package` (
  `id` int(55) NOT NULL,
  `customer_id` int(55) NOT NULL,
  `package_id` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `customer_package`
--

INSERT INTO `customer_package` (`id`, `customer_id`, `package_id`) VALUES
(3, 15, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(55) NOT NULL,
  `customer_id` int(55) NOT NULL,
  `payment_id` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `customer_payment`
--

INSERT INTO `customer_payment` (`id`, `customer_id`, `payment_id`) VALUES
(1, 15, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `package`
--

CREATE TABLE `package` (
  `package_id` int(55) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `package`
--

INSERT INTO `package` (`package_id`, `name`) VALUES
(1, 'paket 1'),
(2, 'paket 2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(55) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `payment`
--

INSERT INTO `payment` (`payment_id`, `name`) VALUES
(1, 'kredi kartı'),
(2, 'banka kartı');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Tablo için indeksler `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Tablo için indeksler `customer_package`
--
ALTER TABLE `customer_package`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Tablo için indeksler `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `customer_package`
--
ALTER TABLE `customer_package`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `customer_payment`
--
ALTER TABLE `customer_payment`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
