-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2021 at 01:23 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_push_web_notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`) VALUES
(1, 'test', 'again testing this page', 'bayyinah_tv.png'),
(2, 'No Internet', 'I am holding Cisco certifications and have good knowledge and experience with Cisco devices.', 'ecommerce.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(20) NOT NULL,
  `endpoint` text NOT NULL,
  `auth` text NOT NULL,
  `p256dh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `endpoint`, `auth`, `p256dh`) VALUES
(1, 'https://updates.push.services.mozilla.com/wpush/v2/gAAAAABgCCAv8Wj4KbRpWJsZ0Bjbj7XmY1zQBmnSmDXJ1T2GuinhE5kE_cv5cXjiVveCsJsfmoY2vfnYiYmVxS4NjeLsqNFXitf90k2aU6pa04-VysYq2KXwiN4F767nbtZalXcEcO8Zyjy4ohqi6cTAS6nR1Qnyvas2k_BIDKvtdHZbrTsyz5k', 'w+a04E6qnqSWAtabonAuMA==', 'BIu5DtagIeLN62eb4yHQ2brp5wewf07AcA2TeCtZtk95iX8iEk/VeNgHY4ti868/50wrdKccAjMxN8sT4UwIlbM='),
(2, 'https://fcm.googleapis.com/fcm/send/cBXYVNcDlSE:APA91bEv13yA-2_5_o72PjaxdCu-qa5cmJOojmnooYrflphprYpniJuLDTGbeZI93sbExJdh9ifD3BM2ChYDlwGGlD31pVh8v_jfnAUa5JFXpTgGQLy14tDPrttgas9t1DYxJYfDtexB', 'aWBaPZB0Ziaunmzd0qsmMg==', 'BOKFNGmk6aNqBABNGpiFi/vQjMpV29PcP49jVjYR9eShka57GE+j7U3k1NeLB41EvjvsFxLGl/Z7FDtosRyH3+k=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
