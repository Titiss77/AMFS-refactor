SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


TRUNCATE TABLE `audit_logs`;
TRUNCATE TABLE `auth_groups_users`;
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'superadmin', '2026-04-11 17:01:16'),
(3, 3, 'user', '2026-04-30 14:13:10'),
(6, 2, 'admin', '2026-05-17 22:56:01');

TRUNCATE TABLE `auth_identities`;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-05-29 22:17:38', '2026-04-11 17:01:16', '2026-05-29 22:17:38'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-05-29 22:04:48', '2026-04-11 17:02:38', '2026-05-29 22:04:48'),
(3, 2, 'magic-link', NULL, 'e3fc52dba64bd3b1958f', NULL, '2026-04-30 15:11:11', NULL, 0, NULL, '2026-04-30 14:11:11', '2026-04-30 14:11:11'),
(4, 3, 'email_password', NULL, 'hugophilippe26@gmail.com', '$2y$12$9rKoqgP6n7E1vosN4EUWpu5L/lPLkyb9GrDKmIqJxQX9pzG/7drPG', NULL, NULL, 0, NULL, '2026-04-30 14:13:09', '2026-04-30 14:13:10');

TRUNCATE TABLE `auth_logins`;
TRUNCATE TABLE `auth_permissions_users`;
TRUNCATE TABLE `auth_remember_tokens`;
INSERT INTO `auth_remember_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`, `created_at`, `updated_at`) VALUES
(7, '39a90689a25075a2f5b37d15', '0269a260d3760f4c770e94c04030845a2883ab5d376903a0f137f5abeb3b9f98', 1, '2026-06-28 22:17:38', '2026-05-29 22:17:38', '2026-05-29 22:17:38');

TRUNCATE TABLE `auth_token_logins`;
TRUNCATE TABLE `cron_logs`;
INSERT INTO `cron_logs` (`id`, `item_id`, `titre`, `url_testee`, `code_erreur`, `task_name`, `last_run`) VALUES
(1, NULL, 'Aucun lien mort détecté', NULL, 200, 'check_dead_links', '2026-05-29 22:28:58');

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
(2, 2, 0, 2, 'One Piece', 'Aucun', 'https://www.myutaku.com/media/mangas/12.jpg', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', 'ok', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1183', 0, 0, '2026-05-22 18:00:00', NULL),
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
(34, 2, 0, 1, 'Tsugai - Daemons of the Shadow Realm', 'En cours', 'https://image.tmdb.org/t/p/w500/mNqW2jnAogZa0nJ94q1LUum8Hos.jpg', 'https://voir-anime.to/anime/yomi-no-tsugai/daemons-of-the-shadow-realm-{ep2}-vostfr/', 'ok', 'Yuru, le chasseur, vit séparé de sa sœur jumelle Asa, enfermée dans une prison pour satisfaire un ri...', '9', 1, 2, '2026-05-24 18:00:00', NULL),
(35, 2, 0, 1, 'Classroom of the Elite', 'En cours', 'https://image.tmdb.org/t/p/w500/mmhx3dImdsfYpcFm3J1tlQt5IRN.jpg', 'https://voir-anime.to/anime/classroom-of-the-elite-{s}/classroom-of-the-elite-{s}-{ep2}-vostfr/', 'ok', 'Kiyotaka Ayanokôji intègre le prestigieux lycée de haut niveau de Tokyo où, une fois le diplôme en p...', '10', 3, 0, NULL, NULL),
(36, 2, 0, 1, 'Re:ZERO', 'Aucun', 'https://image.tmdb.org/t/p/w500/ccG0ZfXOQ0834bIus4SwZrXtkyM.jpg', 'https://voir-anime.to/anime/rezero-kara-hajimeru-isekai-seikatsu-s{s}/re-zero-kara-hajimeru-isekai-seikatsu-saison-{s}-{ep2}-vostfr/', 'ok', 'Subaru Natsuki a basculé dans un monde fantastique où il fait la connaissance d’Émilia, une jeune fi...', '1', 3, 9, NULL, NULL),
(37, 2, 0, 1, 'Dr. STONE', 'Aucun', 'https://image.tmdb.org/t/p/w500/dLlnzbDCblBXcJqFLXyvN43NIwp.jpg', 'https://voir-anime.to/anime/dr-stone-{s}-science-future/dr-stone-{s}-{ep2}-vostfr/', 'ok', 'Plusieurs milliers d\'années après un mystérieux phénomène qui a transformé toute l\'humanité en pierr...', '1', 4, 4, NULL, NULL),
(38, 1, 1, 10, 'Gemini', 'Aucun', '', 'https://gemini.google.com/app?hl=fr', 'ok', '', '', 0, 0, NULL, NULL),
(39, 2, 0, 11, 'Suivi des comptes', 'Aucun', '', 'https://summury.22web.org/suivi-comptes/index.php', 'ok', '', '', 0, 0, NULL, NULL),
(40, 2, 0, 2, 'Jujutsu Kaisen Modulo', 'À voir', 'https://www.myutaku.com/media/mangas/88950.jpg?1757883349', 'https://www.scan-vf.net/jujutsu-kaisen-modulo/chapitre-{ep}', 'ok', 'Souffrance, regrets, humiliations... les sentiments négatifs que ressentent les humains se transform...', '5', 0, 1, NULL, NULL),
(41, 2, 0, 11, 'Intranap Pec', 'Aucun', '', 'https://pec-intranap.is-best.net', 'ok', '', '', 0, 0, NULL, NULL),
(43, 2, 0, 1, 'Les Carnets de l\'apothicaire', 'Aucun', 'https://image.tmdb.org/t/p/w500/47pSay5Ao7SFeyQBZVkW5ifyhAZ.jpg', 'https://voir-anime.to/anime/the-apothecary-diaries/the-apothecary-diaries-{ep2}-vostfr/', 'ok', 'Formée dès son plus jeune âge par son père apothicaire, Mao Mao est un jour vendue comme servante au...', '1', 1, 11, NULL, NULL),
(46, 2, 0, 1, 'L\'Atelier des Sorciers', 'En cours', 'https://image.tmdb.org/t/p/w500/dH1ZLuGubotqtQbRSCSvYswb3HP.jpg', 'https://voir-anime.to/anime/witch-hat-atelier/witch-hat-atelier-{ep2}-vostfr/', 'ok', 'Coco a toujours été fascinée par la magie, mais seuls les sorciers la pratiquent à l\'abri des regard...', '9', 1, 1, '2026-05-25 18:00:00', NULL),
(47, 2, 0, 11, 'Liens très privés', 'Aucun', '', 'https://prive.22web.org/', 'ok', '', '', 0, 0, NULL, NULL),
(48, 2, 0, 4, 'Nemesis', 'En cours', 'https://image.tmdb.org/t/p/w500/qjkp7DH7eSbLWLacjBqSV6TKz3Q.jpg', '', 'ok', 'Deux hommes situés de part et d\'autre de la loi, et illustre la réaction provoquée par la rencontre ...', '', 0, 0, NULL, NULL);

TRUNCATE TABLE `item_revisions`;
TRUNCATE TABLE `migrations`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', NULL, NULL, 1, '2026-05-18 00:30:18', '2026-04-11 17:01:15', '2026-05-17 12:39:43', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-05-29 22:03:18', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL),
(3, 'Seiko', NULL, NULL, 1, NULL, '2026-04-30 14:13:09', '2026-05-29 22:18:11', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
