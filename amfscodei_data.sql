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
(1, 'Animés & Mangas');


-- --------------------------------------------------------
-- 3. INSERTION DES DIVISIONS
-- --------------------------------------------------------
INSERT INTO `division` (`id`, `id_header`, `nom`) VALUES
(1, 1, 'Animés'),
(2, 1, 'Scans / Mangas');

-- --------------------------------------------------------
-- 4. INSERTION DES 50 ITEMS AVEC TES VRAIES IMAGES
-- --------------------------------------------------------
INSERT INTO `item` (`id`, `id_user`, `id_division`, `titre`, `lien`, `description`, `episode`, `saison`) VALUES
(1, 1, 1, 'Animé : One Piece', 'https://voir-anime.to/anime/one-piece/one-piece-1141-vostfr/', NULL, '1141', '1'),
(2, 1, 2, 'Manga : One Piece', 'https://www.scan-vf.net/one_piece/chapitre-1177', NULL, '1177', '1');
