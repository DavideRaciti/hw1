
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database hw1_db;
use hw1_db;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `circuit`
--

CREATE TABLE `circuits` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lenght` varchar(255) NOT NULL,
  `type` varchar(16) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `user` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `circuit`
--
INSERT INTO circuits (id, name, type, lenght, picture, user) VALUES
('1', 'Nürburgring', 'automobilistici', '28,250 km', 'Nurburgring.jpg', 'Auto Showroom'),
('2', 'Circuito 24h Le Mans', 'automobilistici', '13,626 km', 'LeMans.jpg', 'Auto Showroom'),
('3', 'Circuito di Monte Carlo', 'formula1', '3,337 km', 'Montecarlo.jpg', 'Auto Showroom'),
('4', 'Autodromo di Imola', 'automobilistici', '4,909 km', 'Imola.jpg', 'Auto Showroom'),
('5', 'Circuit de Spa-Francorchamps', 'formula1', '7,004 km', 'spafrancorchamps.jpg', 'Auto Showroom'),
('6', 'Circuito di Silverstone', 'formula1', '5,891 km', 'silverstone.png', 'Auto Showroom'),
('7', 'Bahrain International Circuit', 'formula1', '5,412 km', 'bahrain.png', 'Auto Showroom'),
('8', 'Circuito di Baku', 'formula1', '6,003 km', 'baku.png', 'Auto Showroom'),
('9', 'Circuito di  Barcelona-Catalunya', 'formula1', '4,655 km', 'barcelona.avif', 'Auto Showroom'),
('10', 'Circuito Internazionale di Suzuka', 'formula1', '5,807 km', 'suzuka.avif', 'Auto Showroom'),
('11', 'Circuito delle Americhe', 'formula1', '5,513 km', 'americhe.avif', 'Auto Showroom'),
('12', 'Red Bull Ring', 'formula1', '4,318 km', 'redbull.avif', 'Auto Showroom'),
('13', 'Mount Panorama Bathurst', 'automobilistici', '6,213 km', 'panorama.jpeg', 'Auto Showroom'),
('14', 'Autodromo del Mugello', 'automobilistici', '5,245 km', 'mugello.avif', 'Auto Showroom'),
('15', 'Autodromo Vallelunga', 'automobilistici', '4,085 km', 'vallelunga.jpeg', 'Auto Showroom'),
('16', 'Autodromo di Monza', 'automobilistici', '5.793 km', 'monza.png', 'Auto Showroom'),
('17', 'Circuito Tazio Nuvolari', 'automobilistici', '2,805 km', 'nuvolari.jpeg', 'Auto Showroom'),
('18', 'Circuito di Watkins Glen', 'automobilistici', '5,552 km', 'watkins.png', 'Auto Showroom');
-- --------------------------------------------------------

--
-- Struttura della tabella `stars`
--

CREATE TABLE `stars` (
  `user` int(11) NOT NULL,
  `circuit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `stars`
--
INSERT INTO `stars` (`user`, `circuit`) VALUES
(3, 1),
(3, 2),
(4, 2);


-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `phone` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `phone`) VALUES
(3, 'ciao', '$2y$10$BLDdbQGeDK5Gr/tEBOPlK.NQamQ..iaeD8cm6SXbaqqh05fcYiICK', 'ciao@gmail.com', 'prova', 'test', ''),
(4, 'test_prova', '$2y$10$aV0eUXyqOvoxWlK1nzxRr.6ZeJtIrUPBun2GT9bdUynDfSC.xll8a', 'prova@gmail.com', 'test', 'prova', '');
--
-- Indici per le tabelle 
--

--
-- Indici per le tabelle `circuit`
--
ALTER TABLE `circuits`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`user`,`circuit`),
  ADD KEY `idx_user` (`user`),
  ADD KEY `idx_circuit` (`circuit`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `circuits`
--
ALTER TABLE `circuits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle 
--

--
-- Limiti per la tabella `stars`
--
ALTER TABLE `stars`
  ADD CONSTRAINT `stars_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stars_ibfk_2` FOREIGN KEY (`circuit`) REFERENCES `circuits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;