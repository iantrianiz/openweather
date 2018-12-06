-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 06, 2018 at 02:01 AM
-- Server version: 5.6.36-82.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thejavaa_maps`
--

-- --------------------------------------------------------

--
-- Table structure for table `tmaps`
--

CREATE TABLE `tmaps` (
  `id` int(11) NOT NULL,
  `location` varchar(60) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmaps`
--

INSERT INTO `tmaps` (`id`, `location`, `lat`, `lng`) VALUES
(1, 'Sydney', -33.869999, 151.210007),
(2, 'Melbourne', -37.810001, 144.960007),
(3, 'Brisbane', -27.459999, 153.020004),
(4, 'Perth', -31.959999, 115.839996),
(5, 'Adelaide', -34.930000, 138.600006),
(6, 'Newcastle', -32.919998, 151.750000),
(7, 'Gold coast', -28.070000, 153.440002),
(8, 'Canberra', -35.310001, 149.130005),
(9, 'Wollongong', -34.419998, 150.869995),
(10, 'Sunshine coast', -25.879999, 152.559998),
(11, 'Hobart', -42.849998, 147.289993),
(12, 'Geelong', -38.139999, 144.320007),
(13, 'Townsville', -19.260000, 146.779999),
(14, 'Cairns', -16.920000, 145.750000),
(15, 'Launceston', -41.450001, 147.130005),
(16, 'Albury', -36.060001, 146.919998),
(17, 'Darwin', -12.430000, 130.850006),
(18, 'Toowoomba', -27.559999, 151.960007),
(19, 'Ballarat', -37.560001, 143.839996),
(20, 'Caboolture', -27.090000, 152.949997),
(21, 'Bendigo', -36.759998, 144.279999),
(22, 'Burnie', -41.060001, 145.889999),
(23, 'Bathurst', -33.419998, 149.570007),
(24, 'Mackay', -21.139999, 149.179993),
(25, 'Hastings', -38.310001, 145.190002),
(26, 'Rockhampton', -23.370001, 150.509995),
(27, 'Coffs', -30.299999, 153.119995),
(28, 'Bundaberg', -24.870001, 152.350006),
(29, 'Broken Hill', -31.950001, 141.440002),
(30, 'Mildura', -34.189999, 142.160004),
(31, 'Shepparton', -36.369999, 145.399994),
(32, 'Maroochydore', -26.680000, 153.119995),
(33, 'Taree', -31.900000, 152.470001),
(34, 'Lismore', -28.809999, 153.289993),
(35, 'Gladstone', -23.850000, 151.250000),
(36, 'Mandurah', -32.529999, 115.750000),
(37, 'Hervey Bay', -25.290001, 152.839996),
(38, 'Dubbo', -32.250000, 148.600006),
(39, 'Tamworth', -31.100000, 150.919998),
(40, 'Port Macquarie', -31.440001, 152.910004),
(41, 'Kalgoorlie', -30.740000, 121.459999),
(42, 'Caloundra', -26.809999, 153.130005),
(43, 'Melton', -37.689999, 144.570007),
(44, 'Tewantin', -26.389999, 153.029999),
(45, 'Warrnambool', -38.380001, 142.470001),
(46, 'Geraldton', -28.770000, 114.589996),
(47, 'Bunbury', -33.349998, 115.650002),
(48, 'Cranbourne', -38.110001, 145.270004),
(49, 'Mount isa', -20.730000, 139.479996),
(50, 'Maryborough', -25.540001, 152.720001),
(51, 'Alice springs', -23.700001, 133.869995),
(52, 'Palmerston', -12.400000, 130.899994),
(53, 'Sunbury', -37.570000, 144.710007),
(54, 'Whyalla', -33.029999, 137.570007),
(55, 'Queanbeyan', -35.349998, 149.220001),
(56, 'Albany', -35.020000, 117.879997),
(57, 'Mount', -37.840000, 140.770004),
(58, 'Richmond', -33.599998, 150.740005),
(59, 'Armidale', -30.510000, 151.660004),
(60, 'Goulburn', -34.750000, 149.710007);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tmaps`
--
ALTER TABLE `tmaps`
  ADD KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
