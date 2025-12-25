-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 25, 2025 at 08:10 PM
-- Server version: 8.0.41
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE `adresse` (
  `id` int NOT NULL,
  `numero_porte` int NOT NULL,
  `rue` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_postal` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `province` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pays` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adresse`
--

INSERT INTO `adresse` (`id`, `numero_porte`, `rue`, `ville`, `code_postal`, `province`, `pays`) VALUES
(37, 1, 'de la rue', 'Quebec', 'G8W7N6', 'Quebec', 'Canada'),
(1, 123, 'perlinpinpin', 'Quelquepart', 'H0H0H0', 'ici', 'labas'),
(2, 321, 'PetitPain', 'Boulanger', 'P4N4I5', 'ici', 'labas'),
(5, 555, 'RRRR', 'CCCC', 'H8H8H3', 'PPP', 'COCO'),
(3, 978, 'Floopy', 'Bloopy', 'B0B0B0', 'Sloopy', 'Gloopeur'),
(12, 2320, 'De la belle patate', 'Québec', 'g2q3d2', 'Québec', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `bibliotheque`
--

CREATE TABLE `bibliotheque` (
  `id` int NOT NULL,
  `Nom` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bibliotheque`
--

INSERT INTO `bibliotheque` (`id`, `Nom`, `adresse_id`) VALUES
(1, 'La belle pomme', 2),
(2, 'L\'oiseau des champs', 5),
(3, 'Le tournesol', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `id` int NOT NULL,
  `emp_nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `salaire` int NOT NULL,
  `date_embauche` date NOT NULL,
  `bibli_id` int NOT NULL,
  `adresse_id` int NOT NULL,
  `emp_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `emp_mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`id`, `emp_nom`, `salaire`, `date_embauche`, `bibli_id`, `adresse_id`, `emp_user`, `emp_mdp`) VALUES
(1, 'Monique', 7, '2000-12-12', 1, 1, 'Monique01', '$2y$10$1i5MneqZ7ZbOSWYjHM969u5IRvO.dDHFn8VibgTefXMB7bh.a7Wky'),
(4, 'Manon Tremblay', 90, '2025-09-01', 2, 12, 'Manon01', '$2y$10$cFnyLm8.xmlRqigpK3oqHuA9qZxByLAemfAYLYAEhrBgX02MO738K');

-- --------------------------------------------------------

--
-- Table structure for table `emprunteur`
--

CREATE TABLE `emprunteur` (
  `id` int NOT NULL,
  `emp_nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adresse_id` int NOT NULL,
  `emp_livres_id_1` int DEFAULT NULL,
  `emp_livres_id_2` int DEFAULT NULL,
  `emp_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `emp_mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emprunteur`
--

INSERT INTO `emprunteur` (`id`, `emp_nom`, `email`, `adresse_id`, `emp_livres_id_1`, `emp_livres_id_2`, `emp_user`, `emp_mdp`) VALUES
(32, 'Lucas Minville', 'lucas@email.com', 37, 28, NULL, 'Lucas', '$2y$10$SMUmlV7Y557d.DhDm3Zybew5z9DS.nH/b40KT5A3kSbrXdHoMFFay');

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE `livres` (
  `id` int NOT NULL,
  `titre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `auteur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_publication` date NOT NULL,
  `nombre_pages` int NOT NULL,
  `bibli_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`, `date_publication`, `nombre_pages`, `bibli_id`) VALUES
(1, 'Fifteen first lives of Harry August', 'Claire North', '2014-04-08', 405, 1),
(2, 'Le Vide', 'Patrick Senécal', '2007-02-21', 642, 2),
(3, 'Le Parfum', 'Patrick Süskind', '1986-01-01', 279, 3);

-- --------------------------------------------------------

--
-- Table structure for table `livres_emprunte`
--

CREATE TABLE `livres_emprunte` (
  `id` int NOT NULL,
  `demande_emprunt` tinyint(1) DEFAULT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour_max` date NOT NULL,
  `date_retour` date DEFAULT NULL,
  `emprunteur_id` int NOT NULL,
  `livres_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livres_emprunte`
--

INSERT INTO `livres_emprunte` (`id`, `demande_emprunt`, `date_emprunt`, `date_retour_max`, `date_retour`, `emprunteur_id`, `livres_id`) VALUES
(28, 1, '2025-09-02', '2025-09-16', NULL, 32, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_porte` (`numero_porte`,`rue`,`ville`,`code_postal`,`province`,`pays`);

--
-- Indexes for table `bibliotheque`
--
ALTER TABLE `bibliotheque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adresse_id` (`adresse_id`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_user` (`emp_user`),
  ADD KEY `bibli_id` (`bibli_id`),
  ADD KEY `emp_address_id` (`adresse_id`);

--
-- Indexes for table `emprunteur`
--
ALTER TABLE `emprunteur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_user` (`emp_user`),
  ADD KEY `adresse` (`adresse_id`),
  ADD KEY `emp_livres_1` (`emp_livres_id_1`),
  ADD KEY `emp_livres_2` (`emp_livres_id_2`);

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bibli_id` (`bibli_id`);

--
-- Indexes for table `livres_emprunte`
--
ALTER TABLE `livres_emprunte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livres` (`livres_id`),
  ADD KEY `emprunteur` (`emprunteur_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `bibliotheque`
--
ALTER TABLE `bibliotheque`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emprunteur`
--
ALTER TABLE `emprunteur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `livres_emprunte`
--
ALTER TABLE `livres_emprunte`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bibliotheque`
--
ALTER TABLE `bibliotheque`
  ADD CONSTRAINT `adresse_id` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `bibli_id` FOREIGN KEY (`bibli_id`) REFERENCES `bibliotheque` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `emp_address_id` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `emprunteur`
--
ALTER TABLE `emprunteur`
  ADD CONSTRAINT `adresse` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `emp_livre_id` FOREIGN KEY (`emp_livres_id_1`) REFERENCES `livres_emprunte` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `emp_livre_id_2` FOREIGN KEY (`emp_livres_id_2`) REFERENCES `livres_emprunte` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `bibliotheque` FOREIGN KEY (`bibli_id`) REFERENCES `bibliotheque` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `livres_emprunte`
--
ALTER TABLE `livres_emprunte`
  ADD CONSTRAINT `livres` FOREIGN KEY (`livres_id`) REFERENCES `livres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
