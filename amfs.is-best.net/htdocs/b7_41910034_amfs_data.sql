SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


TRUNCATE TABLE `audit_logs`;
INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(1, 1, 'Modification Profil', 'Mise à jour du compte ID 4. Pseudo: \'test\' -> \'User de test\'. Nouveau groupe de sécurité assigné: [user].', '5.49.246.18', '2026-05-29 22:31:14'),
(2, 2, 'Mise à jour Carte', 'Modification de la carte ID 34 (\'Tsugai - Daemons of the Shadow Realm\'). Visibilité: Privée.', '5.49.246.18', '2026-05-29 22:34:23'),
(3, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 46 (\'L\'Atelier des Sorciers\') : Épisode passé à 10.', '5.49.246.18', '2026-05-29 23:09:50'),
(4, 2, 'Mise à jour Carte', 'Modification de la carte ID 46 (\'L\'Atelier des Sorciers\'). Visibilité: Privée.', '5.49.246.18', '2026-05-29 23:10:04'),
(5, 2, 'Suppression Carte', 'Suppression de la carte ID 48 (\'Nemesis\').', '5.49.246.18', '2026-05-29 23:10:30'),
(6, 2, 'Création Carte', 'Création de la carte ID 49 (\'Shadow and Bone : La saga Grisha\'). Visibilité initiale: Privée.', '5.49.246.18', '2026-05-30 01:02:54'),
(7, 2, 'Mise à jour Carte', 'Modification de la carte ID 49 (\'Shadow and Bone : La saga Grisha\'). Visibilité: Privée.', '5.49.246.18', '2026-05-30 01:03:25'),
(8, 2, 'Mise à jour Carte', 'Modification de la carte ID 49 (\'Shadow and Bone : La saga Grisha\'). Visibilité: Privée.', '5.49.246.18', '2026-05-30 01:05:10'),
(9, 2, 'Mise à jour Carte', 'Modification de la carte ID 49 (\'Shadow and Bone : La saga Grisha\'). Visibilité: Privée.', '5.49.246.18', '2026-05-30 01:05:29'),
(10, 2, 'Mise à jour Carte', 'Modification de la carte ID 49 (\'Shadow and Bone : La saga Grisha\'). Visibilité: Privée.', '5.49.246.18', '2026-05-30 01:05:48'),
(11, 2, 'Sanction : Bannissement', 'Le compte ID 4 (\'User de test\') a été suspendu de la plateforme.', '5.49.246.18', '2026-05-30 01:06:02'),
(12, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 34 (\'Tsugai - Daemons of the Shadow Realm\') : Épisode passé à 10.', '5.49.246.18', '2026-05-31 22:10:49'),
(13, 2, 'Mise à jour Carte', 'Modification de la carte ID 34 (\'Tsugai - Daemons of the Shadow Realm\'). Visibilité: Privée.', '5.49.246.18', '2026-05-31 22:11:02'),
(14, 2, 'Mise à jour Carte', 'Modification de la carte ID 46 (\'L\'Atelier des Sorciers\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 00:16:55'),
(15, 2, 'Suppression Carte', 'Suppression de la carte ID 49 (\'Shadow and Bone : La saga Grisha\').', '5.49.246.18', '2026-06-03 17:15:33'),
(16, 2, 'Mise à jour Carte', 'Modification de la carte ID 35 (\'Classroom of the Elite\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 21:42:48'),
(17, 2, 'Mise à jour Carte', 'Modification de la carte ID 35 (\'Classroom of the Elite\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 21:42:56'),
(18, 2, 'Mise à jour Carte', 'Modification de la carte ID 35 (\'Classroom of the Elite\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 22:14:54'),
(19, 2, 'Création Carte', 'Création de la carte ID 50 (\'Shadow and Bone : La saga Grisha\'). Visibilité initiale: Privée.', '5.49.246.18', '2026-06-03 22:55:09'),
(20, 2, 'Mise à jour Carte', 'Modification de la carte ID 50 (\'Shadow and Bone : La saga Grisha\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 22:55:48'),
(21, 2, 'Mise à jour Carte', 'Modification de la carte ID 35 (\'Classroom of the Elite\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 23:00:45'),
(22, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 35 (\'Classroom of the Elite\') : Épisode passé à 11.', '5.49.246.18', '2026-06-03 23:48:23'),
(23, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 35 (\'Classroom of the Elite\') : Épisode passé à 12.', '5.49.246.18', '2026-06-03 23:48:24'),
(24, 2, 'Mise à jour Carte', 'Modification de la carte ID 35 (\'Classroom of the Elite\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 23:48:31'),
(25, 2, 'Mise à jour Carte', 'Modification de la carte ID 35 (\'Classroom of the Elite\'). Visibilité: Privée.', '5.49.246.18', '2026-06-03 23:48:40'),
(26, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 35 (\'Classroom of the Elite\') : Épisode passé à 12.', '5.49.246.18', '2026-06-04 00:18:03'),
(27, 2, 'Suppression Carte', 'Suppression de la carte ID 50 (\'Shadow and Bone : La saga Grisha\').', '5.49.246.18', '2026-06-04 23:54:13'),
(28, 2, 'Création Carte', 'Création de la carte ID 51 (\'Locke & Key\'). Visibilité initiale: Privée.', '5.49.246.18', '2026-06-04 23:54:50'),
(29, 2, 'Mise à jour Carte', 'Modification de la carte ID 2 (\'One Piece\'). Visibilité: Privée.', '5.49.246.18', '2026-06-07 18:16:00'),
(30, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 2 (\'One Piece\') : Épisode passé à 1184.', '5.49.246.18', '2026-06-07 18:16:10'),
(31, 2, 'Incrémentation Rapide', 'Mise à jour de la carte ID 2 (\'One Piece\') : Épisode passé à 1185.', '5.49.246.18', '2026-06-07 18:24:03'),
(32, 2, 'Mise à jour Carte', 'Modification de la carte ID 2 (\'One Piece\'). Visibilité: Privée.', '5.49.246.18', '2026-06-07 18:24:20'),
(33, 2, 'Mise à jour Carte', 'Modification de la carte ID 2 (\'One Piece\'). Visibilité: Privée.', '5.49.246.18', '2026-06-07 18:25:01'),
(34, 2, 'Mise à jour Carte', 'Modification de la carte ID 2 (\'One Piece\'). Visibilité: Privée.', '5.49.246.18', '2026-06-07 18:25:20'),
(35, 2, 'Mise à jour Carte', 'Modification de la carte ID 34 (\'Tsugai - Daemons of the Shadow Realm\'). Visibilité: Privée.', '5.49.246.18', '2026-06-07 20:21:59');

TRUNCATE TABLE `auth_groups_users`;
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'superadmin', '2026-04-11 17:01:16'),
(3, 3, 'user', '2026-04-30 14:13:10'),
(6, 2, 'admin', '2026-05-17 22:56:01'),
(7, 4, 'user', '2026-05-29 22:30:45');

TRUNCATE TABLE `auth_identities`;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-05-29 22:30:56', '2026-04-11 17:01:16', '2026-05-29 22:30:56'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-06-07 18:01:20', '2026-04-11 17:02:38', '2026-06-07 18:01:20'),
(3, 2, 'magic-link', NULL, 'e3fc52dba64bd3b1958f', NULL, '2026-04-30 15:11:11', NULL, 0, NULL, '2026-04-30 14:11:11', '2026-04-30 14:11:11'),
(4, 3, 'email_password', NULL, 'hugophilippe26@gmail.com', '$2y$12$9rKoqgP6n7E1vosN4EUWpu5L/lPLkyb9GrDKmIqJxQX9pzG/7drPG', NULL, NULL, 0, NULL, '2026-04-30 14:13:09', '2026-04-30 14:13:10'),
(5, 4, 'email_password', NULL, 'mathisfrances111@gmail.com', '$2y$12$q4NTrCKkkMj3kINlncokHuDcbgPaDT2SDDooXI0R5asUjUwjK1pem', NULL, NULL, 0, '2026-05-29 22:31:26', '2026-05-29 22:30:44', '2026-05-29 22:31:26');

TRUNCATE TABLE `auth_logins`;
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-05-29 22:30:56', 1),
(2, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances111@gmail.com', 4, '2026-05-29 22:31:26', 1),
(3, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-29 22:33:06', 1),
(4, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-06-03 22:14:48', 1),
(5, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-06-03 23:00:29', 1),
(6, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-06-03 23:14:49', 1),
(7, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-06-03 23:41:18', 1),
(8, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-06-03 23:45:27', 1),
(9, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-06-07 18:01:20', 1);

TRUNCATE TABLE `auth_permissions_users`;
TRUNCATE TABLE `auth_remember_tokens`;
INSERT INTO `auth_remember_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`, `created_at`, `updated_at`) VALUES
(10, 'ecb041d68a37b7279dd1a53f', '2319b22b89e96115ee6552125773cb90b6397bf47882a447a402c7332f014af8', 2, '2026-07-03 21:42:19', '2026-05-29 22:33:06', '2026-06-03 21:42:19'),
(11, '2faf4f7a07ed924914240d39', '9f8375ad7b9635c7881b4b400c13cebcf19175ee62832a446f08839a11231ed0', 2, '2026-07-03 22:14:48', '2026-06-03 22:14:48', '2026-06-03 22:14:48'),
(12, '9f67ffcb6bbbf0012f74316c', '7bf219cd4dce9628ab2fe65cc7c5868c311f61a44e6c053c6c94e303ecd312d7', 2, '2026-07-03 23:00:29', '2026-06-03 23:00:29', '2026-06-03 23:00:29'),
(13, '2cc200cf27947f8ebb154c70', '08fb70d86829c2e8761ea7a124ba65cf7047c3fdc439dc59fa3e3cd5d9e61b87', 2, '2026-07-03 23:14:49', '2026-06-03 23:14:49', '2026-06-03 23:14:49'),
(14, 'd345934cc4c8a5447d3461c3', '8472d4e3b10fa86f79e70200dedcc244fc046c13928476d460c20f3a834d095a', 2, '2026-07-03 23:41:18', '2026-06-03 23:41:18', '2026-06-03 23:41:18'),
(15, 'f26b736f492d84eb526e6e84', 'fe0b5a422eb85f5766a5fcca661a8afc9875fabdf5faf722d9488d217c04728b', 2, '2026-07-04 23:54:13', '2026-06-03 23:45:27', '2026-06-04 23:54:13'),
(16, '1424369907e2fc8ba6995a38', '67fbac29e880d40f98f87cae4ef1dc25e1cd15c6b8f1ad940b30d1d80b63a0aa', 2, '2026-07-07 22:45:37', '2026-06-07 18:01:20', '2026-06-07 22:45:37');

TRUNCATE TABLE `auth_token_logins`;
TRUNCATE TABLE `cron_logs`;
INSERT INTO `cron_logs` (`id`, `item_id`, `titre`, `url_testee`, `code_erreur`, `task_name`, `last_run`) VALUES
(1, NULL, 'Aucun lien mort détecté', NULL, 200, 'check_dead_links', '2026-06-07 22:46:12');

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
(10, 5, 'Utilitaires Web'),
(11, 5, 'Autres');

TRUNCATE TABLE `header`;
INSERT INTO `header` (`id`, `nom`) VALUES
(1, 'Animés & Mangas'),
(2, 'Films & Séries'),
(3, 'Liens'),
(5, 'Outils');

TRUNCATE TABLE `item`;
INSERT INTO `item` (`id`, `id_user`, `is_public`, `id_division`, `titre`, `status`, `image`, `lien`, `link_status`, `description`, `episode`, `saison`, `position`, `date_sortie`, `deleted_at`) VALUES
(1, 2, 0, 1, 'One Piece', 'En cours', 'https://image.tmdb.org/t/p/w500/l5menwH7JjOBbXjoftYdwMmsqmT.jpg', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', 'ok', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1141', 1, 8, NULL, NULL),
(2, 2, 0, 2, 'One Piece', 'Aucun', 'https://www.myutaku.com/media/mangas/12.jpg', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', 'ok', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1185', 0, 0, '2026-06-19 18:00:00', NULL),
(5, 2, 0, 1, 'Frieren', 'Aucun', 'https://image.tmdb.org/t/p/w500/j8K7vgF3Kp5T6EwJvez9B4it6CB.jpg', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep2}-vostfr/', 'ok', 'L’elfe Frieren a vaincu le roi des démons aux côtés du groupe mené par le jeune héros Himmel. Après ...', '3', 2, 5, NULL, NULL),
(6, 2, 0, 1, 'Wind Breaker', 'Aucun', 'https://image.tmdb.org/t/p/w500/cciJ1sSUtbdamdhM01qUqkxgEEf.jpg', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', 'ok', 'Au lycée Fûrin, on n\'a pas la moyenne, mais on sait se battre ! Cet établissement a le pire taux de ...', '9', 2, 3, NULL, NULL),
(7, 2, 0, 1, 'To Your Eternity', 'Aucun', 'https://image.tmdb.org/t/p/w500/bohMYRVSIG68md0zQobyWbV4S8e.jpg', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', 'ok', 'Un garçon solitaire errant dans les régions arctiques de l\'Amérique du Nord rencontre un loup. Tous ...', '9', 3, 6, NULL, NULL),
(8, 2, 0, 1, 'Bleach', 'En pause', 'https://www.myutaku.com/media/anime/poster/74796.jpg', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', 'ok', 'Adolescent de quinze ans, Ichigo Kurosaki possède un don particulier : celui de voir les esprits. Un...', '154', 8, 10, NULL, NULL),
(10, 1, 1, 6, 'VoirAnime', 'Aucun', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdYwTRt_o2nzbUEQuhIf36xoD7DC5rpxP6vg&s', 'https://voir-anime.to/', 'ok', '', '', 0, 0, NULL, NULL),
(11, 2, 0, 2, 'Chainsaw Man', 'Aucun', 'https://image.tmdb.org/t/p/w500/npdB6eFzizki0WaZ1OvKcJrWe97.jpg', 'https://sushiscan.net/chainsaw-man-chapitre-{ep}/', 'ok', 'Denji est un adolescent qui vit avec son chien-démon-tronçonneuse, Pochita. À cause d’une énorme det...', '52', 0, 2, NULL, NULL),
(12, 1, 1, 9, 'PapaduStream', 'Aucun', '', 'https://papadustream.marketing/', 'ok', '', '', 0, 0, NULL, NULL),
(13, 1, 1, 9, 'PLR', 'Aucun', NULL, 'https://sites.google.com/view/prl-series/accueil?authuser=0', 'ok', NULL, NULL, NULL, 0, NULL, NULL),
(14, 1, 1, 6, 'Franime', 'Aucun', 'https://linktr.ee/og/image/franime.jpg', 'https://franime.fr/', 'ok', '', '', 0, 0, NULL, NULL),
(16, 1, 1, 7, 'Lelmanga', 'Aucun', 'https://img.themesinfo.com/i/1/387/wordpress-theme-mangareader-q6z9a-m.jpg', 'https://www.lelmanga.com/', 'ok', '', '', 0, 2, NULL, NULL),
(17, 1, 1, 7, 'ScanVf', 'Aucun', NULL, 'https://www.scan-vf.net/', 'ok', NULL, NULL, NULL, 0, NULL, NULL),
(18, 1, 1, 7, 'Mangamoins', 'Aucun', '', 'https://mangamoins.com/', 'ok', '', '', NULL, 3, NULL, NULL),
(19, 1, 1, 7, 'Sushiscan', 'Aucun', '', 'https://sushiscan.net', 'ok', '', '', 0, 1, NULL, NULL),
(20, 1, 1, 8, 'PLR', 'Aucun', NULL, 'https://sites.google.com/view/teamprl/', 'ok', NULL, NULL, NULL, 0, NULL, NULL),
(21, 1, 1, 5, 'Wiflix', 'Aucun', '', 'https://flemmix.zip', 'ok', '', '', 0, 0, NULL, NULL),
(22, 1, 1, 5, 'Netflix', 'Aucun', 'https://images.ctfassets.net/4cd45et68cgf/Rx83JoRDMkYNlMC9MKzcB/2b14d5a59fc3937afd3f03191e19502d/Netflix-Symbol.png?w=700&h=456', 'https://www.netflix.com/browse', 'ok', '', '', 0, 0, NULL, NULL),
(24, 2, 0, 1, 'Noble Reincarnation', 'Aucun', 'https://image.tmdb.org/t/p/w500/ggxUYlw7a3eVegnXDv8aCDiLccJ.jpg', 'https://voir-anime.to/anime/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power-{ep2}-vostfr/', 'ok', 'En tant que treizième prince de la famille royale, Noah a toujours mené une vie paisible, loin des i...', '2', 1, 7, NULL, NULL),
(25, 1, 1, 10, 'Audio To Text', 'Aucun', NULL, 'https://editor.flixier.com/transcribe?fx_source=search&lang=en&fx_campaign=convert-audio-to-text&fx_medium=tools', 'ok', 'Convertir les fichiers audio en textes', NULL, NULL, 0, NULL, NULL),
(26, 1, 1, 10, 'Bootstrap Icons', 'Aucun', NULL, 'https://icons.getbootstrap.com', 'ok', 'Bibliothèque d\'icônes', NULL, NULL, 0, NULL, NULL),
(27, 1, 1, 5, 'Prime Video', 'Aucun', 'https://cdn.prod.website-files.com/63f46dc8ada663b2260ad042/651e7514b3a51ee790163981_Amazon%20-%20Prime%20Video%20(2).jpg', 'https://www.primevideo.com/', 'ok', '', '', 0, 0, NULL, NULL),
(28, 1, 1, 10, 'Cleanup', 'Aucun', NULL, 'https://cleanup.pictures/', 'ok', 'Nettoyer des images', NULL, NULL, 0, NULL, NULL),
(30, 1, 1, 10, 'Durable', 'Aucun', '', 'https://app.durable.co/dashboard', 'ok', 'Générer des sites web', '', 0, 0, NULL, NULL),
(31, 1, 1, 10, 'Fotor', 'Aucun', NULL, 'https://www.fotor.com/', 'ok', 'conceptions et éditions d\'images', NULL, NULL, 0, NULL, NULL),
(32, 1, 1, 10, 'Krea.ai', 'Aucun', NULL, 'https://www.krea.ai/apps/image/realtime', 'ok', 'Générer des Images', NULL, NULL, 0, NULL, NULL),
(33, 1, 1, 10, 'obfuscator', 'Aucun', NULL, 'https://obfuscator.io/', 'ok', 'crypter les scripts javascripts', NULL, NULL, 0, NULL, NULL),
(34, 2, 0, 1, 'Tsugai - Daemons of the Shadow Realm', 'En cours', 'https://image.tmdb.org/t/p/w500/mNqW2jnAogZa0nJ94q1LUum8Hos.jpg', 'https://voir-anime.to/anime/yomi-no-tsugai/daemons-of-the-shadow-realm-{ep2}-vostfr/', 'ok', 'Yuru, le chasseur, vit séparé de sa sœur jumelle Asa, enfermée dans une prison pour satisfaire un ri...', '11', 1, 2, '2026-06-13 18:00:00', NULL),
(35, 2, 0, 1, 'Classroom of the Elite', 'En cours', 'https://image.tmdb.org/t/p/w500/mmhx3dImdsfYpcFm3J1tlQt5IRN.jpg', 'https://voir-anime.to/anime/classroom-of-the-elite-{s}/classroom-of-the-elite-{s}-{ep2}-vostfr/', 'ok', 'Kiyotaka Ayanokôji intègre le prestigieux lycée de haut niveau de Tokyo où, une fois le diplôme en p...', '12', 3, 0, NULL, NULL),
(36, 2, 0, 1, 'Re:ZERO', 'Aucun', 'https://image.tmdb.org/t/p/w500/ccG0ZfXOQ0834bIus4SwZrXtkyM.jpg', 'https://voir-anime.to/anime/rezero-kara-hajimeru-isekai-seikatsu-s{s}/re-zero-kara-hajimeru-isekai-seikatsu-saison-{s}-{ep2}-vostfr/', 'ok', 'Subaru Natsuki a basculé dans un monde fantastique où il fait la connaissance d’Émilia, une jeune fi...', '1', 3, 9, NULL, NULL),
(37, 2, 0, 1, 'Dr. STONE', 'Aucun', 'https://image.tmdb.org/t/p/w500/dLlnzbDCblBXcJqFLXyvN43NIwp.jpg', 'https://voir-anime.to/anime/dr-stone-{s}-science-future/dr-stone-{s}-{ep2}-vostfr/', 'ok', 'Plusieurs milliers d\'années après un mystérieux phénomène qui a transformé toute l\'humanité en pierr...', '1', 4, 4, NULL, NULL),
(38, 1, 1, 10, 'Gemini', 'Aucun', '', 'https://gemini.google.com/app?hl=fr', 'ok', '', '', 0, 0, NULL, NULL),
(39, 2, 0, 11, 'Suivi des comptes', 'Aucun', '', 'https://summury.22web.org/suivi-comptes/index.php', 'ok', '', '', 0, 0, NULL, NULL),
(40, 2, 0, 2, 'Jujutsu Kaisen Modulo', 'À voir', 'https://www.myutaku.com/media/mangas/88950.jpg?1757883349', 'https://www.scan-vf.net/jujutsu-kaisen-modulo/chapitre-{ep}', 'ok', 'Souffrance, regrets, humiliations... les sentiments négatifs que ressentent les humains se transform...', '5', 0, 1, NULL, NULL),
(41, 2, 0, 11, 'Intranap Pec', 'Aucun', '', 'https://pec-intranap.is-best.net', 'ok', '', '', 0, 0, NULL, NULL),
(43, 2, 0, 1, 'Les Carnets de l\'apothicaire', 'Aucun', 'https://image.tmdb.org/t/p/w500/47pSay5Ao7SFeyQBZVkW5ifyhAZ.jpg', 'https://voir-anime.to/anime/the-apothecary-diaries/the-apothecary-diaries-{ep2}-vostfr/', 'ok', 'Formée dès son plus jeune âge par son père apothicaire, Mao Mao est un jour vendue comme servante au...', '1', 1, 11, NULL, NULL),
(46, 2, 0, 1, 'L\'Atelier des Sorciers', 'En cours', 'https://image.tmdb.org/t/p/w500/dH1ZLuGubotqtQbRSCSvYswb3HP.jpg', 'https://voir-anime.to/anime/witch-hat-atelier/witch-hat-atelier-{ep2}-vostfr/', 'ok', 'Coco a toujours été fascinée par la magie, mais seuls les sorciers la pratiquent à l\'abri des regard...', '11', 1, 1, '2026-06-08 18:00:00', NULL),
(47, 2, 0, 11, 'Liens très privés', 'Aucun', '', 'https://prive.22web.org/', 'ok', '', '', 0, 0, NULL, NULL),
(51, 2, 0, 4, 'Locke & Key', 'Aucun', 'https://image.tmdb.org/t/p/w500/dRw3ZqGL2XMiQms0BKKpH98X1dW.jpg', '', 'ok', 'Après le meurtre de leur père, trois enfants emménagent avec leur mère dans une maison de famille où...', '', 0, 0, NULL, NULL);

TRUNCATE TABLE `item_revisions`;
TRUNCATE TABLE `migrations`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', NULL, NULL, 1, '2026-05-18 00:30:18', '2026-04-11 17:01:15', '2026-05-17 12:39:43', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-06-07 20:21:59', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL),
(3, 'Seiko', NULL, NULL, 1, NULL, '2026-04-30 14:13:09', '2026-05-29 22:18:11', NULL),
(4, 'User de test', 'banned', 'Accès révoqué par l\'administration.', 1, NULL, '2026-05-29 22:30:44', '2026-05-30 01:06:02', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
