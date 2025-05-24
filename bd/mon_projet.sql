-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 22 mai 2025 à 19:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mon_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `n_facture` int(11) NOT NULL,
  `date_expi` date DEFAULT NULL,
  `num_regi_pre` int(11) NOT NULL,
  `regi_pre` varchar(80) DEFAULT NULL,
  `regi_pre_old` varchar(30) NOT NULL,
  `bureau_douane` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `n_facture`, `date_expi`, `num_regi_pre`, `regi_pre`, `regi_pre_old`, `bureau_douane`) VALUES
(2, 1209, NULL, 0, '500', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `items_list`
--

CREATE TABLE `items_list` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `item` varchar(70) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `items_list`
--

INSERT INTO `items_list` (`id`, `type`, `item`, `date`) VALUES
(1, 'bureadiwan', 'ميناء الجزائر-شارع بيزيي', '2025-05-10'),
(2, 'client', 'الجزائر', '2025-05-10'),
(3, 'client', 'الطالب العاربي', '2025-05-10'),
(4, 'bureadiwan', 'الطالب العاربي', '2025-05-10'),
(5, 'bureadiwan', 'المغنية', '2025-05-10'),
(6, 'regime', 'المغنية', '2025-05-10'),
(7, 'regime_president', 'حاسي مسعود', '2025-05-10'),
(8, 'regime_president', 'ميناء الجزائر-شارع بيزيي', '2025-05-10'),
(9, 'regime', 'الجزائر', '2025-05-10'),
(10, 'regime', 'حي الاستقلال', '2025-05-10'),
(11, 'client', 'سونطراك', '2025-05-10'),
(12, 'client', 'نافطال', '2025-05-10'),
(13, 'bureadiwan', 'الوادي', '2025-05-21');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_facture` int(11) NOT NULL,
  `n_rep` int(10) DEFAULT NULL,
  `n_facture` text NOT NULL,
  `type` varchar(6) NOT NULL,
  `client` varchar(100) NOT NULL,
  `regime` varchar(50) NOT NULL,
  `type_input` varchar(15) NOT NULL,
  `bureadiwan` varchar(50) DEFAULT NULL,
  `dec_reg_prec` varchar(20) NOT NULL,
  `import_decl` varchar(100) NOT NULL,
  `num_declaration` int(30) NOT NULL,
  `s_n` varchar(100) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `date_declaration` date NOT NULL,
  `Appurement` varchar(10) DEFAULT NULL,
  `paye` varchar(3) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_creation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id_order`, `id_product`, `id_facture`, `n_rep`, `n_facture`, `type`, `client`, `regime`, `type_input`, `bureadiwan`, `dec_reg_prec`, `import_decl`, `num_declaration`, `s_n`, `designation`, `date_declaration`, `Appurement`, `paye`, `status`, `date_creation`) VALUES
(1, 2, 2, 1, '1209', 'sigad', 'Sonatrach', 'الجزائر', 'import', 'الجزائر', '500', '1', 12862110, 'FDR109090H', 'FDR090H', '2025-05-10', NULL, 'oui', '', '2025-05-10'),
(2, 2, 2, 1, '1209', 'sigad', 'الجزائر', 'الجزائر', 'export', 'ميناء الجزائر-شارع بيزيي', '500', '1', 12862110, 'FDR109090H', 'FDR090H', '2025-05-02', NULL, 'oui', '', '2025-05-21'),
(3, 5, 0, NULL, '1212', 'alces', 'نافطال', 'المغنية', 'export', NULL, '12', '', 13, 'azaz', '121212', '2025-05-17', 'global', 'non', '', '2025-05-21'),
(4, 6, 0, NULL, '12', 'alces', 'سونطراك', 'حي الاستقلال', 'import', NULL, '1234', '', 10, 'az32frrd', 'FAz213', '2025-05-16', NULL, 'oui', '', '2025-05-21'),
(5, 7, 0, 2, '6', 'sigad', 'الطالب العاربي', 'المغنية', 'import', 'ميناء الجزائر-شارع بيزيي', '1234', '', 1234, '545', 'GF12', '2025-05-09', NULL, 'non', '', '2025-05-21'),
(6, 8, 0, 3, '9090', 'sigad', 'الجزائر', 'الجزائر', 'import', 'ميناء الجزائر-شارع بيزيي', '12', '', 109, 'kl90', 'kjlk', '2025-05-08', NULL, 'non', '', '2025-05-22');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id_product` int(10) NOT NULL,
  `number_colis` int(10) NOT NULL,
  `qt` int(10) NOT NULL,
  `poids` float NOT NULL,
  `date_add` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id_product`, `number_colis`, `qt`, `poids`, `date_add`) VALUES
(2, 12, 3, 1.871, '2025-05-10'),
(3, 13, 19, 1.871, '2025-05-21'),
(5, 14, 12, 1222.02, '2025-05-21'),
(6, 15, 6, 1.068, '2025-05-21'),
(7, 16, 12, 12, '2025-05-21'),
(8, 1234, 13, 10.104, '2025-05-22');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- Index pour la table `items_list`
--
ALTER TABLE `items_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `items_list`
--
ALTER TABLE `items_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
