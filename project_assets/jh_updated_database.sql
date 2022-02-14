-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2018 at 07:47 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bellsweb_mgr`
--

-- --------------------------------------------------------

--
-- Table structure for table `directions`
--

CREATE TABLE `directions` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `instruction` varchar(1000) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `directions`
--

INSERT INTO `directions` (`id`, `recipe_id`, `instruction`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Use a food processor to grind the pork rinds up into a fine powder. Preheat your oven to 350F.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(2, 1, 'In a mixing bowl add the powdered pork rinds, 3 eggs, and water. Mix well.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(3, 1, 'Preheat a frying pan over medium heat. Add 1-2 tablespoons of butter. When it becomes hot and stops foaming, ladle a large scoop of the batter into the pan. Spread it out into a large pancake shape. Wait until the batter bubbles and is brown around the edges before carefully flipping. After the tortilla is cooked on both sides set it aside and start a new one in the pan. Continue until you use up all the batter, there will be about 4 pieces.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(4, 1, 'Brush the bottom of a 9-inch pie pan with melted butter, then add a piece of the cooked pork rind batter. Break up the other pieces to fully cover the edges, but make sure to reserve one for the top of the cake. Brush with melted butter and sprinkle liberally with the cinnamon/erythritol mixture. Bake for 5-10 minutes.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(5, 1, 'Use a hand mixer to blend the softened cream cheese, Swerve confectioners, remaining 2 eggs, and vanilla extract.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(6, 1, 'Spread the cheesecake mixture over the bottom crust.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(7, 1, 'Cut the remaining piece of cooked pork rind batter into wedges and arrange over the top. Sprinkle liberally with the cinnamon/erythritol mixture.', NULL, '2018-12-03 17:58:59', '2018-12-03 17:58:59'),
(21, 1, 'Bake for 20 minutes then allow to cool before serving.', NULL, '2018-12-07 17:17:01', '2018-12-07 17:17:30'),
(22, 11, '', NULL, '2018-12-07 17:19:51', '2018-12-07 17:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `duration_types`
--

CREATE TABLE `duration_types` (
  `id` int(11) NOT NULL,
  `duration` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duration_types`
--

INSERT INTO `duration_types` (`id`, `duration`) VALUES
(1, 'second'),
(2, 'minute'),
(3, 'hour'),
(4, 'day');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `measure_amount` int(11) DEFAULT NULL,
  `measurement_type_id` int(11) DEFAULT NULL,
  `ingredient_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `recipe_id`, `measure_amount`, `measurement_type_id`, `ingredient_name`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 5, 'pork rinds', '2018-12-03 17:59:29', '2018-12-07 17:16:53'),
(2, 1, 5, 1, 'egg', '2018-12-03 17:59:29', '2018-12-07 17:16:53'),
(3, 1, 1, 6, 'water', '2018-12-03 17:59:29', '2018-12-07 17:16:53'),
(10, 1, 4, 3, 'granulated erythritol', '2018-12-03 17:59:29', '2018-12-07 17:16:53'),
(26, 1, 16, 5, 'cream cheese, softened', '2018-12-07 17:15:38', '2018-12-07 17:16:53'),
(27, 1, 1, 6, 'Swerve confectioners', '2018-12-07 17:17:07', '2018-12-07 17:17:30'),
(28, 1, 2, 4, 'vanilla extract', '2018-12-07 17:17:08', '2018-12-07 17:17:30'),
(29, 11, 1, 6, 'sugar', '2018-12-07 17:19:51', '2018-12-07 17:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `measurement_types`
--

CREATE TABLE `measurement_types` (
  `id` int(11) NOT NULL,
  `measurement_type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measurement_types`
--

INSERT INTO `measurement_types` (`id`, `measurement_type`) VALUES
(1, 'none'),
(2, 'pound'),
(3, 'tablespoon'),
(4, 'teaspoon'),
(5, 'ounce'),
(6, 'cup'),
(8, 'liter'),
(9, 'gram'),
(10, 'kilogram');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `serving_size` int(11) DEFAULT NULL,
  `prep_time` int(11) DEFAULT NULL,
  `prep_time_duration` varchar(55) DEFAULT NULL,
  `cook_time` int(11) DEFAULT NULL,
  `cook_time_duration` varchar(55) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `serving_size`, `prep_time`, `prep_time_duration`, `cook_time`, `cook_time_duration`, `created_at`, `updated_at`) VALUES
(1, 'Sopapilla Cheesecake', 'Here&#39;s an easy, low-carb, sopapilla cheesecake! Instead of a traditional crust, we will substitute a pork rind based dough. This means that you don&#39;t have to blind bake a pie crust. You can pan-fry the layers instead. Then this dessert gets layered with a quick cheesecake. It&#39;s topped with another layer of pan-fried dough, then a generous dusting of cinnamon and erythritol. I think you&#39;ll love serving this dessert with a nice cup of hot coffee.', 4, 2, 'hour', 456, 'second', '2018-11-29 18:49:48', '2018-12-07 17:16:53'),
(11, 'Chocolate Cake', 'Yummy cake	', 4, 30, 'minute', 30, 'minute', '2018-12-07 17:19:51', '2018-12-07 17:19:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duration_types`
--
ALTER TABLE `duration_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `measurement_types`
--
ALTER TABLE `measurement_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `directions`
--
ALTER TABLE `directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `duration_types`
--
ALTER TABLE `duration_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `measurement_types`
--
ALTER TABLE `measurement_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
