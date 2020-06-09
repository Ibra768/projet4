-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 09 juin 2020 à 08:07
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jean`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `pseudo`, `pass`, `email`) VALUES
(1, 'Jean', '$2y$10$MuwGRjIuVNFQ2DAIAtzY3eu2glFKXl0z10O2Elw8h7v4mbrHETks6', 'jean.forteroche4@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `signalement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nb_signalements` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_fk` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `img_nom` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_taille` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `images_fk` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`img_id`, `post_id`, `img_nom`, `img_taille`, `img_type`) VALUES
(1, 1, 'landscape-1622739_1920.jpg', '243586', 'jpg'),
(2, 2, 'alaska-566722_1920.jpg', '772934', 'jpg'),
(3, 3, 'mountains-1622731_1920.jpg', '750121', 'jpg'),
(4, 4, 'night-1189929_1920.jpg', '593484', 'jpg'),
(5, 5, 'humpback-whale-1984341_1920.jpg', '831108', 'jpg'),
(6, 6, 'mount-mckinley-898378_1920.jpg', '745068', 'jpg');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `creation_date`) VALUES
(1, 'L\'Alaska', '&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada nibh vel dolor scelerisque cursus. Pellentesque tincidunt sem in nisl consectetur porttitor. Nam in lorem ex. Sed vel suscipit augue. Maecenas gravida nisl felis, sit amet egestas justo fermentum sed. Pellentesque tempor massa eget semper egestas. Nullam orci nunc, facilisis sed eros et, finibus eleifend eros. Nulla sit amet ante et lorem hendrerit convallis nec eu magna. Aliquam maximus molestie tellus, rhoncus maximus nisi dapibus posuere. Sed eu mauris malesuada, iaculis purus quis, molestie urna. In id interdum turpis. Integer scelerisque aliquam metus, nec semper tellus consectetur quis. Praesent nunc nulla, vulputate eu viverra ac, mattis eu lectus. Duis vitae faucibus massa. Duis quis nisi in diam tempor pharetra a non lacus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Nulla lacus orci, consequat et egestas nec, lobortis nec est. Nulla iaculis odio eu dui sollicitudin, vitae convallis nisi vehicula. Nam tincidunt justo orci, sed commodo ipsum auctor suscipit. Sed suscipit, sapien eu bibendum efficitur, odio diam tempus tellus, vitae molestie dui libero ac tortor. Cras gravida dignissim tempus. Suspendisse porttitor ex tristique ligula malesuada aliquet. Vivamus quis est quis sapien cursus vulputate a vel dolor. Donec varius nisl consequat, suscipit ex quis, commodo libero. Donec dignissim pretium dapibus. Phasellus porttitor turpis non sapien gravida, vitae efficitur leo porta.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Suspendisse a lobortis tellus. Maecenas at ipsum bibendum elit elementum sagittis. Nullam malesuada justo neque, mollis pellentesque est condimentum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget leo nec eros interdum mollis. Phasellus sagittis purus urna, nec porta tellus feugiat sit amet. Etiam tempus egestas arcu, at sagittis nisl suscipit ut. Curabitur sit amet tincidunt purus. Etiam mattis iaculis maximus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Ut egestas lobortis augue, a finibus augue cursus in. Praesent quam neque, pellentesque a justo a, suscipit ornare odio. Integer maximus semper imperdiet. Maecenas vitae mauris quis orci laoreet facilisis vel sit amet ex. Nulla facilisi. Donec consectetur euismod mi eu luctus. Suspendisse cursus, turpis ac ullamcorper gravida, massa sapien molestie neque, nec commodo urna nulla at velit. In accumsan ipsum nunc, et convallis mi vestibulum ac.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Mauris tincidunt purus leo, vitae facilisis quam faucibus ac. Sed ut vulputate orci. Suspendisse ut fringilla arcu. Duis ut turpis eu erat convallis ultrices in vitae leo. Vestibulum suscipit sit amet lectus non luctus. Donec eu eros quis turpis blandit feugiat ut eu tellus. Ut dapibus semper nibh, id consectetur turpis ultricies et.&lt;/p&gt;', 'Jean', '2020-06-08 22:22:29'),
(2, 'Le glacier Aurora', '&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada nibh vel dolor scelerisque cursus. Pellentesque tincidunt sem in nisl consectetur porttitor. Nam in lorem ex. Sed vel suscipit augue. Maecenas gravida nisl felis, sit amet egestas justo fermentum sed. Pellentesque tempor massa eget semper egestas. Nullam orci nunc, facilisis sed eros et, finibus eleifend eros. Nulla sit amet ante et lorem hendrerit convallis nec eu magna. Aliquam maximus molestie tellus, rhoncus maximus nisi dapibus posuere. Sed eu mauris malesuada, iaculis purus quis, molestie urna. In id interdum turpis. Integer scelerisque aliquam metus, nec semper tellus consectetur quis. Praesent nunc nulla, vulputate eu viverra ac, mattis eu lectus. Duis vitae faucibus massa. Duis quis nisi in diam tempor pharetra a non lacus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Nulla lacus orci, consequat et egestas nec, lobortis nec est. Nulla iaculis odio eu dui sollicitudin, vitae convallis nisi vehicula. Nam tincidunt justo orci, sed commodo ipsum auctor suscipit. Sed suscipit, sapien eu bibendum efficitur, odio diam tempus tellus, vitae molestie dui libero ac tortor. Cras gravida dignissim tempus. Suspendisse porttitor ex tristique ligula malesuada aliquet. Vivamus quis est quis sapien cursus vulputate a vel dolor. Donec varius nisl consequat, suscipit ex quis, commodo libero. Donec dignissim pretium dapibus. Phasellus porttitor turpis non sapien gravida, vitae efficitur leo porta.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Suspendisse a lobortis tellus. Maecenas at ipsum bibendum elit elementum sagittis. Nullam malesuada justo neque, mollis pellentesque est condimentum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget leo nec eros interdum mollis. Phasellus sagittis purus urna, nec porta tellus feugiat sit amet. Etiam tempus egestas arcu, at sagittis nisl suscipit ut. Curabitur sit amet tincidunt purus. Etiam mattis iaculis maximus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Ut egestas lobortis augue, a finibus augue cursus in. Praesent quam neque, pellentesque a justo a, suscipit ornare odio. Integer maximus semper imperdiet. Maecenas vitae mauris quis orci laoreet facilisis vel sit amet ex. Nulla facilisi. Donec consectetur euismod mi eu luctus. Suspendisse cursus, turpis ac ullamcorper gravida, massa sapien molestie neque, nec commodo urna nulla at velit. In accumsan ipsum nunc, et convallis mi vestibulum ac.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Mauris tincidunt purus leo, vitae facilisis quam faucibus ac. Sed ut vulputate orci. Suspendisse ut fringilla arcu. Duis ut turpis eu erat convallis ultrices in vitae leo. Vestibulum suscipit sit amet lectus non luctus. Donec eu eros quis turpis blandit feugiat ut eu tellus. Ut dapibus semper nibh, id consectetur turpis ultricies et.&lt;/p&gt;', 'Jean', '2020-06-08 22:23:33'),
(3, 'Le Mont Hunter', '&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada nibh vel dolor scelerisque cursus. Pellentesque tincidunt sem in nisl consectetur porttitor. Nam in lorem ex. Sed vel suscipit augue. Maecenas gravida nisl felis, sit amet egestas justo fermentum sed. Pellentesque tempor massa eget semper egestas. Nullam orci nunc, facilisis sed eros et, finibus eleifend eros. Nulla sit amet ante et lorem hendrerit convallis nec eu magna. Aliquam maximus molestie tellus, rhoncus maximus nisi dapibus posuere. Sed eu mauris malesuada, iaculis purus quis, molestie urna. In id interdum turpis. Integer scelerisque aliquam metus, nec semper tellus consectetur quis. Praesent nunc nulla, vulputate eu viverra ac, mattis eu lectus. Duis vitae faucibus massa. Duis quis nisi in diam tempor pharetra a non lacus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Nulla lacus orci, consequat et egestas nec, lobortis nec est. Nulla iaculis odio eu dui sollicitudin, vitae convallis nisi vehicula. Nam tincidunt justo orci, sed commodo ipsum auctor suscipit. Sed suscipit, sapien eu bibendum efficitur, odio diam tempus tellus, vitae molestie dui libero ac tortor. Cras gravida dignissim tempus. Suspendisse porttitor ex tristique ligula malesuada aliquet. Vivamus quis est quis sapien cursus vulputate a vel dolor. Donec varius nisl consequat, suscipit ex quis, commodo libero. Donec dignissim pretium dapibus. Phasellus porttitor turpis non sapien gravida, vitae efficitur leo porta.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Suspendisse a lobortis tellus. Maecenas at ipsum bibendum elit elementum sagittis. Nullam malesuada justo neque, mollis pellentesque est condimentum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget leo nec eros interdum mollis. Phasellus sagittis purus urna, nec porta tellus feugiat sit amet. Etiam tempus egestas arcu, at sagittis nisl suscipit ut. Curabitur sit amet tincidunt purus. Etiam mattis iaculis maximus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Ut egestas lobortis augue, a finibus augue cursus in. Praesent quam neque, pellentesque a justo a, suscipit ornare odio. Integer maximus semper imperdiet. Maecenas vitae mauris quis orci laoreet facilisis vel sit amet ex. Nulla facilisi. Donec consectetur euismod mi eu luctus. Suspendisse cursus, turpis ac ullamcorper gravida, massa sapien molestie neque, nec commodo urna nulla at velit. In accumsan ipsum nunc, et convallis mi vestibulum ac.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Mauris tincidunt purus leo, vitae facilisis quam faucibus ac. Sed ut vulputate orci. Suspendisse ut fringilla arcu. Duis ut turpis eu erat convallis ultrices in vitae leo. Vestibulum suscipit sit amet lectus non luctus. Donec eu eros quis turpis blandit feugiat ut eu tellus. Ut dapibus semper nibh, id consectetur turpis ultricies et.&lt;/p&gt;', 'Jean', '2020-06-08 22:24:18'),
(4, 'Les aurores boréales', '&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada nibh vel dolor scelerisque cursus. Pellentesque tincidunt sem in nisl consectetur porttitor. Nam in lorem ex. Sed vel suscipit augue. Maecenas gravida nisl felis, sit amet egestas justo fermentum sed. Pellentesque tempor massa eget semper egestas. Nullam orci nunc, facilisis sed eros et, finibus eleifend eros. Nulla sit amet ante et lorem hendrerit convallis nec eu magna. Aliquam maximus molestie tellus, rhoncus maximus nisi dapibus posuere. Sed eu mauris malesuada, iaculis purus quis, molestie urna. In id interdum turpis. Integer scelerisque aliquam metus, nec semper tellus consectetur quis. Praesent nunc nulla, vulputate eu viverra ac, mattis eu lectus. Duis vitae faucibus massa. Duis quis nisi in diam tempor pharetra a non lacus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Nulla lacus orci, consequat et egestas nec, lobortis nec est. Nulla iaculis odio eu dui sollicitudin, vitae convallis nisi vehicula. Nam tincidunt justo orci, sed commodo ipsum auctor suscipit. Sed suscipit, sapien eu bibendum efficitur, odio diam tempus tellus, vitae molestie dui libero ac tortor. Cras gravida dignissim tempus. Suspendisse porttitor ex tristique ligula malesuada aliquet. Vivamus quis est quis sapien cursus vulputate a vel dolor. Donec varius nisl consequat, suscipit ex quis, commodo libero. Donec dignissim pretium dapibus. Phasellus porttitor turpis non sapien gravida, vitae efficitur leo porta.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Suspendisse a lobortis tellus. Maecenas at ipsum bibendum elit elementum sagittis. Nullam malesuada justo neque, mollis pellentesque est condimentum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget leo nec eros interdum mollis. Phasellus sagittis purus urna, nec porta tellus feugiat sit amet. Etiam tempus egestas arcu, at sagittis nisl suscipit ut. Curabitur sit amet tincidunt purus. Etiam mattis iaculis maximus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Ut egestas lobortis augue, a finibus augue cursus in. Praesent quam neque, pellentesque a justo a, suscipit ornare odio. Integer maximus semper imperdiet. Maecenas vitae mauris quis orci laoreet facilisis vel sit amet ex. Nulla facilisi. Donec consectetur euismod mi eu luctus. Suspendisse cursus, turpis ac ullamcorper gravida, massa sapien molestie neque, nec commodo urna nulla at velit. In accumsan ipsum nunc, et convallis mi vestibulum ac.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Mauris tincidunt purus leo, vitae facilisis quam faucibus ac. Sed ut vulputate orci. Suspendisse ut fringilla arcu. Duis ut turpis eu erat convallis ultrices in vitae leo. Vestibulum suscipit sit amet lectus non luctus. Donec eu eros quis turpis blandit feugiat ut eu tellus. Ut dapibus semper nibh, id consectetur turpis ultricies et.&lt;/p&gt;', 'Jean', '2020-06-08 22:25:07'),
(5, 'La Baleine de Minke', '&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada nibh vel dolor scelerisque cursus. Pellentesque tincidunt sem in nisl consectetur porttitor. Nam in lorem ex. Sed vel suscipit augue. Maecenas gravida nisl felis, sit amet egestas justo fermentum sed. Pellentesque tempor massa eget semper egestas. Nullam orci nunc, facilisis sed eros et, finibus eleifend eros. Nulla sit amet ante et lorem hendrerit convallis nec eu magna. Aliquam maximus molestie tellus, rhoncus maximus nisi dapibus posuere. Sed eu mauris malesuada, iaculis purus quis, molestie urna. In id interdum turpis. Integer scelerisque aliquam metus, nec semper tellus consectetur quis. Praesent nunc nulla, vulputate eu viverra ac, mattis eu lectus. Duis vitae faucibus massa. Duis quis nisi in diam tempor pharetra a non lacus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Nulla lacus orci, consequat et egestas nec, lobortis nec est. Nulla iaculis odio eu dui sollicitudin, vitae convallis nisi vehicula. Nam tincidunt justo orci, sed commodo ipsum auctor suscipit. Sed suscipit, sapien eu bibendum efficitur, odio diam tempus tellus, vitae molestie dui libero ac tortor. Cras gravida dignissim tempus. Suspendisse porttitor ex tristique ligula malesuada aliquet. Vivamus quis est quis sapien cursus vulputate a vel dolor. Donec varius nisl consequat, suscipit ex quis, commodo libero. Donec dignissim pretium dapibus. Phasellus porttitor turpis non sapien gravida, vitae efficitur leo porta.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Suspendisse a lobortis tellus. Maecenas at ipsum bibendum elit elementum sagittis. Nullam malesuada justo neque, mollis pellentesque est condimentum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget leo nec eros interdum mollis. Phasellus sagittis purus urna, nec porta tellus feugiat sit amet. Etiam tempus egestas arcu, at sagittis nisl suscipit ut. Curabitur sit amet tincidunt purus. Etiam mattis iaculis maximus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Ut egestas lobortis augue, a finibus augue cursus in. Praesent quam neque, pellentesque a justo a, suscipit ornare odio. Integer maximus semper imperdiet. Maecenas vitae mauris quis orci laoreet facilisis vel sit amet ex. Nulla facilisi. Donec consectetur euismod mi eu luctus. Suspendisse cursus, turpis ac ullamcorper gravida, massa sapien molestie neque, nec commodo urna nulla at velit. In accumsan ipsum nunc, et convallis mi vestibulum ac.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Mauris tincidunt purus leo, vitae facilisis quam faucibus ac. Sed ut vulputate orci. Suspendisse ut fringilla arcu. Duis ut turpis eu erat convallis ultrices in vitae leo. Vestibulum suscipit sit amet lectus non luctus. Donec eu eros quis turpis blandit feugiat ut eu tellus. Ut dapibus semper nibh, id consectetur turpis ultricies et.&lt;/p&gt;', 'Jean', '2020-06-08 22:27:36'),
(6, 'La randonnée', '&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras malesuada nibh vel dolor scelerisque cursus. Pellentesque tincidunt sem in nisl consectetur porttitor. Nam in lorem ex. Sed vel suscipit augue. Maecenas gravida nisl felis, sit amet egestas justo fermentum sed. Pellentesque tempor massa eget semper egestas. Nullam orci nunc, facilisis sed eros et, finibus eleifend eros. Nulla sit amet ante et lorem hendrerit convallis nec eu magna. Aliquam maximus molestie tellus, rhoncus maximus nisi dapibus posuere. Sed eu mauris malesuada, iaculis purus quis, molestie urna. In id interdum turpis. Integer scelerisque aliquam metus, nec semper tellus consectetur quis. Praesent nunc nulla, vulputate eu viverra ac, mattis eu lectus. Duis vitae faucibus massa. Duis quis nisi in diam tempor pharetra a non lacus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Nulla lacus orci, consequat et egestas nec, lobortis nec est. Nulla iaculis odio eu dui sollicitudin, vitae convallis nisi vehicula. Nam tincidunt justo orci, sed commodo ipsum auctor suscipit. Sed suscipit, sapien eu bibendum efficitur, odio diam tempus tellus, vitae molestie dui libero ac tortor. Cras gravida dignissim tempus. Suspendisse porttitor ex tristique ligula malesuada aliquet. Vivamus quis est quis sapien cursus vulputate a vel dolor. Donec varius nisl consequat, suscipit ex quis, commodo libero. Donec dignissim pretium dapibus. Phasellus porttitor turpis non sapien gravida, vitae efficitur leo porta.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Suspendisse a lobortis tellus. Maecenas at ipsum bibendum elit elementum sagittis. Nullam malesuada justo neque, mollis pellentesque est condimentum ac. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla eget leo nec eros interdum mollis. Phasellus sagittis purus urna, nec porta tellus feugiat sit amet. Etiam tempus egestas arcu, at sagittis nisl suscipit ut. Curabitur sit amet tincidunt purus. Etiam mattis iaculis maximus.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Ut egestas lobortis augue, a finibus augue cursus in. Praesent quam neque, pellentesque a justo a, suscipit ornare odio. Integer maximus semper imperdiet. Maecenas vitae mauris quis orci laoreet facilisis vel sit amet ex. Nulla facilisi. Donec consectetur euismod mi eu luctus. Suspendisse cursus, turpis ac ullamcorper gravida, massa sapien molestie neque, nec commodo urna nulla at velit. In accumsan ipsum nunc, et convallis mi vestibulum ac.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;&quot;&gt;Mauris tincidunt purus leo, vitae facilisis quam faucibus ac. Sed ut vulputate orci. Suspendisse ut fringilla arcu. Duis ut turpis eu erat convallis ultrices in vitae leo. Vestibulum suscipit sit amet lectus non luctus. Donec eu eros quis turpis blandit feugiat ut eu tellus. Ut dapibus semper nibh, id consectetur turpis ultricies et.&lt;/p&gt;', 'Jean', '2020-06-08 22:31:09');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
