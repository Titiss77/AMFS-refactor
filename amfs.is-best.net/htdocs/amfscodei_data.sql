SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

TRUNCATE TABLE `auth_groups_users`;
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'superadmin', '2026-04-11 17:01:16'),
(3, 3, 'user', '2026-04-30 14:13:10'),
(4, 2, 'admin', '2026-05-17 12:39:00');

TRUNCATE TABLE `auth_identities`;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-05-17 12:38:45', '2026-04-11 17:01:16', '2026-05-17 12:38:45'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-05-17 13:05:13', '2026-04-11 17:02:38', '2026-05-17 13:05:13'),
(3, 2, 'magic-link', NULL, 'e3fc52dba64bd3b1958f', NULL, '2026-04-30 15:11:11', NULL, 0, NULL, '2026-04-30 14:11:11', '2026-04-30 14:11:11'),
(4, 3, 'email_password', NULL, 'hugophilippe26@gmail.com', '$2y$12$9rKoqgP6n7E1vosN4EUWpu5L/lPLkyb9GrDKmIqJxQX9pzG/7drPG', NULL, NULL, 0, NULL, '2026-04-30 14:13:09', '2026-04-30 14:13:10');

TRUNCATE TABLE `auth_logins`;
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '79.83.33.124', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-13 17:55:56', 1),
(2, '79.83.33.124', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'titisland@gmail.com', 1, '2026-05-13 17:56:16', 1),
(3, '79.83.33.124', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-13 17:56:38', 1),
(4, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-15 17:49:22', 1),
(5, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-05-16 16:15:10', 1),
(6, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-16 17:39:28', 1),
(7, '79.83.33.192', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'titisland@gmail.com', 1, '2026-05-16 18:02:02', 1),
(8, '79.83.33.192', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'titisland@gmail.com', 1, '2026-05-16 18:03:12', 1),
(9, '79.83.33.192', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-16 18:04:03', 1),
(10, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-17 12:38:37', 1),
(11, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'titisland@gmail.com', 1, '2026-05-17 12:38:45', 1),
(12, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-17 12:40:05', 1),
(13, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-17 12:42:38', 1),
(14, '5.49.246.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-05-17 13:05:13', 1);

TRUNCATE TABLE `auth_permissions_users`;
TRUNCATE TABLE `auth_remember_tokens`;
INSERT INTO `auth_remember_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`, `created_at`, `updated_at`) VALUES
(45, '5801e110a7249fe75d52e6a5', 'd6fbf0e50acff1d1d057b168634551a156e22aaa30f008fd4699d73de62fce55', 2, '2026-06-16 12:40:05', '2026-05-17 12:40:05', '2026-05-17 12:40:05'),
(46, '23521556041e37bddb15f82f', 'ec8c1560000112008de4644c0787bbeb0f8e7490fba8ae76d3ca0771fb13977d', 2, '2026-06-16 15:22:02', '2026-05-17 12:42:38', '2026-05-17 15:22:02'),
(47, 'ed1dec4a3ad6fab5eeca7522', '385630c8eb6b5870a136450652296151dc4497a7d1884667899ca99348f3fc0d', 2, '2026-06-16 13:05:13', '2026-05-17 13:05:13', '2026-05-17 13:05:13');

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
(10, 5, 'Utilitaires Web'),
(11, 5, 'Autres');

TRUNCATE TABLE `header`;
INSERT INTO `header` (`id`, `nom`) VALUES
(1, 'Animés & Mangas'),
(2, 'Films & Séries'),
(3, 'Liens'),
(5, 'Outils');

TRUNCATE TABLE `item`;
INSERT INTO `item` (`id`, `id_user`, `is_public`, `id_division`, `titre`, `status`, `image`, `lien`, `description`, `episode`, `saison`, `position`, `date_sortie`, `deleted_at`) VALUES
(1, 2, 0, 1, 'One Piece', 'En cours', 'https://image.tmdb.org/t/p/w500/l5menwH7JjOBbXjoftYdwMmsqmT.jpg', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1141', 1, 9, NULL, NULL),
(2, 2, 0, 2, 'One Piece', 'Aucun', 'https://www.myutaku.com/media/mangas/12.jpg', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1183', 0, 2, '2026-05-16 18:00:00', NULL),
(4, 2, 0, 1, 'Farming Life in Another World', 'Aucun', 'https://image.tmdb.org/t/p/w500/mE4pE6NOV3AbvTUE3MkFMlfs12n.jpg', 'https://voir-anime.to/anime/isekai-nonbiri-nouka-{s}/isekai-nonbiri-nouka-{s}-{ep2}-vostfr/', 'Alors qu’il tente de sauver de la faillite l’entreprise dans laquelle il travaille, Hiruka Machio, 3...', '1', 2, 6, NULL, NULL),
(5, 2, 0, 1, 'Frieren', 'Aucun', 'https://image.tmdb.org/t/p/w500/j8K7vgF3Kp5T6EwJvez9B4it6CB.jpg', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep2}-vostfr/', 'L’elfe Frieren a vaincu le roi des démons aux côtés du groupe mené par le jeune héros Himmel. Après ...', '3', 2, 7, NULL, NULL),
(6, 2, 0, 1, 'Wind Breaker', 'Aucun', 'https://image.tmdb.org/t/p/w500/cciJ1sSUtbdamdhM01qUqkxgEEf.jpg', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', 'Au lycée Fûrin, on n\'a pas la moyenne, mais on sait se battre ! Cet établissement a le pire taux de ...', '9', 2, 12, NULL, NULL),
(7, 2, 0, 1, 'To Your Eternity', 'Aucun', 'https://image.tmdb.org/t/p/w500/bohMYRVSIG68md0zQobyWbV4S8e.jpg', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', 'Un garçon solitaire errant dans les régions arctiques de l\'Amérique du Nord rencontre un loup. Tous ...', '9', 3, 11, NULL, NULL),
(8, 2, 0, 1, 'Bleach', 'En pause', 'https://www.myutaku.com/media/anime/poster/74796.jpg', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', 'Adolescent de quinze ans, Ichigo Kurosaki possède un don particulier : celui de voir les esprits. Un...', '154', 8, 4, NULL, NULL),
(10, 1, 1, 6, 'VoirAnime', 'Aucun', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdYwTRt_o2nzbUEQuhIf36xoD7DC5rpxP6vg&s', 'https://voir-anime.to/', '', '', 0, 0, NULL, NULL),
(11, 2, 0, 2, 'Chainsaw Man', 'Aucun', 'https://image.tmdb.org/t/p/w500/npdB6eFzizki0WaZ1OvKcJrWe97.jpg', 'https://sushiscan.net/chainsaw-man-chapitre-{ep}/', 'Denji est un adolescent qui vit avec son chien-démon-tronçonneuse, Pochita. À cause d’une énorme det...', '52', 0, 3, NULL, NULL),
(12, 1, 1, 9, 'PapaduStream', 'Aucun', '', 'https://papadustream.motorcycles/', '', '', 0, 0, NULL, NULL),
(13, 1, 1, 9, 'PLR', 'Aucun', NULL, 'https://sites.google.com/view/prl-series/accueil?authuser=0', NULL, NULL, NULL, 0, NULL, NULL),
(14, 1, 1, 6, 'Franime', 'Aucun', 'https://linktr.ee/og/image/franime.jpg', 'https://franime.fr/', '', '', 0, 0, NULL, NULL),
(16, 1, 1, 7, 'Lelmanga', 'Aucun', NULL, 'https://www.lelmanga.com/', NULL, NULL, NULL, 0, NULL, NULL),
(17, 1, 1, 7, 'ScanVf', 'Aucun', NULL, 'https://www.scan-vf.net/', NULL, NULL, NULL, 0, NULL, NULL),
(18, 1, 1, 7, 'Shaeishu', 'Aucun', NULL, 'https://mangamoins.shaeishu.co/', NULL, NULL, NULL, 0, NULL, NULL),
(19, 1, 1, 7, 'Sushiscan', 'Aucun', NULL, 'https://sushiscan.top', NULL, NULL, NULL, 0, NULL, NULL),
(20, 1, 1, 8, 'PLR', 'Aucun', NULL, 'https://sites.google.com/view/teamprl/', NULL, NULL, NULL, 0, NULL, NULL),
(21, 1, 1, 5, 'Wiflix', 'Aucun', 'https://playstorageeaprod.blob.core.windows.net/prod/Logo/2022-08/Wi-Flix%20Logo%20%281%29.png', 'https://flemmix.zip', '', '', 0, 0, NULL, NULL),
(22, 1, 1, 5, 'Netflix', 'Aucun', 'https://images.ctfassets.net/4cd45et68cgf/Rx83JoRDMkYNlMC9MKzcB/2b14d5a59fc3937afd3f03191e19502d/Netflix-Symbol.png?w=700&h=456', 'https://www.netflix.com/browse', '', '', 0, 0, NULL, NULL),
(23, 2, 0, 4, 'The Boys', 'En cours', 'https://image.tmdb.org/t/p/w500/4Tw8TB9ikrcgzJgR0LOvgfnXD74.jpg', 'https://papadustream.motorcycles/cat-series/action-s/2018-the-boys-t-88c/{s}-saison/{ep}-episode.html', 'Lorsque les super-héros abusent de leurs super-pouvoirs au lieu de les utiliser pour faire le bien, ...', '8', 5, 0, NULL, NULL),
(24, 2, 0, 1, 'Noble Reincarnation', 'Aucun', 'https://image.tmdb.org/t/p/w500/ggxUYlw7a3eVegnXDv8aCDiLccJ.jpg', 'https://voir-anime.to/anime/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power-{ep2}-vostfr/', 'En tant que treizième prince de la famille royale, Noah a toujours mené une vie paisible, loin des i...', '2', 1, 8, NULL, NULL),
(25, 1, 1, 10, 'Audio To Text', 'Aucun', NULL, 'https://editor.flixier.com/transcribe?fx_source=search&lang=en&fx_campaign=convert-audio-to-text&fx_medium=tools', 'Convertir les fichiers audio en textes', NULL, NULL, 0, NULL, NULL),
(26, 1, 1, 10, 'Bootstrap Icons', 'Aucun', NULL, 'https://icons.getbootstrap.com', 'Bibliothèque d\'icônes', NULL, NULL, 0, NULL, NULL),
(27, 1, 1, 5, 'Prime Video', 'Aucun', 'https://cdn.prod.website-files.com/63f46dc8ada663b2260ad042/651e7514b3a51ee790163981_Amazon%20-%20Prime%20Video%20(2).jpg', 'https://www.primevideo.com/', '', '', 0, 0, NULL, NULL),
(28, 1, 1, 10, 'Cleanup', 'Aucun', NULL, 'https://cleanup.pictures/', 'Nettoyer des images', NULL, NULL, 0, NULL, NULL),
(29, 1, 1, 10, 'DALL.E', 'Aucun', NULL, 'https://labs.openai.com/', 'Générer des Images', NULL, NULL, 0, NULL, NULL),
(30, 1, 1, 10, 'Durable', 'Aucun', '', 'https://app.durable.co/dashboard', 'Générer des sites web', '', 0, 0, NULL, NULL),
(31, 1, 1, 10, 'Fotor', 'Aucun', NULL, 'https://www.fotor.com/', 'conceptions et éditions d\'images', NULL, NULL, 0, NULL, NULL),
(32, 1, 1, 10, 'Krea.ai', 'Aucun', NULL, 'https://www.krea.ai/apps/image/realtime', 'Générer des Images', NULL, NULL, 0, NULL, NULL),
(33, 1, 1, 10, 'obfuscator', 'Aucun', NULL, 'https://obfuscator.io/', 'crypter les scripts javascripts', NULL, NULL, 0, NULL, NULL),
(34, 2, 0, 1, 'Tsugai - Daemons of the Shadow Realm', 'En cours', 'https://image.tmdb.org/t/p/w500/mNqW2jnAogZa0nJ94q1LUum8Hos.jpg', 'https://voir-anime.to/anime/yomi-no-tsugai/daemons-of-the-shadow-realm-{ep2}-vostfr/', 'Yuru, le chasseur, vit séparé de sa sœur jumelle Asa, enfermée dans une prison pour satisfaire un ri...', '8', 1, 2, '2026-05-24 18:00:00', NULL),
(35, 2, 0, 1, 'Classroom of the Elite', 'En cours', 'https://image.tmdb.org/t/p/w500/mmhx3dImdsfYpcFm3J1tlQt5IRN.jpg', 'https://voir-anime.to/anime/classroom-of-the-elite-{s}/classroom-of-the-elite-{s}-{ep2}-vostfr/', 'Kiyotaka Ayanokôji intègre le prestigieux lycée de haut niveau de Tokyo où, une fois le diplôme en p...', '7', 3, 1, NULL, NULL),
(36, 2, 0, 1, 'Re:ZERO', 'Aucun', 'https://image.tmdb.org/t/p/w500/ccG0ZfXOQ0834bIus4SwZrXtkyM.jpg', 'https://voir-anime.to/anime/rezero-kara-hajimeru-isekai-seikatsu-s{s}/re-zero-kara-hajimeru-isekai-seikatsu-saison-{s}-{ep2}-vostfr/', 'Subaru Natsuki a basculé dans un monde fantastique où il fait la connaissance d’Émilia, une jeune fi...', '1', 3, 10, NULL, NULL),
(37, 2, 0, 1, 'Dr. STONE', 'Aucun', 'https://image.tmdb.org/t/p/w500/dLlnzbDCblBXcJqFLXyvN43NIwp.jpg', 'https://voir-anime.to/anime/dr-stone-{s}-science-future/dr-stone-{s}-{ep2}-vostfr/', 'Plusieurs milliers d\'années après un mystérieux phénomène qui a transformé toute l\'humanité en pierr...', '1', 4, 5, NULL, NULL),
(38, 1, 1, 10, 'Gemini', 'Aucun', '', 'https://gemini.google.com/app?hl=fr', '', '', 0, 0, NULL, NULL),
(39, 2, 0, 11, 'Suivi des comptes', 'Aucun', '', 'https://summury.22web.org/suivi-comptes/index.php', '', '', 0, 0, NULL, NULL),
(40, 2, 0, 2, 'JJK Modulo', 'À voir', '', 'https://www.scan-vf.net/jujutsu-kaisen-modulo/chapitre-{ep}', 'Spin Off de JJK…', '5', 0, 1, NULL, NULL),
(41, 2, 0, 11, 'Intranap Pec', 'Aucun', '', 'https://intranap-pec.22web.org', '', '', 0, 0, NULL, NULL),
(43, 2, 0, 1, 'Les Carnets de l\'apothicaire', 'Aucun', 'https://image.tmdb.org/t/p/w500/47pSay5Ao7SFeyQBZVkW5ifyhAZ.jpg', 'https://voir-anime.to/anime/the-apothecary-diaries/the-apothecary-diaries-{ep2}-vostfr/', 'Formée dès son plus jeune âge par son père apothicaire, Mao Mao est un jour vendue comme servante au...', '1', 1, 3, NULL, NULL),
(46, 2, 0, 1, 'L\'Atelier des Sorciers', 'En cours', 'https://image.tmdb.org/t/p/w500/dH1ZLuGubotqtQbRSCSvYswb3HP.jpg', 'https://voir-anime.to/anime/witch-hat-atelier/witch-hat-atelier-{ep2}-vostfr/', 'Coco a toujours été fascinée par la magie, mais seuls les sorciers la pratiquent à l\'abri des regard...', '3', 1, 0, NULL, NULL);

TRUNCATE TABLE `migrations`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', NULL, NULL, 1, '2026-05-16 16:15:16', '2026-04-11 17:01:15', '2026-05-17 12:39:43', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-05-17 15:22:27', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL),
(3, 'Seiko', NULL, NULL, 1, NULL, '2026-04-30 14:13:09', '2026-05-16 16:16:13', NULL);
COMMIT;
