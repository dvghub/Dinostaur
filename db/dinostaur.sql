-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2019 at 06:04 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dinostaur`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT '1000-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_price`, `date`) VALUES
(6, 2, 35, '1000-01-01'),
(7, 2, 35, '1000-01-01'),
(8, 12, 1295, '1000-01-01'),
(9, 10, 915, '1000-01-01'),
(10, 5, 265, '2019-10-07'),
(11, 9, 440, '2019-10-07'),
(12, 9, 105, '2019-10-10'),
(13, 15, 360, '2019-10-15'),
(14, 15, 165, '2019-10-15'),
(15, 2, 140, '2019-10-17'),
(16, 2, 230, '2019-10-17'),
(17, 2, 140, '2019-10-17'),
(18, 2, 230, '2019-10-17'),
(19, 1, 325, '2019-10-17'),
(20, 2, 405, '2019-10-18'),
(21, 2, 595, '2019-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `product_amount`, `id`) VALUES
(6, 10, 1, 8),
(6, 15, 1, 9),
(6, 16, 1, 10),
(7, 10, 1, 11),
(7, 15, 1, 12),
(7, 16, 1, 13),
(8, 24, 9, 14),
(8, 22, 6, 15),
(8, 11, 1, 16),
(8, 21, 1, 17),
(8, 27, 10, 18),
(9, 20, 5, 19),
(9, 23, 1, 20),
(9, 17, 5, 21),
(9, 10, 10, 22),
(9, 26, 8, 23),
(10, 14, 1, 24),
(10, 16, 8, 25),
(11, 10, 3, 26),
(11, 19, 12, 27),
(11, 26, 7, 28),
(12, 26, 3, 29),
(13, 21, 5, 30),
(13, 27, 1, 31),
(13, 22, 3, 32),
(14, 11, 11, 33),
(15, 15, 1, 34),
(15, 20, 1, 35),
(15, 27, 1, 36),
(16, 17, 6, 37),
(16, 15, 3, 38),
(16, 13, 3, 39),
(16, 23, 5, 40),
(17, 15, 1, 41),
(17, 20, 1, 42),
(17, 27, 1, 43),
(18, 17, 6, 44),
(18, 15, 3, 45),
(18, 13, 3, 46),
(18, 23, 5, 47),
(19, 15, 12, 48),
(19, 13, 3, 49),
(20, 28, 4, 50),
(20, 22, 7, 51),
(20, 13, 1, 52),
(21, 28, 5, 53),
(21, 19, 1, 54),
(21, 17, 3, 55),
(21, 18, 7, 56);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(99) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'img/placeholder.png',
  `price` int(11) NOT NULL,
  `description` varchar(999) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tags` set('all','triassic','jurassic','cretaceous','land','marine','avian','reptile','mammal','bird','amphib','omni','herbi','carni') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `description`, `tags`) VALUES
(10, 'Eoraptor', 'img/eoraptor.jpg', 15, 'Earliest identified true dinosaur from middle Triassic period. Its name means \'dawn thief\'. It was a two-legged dinosaur, evolved from the middle Triassic period\'s archosaurs. Based on its heterodont teeth, it is believed to have been an omnivore. Despite its name, the Eoraptor is not a true raptor.', 'all,triassic,land,reptile,omni'),
(11, 'Nothosaurus', 'img/nothosaurus.jpg', 15, 'This \'fake lizard\' lived in oceans worldwide during the Triassic period. It was not as well-adapted to full-time aquatic life as later pliosaurs and plesiosaurs. It had nostrils, leading paleontologists to believe this animal spent at least some of its time on land. It\'s one of the most important marine reptiles on record, and many different species of Nothosaurus have been found all over the world.', 'all,triassic,reptile,amphib,carni'),
(12, 'Diplodocus', 'img/diplodocus.jpg', 25, 'One of the biggest North American late Jurassic dinosaurs. More fossils have been found than of just about any other dinosaur. It is definitely the longest dinosaur to have ever lived, and it most likely used its long neck to sweep over the ground to find and eat shrubs and bushes. It\'s front legs were quite a big shorter than its hind legs, making it walk head-down, ass-high. Science isn\'t clear yet about why this might be the case. Its size was the only thing keeping it safe. It was barely smarter than the plants it ate, but the sheer mass of the thing meant it had no natural enemies as an adult.', 'all,jurassic,land,reptile,herbi'),
(13, 'Troodon', 'img/troodon.jpg', 5, 'This small, bird-like dinosaur had the comparatively biggest brain of its time, making it about as smart as a chicken.', 'all,cretaceous,land,reptile'),
(14, 'Elasmosaurus', 'img/elasmosaurus.jpg', 225, 'This was one of the biggest plesiosaurs that ever lived, although it couldn\'t compare in size to ichthyosaurs, pliosaurs and mosasaurs. It was so big, it couldn\'t lift anything other than its tiny head up out of the water, unless it was sitting in a shallow puddle. Elasmosaurus probably gave birth to live young, like another closely related plesiosaur, although no concrete evidence of this has surfaced yet. This is the dinosaur most commonly assumed to be the true identity of Nessie.', 'all,triassic,jurassic,cretaceous,marine,reptile'),
(15, 'Kronosaurus', 'img/kronosaur.jpg', 25, 'Second to largest pliosaur known to date, only surpassed by the Liopleurodon. Its big teeth were not very sharp, but it made up for that with en extremely strong bite and high speed. Based on the places its fossils have been found, it may well have been found all over the world. Better-adapted sharks and mosasaurs were eventually its downfall.', 'all,cretaceous,marine,reptile,carni'),
(16, 'Pteranodon', 'img/pteranodon.jpg', 5, 'The most well known of pterasaur, albeit under a different name. This is the animal most people think of when they hear \'pterodactyl\'. Contrary to popular belief, they are only distantly related to prehistoric birds, and they were not feathered. Their \'wings\' were made of skin rather than feathers and it most likely was a glider rather than a flyer. It is believed they spent most of their time with both feet solidly on the ground.', 'all,cretaceous,avian,reptile,carni'),
(17, 'Shonisaurus', 'img/shonisaurus.jpg', 15, '[Insert wikipedia knowledge]', 'all,triassic,marine,reptile,carni'),
(18, 'Herrerasaurus', 'img/herrerasaurus.jpg', 55, '[Wikipedia yada yada]', 'all,triassic,land,reptile,carni'),
(19, 'Eudimorphodon', 'img/eudimorphodon.jpg', 15, '[Something about dimorphic teeth]', 'all,triassic,avian,reptile,carni'),
(20, 'Brachiosaurus', 'img/brachiosaurus.jpg', 100, '[Long misunderstood dude easily confused with giraffatitan or branchiosaurus]', 'all,jurassic,land,reptile,herbi'),
(21, 'Allosaurus', 'img/allosaurus.jpg', 45, '[Less well known T. Rex-like theropod]', 'all,jurassic,land,reptile,carni'),
(22, 'Archaeopteryx', 'img/archaeopteryx.jpg', 150, '[Tiny old not-quite birds.]', 'all,jurassic,avian,reptile,carni'),
(23, 'Quetzalcoatlus', 'img/quetzalcoatlus.jpg', 10, '[Big controversial birb]', 'all,cretaceous,land,avian,reptile,carni'),
(24, 'Styracosaurus', 'img/styracosaurus.jpg', 95, '[Prehistoric punk cow]', 'all,cretaceous,land,reptile,herbi'),
(25, 'Repenomamus', 'img/repenomamus.jpg', 40, '[Dinosaur-eating badass]', 'all,cretaceous,land,mammal,carni'),
(26, 'Buitreraptor', 'img/buitreraptor.jpg', 35, '[Terror chicken]', 'all,cretaceous,land,reptile,carni'),
(27, 'Stegoceras', 'img/stegoceras.jpg', 15, '[Bird goat]', 'all,cretaceous,land,reptile,herbi'),
(28, 'Cryptoclidus', 'img/cryptoclidus.jpg', 30, '[Garbage fish.]', 'all,jurassic,marine,reptile,carni'),
(30, 'Confuciusornis', 'img/confuciusornis.jpg', 65, '[Old crow]', 'all,cretaceous,avian,bird,omni'),
(31, 'Triceratops', 'img/triceratops.jpg', 65, '[Triceratops.]', 'all,cretaceous,land,reptile,herbi'),
(32, 'Thescelosaurus', 'img/thescelosaurus.jpg', 20, '[Wonderful lizard.]', 'all,cretaceous,land,reptile,herbi'),
(33, 'Edmontonia', 'img/edmontonia.jpg', 15, '[Big armadillo.]', 'all,cretaceous,land,reptile,herbi'),
(34, 'Riojasaurus', 'img/riojasaurus.jpg', 105, '[Another big lizard.]', 'all,cretaceous,land,reptile,omni'),
(35, 'Sinraptor', 'img/sinraptor.jpg', 250, '[SIN RAPTOR (Chinese plunderer).]', 'all,cretaceous,land,reptile,herbi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `admin`) VALUES
(1, 'name@email.com', 'name', '$2a$10$MD7lISpvkPoCYqBgcQdp6OSVZwdh8d0qYmUZhFZRbgxXkyxGFWevu', 1),
(2, 'staff@ethlan.fr', 'imval', '$2a$10$EUL.EpbioXOl04c2Piyj/.KJf9BOreyuKv2VifkHv/XLFnrra0bru', 0),
(3, 'entry@email.com', 'third entry', '$2a$10$tfS/NhiPw.d9gXcaPrktJuBqLqZ.vmbvPbysEyhgUIOgmocxPTJrm', 0),
(4, 'fourth.entry@email.com', 'fourth entry', '$2a$10$xLJej08GozzCfiB5CSmcNun8IWduAM4SOWjLhFtgsVkfih6tcw0.a', 0),
(5, 'error@test.com', 'error test', '$2a$10$xcs6xpPKYQcaK147Bn6uxOixDjVUO6P6zCk/8F8sr1ickbPUTgnrq', 0),
(6, 'reggy@test.com', 'reggy', '$2a$10$890sZTG5rWgaI9/1.32yy.vo2TXA3Y6zF82ZNgdXQu7QHF/sdCAMi', 0),
(7, 'tester@email.com', 'tester one', '$2a$10$/G.5YdOrmuyGm9C4OtIVQO5WaOLieHV8Oebmyk9lD9DrElMH7uaS6', 0),
(8, 'nernjrn@nruvnrei.ru', 'erjvwigbi', '$2a$10$890sZTG5rWgaI9/1.32yy.vo2TXA3Y6zF82ZNgdXQu7QHF/sdCAMi', 0),
(9, 'a@a.a', 'a', '$2a$10$6FV0/lPSjUjUDhSCcXrmY.LldlZfknHAFUfBj0O5JYXH.BtJpFvny', 0),
(10, 'trogg@good.music', 'trogg', '$2a$10$8H2z4a0STlbteTzU1xiPWu6iEB.jkyYF4A/7WUvulHg2t/s8YPJiy', 0),
(11, 'test@email.com', 'test', '$2a$10$PZIlP.HA39wgAJGGJP3aIu.RKPVdC2ZXI/RbSecgyWd5XDAYm6lg.', 0),
(12, 'b@b.b', 'b', '$2a$10$sb4E446XA6EhetPmsMEu.up4cyFvMEwtD8jE2Fbx9qnAcrhbR6uyC', 0),
(13, 'namename@email.com', 'name', '$2a$10$0Mm5T8FmVOyNoou4Li3Yxunr9dJ6FlfmHtsNDGpMK32tRuVWU0Dn2', 0),
(14, 'uwecu@nvrun.gnri', 'wueuowb', '$2a$10$5YTvu0rj08hwHRl1bMl7DuZFJAZRLd9jiozg9fopqqzRK2x17YiWq', 0),
(15, 'person@email.com', 'new person', '$2a$10$VcFgz1vGqSrsQxKfCNUojOasfgHQE2KOC9AYNo3/zvZdHGksM4vQ6', 0),
(16, 'justin@solid-optics.eu', 'Michel', '$2a$10$Ey7sDxqEWGBSd.cNNkx8NePK3vDM0jsMD2RVkzi8qlxBo95Irbx5W', 0),
(17, 'road@runner.com', 'road runner', '$2a$10$yeUE7WWcwzfGl8a6RAxJrevW3nh7MbWaZybncfJBRqLlMnQNb3Zba', 0),
(18, 'aegus@v.com', 'aegus', '$2y$10$CE6bLXEp23gy0MSsYWT7b.4bfSq1gY3XagqEj/7kPrabUOc2aQMFa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
