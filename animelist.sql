-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 25 Avril 2017 à 16:31
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `animelist`
--

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

CREATE TABLE IF NOT EXISTS `anime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `nb_ep` int(11) NOT NULL,
  `nb_oav` tinyint(3) NOT NULL,
  `nb_film` tinyint(3) NOT NULL,
  `note` tinyint(3) NOT NULL,
  `synopsis` text NOT NULL,
  `Auteur` varchar(50) NOT NULL,
  `Studio` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `imglarge` varchar(255) NOT NULL,
  `img_vedette` varchar(255) DEFAULT NULL,
  `watching` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Contenu de la table `anime`
--

INSERT INTO `anime` (`id`, `nom`, `nb_ep`, `nb_oav`, `nb_film`, `note`, `synopsis`, `Auteur`, `Studio`, `img`, `imglarge`, `img_vedette`, `watching`) VALUES
(2, 'Code Geass', 50, 0, 0, 10, 'Nous sommes en 2017. Sept ans se sont &eacute;coul&eacute;s depuis que le Nouvel Empire de Britannia a d&eacute;clar&eacute; la guerre au Japon. Ce dernier, n&rsquo;ayant pu r&eacute;sister aux robots de combat de l&rsquo;Empire (appel&eacute;s Nightmares), est devenu un territoire de l&rsquo;Empire connu sous le nom de Zone 11. Lelouch, jeune &eacute;tudiant qui se joue des nobles, se retrouve un jour impliqu&eacute; dans le vol d&rsquo;une arme chimique, qui s&rsquo;av&egrave;re &ecirc;tre en r&eacute;alit&eacute; une fille. Malheureusement pour lui, les soldats de l&rsquo;Arm&eacute;e Imp&eacute;riale le retrouvent, le prennent pour un terroriste et s&rsquo;appr&ecirc;tent &agrave; le tuer. C&rsquo;est alors que la fille s&rsquo;interpose. Avant de mourir, elle parvient &agrave; accorder &agrave; Lelouch un pouvoir le mettant dans un &eacute;tat second, &agrave; partir duquel il a la possibilit&eacute; de donner un ordre &agrave; quiconque. Un pouvoir qui force l&rsquo;ob&eacute;issance absolue. Que se passera-t-il ? D&rsquo;o&ugrave; vient cette fille ? Qu&rsquo;adviendra-t-il de Lelouch ? Il existe un spin-off, Code Geass Gaiden : Boukoku no Akito.', 'Ookouchi Ichirou, Taniguchi Gorou', 'Sunrise', 'images/Code-Geass.jpg', 'images/codegeasslarge.jpg', NULL, 0),
(3, 'Hunter x Hunter', 148, 0, 2, 10, 'Des monstres redoutables, des cr&eacute;atures rares, des richesses enfouies, des tr&eacute;sors cach&eacute;s, des mondes d&eacute;moniaques, des terres inexplor&eacute;es, le mot &laquo; inconnu &raquo; d&eacute;gage quelque chose de magique, et certaines personnes sont attir&eacute;es par cette force, on les appelle&hellip; les Hunters. Gon est un jeune gar&ccedil;on de douze ans vivant sur l''&icirc;le de la Baleine. Son p&egrave;re l''a abandonn&eacute; et a disparu il y a longtemps pour devenir Hunter. Gon d&eacute;cide donc de quitter son &icirc;le et de passer l''examen des Hunters pour suivre le chemin de son p&egrave;re et peut-&ecirc;tre un jour le retrouver et en savoir plus sur lui. Mais devenir un Hunter officiel n''est pas donn&eacute; &agrave; tout le monde, et les chances de mourir ou d''&eacute;chec sont extr&ecirc;mement &eacute;lev&eacute;es. Il rencontrera sur son chemin Kurapika, L&eacute;olio et Kirua, qui seront ses camarades de route &agrave; travers les diff&eacute;rentes &eacute;tapes et dangers que pr&eacute;sage la vie d''un Hunter.', 'Yoshihiro Togashi', 'Madhouse', 'images/hxh.jpg', 'images/hxhlarge.jpg', NULL, 0),
(4, 'Fate/Zero', 38, 0, 0, 9, 'En qu&ecirc;te du Saint Graal et du miracle qu&rsquo;il promet d&rsquo;exaucer, 7 magiciens (Ma&icirc;tres) ont invoqu&eacute; 7 Esprits-H&eacute;ros (Serviteurs) qui se livrent une lutte sans merci jusqu&rsquo;&agrave; ce qu&rsquo;il n&rsquo;en reste qu&rsquo;un&hellip; C&rsquo;est la Guerre Sainte. Apr&egrave;s 3 guerres sans vainqueur, le combat est sur le point de reprendre pour la 4&egrave;me fois. Les magiciens s&rsquo;empressent de rejoindre Fuyuki, le champ de bataille, chacun priant pour la victoire. Parmi eux cependant, un seul ne semble pas montrer autant de motivation. Son nom, Kirei Kotomine. Ne pouvant se r&eacute;signer &agrave; son destin, Kirei se pose des questions. Pourquoi doit-il endosser ce qu&rsquo;il voit comme une mal&eacute;diction ? Mais un adversaire va lui faire oublier tous ses doutes et le remettre sur le chemin de sa destin&eacute;e. Cet adversaire n&rsquo;est autre que Kiritsugu Emiya. &Eacute;pris d&rsquo;aucune compassion, lui veut le Saint Graal plus violemment que tous les autres. Cette histoire retrace la v&eacute;rit&eacute; sur la Quatri&egrave;me Guerre Sainte qui a eu lieu il y a 10 ans et qui n''avait &eacute;t&eacute; qu''effleur&eacute;e par fragment dans le jeu &agrave; succ&egrave;s &quot;Fate/stay night&quot;. Ici sera r&eacute;v&eacute;l&eacute;e la v&eacute;rit&eacute; sur le combat qui a impliqu&eacute; le p&egrave;re adoptif de Shiro, le p&egrave;re de Rin et le jeune Kirei Kotomine, le h&eacute;ros de l''histoire !', 'Nitroplus &amp; TYPE-MOON', 'ufotable', 'images/fatezero.jpg', 'images/fatezerolarge.jpg', NULL, 0),
(5, 'Fate/Stay Night: Unlimited Blade Works', 37, 1, 0, 9, 'L&rsquo;histoire nous entra&icirc;ne dans le quotidien de Emiya Shiro, un lyc&eacute;en capable d&rsquo;analyser la structure des objets gr&acirc;ce &agrave; la magie. Enfant, Emiya fut t&eacute;moin du d&eacute;nouement tragique d&rsquo;une guerre occulte opposant 7 magiciens et leurs servants (serviteurs) qui d&eacute;truisit son quartier.Recueilli par un magicien, d&eacute;sormais d&eacute;c&eacute;d&eacute;, Emiya est devenu un jeune gar&ccedil;on solitaire capable de r&eacute;parer les objets par instinct et de lancer quelques sorts.Cependant, sa vie bascule quand il fait partie des 7 Magiciens qui doivent s&rsquo;entre-tuer dans la nouvelle Guerre Sainte. C&rsquo;est ainsi qu&rsquo;il rencontre son servant, Saber, une redoutable &eacute;p&eacute;iste.', 'Nasu Kinoko &amp; TYPE-MOON', 'ufotable', 'images/fatestaynight.jpg', 'images/fatestaynightlarge.jpg', NULL, 0),
(21, 'Steins;Gate', 24, 6, 1, 10, 'Dans un quartier d''Otaku &agrave; Akihabara, un groupe d''amis modifient leurs micro-ondes de mani&egrave;re &agrave; en faire un dispositif qui leur permet d''envoyer des messages &eacute;crits vers le pass&eacute;. Une organisation, CERN, a men&eacute; diff&eacute;rentes recherches &agrave; propos des voyages temporels. &Agrave; pr&eacute;sent, le groupe, ayant effectu&eacute; plusieurs exp&eacute;riences diverses, doit absolument &eacute;viter de se faire capturer par cette organisation qui les perturbent en les traquant...', '5pb. &amp; NitroPlus', 'WHITE FOX', 'images/S;G.jpg', 'images/S;Glarge.jpg', NULL, 0),
(22, 'Boku no Hero Academia', 17, 0, 0, 9, 'Super-h&eacute;ros, supers pouvoirs&hellip; On a tous r&ecirc;v&eacute; secr&egrave;tement de poss&eacute;der une qualit&eacute; hors du commun ou d''&ecirc;tre LA personne la plus puissante de l&rsquo;univers. Mais dans un monde o&ugrave; 80% de la population poss&egrave;de un super-pouvoir appel&eacute; alter, les h&eacute;ros font partie de la vie quotidienne. Et les super-vilains aussi ! Face &agrave; eux se dresse l&rsquo;invincible All Might, le plus puissant des h&eacute;ros ! Malheureusement, 20% naissent sans alter. C''est le cas d''Izuku Midoriya, un jeune adolescent de 14 ans, fan absolu d''All Might. Son r&ecirc;ve ? Entrer &agrave; la Hero Academia pour suivre les traces de son idole. Tout va basculer lorsqu''All Might en personne, va choisir Izuku, contre toute attente, pour devenir son successeur. Le r&ecirc;ve peut devenir r&eacute;alit&eacute; ! Mais pour Izuku, le parcours du combattant ne fait que commencer...', 'Horikoshi Kohei', 'Bones', 'images/myheroacademia.jpg', 'images/myheroacademialarge.jpg', 'images/myheroacademiavedette.jpg', 1),
(23, 'Shingeki no Kyojin', 29, 3, 1, 9, 'Dans un monde ravag&eacute; par des titans mangeurs d&rsquo;homme depuis plus d&rsquo;un si&egrave;cle, les rares survivants de l&rsquo;Humanit&eacute; n&rsquo;ont d&rsquo;autre choix pour survivre que de se barricader dans une cit&eacute;-forteresse. Le jeune Eren, t&eacute;moin de la mort de sa m&egrave;re d&eacute;vor&eacute;e par un titan, n&rsquo;a qu&rsquo;un r&ecirc;ve : entrer dans le corps d&rsquo;&eacute;lite charg&eacute; de d&eacute;couvrir l&rsquo;origine des titans, et les annihiler jusqu&rsquo;au dernier&hellip;', 'Isayama Hajime', 'Wit Studio', 'images/snk.jpg', 'images/snklarge.jpg', 'images/snkvedette.jpg', 1),
(25, 'Boruto: Naruto Next Generations', 3, 1, 0, 8, 'Depuis que son p&egrave;re occupe la plus haute fonction du village de Konoha, Boruto Uzumaki, le fils de Nanadaime Hokage et Hinata Hyuga, vit dans l&rsquo;ombre de son p&egrave;re. Cherchant toujours &agrave; attirer l&rsquo;attention de ce dernier, Boruto a pris la ferme r&eacute;solution de surpasser son paternel. Mais la vie que m&egrave;nent les ninjas de haute-vol&eacute;e est rythm&eacute;e par les missions complexes et les entra&icirc;nements rigoureux, notre jeune h&eacute;ros va d&rsquo;ailleurs, apprendre &agrave; ses d&eacute;pens que devenir le meilleur ninja, n&rsquo;est point une t&acirc;che ais&eacute;e. En compagnie de Sarada, l&rsquo;enfant de Sasuke Uchiha et Sakura Haruno, Boruto va d&egrave;s lors d&eacute;couvrir le monde des shinobis, ainsi que ses fondements...', 'Kishimoto Masashi', 'Studio Pierrot', 'images/boruto.jpg', 'images/borutolarge.jpg', NULL, 1),
(26, 'Re:Creators', 3, 0, 0, 7, 'Les humains ont cr&eacute;&eacute; plusieurs histoires. Joie, tristesse, la col&egrave;re, profondes &eacute;motions. Ces histoires qui bouleversent nos &eacute;motions et nous fascinent. Si les personnages de ces histoires avaient leurs propres &eacute;motions et intentions, serions-nous des existences divines p', 'Hiroe Rei &amp; Ei Aoki', 'TROYCA', 'images/recreator.jpg', 'images/recreatorlarge.jpg', 'images/recreator.jpg', 1),
(27, 'Zero Kara Hajimeru Mahou no Sho', 3, 0, 0, 9, 'An 526. Les humains ont d&eacute;sormais conscience que la magie existe et que certaines personnes la pratiquent, mais ils ignorent comment elles proc&egrave;dent. Un jeune mercenaire mi-humain, mi-b&ecirc;te croise un jour la route d''une talentueuse sorci&egrave;re pr&eacute;nomm&eacute;e Zero. Cette derni&egrave;re lui promet de r&eacute;aliser son r&ecirc;ve - redevenir humain - &agrave; la condition qu''il l''aide &agrave; retrouver un puissant grimoire dont elle avait la garde et qui lui a &eacute;t&eacute; d&eacute;rob&eacute;.', 'Kobashiri Kakeru', 'WHITE FOX', 'images/grimoireofzero.jpg', 'images/grimoireofzerolarge.jpg', 'images/grimoireofzero.jpg', 1),
(28, 'DanMachi: Sword Oratoria', 2, 0, 0, 7, 'Ce spin-off se focalise sur Aiz Wallenstein. La princesse &eacute;p&eacute;iste, Aiz Wallenstein. Aujourd''hui, encore une fois, la plus puissante femme &eacute;p&eacute;iste m&egrave;ne son &eacute;quipe durant l''exploration de cet &eacute;norme labyrinthe que l''on appelle : Donjon. Au 5&egrave;me sous-sol du donjon, elle secourt un jeune homme du nom de Bell Cranel qui se fait poursuivre par un minotaure &eacute;chapp&eacute; du 49&egrave;me sous-sol. Cependant, en lui demandant s''il va bien, ce dernier s''enfuit. Ceci est le d&eacute;but d''une histoire entre un homme et une femme que tout s&eacute;pare.', 'Omori Fujino', 'J.C. Staff', 'images/swordoratoria.jpg', 'images/swordoratoria.jpg', NULL, 1),
(29, 'Rokudenashi Majutsu Koushi to Akashic', 3, 0, 0, 7, 'Sistine fr&eacute;quente une &eacute;cole de magie pour am&eacute;liorer ses performances dans l&rsquo;espoir de r&eacute;soudre la fameuse &eacute;nigme du Ch&acirc;teau c&eacute;leste. Mais son professeur favori vient de partir &agrave; la retraite et son rempla&ccedil;ant, Glenn, se r&eacute;v&egrave;le &ecirc;tre paresseux et surtout d&rsquo;une totale incomp&eacute;tence ! Alors, pourquoi cette prestigieuse acad&eacute;mie l&rsquo;a-t-elle recrut&eacute; et le pr&eacute;sente-t-elle comme l&rsquo;un des meilleurs enseignants de son domaine ?', 'Tar&ocirc; Hitsuji', 'LIDEN FILMS', 'images/rokudenashi.jpg', 'images/rokudenashilarge.jpg', 'images/rokudenashi.jpg', 1),
(31, 'Mahō Shōjo Madoka☆Magica', 12, 0, 1, 8, 'Entour&eacute;e de sa famille ador&eacute;e, de ses amies, parfois &agrave; sourire, parfois &agrave; pleurer, une vie ordinaire comme on en voit partout. El&egrave;ve en 4&egrave;me au coll&egrave;ge de Mitakihara, Madoka Kaname coule de tels jours. Mais un jour, elle fait une rencontre myst&eacute;rieuse. Est-ce une co&iuml;ncidence, ou bien la providence ? Elle-m&ecirc;me l''ignore encore. Une rencontre capable de changer le cours de son destin... Le d&eacute;but d''une nouvelle l&eacute;gende des magical girls...', 'MAGICA QUARTET', 'SHAFT &amp; MBS &amp; ANIPLEX', 'images/madoka.jpg', 'images/madokalarge.jpg', NULL, 0),
(32, 'Fullmetal Alchemist : Brotherhood', 64, 0, 0, 10, 'Edward Elric et son fr&egrave;re Alphonse Elric sont de jeunes Alchimistes. En tentant de ramener leur m&egrave;re &agrave; la vie, ils ont pay&eacute; un lourd tribut, et ils tentent d&eacute;sormais de r&eacute;cup&eacute;rer ce qu''ils ont perdu. Pour cela, Edward est devenu Alchimiste d''Etat : le Fullmetal Alchemist. Mais au cours de leurs recherches, bien des &eacute;preuves attendent les deux fr&egrave;res et des &ecirc;tres &eacute;tranges : les Homonculus, les poursuivent.', 'Hiromu Arakawa', 'Bones', 'images/fmab.jpg', 'images/fmablarge.jpg', NULL, 0),
(36, 'Alice to Zouroku', 4, 0, 0, 6, 'Un groupe de jeunes filles poss&egrave;de un myst&eacute;rieux pouvoir appel&eacute; &laquo; r&ecirc;ve d&rsquo;Alice &raquo; qui leur permet de d&eacute;fier les lois de la physique. Cependant, elles vivent confin&eacute;es dans un laboratoire secret afin d&rsquo;&ecirc;tre observ&eacute;es, jusqu&rsquo;au jour o&ugrave; l&rsquo;une d&rsquo;entre elles, Sana, parvient &agrave; s&rsquo;&eacute;chapper. Elle trouve refuge chez un vieil homme bougon, Z&ocirc;roku, dont le quotidien tranquille se trouve &agrave; jamais chamboul&eacute;.', 'Imai Tetsuya', 'J.C. Staff', 'images/alicetozouroku.jpg', 'images/alicetozourokularge.jpg', NULL, 1),
(37, 'Shigatsu wa Kimi no Uso', 22, 1, 0, 9, 'Arima Kosei est un v&eacute;ritable prodige du piano ; enfant, il dominait tous ses rivaux en comp&eacute;tition et s''&eacute;tait d&eacute;j&agrave; fait un nom dans le domaine musical. Mais apr&egrave;s la mort de sa m&egrave;re, il a subit une forte d&eacute;pression qui l''a forc&eacute; &agrave; &ecirc;tre d&eacute;go&ucirc;t&eacute; de son propre instrument. Deux ans apr&egrave;s le drame, continuant de consid&eacute;rer sa vie comme insipide, Arima se contente de vivre sa vie sans r&eacute;el but&hellip; jusqu''&agrave; ce qu''il rencontre Miyazono Kaori, une jeune violoncelliste qui, elle aussi, semble exceller dans son art&hellip;', 'Arakawa Naoshi', 'A-1 Pictures', 'images/shigatsu.jpg', 'images/shigatsularge.jpg', NULL, 0),
(38, 'Bleach', 366, 2, 4, 8, 'Le personnage principal se nomme Ichigo Kurosaki, un adolescent de quinze ans qui vient de rentrer au lyc&eacute;e. Sa particularit&eacute;, outre le fait d''avoir des cheveux orange et d''avoir un go&ucirc;t tr&egrave;s prononc&eacute; pour la bagarre h&eacute;rit&eacute; visiblement de son p&egrave;re, est qu''il peut voir et toucher les morts. R&eacute;guli&egrave;rement, Ichigo rencontre donc des fant&ocirc;mes auxquels il essaie de rendre service. Un soir, un Shinigami (terme d&eacute;signant un &ecirc;tre spirituel et pouvant &ecirc;tre traduit par &laquo; dieu de la mort &raquo;) rentre dans sa chambre. Les Shinigami sont charg&eacute;s de guider les bonnes &acirc;mes (les &laquo; Plus &raquo;) vers le Paradis ou plut&ocirc;t la &laquo; Soul Society &raquo; et d''&eacute;purer les mauvaises &acirc;mes (les &laquo; Hollows &raquo;). Au m&ecirc;me moment, la maison d''Ichigo se fait attaquer par un monstre, un de ces mauvais esprits. Le Shinigami, qui s''appelle Rukia Kuchiki, va tenter de l''an&eacute;antir, en vain. Elle explique &agrave; notre h&eacute;ros que le Hollow en a apr&egrave;s lui car il poss&egrave;de une grande force spirituelle et que, s''il veut se d&eacute;fendre et prot&eacute;ger sa famille, la seule option est qu''elle lui transmette une partie de ses pouvoirs afin qu''il devienne lui-m&ecirc;me un Shinigami. &Agrave; la grande stup&eacute;faction de Rukia, Ichigo h&eacute;rite non pas de la moiti&eacute; de ses pouvoirs, mais de tous. Ichigo, devenu Shinigami &agrave; son tour, est donc pr&ecirc;t &agrave; faire la chasse aux Hollows !', 'Tite Kubo', 'Studio Pierrot', 'images/bleach.jpg', 'images/bleachlarge.jpg', NULL, 0),
(39, 'Katekyo Hitman Reborn !', 203, 1, 0, 8, 'Tsuna est un &eacute;l&egrave;ve plus que m&eacute;diocre. C''est pourquoi, lorsqu''elle trouve dans son courrier la petite annonce d''un professeur particulier, sa m&egrave;re d&eacute;cide de l''engager sur-le-champ pour venir en aide &agrave; son fils. Ce qu''elle ne sait pas, c''est que le professeur particulier, qui se pr&eacute;sente sous le nom de Reborn et qui a l''apparence d''un b&eacute;b&eacute;, n''est autre que le repr&eacute;sentant d''une grande mafia italienne. C''est ainsi que Reborn est envoy&eacute; au Japon pour former le dixi&egrave;me parrain de la famille Vongola&hellip; Et c''est Tsuna qui a &eacute;t&eacute; choisi !', 'AMANO Akira', 'Artland', 'images/reborn.jpg', 'images/rebornlarge.jpg', NULL, 0),
(40, 'Toradora', 25, 5, 0, 8, 'En raison de son regard mena&ccedil;ant h&eacute;rit&eacute; de son p&egrave;re, Takasu Ryuuji est un adolescent craint, car consid&eacute;r&eacute; comme un d&eacute;linquant, par les autres &eacute;l&egrave;ves de son lyc&eacute;e. Cette image &eacute;tant &agrave; l&rsquo;oppos&eacute; de ce qu&rsquo;il est r&eacute;ellement, ce dernier aimerait s&rsquo;en s&eacute;parer d&eacute;finitivement afin de ne plus souffrir des cons&eacute;quences qui en d&eacute;coulent. Ryuuji ne perd pas espoir d&rsquo;y arriver gr&acirc;ce notamment &agrave; son ami Kitamura qui, en plus d&rsquo;avoir vu clair dans cette m&eacute;sentente, lui a permis de rencontrer Kushieda Minori dont il est tomb&eacute; amoureux. Alors qu&rsquo;il pense &agrave; elle, il bouscule par m&eacute;garde Asaika Taiga, une &eacute;l&egrave;ve de sa classe et amie de Minori dont le mauvais caract&egrave;re n&rsquo;a d&rsquo;&eacute;gal que sa force. Suite &agrave; un concours de circonstances, Ryuuji apprendra que Aisaka est sa nouvelle voisine et que cette derni&egrave;re est amoureuse de Kitamura. Se d&eacute;veloppe alors entre les deux une relation ambigu&euml; dans le but de se rapprocher des personnes respectives aim&eacute;es.', 'Takemiya Yuyuko', 'Genco - J.C. Staff', 'images/toradora.jpg', 'images/toradoralarge.jpg', NULL, 0),
(41, 'Guilty Crown', 22, 1, 0, 8, 'Japon 2039. A la suite de l''apparition d''un virus ayant plong&eacute; le pays dans le chaos dix ans plus t&ocirc;t, la population japonaise vit sous le contr&ocirc;le d''une organisation internationale, le GHQ, contre laquelle se battent des groupes de r&eacute;sistants. Lyc&eacute;en ordinaire et jusqu''alors sans histoire, Shu &Ocirc;ma se retrouve soudain entra&icirc;n&eacute; dans leur combat lorsqu''il acquiert un &eacute;trange pouvoir qui lui permet de mat&eacute;rialiser des armes avec le coeur de ses amis...', 'Miyagi Yousuke', 'Production I.G', 'images/guiltycrown.jpg', 'images/guiltycrownlarge.jpg', NULL, 0),
(42, 'Kuroko no basket', 75, 3, 1, 8, 'Le coll&egrave;ge Teiko a vu en son sein se d&eacute;velopper plusieurs &eacute;quipes de basket-ball qui ont su lui conf&eacute;rer une renomm&eacute;e nationale. L''une d''entre elles s''est particuli&egrave;rement d&eacute;marqu&eacute;e gr&acirc;ce aux cinq jeunes prodiges qui la composaient et qui virent leur groupe appel&eacute; la G&eacute;n&eacute;ration des miracles. Toutefois, une rumeur circule concernant la pr&eacute;sence fantomatique d''un sixi&egrave;me joueur reconnu par les cinq prodiges. Alors que l''ann&eacute;e scolaire d&eacute;bute au lyc&eacute;e Seirin, les clubs cherchent &agrave; recruter de nouveaux membres. Le club de basket voit notamment d&eacute;barquer deux recrues inesp&eacute;r&eacute;es : Taiga Kagami, un adolescent au regard incisif ayant pu apprendre le basket &agrave; sa source lors de ses &eacute;tudes en Am&eacute;rique, et Tetsuya Kuroko, le fameux sixi&egrave;me homme de la G&eacute;n&eacute;ration des miracles. Bien qu''au commencement les deux futurs partenaires cherchent &agrave; &eacute;valuer leurs capacit&eacute;s respectives, l''alchimie s''op&egrave;re entre eux, leur permettant de former alors un duo explosif qui verra t&ocirc;t ou tard les cinq autres prodiges de la G&eacute;n&eacute;ration des miracles se dresser sur leur route.', 'FUJIMAKI TADATOSHI', 'PRODUCTION I.G', 'images/kuroko.jpg', 'images/kurokolarge.jpg', NULL, 0),
(43, 'Psycho-pass', 33, 0, 1, 8, 'Dans un avenir proche, afin de minimiser les crimes, le gouvernement a mis en place le syst&egrave;me Sybil, qui permet de scanner r&eacute;guli&egrave;rement l''&eacute;tat nerveux, appel&eacute; Psycho-Pass, de n''importe quel &ecirc;tre humain. Au sein du d&eacute;partement de la s&eacute;curit&eacute; publique, une section d''investigation criminelle particuli&egrave;re a ainsi vu le jour et est charg&eacute;e d''appr&eacute;hender toute personne jug&eacute;e potentiellement dangereuse par Sybil. Sortie premi&egrave;re de sa promotion, la jeune Akane Tsunemori rejoint les rangs du CID en tant qu''inspectrice et se voit d&egrave;s le d&eacute;part envoy&eacute;e sur le terrain pour une mission d''arrestation. &Eacute;paul&eacute;e au fil de ses enqu&ecirc;tes par des criminels latents qui ont pr&eacute;f&eacute;r&eacute; &ecirc;tre musel&eacute;s par le gouvernement plut&ocirc;t que d''&ecirc;tre en cellule d''isolement, Akane va d&eacute;couvrir des failles dans le syst&egrave;me Sybil et mettre en doute la l&eacute;gitimit&eacute; d''une utilisation aveugl&eacute;e de ce dernier.', 'MOTOHIRO KATSUYUKI', 'Production I.G.', 'images/psychopass.jpg', 'images/psychopasslarge.jpg', NULL, 0),
(44, 'Nisekoi', 32, 5, 0, 9, 'L&rsquo;histoire nous entra&icirc;ne dans la rivalit&eacute; de 2 familles criminelles.Raku Ichijo est le fils d&rsquo;un chef Yakuza et Chitoge Kirisaki est la fille d&rsquo;un chef de Gang. Le seul moyen d&rsquo;&eacute;viter la guerre est que leurs enfants sortent ensemble.Malheureusement, les 2 lyc&eacute;ens ne se supportent pas en classe.Mais conscients de l&rsquo;enjeu, Raku et Chitoge vont faire semblant de s&rsquo;appr&eacute;cier aux yeux de leur famille pour &eacute;viter toute guerre.', 'Akiyuki Shinbo', 'SHAFT', 'images/nisekoi.jpg', 'images/nisekoilarge.jpg', NULL, 0),
(45, 'Nanatsu no Taizai', 24, 2, 0, 9, 'Les Seven Deadly Sins (=Sept p&eacute;ch&eacute;s capitaux), un groupe de chevaliers mal&eacute;fiques qui ont conspir&eacute; pour renverser le Royaume de Britannia, auraient &eacute;t&eacute; &eacute;radiqu&eacute;s par les Holy Knights. Mais des rumeurs pr&eacute;tendent qu&rsquo;ils auraient surv&eacute;cu&hellip; 10 ans plus tard, les Holy Knights ont organis&eacute; un coup d&rsquo;&Eacute;tat et l&rsquo;assassinat du roi, devenant les nouveaux dirigeants tyranniques du Royaume.Elizabeth, la fille du roi, s&rsquo;&eacute;chappe et se r&eacute;fugie dans une taverne tenu par le jeune Meliodas. Derri&egrave;re son air candide, Meliodas s&rsquo;av&egrave;re &ecirc;tre un redoutable guerrier.Ensemble, ils se lancent dans un voyage afin de trouver les Seven Deadly Sins, et obtenir leur aide pour reprendre le Royaume.', 'Suzuki Nakaba', 'A-1 Pictures', 'images/nanatsu.jpg', 'images/nanatsularge.jpg', NULL, 0),
(46, 'One Punch-Man', 12, 7, 0, 8, 'Saitama est un homme tout ce qu''il y a de plus banal, du moins, en apparence. En effet, malgr&eacute; sa carrure, plut&ocirc;t fr&ecirc;le, c''est un super-h&eacute;ros redoutablement efficace puisqu''il terrasse tous ses ennemis en un seul coup ! Malheureusement, cette puissance colossale est un probl&egrave;me pour Saitama, qui s''ennuie, et cherche d&eacute;sesp&eacute;r&eacute;ment un adversaire &agrave; sa mesure.', 'ONE', 'Madhouse Studios', 'images/onepunchman.jpg', 'images/onepunchmanlarge.jpg', NULL, 0),
(47, 'Re:Zero kara Hajimeru Isekai Seikatsu', 25, 25, 0, 8, 'Subaru Natsuki est un lyc&eacute;en comme les autres qui se retrouve un jour perdu dans un monde alternatif. Alors qu''il se trouve en danger, une belle fille aux cheveux argent&eacute;s fait son apparition pour le sauver. Il d&eacute;cide de rester avec elle afin de ne rien lui devoir. Tous deux se retrouvent malheureusement tu&eacute;s lors d''une attaque ennemie... Il se r&eacute;veille un peu plus tard &agrave; l''endroit o&ugrave; il est arriv&eacute; dans ce monde fantastique. Il comprend alors qu''il a le pouvoir de remonter le temps, mais lui seul se souviens de ce qu''il s''est pass&eacute; avant sa mort. Notre h&eacute;ros r&eacute;ussira-t-il &agrave; changer le cours des &eacute;v&eacute;nements ?', 'Nagatsuki Tappei', 'White Fox', 'images/rezero.jpg', 'images/rezerolarge.jpg', NULL, 0),
(48, 'Naruto', 220, 0, 0, 8, 'L''histoire commence dans le village cach&eacute; de Konoha, o&ugrave; vit Naruto Uzumaki, le pire garnement de l''ordre des ninjas ! Cependant, un grand secret plane autour de lui : douze ans auparavant, le puissant d&eacute;mon Ky&ucirc;bi, un d&eacute;mon-renard &agrave; neuf queues, d&eacute;vastait des for&ecirc;ts et des villages, puis fut emprisonn&eacute; par le quatri&egrave;me Hokage dans le corps de Naruto alors qu''il n''&eacute;tait qu''un b&eacute;b&eacute;. Celui-ci souhaite devenir le plus grand des Hokage&hellip;', 'CHIBA MICHINORI ; CHIBA TAKA', 'STUDIO PIERROT', 'images/naruto.jpg', 'images/narutolarge.jpg', NULL, 0),
(49, 'Naruto Shippuden', 500, 12, 8, 9, 'Naruto de retour &agrave; Konoha trois ans apr&egrave;s son voyage d''entra&icirc;nement avec Jiraiya. Konoha n''a pas chang&eacute;, enfin presque. Notre cher h&eacute;ros retrouve une Sakura bien plus forte, un Kakashi toujours fid&egrave;le &agrave; lui-m&ecirc;me, et des compagnons qui n''ont pas l''air d''avoir ch&ocirc;m&eacute; ces trois derni&egrave;res ann&eacute;es, mais les retrouvailles seront de courte dur&eacute;e... Akatsuki reprend aussi du service et, qui plus est, a l''air de sortir les grands moyens pour ex&eacute;cuter ses plans. Naruto et les autres &eacute;quipes sont d&eacute;p&ecirc;ch&eacute;s pour les contrer, un bon moyen pour voir les r&eacute;sultats d''entra&icirc;nement de tous. Tout au long des ses aventures, Naruto devra faire face &agrave; divers p&eacute;riples et choix bien plus difficiles qu''auparavant. Il devra fournir plus d''efforts et changer d''attitude pour prot&eacute;ger ses amis et surtout esp&eacute;rer ramener Sasuke...', 'Kishimoto Masashi', 'Studio Pierrot', 'images/narutoshippuden.jpg', 'images/narutoshippudenlarge.jpg', NULL, 0),
(50, 'Deadman Wonderland', 12, 1, 0, 8, 'Un puissant s&eacute;isme a ravag&eacute; la partie continentale du Japon et a d&eacute;truit en grande partie Tokyo, provoquant l''immersion des trois quarts de la ville dans l''oc&eacute;an. Dix ans plus tard, l''histoire se centre sur Ganta Igarashi, un &eacute;tudiant apparemment ordinaire qui fr&eacute;quente le coll&egrave;ge de la pr&eacute;fecture de Nagano. Bien que survivant du tremblement de terre, Ganta n''a aucun souvenir de la trag&eacute;die et a v&eacute;cu une vie ordinaire. Tout cela change quand un homme &eacute;trange couvert de sang et portant une armure pourpre flotte devant les fen&ecirc;tres de la classe. Souriant comme un fou, l''Homme en Rouge massacre toute la classe de Ganta et, plut&ocirc;t que de le tuer, lui incruste un &eacute;clat de cristal rouge dans la poitrine. Quelques jours apr&egrave;s le massacre, Ganta est d&eacute;clar&eacute; l''unique suspect et, apr&egrave;s un proc&egrave;s rapide, est condamn&eacute; &agrave; la prison &agrave; vie dans Deadman Wonderland, une prison doubl&eacute;e d''un parc d''attraction.', 'Kazuma Kondou ; Jinsei Kataoka', 'Manglobe', 'images/deadmanwonderland.jpg', 'images/deadmanwonderlandlarge.jpg', NULL, 0),
(100, 'To Aru Majutsu no Index', 48, 3, 1, 7, 'T&ocirc;ma est victime d&rsquo;une mauvaise blague jou&eacute;e par le destin : il dispose d&rsquo;un don extraordinaire, celui d&rsquo;annuler tout pouvoir surnaturel. Mais dans la Cit&eacute; Scolaire, la ville fourmillante d&rsquo;&eacute;tudiants en sciences occultes o&ugrave; il vit, cette capacit&eacute; pourtant incroyable ne lui attire aucune estime. Comble de l&rsquo;ironie, &agrave; chaque fois qu&rsquo;il utilise son pouvoir, une terrible malchance s&rsquo;acharne sur lui ! C&rsquo;est peut-&ecirc;tre cette mal&eacute;diction qui lui fait croiser le chemin d&rsquo;Index, une jeune nonne poursuivie par d&rsquo;inqui&eacute;tants magiciens. Index a m&eacute;moris&eacute; 103 000 ouvrages de sorcellerie interdits pour le compte de l&rsquo;&Eacute;glise. Fragilis&eacute;e sans le savoir par les secrets qu&rsquo;elle abrite, la jeune fille est sur le point de voir se refermer sur elle un pi&egrave;ge mortel. Science ou magie, qui l&rsquo;emportera ? Il existe un anime spin-off intitul&eacute; To Aru Kagaku no Railgun.', 'Haimura Kiyotaka, Kamachi Kazuma', 'J.c. Staff', 'images/toarumajutsu.jpg', 'images/toarumajutsularge.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `anime_genre`
--

CREATE TABLE IF NOT EXISTS `anime_genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anime_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anime_id` (`anime_id`),
  KEY `genre_id` (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=189 ;

--
-- Contenu de la table `anime_genre`
--

INSERT INTO `anime_genre` (`id`, `anime_id`, `genre_id`) VALUES
(5, 2, 1),
(6, 2, 6),
(7, 2, 7),
(8, 2, 12),
(9, 3, 1),
(10, 3, 2),
(11, 3, 4),
(12, 3, 7),
(13, 3, 12),
(16, 4, 4),
(17, 4, 7),
(18, 4, 12),
(19, 4, 1),
(25, 5, 1),
(26, 5, 3),
(27, 5, 4),
(28, 5, 7),
(29, 5, 12),
(41, 22, 1),
(42, 22, 4),
(43, 22, 5),
(44, 22, 12),
(45, 21, 2),
(46, 21, 3),
(47, 21, 7),
(48, 21, 11),
(49, 23, 1),
(50, 23, 7),
(51, 23, 12),
(52, 23, 13),
(54, 25, 1),
(55, 25, 2),
(56, 25, 4),
(57, 25, 5),
(58, 26, 1),
(59, 26, 4),
(60, 26, 11),
(61, 27, 2),
(62, 27, 7),
(63, 29, 2),
(64, 29, 5),
(65, 29, 12),
(66, 31, 3),
(67, 31, 7),
(68, 31, 12),
(69, 31, 14),
(70, 32, 1),
(71, 32, 2),
(72, 32, 4),
(73, 32, 7),
(74, 32, 12),
(81, 36, 2),
(82, 36, 5),
(83, 28, 1),
(84, 28, 2),
(85, 28, 4),
(86, 28, 5),
(87, 28, 12),
(88, 37, 3),
(89, 37, 7),
(90, 37, 15),
(91, 38, 1),
(92, 38, 2),
(93, 38, 4),
(94, 38, 12),
(95, 38, 7),
(96, 39, 1),
(97, 39, 2),
(98, 39, 4),
(99, 39, 5),
(100, 40, 3),
(101, 40, 5),
(102, 40, 17),
(103, 41, 1),
(104, 41, 3),
(105, 41, 7),
(106, 41, 11),
(107, 42, 1),
(108, 42, 16),
(109, 43, 1),
(110, 43, 7),
(111, 43, 9),
(112, 43, 12),
(113, 44, 3),
(114, 44, 5),
(115, 45, 1),
(116, 45, 2),
(117, 45, 4),
(118, 45, 5),
(119, 45, 12),
(120, 46, 1),
(121, 46, 4),
(122, 46, 5),
(123, 46, 12),
(124, 47, 1),
(125, 47, 3),
(126, 47, 7),
(127, 47, 12),
(128, 47, 13),
(129, 48, 1),
(130, 48, 2),
(131, 48, 3),
(132, 48, 4),
(133, 48, 12),
(134, 49, 1),
(135, 49, 2),
(136, 49, 3),
(137, 49, 4),
(138, 49, 12),
(139, 50, 1),
(140, 50, 3),
(141, 50, 7),
(142, 50, 13),
(181, 100, 1),
(182, 100, 3),
(183, 100, 5),
(184, 100, 12);

-- --------------------------------------------------------

--
-- Structure de la table `anime_season`
--

CREATE TABLE IF NOT EXISTS `anime_season` (
  `anime_id` int(11) NOT NULL,
  KEY `anime_id` (`anime_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `anime_season`
--

INSERT INTO `anime_season` (`anime_id`) VALUES
(22),
(23),
(26),
(27),
(29);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`id`, `nom`) VALUES
(1, 'ACTION'),
(2, 'AVENTURE'),
(3, 'AMOUR ET AMITIE'),
(4, 'COMBAT'),
(5, 'COMEDIE'),
(6, 'CYBER ET MECHA'),
(7, 'DRAME'),
(8, 'ECCHI'),
(9, 'ENIGME ET POLICIER'),
(10, 'EPIQUE ET HEROIQUE'),
(11, 'SCIENCE-FICTION'),
(12, 'FANTASTIQUE'),
(13, 'HORREUR'),
(14, 'MAGICAL GIRL'),
(15, 'MUSICAL'),
(16, 'SPORT'),
(17, 'TRANCHE DE VIE');

-- --------------------------------------------------------

--
-- Structure de la table `ost`
--

CREATE TABLE IF NOT EXISTS `ost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_ost` enum('opening','ending','ost') NOT NULL,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(50) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `anime_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `anime_id` (`anime_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `ost`
--

INSERT INTO `ost` (`id`, `type_ost`, `titre`, `auteur`, `note`, `anime_id`) VALUES
(1, 'opening', 'Hacking to the Gate', 'Ito Kanako', 90, 21),
(2, 'ending', 'Tokitsukasadoru Juuni no Meiyaku', 'PHANTASM', 60, 21),
(3, 'opening', 'Oath sign', 'LiSA', 73, 4),
(4, 'ending', 'MEMORIA', 'Aoi Eir', 80, 4),
(5, 'opening', 'THE DAY', 'Porno Graffitti', 80, 22),
(7, 'ending', 'HEROES', 'Brian the Sun', 60, 22),
(13, 'ost', 'Sis puella magica !', 'Itoh Eri', 95, 31),
(14, 'opening', 'Peace Sign', 'Yonezu Kenshi', 80, 22),
(15, 'opening', 'One Reason', 'Fade', 95, 50),
(16, 'ending', 'LET IT OUT', 'Fukuhara Miho', 78, 32),
(17, 'ending', 'Departures', 'EGOIST', 73, 41),
(18, 'ost', 'Unlimited Blade Works', '', 70, 5),
(19, 'ost', 'Tsuna Awakens', '', 70, 39);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) CHARACTER SET latin1 NOT NULL,
  `pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `access` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `access`) VALUES
(13, 'Backupinfo', '4db2466dc8d9d96ac620535808e8785f38084073', 1),
(14, 'adminrh', '07e528c75e17d4fd63c505f872cef503875b73c1', 2),
(16, 'julien.colleter', 'e38fabc73b19a44be17ccbc673f26c1a7567145c', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `anime_genre`
--
ALTER TABLE `anime_genre`
  ADD CONSTRAINT `animeid` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`),
  ADD CONSTRAINT `genreid` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `anime_season`
--
ALTER TABLE `anime_season`
  ADD CONSTRAINT `anime_season_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`);

--
-- Contraintes pour la table `ost`
--
ALTER TABLE `ost`
  ADD CONSTRAINT `ost_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
