-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : db5000560214.hosting-data.io
-- Généré le : mar. 23 juin 2020 à 11:23
-- Version du serveur :  5.7.30-log
-- Version de PHP : 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs537857`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `pseudo`, `pass`, `email`) VALUES
(1, 'Jean', '$2y$10$77MYVwh5uVkijnC6n2Z7OOH.Nm8XKmF4lRO1i29.uV0d99wMPqhb2', 'jean.forteroche4@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `signalement` tinyint(1) NOT NULL,
  `nb_signalements` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `signalement`, `nb_signalements`) VALUES
(6, 3, 'kjikj', 'kjk', '2020-06-23 13:17:36', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `img_nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_taille` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL
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
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_fk` (`post_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `images_fk` (`post_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
