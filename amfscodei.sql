SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `b13_39213320_database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `b13_39213320_database`;
DROP TABLE IF EXISTS `item`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `division`;
DROP TABLE IF EXISTS `header`;
CREATE TABLE `division` (
  `id` int UNSIGNED NOT NULL,
  `id_header` int UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `header` (
  `id` int UNSIGNED NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `item` (
  `id` int UNSIGNED NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `id_division` int UNSIGNED NOT NULL,
  `titre` varchar(100) NOT NULL,
  `lien` text,
  `description` text,
  `episode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `saison` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `author` enum('0','1','2') NOT NULL DEFAULT '1',
  `dateDeCreation` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `motDePasse` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
ALTER TABLE `division`
ADD PRIMARY KEY (`id`),
  ADD KEY `id_header` (`id_header`);
ALTER TABLE `header`
ADD PRIMARY KEY (`id`);
ALTER TABLE `item`
ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`, `id_division`),
  ADD KEY `id_division` (`id_division`);
ALTER TABLE `user`
ADD PRIMARY KEY (`id`);
ALTER TABLE `division`
MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `header`
MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `item`
MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `division`
ADD CONSTRAINT `division_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `item`
ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_division`) REFERENCES `division` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;