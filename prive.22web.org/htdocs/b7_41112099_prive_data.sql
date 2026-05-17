SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


TRUNCATE TABLE `categories`;
INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Actrices'),
(2, 'Hentai'),
(3, 'Liens'),
(4, 'Porno');

TRUNCATE TABLE `donnees`;
INSERT INTO `donnees` (`id`, `nom`, `lien`, `idCateg`, `temps`) VALUES
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
(22, 'babe teen maigre baisee par groupe de mecs tres fort', 'https://www.xvideos.com/video.ffeuudf9d1/babe_teen_maigre_baisee_par_groupe_de_mecs_tres_fort', 4, NULL),
(23, 'hookup hotshot', 'https://search.brave.com/images?q=hookup%20hotshot', 4, NULL),
(24, 'Lucky pizza guy orgy reverse', 'https://www.xvideos.com/?k=Lucky+pizza+guy+orgy+reverse', 4, NULL),
(25, 'Kylie Quinn Aime Le Sexe Brut', 'https://fr.pornhub.com/view_video.php?viewkey=ph62213e75691e7', 4, NULL),
(26, 'Tik.Porn', 'https://tik.porn/', 3, NULL),
(27, 'Perversefamily', 'https://mat6tube.com/watch/-201455668_456239897', 3, NULL),
(28, 'Dominatrix Princess', 'https://search.brave.com/search?q=Dominatrix+Princess+Donna+getting+the+fight+fucked+completely+out+of+her.&source=android', 4, NULL),
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
(48, 'Cloe chevalier', 'https://fr.pornhub.com/model/chloe-chevalier', 1, NULL),
(50, 'ArIia Guillard ', 'https://fr.pornhub.com/model/ariia-guillard', 1, NULL),
(51, 'Zadza', 'https://coomer.su/onlyfans/user/zadza.fr', 1, NULL),
(52, 'Dancing bear', 'https://fr.pornhub.com/view_video.php?viewkey=6617c17b03771#1', 4, NULL),
(53, 'Claudia Bavel', 'https://fr.pornhub.com/video/search?search=claudia+bavel', 1, NULL),
(54, 'Perverse Rock Fest', 'https://fra.xhamster.com/videos/perverse-rock-fest-xhpjJ4P', 4, NULL),
(55, 'Squid game vol2', 'https://www.yespornplease.sexy/video/sonya-vibe-sia-siberia-ksu-colt-lesya-moon-squid-game-xxx-parody-vol-2-111314.html', 4, NULL),
(56, 'Squid game vol1', 'https://www.yespornplease.sexy/video/sonya-vibe-sia-siberia-ksu-colt-lesya-moon-squid-game-xxx-parody-vol-1-111313.html', 4, NULL),
(57, 'Squid game vol3', 'https://www.yespornplease.sexy/video/sia-siberia-squid-game-xxx-parody-vol-3-111369.html', 4, NULL),
(58, 'Freeze', 'https://de.pornhub.org/channels/freeze', 3, NULL),
(59, 'Salomé Cllout', 'https://fr.pornhub.com/video/search?search=salome+cllout', 1, NULL),
(60, 'Cutie kim', 'https://fr.xxxi.porn/model/cutie-kim', 1, NULL),
(61, 'Stella lux', 'https://fra.xhamster.com/pornstars/stella-luxx', 1, NULL),
(62, 'Porndude', 'https://theporndude.com/', 3, NULL),
(63, 'Une orgie espagnole avec orgasme', 'https://www.porn300.com/fr/video/une-orgie-espagnole-avec-orgasme/', 4, NULL),
(64, 'J’avais vidéo velo', 'https://www5.javmost.com/SGKI-067/', 4, NULL),
(65, 'Juliette stj', 'https://pimpbunny.com/fr/onlyfans-models/juliette-stj-leaks/', 1, 'Down'),
(66, 'Insta bizarre ', 'https://www.instagram.com/emilyvorina?igsh=MTc2YmFoZTg3cXFjZg==', 3, ''),
(67, 'lacarboni leaks', 'https://www.google.com/search?client=safari&hs=CtGp&sca_esv=35e5eccfaf2e56f5&hl=fr-fr&q=lacarboni+leaks&source=lnms&fbs=ADc_l-bpk8W4E-qsVlOvbGJcDwpnHC5OJXXTJvmMu2n9YYx-G8xzgQk24aW1N_FyIND5zVDd4bb14119C8nZHL5l4Fe3Q78DM888EmtVm1l7Ggrb1T-k21bF25hp3XwCXr-vCPa1y42EX9HYRnPj4sPUhWw0D21yWRp4jrEQ160E-OUHLmawprPjKVPSXhiRMMmoFI6TgWsLLrWi1O-_FSLGob6bIYFMtg&sa=X&ved=2ahUKEwjVtOXylLiSAxVBoScCHeZTGg0Q0pQJegQIDxAB&biw=390&bih=645&dpr=3&aic=0', 1, ''),
(68, 'elsabellucci18', 'https://www.google.com/search?q=elsabellucci18+leaks&client=safari&hs=QtGp&sca_esv=35e5eccfaf2e56f5&hl=fr-fr&udm=2&biw=390&bih=645&aic=0&ei=6zh_ac-fIZSikdUPx46s0QQ&oq=elsabellucci18+leaks&gs_lp=EhJtb2JpbGUtZ3dzLXdpei1pbWciFGVsc2FiZWxsdWNjaTE4IGxlYWtzSI4oUMATWJkkcAB4AJABAZgBbaAB8QKqAQMyLjK4AQPIAQD4AQGYAgCgAgCYAwCIBgGSBwCgB6kCsgcAuAcAwgcAyAcAgAgA&sclient=mobile-gws-wiz-img', 1, ''),
(69, 'Emma Moon', 'https://leakimedia.com/threads/emma-moon.40415/page-2', 1, ''),
(70, 'anastasia_grace21', 'https://www.google.com/search?client=safari&hs=KMx9&sca_esv=30be4ccf2ba70406&hl=fr-fr&q=anastasia_grace21+leaks&source=lnms&fbs=ADc_l-bpk8W4E-qsVlOvbGJcDwpnHC5OJXXTJvmMu2n9YYx-G8xzgQk24aW1N_FyIND5zVDd4bb14119C8nZHL5l4Fe3Q78DM888EmtVm1l7Ggrb1T-k21bF25hp3XwCXr-vCPa1y42EX9HYRnPj4sPUhWw0D21yWRp4jrEQ160E-OUHLmawprPjKVPSXhiRMMmoFI6TgWsLLrWi1O-_FSLGob6bIYFMtg&sa=X&ved=2ahUKEwjrg4Dl5b-SAxWVSFUIHQ0rIOwQ0pQJegQICRAB&biw=390&bih=645&dpr=3&aic=0', 1, ''),
(71, 'Julie D', 'https://www.sxysluts.com/leak/julie-d', 1, ''),
(72, 'zulematorres', 'https://link.me/zulematorres?utm_source=ig&utm_medium=social&utm_content=link_in_bio', 1, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
