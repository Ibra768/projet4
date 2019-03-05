-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 05 mars 2019 à 12:08
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jeanpgyp_alaska`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `pseudo`, `pass`) VALUES
(1, 'ibrahim', '$2y$10$wWa1Ap12ohSu0UFtAMCUYuCJN8f33WxhFhQYLCzG.4SG3iKyWOz3S');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `signalement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `signalement`) VALUES
(1, 6, 'Ibrahim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus, nunc sit amet euismod gravida, lorem turpis aliquet nunc, sodales vulputate lectus arcu at elit. Suspendisse id enim auctor, placerat risus vitae, aliquam velit. Vestibulum eu porttitor ex. Mauris posuere pellentesque pretium. Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-27 11:59:19', 'TRUE'),
(3, 4, 'Ibrahim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus, nunc sit amet euismod gravida, lorem turpis aliquet nunc, sodales vulputate lectus arcu at elit. Suspendisse id enim auctor, placerat risus vitae, aliquam velit. Vestibulum eu porttitor ex. Mauris posuere pellentesque pretium. Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-27 11:59:44', 'FALSE'),
(4, 3, 'Ibrahim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus, nunc sit amet euismod gravida, lorem turpis aliquet nunc, sodales vulputate lectus arcu at elit. Suspendisse id enim auctor, placerat risus vitae, aliquam velit. Vestibulum eu porttitor ex. Mauris posuere pellentesque pretium. Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-27 11:59:52', 'FALSE'),
(5, 2, 'Ibrahim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus, nunc sit amet euismod gravida, lorem turpis aliquet nunc, sodales vulputate lectus arcu at elit. Suspendisse id enim auctor, placerat risus vitae, aliquam velit. Vestibulum eu porttitor ex. Mauris posuere pellentesque pretium. Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-27 12:00:02', 'FALSE'),
(6, 1, 'Ibrahim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus, nunc sit amet euismod gravida, lorem turpis aliquet nunc, sodales vulputate lectus arcu at elit. Suspendisse id enim auctor, placerat risus vitae, aliquam velit. Vestibulum eu porttitor ex. Mauris posuere pellentesque pretium. Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-27 12:00:11', 'FALSE'),
(7, 2, 'Ibrahim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus, nunc sit amet euismod gravida, lorem turpis aliquet nunc, sodales vulputate lectus arcu at elit. Suspendisse id enim auctor, placerat risus vitae, aliquam velit. Vestibulum eu porttitor ex. Mauris posuere pellentesque pretium. Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-28 03:01:43', 'FALSE'),
(8, 5, 'Ibrahim', 'Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem. Phasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-02-28 03:02:06', 'FALSE'),
(9, 5, 'Ibrahim', ' Nullam in feugiat massa. Praesent dictum aliquet nulla vitae lacinia. Vestibulum a enim est. Vestibulum auctor, nunc vitae hendrerit rutrum, mi nisl auctor ex, ut dictum ipsum massa nec eros. Etiam pharetra volutpat feugiat. Mauris tempor lorem at lacus tincidunt consequat.', '2019-02-28 03:02:43', 'FALSE'),
(10, 5, 'moi', 'super', '2019-03-03 16:31:04', 'FALSE');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`) VALUES
(1, 'EPISODE 1', 'Corrig&eacute; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tristique quam ac pretium. Nunc pulvinar, felis eget scelerisque cursus, tortor odio pulvinar erat, eget vestibulum sem turpis id purus. Donec laoreet nulla quis risus malesuada, ut iaculis tellus suscipit. Morbi eleifend vulputate rhoncus. Etiam ac sagittis arcu. Morbi et volutpat purus, quis scelerisque tortor. Phasellus porttitor erat id turpis pretium, sit amet egestas dolor luctus. Mauris maximus aliquet elementum. Mauris id ultrices metus. Aenean rutrum non elit rhoncus posuere. Aenean mollis sodales urna nec imperdiet. Aliquam rutrum commodo est sit amet sagittis. Nunc vulputate rhoncus mi vitae vehicula. Integer nec orci ultricies, mollis justo et, aliquet urna. Mauris ullamcorper neque sit amet massa gravida, non semper diam eleifend. Fusce porttitor velit lacus, in ultricies leo facilisis nec. Proin non venenatis sem, sit amet tincidunt eros. Sed velit dolor, fermentum id vulputate a, gravida in nisl. Fusce scelerisque ultricies aliquet. Donec egestas, nisl eu blandit commodo, magna ex lacinia ex, sed faucibus magna urna id quam. Nam eget gravida turpis, sit amet accumsan lacus. In efficitur lorem consequat, viverra augue sit amet, interdum turpis. Mauris malesuada, ex vel dignissim varius, nisl magna mattis magna, a eleifend massa neque sit amet velit. Nulla dapibus odio nec congue fringilla. Proin nec nunc ut tellus dapibus vehicula et in diam. Aenean eget dolor eget massa fringilla lobortis id porttitor tortor. Phasellus erat turpis, elementum et augue vitae, elementum lobortis ex. Etiam quam massa, egestas nec turpis at, efficitur varius tellus. Sed leo eros, pretium sit amet purus sit amet, auctor cursus ligula. Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem. Phasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-02-19 00:00:00'),
(2, 'EPISODE 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tristique quam ac pretium. Nunc pulvinar, felis eget scelerisque cursus, tortor odio pulvinar erat, eget vestibulum sem turpis id purus. Donec laoreet nulla quis risus malesuada, ut iaculis tellus suscipit. Morbi eleifend vulputate rhoncus. Etiam ac sagittis arcu. Morbi et volutpat purus, quis scelerisque tortor. Phasellus porttitor erat id turpis pretium, sit amet egestas dolor luctus. Mauris maximus aliquet elementum. Mauris id ultrices metus.\r\n\r\nAenean rutrum non elit rhoncus posuere. Aenean mollis sodales urna nec imperdiet. Aliquam rutrum commodo est sit amet sagittis. Nunc vulputate rhoncus mi vitae vehicula. Integer nec orci ultricies, mollis justo et, aliquet urna. Mauris ullamcorper neque sit amet massa gravida, non semper diam eleifend. Fusce porttitor velit lacus, in ultricies leo facilisis nec.\r\n\r\nProin non venenatis sem, sit amet tincidunt eros. Sed velit dolor, fermentum id vulputate a, gravida in nisl. Fusce scelerisque ultricies aliquet. Donec egestas, nisl eu blandit commodo, magna ex lacinia ex, sed faucibus magna urna id quam. Nam eget gravida turpis, sit amet accumsan lacus. In efficitur lorem consequat, viverra augue sit amet, interdum turpis. Mauris malesuada, ex vel dignissim varius, nisl magna mattis magna, a eleifend massa neque sit amet velit. Nulla dapibus odio nec congue fringilla. Proin nec nunc ut tellus dapibus vehicula et in diam. Aenean eget dolor eget massa fringilla lobortis id porttitor tortor. Phasellus erat turpis, elementum et augue vitae, elementum lobortis ex. Etiam quam massa, egestas nec turpis at, efficitur varius tellus. Sed leo eros, pretium sit amet purus sit amet, auctor cursus ligula. Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem.\r\n\r\nPhasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-02-21 00:00:00'),
(3, 'EPISODE 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tristique quam ac pretium. Nunc pulvinar, felis eget scelerisque cursus, tortor odio pulvinar erat, eget vestibulum sem turpis id purus. Donec laoreet nulla quis risus malesuada, ut iaculis tellus suscipit. Morbi eleifend vulputate rhoncus. Etiam ac sagittis arcu. Morbi et volutpat purus, quis scelerisque tortor. Phasellus porttitor erat id turpis pretium, sit amet egestas dolor luctus. Mauris maximus aliquet elementum. Mauris id ultrices metus.\r\n\r\nAenean rutrum non elit rhoncus posuere. Aenean mollis sodales urna nec imperdiet. Aliquam rutrum commodo est sit amet sagittis. Nunc vulputate rhoncus mi vitae vehicula. Integer nec orci ultricies, mollis justo et, aliquet urna. Mauris ullamcorper neque sit amet massa gravida, non semper diam eleifend. Fusce porttitor velit lacus, in ultricies leo facilisis nec.\r\n\r\nProin non venenatis sem, sit amet tincidunt eros. Sed velit dolor, fermentum id vulputate a, gravida in nisl. Fusce scelerisque ultricies aliquet. Donec egestas, nisl eu blandit commodo, magna ex lacinia ex, sed faucibus magna urna id quam. Nam eget gravida turpis, sit amet accumsan lacus. In efficitur lorem consequat, viverra augue sit amet, interdum turpis. Mauris malesuada, ex vel dignissim varius, nisl magna mattis magna, a eleifend massa neque sit amet velit. Nulla dapibus odio nec congue fringilla. Proin nec nunc ut tellus dapibus vehicula et in diam. Aenean eget dolor eget massa fringilla lobortis id porttitor tortor. Phasellus erat turpis, elementum et augue vitae, elementum lobortis ex. Etiam quam massa, egestas nec turpis at, efficitur varius tellus. Sed leo eros, pretium sit amet purus sit amet, auctor cursus ligula. Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem.\r\n\r\nPhasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-02-23 00:00:00'),
(4, 'EPISODE 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tristique quam ac pretium. Nunc pulvinar, felis eget scelerisque cursus, tortor odio pulvinar erat, eget vestibulum sem turpis id purus. Donec laoreet nulla quis risus malesuada, ut iaculis tellus suscipit. Morbi eleifend vulputate rhoncus. Etiam ac sagittis arcu. Morbi et volutpat purus, quis scelerisque tortor. Phasellus porttitor erat id turpis pretium, sit amet egestas dolor luctus. Mauris maximus aliquet elementum. Mauris id ultrices metus.\r\n\r\nAenean rutrum non elit rhoncus posuere. Aenean mollis sodales urna nec imperdiet. Aliquam rutrum commodo est sit amet sagittis. Nunc vulputate rhoncus mi vitae vehicula. Integer nec orci ultricies, mollis justo et, aliquet urna. Mauris ullamcorper neque sit amet massa gravida, non semper diam eleifend. Fusce porttitor velit lacus, in ultricies leo facilisis nec.\r\n\r\nProin non venenatis sem, sit amet tincidunt eros. Sed velit dolor, fermentum id vulputate a, gravida in nisl. Fusce scelerisque ultricies aliquet. Donec egestas, nisl eu blandit commodo, magna ex lacinia ex, sed faucibus magna urna id quam. Nam eget gravida turpis, sit amet accumsan lacus. In efficitur lorem consequat, viverra augue sit amet, interdum turpis. Mauris malesuada, ex vel dignissim varius, nisl magna mattis magna, a eleifend massa neque sit amet velit. Nulla dapibus odio nec congue fringilla. Proin nec nunc ut tellus dapibus vehicula et in diam. Aenean eget dolor eget massa fringilla lobortis id porttitor tortor. Phasellus erat turpis, elementum et augue vitae, elementum lobortis ex. Etiam quam massa, egestas nec turpis at, efficitur varius tellus. Sed leo eros, pretium sit amet purus sit amet, auctor cursus ligula. Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem.\r\n\r\nPhasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-02-25 00:00:00'),
(5, 'EPISODE 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tristique quam ac pretium. Nunc pulvinar, felis eget scelerisque cursus, tortor odio pulvinar erat, eget vestibulum sem turpis id purus. Donec laoreet nulla quis risus malesuada, ut iaculis tellus suscipit. Morbi eleifend vulputate rhoncus. Etiam ac sagittis arcu. Morbi et volutpat purus, quis scelerisque tortor. Phasellus porttitor erat id turpis pretium, sit amet egestas dolor luctus. Mauris maximus aliquet elementum. Mauris id ultrices metus.\r\n\r\nAenean rutrum non elit rhoncus posuere. Aenean mollis sodales urna nec imperdiet. Aliquam rutrum commodo est sit amet sagittis. Nunc vulputate rhoncus mi vitae vehicula. Integer nec orci ultricies, mollis justo et, aliquet urna. Mauris ullamcorper neque sit amet massa gravida, non semper diam eleifend. Fusce porttitor velit lacus, in ultricies leo facilisis nec.\r\n\r\nProin non venenatis sem, sit amet tincidunt eros. Sed velit dolor, fermentum id vulputate a, gravida in nisl. Fusce scelerisque ultricies aliquet. Donec egestas, nisl eu blandit commodo, magna ex lacinia ex, sed faucibus magna urna id quam. Nam eget gravida turpis, sit amet accumsan lacus. In efficitur lorem consequat, viverra augue sit amet, interdum turpis. Mauris malesuada, ex vel dignissim varius, nisl magna mattis magna, a eleifend massa neque sit amet velit. Nulla dapibus odio nec congue fringilla. Proin nec nunc ut tellus dapibus vehicula et in diam. Aenean eget dolor eget massa fringilla lobortis id porttitor tortor. Phasellus erat turpis, elementum et augue vitae, elementum lobortis ex. Etiam quam massa, egestas nec turpis at, efficitur varius tellus. Sed leo eros, pretium sit amet purus sit amet, auctor cursus ligula. Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem.\r\n\r\nPhasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-02-27 00:00:00'),
(6, 'EPISODE 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tristique quam ac pretium. Nunc pulvinar, felis eget scelerisque cursus, tortor odio pulvinar erat, eget vestibulum sem turpis id purus. Donec laoreet nulla quis risus malesuada, ut iaculis tellus suscipit. Morbi eleifend vulputate rhoncus. Etiam ac sagittis arcu. Morbi et volutpat purus, quis scelerisque tortor. Phasellus porttitor erat id turpis pretium, sit amet egestas dolor luctus. Mauris maximus aliquet elementum. Mauris id ultrices metus.\r\n\r\nAenean rutrum non elit rhoncus posuere. Aenean mollis sodales urna nec imperdiet. Aliquam rutrum commodo est sit amet sagittis. Nunc vulputate rhoncus mi vitae vehicula. Integer nec orci ultricies, mollis justo et, aliquet urna. Mauris ullamcorper neque sit amet massa gravida, non semper diam eleifend. Fusce porttitor velit lacus, in ultricies leo facilisis nec.\r\n\r\nProin non venenatis sem, sit amet tincidunt eros. Sed velit dolor, fermentum id vulputate a, gravida in nisl. Fusce scelerisque ultricies aliquet. Donec egestas, nisl eu blandit commodo, magna ex lacinia ex, sed faucibus magna urna id quam. Nam eget gravida turpis, sit amet accumsan lacus. In efficitur lorem consequat, viverra augue sit amet, interdum turpis. Mauris malesuada, ex vel dignissim varius, nisl magna mattis magna, a eleifend massa neque sit amet velit. Nulla dapibus odio nec congue fringilla. Proin nec nunc ut tellus dapibus vehicula et in diam. Aenean eget dolor eget massa fringilla lobortis id porttitor tortor. Phasellus erat turpis, elementum et augue vitae, elementum lobortis ex. Etiam quam massa, egestas nec turpis at, efficitur varius tellus. Sed leo eros, pretium sit amet purus sit amet, auctor cursus ligula. Cras quis est varius, ornare mauris non, finibus quam. Integer sagittis, lectus eu venenatis dictum, justo enim bibendum magna, ut pretium metus urna sit amet felis. Etiam ut ante sit amet risus condimentum pulvinar sit amet eu lorem.\r\n\r\nPhasellus feugiat volutpat sagittis. Ut suscipit arcu ac sollicitudin pulvinar. Sed sit amet ultrices enim, eget feugiat turpis. Mauris tincidunt massa maximus, interdum mauris in, rhoncus diam. Nullam posuere volutpat pulvinar. Maecenas pellentesque pretium libero, non rhoncus est viverra eu. Ut iaculis id est ut iaculis. Aenean et metus nulla. Quisque non diam a ipsum vehicula bibendum vel vel dolor. Sed sit amet vestibulum dui, ut lacinia arcu.', '2019-03-01 00:00:00');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
