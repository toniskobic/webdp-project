-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2021 at 11:36 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2020x119`
--

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `dnevnik_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `radnja` text NOT NULL,
  `upit` text,
  `datum_vrijeme` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`dnevnik_id`, `tip_id`, `korisnik_id`, `radnja`, `upit`, `datum_vrijeme`) VALUES
(1, 1, 42, 'Uspješna prijava', 'UPDATE', '0000-00-00 00:00:00'),
(2, 1, 42, 'Uspješna prijava', 'UPDATE', '2021-06-17 22:27:31'),
(3, 3, 42, 'Uspješna odjava', 'PRAZNO', '2021-06-17 22:29:53'),
(5, 1, 1, 'Uspješna prijava', 'UPDATE', '2021-06-17 23:32:26'),
(6, 3, 1, 'Uspješna odjava', 'PRAZNO', '2021-06-17 23:32:58'),
(7, 1, 49, 'Uspješna prijava', 'UPDATE', '2021-06-17 23:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_korisnik`
--

CREATE TABLE `DZ4_korisnik` (
  `id_korisnik` int(11) NOT NULL,
  `id_uloga` int(11) NOT NULL,
  `ime` varchar(45) DEFAULT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `korisnicko_ime` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `lozinka` varchar(25) NOT NULL,
  `lozinka_sha256` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_korisnik`
--

INSERT INTO `DZ4_korisnik` (`id_korisnik`, `id_uloga`, `ime`, `prezime`, `korisnicko_ime`, `email`, `lozinka`, `lozinka_sha256`) VALUES
(1, 3, NULL, NULL, 'admin', 'admin@nogomet.com', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(2, 2, 'Toni', 'Skobic', 'tskobic', 'tskobic@foi.hr', 'lozinka123', '8d43d8eb44484414d61a18659b443fbfe52399510da4689d5352bd9631c6c51b'),
(3, 2, 'Petar', 'Siljeg', 'psiljeg', 'psiljeg@foi.hr', 'sifra321', '71db441917cbc2cd38bfe60d40827c471e38bb170779e1387fe41e26b4cbcdde'),
(4, 1, 'Ante', 'Vucic', 'avucic', 'avucic@foi.hr', 'ljubuski99', '152ff492f5c077b17a76dc57ba1a13aa09febd56a547f89804c26fd4f64e73ad'),
(5, 1, 'Stipe', 'Kovacic', 'skovacic', 'skovacic@foi.hr', 'redbull22', '2e6faad5c5155e2d7a108d982dd7d6bc2814c673a31dd6128c3edd6ba085c506'),
(6, 2, NULL, NULL, 'moderator', 'moderator@nogomet.com', 'moderator', 'cfde2ca5188afb7bdd0691c7bef887baba78b709aadde8e8c535329d5751e6fe'),
(7, 1, NULL, NULL, 'korisnik', 'korisnik@nogomet.com', 'korisnik', '25862b1b6ca0ee21d472a8529a6ab06e1afa5b40a73bf3cedea4a4afdcd63ad7');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_obrazac`
--

CREATE TABLE `DZ4_obrazac` (
  `id_obrazac` int(11) NOT NULL,
  `datum` varchar(45) NOT NULL,
  `vrijeme` varchar(45) NOT NULL,
  `tim` varchar(45) NOT NULL,
  `primarna_pozicija` varchar(45) NOT NULL,
  `sekundarna_pozicija` varchar(45) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `golovi` int(11) NOT NULL,
  `dribling` int(11) NOT NULL,
  `asistencije` int(11) NOT NULL,
  `ocjena` decimal(5,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_obrazac`
--

INSERT INTO `DZ4_obrazac` (`id_obrazac`, `datum`, `vrijeme`, `tim`, `primarna_pozicija`, `sekundarna_pozicija`, `ime`, `prezime`, `golovi`, `dribling`, `asistencije`, `ocjena`) VALUES
(1, '18.05.2002.', '07:13:31', 'Barcelona', 'Napad', 'Veza', 'Lionel', 'Messi', 23, 76, 12, '9.300'),
(2, '10.03.1992.', '14:45:59', 'Barcelona', 'Napad', 'Veza', 'Antoine', 'Griezmann', 14, 54, 7, '8.900'),
(4, '13.05.1999.', '10:31:30', 'Sevilla', 'Veza', 'Napad', 'Ivan', 'Rakitić', 4, 43, 7, '8.500'),
(5, '10.05.2001.', '16:35:40', 'Atletico Madrid', 'Napad', 'Veza', 'Luis', 'Suarez', 19, 27, 4, '8.705'),
(7, '20.03.1999.', '10:30:20', 'Atletico Madrid', 'Obrana', 'Veza', 'Stefan', 'Savić', 1, 3, 1, '7.430'),
(8, '20.03.2001.', '10:03:32', 'Barcelona', 'Napad', 'Veza', 'Ansu', 'Fati', 7, 54, 3, '7.800'),
(9, '13.12.2021.', '12:12:12', 'Real Madrid', 'Napad', 'Veza', 'WebDiP2020x119', 'WebDiP2020x119', 1, 2, 2, '22.000');

-- --------------------------------------------------------

--
-- Table structure for table `DZ4_uloga`
--

CREATE TABLE `DZ4_uloga` (
  `id_uloga` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL,
  `razina_autorizacije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `DZ4_uloga`
--

INSERT INTO `DZ4_uloga` (`id_uloga`, `naziv`, `razina_autorizacije`) VALUES
(1, 'registrirani korisnik', 1),
(2, 'moderator', 2),
(3, 'administrator', 3);

-- --------------------------------------------------------

--
-- Table structure for table `grupa`
--

CREATE TABLE `grupa` (
  `grupa_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `godina` int(11) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupa`
--

INSERT INTO `grupa` (`grupa_id`, `naziv`, `godina`, `opis`) VALUES
(1, 'Predškolci', 6, 'Grupa za predškolce, za djecu do 6 godina'),
(2, 'Vrtić', 4, 'Grupa za djecu koja idu u vrtić, za djecu do 4 godine'),
(3, 'Tinejdžeri', 15, 'Grupa za tinejdžere od 11 do 15 godina¸¸'),
(4, 'Mladi punoljetni', 20, 'Grupa za mlade');

-- --------------------------------------------------------

--
-- Table structure for table `grupa_moderator`
--

CREATE TABLE `grupa_moderator` (
  `grupa_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grupa_moderator`
--

INSERT INTO `grupa_moderator` (`grupa_id`, `korisnik_id`) VALUES
(1, 42),
(2, 49),
(4, 49),
(3, 51);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `uloga_id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(25) NOT NULL,
  `lozinka` varchar(25) NOT NULL,
  `lozinka_sha256` char(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `aktivan` tinyint(1) NOT NULL,
  `broj_neuspjesnih_prijava` int(11) NOT NULL,
  `datum_registracije` datetime NOT NULL,
  `salt` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `uloga_id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `lozinka_sha256`, `email`, `aktivan`, `broj_neuspjesnih_prijava`, `datum_registracije`, `salt`) VALUES
(1, 1, 'Petar', 'Šiljeg', 'piljeg', 'test123', '8dfcb76c289d835327b9d5880e5245edbc4aac9ae2b70c97c4a17ea6ceb55fed', 'psiljeg@foi.hr', 1, 0, '2021-06-11 00:00:00', 'ae1969f9a6ecd5e7f0e0557b6d8e4d2cf202204c'),
(4, 3, 'Toni', 'Škobić', 'tskobic', 'test123', '5359033bf9aa83b5bc49bb788c6e2b8e26898116a58b5c78e8f44d741ab8cda6', 'tskobic@foi.hr', 1, 0, '2021-06-12 19:30:04', 'c43eab5a109cc090d88664afacce87d403fdbbae'),
(5, 1, 'Stipe', 'Kovačić', 'sljunac', 'test123', '7fab82e149a4ebdcf9b389cb34541408ed3a0c98ae7290e404cb3124a4fc5306', 'skovacic@foi.hr', 1, 0, '2021-06-16 18:14:41', '18814e251ad92d3bd28826e362edd86c8aa780cf'),
(40, 1, 'Ante', 'Vučić', 'avucic', 'Test1234', '873659c43340a9a9905a3a6bc94406a771d10f9967a9a4351fb6d5e1941bd89f', 'avucic@foi.hr', 0, 0, '2021-06-16 20:23:35', 'd154ddf963251632b5efb724ef84f7896a49853c'),
(42, 2, 'Janko', 'Janković', 'janko22', 'FD9T0d51', 'e19aebe6f6a941a63a07e28c044a18d5f8ee29537e56c79d398c27df00324260', 'toni.skobic@hotmail.com', 1, 0, '2021-06-16 21:47:37', 'd993d1f2d18fad5f84d717dd7b8a1b0c6e17b9d4'),
(49, 2, 'Ante', 'Antić', 'antisa23', 'Test1234', '3edfa4dd2d81657da10fd5c4027d9aa29e1ee525ae14bf145f786bd56a0a6119', 'ante.antic@gmail.com', 1, 0, '2021-06-17 10:35:43', 'ef8e6cb74e52490f4566c692a7fbc238480381f4'),
(50, 3, 'Admin', 'Admin', 'admin', 'Admin123', '17a1833f8d4eed7bc917338ffffeceeb31d3b5d16d8fdb305209c3d9bebd65f5', 'tskobic@foi.hr', 1, 1, '2021-06-17 10:36:28', 'fc486fa21638a0b0db8b200f815daba1e6b013d8'),
(51, 2, 'Moderator', 'Moderator', 'moderator', 'Moderator1', '46a29b902788a2783723d5a0a2c120c0a15dfe2fb6e0652e48aca71920400753', 'tskobic@foi.hr', 1, 0, '2021-06-17 10:36:53', '4bd402d752ecdbf51ae8525e85bfd5f7b17e30a7'),
(52, 1, 'Korisnik', 'Korisnik', 'korisnik', 'Test1234', '8e5f7c3a5dbaa7c8f6579fd799827e2439f4f8154c8faaf9c39dd79968d97b5e', 'tskobic@foi.hr', 1, 0, '2021-06-17 10:37:14', '09ae125ce9704671fe27ab8097eff588ffca6fea'),
(56, 1, 'Stipe', 'Kovačić', 'sljunac3', 'Monster123', '5156efb94a14c685f742ce661a5acb2803258828552a7e7f566a58c1ad5861c5', 'toni.skobic@hotmail.com', 1, 0, '2021-06-17 21:40:13', 'f71fa11e7edd45d8e70d7b955cf4f4ed04ddcff9');

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE `materijal` (
  `materijal_id` int(11) NOT NULL,
  `tip_id` int(11) NOT NULL,
  `rodjendan_id` int(11) NOT NULL,
  `opis` text NOT NULL,
  `suglasnost` tinyint(1) NOT NULL,
  `putanja` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rodjendan`
--

CREATE TABLE `rodjendan` (
  `rodjendan_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `grupa_id` int(11) NOT NULL,
  `broj_djece` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `naziv` varchar(45) DEFAULT NULL,
  `opis` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rodjendan`
--

INSERT INTO `rodjendan` (`rodjendan_id`, `korisnik_id`, `status_id`, `grupa_id`, `broj_djece`, `datum`, `vrijeme`, `naziv`, `opis`) VALUES
(1, 52, 2, 1, 44, '2021-06-17', '01:16:00', 'Zadnji test', 'Zadnji test'),
(2, 52, 2, 1, 13, '2021-06-18', '18:43:16', 'Rođendan 2', 'rođendan 2'),
(9, 1, 2, 2, 1321, '2021-06-25', '23:26:00', 'njuki', 'njuki'),
(10, 1, 1, 3, 323, '2021-06-11', '18:24:00', NULL, NULL),
(13, 1, 1, 2, 32, '2021-06-24', '16:28:24', 'Rođendan', 'Rođendan'),
(14, 52, 3, 1, 2312, '2021-06-04', '22:20:00', NULL, NULL),
(15, 52, 1, 3, 5, '2021-06-17', '23:41:00', NULL, NULL),
(16, 1, 1, 4, 323, '2021-06-17', '02:35:00', NULL, NULL),
(17, 1, 2, 2, 5, '2021-06-15', '02:32:00', 'Fešta', 'slavlje veliko'),
(18, 1, 1, 2, 5, '2021-06-15', '02:32:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `naziv`) VALUES
(1, 'u tijeku'),
(2, 'prihvaćen'),
(3, 'odbijen');

-- --------------------------------------------------------

--
-- Table structure for table `tip_dnevnika`
--

CREATE TABLE `tip_dnevnika` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_dnevnika`
--

INSERT INTO `tip_dnevnika` (`tip_id`, `naziv`) VALUES
(1, 'prijava'),
(2, 'registracija'),
(3, 'odjava');

-- --------------------------------------------------------

--
-- Table structure for table `tip_materijala`
--

CREATE TABLE `tip_materijala` (
  `tip_id` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tip_materijala`
--

INSERT INTO `tip_materijala` (`tip_id`, `naziv`) VALUES
(1, 'audio'),
(2, 'video'),
(3, 'fotografija');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `uloga_id` int(11) NOT NULL,
  `naziv` varchar(25) NOT NULL,
  `razina_autorizacije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`uloga_id`, `naziv`, `razina_autorizacije`) VALUES
(1, 'user', 1),
(2, 'moderator', 2),
(3, 'admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `uzvanik`
--

CREATE TABLE `uzvanik` (
  `korisnik_id` int(11) NOT NULL,
  `rodjendan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`dnevnik_id`,`tip_id`,`korisnik_id`),
  ADD KEY `fk_dnevnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_dnevnik_tip1_idx` (`tip_id`);

--
-- Indexes for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD KEY `fk_DZ4_korisnik_DZ4_uloga_idx` (`id_uloga`);

--
-- Indexes for table `DZ4_obrazac`
--
ALTER TABLE `DZ4_obrazac`
  ADD PRIMARY KEY (`id_obrazac`);

--
-- Indexes for table `DZ4_uloga`
--
ALTER TABLE `DZ4_uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- Indexes for table `grupa`
--
ALTER TABLE `grupa`
  ADD PRIMARY KEY (`grupa_id`);

--
-- Indexes for table `grupa_moderator`
--
ALTER TABLE `grupa_moderator`
  ADD PRIMARY KEY (`grupa_id`,`korisnik_id`),
  ADD KEY `fk_grupa_has_korisnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_grupa_has_korisnik_grupa1_idx` (`grupa_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_id`);

--
-- Indexes for table `materijal`
--
ALTER TABLE `materijal`
  ADD PRIMARY KEY (`materijal_id`),
  ADD KEY `fk_materijali_tip_materijala1_idx` (`tip_id`),
  ADD KEY `fk_materijal_rodjendan1_idx` (`rodjendan_id`);

--
-- Indexes for table `rodjendan`
--
ALTER TABLE `rodjendan`
  ADD PRIMARY KEY (`rodjendan_id`),
  ADD KEY `fk_rezervacija_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_rodjendan_status1_idx` (`status_id`),
  ADD KEY `fk_rodjendan_grupa1_idx` (`grupa_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tip_dnevnika`
--
ALTER TABLE `tip_dnevnika`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `tip_materijala`
--
ALTER TABLE `tip_materijala`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`uloga_id`);

--
-- Indexes for table `uzvanik`
--
ALTER TABLE `uzvanik`
  ADD PRIMARY KEY (`korisnik_id`,`rodjendan_id`),
  ADD KEY `fk_rodjendan_has_korisnik_korisnik1_idx` (`korisnik_id`),
  ADD KEY `fk_rodjendan_has_korisnik_rodjendan1_idx` (`rodjendan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `dnevnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `DZ4_obrazac`
--
ALTER TABLE `DZ4_obrazac`
  MODIFY `id_obrazac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `DZ4_uloga`
--
ALTER TABLE `DZ4_uloga`
  MODIFY `id_uloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grupa`
--
ALTER TABLE `grupa`
  MODIFY `grupa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `materijal`
--
ALTER TABLE `materijal`
  MODIFY `materijal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rodjendan`
--
ALTER TABLE `rodjendan`
  MODIFY `rodjendan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tip_dnevnika`
--
ALTER TABLE `tip_dnevnika`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tip_materijala`
--
ALTER TABLE `tip_materijala`
  MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `uloga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`korisnik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dnevnik_tip1` FOREIGN KEY (`tip_id`) REFERENCES `tip_dnevnika` (`tip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `DZ4_korisnik`
--
ALTER TABLE `DZ4_korisnik`
  ADD CONSTRAINT `fk_DZ4_korisnik_DZ4_uloga` FOREIGN KEY (`id_uloga`) REFERENCES `DZ4_uloga` (`id_uloga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
