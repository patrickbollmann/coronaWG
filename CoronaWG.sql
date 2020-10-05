-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 05. Okt 2020 um 13:31
-- Server-Version: 5.7.31-0ubuntu0.18.04.1
-- PHP-Version: 7.3.22-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `CoronaWG`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Event`
--

CREATE TABLE `Event` (
  `ID` int(11) NOT NULL,
  `Datum` datetime NOT NULL,
  `Titel` varchar(100) NOT NULL,
  `Beschreibung` varchar(500) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User`
--

CREATE TABLE `User` (
  `ID` int(11) NOT NULL,
  `Vorname` varchar(50) NOT NULL,
  `Nachname` varchar(50) NOT NULL,
  `Straße` varchar(100) NOT NULL,
  `Hausnummer` varchar(50) NOT NULL,
  `Postleitzahl` varchar(50) NOT NULL,
  `Ort` varchar(80) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefon` varchar(50) NOT NULL,
  `Event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Event`
--
ALTER TABLE `Event`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `User`
--
ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
