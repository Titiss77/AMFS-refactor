<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FavorisSeeder extends Seeder
{
    public function run()
    {
        // ------------------------------------
        // Insertion des Catégories (idCateg)
        // ------------------------------------
        $categories = [
            ['nom' => 'Actrices'],
            ['nom' => 'Hentai'],
            ['nom' => 'Liens'],
            ['nom' => 'Porno'],
        ];

        // On utilise insertBatch pour insérer plusieurs lignes d'un coup
        $this->db->table('categories')->ignore(true)->insertBatch($categories);

        // ------------------------------------
        // Insertion des Données (donneesh)
        // ------------------------------------
        $donnees = [
            ['nom' => 'itsxlilix', 'lien' => 'https://fr.pornhub.com/model/itsxlilix', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Dani Fae', 'lien' => 'https://search.brave.com/search?q=Dani+fae+porn&source=android', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Lydia Black', 'lien' => 'https://fr.pornhub.com/video/search?search=lydia+black', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Eden Ivy', 'lien' => 'https://fr.xhamster.com/pornstars/eden-ivy', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'scan hentai', 'lien' => 'https://scan.hentai.menu/', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Tayu Tayu', 'lien' => 'https://hentai.adkami.com/hentai/2140/3/2/2/1/', 'idCateg' => 2, 'temps' => '15:30'],
            ['nom' => 'Last Waltz', 'lien' => 'https://hentai.adkami.com/hentai/4492', 'idCateg' => 2, 'temps' => '07:32'],
            ['nom' => 'Ikumonogakari The Animation', 'lien' => 'https://hentaivost.fr/ikumonogakari-the-animation-01-vostfr/', 'idCateg' => 2, 'temps' => '10:00'],
            ['nom' => 'Gakuen de Jikan yo Tomare', 'lien' => 'https://hentaivost.fr/gakuen-de-jikan-yo-tomare-02-vostfr/', 'idCateg' => 2, 'temps' => '22:00'],
            ['nom' => 'Kuroinu', 'lien' => 'https://hentai.adkami.com/hentai/3009', 'idCateg' => 2, 'temps' => '9:00'],
            ['nom' => 'Toriko no Chigiri', 'lien' => 'https://hentai.adkami.com/hentai/3964', 'idCateg' => 2, 'temps' => '4:20'],
            ['nom' => 'Kyonyuu Fantasy', 'lien' => 'https://hentai.adkami.com/hentai/3389/2/2/2/1/', 'idCateg' => 2, 'temps' => '9:44'],
            ['nom' => 'Isekai Harem Monogatari', 'lien' => 'https://hentai.adkami.com/hentai/3894', 'idCateg' => 2, 'temps' => NULL],
            ['nom' => 'Tsugou no Yoi Sexfriend?', 'lien' => 'https://hentai.adkami.com/hentai/2686', 'idCateg' => 2, 'temps' => NULL],
            ['nom' => 'Baku Ane', 'lien' => 'https://hentai.adkami.com/hentai/2030', 'idCateg' => 2, 'temps' => NULL],
            ['nom' => 'Discipline', 'lien' => 'https://hentai.adkami.com/hentai/2028/2/2/2/1/', 'idCateg' => 2, 'temps' => '16:50'],
            ['nom' => 'Nee, Chanto Shiyou Yo', 'lien' => 'https://hentai-vostfr.tv/nee-chanto-shiyou-yo-02-vostfr/', 'idCateg' => 2, 'temps' => '16:00'],
            ['nom' => 'Ijirare: Fukushuu Saimin', 'lien' => 'https://hentai-vostfr.tv/ijirare-fukushuu-saimin-01-vostfr/', 'idCateg' => 2, 'temps' => '4:00'],
            ['nom' => 'Futa-bu', 'lien' => 'https://hentai-vostfr.tv/futa-bu-02-vostfr/', 'idCateg' => 2, 'temps' => '7:30'],
            ['nom' => 'NocturnaL', 'lien' => 'https://hentai-vostfr.tv/nocturnal-02-raw/', 'idCateg' => 2, 'temps' => '18:20'],
            ['nom' => 'Gangbang Teen', 'lien' => 'https://www.xvideos.com/video.ihualcm0c73/gangbang_teen', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'babe teen maigre baisee par groupe de mecs tres fort', 'lien' => 'https://www.xvideos.com/video.ffeuudf9d1/babe_teen_maigre_baisee_par_groupe_de_mecs_tres_fort', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'hookup hotshot', 'lien' => 'https://search.brave.com/images?q=hookup%20hotshot', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Lucky pizza guy orgy reverse', 'lien' => 'https://www.xvideos.com/?k=Lucky+pizza+guy+orgy+reverse', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Kylie Quinn Aime Le Sexe Brut', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=ph62213e75691e7', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Tik.Porn', 'lien' => 'https://tik.porn/', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Perversefamily', 'lien' => 'https://mat6tube.com/watch/-201455668_456239897', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Dominatrix Princess', 'lien' => 'https://search.brave.com/search?q=Dominatrix+Princess+Donna+getting+the+fight+fucked+completely+out+of+her.&source=android', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Baise La plus Chaude Avec,Giclée, Twerk, éjaculation, Plan à 4', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=ph5b09b29af3318&pkey=33832901', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'AbsoluPorn', 'lien' => 'http://www.absoluporn.com/en/video4-127515.html', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Eden Ivy, jeune et sexy, se fait baiser dans un gangbang par 6 vieux', 'lien' => 'https://fr.xhamster.com/videos/hot-young-eden-ivy-gets-hardcore-fucked-in-gangbang-by-6-old-men-xhRgVcU', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Cum Swapping', 'lien' => 'https://fr.pornhub.com/video/search?search=cum+swapping', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Bi Sex Party 10 - Bridal Shower', 'lien' => 'https://fr.xhamster.com/videos/bi-sex-party-10-bridal-shower-3867753', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Elle se prend 2 bites dans le CUL avec le sourire', 'lien' => 'https://tukif.com/videos/224536/elle-se-prend-2-bites-dans-le-cul-avec-le-sourire.html?tagpos=1855', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Adriana Chechik Sucks off her Fans Ins a FANBLOWBANG', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=ph5adfd11d77135', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'GIRLSRIMMING - Léchage De Cul De MFF Avec Belle-mère Aux Gros Seins Tiffany Rousso et Mignonne Zazie Sky', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=65257754ce1b8', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Voyez-le attaché avec des Pierce Paris, des Chloe Temple, des Valerica Steele', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=642ac879bc3c2', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'FreeUse - Les Demi-soeurs Sont Les Meilleures - Ava Sinclaire et Aften Opal - En Fantasy', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=646cc3f023a03', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Le Bordel: Free Anal & Hardcore Porn Video', 'lien' => 'https://xhamster.com/videos/le-bordel-3941690', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'MILF Mince Séduisante Anya Olsen Utilise SA Chatte Pour Mesurer La Bite De Son Beau-fils et De Son Ami', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=668f0b452d179', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Vidéos porno torrides - France', 'lien' => 'https://fr.pornhub.com/', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Ma chatte adore se faire fourrer tout en absorbant le soleil', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=66291cf4851c9', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Charity Crawford se fait baiser profondément sa chatte jaillissante jusqu’à de multiples orgasmes', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=ph6215879e613b9', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'LUBED Lana Rhoades se fait pilonner par une grosse bite trempée d’huile', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=655d337747b32', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Fais moi ruiner ma chatte avec le plus gros gode J’ai les trois triple bite d’Amigos par Mrhankeystoys', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=ph6310884aec96e', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Sally Dinosaur', 'lien' => 'https://fr.pornhub.com/model/sally-dinosaur', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Bonnie Blue', 'lien' => 'https://fr.pornhub.com/pornstar/bonnie-blue', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Cloe chevalier', 'lien' => 'https://fr.pornhub.com/model/chloe-chevalier', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Instruction Sexuelle et élevage De Belle-mère - Anya Olsen & Ashley Alexander - Thérapie Familiale - Alex Adams', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=669c0385df8eb', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'ArIia Guillard ', 'lien' => 'https://fr.pornhub.com/model/ariia-guillard', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Zadza', 'lien' => 'https://coomer.su/onlyfans/user/zadza.fr', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Dancing bear', 'lien' => 'https://fr.pornhub.com/view_video.php?viewkey=6617c17b03771#1', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Claudia Bavel', 'lien' => 'https://fr.pornhub.com/video/search?search=claudia+bavel', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Perverse Rock Fest', 'lien' => 'https://fra.xhamster.com/videos/perverse-rock-fest-xhpjJ4P', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Squid game vol2', 'lien' => 'https://www.yespornplease.sexy/video/sonya-vibe-sia-siberia-ksu-colt-lesya-moon-squid-game-xxx-parody-vol-2-111314.html', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Squid game vol1', 'lien' => 'https://www.yespornplease.sexy/video/sonya-vibe-sia-siberia-ksu-colt-lesya-moon-squid-game-xxx-parody-vol-1-111313.html', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Squid game vol3', 'lien' => 'https://www.yespornplease.sexy/video/sia-siberia-squid-game-xxx-parody-vol-3-111369.html', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Freeze', 'lien' => 'https://de.pornhub.org/channels/freeze', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Salomé Cllout', 'lien' => 'https://fr.pornhub.com/video/search?search=salome+cllout', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Cutie kim', 'lien' => 'https://fr.xxxi.porn/model/cutie-kim', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Stella lux', 'lien' => 'https://fra.xhamster.com/pornstars/stella-luxx', 'idCateg' => 1, 'temps' => NULL],
            ['nom' => 'Porndude', 'lien' => 'https://theporndude.com/', 'idCateg' => 3, 'temps' => NULL],
            ['nom' => 'Une orgie espagnole avec orgasme', 'lien' => 'https://www.porn300.com/fr/video/une-orgie-espagnole-avec-orgasme/', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'J’avais vidéo velo', 'lien' => 'https://www5.javmost.com/SGKI-067/', 'idCateg' => 4, 'temps' => NULL],
            ['nom' => 'Juliette stj', 'lien' => 'https://pimpbunny.com/fr/onlyfans-models/juliette-stj-leaks/', 'idCateg' => 1, 'temps' => NULL],
        ];

        // Insertion
        $this->db->table('donnees')->ignore(true)->insertBatch($donnees);
    }
}