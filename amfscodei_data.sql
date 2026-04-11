TRUNCATE `item`;
TRUNCATE `division`;
TRUNCATE `header`;
TRUNCATE `user`;
-- --------------------------------------------------------
-- 1. INSERTION DES UTILISATEURS (Garde tes utilisateurs)
-- --------------------------------------------------------
INSERT INTO `user` (`id`, `login`, `nom`, `prenom`, `author`, `motDePasse`) VALUES
(1, 'admin', 'Doe', 'John', '0', '$2y$10$XVrdOxdWDD6e0F1wJfEFqe6dLLLbr3kDjBhF1tW5D5kYt8QV7JRrW'),
(2, 'user1', 'Smith', 'Alice', '1', '$2y$10$FmMaTj.4Zs1g.dlG54JGUOBLblqhFzUIQv76.wytYgIN2spNT5MZq');

-- --------------------------------------------------------
-- 2. INSERTION DES HEADERS
-- --------------------------------------------------------
INSERT INTO `header` (`id`, `nom`) VALUES
(1, 'Animés & Mangas'),
(2, 'Liens utiles');


-- --------------------------------------------------------
-- 3. INSERTION DES DIVISIONS
-- --------------------------------------------------------
INSERT INTO `division` (`id`, `id_header`, `nom`) VALUES
(1, 1, 'Animés'),
(2, 1, 'Scans / Mangas'),
(3, 2, 'Animés');

-- --------------------------------------------------------
-- 4. INSERTION DES 50 ITEMS AVEC TES VRAIES IMAGES
-- --------------------------------------------------------
INSERT INTO `item` (`id`, `id_user`, `id_division`, `titre`, `lien`, `description`, `episode`, `saison`) VALUES
(1, 1, 1, 'Animé : One Piece', 'https://voir-anime.to/anime/one-piece/one-piece-{ep4}-vostfr/', '', '1141', 1),
(2, 1, 2, 'Manga : One Piece', 'https://www.scan-vf.net/one_piece/chapitre-{ep}', '', '1177', 1),
(4, 1, 1, 'Hell\'s Paradise', 'https://voir-anime.to/anime/jigokuraku-{s}/jigokuraku-{s}-{ep2}-vostfr/', '', '12', 2),
(5, 1, 1, 'Jujutsu Kaisen', 'https://voir-anime.to/anime/jujutsu-kaisen-{s}/jujutsu-kaisen-{s}-{ep2}-vostfr/', '', '12', 3),
(6, 1, 1, 'Farming Life', 'https://voir-anime.to/anime/isekai-nonbiri-nouka-{s}/isekai-nonbiri-nouka-{s}-{ep2}-vostfr/', '', '1', 2),
(7, 1, 1, 'Frieren', 'https://voir-anime.to/anime/sousou-no-frieren-{s}/sousou-no-frieren-{s}-{ep1}-vostfr/', '', '3', 2),
(8, 1, 1, 'Wind Breaker', 'https://voir-anime.to/anime/wind-breaker-{s}/wind-breaker-{s}-{ep2}-vostfr/', '', '9', 2),
(9, 1, 1, 'To Your Eternity', 'https://voir-anime.to/anime/fumetsu-no-anata-e-{s}/fumetsu-no-anata-e-{s}-{ep2}-vostfr/', '', '9', 3),
(10, 1, 1, 'Bleach', 'https://voir-anime.to/anime/bleach/bleach-{ep3}-vostfr/', '', '154', 8),
(11, 1, 2, 'Jujutsu Kaisen', 'https://www.scan-vf.net/jujutsu-kaisen/chapitre-{ep}', '', '175', 1),
(12, 1, 3, 'VoirAnime', 'https://voir-anime.to/', '', '1', 1);
