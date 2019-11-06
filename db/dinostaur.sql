-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2019 at 11:54 PM
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
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `total_price`) VALUES
(2, 1, 1035),
(3, 1, 5),
(4, 1, 1025),
(5, 1, 0),
(6, 2, 35),
(7, 2, 35);

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
(2, 14, 4, 1),
(2, 12, 5, 2),
(2, 13, 2, 3),
(3, 10, 1, 4),
(4, 11, 5, 5),
(4, 14, 4, 6),
(4, 16, 10, 7),
(6, 10, 1, 8),
(6, 15, 1, 9),
(6, 16, 1, 10),
(7, 10, 1, 11),
(7, 15, 1, 12),
(7, 16, 1, 13);

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
  `tags` set('all','triassic','jurassic','cretaceous','land','marine','avian','reptile','mammal','bird','amphib','omni','herbi','carni') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `description`, `tags`) VALUES
(10, 'Eoraptor', 'img/eoraptor.jpg', 5, 'Earliest identified true dinosaur from middle Triassic period. Its name means  \'dawn thief\'. It was a two-legged dinosaur, evolved from the middle Triassic period\'s archosaurs. Based on its heterodont teeth, it is believed to have been an omnivore. Despite its name, the Eoraptor is not a true raptor.', 'all,triassic,land,reptile,omni'),
(11, 'Nothosaurus', 'img/nothosaurus.jpg', 15, 'This \'fake lizard\' lived in oceans worldwide during the Triassic period. It was not as well-adapted to full-time aquatic life as later pliosaurs and plesiosaurs. It had nostrils, leading paleontologists to believe this animal spent at least some of its time on land. It\'s one of the most important marine reptiles on record, and many different species of Nothosaurus have been found all over the world.', 'all,triassic,reptile,amphib,carni'),
(12, 'Diplodocus', 'img/diplodocus.jpg', 25, 'One of the biggest North American late Jurassic dinosaurs. More fossils have been found than of just about any other dinosaur. It is definitely the longest dinosaur to have ever lived, and it most likely used its long neck to sweep over the ground to find and eat shrubs and bushes. It\'s front legs were quite a big shorter than its hind legs, making it walk head-down, ass-high. Science isn\'t clear yet about why this might be the case. Its size was the only thing keeping it safe. It was barely smarter than the plants it ate, but the sheer mass of the thing meant it had no natural enemies as an adult.', 'all,jurassic,land,reptile,herbi'),
(13, 'Troodon', 'img/troodon.jpg', 5, 'This small, bird-like dinosaur had the comparatively biggest brain of its time, making it about as smart as a chicken.', 'all,cretaceous,land,reptile'),
(14, 'Elasmosaurus', 'img/elasmosaurus.jpg', 225, 'This was one of the biggest plesiosaurs that ever lived, although it couldn\'t compare in size to ichthyosaurs, pliosaurs and mosasaurs. It was so big, it couldn\'t lift anything other than its tiny head up out of the water, unless it was sitting in a shallow puddle. Elasmosaurus probably gave birth to live young, like another closely related plesiosaur, although no concrete evidence of this has surfaced yet. This is the dinosaur most commonly assumed to be the true identity of Nessie.', 'all,triassic,jurassic,cretaceous,marine,reptile'),
(15, 'Kronosaurus', 'img/kronosaur.jpg', 25, 'Second to largest pliosaur known to date, only surpassed by the Liopleurodon. Its big teeth were not very sharp, but it made up for that with en extremely strong bite and high speed. Based on the places its fossils have been found, it may well have been found all over the world. Better-adapted sharks and mosasaurs were eventually its downfall.', 'all,cretaceous,marine,reptile,carni'),
(16, 'Pteranodon', 'img/pteranodon.jpg', 5, 'The most well known of pterasaur, albeit under a different name. This is the animal most people think of when they hear \'pterodactyl\'. Contrary to popular belief, they are only distantly related to prehistoric birds, and they were not feathered. Their \'wings\' were made of skin rather than feathers and it most likely was a glider rather than a flyer. It is believed they spent most of their time with both feet solidly on the ground.', 'all,cretaceous,avian,reptile,carni');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
(1, 'name@email.com', 'name', 'password'),
(2, 'staff@ethlan.fr', 'imval', 'hackmeifyoucan'),
(3, 'entry@email.com', 'third entry', 'goodpassword'),
(4, 'fourth.entry@email.com', 'fourth entry', 'supergoodpassword'),
(5, 'error@test.com', 'error test', 'error'),
(6, 'reggy@test.com', 'reggy', 'p4ss'),
(7, 'tester@email.com', 'tester one', 'password'),
(8, 'nernjrn@nruvnrei.ru', 'erjvwigbi', 'p4ss'),
(9, 'a@a.a', 'a', 'a'),
(10, 'trogg@good.music', 'trogg', 'wildthing'),
(11, 'test@email.com', 'test', 'test'),
(12, 'b@b.b', 'b', 'b'),
(13, 'namename@email.com', 'name', 'password'),
(14, 'uwecu@nvrun.gnri', 'wueuowb', 'pass'),
(15, 'person@email.com', 'new person', 'fantasticpassword'),
(16, 'justin@solid-optics.eu', 'Michel', 'putetete');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
