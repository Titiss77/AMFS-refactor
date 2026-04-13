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
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-04-13 11:29:48', '2026-04-11 17:01:16', '2026-04-13 11:29:48'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-04-13 11:31:30', '2026-04-11 17:02:38', '2026-04-13 11:31:30');

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
(43, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-13 11:31:30', 1);

TRUNCATE TABLE `auth_permissions_users`;
TRUNCATE TABLE `auth_remember_tokens`;
TRUNCATE TABLE `auth_token_logins`;
TRUNCATE TABLE `division`;
INSERT INTO `division` (`id`, `id_header`, `nom`) VALUES
(1, 1, 'Animés à voir'),
(2, 1, 'Scans à lire'),
(3, 3, 'General -> Sites'),
(4, 3, 'Animés -> Sites'),
(5, 3, 'Films -> Sites'),
(7, 3, 'Scans -> Sites'),
(8, 3, 'Séries -> Sites'),
(9, 2, 'Films à voir'),
(10, 2, 'Séries à voir'),
(11, 5, 'Outils');

TRUNCATE TABLE `header`;
INSERT INTO `header` (`id`, `nom`) VALUES
(1, 'Animés & Mangas'),
(2, 'Films & Séries'),
(3, 'Liens'),
(5, 'Outils');

TRUNCATE TABLE `item`;
INSERT INTO `item` (`id`, `id_user`, `id_division`, `titre`, `image`, `lien`, `description`, `episode`, `saison`) VALUES
(1, 2, 1, 'One Piece', 'https://www.myutaku.com/media/anime/poster/81797.jpg', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', NULL, '1141', 1),
(2, 2, 2, 'Manga : One Piece', 'https://www.myutaku.com/media/mangas/12.jpg', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', 'Sortie : ~ 16 Avril', '1180', NULL),
(6, 2, 1, 'Farming Life in Another World', 'https://www.myutaku.com/media/anime/poster/354478.jpg', 'https://voir-anime.to/anime/isekai-nonbiri-nouka-{s}/isekai-nonbiri-nouka-{s}-{ep2}-vostfr/', NULL, '1', 2),
(7, 2, 1, 'Frieren', 'https://www.myutaku.com/media/anime/poster/355325.jpg', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep1}-vostfr/', NULL, '3', 2),
(8, 2, 1, 'Wind Breaker', 'https://www.myutaku.com/media/anime/poster/357086.jpg', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', NULL, '9', 2),
(9, 2, 1, 'To Your Eternity', 'https://www.myutaku.com/media/anime/poster/346664.jpg', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', NULL, '9', 3),
(10, 2, 1, 'Bleach', 'https://www.myutaku.com/media/anime/poster/74796.jpg?t=1741173301', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', '', '154', 8),
(11, 2, 2, 'Jujutsu Kaisen', 'https://www.myutaku.com/media/mangas/49948.jpg', 'https://www.scan-vf.net/jujutsu-kaisen/chapitre-{ep}', NULL, '175', NULL),
(12, 1, 4, 'VoirAnime', NULL, 'https://voir-anime.to/', NULL, NULL, NULL),
(13, 2, 2, 'Chainsow Man', 'https://www.myutaku.com/media/mangas/52657.jpg', 'https://sushiscan.net/chainsaw-man-chapitre-{ep}/', NULL, '52', NULL),
(14, 1, 8, 'PapaduStream', NULL, 'https://papadustream.singles/', NULL, NULL, NULL),
(15, 1, 8, 'PLR', NULL, 'https://sites.google.com/view/prl-series/accueil?authuser=0', NULL, NULL, NULL),
(17, 1, 3, 'Franime', 'https://linktr.ee/og/image/franime.jpg', 'https://franime.fr/', NULL, NULL, NULL),
(18, 1, 4, 'Vostfree', NULL, 'https://vostfree.in/', NULL, NULL, NULL),
(19, 1, 7, 'Lelmanga', NULL, 'https://www.lelmanga.com/', NULL, NULL, NULL),
(20, 1, 7, 'ScanVf', NULL, 'https://www.scan-vf.net/', NULL, NULL, NULL),
(21, 1, 7, 'Shaeishu', NULL, 'https://mangamoins.shaeishu.co/', NULL, NULL, NULL),
(22, 1, 7, 'Sushiscan', NULL, 'https://sushiscan.top', NULL, NULL, NULL),
(23, 1, 5, 'PLR', NULL, 'https://sites.google.com/view/teamprl/', NULL, NULL, NULL),
(24, 1, 5, 'Wiflix', NULL, 'https://flemmix.zip', NULL, NULL, NULL),
(25, 1, 3, 'Netflix', 'https://images.ctfassets.net/4cd45et68cgf/Rx83JoRDMkYNlMC9MKzcB/2b14d5a59fc3937afd3f03191e19502d/Netflix-Symbol.png?w=700&h=456', 'https://www.netflix.com/browse', NULL, NULL, NULL),
(26, 2, 10, 'The Boys', 'https://upload.wikimedia.org/wikipedia/en/1/14/The_Boys_Season_2.jpg', 'https://flemmix.farm/serie-en-streaming/35782-the-boys-saison-5.html', NULL, '1', 5),
(27, 2, 1, 'Noble Reincarnation: Born Blessed, So I’ll Obtain Ultimate Power', 'https://www.myutaku.com/media/anime/poster/361049.jpg', 'https://voir-anime.to/anime/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power-{ep2}-vostfr/', NULL, '2', 1),
(28, 1, 11, 'Audio To Text', NULL, 'https://editor.flixier.com/transcribe?fx_source=search&lang=en&fx_campaign=convert-audio-to-text&fx_medium=tools', 'Convertir les fichiers audio en textes', NULL, NULL),
(29, 1, 11, 'Bootstrap Icons', NULL, 'https://icons.getbootstrap.com', 'Bibliothèque d\'icônes', NULL, NULL),
(30, 1, 3, 'Prime Video', NULL, 'https://www.primevideo.com/', NULL, NULL, NULL),
(31, 1, 11, 'Cleanup', NULL, 'https://cleanup.pictures/', 'Nettoyer des images', NULL, NULL),
(32, 1, 11, 'DALL.E', NULL, 'https://labs.openai.com/', 'Générer des Images', NULL, NULL),
(33, 1, 11, 'Durable', NULL, 'https://app.durable.co/dashboard', 'Générer de site web', NULL, NULL),
(34, 1, 11, 'Fotor', NULL, 'https://www.fotor.com/', 'conceptions et éditions d\'images', NULL, NULL),
(35, 1, 11, 'Krea.ai', NULL, 'https://www.krea.ai/apps/image/realtime', 'Générer des Images', NULL, NULL),
(36, 1, 11, 'obfuscator', NULL, 'https://obfuscator.io/', 'crypter les scripts javascripts', NULL, NULL),
(37, 2, 1, 'Daemons of the Shadow Realm', 'https://www.myutaku.com/media/anime/poster/361772.jpg', 'https://voir-anime.to/anime/yomi-no-tsugai/daemons-of-the-shadow-realm-{ep2}-vostfr/', NULL, '1', 1),
(38, 2, 1, 'Classroom of the Elite', 'https://www.myutaku.com/media/anime/poster/13141.jpg', 'https://voir-anime.to/anime/classroom-of-the-elite-{s}/classroom-of-the-elite-{s}-{ep2}-vostfr/', NULL, '1', 3),
(39, 2, 1, 'Re:ZERO -Starting Life in Another World-', 'https://www.myutaku.com/media/anime/poster/305089.jpg', 'https://voir-anime.to/anime/rezero-kara-hajimeru-isekai-seikatsu-s{s}/re-zero-kara-hajimeru-isekai-seikatsu-saison-{s}-{ep2}-vostfr/', NULL, '1', 3),
(40, 2, 1, 'Dr. Stone', 'https://www.myutaku.com/media/anime/poster/344884.jpg', 'https://voir-anime.to/anime/dr-stone-{s}-science-future/dr-stone-{s}-{ep2}-vostfr/', NULL, '1', 4);

TRUNCATE TABLE `migrations`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UserFictif', NULL, NULL, 1, '2026-04-13 11:30:15', '2026-04-11 17:01:15', '2026-04-11 17:01:16', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-04-13 11:52:25', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL);
COMMIT;
