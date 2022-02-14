-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 04:08 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `Directions`
--

CREATE TABLE `Directions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Directions`
--

INSERT INTO `Directions` (`id`, `name`) VALUES
(1, 'Use a food processor to grind the pork rinds up into a fine powder. Preheat your oven to 350°F.'),
(2, 'In a mixing bowl add the powdered pork rinds, 3 eggs, and water. Mix well.'),
(3, ' Preheat a frying pan over medium heat. Add 1-2 tablespoons of butter.  When it becomes hot and stops foaming,  ladle a large scoop of the batter into the pan. Spread it out into a large pancake shape.  Wait until the batter bubbles and is brown around the edges before carefully flipping. After the “tortilla” is cooked on both sides set it aside and start a new one in the pan.  Continue until you use up all the batter, there will be about 4 pieces.'),
(4, ' Brush the bottom of a 9-inch pie pan with melted butter, then add a piece of the cooked pork rind batter. Break up the other pieces to fully cover the edges, but make sure to reserve one for the top of the cake. Brush with melted butter and sprinkle liberally with the cinnamon/erythritol mixture. Bake for 5-10 minutes.'),
(5, 'Use a hand mixer to blend the softened cream cheese, Swerve confectioners, remaining 2 eggs, and vanilla extract.'),
(6, 'Spread the cheesecake mixture over the bottom crust.'),
(7, 'Cut the remaining piece of cooked pork rind batter into wedges and arrange over the top. Sprinkle liberally with the cinnamon/erythritol mixture.'),
(8, 'Bake for 20 minutes then allow to cool before serving.');

-- --------------------------------------------------------

--
-- Table structure for table `Ingredient`
--

CREATE TABLE `Ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Ingredient`
--

INSERT INTO `Ingredient` (`id`, `name`) VALUES
(1, 'egg'),
(2, 'salt'),
(3, 'sugar'),
(4, 'chocolate'),
(5, 'vanilla extract'),
(6, 'flour'),
(7, 'water'),
(8, 'butter, melted'),
(9, 'granulated erythritol'),
(10, 'cinnamon'),
(11, 'cream cheese, softened'),
(13, 'pork rinds'),
(14, 'Swerve confectioners');

-- --------------------------------------------------------

--
-- Table structure for table `Measure`
--

CREATE TABLE `Measure` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Measure`
--

INSERT INTO `Measure` (`id`, `name`) VALUES
(1, 'cup'),
(2, 'teaspoon'),
(3, 'tablespoon'),
(4, 'ounces');

-- --------------------------------------------------------

--
-- Table structure for table `Recipe`
--

CREATE TABLE `Recipe` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `description` text,
  `instructions` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Recipe`
--

INSERT INTO `Recipe` (`id`, `name`, `description`, `instructions`) VALUES
(1, 'Sopapilla Cheesecake', 'Here\'s an easy, low-carb, sopapilla cheesecake! Instead of a traditional crust, we will substitute a pork rind based dough. This means that you don\'t have to blind bake a pie crust. You can pan-fry the layers instead. Then this dessert gets layered with a quick cheesecake. It\'s topped with another layer of pan-fried dough, then a generous dusting of cinnamon and erythritol.  I think you\'ll love serving this dessert with a nice cup of hot coffee.', ''),
(2, 'Chocolate Cake', 'Yummy cake', 'Add eggs, flour, chocolate to pan. Bake at 350 for 1 hour');

-- --------------------------------------------------------

--
-- Table structure for table `RecipeDirections`
--

CREATE TABLE `RecipeDirections` (
  `recipe_id` int(11) NOT NULL,
  `directions_id` int(11) NOT NULL,
  `images` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RecipeDirections`
--

INSERT INTO `RecipeDirections` (`recipe_id`, `directions_id`, `images`) VALUES
(1, 1, ''),
(1, 2, ''),
(1, 3, ''),
(1, 4, ''),
(1, 5, ''),
(1, 6, ''),
(1, 7, ''),
(1, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `RecipeIngredient`
--

CREATE TABLE `RecipeIngredient` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `measure_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RecipeIngredient`
--

INSERT INTO `RecipeIngredient` (`recipe_id`, `ingredient_id`, `measure_id`, `amount`) VALUES
(1, 13, 4, 4),
(1, 1, NULL, 5),
(1, 7, 1, 1),
(1, 8, 3, 4),
(1, 9, 3, 2),
(1, 11, 4, 16),
(1, 14, 1, 1),
(1, 5, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Directions`
--
ALTER TABLE `Directions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Ingredient`
--
ALTER TABLE `Ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Measure`
--
ALTER TABLE `Measure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Recipe`
--
ALTER TABLE `Recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RecipeDirections`
--
ALTER TABLE `RecipeDirections`
  ADD KEY `fk_directions` (`directions_id`),
  ADD KEY `fk_recipe` (`recipe_id`);

--
-- Indexes for table `RecipeIngredient`
--
ALTER TABLE `RecipeIngredient`
  ADD KEY `fk_recipe` (`recipe_id`),
  ADD KEY `fk_ingredient` (`ingredient_id`),
  ADD KEY `fk_measure` (`measure_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Directions`
--
ALTER TABLE `Directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Ingredient`
--
ALTER TABLE `Ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Measure`
--
ALTER TABLE `Measure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Recipe`
--
ALTER TABLE `Recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `RecipeDirections`
--
ALTER TABLE `RecipeDirections`
  ADD CONSTRAINT `fk_directions` FOREIGN KEY (`directions_id`) REFERENCES `Directions` (`id`),
  ADD CONSTRAINT `fkrecipe` FOREIGN KEY (`recipe_id`) REFERENCES `Recipe` (`id`);

--
-- Constraints for table `RecipeIngredient`
--
ALTER TABLE `RecipeIngredient`
  ADD CONSTRAINT `fk_ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `Ingredient` (`id`),
  ADD CONSTRAINT `fk_measure` FOREIGN KEY (`measure_id`) REFERENCES `Measure` (`id`),
  ADD CONSTRAINT `fk_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `Recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
