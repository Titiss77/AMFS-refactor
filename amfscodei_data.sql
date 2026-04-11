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
(1, 1, 'user', '2026-04-11 17:01:16'),
(2, 2, 'user', '2026-04-11 17:02:38');

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-04-11 17:23:35', '2026-04-11 17:01:16', '2026-04-11 17:23:35'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-04-11 17:22:30', '2026-04-11 17:02:38', '2026-04-11 17:22:30');

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:03:15', 1),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:20:13', 1),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 17:20:25', 1),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 17:22:30', 1),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:23:35', 1);

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
(12, 1, 3, 'VoirAnime', 'https://voir-anime.to/', NULL, NULL, NULL);

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UserFictif', NULL, NULL, 1, '2026-04-11 17:03:22', '2026-04-11 17:01:15', '2026-04-11 17:01:16', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-04-11 17:02:56', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
