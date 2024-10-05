-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Okt 01. 09:28
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hirdetesek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ads`
--

CREATE TABLE `ads` (
  `id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(250) NOT NULL,
  `ownerId` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `ads`
--

INSERT INTO `ads` (`id`, `name`, `description`, `price`, `category`, `ownerId`) VALUES
('3B939CE3-D610-B215-022D-A22DFCBFCE41', 'Mérleg', 'Ez egy antik mérleg', 8000, 'antik', 'FA9C2289-D904-AF72-66B8-2E0D6694FD9E'),
('5014A983-B7C3-19A7-6457-72205CC735B9', 'Ronaldo focimez', 'C. Ronaldo által dedikált focimez', 30000, 'sport', '20709691-AC0D-F287-4875-5AFD82E92F1E'),
('8950CF89-7DBB-2D81-4075-39962A608B46', 'Söröskorsó', 'Egy szép söröskorsó', 5000, 'antik', '20709691-AC0D-F287-4875-5AFD82E92F1E');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fkey` (`ownerId`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SELECT * FROM ads;

SELECT * FROM users;

