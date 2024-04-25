-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 03:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `player_id`, `user_id`, `comment`, `date_posted`) VALUES
(14, 6, 12, 'Erling Haaland, a rising star in the world of football, has taken the sport by storm with his extraordinary talent, lethal goal-scoring ability, and remarkable maturity beyond his years. As one of the most promising young talents in the game, Haaland\'s meteoric rise to prominence is a testament to his innate skill, relentless work ethic, and unwavering determination to succeed.', '2024-04-24 06:42:53'),
(15, 7, 11, 'Thiago Silva, revered as one of the finest defenders of his generation, epitomizes the art of defensive excellence in football. With his impeccable positioning, astute reading of the game, and elegant style of play, Silva has carved out a distinguished career marked by defensive mastery and leadership on the field.', '2024-04-24 06:43:45'),
(16, 8, 11, 'Müller\'s impact extends far beyond the conventional metrics of goals and assists. While his goal-scoring prowess is undeniable, it is his intuitive reading of the game that sets him apart. Whether it\'s creating space for his teammates with intelligent runs or exploiting gaps in the defense with his impeccable positioning, Müller possesses an innate ability to influence the flow of matches in ways that defy traditional analysis.', '2024-04-24 06:49:45'),
(17, 10, 12, 'Since arriving at the Santiago Bernabéu, Vinicius has continued to impress with his fearless style of play and ability to take on defenders with ease. Blessed with exceptional speed and agility, he possesses the rare gift of leaving opposition defenders in his wake as he glides effortlessly across the pitch. His close control and dribbling skills make him a nightmare for defenders to contain, often drawing comparisons to the Brazilian greats who preceded him.', '2024-04-24 06:50:33'),
(18, 11, 12, 'Off the field, Son\'s impact extends beyond the realm of football. He is a beloved figure in South Korea, where he is hailed as a role model and inspiration to aspiring young athletes. His philanthropic efforts, including charitable donations and initiatives to promote youth development, have further endeared him to fans and earned him widespread admiration.', '2024-04-24 06:51:15'),
(19, 12, 10, 'Mbapp&eacute; is a once-in-a-generation talent! His speed and skill on the ball are just mesmerizing. Every time he&#039;s on the pitch, you can&#039;t help but feel excited.', '2024-04-25 00:57:51'),
(20, 13, 13, 'Lewandowski is an absolute goal machine! His scoring ability is unmatched, and he always delivers when the team needs him most. A true legend of the game.', '2024-04-25 00:58:27'),
(22, 14, 10, 'Ødegaard is pure magic on the pitch! His vision and passing are out of this world. Every time he touches the ball, you just know something special could happen.', '2024-04-25 00:57:15'),
(23, 10, 13, 'Vinícius Júnior is a young talent with immense potential! His speed, dribbling skills, and flair make him such an exciting player to watch. Can\'t wait to see him develop even further.', '2024-04-25 00:59:01'),
(24, 1, 13, 'Messi is not just the best player of his generation; he\'s the greatest of all time. His talent, vision, and consistency are unmatched. A living legend.', '2024-04-25 00:59:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `player_id_fk` (`player_id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `player_id_fk` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
