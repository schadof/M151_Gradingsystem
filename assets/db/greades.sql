-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Okt 2017 um 21:39
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `greades`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `weight` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `module` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `occupations`
--

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL,
  `occupation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `occupation` int(11) NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
