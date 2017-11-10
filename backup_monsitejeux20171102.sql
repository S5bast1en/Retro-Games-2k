SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comment` (`id`, `user_id`, `game_id`, `content`) VALUES
(3, 1, 10, 'j ajoute 2 fois ce deuxieme commentaire'),
(4, 1, 5, 'autre commentaire poru le dernier exercice'),
(6, 2, 5, 'sedfsdfsdf'),
(7, 3, 5, 'wouah');

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `developer` (`id`, `name`) VALUES
(1, 'Bally Midway Manufacturing Company'),
(2, 'Irem'),
(3, 'id Software'),
(4, 'Mythic Entertainment'),
(5, 'Destiny Sofware');

CREATE TABLE `editor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `editor` (`id`, `name`) VALUES
(1, 'Bally Midway Manufacturing Company'),
(2, 'Irem Williams Electronics'),
(3, 'id Software'),
(4, 'GT Interactive'),
(5, 'Electronic Arts');

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://i.telegraph.co.uk/multimedia/archive/03597/POTD_chick_3597497k.jpg',
  `type_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date DEFAULT NULL,
  `press_note` float DEFAULT NULL,
  `player_note` float DEFAULT NULL,
  `editor_id` int(11) NOT NULL,
  `developer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `games` (`id`, `name`, `picture`, `type_id`, `description`, `release_date`, `press_note`, `player_note`, `editor_id`, `developer_id`) VALUES
(1, 'Death track', 'img/deathtrack_cover_1989.jpg', 2, 'st un jeu vidéo de combat motorisé sorti en 1989 sous DOS. There are two ways to win a race: BE THE 1st, OR BE THE ONLY 1. Based in a futuristic America, the player races on various tracks across the country for money, which can be spent on armor, weapons and other modifications to protect and use against the competition. The player chooses from one of three cars (either The Hellcat for high speed, The Crusher for high firepower or The Pitbull for heavy armor) and begins racing against other drivers.', '1989-01-01', 12, 12, 1, 1),
(2, 'Prince of persia', 'img/princeofpersia_cover_1989.jpg', 3, 'Prince of Persia est un jeu vidéo d\'action/réflexion et d\'aventure en deux dimensions développé par Brøderbund et sorti en 1989 pour le micro-ordinateur 8 bits Apple II. Développé par Jordan Mechner pendant près de 4 ans, il rencontre un fort succès. Traduit dans 6 langues, et porté sur une vingtaine de supports, le jeu s\'est vendu à plus de 2 millions d\'exemplaires à travers le monde.Il est resté célèbre pour la qualité des animations par rapport aux autres jeux de l\'époque grâce à l\'utilisation de la technique de rotoscopie. Il est le premier épisode de la saga Prince of Persia et le premier épisode du premier cycle de la série. Le jeu est novateur et abouti sur bien des aspects : on y trouve une animation très fluide et détaillée du personnage, jointe à un comportement et des aptitudes physiques réalistes, à contre-courant de nombreux jeu d\'arcade de l\'époque; l\'utilisation de la barre de vie, encore rare à cette époque; un temps limité pour achever l\'aventure; des combats originaux : le protagoniste et les ennemis s\'affrontent à l\'épée, et non avec toutes sortes de projectiles comme dans les jeux qui lui sont contemporains; l\'absence de tout score ou encore l\'inclusion de scènes cinématiques (séquences où le joueur devient spectateur et n\'a plus de contrôle sur le personnage).', '1989-01-01', 18, 19, 2, 2),
(3, 'Space Invadeur', 'img_retro/spaceinvaders_cover.jpg', 5, ' Space invaders est un jeu à la base développé pour Atari 2600 en download disponible à l\'émulation au format rom 2600 space invaders fr ou en.', '1978-01-01', 12, 14, 3, 4),
(4, 'Blood bowl', 'img_bloodbowl/bloodbowl_cover_1995.jpg', 3, 'il est adpaté du jeu de figurines éponyme de Games Workshop, Blood Bowl. Il se déroule dans un univers mêlant fantasy et football américain.', '1995-01-01', 13, 13, 4, 5),
(5, 'Mortal kombat', 'img/MK_cover.jpg', 2, 'MK est un jeu vidéo de Midway Manufacturing Company sorti sur borne d\'arcade en 1992, célèbre pour sa violence, sa brutalité et son côté gore. L\'histoire se centre sur un tournoi du nom de Mortal Kombat organisé par le maléfique sorcier Shang Tsung. Le jeu a connu un très fort succès ce qui a donné suite à un second volet, Mortal Kombat II en 1993.', '1992-01-01', 18, 16, 5, 3),
(6, 'Warhammer', 'img_warhammer/ageofreckoning_cover_2009.jpg', 1, 'WAR est un jeu vidéo de type MMORPG inspiré de l\'univers fantastique de Warhammer de Games Workshop. Warhammer Online a pour ambition de s’orienter majoritairement vers un jeu du type Royaume contre Royaume (RvR). Le jeu se déroule sur trois fronts : Nains contre Peaux-Vertes, Empire contre Chaos, Hauts-Elfes contre Elfes noirs. Pour chaque front, les joueurs des deux factions s\'affrontent pour la domination de la zone. Pour cela, les joueurs accumulent des points de victoire, obtenus par divers moyens : affrontements entre joueurs de factions opposées, prises de forts et d\'objectifs de guerre sur les champs de bataille, scénarios instanciés, quêtes de toutes sortes. abrégé WAR, est un jeu vidéo de type MMORPG inspiré de l\'univers fantastique de Warhammer de Games Workshop. Warhammer Online a pour ambition de s’orienter majoritairement vers un jeu du type Royaume contre Royaume (RvR). Le jeu se déroule sur trois fronts : Nains contre Peaux-Vertes, Empire contre Chaos, Hauts-Elfes contre Elfes noirs. Pour chaque front, les joueurs des deux factions s\'affrontent pour la domination de la zone. Pour cela, les joueurs accumulent des points de victoire, obtenus par divers moyens : affrontements entre joueurs de factions opposées, prises de forts et d\'objectifs de guerre sur les champs de bataille, scénarios instanciés, quêtes de toutes sortes.', '1973-01-01', 14, 13.5, 5, 1),
(7, 'Moon patrol', 'img_retro/moonpatrol_cover.jpg', 5, 'Le joueur contrôle un véhicule terrestre dans des environnements lunaires visualisés de profil. Le véhicule se déplace vers la droite de l\'écran et le but est d\'éliminer les soucoupes volantes et les tanks ennemis qui se présentent. La borne d\'arcade présente un joystick à deux directions (pour modifier la vitesse du véhicule) et deux boutons : l\'un pour tirer (le véhicule possède un canon dirigé vers l\'avant et un autre dirigé vers le dessus), l\'autre pour faire sauter le véhicule (afin de contourner les cratères, mines et autres blocs de roches présents sur le parcours).', '1982-01-01', 11, 12.5, 2, 2),
(8, 'Tron', 'img_retro/tron_cover.jpg', 5, 'Tron est un jeu vidéo d\'arcade développé et commercialisé par Bally Midway Manufacturing Company sorti en 1982 . Il a par la suite été porté sur le Xbox Live Arcade. Tron regroupe quatre disciplines dans lesquelles le joueur doit tantôt lutter contre des bugs ou araignées, combattre des tanks ou essayer, comme dans le film, de fracasser les motos de l\'adversaire contre son mur de lumière. La dernière discipline consiste à pulvériser un nombre donné de briques pour pénétrer le MCP. Chaque fois que les quatre disciplines sont maîtrisées, le jeu passe au niveau supérieur.', '1982-01-01', 11, 10.5, 1, 1),
(9, 'Donkey kong', 'img_retro/donkeykong_cover.jpg', 2, 'Le jeu utilise les graphismes et l\'animation pour caractériser les sentiments et les identités des personnages. Donkey Kong est identifiable par son sourire ; Lady est directement reconnaissable comme un personnage féminin par sa robe rose et ses longs cheveux, le message « HELP! » apparaît fréquemment derrière elle. Jumpman apparaît habillé d\'une salopette rouge ; c\'est un personnage commun au Japon, sans trait identifiable. Le travail artistique réalisé sur la borne d\'arcade et les produits dérivés donnèrent aux personnages une apparence plus marquée. Lady, par exemple, apparaît avec la même chevelure que l\'actrice Fay Wray, avec une robe déchirée et des talons hauts.', '1981-01-01', 12, 12.5, 1, 4),
(10, 'Doom', 'https://upload.wikimedia.org/wikipedia/fr/thumb/0/0b/Doom.png/280px-Doom.png', 1, 'est un jeu vidéo de tir en vue à la première personne (en anglais First person shooter ou FPS), développé et édité par la société id Software et publié le 10 décembre 1993.', '1990-00-00', 12, 14, 3, 3),
(11, 'Doom II', 'https://upload.wikimedia.org/wikipedia/fr/thumb/a/aa/Doom_II_Hell_on_Earth_logo.png/280px-Doom_II_Hell_on_Earth_logo.png', 1, 'Doom II fait suite à Doom, publié en 1993 et s’inscrit dans la lignée du précédent titre développé par id Software, Wolfenstein 3D. Le jeu se déroule dans un futur proche peu après les événements décrits dans Doom, le joueur incar', '1993-01-01', 15, 16.4, 4, 3);

CREATE TABLE `games_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `games_type` (`id`, `name`) VALUES
(1, 'Horreur'),
(2, 'Adult'),
(3, 'fantastique'),
(4, 'MMORPG'),
(5, 'sci-fi');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premium` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `email`, `password`, `premium`, `admin`) VALUES
(1, 'toto@yahoo.fr', 'totopassword', 0, 1),
(2, 'titi@yahoo.com', 'titipwd', 1, 0),
(3, 'tutu@email.cz', 'tutupassword', 0, 0);

CREATE TABLE `users_game` (
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_fk0` (`user_id`),
  ADD KEY `comment_fk1` (`game_id`);

ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_fk0` (`type_id`),
  ADD KEY `editor_id` (`editor_id`),
  ADD KEY `developer_id` (`developer_id`);

ALTER TABLE `games_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users_game`
  ADD KEY `users_game_fk0` (`game_id`),
  ADD KEY `users_game_fk1` (`user_id`);


ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `games_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `comment`
  ADD CONSTRAINT `comment_fk0` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_fk1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);

ALTER TABLE `games`
  ADD CONSTRAINT `games_fk0` FOREIGN KEY (`type_id`) REFERENCES `games_type` (`id`),
  ADD CONSTRAINT `games_fk1` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`),
  ADD CONSTRAINT `games_fk2` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`id`);

ALTER TABLE `users_game`
  ADD CONSTRAINT `users_game_fk0` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `users_game_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
