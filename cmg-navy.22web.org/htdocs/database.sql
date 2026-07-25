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
  `body_fat` decimal(5,2) NOT NULL,
  `fat_mass` decimal(5,2) NOT NULL,
  `lean_mass` decimal(5,2) NOT NULL,
  `bmr` int NOT NULL,
  `tdee` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `idx_created_at` (`created_at`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `metrics_history`
  ADD CONSTRAINT `metrics_history_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

TRUNCATE TABLE `users`;
INSERT INTO `users` VALUES('1', 'mathisfrances11@gmail.com', '$2y$10$AjeXQVTeEn5HCDfH1pi.T.KxCFdyx8.kGI5pPirN46XSQ5yx50CUa', '2026-07-24 07:07:07');

TRUNCATE TABLE `metrics_history`;
INSERT INTO `metrics_history` VALUES(1, '1', 'male', '170.00', '86.60', '37.00', '112.00', NULL, '1.200', '35.56', '30.80', '55.80', '1575', '1890', '2025-09-24 07:07:07');
INSERT INTO `metrics_history` VALUES(2, '1', 'male', '170.00', '80.00', '37.00', '107.00', NULL, '1.200', '32.86', '26.29', '53.71', '1530', '1836', '2025-09-30 07:07:07');
INSERT INTO `metrics_history` VALUES(3, '1', 'male', '170.00', '79.90', '37.00', '100.00', NULL, '1.550', '28.78', '23.00', '56.90', '1599', '2479', '2025-11-14 07:07:07');
INSERT INTO `metrics_history` VALUES(4, '1', 'male', '170.00', '79.30', '37.00', '97.00', NULL, '1.550', '26.92', '21.34', '57.96', '1622', '2514', '2026-01-07 07:07:07');
INSERT INTO `metrics_history` VALUES(5, '1', 'male', '170.00', '76.00', '37.00', '101.00', NULL, '1.550', '29.38', '22.33', '53.67', '1529', '2370', '2026-05-06 07:07:07');
INSERT INTO `metrics_history` VALUES(6, '1', 'male', '170.00', '75.10', '37.00', '79.00', NULL, '1.550', '13.71', '10.30', '64.80', '1770', '2743', '2026-07-24 07:07:07');

COMMIT;