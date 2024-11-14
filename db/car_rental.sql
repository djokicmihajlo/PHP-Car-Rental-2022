-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 09:53 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `Brand` varchar(20) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `Price` float NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`Brand`, `Model`, `Price`, `Description`, `Image`, `ID`) VALUES
('Mercedes', 'A-Class(W-177)', 30, 'Small and compact', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.EbzjcNLEAwuWzPeC8_VIqQHaEK%26pid%3DApi&f=1', 1),
('Tesla', 'Model 3', 50, 'Eco friendly', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.autoexpress.co.uk%2Fimage%2Fprivate%2Fs--w3mCgRM3--%2Fv1565281565%2Fautoexpress%2F2019%2F08%2Fdsc_9204.jpg&f=1&nofb=1', 2),
('Audi', 'A1', 25, 'Small and compact', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fassets.newatlas.com%2Fdims4%2Fdefault%2Fd940503%2F2147483647%2Fstrip%2Ftrue%2Fcrop%2F1618x1079%2B151%2B0%2Fresize%2F1200x800!%2Fquality%2F90%2F%3Furl%3Dhttp%3A%252F%252Fnewatlas-brightspot.s3.amazonaws.com%252Farchive%252Faudi-a1-sportback-uk-14.jpg&f=1&nofb=1', 6),
('Audi', 'A7', 70, 'Sporty Sedan', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.larevueautomobile.com%2Fimages%2Ffiche-technique%2F2020%2FAudi%2FA7-Sportback%2FAudi_A7-Sportback_HD_1.jpg&f=1&nofb=1', 7),
('Lamborghini', 'Huracan', 350, 'Super fast', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fperformancedrive.com.au%2Fwp-content%2Fuploads%2F2019%2F01%2FLamborghini-Huracan-Evo-front.jpg&f=1&nofb=1', 8),
('Skoda', 'Rapid', 30, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.autoprove.it%2Fwp-content%2Fuploads%2F2019%2F12%2F2020-Skoda-Rapid-Russia-spec-1.jpg&f=1&nofb=1', 19),
('Skoda', 'Octavia RS', 35, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.motori.news%2Fwp-content%2Fuploads%2F2019%2F12%2Fmotorinews_b0ed97555448c53a70c8bd31384b336e.jpg&f=1&nofb=1', 20),
('Mini', 'Cooper', 20, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fautonxt.net%2Fwp-content%2Fuploads%2F2021%2F01%2F2022-MINI-Cooper1.jpg&f=1&nofb=1', 21),
('Volkswagen', 'Golf 8', 25, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.speedheads.de%2Fartikel%2Fvw-golf-8-dynamisch-front-seite-0097228-1200x800.jpg&f=1&nofb=1', 22),
('Volkswagen', 'Polo', 15, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmediacloud.carbuyer.co.uk%2Fimage%2Fprivate%2Fs--itQSLnkf--%2Fv1595082940%2Fcarbuyer%2F2018%2F01%2Fpolo_se_10tsi_022.jpg&f=1&nofb=1', 23),
('Opel', 'Insignia', 30, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi1.wp.com%2Fwww.photoscar.fr%2Fwp-content%2Fuploads%2F2017%2F07%2F2018-Opel-Insignia-GSi-01.jpg%3Ffit%3D2048%252C1536%26ssl%3D1&f=1&nofb=1', 24),
('BMW', 'i3', 15, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.autoexpress.co.uk%2Fimage%2Fprivate%2Fs--ie13RXlh--%2Fv1563183677%2Fautoexpress%2F2016%2F07%2F_bl71138_01.jpg&f=1&nofb=1', 25),
('Skoda', 'Kodiaq', 28, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwheels.iconmagazine.it%2Fcontent%2Fuploads%2F2020%2F06%2FSkoda-Kodiaq.jpg&f=1&nofb=1', 26),
('Tesla', 'Model S', 55, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.drivingelectric.com%2Fimage%2Fprivate%2Fs--JLOJ7uco--%2Fv1611827782%2Fautoexpress%2F2021%2F01%2FTesla%2520Model%2520S%2520Plaid%2520main.jpg&f=1&nofb=1', 27),
('Toyota', 'Supra', 60, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fphoto-voiture.motorlegend.com%2Fhd%2Ftoyota-supra-mkv-3-0-340-ch-124268.jpg&f=1&nofb=1', 28),
('Audi', 'RS6', 80, 'Lorem ipsum dolor sit', 'https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fcdn.carbuzz.com%2Fgallery-images%2F1600%2F843000%2F500%2F843500.jpg&f=1&nofb=1', 29);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `User_Email` varchar(50) NOT NULL,
  `Car_ID` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `Return_Date` date NOT NULL,
  `Order_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `User_Email`, `Car_ID`, `Start_Date`, `Return_Date`, `Order_status`) VALUES
(30, 'gladiolassquealing@defaultingorthodoxy.ne', 1, '2022-05-18', '2022-05-26', 'accepted'),
(32, 'sentimentalisms@execratingbrine.info', 21, '2022-05-18', '2022-05-25', 'declined'),
(33, 'fowledfirefighter@transmissible.org', 28, '2022-06-01', '2022-06-06', 'waiting'),
(35, 'random@cabinetmakers.com', 8, '2022-05-17', '2022-05-18', 'accepted'),
(36, 'fowledfirefighter@transmissible.org', 26, '2022-05-08', '2022-05-26', 'waiting'),
(37, 'admin@gmail.com', 20, '2022-05-26', '2022-06-11', 'waiting');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `Title`, `Content`) VALUES
(14, 'Welcome to Car rental!', 'Welcome to our car rental service! We offer a wide range of vehicles to fit your style and budget, with easy online booking and flexible rental options. Thank you for choosing us, and we look forward to serving you!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Status` varchar(5) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `Name`, `Lastname`, `Status`, `Password`) VALUES
(0, 'admin@gmail.com', 'Admin', 'Admin', '1', '$2y$10$a0V0VvjsfucCIBEPUr4KouWAAT3FDTRGk12Z0LSrbjCexcadJXm7S'),
(10, 'sentimentalisms@execratingbrine.info', 'Wilbur', 'Session', '0', '$2y$10$goXXRH8ge0fL0Fh2mimz9uW5WjD35EXOqjfFiX9I9hzdAtdfMW9oa'),
(12, 'gladiolassquealing@defaultingorthodoxy.ne', 'Tricia', 'Deandrea', '0', '$2y$10$SH6LzjdZnlHR/LLswek5Oe8tu4PN/ixLhLCui5lNby5tscuFPyk0i'),
(13, 'fowledfirefighter@transmissible.org', 'Mark', 'Walt', '0', '$2y$10$oL6clFDy4EEL04kx8bzmKOmP3TbiPNN7bal4YkOxpkjD614w.QBaW'),
(14, 'random@cabinetmakers.com', 'Caroyln', 'Colligan', '0', '$2y$10$xX6Zi3Tiu64Snv/a1Fa4OO1t73bpsH5QCcNnF8etBww4XeYu5byWi'),
(15, 'joledjole@gmail.com', 'Mihajlo', 'Djokic', '0', '$2y$10$fOO.BA.vNyGNCQIT0oTouuizkuOEwrXjPbbIw4uNvYGgwrBeDdDFe'),
(16, 'micadjokicx@gmail.com', 'Mihajlo', 'Djokic', '0', '$2y$10$6/T/P3bJb3qU8BDWuuMiYuErS4Iy9f8OJfnro5fLUr7rjCecKUUEO'),
(17, 'micadjokicxx@gmail.com', 'sssssssssssssssssssssssssssssssssssssss', 'ssssssssssssssssssssssssssssssssssssssssssssssssss', '0', '$2y$10$2et86wSiOyT04PgM0W5SF.LzI0e5ZKEKp0zjH4dfSH.2uE7xZBobi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
