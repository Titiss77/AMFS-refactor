SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

TRUNCATE TABLE `auth_groups_users`;
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2026-04-11 17:01:16'),
(2, 2, 'user', '2026-04-11 17:02:38');

TRUNCATE TABLE `auth_identities`;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-04-14 20:17:57', '2026-04-11 17:01:16', '2026-04-14 20:17:57'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-04-14 19:53:10', '2026-04-11 17:02:38', '2026-04-14 19:53:10');

TRUNCATE TABLE `auth_logins`;
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:03:15', 1),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:20:13', 1),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 17:20:25', 1),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 17:22:30', 1),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:23:35', 1),
(6, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 17:58:11', 1),
(7, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 17:58:35', 1),
(8, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 17:58:46', 1),
(9, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 18:17:21', 1),
(10, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 18:29:43', 1),
(11, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'titissland@gmail.com', NULL, '2026-04-11 18:30:02', 0),
(12, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'titissland@gmail.com', NULL, '2026-04-11 18:30:15', 0),
(13, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 18:30:27', 1),
(14, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 19:08:52', 1),
(15, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 19:21:04', 1),
(16, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 19:49:36', 1),
(17, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-11 21:57:30', 1),
(18, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-11 21:57:55', 1),
(19, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 08:39:27', 1),
(20, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 08:39:59', 1),
(21, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 09:31:23', 1),
(22, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 09:33:51', 1),
(23, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-12 12:07:30', 1),
(24, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 12:11:34', 1),
(25, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 12:39:39', 1),
(26, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 15:52:37', 1),
(27, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 16:05:15', 1),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 16:10:17', 1),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-12 16:13:31', 1),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 16:13:50', 1),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-12 16:17:13', 1),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 16:24:47', 1),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-12 16:58:55', 1),
(34, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 17:01:33', 1),
(35, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 17:46:21', 1),
(36, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 21:06:31', 1),
(37, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 21:06:43', 1),
(38, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-12 21:06:53', 1),
(39, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 10:19:36', 1),
(40, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-13 11:22:27', 1),
(41, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 11:25:21', 1),
(42, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-13 11:29:48', 1),
(43, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 11:31:30', 1),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 14:21:19', 1),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 14:41:09', 1),
(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 15:21:23', 1),
(47, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 20:09:55', 1),
(48, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 21:39:18', 1),
(49, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-14 19:53:10', 1),
(50, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-04-14 20:17:57', 1);

TRUNCATE TABLE `auth_permissions_users`;
TRUNCATE TABLE `auth_remember_tokens`;
TRUNCATE TABLE `auth_token_logins`;
TRUNCATE TABLE `division`;
INSERT INTO `division` (`id`, `id_header`, `nom`) VALUES
(1, 1, 'Animés'),
(2, 1, 'Mangas'),
(3, 2, 'Films'),
(4, 2, 'Séries'),
(5, 3, 'Généralistes'),
(6, 3, 'Streaming Animés'),
(7, 3, 'Lecture Mangas'),
(8, 3, 'Streaming Films'),
(9, 3, 'Streaming Séries'),
(10, 5, 'Utilitaires Web');

TRUNCATE TABLE `header`;
INSERT INTO `header` (`id`, `nom`) VALUES
(1, 'Animés & Mangas'),
(2, 'Films & Séries'),
(3, 'Liens'),
(5, 'Outils');

TRUNCATE TABLE `item`;
INSERT INTO `item` (`id`, `id_user`, `is_public`, `id_division`, `titre`, `status`, `image`, `lien`, `description`, `episode`, `saison`, `ordre`) VALUES
(1, 2, 0, 1, 'One Piece', 'En cours', 'https://image.tmdb.org/t/p/w500/l5menwH7JjOBbXjoftYdwMmsqmT.jpg', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1141', 1, 0),
(2, 2, 0, 2, 'One Piece', 'À voir', 'https://www.myutaku.com/media/mangas/12.jpg', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', 'Sortie : ~ 16 Avril', '1180', 0, 0),
(6, 2, 0, 1, 'Farming Life in Another World', 'À voir', 'https://image.tmdb.org/t/p/w500/mE4pE6NOV3AbvTUE3MkFMlfs12n.jpg', 'https://voir-anime.to/anime/isekai-nonbiri-nouka-{s}/isekai-nonbiri-nouka-{s}-{ep2}-vostfr/', 'Alors qu’il tente de sauver de la faillite l’entreprise dans laquelle il travaille, Hiruka Machio, 3...', '1', 2, 0),
(7, 2, 0, 1, 'Frieren', 'À voir', 'https://image.tmdb.org/t/p/w500/j8K7vgF3Kp5T6EwJvez9B4it6CB.jpg', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep1}-vostfr/', 'L’elfe Frieren a vaincu le roi des démons aux côtés du groupe mené par le jeune héros Himmel. Après ...', '3', 2, 0),
(8, 2, 0, 1, 'Wind Breaker', 'À voir', 'https://image.tmdb.org/t/p/w500/cciJ1sSUtbdamdhM01qUqkxgEEf.jpg', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', 'Au lycée Fûrin, on n\'a pas la moyenne, mais on sait se battre ! Cet établissement a le pire taux de ...', '9', 2, 0),
(9, 2, 0, 1, 'To Your Eternity', 'À voir', 'https://image.tmdb.org/t/p/w500/bohMYRVSIG68md0zQobyWbV4S8e.jpg', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', 'Un garçon solitaire errant dans les régions arctiques de l\'Amérique du Nord rencontre un loup. Tous ...', '9', 3, 0),
(10, 2, 0, 1, 'Bleach', 'À voir', 'https://www.myutaku.com/media/anime/poster/74796.jpg', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', 'Adolescent de quinze ans, Ichigo Kurosaki possède un don particulier : celui de voir les esprits. Un...', '154', 8, 0),
(11, 2, 0, 2, 'Jujutsu Kaisen', 'À voir', 'https://image.tmdb.org/t/p/w500/w2Shg7bI5WB7LINt1KxB7eihO8s.jpg', 'https://www.scan-vf.net/jujutsu-kaisen/chapitre-{ep}', 'Souffrance, regrets, humiliations... les sentiments négatifs que ressentent les humains se transform...', '175', 0, 0),
(12, 1, 1, 6, 'VoirAnime', 'À voir', NULL, 'https://voir-anime.to/', NULL, NULL, NULL, 0),
(13, 2, 0, 2, 'Chainsaw Man', 'À voir', 'https://image.tmdb.org/t/p/w500/npdB6eFzizki0WaZ1OvKcJrWe97.jpg', 'https://sushiscan.net/chainsaw-man-chapitre-{ep}/', 'Denji est un adolescent qui vit avec son chien-démon-tronçonneuse, Pochita. À cause d’une énorme det...', '52', 0, 0),
(14, 1, 1, 9, 'PapaduStream', 'À voir', NULL, 'https://papadustream.singles/', NULL, NULL, NULL, 0),
(15, 1, 1, 9, 'PLR', 'À voir', NULL, 'https://sites.google.com/view/prl-series/accueil?authuser=0', NULL, NULL, NULL, 0),
(17, 1, 1, 6, 'Franime', 'À voir', 'https://linktr.ee/og/image/franime.jpg', 'https://franime.fr/', NULL, NULL, NULL, 0),
(18, 1, 1, 6, 'Vostfree', 'À voir', NULL, 'https://vostfree.in/', NULL, NULL, NULL, 0),
(19, 1, 1, 7, 'Lelmanga', 'À voir', NULL, 'https://www.lelmanga.com/', NULL, NULL, NULL, 0),
(20, 1, 1, 7, 'ScanVf', 'À voir', NULL, 'https://www.scan-vf.net/', NULL, NULL, NULL, 0),
(21, 1, 1, 7, 'Shaeishu', 'À voir', NULL, 'https://mangamoins.shaeishu.co/', NULL, NULL, NULL, 0),
(22, 1, 1, 7, 'Sushiscan', 'À voir', NULL, 'https://sushiscan.top', NULL, NULL, NULL, 0),
(23, 1, 1, 8, 'PLR', 'À voir', NULL, 'https://sites.google.com/view/teamprl/', NULL, NULL, NULL, 0),
(24, 1, 1, 3, 'Wiflix', 'À voir', NULL, 'https://flemmix.zip', NULL, NULL, NULL, 0),
(25, 1, 1, 3, 'Netflix', 'À voir', 'https://images.ctfassets.net/4cd45et68cgf/Rx83JoRDMkYNlMC9MKzcB/2b14d5a59fc3937afd3f03191e19502d/Netflix-Symbol.png?w=700&h=456', 'https://www.netflix.com/browse', NULL, NULL, NULL, 0),
(26, 2, 0, 4, 'The Boys', 'À voir', 'https://image.tmdb.org/t/p/w500/4Tw8TB9ikrcgzJgR0LOvgfnXD74.jpg', 'https://flemmix.farm/serie-en-streaming/35782-the-boys-saison-5.html', 'Lorsque les super-héros abusent de leurs super-pouvoirs au lieu de les utiliser pour faire le bien, ...', '1', 5, 0),
(27, 2, 0, 1, 'Noble Reincarnation', 'À voir', 'https://image.tmdb.org/t/p/w500/ggxUYlw7a3eVegnXDv8aCDiLccJ.jpg', 'https://voir-anime.to/anime/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power-{ep2}-vostfr/', 'En tant que treizième prince de la famille royale, Noah a toujours mené une vie paisible, loin des i...', '2', 1, 0),
(28, 1, 1, 10, 'Audio To Text', 'À voir', NULL, 'https://editor.flixier.com/transcribe?fx_source=search&lang=en&fx_campaign=convert-audio-to-text&fx_medium=tools', 'Convertir les fichiers audio en textes', NULL, NULL, 0),
(29, 1, 1, 10, 'Bootstrap Icons', 'À voir', NULL, 'https://icons.getbootstrap.com', 'Bibliothèque d\'icônes', NULL, NULL, 0),
(30, 1, 1, 6, 'Prime Video', 'Aucun', '', 'https://www.primevideo.com/', '', '', 0, 0),
(31, 1, 1, 10, 'Cleanup', 'À voir', NULL, 'https://cleanup.pictures/', 'Nettoyer des images', NULL, NULL, 0),
(32, 1, 1, 10, 'DALL.E', 'À voir', NULL, 'https://labs.openai.com/', 'Générer des Images', NULL, NULL, 0),
(33, 1, 1, 10, 'Durable', 'À voir', NULL, 'https://app.durable.co/dashboard', 'Générer de site web', NULL, NULL, 0),
(34, 1, 1, 10, 'Fotor', 'À voir', NULL, 'https://www.fotor.com/', 'conceptions et éditions d\'images', NULL, NULL, 0),
(35, 1, 1, 10, 'Krea.ai', 'À voir', NULL, 'https://www.krea.ai/apps/image/realtime', 'Générer des Images', NULL, NULL, 0),
(36, 1, 1, 10, 'obfuscator', 'À voir', NULL, 'https://obfuscator.io/', 'crypter les scripts javascripts', NULL, NULL, 0),
(37, 2, 0, 1, 'Tsugai - Daemons of the Shadow Realm', 'À voir', 'https://image.tmdb.org/t/p/w500/mNqW2jnAogZa0nJ94q1LUum8Hos.jpg', 'https://voir-anime.to/anime/yomi-no-tsugai/daemons-of-the-shadow-realm-{ep2}-vostfr/', 'Yuru, le chasseur, vit séparé de sa sœur jumelle Asa, enfermée dans une prison pour satisfaire un ri...', '1', 1, 0),
(38, 2, 0, 1, 'Classroom of the Elite', 'À voir', 'https://image.tmdb.org/t/p/w500/mmhx3dImdsfYpcFm3J1tlQt5IRN.jpg', 'https://voir-anime.to/anime/classroom-of-the-elite-{s}/classroom-of-the-elite-{s}-{ep2}-vostfr/', 'Kiyotaka Ayanokôji intègre le prestigieux lycée de haut niveau de Tokyo où, une fois le diplôme en p...', '1', 3, 0),
(39, 2, 0, 1, 'Re:ZERO', 'À voir', 'https://image.tmdb.org/t/p/w500/ccG0ZfXOQ0834bIus4SwZrXtkyM.jpg', 'https://voir-anime.to/anime/rezero-kara-hajimeru-isekai-seikatsu-s{s}/re-zero-kara-hajimeru-isekai-seikatsu-saison-{s}-{ep2}-vostfr/', 'Subaru Natsuki a basculé dans un monde fantastique où il fait la connaissance d’Émilia, une jeune fi...', '1', 3, 0),
(40, 2, 0, 1, 'Dr. STONE', 'À voir', 'https://image.tmdb.org/t/p/w500/dLlnzbDCblBXcJqFLXyvN43NIwp.jpg', 'https://voir-anime.to/anime/dr-stone-{s}-science-future/dr-stone-{s}-{ep2}-vostfr/', 'Plusieurs milliers d\'années après un mystérieux phénomène qui a transformé toute l\'humanité en pierr...', '1', 4, 0),
(42, 1, 1, 10, 'Gemini', 'À voir', '', 'https://gemini.google.com/app?hl=fr', '', '', 0, 0);

TRUNCATE TABLE `migrations`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UserFictif', NULL, NULL, 1, '2026-04-14 20:23:32', '2026-04-11 17:01:15', '2026-04-11 17:01:16', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-04-14 20:17:26', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL);
COMMIT;
