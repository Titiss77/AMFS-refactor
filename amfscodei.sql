SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `b13_39213320_amfs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `b13_39213320_amfs`;

CREATE TABLE `amfs` (
  `id` int(11) NOT NULL,
  `idUser` int(10) UNSIGNED DEFAULT NULL,
  `idCategorie` int(10) UNSIGNED DEFAULT NULL,
  `libelle` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `lien` text DEFAULT NULL,
  `dateLimite` datetime DEFAULT current_timestamp(),
  `description` text DEFAULT NULL,
  `saison` varchar(255) NOT NULL DEFAULT 'N/A',
  `episode` varchar(10) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `amfs` (`id`, `idUser`, `idCategorie`, `libelle`, `image`, `lien`, `dateLimite`, `description`, `saison`, `episode`) VALUES
(1, 1, 8, '28 ans plus tard', 'https://tse4.mm.bing.net/th/id/OIP.NRRxGGIO7vWD0LLDhYGApQHaE7?pid=Api&P=0&h=180', 'https://uqload.cx/chhmlqktcehh.html', NULL, 'Temps : 21\'56', '1/1', '1/1'),
(2, 1, 8, '28 Jours plus tard', 'https://summury.22web.org/banqueimage/img/amfs/films/28-j-plus-tard.webp', 'https://nightflix{ext}/film/28-jours-plus-tard', NULL, 'Temps : 1h15', '1/1', '1/1'),
(3, 1, 8, 'American Nightmare 2', 'https://summury.22web.org/banqueimage/img/amfs/films/americannightmare2.png', 'https://nightflix{ext}/film/american-nightmare-2', NULL, NULL, '1/1', '1/1'),
(4, 1, 8, 'American Nightmare 3', 'https://summury.22web.org/banqueimage/img/amfs/films/americannightmare3.png', 'https://nightflix{ext}/film/american-nightmare-3-Elections', NULL, NULL, '1/1', '1/1'),
(5, 1, 8, 'American Nightmare 4', 'https://summury.22web.org/banqueimage/img/amfs/films/americannightmare4.png', 'https://nightflix{ext}/film/american-nightmare-4-les-origines', NULL, NULL, '1/1', '1/1'),
(6, 1, 8, 'American Nightmare 5', 'https://summury.22web.org/banqueimage/img/amfs/films/americannightmare5.png', 'https://nightflix{ext}/film/american-nightmare-5-sans-limites', NULL, NULL, '1/1', '1/1'),
(7, 1, 3, 'Anime Sama', 'https://summury.22web.org/banqueimage/img/amfs/utiles/anime_sama.png', 'https://anime-sama.fr/', NULL, NULL, '1/1', '1/1'),
(8, 1, 10, 'a playthrough of a certain dudes', 'https://imgsrv.crunchyroll.com/cdn-cgi/image/fit=contain,format=auto,quality=85,width=1200,height=675/catalog/crunchyroll/44479557b36fceda01ee2977142fc5dd.jpg', 'https://v6.voiranime.com/anime/a-playthrough-of-a-certain-dudes-vrmmo-life/a-playthrough-of-a-certain-dudes-vrmmo-life-{ep}-vostfr/', '2006-07-02 00:00:00', '', '1/1', '6/12'),
(9, 1, 8, 'Arrete moi si tu peux', 'https://summury.22web.org/banqueimage/img/amfs/films/arrete-moi-si-tu-peux.png', 'https://nightflix{ext}/film/arrete-moi-si-tu-peux', NULL, NULL, '1/1', '1/1'),
(10, 1, 5, 'Audio To Text', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/audio_to_text.gif', 'https://editor.flixier.com/transcribe?fx_source=search&lang=en&fx_campaign=convert-audio-to-text&fx_medium=tools', NULL, 'Convertir les fichiers audio en textes', '1/1', '1/1'),
(11, 1, 8, 'Avatar 2', 'https://freakingeek.com/wp-content/uploads/2022/12/Avatar2-Banniere-800x445.jpg', 'https://nightflix{ext}/film/avatar-2', NULL, NULL, '1/1', '1/1'),
(12, 1, 11, 'B: The Beginning', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/b-the-beginning.jpg', 'https://anime-sama.fr/catalogue/b-the-beginning/', NULL, NULL, '1/1', '1/1'),
(13, 1, 8, 'Bad Boys 1', 'https://summury.22web.org/banqueimage/img/amfs/films/bad-boys-1.png', 'https://nightflix{ext}/film/bad-boys', NULL, NULL, '1/1', '1/1'),
(14, 1, 8, 'Bad Boys 2', 'https://summury.22web.org/banqueimage/img/amfs/films/bad-boys-2.png', 'https://nightflix{ext}/film/bad-boys-2', NULL, NULL, '1/1', '1/1'),
(15, 1, 8, 'Bad Boys 3', 'https://summury.22web.org/banqueimage/img/amfs/films/bad-boys-3.png', 'https://nightflix{ext}/film/bad-boys-3', NULL, NULL, '1/1', '1/1'),
(16, 1, 8, 'Bad Boys: Ride or die', 'https://summury.22web.org/banqueimage/img/amfs/films/bad-boys-4.png', 'https://nightflix{ext}/film/bad-boys-ride-or-die', NULL, NULL, '1/1', '1/1'),
(17, 1, 3, 'Bananime', 'https://summury.22web.org/banqueimage/img/amfs/utiles/bananime.png', 'https://bananimes.com/', NULL, NULL, '1/1', '1/1'),
(18, 1, 14, 'Berserk', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/berserk.jpg', 'https://sushiscan.net/berserk-volume', '2024-03-23 00:00:00', NULL, '1/1', '10/1'),
(19, 1, 14, 'Black Clover', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/black-clover.jpg', 'https://sushiscan.fr/black-clover-chapitre-', '2024-01-02 18:30:00', NULL, '1/1', '378/0'),
(20, 1, 12, 'Bleach', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/bleach.jpg', 'https://v6.voiranime.com/anime/bleach/bleach-{ep}-vostfr/', '2020-05-25 07:00:00', '( 2 saisons )', '1/1', '210/366'),
(21, 1, 11, 'Blue Exorcist', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/blue-exorcist.jpg', 'https://v5.voiranime.com/anime/ao-no-exorcist-3-shimane-illuminati-hen/ao-no-exorcist-', '2024-01-13 18:30:00', NULL, '3/3', '11/12'),
(22, 1, 5, 'bootstrap icons', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/bootstrap-icons.png', 'https://icons.getbootstrap.com', NULL, 'Bibliothèque d\'icônes', '1/1', '1/1'),
(23, 1, 12, 'Boruto', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/boruto.jpg', 'https://v5.voiranime.com/anime/boruto-naruto-next-generations/boruto-naruto-next-generations-', '2020-05-25 11:00:00', NULL, '1/1', '110/293'),
(24, 1, 12, 'Blue Period', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/blue-period.jpg', 'https://v5.voiranime.com/anime/blue-period/blue-period-12-vostfr/', '2020-05-25 11:00:00', NULL, '1/1', '12/12'),
(25, 1, 1, 'Canal + FOOT', 'https://alloforfait.fr/wp-content/uploads/2022/09/canal-foot-300x200.jpg', 'https://nightflix{ext}/tv/?play=canal-footx', NULL, NULL, '1/1', '1/1'),
(26, 1, 11, 'a certain scientific accelerator', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/a-certain-scientific-accelerator.jpg', 'https://anime-sama.fr/catalogue/a-certain-scientific-accelerator/', NULL, NULL, '1/1', '1/1'),
(27, 1, 11, 'Classroom of the Elite', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/classroom-of-the-elite.jpg', 'https://v5.voiranime.com/anime/classroom-of-the-elite-3/classroom-of-the-elite-3-', '2024-01-04 18:00:00', NULL, '3/3', '10/13'),
(28, 1, 5, 'Cleanup', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/cleanup.png', 'https://cleanup.pictures/', NULL, 'Nettoyer des images', '1/1', '1/1'),
(29, 1, 5, 'Copilot', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/copilot.png', 'https://www.bing.com/chat?q=Microsoft+Copilot&FORM=hpcodx', NULL, 'Résoudre n\'importe quoi', '1/1', '1/1'),
(30, 1, 6, 'À la croisée des mondes', 'https://summury.22web.org/banqueimage/img/amfs/series/croisee_des_mondes.png', 'https://papadustream{ext}/cat-series/drame-s/2865-his-dark-materials-a-la-croisee-des-mondes-30c/', '2019-06-20 04:00:00', NULL, '1/3', '1/8'),
(31, 1, 5, 'DALL.E', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/dall_e.png', 'https://labs.openai.com/', NULL, 'Générer des Images', '1/1', '1/1'),
(32, 1, 14, 'Dandadan', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/dandadan.jpg', 'https://www.lelmanga.com/dandadan-', '2023-03-31 23:00:00', NULL, '1/1', '89/0'),
(33, 1, 11, 'Dandadan', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/dandadan.jpg', 'https://v5.voiranime.com/anime/dandadan/dandadan-', '2024-10-15 13:38:00', NULL, '1/1', '10/12'),
(34, 1, 14, 'Dragon Ball', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/dragon-ball.jpg', 'https://v5.voiranime.com/anime/dragon-ball/dragon-ball-', '2020-05-25 11:00:00', NULL, '1/1', '10/153'),
(35, 1, 14, 'demon slayer', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/demon-slayer.jpg', 'https://anime-sama.fr/catalogue/demon-slayer/scan/vf/', NULL, 'Dernier lu: 125', '1/1', '1/1'),
(36, 1, 8, 'Divergeante 2', 'https://summury.22web.org/banqueimage/img/amfs/films/divergente-2.png', 'https://nightflix{ext}/film/divergente-2', NULL, 'temps: 01:04:16', '1/1', '1/1'),
(37, 1, 8, 'Divergeante 3', 'https://summury.22web.org/banqueimage/img/amfs/films/divergente-3.png', 'https://nightflix{ext}/film/divergente-3', NULL, NULL, '1/1', '1/1'),
(38, 1, 14, 'dr stone', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/dr-stone.jpg', 'https://anime-sama.fr/catalogue/dr-stone/scan/vf/', '2025-10-14 00:00:00', NULL, '1/1', '116/1'),
(39, 1, 5, 'Durable', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/durable.png', 'https://app.durable.co/dashboard', NULL, 'Générer de site web', '1/1', '1/1'),
(40, 1, 5, 'Fotor', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/fotor.png', 'https://www.fotor.com/', NULL, 'conceptions et éditions d\'images', '1/1', '1/1'),
(41, 1, 8, 'Gladiator 2', 'https://summury.22web.org/banqueimage/img/amfs/films/gladiator2.png', 'https://nightflix{ext}/film/gladiator-2', NULL, NULL, '1/1', '1/1'),
(42, 1, 11, 'Goblin Slayer', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/goblin-slayer.jpg', 'https://v5.voiranime.com/anime/goblin-slayer-ii/goblin-slayer-2-', '2020-05-25 07:00:00', NULL, '2/2', '11/12'),
(43, 1, 6, 'Game of Throne : House of the Dragon', 'https://summury.22web.org/banqueimage/img/amfs/series/got-hd.png', 'https://papadustream{ext}/categorie-series/drame-s/10697-game-of-thrones-house-of-the-dragon/', '2023-12-20 00:00:00', NULL, '1/3', '1/10'),
(44, 1, 5, 'Chat GPT', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/gpt.png', 'https://chat.openai.com/', NULL, 'Résoudre n\'importe quoi', '1/1', '1/1'),
(45, 1, 14, 'hells paradise', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/hells-paradise.jpg', 'https://anime-sama.fr/catalogue/hells-paradise/scan/vf/', '2025-10-14 00:00:00', NULL, '1/1', '47/1'),
(46, 1, 11, 'the hidden dungeon', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/the-hidden-dungeon.jpg', 'https://anime-sama.fr/catalogue/the-hidden-dungeon/', NULL, NULL, '1/1', '1/1'),
(47, 1, 11, 'In Another World with my Smartphone', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/in-another-world-with-my-smartphone.jpg', 'https://v5.voiranime.com/anime/isekai-wa-smartphone-to-tomo-ni/isekai-wa-smartphone-to-tomo-ni-', '2020-05-25 11:00:00', '( 2 saisons )', '1/1', '10/12'),
(48, 1, 11, 'jagaaan', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/jagaaan.jpg', 'https://anime-sama.fr/catalogue/jagaaan/scan/vf/', '2025-10-14 00:00:00', NULL, '1/1', '36/1'),
(49, 1, 14, 'Jujutsu Kaisen', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/jujutsu-kaisen.jpg', 'https://sushiscan.fr/jujutsu-kaisen-chapitre-', '2024-03-23 23:00:00', NULL, '1/1', '148/0'),
(50, 1, 14, 'Kaiju n°8', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/kaiju-n8.jpg', 'https://www.lelmanga.com/kaiju-no-8-', '2023-09-07 17:15:00', NULL, '1/1', '102/0'),
(51, 1, 11, 'Kaiju n°8', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/kaiju-n8.jpg', 'https://v5.voiranime.com/anime/kaiju-no-8/kaiju-no-8-', '2024-05-04 00:00:00', NULL, '1/1', '1/12'),
(52, 1, 11, 'Konosuba', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/konosuba.jpg', 'https://anime-sama.fr/catalogue/konosuba/', NULL, NULL, '1/1', '1/1'),
(53, 1, 5, 'Krea.ai', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/kreaai.png', 'https://www.krea.ai/apps/image/realtime', NULL, 'Générer des Images', '1/1', '1/1'),
(54, 1, 4, 'lelmanga', 'https://summury.22web.org/banqueimage/img/amfs/utiles/lelmanga.png', 'https://www.lelmanga.com/', NULL, NULL, '1/1', '1/1'),
(55, 1, 8, 'Les misérables', 'https://summury.22web.org/banqueimage/img/amfs/films/les-miserables.jpg', 'https://nightflix{ext}/film/les-miserables', NULL, NULL, '1/1', '1/1'),
(56, 1, 8, 'Planète des singes : L\'affrontement', 'https://summury.22web.org/banqueimage/img/amfs/films/lpds-2.png', 'https://nightflix{ext}/film/la-planete-des-singes-l-affrontement', NULL, NULL, '1/1', '1/1'),
(57, 1, 8, 'Planète des singes : Suprématie', 'https://summury.22web.org/banqueimage/img/amfs/films/lpds-3.png', 'https://nightflix{ext}/film/la-planete-des-singes-suprematie', NULL, NULL, '1/1', '1/1'),
(58, 1, 8, 'Planète des singes : Le Nouveau Royaume', 'https://summury.22web.org/banqueimage/img/amfs/films/lpds-4.png', 'https://nightflix{ext}/film/la-planete-des-singes-le-nouveau-royaume', NULL, NULL, '1/1', '1/1'),
(59, 1, 14, 'Mashle', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/mashle.jpg', 'https://anime-sama.fr/catalogue/mashle/scan/vf/', NULL, 'Dernier lu: 38', '1/1', '1/1'),
(61, 1, 13, 'Murim Login', 'https://summury.22web.org/banqueimage/img/amfs/scan/murim-login.png', 'https://legacy-scans.com/manga/murim-login/chapter/', '2024-03-23 19:00:00', NULL, '1/1', '75/1'),
(62, 1, 1, 'Netflix', 'https://summury.22web.org/banqueimage/img/amfs/utiles/netflix.png', 'https://www.netflix.com/', NULL, NULL, '1/1', '1/1'),
(63, 1, 1, 'NightFlix', 'https://summury.22web.org/banqueimage/img/amfs/utiles/nightflix.png', 'https://nightflix.stream/', NULL, NULL, '1/1', '1/1'),
(64, 1, 5, 'obfuscator', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/obfuscator.png', 'https://obfuscator.io/', NULL, 'crypter les scripts javascripts', '1/1', '1/1'),
(65, 1, 10, 'One punch man', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/one-punch-man.jpg', 'https://v6.voiranime.com/anime/one-punch-man-3/one-punch-man-3-{ep}-vostfr/', '2025-11-16 23:59:00', '', '3/3', '6/12'),
(66, 1, 10, 'Animé : One Piece', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/one-piece.jpg', 'https://v6.voiranime.com/anime/one-piece/one-piece-{ep}-vostfr/', '2024-05-03 00:00:00', '', '1/1', '1141/1'),
(67, 1, 13, 'Manga : One piece', 'https://preview.redd.it/z6btu437zgi91.jpg?auto=webp&s=e633b3c45ce542ab88661d0e23db201d00a1b803', 'https://www.scan-vf.net/one_piece/chapitre-1', '2025-12-04 00:00:00', NULL, '1/1', '1168/1'),
(68, 1, 8, 'Oppenheimer', 'https://summury.22web.org/banqueimage/img/amfs/films/oppenheimer.png', 'https://nightflix{ext}/film/oppenheimer', NULL, 'temps: 02:28:00', '1/1', '1/1'),
(69, 1, 5, 'Palette de couleur', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/palette.png', 'https://www.palettedecouleur.net/', NULL, 'répertorie les palettes armonieuses', '1/1', '1/1'),
(70, 1, 2, 'PapaDuStream', 'https://summury.22web.org/banqueimage/img/amfs/utiles/papdustream.png', 'https://papa-adresse.lol/', NULL, NULL, '1/1', '1/1'),
(71, 1, 6, 'Percy Jackson', 'https://summury.22web.org/banqueimage/img/amfs/series/percy-jackson-et-les-olympiens.png', 'https://papadustream.doctor/cat-series/aventure-s/14585-percy-jackson-et-les-olympiens-ff0/1-saison/1-episode.html', '2023-12-20 00:00:00', NULL, '1/1', '6/8'),
(72, 1, 1, 'PLR', 'https://summury.22web.org/banqueimage/img/amfs/utiles/plr.png', 'https://sites.google.com/view/teamprl/', NULL, NULL, '1/1', '1/1'),
(73, 1, 2, 'PLR', 'https://summury.22web.org/banqueimage/img/amfs/utiles/plr.png', 'https://sites.google.com/view/prl-series/accueil?authuser=0', NULL, NULL, '1/1', '1/1'),
(74, 1, 1, 'Prime Video', 'https://summury.22web.org/banqueimage/img/amfs/utiles/prime_video.png', 'https://www.primevideo.com/', NULL, NULL, '1/1', '1/1'),
(75, 1, 14, 'the promised neverland', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/the-promised-neverland.jpg', 'https://anime-sama.fr/catalogue/the-promised-neverland/scan/vf/', NULL, 'Dernier lu: 18', '1/1', '1/1'),
(76, 1, 5, 'Resize Pixel', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/resize.jpg', 'https://www.resizepixel.com/fr', NULL, 'Redimentionner les photos,gif,...', '1/1', '1/1'),
(77, 1, 11, 'Re:Zero', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/re-zero.jpg', 'https://v5.voiranime.com/anime/rezero-kara-hajimeru-isekai-seikatsu/re-zero-kara-hajimeru-isekai-seikatsu-', '2024-06-01 07:00:00', NULL, '1/3', '10/25'),
(78, 1, 14, 'Sakamoto Days', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/sakamoto-days.jpg', 'https://www.lelmanga.com/sakamoto-days-', '2023-04-02 15:30:00', NULL, '1/1', '17/0'),
(79, 1, 8, 'Saw X', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-10.png', 'https://nightflix{ext}/film/saw-x', NULL, NULL, '1/1', '1/1'),
(80, 1, 8, 'Saw II', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-2.png', 'https://nightflix{ext}/film/saw-2', NULL, NULL, '1/1', '1/1'),
(81, 1, 8, 'Saw III', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-3.png', 'https://nightflix{ext}/film/saw-3', NULL, NULL, '1/1', '1/1'),
(82, 1, 8, 'Saw IV', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-4.png', 'https://nightflix{ext}/film/saw-4', NULL, NULL, '1/1', '1/1'),
(83, 1, 8, 'Saw V', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-5.png', 'https://nightflix{ext}/film/saw-5', NULL, NULL, '1/1', '1/1'),
(84, 1, 8, 'Saucisse', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-6.png', 'https://nightflix{ext}/film/saw-6', NULL, NULL, '1/1', '1/1'),
(85, 1, 8, 'Zosette', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-7.png', 'https://nightflix{ext}/film/saw-3d-chapitre-final', NULL, NULL, '1/1', '1/1'),
(86, 1, 8, 'Jigsaw', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-8.png', 'https://nightflix{ext}/film/jigsaw', NULL, NULL, '1/1', '1/1'),
(87, 1, 8, 'Spiral: From the book of Saw', 'https://summury.22web.org/banqueimage/img/amfs/films/saw-9.png', 'https://nightflix{ext}/film/spirale-l-heritage-de-saw', NULL, NULL, '1/1', '1/1'),
(88, 1, 4, 'scan vf', 'https://summury.22web.org/banqueimage/img/amfs/utiles/scan_vf.png', 'https://www.scan-vf.net/', NULL, NULL, '1/1', '1/1'),
(89, 1, 4, 'Shaeishu', 'https://summury.22web.org/banqueimage/img/amfs/utiles/shaeishu.png', 'https://mangamoins.shaeishu.co/', NULL, NULL, '1/1', '1/1'),
(90, 1, 11, 'Spy classroom', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/spy-classroom.jpg', 'https://v6.voiranime.com/anime/spy-kyoushitsu/spy-kyoushitsu-', '2024-01-13 13:30:00', NULL, '1/2', '16/12'),
(91, 1, 11, 'Spy X Family', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/spy-x-family.jpg', 'https://anime-sama.fr/catalogue/spy-x-family/', NULL, NULL, '1/1', '1/1'),
(92, 1, 11, 'steins; Gate', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/steins-gate.jpg', 'https://anime-sama.fr/catalogue/steins-gate', NULL, NULL, '1/1', '1/1'),
(93, 1, 5, 'Suno', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/suno.png', 'https://suno.com/', NULL, 'Créer de la musique', '1/1', '1/1'),
(94, 1, 4, 'sushiscan', 'https://summury.22web.org/banqueimage/img/amfs/utiles/sushiscan.png', 'https://sushiscan.top', NULL, NULL, '1/1', '1/1'),
(95, 1, 11, 'Sword Gai', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/sword-gai-the-animation.jpg', 'https://v5.voiranime.com/anime/sword-gai-the-animation/sword-gai-the-animation-', '2025-04-25 00:00:00', NULL, '1/1', '14/12'),
(96, 1, 8, 'Terrifier 2', 'https://summury.22web.org/banqueimage/img/amfs/films/terrifier.png', 'https://nightflix{ext}/film/terrifier-2', NULL, NULL, '1/1', '1/1'),
(97, 1, 11, 'The Kingdoms of ruin', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/the-kingdoms-of-ruin.jpg', 'https://v5.voiranime.com/anime/hametsu-no-oukoku/the-kingdoms-of-ruin-', '2020-05-25 11:00:00', NULL, '1/1', '19/12'),
(98, 1, 11, 'the rising of the shield hero', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/the-rising-of-the-shield-hero.jpg', 'https://v6.voiranime.com/anime/tate-no-yuusha-no-nariagari-3/tate-no-yuusha-no-nariagari-3-', '2024-01-13 18:30:00', NULL, '3/3', '10/12'),
(99, 1, 6, 'The Witcher', 'https://summury.22web.org/banqueimage/img/amfs/series/the-witcher.png', 'https://www.netflix.com/search?q=the%20witcher&jbv=80189685', '2023-12-20 12:30:00', NULL, '2/4', '10/8'),
(100, 1, 11, 'The Brilliant Healer’s New Life in the Shadows', 'https://summury.22web.org/banqueimage/img/amfs/TheBrilliantHealer.jpeg', 'https://v6.voiranime.com/anime/the-brilliant-healers-new-life-in-the-shadows/the-brilliant-healers-new-life-in-the-shadows-', '2006-07-02 00:00:00', NULL, '1/1', '12/12'),
(101, 1, 6, 'The Walking Dead: Dead City', 'https://summury.22web.org/banqueimage/img/amfs/series/The%20Walking%20Dead:%20Dead%20City.webp', 'https://papadustream.doctor/cat-series/drame-s/13583-the-walking-dead-dead-city-700/1-saison/1-episode.html', '2006-07-02 00:00:00', NULL, '2/2', '1/6'),
(102, 1, 6, 'The Walking Dead : The Ones Who Live', 'https://summury.22web.org/banqueimage/img/amfs/series/The%20Walking%20Dead%20:%20The%20Ones%20Who%20Live.webp', 'https://nightflix{ext}/serie/the-walking-dead-the-ones-who-live', '2030-07-02 00:00:00', NULL, '2/2', '1/6'),
(103, 1, 5, 'Tome AI', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/tome_ai.png', 'https://tome.app/', NULL, 'Générer des PowerPoint', '1/1', '1/1'),
(104, 1, 10, 'To your Eternity', 'https://summury.22web.org/banqueimage/img/amfs/to%20your%20eternity.jpg', 'https://v6.voiranime.com/anime/fumetsu-no-anata-e-3/fumetsu-no-anata-e-3-{ep}-vostfr/', '2025-11-15 23:59:00', '', '3/3', '9/22'),
(105, 1, 11, 'The Promised Neverland', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/the-promised-neverland.jpg', 'https://v5.voiranime.com/anime/yakusoku-no-neverland/yakusoku-no-neverland-the-promised-neverland-', '2020-05-25 11:00:00', '( 2 saisons )', '1/1', '10/12'),
(106, 1, 11, 'Tokyo Revengers', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/tokyo-revengers.jpg', 'https://v5.voiranime.com/anime/tokyo-revengers/tokyo-revengers-nc-', '2020-05-25 11:00:00', '3 saisons', '1/1', '15/24'),
(107, 1, 8, 'Les 3 mousquetaires : Milady', 'https://summury.22web.org/banqueimage/img/amfs/films/troismousquetaires.png', 'https://nightflix{ext}/film/les-trois-mousquetaires-milady', NULL, NULL, '1/1', '1/1'),
(108, 1, 6, 'TWD : Daryl Dixon', 'https://summury.22web.org/banqueimage/img/amfs/series/twd-daryl.png', 'https://papadustream{ext}/cat-series/drame-s/14359-the-walking-dead-daryl-dixon-c1e/', '2020-10-17 13:00:00', 'Lecteur : Filemoon, reste: 30:46', '2/2', '4/6'),
(109, 1, 6, 'Under The Dome', 'https://summury.22web.org/banqueimage/img/amfs/series/under_the_dome.png', 'https://papadustream{ext}/cat-series/drame-s/3163-under-the-dome-457/', '2023-12-20 12:30:00', NULL, '2/3', '8/13'),
(110, 1, 6, 'Vikings', 'https://summury.22web.org/banqueimage/img/amfs/series/viking.jpeg', 'https://papadustream{ext}/cat-series/aventure-s/525-vikings-157/', '2006-07-02 00:00:00', NULL, '5/6', '12/20'),
(111, 1, 10, 'Villainess Level 99', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/villainess-level-99.jpg', 'https://v6.voiranime.com/anime/villainess-level-99/villainess-level-99-{ep}-vostfr/', '2025-10-04 00:00:00', '', '1/1', '10/12'),
(112, 1, 5, 'Voicemy AI', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/voicemy_ai.png', 'https://www.app.voicemy.ai/text-to-speech', NULL, 'Générer des voix', '1/1', '1/1'),
(113, 1, 3, 'Voir Anime', 'https://summury.22web.org/banqueimage/img/amfs/utiles/voir_anime.png', 'https://voiranime.com/', NULL, NULL, '1/1', '1/1'),
(114, 1, 3, 'Vostfree', 'https://summury.22web.org/banqueimage/img/amfs/utiles/vostfree.png', 'https://vostfree.in/', NULL, NULL, '1/1', '1/1'),
(115, 1, 1, 'wiflix', 'https://summury.22web.org/banqueimage/img/amfs/utiles/wiflix.png', 'https://flemmix.zip', NULL, NULL, '1/1', '1/1'),
(116, 1, 10, 'Wind breaker', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/wind-breaker-manga.jpg', 'https://v6.voiranime.com/anime/wind-breaker-2/wind-breaker-2-{ep}-vostfr/', '2025-05-15 00:00:00', '', '2/2', '8/12'),
(117, 1, 5, 'Writesonic', 'https://summury.22web.org/banqueimage/img/amfs/ai_tools/writesonic.png', 'https://app.writesonic.com/fr/', NULL, 'Écrire n\'importe quoi', '1/1', '1/1'),
(118, 1, 11, 'Yofukashi no Uta', 'https://cdn.statically.io/gh/Anime-Sama/IMG/img/contenu/yofukashi-no-uta.jpg', 'https://v5.voiranime.com/anime/yofukashi-no-uta/yofukashi-no-uta-', NULL, NULL, '1/1', '1/1');

CREATE TABLE `categorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `idHeader` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categorie` (`id`, `libelle`, `idHeader`) VALUES
(1, 'Films', 1),
(2, 'Séries', 1),
(3, 'Animés', 1),
(4, 'Scans', 1),
(5, 'Outils', 2),
(6, 'En cours', 3),
(7, 'Envie de voir', 3),
(8, 'Envie de voir', 4),
(9, 'En pause', 4),
(10, 'En cours', 5),
(11, 'Envie de voir', 5),
(12, 'En pause', 5),
(13, 'En cours', 6),
(14, 'Envie de lire', 6),
(15, 'En pause', 6);

CREATE TABLE `cateh` (
  `id` int(6) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `cateh` (`id`, `nom`) VALUES
(1, 'Actrices'),
(2, 'Hentai'),
(3, 'Liens'),
(4, 'Porno');

CREATE TABLE `donneesh` (
  `id` int(6) NOT NULL,
  `nom` text NOT NULL,
  `lien` text NOT NULL,
  `cateH` int(6) NOT NULL,
  `temps` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `donneesh` (`id`, `nom`, `lien`, `cateH`, `temps`) VALUES
(1, 'itsxlilix', 'https://fr.pornhub.com/model/itsxlilix', 1, NULL),
(2, 'Dani Fae', 'https://search.brave.com/search?q=Dani+fae+porn&source=android', 1, NULL),
(3, 'Lydia Black', 'https://fr.pornhub.com/video/search?search=lydia+black', 1, NULL),
(4, 'Eden Ivy', 'https://fr.xhamster.com/pornstars/eden-ivy', 1, NULL),
(5, 'scan hentai', 'https://scan.hentai.menu/', 3, NULL),
(6, 'Tayu Tayu', 'https://hentai.adkami.com/hentai/2140/3/2/2/1/', 2, '15:30'),
(7, 'Last Waltz', 'https://hentai.adkami.com/hentai/4492', 2, '07:32'),
(8, 'Ikumonogakari The Animation', 'https://hentaivost.fr/ikumonogakari-the-animation-01-vostfr/', 2, '10:00'),
(9, 'Gakuen de Jikan yo Tomare', 'https://hentaivost.fr/gakuen-de-jikan-yo-tomare-02-vostfr/', 2, '22:00'),
(10, 'Kuroinu', 'https://hentai.adkami.com/hentai/3009', 2, '9:00'),
(11, 'Toriko no Chigiri', 'https://hentai.adkami.com/hentai/3964', 2, '4:20'),
(12, 'Kyonyuu Fantasy', 'https://hentai.adkami.com/hentai/3389/2/2/2/1/', 2, '9:44'),
(13, 'Isekai Harem Monogatari', 'https://hentai.adkami.com/hentai/3894', 2, NULL),
(14, 'Tsugou no Yoi Sexfriend?', 'https://hentai.adkami.com/hentai/2686', 2, NULL),
(15, 'Baku Ane', 'https://hentai.adkami.com/hentai/2030', 2, NULL),
(16, 'Discipline', 'https://hentai.adkami.com/hentai/2028/2/2/2/1/', 2, '16:50'),
(17, 'Nee, Chanto Shiyou Yo', 'https://hentai-vostfr.tv/nee-chanto-shiyou-yo-02-vostfr/', 2, '16:00'),
(18, 'Ijirare: Fukushuu Saimin', 'https://hentai-vostfr.tv/ijirare-fukushuu-saimin-01-vostfr/', 2, '4:00'),
(19, 'Futa-bu', 'https://hentai-vostfr.tv/futa-bu-02-vostfr/', 2, '7:30'),
(20, 'NocturnaL', 'https://hentai-vostfr.tv/nocturnal-02-raw/', 2, '18:20'),
(21, 'Gangbang Teen', 'https://www.xvideos.com/video.ihualcm0c73/gangbang_teen', 4, NULL),
(22, 'babe teen maigre baisee par groupe de mecs tres fort', 'https://www.xvideos.com/video.ffeuudf9d1/babe_teen_maigre_baisee_par_groupe_de_mecs_tres_fort', 4, NULL),
(23, 'hookup hotshot', 'https://search.brave.com/images?q=hookup%20hotshot', 4, NULL),
(24, 'Lucky pizza guy orgy reverse', 'https://www.xvideos.com/?k=Lucky+pizza+guy+orgy+reverse', 4, NULL),
(25, 'Kylie Quinn Aime Le Sexe Brut', 'https://fr.pornhub.com/view_video.php?viewkey=ph62213e75691e7', 4, NULL),
(26, 'Tik.Porn', 'https://tik.porn/', 3, NULL),
(27, 'Perversefamily', 'https://mat6tube.com/watch/-201455668_456239897', 3, NULL),
(28, 'Dominatrix Princess', 'https://search.brave.com/search?q=Dominatrix+Princess+Donna+getting+the+fight+fucked+completely+out+of+her.&source=android', 4, NULL),
(29, 'Baise La plus Chaude Avec,Giclée, Twerk, éjaculation, Plan à 4', 'https://fr.pornhub.com/view_video.php?viewkey=ph5b09b29af3318&pkey=33832901', 4, NULL),
(30, 'AbsoluPorn', 'http://www.absoluporn.com/en/video4-127515.html', 3, NULL),
(31, 'Eden Ivy, jeune et sexy, se fait baiser dans un gangbang par 6 vieux', 'https://fr.xhamster.com/videos/hot-young-eden-ivy-gets-hardcore-fucked-in-gangbang-by-6-old-men-xhRgVcU', 4, NULL),
(32, 'Cum Swapping', 'https://fr.pornhub.com/video/search?search=cum+swapping', 4, NULL),
(33, 'Bi Sex Party 10 - Bridal Shower', 'https://fr.xhamster.com/videos/bi-sex-party-10-bridal-shower-3867753', 4, NULL),
(34, 'Elle se prend 2 bites dans le CUL avec le sourire', 'https://tukif.com/videos/224536/elle-se-prend-2-bites-dans-le-cul-avec-le-sourire.html?tagpos=1855', 4, NULL),
(35, 'Adriana Chechik Sucks off her Fans Ins a FANBLOWBANG', 'https://fr.pornhub.com/view_video.php?viewkey=ph5adfd11d77135', 4, NULL),
(36, 'GIRLSRIMMING - Léchage De Cul De MFF Avec Belle-mère Aux Gros Seins Tiffany Rousso et Mignonne Zazie Sky', 'https://fr.pornhub.com/view_video.php?viewkey=65257754ce1b8', 4, NULL),
(37, 'Voyez-le attaché avec des Pierce Paris, des Chloe Temple, des Valerica Steele', 'https://fr.pornhub.com/view_video.php?viewkey=642ac879bc3c2', 4, NULL),
(38, 'FreeUse - Les Demi-soeurs Sont Les Meilleures - Ava Sinclaire et Aften Opal - En Fantasy', 'https://fr.pornhub.com/view_video.php?viewkey=646cc3f023a03', 4, NULL),
(39, 'Le Bordel: Free Anal & Hardcore Porn Video', 'https://xhamster.com/videos/le-bordel-3941690', 4, NULL),
(40, 'MILF Mince Séduisante Anya Olsen Utilise SA Chatte Pour Mesurer La Bite De Son Beau-fils et De Son Ami', 'https://fr.pornhub.com/view_video.php?viewkey=668f0b452d179', 4, NULL),
(41, 'Vidéos porno torrides - France', 'https://fr.pornhub.com/', 3, NULL),
(42, 'Ma chatte adore se faire fourrer tout en absorbant le soleil', 'https://fr.pornhub.com/view_video.php?viewkey=66291cf4851c9', 4, NULL),
(43, 'Charity Crawford se fait baiser profondément sa chatte jaillissante jusqu’à de multiples orgasmes', 'https://fr.pornhub.com/view_video.php?viewkey=ph6215879e613b9', 4, NULL),
(44, 'LUBED Lana Rhoades se fait pilonner par une grosse bite trempée d’huile', 'https://fr.pornhub.com/view_video.php?viewkey=655d337747b32', 4, NULL),
(45, 'Fais moi ruiner ma chatte avec le plus gros gode J’ai les trois triple bite d’Amigos par Mrhankeystoys', 'https://fr.pornhub.com/view_video.php?viewkey=ph6310884aec96e', 4, NULL),
(46, 'Sally Dinosaur', 'https://fr.pornhub.com/model/sally-dinosaur', 1, NULL),
(47, 'Bonnie Blue', 'https://fr.pornhub.com/pornstar/bonnie-blue', 1, NULL),
(49, 'Cloe chevalier', 'https://fr.pornhub.com/model/chloe-chevalier', 1, NULL),
(50, 'Instruction Sexuelle et élevage De Belle-mère - Anya Olsen & Ashley Alexander - Thérapie Familiale - Alex Adams', 'https://fr.pornhub.com/view_video.php?viewkey=669c0385df8eb', 4, NULL),
(51, 'ArIia Guillard ', 'https://fr.pornhub.com/model/ariia-guillard', 1, NULL),
(52, 'Zadza', 'https://coomer.su/onlyfans/user/zadza.fr', 1, NULL),
(53, 'Dancing bear', 'https://fr.pornhub.com/view_video.php?viewkey=6617c17b03771#1', 4, NULL),
(54, 'Claudia Bavel', 'https://fr.pornhub.com/video/search?search=claudia+bavel', 1, NULL),
(55, 'Perverse Rock Fest', 'https://fra.xhamster.com/videos/perverse-rock-fest-xhpjJ4P', 4, NULL),
(56, 'Squid game vol2', 'https://www.yespornplease.sexy/video/sonya-vibe-sia-siberia-ksu-colt-lesya-moon-squid-game-xxx-parody-vol-2-111314.html', 4, NULL),
(57, 'Squid game vol1', 'https://www.yespornplease.sexy/video/sonya-vibe-sia-siberia-ksu-colt-lesya-moon-squid-game-xxx-parody-vol-1-111313.html', 4, NULL),
(58, 'Squid game vol3', 'https://www.yespornplease.sexy/video/sia-siberia-squid-game-xxx-parody-vol-3-111369.html', 4, NULL),
(59, 'Freeze', 'https://de.pornhub.org/channels/freeze', 3, NULL),
(60, 'Salomé Cllout', 'https://fr.pornhub.com/video/search?search=salome+cllout', 1, NULL),
(61, 'Cutie kim', 'https://fr.xxxi.porn/model/cutie-kim', 1, NULL),
(62, 'Stella lux', 'https://fra.xhamster.com/pornstars/stella-luxx', 1, NULL),
(63, 'Porndude', 'https://theporndude.com/', 3, NULL),
(64, 'Une orgie espagnole avec orgasme', 'https://www.porn300.com/fr/video/une-orgie-espagnole-avec-orgasme/', 4, NULL),
(65, 'J’avais vidéo velo', 'https://www5.javmost.com/SGKI-067/', 4, NULL),
(66, 'Juliette stj', 'https://pimpbunny.com/fr/onlyfans-models/juliette-stj-leaks/', 1, NULL);

CREATE TABLE `episode_rules` (
  `id` int(11) NOT NULL,
  `site` varchar(100) NOT NULL,
  `url_format` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `episode_rules` (`id`, `site`, `url_format`) VALUES
(1, 'voiranime', '{animeSlug}-{formatEpisode}-vostfr/'),
(2, 'scan-vf.net', 'chapitre-{episode}'),
(3, 'legacy-scans', '{episode}'),
(4, 'lelmanga', '{episode}'),
(5, 'papadustream', '{saison}-saison/{episode}-episode.html'),
(7, 'sushiscan', '{animeSlug}-{episode}/'),
(8, 'bananimes', '{episode}/');

CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `date_evenement` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `evenements` (`id`, `libelle`, `date_evenement`) VALUES
(1, 'Caca', '2025-11-05 17:15:00'),
(2, 'essai', '2025-10-05 17:02:00'),
(3, 'Japon Garance', '2025-08-24 13:40:00');

CREATE TABLE `extention` (
  `id` int(10) UNSIGNED NOT NULL,
  `site` varchar(20) NOT NULL,
  `ext` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `extention` (`id`, `site`, `ext`) VALUES
(1, 'Nightflix', '.world');

CREATE TABLE `fichiers` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `dossier` varchar(255) DEFAULT NULL,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `fichiers` (`id`, `nom`, `chemin`, `dossier`, `date_ajout`) VALUES
(1, 'audio_to_text.gif', 'img/amfs/ai_tools/audio_to_text.gif', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(2, 'bootstrap-icons.png', 'img/amfs/ai_tools/bootstrap-icons.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(4, 'cleanup.png', 'img/amfs/ai_tools/cleanup.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(5, 'copilot.png', 'img/amfs/ai_tools/copilot.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(6, 'dall_e.png', 'img/amfs/ai_tools/dall_e.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(7, 'durable.png', 'img/amfs/ai_tools/durable.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(8, 'fotor.png', 'img/amfs/ai_tools/fotor.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(9, 'kreaai.png', 'img/amfs/ai_tools/kreaai.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(10, 'obfuscator.png', 'img/amfs/ai_tools/obfuscator.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(11, 'palette.png', 'img/amfs/ai_tools/palette.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(12, 'resize.jpg', 'img/amfs/ai_tools/resize.jpg', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(13, 'suno.png', 'img/amfs/ai_tools/suno.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(14, 'tome_ai.png', 'img/amfs/ai_tools/tome_ai.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(15, 'voicemy_ai.png', 'img/amfs/ai_tools/voicemy_ai.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(16, 'writesonic.png', 'img/amfs/ai_tools/writesonic.png', 'amfs/ai_tools', '2025-06-13 06:25:18'),
(17, 'americannightmare1.png', 'img/amfs/films/americannightmare1.png', 'amfs/films', '2025-06-13 06:25:18'),
(18, 'americannightmare2.png', 'img/amfs/films/americannightmare2.png', 'amfs/films', '2025-06-13 06:25:18'),
(19, 'americannightmare3.png', 'img/amfs/films/americannightmare3.png', 'amfs/films', '2025-06-13 06:25:18'),
(20, 'americannightmare4.png', 'img/amfs/films/americannightmare4.png', 'amfs/films', '2025-06-13 06:25:18'),
(21, 'americannightmare5.png', 'img/amfs/films/americannightmare5.png', 'amfs/films', '2025-06-13 06:25:18'),
(22, 'arrete-moi-si-tu-peux.png', 'img/amfs/films/arrete-moi-si-tu-peux.png', 'amfs/films', '2025-06-13 06:25:18'),
(23, 'bad-boys-1.png', 'img/amfs/films/bad-boys-1.png', 'amfs/films', '2025-06-13 06:25:18'),
(24, 'bad-boys-2.png', 'img/amfs/films/bad-boys-2.png', 'amfs/films', '2025-06-13 06:25:18'),
(25, 'bad-boys-3.png', 'img/amfs/films/bad-boys-3.png', 'amfs/films', '2025-06-13 06:25:18'),
(26, 'bad-boys-4.png', 'img/amfs/films/bad-boys-4.png', 'amfs/films', '2025-06-13 06:25:18'),
(27, 'divergente-2.png', 'img/amfs/films/divergente-2.png', 'amfs/films', '2025-06-13 06:25:18'),
(28, 'divergente-3.png', 'img/amfs/films/divergente-3.png', 'amfs/films', '2025-06-13 06:25:18'),
(29, 'fastandfurious.jpg', 'img/amfs/films/fastandfurious.jpg', 'amfs/films', '2025-06-13 06:25:18'),
(30, 'gladiator2.png', 'img/amfs/films/gladiator2.png', 'amfs/films', '2025-06-13 06:25:18'),
(31, 'lpds-2.png', 'img/amfs/films/lpds-2.png', 'amfs/films', '2025-06-13 06:25:18'),
(32, 'lpds-3.png', 'img/amfs/films/lpds-3.png', 'amfs/films', '2025-06-13 06:25:18'),
(33, 'lpds-4.png', 'img/amfs/films/lpds-4.png', 'amfs/films', '2025-06-13 06:25:18'),
(34, 'oppenheimer.png', 'img/amfs/films/oppenheimer.png', 'amfs/films', '2025-06-13 06:25:18'),
(35, 'saw-10.png', 'img/amfs/films/saw-10.png', 'amfs/films', '2025-06-13 06:25:18'),
(36, 'saw-2.png', 'img/amfs/films/saw-2.png', 'amfs/films', '2025-06-13 06:25:18'),
(37, 'saw-3.png', 'img/amfs/films/saw-3.png', 'amfs/films', '2025-06-13 06:25:18'),
(38, 'saw-4.png', 'img/amfs/films/saw-4.png', 'amfs/films', '2025-06-13 06:25:18'),
(39, 'saw-5.png', 'img/amfs/films/saw-5.png', 'amfs/films', '2025-06-13 06:25:18'),
(40, 'saw-6.png', 'img/amfs/films/saw-6.png', 'amfs/films', '2025-06-13 06:25:18'),
(41, 'saw-7.png', 'img/amfs/films/saw-7.png', 'amfs/films', '2025-06-13 06:25:18'),
(42, 'saw-8.png', 'img/amfs/films/saw-8.png', 'amfs/films', '2025-06-13 06:25:18'),
(43, 'saw-9.png', 'img/amfs/films/saw-9.png', 'amfs/films', '2025-06-13 06:25:18'),
(44, 'ted_2.png', 'img/amfs/films/ted_2.png', 'amfs/films', '2025-06-13 06:25:18'),
(45, 'terrifier.png', 'img/amfs/films/terrifier.png', 'amfs/films', '2025-06-13 06:25:18'),
(46, 'troismousquetaires.png', 'img/amfs/films/troismousquetaires.png', 'amfs/films', '2025-06-13 06:25:18'),
(47, 'murim-login.png', 'img/amfs/scan/murim-login.png', 'amfs/scan', '2025-06-13 06:25:18'),
(48, 'croisee_des_mondes.png', 'img/amfs/series/croisee_des_mondes.png', 'amfs/series', '2025-06-13 06:25:18'),
(49, 'got-hd.png', 'img/amfs/series/got-hd.png', 'amfs/series', '2025-06-13 06:25:18'),
(50, 'percy-jackson-et-les-olympiens.png', 'img/amfs/series/percy-jackson-et-les-olympiens.png', 'amfs/series', '2025-06-13 06:25:18'),
(51, 'prisonbreak.png', 'img/amfs/series/prisonbreak.png', 'amfs/series', '2025-06-13 06:25:18'),
(52, 'the-walking-dead.png', 'img/amfs/series/the-walking-dead.png', 'amfs/series', '2025-06-13 06:25:18'),
(53, 'the-witcher.png', 'img/amfs/series/the-witcher.png', 'amfs/series', '2025-06-13 06:25:18'),
(54, 'twd-daryl.png', 'img/amfs/series/twd-daryl.png', 'amfs/series', '2025-06-13 06:25:18'),
(55, 'under_the_dome.png', 'img/amfs/series/under_the_dome.png', 'amfs/series', '2025-06-13 06:25:18'),
(56, 'anime_sama.png', 'img/amfs/utiles/anime_sama.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(57, 'bananime.png', 'img/amfs/utiles/bananime.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(58, 'lelmanga.png', 'img/amfs/utiles/lelmanga.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(59, 'netflix.png', 'img/amfs/utiles/netflix.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(60, 'nightflix.png', 'img/amfs/utiles/nightflix.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(61, 'papdustream.png', 'img/amfs/utiles/papdustream.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(62, 'plr.png', 'img/amfs/utiles/plr.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(63, 'prime_video.png', 'img/amfs/utiles/prime_video.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(64, 'scan_vf.png', 'img/amfs/utiles/scan_vf.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(65, 'shaeishu.png', 'img/amfs/utiles/shaeishu.png', 'amfs/utiles', '2025-06-13 06:25:18'),
(66, 'sushiscan.png', 'img/amfs/utiles/sushiscan.png', 'amfs/utiles', '2025-06-13 06:25:19'),
(67, 'voir_anime.png', 'img/amfs/utiles/voir_anime.png', 'amfs/utiles', '2025-06-13 06:25:19'),
(68, 'vostfree.png', 'img/amfs/utiles/vostfree.png', 'amfs/utiles', '2025-06-13 06:25:19'),
(69, 'bg.png', 'img/bgyicon/bg.png', 'bgyicon', '2025-06-13 06:25:19'),
(108, 'icon.png', 'img/bgyicon/icon.png', 'bgyicon', '2025-07-25 14:26:30'),
(71, 'pec.jpeg', 'img/bgyicon/pec.jpeg', 'bgyicon', '2025-06-13 06:25:19'),
(72, 'cerfrance.png', 'img/cv_num/cerfrance.png', 'cv_num', '2025-06-13 06:25:19'),
(73, 'coder.png', 'img/cv_num/coder.png', 'cv_num', '2025-06-13 06:25:19'),
(74, 'cv-cover.png', 'img/cv_num/cv-cover.png', 'cv_num', '2025-06-13 06:25:19'),
(75, 'ecole.png', 'img/cv_num/ecole.png', 'cv_num', '2025-06-13 06:25:19'),
(76, 'gaming.png', 'img/cv_num/gaming.png', 'cv_num', '2025-06-13 06:25:19'),
(77, 'imprimante.png', 'img/cv_num/imprimante.png', 'cv_num', '2025-06-13 06:25:19'),
(78, 'me.png', 'img/cv_num/me.png', 'cv_num', '2025-06-13 06:25:19'),
(79, 'natation.png', 'img/cv_num/natation.png', 'cv_num', '2025-06-13 06:25:19'),
(80, 'partage_emploi.png', 'img/cv_num/partage_emploi.png', 'cv_num', '2025-06-13 06:25:19'),
(101, 'the-vampire-diaries.jpg', 'img/amfs/series/the-vampire-diaries.jpg', 'amfs/series', '2025-06-16 07:12:45'),
(82, 'snu.png', 'img/cv_num/snu.png', 'cv_num', '2025-06-13 06:25:19'),
(83, 'loading_for_dark.gif', 'img/gif/loading_for_dark.gif', 'gif', '2025-06-13 06:25:19'),
(84, 'loading_for_light.gif', 'img/gif/loading_for_light.gif', 'gif', '2025-06-13 06:25:19'),
(85, 'facebook.svg', 'img/svg/facebook.svg', 'svg', '2025-06-13 06:25:19'),
(86, 'linkedin.svg', 'img/svg/linkedin.svg', 'svg', '2025-06-13 06:25:19'),
(87, 'strava.svg', 'img/svg/strava.svg', 'svg', '2025-06-13 06:25:19'),
(88, 'twitter.svg', 'img/svg/twitter.svg', 'svg', '2025-06-13 06:25:19'),
(89, 'youtube.svg', 'img/svg/youtube.svg', 'svg', '2025-06-13 06:25:19'),
(98, 'gpt.png', 'img/amfs/ai_tools/gpt.png', 'amfs/ai_tools', '2025-06-13 10:37:45'),
(102, 'fastandfurious7.jpg', 'img/amfs/films/fastandfurious7.jpg', 'amfs/films', '2025-06-19 12:40:59'),
(103, 'TheBrilliantHealer.jpeg', 'img/amfs/TheBrilliantHealer.jpeg', 'amfs', '2025-06-26 07:08:25'),
(104, '28-j-plus-tard.webp', 'img/amfs/films/28-j-plus-tard.webp', 'amfs/films', '2025-06-29 14:36:22'),
(105, 'shutterisland.jpg', 'img/amfs/films/shutterisland.jpg', 'amfs/films', '2025-07-20 15:43:52'),
(106, 'wiflix.png', 'img/amfs/utiles/wiflix.png', 'amfs/utiles', '2025-07-23 15:07:09'),
(107, 'usual-suspect.jpg', 'img/amfs/films/usual-suspect.jpg', 'amfs/films', '2025-07-23 15:09:19'),
(109, 'user.png', 'img/bgyicon/user.png', 'bgyicon', '2025-07-26 11:28:07'),
(110, 'squid-game.jpg', 'img/amfs/series/squid-game.jpg', 'amfs/series', '2025-07-27 04:26:09'),
(111, 'The Walking Dead: Dead City.webp', 'img/amfs/series/The Walking Dead: Dead City.webp', 'amfs/series', '2025-07-27 08:57:53'),
(112, 'The Walking Dead : The Ones Who Live.webp', 'img/amfs/series/The Walking Dead : The Ones Who Live.webp', 'amfs/series', '2025-07-27 08:59:26'),
(113, 'les-miserables.jpg', 'img/amfs/films/les-miserables.jpg', 'amfs/films', '2025-08-19 02:26:10'),
(114, 'viking.jpeg', 'img/amfs/series/viking.jpeg', 'amfs/series', '2025-08-19 12:58:23'),
(115, 'to your eternity.jpg', 'img/amfs/to your eternity.jpg', 'amfs', '2025-11-01 09:56:00');

CREATE TABLE `header` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `header` (`id`, `libelle`) VALUES
(1, 'Streaming'),
(2, 'IA'),
(3, 'Séries'),
(4, 'Films'),
(5, 'Animés'),
(6, 'Mangas');

CREATE TABLE `id_div` (
  `id` int(6) NOT NULL,
  `id_header` int(6) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `id_div` (`id`, `id_header`, `nom`) VALUES
(1, 1, 'Animés'),
(2, 6, 'Animés à voir'),
(3, 6, 'Animés en pause'),
(4, 1, 'Scans'),
(5, 2, 'Liens'),
(6, 3, 'Outils'),
(7, 5, 'Films'),
(8, 4, 'Séries'),
(9, 4, 'Séries à voir'),
(10, 4, 'Séries en pause'),
(11, 7, 'Mangas à voir'),
(15, 5, 'American Nightmare'),
(16, 5, 'Saw'),
(17, 5, 'Bad Boys'),
(18, 5, 'La Planète des singes');

CREATE TABLE `jeuxDeReflexe` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `nb_cases` int(11) NOT NULL,
  `record` float NOT NULL DEFAULT 9999,
  `joueur` varchar(50) DEFAULT 'inconnu'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `jeuxDeReflexe` (`id`, `nom`, `nb_cases`, `record`, `joueur`) VALUES
(1, 'Facile', 25, 15.08, 'lina'),
(2, 'Moyen', 50, 30.73, 'lina'),
(3, 'Difficile', 100, 64.26, 'lina'),
(4, 'Très difficile', 150, 96.88, 'lina'),
(5, 'Trop chiant', 200, 131.54, 'lina'),
(6, 'Démon', 666, 561.38, 'lina');

CREATE TABLE `machines` (
  `id` int(6) NOT NULL,
  `nomMachine` varchar(20) NOT NULL,
  `idMuscle` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `machines` (`id`, `nomMachine`, `idMuscle`) VALUES
(1, 'Développé couché', 1),
(2, 'Ecarté à la machine', 1),
(3, 'Developpé épaules à ', 2),
(4, 'Elevations latérales', 2),
(5, 'Leg press', 6),
(6, 'Lec curl', 7),
(7, 'Leg extention', 6),
(8, 'Extention mollets', 9),
(9, 'Extentions à la poul', 3),
(10, 'dips', 3),
(11, 'Tirage vertical', 4),
(12, 'Rowing assis', 4),
(13, 'Hyperextentions', 10),
(14, 'Fentes aux haltères', 8),
(15, 'Squat à la smith', 6);

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2025-08-26-174502', 'App\\Database\\Migrations\\InitialSchema', 'development', 'App', 1771769514, 1),
(3, '2026-02-22-140922', 'App\\Database\\Migrations\\AddPatterns', 'development', 'App', 1771769514, 1);

CREATE TABLE `muscles` (
  `id` int(6) NOT NULL,
  `nomMuscle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `muscles` (`id`, `nomMuscle`) VALUES
(1, 'Pectoraux'),
(2, 'Epaules'),
(3, 'Triceps'),
(4, 'Dos'),
(5, 'Biceps'),
(6, 'Quadri'),
(7, 'Ischio'),
(8, 'Fessiers'),
(9, 'Mollets'),
(10, 'Lombaires');

CREATE TABLE `patterns` (
  `id` int(10) UNSIGNED NOT NULL,
  `domaine` varchar(100) NOT NULL COMMENT 'Partie du lien pour identifier le site (ex: voiranime)',
  `padding` int(11) NOT NULL DEFAULT 2 COMMENT 'Nombre de chiffres (2 pour 01, 3 pour 001, 4 pour 0001)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `patterns` (`id`, `domaine`, `padding`) VALUES
(1, 'voiranime', 2),
(2, 'one-piece', 4),
(3, 'anime-sama', 0);

CREATE TABLE `snakeRecords` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT 'Anonyme',
  `score` int(11) NOT NULL,
  `date_enregistrement` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `snakeRecords` (`id`, `pseudo`, `score`, `date_enregistrement`) VALUES
(4, 'Titiss', 21, '2025-07-25 14:05:47');

CREATE TABLE `statsmachines` (
  `id` int(6) NOT NULL,
  `idMachine` int(6) NOT NULL,
  `methode` enum('puissance','volume','endurance') DEFAULT NULL,
  `poidsSouleve` int(3) NOT NULL,
  `nombreDeReps` int(2) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `statsmachines` (`id`, `idMachine`, `methode`, `poidsSouleve`, `nombreDeReps`, `date`) VALUES
(1, 1, 'volume', 60, 10, '2025-11-04'),
(2, 2, 'volume', 25, 12, '2025-11-04'),
(3, 3, 'volume', 35, 12, '2025-11-02'),
(4, 4, 'volume', 8, 12, '2025-11-02'),
(5, 11, 'volume', 40, 12, '2025-11-02'),
(6, 12, 'volume', 35, 12, '2025-11-02'),
(7, 13, 'volume', 8, 12, '2025-11-02'),
(8, 5, 'puissance', 140, 8, '2025-11-30'),
(9, 7, 'puissance', 65, 8, '2025-11-30'),
(10, 6, 'puissance', 55, 7, '2025-11-30'),
(11, 14, 'puissance', 28, 14, '2025-11-02'),
(12, 8, 'puissance', 55, 10, '2025-11-30'),
(13, 15, 'puissance', 60, 6, '2025-11-30');

CREATE TABLE `themes` (
  `varName` varchar(50) NOT NULL,
  `varValue` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `themes` (`varName`, `varValue`) VALUES
('--bg-body', '#222222'),
('--bg-h-f', '#1f1f1f'),
('--color-text', '#b5b5b5'),
('--color-border', 'gray'),
('--couleur-font-anime', 'linear-gradient(0deg, #222222 0%, #27403F 100%)'),
('--couleur-false', '#a02121'),
('--couleur-btn-anime', 'rgb(45, 82, 142)'),
('--couleur-btn-film', 'rgb(37, 115, 66)'),
('--couleur-btn-serie', 'rgb(109, 67, 152);'),
('--couleur-btn-scan', '#626874'),
('--couleur-btn-all', 'rgb(145, 60, 63)'),
('--box-shadow', 'none'),
('--box-shadow-hover', '7px 7px 7px 0px #90909073'),
('--border-radius', '1rem');

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Identifiant non null et unique',
  `login` varchar(30) NOT NULL COMMENT 'Identifiant de connexion',
  `nom` varchar(30) NOT NULL COMMENT 'Nom du user',
  `prenom` varchar(20) NOT NULL COMMENT 'Prénom du user',
  `author` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0 = admin, 1 = user',
  `dateDeCreation` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `motDePasse` char(255) NOT NULL COMMENT 'Mot de passe haché'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `login`, `nom`, `prenom`, `author`, `dateDeCreation`, `motDePasse`) VALUES
(1, 'admin', 'Doe', 'John', '0', '2026-02-22 15:11:57', '$2y$10$XVrdOxdWDD6e0F1wJfEFqe6dLLLbr3kDjBhF1tW5D5kYt8QV7JRrW'),
(2, 'user1', 'Smith', 'Alice', '1', '2026-02-22 15:11:57', '$2y$10$FmMaTj.4Zs1g.dlG54JGUOBLblqhFzUIQv76.wytYgIN2spNT5MZq'),
(3, 'moderator', 'Garcia', 'Carlos', '2', '2026-02-22 15:11:57', '$2y$10$FmMaTj.4Zs1g.dlG54JGUOBLblqhFzUIQv76.wytYgIN2spNT5MZq');


ALTER TABLE `amfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amfs_idUser_foreign` (`idUser`),
  ADD KEY `amfs_idCategorie_foreign` (`idCategorie`);

ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_idHeader_foreign` (`idHeader`);

ALTER TABLE `cateh`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `donneesh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cateH` (`cateH`);

ALTER TABLE `episode_rules`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `extention`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `id_div`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_header` (`id_header`);

ALTER TABLE `jeuxDeReflexe`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `machines_ibfk_1` (`idMuscle`);

ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `muscles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `patterns`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `snakeRecords`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `statsmachines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMachine` (`idMachine`);

ALTER TABLE `themes`
  ADD PRIMARY KEY (`varName`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `amfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

ALTER TABLE `categorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `cateh`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `donneesh`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

ALTER TABLE `episode_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `extention`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `fichiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

ALTER TABLE `header`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `id_div`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `jeuxDeReflexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `machines`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `muscles`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `patterns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `snakeRecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `statsmachines`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identifiant non null et unique', AUTO_INCREMENT=4;


ALTER TABLE `amfs`
  ADD CONSTRAINT `amfs_idCategorie_foreign` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `amfs_idUser_foreign` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_idHeader_foreign` FOREIGN KEY (`idHeader`) REFERENCES `header` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `donneesh`
  ADD CONSTRAINT `donneesh_ibfk_1` FOREIGN KEY (`cateH`) REFERENCES `cateh` (`id`);

ALTER TABLE `id_div`
  ADD CONSTRAINT `id_div_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `header` (`id`);

ALTER TABLE `machines`
  ADD CONSTRAINT `machines_ibfk_1` FOREIGN KEY (`idMuscle`) REFERENCES `muscles` (`id`);

ALTER TABLE `statsmachines`
  ADD CONSTRAINT `statsmachines_ibfk_1` FOREIGN KEY (`idMachine`) REFERENCES `machines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
