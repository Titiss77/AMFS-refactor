SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `sprint_metrics_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `sprint_metrics_db`;

CREATE TABLE IF NOT EXISTS `metrics_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `gender` varchar(10) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `neck` decimal(5,2) NOT NULL,
  `waist` decimal(5,2) NOT NULL,
  `hip` decimal(5,2) DEFAULT NULL,
  `activity_multiplier` decimal(4,3) NOT NULL,
  `is_athlete` tinyint(1) NOT NULL DEFAULT '0',
  `body_fat` decimal(5,2) NOT NULL,
  `fat_mass` decimal(5,2) NOT NULL,
  `lean_mass` decimal(5,2) NOT NULL,
  `bmr` int NOT NULL,
  `tdee` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `metrics_history`
  ADD CONSTRAINT `metrics_history_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

TRUNCATE TABLE `users`;
INSERT INTO `users` VALUES(1, 'mathisfrances11@gmail.com', '$2y$10$AjeXQVTeEn5HCDfH1pi.T.KxCFdyx8.kGI5pPirN46XSQ5yx50CUa', '2026-07-24 18:26:49');


TRUNCATE TABLE `metrics_history`;
INSERT INTO `metrics_history` VALUES(1, 1, 'male', '170.00', '86.60', '38.00', '112.00', NULL, '1.200', 0, '35.04', '30.34', '56.26', 1585, 1902, '2025-09-25 01:40:44');
INSERT INTO `metrics_history` VALUES(2, 1, 'male', '170.00', '80.00', '38.00', '107.00', NULL, '1.200', 0, '32.30', '25.84', '54.16', 1540, 1848, '2025-10-01 01:42:03');
INSERT INTO `metrics_history` VALUES(3, 1, 'male', '170.00', '79.90', '38.00', '100.00', NULL, '1.375', 0, '28.17', '22.51', '57.39', 1610, 2213, '2025-11-16 02:42:13');
INSERT INTO `metrics_history` VALUES(4, 1, 'male', '170.00', '79.30', '38.00', '97.00', NULL, '1.550', 0, '26.28', '20.84', '58.46', 1633, 2531, '2026-01-08 08:07:38');
INSERT INTO `metrics_history` VALUES(5, 1, 'male', '170.00', '77.80', '38.00', '92.00', NULL, '1.550', 1, '21.44', '16.68', '61.12', 1690, 2620, '2026-05-07 01:44:18');
INSERT INTO `metrics_history` VALUES(6, 1, 'male', '170.00', '75.10', '38.00', '79.00', NULL, '1.550', 1, '11.35', '8.52', '66.58', 1808, 2803, '2026-07-25 01:41:29');
INSERT INTO `metrics_history` VALUES(7, 1, 'male', '170.00', '76.40', '38.00', '80.00', NULL, '1.550', 1, '12.21', '9.33', '67.07', 1819, 2819, '2026-07-27 01:41:21');
INSERT INTO `metrics_history` VALUES(8, 1, 'male', '170.00', '75.00', '38.00', '80.00', NULL, '1.550', 1, '12.21', '9.16', '65.84', 1792, 2778, '2026-07-29 01:40:57');

COMMIT;