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

TRUNCATE TABLE `metrics_history`;
INSERT INTO `metrics_history` VALUES(1, 1, 'male', 170.00, 86.60, 38.00, 112.00, NULL, 1.200, 0, 35.04, 30.34, 56.26, 1585, 1902, '2025-09-24 22:36:48');
INSERT INTO `metrics_history` VALUES(2, 1, 'male', 170.00, 80.00, 38.00, 107.00, NULL, 1.550, 0, 32.30, 25.84, 54.16, 1540, 2387, '2025-09-30 22:05:49');
INSERT INTO `metrics_history` VALUES(3, 1, 'male', 170.00, 79.90, 38.00, 100.00, NULL, 1.550, 0, 28.17, 22.51, 57.39, 1610, 2495, '2025-11-15 00:06:45');
INSERT INTO `metrics_history` VALUES(4, 1, 'male', 170.00, 79.30, 38.00, 97.00, NULL, 1.550, 0, 26.28, 20.84, 58.46, 1633, 2531, '2026-01-08 00:07:38');
INSERT INTO `metrics_history` VALUES(5, 1, 'male', 170.00, 76.00, 38.00, 101.00, NULL, 1.550, 0, 28.78, 21.87, 54.13, 1539, 2386, '2026-05-06 22:09:16');
INSERT INTO `metrics_history` VALUES(6, 1, 'male', 170.00, 75.10, 38.00, 79.00, NULL, 1.550, 0, 12.85, 9.65, 65.45, 1784, 2765, '2026-07-24 22:10:15');
INSERT INTO `metrics_history` VALUES(7, 1, 'male', 170.00, 76.40, 38.00, 80.00, NULL, 1.550, 0, 13.71, 10.48, 65.92, 1794, 2781, '2026-07-26 22:11:01');
INSERT INTO `metrics_history` VALUES(8, 1, 'male', 170.00, 75.00, 38.00, 80.00, NULL, 1.550, 0, 13.71, 10.28, 64.72, 1768, 2740, '2026-07-28 11:02:01');

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE TABLE `users`;
INSERT INTO `users` VALUES(1, 'mathisfrances11@gmail.com', '$2y$10$AjeXQVTeEn5HCDfH1pi.T.KxCFdyx8.kGI5pPirN46XSQ5yx50CUa', '2026-07-24 11:26:49');


ALTER TABLE `metrics_history`
  ADD CONSTRAINT `metrics_history_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;