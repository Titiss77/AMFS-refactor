SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

TRUNCATE TABLE `auth_groups_users`;
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2026-04-11 17:01:16'),
(2, 2, 'user', '2026-04-11 17:02:38');

TRUNCATE TABLE `auth_identities`;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'titisland@gmail.com', '$2y$12$fQQGOXUFz0cpRjQv6KEQKunD.NyN.foC2QF30zzcvm47qdRIHtW26', NULL, NULL, 0, '2026-04-27 19:57:20', '2026-04-11 17:01:16', '2026-04-27 19:57:20'),
(2, 2, 'email_password', NULL, 'mathisfrances11@gmail.com', '$2y$12$zqJUMEtVBDWzxe6Orkj2XO9DpI34W94tIIWxude20vrz5wjSaHwKC', NULL, NULL, 0, '2026-04-28 19:05:16', '2026-04-11 17:02:38', '2026-04-28 19:05:16');

TRUNCATE TABLE `auth_logins`;
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '5.49.246.18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mathisfrances11@gmail.com', 2, '2026-04-28 19:05:16', 1);

TRUNCATE TABLE `auth_permissions_users`;
TRUNCATE TABLE `auth_remember_tokens`;
INSERT INTO `auth_remember_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`, `created_at`, `updated_at`) VALUES
(1, '02e0ba918d937397357aeca3', '22b27c1fc81dbd85cc8f5e8af07779d00164964938ad784d3c90c54e38ba1d66', 2, '2026-05-28 18:54:14', '2026-04-28 18:54:14', '2026-04-28 18:54:14'),
(2, 'e88a2977153cc89171e1feeb', '9d9afb5e654ae348ceb0dd7980ef04ba413a844f8a6afacdfe62b88c3193afd9', 2, '2026-05-28 19:05:16', '2026-04-28 19:05:16', '2026-04-28 19:05:16');

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
INSERT INTO `item` (`id`, `id_user`, `is_public`, `id_division`, `titre`, `status`, `image`, `lien`, `description`, `episode`, `saison`, `position`) VALUES
(1, 2, 0, 1, 'One Piece', 'En cours', 'https://image.tmdb.org/t/p/w500/l5menwH7JjOBbXjoftYdwMmsqmT.jpg', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', 'Une aventure en haute mer légendaire et unique en son genre. Monkey D. Luffy est un jeune aventurier...', '1141', 1, 7),
(2, 2, 0, 2, 'One Piece', 'Aucun', 'https://www.myutaku.com/media/mangas/12.jpg', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', 'Sortie : ~ 30 Avril', '1182', 0, 2),
(4, 2, 0, 1, 'Farming Life in Another World', 'Aucun', 'https://image.tmdb.org/t/p/w500/mE4pE6NOV3AbvTUE3MkFMlfs12n.jpg', 'https://voir-anime.to/anime/isekai-nonbiri-nouka-{s}/isekai-nonbiri-nouka-{s}-{ep2}-vostfr/', 'Alors qu’il tente de sauver de la faillite l’entreprise dans laquelle il travaille, Hiruka Machio, 3...', '1', 2, 4),
(5, 2, 0, 1, 'Frieren', 'Aucun', 'https://image.tmdb.org/t/p/w500/j8K7vgF3Kp5T6EwJvez9B4it6CB.jpg', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep2}-vostfr/', 'L’elfe Frieren a vaincu le roi des démons aux côtés du groupe mené par le jeune héros Himmel. Après ...', '3', 2, 5),
(6, 2, 0, 1, 'Wind Breaker', 'Aucun', 'https://image.tmdb.org/t/p/w500/cciJ1sSUtbdamdhM01qUqkxgEEf.jpg', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', 'Au lycée Fûrin, on n\'a pas la moyenne, mais on sait se battre ! Cet établissement a le pire taux de ...', '9', 2, 10),
(7, 2, 0, 1, 'To Your Eternity', 'Aucun', 'https://image.tmdb.org/t/p/w500/bohMYRVSIG68md0zQobyWbV4S8e.jpg', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', 'Un garçon solitaire errant dans les régions arctiques de l\'Amérique du Nord rencontre un loup. Tous ...', '9', 3, 9),
(8, 2, 0, 1, 'Bleach', 'En pause', 'https://www.myutaku.com/media/anime/poster/74796.jpg', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', 'Adolescent de quinze ans, Ichigo Kurosaki possède un don particulier : celui de voir les esprits. Un...', '154', 8, 2),
(9, 2, 0, 2, 'Jujutsu Kaisen', 'En cours', 'https://image.tmdb.org/t/p/w500/w2Shg7bI5WB7LINt1KxB7eihO8s.jpg', 'https://www.scan-vf.net/jujutsu-kaisen/chapitre-{ep}', 'Souffrance, regrets, humiliations... les sentiments négatifs que ressentent les humains se transform...', '266', 0, 0),
(10, 1, 1, 6, 'VoirAnime', 'Aucun', '', 'https://voir-anime.to/', '', '', 0, 0),
(11, 2, 0, 2, 'Chainsaw Man', 'Aucun', 'https://image.tmdb.org/t/p/w500/npdB6eFzizki0WaZ1OvKcJrWe97.jpg', 'https://sushiscan.net/chainsaw-man-chapitre-{ep}/', 'Denji est un adolescent qui vit avec son chien-démon-tronçonneuse, Pochita. À cause d’une énorme det...', '52', 0, 3),
(12, 1, 1, 9, 'PapaduStream', 'Aucun', NULL, 'https://papadustream.singles/', NULL, NULL, NULL, 0),
(13, 1, 1, 9, 'PLR', 'Aucun', NULL, 'https://sites.google.com/view/prl-series/accueil?authuser=0', NULL, NULL, NULL, 0),
(14, 1, 1, 6, 'Franime', 'Aucun', 'https://linktr.ee/og/image/franime.jpg', 'https://franime.fr/', '', '', 0, 0),
(15, 1, 1, 6, 'Vostfree', 'Aucun', '', 'https://vostfree.in/', '', '', 0, 0),
(16, 1, 1, 7, 'Lelmanga', 'Aucun', NULL, 'https://www.lelmanga.com/', NULL, NULL, NULL, 0),
(17, 1, 1, 7, 'ScanVf', 'Aucun', NULL, 'https://www.scan-vf.net/', NULL, NULL, NULL, 0),
(18, 1, 1, 7, 'Shaeishu', 'Aucun', NULL, 'https://mangamoins.shaeishu.co/', NULL, NULL, NULL, 0),
(19, 1, 1, 7, 'Sushiscan', 'Aucun', NULL, 'https://sushiscan.top', NULL, NULL, NULL, 0),
(20, 1, 1, 8, 'PLR', 'Aucun', NULL, 'https://sites.google.com/view/teamprl/', NULL, NULL, NULL, 0),
(21, 1, 1, 5, 'Wiflix', 'Aucun', '', 'https://flemmix.zip', '', '', 0, 0),
(22, 1, 1, 5, 'Netflix', 'Aucun', 'https://images.ctfassets.net/4cd45et68cgf/Rx83JoRDMkYNlMC9MKzcB/2b14d5a59fc3937afd3f03191e19502d/Netflix-Symbol.png?w=700&h=456', 'https://www.netflix.com/browse', '', '', 0, 0),
(23, 2, 1, 4, 'The Boys', 'En cours', 'https://image.tmdb.org/t/p/w500/4Tw8TB9ikrcgzJgR0LOvgfnXD74.jpg', 'https://papadustream.singles/cat-series/action-s/2018-the-boys-t-88c/{s}-saison/{ep}-episode.html', 'Lorsque les super-héros abusent de leurs super-pouvoirs au lieu de les utiliser pour faire le bien, ...', '5', 5, 0),
(24, 2, 0, 1, 'Noble Reincarnation', 'Aucun', 'https://image.tmdb.org/t/p/w500/ggxUYlw7a3eVegnXDv8aCDiLccJ.jpg', 'https://voir-anime.to/anime/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power/noble-reincarnation-born-blessed-so-ill-obtain-ultimate-power-{ep2}-vostfr/', 'En tant que treizième prince de la famille royale, Noah a toujours mené une vie paisible, loin des i...', '2', 1, 6),
(25, 1, 1, 10, 'Audio To Text', 'Aucun', NULL, 'https://editor.flixier.com/transcribe?fx_source=search&lang=en&fx_campaign=convert-audio-to-text&fx_medium=tools', 'Convertir les fichiers audio en textes', NULL, NULL, 0),
(26, 1, 1, 10, 'Bootstrap Icons', 'Aucun', NULL, 'https://icons.getbootstrap.com', 'Bibliothèque d\'icônes', NULL, NULL, 0),
(27, 1, 1, 5, 'Prime Video', 'Aucun', '', 'https://www.primevideo.com/', '', '', 0, 0),
(28, 1, 1, 10, 'Cleanup', 'Aucun', NULL, 'https://cleanup.pictures/', 'Nettoyer des images', NULL, NULL, 0),
(29, 1, 1, 10, 'DALL.E', 'Aucun', NULL, 'https://labs.openai.com/', 'Générer des Images', NULL, NULL, 0),
(30, 1, 1, 10, 'Durable', 'Aucun', NULL, 'https://app.durable.co/dashboard', 'Générer de site web', NULL, NULL, 0),
(31, 1, 1, 10, 'Fotor', 'Aucun', NULL, 'https://www.fotor.com/', 'conceptions et éditions d\'images', NULL, NULL, 0),
(32, 1, 1, 10, 'Krea.ai', 'Aucun', NULL, 'https://www.krea.ai/apps/image/realtime', 'Générer des Images', NULL, NULL, 0),
(33, 1, 1, 10, 'obfuscator', 'Aucun', NULL, 'https://obfuscator.io/', 'crypter les scripts javascripts', NULL, NULL, 0),
(34, 2, 0, 1, 'Tsugai - Daemons of the Shadow Realm', 'Aucun', 'https://image.tmdb.org/t/p/w500/mNqW2jnAogZa0nJ94q1LUum8Hos.jpg', 'https://voir-anime.to/anime/yomi-no-tsugai/daemons-of-the-shadow-realm-{ep2}-vostfr/', 'Sortie : ~ 25 Avril', '4', 1, 1),
(35, 2, 0, 1, 'Classroom of the Elite', 'En pause', 'https://image.tmdb.org/t/p/w500/mmhx3dImdsfYpcFm3J1tlQt5IRN.jpg', 'https://voir-anime.to/anime/classroom-of-the-elite-{s}/classroom-of-the-elite-{s}-{ep2}-vostfr/', 'Kiyotaka Ayanokôji intègre le prestigieux lycée de haut niveau de Tokyo où, une fois le diplôme en p...', '3', 3, 0),
(36, 2, 0, 1, 'Re:ZERO', 'Aucun', 'https://image.tmdb.org/t/p/w500/ccG0ZfXOQ0834bIus4SwZrXtkyM.jpg', 'https://voir-anime.to/anime/rezero-kara-hajimeru-isekai-seikatsu-s{s}/re-zero-kara-hajimeru-isekai-seikatsu-saison-{s}-{ep2}-vostfr/', 'Subaru Natsuki a basculé dans un monde fantastique où il fait la connaissance d’Émilia, une jeune fi...', '1', 3, 8),
(37, 2, 0, 1, 'Dr. STONE', 'Aucun', 'https://image.tmdb.org/t/p/w500/dLlnzbDCblBXcJqFLXyvN43NIwp.jpg', 'https://voir-anime.to/anime/dr-stone-{s}-science-future/dr-stone-{s}-{ep2}-vostfr/', 'Plusieurs milliers d\'années après un mystérieux phénomène qui a transformé toute l\'humanité en pierr...', '1', 4, 3),
(38, 1, 1, 10, 'Gemini', 'Aucun', '', 'https://gemini.google.com/app?hl=fr', '', '', 0, 0),
(39, 2, 0, 11, 'Suivi des comptes', 'Aucun', '', 'https://summury.22web.org/suivi-comptes/index.php', '', '', 0, 0),
(40, 2, 0, 2, 'JJK Modulo', 'À voir', '', 'https://www.scan-vf.net/jujutsu-kaisen-modulo/chapitre-{ep}', 'Spin Off de JJK…', '1', 0, 1),
(41, 2, 0, 11, 'Intranap Pec', 'Aucun', '', 'https://intranap-pec.22web.org', '', '', 0, 0);

TRUNCATE TABLE `migrations`;
TRUNCATE TABLE `settings`;
TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UserFictif', NULL, NULL, 1, '2026-04-14 21:08:36', '2026-04-11 17:01:15', '2026-04-11 17:01:16', NULL),
(2, 'Titiss', NULL, NULL, 1, '2026-04-28 19:19:35', '2026-04-11 17:02:37', '2026-04-11 17:02:38', NULL);
COMMIT;
