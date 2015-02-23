-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 23 Φεβ 2015 στις 14:06:18
-- Έκδοση διακομιστή: 5.6.21
-- Έκδοση PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση δεδομένων: `cur_calc`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
`id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `shortname` varchar(45) DEFAULT NULL,
  `c_symbol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Άδειασμα δεδομένων του πίνακα `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `value`, `shortname`, `c_symbol`) VALUES
(1, 'United States Dollar', 1, 'USD', '$'),
(2, 'Euro', 1.13804, 'EUR', '€'),
(3, 'British Pound', 1.53876, 'GBP', '£'),
(4, 'Swiss Franc', 1.06292, 'CHF', 'CHF'),
(5, 'Japanese Yen', 0.00839661, 'JPY', '¥'),
(6, 'Canadian Dollar', 0.792631, 'CAD', ''),
(25, 'Test Currency', 0, 'TST', 'TST');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `currencies`
--
ALTER TABLE `currencies`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `currencies`
--
ALTER TABLE `currencies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
