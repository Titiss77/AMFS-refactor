SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `b13_39213320_database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `b13_39213320_database`;

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2026-04-11 16:35:41');

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$o8fb2qzNUHt.cp.ql5twHO2gIC0olV9efaaBx7GNR71tcPW34u6n6', NULL, NULL, 0, '2026-04-11 16:36:30', '2026-04-11 16:35:40', '2026-04-11 16:36:30'),
(2, 1, 'magic-link', NULL, 'd8cf18a1d24203166da5', NULL, '2026-04-11 17:37:00', NULL, 0, NULL, '2026-04-11 16:37:00', '2026-04-11 16:37:00');

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 1, '2026-04-11 16:36:30', 1);

INSERT INTO `division` (`id`, `id_header`, `nom`) VALUES
(1, 1, 'Animés'),
(2, 1, 'Scans / Mangas'),
(3, 2, 'Animés');

INSERT INTO `header` (`id`, `nom`) VALUES
(1, 'Animés & Mangas'),
(2, 'Liens utiles');

INSERT INTO `item` (`id`, `id_user`, `id_division`, `titre`, `lien`, `description`, `episode`, `saison`) VALUES
(1, 2, 1, 'Animé : One Piece', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', NULL, '1141', 1),
(2, 2, 2, 'Manga : One Piece', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', '', '1177', 1),
(4, 2, 1, 'Hell\'s Paradise', 'https://voir-anime.to/anime/jigokuraku-{s}/jigokuraku-{s}-{ep2}-vostfr/', '', '12', 2),
(5, 2, 1, 'Jujutsu Kaisen', 'https://voir-anime.to/anime/jujutsu-kaisen-{s}/jujutsu-kaisen-{s}-{ep2}-vostfr/', '', '12', 3),
(6, 2, 1, 'Farming Life', 'https://voir-anime.to/anime/isekai-nonbiri-nouka-{s}/isekai-nonbiri-nouka-{s}-{ep2}-vostfr/', '', '1', 2),
(7, 2, 1, 'Frieren', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep1}-vostfr/', '', '3', 2),
(8, 2, 1, 'Wind Breaker', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', '', '9', 2),
(9, 2, 1, 'To Your Eternity', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', '', '9', 3),
(10, 2, 1, 'Bleach', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', '', '154', 8),
(11, 2, 2, 'Jujutsu Kaisen', 'https://www.scan-vf.net/jujutsu-kaisen/chapitre-{ep}', '', '175', 1),
(12, 1, 3, 'VoirAnime', 'https://voir-anime.to/', '', '1', 1);

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'development', 'CodeIgniter\\Shield', 1775924925, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'development', 'CodeIgniter\\Settings', 1775924926, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'development', 'CodeIgniter\\Settings', 1775924926, 1),
(4, '2026-01-01-000001', 'App\\Database\\Migrations\\CreateFirst', 'development', 'App', 1775924926, 1);

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Titiss', NULL, NULL, 1, '2026-04-11 16:36:40', '2026-04-11 16:35:40', '2026-04-11 16:35:41', NULL);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
