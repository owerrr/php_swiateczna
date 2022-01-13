-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Sty 2022, 16:31
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `3tipsp_prezenty`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gifts`
--

CREATE TABLE `gifts` (
  `Id` int(11) NOT NULL,
  `Giver_Id` int(11) NOT NULL,
  `Receiver_Id` int(11) NOT NULL,
  `Label` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `gifts`
--

INSERT INTO `gifts` (`Id`, `Giver_Id`, `Receiver_Id`, `Label`, `Price`, `Description`) VALUES
(1, 1, 2, 'prezent', '19.99', 'opis'),
(2, 2, 1, 'prezent2', '27.99', 'opis2'),
(3, 2, 3, 'prezent3', '18.99', 'opis3'),
(4, 3, 2, 'prezent4', '20.00', 'opis4'),
(5, 3, 4, 'prezent5', '75.00', 'opis5'),
(6, 4, 1, 'prezent6', '9.99', 'opis6'),
(7, 1, 1, 'test', '11.11', 'test'),
(8, 2, 1, 'test11', '21.37', 'test11');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `giftsview`
-- (Zobacz poniżej rzeczywisty widok)
--
CREATE TABLE `giftsview` (
`Id` int(11)
,`nadawca` varchar(201)
,`odbiorca` varchar(201)
,`Label` varchar(100)
,`Price` decimal(10,2)
,`Description` longtext
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `persons`
--

CREATE TABLE `persons` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(100) DEFAULT NULL,
  `DateOfBirth` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `persons`
--

INSERT INTO `persons` (`Id`, `FirstName`, `LastName`, `PostalCode`, `DateOfBirth`) VALUES
(1, 'Andrzej', 'Mike', '12-345', '20.04.1995'),
(2, 'Michał', 'Szpak', '21-354', '01.12.1997'),
(3, 'Tadeusz', 'Nowak', '32-405', '05.08.1984'),
(4, 'Kacper', 'Koziol', '23-020', '12.01.1999');

-- --------------------------------------------------------

--
-- Struktura widoku `giftsview`
--
DROP TABLE IF EXISTS `giftsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `giftsview`  AS  select `gifts`.`Id` AS `Id`,concat(`p1`.`FirstName`,' ',`p1`.`LastName`) AS `nadawca`,concat(`p2`.`FirstName`,' ',`p2`.`LastName`) AS `odbiorca`,`gifts`.`Label` AS `Label`,`gifts`.`Price` AS `Price`,`gifts`.`Description` AS `Description` from ((`gifts` join `persons` `p1` on(`gifts`.`Giver_Id` = `p1`.`Id`)) join `persons` `p2` on(`gifts`.`Receiver_Id` = `p2`.`Id`)) ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Giver_Id` (`Giver_Id`),
  ADD KEY `Receiver_Id` (`Receiver_Id`);

--
-- Indeksy dla tabeli `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `gifts`
--
ALTER TABLE `gifts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `persons`
--
ALTER TABLE `persons`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `gifts`
--
ALTER TABLE `gifts`
  ADD CONSTRAINT `gifts_ibfk_1` FOREIGN KEY (`Giver_Id`) REFERENCES `persons` (`Id`),
  ADD CONSTRAINT `gifts_ibfk_2` FOREIGN KEY (`Receiver_Id`) REFERENCES `persons` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
