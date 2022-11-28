-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: sql307.epizy.com
-- Létrehozás ideje: 2022. Nov 28. 04:54
-- Kiszolgáló verziója: 10.3.27-MariaDB
-- PHP verzió: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `epiz_33090923_adatok`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tabla`
--

CREATE TABLE `tabla` (
  `Sor` int(1) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Titkos` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `tabla`
--

INSERT INTO `tabla` (`Sor`, `Username`, `Titkos`) VALUES
(1, 'katika@gmail.com', 'piros'),
(6, 'nagysanyi@gmail.hu', 'feher'),
(2, 'arpi40@freemail.hu', 'zold'),
(3, 'zsanettka@hotmail.com', 'sarga'),
(4, 'hatizsak@protonmail.com', 'kek'),
(5, 'terpeszterez@citromail.hu', 'fekete');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `tabla`
--
ALTER TABLE `tabla`
  ADD PRIMARY KEY (`Sor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
